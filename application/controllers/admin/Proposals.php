<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Proposals extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('proposals_model');
        $this->load->model('currencies_model');
    }
    public function index($proposal_id = '')
    {
        if (!has_permission('proposals', '', 'view')) {
            access_denied('proposals');
        }
        $this->list_proposals($proposal_id);
    }
    public function list_proposals($proposal_id = '')
    {
        if (!has_permission('proposals', '', 'view')) {
            access_denied('proposals');
        }
        if ($this->session->has_userdata('proposals_pipeline') && $this->session->userdata('proposals_pipeline') == 'true' && !isset($_GET['status'])) {
            $data['title']           = _l('proposals_pipeline');
            $data['status']          = '';
            $data['bodyclass']       = 'proposals-pipeline';
            $data['switch_pipeline'] = false;
            // Direct access
            if(is_numeric($proposal_id)){
                $data['proposalid'] = $proposal_id;
            } else {
                $data['proposalid']      = $this->session->flashdata('proposalid');
            }

            $this->load->view('admin/proposals/pipeline/manage', $data);
        } else {
            $_status = '';
            if (isset($_GET['status'])) {
                $_status = $_GET['status'];
            }
            if ($this->input->is_ajax_request()) {
                $this->perfex_base->get_table_data('proposals');
            }
            $data['proposal_id'] = '';
            if (is_numeric($proposal_id)) {
                $data['proposal_id'] = $proposal_id;
            }
            $data['chosen_status']     = $_status;
            $data['switch_pipeline'] = true;
            $data['title']           = _l('proposals');
            $data['statuses'] = $this->proposals_model->get_statuses();
            $data['proposals_sale_agents'] = $this->proposals_model->get_sale_agents();
            $data['years'] = $this->proposals_model->get_proposals_years();
            $this->load->view('admin/proposals/manage', $data);
        }
    }
    public function proposal_relations($rel_id, $rel_type)
    {
        if ($this->input->is_ajax_request()) {
            $this->perfex_base->get_table_data('proposals_relations', array(
                'rel_id' => $rel_id,
                'rel_type' => $rel_type
            ));
        }
    }
    public function delete_attachment($id)
    {
        if (!has_permission('invoices', '', 'delete')) {
            header('HTTP/1.0 400 Bad error');
            echo _l('access_denied');
            die;
        }
        echo $this->proposals_model->delete_attachment($id);
    }
    public function proposal($id = '')
    {
        if (!has_permission('proposals', '', 'view')) {
            access_denied('proposals');
        }
        if ($this->input->post()) {
            if ($id == '') {
                if (!has_permission('proposals', '', 'create')) {
                    access_denied('proposals');
                }
                $id = $this->proposals_model->add($this->input->post());
                if ($id) {
                    set_alert('success', _l('added_successfuly', _l('proposal')));
                    if ($this->set_proposal_pipeline_autoload($id)) {
                        redirect(admin_url('proposals/list_proposals/'));
                    } else {
                        redirect(admin_url('proposals/list_proposals/' . $id));
                    }
                }
            } else {
                if (!has_permission('proposals', '', 'edit')) {
                    access_denied('proposals');
                }
                $success = $this->proposals_model->update($this->input->post(), $id);
                if ($success) {
                    set_alert('success', _l('updated_successfuly', _l('proposal')));
                }
                if ($this->set_proposal_pipeline_autoload($id)) {
                    redirect(admin_url('proposals/list_proposals/'));
                } else {
                    redirect(admin_url('proposals/list_proposals/' . $id));
                }
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('proposal_lowercase'));
        } else {
            $data['proposal'] = $this->proposals_model->get($id);
            $title            = _l('edit', _l('proposal_lowercase'));
        }
        $data['statuses'] = $this->proposals_model->get_statuses();
        $data['staff']      = $this->staff_model->get('', 1);
        $data['currencies'] = $this->currencies_model->get();
        $data['title']      = $title;
        $this->load->view('admin/proposals/proposal', $data);
    }
    public function send_expiry_reminder($id){
        if (!has_permission('proposals', '', 'view')) {
            access_denied('proposals');
        }
        $success = $this->proposals_model->send_expiry_reminder($id);
        if($success) {
            set_alert('success', _l('sent_expiry_reminder_success'));
        } else {
            set_alert('danger', _l('sent_expiry_reminder_fail'));
        }
        if($this->set_proposal_pipeline_autoload($id)){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('proposals/list_proposals/'.$id));
        }
    }
    public function pdf($id)
    {
        if (!has_permission('proposals', '', 'view')) {
            access_denied('proposals');
        }
        if (!$id) {
            redirect(admin_url('proposals/list_proposals'));
        }
        $proposal = $this->proposals_model->get($id);
        $pdf      = proposal_pdf($proposal);
        $type     = 'D';
        if ($this->input->get('print')) {
            $type = 'I';
        }
        $pdf->Output(slug_it($proposal->subject) . '.pdf', $type);
    }
    public function get_proposal_data_ajax($id, $to_return = false)
    {
        if (!has_permission('proposals', '', 'view')) {
            echo _l('access_denied');
            die;
        }
        if (!$id) {
            die('No proposal found');
        }
        $proposal = $this->proposals_model->get($id, array(), true);
        if (!$proposal) {
            echo 'Proposal Not Found';
            die;
        }

        $data['members']        = $this->staff_model->get('', 1);
        $merge_fields           = array();
        $merge_fields           = array_merge($merge_fields, get_proposal_merge_fields($proposal->id));
        $proposal_merge_fields  = get_available_merge_fields();
        $_proposal_merge_fields = array();
        foreach ($proposal_merge_fields as $key => $val) {
            foreach ($val as $type => $f) {
                if ($type == 'proposals') {
                    foreach ($f as $available) {
                        foreach ($available['available'] as $av) {
                            if ($av == 'proposals') {
                                array_push($_proposal_merge_fields, $f);
                                break;
                            }
                        }
                        break;
                    }
                } else if ($type == 'other') {
                    array_push($_proposal_merge_fields, $f);
                }
            }
        }
        $data['proposal_statuses'] = $this->proposals_model->get_statuses();
        $template_name = 'proposal-send-to-customer';
        $data['proposal_merge_fields'] = $_proposal_merge_fields;
        $data['template']              = parse_email_template($template_name, $merge_fields);
        $data['proposal']              = $proposal;
        $data['template_name'] = $template_name;
        if ($to_return == false) {
            $this->load->view('admin/proposals/proposals_preview_template', $data);
        } else {
            return $this->load->view('admin/proposals/proposals_preview_template', $data, true);
        }
    }
    public function convert_to_estimate($id)
    {
        if (!has_permission('estimates', '', 'create')) {
            access_denied('estimates');
        }
        if ($this->input->post()) {
            $this->load->model('estimates_model');
            $estimate_id = $this->estimates_model->add($this->input->post());
            if ($estimate_id) {
                set_alert('success', _l('proposal_converted_to_estimate_success'));
                $this->db->where('id', $id);
                $this->db->update('tblproposals', array(
                    'estimate_id' => $estimate_id,
                    'status' => 3
                ));
                logActivity('Proposal Converted to Estimate [EstimateID: ' . $estimate_id . ', ProposalID: ' . $id . ']');
                redirect(admin_url('estimates/estimate/' . $estimate_id));
            } else {
                set_alert('danger', _l('proposal_converted_to_estimate_fail'));
            }
            if ($this->set_proposal_pipeline_autoload($id)) {
                redirect(admin_url('proposals/list_proposals/'));
            } else {
                redirect(admin_url('proposals/list_proposals/' . $id));
            }
        }
    }
    public function convert_to_invoice($id)
    {
        if (!has_permission('invoices', '', 'create')) {
            access_denied('invoices');
        }
        if ($this->input->post()) {
            $this->load->model('invoices_model');
            $invoice_id = $this->invoices_model->add($this->input->post());
            if ($invoice_id) {
                set_alert('success', _l('proposal_converted_to_invoice_success'));
                $this->db->where('id', $id);
                $this->db->update('tblproposals', array(
                    'invoice_id' => $invoice_id,
                    'status' => 3
                ));
                logActivity('Proposal Converted to Invoice [InvoiceID: ' . $invoice_id . ', ProposalID: ' . $id . ']');
                redirect(admin_url('invoices/invoice/' . $invoice_id));
            } else {
                set_alert('danger', _l('proposal_converted_to_invoice_fail'));
            }
            if ($this->set_proposal_pipeline_autoload($id)) {
                redirect(admin_url('proposals/list_proposals/'));
            } else {
                redirect(admin_url('proposals/list_proposals/' . $id));
            }
        }
    }
    public function get_invoice_convert_data($id)
    {
        $this->load->model('payment_modes_model');
        $data['payment_modes'] = $this->payment_modes_model->get();
        $this->load->model('taxes_model');
        $data['taxes']      = $this->taxes_model->get();
        $data['currencies'] = $this->currencies_model->get();
        $this->load->model('invoice_items_model');
        $data['items']   = $this->invoice_items_model->get();
        $data['clients'] = $this->clients_model->get();

        $data['staff']    = $this->staff_model->get('', 1);
        $data['proposal'] = $this->proposals_model->get($id);
        $this->load->model('tasks_model');
        $data['billable_tasks'] = $this->tasks_model->get_billable_tasks();
        $data['add_items']      = $this->_parse_items($data['proposal']);
        $data['do_not_auto_toggle'] = true;

        $this->load->view('admin/proposals/invoice_convert_template', $data);
    }
    public function get_estimate_convert_data($id)
    {
        $this->load->model('taxes_model');
        $data['taxes']      = $this->taxes_model->get();
        $data['currencies'] = $this->currencies_model->get();
        $this->load->model('invoice_items_model');
        $data['items']   = $this->invoice_items_model->get();
        $data['clients'] = $this->clients_model->get();

        $data['staff']     = $this->staff_model->get('', 1);
        $data['proposal']  = $this->proposals_model->get($id);
        $data['add_items'] = $this->_parse_items($data['proposal']);
        $this->load->model('estimates_model');
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();
        $data['do_not_auto_toggle'] = true;
        $this->load->view('admin/proposals/estimate_convert_template', $data);
    }
    private function _parse_items($proposal)
    {
        $items = array();
        $this->load->helper('simple_html_dom');
        $html = str_get_html($proposal->content);
        if ($html) {
            foreach ($html->find('table[class=proposal-items] tbody > tr') as $tr) {
                // The parent tag name
                $parentTag = $tr->parent()->tag;
                $_items    = array();
                // Make sure the parent tag is 'tbody'
                if ($parentTag == 'tbody') {
                    $i = 0;
                    foreach ($tr->children() as $cell) {
                        if ($i > 4) {
                            break;
                        }
                        if ($i != 4) {
                            if ($i == 0) {
                                $name = 'description';
                            } else if ($i == 1) {
                                $name = 'long_description';
                            } else if ($i == 2) {
                                $name = 'qty';
                            } else if ($i == 3) {
                                $name = 'rate';
                            }
                            $cell->plaintext = trim($cell->plaintext);
                            if ($i == 3) {
                                $cell->plaintext = number_unformat($cell->plaintext);
                                $cell->plaintext = number_format(floatval($cell->plaintext), 2, '.', '');
                            }
                            $_items[$name] = $cell->plaintext;
                        } else {
                            $tax_id = trim($cell->{'data-taxid'});
                            if (empty($tax_id)) {
                                // user changed the tax after inserting the item directly in the table
                                // lets assume that this tax is in database and add the id if found
                                $tax = trim($cell->plaintext);
                                $tax = str_replace('%', '', $tax);
                                $this->db->where('taxrate', $tax);
                                $_tax = $this->db->get('tbltaxes')->row();
                                if ($_tax) {
                                    $tax = $_tax->name . '|' . $_tax->taxrate;
                                } else {
                                    $tax = '';
                                }
                                $_items['taxname'] = $tax;
                            } else {
                                $tax               = get_tax_by_id($tax_id);
                                $_items['taxname'] = '';
                                if ($tax) {
                                    $_items['taxname'] = $tax->name . '|' . $tax->taxrate;
                                }
                            }
                        }
                        $i++;
                    }
                    $_items['id'] = 0;
                    $items[]      = $_items;
                }
            }
        }
        return $items;
    }
    /* Send proposal to email */
    public function send_to_email($id)
    {
        if (!has_permission('proposals', '', 'view')) {
            access_denied('proposals');
        }
        $success = $this->proposals_model->sent_proposal_to_email($id, 'proposal-send-to-customer', $this->input->post('attach_pdf'));
        if ($success) {
            set_alert('success', _l('proposal_sent_to_email_success'));
        } else {
            set_alert('danger', _l('proposal_sent_to_email_fail'));
        }

        if($this->set_proposal_pipeline_autoload($id)){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('proposals/list_proposals/'.$id));
        }
    }
    public function copy($id)
    {
        if (!has_permission('proposals', '', 'create')) {
            access_denied('proposals');
        }
        $new_id = $this->proposals_model->copy($id);
        if ($new_id) {
            set_alert('success', _l('proposal_copy_success'));
            if($this->set_proposal_pipeline_autoload($new_id)){
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('proposals/list_proposals/'.$new_id));
            }
        } else {
            set_alert('success', _l('proposal_copy_fail'));
        }
        if ($this->set_proposal_pipeline_autoload($id)) {
            redirect(admin_url('proposals/list_proposals/'));
        } else {
            redirect(admin_url('proposals/list_proposals/' . $id));
        }
    }
    public function mark_action_status($status, $id)
    {
        if (!has_permission('proposals', '', 'edit')) {
            access_denied('proposals');
        }
        $success = $this->proposals_model->mark_action_status($status, $id);
        if ($success) {
            set_alert('success', _l('proposal_status_changed_success'));
        } else {
            set_alert('danger', _l('proposal_status_changed_fail'));
        }
        if ($this->set_proposal_pipeline_autoload($id)) {
            redirect(admin_url('proposals/list_proposals/'));
        } else {
            redirect(admin_url('proposals/list_proposals/' . $id));
        }
    }
    public function delete($id)
    {
        if (!has_permission('proposals', '', 'delete')) {
            access_denied('proposals');
        }
        $response = $this->proposals_model->delete($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('proposal')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('proposal_lowercase')));
        }
        redirect(admin_url('proposals/list_proposals'));
    }
    public function get_relation_data_values($rel_id, $rel_type)
    {
        echo json_encode($this->proposals_model->get_relation_data_values($rel_id, $rel_type));
    }
    public function add_proposal_comment()
    {
        echo json_encode(array(
            'success' => $this->proposals_model->add_comment($this->input->post())
        ));
    }
    public function get_proposal_comments($id)
    {
        $data['comments'] = $this->proposals_model->get_comments($id);
        $this->load->view('admin/proposals/comments_template', $data);
    }
    public function remove_comment($id)
    {
        $this->db->where('id',$id);
        $comment = $this->db->get('tblproposalcomments')->row();
        if($comment){
        if (($comment->staffid != get_staff_user_id() && !has_permission('proposals', '', 'delete')) || !is_staff_logged_in()) {
            echo json_encode(array(
                'success' => false,
            ));
            die;
        }
        echo json_encode(array(
            'success' => $this->proposals_model->remove_comment($id)
        ));
    } else {
          echo json_encode(array(
            'success' => false,
        ));
    }
    }
    public function save_proposal_data()
    {
        if (!has_permission('proposals', '', 'edit')) {
            header('HTTP/1.0 400 Bad error');
            echo json_encode(array(
                'success' => false,
                'message' => _l('access_denied')
            ));
            die;
        }
        if ($this->input->post('content')) {
            $this->db->where('id', $this->input->post('proposal_id'));
            $this->db->update('tblproposals', array(
                'content' => $this->input->post('content')
            ));
            $success = false;
            $message = '';
            if ($this->db->affected_rows() > 0) {
                $success = true;
                $message = _l('updated_successfuly', _l('proposal'));
            }
            echo json_encode(array(
                'success' => $success,
                'message' => $message
            ));
        }
    }
    // Pipeline
    public function pipeline($set = 0)
    {
        if ($set == 1) {
            $set = 'true';
        } else {
            $set = 'false';
        }
        $this->session->set_userdata(array(
            'proposals_pipeline' => $set
        ));
        redirect(admin_url('proposals/list_proposals'));
    }
    public function pipeline_open($id)
    {
        if (has_permission('proposals', '', 'view')) {
            $data['proposal'] = $this->get_proposal_data_ajax($id, true);
            $data['proposal_data'] = $this->proposals_model->get($id);
            $this->load->view('admin/proposals/pipeline/proposal', $data);
        }
    }
    public function update_pipeline()
    {
        if (has_permission('proposals', '', 'edit')) {
            $this->proposals_model->update_pipeline($this->input->post());
        }
    }
    public function get_pipeline()
    {
        if (has_permission('proposals', '', 'view')) {
            $data['statuses'] = $this->proposals_model->get_statuses();
            $this->load->view('admin/proposals/pipeline/pipeline', $data);
        }
    }
    public function set_proposal_pipeline_autoload($id)
    {
        if ($id == '') {
            return false;
        }
        if ($this->session->has_userdata('proposals_pipeline') && $this->session->userdata('proposals_pipeline') == 'true') {
            $this->session->set_flashdata('proposalid', $id);
            return true;
        }
        return false;
    }
}
