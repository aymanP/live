<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }
    /* This is admin home view */
    public function index()
    {
        $this->load->model('departments_model');
        $this->load->model('todo_model');
        $data['departments']               = $this->departments_model->get();
        $data['todos']                     = $this->todo_model->get_todo_items(0, 8);
        $data['todos_finished']            = $this->todo_model->get_todo_items(1, 4);
        $data['upcoming_events_next_week'] = $this->home_model->get_upcoming_events_next_week();
        $data['upcoming_events']           = $this->home_model->get_upcoming_events();
        $this->load->model('tasks_model');
        $data['tasks'] = $this->tasks_model->get_user_tasks_assigned();
        $data['title']                     = _l('dashboard_string');
        $this->load->model('currencies_model');
        $data['currencies']                           = $this->currencies_model->get();
        $data['base_currency']                        = $this->currencies_model->get_base_currency();
        $data['activity_log'] = $this->misc_model->get_activity_log();
        // Tickets charts
        $data['tickets_reply_by_status']              = json_encode($this->home_model->tickets_awaiting_reply_by_status());
        $data['tickets_awaiting_reply_by_department'] = json_encode($this->home_model->tickets_awaiting_reply_by_department());
        $data['projects_status_stats']                = json_encode($this->home_model->projects_status_stats());
        $data['leads_status_stats']                   = json_encode($this->home_model->leads_status_stats());
        $data['google_ids_calendars']                 = $this->misc_model->get_google_calendar_ids();
        $data['bodyclass']                            = 'home';
        $this->load->model('announcements_model');
        $data['staff_announcements'] = $this->announcements_model->get();
        $data['is_home']             = true;
        $this->load->model('projects_model');
        $data['projects_activity'] = $this->projects_model->get_activity('', 20);
        // To load js files
        $data['calendar_assets']   = true;

        $this->load->model('estimates_model');
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();

        $this->load->model('proposals_model');
        $data['proposal_statuses'] = $this->proposals_model->get_statuses();

        $this->load->view('admin/home', $data);

    }
    /* Chart weekly payments statistics on home page / ajax */
    public function weekly_payments_statistics($currency)
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->home_model->get_weekly_payments_statistics($currency));
            die();
        }
    }
}
