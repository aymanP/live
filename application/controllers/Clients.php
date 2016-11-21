<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clients extends Clients_controller
{
    function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters('<div class="text-danger alert-validation">', '</div>');
    }
    public function index()
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $data['is_home'] = true;
        $this->load->model('reports_model');
        $data['payments_years'] = $this->reports_model->get_distinct_customer_invoices_years();

        $data['title']   = get_option('companyname');
        $this->data      = $data;
        $this->view      = 'home';
        $this->layout();
    }
    public function announcements(){
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $data['title'] = _l('announcements');
        $data['announcements'] = $this->announcements_model->get();
        $this->data = $data;
        $this->view = 'announcements';
        $this->layout();
    }
    public function announcement($id){
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->model('invoices_model');
        $data['mode'] = $this->invoices_model->get_mode(get_client_user_id());
        $data['alami'] = $this->invoices_model->mode_alami();

        $data['announcement'] = $this->announcements_model->get($id);
        $data['title'] =$data['announcement']->name;
        $this->data = $data;
        $this->view = 'announcement';
        $this->layout();
    }
    public function projects($status = '')
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        if (!has_contact_permission('projects')) {
            redirect(site_url());
        }

        $contact_id = get_contact_user_id();
        $where = array(
            'clientid' => get_client_user_id()
        );

        if(is_numeric($status)){
            $where['status'] = $status;
        }
        $this->load->model(Clients_model);
        $data['projects'] = $this->Clients_model->get_project($contact_id);
        $data['title']    = _l('clients_my_projects');
        $this->data       = $data;
        $this->view       = 'projects';
        $this->layout();
    }
    public function project($id)
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        if (!has_contact_permission('projects')) {
            redirect(site_url());
        }
        $project         = $this->projects_model->get($id, array(
            'clientid' => get_client_user_id()
        ));
        $data['project'] = $project;
        $data['title']   = $data['project']->name;
        if ($this->input->post('action')) {
            $action = $this->input->post('action');
            switch ($action) {
                case 'discussion_comments':
                 //   var_dump($this->projects_model->get_discussion_comments($this->input->post('discussion_id')));
                    echo json_encode($this->projects_model->get_discussion_comments($this->input->post('discussion_id')));
                    die;
                case 'new_discussion_comment':
                    echo json_encode($this->projects_model->add_discussion_comment($this->input->post(), $this->input->post('discussion_id')));
                    die;
                    break;
                case 'update_discussion_comment':
                    echo json_encode($this->projects_model->update_discussion_comment($this->input->post(), $this->input->post('discussion_id')));
                    die;
                    break;
                case 'delete_discussion_comment':
                    echo json_encode($this->projects_model->delete_discussion_comment($this->input->post('id')));
                    die;
                    break;
                case 'new_discussion':
                    $data = $this->input->post();
                    unset($data['action']);
                    $success = $this->projects_model->add_discussion($data);
                    if ($success) {
                        set_alert('success', _l('added_successfuly', _l('project_discussion')));
                    }
                    redirect(site_url('clients/project/' . $id . '?group=project_discussions'));
                    break;
                case 'upload_file':
                    handle_project_file_uploads($id);
                    die;
                    break;
                case 'upload_task_file':
                    $taskid = $this->input->post('task_id');
                    $file   = handle_tasks_attachments($taskid);
                    if ($file) {
                        $this->tasks_model->add_attachment_to_database($taskid, $file);
                    }
                    die;
                    break;
                case 'new_task_comment':
                    $data    = $this->input->post();
                    $success = $this->tasks_model->add_task_comment($data);
                    if ($success) {
                        set_alert('success', _l('task_comment_added'));
                    }
                    redirect(site_url('clients/project/' . $id . '?group=project_tasks&taskid=' . $data['taskid']));
                    break;
                default:
                    redirect(site_url('clients/project/' . $id));
                    break;
            }
        }
        if (!$this->input->get('group')) {
            $group = 'project_overview';
        } else {
            $group = $this->input->get('group');
        }
        if ($this->input->get('taskid')) {
            $data['view_task'] = $this->tasks_model->get($this->input->get('taskid'), array(
                'rel_id' => $project->id,
                'rel_type' => 'project'
            ));
        }
        $data['currency'] = $this->projects_model->get_currency($id);
        $percent          = $this->projects_model->calc_progress($id);
        @$data['percent'] = $percent / 100;
        $data['group']       = $group;
        $data['invoices']    = $this->invoices_model->get('', array(
            'clientid' => get_client_user_id(),
            'project_id' => $id
        ));
        $data['members']     = $this->projects_model->get_project_members($id);
        $data['milestones']  = $this->projects_model->get_milestones($id);
        $data['gantt_data']  = $this->projects_model->get_gantt_data($id);
        $data['discussions'] = $this->projects_model->get_discussions($id);
        $data['files']       = $this->projects_model->get_files($id);

        $this->load->helper('date');
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
        $this->load->model('invoices_model');
        $data['activity']   = $this->projects_model->get_activity($id);
        $data['mode'] = $this->invoices_model->get_mode(get_client_user_id());
        $data['alami'] = $this->invoices_model->mode_alami();
        $data['timesheets'] = $this->projects_model->get_timesheets($id);
        $data['tasks']      = $this->projects_model->get_tasks($id);
        if ($this->input->get('discussion_id')) {
            $data['discussion_user_profile_image_url'] = contact_profile_image_url(get_contact_user_id());
            $data['discussion']                        = $this->projects_model->get_discussion($this->input->get('discussion_id'), $id);
            $data['current_user_is_admin']             = false;
        }

        $data['tickets'] = $this->tickets_model->get('',array('tbltickets.userid'=>get_client_user_id(),'project_id'=>$id));
        $data['estimates'] = $this->estimates_model->get('', array(
            'clientid' => get_client_user_id(),
            'project_id' => $id
        ));
        $data['project_tasks'] = $this->projects_model->get_tasks($id);
        $this->data            = $data;
        $this->view            = 'project';
        $this->layout();
    }
    public function remove_task_comment($id)
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        echo json_encode(array(
            'success' => $this->tasks_model->remove_comment($id)
        ));
    }
    public function edit_comment()
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        if ($this->input->post()) {
            $success = $this->tasks_model->edit_comment($this->input->post());
            if ($success) {
                set_alert('success', _l('task_comment_updated'));
            }
            echo json_encode(array(
                'success' => $success
            ));
        }
    }
    public function tickets($status = '')
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        if (!has_contact_permission('support')) {
            redirect(site_url());
        }
        $where = array(
            'tbltickets.userid' => get_client_user_id()
        );
        if (is_numeric($status)) {
            $where['status'] = $status;
        }
        $data['bodyclass'] = 'tickets';
        $data['tickets']   = $this->tickets_model->get('', $where);
        $data['title']     = _l('clients_tickets_heading');
        $this->data        = $data;
        $this->view        = 'tickets';
        $this->layout();
    }
    public function change_ticket_status(){
        if(is_client_logged_in()){
            $post_data = $this->input->post();
            $response = $this->tickets_model->change_ticket_status($post_data['ticket_id'],$post_data['status_id']);
            set_alert('alert-'.$response['alert'],$response['message']);
        }
    }
    public function viewproposal($id, $hash)
    {
        check_proposal_restrictions($id, $hash);
        $proposal = $this->proposals_model->get($id);
        if ($proposal->rel_type == 'customer' && !is_client_logged_in()) {
            load_client_language($proposal->rel_id);
        }
        if ($this->input->post()) {
            $action = $this->input->post('action');
            switch ($action) {
                case 'proposal_pdf':
                    $pdf = proposal_pdf($proposal);
                    $pdf->Output(slug_it($proposal->subject) . '.pdf', 'D');
                    break;
                case 'proposal_comment':
                    // comment is blank
                    if (!$this->input->post('content')) {
                        redirect($this->uri->uri_string());
                    }
                    $data               = $this->input->post();
                    $data['proposalid'] = $id;
                    $this->proposals_model->add_comment($data, true);
                    redirect($this->uri->uri_string());
                    break;
                case 'accept_proposal':
                    $success = $this->proposals_model->mark_action_status(3, $id, true);
                    if ($success) {
                        redirect($this->uri->uri_string(), 'refresh');
                    }
                    break;
                case 'decline_proposal':
                    $success = $this->proposals_model->mark_action_status(2, $id, true);
                    if ($success) {
                        redirect($this->uri->uri_string(), 'refresh');
                    }
                    break;
            }
        }
        $this->use_footer     = false;
        $this->use_navigation = false;
        $data['title']        = $proposal->subject;
        $data['proposal']     = $proposal;
        $data['bodyclass']     = 'proposal proposal-view';
        $data['comments']     = $this->proposals_model->get_comments($id);
        add_views_tracking('proposal', $id);
        $this->data = $data;
        $this->view = 'viewproposal';
        $this->layout();
        //$this->load->view('themes/' . active_clients_theme() . '/views/viewproposal', $data);
    }
    public function proposals()
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        if (!has_contact_permission('proposals')) {
            redirect(site_url());
        }
        $data['proposals'] = $this->proposals_model->get('', array(
            'rel_id' => get_client_user_id(),
            'rel_type' => 'customer'
        ));
        $data['title']     = _l('proposals');
        $this->data        = $data;
        $this->view        = 'proposals';
        $this->layout();
    }
    public function open_ticket()
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        if (!has_contact_permission('support')) {
            redirect(site_url());
        }
        if ($this->input->post()) {

            $this->form_validation->set_rules('subject', _l('customer_ticket_subject'), 'required');
            $this->form_validation->set_rules('department', _l('clients_ticket_open_departments'), 'required');
            $this->form_validation->set_rules('priority', _l('priority'), 'required');
            $custom_fields = get_custom_fields('tickets', array(
                'show_on_client_portal' => 1,
                'required' => 1
            ));
            foreach ($custom_fields as $field) {
                $this->form_validation->set_rules('custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']', $field['name'], 'required');
            }
            if ($this->form_validation->run() !== FALSE) {
                  $id = $this->tickets_model->add($this->input->post());
            if ($id) {
                $attachments = handle_ticket_attachments($id);
                if ($attachments) {
                    $this->tickets_model->insert_ticket_attachments_to_database($attachments, $id);
                }
                set_alert('success', _l('new_ticket_added_succesfuly', $id));
                redirect(site_url('clients/ticket/' . $id));
            }
            }
        }
        $data                   = array();
        $data['latest_tickets'] = $this->tickets_model->get_client_latests_ticket();
        $data['projects'] = $this->projects_model->get_projects_for_ticket(get_client_user_id());
        $data['title']          = _l('new_ticket');
        $this->data             = $data;
        $this->view             = 'open_ticket';
        $this->layout();
    }
    public function ticket($id)
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        if (!has_contact_permission('support')) {
            redirect(site_url());
        }
        if (!$id) {
            redirect(site_url());
        }
        if ($this->input->post()) {
            $this->form_validation->set_rules('message', _l('ticket_reply'), 'required');
                if($this->form_validation->run() !== false){
                $replyid     = $this->tickets_model->add_reply($this->input->post(), $id, NULL);
                $attachments = handle_ticket_attachments($id);
                if ($attachments) {
                    $this->tickets_model->insert_ticket_attachments_to_database($attachments, $id, $replyid);
                }
                if ($replyid) {
                    set_alert('success', _l('replied_to_ticket_succesfuly', $id));
                    redirect(site_url('clients/ticket/' . $id));
                }
            }
        }
        $data['ticket'] = $this->tickets_model->get_ticket_by_id($id, get_client_user_id());
        if ($data['ticket']->userid != get_client_user_id()) {
            redirect(site_url());
        }
        $this->load->model('payments_model');
        $data['mode']=$this->invoices_model->get_mode(get_client_user_id());
        $data['alami'] = $this->invoices_model->mode_alami();
        $data['ticket_replies'] = $this->tickets_model->get_ticket_replies($id);
        $data['title']          = $data['ticket']->subject;
        $this->data             = $data;
        $this->view             = 'single_ticket';
        $this->layout();
    }
    public function contracts()
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        if (!has_contact_permission('contracts')) {
            redirect(site_url());
        }
        $this->load->model('contracts_model');
        $data['contracts'] = $this->contracts_model->get('', array(
            'client' => get_client_user_id(),
            'not_visible_to_client' => 0,
            'trash' => 0
        ));

        $data['contracts_by_type_chart'] = json_encode($this->contracts_model->get_contracts_types_chart_data());
        $data['title']     = _l('clients_contracts');
        $this->data        = $data;
        $this->view        = 'contracts';
        $this->layout();
    }
    public function contract_pdf($id)
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->load->model('contracts_model');
        $contract = $this->contracts_model->get($id, array(
            'client' => get_client_user_id(),
            'not_visible_to_client' => 0,
            'trash' => 0
        ));
        $pdf      = contract_pdf($contract);
        $pdf->Output(slug_it($contract->subject) . '.pdf', 'D');
    }
    public function invoices($status = false)
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        if (!has_contact_permission('invoices')) {
            redirect(site_url());
        }
        $where = array(
            'clientid' => get_client_user_id()
        );
        if (is_numeric($status)) {
            $where['status'] = $status;
        }
        $data['invoices'] = $this->invoices_model->get('', $where);
        $data['title']    = _l('clients_my_invoices');
        $this->data       = $data;
        $this->view       = 'invoices';
        $this->layout();
    }
    public function viewinvoice($id = '', $hash = '')
    {
        check_invoice_restrictions($id, $hash);
        $invoice = $this->invoices_model->get($id);

        if (!is_client_logged_in()) {
            load_client_language($invoice->clientid);
        }
        // Handle Invoice PDF generator
        if ($this->input->post('invoicepdf')) {
            $pdf            = invoice_pdf($invoice);
            $invoice_number = format_invoice_number($invoice->id);
            $companyname    = get_option('invoice_company_name');
            if ($companyname != '') {
                $invoice_number .= '-' . mb_strtoupper(slug_it($companyname));
            }
            $pdf->Output(mb_strtoupper(slug_it($invoice_number)) . '.pdf', 'D');
            die();
        }
        // Handle $_POST payment
        if ($this->input->post('make_payment')) {
            $this->load->model('payments_model');
            if (!$this->input->post('paymentmode')) {
                set_alert('warning', _l('invoice_html_payment_modes_not_selected'));
                redirect(site_url('viewinvoice/' . $id . '/' . $hash));
            } else if ((!$this->input->post('amount') || $this->input->post('amount') == 0) && get_option('allow_payment_amount_to_be_modified') == 1) {
                set_alert('warning', _l('invoice_html_amount_blank'));
                redirect(site_url('viewinvoice/' . $id . '/' . $hash));
            }
            $this->payments_model->process_payment($this->input->post(), $id);
        }
        if ($this->input->post('paymentpdf')) {
            $id                    = $this->input->post('paymentpdf');
            $payment               = $this->payments_model->get($id);
            $payment->invoice_data = $this->invoices_model->get($payment->invoiceid);
            $paymentpdf            = payment_pdf($payment);
            $paymentpdf->Output(mb_strtoupper(slug_it(_l('payment') . '-' . $payment->paymentid)) . '.pdf', 'D');
            die;
        }
        $this->load->library('numberword',array('clientid'=>$invoice->clientid));
        $this->load->model('payment_modes_model');
        $this->load->model('payments_model');
        $data['mode']=$this->invoices_model->get_mode($invoice->clientid);
        $data['alami'] = $this->invoices_model->mode_alami();

        $data['payments']      = $this->payments_model->get_invoice_payments($id);
        $data['payment_modes'] = $this->payment_modes_model->get();
        $data['title']         = format_invoice_number($invoice->id);
        $this->use_navigation  = false;
        $data['hash']          = $hash;
        $data['invoice']       = $invoice;

        $data['bodyclass']     = 'viewinvoice';
        $this->data            = $data;
        $this->view            = 'invoicehtml';
        add_views_tracking('invoice', $id);
        $this->layout();
    }
    public function viewestimate($id, $hash)
    {
        check_estimate_restrictions($id, $hash);
        $estimate = $this->estimates_model->get($id);
        if (!is_client_logged_in()) {
            load_client_language($estimate->clientid);
        }
        if ($this->input->post('estimate_action')) {
            $action = $this->input->post('estimate_action');
            // Only decline and accept allowed
            if ($action == 4 || $action == 3) {
                $success = $this->estimates_model->mark_action_status($action, $id, true);
                if (is_array($success) && $success['invoiced'] == true) {
                    $invoice = $this->invoices_model->get($success['invoiceid']);
                    set_alert('success', _l('clients_estimate_invoiced_successfuly'));
                    redirect(site_url('viewinvoice/' . $invoice->id . '/' . $invoice->hash));
                } else if (is_array($success) && $success['invoiced'] == false || $success === true) {
                    if ($action == 4) {
                        set_alert('success', _l('clients_estimate_accepted_not_invoiced'));
                    } else {
                        set_alert('success', _l('clients_estimate_declined'));
                    }
                } else {
                    set_alert('warning', _l('clients_estimate_failed_action'));
                }
            }
            redirect($this->uri->uri_string());
        }
        // Handle Estimate PDF generator
        if ($this->input->post('estimatepdf')) {
            $pdf             = estimate_pdf($estimate);
            $estimate_number = format_estimate_number($estimate->id);
            $companyname     = get_option('invoice_company_name');
            if ($companyname != '') {
                $estimate_number .= '-' . mb_strtoupper(slug_it($companyname));
            }
            $pdf->Output(mb_strtoupper(slug_it($estimate_number)) . '.pdf', 'D');
            die();
        }
        $this->load->library('numberword',array('clientid'=>$estimate->clientid));
        $this->load->model('invoices_model');
        $data['mode']=$this->invoices_model->get_mode($estimate->clientid);
        $data['alami'] = $this->invoices_model->mode_alami();
        $data['title']        = format_estimate_number($estimate->id);
        $this->use_navigation = false;
        $data['hash']         = $hash;
        $data['estimate']     = $estimate;
        $data['bodyclass']    = 'viewestimate';
        $this->data           = $data;
        $this->view           = 'estimatehtml';
        add_views_tracking('estimate', $id);
        $this->layout();
    }
    public function estimates($status = '')
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        if (!has_contact_permission('estimates')) {
            redirect(site_url());
        }
        $where             = array(
            'clientid' => get_client_user_id()
        );
        if(is_numeric($status)){
            $where['status'] = $status;
        }
        if(isset($where['status'])){
            if($where['status'] == 1 && get_option('exclude_estimate_from_client_area_with_draft_status') == 1){
                unset($where['status']);
                $where['status !=']= 1;
            }
        } else {
            if(get_option('exclude_estimate_from_client_area_with_draft_status') == 1){
                $where['status !='] = 1;
            }
        }
        $data['estimates'] = $this->estimates_model->get('', $where);
        $data['title']     = _l('clients_my_estimates');
        $this->data        = $data;
        $this->view        = 'estimates';
        $this->layout();
    }
    public function survey($id, $hash)
    {
        if (!$hash || !$id) {
            die('No survey specified');
        }
        $this->load->model('surveys_model');
        $survey = $this->surveys_model->get($id);
        if (!$survey || ($survey->hash != $hash)) {
            show_404();
        }
        if ($survey->active == 0) {
            // Allow users with permission manage surveys to preview the survey even if is not active
            if (!has_permission('surveys', '', 'view')) {
                die('Survey not active');
            }
        }
        // Check if survey is only for logged in participants / staff / clients
        if ($survey->onlyforloggedin == 1) {
            if (!is_logged_in()) {
                die('This survey is only for logged in users');
            }
        }
        // Ip Restrict check
        if ($survey->iprestrict == 1) {
            $this->db->where('surveyid', $id);
            $this->db->where('ip', $this->input->ip_address());
            $total = $this->db->count_all_results('tblsurveyresultsets');
            if ($total > 0) {
                die('Already participated on this survey. Thanks');
            }
        }
        if ($this->input->post()) {
            $success = $this->surveys_model->add_survey_result($id, $this->input->post());
            if ($success) {
                $survey = $this->surveys_model->get($id);
                if ($survey->redirect_url !== '') {
                    redirect($survey->redirect_url);
                }
                set_alert('success', 'Thank you for participating in this survey. Your answers are very important to us.');
                $default_redirect = do_action('survey_default_redirect', site_url());
                redirect($default_redirect);
            }
        }
        $this->use_navigation = false;
        $data['survey']       = $survey;
        $data['title']        = $data['survey']->subject;
        $this->data           = $data;
        $this->view           = 'survey_view';
        $this->layout();
    }
    public function company()
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        if ($this->input->post()) {
            $this->form_validation->set_rules('company', _l('clients_company'), 'required');
            $custom_fields = get_custom_fields('customers', array(
                'show_on_client_portal' => 1,
                'required' => 1
            ));
            foreach ($custom_fields as $field) {
                $this->form_validation->set_rules('custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']', $field['name'], 'required');
            }
            if ($this->form_validation->run() !== FALSE) {
                $data    = $this->input->post();
                $success = $this->clients_model->update_company_details($data, get_client_user_id());
                if ($success == true) {
                    set_alert('success', _l('clients_profile_updated'));
                }
                redirect(site_url('clients/company'));
            }
        }
        $data['title'] = _l('client_company_info');
        $this->data    = $data;
        $this->view    = 'company_profile';
        $this->layout();
    }
    public function profile()
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        if ($this->input->post('profile')) {
            $this->form_validation->set_rules('firstname', _l('client_firstname'), 'required');
            $this->form_validation->set_rules('lastname', _l('client_lastname'), 'required');
            $custom_fields = get_custom_fields('contacts', array(
                'show_on_client_portal' => 1,
                'required' => 1
            ));
            foreach ($custom_fields as $field) {
                $this->form_validation->set_rules('custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']', $field['name'], 'required');
            }
            if ($this->form_validation->run() !== FALSE) {
                handle_contact_profile_image_upload();
                $data = $this->input->post();
                // Unset the form indicator so we wont send it to the model
                unset($data['profile']);
                $success = $this->clients_model->update_contact($data, get_contact_user_id(), true);
                if ($success == true) {
                    set_alert('success', _l('clients_profile_updated'));
                }
                redirect(site_url('clients/profile'));
            }
        } else if ($this->input->post('change_password')) {
            $this->form_validation->set_rules('oldpassword', _l('clients_edit_profile_old_password'), 'required');
            $this->form_validation->set_rules('newpassword', _l('clients_edit_profile_new_password'), 'required');
            $this->form_validation->set_rules('newpasswordr', _l('clients_edit_profile_new_password_repeat'), 'required|matches[newpassword]');
            if ($this->form_validation->run() !== FALSE) {
                $success = $this->clients_model->change_contact_password($this->input->post());
                if (is_array($success) && isset($success['old_password_not_match'])) {
                    set_alert('danger', _l('client_old_password_incorect'));
                } else if ($success == true) {
                    set_alert('success', _l('client_password_changed'));
                }
                redirect(site_url('clients/profile'));
            }
        }
        $data['title'] = _l('clients_profile_heading');
        $this->data    = $data;
        $this->view    = 'profile';
        $this->layout();
    }
    public function remove_profile_image()
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        do_action('before_remove_contact_profile_image');
        if (file_exists(CLIENT_PROFILE_IMAGES_FOLDER . get_contact_user_id())) {
            delete_dir(CLIENT_PROFILE_IMAGES_FOLDER . get_contact_user_id());
        }
        $this->db->where('id', get_contact_user_id());
        $this->db->update('tblcontacts', array(
            'profile_image' => NULL
        ));
        if ($this->db->affected_rows() > 0) {
            redirect(site_url('clients/profile'));
        }
    }
    public function register()
    {
        if (get_option('allow_registration') != 1 || is_client_logged_in()) {
            redirect(site_url());
        }
        $this->form_validation->set_rules('company', _l('client_company'), 'required');
        $this->form_validation->set_rules('firstname', _l('client_firstname'), 'required');
        $this->form_validation->set_rules('lastname', _l('client_lastname'), 'required');
        $this->form_validation->set_rules('email', _l('client_email'), 'required|is_unique[tblcontacts.email]|valid_email');
        $this->form_validation->set_rules('password', _l('clients_register_password'), 'required');
        $this->form_validation->set_rules('passwordr', _l('clients_register_password_repeat'), 'required|matches[password]');

        if(get_option('use_recaptcha_customers_area') == 1 && get_option('recaptcha_secret_key') != '' && get_option('recaptcha_site_key') != '' && is_connected('google.com')){
             $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'callback_recaptcha');
        }

        $custom_fields          = get_custom_fields('customers', array(
            'show_on_client_portal' => 1,
            'required' => 1
        ));
        $custom_fields_contacts = get_custom_fields('contacts', array(
            'show_on_client_portal' => 1,
            'required' => 1
        ));
        foreach ($custom_fields as $field) {
            $this->form_validation->set_rules('custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']', $field['name'], 'required');
        }
        foreach ($custom_fields_contacts as $field) {
            $this->form_validation->set_rules('custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']', $field['name'], 'required');
        }

        if ($this->form_validation->run() !== FALSE) {
            if ($this->input->post()) {
                $data = $this->input->post();
                // Unset recaptchafield
                if(isset($data['g-recaptcha-response'])){
                    unset($data['g-recaptcha-response']);
                }
                $clientid = $this->clients_model->add($data, true);
                if ($clientid) {
                    $this->load->model('authentication_model');
                    $logged_in = $this->authentication_model->login($this->input->post('email'), $this->input->post('password'), false, false);
                    if ($logged_in) {
                        set_alert('success', _l('clients_successfully_registered'));
                    } else {
                        set_alert('warning', _l('clients_account_created_but_not_logged_in'));
                        redirect(site_url('clients/login'));
                    }
                    redirect(site_url());
                }
            }
        }
        $data['title'] = _l('clients_register_heading');
        $this->data    = $data;
        $this->view    = 'register';
        $this->auth_layout();
    }

    public function forgot_password()
    {
        if (is_client_logged_in()) {
            redirect(site_url());
        }
        $this->form_validation->set_rules('email', _l('customer_forgot_password_email'), 'required|valid_email|callback_contact_email_exists');
        if ($this->input->post()) {
            if ($this->form_validation->run() !== false) {
                $this->load->model('Authentication_model');
                $success = $this->Authentication_model->forgot_password($this->input->post('email'));
                if (is_array($success) && isset($success['memberinactive'])) {
                    set_alert('danger', _l('inactive_account'));
                } else if ($success == true) {
                    set_alert('success', _l('check_email_for_reseting_password'));
                } else {
                    set_alert('danger', _l('error_setting_new_password_key'));
                }
                redirect(site_url('clients/login'));
            }
        }
        $data['title'] = _l('customer_forgot_password');
        $this->data = $data;
        $this->view = 'forgot_password';

        $this->auth_layout();
    }
    public function reset_password($staff, $userid, $new_pass_key)
    {
        $this->load->model('Authentication_model');
        if (!$this->Authentication_model->can_reset_password($staff, $userid, $new_pass_key)) {
            set_alert('danger', _l('password_reset_key_expired'));
            redirect(site_url('clients/login'));
        }
        $this->form_validation->set_rules('password', _l('customer_reset_password'), 'required');
        $this->form_validation->set_rules('passwordr', _l('customer_reset_password_repeat'), 'required|matches[password]');
        if ($this->input->post()) {
            if ($this->form_validation->run() !== false) {
                do_action('before_user_reset_password', array(
                    'staff' => $staff,
                    'userid' => $userid
                ));
                $success = $this->Authentication_model->reset_password(0, $userid, $new_pass_key, $this->input->post('passwordr'));
                if (is_array($success) && $success['expired'] == true) {
                    set_alert('danger', _l('password_reset_key_expired'));
                } else if ($success == true) {
                    do_action('after_user_reset_password', array(
                        'staff' => $staff,
                        'userid' => $userid
                    ));
                    set_alert('success', _l('password_reset_message'));
                } else {
                    set_alert('danger', _l('password_reset_message_fail'));
                }
                redirect(site_url('clients/login'));
            }
        }
        $this->view = 'reset_password';
        $this->auth_layout();
    }
    public function dismiss_announcement($id)
    {
        if (!is_client_logged_in()) {
            redirect(site_url('clients/login'));
        }
        $this->misc_model->dismiss_announcement($id, false);
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function knowledge_base($slug = '')
    {
        if ((get_option('use_knowledge_base') == 1 && !is_client_logged_in() && get_option('knowledge_base_without_registration') == 1) || (get_option('use_knowledge_base') == 1 && is_client_logged_in())) {
            // This is for did you find this answer useful
            if (($this->input->post() && $this->input->is_ajax_request())) {
                echo json_encode($this->knowledge_base_model->add_article_answer($this->input->post()));
                die();
            }
            $data = array();
            if ($slug == '' || $this->input->get('groupid')) {
                $data['title'] = _l('clients_knowledge_base');
                $this->view    = 'knowledge_base';
            } else {
                $data['article'] = $this->knowledge_base_model->get(false, $slug);
                if($data['article']){
                    $data['related_articles'] = $this->knowledge_base_model->get_related_articles($data['article']->articleid);
                    add_views_tracking('kb_article', $data['article']->articleid);
                    if ($data['article']->active_article == 0) {
                        redirect(site_url('knowledge_base'));
                    }
                    $data['title'] = $data['article']->subject;

                    $this->view    = 'knowledge_base_article';
                } else {
                    show_404();
                }
            }
            $this->data = $data;
            $this->layout();
        } else {
            redirect(site_url());
        }
    }
    public function login()
    {
        if (is_client_logged_in()) {
            redirect(site_url());
        }
        $this->form_validation->set_rules('password',_l('clients_login_password'),'required');
        $this->form_validation->set_rules('email',_l('clients_login_email'),'required|valid_email');
        if(get_option('use_recaptcha_customers_area') == 1 && get_option('recaptcha_secret_key') != '' && get_option('recaptcha_site_key') != '' && is_connected('google.com')){
             $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'callback_recaptcha');
        }
        if ($this->form_validation->run() !== FALSE) {
            $this->load->model('Authentication_model');
            $success = $this->Authentication_model->login($this->input->post('email'), $this->input->post('password'), $this->input->post('remember'), false);
            if (is_array($success) && isset($success['memberinactive'])) {
                set_alert('danger', _l('inactive_account'));
                redirect(site_url('clients/login'));
            } else if ($success == false) {
                set_alert('danger', _l('client_invalid_username_or_password'));
                redirect(site_url('clients/login'));
              //  $this->load->view('clients','login');
            }
            do_action('after_contact_login');
            redirect(site_url());
        }
        if (get_option('allow_registration') == 1) {
            $data['title'] = _l('clients_login_heading_register');
        } else {
            $data['title'] = _l('clients_login_heading_no_register');
        }
        $this->data = $data;
        $this->view = 'login';
        $this->auth_layout();
    }
    public function logout()
    {
        $this->load->model('authentication_model');
        $this->authentication_model->logout(false);
        redirect(site_url('clients/login'));
    }
    public function contact_email_exists($email = '')
    {
        if ($email == '') {
            $email = $this->input->post('email');
        }
        $this->db->where('email', $email);
        $total_rows = $this->db->count_all_results('tblcontacts');
        if ($this->input->post() && $this->input->is_ajax_request()) {
            if ($total_rows > 0) {
                echo json_encode(false);
            } else {
                echo json_encode(true);
            }
            die();
        } else if ($this->input->post()) {
            if ($total_rows == 0) {
                $this->form_validation->set_message('contact_email_exists', _l('auth_reset_pass_email_not_found'));
                return false;
            }
            return true;
        }
    }
    /**
     * Client home chart
     * @return mixed
     */
    public function client_home_chart()
    {
        if (is_client_logged_in()) {
            $statuses        = array(
                1,
                2,
                4,
                3,
            );
            $months          = array();
            $months_original = array();
            for ($m = 1; $m <= 12; $m++) {
                array_push($months, _l(date('F', mktime(0, 0, 0, $m, 1))));
                array_push($months_original, date('F', mktime(0, 0, 0, $m, 1)));
            }
            $chart = array(
                'labels' => $months,
                'datasets' => array()
            );
            foreach ($statuses as $status) {

                $this->db->select('total as amount, date');
                $this->db->from('tblinvoices');
                $this->db->where('clientid', get_client_user_id());
                $this->db->where('status', $status);
                $by_currency = $this->input->post('report_currency');
                if ($by_currency) {
                    $this->db->where('currency', $by_currency);
                }
                if($this->input->post('year')){
                    $this->db->where('YEAR(tblinvoices.date)', $this->input->post('year'));
                }
                $payments      = $this->db->get()->result_array();
                $data          = array();
                $data['temp']  = $months_original;
                $data['total'] = array();
                $i             = 0;
                foreach ($months_original as $month) {
                    $data['temp'][$i] = array();
                    foreach ($payments as $payment) {
                        $_month = date('F', strtotime($payment['date']));
                        if ($_month == $month) {
                            $data['temp'][$i][] = $payment['amount'];
                        }
                    }
                    $data['total'][] = array_sum($data['temp'][$i]);
                    $i++;
                }
                if ($status == 1) {
                    $borderColor = '#fc142b';
                } else if ($status == 2) {
                    $borderColor = '#84c529';
                } else if ($status == 4) {
                    $borderColor = '#ff6f00';
                }
                array_push($chart['datasets'], array(
                    'label' => format_invoice_status($status, '', false, true),
                    'fillColor' => 'rgba(151,187,205,0.5)',
                    'borderColor' => $borderColor,
                    'borderWidth'=>1,
                    'tension'=>false,
                    'data' => $data['total']
                ));
            }
            echo json_encode($chart);
        }
    }
    public function recaptcha($str = '')
    {
        return do_recaptcha_validation($str);
    }
}
