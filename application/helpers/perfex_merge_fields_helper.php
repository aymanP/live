<?php

function get_other_merge_fields()
{
    $fields = array();
    $fields['{logo_url}'] = '<a href="' . site_url() . '" target="_blank"><img src="' . site_url('uploads/company/' . get_option('company_logo')) . '"></a>';
    $fields['{crm_url}'] = '<a href="' . site_url() . '">' . site_url() . '</a>';
    $fields['{main_domain}'] = get_option('main_domain');
    $fields['{companyname}'] = get_option('companyname');
    $fields['{email_signature}'] = get_option('email_signature');
    return $fields;
}



function get_project_merge_fields($project_id, $additional_data = array())
{
    $fields = array();

    $fields['{project_name}'] = '';
    $fields['{project_link}'] = '';
    $fields['{discussion_link}'] = '';
    $fields['{discussion_creator}'] = '';
    $fields['{comment_creator}'] = '';
    $fields['{file_creator}'] = '';
    $fields['{discussion_subject}'] = '';
    $fields['{discussion_description}'] = '';
    $fields['{discussion_comment}'] = '';

    $CI =& get_instance();

    $CI->db->where('id', $project_id);
    $project = $CI->db->get('tblprojects')->row();

    $fields['{project_name}'] = $project->name;
    if (is_client_logged_in()) {
        $cf = get_contact_full_name(get_contact_user_id());
        $fields['{file_creator}'] = $cf;
        $fields['{discussion_creator}'] = $cf;
        $fields['{comment_creator}'] = $cf;
    } else {
        $sf = get_staff_full_name(get_staff_user_id());
        $fields['{file_creator}'] = $sf;
        $fields['{discussion_creator}'] = $sf;
        $fields['{comment_creator}'] = $sf;
    }
    if (isset($additional_data['discussion_id'])) {
        $CI->db->where('id', $additional_data['discussion_id']);
        $CI->db->where('project_id', $project_id);
        $discussion = $CI->db->get('tblprojectdiscussions')->row();

        $fields['{discussion_subject}'] = $discussion->subject;
        $fields['{discussion_description}'] = $discussion->description;

        if (isset($additional_data['discussion_comment_id'])) {
            $CI->db->where('id', $additional_data['discussion_comment_id']);
            $CI->db->where('discussion_id', $additional_data['discussion_id']);
            $discussion_comment = $CI->db->get('tblprojectdiscussioncomments')->row();

            $fields['{discussion_comment}'] = $discussion_comment->content;
        }
    }
    if (isset($additional_data['customer_template'])) {
        $fields['{project_link}'] = '<a href="' . site_url('clients/project/' . $project_id) . '">' . $project->name . '</a>';

        if (isset($additional_data['discussion_id'])) {
            $fields['{discussion_link}'] = '<a href="' . site_url('clients/project/' . $project_id . '?group=project_discussions&discussion_id=' . $additional_data['discussion_id']) . '">' . $discussion->subject . '</a>';
        }
    } else {
        $fields['{project_link}'] = '<a href="' . admin_url('projects/view/' . $project_id) . '">' . $project->name . '</a>';
        if (isset($additional_data['discussion_id'])) {
            $fields['{discussion_link}'] = '<a href="' . admin_url('projects/view/' . $project_id . '?group=project_discussions&discussion_id=' . $additional_data['discussion_id']) . '">' . $discussion->subject . '</a>';
        }
    }

    return $fields;
}

