<?php

function _perfex_upload_error($error){
    $phpFileUploadErrors = array(
        0 => _l('file_uploaded_success'),
        1 => _l('file_exceds_max_filesize'),
        2 => _l('file_exceds_maxfile_size_in_form'),
        3 => _l('file_uploaded_partially'),
        4 => _l('file_not_uploaded'),
        6 => _l('file_missing_temporary_folder'),
        7 => _l('file_failed_to_write_to_disk'),
        8 => _l('file_php_extension_blocked'),
    );

    if(isset($phpFileUploadErrors[$error]) && $error != 0){
        return $phpFileUploadErrors[$error];
    }
    return false;
}
/**
 * Newsfeed post attachments
 * @param  mixed $postid Post ID to add attachments
 * @return array  - Result values
 */
function handle_newsfeed_post_attachments($postid)
{
    if(isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])){
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }

    $path = NEWSFEED_FOLDER . $postid . '/';
    $CI =& get_instance();
    if (isset($_FILES['file']['name'])) {
        do_action('before_upload_newsfeed_attachment',$postid);
        $uploaded_files = false;
        // Get the temp file path
        $tmpFilePath    = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            $type        = $_FILES["file"]["type"];
            // Setup our new file path
            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
            $filename    = unique_filename($path, $_FILES["file"]["name"]);
            $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $file_uploaded = true;
                $CI->db->insert('tblpostattachments', array(
                    'filename' => $filename,
                    'postid' => $postid,
                    'filetype' => $type,
                    'datecreated' => date('Y-m-d H:i:s')
                ));
            }
        }
        if ($file_uploaded == true) {
            echo json_encode(array(
                'success' => true,
                'postid' => $postid
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'postid' => $postid
            ));
        }
    }
}
function handle_project_file_uploads($project_id)
{

    if(isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])){
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '')
    {
        do_action('before_upload_project_attachment',$project_id);
        $path        = PROJECT_ATTACHMENTS_FOLDER . $project_id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '')
        {
            // Setup our new file path

            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
             $filename    = unique_filename($path, $_FILES["file"]["name"]);
             $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI =& get_instance();
                if (is_client_logged_in()) {
                    $contact_id = get_contact_user_id();
                    $staffid = 0;
                } else {
                    $staffid = get_staff_user_id();
                    $contact_id = 0;
                }
                $data = array(
                    'project_id' => $project_id,
                    'file_name' => $filename,
                    'filetype' => $_FILES["file"]["type"],
                    'dateadded' => date('Y-m-d H:i:s'),
                    'staffid' => $staffid,
                    'contact_id' => $contact_id,
                );
                if(is_client_logged_in()){
                    $data['visible_to_customer'] = 1;
                } else {
                    $data['visible_to_customer'] = ($CI->input->post('visible_to_customer') == 'true' ? 1 : 0);
                }
                $CI->db->insert('tblprojectfiles', $data);
                $insert_id = $CI->db->insert_id();
                    $CI->load->model('projects_model');
                    $project = $CI->projects_model->get($project_id);

                    $additional_data = '';
                    $additional_data .= $filename . '<br />'.$_FILES["file"]["type"];
                    $CI->projects_model->log_activity($project_id,'project_activity_uploaded_file',$additional_data,$data['visible_to_customer']);

                    if($insert_id){
                        $members = $CI->projects_model->get_project_members($project_id);
                        $notification_data = array(
                           'description'=>'not_project_file_uploaded',
                           'link'=>'projects/view/'.$project_id.'?group=project_files'
                           );
                        if(is_client_logged_in()){
                            $notification_data['fromclientid'] = get_contact_user_id();
                        } else {
                            $notification_data['fromuserid'] = get_staff_user_id();
                        }
                        foreach($members as $member){
                            if($member['staff_id'] == get_staff_user_id() && !is_client_logged_in()){continue;}
                            $notification_data['touserid'] = $member['staff_id'];
                            add_notification($notification_data);
                        }
                   $CI->projects_model->send_project_email_template(
                       $project_id,
                        'new-project-file-uploaded-to-staff',
                        'new-project-file-uploaded-to-customer',
                        $data['visible_to_customer'] == 1,
                        array(
                            'customers'=>array('customer_template'=>true)
                            )
                    );
                    } else {
                        unlink($newFilePath);
                        return false;
                    }
                return true;
            }
        }
    }
    return false;
}
function handle_purchase_file_uploads($project_id)
{
    $CI =& get_instance();
    $data['Reference'] = $CI->input->post('reference');
    $data['Titre'] = $CI->input->post('titre');
    $data['TVA'] = $CI->input->post('TVA');
    $data['montant'] = $CI->input->post('montant');
    if(isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error']))
    {
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '')
    {
        do_action('before_upload_project_attachment',$project_id);
        $path        = PURCHASE_ATTACHMENTS_FOLDER . $project_id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '')
        {
            // Setup our new file path

            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
            $filename    = unique_filename($path, $_FILES["file"]["name"]);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath))
            {

                $CI->load->model('purchase_model');
                if (is_client_logged_in()) {
                    $contact_id = get_contact_user_id();
                    $staffid = 0;
                } else {
                    $staffid = get_staff_user_id();
                    $contact_id = 0;//$CI->Projects_model->get_project_cont($project->contactid);
                    //;
                }
                $data['Reference'] = $CI->input->post('reference');
                $data['Titre'] = $CI->input->post('titre');
                $data['TVA'] = $CI->input->post('TVA');
                $data['montant'] = $CI->input->post('montant');
                $data['id_project'] = $project_id;
                $CI->db->insert('tblpurchase', $data);
                $purchaseid = $CI->db->insert_id();
                $file = array(
                    'id_purchase' => $purchaseid,
                    'attachment' => $filename,
                    'filetype' => $_FILES["file"]["type"],
                    'dateadd' => date('Y-m-d H:i:s'),
                    'staffid' => $staffid,
                    'contact_id' => $contact_id,
                );
                /*
                if(is_client_logged_in())
                {
                    $data['visible_to_customer'] = 1;
                } else {
                    $data['visible_to_customer'] = ($CI->input->post('visible_to_customer') == 'true' ? 1 : 0);
                }*/
                $CI->db->insert('tblpurchase_file', $file);
                $insert_id = $CI->db->insert_id();
                /*$CI->load->model('projects_model');
                $project = $CI->projects_model->get($project_id);*/

                $additional_data = '';
                $additional_data .= $filename . '<br />'.$_FILES["file"]["type"];
                $CI->projects_model->log_activity($project_id,'project_activity_uploaded_file',$additional_data,$data['visible_to_customer']);
                /* Notification
                if($insert_id)
                {
                    $members = $CI->projects_model->get_project_members($project_id);
                    $notification_data = array(
                        'description'=>'not_project_file_uploaded',
                        'link'=>'projects/view/'.$project_id.'?group=project_files'
                    );
                    if(is_client_logged_in()){
                        $notification_data['fromclientid'] = get_contact_user_id();
                    } else {
                        $notification_data['fromuserid'] = get_staff_user_id();
                    }
                    foreach($members as $member){
                        if($member['staff_id'] == get_staff_user_id() && !is_client_logged_in()){continue;}
                        $notification_data['touserid'] = $member['staff_id'];
                        add_notification($notification_data);
                    }
                    $CI->projects_model->send_project_email_template(
                        $project_id,
                        'new-project-file-uploaded-to-staff',
                        'new-project-file-uploaded-to-customer',
                        $data['visible_to_customer'] == 1,
                        array(
                            'customers'=>array('customer_template'=>true)
                        )
                    );
                } else {
                    unlink($newFilePath);
                    return false;
                }*/
                return true;
            }
        }
    }
    $CI->db->insert('tblpurchase', $data);
    $purchaseid = $CI->db->insert_id();
    if($purchaseid != 0)
        return true;
    return false;
}




