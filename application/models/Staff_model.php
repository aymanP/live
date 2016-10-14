<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Staff_model extends CRM_Model
{
    private $perm_statements = array(
        'view',
        'edit',
        'create',
        'delete',
        );
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Get staff member/s
     * @param  mixed $id Optional - staff id
     * @param  integer $active Optional get all active or inactive
     * @return mixed if id is passed return object else array
     */
    public function get($id = '', $active = '', $where = array())
    {
        if (is_int($active)) {
            $this->db->where('active', $active);
        }
        if (is_numeric($id)) {
            $this->db->where('staffid', $id);
            return $this->db->get('tblstaff')->row();
        }
        $this->db->order_by('firstname', 'desc');
        return $this->db->get('tblstaff')->result_array();
    }
    /**
     * Add new staff member
     * @param array $data staff $_POST data
     */
    public function add($data)
    {
        // First check for all cases if the email exists.
        $this->db->where('email', $data['email']);
        $email = $this->db->get('tblstaff')->row();
        if ($email) {
           die('Email already exists');
        }
        $data['admin'] = 0;
        if (is_admin()) {
            if (isset($data['administrator'])) {
                $data['admin'] = 1;
                unset($data['administrator']);
            }
        }

        $this->load->helper('phpass');
        $hasher              = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        $data['password']    = $hasher->HashPassword($data['password']);
        $data['datecreated'] = date('Y-m-d H:i:s');
        if (isset($data['departments'])) {
            $departments = $data['departments'];
            unset($data['departments']);
        }

        $permissions = array();
        if (isset($data['view'])) {
            $permissions['view'] = $data['view'];
            unset($data['view']);
        }
        if (isset($data['edit'])) {
            $permissions['edit'] = $data['edit'];
            unset($data['edit']);
        }
        if (isset($data['create'])) {
            $permissions['create'] = $data['create'];
            unset($data['create']);
        }
        if (isset($data['delete'])) {
            $permissions['delete'] = $data['delete'];
            unset($data['delete']);
        }

        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }
        $this->db->insert('tblstaff', $data);
        $staffid = $this->db->insert_id();
        if ($staffid) {

            $sl = $data['firstname'].' '.$data['lastname'];
            if($sl == ' '){
                $sl = 'unknown-'.$staffid;
            }
            $this->db->where('staffid',$staffid);
            $this->db->update('tblstaff',array('media_path_slug'=>slug_it($sl)));

            if (isset($custom_fields)) {
                handle_custom_fields_post($staffid, $custom_fields);
            }
            if (isset($departments)) {
                foreach ($departments as $department) {
                    $this->db->insert('tblstaffdepartments', array(
                        'staffid' => $staffid,
                        'departmentid' => $department
                    ));
                }
            }


        $_all_permissions = $this->roles_model->get_permissions();
        foreach($_all_permissions as $permission){
            $this->db->insert('tblstaffpermissions',array(
                'permissionid'=>$permission['permissionid'],
                'staffid'=>$staffid,
                'can_view'=>0,
                'can_edit'=>0,
                'can_create'=>0,
                'can_delete'=>0,
                ));
        }
        foreach($this->perm_statements as $c){
            foreach($permissions as $key => $p){
                if($key == $c){
                    foreach($p as $perm){
                        $this->db->where('staffid',$staffid);
                        $this->db->where('permissionid',$perm);
                        $this->db->update('tblstaffpermissions',array(
                            'can_'.$c=>1
                            ));
                    }
                }
            }
        }

            logActivity('New Staff Member Added [ID: ' . $staffid . ', ' . $data['firstname'] . ' ' . $data['lastname'] . ']');
            // Delete all staff permission if is admin we dont need permissions stored in database (in case admin check some permissions)
            if ($data['admin'] == 1) {
                $this->db->where('staffid', $staffid);
                $this->db->delete('tblstaffpermissions');
            }
            // Get all announcements and set it to read.
            $this->db->select('announcementid');
            $this->db->from('tblannouncements');
            $this->db->where('showtostaff', 1);
            $announcements = $this->db->get()->result_array();
            foreach ($announcements as $announcement) {
                $this->db->insert('tbldismissedannouncements', array(
                    'announcementid' => $announcement['announcementid'],
                    'staff' => 1,
                    'userid' => $staffid
                ));
            }
            return $staffid;
        }
        return false;
    }
    /**
     * Update staff member info
     * @param  array $data staff data
     * @param  mixed $id   staff id
     * @return boolean
     */
    public function update($data, $id)
    {
        $hook_data['data'] = $data;
        $hook_data['userid'] = $id;
        $hook_data = do_action('before_update_staff_member',$hook_data);
        $data = $hook_data['data'];
        $id = $hook_data['userid'];

        if (is_admin()) {
            if (isset($data['administrator'])) {
                $data['admin'] = 1;
                unset($data['administrator']);
            } else {
                if ($id != get_staff_user_id()) {
                    if ($id == 1) {
                        return array('cant_remove_main_admin'=>true);
                    }
                } else {
                    return array('cant_remove_yourself_from_admin'=>true);
                }
                $data['admin'] = 0;
            }
        }

        $affectedRows = 0;
        if (isset($data['departments'])) {
            $departments = $data['departments'];
            unset($data['departments']);
        }
        $permissions = array();
        if (isset($data['view'])) {
            $permissions['view'] = $data['view'];
            unset($data['view']);
        }
        if (isset($data['edit'])) {
            $permissions['edit'] = $data['edit'];
            unset($data['edit']);
        }
        if (isset($data['create'])) {
            $permissions['create'] = $data['create'];
            unset($data['create']);
        }
        if (isset($data['delete'])) {
            $permissions['delete'] = $data['delete'];
            unset($data['delete']);
        }
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $this->load->helper('phpass');
            $hasher                       = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $data['password']             = $hasher->HashPassword($data['password']);
            $data['last_password_change'] = date('Y-m-d H:i:s');
        }

        if (isset($data['is_not_staff'])) {
            $data['is_not_staff'] = 1;
        } else {
            $data['is_not_staff'] = 0;
        }

        $this->load->model('departments_model');
        $staff_departments = $this->departments_model->get_staff_departments($id);
        if (sizeof($staff_departments) > 0) {
            if (!isset($data['departments'])) {
                $this->db->where('staffid', $id);
                $this->db->delete('tblstaffdepartments');
            } else {
                foreach ($staff_departments as $staff_department) {
                    if (isset($departments)) {
                        if (!in_array($staff_department['departmentid'], $departments)) {
                            $this->db->where('staffid', $id);
                            $this->db->where('departmentid', $staff_department['departmentid']);
                            $this->db->delete('tblstaffdepartments');
                            if ($this->db->affected_rows() > 0) {
                                $affectedRows++;
                            }
                        }
                    }
                }
            }
            if (isset($departments)) {
                foreach ($departments as $department) {
                    $this->db->where('staffid', $id);
                    $this->db->where('departmentid', $department);
                    $_exists = $this->db->get('tblstaffdepartments')->row();
                    if (!$_exists) {
                        $this->db->insert('tblstaffdepartments', array(
                            'staffid' => $id,
                            'departmentid' => $department
                        ));
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                }
            }
        } else {
            if (isset($departments)) {
                foreach ($departments as $department) {
                    $this->db->insert('tblstaffdepartments', array(
                        'staffid' => $id,
                        'departmentid' => $department
                    ));
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
        }


        $this->db->where('staffid', $id);
        $this->db->update('tblstaff', $data);
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }

            $all_permissions = $this->roles_model->get_permissions();
            if(total_rows('tblstaffpermissions',array('staffid'=>$id)) == 0){
                foreach($all_permissions as $p ){
                    $_ins = array();
                    $_ins['staffid'] = $id;
                    $_ins['permissionid'] = $p['permissionid'];
                    $this->db->insert('tblstaffpermissions',$_ins);
                }
            } else if(total_rows('tblstaffpermissions',array('staffid'=>$id)) != count($all_permissions)){

                 foreach($all_permissions as $p ){
                    if(total_rows('tblstaffpermissions',array('staffid'=>$id,'permissionid'=>$p['permissionid'])) == 0){
                        $_ins = array();
                        $_ins['staffid'] = $id;
                        $_ins['permissionid'] = $p['permissionid'];
                        $this->db->insert('tblstaffpermissions',$_ins);
                    }
                }
            }
            $_permission_restore_affected_rows = 0;
            foreach($all_permissions as $permission){
                foreach($this->perm_statements as $c){
                    $this->db->where('staffid',$id);
                    $this->db->where('permissionid',$permission['permissionid']);
                    $this->db->update('tblstaffpermissions',array('can_'.$c=>0));
                    if($this->db->affected_rows() > 0){
                        $_permission_restore_affected_rows++;
                    }
                }
            }
            $_new_permissions_added_affected_rows = 0;
            foreach($permissions as $key=>$val){
                foreach($val as $p){
                    $this->db->where('staffid',$id);
                    $this->db->where('permissionid',$p);
                    $this->db->update('tblstaffpermissions',array('can_'.$key=>1));
                    if($this->db->affected_rows() > 0){
                        $_new_permissions_added_affected_rows++;
                    }
                }
            }
            if($_new_permissions_added_affected_rows != $_permission_restore_affected_rows){
                $affectedRows++;
            }

        if (isset($data['admin']) && $data['admin'] == 1) {
            $this->db->where('staffid', $id);
            $this->db->delete('tblstaffpermissions');
        }
        if ($affectedRows > 0) {
            logActivity('Staff Member Updated [ID: ' . $id . ', ' . $data['firstname'] . ' ' . $data['lastname'] . ']');
            return true;
        }
        return false;
    }
    public function update_profile($data,$id){

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $this->load->helper('phpass');
            $hasher                       = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $data['password']             = $hasher->HashPassword($data['password']);
            $data['last_password_change'] = date('Y-m-d H:i:s');
        }
        $this->db->where('staffid',$id);
        $this->db->update('tblstaff',$data);
        if($this->db->affected_rows() > 0){
            logActivity('Staff Profile Updated [Staff: '.get_staff_full_name($id).']');
            return true;
        }
        return false;
    }
    /**
     * Change staff passwordn
     * @param  mixed $data   password data
     * @param  mixed $userid staff id
     * @return mixed
     */
    public function change_password($data, $userid)
    {
        $hook_data['data'] = $data;
        $hook_data['userid'] = $userid;
        $hook_data = do_action('before_staff_change_password',$hook_data);
        $data = $hook_data['data'];
        $userid = $hook_data['userid'];

        $member = $this->get($userid);
        // CHeck if member is active
        if ($member->active == 0) {
            return array(
                array(
                    'memberinactive' => true
                )
            );
        }
        $this->load->helper('phpass');
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        // Check new old password
        if (!$hasher->CheckPassword($data['oldpassword'], $member->password)) {
            return array(
                array(
                    'passwordnotmatch' => true
                )
            );
        }
        $data['newpasswordr'] = $hasher->HashPassword($data['newpasswordr']);
        $this->db->where('staffid', $userid);
        $this->db->update('tblstaff', array(
            'password' => $data['newpasswordr'],
            'last_password_change' => date('Y-m-d H:i:s')
        ));
        if ($this->db->affected_rows() > 0) {
            logActivity('Staff Password Changed [' . $userid . ']');
            return true;
        }
        return false;
    }
    /**
     * Change staff status / active / inactive
     * @param  mixed $id     staff id
     * @param  mixed $status status(0/1)
     */
    public function change_staff_status($id, $status)
    {
        $hook_data['id'] = $id;
        $hook_data['status'] = $status;
        $hook_data = do_action('before_staff_status_change',$hook_data);
        $status = $hook_data['status'];
        $id = $hook_data['id'];

        $this->db->where('staffid', $id);
        $this->db->update('tblstaff', array(
            'active' => $status
        ));
        logActivity('Staff Status Changed [StaffID: ' . $id . ' - Status(Active/Inactive): ' . $status . ']');
    }
    public function get_logged_time_data($id = ''){
        if($id == ''){
            $id = get_staff_user_id();
        }

        $result['total'] = array();
        $result['this_month'] = array();

        $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
        $last_day_this_month  = date('Y-m-t');

        $result['last_month'] = array();
        $first_day_last_month = date('Y-m-01',strtotime('-1 MONTH')); // hard-coded '01' for first day
        $last_day_last_month  = date('Y-m-t',strtotime('-1 MONTH'));

        $result['this_week'] = array();
        $first_day_this_week = date('Y-m-d', strtotime('monday this week'));
        $last_day_this_week  = date('Y-m-d', strtotime('sunday this week'));

        $result['last_week'] = array();

        $first_day_last_week = date('Y-m-d', strtotime('monday last week'));
        $last_day_last_week  = date('Y-m-d', strtotime('sunday last week'));

        $this->db->where('staff_id',$id);
        $timers = $this->db->get('tbltaskstimers')->result_array();
        foreach($timers as $timer){
            $total = time() - $timer['start_time'];
            $start_date = strftime('%Y-%m-%d', $timer['start_time']);
            if($timer['end_time'] != NULL){
                $total = $timer['end_time'] - $timer['start_time'];
            }
            $result['total'][] = $total;

            if ($start_date > $first_day_this_month && $start_date < $last_day_this_month)
            {
                $result['this_month'][] = $total;
            }
            if ($start_date > $first_day_last_month && $start_date < $last_day_last_month)
            {
                $result['this_month'][] = $total;
            }
            if ($start_date > $first_day_this_week && $start_date < $last_day_this_week)
            {
                $result['this_week'][] = $total;
            }
            if ($start_date > $first_day_last_week && $start_date < $last_day_last_week)
            {
                $result['last_week'][] = $total;
            }
        }
        $result['total'] = array_sum($result['total']);
        $result['this_month'] = array_sum($result['this_month']);
        $result['last_month'] = array_sum($result['last_month']);
        $result['this_week'] = array_sum($result['this_week']);
        $result['last_week'] = array_sum($result['last_week']);
        return $result;
    }
}
