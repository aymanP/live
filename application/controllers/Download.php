<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('download');
    }
    public function file($folder_indicator, $attachmentid = '')
    {
        $this->load->model('tickets_model');
        if ($folder_indicator == 'ticket') {
            if (is_logged_in()) {
                $this->db->where('id', $attachmentid);
                $attachment = $this->db->get('tblticketattachments')->row();
                if (!$attachment) {
                    die('No attachment found in database');
                }
                $ticket   = $this->tickets_model->get_ticket_by_id($attachment->ticketid);
                $ticketid = $attachment->ticketid;
                if ($ticket->userid == get_client_user_id() || is_staff_logged_in()) {
                    if ($attachment->id != $attachmentid) {
                        die('Attachment or ticket not equal');
                    }
                    $path = TICKET_ATTACHMENTS_FOLDER . $ticketid . '/' . $attachment->file_name;
                    $name = $attachment->file_name;
                }
            }
        } else if ($folder_indicator == 'newsfeed') {
            if (is_logged_in()) {
                if (!$attachmentid) {
                    die('No attachmentid specified');
                }
                $this->db->where('id', $attachmentid);
                $attachment = $this->db->get('tblpostattachments')->row();
                if (!$attachment) {
                    die('No attachment found in database');
                }
                $path = NEWSFEED_FOLDER . $attachment->postid . '/' . $attachment->filename;
                $name = $attachment->filename;
            }
        } else if ($folder_indicator == 'contract') {
            if (is_logged_in()) {
                if (!$attachmentid) {
                    die('No attachmentid specified');
                }
                $this->db->where('id', $attachmentid);
                $attachment = $this->db->get('tblcontractattachments')->row();
                if (!$attachment) {
                    die('No attachment found in database');
                }
                $this->load->model('contracts_model');
                $contract = $this->contracts_model->get($attachment->contractid);
                if (is_client_logged_in()) {
                    if ($contract->not_visible_to_client == 1) {
                        if (!is_staff_logged_in()) {
                            die;
                        }
                    }
                }
                if (!is_staff_logged_in()) {
                    if ($contract->client != get_client_user_id()) {
                        die();
                    }
                } else {
                    if (!has_permission('contracts','','view')) {
                        access_denied('contracts');
                    }
                }
                $path = CONTRACTS_UPLOADS_FOLDER . $attachment->contractid . '/' . $attachment->file_name;
                $name = $attachment->file_name;
            }
        } else if ($folder_indicator == 'taskattachment') {
            if (!is_staff_logged_in() && !is_client_logged_in()) {
                die();
            }

            $this->db->where('id', $attachmentid);
            $attachment = $this->db->get('tblstafftasksattachments')->row();
            if (!$attachment) {
                die('No attachment found in database');
            }
            $path = TASKS_ATTACHMENTS_FOLDER . $attachment->taskid . '/' . $attachment->file_name;
            $name = $attachment->file_name;
        } else if ($folder_indicator == 'sales_attachment') {
            $this->db->where('attachment_key', $attachmentid);
            $attachment = $this->db->get('tblsalesattachments')->row();
            if (!$attachment) {
                die('No attachment found in database');
            }
            if($attachment->rel_type == 'invoice'){
                $path = INVOICE_ATTACHMENTS_FOLDER;
            } else if($attachment->rel_type == 'estimate'){
                $path = ESTIMATE_ATTACHMENTS_FOLDER;
            } else if($attachment->rel_type == 'proposal'){
                $path = PROPOSAL_ATTACHMENTS_FOLDER;
            } else {
                die;
            }

        $path .= $attachment->rel_id . '/' . $attachment->file_name;
        $name = $attachment->file_name;
        } else if ($folder_indicator == 'expense') {
            if (!is_staff_logged_in()) {
                die();
            }
            $this->db->where('id', $attachmentid);
            $expense = $this->db->get('tblexpenses')->row();
            $path    = EXPENSE_ATTACHMENTS_FOLDER . $expense->id . '/' . $expense->attachment;
            $name    = $expense->attachment;
        }

        else if ($folder_indicator == 'purchase') {
            if (!is_staff_logged_in()) {
                die();
            }
            $this->db->where('id', $attachmentid);
            $purchase_file = $this->db->get('tblpurchase_file')->row();
            $path    = PURCHASE_ATTACHMENTS_FOLDER . $purchase_file->id . '/' . $purchase_file->attachment;
            $name    = $purchase_file->attachment;
        }


        else if ($folder_indicator == 'lead_attachment') {
            if (!is_staff_logged_in()) {
                die();
            }
            $this->db->where('id', $attachmentid);
            $attachment = $this->db->get('tblleadattachments')->row();
            if (!$attachment) {
                die('No attachment found in database');
            }
            $path = LEAD_ATTACHMENTS_FOLDER . $attachment->leadid . '/' . $attachment->file_name;
            $name = $attachment->file_name;
        } else if ($folder_indicator == 'db_backup') {
            if (!is_admin()) {
                die('Access forbidden');
            }
            $path = BACKUPS_FOLDER . $attachmentid;
            $name = $attachmentid;
        } else if ($folder_indicator == 'client') {
            if (has_permission('customers','','view') || is_customer_admin()) {
                $this->db->where('id', $attachmentid);
                $attachment = $this->db->get('tblclientattachments')->row();
                $path       = CLIENT_ATTACHMENTS_FOLDER . $attachment->clientid . '/' . $attachment->file_name;
                $name       = $attachment->file_name;
                ;
            }
        } else {
            die('folder not specified');
        }
        $data = file_get_contents($path);
        force_download($name, $data);
    }
}
