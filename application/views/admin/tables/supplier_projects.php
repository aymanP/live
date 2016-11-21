<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$aColumns = array('name', 'tblprojects.supplierid', 'start_date', 'deadline','status','billing_type','project_created');
$sIndexColumn = "id";
$sTable = 'tblprojects';

$additionalSelect = array('company','tblprojects.id');
$join = array(
    'JOIN tblsuppliers ON tblsuppliers.supplierid = tblprojects.supplierid',
);

$where = array();
$filter = array();
// If dont have permission to view all projects and the request is not coming from the customer profile show only staff projects
if((!has_permission('projects','','view') && !is_numeric($supplierid)) || $this->_instance->input->post('my_projects')){
    array_push($where,' AND tblprojects.id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id='.get_staff_user_id().')');
}
$_statuses = array();
foreach($this->_instance->supplier_projects_model->get_project_statuses() as $status){
    if($this->_instance->input->post('project_status_'.$status)){
        array_push($_statuses,$status);
    }
}

if(count($_statuses) > 0){
    array_push($filter, 'OR status IN (' . implode(', ',$_statuses) . ')');
}
if(count($filter) > 0){
    array_push($where,'AND ('.prepare_dt_filter($filter).')');
}
if(is_numeric($supplierid)){
    $where = array('WHERE tblsuppliers.supplierid='.$supplierid);
}

$custom_fields = get_custom_fields('projects',array('show_on_table'=>1));
$i = 0;
foreach($custom_fields as $field){
    array_push($aColumns,'ctable_'.$i.'.value as cvalue_'.$i);
    array_push($join,'LEFT JOIN tblcustomfieldsvalues as ctable_'.$i . ' ON tblprojects.id = ctable_'.$i . '.relid AND ctable_'.$i . '.fieldto="'.$field['fieldto'].'" AND ctable_'.$i . '.fieldid='.$field['id']);
    $i++;
}
// Fix for big queries. Some hosting have max_join_limit
if(count($custom_fields) > 4){
    @$this->_instance->db->query('SET SQL_BIG_SELECTS=1');
}
$result = data_tables_init($aColumns,$sIndexColumn,$sTable,$join,$where,$additionalSelect);

$output = $result['output'];
$rResult = $result['rResult'];

foreach ( $rResult as $aRow )
{
    $row = array();
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
        if(strpos($aColumns[$i],'as') !== false && !isset($aRow[ $aColumns[$i] ])){
            $_data = $aRow[ strafter($aColumns[$i],'as ')];
        } else {
            $_data = $aRow[ $aColumns[$i] ];
        }

        if($aColumns[$i] == 'tblprojects.supplierid'){
            $_data = '<a href="'.admin_url('suppliers/supplier/'.$aRow['tblprojects.supplierid']).'">'. $aRow['company'] . '</a>';
        } else if($aColumns[$i] == 'start_date' || $aColumns[$i] == 'deadline' || $aColumns[$i] == 'project_created'){
            $_data = _d($_data);
        } else if($aColumns[$i] == 'name'){
            $_data = '<a href="'.admin_url('supplier_projects/view/'.$aRow['id']).'">'.$_data.'</a>';
        } else if($aColumns[$i] == 'billing_type'){
            if($aRow['billing_type'] == 1){
                $type_name = 'project_billing_type_fixed_cost';
            } else if($aRow['billing_type'] == 2){
                $type_name = 'project_billing_type_project_hours';
            } else {
                $type_name = 'project_billing_type_project_task_hours';
            }
            $_data = _l($type_name);
        } else if($aColumns[$i] == 'status'){
            if($_data == 1){
                $label = 'default';
            } else if($_data == 2){
                $label = 'info';
            } else if($_data == 3){
                $label = 'warning';
            } else {
                $label = 'success';
            }
            $status = '<span class="label label-'.$label.' inline-block">'._l('project_status_'.$_data).'</span>';
            $_data = $status;
        }

        $row[] = $_data;
    }
    $options = '';
    if(has_permission('projects','','edit')){
        $options .= icon_btn('supplier_projects/project/'.$aRow['id'],'pencil-square-o');
    }
    if(has_permission('projects','','delete')){
        $options .= icon_btn('supplier_projects/delete/'.$aRow['id'],'remove','btn-danger _delete');
    }

    $row[] = $options;
    $output['aaData'][] = $row;
}
