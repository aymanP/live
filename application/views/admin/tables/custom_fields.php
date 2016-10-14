<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$aColumns     = array(
    'id',
    'name',
    'fieldto',
    'type',
    'active',
    );
$sIndexColumn = "id";
$sTable       = 'tblcustomfields';

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = array();
    for ($i = 0; $i < count($aColumns); $i++) {
        $_data = $aRow[$aColumns[$i]];
        if ($aColumns[$i] == 'name' || $aColumns[$i] == 'id') {
            $_data = '<a href="' . admin_url('custom_fields/field/' . $aRow['id']) . '">' . $_data . '</a>';
        } else if ($aColumns[$i] == 'active') {
            $checked = '';
            if ($aRow['active'] == 1) {
                $checked = 'checked';
            }
            $_data = '<input type="checkbox" class="switch-box input-xs" data-size="mini" data-id="' . $aRow['id'] . '" data-switch-url="'.ADMIN_URL.'/custom_fields/change_custom_field_status" ' . $checked . '>';
            // For exporting
            $_data .=  '<span class="hide">' . ($checked == 'checked' ? _l('is_active_export') : _l('is_not_active_export')) .'</span>';
        }

        $row[] = $_data;
    }

    $options = icon_btn('custom_fields/field/' . $aRow['id'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('custom_fields/delete/' . $aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
