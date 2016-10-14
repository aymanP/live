<?php
$filter = array();


if ($this->_instance->input->post('my_tasks')) {
    array_push($filter,'OR (tblstafftasks.id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid = ' . get_staff_user_id() . '))');
}
if ($this->_instance->input->post('finished')) {
    array_push($filter,'OR finished=1');
}
if ($this->_instance->input->post('unfinished')) {
    array_push($filter,'OR finished=0');
}
if ($this->_instance->input->post('not_assigned')) {
    array_push($filter,'OR tblstafftasks.id NOT IN (SELECT taskid FROM tblstafftaskassignees)');
}
if ($this->_instance->input->post('due_date_passed')) {
    array_push($filter,'OR (duedate < "' . date('Y-m-d') . '" AND duedate IS NOT NULL) AND finished = 0');
}
if ($this->_instance->input->post('my_following_tasks')) {
    array_push($filter,'OR (tblstafftasks.id IN (SELECT taskid FROM tblstafftasksfollowers WHERE staffid = ' . get_staff_user_id() . '))');
}
if ($this->_instance->input->post('billable')) {
    array_push($filter,'OR billable = 1');
}
if ($this->_instance->input->post('billed')) {
    array_push($filter,'OR billed = 1');
}
if ($this->_instance->input->post('not_billed')) {
    array_push($filter,'OR billable =1 AND billed=0');
}

$assignees = $this->_instance->misc_model->get_tasks_distinct_assignees();
$_assignees = array();
foreach($assignees as $__assignee){
    if($this->_instance->input->post('task_assigned_'.$__assignee['assigneeid'])){
        array_push($_assignees,$__assignee['assigneeid']);
    }
}
if(count($_assignees) > 0){
     array_push($filter, 'AND (tblstafftasks.id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid IN (' . implode(', ', $_assignees) . ')))');
}

if (!has_permission('tasks', '', 'view')) {
    $_tasks_where = 'AND (tblstafftasks.id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid = ' . get_staff_user_id() . ') OR tblstafftasks.id IN (SELECT taskid FROM tblstafftasksfollowers WHERE staffid = ' . get_staff_user_id() . ') OR addedfrom=' . get_staff_user_id();
    if(get_option('show_all_tasks_for_project_member') == 1){
        $_tasks_where .= ' OR (rel_type="project" AND rel_id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id='.get_staff_user_id().'))';
    }
    $_tasks_where .= ' OR is_public = 1)';
    array_push($where, $_tasks_where);
}
if(count($filter) > 0){
    array_push($where,'AND ('.prepare_dt_filter($filter).')');
}
