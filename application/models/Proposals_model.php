<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Proposals_model extends CRM_Model
{
    private $statuses = array(0,4,1,2,3);
    function __construct()
    {
        parent::__construct();
    }
    public function get_statuses(){
        return $this->statuses;
    }
    public function get_sale_agents(){
        return $this->db->query("SELECT DISTINCT(assigned) as sale_agent FROM tblproposals WHERE assigned != 0")->result_array();
    }
    public function get_proposals_years(){
        return $this->db->query('SELECT DISTINCT(YEAR(date)) as year FROM tblproposals')->result_array();
    }
    /**
     * Inserting new proposal function
     * @param mixed $data $_POST data
     */
    public function add($data)
    {
        if (isset($data['allow_comments'])) {
            $data['allow_comments'] = 1;
        } else {
            $data['allow_comments'] = 0;
        }
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }
        $data['datecreated'] = date('Y-m-d H:i:s');
        $data['addedfrom']   = get_staff_user_id();
        $data['date']        = to_sql_date($this->input->post('date'));
        $data['hash']        = md5(rand() . microtime());
        // Check if the key exists
        $this->db->where('hash', $data['hash']);
        $exists = $this->db->get('tblproposals')->row();
        if ($exists) {
            $data['hash'] = md5(rand() . microtime());
        }
        if (empty($data['rel_type'])) {
            unset($data['rel_type']);
            unset($data['rel_id']);
        } else {
            if (empty($data['rel_id'])) {
                unset($data['rel_type']);
                unset($data['rel_id']);
            }
        }
        if (!empty($data['open_till'])) {
            $data['open_till'] = to_sql_date($data['open_till']);
        } else {
            unset($data['open_till']);
        }
        $this->db->insert('tblproposals', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            if (isset($custom_fields)) {
                handle_custom_fields_post($insert_id, $custom_fields);
            }
            $proposal = $this->get($insert_id);
            if ($proposal->assigned != 0) {
                if ($proposal->assigned != get_staff_user_id()) {
                    add_notification(array(
                        'description' => 'not_proposal_assigned_to_you',
                        'touserid' => $proposal->assigned,
                        'fromuserid' => get_staff_user_id(),
                        'link' => 'proposals/list_proposals/' . $insert_id,
                        'additional_data'=>serialize(array($proposal->subject))
                    ));
                }
            }
            logActivity('New Proposal Created [ID:' . $insert_id . ']');
            return $insert_id;
        }
        return false;
    }
    /**
     * Update proposal
     * @param  mixed $data $_POST data
     * @param  mixed $id   proposal id
     * @return boolean
     */
    public function update($data, $id)
    {
        $affectedRows     = 0;
        $current_proposal = $this->get($id);
        if (empty($data['rel_type'])) {
            $data['rel_id']   = NULL;
            $data['rel_type'] = '';
        } else {
            if (empty($data['rel_id'])) {
                $data['rel_id']   = NULL;
                $data['rel_type'] = '';
            }
        }
        if (isset($data['allow_comments'])) {
            $data['allow_comments'] = 1;
        } else {
            $data['allow_comments'] = 0;
        }
        $data['date'] = to_sql_date($this->input->post('date'));
        if (!empty($data['open_till'])) {
            $data['open_till'] = to_sql_date($data['open_till']);
        } else {
            $data['open_till'] = NULL;
        }
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }
        $this->db->where('id', $id);
        $this->db->update('tblproposals', $data);
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
            $proposal_now = $this->get($id);
            if ($current_proposal->assigned != $proposal_now->assigned) {
                if ($proposal_now->assigned != get_staff_user_id()) {
                    add_notification(array(
                        'description' => 'not_proposal_assigned_to_you',
                        'touserid' => $proposal_now->assigned,
                        'fromuserid' => get_staff_user_id(),
                        'link' => 'proposals/list_proposals/' . $id,
                        'additional_data'=>serialize(array($proposal_now->subject)),
                    ));
                }
            }
        }
        if ($affectedRows > 0) {
            logActivity('Proposal Updated [ID:' . $id . ']');
            return true;
        }
        return false;
    }
    /**
     * Get proposals
     * @param  mixed $id proposal id OPTIONAL
     * @return mixed
     */
    public function get($id = '',$where = array(),$for_editor = false)
    {
        $this->db->where($where);

        if(is_client_logged_in()){
            $this->db->where('status !=',0);
        }

        if (is_numeric($id)) {
            $this->db->where('id', $id);
            $proposal = $this->db->get('tblproposals')->row();
            if($proposal){
                $proposal->attachments = $this->get_attachments($id);
                $proposal->visible_attachments_to_customer_found = false;
                foreach($proposal->attachments as $attachment){
                    if($attachment['visible_to_customer'] ==1){
                        $proposal->visible_attachments_to_customer_found =true;
                        break;
                    }
                }
                if($for_editor == false){
                    $merge_fields = array();
                    $merge_fields = array_merge($merge_fields,get_proposal_merge_fields($id));
                    $merge_fields = array_merge($merge_fields,get_other_merge_fields());
                    foreach($merge_fields as $key => $val){
                        if(stripos($proposal->content,$key) !== false){
                            $proposal->content = str_ireplace($key, $val, $proposal->content);
                        } else {
                            $proposal->content = str_ireplace($key, '', $proposal->content);
                        }
                    }
                }
            }
            return $proposal;
        }
        return $this->db->get('tblproposals')->result_array();
    }
     public function update_pipeline($data)
    {
        $this->mark_action_status($data['status'], $data['proposalid']);
        foreach ($data['order'] as $order_data) {
            $this->db->where('id', $order_data[0]);
            $this->db->update('tblproposals', array(
                'pipeline_order' => $order_data[1]
            ));
        }
    }

     public function get_attachments($proposal_id, $id = '')
    {
        // If is passed id get return only 1 attachment
        if (is_numeric($id)) {
            $this->db->where('id', $id);
        } else {
            $this->db->where('rel_id', $proposal_id);
        }
        $this->db->where('rel_type','proposal');
        $result = $this->db->get('tblsalesattachments');
        if (is_numeric($id)) {
            return $result->row();
        } else {
            return $result->result_array();
        }
    }
    /**
     *  Delete proposal attachment
     * @param   mixed $id  attachmentid
     * @return  boolean
     */
    public function delete_attachment($id)
    {
        $attachment = $this->get_attachments('', $id);
        if ($attachment) {
            if (unlink(PROPOSAL_ATTACHMENTS_FOLDER . $attachment->rel_id . '/' . $attachment->file_name)) {
                $this->db->where('id', $id);
                $this->db->delete('tblsalesattachments');
                $other_attachments = list_files(PROPOSAL_ATTACHMENTS_FOLDER . $attachment->rel_id);
                if (count($other_attachments) == 0) {
                    // delete the dir if no other attachments found
                    delete_dir(PROPOSAL_ATTACHMENTS_FOLDER . $attachment->rel_id);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Add proposal comment
     * @param mixed  $data   $_POST comment data
     * @param boolean $client is request coming from the client side
     */
    public function add_comment($data,$client = false)
    {
        if(is_staff_logged_in()){
            $client = false;
        }

        if (isset($data['action'])) {
            unset($data['action']);
        }
        $data['dateadded'] = date('Y-m-d H:i:s');
        if ($client == false) {
            $data['staffid'] = get_staff_user_id();
        }
        $data['content'] = nl2br($data['content']);
        $this->db->insert('tblproposalcomments', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            $proposal = $this->get($data['proposalid']);

            $merge_fields = array();
            $merge_fields = array_merge($merge_fields,get_proposal_merge_fields($proposal->id));

            // Get creator and assigned;
            $this->db->where('staffid', $proposal->addedfrom);
            $this->db->or_where('staffid', $proposal->assigned);
            $staff_proposal = $this->db->get('tblstaff')->result_array();
            $this->load->model('emails_model');
            if ($client == true) {
                foreach ($staff_proposal as $member) {
                        add_notification(array(
                            'description' =>'not_proposal_comment_from_client',
                            'touserid' => $member['staffid'],
                            'fromcompany' => 1,
                            'fromuserid' => NULL,
                            'link' => 'proposals/list_proposals/' . $data['proposalid'],
                            'additional_data'=>serialize(array($proposal->subject)),
                        ));
                        // Send email to admin that client commented
                        $this->emails_model->send_email_template('proposal-comment-to-admin', $member['email'], $merge_fields);
                }
            } else {
                // Send email to client that admin commented
                $this->emails_model->send_email_template('proposal-comment-to-client', $proposal->email, $merge_fields);
            }
            return true;
        }
        return false;
    }
    /**
     * Get proposal comments
     * @param  mixed $id proposal id
     * @return array
     */
    public function get_comments($id)
    {
        $this->db->where('proposalid', $id);
        $this->db->order_by('dateadded', 'ASC');
        return $this->db->get('tblproposalcomments')->result_array();
    }
    /**
     * Get proposal single comment
     * @param  mixed $id  comment id
     * @return object
     */
    public function get_comment($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('tblproposalcomments')->row();
    }
    /**
     * Remove proposal comment
     * @param  mixed $id comment id
     * @return boolean
     */
    public function remove_comment($id)
    {
        $comment = $this->get_comment($id);
        $this->db->where('id', $id);
        $this->db->delete('tblproposalcomments');
        if ($this->db->affected_rows() > 0) {
            logActivity('Proposal Comment Removed [ProposalID:' . $comment->proposalid . ', Comment Content: ' . $comment->content . ']');
            return true;
        }
        return false;
    }
    /**
     * Copy proposal
     * @param  mixed $id proposal id
     * @return mixed
     */
    public function copy($id)
    {
        $proposal        = $this->get($id);
        $not_copy_fields = array(
            'addedfrom',
            'id',
            'datecreated',
            'hash',
            'status',
            'invoice_id',
            'estimate_id',
            'is_expiry_notified',
        );
        $fields          = $this->db->list_fields('tblproposals');
        $insert_data     = array();
        foreach ($fields as $field) {
            if (!in_array($field, $not_copy_fields)) {
                $insert_data[$field] = $proposal->$field;
            }
        }
        $insert_data['addedfrom']   = get_staff_user_id();
        $insert_data['datecreated'] = date('Y-m-d H:i:s');
        $insert_data['status']      = 1;
        $insert_data['hash']        = md5(rand() . microtime());
        // Check if the key exists
        $this->db->where('hash', $insert_data['hash']);
        $exists = $this->db->get('tblproposals')->row();
        if ($exists) {
            $insert_data['hash'] = md5(rand() . microtime());
        }
        // in case open till is expired set new 7 days starting from current date
        if (date('Y-m-d', strtotime($insert_data['open_till']))) {
            $insert_data['open_till'] = date('Y-m-d', strtotime('+7 DAY', strtotime(date('Y-m-d'))));
        }
        $this->db->insert('tblproposals', $insert_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            return $insert_id;
        }
        return false;
    }
    /**
     * Take proposal action (change status) manualy
     * @param  mixed $status status id
     * @param  mixed  $id     proposal id
     * @param  boolean $client is request coming from client side or not
     * @return boolean
     */
    public function mark_action_status($status, $id, $client = false)
    {
        if(is_staff_logged_in()){
            $client = false;
        }
        $original_proposal = $this->get($id);
        $this->db->where('id', $id);
        $this->db->update('tblproposals', array(
            'status' => $status
        ));
        if ($this->db->affected_rows() > 0) {
            // Client take action
            if ($client == true) {
                $revert = false;
                // Declined
                if ($status == 2) {
                    $message = 'not_proposal_proposal_declined';
                } else if ($status == 3) {
                    $message = 'not_proposal_proposal_accepted';
                    // Accepted
                } else {
                    $revert = true;
                }
                // This is protection that only 3 and 4 statuses can be taken as action from the client side
                if ($revert == true) {
                    $this->db->where('id', $id);
                    $this->db->update('tblproposals', array(
                        'status' => $original_proposal->status
                    ));
                    return false;
                } else {

                    $merge_fields = array();
                    $merge_fields = array_merge($merge_fields,get_proposal_merge_fields($original_proposal->id));

                    // Get creator and assigned;
                    $this->db->where('staffid', $original_proposal->addedfrom);
                    $this->db->or_where('staffid', $original_proposal->assigned);
                    $staff_proposal = $this->db->get('tblstaff')->result_array();

                    foreach ($staff_proposal as $member) {
                            add_notification(array(
                                'fromcompany' => true,
                                'touserid' => $member['staffid'],
                                'description' => $message,
                                'link' => 'proposals/list_proposals/' . $id
                                ));

                    }
                    $this->load->model('emails_model');
                    // Send thank you to the customer email template
                    if ($status == 3) {
                        // Client declined send template to admin
                        foreach ($staff_proposal as $member) {
                                $this->emails_model->send_email_template('proposal-client-accepted', $member['email'], $merge_fields);

                        }
                        $this->emails_model->send_email_template('proposal-client-thank-you', $original_proposal->email, $merge_fields);
                    } else {
                        // Client declined send template to admin
                        foreach ($staff_proposal as $member) {
                                $this->emails_model->send_email_template('proposal-client-declined', $member['email'], $merge_fields);
                        }
                    }
                }
            } else {
                // in case admin mark as open the the open till date is smaller then current date set open till date 7 days more
                if ((date('Y-m-d', strtotime($original_proposal->open_till)) < date('Y-m-d')) && $status == 1) {
                    $open_till = date('Y-m-d', strtotime('+7 DAY', strtotime(date('Y-m-d'))));
                    $this->db->where('id', $id);
                    $this->db->update('tblproposals', array(
                        'open_till' => $open_till
                    ));
                }
            }
            logActivity('Proposal Status Changes [ProposalID:' . $id . ', Status:' . format_proposal_status($status, '', false) . ',Client Action: ' . (int) $client . ']');
            return true;
        }
        return false;
    }
    /**
     * Delete proposal
     * @param  mixed $id proposal id
     * @return boolean
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tblproposals');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('proposalid', $id);
            $this->db->delete('tblproposalcomments');
            // Get related tasks
            $this->load->model('tasks_model');
            $this->db->where('rel_type', 'proposal');
            $this->db->where('rel_id', $id);

            $tasks = $this->db->get('tblstafftasks')->result_array();
            foreach ($tasks as $task) {
                $this->tasks_model->delete_task($task['id']);
            }

             $attachments = $this->get_attachments($id);
            foreach($attachments as $attachment){
                $this->delete_attachment($attachment['id']);
            }

            $this->db->where('rel_type','proposal');
            $this->db->where('rel_id',$id);
            $this->db->delete('tblviewstracking');

            logActivity('Proposal Deleted [ProposalID:' . $id . ']');
            return true;
        }
        return false;
    }
    /**
     * Get relation proposal data. Ex lead or customer will return the necesary db fields
     * @param  mixed $rel_id
     * @param  string $rel_type customer/lead
     * @return object
     */
    public function get_relation_data_values($rel_id, $rel_type)
    {
        $data = new StdClass();
        if ($rel_type == 'customer') {
            $this->db->where('userid', $rel_id);
            $_data         = $this->db->get('tblclients')->row();
            $data->address = $_data->address;
            $primary_contact_id = get_primary_contact_user_id($rel_id);
            if($primary_contact_id){
                $contact = $this->clients_model->get_contact($primary_contact_id);
                $data->email = $contact->email;
            }
            $data->phone   = $_data->phonenumber;
            if (!empty($_data->company)) {
                $data->to = $_data->company;
            } else {
                $data->to = $_data->firstname . ' ' . $_data->lastname;
            }

            $default_currency = $this->clients_model->get_customer_default_currency($rel_id);
            if ($default_currency != 0) {
                $data->currency = $default_currency;
            }
        } else if ($rel_type = 'lead') {
            $this->db->where('id', $rel_id);
            $_data       = $this->db->get('tblleads')->row();
            $data->phone = $_data->phonenumber;
            $data->to    = $_data->name;
            $data->email = $_data->email;
        }
        return $data;
    }
    /**
     * Sent proposal to email
     * @param  mixed  $id        proposalid
     * @param  string  $template  email template to sent
     * @param  boolean $attachpdf attach proposal pdf or not
     * @return boolean
     */
    public function send_expiry_reminder($id){
        $proposal = $this->get($id);
        $pdf      = proposal_pdf($proposal);
        $attach = $pdf->Output(slug_it($proposal->subject) . '.pdf', 'S');
        $this->load->model('emails_model');
        $this->emails_model->add_attachment(array(
                'attachment' => $attach,
                'filename' => slug_it($proposal->subject) . '.pdf',
                'type' => 'application/pdf'
            ));

        $merge_fields = array();
        $merge_fields = array_merge($merge_fields,get_proposal_merge_fields($proposal->id));
        $sent = $this->emails_model->send_email_template('proposal-expiry-reminder', $proposal->email, $merge_fields);
        if($sent){
            $this->db->where('id',$id);
            $this->db->update('tblproposals',array('is_expiry_notified'=>1));
            return true;
        }
        return false;
    }
    public function sent_proposal_to_email($id, $template = '', $attachpdf = true)
    {
        $this->load->model('emails_model');
        $proposal = $this->get($id);
        if ($attachpdf) {
            $pdf      = proposal_pdf($proposal);
            $attach = $pdf->Output(slug_it($proposal->subject) . '.pdf', 'S');
            $this->emails_model->add_attachment(array(
                'attachment' => $attach,
                'filename' => slug_it($proposal->subject) . '.pdf',
                'type' => 'application/pdf'
            ));
        }

        if ($this->input->post('email_attachments')) {
            $_other_attachments = $this->input->post('email_attachments');
            foreach ($_other_attachments as $attachment) {
                $_attachment = $this->get_attachments($id, $attachment);
                $this->emails_model->add_attachment(array(
                    'attachment' => PROPOSAL_ATTACHMENTS_FOLDER . $id . '/' . $_attachment->file_name,
                    'filename' => $_attachment->file_name,
                    'type' => $_attachment->filetype,
                    'read' => true
                    ));
            }
        }

        $merge_fields = array();
        $merge_fields = array_merge($merge_fields,get_proposal_merge_fields($proposal->id));
        $sent = $this->emails_model->send_email_template($template, $proposal->email, $merge_fields);
        if ($sent) {
            // Set to status sent
            $this->db->where('id', $id);
            $this->db->update('tblproposals', array(
                'status' => 4
            ));
            return true;
        }
        return false;
    }
}