function handle_invoice_file_uploads($invoice_id='')
{
    $CI =& get_instance();
    $data['supplierid'] = $CI->input->post('supplierid');
    $data['number'] = $CI->input->post('number');
    //$data['description'] = $CI->input->post('description');
    $data['date'] = $CI->input->post('date');
    $data['duedate'] = $CI->input->post('duedate');
   // $data['taxname'] = $CI->input->post('taxname');
    $data['subtotal'] = $CI->input->post('subtotal');
    $data['total'] = $CI->input->post('total');
    if(isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error']))
    {
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '')
    {
        do_action('before_upload_project_attachment',$invoice_id);
        $path        = INVOICE_ATTACHMENTS_FOLDER . $invoice_id . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '')
        {
            // Setup our new file path

            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
            $filename    = unique_filename($path, $_FILES["file"]["name"]);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath))
            {

                $CI->load->model('supplier_invoices_model');

                $data['supplierid'] = $CI->input->post('supplierid');
                $data['number'] = $CI->input->post('number');
               // $data['description'] = $CI->input->post('description');
                $data['date'] = $CI->input->post('date');
                $data['duedate'] = $CI->input->post('duedate');
               // $data['taxname'] = $CI->input->post('taxname');
                $data['subtotal'] = $CI->input->post('subtotal');
                $data['total'] = $CI->input->post('total');
                $data['id'] = $invoice_id;
                $CI->db->insert('tblinvoices', $data);
                $invoiceid = $CI->db->insert_id();
                $key = md5(date('Y-m-d H:i:s').$invoiceid);
                $file = array(
                    'rel_id' => $invoiceid,
                    'rel_type' =>'supplier_invoice',
                    'file_name' => $filename,
                    'filetype' => $_FILES["file"]["type"],
                    'datecreated' => date('Y-m-d H:i:s'),
                    'attachment_key'=>$key,
                    'visible_to_customer'=>0,
                   // 'staffid' => get_staff_user_id(),
                );

                $CI->db->insert('tblsalesattachments', $file);
                $insert_id = $CI->db->insert_id();


                $additional_data = '';
                $additional_data .= $filename . '<br />'.$_FILES["file"]["type"];
                $CI->supplier_invoices_model->log_activity($invoice_id,'project_activity_uploaded_file',$additional_data,$data['visible_to_customer']);

                return true;
            }
        }
    }
    $CI->db->insert('tblinvoices', $data);
    $invoiceid = $CI->db->insert_id();
    if($invoiceid != 0)
        return true;
    return false;
}
/**
 * Handle contract attachments if any
 * @param  mixed $contractid
 * @return boolean
 */




