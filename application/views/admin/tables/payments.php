<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$aColumns = array(
    'tblinvoicepaymentrecords.id',
    'invoiceid',
    'paymentmode',
    'transactionid',
    'company',
    'amount',
    'tblinvoicepaymentrecords.date'
    );

$join = array(
    'LEFT JOIN tblinvoices ON tblinvoices.id = tblinvoicepaymentrecords.invoiceid',
    'LEFT JOIN tblclients ON tblclients.userid = tblinvoices.clientid',
    'LEFT JOIN tblcurrencies ON tblcurrencies.id = tblinvoices.currency',
    'LEFT JOIN tblinvoicepaymentsmodes ON tblinvoicepaymentsmodes.id = tblinvoicepaymentrecords.paymentmode'

    );

$where = array();
if(is_numeric($clientid)){
    array_push($where,'AND tblclients.userid='.$clientid);
}

if($this->_instance->input->post('custom_view')){
    $custom_view = $this->_instance->input->post('custom_view');
    if($custom_view == 'today'){
        array_push($where,'AND DATE(tblinvoicepaymentrecords.date) = "'.date('Y-m-d').'"');
    }
}

$sIndexColumn = "id";
$sTable       = 'tblinvoicepaymentrecords';
$result       = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, array(
    'tblinvoices.id',
    'tblinvoicepaymentrecords.date',
    'company',
    'clientid',
    'symbol',
    'total',
    'number',
    'tblinvoicepaymentsmodes.name',
    'tblinvoicepaymentsmodes.id as paymentmodeid'
    ));
$output       = $result['output'];
$rResult      = $result['rResult'];

$this->_instance->load->model('payment_modes_model');
$online_modes = $this->_instance->payment_modes_model->get_online_payment_modes();

foreach ($rResult as $aRow) {
    $row = array();

    for ($i = 0; $i < count($aColumns); $i++) {
        $_data = $aRow[$aColumns[$i]];
        if ($aColumns[$i] == 'paymentmode') {
           $_data = $aRow['name'];
                         // Since version 1.0.1
           if (is_null($aRow['paymentmodeid'])) {
            foreach ($online_modes as $online_mode) {
                if ($aRow['paymentmode'] == $online_mode['id']) {
                    $_data = $online_mode['name'];
                }
            }
        }
    } else if ($aColumns[$i] == 'tblinvoicepaymentrecords.id') {
        $_data = '<a href="' . admin_url('payments/payment/' . $_data) . '">' . $_data . '</a>';
    } else if ($aColumns[$i] == 'tblinvoicepaymentrecords.date') {
        $_data = _d($_data);
    } else if ($aColumns[$i] == 'invoiceid') {
        $_data = '<a href="' . admin_url('invoices/list_invoices/' . $aRow[$aColumns[$i]]) . '">' . format_invoice_number($aRow['id']) . '</a>';
    } else if ($aColumns[$i] == 'company') {
        $_data = '<a href="' . admin_url('clients/client/' . $aRow['clientid']) . '">' . $aRow['company'] . '</a>';
    } else if ($aColumns[$i] == 'amount') {
        $_data = format_money($_data,$aRow['symbol']);
    }

    $row[] = $_data;
}

$options            = icon_btn('payments/payment/' . $aRow['tblinvoicepaymentrecords.id'], 'pencil-square-o');
$row[]              = $options .= icon_btn('payments/delete/' . $aRow['tblinvoicepaymentrecords.id'], 'remove', 'btn-danger _delete');
$output['aaData'][] = $row;
}
