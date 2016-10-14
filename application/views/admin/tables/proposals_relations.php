<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$aColumns     = array(
    'id',
    'subject',
    'total',
    'open_till',
    'datecreated',
    'status'
    );
$sIndexColumn = "id";
$sTable       = 'tblproposals';

$custom_fields = get_custom_fields('proposal',array('show_on_table'=>1));
$join = array();
$i = 0;
foreach($custom_fields as $field){
    array_push($aColumns,'ctable_'.$i.'.value as cvalue_'.$i);
    array_push($join,'LEFT JOIN tblcustomfieldsvalues as ctable_'.$i . ' ON tblproposals.id = ctable_'.$i . '.relid AND ctable_'.$i . '.fieldto="'.$field['fieldto'].'" AND ctable_'.$i . '.fieldid='.$field['id']);
    $i++;
}

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, array('AND rel_id = '.$rel_id. ' AND rel_type = "'.$rel_type.'"'), array(
    'tblproposals.id',
    'currency',
    ));
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {

    $row = array();
    for ($i = 0; $i < count($aColumns); $i++) {
        if(strpos($aColumns[$i],'as') !== false && !isset($aRow[ $aColumns[$i] ])){
            $_data = $aRow[ strafter($aColumns[$i],'as ')];
        } else {
            $_data = $aRow[ $aColumns[$i] ];
        }if($aColumns[$i] == 'id'){
            $_data = '<span class="label label-default inline-block">'.$_data.'</span>';
        } else if ($aColumns[$i] == 'subject') {
            $_data = '<a href="'.admin_url('proposals/list_proposals/'.$aRow['id']).'">' . $_data . '</a>';
        } else if ($aColumns[$i] == 'status') {
            $_data = format_proposal_status($aRow['status']);
        } else if($aColumns[$i] == 'open_till' || $aColumns[$i] == 'datecreated'){
            $_data = _d($_data);
        } else if($aColumns[$i] == 'total'){
            if($aRow['currency'] != 0){
                $_data = format_money($_data,$this->_instance->currencies_model->get_currency_symbol($aRow['currency']));
            } else {
                $_data = format_money($_data,$this->_instance->currencies_model->get_base_currency($aRow['currency'])->symbol);
            }

        }
        $row[] = $_data;
    }

    $output['aaData'][] = $row;
}