function handle_contract_attachment($contractid)
{

     if(isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])){
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
        do_action('before_upload_contract_attachment',$contractid);
        $path        = CONTRACTS_UPLOADS_FOLDER . $contractid . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Setup our new file path


            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
            $filename    = unique_filename($path, $_FILES["file"]["name"]);
            $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI =& get_instance();
                $CI->db->insert('tblcontractattachments', array(
                    'contractid' => $contractid,
                    'file_name' => $filename,
                    'filetype' => $_FILES["file"]["type"],
                    'dateadded' => date('Y-m-d H:i:s')
                ));
                return true;
            }
        }
    }
    return false;
}
/**
 * Handle lead attachments if any
 * @param  mixed $leadid
 * @return boolean
 */
function handle_lead_attachments($leadid)
{

    if(isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])){
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }

    $CI =& get_instance();
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
        do_action('before_upload_lead_attachment',$leadid);
        $path        = LEAD_ATTACHMENTS_FOLDER . $leadid . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Setup our new file path
            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
             $filename    = unique_filename($path, $_FILES["file"]["name"]);
             $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI =& get_instance();
                $CI->db->insert('tblleadattachments', array(
                    'leadid' => $leadid,
                    'file_name' => $filename,
                    'filetype' => $_FILES["file"]["type"],
                    'addedfrom' => get_staff_user_id(),
                    'dateadded' => date('Y-m-d H:i:s')
                ));
                $CI->load->model('leads_model');
                $CI->leads_model->log_lead_activity($leadid, 'not_lead_activity_added_attachment');
                return true;
            }
        }
    }
    return false;
}
/**
 * Check for task attachment
 * @since Version 1.0.1
 * @param  mixed $taskid
 * @return mixed           false if no attachment || array uploaded attachments
 */
