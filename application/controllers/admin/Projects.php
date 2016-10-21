<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Projects extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('projects_model');
        $this->load->model('tasks_model');
        $this->load->model('currencies_model');
        $this->load->helper('date');
    }
    public function index($clientid = '')
    {
        if ($this->input->is_ajax_request()) {
            $this->perfex_base->get_table_data('projects', array(
                'clientid' => $clientid
            ));
        }
        $data['statuses'] = $this->projects_model->get_project_statuses();
        $data['title'] = _l('projects');
        $this->load->view('admin/projects/manage', $data);
    }

    public function staff_projects()
    {
        if ($this->input->is_ajax_request()) {
            $this->perfex_base->get_table_data('staff_projects');
        }
    }
    public function expenses($id){
        if ($this->input->is_ajax_request()) {
            $this->load->model('expenses_model');
            $this->perfex_base->get_table_data('project_expenses', array(
                'project_id' => $id
            ));
        }
    }
    public function add_expense(){
      if ($this->input->post()) {
        $this->load->model('expenses_model');
                $id = $this->expenses_model->add($this->input->post());
                if ($id) {
                    set_alert('success', _l('added_successfuly', _l('expense')));
                    echo json_encode(array(
                        'url' => admin_url('projects/view/'.$this->input->post('project_id').'/?group=project_expenses'),
                        'expenseid' => $id
                    ));
                    die;
                }
                echo json_encode(array(
                    'url' => admin_url('projects/view/'.$this->input->post('project_id').'/?group=project_expenses'),
                ));
                die;
        }
    }
    public function project($id = '')
    {
        if (!has_permission('projects', '', 'edit') && !has_permission('projects', '', 'create')) {
            access_denied('Projects');
        }

        if ($this->input->post())
        {
            $contact_ids = $this->input->post('contactid[]');

            if ($id == '') {
                if (!has_permission('projects', '', 'create')) {
                    acccess_danied('Projects');
                }
                $id = $this->projects_model->add($this->input->post());

                if ($id) {
                    //$this->projects_model->update_contacts($id, $contact_ids);

                    set_alert('success', _l('added_successfuly', _l('project')));
                    redirect(admin_url('projects/view/' . $id));
                }
            } else {
                if (!has_permission('projects', '', 'edit')) {
                    acccess_danied('Projects');
                }
                $success = $this->projects_model->update($this->input->post(), $id);
                $this->projects_model->update_contacts($id, $contact_ids);

                if ($success) {
                    set_alert('success', _l('updated_successfuly', _l('project')));
                }
                redirect(admin_url('projects/view/' . $id));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('project_lowercase'));
        } else {


            $data['project']         = $this->projects_model->get($id);
            $data['project_members'] = $this->projects_model->get_project_members($id);
            $title                   = _l('edit', _l('project_lowercase'));

            $client_id = $data['project']->clientid;

            $data['project_contacts'] = $this->projects_model->get_project_contacts($id);
            $data['contacts']        = $this->clients_model->get_contacts($client_id);
        }

        if($this->input->get('customer_id')){
            $data['customer_id'] = $this->input->get('customer_id');
            $data['do_not_auto_toggle'] = true;
        }

        $data['last_project_settings'] = $this->projects_model->get_last_project_settings();
        $data['settings']              = $this->projects_model->get_settings();
        $data['statuses'] = $this->projects_model->get_project_statuses();
        $data['staff']     = $this->staff_model->get('', 1);
        $data['customers'] = $this->clients_model->get('', 1);
        $data['title']     = $title;
        $this->load->view('admin/projects/project', $data);
    }
    public function view($id)
    {
        if ($this->projects_model->is_member($id) || has_permission('projects', '', 'view')) {
            $project = $this->projects_model->get($id);
            if (!$project) {
                blank_page('Project not found');
            }
            $this->load->model('invoices_model');
              $data['invoices_years'] = $this->invoices_model->get_invoices_years();
        $data['invoices_sale_agents'] = $this->invoices_model->get_sale_agents();
        $data['invoices_statuses']       = $this->invoices_model->get_statuses();
        $data['chosen_invoice_status']        = '';
        $data['chosen_ticket_status']        = '';
            $data['project'] = $project;
            if (!$this->input->get('group') || ($this->input->get('group') == 'project_invoices' && !has_permission('invoices', '', 'view')) || $this->input->get('group') == 'project_expenses' && (!has_permission('expenses','','view') && !has_permission('expenses','','create'))) {
                $view = 'project_overview';
            } else {
                $view = $this->input->get('group');
            }
            $data['currency']                  = $this->projects_model->get_currency($id);
            $data['project_total_days']        = round((human_to_unix($data['project']->deadline . ' 00:00') - human_to_unix($data['project']->start_date . ' 00:00')) / 3600 / 24);
            $data['project_days_left']         = $data['project_total_days'];
            $data['project_time_left_percent'] = 100;
            if (human_to_unix($data['project']->start_date . ' 00:00') < time() && human_to_unix($data['project']->deadline . ' 00:00') > time()) {
                $data['project_days_left']         = round((human_to_unix($data['project']->deadline . ' 00:00') - time()) / 3600 / 24);
                $data['project_time_left_percent'] = $data['project_days_left'] / $data['project_total_days'] * 100;
            }
            if (human_to_unix($data['project']->deadline . ' 00:00') < time()) {
                $data['project_days_left']         = 0;
                $data['project_time_left_percent'] = 0;
            }
            $total_tasks                 = total_rows('tblstafftasks', array(
                'rel_id' => $id,
                'rel_type' => 'project'
            ));
            $data['tasks_not_completed'] = total_rows('tblstafftasks', array(
                'finished' => 0,
                'rel_id' => $id,
                'rel_type' => 'project'
            ));
            $data['tasks_completed']     = total_rows('tblstafftasks', array(
                'finished' => 1,
                'rel_id' => $id,
                'rel_type' => 'project'
            ));
            $data['total_tasks']         = $total_tasks;
            @$data['tasks_not_completed_progress'] = $data['tasks_completed'] / $total_tasks * 100;
            $data['tasks'] = $this->projects_model->get_tasks($id);
            $this->load->model('payment_modes_model');
            $data['payment_modes'] = $this->payment_modes_model->get('', true);
            $data['members']       = $this->projects_model->get_project_members($id);
            $data['staff']         = $this->staff_model->get('', 1);
            $data['gantt_data']    = $this->projects_model->get_gantt_data($id);
            $data['title']         = $data['project']->name;
            $data['invoiceid']     = '';
            $data['status']        = '';
            $data['custom_view']   = '';
            $data['files']         = $this->projects_model->get_files($id);
            $percent               = $this->projects_model->calc_progress($id);
            @$percent_circle = $percent / 100;
            $data['percent_circle'] = $percent_circle;

            // Expense data
            $this->load->model('taxes_model');
            $this->load->model('expenses_model');
            $data['taxes']         = $this->taxes_model->get();
            $data['expense_categories']    = $this->expenses_model->get_category();
            $data['currencies'] = $this->currencies_model->get();

            // Discussions
            if ($this->input->get('discussion_id')) {
                $data['discussion_user_profile_image_url'] = staff_profile_image_url(get_staff_user_id());
                $data['discussion']                        = $this->projects_model->get_discussion($this->input->get('discussion_id'), $id);
                $data['current_user_is_admin']             = is_admin();
            }
            $data['activity']              = $this->projects_model->get_activity($id);
            $data['bodyclass']             = 'project';
            $data['staff_notes']           = $this->projects_model->get_staff_notes($id);
            $this->load->model('tickets_model');
            $data['ticket_assignees'] = $this->tickets_model->get_tickets_assignes_disctinct();
            $this->load->model('departments_model');
            $data['staff_deparments_ids'] = $this->departments_model->get_staff_departments(get_staff_user_id(), true);
            $data['group_view']            = $this->load->view('admin/projects/' . $view, $data, true);
            $data['percent']               = $percent;
            $data['projects_assets']       = true;
            $data['circle_progress_asset'] = true;

            $this->load->view('admin/projects/view', $data);
        } else {
            access_denied('Project View');
        }
    }
    public function update_task_milestone(){
        if($this->input->post()){
            $this->projects_model->update_task_milestone($this->input->post());
        }
    }
    public function pin_action($project_id){
        $this->projects_model->pin_action($project_id);
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function add_edit_members($project_id)
    {
        if (has_permission('projects', '', 'edit') || has_permission('projects','','create')) {
            $this->projects_model->add_edit_members($this->input->post(), $project_id);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function discussions($project_id)
    {
        if ($this->projects_model->is_member($project_id) || has_permission('projects', '', 'view')) {
            if ($this->input->is_ajax_request()) {
                $this->perfex_base->get_table_data('project_discussions', array(
                    'project_id' => $project_id
                ));
            }
        }
    }
    public function discussion($id = '')
    {
        if ($this->input->post()) {
            $message = '';
            $success = false;
            if (!$this->input->post('id')) {
                $id = $this->projects_model->add_discussion($this->input->post());
                if ($id) {
                    $success = true;
                    $message = _l('added_successfuly', _l('project_discussion'));
                }
                echo json_encode(array(
                    'success' => $success,
                    'message' => $message
                ));
            } else {
                $data = $this->input->post();
                $id   = $data['id'];
                unset($data['id']);
                $success = $this->projects_model->edit_discussion($data, $id);
                if ($success) {
                    $message = _l('updated_successfuly', _l('project_discussion'));
                }
                echo json_encode(array(
                    'success' => $success,
                    'message' => $message
                ));
            }
            die;
        }
    }
    public function get_discussion_comments($id)
    {
        echo json_encode($this->projects_model->get_discussion_comments($id));
    }
    public function add_discussion_comment($discussion_id)
    {
        echo json_encode($this->projects_model->add_discussion_comment($this->input->post(), $discussion_id));
    }
    public function update_discussion_comment()
    {
        echo json_encode($this->projects_model->update_discussion_comment($this->input->post()));
    }
    public function delete_discussion_comment($id)
    {
        echo json_encode($this->projects_model->delete_discussion_comment($id));
    }
    public function delete_discussion($id)
    {
        $success = false;
        if (has_permission('projects', '', 'delete')) {
            $success = $this->projects_model->delete_discussion($id);
        }
        $alert_type = 'warning';
        $message    = _l('project_discussion_failed_to_delete');
        if ($success) {
            $alert_type = 'success';
            $message    = _l('project_discussion_deleted');
        }
        echo json_encode(array(
            'alert_type' => $alert_type,
            'message' => $message
        ));
    }
    public function change_milestone_color(){
        if($this->input->post()){
            $this->projects_model->update_milestone_color($this->input->post());
        }
    }
    public function upload_file($project_id)
    {
        handle_project_file_uploads($project_id);
    }
    public function change_file_visibility($id, $visible)
    {
        if ($this->input->is_ajax_request()) {
            $this->projects_model->change_file_visibility($id, $visible);
        }
    }
    public function change_activity_visibility($id, $visible)
    {
        if (has_permission('projects','','create')) {
            if ($this->input->is_ajax_request()) {
                $this->projects_model->change_activity_visibility($id, $visible);
            }
        }
    }
    public function remove_file($project_id, $id)
    {
        $this->projects_model->remove_file($id);
        redirect(admin_url('projects/view/' . $project_id . '?group=project_files'));
    }
    public function milestones($project_id)
    {
        if ($this->projects_model->is_member($project_id) || has_permission('projects', '', 'view')) {
            if ($this->input->is_ajax_request()) {
                $this->perfex_base->get_table_data('milestones', array(
                    'project_id' => $project_id
                ));
            }
        }
    }
    public function milestone($id = '')
    {
        if ($this->input->post()) {
            $message = '';
            $success = false;
            if (!$this->input->post('id')) {
                $id = $this->projects_model->add_milestone($this->input->post());
                if ($id) {
                    set_alert('success',_l('added_successfuly', _l('project_milestone')));
                }
            } else {
                $data = $this->input->post();
                $id   = $data['id'];
                unset($data['id']);
                $success = $this->projects_model->update_milestone($data, $id);
                if ($success) {
                    set_alert('success',_l('updated_successfuly', _l('project_milestone')));
                }
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function delete_milestone($project_id, $id)
    {
        if (has_permission('projects', '', 'delete')) {
            if ($this->projects_model->delete_milestone($id)) {
                set_alert('deleted', 'project_milestone');
            }
        }
        redirect(admin_url('projects/view/' . $project_id . '?group=project_milestones'));
    }
    public function timesheets($project_id)
    {
        if ($this->projects_model->is_member($project_id) || has_permission('projects', '', 'view')) {
            if ($this->input->is_ajax_request()) {
                $this->perfex_base->get_table_data('timesheets', array(
                    'project_id' => $project_id
                ));
            }
        }
    }
    public function timesheet()
    {
        if ($this->input->post()) {
            $message = '';
            $success = false;
            $success = $this->tasks_model->timesheet($this->input->post());
            if ($success === true) {
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
    public function timesheet_task_assignees($task_id, $project_id, $staff_id = 'undefined')
    {
        $assignees      = $this->tasks_model->get_task_assignees($task_id);
        $data           = '';
        $has_permission = has_permission('projects', '', 'edit');
        // The second condition if staff member edit their own timesheet
        if ($staff_id == 'undefined' || $staff_id != 'undefined' && !$has_permission) {
            $staff_id     = get_staff_user_id();
            $current_user = true;
        }
        foreach ($assignees as $staff) {
            $selected = '';
            // maybe is admin and not project member
            if ($staff['assigneeid'] == $staff_id && $this->projects_model->is_member($project_id, $staff_id)) {
                $selected = ' selected';
            }
            if (!$has_permission && isset($current_user)) {
                if ($staff['assigneeid'] != $staff_id) {
                    continue;
                }
            }
            $data .= '<option value="' . $staff['assigneeid'] . '"' . $selected . '>' . get_staff_full_name($staff['assigneeid']) . '</option>';
        }
        echo $data;
    }
    public function remove_team_member($project_id, $staff_id)
    {
        if (has_permission('projects', '', 'edit') || has_permission('projects', '', 'create')) {
            if ($this->projects_model->remove_team_member($project_id, $staff_id)) {
                set_alert('success', _l('project_member_removed'));
            }
        }
        redirect(admin_url('projects/view/' . $project_id));
    }
    public function save_note($project_id)
    {
        if ($this->input->post()) {
            $success = $this->projects_model->save_note($this->input->post(), $project_id);
            if ($success) {
                set_alert('success', _l('updated_successfuly', _l('project_note')));
            }
            redirect(admin_url('projects/view/' . $project_id . '?group=project_notes'));
        }
    }
    public function delete($project_id)
    {
        if (has_permission('projects', '', 'delete')) {
            $project = $this->projects_model->get($project_id);
            $success = $this->projects_model->delete($project_id);
            if ($success) {
                set_alert('success', _l('deleted', _l('project')));
                redirect(admin_url('projects'));
            } else {
                set_alert('warning', _l('problem_deleting', _l('project_lowercase')));
                redirect(admin_url('projects/view/' . $project_id));
            }
        }
    }
    public function copy($project_id)
    {
        if (has_permission('projects', '', 'create')) {
            $id = $this->projects_model->copy($project_id);
            if ($id) {
                set_alert('success', _l('project_copied_successfuly'));
                redirect(admin_url('projects/view/' . $id));
            } else {
                set_alert('danger', _l('failed_to_copy_project'));
                redirect(admin_url('projects/view/' . $project_id));
            }
        }
    }
    public function mass_stop_timers($project_id, $billable = 'false')
    {
        if (has_permission('invoices', '', 'create')) {
            $where = array(
                'billed' => 0,
                'startdate <=' => date('Y-m-d')
            );
            if ($billable == 'true') {
                $where['billable'] = true;
            }
            $tasks                = $this->projects_model->get_tasks($project_id, $where);
            $total_timers_stopped = 0;
            foreach ($tasks as $task) {
                $this->db->where('task_id', $task['id']);
                $this->db->where('end_time IS NULL');
                $this->db->update('tbltaskstimers', array(
                    'end_time' => time()
                ));
                $total_timers_stopped += $this->db->affected_rows();
            }
            $message = _l('project_tasks_total_timers_stopped', $total_timers_stopped);
            $type    = 'success';
            if ($total_timers_stopped == 0) {
                $type = 'warning';
            }
            echo json_encode(array(
                'type' => $type,
                'message' => $message
            ));
        }
    }
    public function get_pre_invoice_project_info($project_id)
    {
        if (has_permission('invoices', '', 'create')) {
            $data['billable_tasks']     = $this->projects_model->get_tasks($project_id, array(
                'billable' => 1,
                'billed' => 0,
                'startdate <=' => date('Y-m-d')
            ));
            $data['not_billable_tasks'] = $this->projects_model->get_tasks($project_id, array(
                'billable' => 1,
                'billed' => 0,
                'startdate >' => date('Y-m-d')
            ));
            $data['project_id']         = $project_id;
            $data['billing_type']       = get_project_billing_type($project_id);
            $this->load->model('expenses_model');
            $this->db->where('invoiceid IS NULL');
            $data['expenses'] = $this->expenses_model->get('',array('project_id'=>$project_id,'billable'=>1));

            $this->load->view('admin/projects/project_pre_invoice_settings', $data);
        }
    }
    public function get_invoice_project_data()
    {
        if (has_permission('invoices', '', 'create')) {
            $type       = $this->input->post('type');
            $project_id = $this->input->post('project_id');
            // Check for all cases
            if ($type == '') {
                $type == 'single_line';
            }
            $this->load->model('payment_modes_model');
            $data['payment_modes'] = $this->payment_modes_model->get();
            $this->load->model('taxes_model');
            $data['taxes']      = $this->taxes_model->get();
            $data['currencies'] = $this->currencies_model->get();
            $this->load->model('invoice_items_model');
            $data['items']   = $this->invoice_items_model->get();
            $data['clients'] = $this->clients_model->get();

            $data['staff']          = $this->staff_model->get('', 1);
            $project                = $this->projects_model->get($project_id);
            $data['project']        = $project;
            $data['billable_tasks'] = $this->tasks_model->get_billable_tasks();
            $items                  = array();
            $default_tax_name       = '';
            $default_tax            = explode('+', get_option('default_tax'));
            foreach ($default_tax as $tax) {
                $default_tax_name .= $tax . '+';
            }
            if ($default_tax_name != '') {
                $default_tax_name = mb_substr($default_tax_name, 0, -1);
            }
            $project         = $this->projects_model->get($project_id);
            $item['id']      = 0;
            $item['taxname'] = $default_tax_name;
            $tasks           = $this->input->post('tasks');
            if ($tasks) {
                $item['long_description'] = '';
                $item['qty']              = 0;
                $item['task_id']           = array();
                if ($type == 'single_line') {
                    $item['description'] = $project->name;
                    foreach ($tasks as $task_id) {
                        $task = $this->tasks_model->get($task_id);
                        $item['long_description'] .= $task->name . ' - ' . format_seconds($this->tasks_model->calc_task_total_time($task_id)) . "\r\n";
                        $item['task_id'][] = $task_id;
                        if ($project->billing_type == 2) {
                            $sec = $this->tasks_model->calc_task_total_time($task_id);
                            if ($sec < 60) {
                                $sec = 0;
                            }
                            $item['qty'] += sec2qty($sec);
                        }
                    }
                    if ($project->billing_type == 1) {
                        $item['qty']  = 1;
                        $item['rate'] = $project->project_cost;
                    } else if ($project->billing_type == 2) {
                        $item['rate'] = $project->project_rate_per_hour;
                    }
                    $items[] = $item;
                } else if ($type == 'task_per_item') {
                    foreach ($tasks as $task_id) {
                        $task                     = $this->tasks_model->get($task_id);
                        $item['description']      = $project->name . ' - ' . $task->name;
                        $item['qty']              = floatVal(sec2qty($this->tasks_model->calc_task_total_time($task_id)));
                        $item['long_description'] = format_seconds($this->tasks_model->calc_task_total_time($task_id));
                        if ($project->billing_type == 2) {
                            $item['rate'] = $project->project_rate_per_hour;
                        } else if ($project->billing_type == 3) {
                            $item['rate'] = $task->hourly_rate;
                        }
                        $item['task_id'] = $task_id;
                        $items[]         = $item;
                    }
                } else if ($type == 'timesheets_individualy') {
                    $timesheets     = $this->projects_model->get_timesheets($project_id, $tasks);
                    $added_task_ids = array();
                    foreach ($timesheets as $timesheet) {
                        if ($timesheet['task_data']->billed == 0 && $timesheet['task_data']->billable == 1) {
                            $item['description'] = $project->name . ' - ' . $timesheet['task_data']->name;
                            if (!in_array($timesheet['task_id'], $added_task_ids)) {
                                $item['task_id'] = $timesheet['task_id'];
                            }
                            array_push($added_task_ids, $timesheet['task_id']);
                            $item['qty']              = floatVal(sec2qty($timesheet['total_spent']));
                            $item['long_description'] = _l('project_invoice_timesheet_start_time', strftime(get_current_date_format() . ' %H:%M', $timesheet['start_time'])) . "\r\n" . _l('project_invoice_timesheet_end_time', strftime(get_current_date_format() . ' %H:%M', $timesheet['end_time'])) . "\r\n" . _l('project_invoice_timesheet_total_logged_time', format_seconds($timesheet['total_spent']));
                            if ($project->billing_type == 2) {
                                $item['rate'] = $project->project_rate_per_hour;
                            } else if ($project->billing_type == 3) {
                                $item['rate'] = $timesheet['task_data']->hourly_rate;
                            }
                            $items[] = $item;
                        }
                    }
                }
            }
            if ($project->billing_type != 1) {
                $data['hours_quantity'] = true;
            }

            if($this->input->post('expenses')){
                if(isset($data['hours_quantity'])){
                    unset($data['hours_quantity']);
                }
                if(count($tasks) > 0){
                    $data['qty_hrs_quantity'] = true;
                }
                $expenses = $this->input->post('expenses');
                $this->load->model('expenses_model');
                foreach($expenses as $expense_id){
                    // reset item array
                    $item = array();
                    $item['id'] = 0;
                    $expense = $this->expenses_model->get($expense_id);
                    $item['expense_id']           = $expense->expenseid;
                    $item['description']      = _l('item_as_expense'). ' ' .$expense->name;
                    $item['long_description'] = $expense->description;
                    $item['qty']              = 1;
                    $item['taxname']          = '';
                    if ($expense->tax != 0) {
                        $tax_data = get_tax_by_id($expense->tax);
                        $item['taxname'] = $tax_data->name . '|' . $tax_data->taxrate;
                    }
                    $item['rate']  = $expense->amount;
                    $item['order'] = 1;
                    $items[] = $item;
                }
            }
            $data['do_not_auto_toggle'] = true;
            $data['customer_id'] = $project->clientid;
            $data['invoice_from_project'] = true;
            $data['add_items'] = $items;
            $this->load->view('admin/projects/invoice_project', $data);
        }
    }
    public function get_rel_project_data($id, $task_id = '')
    {
        if ($this->input->is_ajax_request()) {
            $selected_milestone = '';
            if ($task_id != '') {
                $task               = $this->tasks_model->get($task_id);
                $selected_milestone = $task->milestone;
            }
            echo json_encode(array(
                'billing_type' => get_project_billing_type($id),
                'milestones' => render_select('milestone', $this->projects_model->get_milestones($id), array(
                    'id',
                    'name'
                ), 'task_milestone', $selected_milestone)
            ));
        }
    }
    public function invoice_project($project_id)
    {
        if (has_permission('invoices', '', 'create')) {
            $this->load->model('invoices_model');
            $data = $this->input->post();
            $data['project_id'] = $project_id;
            $invoice_id = $this->invoices_model->add($data);
            if ($invoice_id) {
                $this->projects_model->log_activity($project_id, 'project_activity_invoiced_project', format_invoice_number($invoice_id));
                set_alert('success', _l('project_invoiced_successfuly'));
            }
            redirect(admin_url('projects/view/' . $project_id . '?group=project_invoices'));
        }
    }
    public function view_project_as_client($id, $clientid)
    {
        if (has_permission('projects','','create') || has_permission('projects','','edit') || has_permission('projects','','create') || has_permission('projects','','edit') || has_permission('customers','','view') || is_customer_admin($clientid)) {
            $this->clients_model->login_as_client($clientid);
            redirect(site_url('clients/project/' . $id));
        }
    }

    public function get_contacts_by_client($id)
    {
        $contacts = $this->clients_model->get_contacts($id);
        foreach($contacts as $key => $contact){
            foreach($contact as $k => $v){
                if($k != "id" && $k != "firstname" && $k != "lastname") {
                    unset($contacts[$key][$k]);
                }
            }
        }
        echo json_encode($contacts);
    }


}
