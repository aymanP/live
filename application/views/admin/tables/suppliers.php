<?php
/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 08/11/2016
 * Time: 11:17
 */
?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$custom_fields = get_custom_fields('suppliers', array(
    'show_on_table' => 0
));

$aColumns = array('tblsuppliers.profile_image',
    'company',
    'tblsuppliercontacts.firstname ',
    'tblsuppliercontacts.email',
    'tblsuppliers.phonenumber',
    '(SELECT GROUP_CONCAT(name) FROM tblcustomersgroups LEFT JOIN tblsuppliergroups_in ON tblsuppliergroups_in.groupid = tblcustomersgroups.id WHERE supplier_id = tblsuppliers.supplierid)',


);

$join = array();
array_push($join,'LEFT JOIN tblsuppliercontacts ON tblsuppliercontacts.supplierid=tblsuppliers.supplierid AND tblsuppliercontacts.is_primary=1');
$i    = 0;
foreach ($custom_fields as $field) {
    array_push($aColumns, 'ctable_' . $i . '.value as cvalue_' . $i);
    array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $i . ' ON tblsuppliers.supplierid = ctable_' . $i . '.relid AND ctable_' . $i . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $i . '.fieldid=' . $field['id']);
    $i++;
}
$sIndexColumn = "supplierid";
$sTable       = 'tblsuppliers';

$where = array();
// Add blank where all filter can be stored
$filter = array();
// Filter by custom groups
$groups = $this->_instance->clients_model->get_groups();
$_groups = array();
foreach($groups as $group)
{
    if($this->_instance->input->post('supplier_group_'.$group['id'])){
        array_push($_groups,$group['id']);
    }
}
if(count($_groups) > 0){
    array_push($filter, 'OR tblsuppliers.supplierid IN (SELECT supplier_id FROM tblsuppliergroups_in WHERE groupid IN ('.implode(', ',$_groups).'))');
}
// Filter by invoices
$_invoice_statuses = array();
foreach(array(1,2,3,4) as $status)
{
    if($this->_instance->input->post('invoices_'.$status))
    {
        array_push($_invoice_statuses,$status);
    }
}
if(count($_invoice_statuses) > 0)
{
    array_push($filter, 'OR tblsuppliers.supplierid IN (SELECT supplierid FROM tblinvoices WHERE status IN (' . implode(', ',$_invoice_statuses) . '))');
}
// Filter by estimates
$_estimate_statuses = array();
foreach(array(1,2,3,4) as $status)
{
    if($this->_instance->input->post('estimates_'.$status)){
        array_push($_estimate_statuses,$status);
    }
}
if(count($_estimate_statuses) > 0){
    array_push($filter, 'OR tblsuppliers.supplierid IN (SELECT supplierid FROM tblestimates WHERE status IN (' . implode(', ',$_estimate_statuses) . '))');
}
// Filter by projects
$_projects = array();
$this->_instance->load->model('projects_model');
foreach($this->_instance->projects_model->get_project_statuses() as $status)
{
    if($this->_instance->input->post('projects_'.$status))
    {
        array_push($_projects,$status);
    }
}
if(count($_projects) > 0){
    array_push($where, 'OR tblsuppliers.supplierid IN (SELECT supplierid FROM tblprojects WHERE status IN (' . implode(', ',$_projects) . '))');
}
// Filter by proposals
$_proposals = array();
foreach(array(1,2,3,4,5) as $status)
{
    if($this->_instance->input->post('proposals_'.$status))
    {
        array_push($_proposals,$status);
    }
}
if(count($_proposals) > 0)
{
    array_push($where, 'OR tblsuppliers.supplierid IN (SELECT rel_id FROM tblproposals WHERE status IN (' . implode(', ',$_proposals) . ') AND rel_type="supplier")');
}
// Filter by having contracts by type
$this->_instance->load->model('contracts_model');
$_contract_types = array();
$contract_types = $this->_instance->contracts_model->get_contract_types();
foreach($contract_types as $type){
    if($this->_instance->input->post('contract_type_'.$type['id'])){
        array_push($_contract_types,$type['id']);
    }
}
if(count($_contract_types) > 0){
    array_push($where, 'OR tblsuppliers.supplierid IN (SELECT supplier FROM tblcontracts WHERE contract_type IN (' . implode(', ',$_contract_types) . '))');
}

if(count($filter) > 0){
    array_push($where,'AND ('.prepare_dt_filter($filter).')');
}
if(!has_permission('suppliers','','view')) {
    array_push($where,'AND tblsuppliers.supplierid IN (SELECT supplier_id FROM tblsupplieradmins WHERE staff_id='.get_staff_user_id().')');
}

// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
    @$this->_instance->db->query('SET SQL_BIG_SELECTS=1');
}

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, array(
    'company',
    'tblsuppliers.supplierid',
    'firstname',
    'lastname',
));
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {

    $row = array();

    for ($i = 0; $i < count($aColumns); $i++)
    {
        if (strpos($aColumns[$i], 'as') !== false && !isset($aRow[$aColumns[$i]]))
        {
            $_data = $aRow[strafter($aColumns[$i], 'as ')];
        } else {
            $_data = $aRow[$aColumns[$i]];
        }

        if ($i == 4)
        {
            if ($_data != '')
            {
                $groups = explode(',', $_data);
                $_data  = '';
                foreach ($groups as $group)
                {
                    $_data .= '<span class="label label-default mleft5 inline-block">' . $group . '</span>';
                }
            }
        }else if ($aColumns[$i] == 'company') {
            $_data = ' <a href="' . admin_url('suppliers/supplier/' . $aRow['supplierid']) . '">' . $aRow['company'] . '</a>';
        }else if ($aColumns[$i] == 'tblsuppliers.profile_image') {
            $_data =  supplier_profile_image($aRow['supplierid'], array(
                'client-profile-image-small'
            )) ;
        }else if ($aColumns[$i] == 'phonenumber') {
            $_data =  $_data;
        } else if ($aColumns[$i] == $aColumns[2]) {
            $_data =  $aRow['firstname']. ' ' .$aRow['lastname'] ;
        } else if($i == 1){
            // primary contact add link
            $_data = '<a href="'.admin_url('suppliers/supplier/'.$aRow['supplierid'].'?contactid='.get_supplier_primary_contact_user_id($aRow['supplierid'])).'" target="_blank">'.$aRow['firstname']. ' ' .$aRow['lastname']. '</a>';
        }
        $row[] = $_data;
    }

    $options = '<div class="checkbox"><input type="checkbox" value="'.$aRow['supplierid'].'"><label></label></div>';
    $options .= icon_btn('suppliers/supplier/' . $aRow['supplierid'], 'pencil-square-o');
//    if(has_permission('suppliers','','delete'))
//    {
    $options .= icon_btn('suppliers/delete/' . $aRow['supplierid'], 'remove', 'btn-danger _delete', array(
        'data-toggle' => 'tooltip',
        'data-placement' => 'left',
        'title' => _l('supplier_delete_tooltip')
    ));
//    }
//    if(has_permission('suppliers','','delete')){
    $options .= '<div class="checkbox"><input type="checkbox" value="'.$aRow['supplierid'].'"><label></label></div>';
//    }
    $row[]   = $options;

   $output['aaData'][] = $row;
}

