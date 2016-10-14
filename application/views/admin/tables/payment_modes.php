<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$aColumns     = array(
    'name',
    'description',
    'active',
    );
$sIndexColumn = "id";
$sTable       = 'tblinvoicepaymentsmodes';

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, array(), array(), array(
    'id'
    ));
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = array();
    for ($i = 0; $i < count($aColumns); $i++) {
        $_data = $aRow[$aColumns[$i]];

        if($aColumns[$i] == 'active'){
            $checked = '';
            if($aRow['active'] == 1){
                $checked = 'checked';
            }
            $_data = '<input type="checkbox" class="switch-box input-xs" data-size="mini" data-id="'.$aRow['id'].'" data-switch-url="'.ADMIN_URL.'/paymentmodes/change_payment_mode_status" '.$checked.'>';
                        // For exporting
            $_data .=  '<span class="hide">' . ($checked == 'checked' ? _l('is_active_export') : _l('is_not_active_export')) .'</span>';
        }else if($aColumns[$i] == 'name'){
            $_data = '<a href="#" data-toggle="modal" data-target="#payment_mode_modal" data-id="'.$aRow['id'].'">'.$_data.'</a>';
        }

        $row[] = $_data;
    }

    $options = icon_btn('#' . $aRow['id'], 'pencil-square-o', 'btn-default', array(
        'data-toggle' => 'modal',
        'data-target' => '#payment_mode_modal',
        'data-id' => $aRow['id']
        ));
    $row[]   = $options .= icon_btn('paymentmodes/delete/' . $aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
