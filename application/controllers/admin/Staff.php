<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Staff extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
    }
    /* List all staff members */
    public function index()
    {
        if (!has_permission('staff', '', 'view')) {
            access_denied('staff');
        }
        if ($this->input->is_ajax_request()) {
            $this->perfex_base->get_table_data('staff');
        }
        $data['title'] = _l('staff_members');
        $this->load->view('admin/staff/manage', $data);
    }
    /* Add new staff member or edit existing */
    public function member($id = '')
    {
        $this->load->model('departments_model');
        if ($this->input->post()) {
            if ($id == '') {
                if (!has_permission('staff', '', 'create')) {
                    access_denied('staff');
                }
                $id = $this->staff_model->add($this->input->post());
                if ($id) {
                    set_alert('success', _l('added_successfuly', _l('staff_member')));
                    redirect(admin_url('staff/member/' . $id));
                }
            } else {
                if (!has_permission('staff', '', 'edit')) {
                    access_denied('staff');
                }
                $response = $this->staff_model->update($this->input->post(), $id);
                if(is_array($response)){
                    if(isset($response['cant_remove_main_admin'])){
                        set_alert('warning', _l('staff_cant_remove_main_admin'));
                    } else if(isset($response['cant_remove_yourself_from_admin'])){
                        set_alert('warning', _l('staff_cant_remove_yourself_from_admin'));
                    }
                } elseif ($response == true) {
                   set_alert('success', _l('updated_successfuly', _l('staff_member')));
               }
               redirect(admin_url('staff/member/' . $id));
            }
        }
        if ($id == '') {
            $title = _l('add_new', _l('staff_member_lowercase'));
        } else {
            $member                    = $this->staff_model->get($id);
            $data['member']            = $member;
            $title                     = _l('edit', _l('staff_member_lowercase')) . ' ' . $member->firstname . ' ' . $member->lastname;
            $data['staff_permissions'] = $this->roles_model->get_staff_permissions($id);
            $data['staff_departments'] = $this->departments_model->get_staff_departments($member->staffid);
            $data['logged_time'] = $this->staff_model->get_logged_time_data($id);
        }
        $data['roles']       = $this->roles_model->get();
        $data['permissions'] = $this->roles_model->get_permissions();
        $data['user_notes'] = $this->misc_model->get_notes($id, 'staff');
        $data['departments'] = $this->departments_model->get();
        $data['title']       = $title;
        $this->load->view('admin/staff/member', $data);
    }
    /* When staff edit his profile */
    public function edit_profile()
    {
        if ($this->input->post()) {
            handle_staff_profile_image_upload();
            $success = $this->staff_model->update_profile($this->input->post(), get_staff_user_id());
            if ($success) {
                set_alert('success', _l('staff_profile_updated'));
            }
            redirect(admin_url('staff/edit_profile/' . get_staff_user_id()));
        }
        $member = $this->staff_model->get(get_staff_user_id());
        $this->load->model('departments_model');
        $data['member']            = $member;
        $data['departments']       = $this->departments_model->get();
        $data['staff_departments'] = $this->departments_model->get_staff_departments($member->staffid);
        $data['title']             = $member->firstname . ' ' . $member->lastname;
        $this->load->view('admin/staff/profile', $data);
    }
    /* Remove staff profile image / ajax */
    public function remove_staff_profile_image()
    {
        do_action('before_remove_staff_profile_image');
        $member = $this->staff_model->get(get_staff_user_id());
        if (file_exists(STAFF_PROFILE_IMAGES_FOLDER . get_staff_user_id())) {
            delete_dir(STAFF_PROFILE_IMAGES_FOLDER . get_staff_user_id());
        }
        $this->db->where('staffid', get_staff_user_id());
        $this->db->update('tblstaff', array(
            'profile_image' => NULL
        ));
        if ($this->db->affected_rows() > 0) {
            redirect(admin_url('staff/edit_profile/' . get_staff_user_id()));
        }
    }
    /* When staff change his password */
    public function change_password_profile()
    {
        if ($this->input->post()) {
            $response = $this->staff_model->change_password($this->input->post(), get_staff_user_id());
            if (is_array($response) && isset($response[0]['passwordnotmatch'])) {
                set_alert('danger', _l('staff_old_password_incorect'));
            } else {
                if ($response == true) {
                    set_alert('success', _l('staff_password_changed'));
                } else {
                    set_alert('warning', _l('staff_problem_changing_password'));
                }
            }
            redirect(admin_url('staff/edit_profile'));
        }
    }
    /* View public profile. If id passed view profile by staff id else current user*/
    public function profile($id = '')
    {
        if ($id == '') {
            $id = get_staff_user_id();
        }

        $data['logged_time'] = $this->staff_model->get_logged_time_data($id);
        $data['staff_p'] = $this->staff_model->get($id);
        $this->load->model('departments_model');
        $data['staff_departments'] = $this->departments_model->get_staff_departments($data['staff_p']->staffid);
        $data['departments']       = $this->departments_model->get();
        $data['title']             = _l('staff_profile_string') . ' - ' . $data['staff_p']->firstname . ' ' . $data['staff_p']->lastname;
        // notifications
        $total_notifications       = total_rows('tblnotifications', array(
            'touserid' => get_staff_user_id()
        ));
        $data['total_pages']       = ceil($total_notifications / $this->misc_model->notifications_limit);
        $this->load->view('admin/staff/myprofile', $data);
    }
    /* Change status to staff active or inactive / ajax */
    public function change_staff_status($id, $status)
    {
        if (has_permission('staff', '', 'edit')) {
            if ($this->input->is_ajax_request()) {
                $this->staff_model->change_staff_status($id, $status);
            }
        }
    }
    /* Logged in staff notifications*/
    public function notifications()
    {
        $this->load->model('misc_model');
        if ($this->input->post()) {
            echo json_encode($this->misc_model->get_all_user_notifications($this->input->post('page')));
            die;
        }
    }
}
