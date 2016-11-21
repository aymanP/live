<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('EMAIL_TEMPLATE_SEND', true);
class Emails_model extends CRM_Model
{
    private $attachment = array();
    function __construct()
    {
        parent::__construct();
        $this->load->library('email');
    }
    /**
     * @param  string
     * @return array
     * Get email template by type
     */
    public function get($type)
    {
        $this->db->where('type', $type);
        return $this->db->get('tblemailtemplates')->result_array();
    }
    /**
     * @param  integer
     * @return object
     * Get email template by id
     */
    public function get_email_template_by_id($id)
    {
        $this->db->where('emailtemplateid', $id);
        return $this->db->get('tblemailtemplates')->row();
    }
    /**
     * @param  array $_POST data
     * @param  integer ID
     * @return boolean
     * Update email template
     */
    public function update($data, $id)
    {
        if (isset($data['plaintext'])) {
            $data['plaintext'] = 1;
        } else {
            $data['plaintext'] = 0;
        }
        if (isset($data['disabled'])) {
            $data['active'] = 0;
            unset($data['disabled']);
        } else {
            $data['active'] = 1;
        }
        $this->db->where('emailtemplateid', $id);
        $this->db->update('tblemailtemplates', $data);
        if ($this->db->affected_rows() > 0) {
            logActivity('Email Template Updated [' . $id . ']');
            return true;
        }
        return false;
    }

    /**
     * Send email - No templates used only simple string
     * @since Version 1.0.2
     * @param  string $email   email
     * @param  string $message message
     * @param  string $subject email subject
     * @return boolean
     */
    public function send_simple_email($email, $subject, $message)
    {
        $this->email->initialize();
        $this->email->set_newline("\r\n");
        $this->email->clear(TRUE);
        $this->email->from(get_option('smtp_email'), get_option('companyname'));
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_alt_message(strip_tags($message));
        if (count($this->attachment) > 0) {
            foreach ($this->attachment as $attach) {
                if (!isset($attach['read'])) {
                    $this->email->attach($attach['attachment'], 'attachment', $attach['filename'], $attach['type']);
                } else {
                $this->email->attach($attach['attachment'], '', $attach['filename']);

                }
            }
        }
        $this->clear_attachments();
        if ($this->email->send()) {
            logActivity('Email sent to: '.$email.' Subject:'.$subject);
            return true;
        }
        return false;
    }
    /**
     * @param  string (email address)
     * @param  string (email subject)
     * @param  string (html email template type)
     * @param  array available data for the email template
     * @return boolean
     * Send email template from views/email
     */
    public function send_email($email, $subject, $type, &$data)
    {
        $template = $this->load->view('email/' . $type, $data, TRUE);
        $this->email->initialize();
        $this->email->set_newline("\r\n");
        $this->email->clear(TRUE);
        $this->email->from(get_option('smtp_email'), get_option('companyname'));
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($template);
        $this->email->set_alt_message(strip_tags($template));
        if (count($this->attachment) > 0) {
            foreach ($this->attachment as $attach) {
                if (!isset($attach['read'])) {
                    $this->email->attach($attach['attachment'], 'attachment', $attach['filename'], $attach['type']);
                } else {
                    $this->email->attach($attach['attachment'], '', $attach['filename']);
                }
            }
        }

        $this->clear_attachments();
        if ($this->email->send()) {
            logActivity('Email Send To [Email:' . $email . ', Type:' . $type . ']');
            return true;
        }
        return false;
    }

