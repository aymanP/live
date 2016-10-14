<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$custom_fields = get_custom_fields('leads', array(
    'show_on_table' => 1
    ));
$is_admin = is_admin();

$aColumns     = array(
    'tblleads.name',
    'tblleads.company',
    'tblleads.email',
    'tblleads.phonenumber',
    'assigned',
    'tblleadsstatus.name',
    'lastcontact',
    'dateadded'
    );
$sIndexColumn = "id";
$sTable       = 'tblleads';

$join = array(
    'LEFT JOIN tblstaff ON tblstaff.staffid = tblleads.assigned',
    'LEFT JOIN tblleadsstatus ON tblleadsstatus.id = tblleads.status'
    );

$i = 0;
foreach ($custom_fields as $field) {
    array_push($aColumns, 'ctable_' . $i . '.value as cvalue_' . $i);
    array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $i . ' ON tblleads.id = ctable_' . $i . '.relid AND ctable_' . $i . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $i . '.fieldid=' . $field['id']);

    $i++;
}

$where = array();

if ($this->_instance->input->post('custom_view')) {
    $custom_view = $this->_instance->input->post('custom_view');
    if ($custom_view == 'lost') {
        array_push($where, 'AND lost = 1');
    } else if ($custom_view == 'junk') {
        array_push($where, 'AND junk = 1');
    } else if ($custom_view == 'not_assigned') {
        array_push($where, 'AND assigned = 0');
    }
}
if(is_admin()){
    if ($this->_instance->input->post('assigned')) {
        $by_assigned = $this->_instance->input->post('assigned');
        array_push($where, 'AND assigned =' . $by_assigned);
    }
}
if ($this->_instance->input->post('status')) {
    $by_assigned = $this->_instance->input->post('status');
    array_push($where, 'AND status =' . $by_assigned);
}

if ($this->_instance->input->post('source')) {
    $by_assigned = $this->_instance->input->post('source');
    array_push($where, 'AND source =' . $by_assigned);
}

if (!is_admin()) {
    array_push($where, 'AND (assigned =' . get_staff_user_id() . ' OR addedfrom = ' . get_staff_user_id() . ' OR is_public = 1)');
}
// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
    @$this->_instance->db->query('SET SQL_BIG_SELECTS=1');
}

$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, array(
    'firstname',
    'lastname',
    'tblleads.id',
    'junk',
    'lost',
    'isdefault',
    'color'
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

        if ($aColumns[$i] == 'tblleads.name') {
            $_data = '<a href="#" onclick="init_lead('.$aRow['id'].');return false;">' . $_data . '</a>';
        } else if ($aColumns[$i] == 'lastcontact' || $aColumns[$i] == 'dateadded') {
            if ($_data == '0000-00-00 00:00:00' || !is_date($_data)) {
                $_data = '';
            } else {
                 if ($aColumns[$i] == 'lastcontact'){
                     $_data = '<span data-toggle="tooltip" title="' . _dt($_data) . '">' . time_ago_specific($_data) . '</span>';
                 } else {
                    $_data = _dt($_data);
                 }
            }
        } else if ($aColumns[$i] == 'assigned') {
            if ($aRow['assigned'] != 0) {
                $_data = staff_profile_image($aRow['assigned'], array(
                    'staff-profile-image-small'
                    )) . ' ' . $aRow['firstname'] . ' ' . $aRow['lastname'];
            } else {
                $_data = '';
            }
        } else if ($aColumns[$i] == 'tblleadsstatus.name') {
            if ($aRow['tblleadsstatus.name'] == null) {
                if ($aRow['lost'] == 1) {
                    $_data = '<span class="label label-danger inline-block">' . _l('lead_lost') . '</span>';
                } else if ($aRow['junk'] == 1) {
                    $_data = '<span class="label label-warning inline-block">' . _l('lead_junk') . '</span>';
                }
            } else {

                $_label_class = '';
                if (empty($aRow['color'])) {
                    $_label_class = 'default';
                }

                $_data = '<span class="inline-block label label-' . $_label_class . '" style="color:' . $aRow['color'] . ';border:1px solid ' . $aRow['color'] . '">' . $_data . '</span>';
            }
        } else if ($aColumns[$i] == 'tblleads.phonenumber') {
            $_data = '<a href="tel:' . $_data . '">' . $_data . '</a>';
        } else if ($aColumns[$i] == 'tblleads.email') {
            $_data = '<a href="mailto:' . $_data . '">' . $_data . '</a>';
        }

        $row[] = $_data;
    }
    $options = icon_btn('#', 'pencil-square-o','btn-default',array('onclick'=>'init_lead('.$aRow['id'].');return false;'));

    if (is_lead_creator($aRow['id']) || $is_admin) {
        $options .= icon_btn('leads/delete/' . $aRow['id'], 'remove', 'btn-danger _delete');
    }

    if($is_admin){
    $options .= '<div class="checkbox mleft5"><input type="checkbox" value="'.$aRow['id'].'"><label></label></div>';
    }

    $row[] = $options;
    if ($aRow['assigned'] == get_staff_user_id()) {
        $row['DT_RowClass'] = 'alert-info';
    }
    $output['aaData'][] = $row;
}
