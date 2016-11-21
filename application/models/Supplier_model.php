<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Supplier_model extends CRM_Model
{
    private $supplierContact_data = array('firstname', 'lastname', 'email', 'phonenumber', 'title', 'password', 'send_set_password_email', 'donotsendwelcomeemail', 'permissions');
    function __construct()
    {
        parent::__construct();
    }
    /**
     * With this function staff can login as client in the clients area
     * @param  mixed $id client id
     */


    /**
     * @param  mixed $id supplier id (optional)
     * @param  integer $active (optional) get all active or inactive
     * @return mixed
     * Get suplier object based on passed clientid if not passed clientid return array of all clients
     */
    public function get($id = false)
    {
        $this->db->join('tblcountries', 'tblcountries.country_id = tblsuppliers.country', 'left');
        if (is_numeric($id)) {
            $this->db->where('supplierid', $id);
            $supplier = $this->db->get('tblsuppliers')->row();
            return $supplier;
        }
        $this->db->order_by('company', 'asc');
        return $this->db->get('tblsuppliers')->result_array();
    }

    public function get_contact_project($id)
    {
        $this->db->where('id', $id);
        $proj= $this->db->get('tblprojects')->row();
        $this->db->where('id', $proj->suppliercontactid);
        return $this->db->get('tblsuppliercontacts')->result_array();
    }

    public function get_contact_primary($id)
    {
        $val =1;
        $this->db->where('supplierid', $id);
        $this->db->where('is_primary',$val );
        $this->db->where('email_cc',$val );
        return $this->db->get('tblsuppliercontacts')->result_array();
    }

    public function get_contacts($supplier_id = '', $where = array('active' => 1))
    {
        $this->db->where($where);
        if ($supplier_id != '') {
            $this->db->where('supplierid', $supplier_id);
        }
        $this->db->order_by('is_primary', 'DESC');
        return $this->db->get('tblsuppliercontacts')->result_array();
    }
    public function get_contact($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('tblsuppliercontacts')->row();
    }
    public function get_admins($id){
        $this->db->where('supplier_id',$id);
        return $this->db->get('tblsupplieradmins')->result_array();
    }
    public function assign_admins($data,$id){
        $affectedRows = 0;

        if(count($data) == 0){
            $this->db->where('supplier_id',$id);
            $this->db->delete('tblsupplieradmins');
            if($this->db->affected_rows() > 0){
                $affectedRows++;
            }
        } else {

            $current_admins = $this->get_admins($id);
            $current_admins_ids = array();
            foreach($current_admins as $c_admin){
                array_push($current_admins_ids,$c_admin['staff_id']);
            }
            foreach($current_admins_ids as $c_admin_id){
                if(!in_array($c_admin_id, $data['supplier_admins'])){
                    $this->db->where('staff_id',$c_admin_id);
                    $this->db->where('supplier_id',$id);
                    $this->db->delete('tblsupplieradmins');
                    if($this->db->affected_rows() > 0){
                        $affectedRows++;
                    }
                }
            }
            foreach($data['supplier_admins'] as $n_admin_id){
                if(total_rows('tblsupplieradmins',array('supplier_id'=>$id,'staff_id'=>$n_admin_id)) == 0){
                    $this->db->insert('tblsupplieradmins',array('supplier_id'=>$id,'staff_id'=>$n_admin_id,'date_assigned'=>date('Y-m-d H:i:s')));
                    if($this->db->affected_rows() > 0){
                        $affectedRows++;
                    }
                }
            }
        }
        if($affectedRows > 0){
            return true;
        }

        return false;
    }
    public function update_supplier_contact($data, $id, $supplier_request = false)
    {
        $hook_data['data'] = $data;
        $hook_data['id'] = $id;
        $hook_data = do_action('before_update_supplierContact',$hook_data);
        $data = $hook_data['data'];
        $id = $hook_data['id'];

        $affectedRows = 0;
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $this->load->helper('phpass');
            $hasher                       = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $data['password']             = $hasher->HashPassword($data['password']);
            $data['last_password_change'] = date('Y-m-d H:i:s');
        }
        $permissions = array();
        if (isset($data['permissions'])) {
            $permissions = $data['permissions'];
            unset($data['permissions']);
        }
        if (isset($data['send_set_password_email'])) {
            $send_set_password_email = true;
            unset($data['send_set_password_email']);
        }
        $supplierContact = $this->get_contact($id);
        if (isset($data['is_primary'])) {
            $data['is_primary'] = 1;
        } else {
            $data['is_primary'] = 0;
        }
        if (isset($data['email_cc'])) {
            $data['email_cc'] = 1;
        } else {
            $data['email_cc'] = 0;
        }
        // Contact cant change if is primary or not
        if ($supplier_request == true) {
            unset($data['is_primary']);
            if(isset($data['email'])){
                unset($data['email']);
            }
        }
        if (isset($send_set_password_email)) {
            $success = $this->authentication_model->set_password_email($data['email'], 0);
            if ($success) {
                $set_password_email_sent = true;
            }
        }
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }
        $this->db->where('id', $id);
        $this->db->update('tblsupplierContacts', $data);
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
            if (isset($data['is_primary']) && $data['is_primary'] == 1) {
                $this->db->where('userid', $supplierContact->supplierid);
                $this->db->where('id !=', $id);
                $this->db->update('tblsuppliercontacts', array(
                    'is_primary' => 0
                ));
            }
        }
        if ($supplier_request == false) {
            $supplier_permissions = $this->roles_model->get_supplier_contact_permissions($id);
            if (sizeof($supplier_permissions) > 0) {
                foreach ($supplier_permissions as $supplier_permission) {
                    if (!in_array($supplier_permission['permission_id'], $permissions)) {
                        $this->db->where('userid', $id);
                        $this->db->where('permission_id', $supplier_permission['permission_id']);
                        $this->db->delete('tblsuppliercontactpermissions');
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                }
                foreach ($permissions as $permission) {
                    $this->db->where('userid', $id);
                    $this->db->where('permission_id', $permission);
                    $_exists = $this->db->get('tblsuppliercontactpermissions')->row();
                    if (!$_exists) {
                        $this->db->insert('tblsuppliercontactpermissions', array(
                            'userid' => $id,
                            'permission_id' => $permission
                        ));
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                }
            } else {
                foreach ($permissions as $permission) {
                    $this->db->insert('tblsuppliercontactpermissions', array(
                        'userid' => $id,
                        'permission_id' => $permission
                    ));
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
        }
        if ($affectedRows > 0 && !isset($set_password_email_sent)) {
            logActivity('supplierContact Updated [' . $data['firstname'] . ' ' . $data['lastname'] . ']');
            return true;
        } else if ($affectedRows > 0 && isset($set_password_email_sent)) {
            return array(
                'set_password_email_sent_and_profile_updated' => true
            );
        } else if ($affectedRows == 0 && isset($set_password_email_sent)) {
            return array(
                'set_password_email_sent' => true
            );
        }
        return false;
    }
    public function add_supplier_contact($data, $supplier_id, $not_manual_request = false)
    {
        // First check for all cases if the email exists.
        $this->db->where('email', $data['email']);
        $this->db->where('supplierid', $supplier_id);
        $email = $this->db->get('tblsuppliercontacts')->row();
        if ($email) {
            die('Email already exists');
        }
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }
        if (isset($data['send_set_password_email'])) {
            $send_set_password_email = true;
            unset($data['send_set_password_email']);
        }
        if (isset($data['permissions'])) {
            $permissions = $data['permissions'];
            unset($data['permissions']);
        }
        $send_welcome_email = true;
        if (isset($data['donotsendwelcomeemail'])) {
            $send_welcome_email = false;
            unset($data['donotsendwelcomeemail']);
        } else if (strpos($_SERVER['HTTP_REFERER'], 'register') !== false) {
            $send_welcome_email = true;
        }
        // If supplier register set this auto contact as primary
        if ($not_manual_request == 1) {
            $data['is_primary'] = 1;
        }
        if (isset($data['is_primary'])) {
            $data['is_primary'] = 1;
            $this->db->where('supplierid', $supplier_id);
            $this->db->update('tblsuppliercontacts', array(
                'is_primary' => 0
            ));
        } else {
            $data['is_primary'] = 0;
        }

        if (isset($data['email_cc'])) {
            $data['email_cc'] = 1;
        } else {
            $data['email_cc'] = 0;
        }
        $data['supplierid'] = $supplier_id;
        if (isset($data['password'])) {
            $this->load->helper('phpass');
            $hasher              = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $data['password']    = $hasher->HashPassword($data['password']);
            $data['datecreated'] = date('Y-m-d H:i:s');
        }
        $_data = array(
            'data'=>$data,
            'not_manual_request'=>$not_manual_request,
        );

        $_data = do_action('before_create_supplier_contact',$_data);
        $data = $_data['data'];

        $this->db->insert('tblsuppliercontacts', $data);
        $supplierContact_id = $this->db->insert_id();

        if ($supplierContact_id) {
            if (isset($custom_fields)) {
                handle_custom_fields_post($supplierContact_id, $custom_fields);
            }
            // request from admin area
            if (!isset($permissions) && $not_manual_request == false) {
                $permissions = array();
            } else if ($not_manual_request == true) {
                $permissions  = array();
                $_permissions = $this->perfex_base->get_supplier_contact_permissions();
                $default_permissions = @unserialize(get_option('default_supplier_contact_permissions'));
                foreach ($_permissions as $permission) {
                    if(is_array($default_permissions) && in_array($permission['id'],$default_permissions)){
                        array_push($permissions, $permission['id']);
                    }
                }
            }
            foreach ($permissions as $permission) {
                $this->db->insert('tblsuppliercontactpermissions', array(
                    'supplierid' => $supplierContact_id,
                    'permission_id' => $permission
                ));
            }
            // Get all announcements and set it to read.
            $this->db->select('announcementid');
            $this->db->from('tblannouncements');
            $this->db->where('showtousers', 1);
            $announcements = $this->db->get()->result_array();
//            foreach ($announcements as $announcement) {
//                $this->db->insert('tbldismissedannouncements', array(
//                    'announcementid' => $announcement['announcementid'],
//                    'staff' => 0,
//                    'userid' => $supplierContact_id
//                ));
//            }
            if ($send_welcome_email == true) {
                $this->load->model('emails_model');
                $merge_fields = array();
                $merge_fields = array_merge($merge_fields, get_supplier_contact_merge_fields($data['supplierid'], $supplierContact_id));
                $this->emails_model->send_email_template('new-supplier-created', $data['email'], $merge_fields);
            }
            if (isset($send_set_password_email)) {
                $this->authentication_model->set_password_email($data['email'], 0);
            }
            return true;
        }
        return false;
    }
    /**
     * @param array $_POST data
     * @param client_request is this request from the customer area
     * @return integer Insert ID
     * Add new client to database
     */
    public function add($data, $supplier_or_lead_convert_request = false)
    {
        $supplierContact_data = array();
        foreach ($this->supplierContact_data as $field) {
            if (isset($data[$field])) {
                $supplierContact_data[$field] = $data[$field];
                // Phonenumber is also used for the company profile
                if ($field != 'phonenumber') {
                    unset($data[$field]);
                }
            }
        }
        // From customer profile register
        if (isset($data['supplier_contact_phonenumber'])) {
            $supplierContact_data['phonenumber'] = $data['supplier_contact_phonenumber'];
            unset($data['supplier_contact_phonenumber']);
        }
        if (isset($data['passwordr'])) {
            unset($data['passwordr']);
        }
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }
        if (isset($data['groups_in'])) {
            $groups_in = $data['groups_in'];
            unset($data['groups_in']);
        }
        if (isset($data['country']) && $data['country'] == '' || !isset($data['country'])) {
            $data['country'] = 0;
        }
        if (isset($data['billing_country']) && $data['billing_country'] == '' || !isset($data['billing_country'])) {
            $data['billing_country'] = 0;
        }
        if (isset($data['default_currency']) && $data['default_currency'] == '' || !isset($data['default_currency'])) {
            $data['default_currency'] = 0;
        }
        if (isset($data['shipping_country']) && $data['shipping_country'] == '' || !isset($data['shipping_country'])) {
            $data['shipping_country'] = 0;
        }
        $data['datecreated'] = date('Y-m-d H:i:s');
        $data                = do_action('before_supplier_added', $data);
        $this->db->insert('tblsuppliers', $data);
        $userid = $this->db->insert_id();
        if ($userid) {
            if (isset($custom_fields)) {
                $_custom_fields = $custom_fields;
                // Possible request from the register area with 2 types of custom fields for contact and for comapny/customer
                if (count($custom_fields) == 2) {
                    unset($custom_fields);
                    $custom_fields['suppliers']                = $_custom_fields['suppliers'];
                    $contact_data['custom_fields']['supplier_contacts'] = $_custom_fields['supplier_contacts'];
                } else if(count($custom_fields) == 1){
                    if(isset($_custom_fields['supplier_contacts'])){
                        $contact_data['custom_fields']['supplier_contacts'] = $_custom_fields['supplier_contacts'];
                        unset($custom_fields);
                    }
                }
                handle_custom_fields_post($userid, $custom_fields);
            }
            // If request from client area or lead convert to client add as contact too
            if ($supplier_or_lead_convert_request == true) {
                $this->add_supplier_contact($contact_data, $userid, $supplier_or_lead_convert_request);
            }
            if (isset($groups_in)) {
                foreach ($groups_in as $group) {
                    $this->db->insert('tblsuppliergroups_in', array(
                        'supplier_id' => $userid,
                        'groupid' => $group
                    ));
                }
            }
            do_action('after_supplier_added', $userid);
            $_new_supplier_log = $data['company'];
            $_is_staff       = NULL;
            if (is_staff_logged_in()) {
                $_new_supplier_log .= ' From Staff: ' . get_staff_user_id();
                $_is_staff = get_staff_user_id();
            }
            logActivity('New Client Created [' . $_new_supplier_log . ']', $_is_staff);
        }
        return $userid;
    }
    /**
     * @param  array $_POST data
     * @param  integer ID
     * @return boolean
     * Update client informations
     */
    public function update($data, $id,$supplier_request = false)
    {
        unset($data['DataTables_Table_0_length']);
        unset($data['DataTables_Table_1_length']);
        if (isset($data['update_all_other_transactions'])) {
            $update_all_other_transactions = true;
            unset($data['update_all_other_transactions']);
        }
        $affectedRows = 0;
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }
        if (isset($data['groups_in'])) {
            $groups_in = $data['groups_in'];
            unset($data['groups_in']);
        }
        if (isset($data['country']) && $data['country'] == '' || !isset($data['country'])) {
            $data['country'] = 0;
        }
        if (isset($data['billing_country']) && $data['billing_country'] == '' || !isset($data['billing_country'])) {
            $data['billing_country'] = 0;
        }
        if (isset($data['default_currency']) && $data['default_currency'] == '' || !isset($data['default_currency'])) {
            $data['default_currency'] = 0;
        }
        if (isset($data['shipping_country']) && $data['shipping_country'] == '' || !isset($data['shipping_country'])) {
            $data['shipping_country'] = 0;
        }
        $_data = do_action('before_supplier_updated', array(
            'supplierid' => $id,
            'data' => $data
        ));
        $data  = $_data['data'];
        $this->db->where('supplierid', $id);
        $this->db->update('tblsuppliers', $data);

        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
            do_action('after_supplier_updated', $id);
        }
        if (isset($update_all_other_transactions)) {
            // Update all unpaid invoices
            $this->db->where('supplierid', $id);
            $this->db->where('status !=', 2);
            $invoices = $this->db->get('tblinvoices')->result_array();
            foreach ($invoices as $invoice) {
                $this->db->where('id', $invoice['id']);
                $this->db->update('tblinvoices', array(
                    'billing_street' => $data['billing_street'],
                    'billing_city' => $data['billing_city'],
                    'billing_state' => $data['billing_state'],
                    'billing_zip' => $data['billing_zip'],
                    'billing_country' => $data['billing_country'],
                    'shipping_street' => $data['shipping_street'],
                    'shipping_city' => $data['shipping_city'],
                    'shipping_state' => $data['shipping_state'],
                    'shipping_zip' => $data['shipping_zip'],
                    'shipping_country' => $data['shipping_country']
                ));
                if ($this->db->affected_rows() > 0) {
                    $affectedRows++;
                }
            }
            // Update all estimates
            $this->db->where('supplierid', $id);
            $estimates = $this->db->get('tblestimates')->result_array();
            foreach ($estimates as $estimate) {
                $this->db->where('id', $estimate['id']);
                $this->db->update('tblestimates', array(
                    'billing_street' => $data['billing_street'],
                    'billing_city' => $data['billing_city'],
                    'billing_state' => $data['billing_state'],
                    'billing_zip' => $data['billing_zip'],
                    'billing_country' => $data['billing_country'],
                    'shipping_street' => $data['shipping_street'],
                    'shipping_city' => $data['shipping_city'],
                    'shipping_state' => $data['shipping_state'],
                    'shipping_zip' => $data['shipping_zip'],
                    'shipping_country' => $data['shipping_country']
                ));
                if ($this->db->affected_rows() > 0) {
                    $affectedRows++;
                }
            }
        }
        $customer_groups = $this->get_supplier_groups($id);
        if (sizeof($customer_groups) > 0) {
            foreach ($customer_groups as $customer_group) {
                if (isset($groups_in)) {
                    if (!in_array($customer_group['groupid'], $groups_in)) {
                        $this->db->where('supplier_id', $id);
                        $this->db->where('id', $customer_group['id']);
                        $this->db->delete('tblsuppliergroups_in');
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                } else {
                    $this->db->where('supplier_id', $id);
                    $this->db->delete('tblsuppliergroups_in');
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
            if (isset($groups_in)) {
                foreach ($groups_in as $group) {
                    $this->db->where('supplier_id', $id);
                    $this->db->where('groupid', $group);
                    $_exists = $this->db->get('tblsuppliergroups_in')->row();
                    if (!$_exists) {
                        if (empty($group)) {
                            continue;
                        }
                        $this->db->insert('tblsuppliergroups_in', array(
                            'supplier_id' => $id,
                            'groupid' => $group
                        ));
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                }
            }
        } else {
            if (isset($groups_in)) {
                foreach ($groups_in as $group) {
                    if (empty($group)) {
                        continue;
                    }
                    $this->db->insert('tblsuppliergroups_in', array(
                        'customer_id' => $id,
                        'groupid' => $group
                    ));
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
        }
        if ($affectedRows > 0) {
            logActivity('Supplier Info Updated [' . $data['company'] . ']');
            return true;
        }
        return false;
    }

    /**
     * Used to update company details from customers area
     * @param  array $data $_POST data
     * @param  mixed $id
     * @return boolean
     */
    public function update_company_details($data,$id){
        $affectedRows = 0;
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }
        if (isset($data['country']) && $data['country'] == '' || !isset($data['country'])) {
            $data['country'] = 0;
        }
        $this->db->where('supplier',$id);
        $this->db->update('tblsuppliers',$data);
        if($this->db->affected_rows() > 0){
            logActivity('Supplier Info Updated From Clients Area [' . $data['company'] . ']');
            return true;
        }
        return false;
    }

    /**
     * @param  integer ID
     * @return boolean
     * Delete client, also deleting rows from, dismissed client announcements, ticket replies, tickets, autologin, user notes
     */
    public function delete($id)
    {
        $affectedRows = 0;
        do_action('before_supplier_deleted', $id);
        if (is_reference_in_table('supplierid', 'tblinvoices', $id) || is_reference_in_table('supplierid', 'tblestimates', $id)) {
            return array(
                'referenced' => true
            );
        }
        $this->db->where('supplierid', $id);
        $this->db->delete('tblsuppliers');
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
            $this->db->where('supplierid', $id);
            $this->db->where('staff', 0);
            $this->db->delete('tbldismissedannouncements');
            // Delete all tickets start here
            $this->db->where('supplierid', $id);
            $tickets = $this->db->get('tbltickets')->result_array();
            $this->load->model('tickets_model');
            foreach ($tickets as $ticket) {
                $this->tickets_model->delete($ticket['ticketid']);
            }
            // Delete autologin if found
//            $this->db->where('user_id', $id);
//            $this->db->where('staff', 0);
//            $this->db->delete('tbluserautologin');

            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'supplier');
            $this->db->delete('tblnotes');

            // Delete all user contacts
            $this->db->where('supplierid', $id);
            $contacts = $this->db->get('tblsuppliercontacts')->result_array();
            foreach ($contacts as $contact) {
                $this->delete_supplier_contact($contact['id']);
            }
            // Get all client contracts
            $this->load->model('contracts_model');
            $this->db->where('supplier', $id);
            $contracts = $this->db->get('tblcontracts')->result_array();
            foreach ($contracts as $contract) {
                $this->contracts_model->delete($contract['id']);
            }
            // Delete the custom field values
            $this->db->where('relid', $id);
            $this->db->where('fieldto', 'suppliers');
            $this->db->delete('tblcustomfieldsvalues');
            // Get customer related tasks
            $this->load->model('tasks_model');
            $this->db->where('rel_type', 'supplier');
            $this->db->where('rel_id', $id);
            $tasks = $this->db->get('tblstafftasks')->result_array();
            foreach ($tasks as $task) {
                $this->tasks_model->delete_task($task['id']);
            }
            $this->db->where('rel_type', 'supplier');
            $this->db->where('rel_id', $id);
            $this->db->delete('tblreminders');
            // Delete all projects
            $this->load->model('projects_model');
            $this->db->where('supplierid', $id);
            $projects = $this->db->get('tblprojects')->result_array();
            foreach ($projects as $project) {
                $this->projects_model->delete($project['id']);
            }
            $this->load->model('proposals_model');
            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'supplier');
            $proposals = $this->db->get('tblproposals')->result_array();
            foreach ($proposals as $proposal) {
                $this->proposals_model->delete($proposal['id']);
            }
            $this->db->where('supplierid', $id);
            $attachments = $this->db->get('tblsupplierattachments')->result_array();
            foreach ($attachments as $attachment) {
                $this->delete_attachment($attachment['id']);
            }
        }
        if ($affectedRows > 0) {
            do_action('after_supplier_deleted');
            logActivity('Supplier Deleted [' . $id . ']');
            return true;
        }
        return false;
    }
    public function delete_supplier_contact($id)
    {
        do_action('before_delete_supplier_contact',$id);
        $this->db->where('id', $id);
        $this->db->delete('tblsuppliercontacts');
        if ($this->db->affected_rows() > 0) {
            if(is_dir(SUPPLIER_PROFILE_IMAGES_FOLDER.$id)){
                delete_dir(SUPPLIER_PROFILE_IMAGES_FOLDER.$id);
            }
            $this->db->where('relid', $id);
            $this->db->where('fieldto', 'contacts');
            $this->db->delete('tblcustomfieldsvalues');
            $this->db->where('supplierid', $id);
            $this->db->delete('tblsuppliercontactpermissions');
            return true;
        }
        return false;
    }
    /**
     * Get customer default currency
     * @param  mixed $id customer id
     * @return mixed
     */
    public function get_supplier_default_currency($id)
    {
        $this->db->where('supplierid', $id);
        $result = $this->db->get('tblsuppliers')->row();
        if($result){
            return $result->default_currency;
        }

        return false;
    }
    /**
     *  Get customer billing details
     * @param   mixed $id   customer id
     * @return  array
     */
    public function get_supplier_billing_and_shipping_details($id)
    {
        $this->db->select('billing_street,billing_city,billing_state,billing_zip,billing_country,shipping_street,shipping_city,shipping_state,shipping_zip,shipping_country');
        $this->db->from('tblsuppliers');
        $this->db->where('supplierid', $id);
        return $this->db->get()->result_array();
    }
    /**
     *  Get customer attachment
     * @param   mixed $id   customer id
     * @return  array
     */
    public function get_all_supplier_attachments($id)
    {
        $attachments              = array();
        $attachments['invoice']  = array();
        $attachments['estimate']  = array();
        $attachments['proposal']  = array();

        $attachments['contracts'] = array();
        $attachments['leads']     = array();
        $attachments['tickets']   = array();
        $attachments['tasks']     = array();
        $attachments['supplier']  = array();
        // Invoices
        $this->db->select('supplierid,id');
        $this->db->where('supplierid', $id);
        $this->db->from('tblinvoices');
        $invoices = $this->db->get()->result_array();
        foreach ($invoices as $invoice) {
            $this->db->where('rel_id', $invoice['id']);
            $this->db->where('rel_type','invoice');
            $_attachments = $this->db->get('tblsalesattachments')->result_array();
            if (count($_attachments) > 0) {
                foreach ($_attachments as $_att) {
                    array_push($attachments['invoice'], $_att);
                }
            }
        }
        // Estimates
        $this->db->select('supplierid,id');
        $this->db->where('supplierid', $id);
        $this->db->from('tblestimates');
        $estimates = $this->db->get()->result_array();
        foreach ($estimates as $estimate) {
            $this->db->where('rel_id', $estimate['id']);
            $this->db->where('rel_type','estimate');
            $_attachments = $this->db->get('tblsalesattachments')->result_array();
            if (count($_attachments) > 0) {
                foreach ($_attachments as $_att) {
                    array_push($attachments['estimate'], $_att);
                }
            }
        }

        // Proposals
        $this->db->select('rel_id,id');
        $this->db->where('rel_id', $id);
        $this->db->where('rel_type', 'supplier');
        $this->db->from('tblproposals');
        $proposals = $this->db->get()->result_array();
        foreach ($proposals as $proposal) {
            $this->db->where('rel_id', $proposal['id']);
            $this->db->where('rel_type','proposal');
            $_attachments = $this->db->get('tblsalesattachments')->result_array();
            if (count($_attachments) > 0) {
                foreach ($_attachments as $_att) {
                    array_push($attachments['proposal'], $_att);
                }
            }
        }
        // Contracts
        $this->db->select('supplier,id');
        $this->db->where('supplier', $id);
        $this->db->from('tblcontracts');
        $contracts = $this->db->get()->result_array();
        foreach ($contracts as $contract) {
            $this->db->where('contractid', $contract['id']);
            $_attachments = $this->db->get('tblcontractattachments')->result_array();
            if (count($_attachments) > 0) {
                foreach ($_attachments as $_att) {
                    array_push($attachments['contracts'], $_att);
                }
            }
        }
        $customer = $this->get($id);
        if ($customer->leadid != NULL) {
            $this->db->where('leadid', $customer->leadid);
            $_attachments = $this->db->get('tblleadattachments')->result_array();
            if (count($_attachments) > 0) {
                foreach ($_attachments as $_att) {
                    array_push($attachments['leads'], $_att);
                }
            }
        }
        $this->db->select('ticketid,supplierid');
        $this->db->where('supplierid', $id);
        $this->db->from('tbltickets');
        $tickets = $this->db->get()->result_array();
        foreach ($tickets as $ticket) {
            $this->db->where('ticketid', $ticket['ticketid']);
            $_attachments = $this->db->get('tblticketattachments')->result_array();
            if (count($_attachments) > 0) {
                foreach ($_attachments as $_att) {
                    array_push($attachments['tickets'], $_att);
                }
            }
        }
        $this->db->select('rel_id,id');
        $this->db->where('rel_id', $id);
        $this->db->where('rel_type', 'supplier');
        $this->db->from('tblstafftasks');
        $tasks = $this->db->get()->result_array();
        foreach ($tasks as $task) {
            $this->db->where('taskid', $task['id']);
            $_attachments = $this->db->get('tblstafftasksattachments')->result_array();
            if (count($_attachments) > 0) {
                foreach ($_attachments as $_att) {
                    array_push($attachments['tasks'], $_att);
                }
            }
        }
        $this->db->where('supplierid', $id);
        $supplier_main_attachments = $this->db->get('tblsupplierattachments')->result_array();
        $attachments['supplier']   = $supplier_main_attachments;
        return $attachments;
    }
    public function delete_attachment($id)
    {
        $this->db->where('id', $id);
        $attachment = $this->db->get('tblsupplierattachments')->row();
        if ($attachment) {
            if (unlink(SUPPLIER_ATTACHMENTS_FOLDER . $attachment->supplierid . '/' . $attachment->file_name)) {
                $this->db->where('id', $id);
                $this->db->delete('tblsupplierattachments');
            }
            // Check if no attachments left, so we can delete the folder also
            $other_attachments = list_files(SUPPLIER_ATTACHMENTS_FOLDER . $attachment->supplierid);
            if (count($other_attachments) == 0) {
                delete_dir(SUPPLIER_ATTACHMENTS_FOLDER . $attachment->supplierid);
            }
            return true;
        }
        return false;
    }
    /**
     * @param  integer ID
     * @param  integer Status ID
     * @return boolean
     * Update client status Active/Inactive
     */
    public function change_supplier_contact_status($id, $status)
    {
        $hook_data['id'] = $id;
        $hook_data['status'] = $status;
        $hook_data = do_action('    ',$hook_data);
        $status = $hook_data['status'];
        $id = $hook_data['id'];

        $this->db->where('id', $id);
        $this->db->update('tblsuppliercontacts', array(
            'active' => $status
        ));
        if ($this->db->affected_rows() > 0) {
            logActivity('Supplier contact Status Changed [ContactID: ' . $id . ' Status(Active/Inactive): ' . $status . ']');
            return true;
        }
        return false;
    }
    /**
     * @param  mixed $_POST data
     * @return mixed
     * Change contact password, used from client area
//     */
//    public function change_supplier_contact_password($data)
//    {
//        $hook_data['data'] = $data;
//        $hook_data = do_action('before_supplier_contact_change_password',$hook_data);
//        $data = $hook_data['data'];
//
//        // Get current password
//        $this->db->where('id', get_contact_user_id());
//        $client = $this->db->get('tblcontacts')->row();
//        $this->load->helper('phpass');
//        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
//        if (!$hasher->CheckPassword($data['oldpassword'], $client->password)) {
//            return array(
//                'old_password_not_match' => true
//            );
//        }
//        $update_data['password']             = $hasher->HashPassword($data['newpasswordr']);
//        $update_data['last_password_change'] = date('Y-m-d H:i:s');
//        $this->db->where('id', get_contact_user_id());
//        $this->db->update('tblcontacts', $update_data);
//        if ($this->db->affected_rows() > 0) {
//            logActivity('Contact Password Changed [ContactID: ' . get_contact_user_id() . ']');
//            return true;
//        }
//        return false;
//    }


    public function get_supplier_groups($id)
    {
        $this->db->where('supplier_id', $id);
        return $this->db->get('tblsuppliergroups_in')->result_array();
    }
    public function get_groups($id = '')
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);
            return $this->db->get('tblcustomersgroups')->row();
        }
        return $this->db->get('tblcustomersgroups')->result_array();
    }
    public function delete_group($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tblcustomersgroups');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('groupid', $id);
            $this->db->delete('tblsuppliergroups_in');
            logActivity('Customer Group Deleted [ID:' . $id . ']');
            return true;
        }
        return false;
    }
    public function add_group($data)
    {
        $this->db->insert('tblcustomersgroups', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Customer Group Created [ID:' . $insert_id . ', Name:' . $data['name'] . ']');
            return true;
        }
        return false;
    }
    public function edit_group($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tblcustomersgroups', array(
            'name' => $data['name']
        ));
        if ($this->db->affected_rows() > 0) {
            logActivity('Customer Group Updated [ID:' . $data['id'] . ']');
            return true;
        }
        return false;
    }

    /**
     * Change client status  / active / inactive
     */
    public function change_suppliers_status($id, $status)
    {
        $this->db->where('supplierid', $id);
        $this->db->update('tblsuppliers', array(
            'actif' => $status
        ));
        logActivity('Custom Field Status Changed [FieldID: ' . $id . ' - Active: ' . $status . ']');
    }

    /**
     * Change client mode alami  / active / inactive
     */
//    public function change_clients_mode_alami($id, $status)
//    {
//        $this->db->where('userid', $id);
//        $this->db->update('tblclients', array(
//            'mode_alami' => $status
//        ));
//        logActivity('Custom Field Mode alami Changed [FieldID: ' . $id . ' - Active: ' . $status . ']');
//    }



}
