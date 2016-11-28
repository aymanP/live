<?php defined('BASEPATH') OR exit('No direct script access allowed');

$aColumns = array(
    'number',
    'total',
    'total_tax',
    'year',
    'date',
    'company',
    'duedate',
    'status',
);

$join = array(
    'LEFT JOIN tblsuppliers ON tblsuppliers.supplierid = tblinvoices.supplierid',
    'LEFT JOIN tblcurrencies ON tblcurrencies.id = tblinvoices.currency'
);

$custom_fields = get_custom_fields('invoice',array('show_on_table'=>1));

$i = 0;
foreach($custom_fields as $field){
    array_push($aColumns,'ctable_'.$i.'.value as cvalue_'.$i);
    array_push($join,'LEFT JOIN tblcustomfieldsvalues as ctable_'.$i . ' ON tblinvoices.id = ctable_'.$i . '.relid AND ctable_'.$i . '.fieldto="'.$field['fieldto'].'" AND ctable_'.$i . '.fieldid='.$field['id']);
    $i++;
}

$where = array();
$filter = array();

if($this->_instance->input->post('not_sent')){
    array_push($filter, 'OR (sent= 0 AND status != 2)');
}
if($this->_instance->input->post('not_have_payment')){
    array_push($filter, 'OR tblinvoices.id NOT IN(SELECT invoiceid FROM tblinvoicepaymentrecords)');
}
if($this->_instance->input->post('recurring')){
    array_push($filter, 'OR recurring > 0');
}
$statuses = $this->_instance->supplier_invoices_model->get_statuses();
$_statuses = array();
foreach($statuses as $status){
    if($this->_instance->input->post('invoices_'.$status)){
        array_push($_statuses,$status);
    }
}
if(count($_statuses) > 0){
    array_push($filter, 'AND status IN (' . implode(', ',$_statuses) . ')');
}
$agents = $this->_instance->supplier_invoices_model->get_sale_agents();
$_agents = array();
foreach($agents as $agent){
    if($this->_instance->input->post('sale_agent_'.$agent['sale_agent'])){
        array_push($_agents,$agent['sale_agent']);
    }
}
if(count($_agents) > 0){
    array_push($filter, 'AND sale_agent IN (' . implode(', ',$_agents) . ')');
}

$_modes = array();
foreach($data['payment_modes'] as $mode){
    if($this->_instance->input->post('invoice_payments_by_'.$mode['id'])){
        array_push($_modes,$mode['id']);
    }
}
if(count($_modes) > 0){
    array_push($where,'AND tblinvoices.id IN (SELECT invoiceid FROM tblinvoicepaymentrecords WHERE paymentmode IN ("'. implode('", "', $_modes) .'"))');
}

$years = $this->_instance->supplier_invoices_model->get_invoices_years();
$_years = array();
foreach($years as $year){
    if($this->_instance->input->post('year_'.$year['year'])){
        array_push($_years,$year['year']);
    }
}
if(count($_years) > 0){
    array_push($filter,'AND tblinvoices.supplierid != 0 AND year IN ('.implode(', ',$_years).')');
}

if(count($filter) > 0){
    array_push($where,'AND ('.prepare_dt_filter($filter).')');
}

if (is_numeric($supplierid)) {
    array_push($where,'AND tblinvoices.supplierid='.$supplierid);
}

if($this->_instance->input->post('project_id')){
    array_push($where,'AND project_id='.$this->_instance->input->post('project_id'));
}


$sIndexColumn = "id";
$sTable       = 'tblinvoices';
$result       = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, array(
    'tblinvoices.id',
    'company',
    'tblsuppliers.supplierid',
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
            if (is_numeric($supplierid)) {
                $__data = '<a target="_blank" href="'.site_url('uploads/invoices/'.$aRow['id'].'/'.get_supplier_invoice_attachments($aRow['id'])).'">' . format_invoice_number($aRow['id']) . '</a><br />';
            } else {
              //  $__data = '<a href="'.site_url('uploads/invoices/'.$aRow['id'].'/'.$file['file_name']).">' . format_invoice_number($aRow['id']) . '</a><br />';onclick="init_invoice(' . $aRow['id'] . '); return false;">'
                if(has_permission('invoices','','download') )
                $__data = '<a target="_blank" href="'.site_url('uploads/invoices/'.$aRow['id'].'/'.get_supplier_invoice_attachments($aRow['id'])).'">' . format_invoice_number($aRow['id']) . '</a><br />';
//                $__data = '<a href="'.'localhost/CRM/live/uploads/purchases/5/templatemo_image_03-1.jpg'.'">' . format_invoice_number($aRow['id']) . '</a><br />';
                //localhost/CRM/live/uploads/purchases/5/templatemo_image_03-1.jpg
                //else   $__data = '<a href="#" onclick="init_invoice(' . $aRow['id'] . '); return false;">' . format_invoice_number($aRow['id']) . '</a><br />';

            }
        } else if ($aColumns[$i] == 'date') {
            $__data = _d($_data);
        } else if ($aColumns[$i] == 'company') {
            $__data = '<a href="' . admin_url('suppliers/supplier/' . $aRow['supplierid']) . '">' . $aRow['company'] . '</a><br />';
        } else if ($aColumns[$i] == 'duedate') {
            $__data = _d($_data);
        } else if ($aColumns[$i] == 'total' || $aColumns[$i] == 'total_tax') {
            $__data = format_money($_data, $aRow['symbol']);
        } else if($aColumns[$i] == 'status') {
            $__data = format_invoice_status($aRow['status']);
            // Status
        } else {
            $__data = $_data;
        }

        $row[] = $__data;
    }

    $options = '';
    $options .= icon_btn('supplier_invoices//' . $aRow['id'], 'pencil-square-o');
    if(has_permission('suppliers','','edit'))
    {
        $options .= icon_btn('supplier_invoices/delete/' . $aRow['id'], 'remove', 'btn-danger _delete');//, array(
//            'data-toggle' => 'tooltip',
//            'data-placement' => 'left',
//            'title' => _l('invoice_delete_tooltip')
//        ));
    }
    if(has_permission('suppliers','','delete')){
        $options .= '<div class="checkbox"><input type="checkbox" value="'.$aRow['id'].'"><label></label></div>';
    }
    $row[]   = $options;

    $output['aaData'][] = $row;
}
