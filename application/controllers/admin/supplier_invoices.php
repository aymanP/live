<?php

/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 14/11/2016
 * Time: 12:21
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_invoices extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('supplier_invoices_model');
        $this->load->model('supplier_model');
    }
    /* Get all invoices in case user go on index page */
    public function index($id = false)
    {
        $this->list_invoice($id);
    }
    /* List all invoices datatables */

    public function invoice_upload_file($invoice_id)
    {
        handle_invoice_file_uploads($invoice_id);
        redirect(admin_url('supplier_invoices/list_invoice'));
    }

    public function list_invoice($id = '', $supplierid = '')
    {

        if (!has_permission('supplier_invoices', '', 'view')) {
            access_denied('supplier_invoices');
        }
        $this->load->model('payment_modes_model');
        $data['payment_modes'] = $this->payment_modes_model->get('', true);
        $data['files'] = $this->supplier_invoices_model->get_attachments($id);

        $_custom_view          = '';
        $_status               = '';
        if ($this->input->get('custom_view')) {
            $_custom_view = $this->input->get('custom_view');
        } else if ($this->input->get('status')) {
            $_status = $this->input->get('status');
        }
            if ($this->input->is_ajax_request()) {
                log_message('ERROR', 'Some variable did not contain a value.');
                    $this->perfex_base->get_table_data('supplier_invoices', array(
                        'id' => $id,
                        'supplierid' => $supplierid,
                        'data' => $data
                    ));
                    log_message('EROOR', 'Some variable did not contain a value.');
                }
            

        $data['invoiceid'] = '';
        if (is_numeric($id)) {
            $data['invoiceid'] = $id;
        }
      //  $invoice                            = $this->supplier_invoices_model->get($id);
       // $data['invoice'] = $invoice;
        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $data['custom_view'] = $_custom_view;
        $data['chosen_invoice_status']      = $_status;
        $data['title']       = _l('supplier_invoices');
        $this->load->model('supplier_model');
        $data['suppliers']    = $this->supplier_model->get();
        $data['invoices_years'] = $this->supplier_invoices_model->get_invoices_years();
        $data['invoices_sale_agents'] = $this->supplier_invoices_model->get_sale_agents();
        $data['invoices_statuses']       = $this->supplier_invoices_model->get_statuses();

        
       $this->load->view('admin/supplier_invoices/manage', $data);
    }



    public function supplier_change_data($supplier_id, $current_invoice = 'undefined')
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('projects_model');
            $data                       = array();
            $data['billing_shipping']   = $this->supplier_model->get_supplier_billing_and_shipping_details($supplier_id);
            $data['supplier_currency']    = $this->supplier_model->get_supplier_default_currency($supplier_id);
            $data['projects']    = $this->projects_model->get('',array('supplierid'=>$supplier_id));
            $_data['invoices_to_merge'] = $this->supplier_invoices_model->check_for_merge_invoice($supplier_id, $current_invoice);
            $data['merge_info']         = $this->load->view('admin/supplier_invoices/merge_invoice', $_data, true);
            echo json_encode($data);
        }
    }
    public function validate_invoice_number(){
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
        if(total_rows('tblinvoices',array('year'=>get_option('invoice_year'),'number'=>$number)) > 0){
            echo 'false';
        } else {
            echo 'true';
        }
    }
    public function mark_as_cancelled($id)
    {
        if(!has_permission('invoices','','edit') && !has_permission('invoices','','create')){
            access_denied('invoices');
        }
        $success = $this->supplier_invoices_model->mark_as_cancelled($id);
        if ($success) {
            set_alert('success', _l('invoice_marked_as_cancelled_successfuly'));
        }
        redirect(admin_url('supplier_invoices/list_invoice/' . $id));
    }
    public function unmark_as_cancelled($id)
    {
        if(!has_permission('invoices','','edit') && !has_permission('invoices','','create')){
            access_denied('invoices');
        }
        $success = $this->supplier_invoices_model->unmark_as_cancelled($id);
        if ($success) {
            set_alert('success', _l('invoice_unmarked_as_cancelled'));
        }
        redirect(admin_url('supplier_invoices/list_invoice/' . $id));
    }
    public function copy($id)
    {
        if (!$id) {
            redirect(admin_url('supplier_invoices'));
        }
        if (!has_permission('invoices', '', 'create')) {
            access_denied('invoices');
        }
        $new_id = $this->supplier_invoices_model->copy($id);
        if ($new_id) {
            set_alert('success', _l('invoice_copy_success'));
            redirect(admin_url('supplier_invoices/invoice/' . $new_id));
        } else {
            set_alert('success', _l('invoice_copy_fail'));
        }
        redirect(admin_url('supplier_invoices/invoice/' . $id));
    }
    public function get_items_suggestions()
    {
        $this->load->model('invoice_items_model');
        echo json_encode($this->invoice_items_model->get());
    }
    public function get_merge_data($id)
    {
        $invoice = $this->supplier_invoices_model->get($id);
        $i       = 0;
        foreach ($invoice->items as $item) {
            $invoice->items[$i]['taxname'] = get_invoice_item_taxes($item['id']);
            $i++;
        }
        echo json_encode($invoice);
    }
    /* Add new invoice or update existing */
    public function invoice($id = '')
    {
        $this->load->model('supplier_model');
        if (!has_permission('invoices', '', 'view')) {
            access_denied('invoices');
        }
        if ($this->input->post()) {
            if ($id == '') {
                if (!has_permission('invoices', '', 'create')) {
                    access_denied('invoices');
                }
                $id = $this->supplier_invoices_model->add($this->input->post());
                if ($id) {
                    set_alert('success', _l('added_successfuly', _l('invoice')));

//                    set_alert('modal');
                    //$script = $this->session->set_flashdata($script);
                    redirect(admin_url('supplier_invoices/list_invoice/'));
                }
            } else {
                if (!has_permission('invoices', '', 'edit')) {
                    access_denied('invoices');
                }
                $success = $this->supplier_invoices_model->update($this->input->post(), $id);
                if ($success) {
                    set_alert('success', _l('updated_successfuly', _l('invoice')));
                }else{
                    set_alert('danger', _l('updated_failed'));
                }
                redirect(admin_url('supplier_invoices/list_invoice/'));
            }
        }
        if ($id == '') {
            $title = _l('create_new_invoice');
        } else {
            $invoice                            = $this->supplier_invoices_model->get($id);
            $data['invoices_to_merge']          = $this->supplier_invoices_model->check_for_merge_invoice($invoice->supplierid, $invoice->id);
            $data['invoice_recurring_invoices'] = $this->supplier_invoices_model->get_invoice_recuring_invoices($id);

            $data['invoice']                    = $invoice;
            $data['edit']                       = true;
            $title                              = _l('edit', _l('invoice_lowercase'));
        }
        if($this->input->get('supplier_id')){
            $data['supplier_id'] = $this->input->get('supplier_id');
            $data['do_not_auto_toggle'] = true;
        }
        
        $this->load->model('payment_modes_model');
        $data['payment_modes'] = $this->payment_modes_model->get();
        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $this->load->model('invoice_items_model');
        $data['items'] = $this->invoice_items_model->get();
        $this->load->model('tasks_model');
        $data['billable_tasks'] = $this->tasks_model->get_billable_tasks();
        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();
        $data['suppliers']    = $this->supplier_model->get();
        $data['staff']     = $this->staff_model->get('', 1);
        $data['title']     = $title;
        $data['bodyclass'] = 'invoice';
        $this->load->view('admin/supplier_invoices/supplier_invoice', $data);
    }
    public function init_invoice_items_ajax($id)
    {
        echo json_encode($this->supplier_invoices_model->get_invoice_items($id));
    }
    /* Get all invoice data used when user click on invoiec number in a datatable left side*/
    public function get_invoice_data_ajax($id)
    {
        if (!has_permission('invoices', '', 'view')) {
            echo _l('access_denied');
            die;
        }
        if (!$id) {
            die('No invoice found');
        }
        $invoice = $this->supplier_invoices_model->get($id);
        if (!$invoice) {
            echo 'Invoice Not Found';
            die;
        }
        $invoice->date    = _d($invoice->date);
        $invoice->duedate = _d($invoice->duedate);
        $merge_fields  = array();
        $merge_fields  = array_merge($merge_fields, get_supplier_contact_merge_fields($invoice->supplierid));
        $merge_fields  = array_merge($merge_fields, get_invoice_merge_fields($invoice->id));
        $template_name = 'invoice-send-to-client';
        if ($invoice->sent == 1) {
            $template_name = 'invoice-already-send';
        }
        $template_name             = do_action('after_invoice_sent_template_statement', $template_name);
        $data['template']          = parse_email_template($template_name, $merge_fields);

        $data['invoices_to_merge'] = $this->supplier_invoices_model->check_for_merge_invoice($invoice->supplierid, $id);
        $data['template_name'] = $template_name;
        // Check for recorded payments
        $this->load->model('payments_model');
        $data['members']     = $this->staff_model->get('', 1);
        $data['contacts']    = $this->supplier_model->get_contacts($invoice->supplierid);
        $data['payments']    = $this->payments_model->get_invoice_payments($id);
        $data['activity']    = $this->supplier_invoices_model->get_invoice_activity($id);
        $data['invoice']     = $invoice;
        $this->load->view('admin/supplier_invoices/ ', $data);
//        $this->load->view('admin/supplier_invoices/invoice_preview_template', $data);
    }
    public function get_invoices_total()
    {
        if ($this->input->post()) {
            $_data = $this->input->post();
            if(!$this->input->post('supplier_id')){
                $multiple_currencies = call_user_func('is_using_multiple_currencies');
            } else {
                $_data['supplier_id'] = $this->input->post('supplier_id');
                $multiple_currencies = call_user_func('is_supplier_using_multiple_currencies',$this->input->post('supplier_id'));
            }

            if($this->input->post('project_id')){
                $_data['project_id'] = $this->input->post('project_id');
            }

            if ($multiple_currencies) {
                $this->load->model('currencies_model');
                $data['currencies'] = $this->currencies_model->get();
            }
            $data['total_result'] = $this->supplier_invoices_model->get_invoices_total($_data);
            $data['_currency'] = $data['total_result']['currencyid'];
            $this->load->view('admin/supplier_invoices/invoices_total_template', $data);
        }
    }
    /* Record new inoice payment view */
    public function record_invoice_payment_ajax($id)
    {
        $this->load->model('payment_modes_model');
        $this->load->model('payments_model');
        $data['payment_modes'] = $this->payment_modes_model->get();
        $data['invoice']       = $invoice = $this->supplier_invoices_model->get($id);
        $data['payments']      = $this->payments_model->get_invoice_payments($id);
        $this->load->view('admin/supplier_invoices/record_payment_template', $data);
    }
    /* This is where invoice payment record $_POST data is send */
    public function record_payment()
    {
        if (!has_permission('payments', '', 'create')) {
            access_denied('Record Payment');
        }
        if ($this->input->post()) {
            $this->load->model('payments_model');
            $id = $this->payments_model->process_payment($this->input->post(), '');
            if ($id) {
                set_alert('success', _l('invoice_payment_recorded'));
                redirect(admin_url('payments/payment/' . $id));
            } else {
                set_alert('danger', _l('invoice_payment_record_failed'));
            }
            redirect(admin_url('supplier_invoices/list_invoice/' . $this->input->post('invoiceid')));
        }
    }
    /* Send invoiece to email */
    public function send_to_email($id)
    {
        if (!has_permission('invoices', '', 'view')) {
            access_denied('invoices');
        }
        $success = $this->supplier_invoices_model->sent_invoice_to_supplier($id, '', $this->input->post('attach_pdf'));
        if ($success) {
            set_alert('success', _l('invoice_sent_to_supplier_success'));
        } else {
            set_alert('danger', _l('invoice_sent_to_supplier_fail'));
        }
        redirect(admin_url('supplier_invoices/list_invoice/' . $id));
    }
    /* Delete invoice payment*/
    public function delete_payment($id, $invoiceid)
    {
        if (!has_permission('payments', '', 'delete')) {
            access_denied('payments');
        }
        $this->load->model('payments_model');
        if (!$id) {
            redirect(admin_url('payments'));
        }
        $response = $this->payments_model->delete($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('payment')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('payment_lowercase')));
        }
        redirect(admin_url('supplier_invoices/list_invoice/' . $invoiceid));
    }
    /* Delete invoice */
    public function delete($id)
    {
        if (!has_permission('invoices', '', 'delete')) {
            access_denied('invoices');
        }
        if (!$id) {
            redirect(admin_url('supplier_invoices/list_invoice'));
        }
        $success = $this->supplier_invoices_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('invoice')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('invoice_lowercase')));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function delete_attachment($id)
    {
        if (!has_permission('invoices', '', 'delete')) {
            header('HTTP/1.0 400 Bad error');
            echo _l('access_denied');
            die;
        }
        echo $this->supplier_invoices_model->delete_attachment($id);
    }
    /* Will send overdue notice to client */
    public function send_overdue_notice($id)
    {
        if (!has_permission('invoices', '', 'view')) {
            access_denied('invoices');
        }
        $send = $this->supplier_invoices_model->send_invoice_overdue_notice($id);
        if ($send) {
            set_alert('success', _l('invoice_overdue_reminder_sent'));
        } else {
            set_alert('warning', _l('invoice_reminder_send_problem'));
        }
        redirect(admin_url('supplier_invoices/list_invoice/' . $id));
    }
    /* Generates invoice PDF and senting to email of $send_to_email = true is passed */
    public function pdf($id)
    {
        if (!has_permission('invoices', '', 'view')) {
            access_denied('invoices');
        }
        if (!$id) {
            redirect(admin_url('supplier_invoices/list_invoice'));
        }
        $invoice        = $this->supplier_invoices_model->get($id);
        $invoice_number = format_invoice_number($invoice->id);
        $pdf            = invoice_pdf($invoice);
        $type           = 'D';
        if ($this->input->get('print')) {
            $type = 'I';
        }
        $pdf->Output(mb_strtoupper(slug_it($invoice_number)) . '.pdf', $type);
    }

    public function mark_as_sent($id)
    {
        if (!$id) {
            redirect(admin_url('supplier_invoices/list_invoice'));
        }
        $success = $this->supplier_invoices_model->set_invoice_sent($id, true);
        if ($success) {
            set_alert('success', _l('invoice_marked_as_sent'));
        } else {
            set_alert('warning', _l('invoice_marked_as_sent_failed'));
        }
        redirect(admin_url('supplier_invoices/list_invoice/' . $id));
    }
    public function get_due_date(){
        if ($this->input->post()) {
            $date    = $this->input->post('date');
            $duedate = '';
            if (get_option('invoice_due_after') != 0) {
                $date = to_sql_date($date);
                $d = date('Y-m-d', strtotime('+' . get_option('invoice_due_after') . ' DAY',strtotime($date)));
                $duedate = _d($d);
            }
            echo $duedate;
        }
    }
}
