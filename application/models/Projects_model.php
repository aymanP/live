<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Projects_model extends CRM_Model
{
    private $project_settings;
    private $project_statuses = array(1,2,3,4);
    function __construct()
    {
        parent::__construct();
        $this->load->model('tasks_model');
        $project_settings       = array(
            'view_tasks',
            'comment_on_tasks',
            'view_task_comments',
            'view_task_attachments',
            'view_task_checklist_items',
            'upload_on_tasks',
            'view_task_total_logged_time',
            'view_finance_overview',
            'upload_files',
            'open_discussions',
            'view_milestones',
            'view_gantt',
            'view_timesheets',
            'view_activity_log',
            'view_team_members',
        );
        $this->project_settings = do_action('project_settings', $project_settings);
    }
    public function get_project_statuses(){
        return $this->project_statuses;
    }
    public function timers_started_for_project($project_id, $where = array(), $task_timers_where = array())
    {
        $tasks              = $this->get_tasks($project_id, $where);
        $timers_found       = false;
        $_task_timers_where = array();
        foreach ($task_timers_where as $key => $val) {
            $_task_timers_where[$key] = $val;
        }
        foreach ($tasks as $task) {
            $_task_timers_where['task_id'] = $task['id'];
            if (total_rows('tbltaskstimers', $_task_timers_where) > 0) {
                $timers_found = true;
                break;
            }
        }
        return $timers_found;
    }
    public function pin_action($id){
        if(total_rows('tblpinnedprojects',array('staff_id'=>get_staff_user_id(),'project_id'=>$id)) == 0){
            $this->db->insert('tblpinnedprojects',array(
                'staff_id'=>get_staff_user_id(),
                'project_id'=>$id,
                ));
            return true;
        } else {
            $this->db->where('project_id',$id);
            $this->db->where('staff_id',get_staff_user_id());
            $this->db->delete('tblpinnedprojects');
            return true;
        }
    }


    public function update_contacts($project_id, $contact_ids)
    {
        $this->db->where('project_id' ,$project_id )->delete('tblcontactprojects');
        foreach($contact_ids as $key => $value){
            $this->db->insert('tblcontactprojects', array( 'project_id' => $project_id, 'contact_id' => $value));
        }
    }

    public function get_project_contacts($project_id)
    {
        $query = $this->db->select('contact_id')
                      ->where('project_id', $project_id)
                      ->get('tblcontactprojects')
                      ->result_array();
        return array_map( function( $data ) { return $data['contact_id']; }, $query );
    }


    public function get_currency($id)
    {
        $project = $this->get($id);
        $this->load->model('currencies_model');
        $customer_currency = $this->clients_model->get_customer_default_currency($project->clientid);
        if ($customer_currency != 0) {
            $currency = $this->currencies_model->get($customer_currency);
        } else {
            $currency = $this->currencies_model->get_base_currency();
        }
        return $currency;
    }
    public function calc_progress($id)
    {
        $project = $this->get($id);
        if ($project->status == 4) {
            return 100;
        }
        if($project->progress_from_tasks == 1){
            return $this->calc_progress_by_tasks($id);
        } else {
            return $project->progress;
        }
    }
    public function calc_progress_by_tasks($id){
      $project = $this->get($id);
      $total_project_tasks  = total_rows('tblstafftasks', array(
        'rel_type' => 'project',
        'rel_id' => $id
        ));
      $total_finished_tasks = total_rows('tblstafftasks', array(
        'rel_type' => 'project',
        'rel_id' => $id,
        'finished' => 1
        ));
      $percent              = 0;
      if ($total_finished_tasks >= floatval($total_project_tasks)) {
        $percent = 100;
    } else {
        if ($total_project_tasks !== 0) {
            $percent = number_format(($total_finished_tasks * 100) / $total_project_tasks, 2);
        }
    }
    return $percent;
}
    public function get_last_project_settings()
    {
        $this->db->select('id');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $last_project = $this->db->get('tblprojects')->row();
        if ($last_project) {
            return $this->get_project_settings($last_project->id);
        }
        return array();
    }
    public function get_settings()
    {
        return $this->project_settings;
    }


    public function get_client_projects($contact_id, $where)
    {
        $this->db->where($where)
                 ->where('`id` in', '(select `project_id` from `tblcontactprojects` where `contact_id` = '.$contact_id.')', false);
        return $this->db->get('tblprojects')->result_array();
    }
    public function get($id = '', $where = array())
    {
        $this->db->where($where);
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            $project = $this->db->get('tblprojects')->row();
            if ($project) {
                $settings          = $this->get_project_settings($id);
                $project->settings = new StdClass();
                foreach ($settings as $setting) {
                    $project->settings->{$setting['name']} = $setting['value'];
                }
                $project->client_data = new StdClass();
                $project->client_data = $this->clients_model->get($project->clientid);
                return $project;
            }
            return null;
        }
        return $this->db->get('tblprojects')->result_array();
    }
    public function calculate_total_by_project_hourly_rate($seconds, $hourly_rate)
    {
        $hours       = sec2qty($seconds);
        $total_money = 0;
        $total_money += ($hours * $hourly_rate);
        return array(
            'hours' => $hours,
            'total_money' => $total_money
        );
    }
    public function calculate_total_by_task_hourly_rate($tasks)
    {
        $total_money    = 0;
        $_total_seconds = 0;
        foreach ($tasks as $task) {
            $seconds = $this->tasks_model->calc_task_total_time($task['id']);
            $_total_seconds += $seconds;
            $total_money += sec2qty($seconds) * $task['hourly_rate'];
        }
        return array(
            'total_money' => $total_money,
            'total_seconds' => $_total_seconds
        );
    }
    public function get_tasks($id, $where = array(),$apply_restrictions = false)
    {
        if (is_client_logged_in()) {
            $this->db->where('visible_to_client', 1);
        }
        $this->db->where('rel_id', $id);
        $this->db->where('rel_type', 'project');
        $this->db->order_by('duedate', 'desc');
        $this->db->order_by('finished', 'asc');
        $this->db->where($where);
        $tasks = $this->db->get('tblstafftasks')->result_array();
        if($apply_restrictions == true){
            $has_permission = has_permission('tasks','','view');
            $i = 0;
            foreach($tasks as $task){
                if(!is_client_logged_in() && !$has_permission){
                    if(get_option('show_all_tasks_for_project_member') == 0){
                        if(!$this->tasks_model->is_task_assignee(get_staff_user_id(),$task['id']) && !$this->tasks_model->is_task_follower(get_staff_user_id(),$task['id']) && $task['is_public'] != 1 && $task['addedfrom'] != get_staff_user_id()){
                            unset($tasks[$i]);
                        }
                        }
                    }
                    $i++;
                }
            }

        $tasks = array_values($tasks);
        return $tasks;
    }
    public function get_files($project_id)
    {
        if (is_client_logged_in()) {
            $this->db->where('visible_to_customer', 1);
        }
        $this->db->where('project_id', $project_id);
        return $this->db->get('tblprojectfiles')->result_array();
    }
    public function change_file_visibility($id, $visible)
    {
        $this->db->where('id', $id);
        $this->db->update('tblprojectfiles', array(
            'visible_to_customer' => $visible
        ));
    }
    public function change_activity_visibility($id, $visible)
    {
        $this->db->where('id', $id);
        $this->db->update('tblprojectactivity', array(
            'visible_to_customer' => $visible
        ));
    }
    public function add_edit_contacts($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('tblprojects', array(
            'contactid' => $data
        ));
    }
    public function remove_file($id)
    {
        $this->db->where('id', $id);
        $file = $this->db->get('tblprojectfiles')->row();
        if ($file) {
            if(file_exists(PROJECT_ATTACHMENTS_FOLDER . $file->project_id . '/' . $file->file_name)){
                if (unlink(PROJECT_ATTACHMENTS_FOLDER . $file->project_id . '/' . $file->file_name)) {
                    $this->db->where('id', $id);
                    $this->db->delete('tblprojectfiles');
                    $this->log_activity($file->project_id, 'project_activity_project_file_removed', $file->file_name, $file->visible_to_customer);
                }
            }
            if(is_dir(PROJECT_ATTACHMENTS_FOLDER . $file->project_id)){
                // Check if no attachments left, so we can delete the folder also
                $other_attachments = list_files(PROJECT_ATTACHMENTS_FOLDER . $file->project_id);
                if (count($other_attachments) == 0) {
                    delete_dir(PROJECT_ATTACHMENTS_FOLDER . $file->project_id);
                }
            }
            return true;
        }
        return false;
    }
    public function get_gantt_data($project_id)
    {
        $this->load->model('tasks_model');
        $milestones = array();
        $milestones[] = array(
            'name'=>_l('milestones_uncategorized'),
            'id'=>0,
            );
        $_milestones = $this->get_milestones($project_id);
        foreach($_milestones as $m){
            $milestones[] = $m;
        }
        $gantt_data = array();
        $has_permission = has_permission('tasks','','view');
          foreach($milestones as $milestone){
            $tasks      = $this->get_tasks($project_id,array('milestone'=>$milestone['id']),true);

            if(count($tasks) > 0){
                $data  = array();
                $data['values']        = array();
                $values = array();
                $data['desc'] = $tasks[0]['name'];
                $data['name']          = $milestone['name'];
                $class = '';
                if ($tasks[0]['finished'] == 1) {
                    $class = 'line-throught';
                }
                $values['from']        = "/Date(" . (strtotime($tasks[0]['startdate']) * 1000) . ")/";
                $values['to']          = "/Date(" . (strtotime($tasks[0]['duedate']) * 1000) . ")/";
                $values['desc']        = _l('task_total_logged_time') . ' ' . format_seconds($this->tasks_model->calc_task_total_time($tasks[0]['id']));
                $values['label']       = $tasks[0]['name'];
                if($tasks[0]['duedate'] && date('Y-m-d') > $tasks[0]['duedate'] && $tasks[0]['finished'] == 0){
                   $values['customClass']       = 'ganttRed';
                   } else if($tasks[0]['finished'] == 1){
                    $values['label']       = ' <i class="fa fa-check"></i> '. $values['label'];
                    $values['customClass']       = 'ganttGreen';
                }
                $values['dataObj'] = array('task_id'=>$tasks[0]['id']);
                $data['values'][]      = $values;
                $gantt_data[]          = $data;
                unset($tasks[0]);
                foreach ($tasks as $task) {
                    $data  = array();
                    $data['values']        = array();
                    $values = array();
                    $class = '';
                    if ($task['finished'] == 1) {
                        $class = 'line-throught';
                    }
                    $data['desc'] = $task['name'];
                    $data['name'] = '';
                    $values['from']        = "/Date(" . (strtotime($task['startdate']) * 1000) . ")/";
                    $values['to']          = "/Date(" . (strtotime($task['duedate']) * 1000) . ")/";
                    $values['desc']        = _l('task_total_logged_time') . ' ' . format_seconds($this->tasks_model->calc_task_total_time($task['id']));
                    $values['label']       = $task['name'];
                    if($task['duedate'] && date('Y-m-d') > $task['duedate'] && $task['finished'] == 0){
                         $values['customClass']       = 'ganttRed';
                    } else if($task['finished'] == 1){
                        $values['label']       = ' <i class="fa fa-check"></i> '. $values['label'];
                        $values['customClass']       = 'ganttGreen';
                    }

                    $values['dataObj'] = array('task_id'=>$task['id']);
                    $data['values'][]      = $values;
                    $gantt_data[]          = $data;
                }
            }
        }
        return $gantt_data;
    }
    public function calc_milestone_logged_time($project_id, $id)
    {
        $total = array();
        $tasks = $this->get_tasks($project_id, array(
            'milestone' => $id
        ));
        foreach ($tasks as $task) {
            $total[] = $this->tasks_model->calc_task_total_time($task['id']);
        }
        return array_sum($total);
    }
    public function total_logged_time($id)
    {
        $tasks = $this->get_tasks($id);
        $total = array();
        foreach ($tasks as $task) {
            $total[] = $this->tasks_model->calc_task_total_time($task['id']);
        }
        return array_sum($total);
    }
    public function get_milestones($project_id)
    {
        $this->db->where('project_id', $project_id);
        $this->db->order_by('milestone_order', 'ASC');
        $milestones = $this->db->get('tblmilestones')->result_array();
        $i          = 0;
        foreach ($milestones as $milestone) {
            $milestones[$i]['total_logged_time'] = $this->calc_milestone_logged_time($project_id, $milestone['id']);
            $i++;
        }
        return $milestones;
    }
    public function add_milestone($data)
    {
        $data['due_date']    = to_sql_date($data['due_date']);
        $data['datecreated'] = date('Y-m-d');
        $this->db->insert('tblmilestones', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            $this->db->where('id', $insert_id);
            $milestone = $this->db->get('tblmilestones')->row();
            $project   = $this->get($milestone->project_id);
            if ($project->settings->view_milestones == 1) {
                $show_to_customer = 1;
            } else {
                $show_to_customer = 0;
            }
            $this->log_activity($milestone->project_id, 'project_activity_created_milestone', $milestone->name, $show_to_customer);
            logActivity('Project Milestone Created [ID:' . $insert_id . ']');
            return $insert_id;
        }
        return false;
    }
    public function update_milestone($data, $id)
    {
        $this->db->where('id', $id);
        $milestone        = $this->db->get('tblmilestones')->row();
        $data['due_date'] = to_sql_date($data['due_date']);
        $this->db->where('id', $id);
        $this->db->update('tblmilestones', $data);
        if ($this->db->affected_rows() > 0) {
            $project = $this->get($milestone->project_id);
            if ($project->settings->view_milestones == 1) {
                $show_to_customer = 1;
            } else {
                $show_to_customer = 0;
            }
            $this->log_activity($milestone->project_id, 'project_activity_updated_milestone', $milestone->name, $show_to_customer);
            logActivity('Project Milestone Updated [ID:' . $id . ']');
            return true;
        }
        return false;
    }
    public function update_task_milestone($data){
        $this->db->where('id',$data['data']['task_id']);
        $this->db->update('tblstafftasks',array('milestone'=>$data['data']['milestone_id']));
    }
    public function update_milestone_color($data){
        $this->db->where('id',$data['milestone_id']);
        $this->db->update('tblmilestones',array('color'=>$data['color']));
    }
    public function delete_milestone($id)
    {
        $this->db->where('id', $id);
        $milestone = $this->db->get('tblmilestones')->row();
        $this->db->where('id', $id);
        $this->db->delete('tblmilestones');
        if ($this->db->affected_rows() > 0) {
            $project = $this->get($milestone->project_id);
            if ($project->settings->view_milestones == 1) {
                $show_to_customer = 1;
            } else {
                $show_to_customer = 0;
            }
            $this->log_activity($milestone->project_id, 'project_activity_deleted_milestone', $milestone->name, $show_to_customer);
            $this->db->where('milestone', $id);
            $this->db->update('tblstafftasks', array(
                'milestone' => 0
            ));
            logActivity('Project Milestone Deleted [' . $id . ']');
            return true;
        }
        return false;
    }
    public function add($data)
    {


        if (isset($data['settings'])) {
            $project_settings = $data['settings'];
            unset($data['settings']);
        }
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }
        if(isset($data['progress_from_tasks'])){
            $data['progress_from_tasks'] = 1;
        } else {
            $data['progress_from_tasks'] = 0;
        }
        $data['deadline']        = to_sql_date($data['deadline']);
        $data['start_date']      = to_sql_date($data['start_date']);
        $data['project_created'] = date('Y-m-d');
       // $data['contactid']  = 2;
        if (isset($data['project_members'])) {
            $project_members = $data['project_members'];
            unset($data['project_members']);
        }
        if ($data['billing_type'] == 1) {
            $data['project_rate_per_hour'] = 0;
        } else if ($data['billing_type'] == 2) {
            $data['project_cost'] = 0;
        } else {
            $data['project_rate_per_hour'] = 0;
            $data['project_cost']          = 0;
        }
        $data['addedfrom'] = get_staff_user_id();
        $this->db->insert('tblprojects', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            if (isset($custom_fields)) {
                handle_custom_fields_post($insert_id, $custom_fields);
            }
            if (isset($project_members)) {
                $_pm['project_members'] = $project_members;
                $this->add_edit_members($_pm, $insert_id);
            }
            $original_settings = $this->get_settings();
            if (isset($project_settings)) {
                $_settings = array();
                foreach ($project_settings as $name => $val) {
                    array_push($_settings, $name);
                }
                foreach ($original_settings as $setting) {
                    if (in_array($setting, $_settings)) {
                        $value_setting = 1;
                    } else {
                        $value_setting = 0;
                    }
                    $this->db->insert('tblprojectsettings', array(
                        'project_id' => $insert_id,
                        'name' => $setting,
                        'value' => $value_setting
                    ));
                }
            } else {
                foreach ($original_settings as $setting) {
                    $this->db->insert('tblprojectsettings', array(
                        'project_id' => $insert_id,
                        'name' => $setting,
                        'value' => 0
                    ));
                }
            }
            $this->log_activity($insert_id, 'project_activity_created');
            logActivity('New Project Created [ID: ' . $insert_id . ']');
            return $insert_id;
        }
        return false;
    }
    public function update($data, $id)
    {
        $original_project = $this->get($id);
        $affectedRows = 0;
        if (!isset($data['settings'])) {
            $this->db->where('project_id', $id);
            $this->db->update('tblprojectsettings', array(
                'value' => 0
            ));
            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }
        } else {
            $settings = array();
            foreach ($data['settings'] as $name => $val) {
                array_push($settings, $name);
            }
            unset($data['settings']);
            $original_settings = $this->get_project_settings($id);
            foreach ($original_settings as $setting) {
                if (in_array($setting['name'], $settings)) {
                    $value_setting = 1;
                } else {
                    $value_setting = 0;
                }
                $this->db->where('project_id', $id);
                $this->db->where('name', $setting['name']);
                $this->db->update('tblprojectsettings', array(
                    'value' => $value_setting
                ));
                if ($this->db->affected_rows() > 0) {
                    $affectedRows++;
                }
            }
        }

        if(isset($data['progress_from_tasks'])){
            $data['progress_from_tasks'] = 1;
        } else {
            $data['progress_from_tasks'] = 0;
        }

        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }
        $data['deadline']   = to_sql_date($data['deadline']);
        $data['start_date'] = to_sql_date($data['start_date']);
        if ($data['billing_type'] == 1) {
            $data['project_rate_per_hour'] = 0;
        } else if ($data['billing_type'] == 2) {
            $data['project_cost'] = 0;
        } else {
            $data['project_rate_per_hour'] = 0;
            $data['project_cost']          = 0;
        }
        if (isset($data['project_members'])) {
            $project_members = $data['project_members'];
            unset($data['project_members']);
        }
        $_pm = array();
        if (isset($project_members)) {
            $_pm['project_members'] = $project_members;
        }
        if ($this->add_edit_members($_pm, $id)) {
            $affectedRows++;
        }
        if (isset($data['mark_all_tasks_as_completed'])) {
            $mark_all_tasks_as_completed = true;
            unset($data['mark_all_tasks_as_completed']);
        }
        $this->db->where('id', $id);
        $this->db->update('tblprojects', $data);
        if ($this->db->affected_rows() > 0) {
            if (isset($mark_all_tasks_as_completed) && $data['status'] == 4) {
                $this->db->where('rel_type', 'project');
                $this->db->where('rel_id', $id);
                $this->db->update('tblstafftasks', array(
                    'finished' => 1,
                    'datefinished' => date('Y-m-d H:i:s')
                ));
                $tasks = $this->get_tasks($id);
                foreach ($tasks as $task) {
                    $this->db->where('task_id', $task['id']);
                    $this->db->where('end_time IS NULL');
                    $this->db->update('tbltaskstimers', array(
                        'end_time' => time()
                    ));
                }
                $this->log_activity($id, 'project_activity_marked_all_tasks_as_complete');
            }
            $affectedRows++;


        }
        if ($affectedRows > 0) {
            $this->log_activity($id, 'project_activity_updated');
            logActivity('Project Updated [ID: ' . $id . ']');

            if($original_project->status != $data['status']){
                // Give space this log to be on top
                sleep(1);
                if($data['status'] == 4){
                    $this->log_activity($id, 'project_marked_as_finished');
                } else {
                    $this->log_activity($id,'project_status_updated','<b><lang>project_status_'.$data['status'].'</lang></b>');
                }
            }

            return true;
        }
        return false;
    }
    public function add_edit_members($data, $id)
    {
        $affectedRows = 0;
        if (isset($data['project_members'])) {
            $project_members = $data['project_members'];
        }

        $new_project_members_to_receive_email = array();
        $this->db->select('name');
        $this->db->where('id',$id);
        $project_name = $this->db->get('tblprojects')->row()->name;

        $project_members_in = $this->get_project_members($id);
        if (sizeof($project_members_in) > 0) {
            foreach ($project_members_in as $project_member) {
                if (isset($project_members)) {
                    if (!in_array($project_member['staff_id'], $project_members)) {
                        $this->db->where('project_id', $id);
                        $this->db->where('staff_id', $project_member['staff_id']);
                        $this->db->delete('tblprojectmembers');
                        if ($this->db->affected_rows() > 0) {

                            $this->db->where('staff_id',$project_member['staff_id']);
                            $this->db->where('project_id',$id);
                            $this->db->delete('tblpinnedprojects');

                            $this->log_activity($id, 'project_activity_removed_team_member', get_staff_full_name($project_member['staff_id']));
                            $affectedRows++;
                        }
                    }
                } else {
                    $this->db->where('project_id', $id);
                    $this->db->delete('tblprojectmembers');
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
            if (isset($project_members)) {

                foreach ($project_members as $staff_id) {
                    $this->db->where('project_id', $id);
                    $this->db->where('staff_id', $staff_id);
                    $_exists = $this->db->get('tblprojectmembers')->row();
                    if (!$_exists) {
                        if (empty($staff_id)) {
                            continue;
                        }
                        $this->db->insert('tblprojectmembers', array(
                            'project_id' => $id,
                            'staff_id' => $staff_id
                        ));
                        if ($this->db->affected_rows() > 0) {
                            if($staff_id != get_staff_user_id()){
                                add_notification(array(
                                    'fromuserid' => get_staff_user_id(),
                                    'description' => 'not_staff_added_as_project_member',
                                    'link' => 'projects/view/' . $id ,
                                    'touserid' => $staff_id,
                                    'additional_data'=>serialize(array($project_name)),
                                    ));
                                array_push($new_project_members_to_receive_email,$staff_id);
                            }


                            $this->log_activity($id, 'project_activity_added_team_member', get_staff_full_name($staff_id));
                            $affectedRows++;
                        }
                    }
                }
            }
        } else {
            if (isset($project_members)) {
                foreach ($project_members as $staff_id) {
                    if (empty($staff_id)) {
                        continue;
                    }
                    $this->db->insert('tblprojectmembers', array(
                        'project_id' => $id,
                        'staff_id' => $staff_id
                    ));
                    if ($this->db->affected_rows() > 0) {
                        if($staff_id != get_staff_user_id()){
                     add_notification(array(
                        'fromuserid' => get_staff_user_id(),
                        'description' => 'not_staff_added_as_project_member',
                        'link' => 'projects/view/' . $id ,
                        'touserid' => $staff_id,
                        'additional_data'=>serialize(array($project_name)),
                        ));
                     array_push($new_project_members_to_receive_email,$staff_id);
                 }
                        $this->log_activity($id, 'project_activity_added_team_member', get_staff_full_name($staff_id));
                        $affectedRows++;
                    }
                }
            }
        }

        if(count($new_project_members_to_receive_email) > 0){
            $this->load->model('emails_model');
            $all_members = $this->get_project_members($id);
            foreach($all_members as $data){
                if(in_array($data['staff_id'],$new_project_members_to_receive_email)){
                    $merge_fields = array();
                    $merge_fields = array_merge($merge_fields, get_staff_merge_fields($data['staff_id']));
                    $merge_fields = array_merge($merge_fields, get_project_merge_fields($id));
                    $this->emails_model->send_email_template('staff-added-as-project-member',$data['email'],$merge_fields);
                }
            }
        }
        if ($affectedRows > 0) {
            return true;
        }
        return false;
    }
    public function is_member($project_id, $staff_id = '')
    {
        if (!is_numeric($staff_id)) {
            $staff_id = get_staff_user_id();
        }
        $member = total_rows('tblprojectmembers', array(
            'staff_id' => $staff_id,
            'project_id' => $project_id
        ));
        if ($member > 0) {
            return true;
        }
        return false;
    }
    public function get_projects_for_ticket($client_id){
          return $this->get('',array('clientid'=>$client_id));
    }
    public function get_project_settings($project_id)
    {
        $this->db->where('project_id', $project_id);
        return $this->db->get('tblprojectsettings')->result_array();
    }
    public function get_project_cont($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('tblcontacts')->result_array();
    }

    public function get_project_members($id)
    {   $this->db->select('email,project_id,staff_id');
        $this->db->join('tblstaff','tblstaff.staffid=tblprojectmembers.staff_id');
        $this->db->where('project_id', $id);
        return $this->db->get('tblprojectmembers')->result_array();
    }
    public function remove_team_member($project_id, $staff_id)
    {
        $this->db->where('project_id', $project_id);
        $this->db->where('staff_id', $staff_id);
        $this->db->delete('tblprojectmembers');
        if ($this->db->affected_rows() > 0) {
            $this->log_activity($project_id, 'project_activity_removed_team_member', get_staff_full_name($staff_id));
            return true;
        }
        return false;
    }
    public function get_timesheets($project_id, $tasks_ids = array())
    {
        if (count($tasks_ids) == 0) {
            $tasks     = $this->get_tasks($project_id);
            $tasks_ids = array();
            foreach ($tasks as $task) {
                array_push($tasks_ids, $task['id']);
            }
        }
        if (count($tasks_ids) > 0) {
            $this->db->where('task_id IN(' . implode(', ', $tasks_ids) . ')');
            $timesheets = $this->db->get('tbltaskstimers')->result_array();
            $i          = 0;
            foreach ($timesheets as $t) {
                $task                         = $this->tasks_model->get($t['task_id']);
                $timesheets[$i]['task_data']  = $task;
                $timesheets[$i]['staff_name'] = get_staff_full_name($t['staff_id']);
                if (!is_null($t['end_time'])) {
                    $timesheets[$i]['total_spent'] = $t['end_time'] - $t['start_time'];
                } else {
                    $timesheets[$i]['total_spent'] = time() - $t['start_time'];
                }
                $i++;
            }
            return $timesheets;
        } else {
            return array();
        }
    }
    public function get_discussion($id, $project_id = '')
    {
        if ($project_id != '') {
            $this->db->where('project_id', $project_id);
        }
        $this->db->where('id', $id);
        if (is_client_logged_in()) {
            $this->db->where('show_to_customer', 1);
            $this->db->where('project_id IN (SELECT id FROM tblprojects WHERE clientid=' . get_client_user_id() . ')');
        }
        $discussion = $this->db->get('tblprojectdiscussions')->row();
        if ($discussion) {
            return $discussion;
        }
        return false;
    }
    public function get_discussion_comment($id)
    {
        $this->db->where('id', $id);
        $comment = $this->db->get('tblprojectdiscussioncomments')->row();
        if ($comment->contact_id != 0) {
            if (is_client_logged_in()) {
                if ($comment->contact_id == get_contact_user_id()) {
                    $comment->created_by_current_user = true;
                } else {
                    $comment->created_by_current_user = false;
                }
            } else {
                $comment->created_by_current_user = false;
            }
            $comment->profile_picture_url = contact_profile_image_url($comment->contact_id);
            $comment->fullname            = $comment->full_name;
        } else {
            if (is_client_logged_in()) {
                $comment->created_by_current_user = false;
            } else {
                if (is_staff_logged_in()) {
                    if ($comment->staff_id == get_staff_user_id()) {
                        $comment->created_by_current_user = true;
                    } else {
                        $comment->created_by_current_user = false;
                    }
                } else {
                    $comment->created_by_current_user = false;
                }
            }
            if (is_admin($comment->staff_id)) {
                $comment->created_by_admin = true;
            } else {
                $comment->created_by_admin = false;
            }
            $comment->profile_picture_url = staff_profile_image_url($comment->staff_id);
            $comment->fullname            = get_staff_full_name($comment->staff_id);
        }
        if (!is_null($comment->file_name)) {
            $comment->file_url = site_url('uploads/discussions/' . $comment->discussion_id . '/' . $comment->file_name);
        }
        return $comment;
    }
    public function get_discussion_comments($id)
    {
        $this->db->where('discussion_id', $id);
        $comments = $this->db->get('tblprojectdiscussioncomments')->result_array();
        $i        = 0;
        foreach ($comments as $comment) {
            if ($comment['contact_id'] != 0) {
                if (is_client_logged_in()) {
                    if ($comment['contact_id'] == get_contact_user_id()) {
                        $comments[$i]['created_by_current_user'] = true;
                    } else {
                        $comments[$i]['created_by_current_user'] = false;
                    }
                } else {
                    $comments[$i]['created_by_current_user'] = false;
                }
                $comments[$i]['profile_picture_url'] = contact_profile_image_url($comment['contact_id']);
                $comments[$i]['fullname']            = $comment['full_name'];
            } else {
                if (is_client_logged_in()) {
                    $comments[$i]['created_by_current_user'] = false;
                } else {
                    if (is_staff_logged_in()) {
                        if ($comment['staff_id'] == get_staff_user_id()) {
                            $comments[$i]['created_by_current_user'] = true;
                        } else {
                            $comments[$i]['created_by_current_user'] = false;
                        }
                    } else {
                        $comments[$i]['created_by_current_user'] = false;
                    }
                }
                if (is_admin($comment['staff_id'])) {
                    $comments[$i]['created_by_admin'] = true;
                } else {
                    $comments[$i]['created_by_admin'] = false;
                }
                $comments[$i]['profile_picture_url'] = staff_profile_image_url($comment['staff_id']);
                $comments[$i]['fullname']            = apply_alami(get_staff_full_name($comment['staff_id']));
            }
            if (!is_null($comment['file_name'])) {
                $comments[$i]['file_url'] = site_url('uploads/discussions/' . $id . '/' . $comment['file_name']);
            }
            $comments[$i]['created'] = (strtotime($comment['created']) * 1000);
            $i++;
        }
        return $comments;
    }
    public function get_discussions($project_id)
    {
        $this->db->where('project_id', $project_id);
        if (is_client_logged_in()) {
            $this->db->where('show_to_customer', 1);
        }
        $discussions = $this->db->get('tblprojectdiscussions')->result_array();
        $i           = 0;
        foreach ($discussions as $discussion) {
            $discussions[$i]['total_comments'] = total_rows('tblprojectdiscussioncomments', array(
                'discussion_id' => $discussion['id']
            ));
            $i++;
        }
        return $discussions;
    }
    public function add_discussion_comment($data, $discussion_id)
    {
        $discussion             = $this->get_discussion($discussion_id);
        $_data['discussion_id'] = $discussion_id;
        if (isset($data['content'])) {
            $_data['content'] = $data['content'];
        }
        if (isset($data['parent']) && $data['parent'] != NULL) {
            $_data['parent'] = $data['parent'];
        }
        if (is_client_logged_in()) {
            $_data['contact_id'] = get_contact_user_id();
            $_data['full_name']  = get_contact_full_name($_data['contact_id']);
            $_data['staff_id']   = 0;
        } else {
            $_data['contact_id'] = 0;
            $_data['staff_id']   = get_staff_user_id();
        }
        $_data            = handle_project_discussion_comment_attachments($discussion_id, $data, $_data);
        $_data['created'] = date('Y-m-d H:i:s');
        $this->db->insert('tblprojectdiscussioncomments', $_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
              $discussion = $this->get_discussion($discussion_id);
              $members = $this->get_project_members($discussion->project_id);

              $notification_data = array(
                 'description'=>'not_commented_on_project_discussion',
                 'link'=>'projects/view/' . $discussion->project_id . '?group=project_discussions&discussion_id=' . $discussion_id
                 );

            if(is_client_logged_in()){
                $notification_data['fromclientid'] = get_contact_user_id();
            } else {
                $notification_data['fromuserid'] = get_staff_user_id();
            }

            foreach($members as $member){
                if($member['staff_id'] == get_staff_user_id() && !is_client_logged_in()){continue;}
                $notification_data['touserid'] = $member['staff_id'];
                add_notification($notification_data);
            }
            $this->send_project_email_template(
                $discussion->project_id,
                'new-project-discussion-comment-to-staff',
                'new-project-discussion-comment-to-customer',
                $discussion->show_to_customer,
                array(
                    'staff'=>array('discussion_id'=>$discussion_id,'discussion_comment_id'=>$insert_id),
                    'customers'=>array('customer_template'=>true,'discussion_id'=>$discussion_id,'discussion_comment_id'=>$insert_id)
                    )
                );

            $this->log_activity($discussion->project_id, 'project_activity_commented_on_discussion', $discussion->subject,$discussion->show_to_customer);
            $this->db->where('id', $discussion_id);
            $this->db->update('tblprojectdiscussions', array(
                'last_activity' => date('Y-m-d H:i:s')
            ));
            return $this->get_discussion_comment($insert_id);
        }
        return false;
    }
    public function update_discussion_comment($data)
    {
        $comment = $this->get_discussion_comment($data['id']);
        $this->db->where('id', $data['id']);
        $this->db->update('tblprojectdiscussioncomments', array(
            'modified' => date('Y-m-d H:i:s'),
            'content' => nl2br($data['content'])
        ));
        if ($this->db->affected_rows() > 0) {
            $this->db->where('id', $comment->discussion_id);
            $this->db->update('tblprojectdiscussions', array(
                'last_activity' => date('Y-m-d H:i:s')
            ));
        }
        return $this->get_discussion_comment($data['id']);
    }
    public function delete_discussion_comment($id)
    {
        $comment = $this->get_discussion_comment($id);
        $this->db->where('id', $id);
        $this->db->delete('tblprojectdiscussioncomments');
        if ($this->db->affected_rows() > 0) {
            $this->delete_discussion_comment_attachment($comment->file_name, $comment->discussion_id);
            $discussion      = $this->get_discussion($comment->discussion_id);
            $additional_data = '';
            $additional_data .= $discussion->subject . '<br />' . $comment->content;
            if (!is_null($comment->file_name)) {
                $additional_data .= $comment->file_name;
            }
            $this->log_activity($discussion->project_id, 'project_activity_deleted_discussion_comment', $additional_data);
        }
        $this->db->where('parent', $id);
        $this->db->update('tblprojectdiscussioncomments', array(
            'parent' => NULL
        ));
        if ($this->db->affected_rows() > 0) {
            $this->db->where('id', $comment->discussion_id);
            $this->db->update('tblprojectdiscussions', array(
                'last_activity' => date('Y-m-d H:i:s')
            ));
        }
        return true;
    }
    public function delete_discussion_comment_attachment($file_name, $discussion_id)
    {
        $path = PROJECT_DISCUSSION_ATTACHMENT_FOLDER . $discussion_id;
        if (!is_null($file_name)) {
            if (file_exists($path . '/' . $file_name)) {
                unlink($path . '/' . $file_name);
            }
        }
        if (file_exists($path)) {
            // Check if no attachments left, so we can delete the folder also
            $other_attachments = list_files($path);
            if (count($other_attachments) == 0) {
                delete_dir($path);
            }
        }
    }
    public function add_discussion($data)
    {
        if (is_client_logged_in()) {
            $data['contact_id']       = get_contact_user_id();
            $data['staff_id']         = 0;
            $data['show_to_customer'] = 1;
        } else {
            $data['staff_id']   = get_staff_user_id();
            $data['contact_id'] = 0;
            if (isset($data['show_to_customer'])) {
                $data['show_to_customer'] = 1;
            } else {
                $data['show_to_customer'] = 0;
            }
        }
        $data['datecreated'] = date('Y-m-d H:i:s');
        $data['description'] = nl2br($data['description']);
        $this->db->insert('tblprojectdiscussions', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {

          $members = $this->get_project_members($data['project_id']);
          $notification_data = array(
           'description'=>'not_created_new_project_discussion',
           'link'=>'projects/view/' . $data['project_id'] . '?group=project_discussions&discussion_id=' . $insert_id,
           );

            if(is_client_logged_in()){
                $notification_data['fromclientid'] = get_contact_user_id();
            } else {
                $notification_data['fromuserid'] = get_staff_user_id();
            }

            foreach($members as $member){
                if($member['staff_id'] == get_staff_user_id() && !is_client_logged_in()){continue;}
                $notification_data['touserid'] = $member['staff_id'];
                add_notification($notification_data);
            }
            $this->send_project_email_template(
                $data['project_id'],
                'new-project-discussion-created-to-staff',
                'new-project-discussion-created-to-customer',
                $data['show_to_customer'],
                array(
                    'staff'=>array('discussion_id'=>$insert_id),
                    'customers'=>array('customer_template'=>true,'discussion_id'=>$insert_id)
                    )
                );
            $this->log_activity($data['project_id'], 'project_activity_created_discussion', $data['subject'], $data['show_to_customer']);
            return $insert_id;
        }
        return false;
    }
    public function edit_discussion($data, $id)
    {
        $this->db->where('id', $id);
        if (isset($data['show_to_customer'])) {
            $data['show_to_customer'] = 1;
        } else {
            $data['show_to_customer'] = 0;
        }
        $data['description'] = nl2br($data['description']);
        $this->db->update('tblprojectdiscussions', $data);
        if ($this->db->affected_rows() > 0) {
            $this->log_activity($data['project_id'], 'project_activity_updated_discussion', $data['subject'], $data['show_to_customer']);
            return true;
        }
        return false;
    }
    public function delete_discussion($id)
    {
        $discussion = $this->get_discussion($id);
        $this->db->where('id', $id);
        $this->db->delete('tblprojectdiscussions');
        if ($this->db->affected_rows() > 0) {
            $this->log_activity($discussion->project_id, 'project_activity_deleted_discussion', $discussion->subject, $discussion->show_to_customer);
            $this->db->where('discussion_id', $id);
            $comments = $this->db->get('tblprojectdiscussioncomments')->result_array();
            foreach ($comments as $comment) {
                $this->delete_discussion_comment_attachment($comment['file_name'], $id);
            }
            $this->db->where('discussion_id', $id);
            $this->db->delete('tblprojectdiscussioncomments');
            return true;
        }
        return false;
    }
    public function copy($project_id)
    {
        $data      = $this->input->post();
        $project   = $this->get($project_id);
        $settings  = $this->get_project_settings($project_id);
        $_new_data = array();
        $fields    = $this->db->list_fields('tblprojects');
        foreach ($fields as $field) {
            if (isset($project->$field)) {
                $_new_data[$field] = $project->$field;
            }
        }
        unset($_new_data['id']);
        $_new_data['addedfrom']       = get_staff_user_id();
        $_new_data['start_date']      = to_sql_date($data['start_date']);
        $_new_data['deadline']        = to_sql_date($data['deadline']);
        $_new_data['project_created'] = date('Y-m-d H:i:s');
        $this->db->insert('tblprojects', $_new_data);
        $id = $this->db->insert_id();
        if ($id) {
            foreach ($settings as $setting) {
                $this->db->insert('tblprojectsettings', array(
                    'project_id' => $id,
                    'name' => $setting['name'],
                    'value' => $setting['value']
                ));
            }
            $added_tasks = array();
            $tasks       = $this->get_tasks($project_id);
            if (isset($data['tasks'])) {
                $fields_tasks = $this->db->list_fields('tblstafftasks');
                foreach ($tasks as $task) {
                    if (isset($data['task_include_followers'])) {
                        $copy_task_data['copy_task_followers'] = 'true';
                    }
                    if (isset($data['task_include_assignees'])) {
                        $copy_task_data['copy_task_assignees'] = 'true';
                    }
                    if (isset($data['tasks_include_checklist_items'])) {
                        $copy_task_data['copy_task_checklist_items'] = 'true';
                    }
                    $copy_task_data['copy_from'] = $task['id'];
                    $task_id = $this->tasks_model->copy($copy_task_data,array('rel_id'=>$id,'rel_type'=>'project'));
                    if ($task_id) {
                        array_push($added_tasks, $task_id);
                    }
                }
            }
            if (isset($data['milestones'])) {
                $milestones        = $this->get_milestones($project_id);
                $_added_milestones = array();
                foreach ($milestones as $milestone) {
                    $dCreated = new DateTime($milestone['datecreated']);
                    $dDuedate = new DateTime($milestone['due_date']);
                    $dDiff    = $dCreated->diff($dDuedate);
                    $due_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime('+' . $dDiff->days . 'DAY'))));

                    $this->db->insert('tblmilestones', array(
                        'name' => $milestone['name'],
                        'project_id' => $id,
                        'milestone_order' => $milestone['milestone_order'],
                        'due_date' => $due_date,
                        'datecreated' => date('Y-m-d'),
                        'color'=>$milestone['color'],
                    ));

                    $milestone_id = $this->db->insert_id();
                    if ($milestone_id) {
                        $_added_milestone_data         = array();
                        $_added_milestone_data['id']   = $milestone_id;
                        $_added_milestone_data['name'] = $milestone['name'];
                        $_added_milestones[]           = $_added_milestone_data;
                    }
                }
                if (isset($data['tasks'])) {
                    if (count($added_tasks) > 0) {
                        // Original project tasks
                        foreach ($tasks as $task) {
                            if ($task['milestone'] != 0) {
                                $this->db->where('id', $task['milestone']);
                                $milestone = $this->db->get('tblmilestones')->row();
                                if ($milestone) {
                                    $name = $milestone->name;
                                    foreach ($_added_milestones as $added_milestone) {
                                        if ($name == $added_milestone['name']) {
                                            $this->db->where('id IN (' . implode(', ', $added_tasks) . ')');
                                            $this->db->where('milestone', $task['milestone']);
                                            $this->db->update('tblstafftasks', array(
                                                'milestone' => $added_milestone['id']
                                            ));
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                // milestones not set
                if (count($added_tasks)) {
                    foreach ($added_tasks as $task) {
                        $this->db->where('id', $task['id']);
                        $this->db->update('tblstafftasks', array(
                            'milestone' => 0
                        ));
                    }
                }
            }
            if (isset($data['members'])) {
                $members = $this->get_project_members($project_id);
                $_members = array();
                foreach ($members as $member) {
                    array_push($_members,$member['staff_id']);
                }
                $this->add_edit_members(array('project_members'=>$_members),$id);
            }
            if (isset($data['discussions'])) {
                $this->db->where('project_id', $project_id);
                $discussions = $this->db->get('tblprojectdiscussions')->result_array();
                foreach ($discussions as $discussion) {
                    $this->db->insert('tblprojectdiscussions', array(
                        'project_id' => $id,
                        'subject' => $discussion['subject'],
                        'description' => $discussion['description'],
                        'show_to_customer' => $discussion['show_to_customer'],
                        'datecreated' => date('Y-m-d H:i:s'),
                        'datecreated' => get_staff_user_id()
                    ));
                }
            }
            $this->log_activity($id, 'project_activity_created');
            logActivity('Project Copied [ID: ' . $project_id . ', NewID: ' . $id . ']');
            return $id;
            ;
        }
        return false;
    }
    public function get_staff_notes($project_id)
    {
        $this->db->where('project_id', $project_id);
        $this->db->where('staff_id', get_staff_user_id());
        $notes = $this->db->get('tblprojectnotes')->row();
        if ($notes) {
            return $notes->content;
        }
        return '';
    }
    public function save_note($data, $project_id)
    {
        // Check if the note exists for this project;
        $this->db->where('project_id', $project_id);
        $this->db->where('staff_id', get_staff_user_id());
        $notes = $this->db->get('tblprojectnotes')->row();
        if ($notes) {
            $this->db->where('id', $notes->id);
            $this->db->update('tblprojectnotes', array(
                'content' => $data['content']
            ));
            if ($this->db->affected_rows() > 0) {
                return true;
            }
            return false;
        } else {
            $this->db->insert('tblprojectnotes', array(
                'staff_id' => get_staff_user_id(),
                'content' => $data['content'],
                'project_id' => $project_id
            ));
            $insert_id = $this->db->insert_id();
            if ($insert_id) {
                return true;
            }
            return false;
        }
        return false;
    }
    public function delete($project_id)
    {
        $project = $this->get($project_id);
        $this->db->where('id', $project_id);
        $this->db->delete('tblprojects');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('project_id', $project_id);
            $this->db->delete('tblprojectmembers');
            $this->db->where('project_id', $project_id);
            $this->db->delete('tblprojectnotes');
            $this->db->where('project_id', $project_id);
            $this->db->delete('tblprojectsettings');
            $this->db->where('project_id', $project_id);
            $discussions = $this->db->get('tblprojectdiscussions')->result_array();
            foreach ($discussions as $discussion) {
                $discussion_comments = $this->get_discussion_comments($discussion['id']);
                foreach ($discussion_comments as $comment) {
                    $this->delete_discussion_comment_attachment($comment['file_name'], $discussion['id']);
                }
                $this->db->where('discussion_id', $discussion['id']);
                $this->db->delete('tblprojectdiscussioncomments');
            }
            $this->db->where('project_id', $project_id);
            $this->db->delete('tblprojectdiscussions');
            $files = $this->get_files($project_id);
            foreach ($files as $file) {
                $this->remove_file($file['id']);
            }
            $tasks = $this->get_tasks($project_id);
            foreach ($tasks as $task) {
                $this->tasks_model->delete_task($task['id'], false);
            }
            $this->db->where('project_id', $project_id);
            $this->db->delete('tblprojectactivity');

            $this->db->where('project_id',$project_id);
            $this->db->update('tblexpenses',array('project_id'=>0));

            $this->db->where('project_id',$project_id);
            $this->db->delete('tblpinnedprojects');

            logActivity('Project Deleted [ID: ' . $project_id . ', Name: ' . $project->name . ']');
            return true;
        }
        return false;
    }
    public function get_activity($id = '', $limit = '', $only_project_members_activity = false)
    {
        if (!is_client_logged_in()) {
            $has_permission = has_permission('projects', '', 'view');
            if (!$has_permission) {
                $this->db->where('project_id IN (SELECT project_id FROM tblprojectmembers WHERE staff_id=' . get_staff_user_id() . ')');
            }
        }
        if (is_client_logged_in()) {
            $this->db->where('visible_to_customer', 1);
        }
        if (is_numeric($id)) {
            $this->db->where('project_id', $id);
        }
        if (is_numeric($limit)) {
            $this->db->limit($limit);
        }
        $this->db->order_by('dateadded', 'desc');
        $activities = $this->db->get('tblprojectactivity')->result_array();
        $i          = 0;
        foreach ($activities as $activity) {
            $seconds          = get_string_between($activity['additional_data'], '<seconds>', '</seconds>');
            $other_lang_keys  = get_string_between($activity['additional_data'], '<lang>', '</lang>');
            $_additional_data = $activity['additional_data'];
            if ($seconds != '') {
                $_additional_data = str_replace('<seconds>' . $seconds . '</seconds>', format_seconds($seconds), $_additional_data);
            }
            if ($other_lang_keys != '') {
                $_additional_data = str_replace('<lang>' . $other_lang_keys . '</lang>', _l($other_lang_keys), $_additional_data);
            }
            $activities[$i]['description']     = _l($activities[$i]['description_key']);
            $activities[$i]['additional_data'] = $_additional_data;
            $this->db->select('name');
            $this->db->where('id', $activity['project_id']);
            $project_name                   = $this->db->get('tblprojects')->row()->name;
            $activities[$i]['project_name'] = $project_name;
            unset($activities[$i]['description_key']);
            $i++;
        }
        return $activities;
    }
    public function log_activity($project_id, $description_key, $additional_data = '', $visible_to_customer = 1)
    {
        if (!DEFINED('CRON')) {
            if (is_client_logged_in()) {
                $data['contact_id'] = get_contact_user_id();
                $data['staff_id']   = 0;
            } else if (is_staff_logged_in()) {
                $data['contact_id'] = 0;
                $data['staff_id']   = get_staff_user_id();
            }
        } else {
            $data['contact_id'] = 0;
            $data['staff_id']   = 0;
        }
        $data['description_key']     = $description_key;
        $data['additional_data']     = $additional_data;
        $data['visible_to_customer'] = $visible_to_customer;
        $data['project_id']          = $project_id;
        $data['dateadded']           = date('Y-m-d H:i:s');
        $this->db->insert('tblprojectactivity', $data);
    }

    public function send_project_email_template($project_id,$staff_template,$customer_template,$action_visible_to_customer,$additional_data = array()){
        if(count($additional_data) == 0){
            $additional_data['customers'] = array();
            $additional_data['staff'] = array();
        } else if(count($additional_data) == 1){
            if(!isset($additional_data['staff'])){
                $additional_data['staff'] = array();
            } else {
                $additional_data['customers'] = array();
            }
        }

        $project = $this->get($project_id);
        $members = $this->get_project_members($project_id);

        $this->load->model('emails_model');
        foreach($members as $member){
            if(!is_client_logged_in()){
                if($member['staff_id'] == get_staff_user_id()){continue;}
            }
            $merge_fields = array();
            $merge_fields = array_merge($merge_fields, get_staff_merge_fields($member['staff_id']));
            $merge_fields = array_merge($merge_fields, get_project_merge_fields($project->id,$additional_data['staff']));
            $this->emails_model->send_email_template($staff_template,$member['email'],$merge_fields);
        }
        if($action_visible_to_customer == 1){
            $contacts    = $this->clients_model->get_contacts($project->clientid);
            foreach ($contacts as $contact) {
                if(is_client_logged_in()){
                    if($contact['id'] == get_contact_user_id()){continue;}
                }
                if (has_contact_permission('projects', $contact['id'])) {
                    $merge_fields = array();
                    $merge_fields = array_merge($merge_fields, get_client_contact_merge_fields($project->clientid,$contact['id']));
                    $merge_fields = array_merge($merge_fields, get_project_merge_fields($project->id,$additional_data['customers']));
                    $this->emails_model->send_email_template($customer_template,$contact['email'],$merge_fields);
                }
            }
        }
    }
}
