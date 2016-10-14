<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tasks extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('tasks_model');
        $this->load->model('projects_model');
    }
    /* Open also all taks if user access this /tasks url */
    public function index($id = '')
    {
        $this->list_tasks($id);
    }
    /* List all tasks */
    public function list_tasks($id = '')
    {
        // if passed from url
        $_custom_view = '';
        if ($this->input->get('custom_view')) {
            $_custom_view = $this->input->get('custom_view');
        }
        if ($this->input->is_ajax_request()) {
            $this->perfex_base->get_table_data('tasks');
        }
        $data['taskid'] = '';
        if (is_numeric($id)) {
            $data['taskid'] = $id;
        }
        $data['custom_view'] = $_custom_view;
        $data['title']       = _l('tasks');
        $this->load->view('admin/tasks/manage', $data);
    }
    public function detailed_overview(){
        $overview = $this->tasks_model->get_detailed_overview();
        $data['members'] = $this->staff_model->get();
        $data['overview'] = $overview['detailed'];
        $data['staff_id'] = $overview['staff_id'];
        $data['title'] = _l('detailed_overview');
        $this->load->view('admin/tasks/detailed_overview',$data);
    }
    public function init_relation_tasks($rel_id, $rel_type)
    {
        if ($this->input->is_ajax_request()) {
            $this->perfex_base->get_table_data('tasks_relations', array(
                'rel_id' => $rel_id,
                'rel_type' => $rel_type
            ));
        }
    }
    /* Add new task or update existing */
    public function task($id = '')
    {
        if (!has_permission('tasks', '', 'edit') && !has_permission('tasks', '', 'create')) {
            access_denied('Tasks');
        }

        $data = array();
       // FOr new task add directly from the projects milestones
        if($this->input->get('milestone_id')){
            $this->db->where('id',$this->input->get('milestone_id'));
            $milestone = $this->db->get('tblmilestones')->row();
            if($milestone){
                $data['_milestone_selected_data'] = array(
                    'id'=>$milestone->id,
                    'due_date'=>_d($milestone->due_date),
                    );
            }
        }
        if($this->input->get('start_date')){
            $data['start_date'] = $this->input->get('start_date');
        }
        if ($this->input->post()) {
            if ($id == '') {
                if (!has_permission('tasks', '', 'create')) {
                    header('HTTP/1.0 400 Bad error');
                    echo json_encode(array(
                        'success' => false,
                        'message' => _l('access_denied')
                    ));
                    die;
                }
                $id      = $this->tasks_model->add($this->input->post());
                $_id     = false;
                $success = false;
                $message = '';
                if ($id) {
                    $success = true;
                    $_id     = $id;
                    $message = _l('added_successfuly', _l('task'));
                }
                echo json_encode(array(
                    'success' => $success,
                    'id' => $_id,
                    'message' => $message
                ));
            } else {
                if (!has_permission('tasks', '', 'edit')) {
                    header('HTTP/1.0 400 Bad error');
                    echo json_encode(array(
                        'success' => false,
                        'message' => _l('access_denied')
                    ));
                    die;
                }
                $success = $this->tasks_model->update($this->input->post(), $id);
                $message = '';
                if ($success) {
                    $message = _l('updated_successfuly', _l('task'));
                }
                echo json_encode(array(
                    'success' => $success,
                    'message' => $message
                ));
            }
            die;
        }
        if ($id == '') {
            $title = _l('add_new', _l('task_lowercase'));
        } else {
            $data['task'] = $this->tasks_model->get($id);
            $title        = _l('edit', _l('task_lowercase'));
        }
        $data['project_end_date_attrs'] = array();
        if ($this->input->get('rel_type') == 'project' && $this->input->get('rel_id')) {
            $project                        = $this->projects_model->get($this->input->get('rel_id'));
            $data['project_end_date_attrs'] = array(
                'data-date-end-date' => $project->deadline
            );
        }
        $data['id']    = $id;
        $data['title'] = $title;
        $this->load->view('admin/tasks/task', $data);
    }
    public function copy(){
        if (has_permission('tasks', '', 'create')){
            $new_task_id = $this->tasks_model->copy($this->input->post());
            $response = array(
                'new_task_id' => '',
                'alert_type'=>'warning',
                'message'=>_l('failed_to_copy_task'),
                'success'=>false,
                );
            if($new_task_id){
                $response['message']= _l('task_copied_successfuly');
                $response['new_task_id']= $new_task_id;
                $response['success']= true;
                $response['alert_type']= 'success';
            }
            echo json_encode($response);
        }
    }
    public function get_billable_task_data($task_id)
    {
        echo json_encode($this->tasks_model->get_billable_task_data($task_id));
    }
    /* Get task data in a right pane */
    public function get_task_data()
    {
        $taskid = $this->input->post('taskid');
        // Task main data
        $task   = $this->tasks_model->get($taskid);
        if (!$task) {
            echo 'Task not found';
            die();
        }
        $data['task'] = $task;
        $data['id']   = $task->id;
        $this->load->view('admin/tasks/view_task_template', $data);
    }
    public function get_staff_started_timers()
    {
        $data['_started_timers'] = $this->misc_model->get_staff_started_timers();
        $_data['html']  = $this->load->view('admin/tasks/started_timers', $data, true);
        if (count($data['_started_timers']) > 0) {
            $_data['timers_found'] = true;
        }
        echo json_encode($_data);
    }
    public function init_checklist_items()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $post_data          = $this->input->post();
                $data['task_id']    = $post_data['taskid'];
                $data['checklists'] = $this->tasks_model->get_checklist_items($post_data['taskid']);
                $this->load->view('admin/tasks/checklist_items_template', $data);
            }
        }
    }
    public function task_tracking_stats($task_id)
    {
        $data['stats'] = json_encode($this->tasks_model->task_tracking_stats($task_id));
        $this->load->view('admin/tasks/tracking_stats', $data);
    }
    public function checkbox_action($listid, $value)
    {
        $this->db->where('id', $listid);
        $this->db->update('tbltaskchecklists', array(
            'finished' => $value
        ));

        if($this->db->affected_rows() > 0){
            if($value == 1){
                $this->db->where('id',$listid);
                $this->db->update('tbltaskchecklists',array('finished_from'=>get_staff_user_id()));
            }
        }
    }
    public function add_checklist_item()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                echo json_encode(array(
                    'success' => $this->tasks_model->add_checklist_item($this->input->post())
                ));
            }
        }
    }
    public function update_checklist_order()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $this->tasks_model->update_checklist_order($this->input->post());
            }
        }
    }
    public function delete_checklist_item($id)
    {
        $list = $this->tasks_model->get_checklist_item($id);
        if (has_permission('tasks', '', 'delete') || $list->addedfrom == get_staff_user_id()) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(array(
                    'success' => $this->tasks_model->delete_checklist_item($id)
                ));
            }
        }
    }
    public function update_checklist_item()
    {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $this->tasks_model->update_checklist_item($this->input->post('listid'), $this->input->post('description'));
            }
        }
    }
    public function make_public($task_id)
    {
        if (!has_permission('tasks', '', 'edit')) {
            json_encode(array(
                'success' => false
            ));
            die;
        }
        echo json_encode(array(
            'success' => $this->tasks_model->make_public($task_id)
        ));
    }
    /* Add new task comment / ajax */
    public function add_task_comment()
    {
        echo json_encode(array(
            'success' => $this->tasks_model->add_task_comment($this->input->post())
        ));
    }
    /* Add new task follower / ajax */
    public function add_task_followers()
    {
        if (has_permission('tasks', '', 'edit') || has_permission('tasks', '', 'create')) {
            echo json_encode(array(
                'success' => $this->tasks_model->add_task_followers($this->input->post())
            ));
        }
    }
    /* Add task assignees / ajax */
    public function add_task_assignees()
    {
        if (has_permission('tasks', '', 'edit') || has_permission('tasks', '', 'create')) {
            echo json_encode(array(
                'success' => $this->tasks_model->add_task_assignees($this->input->post())
            ));
        }
    }
    /* Check which staff is already in this group and remove from select */
    public function reload_followers_select($taskid)
    {
        $options = '';

        $staff = $this->staff_model->get();
        foreach ($staff as $follower) {
            if (total_rows('tblstafftasksfollowers', array(
                'staffid' => $follower['staffid'],
                'taskid' => $taskid
            )) == 0) {
                $options .= '<option value="' . $follower['staffid'] . '">' . get_staff_full_name($follower['staffid']) . '</option>';
            }
        }
        echo $options;
    }
    /* Check which staff is already in this group and remove from select */
    public function reload_assignees_select($taskid)
    {
        $options = '';

        $staff = $this->staff_model->get();
        $task  = $this->tasks_model->get($taskid);
        foreach ($staff as $assignee) {
            if (total_rows('tblstafftaskassignees', array(
                'staffid' => $assignee['staffid'],
                'taskid' => $taskid
            )) == 0) {
                if ($task->rel_type == 'project') {
                    if (total_rows('tblprojectmembers', array(
                        'project_id' => $task->rel_id,
                        'staff_id' => $assignee['staffid']
                    )) == 0) {
                        continue;
                    }
                }
                $options .= '<option value="' . $assignee['staffid'] . '">' . get_staff_full_name($assignee['staffid']) . '</option>';
            }
        }
        echo $options;
    }
    public function edit_comment()
    {
        if ($this->input->post()) {
            $success = $this->tasks_model->edit_comment($this->input->post());
            $message = '';
            if ($success) {
                $message = _l('task_comment_updated');
            }
            echo json_encode(array(
                'success' => $success,
                'message' => $message
            ));
        }
    }
    /* Remove task comment / ajax */
    public function remove_comment($id)
    {
        echo json_encode(array(
            'success' => $this->tasks_model->remove_comment($id)
        ));
    }
    /* Remove assignee / ajax */
    public function remove_assignee($id, $taskid)
    {
        if (has_permission('tasks', '', 'edit') && has_permission('tasks', '', 'create')) {
            $success = $this->tasks_model->remove_assignee($id, $taskid);
            $message = '';
            if ($success) {
                $message = _l('task_assignee_removed');
            }
            echo json_encode(array(
                'success' => $success,
                'message' => $message
            ));
        }
    }
    /* Remove task follower / ajax */
    public function remove_follower($id, $taskid)
    {
        if (has_permission('tasks', '', 'edit') && has_permission('tasks', '', 'create')) {
            $success = $this->tasks_model->remove_follower($id, $taskid);
            $message = '';
            if ($success) {
                $message = _l('task_follower_removed');
            }
            echo json_encode(array(
                'success' => $success,
                'message' => $message
            ));
        }
    }
    /* Mark task as complete / ajax*/
    public function mark_complete($id)
    {
        $success = $this->tasks_model->mark_complete($id);
        $message = '';
        if ($success) {
            $message = _l('task_marked_as_complete');
        }
        echo json_encode(array(
            'success' => $success,
            'message' => $message
        ));
    }
    /* Unmark task as complete / ajax*/
    public function unmark_complete($id)
    {
        $success = $this->tasks_model->unmark_complete($id);
        $message = '';
        if ($success) {
            $message = _l('task_unmarked_as_complete');
        }
        echo json_encode(array(
            'success' => $success,
            'message' => $message
        ));
    }
    /* Delete task from database */
    public function delete_task($id)
    {
        if (!has_permission('tasks', '', 'delete')) {
            access_denied('tasks');
        }
        $success = $this->tasks_model->delete_task($id);
        $message = _l('problem_deleting', _l('task_lowercase'));
        if ($success) {
            $message = _l('deleted', _l('task'));
            set_alert('success', $message);
        } else {
            set_alert('warning', $message);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    /**
     * Remove task attachment
     * @since  Version 1.0.1
     * @param  mixed $id attachment it
     * @return json
     */
    public function remove_task_attachment($id)
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode(array(
                'success' => $this->tasks_model->remove_task_attachment($id)
            ));
        }
    }
    /**
     * Upload task attachment
     * @since  Version 1.0.1
     */
    public function upload_file()
    {
        if ($this->input->post()) {
            $taskid = $this->input->post('taskid');
            $file   = handle_tasks_attachments($taskid);
            if ($file) {
                $success = $this->tasks_model->add_attachment_to_database($taskid, $file);
                echo json_encode(array(
                    'success' => $success
                ));
            }
        }
    }
    public function timer_tracking($task_id = '', $timer_id = '')
    {
        echo json_encode(array(
            'success' => $this->tasks_model->timer_tracking($task_id, $timer_id)
        ));
    }
    public function delete_timesheet($id)
    {
        if (has_permission('tasks', '', 'delete') || has_permission('projects', '', 'delete')) {
            $alert_type = 'warning';
            $success    = $this->tasks_model->delete_timesheet($id);
            if ($success) {
                $message = _l('deleted', _l('project_timesheet'));
                set_alert('success', $message);
            }
            if(!$this->input->is_ajax_request()){
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('task_single_timesheets_open',true);
            }
        }
    }
    public function log_time(){
        $success = $this->tasks_model->timesheet($this->input->post());
        if ($success === true) {
            $this->session->set_flashdata('task_single_timesheets_open',true);
            $message = _l('added_successfuly', _l('project_timesheet'));
        } else if (is_array($success) && isset($success['end_time_smaller'])) {
            $message = _l('failed_to_add_project_timesheet_end_time_smaller');
        } else {
            $message = _l('project_timesheet_not_updated');
        }

        echo json_encode(array(
            'success' => $success,
            'message' => $message
            ));
        die;

    }
}
