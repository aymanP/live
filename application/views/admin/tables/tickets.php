<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$aColumns         = array(
    'tbltickets.ticketid',
    'subject',
    'tbldepartments.name',
    'company',
    'tblticketstatus.name',
    'tblpriorities.name',
    'lastreply',
    'tbltickets.date'
    );
$additionalSelect = array(
    'adminread',
    'tbltickets.userid',
    'statuscolor',
    'tbltickets.name',
    'tbltickets.email',
    'tbltickets.userid',
    'tblticketstatus.ticketstatusid',
    'tblpriorities.priorityid',
    'assigned',
    );

if (get_option('services') == 1) {
    array_splice($aColumns, 3, 0, 'tblservices.name');
}
$join = array(
    'LEFT JOIN tblservices ON tblservices.serviceid = tbltickets.service',
    'LEFT JOIN tbldepartments ON tbldepartments.departmentid = tbltickets.department',
    'LEFT JOIN tblticketstatus ON tblticketstatus.ticketstatusid = tbltickets.status',
    'LEFT JOIN tblclients ON tblclients.userid = tbltickets.userid',
    'LEFT JOIN tblpriorities ON tblpriorities.priorityid = tbltickets.priority',
    );

$custom_fields = get_custom_fields('tickets', array(
    'show_on_table' => 1
));
$i             = 0;
foreach ($custom_fields as $field) {
    array_push($aColumns, 'ctable_' . $i . '.value as cvalue_' . $i);
    array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $i . ' ON tbltickets.ticketid = ctable_' . $i . '.relid AND ctable_' . $i . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $i . '.fieldid=' . $field['id']);
    $i++;
}
// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
    @$this->_instance->db->query('SET SQL_BIG_SELECTS=1');
}

$where = array();
$filter = array();

if (isset($userid) && $userid != '') {
    array_push($where, 'AND tbltickets.userid = ' . $userid);
} else if(isset($by_email)){
    array_push($where, 'AND tbltickets.email = "'.$by_email.'"');
}
if (isset($where_not_ticket_id)) {
    array_push($where, 'AND tbltickets.ticketid != ' . $where_not_ticket_id);
}
if ($this->_instance->input->post('project_id')) {
    array_push($where, 'AND project_id = ' . $this->_instance->input->post('project_id'));
}

$statuses = $this->_instance->tickets_model->get_ticket_status();
$_statuses = array();
foreach($statuses as $__status){
    if($this->_instance->input->post('ticket_status_'.$__status['ticketstatusid'])){
        array_push($_statuses,$__status['ticketstatusid']);
    }
}
if(count($_statuses) > 0){
     array_push($filter, 'AND status IN (' . implode(', ',$_statuses) . ')');
}

if ($this->_instance->input->post('my_tickets')) {
    array_push($where, 'OR assigned = ' . get_staff_user_id());
}

$assignees = $this->_instance->tickets_model->get_tickets_assignes_disctinct();
$_assignees = array();
foreach($assignees as $__assignee){
    if($this->_instance->input->post('ticket_assignee_'.$__assignee['assigned'])){
        array_push($_assignees,$__assignee['assigned']);
    }
}
if(count($_assignees) > 0){
     array_push($filter, 'AND assigned IN (' . implode(', ',$_assignees) . ')');
}

if(count($filter) > 0){
    array_push($where,'AND ('.prepare_dt_filter($filter).')');
}
// If userid is set, the the view is in client profile, should be shown all tickets
if (!is_admin() && (!isset($userid) || (isset($userid) && $userid== ''))) {
    if (get_option('staff_access_only_assigned_departments') == 1) {
        $this->_instance->load->model('departments_model');
        $staff_deparments_ids = $this->_instance->departments_model->get_staff_departments(get_staff_user_id(), true);
        $departments_ids = array();
        if (count($staff_deparments_ids) == 0) {
            $departments = $this->_instance->departments_model->get();
            foreach($departments as $department){
                array_push($departments_ids,$department['departmentid']);
            }
        } else {
           $departments_ids = $staff_deparments_ids;
       }
       if(count($departments_ids) > 0){
        array_push($where, 'AND department IN (SELECT departmentid FROM tblstaffdepartments WHERE departmentid IN (' . implode(',', $departments_ids) . ') AND staffid="'.get_staff_user_id().'")');
    }
}
}

$sIndexColumn = 'ticketid';
$sTable       = 'tbltickets';
$result  = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, $additionalSelect);
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
        if ($aColumns[$i] == 'lastreply') {
            if ($aRow[$aColumns[$i]] == NULL) {
                $_data = _l('ticket_no_reply_yet');
            } else {
                $_data = time_ago_specific($aRow[$aColumns[$i]]);
            }
        } else if ($aColumns[$i] == 'subject' || $aColumns[$i] == 'tbltickets.ticketid') {
            // Ticket is assigned
            if ($aRow['assigned'] != 0) {
                if ($aColumns[$i] != 'tbltickets.ticketid') {
                    $_data .= '<a href="' . admin_url('profile/' . $aRow['assigned']) . '" data-toggle="tooltip" title="' . get_staff_full_name($aRow['assigned']) . '" class="pull-left mright5">' . staff_profile_image($aRow['assigned'], array(
                        'staff-profile-image-small'
                        )) . '</a>';
                }
            }
            $_data = '<a href="' . admin_url('tickets/ticket/' . $aRow['tbltickets.ticketid']) . '" class="valign">' . $_data . '</a>';
        } else if ($aColumns[$i] == 'company') {
            if ($aRow['userid'] != 0) {
                $_data = '<a href="' . admin_url('clients/client/' . $aRow['userid']) . '">' . $aRow['company'] . '</a>';
            } else {
                $_data = $aRow['name'];
            }
        } else if ($aColumns[$i] == 'tblticketstatus.name') {
            $_data = '<span class="label inline-block" style="border:1px solid ' . $aRow["statuscolor"] . '; color:' . $aRow['statuscolor'] . '">' . ticket_status_translate($aRow['ticketstatusid']) . '</span>';
        } else if ($aColumns[$i] == 'tbltickets.date') {
            $_data = _dt($_data);
        } else if($aColumns[$i] == 'tblpriorities.name'){
            $_data = ticket_priority_translate($aRow['priorityid']);
        }

        $row[] = $_data;

        if ($aRow['adminread'] == 0) {
            $row['DT_RowClass'] = 'text-danger bold';
        }
    }

    $options = icon_btn('tickets/ticket/' . $aRow['tbltickets.ticketid'], 'pencil-square-o');
    $row[]   = $options .= icon_btn('tickets/delete/' . $aRow['tbltickets.ticketid'], 'remove', 'btn-danger _delete');

    $output['aaData'][] = $row;
}