function handle_tasks_attachments($taskid)
{

     if(isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])){
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }

    $path           = TASKS_ATTACHMENTS_FOLDER . $taskid . '/';
    $uploaded_files = array();
    if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
        do_action('before_upload_task_attachment',$taskid);
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Setup our new file path


            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
              $filename    = unique_filename($path, $_FILES["file"]["name"]);
               $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                array_push($uploaded_files, array(
                    'filename' => $filename,
                    'filetype' => $_FILES["file"]["type"]
                ));
            }
        }
    }
    if (count($uploaded_files) > 0) {
        return $uploaded_files;
    }
    return false;
}
/**
 * Invoice attachments
 * @since  Version 1.0.4
 * @param  mixed $invoiceid invoice ID to add attachments
 * @return array  - Result values
 */
function handle_sales_attachments($rel_id,$rel_type)
{

    if(isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])){
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }

    if($rel_type == 'invoice'){
        $path = INVOICE_ATTACHMENTS_FOLDER . $rel_id . '/';
    } else if($rel_type == 'estimate'){
        $path = ESTIMATE_ATTACHMENTS_FOLDER . $rel_id . '/';
    } else if($rel_type == 'proposal'){
        $path = PROPOSAL_ATTACHMENTS_FOLDER . $rel_id . '/';
    }

    $CI =& get_instance();
    if (isset($_FILES['file']['name'])) {
        $uploaded_files = false;
        // Get the temp file path
        $tmpFilePath    = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $type        = $_FILES["file"]["type"];
            // Setup our new file path
            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
            $filename    = unique_filename($path, $_FILES["file"]["name"]);
            $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $file_uploaded = true;
                $key = md5(date('Y-m-d H:i:s').$rel_id);
                $CI->db->insert('tblsalesattachments', array(
                    'file_name' => $filename,
                    'rel_id' => $rel_id,
                    'rel_type' => $rel_type,
                    'filetype' => $type,
                    'datecreated' => date('Y-m-d H:i:s'),
                    'attachment_key'=>$key,

                ));
                $insert_id = $CI->db->insert_id();
                if($rel_type == 'invoice'){
                    $CI->load->model('invoices_model');
                    $CI->invoices_model->log_invoice_activity($rel_id, 'invoice_activity_added_attachment');
                } else if($rel_type == 'estimate'){
                    $CI->load->model('estimates_model');
                    $CI->estimates_model->log_estimate_activity($rel_id, 'estimate_activity_added_attachment');
                }
            }
        }
        if ($file_uploaded == true) {
            echo json_encode(array(
                'success' => true,
                'attachment_id' => $insert_id,
                'filetype' => $type,
                'rel_id'=>$rel_id,
                'file_name' => $filename,
                'key' => $key,
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'rel_id' => $rel_id,
                'file_name' => $filename
            ));
        }
    }
}
/**
 * Client attachments
 * @since  Version 1.0.4
 * @param  mixed $clientid Client ID to add attachments
 * @return array  - Result values
 */
function handle_client_attachments_upload($clientid)
{

    $path = CLIENT_ATTACHMENTS_FOLDER . $clientid . '/';
    $CI =& get_instance();
    if (isset($_FILES['file']['name'])) {
        do_action('before_upload_client_attachment',$clientid);
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $type        = $_FILES["file"]["type"];
            // Setup our new file path


            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
             $filename    = unique_filename($path, $_FILES['file']['name']);
              $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI->db->insert('tblclientattachments', array(
                    'file_name' => $filename,
                    'clientid' => $clientid,
                    'filetype' => $type,
                    'datecreated' => date('Y-m-d H:i:s')
                ));
            }
        }
    }
}

function handle_supplier_attachments_upload($supplierid)
{

    $path = SUPPLIER_ATTACHMENTS_FOLDER . $supplierid . '/';
    $CI =& get_instance();
    if (isset($_FILES['file']['name'])) {
        do_action('before_upload_supplier_attachment',$supplierid);
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $type        = $_FILES["file"]["type"];
            // Setup our new file path


            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
             $filename    = unique_filename($path, $_FILES['file']['name']);
              $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI->db->insert('tblsupplierattachments', array(
                    'file_name' => $filename,
                    'supplierid' => $supplierid,
                    'filetype' => $type,
                    'datecreated' => date('Y-m-d H:i:s')
                ));
            }
        }
    }
}

