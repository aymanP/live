<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$aColumns = array(
    'number',
    'total',
    'total_tax',
    'year',
    'company',
    'date',
    'expirydate',
    'reference_no',
    'status',
    );

$join = array(
    'LEFT JOIN tblclients ON tblclients.userid = tblestimates.clientid',
    'LEFT JOIN tblcurrencies ON tblcurrencies.id = tblestimates.currency'
    );

$custom_fields = get_custom_fields('estimate',array('show_on_table'=>1));

$i = 0;
foreach($custom_fields as $field){
    array_push($aColumns,'ctable_'.$i.'.value as cvalue_'.$i);
    array_push($join,'LEFT JOIN tblcustomfieldsvalues as ctable_'.$i . ' ON tblestimates.id = ctable_'.$i . '.relid AND ctable_'.$i . '.fieldto="'.$field['fieldto'].'" AND ctable_'.$i . '.fieldid='.$field['id']);
    $i++;
}
$where                    = array();
$filter = array();

if($this->_instance->input->post('not_sent')){
    array_push($filter, 'OR (sent= 0 AND status != 4 AND status != 2)');
}
$statuses = $this->_instance->estimates_model->get_statuses();
$_statuses = array();
foreach($statuses as $status){
    if($this->_instance->input->post('estimates_'.$status)){
        array_push($_statuses,$status);
    }
}
if(count($_statuses) > 0){
     array_push($filter, 'AND status IN (' . implode(', ',$_statuses) . ')');
}

$agents = $this->_instance->estimates_model->get_sale_agents();
$_agents = array();
foreach($agents as $agent){
    if($this->_instance->input->post('sale_agent_'.$agent['sale_agent'])){
        array_push($_agents,$agent['sale_agent']);
    }
}
if(count($_agents) > 0){
     array_push($filter, 'AND sale_agent IN (' . implode(', ',$_agents) . ')');
}

$years = $this->_instance->estimates_model->get_estimates_years();
$_years = array();
foreach($years as $year){
    if($this->_instance->input->post('year_'.$year['year'])){
        array_push($_years,$year['year']);
    }
}
if(count($_years) > 0){
    array_push($filter,'AND year IN ('.implode(', ',$_years).')');
}

if(count($filter) > 0){
    array_push($where,'AND ('.prepare_dt_filter($filter).')');
}

if (is_numeric($clientid)) {
    array_push($where,'AND clientid='.$clientid);
}

/*if($this->_instance->input->post('custom_view')){
    $custom_view = $this->_instance->input->post('custom_view');
    if($custom_view == 'not_sent'){
       array_push($where,'AND sent=0');
   }
} else if($this->_instance->input->post('year')){
    $fiter_by_year = true;
    array_push($where,'AND year='.$this->_instance->input->post('year'));
}
*/
$sIndexColumn = "id";
$sTable       = 'tblestimates';
$result       = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, array(
    'tblestimates.id',
    'company',
    'clientid',
    'symbol',
    'total',
    'status'
    ));
$output       = $result['output'];
$rResult      = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = array();

    for ($i = 0; $i < count($aColumns); $i++) {

        if(strpos($aColumns[$i],'as') !== false && !isset($aRow[ $aColumns[$i] ])){
            $_data = $aRow[ strafter($aColumns[$i],'as ')];
        } else {
            $_data = $aRow[ $aColumns[$i] ];
        }

        if ($aColumns[$i] == 'number') {
                        // If is from client area table
            if (is_numeric($clientid)) {
                $__data = '<a href="' . admin_url('estimates/list_estimates/' . $aRow['id']) . '" target="_blank">' . format_estimate_number($aRow['id']) . '</a><br />';
            } else {
             $__data = '<a href="#" onclick="init_estimate(' . $aRow['id'] . '); return false;">' . format_estimate_number($aRow['id']) . '</a><br />';
         }
     } else if ($aColumns[$i] == 'date') {
        $__data = _d($_data);
    } else if ($aColumns[$i] == 'company') {
        $__data = '<a href="' . admin_url('clients/client/' . $aRow['clientid']) . '">' . $aRow['company'] . '</a><br />';
    } else if ($aColumns[$i] == 'expirydate') {
        $__data = _d($_data);
    } else if ($aColumns[$i] == 'total' || $aColumns[$i] == 'total_tax') {
        $__data = format_money($_data, $aRow['symbol']);
    } else if($aColumns[$i] == 'status') {
        $__data = format_estimate_status($aRow['status']);
                        // Status
    } else if($aColumns[$i] == 'reference_no') {
                        // is estimate reference
       $__data = $aRow[$aColumns[$i]];
   } else {
    $__data = $_data;
}
$row[] = $__data;
}

$output['aaData'][] = $row;
}

echo json_encode($output);
die();