function get_supplier_contact_merge_fields($supplier_id, $contact_id = '')
{

    $fields = array();

    if ($contact_id == '') {
        $contact_id = get_primary_contact_user_id($supplier_id);
    }

    $fields['{contact_firstname}'] = '';
    $fields['{contact_lastname}'] = '';
    $fields['{contact_email}'] = '';
    $fields['{client_company}'] = '';
    $fields['{client_phonenumber}'] = '';
    $fields['{client_country}'] = '';
    $fields['{client_city}'] = '';
    $fields['{client_zip}'] = '';
    $fields['{client_state}'] = '';
    $fields['{client_address}'] = '';

    $CI =& get_instance();
    $CI->db->where('userid', $supplier_id);
    $CI->db->join('tblcountries', 'tblcountries.country_id=tblsuppliers.country', 'left');
    $supplier = $CI->db->get('tblsuppliers')->row();
    if (!$supplier) {
        return $fields;
    }

    $CI->db->where('userid', $supplier_id);
    $CI->db->where('id', $contact_id);
    $contact = $CI->db->get('tblcontacts')->row();

    if ($contact) {
        $fields['{contact_firstname}'] = $contact->firstname;
        $fields['{contact_lastname}'] = $contact->lastname;
        $fields['{contact_email}'] = $contact->email;
    }

    $fields['{client_company}'] = $supplier->company;
    $fields['{client_phonenumber}'] = $supplier->company;
    $fields['{client_country}'] = $supplier->short_name;
    $fields['{client_city}'] = $supplier->city;
    $fields['{client_zip}'] = $supplier->zip;
    $fields['{client_state}'] = $supplier->state;
    $fields['{client_address}'] = $supplier->address;

    $custom_fields = get_custom_fields('customers');
    foreach ($custom_fields as $field) {
        $fields['{' . $field['slug'] . '}'] = get_custom_field_value($supplier_id, $field['id'], 'customers');
    }

    $custom_fields = get_custom_fields('contacts');
    foreach ($custom_fields as $field) {
        $fields['{' . $field['slug'] . '}'] = get_custom_field_value($contact_id, $field['id'], 'contacts');
    }

    return $fields;
}

function get_client_contact_merge_fields($client_id, $contact_id = '')
{

    $fields = array();

    if ($contact_id == '') {
        $contact_id = get_primary_contact_user_id($client_id);
    }

    $fields['{contact_firstname}'] = '';
    $fields['{contact_lastname}'] = '';
    $fields['{contact_email}'] = '';
    $fields['{client_company}'] = '';
    $fields['{client_phonenumber}'] = '';
    $fields['{client_country}'] = '';
    $fields['{client_city}'] = '';
    $fields['{client_zip}'] = '';
    $fields['{client_state}'] = '';
    $fields['{client_address}'] = '';

    $CI =& get_instance();
    $CI->db->where('userid', $client_id);
    $CI->db->join('tblcountries', 'tblcountries.country_id=tblclients.country', 'left');
    $client = $CI->db->get('tblclients')->row();
    if (!$client) {
        return $fields;
    }

    $CI->db->where('userid', $client_id);
    $CI->db->where('id', $contact_id);
    $contact = $CI->db->get('tblcontacts')->row();

    if ($contact) {
        $fields['{contact_firstname}'] = $contact->firstname;
        $fields['{contact_lastname}'] = $contact->lastname;
        $fields['{contact_email}'] = $contact->email;
    }

    $fields['{client_company}'] = $client->company;
    $fields['{client_phonenumber}'] = $client->company;
    $fields['{client_country}'] = $client->short_name;
    $fields['{client_city}'] = $client->city;
    $fields['{client_zip}'] = $client->zip;
    $fields['{client_state}'] = $client->state;
    $fields['{client_address}'] = $client->address;

    $custom_fields = get_custom_fields('customers');
    foreach ($custom_fields as $field) {
        $fields['{' . $field['slug'] . '}'] = get_custom_field_value($client_id, $field['id'], 'customers');
    }

    $custom_fields = get_custom_fields('contacts');
    foreach ($custom_fields as $field) {
        $fields['{' . $field['slug'] . '}'] = get_custom_field_value($contact_id, $field['id'], 'contacts');
    }

    return $fields;
}

function get_estimate_merge_fields($estimate_id)
{
    $fields = array();
    $CI =& get_instance();
    $CI->db->where('id', $estimate_id);
    $estimate = $CI->db->get('tblestimates')->row();
    if (!$estimate) {
        return $fields;
    }

    $fields['{estimate_link}'] = '<a href="' . site_url('viewestimate/' . $estimate_id . '/' . $estimate->hash) . '" target="_blank">' . _l('estimate_email_link_text') . '</a>';
    $fields['{estimate_number}'] = format_estimate_number($estimate_id);
    $fields['{estimate_expirydate}'] = _d($estimate->expirydate);
    $fields['{estimate_date}'] = _d($estimate->date);
    $fields['{estimate_status}'] = format_estimate_status($estimate->status, '', false);
    $fields['{estimate_status}'] = format_estimate_status($estimate->status, '', false);
    $fields['{estimate_reference_no}'] = $estimate->reference_no;

    $custom_fields = get_custom_fields('estimate');
    foreach ($custom_fields as $field) {
        $fields['{' . $field['slug'] . '}'] = get_custom_field_value($estimate_id, $field['id'], 'estimate');
    }

    return $fields;
}