function handle_slider_upload($clientid)
{
    $path = FRONTEND_SLIDER_FOLDER . $clientid . '/';
    $CI =& get_instance();
    if (isset($_FILES['file']['name'])) {
        do_action('before_upload_client_attachment',$clientid);
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $type        = $_FILES["file"]["type"];
            // Setup our new file path


            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
            $filename    = unique_filename($path, $_FILES['file']['name']);
            $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI->db->insert('tblsliders', array(
                    'name' => 'No_name',
                    'image' => $filename,
                    'active' => 1,
                    'effect' => 'linear'
                ));
            }
        }
    }
}

function handle_expense_attachments($id)
{
    if(isset($_FILES['file']) && _perfex_upload_error($_FILES['file']['error'])){
        header('HTTP/1.0 400 Bad error');
        echo _perfex_upload_error($_FILES['file']['error']);
        die;
    }


    $path = EXPENSE_ATTACHMENTS_FOLDER . $id . '/';
    $CI =& get_instance();

    if (isset($_FILES['file']['name'])) {
        do_action('before_upload_expense_attachment',$id);
        // Get the temp file path
        $tmpFilePath = $_FILES['file']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Setup our new file path
            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
             $filename    = $_FILES["file"]["name"];
             $newFilePath = $path . $filename;
            // Upload the file into the temp dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI->db->where('id', $id);
                $CI->db->update('tblexpenses', array(
                    'attachment' => $filename,
                    'filetype' => $_FILES["file"]["type"]
                ));
            }
        }
    }
}
/**
 * Check for ticket attachment after inserting ticket to database
 * @param  mixed $ticketid
 * @return mixed           false if no attachment || array uploaded attachments
 */
function handle_ticket_attachments($ticketid)
{

    $path           = TICKET_ATTACHMENTS_FOLDER . $ticketid . '/';
    $uploaded_files = array();
    for ($i = 0; $i < count($_FILES['attachments']['name']); $i++) {
        do_action('before_upload_ticket_attachment',$ticketid);
        if ($i <= get_option('maximum_allowed_ticket_attachments')) {
            // Get the temp file path
            $tmpFilePath = $_FILES['attachments']['tmp_name'][$i];
            // Make sure we have a filepath
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                // Getting file extension
                $path_parts         = pathinfo($_FILES["attachments"]["name"][$i]);
                $extension          = $path_parts['extension'];
                $extension = strtolower($extension);
                $allowed_extensions = explode(',', get_option('ticket_attachments_file_extensions'));
                // Check for all cases if this extension is allowed
                if (!in_array('.'.$extension, $allowed_extensions)) {
                    continue;
                }
                // Setup our new file path
                if (!file_exists($path)) {
                    mkdir($path);
                    fopen($path . 'index.html', 'w');
                }
                 $filename    = unique_filename($path, $_FILES["attachments"]["name"][$i]);
                 $newFilePath = $path . $filename;
                // Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                    array_push($uploaded_files, array(
                        'file_name' => $filename,
                        'filetype' => $_FILES["attachments"]["type"][$i]
                    ));
                }
            }
        }
    }
    if (count($uploaded_files) > 0) {
        return $uploaded_files;
    }
    return false;
}
/**
 * Check for company logo upload
 * @return boolean
 */
function handle_company_logo_upload()
{

   if(isset($_FILES['company_logo']) && _perfex_upload_error($_FILES['company_logo']['error'])){
        set_alert('warning',_perfex_upload_error($_FILES['company_logo']['error']));
        return false;
    }
    if (isset($_FILES['company_logo']['name']) && $_FILES['company_logo']['name'] != '') {
        do_action('before_upload_company_logo_attachment');
        $path        = COMPANY_FILES_FOLDER . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['company_logo']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts         = pathinfo($_FILES["company_logo"]["name"]);
            $extension          = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = array(
                'jpg',
                'jpeg',
                'png'
            );
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', 'Image extension not allowed.');
                return false;
            }
            // Setup our new file path
            $filename    = 'logo' . '.' . $extension;
            $newFilePath = $path . $filename;
            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                update_option('company_logo', $filename);
                return true;
            }
        }
    }
    return false;
}
function handle_favicon_upload()
{

    if (isset($_FILES['favicon']['name']) && $_FILES['favicon']['name'] != '') {
        do_action('before_upload_favicon_attachment');
        $path        = COMPANY_FILES_FOLDER . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['favicon']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts  = pathinfo($_FILES["favicon"]["name"]);
            $extension   = $path_parts['extension'];
            $extension = strtolower($extension);
            // Setup our new file path
            $filename    = 'favicon' . '.' . $extension;
            $newFilePath = $path . $filename;
            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . 'index.html', 'w');
            }
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                update_option('favicon', $filename);
                return true;
            }
        }
    }
    return false;
}
/**
 * Check for staff profile image
 * @return boolean
 */
