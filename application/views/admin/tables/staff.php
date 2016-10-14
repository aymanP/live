<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$custom_fields = get_custom_fields('staff', array(
    'show_on_table' => 1
    ));
$aColumns      = array(
    'firstname',
    'email',
    'last_login',
    'active'
    );
$sIndexColumn  = "staffid";
$sTable        = 'tblstaff';
$join          = array();
$i             = 0;
foreach ($custom_fields as $field) {
    array_push($aColumns, 'ctable_' . $i . '.value as cvalue_' . $i);
    array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $i . ' ON tblstaff.staffid = ctable_' . $i . '.relid AND ctable_' . $i . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $i . '.fieldid=' . $field['id']);
    $i++;
}
            // Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
    @$this->_instance->db->query('SET SQL_BIG_SELECTS=1');
}
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, array(), array(
    'profile_image',
    'lastname',
    'staffid'
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
        if ($aColumns[$i] == 'last_login') {
            if ($_data != NULL) {
                $_data = time_ago($_data);
            } else {
                $_data = 'Never';
            }
        } else if ($aColumns[$i] == 'active') {
            $checked = '';
            if ($aRow['active'] == 1) {
                $checked = 'checked';
            }
            $_data = '<input type="checkbox" class="switch-box input-xs" data-size="mini" data-id="' . $aRow['staffid'] . '" data-switch-url="'.ADMIN_URL.'/staff/change_staff_status" ' . $checked . '>';
                        // For exporting
            $_data .= '<span class="hide">' . ($checked == 'checked' ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';
        } else if ($aColumns[$i] == 'firstname') {
            $_data = '<a href="' . admin_url('staff/profile/' . $aRow['staffid']) . '">' . staff_profile_image($aRow['staffid'], array(
                'staff-profile-image-small'
                )) . '</a>';
            $_data .= ' <a href="' . admin_url('staff/member/' . $aRow['staffid']) . '">' . $aRow['firstname'] . ' ' . $aRow['lastname'] . '</a>';
        } else if ($aColumns[$i] == 'email') {
            $_data = '<a href="mailto:' . $_data . '">' . $_data . '</a>';
        }
        $row[] = $_data;
    }
    $row[]              = icon_btn('staff/member/' . $aRow['staffid'], 'pencil-square-o');
    $output['aaData'][] = $row;
}