function get_invoice_merge_fields($invoice_id)
{
    $fields = array();
    $CI =& get_instance();
    $CI->db->where('id', $invoice_id);
    $invoice = $CI->db->get('tblinvoices')->row();

    if (!$invoice) {
        return $fields;
    }

    $fields['{invoice_link}'] = '<a href="' . site_url('viewinvoice/' . $invoice_id . '/' . $invoice->hash) . '" target="_blank">' . _l('invoice_email_link_text') . '</a>';
    $fields['{invoice_number}'] = format_invoice_number($invoice_id);
    $fields['{invoice_duedate}'] = _d($invoice->duedate);
    $fields['{invoice_date}'] = _d($invoice->date);
    $fields['{invoice_status}'] = format_invoice_status($invoice->status, '', false);

    $custom_fields = get_custom_fields('invoice');
    foreach ($custom_fields as $field) {
        $fields['{' . $field['slug'] . '}'] = get_custom_field_value($invoice_id, $field['id'], 'invoice');
    }

    return $fields;
}

function get_proposal_merge_fields($proposal_id)
{
    $fields = array();
    $CI =& get_instance();
    $CI->db->where('id', $proposal_id);
    $proposal = $CI->db->get('tblproposals')->row();

    if (!$proposal) {
        return $fields;
    }

    $CI->load->model('currencies_model');
    if ($proposal->currency != 0) {
        $currency = $CI->currencies_model->get($proposal->currency);
    } else {
        $currency = $CI->currencies_model->get_base_currency();
    }

    $fields['{proposal_link}'] = '<a href="' . site_url('viewproposal/' . $proposal_id . '/' . $proposal->hash) . '" target="_blank">' . $proposal->subject . '</a>';
    $fields['{proposal_subject}'] = $proposal->subject;
    $fields['{proposal_total}'] = format_money($proposal->total, $currency->symbol);
    $fields['{proposal_open_till}'] = _d($proposal->open_till);
    $fields['{proposal_proposal_to}'] = $proposal->proposal_to;
    $fields['{proposal_address}'] = $proposal->address;
    $fields['{proposal_email}'] = $proposal->email;
    $fields['{proposal_phone}'] = $proposal->phone;

    $custom_fields = get_custom_fields('proposal');
    foreach ($custom_fields as $field) {
        $fields['{' . $field['slug'] . '}'] = get_custom_field_value($proposal_id, $field['id'], 'proposal');
    }

    return $fields;
}

function get_contract_merge_fields($contract_id)
{

    $fields = array();
    $CI =& get_instance();
    $CI->db->where('id', $contract_id);
    $contract = $CI->db->get('tblcontracts')->row();

    if (!$contract) {
        return $fields;
    }

    $CI->load->model('currencies_model');
    $currency = $CI->currencies_model->get_base_currency();

    $fields['{contract_subject}'] = $contract->subject;
    $fields['{contract_description}'] = $contract->description;
    $fields['{contract_datestart}'] = _d($contract->datestart);
    $fields['{contract_dateend}'] = _d($contract->dateend);
    $fields['{contract_contract_value}'] = format_money($contract->contract_value, $currency->symbol);

    $custom_fields = get_custom_fields('contracts');
    foreach ($custom_fields as $field) {
        $fields['{' . $field['slug'] . '}'] = get_custom_field_value($contract_id, $field['id'], 'contracts');
    }

    return $fields;
}

function get_task_merge_fields($task_id)
{

    $fields = array();

    $CI =& get_instance();
    $CI->db->where('id', $task_id);
    $task = $CI->db->get('tblstafftasks')->row();

    if (!$task) {
        return $fields;
    }

    $fields['{task_link}'] = '<a href="' . admin_url('tasks/list_tasks/' . $task_id) . '">' . $task->name . '</a>';

    if (is_client_logged_in()) {
        $fields['{task_user_take_action}'] = get_contact_full_name(get_contact_user_id());
    } else {
        $fields['{task_user_take_action}'] = get_staff_full_name(get_staff_user_id());
    }

    $fields['{task_name}'] = $task->name;
    $fields['{task_description}'] = $task->description;
    $fields['{task_priority}'] = task_priority($task->priority);
    $fields['{task_startdate}'] = _d($task->startdate);
    $fields['{task_duedate}'] = _d($task->duedate);

    $custom_fields = get_custom_fields('tasks');
    foreach ($custom_fields as $field) {
        $fields['{' . $field['slug'] . '}'] = get_custom_field_value($task_id, $field['id'], 'tasks');
    }

    return $fields;
}