function handle_staff_profile_image_upload()
{

    if (isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name'] != '') {
        do_action('before_upload_staff_profile_image');
        $path        = STAFF_PROFILE_IMAGES_FOLDER . get_staff_user_id() . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['profile_image']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts         = pathinfo($_FILES["profile_image"]["name"]);
            $extension          = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = array(
                'jpg',
                'jpeg',
                'png'
            );
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));
                return false;
            }
            // Setup our new file path
            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . '/index.html', 'w');
            }
            $filename    = unique_filename($path, $_FILES["profile_image"]["name"]);
             $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI =& get_instance();
                $config                   = array();
                $config['image_library']  = 'gd2';
                $config['source_image']   = $newFilePath;
                $config['new_image']      = 'thumb_' . $filename;
                $config['maintain_ratio'] = TRUE;
                $config['width']          = 160;
                $config['height']         = 160;
                $CI->load->library('image_lib', $config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library']  = 'gd2';
                $config['source_image']   = $newFilePath;
                $config['new_image']      = 'small_' . $filename;
                $config['maintain_ratio'] = TRUE;
                $config['width']          = 32;
                $config['height']         = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->db->where('staffid', get_staff_user_id());
                $CI->db->update('tblstaff', array(
                    'profile_image' => $filename
                ));
                // Remove original image
                unlink($newFilePath);
                return true;
            }
        }
    }
    return false;
}


/**
 * Check for client profile image
 * @return boolean
 */
function handle_client_profile_image_upload($clientid)
{
    if (isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name'] != '') {
        do_action('before_upload_client_profile_image');
        $path        = CLIENT_PROFILE_IMAGES_FOLDER . $clientid ;

        // Get the temp file path
        $tmpFilePath = $_FILES['profile_image']['tmp_name'];

        // Make sure we have a filepath
        if (isset($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts         = pathinfo($_FILES["profile_image"]["name"]);
            $extension          = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = array(
                'jpg',
                'jpeg',
                'png'
            );
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));
                return false;
            }

            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . '/index.html', 'w');
            }

            $filename    = unique_filename($path, $_FILES["profile_image"]["name"]);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI =& get_instance();
                $config                   = array();
                $config['image_library']  = 'gd2';
                $config['source_image']   = $newFilePath;
                $config['new_image']      = 'thumb_' . $filename;
                $config['maintain_ratio'] = TRUE;
                $config['width']          = 160;
                $config['height']         = 160;
                $CI->load->library('image_lib', $config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library']  = 'gd2';
                $config['source_image']   = $newFilePath;
                $config['new_image']      = 'small_' . $filename;
                $config['maintain_ratio'] = TRUE;
                $config['width']          = 32;
                $config['height']         = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->db->where('userid', $clientid);
                $CI->db->update('tblclients', array(
                    'profile_image' => $filename
                ));
                // Remove original image
                unlink($newFilePath);
                return true;
            }
        }
    }
    return false;
}



