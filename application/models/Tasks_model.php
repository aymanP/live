<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tasks_model extends CRM_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('projects_model');
        $this->load->model('staff_model');
    }
    public function get_user_tasks_assigned(){
        $this->db->where('id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid = ' . get_staff_user_id() . ')');
        $this->db->where('finished',0);
        $this->db->order_by('duedate','asc');
        return  $this->db->get('tblstafftasks')->result_array();
    }
    /**
     * Get task by id
     * @param  mixed $id task id
     * @return object
     */
    public function get($id, $where = array())
    {
        $is_admin = is_admin();
        $this->db->where('id', $id);
        $this->db->where($where);
        $task = $this->db->get('tblstafftasks')->row();
        if ($task) {
            $task->comments        = $this->get_task_comments($id);
            $task->assignees       = $this->get_task_assignees($id);
            $task->followers       = $this->get_task_followers($id);
            $task->attachments     = $this->get_task_attachments($id);
            $task->timesheets      = $this->get_timesheeets($id);
            $task->checklist_items = $this->get_checklist_items($id);
        }
        return $task;
    }
    public function get_detailed_overview(){
        $overview = array();
        if(!has_permission('tasks','','create')){
          $staff_id = get_staff_user_id();
        } else if($this->input->post('member')){
          $staff_id = $this->input->post('member');
        } else {
          $staff_id = '';
        }
        $month = ($this->input->post('month') ? $this->input->post('month') : '');
        $show_tasks = (isset($_POST['show_tasks']) ? $_POST['show_tasks'] : '');

        $fetch_month_from = ($this->input->post('month_from') ? $this->input->post('month_from') : 'duedate');
        for ($m = 1; $m <= 12; $m++) {
           if($month != '' && $month != $m){continue;}
           $this->db->where('MONTH('.$fetch_month_from.')',$m);
           if(is_numeric($staff_id)){
                $this->db->where('(id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid=' . $staff_id . '))');
           }
           if($show_tasks != ''){
                $this->db->where('finished',$show_tasks);
           }
           $this->db->order_by($fetch_month_from,'ASC');
           array_push($overview,$m);
           $overview[$m] = $this->db->get('tblstafftasks')->result_array();
        }
        unset($overview[0]);
        return array('staff_id'=>$staff_id,'detailed'=>$overview);
    }
    public function is_task_billed($id)
    {
        $this->db->where('id', $id);
        $this->db->where('billed', 1);
        $row = $this->db->get('tblstafftasks')->row();
        if ($row) {
            return true;
        }
        return false;
    }
    public function copy($data,$overwrites = array()){

        $task = $this->get($data['copy_from']);
        $fields_tasks = $this->db->list_fields('tblstafftasks');
        $_new_task_data = array();
        foreach ($fields_tasks as $field) {
            if (isset($task->$field)) {
                $_new_task_data[$field] = $task->$field;
            }
        }
        unset($_new_task_data['id']);
        $_new_task_data['finished']  = 0;
        $_new_task_data['dateadded'] = date('Y-m-d H:i:s');
        $_new_task_data['startdate'] = date('Y-m-d');
        $_new_task_data['deadline_notified']    = 0;
        $_new_task_data['billed']     = 0;
        $_new_task_data['invoice_id'] = 0;

        if (!empty($task->duedate)) {
            $dStart                    = new DateTime($task->startdate);
            $dEnd                      = new DateTime($task->duedate);
            $dDiff                     = $dStart->diff($dEnd);
            $_new_task_data['duedate'] = date('Y-m-d', strtotime(date('Y-m-d', strtotime('+' . $dDiff->days . 'DAY'))));
        }
        // Overwrite rel id and rel type - possible option to pass when copying project tasks in projects_model
        if(count($overwrites) > 0){
            foreach($overwrites as $key=>$val){
                $_new_task_data[$key] = $val;
            }
        }
        unset($_new_task_data['datefinished']);
        $this->db->insert('tblstafftasks',$_new_task_data);
        $insert_id = $this->db->insert_id();
        if($insert_id){
            if(isset($data['copy_task_assignees']) && $data['copy_task_assignees'] == 'true'){
                $this->copy_task_assignees($data['copy_from'],$insert_id);
            }
            if(isset($data['copy_task_followers']) && $data['copy_task_followers'] == 'true'){
                $this->copy_task_followers($data['copy_from'],$insert_id);
            }
            if(isset($data['copy_task_checklist_items']) &&  $data['copy_task_checklist_items'] == 'true'){
                $this->copy_task_checklist_items($data['copy_from'],$insert_id);
            }
            if(isset($data['copy_task_attachments']) && $data['copy_task_attachments'] == 'true'){
                if(is_dir(TASKS_ATTACHMENTS_FOLDER.$data['copy_from'])){
                    if(xcopy(TASKS_ATTACHMENTS_FOLDER.$data['copy_from'],TASKS_ATTACHMENTS_FOLDER.$insert_id)){
                        $attachments = $this->get_task_attachments($data['copy_from']);
                        foreach($attachments as $at){
                            $_at = array();
                            $_at[] = $at;
                            // Fix
                            $_at[0]['filename'] = $at['file_name'];
                            $this->add_attachment_to_database($insert_id,$_at);
                        }
                    }
                }
            }
            $this->copy_task_custom_fields($data['copy_from'],$insert_id);

            return $insert_id;
        }

        return false;
    }
    public function copy_task_followers($from_task,$to_task){
        $followers = $this->tasks_model->get_task_followers($from_task);
        foreach ($followers as $follower) {
            $this->db->insert('tblstafftasksfollowers', array(
                'taskid' => $to_task,
                'staffid' => $follower['followerid']
                ));
        }
    }
    public function copy_task_assignees($from_task,$to_task){
        $assignees = $this->tasks_model->get_task_assignees($from_task);
        foreach ($assignees as $assignee) {
            $this->db->insert('tblstafftaskassignees', array(
                'taskid' => $to_task,
                'staffid' => $assignee['assigneeid'],
                'assigned_from'=>get_staff_user_id(),
                ));
        }
    }
    public function copy_task_checklist_items($from_task,$to_task){
        $checklists = $this->tasks_model->get_checklist_items($from_task);
        foreach ($checklists as $list) {
            $this->db->insert('tbltaskchecklists', array(
                'taskid' => $to_task,
                'finished' => 0,
                'description' => $list['description'],
                'dateadded' => date('Y-m-d H:i:s'),
                'addedfrom' => $list['addedfrom'],
                'list_order' => $list['list_order']
                ));
        }
    }
    public function copy_task_custom_fields($from_task,$to_task){
        $custom_fields = get_custom_fields('tasks');
        foreach ($custom_fields as $field) {
            $value = get_custom_field_value($from_task, $field['id'], 'tasks');
            if ($value != '') {
                $this->db->insert('tblcustomfieldsvalues', array(
                    'relid' => $to_task,
                    'fieldid' => $field['id'],
                    'fieldto' => 'tasks',
                    'value' => $value
                    ));
            }
        }
    }
    public function get_billable_tasks()
    {
        $this->db->where('billable', 1);
        $this->db->where('billed', 0);
        $this->db->where('(rel_type != "project" OR rel_type IS NULL)');
        $tasks = $this->db->get('tblstafftasks')->result_array();

        return $tasks;
    }
    public function get_billable_task_data($task_id)
    {
        $this->db->where('id', $task_id);
        $data              = $this->db->get('tblstafftasks')->row();
        $data->total_hours = sec2qty($this->calc_task_total_time($task_id));
        return $data;
    }

    public function get_tasks_by_staff_id($id, $where = array())
    {
        $this->db->where($where);
        $this->db->where('(id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid=' . $id . '))');
        return $this->db->get('tblstafftasks')->result_array();
    }
    /**
     * Add new staff task
     * @param array $data task $_POST data
     * @return mixed
     */
    public function add($data)
    {
        $data['startdate']   = to_sql_date($data['startdate']);
        $data['duedate']     = to_sql_date($data['duedate']);
        $data['dateadded']   = date('Y-m-d H:i:s');
        $data['addedfrom']   = get_staff_user_id();
        $data['description'] = nl2br($data['description']);
        unset($data['task_rel_id']);
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }
        if (isset($data['is_public'])) {
            $data['is_public'] = 1;
        } else {
            $data['is_public'] = 0;
        }

        if (is_client_logged_in()) {
            $data['visible_to_client'] = 1;
        } else {
            if (isset($data['visible_to_client'])) {
                $data['visible_to_client'] = 1;
            } else {
                $data['visible_to_client'] = 0;
            }
        }

        if (isset($data['billable'])) {
            $data['billable'] = 1;
        } else {
            $data['billable'] = 0;
        }

        if ((!isset($data['milestone']) || $data['milestone'] == '') || (isset($data['milestone']) && $data['milestone'] == '')) {
            $data['milestone'] = 0;
        } else {
            if ($data['rel_type'] != 'project') {
                $data['milestone'] = 0;
            }
        }
        if (empty($data['rel_type'])) {
            unset($data['rel_type']);
            unset($data['rel_id']);
        } else {
            if (empty($data['rel_id'])) {
                unset($data['rel_type']);
                unset($data['rel_id']);
            }
        }
        $this->db->insert('tblstafftasks', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            if (isset($custom_fields)) {
                handle_custom_fields_post($insert_id, $custom_fields);
            }
            logActivity('New Task Added [ID:' . $insert_id . ', Name: ' . $data['name'] . ']');
            return $insert_id;
        }
        return false;
    }
    /**
     * Update task data
     * @param  array $data task data $_POST
     * @param  mixed $id   task id
     * @return boolean
     */
    public function update($data, $id)
    {
        $affectedRows        = 0;
        $data['startdate']   = to_sql_date($data['startdate']);
        $data['duedate']     = to_sql_date($data['duedate']);

        if(isset($data['datefinished'])){
            $data['datefinished'] = to_sql_date($data['datefinished'],true);
        }
        $data['description'] = nl2br($data['description']);
        unset($data['task_rel_id']);
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }
        if (isset($data['is_public'])) {
            $data['is_public'] = 1;
        } else {
            $data['is_public'] = 0;
        }
        if (isset($data['billable'])) {
            $data['billable'] = 1;
        } else {
            $data['billable'] = 0;
        }

        if ((!isset($data['milestone']) || $data['milestone'] == '') || (isset($data['milestone']) && $data['milestone'] == '')) {
            $data['milestone'] = 0;
        } else {
            if ($data['rel_type'] != 'project') {
                $data['milestone'] = 0;
            }
        }


        if (isset($data['visible_to_client'])) {
            $data['visible_to_client'] = 1;
        } else {
            $data['visible_to_client'] = 0;
        }
        if (empty($data['rel_type'])) {
            $data['rel_id']   = NULL;
            $data['rel_type'] = '';
        } else {
            if (empty($data['rel_id'])) {
                $data['rel_id']   = NULL;
                $data['rel_type'] = '';
            }
        }

        $this->db->where('id', $id);
        $this->db->update('tblstafftasks', $data);
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
            logActivity('Task Updated [ID:' . $id . ', Name: ' . $data['name'] . ']');
        }
        if ($affectedRows > 0) {
            return true;
        }
        return false;
    }
    public function get_checklist_item($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('tbltaskchecklists')->row();
    }
    public function get_checklist_items($taskid)
    {
        $this->db->where('taskid', $taskid);
        $this->db->order_by('list_order', 'asc');
        return $this->db->get('tbltaskchecklists')->result_array();
    }
    /**
     * Add task new blank check list item
     * @param mixed $data $_POST data with taxid
     */
    public function add_checklist_item($data)
    {
        $this->db->insert('tbltaskchecklists', array(
            'taskid' => $data['taskid'],
            'description' => '',
            'dateadded' => date('Y-m-d H:i:s'),
            'addedfrom' => get_staff_user_id()
        ));
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            return true;
        }
        return false;
    }
    public function delete_checklist_item($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbltaskchecklists');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }
    public function update_checklist_order($data)
    {
        foreach ($data['order'] as $order) {
            $this->db->where('id', $order[0]);
            $this->db->update('tbltaskchecklists', array(
                'list_order' => $order[1]
            ));
        }
    }
    /**
     * Update checklist item
     * @param  mixed $id          check list id
     * @param  mixed $description checklist description
     * @return void
     */
    public function update_checklist_item($id, $description)
    {
        $this->db->where('id', $id);
        $this->db->update('tbltaskchecklists', array(
            'description' => nl2br($description)
        ));
    }
    /**
     * Make task public
     * @param  mixed $task_id task id
     * @return boolean
     */
    public function make_public($task_id)
    {
        $this->db->where('id', $task_id);
        $this->db->update('tblstafftasks', array(
            'is_public' => 1
        ));
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }
    /**
     * Get task creator id
     * @param  mixed $taskid task id
     * @return mixed
     */
    public function get_task_creator_id($taskid)
    {
        return $this->get($taskid)->addedfrom;
    }
    /**
     * Add new task comment
     * @param array $data comment $_POST data
     * @return boolean
     */
    public function add_task_comment($data)
    {
        if ($data['content'] == '') {
            return false;
        }

        if (is_client_logged_in()) {
            $data['staffid']    = 0;
            $data['contact_id'] = get_contact_user_id();

        } else {
            $data['staffid']    = get_staff_user_id();
            $data['contact_id'] = 0;
        }

        if (isset($data['action'])) {
            unset($data['action']);
        }

        $data['dateadded'] = date('Y-m-d H:i:s');
        $data['content']   = $data['content'];
        if (is_client_logged_in()) {
            $data['content'] = _strip_tags($data['content']);
        }
        $this->db->insert('tblstafftaskcomments', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            $task        = $this->get($data['taskid']);
            $description = 'not_task_new_comment';
            $additional_data = serialize(array($task->name));
            if ($task->rel_type == 'project') {
                $this->projects_model->log_activity($task->rel_id, 'project_activity_new_task_comment', $task->name, $task->visible_to_client);
            }
            $this->_send_task_responsible_users_notification($description, $data['taskid'], false, 'task-commented',$additional_data);
            return true;
        }
        return false;
    }
    /**
     * Add task followers
     * @param array $data followers $_POST data
     * @return boolean
     */
    public function add_task_followers($data)
    {
        $this->db->insert('tblstafftasksfollowers', array(
            'taskid' => $data['taskid'],
            'staffid' => $data['follower']
        ));
        if ($this->db->affected_rows() > 0) {
            $task = $this->get($data['taskid']);
            if (get_staff_user_id() != $data['follower']) {
                add_notification(array(
                    'description' => 'not_task_added_you_as_follower',
                    'touserid' => $data['follower'],
                    'link' => 'tasks/list_tasks/' . $task->id,
                    'additional_data'=>serialize(array($task->name)),
                ));
                $member = $this->staff_model->get($data['follower']);

                $merge_fields = array();
                $merge_fields = array_merge($merge_fields, get_staff_merge_fields($data['follower']));
                $merge_fields = array_merge($merge_fields, get_task_merge_fields($task->id));
                $this->load->model('emails_model');
                $this->emails_model->send_email_template('task-added-as-follower', $member->email, $merge_fields);
            }
            $description = 'not_task_added_someone_as_follower';
            $additional_notification_data = serialize(array(
                get_staff_full_name($data['follower']),
                $task->name
            ));
            if ($data['follower'] == get_staff_user_id()) {
                $additional_notification_data = serialize(array($task->name));
                $description = 'not_task_added_himself_as_follower';
            }
            $this->_send_task_responsible_users_notification($description, $data['taskid'], $data['follower'],'',$additional_notification_data);
            return true;
        }
        return false;
    }
    /**
     * Assign task to staff
     * @param array $data task assignee $_POST data
     * @return boolean
     */
    public function add_task_assignees($data)
    {
        $this->db->insert('tblstafftaskassignees', array(
            'taskid' => $data['taskid'],
            'staffid' => $data['assignee'],
            'assigned_from'=>get_staff_user_id(),
        ));
        if ($this->db->affected_rows() > 0) {

            $task = $this->get($data['taskid']);
            if (get_staff_user_id() != $data['assignee']) {
                add_notification(array(
                    'description' => 'not_task_assigned_to_you',
                    'touserid' => $data['assignee'],
                    'link' => 'tasks/list_tasks/' . $task->id
                ));
                $member = $this->staff_model->get($data['assignee']);

                $merge_fields = array();
                $merge_fields = array_merge($merge_fields, get_staff_merge_fields($data['assignee']));
                $merge_fields = array_merge($merge_fields, get_task_merge_fields($task->id));
                $this->load->model('emails_model');
                $this->emails_model->send_email_template('task-assigned', $member->email, $merge_fields);
            }

            $description = 'not_task_assigned_someone';
            $additional_notification_data = serialize(array(get_staff_full_name($data['assignee']),$task->name));
            if ($data['assignee'] == get_staff_user_id()) {
                $description = 'not_task_will_do_user';
                $additional_notification_data = serialize(array($task->name));
            }

            if ($task->rel_type == 'project') {
                $this->projects_model->log_activity($task->rel_id, 'project_activity_new_task_assignee', $task->name . ' - ' . get_staff_full_name($data['assignee']), $task->visible_to_client);
            }

            $this->_send_task_responsible_users_notification($description, $data['taskid'], $data['assignee'],'',$additional_notification_data);
            return true;
        }
        return false;
    }
    /**
     * Get all task attachments
     * @param  mixed $taskid taskid
     * @return array
     */
    public function get_task_attachments($taskid)
    {
        $this->db->where('taskid', $taskid);
        $this->db->order_by('dateadded', 'desc');
        return $this->db->get('tblstafftasksattachments')->result_array();
    }
    /**
     * Remove task attachment from server and database
     * @param  mixed $id attachmentid
     * @return boolean
     */
    public function remove_task_attachment($id)
    {
        // Get the attachment
        $this->db->where('id', $id);
        $attachment = $this->db->get('tblstafftasksattachments')->row();
        if (is_file(TASKS_ATTACHMENTS_FOLDER . $attachment->taskid . '/' . $attachment->file_name)) {
            $deleted = unlink(TASKS_ATTACHMENTS_FOLDER . $attachment->taskid . '/' . $attachment->file_name);
            if ($deleted) {
                $this->db->where('id', $id);
                $this->db->delete('tblstafftasksattachments');
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
            }
        }
        return false;
    }
    /**
     * Add uploaded attachments to database
     * @since  Version 1.0.1
     * @param mixed $taskid     task id
     * @param array $attachment attachment data
     */
    public function add_attachment_to_database($taskid, $attachment)
    {
        $data = array(
            'file_name' => $attachment[0]['filename'],
            'dateadded' => date('Y-m-d H:i:s'),
            'taskid' => $taskid,
            'filetype' => $attachment[0]['filetype']
        );

        if (is_client_logged_in()) {
            $data['contact_id'] = get_contact_user_id();
            $data['staffid']    = 0;
        } else {
            $data['staffid']    = get_staff_user_id();
            $data['contact_id'] = 0;
        }

        $this->db->insert('tblstafftasksattachments', $data);
        if ($this->db->affected_rows() > 0) {
            $task = $this->get($taskid);
            if ($task->rel_type == 'project') {
                $this->projects_model->log_activity($task->rel_id, 'project_activity_new_task_attachment', $task->name, $task->visible_to_client);
            }
            $description = 'not_task_new_attachment';
            $this->_send_task_responsible_users_notification($description, $taskid, false, 'task-added-attachment');
            return true;
        }
        return false;
    }
    /**
     * Get all task followers
     * @param  mixed $id task id
     * @return array
     */
    public function get_task_followers($id)
    {
        $this->db->select('id,tblstafftasksfollowers.staffid as followerid');
        $this->db->from('tblstafftasksfollowers');
        $this->db->join('tblstaff', 'tblstaff.staffid = tblstafftasksfollowers.staffid', 'left');
        $this->db->where('taskid', $id);
        return $this->db->get()->result_array();
    }
    /**
     * Get all task assigneed
     * @param  mixed $id task id
     * @return array
     */
    public function get_task_assignees($id)
    {
        $this->db->select('id,tblstafftaskassignees.staffid as assigneeid,assigned_from');
        $this->db->from('tblstafftaskassignees');
        $this->db->join('tblstaff', 'tblstaff.staffid = tblstafftaskassignees.staffid', 'left');
        $this->db->where('taskid', $id);
        return $this->db->get()->result_array();
    }
    /**
     * Get task comment
     * @param  mixed $id task id
     * @return array
     */
    public function get_task_comments($id)
    {
        $this->db->select('id,dateadded,content,tblstaff.firstname,tblstaff.lastname,tblstafftaskcomments.staffid,tblstafftaskcomments.contact_id as contact_id');
        $this->db->from('tblstafftaskcomments');
        $this->db->join('tblstaff', 'tblstaff.staffid = tblstafftaskcomments.staffid', 'left');
        $this->db->where('taskid', $id);
        $this->db->order_by('dateadded', 'asc');
        return $this->db->get()->result_array();
    }
    public function edit_comment($data)
    {
        // Check if user really creator
        $this->db->where('id', $data['id']);
        $comment = $this->db->get('tblstafftaskcomments')->row();
        if ($comment->staffid == get_staff_user_id() || has_permission('tasks','','edit') || $comment->contact_id == get_contact_user_id()) {
            $comment_added = strtotime($comment->dateadded);
            $minus_1_hour  = strtotime('-1 hours');
            if (get_option('client_staff_add_edit_delete_task_comments_first_hour') == 0 || (get_option('client_staff_add_edit_delete_task_comments_first_hour') == 1 && $comment_added >= $minus_1_hour) || is_admin()) {
                $this->db->where('id', $data['id']);
                $this->db->update('tblstafftaskcomments', array(
                    'content' => $data['content']
                ));
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
            } else {
                return false;
            }
            return false;
        }
    }
    /**
     * Remove task comment from database
     * @param  mixed $id task id
     * @return boolean
     */
    public function remove_comment($id)
    {
        // Check if user really creator
        $this->db->where('id', $id);
        $comment = $this->db->get('tblstafftaskcomments')->row();
        if ($comment->staffid == get_staff_user_id() || has_permission('tasks','','delete') || $comment->contact_id == get_contact_user_id()) {
            $comment_added = strtotime($comment->dateadded);
            $minus_1_hour  = strtotime('-1 hours');
            if (get_option('client_staff_add_edit_delete_task_comments_first_hour') == 0 || (get_option('client_staff_add_edit_delete_task_comments_first_hour') == 1 && $comment_added >= $minus_1_hour) || is_admin()) {
                $this->db->where('id', $id);
                $this->db->delete('tblstafftaskcomments');
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
            } else {
                return false;
            }
        }
        return false;
    }
    /**
     * Remove task assignee from database
     * @param  mixed $id     assignee id
     * @param  mixed $taskid task id
     * @return boolean
     */
    public function remove_assignee($id, $taskid)
    {
        $task = $this->get($taskid);
        $this->db->where('id', $id);
        $assignee_data = $this->db->get('tblstafftaskassignees')->row();
        // Check if user has timer started
        $this->db->where('task_id', $taskid);
        $this->db->where('staff_id', $assignee_data->staffid);
        $timers = $this->db->get('tbltaskstimers')->result_array();
        foreach ($timers as $timer) {
            if ($timer['end_time'] == NULL) {
                $this->db->where('id', $timer['id']);
                $this->db->update('tbltaskstimers', array(
                    'end_time' => time()
                ));
            }
        }
        $this->db->where('id', $id);
        $this->db->delete('tblstafftaskassignees');
        if ($this->db->affected_rows() > 0) {
            if ($task->rel_type == 'project') {
                $this->projects_model->log_activity($task->rel_id, 'project_activity_task_assignee_removed', $task->name . ' - ' . get_staff_full_name($assignee_data->staffid), $task->visible_to_client);
            }
            return true;
        }
        return false;
    }
    /**
     * Remove task follower from database
     * @param  mixed $id     followerid
     * @param  mixed $taskid task id
     * @return boolean
     */
    public function remove_follower($id, $taskid)
    {
        $this->db->where('id', $taskid);
        $task = $this->db->get('tblstafftasks')->row();
        $this->db->where('id', $id);
        $this->db->delete('tblstafftasksfollowers');
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }
    /**
     * Mark task as complete
     * @param  mixed $id task id
     * @return boolean
     */
    public function mark_complete($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tblstafftasks', array(
            'datefinished' => date('Y-m-d H:i:s'),
            'finished' => 1
        ));
        if ($this->db->affected_rows() > 0) {
            $task        = $this->get($id);
            $description = _l('not_task_marked_as_complete', substr($task->name, 0, 50));

            $this->db->where('end_time IS NULL');
            $this->db->where('task_id', $id);
            $this->db->update('tbltaskstimers', array(
                'end_time' => time()
            ));

            if ($task->rel_type == 'project') {
                $this->projects_model->log_activity($task->rel_id, 'project_activity_task_marked_complete', $task->name, $task->visible_to_client);
            }
            $this->_send_task_responsible_users_notification($description, $id, false, 'task-marked-as-finished');
            return true;
        }
        return false;
    }
    /**
     * Unmark task as complete
     * @param  mixed $id task id
     * @return boolean
     */
    public function unmark_complete($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tblstafftasks', array(
            'datefinished' => NULL,
            'finished' => 0
        ));
        if ($this->db->affected_rows() > 0) {
            $task = $this->get($id);
            if ($task->rel_type == 'project') {
                $this->projects_model->log_activity($task->rel_id, 'project_activity_task_unmarked_complete', $task->name, $task->visible_to_client);
            }
            $description = _l('not_task_unmarked_as_complete', substr($task->name, 0, 50));
            $this->_send_task_responsible_users_notification($description, $id, false, 'task-unmarked-as-finished');
            return true;
        }
        return false;
    }
    /**
     * Delete task and all connections
     * @param  mixed $id taskid
     * @return boolean
     */
    public function delete_task($id)
    {
        $task = $this->get($id);
        $this->db->where('id', $id);
        $this->db->delete('tblstafftasks');
        if ($this->db->affected_rows() > 0) {

            // Log activity only if task is deleted indivudual not when deleting all projects
            if ($task->rel_type == 'project') {
                $this->projects_model->log_activity($task->rel_id, 'project_activity_task_deleted', $task->name, $task->visible_to_client);
            }

            $this->db->where('taskid', $id);
            $this->db->delete('tblstafftasksfollowers');

            $this->db->where('taskid', $id);
            $this->db->delete('tblstafftaskassignees');

            $this->db->where('taskid', $id);
            $this->db->delete('tblstafftaskcomments');

            $this->db->where('taskid', $id);
            $this->db->delete('tbltaskchecklists');
            // Delete the custom field values
            $this->db->where('relid', $id);
            $this->db->where('fieldto', 'tasks');
            $this->db->delete('tblcustomfieldsvalues');

            $this->db->where('task_id', $id);
            $this->db->delete('tbltaskstimers');

            $this->db->where('taskid', $id);
            $this->db->delete('tblstafftasksattachments');

            $this->db->where('rel_id',$id);
            $this->db->where('rel_type','task');
            $this->db->delete('tblitemsrelated');

            if (is_dir(TASKS_ATTACHMENTS_FOLDER . $id)) {
                delete_dir(TASKS_ATTACHMENTS_FOLDER . $id);
            }
            return true;
        }
        return false;
    }
    /**
     * Send notification on task activity to creator,follower/s,assignee/s
     * @param  string  $description notification description
     * @param  mixed  $taskid      task id
     * @param  boolean $excludeid   excluded staff id to not send the notifications
     * @return boolean
     */
    private function _send_task_responsible_users_notification($description, $taskid, $excludeid = false, $email_template = '',$additional_notification_data = '')
    {
        $this->load->model('staff_model');
        $staff = $this->staff_model->get('', 1);
        foreach ($staff as $member) {
            if (is_numeric($excludeid)) {
                if ($excludeid == $member['staffid']) {
                    continue;
                }
            }
            if (!is_client_logged_in()) {
                if ($member['staffid'] == get_staff_user_id()) {
                    continue;
                }
            }
            if ($this->is_task_follower($member['staffid'], $taskid) || $this->is_task_assignee($member['staffid'], $taskid) || $this->is_task_creator($member['staffid'], $taskid)) {
                add_notification(array(
                    'description' => $description,
                    'touserid' => $member['staffid'],
                    'link' => 'tasks/list_tasks/' . $taskid,
                    'additional_data'=>$additional_notification_data
                ));
                if ($email_template != '') {
                    $merge_fields = array();
                    $merge_fields = array_merge($merge_fields, get_staff_merge_fields($member['staffid']));
                    $merge_fields = array_merge($merge_fields, get_task_merge_fields($taskid));
                    $this->load->model('emails_model');
                    $this->emails_model->send_email_template($email_template, $member['email'], $merge_fields);
                }
            }
        }
    }
    /**
     * Check is user is task follower
     * @param  mixed  $userid staff id
     * @param  mixed  $taskid taskid
     * @return boolean
     */
    public function is_task_follower($userid, $taskid)
    {
        if (total_rows('tblstafftasksfollowers', array(
            'staffid' => $userid,
            'taskid' => $taskid
        )) == 0) {
            return false;
        }
        return true;
    }
    /**
     * Check is user is task assignee
     * @param  mixed  $userid staff id
     * @param  mixed  $taskid taskid
     * @return boolean
     */
    public function is_task_assignee($userid, $taskid)
    {
        if (total_rows('tblstafftaskassignees', array(
            'staffid' => $userid,
            'taskid' => $taskid
        )) == 0) {
            return false;
        }
        return true;
    }
    /**
     * Check is user is task creator
     * @param  mixed  $userid staff id
     * @param  mixed  $taskid taskid
     * @return boolean
     */
    public function is_task_creator($userid, $taskid)
    {
        if (total_rows('tblstafftasks', array(
            'addedfrom' => $userid,
            'id' => $taskid
        )) == 0) {
            return false;
        }
        return true;
    }
    public function timer_tracking($task_id = '', $timer_id = '')
    {
        if ($task_id == '' && $timer_id == '') {
            return false;
        }
        if (!$this->is_task_assignee(get_staff_user_id(), $task_id)) {
            return false;
        } else if ($this->is_task_billed($task_id)) {
            return false;
        }

        $timer = $this->get_task_timer(array(
            'id' => $timer_id
        ));

        if (total_rows('tbltaskstimers', array(
            'staff_id' => get_staff_user_id(),
            'task_id' => $task_id
        )) == 0 || $timer == null) {
            $this->db->insert('tbltaskstimers', array(
                'start_time' => time(),
                'staff_id' => get_staff_user_id(),
                'task_id' => $task_id
            ));
        $_new_timer_id = $this->db->insert_id();
        if(get_option('auto_stop_tasks_timers_on_new_timer') == 1){
            $this->db->where('id !=',$_new_timer_id);
            $this->db->where('end_time IS NULL');
            $this->db->where('staff_id',get_staff_user_id());
            $this->db->update('tbltaskstimers',array('end_time'=>time()));
        }
        return true;
        } else {
            if ($timer) {
                // time already ended
                if ($timer->end_time != NULL) {
                    return false;
                }
                $this->db->where('id', $timer_id);
                $this->db->update('tbltaskstimers', array(
                    'end_time' => time()
                ));
            }
            return true;
        }
    }
    public function timesheet($data){

        $start_time = to_sql_date($data['start_time'],true);
        $end_time = to_sql_date($data['end_time'],true);
        $start_time = strtotime(date('Y-m-d H:i:s',strtotime($start_time)));
        $end_time = strtotime(date('Y-m-d H:i:s',strtotime($end_time)));

         if ($end_time < $start_time) {
            return array(
                'end_time_smaller' => true
            );
        }
        $timesheet_staff_id = get_staff_user_id();
        if(isset($data['timesheet_staff_id']) && $data['timesheet_staff_id'] != ''){
            $timesheet_staff_id = $data['timesheet_staff_id'];
        }
        if (!isset($data['timer_id']) || (isset($data['timer_id']) && $data['timer_id'] == '')) {
        $this->db->insert('tbltaskstimers', array(
            'start_time' => $start_time,
            'end_time' => $end_time,
            'staff_id' => $timesheet_staff_id,
            'task_id' => $data['timesheet_task_id'],
            ));

        $insert_id = $this->db->insert_id();
        if($insert_id){
             $task       = $this->get($data['timesheet_task_id']);
             if($task->rel_type == 'project'){
                 $total      = $end_time - $start_time;
                 $additional = '<seconds>' . $total . '</seconds>';
                 $additional .= '<br />';
                 $additional .= '<lang>project_activity_task_name</lang> ' . $task->name;
                 $this->projects_model->log_activity($task->rel_id, 'project_activity_recorded_timesheet', $additional,$task->visible_to_client);
             }
             return true;
         } else {
            return false;
         }
     } else {
          $this->db->where('id', $data['timer_id']);
            $this->db->update('tbltaskstimers', array(
                'start_time' => $start_time,
                'end_time' => $end_time,
                'staff_id' => $timesheet_staff_id,
                'task_id' => $data['timesheet_task_id'],
            ));
            if ($this->db->affected_rows() > 0) {
                return true;
            }
            return false;
     }
    }
    public function get_task_timer($where)
    {
        $this->db->where($where);
        return $this->db->get('tbltaskstimers')->row();
    }
    public function is_timer_started($task_id, $staff_id = '')
    {
        if ($staff_id == '') {
            $staff_id = get_staff_user_id();
        }
        $timer = $this->get_last_timer($task_id, $staff_id);
        if (!$timer) {
            return false;
        }
        if ($timer->end_time != NULL) {
            return false;
        }
        return true;
    }
    public function is_timer_started_for_task($id)
    {

        $this->db->where('task_id', $id);
        $this->db->where('end_time IS NULL');
        $row = $this->db->get('tbltaskstimers')->row();
        if ($row) {
            return true;
        }

        return false;
    }
    public function get_last_timer($task_id, $staff_id = '')
    {
        if ($staff_id == '') {
            $staff_id = get_staff_user_id();
        }
        $this->db->where('staff_id', $staff_id);
        $this->db->where('task_id', $task_id);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $a = $this->db->get('tbltaskstimers')->row();
        return $a;
    }
    public function task_tracking_stats($id)
    {
        $assignees  = $this->get_task_assignees($id);
        $labels     = array();
        $labels_ids = array();
        foreach ($assignees as $assignee) {
            array_push($labels, get_staff_full_name($assignee['assigneeid']));
            array_push($labels_ids, $assignee['assigneeid']);
        }
        $chart = array(
            'labels' => $labels,
            'datasets' => array(
                array(
                    'label' => _l('task_stats_logged_hours'),
                    'data' => array()
                )
            )
        );
        $i     = 0;
        foreach ($labels_ids as $staffid) {
            $chart['datasets'][0]['data'][$i] = sec2qty($this->calc_task_total_time($id, ' AND staff_id=' . $staffid));
            $i++;
        }
        return $chart;
    }
    public function get_timesheeets($task_id){
        return $this->db->query("SELECT id,start_time,end_time,task_id,staff_id,
        end_time - start_time time_spent FROM tbltaskstimers WHERE task_id = '$task_id' ORDER BY start_time DESC")->result_array();
    }
    public function get_time_spent($seconds)
    {
        $minutes = $seconds / 60;
        $hours   = $minutes / 60;
        if ($minutes >= 60) {
            return round($hours, 2);
        } elseif ($seconds > 60) {
            return round($minutes, 2);
        } else {
            return $seconds;
        }
    }
    public function calc_task_total_time($task_id, $where = '')
    {
        $sql    = "SELECT start_time,end_time
        FROM tbltaskstimers WHERE task_id =" . $task_id . $where;
        $timers = $this->db->query($sql)->result();

        $total = array();
        foreach ($timers as $key => $timer) {
            $_tspent = 0;
            if(is_null($timer->end_time)){
                $_tspent = time() - $timer->start_time;
            } else {
                $_tspent = $timer->end_time - $timer->start_time;
            }
            $total[] = $_tspent;
        }
        return array_sum($total);
    }
    public function delete_timesheet($id)
    {
        $this->db->where('id', $id);
        $timesheet = $this->db->get('tbltaskstimers')->row();
        $this->db->where('id', $id);
        $this->db->delete('tbltaskstimers');
        if ($this->db->affected_rows() > 0) {
            $task = $this->get($timesheet->task_id);

            if ($task->rel_type == 'project') {
                $additional_data = $task->name;
                $total           = $timesheet->end_time - $timesheet->start_time;
                $additional_data .= '<br /><seconds>' . $total . '</seconds>';
                $this->projects_model->log_activity($task->rel_id, 'project_activity_task_timesheet_deleted', $additional_data, $task->visible_to_client);
            }

            logActivity('Timesheet Deleted [' . $id . ']');
            return true;
        }
        return false;
    }
}