function get_staff_merge_fields($staff_id)
{

    $fields = array();

    $CI =& get_instance();
    $CI->db->where('staffid', $staff_id);
    $staff = $CI->db->get('tblstaff')->row();

    if (!$staff) {
        return $fields;
    }

    $fields['{staff_firstname}'] = $staff->firstname;
    $fields['{staff_lastname}'] = $staff->lastname;

    $custom_fields = get_custom_fields('staff');
    foreach ($custom_fields as $field) {
        $fields['{' . $field['slug'] . '}'] = get_custom_field_value($staff_id, $field['id'], 'staff');
    }

    return $fields;
}

function get_ticket_merge_fields($template, $ticket_id, $reply_id = '')
{

    $fields = array();

    $CI =& get_instance();
    $CI->db->where('ticketid', $ticket_id);
    $ticket = $CI->db->get('tbltickets')->row();

    if (!$ticket) {
        return $fields;
    }

    $fields['{ticket_priority}'] = '';
    $fields['{ticket_service}'] = '';


    $CI->db->where('departmentid', $ticket->department);
    $department = $CI->db->get('tbldepartments')->row();
    if ($department) {
        $fields['{ticket_department}'] = $department->name;
    }

    $fields['{ticket_status}'] = ticket_status_translate($ticket->status);
    $CI->db->where('serviceid', $ticket->service);
    $service = $CI->db->get('tblservices')->row();
    if ($service) {
        $fields['{ticket_service}'] = $service->name;
    }

    $fields['{ticket_id}'] = $ticket_id;
    $fields['{ticket_priority}'] = ticket_priority_translate($ticket->priority);

    if ($template == 'ticket-reply-to-admin' || $template == 'ticket-reply') {
        if ($template != 'ticket-reply-to-admin' && $template != 'new-ticket-created-staff') {
            $fields['{ticket_url}'] = '<a href="' . site_url('clients/ticket/' . $ticket_id) . '" target="_blank">' . _l('ticket') . ' #' . $ticket_id . '</a>';
        } else {
            $fields['{ticket_url}'] = '<a href="' . admin_url('tickets/ticket/' . $ticket_id) . '" target="_blank">' . _l('ticket') . ' #' . $ticket_id . '</a>';
        }
    } else {
        $fields['{ticket_url}'] = '<a href="' . admin_url('tickets/ticket/' . $ticket_id) . '" target="_blank">' . _l('ticket') . ' #' . $ticket_id . '</a>';
    }

    if ($template == 'ticket-reply-to-admin' || $template == 'ticket-reply') {
        $CI->db->where('ticketid', $ticket_id);
        $CI->db->limit(1);
        $CI->db->order_by('date', 'desc');
        $reply = $CI->db->get('tblticketreplies')->row();
        $fields['{ticket_message}'] = $reply->message;
    } else {
        $fields['{ticket_message}'] = $ticket->message;
    }

    $fields['{ticket_date}'] = _dt($ticket->date);
    $fields['{ticket_subject}'] = $ticket->subject;

    return $fields;
}

/**
 * @return array
 * All available merge fields for templates are defined here
 */