function handle_supplier_profile_image_upload($supplierid)
{
    if (isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name'] != '') {
        do_action('before_upload_supplier_profile_image');
        $path        = SUPPLIER_PROFILE_IMAGES_FOLDER . $supplierid ;

        // Get the temp file path
        $tmpFilePath = $_FILES['profile_image']['tmp_name'];

        // Make sure we have a filepath
        if (isset($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts         = pathinfo($_FILES["profile_image"]["name"]);
            $extension          = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = array(
                'jpg',
                'jpeg',
                'png'
            );
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));
                return false;
            }

            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . '/index.html', 'w');
            }

            $filename    = unique_filename($path, $_FILES["profile_image"]["name"]);
            $newFilePath = $path . '/' . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI =& get_instance();
                $config                   = array();
                $config['image_library']  = 'gd2';
                $config['source_image']   = $newFilePath;
                $config['new_image']      = 'thumb_' . $filename;
                $config['maintain_ratio'] = TRUE;
                $config['width']          = 160;
                $config['height']         = 160;
                $CI->load->library('image_lib', $config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library']  = 'gd2';
                $config['source_image']   = $newFilePath;
                $config['new_image']      = 'small_' . $filename;
                $config['maintain_ratio'] = TRUE;
                $config['width']          = 32;
                $config['height']         = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->db->where('supplierid', $supplierid);
                $CI->db->update('tblsuppliers', array(
                    'profile_image' => $filename
                ));
                // Remove original image
                unlink($newFilePath);
                return true;
            }
        }
    }
    return false;
}



/**
 * Check for staff profile image
 * @return boolean
 */
function handle_contact_profile_image_upload()
{
    if (isset($_FILES['profile_image']['name']) && $_FILES['profile_image']['name'] != '') {
        do_action('before_upload_contact_profile_image');
        $path        = CLIENT_PROFILE_IMAGES_FOLDER . get_contact_user_id() . '/';
        // Get the temp file path
        $tmpFilePath = $_FILES['profile_image']['tmp_name'];
        // Make sure we have a filepath
        if (!empty($tmpFilePath) && $tmpFilePath != '') {
            // Getting file extension
            $path_parts         = pathinfo($_FILES["profile_image"]["name"]);
            $extension          = $path_parts['extension'];
            $extension = strtolower($extension);
            $allowed_extensions = array(
                'jpg',
                'jpeg',
                'png'
            );
            if (!in_array($extension, $allowed_extensions)) {
                set_alert('warning', _l('file_php_extension_blocked'));
                return false;
            }
            // Setup our new file path
            if (!file_exists($path)) {
                mkdir($path);
                fopen($path . '/index.html', 'w');
            }
             $filename    = unique_filename($path, $_FILES["profile_image"]["name"]);
             $newFilePath = $path . $filename;
            // Upload the file into the company uploads dir
            if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                $CI =& get_instance();
                $config                   = array();
                $config['image_library']  = 'gd2';
                $config['source_image']   = $newFilePath;
                $config['new_image']      = 'thumb_' . $filename;
                $config['maintain_ratio'] = TRUE;
                $config['width']          = 160;
                $config['height']         = 160;
                $CI->load->library('image_lib', $config);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $config['image_library']  = 'gd2';
                $config['source_image']   = $newFilePath;
                $config['new_image']      = 'small_' . $filename;
                $config['maintain_ratio'] = TRUE;
                $config['width']          = 32;
                $config['height']         = 32;
                $CI->image_lib->initialize($config);
                $CI->image_lib->resize();
                $CI->db->where('id', get_contact_user_id());
                $CI->db->update('tblcontacts', array(
                    'profile_image' => $filename
                ));
                // Remove original image
                unlink($newFilePath);
                return true;
            }
        }
    }
    return false;
}

function handle_project_discussion_comment_attachments($discussion_id,$post_data,$insert_data){

    if (isset($_FILES['file']['name'])) {
       do_action('before_upload_project_discussion_comment_attachment');
       $path = PROJECT_DISCUSSION_ATTACHMENT_FOLDER .$discussion_id . '/';
                 // Get the temp file path
       $tmpFilePath = $_FILES['file']['tmp_name'];
                 // Make sure we have a filepath
       if (!empty($tmpFilePath) && $tmpFilePath != '') {
                 // Setup our new file path
        if (!file_exists($path)) {
            mkdir($path);
            fopen($path . 'index.html', 'w');
        }
        $filename    = unique_filename($path, $_FILES['file']['name']);
        $newFilePath = $path . $filename;
                 // Upload the file into the temp dir
        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            $insert_data['file_name'] = $filename;
            if(isset($_FILES['type'])){
                    $insert_data['file_mime_type'] = $_FILES['type'];
            } else {
                    $insert_data['file_mime_type'] = '';
            }

        }
    }
}

return $insert_data;
}
