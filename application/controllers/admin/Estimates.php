<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Estimates extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('estimates_model');
    }
    /* Get all estimates in case user go on index page */
    public function index($id = false, $clientid = false)
    {
        $this->list_estimates($id, $clientid);
    }
    /* List all estimates datatables */
    public function list_estimates($id = '', $clientid = false)
    {
        if (!has_permission('estimates', '', 'view')) {
            access_denied('estimates');
        }
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();
        if ($this->session->has_userdata('estimate_pipeline') && $this->session->userdata('estimate_pipeline') == 'true' && $clientid == false && !$this->input->get('status')) {
            $data['title']           = _l('estimates_pipeline');
            $data['status']          = '';
            $data['bodyclass']       = 'estimates-pipeline';
            $data['switch_pipeline'] = false;
            if(is_numeric($id)){
                $data['estimateid'] = $id;
            } else {
                $data['estimateid']      = $this->session->flashdata('estimateid');
            }

            $this->load->view('admin/estimates/pipeline/manage', $data);
        } else {
            $_status = '';
            if ($this->input->get('status')) {
                $_status = $this->input->get('status');
            }
            if ($this->input->is_ajax_request()) {
                $this->perfex_base->get_table_data('estimates', array(
                    'clientid' => $clientid,
                    'id' => $id
                ));
            }
            $data['estimateid'] = '';
            if (is_numeric($id)) {
                $data['estimateid'] = $id;
            }
            $data['switch_pipeline'] = true;
            $data['status']          = $_status;
            $data['title']           = _l('estimates');

            $data['estimates_years'] = $this->estimates_model->get_estimates_years();
            $data['estimates_sale_agents'] = $this->estimates_model->get_sale_agents();
            $this->load->view('admin/estimates/manage', $data);
            $this->load->view('admin/estimates/list_template',$data);
        }
    }
    /* Add new estimate or update existing */
    public function estimate($id = '')
    {
        if (!has_permission('estimates', '', 'view')) {
            access_denied('estimates');
        }
        if ($this->input->post()) {
            if ($id == '') {
                if (!has_permission('estimates', '', 'create')) {
                    access_denied('estimates');
                }
                $id = $this->estimates_model->add($this->input->post());
                if ($id) {
                    set_alert('success', _l('added_successfuly', _l('estimate')));
                    if ($this->set_estimate_pipeline_autoload($id)) {
                        redirect(admin_url('estimates/list_estimates/'));
                    } else {
                        redirect(admin_url('estimates/list_estimates/' . $id));
                    }
                }
            } else {
                if (!has_permission('estimates', '', 'edit')) {
                    access_denied('estimates');
                }
                $success = $this->estimates_model->update($this->input->post(), $id);
                if ($success) {
                    set_alert('success', _l('updated_successfuly', _l('estimate')));
                }
                if ($this->set_estimate_pipeline_autoload($id)) {
                    redirect(admin_url('estimates/list_estimates/'));
                } else {
                    redirect(admin_url('estimates/list_estimates/' . $id));
                }
            }
        }
        if ($id == '') {
            $title = _l('create_new_estimate');
        } else {
            $estimate             = $this->estimates_model->get($id);
            $data['estimate']     = $estimate;
            $data['edit']         = true;
            $title                = _l('edit', _l('estimate_lowercase'));
        }
        if($this->input->get('customer_id')){
            $data['customer_id'] = $this->input->get('customer_id');
            $data['do_not_auto_toggle'] = true;
        }
        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();
        $this->load->model('invoice_items_model');
        $data['items']   = $this->invoice_items_model->get();
        $data['clients'] = $this->clients_model->get();
        $data['staff'] = $this->staff_model->get('', 1);
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();
        $data['title'] = $title;
        $this->load->view('admin/estimates/estimate', $data);
    }
    public function validate_estimate_number(){

       $isedit = $this->input->post('isedit');
       $number = $this->input->post('number');
       $original_number = $this->input->post('original_number');
       $number           = trim($number);
       $number = ltrim($number,'0');
       if($isedit == 'true'){
            if($number == $original_number){
                echo json_encode(true);
                die;
            }
       }
       if(total_rows('tblestimates',array('year'=>get_option('estimate_year'),'number'=>$number)) > 0){
            echo 'false';
       } else {
            echo 'true';
       }
    }

    public function init_estimate_items_ajax($id)
    {
        echo json_encode($this->estimates_model->get_estimate_items($id));
    }
     public function delete_attachment($id)
    {
        if (!has_permission('estimates', '', 'delete')) {
            header('HTTP/1.0 400 Bad error');
            echo _l('access_denied');
            die;
        }
        echo $this->estimates_model->delete_attachment($id);
    }
    /* Get all estimate data used when user click on estimate number in a datatable left side*/
    public function get_estimate_data_ajax($id, $to_return = false)
    {
        if (!has_permission('estimates', '', 'view')) {
            echo _l('access_denied');
            die;
        }
        if (!$id) {
            die('No estimate found');
        }
        $estimate = $this->estimates_model->get($id);
        if (!$estimate) {
            echo 'Estimate Not Found';
            die;
        }
        $estimate->date       = _d($estimate->date);
        $estimate->expirydate = _d($estimate->expirydate);
        if ($estimate->invoiceid !== NULL) {
            $this->load->model('invoices_model');
            $estimate->invoice = $this->invoices_model->get($estimate->invoiceid);
        }
        $merge_fields = array();
        $merge_fields = array_merge($merge_fields, get_client_contact_merge_fields($estimate->clientid));
        $merge_fields = array_merge($merge_fields, get_estimate_merge_fields($estimate->id));
        if ($estimate->sent == 0) {
            $template_name = 'estimate-send-to-client';
        } else {
            $template_name = 'estimate-already-send';
        }

        $data['template'] = parse_email_template($template_name, $merge_fields);
        $data['template_name'] = $template_name;

        $data['activity'] = $this->estimates_model->get_estimate_activity($id);
        $data['estimate'] = $estimate;
        $data['members'] = $this->staff_model->get('', 1);
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();
        if ($to_return == false) {
            $this->load->view('admin/estimates/estimate_preview_template', $data);
        } else {
            return $this->load->view('admin/estimates/estimate_preview_template', $data, true);
        }
    }
    public function get_estimates_total()
    {
            if ($this->input->post()) {
                $data['totals'] = $this->estimates_model->get_estimates_total($this->input->post());

                $this->load->model('currencies_model');

                if(!$this->input->post('customer_id')){
                    $multiple_currencies = call_user_func('is_using_multiple_currencies','tblestimates');
                } else {
                    $multiple_currencies = call_user_func('is_client_using_multiple_currencies',$this->input->post('customer_id'),'tblestimates');
                }

                if($this->input->post('project_id')){
                    $_data['project_id'] = $this->input->post('project_id');
                }

                if ($multiple_currencies) {
                    $data['currencies'] = $this->currencies_model->get();
                }

                $data['total_result'] = $this->estimates_model->get_estimates_total($_data);
                $data['_currency'] = $data['totals']['currencyid'];
                unset($data['totals']['currencyid']);
                $this->load->view('admin/estimates/estimates_total_template', $data);
            }
    }
    public function add_note($rel_id)
    {
        if ($this->input->post()) {
            $this->misc_model->add_note($this->input->post(),'estimate',$rel_id);
        }
        echo $rel_id;
    }
    public function delete_note($id)
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode(array(
                'success' => $this->misc_model->delete_note($id)
            ));
        }
    }
    public function get_notes($id)
    {
        if (has_permission('estimates', '', 'view')) {
            $data['notes'] = $this->misc_model->get_notes($id,'estimate');
            $this->load->view('admin/estimates/notes_template', $data);
        }
    }
    public function mark_action_status($status, $id)
    {
        if (!has_permission('estimates', '', 'edit')) {
            access_denied('estimates');
        }
        $success = $this->estimates_model->mark_action_status($status, $id);
        if ($success) {
            set_alert('success', _l('estimate_status_changed_success'));
        } else {
            set_alert('danger', _l('estimate_status_changed_fail'));
        }
        if($this->set_estimate_pipeline_autoload($id)){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('estimates/list_estimates/'.$id));
        }

    }
    public function send_expiry_reminder($id){
        if (!has_permission('estimates', '', 'view')) {
            access_denied('estimates');
        }
        $success = $this->estimates_model->send_expiry_reminder($id);
        if($success) {
            set_alert('success', _l('sent_expiry_reminder_success'));
        } else {
            set_alert('danger', _l('sent_expiry_reminder_fail'));
        }
        if($this->set_estimate_pipeline_autoload($id)){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('estimates/list_estimates/'.$id));
        }
    }
    /* Send estimate to email */
    public function send_to_email($id)
    {
        if (!has_permission('estimates', '', 'view')) {
            access_denied('estimates');
        }
        $success = $this->estimates_model->sent_estimate_to_client($id, '', $this->input->post('attach_pdf'));
        if ($success) {
            set_alert('success', _l('estimate_sent_to_client_success'));
        } else {
            set_alert('danger', _l('estimate_sent_to_client_fail'));
        }
        if($this->set_estimate_pipeline_autoload($id)){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('estimates/list_estimates/'.$id));
        }
    }
    /* Convert estimate to invoice */
    public function convert_to_invoice($id)
    {
        if (!has_permission('invoices', '', 'create')) {
            access_denied('invoices');
        }
        if (!$id) {
            die('No estimate found');
        }
        $invoiceid = $this->estimates_model->convert_to_invoice($id);
        if ($invoiceid) {
            set_alert('success', _l('estimate_convert_to_invoice_successfuly'));
            redirect(admin_url('invoices/list_invoices/' . $invoiceid));
        } else {
            if ($this->session->has_userdata('estimate_pipeline') && $this->session->userdata('estimate_pipeline') == 'true') {
                $this->session->set_flashdata('estimateid', $id);
            }
             if($this->set_estimate_pipeline_autoload($id)){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('estimates/list_estimates/'.$id));
        }
        }
    }
    public function copy($id)
    {
        if (!has_permission('estimates', '', 'create')) {
            access_denied('estimates');
        }
        if (!$id) {
            die('No estimate found');
        }
        $new_id = $this->estimates_model->copy($id);
        if ($new_id) {
            set_alert('success', _l('estimate_copied_successfuly'));
            if($this->set_estimate_pipeline_autoload($new_id)){
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('estimates/estimate/'.$new_id));
            }
        }
        set_alert('danger', _l('estimate_copied_fail'));
        if($this->set_estimate_pipeline_autoload($id)){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('estimates/estimate/'.$id));
        }
    }
    /* Delete estimate */
    public function delete($id)
    {
        if (!has_permission('estimates', '', 'delete')) {
            access_denied('estimates');
        }
        if (!$id) {
            redirect(admin_url('estimates/list_estimates'));
        }
        $success = $this->estimates_model->delete($id);
        if (is_array($success)) {
            set_alert('warning', _l('is_invoiced_estimate_delete_error'));
        } else if ($success == true) {
            set_alert('success', _l('deleted', _l('estimate')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('estimate_lowercase')));
        }
        redirect(admin_url('estimates/list_estimates'));
    }

    /* Generates estimate PDF and senting to email  */
    public function pdf($id)
    {
        if (!has_permission('estimates', '', 'view')) {
            access_denied('estimates');
        }
        if (!$id) {
            redirect(admin_url('estimates/list_estimates'));
        }
        $estimate        = $this->estimates_model->get($id);
        $estimate_number = format_estimate_number($estimate->id);
        $pdf             = estimate_pdf($estimate);
        $type            = 'D';
        if ($this->input->get('print')) {
            $type = 'I';
        }
        $pdf->Output(mb_strtoupper(slug_it($estimate_number)) . '.pdf', $type);
    }
    // Pipeline
    public function get_pipeline()
    {
        if (has_permission('estimates', '', 'view')) {
            $data['estimate_statuses'] = $this->estimates_model->get_statuses();
            $this->load->view('admin/estimates/pipeline/pipeline', $data);
        }
    }
    public function pipeline_open($id)
    {
        if (has_permission('estimates', '', 'view')) {
            $data['id'] = $id;
            $data['estimate'] = $this->get_estimate_data_ajax($id, true);
            $this->load->view('admin/estimates/pipeline/estimate', $data);
        }
    }
    public function update_pipeline()
    {
        if (has_permission('estimates', '', 'edit')) {
            $this->estimates_model->update_pipeline($this->input->post());
        }
    }
    public function pipeline($set = 0)
    {
        if ($set == 1) {
            $set = 'true';
        } else {
            $set = 'false';
        }
        $this->session->set_userdata(array(
            'estimate_pipeline' => $set
        ));
        redirect(admin_url('estimates/list_estimates'));
    }
    public function set_estimate_pipeline_autoload($id)
    {
        if ($id == '') {
            return false;
        }
        if ($this->session->has_userdata('estimate_pipeline') && $this->session->userdata('estimate_pipeline') == 'true') {
            $this->session->set_flashdata('estimateid', $id);
            return true;
        }
        return false;
    }
}