function get_available_merge_fields()
{
    $available_merge_fields = array(
        array(
            'staff' => array(
                array(
                    'name' => 'Staff Firstname',
                    'key' => '{staff_firstname}',
                    'available' => array(
                        'staff',
                        'tasks',
                        'project',
                    )
                ),
                array(
                    'name' => 'Staff Lastname',
                    'key' => '{staff_lastname}',
                    'available' => array(
                        'staff',
                        'tasks',
                        'project',
                    )
                ),
                array(
                    'name' => 'Staff Email',
                    'key' => '{staff_email}',
                    'available' => array(
                        'staff',
                        'project',
                    )
                ),
                array(
                    'name' => 'Staff Date Created',
                    'key' => '{staff_datecreated}',
                    'available' => array(
                        'staff'
                    )
                )
            )
        ),
        array(
            'clients' => array(
                array(
                    'name' => 'Contact Firstname',
                    'key' => '{contact_firstname}',
                    'available' => array(
                        'client',
                        'ticket',
                        'invoice',
                        'estimate',
                        'contract',
                        'project',
                    )
                ),
                array(
                    'name' => 'Contact Lastname',
                    'key' => '{contact_lastname}',
                    'available' => array(
                        'client',
                        'ticket',
                        'invoice',
                        'estimate',
                        'contract',
                        'project',
                    )
                ),
                array(
                    'name' => 'Contact Email',
                    'key' => '{contact_email}',
                    'available' => array(
                        'client',
                        'invoice',
                        'estimate',
                        'ticket',
                        'contract',
                        'project',
                    )
                ),
                array(
                    'name' => 'Client Company',
                    'key' => '{client_company}',
                    'available' => array(
                        'client',
                        'invoice',
                        'estimate',
                        'ticket',
                        'contract'
                    )
                ),
                array(
                    'name' => 'Client Phonenumber',
                    'key' => '{client_phonenumber}',
                    'available' => array(
                        'client',
                        'invoice',
                        'estimate',
                        'ticket',
                        'contract',
                        'project',
                    )
                ),
                array(
                    'name' => 'Client Country',
                    'key' => '{client_country}',
                    'available' => array(
                        'client',
                        'invoice',
                        'estimate',
                        'ticket',
                        'contract',
                        'project',
                    )
                ),
                array(
                    'name' => 'Client City',
                    'key' => '{client_city}',
                    'available' => array(
                        'client',
                        'invoice',
                        'estimate',
                        'ticket',
                        'contract',
                        'project',
                    )
                ),
                array(
                    'name' => 'Client Zip',
                    'key' => '{client_zip}',
                    'available' => array(
                        'client',
                        'invoice',
                        'estimate',
                        'ticket',
                        'contract',
                        'project',
                    )
                ),
                array(
                    'name' => 'Client State',
                    'key' => '{client_state}',
                    'available' => array(
                        'client',
                        'invoice',
                        'estimate',
                        'ticket',
                        'contract',
                        'project',
                    )
                ),
                array(
                    'name' => 'Client Address',
                    'key' => '{client_address}',
                    'available' => array(
                        'client',
                        'invoice',
                        'estimate',
                        'ticket',
                        'contract',
                        'project',
                    )
                )
            )
        ),
        array(
            'ticket' => array(
                array(
                    'name' => 'Ticket ID',
                    'key' => '{ticket_id}',
                    'available' => array(
                        'ticket'
                    )
                ),
                array(
                    'name' => 'Ticket URL',
                    'key' => '{ticket_url}',
                    'available' => array(
                        'ticket'
                    )
                ),
                array(
                    'name' => 'Department',
                    'key' => '{ticket_department}',
                    'available' => array(
                        'ticket'
                    )
                ),
                array(
                    'name' => 'Date Opened',
                    'key' => '{ticket_date}',
                    'available' => array(
                        'ticket'
                    )
                ),
                array(
                    'name' => 'Ticket Subject',
                    'key' => '{ticket_subject}',
                    'available' => array(
                        'ticket'
                    )
                ),
                array(
                    'name' => 'Ticket Message',
                    'key' => '{ticket_message}',
                    'available' => array(
                        'ticket'
                    )
                ),
                array(
                    'name' => 'Ticket Status',
                    'key' => '{ticket_status}',
                    'available' => array(
                        'ticket'
                    )
                ),
                array(
                    'name' => 'Ticket Priority',
                    'key' => '{ticket_priority}',
                    'available' => array(
                        'ticket'
                    )
                )
            )
        ),
        array(
            'contract' => array(
                array(
                    'name' => 'Contract Subject',
                    'key' => '{contract_subject}',
                    'available' => array(
                        'contract'
                    )
                ),
                array(
                    'name' => 'Contract Description',
                    'key' => '{contract_description}',
                    'available' => array(
                        'contract'
                    )
                ),
                array(
                    'name' => 'Contract Date Start',
                    'key' => '{contract_datestart}',
                    'available' => array(
                        'contract'
                    )
                ),
                array(
                    'name' => 'Contract Date End',
                    'key' => '{contract_dateend}',
                    'available' => array(
                        'contract'
                    )
                ),
                array(
                    'name' => 'Contract Value',
                    'key' => '{contract_contract_value}',
                    'available' => array(
                        'contract'
                    )
                )
            )
        ),
        array(
            'invoice' => array(
                array(
                    'name' => 'Invoice Link',
                    'key' => '{invoice_link}',
                    'available' => array(
                        'invoice'
                    )
                ),
                array(
                    'name' => 'Invoice Number',
                    'key' => '{invoice_number}',
                    'available' => array(
                        'invoice'
                    )
                ),
                array(
                    'name' => 'Invoice Duedate',
                    'key' => '{invoice_duedate}',
                    'available' => array(
                        'invoice'
                    )
                ),
                array(
                    'name' => 'Invoice Date',
                    'key' => '{invoice_date}',
                    'available' => array(
                        'invoice'
                    )
                ),
                array(
                    'name' => 'Invoice Status',
                    'key' => '{invoice_status}',
                    'available' => array(
                        'invoice'
                    )
                )
            )
        ),
        array(
            'estimate' => array(
                array(
                    'name' => 'Estimate Link',
                    'key' => '{estimate_link}',
                    'available' => array(
                        'estimate'
                    )
                ),
                array(
                    'name' => 'Estimate Number',
                    'key' => '{estimate_number}',
                    'available' => array(
                        'estimate'
                    )
                ),
                array(
                    'name' => 'Reference no.',
                    'key' => '{estimate_reference_no}',
                    'available' => array(
                        'estimate'
                    )
                ),
                array(
                    'name' => 'Estimate Expiry Date',
                    'key' => '{estimate_expirydate}',
                    'available' => array(
                        'estimate'
                    )
                ),
                array(
                    'name' => 'Estimate Date',
                    'key' => '{estimate_date}',
                    'available' => array(
                        'estimate'
                    )
                ),
                array(
                    'name' => 'Estimate Status',
                    'key' => '{estimate_status}',
                    'available' => array(
                        'estimate'
                    )
                )
            )
        ),
        array(
            'tasks' => array(
                array(
                    'name' => 'Staff/Contact who take action on task',
                    'key' => '{task_user_take_action}',
                    'available' => array(
                        'tasks'
                    )
                ),
                array(
                    'name' => 'Task Link',
                    'key' => '{task_link}',
                    'available' => array(
                        'tasks'
                    )
                ),
                array(
                    'name' => 'Task Name',
                    'key' => '{task_name}',
                    'available' => array(
                        'tasks'
                    )
                ),
                array(
                    'name' => 'Task Description',
                    'key' => '{task_description}',
                    'available' => array(
                        'tasks'
                    )
                ),
                array(
                    'name' => 'Task Priority',
                    'key' => '{task_priority}',
                    'available' => array(
                        'tasks'
                    )
                ),
                array(
                    'name' => 'Task Start Date',
                    'key' => '{task_startdate}',
                    'available' => array(
                        'tasks'
                    )
                ),
                array(
                    'name' => 'Task Due Date',
                    'key' => '{task_duedate}',
                    'available' => array(
                        'tasks'
                    )
                )
            )
        ),
        array(
            'proposals' => array(
                array(
                    'name' => 'Subject',
                    'key' => '{proposal_subject}',
                    'available' => array(
                        'proposals'
                    )
                ),
                array(
                    'name' => 'Total',
                    'key' => '{proposal_total}',
                    'available' => array(
                        'proposals'
                    )
                ),
                array(
                    'name' => 'Open Till',
                    'key' => '{proposal_open_till}',
                    'available' => array(
                        'proposals'
                    )
                ),
                array(
                    'name' => 'Company Name',
                    'key' => '{proposal_proposal_to}',
                    'available' => array(
                        'proposals'
                    )
                ),
                array(
                    'name' => 'Address',
                    'key' => '{proposal_address}',
                    'available' => array(
                        'proposals'
                    )
                ),
                array(
                    'name' => 'Email',
                    'key' => '{proposal_email}',
                    'available' => array(
                        'proposals'
                    )
                ),
                array(
                    'name' => 'Phone',
                    'key' => '{proposal_phone}',
                    'available' => array(
                        'proposals'
                    )
                ),
                array(
                    'name' => 'Proposal Link',
                    'key' => '{proposal_link}',
                    'available' => array(
                        'proposals'
                    )
                )
            )
        ),
        array(
            'projects' => array(
                array(
                    'name' => 'Project Name',
                    'key' => '{project_name}',
                    'available' => array('project'),
                ),
                array(
                    'name' => 'Project Link',
                    'key' => '{project_link}',
                    'available' => array('project'),
                ),
                array(
                    'name' => 'Discussion Link',
                    'key' => '{discussion_link}',
                    'available' => array('project'),
                ),
                array(
                    'name' => 'File Creator',
                    'key' => '{file_creator}',
                    'available' => array('project'),
                ),
                array(
                    'name' => 'Discussion Creator',
                    'key' => '{discussion_creator}',
                    'available' => array('project'),
                ),
                array(
                    'name' => 'Comment Creator',
                    'key' => '{comment_creator}',
                    'available' => array('project'),
                ),
                array(
                    'name' => 'Discussion Subject',
                    'key' => '{discussion_subject}',
                    'available' => array('project'),
                ),
                array(
                    'name' => 'Discussion Description',
                    'key' => '{discussion_description}',
                    'available' => array('project'),
                ),
                array(
                    'name' => 'Discussion Comment',
                    'key' => '{discussion_comment}',
                    'available' => array('project'),
                ),
            )
        ),
        array(
            'other' => array(
                array(
                    'name' => 'Logo Url',
                    'key' => '{logo_url}',
                    'fromoptions' => true,
                    'available' => array(
                        'ticket',
                        'client',
                        'staff',
                        'invoice',
                        'estimate',
                        'contract',
                        'tasks',
                        'proposals',
                        'project',
                    )
                ),
                array(
                    'name' => 'CRM Url',
                    'key' => '{crm_url}',
                    'fromoptions' => true,
                    'available' => array(
                        'ticket',
                        'client',
                        'staff',
                        'invoice',
                        'estimate',
                        'contract',
                        'tasks',
                        'proposals',
                        'project',
                    )
                ),
                array(
                    'name' => 'Main Domain',
                    'key' => '{main_domain}',
                    'fromoptions' => true,
                    'available' => array(
                        'ticket',
                        'client',
                        'staff',
                        'invoice',
                        'estimate',
                        'contract',
                        'tasks',
                        'proposals',
                        'project',
                    )
                ),
                array(
                    'name' => 'Company Name',
                    'key' => '{companyname}',
                    'fromoptions' => true,
                    'available' => array(
                        'ticket',
                        'client',
                        'staff',
                        'invoice',
                        'estimate',
                        'contract',
                        'tasks',
                        'proposals',
                        'project',
                    )
                ),
                array(
                    'name' => 'Email Signature',
                    'key' => '{email_signature}',
                    'fromoptions' => true,
                    'available' => array(
                        'ticket',
                        'client',
                        'staff',
                        'invoice',
                        'estimate',
                        'contract',
                        'tasks',
                        'proposals',
                        'project',
                    )
                )
            )
        )
    );
    if (get_option('services') == 1) {
        $services = array(
            'name' => 'Ticket Service',
            'key' => '{ticket_service}',
            'available' => array(
                'ticket'
            )
        );
        array_push($available_merge_fields[2]['ticket'], $services);
    }

    $i = 0;
    foreach ($available_merge_fields as $fields) {
        $f = 0;
        foreach ($fields as $key => $_fields) {
            switch ($key) {
                case 'clients':
                    $_key = 'customers';
                    break;
                case 'proposals':
                    $_key = 'proposal';
                    break;
                case 'contract':
                    $_key = 'contracts';
                    break;
                default:
                    $_key = $key;
                    break;
            }

            $custom_fields = get_custom_fields($_key);
            foreach ($custom_fields as $field) {
                array_push($available_merge_fields[$i][$key], array(
                    'name' => $field['name'],
                    'key' => '{' . $field['slug'] . '}',
                    'available' => $available_merge_fields[$i][$key][$f]['available'],
                ));
            }

            $f++;

        }
        $i++;
    }
    return $available_merge_fields;
}
