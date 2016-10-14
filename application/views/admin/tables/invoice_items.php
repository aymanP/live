<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$aColumns     = array(
    'description',
    'long_description',
    'tblinvoiceitemslist.rate',
    'tax'
    );
$sIndexColumn = "id";
$sTable       = 'tblinvoiceitemslist';

$join             = array(
    'LEFT JOIN tbltaxes ON tbltaxes.id = tblinvoiceitemslist.tax'
    );
$additionalSelect = array(
    'tblinvoiceitemslist.id',
    'tbltaxes.name',
    'taxrate'
    );
$result           = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, array(), $additionalSelect);
$output           = $result['output'];
$rResult          = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = array();
    for ($i = 0; $i < count($aColumns); $i++) {
        $_data = $aRow[$aColumns[$i]];

        if ($aColumns[$i] == 'tax') {
            if (!$aRow['taxrate']) {
                $aRow['taxrate'] = 0;
            }
            $_data = '<span data-toggle="tooltip" title="' . $aRow['name'] . '" data-taxid="' . $aRow['tax'] . '">' . $aRow['taxrate'] . '%' . '</span>';
        } else if($aColumns[$i] == 'description'){
            $_data = '<a href="#" data-toggle="modal" data-target="#sales_item_modal" data-id="'.$aRow['id'].'">'.$_data.'</a>';
        }

        $row[] = $_data;
    }

    $options = icon_btn('#' . $aRow['id'], 'pencil-square-o', 'btn-default', array(
        'data-toggle' => 'modal',
        'data-target' => '#sales_item_modal',
        'data-id' => $aRow['id']
        ));
    $row[]   = $options .= icon_btn('invoice_items/delete/' . $aRow['id'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