    public function send_email_template($template,$email,$merge_fields,$ticketid = ''){

        $this->db->where('slug', $template);
        $template = $this->db->get('tblemailtemplates')->row();

        if(!$template){
            logActivity('Email Template Not Found');
            return false;
        }

        if ($template->active == 0) {
            return false;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $template = parse_email_template($template,$merge_fields);

        // email config
        if ($template->plaintext == 1) {
            $this->config->set_item('mailtype', 'text');
            $template->message = strip_tags($template->message);
        }
        $fromemail = $template->fromemail;
        $fromname  = $template->fromname;
        if ($fromemail == '') {
            $fromemail = get_option('smtp_email');
        }
        if ($fromname == '') {
            $fromname = get_option('companyname');
        }
        $reply_to = false;
        if (is_numeric($ticketid) && $template->type == 'ticket') {
            $this->load->model('tickets_model');
            $ticket           = $this->tickets_model->get_ticket_by_id($ticketid);
            $department_email = get_department_email($ticket->department);
            if (!empty($department_email) && filter_var($department_email, FILTER_VALIDATE_EMAIL)) {
                $reply_to = $department_email;
            }
            // IMPORTANT
            // Dont change/remove this line, this is used for email piping so the software can recognize the ticket id.
            if (substr($template->subject, 0, 10) != "[Ticket ID") {
                $template->subject = '[Ticket ID: ' . $ticketid . '] ' . $template->subject;
            }
        }

        $template = do_action('before_email_template_send', $template);
        $this->email->initialize();
        $this->email->set_newline("\r\n");
        $this->email->clear(TRUE);
        $this->email->from($fromemail, $fromname);
        $this->email->subject($template->subject);
        $this->email->message($template->message);
        if ($reply_to != false) {
            $this->email->reply_to($reply_to);
        }
        if ($template->plaintext == 0) {
            $this->email->set_alt_message(strip_tags($template->message));
        }
        $this->email->to($email);
        if (count($this->attachment) > 0) {
            foreach ($this->attachment as $attach) {
                if (!isset($attach['read'])) {
                    $this->email->attach($attach['attachment'], 'attachment', $attach['filename'], $attach['type']);
                } else {
                    $this->email->attach($attach['attachment'], '', $attach['filename']);
                }
            }
        }
        $this->clear_attachments();

        $template_array = array('new-client-created');
        $this->db->where('email', $email);
        $contact = $this->db->get('tblcontacts')->row();
        if($contact){
            if(!in_array($template, $template_array) && $contact->email_cc == 1){
                $this->db->where(array('userid' => $contact->userid, 'email_cc' => 1 ));
                $contact_emails_cc = $this->db->get('tblcontacts')->result_array();
                $cc = '';
                foreach($contact_emails_cc as $contact_email_cc){
                    if($contact_email_cc['email'] != $email){
                        $cc .= $contact_email_cc['email'].',';
                    }
                }
                $cc = rtrim($cc, ',');
                $this->email->cc($cc);
            }
        }

        $template_array_supp = array('new-supplier-created');
        $this->db->where('email', $email);
        $supplierc = $this->db->get('tblsuppliercontacts')->row();
        if($supplierc){
            if(!in_array($template, $template_array_supp) && $supplierc->email_cc == 1){
                $this->db->where(array('supplierid' => $supplierc->supplierid, 'email_cc' => 1 ));
                $contact_emails_cc = $this->db->get('tblsuppliercontacts')->result_array();
                $cc = '';
                foreach($contact_emails_cc as $contact_email_cc){
                    if($contact_email_cc['email'] != $email){
                        $cc .= $contact_email_cc['email'].',';
                    }
                }
                $cc = rtrim($cc, ',');
                $this->email->cc($cc);
            }
        }          ////////////////

        if ($this->email->send()) {
            logActivity('Email Send To [Email:' . $email . ', Template:' . $template->name . ']');
            return true;
        }
        return false;
    }
    /**
     * @param resource
     * @param string
     * @param string (mime type)
     * @return none
     * Add attachment to property to check before an email is send
     */
    public function add_attachment($attachment)
    {
        $this->attachment[] = $attachment;
    }
    /**
     * @return none
     * Clear all attachment properties
     */
    private function clear_attachments()
    {
        $this->attachment = array();
    }
}
