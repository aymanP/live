<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function make()
    {
        $this->load->config('migration');
        if ($this->config->item('migration_enabled') == true) {
            if (!$this->input->get('old_base_url')) {
                echo '<h1>You need to pass old base url in the url like: ' . site_url('migration/make?old_base_url=http://myoldbaseurl.com/') . '</h1>';
                die;
            }
            $old_url = $this->input->get('old_base_url');
            $new_url = $this->config->item('base_url');
            if (!endsWith($old_url, '/')) {
                $old_url = $old_url . '/';
            }
            $affectedRows = 0;
            // Replace notifications links
            $this->db->query('UPDATE `tblnotifications` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();

            $this->db->query('UPDATE `tblnotifications` SET `additional_data` = replace(additional_data, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();

            // Replace notes links
            $this->db->query('UPDATE `tblnotes` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();

            // Replace email templates links
            $this->db->query('UPDATE `tblemailtemplates` SET `message` = replace(message, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Replace newsfeed posts links
            $this->db->query('UPDATE `tblposts` SET `content` = replace(content, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Replace newsfeed post comments links
            $this->db->query('UPDATE `tblpostcomments` SET `content` = replace(content, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Replace options
            $this->db->query('UPDATE `tbloptions` SET `value` = replace(value, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Replace options
            $this->db->query('UPDATE `tblpredifinedreplies` SET `message` = replace(message, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Projects
            $this->db->query('UPDATE `tblprojectdiscussioncomments` SET `content` = replace(content, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblprojectdiscussions` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblprojectnotes` SET `content` = replace(content, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblprojects` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Replace reminders
            $this->db->query('UPDATE `tblreminders` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Replace staff tasks description
            $this->db->query('UPDATE `tblstafftasks` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Replace staff tasks comments
            $this->db->query('UPDATE `tblstafftaskcomments` SET `content` = replace(content, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Replace staff surveys
            $this->db->query('UPDATE `tblsurveys` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblsurveys` SET `viewdescription` = replace(viewdescription, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();

            $this->db->query('UPDATE `tblticketreplies` SET `message` = replace(message, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tbltickets` SET `message` = replace(message, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Todo items
            $this->db->query('UPDATE `tbltodoitems` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Proposals
            $this->db->query('UPDATE `tblproposalcomments` SET `content` = replace(content, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblproposals` SET `content` = replace(content, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Leads
            $this->db->query('UPDATE `tblleadactivitylog` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Knowledge base
            $this->db->query('UPDATE `tblknowledgebasegroups` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblknowledgebase` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Invoices
            $this->db->query('UPDATE `tblinvoices` SET `terms` = replace(terms, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblinvoices` SET `clientnote` = replace(clientnote, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblinvoices` SET `adminnote` = replace(adminnote, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblinvoiceactivity` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();

            $this->db->query('UPDATE `tblinvoiceactivity` SET `additional_data` = replace(additional_data, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();

            // Estimates
            $this->db->query('UPDATE `tblestimates` SET `terms` = replace(terms, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblestimates` SET `clientnote` = replace(clientnote, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblestimates` SET `adminnote` = replace(adminnote, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblestimateactivity` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            $this->db->query('UPDATE `tblestimateactivity` SET `additional_data` = replace(additional_data, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Goals
            $this->db->query('UPDATE `tblgoals` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();
            // Contracts description
            $this->db->query('UPDATE `tblcontracts` SET `description` = replace(description, "' . $old_url . '", "' . $new_url . '")');
            $affectedRows += $this->db->affected_rows();

            // Ahmed Faiçal Additional adds
            // Clients add logo_image + active + Mode Alami.
            $this->db->query("ALTER TABLE  `tblclients` ADD  `profile_image` VARCHAR( 300 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER  `datecreated`");
            $affectedRows += $this->db->affected_rows();

            $this->db->query("ALTER TABLE  `tblclients` ADD  `active` TINYINT( 1 ) NOT NULL AFTER  `profile_image`");
            $affectedRows += $this->db->affected_rows();

            $this->db->query("ALTER TABLE `tblclients` ADD `mode_alami` TINYINT( 1 ) NOT NULL AFTER `actif");
            $affectedRows += $this->db->affected_rows();


            // Mode Alami fields
            $this->db->query("ALTER TABLE `tblstaff` ADD `email_alami` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `lastname`");
            $affectedRows += $this->db->affected_rows();

            $this->db->query("ADD `firstname_alami` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `email_alami`");
            $affectedRows += $this->db->affected_rows();

            $this->db->query("ADD `lastname_alami` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `firstname_alami`");
            $affectedRows += $this->db->affected_rows();







            echo '<h1>Total links replaced: ' . $affectedRows . '</h1>';
        } else {
            echo '<h1>Set migration_enabled to TRUE in application/config/migration.php</h1>';
        }
    }
}
