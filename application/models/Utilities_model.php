<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Utilities_model extends CRM_Model
{
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Add new event
     * @param array $data event $_POST data
     */
    public function event($data)
    {
        $data['userid'] = get_staff_user_id();
        $data['start']  = to_sql_date($data['start'], true);
        if ($data['end'] == '') {
            unset($data['end']);
        } else {
            $data['end'] = to_sql_date($data['end'], true);
        }
        if (isset($data['public'])) {
            $data['public'] = 1;
        } else {
            $data['public'] = 0;
        }
        $data['description'] = nl2br($data['description']);
        if (isset($data['eventid'])) {
            unset($data['userid']);
            $this->db->where('eventid', $data['eventid']);
            $event = $this->db->get('tblevents')->row();
            if (!$event) {
                return false;
            }
            if ($event->isstartnotified == 1) {
                if ($data['start'] > $event->start) {
                    $data['isstartnotified'] = 0;
                }
            }
            $this->db->where('eventid', $data['eventid']);
            $this->db->update('tblevents', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
            return false;
        } else {
            $this->db->insert('tblevents', $data);
            $insert_id = $this->db->insert_id();
        }
        if ($insert_id) {
            return true;
        }
        return false;
    }
    /**
     * Get event by passed id
     * @param  mixed $id eventid
     * @return object
     */
    public function get_event_by_id($id)
    {
        $this->db->where('eventid', $id);
        return $this->db->get('tblevents')->row();
    }
    /**
     * Get all user events
     * @return array
     */
    public function get_all_events()
    {
        $is_staff_member = is_staff_member();
        $this->db->select('title,start,end,eventid,userid,color,public');
        // Check if is passed start and end date
        $this->db->where('(start BETWEEN "' . $this->input->get('start') . '" AND "' . $this->input->get('end') . '")');
        $this->db->where('userid', get_staff_user_id());
        if($is_staff_member){
             $this->db->or_where('public', 1);
        }
        return $this->db->get('tblevents')->result_array();
    }

    public function get_event($id)
    {
        $this->db->where('eventid', $id);
        return $this->db->get('tblevents')->row();
    }
    public function get_calendar_data()
    {
        $is_admin                 = is_admin();
        $has_permission_invoices  = has_permission('invoices', '', 'view');
        $has_permission_estimates = has_permission('estimates', '', 'view');
        $has_permission_contracts = has_permission('contracts', '', 'view');
        $has_permission_proposals = has_permission('proposals', '', 'view');
        $data                     = array();
        if (get_option('show_invoices_on_calendar') == 1) {
            $this->db->select('duedate as date,number,id')->from('tblinvoices')->where('status !=', 2)->where('duedate IS NOT NULL')->where('(duedate BETWEEN "' . $this->input->get('start') . '" AND "' . $this->input->get('end') . '")');
            $invoices = $this->db->get()->result_array();
            foreach ($invoices as $invoice) {
                if (!$has_permission_invoices) {
                    continue;
                }
                $number              = format_invoice_number($invoice['id']);
                $invoice['_tooltip'] = _l('calendar_invoice') . ' - ' . $number;
                $invoice['title']    = $number;
                $invoice['color']    = get_option('calendar_invoice_color');
                $invoice['url']      = admin_url('invoices/list_invoices/' . $invoice['id']);
                array_push($data, $invoice);
            }
        }
        if (get_option('show_estimates_on_calendar') == 1) {
            $this->db->select('expirydate as date,number,id')->from('tblestimates')->where('status !=', 3)->where('status !=', 4)->where('expirydate IS NOT NULL')->where('(expirydate BETWEEN "' . $this->input->get('start') . '" AND "' . $this->input->get('end') . '")');
            $estimates = $this->db->get()->result_array();
            foreach ($estimates as $estimate) {
                if (!$has_permission_estimates) {
                    continue;
                }
                $number               = format_estimate_number($estimate['id']);
                $estimate['_tooltip'] = _l('calendar_estimate') . ' - ' . $number;
                $estimate['title']    = $number;
                $estimate['color']    = get_option('calendar_estimate_color');
                $estimate['url']      = admin_url('estimates/list_estimates/' . $estimate['id']);
                array_push($data, $estimate);
            }
        }
        if(get_option('show_proposals_on_calendar') == 1){
            $this->db->select('open_till as date,subject,id')->from('tblproposals')->where('status !=', 2)->where('status !=', 3)->where('open_till IS NOT NULL')->where('(open_till BETWEEN "' . $this->input->get('start') . '" AND "' . $this->input->get('end') . '")');
            $proposals = $this->db->get()->result_array();
            foreach ($proposals as $proposal) {
                if (!$has_permission_proposals) {
                    continue;
                }
                $proposal['_tooltip'] = _l('proposal');
                $proposal['title']    = $proposal['subject'];
                $proposal['color']    = get_option('calendar_proposal_color');
                $proposal['url']      = admin_url('proposals/list_proposals/' . $proposal['id']);
                array_push($data, $proposal);
            }
        }
        if (get_option('show_tasks_on_calendar') == 1) {
            $this->db->select('duedate as date,name as title,id');
            $this->db->from('tblstafftasks');
            $this->db->where('finished', 0);
            $this->db->where('duedate IS NOT NULL');
            $this->db->where('(duedate BETWEEN "' . $this->input->get('start') . '" AND "' . $this->input->get('end') . '")');
            if (!$is_admin) {
                $this->db->where('(id IN (SELECT taskid FROM tblstafftaskassignees WHERE staffid = ' . get_staff_user_id() . ') OR id IN (SELECT taskid FROM tblstafftasksfollowers WHERE staffid = ' . get_staff_user_id() . ') OR addedfrom=' . get_staff_user_id() . ' OR is_public = 1)');
            }
            $tasks = $this->db->get()->result_array();
            foreach ($tasks as $task) {
                $name             = mb_substr($task['title'], 0, 60);
                $task['_tooltip'] = _l('calendar_task') . ' - ' . $name;
                $task['title']    = $name;
                $task['color']    = get_option('calendar_task_color');
                $task['onclick']  = 'init_task_modal(' . $task['id'] . '); return false';
                $task['url']      = '#';
                array_push($data, $task);
            }
        }
        $available_reminders = $this->perfex_base->get_available_reminders_keys();
        foreach($available_reminders as $key){
           if (get_option('show_'.$key.'_reminders_on_calendar') == 1) {
               $this->db->select('date,description,firstname,lastname,creator,staff,rel_id')->from('tblreminders')->where('isnotified', 0)->where('(date BETWEEN "' . $this->input->get('start') . '" AND "' . $this->input->get('end') . '")')->where('rel_type', $key)->join('tblstaff', 'tblstaff.staffid = tblreminders.staff');
               $reminders = $this->db->get()->result_array();
               foreach ($reminders as $reminder) {
                if ((get_staff_user_id() == $reminder['creator'] || get_staff_user_id() == $reminder['staff']) || $is_admin) {
                    $_reminder['title'] = '';
                    if (get_staff_user_id() != $reminder['staff']) {
                        $_reminder['title'] .= '(' . $reminder['firstname'] . ' ' . $reminder['lastname'] . ') ';
                    }
                    $name                  = mb_substr($reminder['description'], 0, 60);
                    $_reminder['_tooltip'] = _l('calendar_'.$key.'_reminder') . ' - ' . $name;
                    $_reminder['title'] .= $name;
                    $_reminder['date']  = $reminder['date'];
                    $_reminder['color'] = get_option('calendar_reminder_color');
                    if($key == 'customer'){
                        $url = admin_url('clients/client/' . $reminder['rel_id']);
                    } else if($key == 'invoice'){
                        $url = admin_url('invoices/list_invoices/'.$reminder['rel_id']);
                    } else if($key == 'estimate'){
                        $url = admin_url('estimates/list_estimates/'.$reminder['rel_id']);
                    } else if($key == 'lead'){
                        $url = admin_url('leads/index/' . $reminder['rel_id']);
                    } else if($key == 'proposal'){
                        $url = admin_url('proposals/list_proposals/' . $reminder['rel_id']);
                    } else {
                        continue;
                    }
                    $_reminder['url']   = $url;
                    array_push($data, $_reminder);
                }
            }
        }
    }

    if (get_option('show_contracts_on_calendar') == 1) {
        $this->db->select('subject as title,dateend,datestart,id')->from('tblcontracts')->where('trash', 0)->where('(dateend > "' . date('Y-m-d') . '" AND dateend IS NOT NULL AND dateend BETWEEN "' . $this->input->get('start') . '" AND "' . $this->input->get('end') . '")')->or_where('(datestart >"' . date('Y-m-d') . '" AND datestart BETWEEN "' . $this->input->get('start') . '" AND "' . $this->input->get('end') . '")');
        $contracts = $this->db->get()->result_array();
        foreach ($contracts as $contract) {
            if (!$has_permission_contracts) {
                continue;
            }
            $name                  = $contract['title'];
            $_contract['title']    = $name;
            $_contract['color']    = get_option('calendar_contract_color');
            $_contract['_tooltip'] = _l('calendar_contract') . ' - ' . $name;
            $_contract['url']      = admin_url('contracts/contract/' . $contract['id']);
            if (!empty($contract['dateend'])) {
                $_contract['date'] = $contract['dateend'];
            } else {
                $_contract['date'] = $contract['datestart'];
            }
            array_push($data, $_contract);
        }
    }
        //calendar_project
    if (get_option('show_projects_on_calendar') == 1) {
        $this->load->model('projects_model');
        $this->db->select('name as title,deadline,start_date,id')->from('tblprojects')->where('(deadline >= "' . date('Y-m-d') . '" AND deadline IS NOT NULL AND deadline BETWEEN "' . $this->input->get('start') . '" AND "' . $this->input->get('end') . '")');
        $projects = $this->db->get()->result_array();
        foreach ($projects as $project) {
            if (!$this->projects_model->is_member($project['id'])) {
                continue;
            }
            $name                 = $project['title'];
            $_project['title']    = $name;
            $_project['color']    = get_option('calendar_project_color');
            $_project['_tooltip'] = _l('calendar_project') . ' - ' . $name;
            $_project['url']      = admin_url('projects/view/' . $project['id']);
            $_project['date']     = $project['deadline'];
            array_push($data, $_project);
        }
    }
    $events = $this->get_all_events();
    foreach ($events as $event) {
        if ($event['userid'] != get_staff_user_id() && !$is_admin) {
            $event['is_not_creator'] = true;
            $event['onclick']        = true;
        }
        $event['_tooltip'] = _l('calendar_event') . ' - ' . $event['title'];
        $event['color']        = $event['color'];
        array_push($data, $event);
    }
    return $data;
}
    /**
     * Delete user event
     * @param  mixed $id event id
     * @return boolean
     */
    public function delete_event($id)
    {
        $this->db->where('eventid', $id);
        $this->db->delete('tblevents');
        if ($this->db->affected_rows() > 0) {
            logActivity('Event Deleted [' . $id . ']');
            return true;
        }
        return false;
    }

    public function get_all_sliders()
    {
        return $this->db->get('tblsliders')->result_array();
    }

    public function delete_slider($id)
    {
        $this->db->where('id', $id);
        $slider = $this->db->get('tblsliders')->row();
        if ($slider) {
            if (unlink(FRONTEND_SLIDER_FOLDER . $slider->image)) {
                $this->db->where('id', $id);
                $this->db->delete('tblsliders');
            }
            return true;
        }
        return false;
    }

    public function rename_image($id, $name = null){

            if($name == null)
            {
                return false;
            }

            if($name != null)
            {
                $this->db->set('name', $name);
            }

            //	La condition
            $this->db->where('id', (int) $id);

            return $this->db->update('tblsliders');
    }

}
