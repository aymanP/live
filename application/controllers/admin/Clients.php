<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clients extends Admin_controller
{
    private $not_importable_clients_fields = array('userid', 'id', 'is_primary', 'password', 'datecreated', 'last_ip', 'last_login', 'last_password_change', 'active', 'new_pass_key', 'new_pass_key_requested', 'leadid', 'default_currency', 'profile_image', 'default_language');
    public $pdf_zip;
    function __construct()
    {
        parent::__construct();
    }
    /* List all clients */
    public function index()
    {
        if (!has_permission('customers', '', 'view')) {
            if(!have_assigned_customers()){
                access_denied('customers');
            }
        }
        if ($this->input->is_ajax_request()) {
            $this->perfex_base->get_table_data('clients');
        }
        $this->load->model('contracts_model');
        $data['contract_types'] = $this->contracts_model->get_contract_types();
        $data['groups']         = $this->clients_model->get_groups();
        $data['title']          = _l('clients');

        $this->load->model('proposals_model');
        $data['proposal_statuses'] = $this->proposals_model->get_statuses();

        $this->load->model('invoices_model');
        $data['invoice_statuses'] = $this->invoices_model->get_statuses();

        $this->load->model('estimates_model');
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();

        $this->load->model('projects_model');
        $data['project_statuses'] = $this->projects_model->get_project_statuses();

        $this->load->view('admin/clients/manage', $data);
    }


    /* Edit client or add new client*/
    public function client($id = '')
    {
        if (!has_permission('customers', '', 'view')) {
            if($id != '' && !is_customer_admin($id)){
                access_denied('customers');
            }
        }
        if ($this->input->post() && !$this->input->is_ajax_request()) {

            if ($id == '') {
                if (!has_permission('customers', '', 'create')) {
                    access_denied('customers');
                }
                $data = $this->input->post();
                $save_and_add_contact = false;
                if(isset($data['save_and_add_contact'])){
                    unset($data['save_and_add_contact']);
                    $save_and_add_contact = true;
                }
                $id = $this->clients_model->add($data);
                if ($id) {
                    set_alert('success', _l('added_successfuly', _l('client')));
                    if($save_and_add_contact == false){
                        redirect(admin_url('clients/client/' . $id));
                    } else {
                        redirect(admin_url('clients/client/' . $id.'?new_contact=true'));
                    }
                }
            } else {

                if (!has_permission('customers', '', 'edit')) {
                    if(!is_customer_admin($id)){
                        access_denied('customers');
                    }
                }
                $clientid = $this->session->userdata('clientid');

                handle_client_profile_image_upload($clientid);
                $success = $this->clients_model->update($this->input->post(), $id);
                if ($success == true) {
                    set_alert('success', _l('updated_successfuly', _l('client')));
                }
                redirect(admin_url('clients/client/' . $id));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('client_lowercase'));
        } else {
            $client = $this->clients_model->get($id);
            if (!$client) {
                blank_page('Client Not Found');
            }
            $this->session->set_userdata('clientid', $id);
            $this->load->model('staff_model');
            $data['staff'] = $this->staff_model->get('',1);
            $data['customer_admins'] = $this->clients_model->get_admins($id);
            $this->load->model('payment_modes_model');
            $data['payment_modes'] = $this->payment_modes_model->get();
            $data['attachments']   = $this->clients_model->get_all_customer_attachments($id);
            $data['client']        = $client;
            $title                 = $client->company;
            // Get all active staff members (used to add reminder)
            $this->load->model('staff_model');
            $data['members'] = $this->staff_model->get('', 1);
            if ($this->input->is_ajax_request()) {
                $this->perfex_base->get_table_data('tickets', array(
                    'userid' => $id
                ));
            }
            $data['customer_groups'] = $this->clients_model->get_customer_groups($id);

            $this->load->model('estimates_model');
            $data['estimate_statuses'] = $this->estimates_model->get_statuses();

            $this->load->model('invoices_model');
            $data['invoice_statuses'] = $this->invoices_model->get_statuses();
        }
        if (!$this->input->get('group')) {
            $group = 'profile';
        } else {
            $group = $this->input->get('group');
        }
        $data['group']  = $group;
        $data['groups'] = $this->clients_model->get_groups();
        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();
        $data['user_notes'] = $this->misc_model->get_notes($id, 'customer');

        $this->load->model('projects_model');
        $data['project_statuses'] = $this->projects_model->get_project_statuses();

        $data['title']      = $title;
        $this->load->view('admin/clients/client', $data);
    }
    public function contact($customer_id, $contact_id = '')
    {
        if (!has_permission('customers', '', 'view')) {
            if(!is_customer_admin($customer_id)){
                echo _l('access_denied');
                die;
            }
        }
        $data['customer_id'] = $customer_id;
        $data['contactid']   = $contact_id;
        if ($this->input->post()) {
            $data = $this->input->post();
            unset($data['contactid']);
            if ($contact_id == '') {
                if (!has_permission('customers', '', 'create')) {
                 if(!is_customer_admin($customer_id)){
                    header('HTTP/1.0 400 Bad error');
                    echo json_encode(array(
                        'success' => false,
                        'message' => _l('access_denied')
                    ));
                    die;
                }
                }
                $id      = $this->clients_model->add_contact($data, $customer_id);
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
                if (!has_permission('customers', '', 'edit')) {
                if(!is_customer_admin($customer_id)){
                    header('HTTP/1.0 400 Bad error');
                    echo json_encode(array(
                        'success' => false,
                        'message' => _l('access_denied')
                    ));
                    die;
                }
                }
                $success = $this->clients_model->update_contact($data, $contact_id);
                $message = '';
                if (is_array($success)) {
                    if (isset($success['set_password_email_sent'])) {
                        $message = _l('set_password_email_sent_to_client');
                    } else if (isset($success['set_password_email_sent_and_profile_updated'])) {
                        $message = _l('set_password_email_sent_to_client_and_profile_updated');
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
            $data['contact'] = $this->clients_model->get_contact($contact_id);
            $title           = $data['contact']->firstname . ' ' . $data['contact']->lastname;
        }

        $data['customer_permissions'] = $this->perfex_base->get_contact_permissions();
        $data['title'] = $title;
        $this->load->view('admin/clients/modals/contact', $data);
    }
    public function assign_admins($id){
        if (!has_permission('customers', '', 'create') && !has_permission('customers', '', 'edit')) {
            access_denied('customers');
        }
        $success = $this->clients_model->assign_admins($this->input->post(),$id);
        if ($success == true) {
            set_alert('success', _l('updated_successfuly', _l('client')));
        }

        redirect(admin_url('clients/client/'.$id.'?tab=customer_admins'));

    }
    public function delete_contact($customer_id,$id)
    {
        if (!has_permission('customers', '', 'delete')) {
            if(!is_customer_admin($customer_id)){
                access_denied('customers');
            }
        }
        $this->clients_model->delete_contact($id);
        redirect(admin_url('clients/client/'.$customer_id.'?tab=contacts'));
    }
    public function contacts($client_id)
    {
        $this->perfex_base->get_table_data('contacts', array(
            'client_id' => $client_id
        ));
    }
    public function upload_attachment($id)
    {
        handle_client_attachments_upload($id);
    }
    public function delete_attachment($customer_id, $id)
    {
        if (has_permission('customers', '', 'delete') || is_customer_admin($customer_id)) {
            $this->clients_model->delete_attachment($id);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    /* Delete client */
    public function delete($id)
    {
        if (!has_permission('customers', '', 'delete')) {
            access_denied('customers');
        }
        if (!$id) {
            redirect(admin_url('clients'));
        }
        $response = $this->clients_model->delete($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('client_delete_invoices_warning'));
        } else if ($response == true) {
            set_alert('success', _l('deleted', _l('client')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('client_lowercase')));
        }
        redirect(admin_url('clients'));
    }
    /* Staff can login as client */
    public function login_as_client($id)
    {
        if (has_permission('customers', '', 'create') || is_customer_admin($id)) {
            $this->clients_model->login_as_client($id);
        }
        do_action('after_contact_login');
        redirect(site_url());
    }
    public function get_customer_billing_and_shipping_details($id)
    {
        echo json_encode($this->clients_model->get_customer_billing_and_shipping_details($id));
    }
    /* Change client status / active / inactive */
    public function change_contact_status($id, $status)
    {
        if (has_permission('customers', '', 'edit')) {
            if ($this->input->is_ajax_request()) {
                $this->clients_model->change_contact_status($id, $status);
            }
        }
    }
    /* Since version 1.0.2 zip client invoices */
    public function zip_invoices($id)
    {
        if (!has_permission('invoices', '', 'view')) {
            access_denied('Zip Customer Invoices');
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
            $this->db->where('clientid', $id);
            $this->db->order_by('date', 'desc');
            $invoices = $this->db->get()->result_array();
            $this->load->model('invoices_model');
            $this->load->helper('file');
            if (!is_really_writable(TEMP_FOLDER)) {
                show_error('/temp folder is not writable. You need to change the permissions to 777');
            }
            $dir = TEMP_FOLDER . $zip_file_name;
            if (is_dir($dir)) {
                delete_dir($dir);
            }
            if (count($invoices) == 0) {
                set_alert('warning', _l('client_zip_no_data_found', _l('invoices')));
                redirect(admin_url('clients/client/' . $id.'?group=invoices'));
            }
            mkdir($dir, 0777);
            foreach ($invoices as $invoice) {
                $invoice_data    = $this->invoices_model->get($invoice['id']);
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
            $this->db->where('clientid', $id);
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
                set_alert('warning', _l('client_zip_no_data_found', _l('estimates')));
                redirect(admin_url('clients/client/' . $id.'?group=estimates'));
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
            access_denied('Zip Customer Payments');
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
        $this->db->where('tblclients.userid', $id);
        $this->db->join('tblinvoices', 'tblinvoices.id = tblinvoicepaymentrecords.invoiceid', 'left');
        $this->db->join('tblclients', 'tblclients.userid = tblinvoices.clientid', 'left');
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
            set_alert('warning', _l('client_zip_no_data_found', _l('payments')));
            redirect(admin_url('clients/client/' . $id.'?group=payments'));
        }
        mkdir($dir, 0777);
        $this->load->model('payments_model');
        $this->load->model('invoices_model');
        foreach ($payments as $payment) {
            $payment_data               = $this->payments_model->get($payment['paymentid']);
            $payment_data->invoice_data = $this->invoices_model->get($payment_data->invoiceid);
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
        if (!has_permission('customers', '', 'create')) {
            access_denied('customers');
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
                            redirect(admin_url('clients/import'));
                        }
                        unset($rows[0]);
                        if ($this->input->post('simulate')) {
                            if (count($rows) > 500) {
                                set_alert('warning', 'Recommended splitting the CSV file into smaller files. Our recomendation is 500 row, your CSV file has ' . count($rows));
                            }
                        }
                        $client_contacts_fields = $this->db->list_fields('tblcontacts');
                        $db_temp_fields         = $this->db->list_fields('tblclients');
                        $db_temp_fields         = array_merge($client_contacts_fields, $db_temp_fields);
                        $db_fields              = array();
                        foreach ($db_temp_fields as $field) {
                            if (in_array($field, $this->not_importable_clients_fields)) {
                                continue;
                            }
                            $db_fields[] = $field;
                        }
                        $custom_fields = get_custom_fields('customers');
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
                                    $email_exists = total_rows('tblcontacts', array(
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
                                    $clientid                        = $this->clients_model->add($insert, true);
                                    if ($clientid) {
                                        if ($this->input->post('groups_in[]')) {
                                            $groups_in = $this->input->post('groups_in[]');
                                            foreach ($groups_in as $group) {
                                                $this->db->insert('tblcustomergroups_in', array(
                                                    'customer_id' => $clientid,
                                                    'groupid' => $group
                                                ));
                                            }
                                        }
                                    }
                                } else {
                                    $simulate_data[$_row_simulate] = $insert;
                                    $clientid                      = true;
                                }
                                if ($clientid) {
                                    $insert = array();
                                    foreach ($custom_fields as $field) {
                                        if (!$this->input->post('simulate')) {
                                            if ($row[$i] != '') {
                                                $this->db->insert('tblcustomfieldsvalues', array(
                                                    'relid' => $clientid,
                                                    'fieldid' => $field['id'],
                                                    'value' => $row[$i],
                                                    'fieldto' => 'customers'
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
        $data['groups']         = $this->clients_model->get_groups();
        $data['not_importable'] = $this->not_importable_clients_fields;
        $data['title']          = 'Import';
        $this->load->view('admin/clients/import', $data);
    }
    public function groups()
    {
        if (!is_admin()) {
            access_denied('Customer Groups');
        }
        if ($this->input->is_ajax_request()) {
            $this->perfex_base->get_table_data('customers_groups');
        }
        $data['title'] = _l('customer_groups');
        $this->load->view('admin/clients/groups_manage', $data);
    }
    public function group()
    {
        if ($this->input->is_ajax_request()) {
            $data = $this->input->post();
            if ($data['id'] == '') {
                $success = $this->clients_model->add_group($data);
                $message = '';
                if ($success == true) {
                    $message = _l('added_successfuly', _l('customer_group'));
                }
                echo json_encode(array(
                    'success' => $success,
                    'message' => $message
                ));
            } else {
                $success = $this->clients_model->edit_group($data);
                $message = '';
                if ($success == true) {
                    $message = _l('updated_successfuly', _l('customer_group'));
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
        if (!is_admin()) {
            access_denied('Delete Customer Group');
        }
        if (!$id) {
            redirect(admin_url('clients/groups'));
        }
        $response = $this->clients_model->delete_group($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('customer_group')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('customer_group_lowercase')));
        }
        redirect(admin_url('clients/groups'));
    }
    public function mass_delete()
    {   do_action('before_do_clients_mass_delete');
        $total = 0;
        if (has_permission('customers', '', 'delete')) {
            $ids = $this->input->post('ids');
            if(is_array($ids)){
                foreach ($ids as $id) {
                    $response = $this->clients_model->delete($id);
                    // if is array is not deleted becuase is referenced
                    if ($response && !is_array($response)) {
                        $total++;
                    }
                }
            }
        }
        set_alert('success', _l('total_clients_deleted', $total));
    }

    /* Remove client logo image / ajax */
    public function remove_client_profile_image()
    {
        do_action('before_remove_client_profile_image');
        $clientid = $this->session->userdata('clientid');
        $member = $this->clients_model->get($clientid);
        if (file_exists(CLIENT_PROFILE_IMAGES_FOLDER . $clientid)) {
            delete_dir(CLIENT_PROFILE_IMAGES_FOLDER . $clientid);
        }
        $this->db->where('userid', $clientid);
        $this->db->update('tblclients', array(
            'profile_image' => NULL
        ));
        if ($this->db->affected_rows() > 0) {
            redirect(admin_url('clients/client/' . $clientid));
        }
    }

    /* Change client status active or inactive*/
    public function change_clients_status($id, $status)
    {
        if ($this->input->is_ajax_request()) {
            $this->clients_model->change_clients_status($id, $status);
        }
    }

    /* Change client mode alami active or inactive*/
    public function change_clients_mode_alami($id, $status)
    {
        if ($this->input->is_ajax_request()) {
            $this->clients_model->change_clients_mode_alami($id, $status);
        }
    }
}
