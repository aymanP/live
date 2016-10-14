<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');
    }
    /* View all settings */
    public function index()
    {
        if (!has_permission('settings', '', 'view')) {
            access_denied('settings');
        }
        if ($this->input->post()) {
            if (!has_permission('settings', '', 'edit')) {
                access_denied('settings');
            }
            handle_company_logo_upload();
            handle_favicon_upload();
            $post_data = $this->input->post();
            $success   = $this->settings_model->update($post_data);
            if ($success > 0) {
                set_alert('success', _l('settings_updated'));
            }
            redirect(admin_url('settings?' . $_SERVER['QUERY_STRING']),'refresh');
        }
        $this->load->model('taxes_model');
        $this->load->model('tickets_model');
        $this->load->model('leads_model');
        $data['taxes']             = $this->taxes_model->get();
        $data['ticket_priorities'] = $this->tickets_model->get_priority();
        $data['ticket_priorities']['callback_translate'] = 'ticket_priority_translate';
        $data['roles']             = $this->roles_model->get();
        $data['leads_sources'] = $this->leads_model->get_source();
        $data['leads_statuses'] = $this->leads_model->get_status();
        $data['title']             = _l('options');
        if (!$this->input->get('group')) {
            $view = 'general';
        } else {
            $view = $this->input->get('group');
        }
        $data['contacts_permissions'] = $this->perfex_base->get_contact_permissions();
        $this->load->library('pdf');
        $data['group']      = $this->input->get('group');
        $data['group_view'] = $this->load->view('admin/settings/includes/' . $view, $data, true);
        $this->load->view('admin/settings/all', $data);
    }
    public function check_new_version()
    {
        if (is_connected() && is_admin()) {
            $current  = $this->db->get('tblmigrations')->row()->version;
            $response = json_decode(@file_get_contents('http://perfexcrm.com/chk_new_version.php?installed_version=' . $current));
            if (isset($response->response)) {
                echo $response->data;
                die;
            }
        }
    }
    /* Remove company logo from settings / ajax */
    public function remove_company_logo()
    {
        do_action('before_remove_company_logo');
        if (!has_permission('settings', '', 'delete')) {
            access_denied('settings');
        }
        if (file_exists(COMPANY_FILES_FOLDER . '/' . get_option('company_logo'))) {
            unlink(COMPANY_FILES_FOLDER . '/' . get_option('company_logo'));
        }
        update_option('company_logo', '');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function remove_favicon()
    {
        do_action('before_remove_favicon');
        if (!has_permission('settings', '', 'delete')) {
            access_denied('settings');
        }
        if (file_exists(COMPANY_FILES_FOLDER . '/' . get_option('favicon'))) {
            unlink(COMPANY_FILES_FOLDER . '/' . get_option('favicon'));
        }
        update_option('favicon', '');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function new_pdf_company_field()
    {
        if (!has_permission('settings', '', 'create')) {
            access_denied('settings');
        }
        if ($this->input->post()) {
            $success = $this->settings_model->add_new_company_pdf_field($this->input->post());
            if ($success === true) {
                set_alert('success', _l('added_successfuly', _l('new_company_field_name')));
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }
    public function delete_option($id)
    {
        if (!has_permission('settings', '', 'delete')) {
            access_denied('settings');
        }
        echo json_encode(array(
            'success' => delete_option($id)
        ));
    }
}
