<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$custom_fields = get_custom_fields('customers', array(
    'show_on_table' => 1
));

$aColumns = array('tblclients.profile_image',
    'company',
    'tblcontacts.id',
    'tblcontacts.email',
    'tblclients.phonenumber',
    '(SELECT GROUP_CONCAT(name) FROM tblcustomersgroups LEFT JOIN tblcustomergroups_in ON tblcustomergroups_in.groupid = tblcustomersgroups.id WHERE customer_id = tblclients.userid)',
    'actif',
    'mode_alami',
);

$join = array();
array_push($join,'LEFT JOIN tblcontacts ON tblcontacts.userid=tblclients.userid AND tblcontacts.is_primary=1');
$i    = 0;
foreach ($custom_fields as $field) {
    array_push($aColumns, 'ctable_' . $i . '.value as cvalue_' . $i);
    array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $i . ' ON tblclients.userid = ctable_' . $i . '.relid AND ctable_' . $i . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $i . '.fieldid=' . $field['id']);
    $i++;
}
$sIndexColumn = "userid";
$sTable       = 'tblclients';

$where = array();
// Add blank where all filter can be stored
$filter = array();
// Filter by custom groups
$groups = $this->_instance->clients_model->get_groups();
$_groups = array();
foreach($groups as $group){
    if($this->_instance->input->post('customer_group_'.$group['id'])){
        array_push($_groups,$group['id']);
    }
}
if(count($_groups) > 0){
    array_push($filter, 'OR tblclients.userid IN (SELECT customer_id FROM tblcustomergroups_in WHERE groupid IN ('.implode(', ',$_groups).'))');
}
// Filter by invoices
$_invoice_statuses = array();
foreach(array(1,2,3,4) as $status){
     if($this->_instance->input->post('invoices_'.$status)){
        array_push($_invoice_statuses,$status);
     }
}
if(count($_invoice_statuses) > 0){
    array_push($filter, 'OR tblclients.userid IN (SELECT clientid FROM tblinvoices WHERE status IN (' . implode(', ',$_invoice_statuses) . '))');
}
// Filter by estimates
$_estimate_statuses = array();
foreach(array(1,2,3,4) as $status){
     if($this->_instance->input->post('estimates_'.$status)){
        array_push($_estimate_statuses,$status);
     }
}
if(count($_estimate_statuses) > 0){
    array_push($filter, 'OR tblclients.userid IN (SELECT clientid FROM tblestimates WHERE status IN (' . implode(', ',$_estimate_statuses) . '))');
}
// Filter by projects
$_projects = array();
$this->_instance->load->model('projects_model');
foreach($this->_instance->projects_model->get_project_statuses() as $status){
     if($this->_instance->input->post('projects_'.$status)){
        array_push($_projects,$status);
     }
}
if(count($_projects) > 0){
    array_push($where, 'OR tblclients.userid IN (SELECT clientid FROM tblprojects WHERE status IN (' . implode(', ',$_projects) . '))');
}
// Filter by proposals
$_proposals = array();
foreach(array(1,2,3,4,5) as $status){
     if($this->_instance->input->post('proposals_'.$status)){
        array_push($_proposals,$status);
     }
}
if(count($_proposals) > 0){
    array_push($where, 'OR tblclients.userid IN (SELECT rel_id FROM tblproposals WHERE status IN (' . implode(', ',$_proposals) . ') AND rel_type="customer")');
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
    array_push($where, 'OR tblclients.userid IN (SELECT client FROM tblcontracts WHERE contract_type IN (' . implode(', ',$_contract_types) . '))');
}

if(count($filter) > 0){
    array_push($where,'AND ('.prepare_dt_filter($filter).')');
}
if(!has_permission('customers','','view')) {
    array_push($where,'AND tblclients.userid IN (SELECT customer_id FROM tblcustomeradmins WHERE staff_id='.get_staff_user_id().')');
}

// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
    @$this->_instance->db->query('SET SQL_BIG_SELECTS=1');
}

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, array(
    'company',
    'tblclients.userid',
    'firstname',
    'lastname',
));
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {

    $row = array();

    for ($i = 0; $i < count($aColumns); $i++) {
        if (strpos($aColumns[$i], 'as') !== false && !isset($aRow[$aColumns[$i]])) {
            $_data = $aRow[strafter($aColumns[$i], 'as ')];
        } else {
            $_data = $aRow[$aColumns[$i]];
        }

        if ($i == 4) {
            if ($_data != '') {
                $groups = explode(',', $_data);
                $_data  = '';
                foreach ($groups as $group) {
                    $_data .= '<span class="label label-default mleft5 inline-block">' . $group . '</span>';
                }
            }
        }else if ($aColumns[$i] == 'company') {

            $_data .= ' <a href="' . admin_url('clients/client/' . $aRow['userid']) . '">' . $aRow['company'] . '</a>';
        }else if ($aColumns[$i] == 'tblclients.profile_image')
        {
            $_data = '<a href="' . admin_url('clients/client/' . $aRow['userid']) . '">' . client_profile_image($aRow['userid'], array(
                    'client-profile-image-small'
                )) . '</a>';

        }
        else if ($aColumns[$i] == 'phonenumber') {
            $_data = '<a href="tel:' . $_data . '">' . $_data . '</a>';
        } else if ($aColumns[$i] == $aColumns[2]) {
            $_data = '<a href="mailto:' . $_data . '">' . $_data . '</a>';
        } else if($i == 1){
            // primary contact add link
            $_data = '<a href="'.admin_url('clients/client/'.$aRow['userid'].'?contactid='.get_primary_contact_user_id($aRow['userid'])).'" target="_blank">'.$aRow['firstname']. ' ' .$aRow['lastname']. '</a>';
        } else if ($aColumns[$i] == 'actif') {
             $checked = '';
             if ($aRow['actif'] == 1) {
                 $checked = 'checked';
             }
             $_data = '<input type="checkbox" class="switch-box input-xs" data-size="mini" data-id="' . $aRow['userid'] . '" data-switch-url="'.ADMIN_URL.'/clients/change_clients_status" ' . $checked . '>';
             // For exporting
             $_data .=  '<span class="hide">' . ($checked == 'checked' ? _l('is_active_export') : _l('is_not_active_export')) .'</span>';
        } else if ($aColumns[$i] == 'mode_alami') {
            $checked = '';
            if ($aRow['mode_alami'] == 1) {
                $checked = 'checked';
            }
            $_data = '<input type="checkbox" class="switch-box input-xs" data-size="mini" data-id="' . $aRow['userid'] . '" data-switch-url="'.ADMIN_URL.'/clients/change_clients_mode_alami" ' . $checked . '>';
            // For exporting
            $_data .=  '<span class="hide">' . ($checked == 'checked' ? _l('is_active_export') : _l('is_not_active_export')) .'</span>';
        }
        $row[] = $_data;
    }

    $options = '';
    $options .= icon_btn('clients/client/' . $aRow['userid'], 'pencil-square-o');
    if(has_permission('customers','','delete')){
         $options .= icon_btn('clients/delete/' . $aRow['userid'], 'remove', 'btn-danger _delete', array(
            'data-toggle' => 'tooltip',
            'data-placement' => 'left',
            'title' => _l('client_delete_tooltip')
        ));
     }
        if(has_permission('customers','','delete')){
            $options .= '<div class="checkbox"><input type="checkbox" value="'.$aRow['userid'].'"><label></label></div>';
        }
     $row[]   = $options;

    $output['aaData'][] = $row;
}
