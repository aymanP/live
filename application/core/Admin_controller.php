<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CRM_Controller
{
    function __construct()
    {
        parent::__construct();
        $language = load_admin_language();
        $this->load->model('authentication_model');
        $this->authentication_model->autologin();

        if (!is_staff_logged_in()) {
            if (strpos($this->uri->uri_string(), 'authentication/admin') === FALSE) {
                $this->session->set_userdata(array(
                    'red_url' => $this->uri->uri_string()
                ));
            }

            redirect(site_url('authentication/admin'));
        }
        if(is_admin() && ENVIRONMENT == 'production'){
            if($this->config->item('encryption_key') === ''){
                die('<h1>Encryption key not sent in application/config/config.php</h1>For more info visit <a href="http://www.perfexcrm.com/knowledgebase/encryption-key/">Encryption key explained</a>');
            } else if(strlen($this->config->item('encryption_key')) != 32){
                die('<h1>Encryption key length should be 32 charachters</h1>For more info visit <a href="http://www.perfexcrm.com/knowledgebase/encryption-key/">Encryption key explained</a>');
            }
        }
       // In case staff have setup logged in as client - This is important dont change it
        $this->session->unset_userdata('client_user_id');
        $this->session->unset_userdata('client_logged_in');
        $this->session->unset_userdata('logged_in_as_client');

        add_action('before_start_render_dashboard_content','show_just_updated_message');

        $this->load->model('staff_model');
        $this->init_quick_actions_links();

        $this->load->vars(array(
            '_staff' => $this->staff_model->get(get_staff_user_id()),
            '_notifications' => $this->misc_model->get_user_notifications(false),
            '_quick_actions' => $this->perfex_base->get_quick_actions_links(),
            '_started_timers' => $this->misc_model->get_staff_started_timers(),
            'google_api_key' => get_option('google_api_key'),
            'total_pages_newsfeed'=>total_rows('tblposts') / 10,
            'locale'=>get_locale_key($language),
            'tinymce_lang'=>get_tinymce_language(get_locale_key($language)),
            '_pinned_projects'=>$this->get_pinned_projects(),
            'total_undismissed_announcements'=>$this->get_total_undismissed_announcements(),
            'current_version'=>$this->db->get('tblmigrations')->row()->version,
            'tasks_filter_assignees'=>$this->get_tasks_distinct_assignees(),
        ));

        $this->load->library('user_agent');
        if ($this->agent->is_mobile()) {
            $this->session->set_userdata(array(
                'is_mobile' => true
            ));
        } else {
            $this->session->unset_userdata('is_mobile');
        }
    }
    public function get_tasks_distinct_assignees(){
        return $this->misc_model->get_tasks_distinct_assignees();
    }
    private function get_total_undismissed_announcements(){
        $this->load->model('announcements_model');
        return $this->announcements_model->get_total_undismissed_announcements();
    }
    private function get_pinned_projects(){
        $this->db->select('tblprojects.id,tblprojects.name');
        $this->db->join('tblprojects','tblprojects.id=tblpinnedprojects.project_id');
        $this->db->where('tblpinnedprojects.staff_id',get_staff_user_id());
        $projects = $this->db->get('tblpinnedprojects')->result_array();
        $i = 0;
        $this->load->model('projects_model');
        foreach($projects as $project){
            $projects[$i]['progress'] = $this->projects_model->calc_progress($project['id']);
            $i++;
        }

        return $projects;
    }
    private function init_quick_actions_links()
    {

        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('qa_create_invoice'),
            'permission' => 'invoices',
            'url' => 'invoices/invoice'
        ));

        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('qa_create_estimate'),
            'permission' => 'estimates',
            'url' => 'estimates/estimate'
        ));

        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('qa_new_expense'),
            'permission' => 'expenses',
            'url' => 'expenses/expense'
        ));

        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('new_proposal'),
            'permission' => 'proposals',
            'url' => 'proposals/proposal'
        ));

        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('new_project'),
            'url' => 'projects/project',
            'permission' => 'projects',
        ));


        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('qa_create_task'),
            'url' => '#',
            'custom_url'=>true,
            'href_attributes'=>array('onclick'=>'new_task();return false;'),
            'permission' => 'tasks',
        ));

        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('qa_create_client'),
            'permission' => 'customers',
            'url' => 'clients/client'
        ));

        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('qa_create_contract'),
            'permission' => 'contracts',
            'url' => 'contracts/contract'
        ));

        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('qa_create_lead'),
            'url' => '#',
            'custom_url'=>true,
            'permission'=>'is_staff_member',
            'href_attributes'=>array('onclick'=>'init_lead(); return false;'),
        ));

        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('qa_new_goal'),
            'url' => 'goals/goal',
            'permission' => 'goals'
        ));

        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('qa_create_kba'),
            'permission' => 'knowledge_base',
            'url' => 'knowledge_base/article'
        ));

        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('qa_create_survey'),
            'permission' => 'surveys',
            'url' => 'surveys/survey'
        ));

        $tickets = array(
            'name' => _l('qa_create_ticket'),
            'url' => 'tickets/add'
        );
        if(get_option('access_tickets_to_none_staff_members') == 0 && !is_staff_member()){
            $tickets['permission'] = 'is_staff_member';
        }
        $this->perfex_base->add_quick_actions_link($tickets);

        $this->perfex_base->add_quick_actions_link(array(
            'name' => _l('qa_create_staff'),
            'url' => 'staff/member',
            'permission' => 'staff'
        ));

    }
}
