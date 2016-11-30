<?php

/**
 * Created by PhpStorm.
 * User: DevTREE
 * Date: 03/11/2016
 * Time: 17:56
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers extends Admin_controller
{
    private $not_importable_supplier_fields = array('supplierid', 'id', 'is_primary', 'password', 'datecreated', 'last_ip', 'last_login', 'last_password_change', 'active', 'new_pass_key', 'new_pass_key_requested', 'leadid', 'default_currency', 'profile_image', 'default_language');
    public $pdf_zip;
    function __construct()
    {
        parent::__construct();
    }
    /* List all clients */
    public function index()
    {
        if (!has_permission('supplier', '', 'view')) {
            if(!have_assigned_customers()){
                access_denied('suppliers');
            }
        }
        if ($this->input->is_ajax_request()) {
            $this->perfex_base->get_table_data('suppliers');
        }
        $this->load->model('contracts_model');
        $this->load->model('supplier_model');
        $data['contract_types'] = $this->contracts_model->get_contract_types();
        $data['groups']         = $this->supplier_model->get_groups();
        $data['title']          = _l('suppliers');

        $this->load->model('proposals_model');
        $data['proposal_statuses'] = $this->proposals_model->get_statuses();

        $this->load->model('supplier_invoices_model');
        $data['invoice_statuses'] = $this->supplier_invoices_model->get_statuses();

        $this->load->model('estimates_model');
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();

        $this->load->model('supplier_projects_model');
        $data['project_statuses'] = $this->supplier_projects_model->get_project_statuses();

        $this->load->view('admin/suppliers/manage', $data);
    }


    /* Edit client or add new client*/
    public function supplier($id = '')
    {
        $this->load->model('supplier_model');
        if (!has_permission('suppliers', '', 'view')) {
            if($id != '' && !is_customer_admin($id)){
                access_denied('suppliers');
            }
        }
        if ($this->input->post() && !$this->input->is_ajax_request()) {

            if ($id == '') {
                if (!has_permission('suppliers', '', 'create')) {
                    access_denied('suppliers');
                }
                $data = $this->input->post();
                $save_and_add_contact = false;
                if(isset($data['save_and_add_supplier_contact'])){
                    unset($data['save_and_add_supplier_contact']);
                    $save_and_add_contact = true;
                }
                $id = $this->supplier_model->add($data);
                if ($id) {
                    set_alert('success', _l('added_successfuly', _l('supplier')));
                    if($save_and_add_contact == false){
                        redirect(admin_url('suppliers/supplier/' . $id));
                    } else {
                        redirect(admin_url('suppliers/supplier/' . $id.'?new_supplier_contact=true'));
                    }
                }
            } else {

                if (!has_permission('suppliers', '', 'edit')) {
                    if(!is_customer_admin($id)){
                        access_denied('suppliers');
                    }
                }
                $supplierid = $this->session->userdata('supplierid');

                handle_supplier_profile_image_upload($supplierid);
                $success = $this->supplier_model->update($this->input->post(), $id);
                if ($success == true) {
                    set_alert('success', _l('updated_successfuly', _l('supplier')));
                }
                redirect(admin_url('suppliers/supplier/' . $id));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('supplier_lowercase'));
        } else {
            $supplier = $this->supplier_model->get($id);
            if (!$supplier) {
                blank_page('Supplier Not Found');
            }
            $this->session->set_userdata('supplierid', $id);
            $this->load->model('staff_model');
            $data['staff'] = $this->staff_model->get('',1);
            $data['supplier_admins'] = $this->supplier_model->get_admins($id);
            $this->load->model('payment_modes_model');
            $data['payment_modes'] = $this->payment_modes_model->get();
            $data['attachments']   = $this->supplier_model->get_all_supplier_attachments($id);
            $data['supplier']        = $supplier;
//            $data['supplierid']        = $supplier->id;
            $title                 = $supplier->company;
            // Get all active staff members (used to add reminder)
            $this->load->model('staff_model');
            $data['members'] = $this->staff_model->get('', 1);
            if ($this->input->is_ajax_request()) {
                $this->perfex_base->get_table_data('tickets', array(
                    'supplierid' => $id
                ));
            }
            $data['customer_groups'] = $this->supplier_model->get_supplier_groups($id);

            $this->load->model('estimates_model');
            $data['estimate_statuses'] = $this->estimates_model->get_statuses();

            $this->load->model('supplier_invoices_model');
            $data['invoice_statuses'] = $this->supplier_invoices_model->get_statuses();
        }
        if (!$this->input->get('group')) {
            $group = 'profile';
        } else {
            $group = $this->input->get('group');
        }
        $data['group']  = $group;
        $data['groups'] = $this->supplier_model->get_groups();
        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();
        $data['user_notes'] = $this->misc_model->get_notes($id, 'customer');

        $this->load->model('supplier_projects_model');
        $data['project_statuses'] = $this->supplier_projects_model->get_project_statuses();

        $data['title']      = $title;
        $this->load->view('admin/suppliers/supplier', $data);
    }
    public function supplier_contact($supllier_id, $contact_id = '')
    {
        $this->load->model('supplier_model');
        if (!has_permission('suppliers', '', 'view')) {
            if(!is_customer_admin($supllier_id)){
                echo _l('access_denied');
                die;
            }
        }
        $data['supplier_id'] = $supllier_id;
        $data['contactid']   = $contact_id;
        if ($this->input->post()) {
            $data = $this->input->post();
            unset($data['suppliercontactid']);
            if ($contact_id == '') {
                if (!has_permission('suppliers', '', 'create')) {
                    if(!is_supplier_admin($supllier_id)){
                        header('HTTP/1.0 400 Bad error');
                        echo json_encode(array(
                            'success' => false,
                            'message' => _l('access_denied')
                        ));
                        die;
                    }
                }
                $id      = $this->supplier_model->add_supplier_contact($data, $supllier_id);
                $message = '';
                $success = false;
                if ($id) {
                    $success = true;
                    $message = _l('added_successfuly', _l('contact'));
                }
                echo json_encode(array(
                    'success' => $success,
                    'message' => $message
                ));
                die;
            } else {
                if (!has_permission('suppliers', '', 'edit')) {
                    if(!is_supplier_admin($supllier_id)){
                        header('HTTP/1.0 400 Bad error');
                        echo json_encode(array(
                            'success' => false,
                            'message' => _l('access_denied')
                        ));
                        die;
                    }
                }
                $success = $this->supplier_model->update_supplier_contact($data, $contact_id);
                $message = '';
                if (is_array($success)) {
                    if (isset($success['set_password_email_sent'])) {
                        $message = _l('set_password_email_sent_to_supplier');
                    } else if (isset($success['set_password_email_sent_and_profile_updated'])) {
                        $message = _l('set_password_email_sent_to_supplier_and_profile_updated');
                    }
                } else {
                    $message = _l('updated_successfuly', _l('contact'));
                }
                echo json_encode(array(
                    'success' => $success,
                    'message' => $message
                ));
                die;
            }
        }
        if ($contact_id == '') {
            $title = _l('add_new', _l('contact_lowercase'));
        } else {
            $data['contact'] = $this->supplier_model->get_contact($contact_id);
            $title           = $data['contact']->firstname . ' ' . $data['contact']->lastname;
        }

        $data['supplier_permissions'] = $this->perfex_base->get_contact_permissions();
        $data['title'] = $title;
        $this->load->view('admin/suppliers/modals/contact', $data);
    }
    public function assign_admins($id){
        $this->load->model('supplier_model');
        if (!has_permission('suppliers', '', 'create') && !has_permission('suppliers', '', 'edit')) {
            access_denied('suppliers');
        }
        $success = $this->supplier_model->assign_admins($this->input->post(),$id);
        if ($success == true) {
            set_alert('success', _l('updated_successfuly', _l('supplier')));
        }

        redirect(admin_url('suppliers/supplier/'.$id.'?tab=supplier_admins'));

    }
    public function delete_contact($supplier_id,$id)
    {
        $this->load->model('supplier_model');
        if (!has_permission('suppliers', '', 'delete')) {
            if(!is_customer_admin($supplier_id)){
                access_denied('suppliers');
            }
        }
        $this->suppliers_model->delete_supplier_contact($id);
        redirect(admin_url('suppliers/supplier/'.$supplier_id.'?tab=contacts'));
    }
    public function supplier_contacts($supplier_id)
    {
        $this->perfex_base->get_table_data('supplier_contacts', array(
            'supplier_id' => $supplier_id
        ));
    }
    public function upload_attachment($id)
    {
        handle_supplier_attachments_upload($id);
    }
    public function delete_attachment($customer_id, $id)
    {
        $this->load->model('supplier_model');
        if (has_permission('suppliers', '', 'delete') || is_supplier_admin($customer_id)) {
           $sucess = $this->supplier_model->delete_attachment($id);

            if($sucess);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    /* Delete client */
    public function delete($id)
    {
        $this->load->model('supplier_model');
        if (!has_permission('suppliers', '', 'delete')) {
            access_denied('suppliers');
        }
        if (!$id) {
            redirect(admin_url('suppliers'));
        }
        $response = $this->supplier_model->delete($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('supplier_delete_invoices_warning'));
        } else if ($response == true) {
            set_alert('success', _l('deleted', _l('supplier')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('supplier_lowercase')));
        }
        redirect(admin_url('suppliers'));
    }
    /* Staff can login as client */
//    public function login_as_client($id)
//    {
//        if (has_permission('customers', '', 'create') || is_customer_admin($id)) {
//            $this->clients_model->login_as_client($id);
//        }
//        do_action('after_contact_login');
//        redirect(site_url());
//    }
    public function get_supplier_billing_and_shipping_details($id)
    {
        $this->load->model('supplier_model');
        echo json_encode($this->supplier_model->get_supplier_billing_and_shipping_details($id));
    }
    /* Change client status / active / inactive */
    public function change_supplier_contact_status($id, $status)
    {
        $this->load->model('supplier_model');
        if (has_permission('suppliers', '', 'edit')) {
            if ($this->input->is_ajax_request()) {
                $this->supplier_model->change_supplier_contact_status($id, $status);
            }
        }
    }
    /* Since version 1.0.2 zip client invoices */
    public function zip_invoices($id)
    {
        $this->load->model('supplier_model');
        if (!has_permission('invoices', '', 'view')) {
            access_denied('Zip Supplier Invoices');
        }
        if ($this->input->post()) {
            $status        = $this->input->post('invoice_zip_status');
            $zip_file_name = $this->input->post('file_name');
            if ($this->input->post('zip-to') && $this->input->post('zip-from')) {
                $from_date = to_sql_date($this->input->post('zip-from'));
                $to_date   = to_sql_date($this->input->post('zip-to'));
                if ($from_date == $to_date) {
                    $this->db->where('date', $from_date);
                } else {
                    $this->db->where('date BETWEEN "' . $from_date . '" AND "' . $to_date . '"');
                }
            }
            $this->db->select('id');
            $this->db->from('tblinvoices');
            if ($status != 'all') {
                $this->db->where('status', $status);
            }
            $this->db->where('supplierid', $id);
            $this->db->order_by('date', 'desc');
            $invoices = $this->db->get()->result_array();
            $this->load->model('supplier_invoices_model');
            $this->load->helper('file');
            if (!is_really_writable(TEMP_FOLDER)) {
                show_error('/temp folder is not writable. You need to change the permissions to 777');
            }
            $dir = TEMP_FOLDER . $zip_file_name;
            if (is_dir($dir)) {
                delete_dir($dir);
            }
            if (count($invoices) == 0) {
                set_alert('warning', _l('supplier_zip_no_data_found', _l('invoices')));
                redirect(admin_url('suppliers/supplier/' . $id.'?group=invoices'));
            }
            mkdir($dir, 0777);
            foreach ($invoices as $invoice) {
                $invoice_data    = $this->supplier_invoices_model->get($invoice['id']);
                $this->pdf_zip   = invoice_pdf($invoice_data);
                $_temp_file_name = slug_it(format_invoice_number($invoice_data->id));
                $file_name       = $dir . '/' . strtoupper($_temp_file_name);
                $this->pdf_zip->Output($file_name . '.pdf', 'F');
            }
            $this->load->library('zip');
            // Read the invoices
            $this->zip->read_dir($dir, false);
            // Delete the temp directory for the client
            delete_dir($dir);
            $this->zip->download(slug_it(get_option('companyname')) . '-invoices-' . $zip_file_name . '.zip');
            $this->zip->clear_data();
        }
    }
    /* Since version 1.0.2 zip client invoices */
    public function zip_estimates($id)
    {
        if (!has_permission('estimates', '', 'view')) {
            access_denied('Zip Customer Estimates');
        }
        if ($this->input->post()) {
            $status        = $this->input->post('estimate_zip_status');
            $zip_file_name = $this->input->post('file_name');
            if ($this->input->post('zip-to') && $this->input->post('zip-from')) {
                $from_date = to_sql_date($this->input->post('zip-from'));
                $to_date   = to_sql_date($this->input->post('zip-to'));
                if ($from_date == $to_date) {
                    $this->db->where('date', $from_date);
                } else {
                    $this->db->where('date BETWEEN "' . $from_date . '" AND "' . $to_date . '"');
                }
            }
            $this->db->select('id');
            $this->db->from('tblestimates');
            if ($status != 'all') {
                $this->db->where('status', $status);
            }
            $this->db->where('supplierid', $id);
            $this->db->order_by('date', 'desc');
            $estimates = $this->db->get()->result_array();
            $this->load->helper('file');
            if (!is_really_writable(TEMP_FOLDER)) {
                show_error('/temp folder is not writable. You need to change the permissions to 777');
            }
            $this->load->model('estimates_model');
            $dir = TEMP_FOLDER . $zip_file_name;
            if (is_dir($dir)) {
                delete_dir($dir);
            }
            if (count($estimates) == 0) {
                set_alert('warning', _l('supplier_zip_no_data_found', _l('estimates')));
                redirect(admin_url('suppliers/supplier/' . $id.'?group=estimates'));
            }
            mkdir($dir, 0777);
            foreach ($estimates as $estimate) {
                $estimate_data   = $this->estimates_model->get($estimate['id']);
                $this->pdf_zip   = estimate_pdf($estimate_data);
                $_temp_file_name = slug_it(format_estimate_number($estimate_data->id));
                $file_name       = $dir . '/' . strtoupper($_temp_file_name);
                $this->pdf_zip->Output($file_name . '.pdf', 'F');
            }
            $this->load->library('zip');
            // Read the invoices
            $this->zip->read_dir($dir, false);
            // Delete the temp directory for the client
            delete_dir($dir);
            $this->zip->download(slug_it(get_option('companyname')) . '-estimates-' . $zip_file_name . '.zip');
            $this->zip->clear_data();
        }
    }
    public function zip_payments($id)
    {
        if (!$id) {
            die('No user id');
        }
        if (!has_permission('payments', '', 'view')) {
            access_denied('Zip Supplier Payments');
        }
        if ($this->input->post('zip-to') && $this->input->post('zip-from')) {
            $from_date = to_sql_date($this->input->post('zip-from'));
            $to_date   = to_sql_date($this->input->post('zip-to'));
            if ($from_date == $to_date) {
                $this->db->where('tblinvoicepaymentrecords.date', $from_date);
            } else {
                $this->db->where('tblinvoicepaymentrecords.date BETWEEN "' . $from_date . '" AND "' . $to_date . '"');
            }
        }
        $this->db->select('tblinvoicepaymentrecords.id as paymentid');
        $this->db->from('tblinvoicepaymentrecords');
        $this->db->where('tblsuppliers.supplierid', $id);
        $this->db->join('tblinvoices', 'tblinvoices.id = tblinvoicepaymentrecords.invoiceid', 'left');
        $this->db->join('tblsuppliers', 'tblsuppliers.supplierid = tblinvoices.supplierid', 'left');
        if ($this->input->post('paymentmode')) {
            $this->db->where('paymentmode', $this->input->post('paymentmode'));
        }
        $payments      = $this->db->get()->result_array();
        $zip_file_name = $this->input->post('file_name');
        $this->load->helper('file');
        if (!is_really_writable(TEMP_FOLDER)) {
            show_error('/temp folder is not writable. You need to change the permissions to 777');
        }
        $dir = TEMP_FOLDER . $zip_file_name;
        if (is_dir($dir)) {
            delete_dir($dir);
        }
        if (count($payments) == 0) {
            set_alert('warning', _l('supplier_zip_no_data_found', _l('payments')));
            redirect(admin_url('suppliers/supplier/' . $id.'?group=payments'));
        }
        mkdir($dir, 0777);
        $this->load->model('payments_model');
        $this->load->model('supplier_invoices_model');
        foreach ($payments as $payment) {
            $payment_data               = $this->payments_model->get($payment['paymentid']);
            $payment_data->invoice_data = $this->supplier_invoices_model->get($payment_data->invoiceid);
            $this->pdf_zip              = payment_pdf($payment_data);
            $file_name                  = $dir;
            $file_name .= '/' . strtoupper(_l('payment'));
            $file_name .= '-' . strtoupper($payment_data->paymentid) . '.pdf';
            $this->pdf_zip->Output($file_name, 'F');
        }
        $this->load->library('zip');
        // Read the invoices
        $this->zip->read_dir($dir, false);
        // Delete the temp directory for the client
        delete_dir($dir);
        $this->zip->download(slug_it(get_option('companyname')) . '-payments-' . $zip_file_name . '.zip');
        $this->zip->clear_data();
    }
    public function import()
    {
        $this->load->model('supplier_model');
        if (!has_permission('suppliers', '', 'create')) {
            access_denied('suppliers');
        }
        $simulate_data  = array();
        $total_imported = 0;
        if ($this->input->post()) {
            if (isset($_FILES['file_csv']['name']) && $_FILES['file_csv']['name'] != '') {
                // Get the temp file path
                $tmpFilePath = $_FILES['file_csv']['tmp_name'];
                // Make sure we have a filepath
                if (!empty($tmpFilePath) && $tmpFilePath != '') {
                    // Setup our new file path
                    $newFilePath = TEMP_FOLDER . $_FILES['file_csv']['name'];
                    if (!file_exists(TEMP_FOLDER)) {
                        mkdir(TEMP_FOLDER, 777);
                    }
                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $import_result = true;
                        $fd            = fopen($newFilePath, 'r');
                        $rows          = array();
                        while ($row = fgetcsv($fd)) {
                            $rows[] = $row;
                        }
                        $data['total_rows_post'] = count($rows);
                        fclose($fd);
                        if (count($rows) <= 1) {
                            set_alert('warning', 'Not enought rows for importing');
                            redirect(admin_url('suppliers/import'));
                        }
                        unset($rows[0]);
                        if ($this->input->post('simulate')) {
                            if (count($rows) > 500) {
                                set_alert('warning', 'Recommended splitting the CSV file into smaller files. Our recomendation is 500 row, your CSV file has ' . count($rows));
                            }
                        }
                        $supplier_contacts_fields = $this->db->list_fields('tblsuppliercontacts');
                        $db_temp_fields         = $this->db->list_fields('tblsuppliers');
                        $db_temp_fields         = array_merge($supplier_contacts_fields, $db_temp_fields);
                        $db_fields              = array();
                        foreach ($db_temp_fields as $field) {
                            if (in_array($field, $this->not_importable_supplier_fields)) {
                                continue;
                            }
                            $db_fields[] = $field;
                        }
                        $custom_fields = get_custom_fields('suppliers');
                        $_row_simulate = 0;
                        $required      = array(
                            'firstname',
                            'lastname',
                            'email',
                            'company'
                        );
                        foreach ($rows as $row) {
                            // do for db fields
                            $insert    = array();
                            $duplicate = false;
                            for ($i = 0; $i < count($db_fields); $i++) {
                                if (!isset($row[$i])) {
                                    continue;
                                }
                                if ($db_fields[$i] == 'email') {
                                    $email_exists = total_rows('tblsuppliercontacts', array(
                                        'email' => $row[$i]
                                    ));
                                    // dont insert duplicate emails
                                    if ($email_exists > 0) {
                                        $duplicate = true;
                                    }
                                }
                                // Avoid errors on required fields;
                                if (in_array($db_fields[$i], $required) && $row[$i] == '') {
                                    $row[$i] = '/';
                                } else if ($db_fields[$i] == 'country') {
                                    if ($row[$i] != '') {
                                        $this->db->where('iso2', $row[$i]);
                                        $this->db->or_where('short_name', $row[$i]);
                                        $this->db->or_where('long_name', $row[$i]);
                                        $country = $this->db->get('tblcountries')->row();
                                        if ($country) {
                                            $row[$i] = $country->country_id;
                                        } else {
                                            $row[$i] = 0;
                                        }
                                    } else {
                                        $row[$i] = 0;
                                    }
                                }
                                $insert[$db_fields[$i]] = $row[$i];
                            }
                            if ($duplicate == true) {
                                continue;
                            }
                            if (count($insert) > 0) {
                                $total_imported++;
                                $insert['datecreated'] = date('Y-m-d H:i:s');
                                if ($this->input->post('default_pass_all')) {
                                    $insert['password'] = $this->input->post('default_pass_all');
                                }
                                if (!$this->input->post('simulate')) {
                                    $insert['donotsendwelcomeemail'] = true;
                                    $supplierid                        = $this->supplier_model->add($insert, true);
                                    if ($supplierid) {
                                        if ($this->input->post('groups_in[]')) {
                                            $groups_in = $this->input->post('groups_in[]');
                                            foreach ($groups_in as $group) {
                                                $this->db->insert('tblsuppliergroups_in', array(
                                                    'supplier_id' => $supplierid,
                                                    'groupid' => $group
                                                ));
                                            }
                                        }
                                    }
                                } else {
                                    $simulate_data[$_row_simulate] = $insert;
                                    $supplierid                      = true;
                                }
                                if ($supplierid) {
                                    $insert = array();
                                    foreach ($custom_fields as $field) {
                                        if (!$this->input->post('simulate')) {
                                            if ($row[$i] != '') {
                                                $this->db->insert('tblcustomfieldsvalues', array(
                                                    'relid' => $supplierid,
                                                    'fieldid' => $field['id'],
                                                    'value' => $row[$i],
                                                    'fieldto' => 'suppliers'
                                                ));
                                            }
                                        } else {
                                            $simulate_data[$_row_simulate][$field['name']] = $row[$i];
                                        }
                                        $i++;
                                    }
                                }
                            }
                            $_row_simulate++;
                            if ($this->input->post('simulate') && $_row_simulate >= 100) {
                                break;
                            }
                        }
                        unlink($newFilePath);
                    }
                } else {
                    set_alert('warning', _l('import_upload_failed'));
                }
            }
        }
        if (count($simulate_data) > 0) {
            $data['simulate'] = $simulate_data;
        }
        if (isset($import_result)) {
            set_alert('success', _l('import_total_imported', $total_imported));
        }
        $data['groups']         = $this->supplier_model->get_groups();
        $data['not_importable'] = $this->not_importable_supplier_fields;
        $data['title']          = 'Import';
        $this->load->view('admin/suppliers/import', $data);
    }
    public function groups()
    {
        if (!is_admin()) {
            access_denied('Supplier Groups');
        }
        if ($this->input->is_ajax_request()) {
            $this->perfex_base->get_table_data('customers_groups');
        }
        $data['title'] = _l('supplier_groups');
        $this->load->view('admin/suppliers/groups_manage', $data);
    }
    public function group()
    {
        $this->load->model('supplier_model');
        if ($this->input->is_ajax_request()) {
            $data = $this->input->post();
            if ($data['id'] == '') {
                $success = $this->supplier_model->add_group($data);
                $message = '';
                if ($success == true) {
                    $message = _l('added_successfuly', _l('supplier_group'));
                }
                echo json_encode(array(
                    'success' => $success,
                    'message' => $message
                ));
            } else {
                $success = $this->supplier_model->edit_group($data);
                $message = '';
                if ($success == true) {
                    $message = _l('updated_successfuly', _l('supplier_group'));
                }
                echo json_encode(array(
                    'success' => $success,
                    'message' => $message
                ));
            }
        }
    }
    public function delete_group($id)
    {
        $this->load->model('supplier_model');
        if (!is_admin()) {
            access_denied('Delete Supplier Group');
        }
        if (!$id) {
            redirect(admin_url('suppliers/groups'));
        }
        $response = $this->supplier_model->delete_group($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('supplierr_group')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('supplier_group_lowercase')));
        }
        redirect(admin_url('suppliers/groups'));
    }
    public function mass_delete()
    {
        $this->load->model('supplier_model');
        do_action('before_do_suppliers_mass_delete');
        $total = 0;
        if (has_permission('suppliers', '', 'delete')) {
            $ids = $this->input->post('ids');
            if(is_array($ids)){
                foreach ($ids as $id) {
                    $response = $this->supplier_model->delete($id);
                    // if is array is not deleted becuase is referenced
                    if ($response && !is_array($response)) {
                        $total++;
                    }
                }
            }
        }
        set_alert('success', _l('total_suppliers_deleted', $total));
    }

    /* Remove client logo image / ajax */
    public function remove_supplier_profile_image()
    {
        $this->load->model('supplier_model');
        do_action('before_remove_supplier_profile_image');
        $supplierid = $this->session->userdata('supplierid');
        $member = $this->supplier_model->get($supplierid);
        if (file_exists(SUPPLIER_PROFILE_IMAGES_FOLDER . $supplierid)) {
            delete_dir(SUPPLIER_PROFILE_IMAGES_FOLDER . $supplierid);
        }
        $this->db->where('supplierid', $supplierid);
        $this->db->update('tblsuppliers', array(
            'profile_image' => NULL
        ));
        if ($this->db->affected_rows() > 0) {
            redirect(admin_url('suppliers/supplier/' . $supplierid));
        }
    }

    /* Change client status active or inactive*/
    public function change_suppliers_status($id, $status)
    {
        $this->load->model('supplier_model');
        if ($this->input->is_ajax_request()) {
            $this->supplier_model->change_suppliers_status($id, $status);
        }
    }

    /* Change client mode alami active or inactive*/
//    public function change_suppliers_mode_alami($id, $status)
//    {
//        if ($this->input->is_ajax_request()) {
//            $this->clients_model->change_clients_mode_alami($id, $status);
//        }
//    }
}
