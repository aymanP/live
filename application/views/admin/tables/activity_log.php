<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$aColumns         = array(
    'description',
    'date',
    'tblactivitylog.staffid'
    );
$sIndexColumn     = "id";
$sTable           = 'tblactivitylog';
$join             = array(
    'LEFT JOIN tblstaff ON tblstaff.staffid = tblactivitylog.staffid'
    );
$additionalSelect = array(
    'firstname',
    'lastname'
    );
$result           = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, array(), $additionalSelect, 'ORDER BY date ASC');
$output           = $result['output'];
$rResult          = $result['rResult'];
foreach ($rResult as $aRow) {
    $row = array();
    for ($i = 0; $i < count($aColumns); $i++) {
        $_data = $aRow[$aColumns[$i]];
        if ($aColumns[$i] == 'date') {
            $_data = _dt($_data);
        } else if ($aColumns[$i] == 'tblactivitylog.staffid') {
            $_data = $aRow['firstname'] . ' ' . $aRow['lastname'];
        }
        $row[] = $_data;
    }
    $output['aaData'][] = $row;
}
