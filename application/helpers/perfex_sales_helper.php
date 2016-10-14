<?php
// Since Version 1.0.1
/**
 * Check if company using invoice with different currencies
 * @return boolean
 */
function is_using_multiple_currencies($table = 'tblinvoices')
{
    $CI =& get_instance();
    $CI->load->model('currencies_model');
    $currencies            = $CI->currencies_model->get();
    $total_currencies_used = 0;
    $other_then_base = false;
    $base_found = false;
    foreach ($currencies as $currency) {
        $CI->db->where('currency', $currency['id']);
        $total = $CI->db->count_all_results($table);
        if ($total > 0) {
            $total_currencies_used++;
            if($currency['isdefault'] == 0){
                $other_then_base = true;
            } else {
                $base_found = true;
            }
        }
    }

    if ($total_currencies_used > 1 && $base_found == true && $other_then_base == true) {
        return true;
    } else if($total_currencies_used == 1 && $base_found == false && $other_then_base == true){
        return true;
    } else if ($total_currencies_used == 0 || $total_currencies_used == 1) {
        return false;
    }
    return true;
}
/**
 * Check if client have invoices with multiple currencies
 * @return booelan
 */
function is_client_using_multiple_currencies($clientid = '', $table = 'tblinvoices')
{
    if ($clientid == '') {
        $clientid = get_client_user_id();
    }
    $CI =& get_instance();
    $CI->load->model('currencies_model');
    $currencies            = $CI->currencies_model->get();
    $total_currencies_used = 0;
    foreach ($currencies as $currency) {
        $CI->db->where('currency', $currency['id']);
        $CI->db->where('clientid', $clientid);
        $total = $CI->db->count_all_results($table);
        if ($total > 0) {
            $total_currencies_used++;
        }
    }
    if ($total_currencies_used > 1) {
        return true;
    } else if ($total_currencies_used == 0 || $total_currencies_used == 1) {
        return false;
    }
    return true;
}
/**
 * Get invoice total left for paying if not payments found the original total from the invoice will be returned
 * @since  Version 1.0.1
 * @param  mixed $id     invoice id
 * @param  mixed $invoice_total
 * @return mixed  total left
 */
function get_invoice_total_left_to_pay($id, $invoice_total)
{
    $CI =& get_instance();
    $CI->load->model('payments_model');
    $payments = $CI->payments_model->get_invoice_payments($id);
    foreach ($payments as $payment) {
        $invoice_total -= $payment['amount'];
    }
    return $invoice_total;
}
/**
 * Check invoice restrictions - hash, clientid
 * @since  Version 1.0.1
 * @param  mixed $id   invoice id
 * @param  string $hash invoice hash
 */
function check_invoice_restrictions($id, $hash)
{
    $CI =& get_instance();
    $CI->load->model('invoices_model');
    if (!$hash || !$id) {
        show_404();
    }
    if (!is_client_logged_in() && !is_staff_logged_in()) {
        if (get_option('view_invoice_only_logged_in') == 1) {
            redirect(site_url('clients/login'));
        }
    }
    $invoice = $CI->invoices_model->get($id);
    if (!$invoice || ($invoice->hash != $hash)) {
        show_404();
    }

    // Do one more check
    if (!is_staff_logged_in()) {
        if (get_option('view_invoice_only_logged_in') == 1) {
            if ($invoice->clientid != get_client_user_id()) {
                show_404();
            }
        }
    }
}
/**
 * Check estimate restrictions - hash, clientid
 * @since  Version 1.0.1
 * @param  mixed $id   estimate id
 * @param  string $hash estimate hash
 */
function check_estimate_restrictions($id, $hash)
{
    $CI =& get_instance();
    $CI->load->model('estimates_model');
    if (!$hash || !$id) {
        show_404();
    }
    if (!is_client_logged_in() && !is_staff_logged_in()) {
        if (get_option('view_estimate_only_logged_in') == 1) {
            redirect(site_url('clients/login'));
        }
    }
    $estimate = $CI->estimates_model->get($id);
    if (!$estimate || ($estimate->hash != $hash)) {
        show_404();
    }
    // Do one more check
    if (!is_staff_logged_in()) {
        if (get_option('view_estimate_only_logged_in') == 1) {
            if ($estimate->clientid != get_client_user_id()) {
               show_404();
            }
        }
    }
}
function check_proposal_restrictions($id, $hash)
{
    $CI =& get_instance();
    $CI->load->model('proposals_model');
    if (!$hash || !$id) {
        show_404();
    }
    $proposal = $CI->proposals_model->get($id);
    if (!$proposal || ($proposal->hash != $hash)) {
        show_404();
    }
}
/**
 * Forat number with 2 decimals
 * @param  mixed $total
 * @return string
 */
function _format_number($total,$force_checking_zero_decimals = false)
{
    if (!is_numeric($total)) {
        return false;
    }
    $decimal_separator  = get_option('decimal_separator');
    $thousand_separator = get_option('thousand_separator');

    $d = 2;
    if(get_option('remove_decimals_on_zero') == 1 || $force_checking_zero_decimals == true){
        if(!is_decimal($total)){
            $d = 0;
        }
    }
    return number_format($total, $d, $decimal_separator, $thousand_separator);
}
function number_unformat($number, $force_number = true)
{
    if ($force_number) {
        $number = preg_replace('/^[^\d]+/', '', $number);
    } else if (preg_match('/^[^\d]+/', $number)) {
        return false;
    }
    $dec_point     = get_option('decimal_separator');
    $thousands_sep = get_option('thousand_separator');
    $type          = (strpos($number, $dec_point) === false) ? 'int' : 'float';
    $number        = str_replace(array(
        $dec_point,
        $thousands_sep
    ), array(
        '.',
        ''
    ), $number);
    settype($number, $type);
    return $number;
}
/**
 * Format money with 2 decimal based on symbol
 * @param  mixed $total
 * @param  string $symbol Money symbol
 * @return string
 */
function format_money($total, $symbol = '')
{
    if (!is_numeric($total) && $total != 0) {
        return false;
    }

    $decimal_separator  = get_option('decimal_separator');
    $thousand_separator = get_option('thousand_separator');
    $currency_placement = get_option('currency_placement');
    $d = 2;
    if(get_option('remove_decimals_on_zero') == 1){
        if(!is_decimal($total)){
            $d = 0;
        }
    }
    $total = number_format($total, $d, $decimal_separator, $thousand_separator);
    if ($currency_placement === 'after') {
        $_formated = $total . '' . $symbol;
    } else {
        $_formated = $symbol . '' . $total;
    }
    return $_formated;
}
function is_decimal($val){
    return is_numeric( $val ) && floor( $val ) != $val;
}
function mutiple_taxes_found_for_item($taxes){
    $names = array();
    foreach($taxes as $t){
        array_push($names,$t['taxname']);
    }
    $names            = array_map("unserialize", array_unique(array_map("serialize", $names)));
    if(count($names) == 1){
        return false;
    }
    return true;
}
/**
 * Format invoice status
 * @param  integer  $status
 * @param  string  $classes additional classes
 * @param  boolean $label   To include in html label or not
 * @return mixed
 */
function format_invoice_status($status, $classes = '', $label = true)
{
    $label_class = get_invoice_status_label($status);
    if ($status == 1) {
        $status      = _l('invoice_status_unpaid');
    } else if ($status == 2) {
        $status      = _l('invoice_status_paid');
    } else if ($status == 3) {
        $status      = _l('invoice_status_not_paid_completely');
    } else if($status == 4){
        $status      = _l('invoice_status_overdue');
    } else {
        // status 5
        $status      = _l('invoice_status_cancelled');
    }
    if ($label == true) {
        return '<span class="label label-' . $label_class . ' ' . $classes . ' s-status">' . $status . '</span>';
    } else {
        return $status;
    }
}
function get_invoice_status_label($status){
    if ($status == 1) {
        $label_class = 'danger';
    } else if ($status == 2) {
        $label_class = 'success';
    } else if ($status == 3) {
        $label_class = 'warning';
    } else if($status == 4){
        $label_class = 'warning';
    } else {
        // status 5
        $label_class = 'default';
    }
    return $label_class;
}
/**
 * Format estimate status
 * @param  integer  $status
 * @param  string  $classes additional classes
 * @param  boolean $label   To include in html label or not
 * @return mixed
 */
function format_estimate_status($status, $classes = '', $label = true)
{
    $label_class = estimate_status_color_class($status);
    $status = estimate_status_by_id($status);
    if ($label == true) {
        return '<span class="label label-' . $label_class . ' ' . $classes . ' s-status">' . $status . '</span>';
    } else {
        return $status;
    }
}
function estimate_status_by_id($id){
    if ($id == 1) {
        $status      = _l('estimate_status_draft');
    } else if ($id == 2) {
        $status      = _l('estimate_status_sent');
    } else if ($id == 3) {
        $status      = _l('estimate_status_declined');
    } else if ($id == 4) {
        $status      = _l('estimate_status_accepted');
    } else {
        // status 5
        $status      = _l('estimate_status_expired');
    }
    return $status;
}
function estimate_status_color_class($id,$replace_default_by_muted = false){
    if ($id == 1) {
        $class = 'default';
        if($replace_default_by_muted == true){
            $class = 'muted';
        }
    } else if ($id == 2) {
        $class = 'info';
    } else if ($id == 3) {
        $class = 'danger';
    } else if ($id == 4) {
        $class = 'success';
    } else {
        // status 5
        $class = 'warning';
    }
    return $class;
}
function proposal_status_color_class($id,$replace_default_by_muted = false){
    if ($id == 0) {
        $class = 'default';
    } else if ($id == 1) {
        $class = 'default';
    } else if ($id == 2) {
        $class = 'danger';
    } else if ($id == 3) {
        $class = 'success';
    } else {
        // status 4
        $class = 'info';
    }
    if($class == 'default'){
        if($replace_default_by_muted == true){
            $class ='muted';
        }
    }
    return $class;
}
function format_proposal_status($status, $classes = '', $label = true)
{
    if($status == 0){
        $status      = _l('proposal_status_draft');
        $label_class = 'default';
    } else if ($status == 1) {
        $status      = _l('proposal_status_open');
        $label_class = 'default';
    } else if ($status == 2) {
        $status      = _l('proposal_status_declined');
        $label_class = 'danger';
    } else if ($status == 3) {
        $status      = _l('proposal_status_accepted');
        $label_class = 'success';
    } else if ($status == 4) {
        $status      = _l('proposal_status_sent');
        $label_class = 'info';
    } else {
        return $status;
    }
    if ($label == true) {
        return '<span class="label label-' . $label_class . ' ' . $classes . ' s-status">' . $status . '</span>';
    } else {
        return $status;
    }
}
/**
 * Update invoice status
 * @param  mixed $id invoice id
 * @return mixed invoice updates status / if no update return false
 */
function update_invoice_status($id)
{
    $CI =& get_instance();

    $CI->load->model('invoices_model');
    $invoice         = $CI->invoices_model->get($id);

    $CI->load->model('payments_model');
    $payments        = $CI->payments_model->get_invoice_payments($id);

    $original_status = $invoice->status;
    $total_payments  = array();
    $status          = 1;
    // Check if the first payments is equal to invoice total
    if (isset($payments[0])) {
        if ($payments[0]['amount'] == $invoice->total) {
            // Paid status
            $status = 2;
        } else {
            foreach ($payments as $payment) {
                array_push($total_payments, $payment['amount']);
            }
            $total = array_sum($total_payments);
            if ($total == $invoice->total) {
                // Paid status
                $status = 2;
            } else if ($total == 0) {
                // Unpaid status
                $status = 1;
            } else {

                if ($invoice->duedate != null) {
                    if ($total > 0) {
                        // Not paid completely status
                        $status = 3;
                    } else if (date('Y-m-d', strtotime($invoice->duedate)) < date('Y-m-d')) {
                        $status = 4;
                    }
                } else {
                    // Not paid completely status
                    $status = 3;
                }
            }
        }
    } else {
        if ($invoice->duedate != null) {
            if (date('Y-m-d', strtotime($invoice->duedate)) < date('Y-m-d')) {
                // Overdue status
                $status = 4;
            }
        }
    }
    $CI->db->where('id', $id);
    $CI->db->update('tblinvoices', array(
        'status' => $status
    ));
    if ($CI->db->affected_rows() > 0) {

        logActivity('Invoice Status Updated [Invoice Number: ' . format_invoice_number($invoice->id) . ', From: ' . format_invoice_status($original_status, '', false) . ' To: ' . format_invoice_status($status, '', false) . ']', NULL);

        $additional_activity = serialize(array(
            '<original_status>'.$original_status.'</original_status>',
            '<new_status>'.$status.'</new_status>'
        ));

        $CI->invoices_model->log_invoice_activity($invoice->id, 'invoice_activity_status_updated',false,$additional_activity);
        return $status;
    }
    return false;
}
/**
 * Check if the give invoice id is last invoice
 * @param  mixed  $id invoice id
 * @return boolean
 */
function is_last_invoice($id)
{
    $CI =& get_instance();
    $CI->db->select('id')->from('tblinvoices')->order_by('id', 'desc')->limit(1);
    $query           = $CI->db->get();
    $last_invoice_id = $query->row()->id;
    if ($last_invoice_id == $id) {
        return true;
    }
    return false;
}
/**
 * Check if the give estimate id is last invoice
 * @since Version 1.0.2
 * @param  mixed  $id estimateid
 * @return boolean
 */
function is_last_estimate($id)
{
    $CI =& get_instance();
    $CI->db->select('id')->from('tblestimates')->order_by('id', 'desc')->limit(1);
    $query            = $CI->db->get();
    $last_estimate_id = $query->row()->id;
    if ($last_estimate_id == $id) {
        return true;
    }
    return false;
}
/**
 * Format invoice number based on description
 * @param  mixed $id
 * @return string
 */
function format_invoice_number($id)
{
    $CI =& get_instance();
    $CI->db->select('year,number')->from('tblinvoices')->where('id', $id);
    $invoice = $CI->db->get()->row();
    $format  = get_option('invoice_number_format');
    if ($format == 1) {
        // Number based
        return get_option('invoice_prefix') . str_pad($invoice->number, get_option('number_padding_invoice_and_estimate'), '0', STR_PAD_LEFT);
    } else if ($format == 2) {
        return get_option('invoice_prefix') . $invoice->year . '/' . str_pad($invoice->number, get_option('number_padding_invoice_and_estimate'), '0', STR_PAD_LEFT);
    }
    return $number;
}
/**
 * Format estimate number based on description
 * @since  Version 1.0.2
 * @param  mixed $id
 * @return string
 */
function format_estimate_number($id)
{
    $CI =& get_instance();
    $CI->db->select('year,number')->from('tblestimates')->where('id', $id);
    $estimate = $CI->db->get()->row();
    $format   = get_option('estimate_number_format');
    if ($format == 1) {
        // Number based
        return get_option('estimate_prefix') . str_pad($estimate->number, get_option('number_padding_invoice_and_estimate'), '0', STR_PAD_LEFT);
    } else if ($format == 2) {
        return get_option('estimate_prefix') . $estimate->year . '/' . str_pad($estimate->number, get_option('number_padding_invoice_and_estimate'), '0', STR_PAD_LEFT);
    }
    return $number;
}
/**
 * Helper function to get tax by passedid
 * @param  integer $id taxid
 * @return object
 */
function get_tax_by_id($id)
{
    $CI =& get_instance();
    $CI->db->where('id', $id);
    return $CI->db->get('tbltaxes')->row();
}
/**
 * Helper function to get tax by passed name
 * @param  string $name tax name
 * @return object
 */
function get_tax_by_name($name)
{
    $CI =& get_instance();
    $CI->db->where('name', $name);
    return $CI->db->get('tbltaxes')->row();
}
function get_invoice_item_taxes($itemid)
{
    $CI =& get_instance();
    $CI->db->where('itemid', $itemid);
    $taxes = $CI->db->get('tblinvoiceitemstaxes')->result_array();
    $i     = 0;
    foreach ($taxes as $tax) {
        $taxes[$i]['taxname'] = $tax['taxname'] . '|' . $tax['taxrate'];
        $i++;
    }
    return $taxes;
}
function get_estimate_item_taxes($itemid)
{
    $CI =& get_instance();
    $CI->db->where('itemid', $itemid);
    $taxes = $CI->db->get('tblestimateitemstaxes')->result_array();
    $i     = 0;
    foreach ($taxes as $tax) {
        $taxes[$i]['taxname'] = $tax['taxname'] . '|' . $tax['taxrate'];
        $i++;
    }
    return $taxes;
}
/**
 * Check if payment mode is allowed for specific invoice
 * @param  mixed  $id payment mode id
 * @param  mixed  $invoiceid invoice id
 * @return boolean
 */
function is_payment_mode_allowed_for_invoice($id, $invoiceid)
{
    $CI =& get_instance();
    $CI->db->select('tblcurrencies.name as currency_name,allowed_payment_modes')->from('tblinvoices')->join('tblcurrencies', 'tblcurrencies.id = tblinvoices.currency', 'left')->where('tblinvoices.id', $invoiceid);
    $invoice       = $CI->db->get()->row();
    $allowed_modes = $invoice->allowed_payment_modes;
    if (!is_null($allowed_modes)) {
        $allowed_modes = unserialize($allowed_modes);
        if (count($allowed_modes) == 0) {
            return false;
        } else {
            foreach ($allowed_modes as $mode) {
                if ($mode == $id) {
                    // is offline payment mode
                    if (is_numeric($id)) {
                        return true;
                    }
                    // check currencies
                    $currencies = explode(',', get_option('paymentmethod_' . $id . '_currencies'));
                    foreach ($currencies as $currency) {
                        $currency = trim($currency);
                        if (strtoupper($currency) == strtoupper($invoice->currency_name)) {
                            return true;
                        }
                    }
                    return false;
                }
            }
        }
    } else {
        return false;
    }
    return false;
}
/**
 * Check if invoice mode exists in invoice
 * @since  Version 1.0.1
 * @param  array  $modes     all invoice modes
 * @param  mixed  $invoiceid invoice id
 * @param  boolean $offline   should check offline or online modes
 * @return boolean
 */
function found_invoice_mode($modes, $invoiceid, $offline = true)
{
    $CI =& get_instance();
    $CI->db->select('tblcurrencies.name as currency_name,allowed_payment_modes')->from('tblinvoices')->join('tblcurrencies', 'tblcurrencies.id = tblinvoices.currency', 'left')->where('tblinvoices.id', $invoiceid);
    $invoice = $CI->db->get()->row();
    if (!is_null($invoice->allowed_payment_modes)) {
        $invoice->allowed_payment_modes = unserialize($invoice->allowed_payment_modes);
        if (count($invoice->allowed_payment_modes) == 0) {
            return false;
        } else {
            foreach ($modes as $mode) {
                if ($offline == true) {
                    if (is_numeric($mode['id'])) {
                        foreach ($invoice->allowed_payment_modes as $allowed_mode) {
                            if ($allowed_mode == $mode['id']) {
                                return true;
                            }
                        }
                    }
                } else {
                    if (!is_numeric($mode['id']) && !empty($mode['id'])) {
                        foreach ($invoice->allowed_payment_modes as $allowed_mode) {
                            if ($allowed_mode == $mode['id']) {
                                // Check for currencies
                                $currencies = explode(',', get_option('paymentmethod_' . $mode['id'] . '_currencies'));
                                foreach ($currencies as $currency) {
                                    $currency = trim($currency);
                                    if (strtoupper($currency) == strtoupper($invoice->currency_name)) {
                                        return true;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    return false;
}
function load_pdf_language($clientid)
{
    $CI =& get_instance();
    $lang     = get_option('active_language');
    // When cron or email sending pdf document the pdfs need to be on the client language
    $language = get_client_default_language($clientid);
    if (DEFINED('CRON') || DEFINED('EMAIL_TEMPLATE_SEND')) {
        if (!empty($language)) {
            $lang = $language;
        }
    } else {
        if (get_option('output_client_pdfs_from_admin_area_in_client_language') == 1) {
            if (!empty($language)) {
                $lang = $language;
            }
        }
    }
    if (file_exists(APPPATH . 'language/' . $lang)) {
        $CI->lang->load($lang . '_lang', $lang);
    }
}

function pdf_logo_url(){
    $custom_pdf_logo_image_url = get_option('custom_pdf_logo_image_url');

    if ($custom_pdf_logo_image_url != '') {
        $path_parts = pathinfo($custom_pdf_logo_image_url);
        if(!isset($path_parts['extension']) || ( isset($path_parts['extension']) && $path_parts['extension'] == null)){
            $extension = get_file_extension($custom_pdf_logo_image_url);
        } else {
            $extension = $path_parts['extension'];
        }
        if(strpos($custom_pdf_logo_image_url,'localhost') !== false){
             $cimg = $custom_pdf_logo_image_url;
        } else if(strpos($custom_pdf_logo_image_url,'http') === false){
            $cimg = FCPATH .$custom_pdf_logo_image_url;
        } else {
            // On some hosting providers you cant access directly the url and throwing error unable to get image size
            // Will simulate like browser access to get the image.
            $ch = curl_init();
            // set url
            curl_setopt($ch, CURLOPT_URL, $custom_pdf_logo_image_url);
            // Return the transfer as a image
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
            // $output contains the output image
            $output = curl_exec($ch);
            // close curl resource to free up system resources
            curl_close($ch);
            $cimg = 'data:image/' . $extension . ';base64,' . base64_encode($output);
        }
        $logo_url = '<a href="' . site_url() . '"><img width="'.get_option('pdf_logo_width').'px" src="' . $cimg . '"></a>';
    } else {
        $logo_url = '<a href="' . site_url() . '"><img width="'.get_option('pdf_logo_width').'px" src="' . COMPANY_FILES_FOLDER. get_option('company_logo') . '"></a>';
    }
    return $logo_url;
}
/**
 * Prepare general invoice pdf
 * @param  object $invoice Invoice as object with all necessary fields
 * @return mixed object
 */
function invoice_pdf($invoice, $tag = '')
{
    $CI =& get_instance();
    load_pdf_language($invoice->clientid);
    $CI->load->library('pdf');
    $invoice_number = format_invoice_number($invoice->id);
    $font_name = get_option('pdf_font');
    $font_size = get_option('pdf_font_size');
    if($font_size == ''){
        $font_size = 10;
    }

    $selected_format = strtoupper(get_option('pdf_format_invoice'));
    $format_short = ($selected_format == 'A4' ? 'P' : 'L');
    $pdf            = new Pdf($format_short, 'mm', $selected_format, true, 'UTF-8', false);

    $pdf->SetTitle($invoice_number);
    $CI->pdf->SetMargins(PDF_MARGIN_LEFT, 26, PDF_MARGIN_RIGHT);
    $CI->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $CI->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $CI->pdf->SetAutoPageBreak(TRUE, 30);
    $pdf->SetAuthor(get_option('company'));
    $pdf->SetFont($font_name, '', $font_size);
    $pdf->setJPEGQuality(100);
    $pdf->AddPage();
    if($CI->input->get('print') == 'true'){
        // force print dialog
        $js = 'print(true);';
        $pdf->IncludeJS($js);
    }
    $status = $invoice->status;
    $swap = get_option('swap_pdf_info');
    $CI->load->library('numberword',array('clientid'=>$invoice->clientid));
    if (file_exists(APPPATH . 'views/themes/' . active_clients_theme() . '/views/my_invoicepdf.php')) {
        include(APPPATH . 'views/themes/' . active_clients_theme() . '/views/my_invoicepdf.php');
    } else {
        include(APPPATH . 'views/themes/' . active_clients_theme() . '/views/invoicepdf.php');
    }
    return $pdf;
}
/**
 * Generate payment pdf
 * @since  Version 1.0.1
 * @param  object $payment All payment data
 * @return mixed object
 */
function payment_pdf($payment, $tag = '')
{
    $CI =& get_instance();
    load_pdf_language($payment->invoice_data->clientid);
    $CI->load->library('pdf');

    $selected_format = strtoupper(get_option('pdf_format_payment'));
    $format_short = ($selected_format == 'A4' ? 'P' : 'L');
    $pdf            = new Pdf($format_short, 'mm', $selected_format, true, 'UTF-8', false);

    $font_name = get_option('pdf_font');
    $font_size = get_option('pdf_font_size');
    if($font_size == ''){
        $font_size = 10;
    }
    $swap = get_option('swap_pdf_info');
    $pdf->SetTitle(_l('payment') . ' #' . $payment->id);
    $CI->pdf->SetMargins(PDF_MARGIN_LEFT, 26, PDF_MARGIN_RIGHT);
    $CI->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $CI->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $CI->pdf->SetAutoPageBreak(TRUE, 30);
    $pdf->setJPEGQuality(100);
    $pdf->SetAuthor(get_option('company'));
    $pdf->SetFont($font_name, '', $font_size);
    $pdf->AddPage();
     if($CI->input->get('print') == 'true'){
        // force print dialog
        $js = 'print(true);';
        $pdf->IncludeJS($js);
    }
    if (file_exists(APPPATH . 'views/themes/' . active_clients_theme() . '/views/my_paymentpdf.php')) {
        include(APPPATH . 'views/themes/' . active_clients_theme() . '/views/my_paymentpdf.php');
    } else {
        include(APPPATH . 'views/themes/' . active_clients_theme() . '/views/paymentpdf.php');
    }
    return $pdf;
}
/**
 * Prepare general estimate pdf
 * @since  Version 1.0.2
 * @param  object $estimate estimate as object with all necessary fields
 * @return mixed object
 */
function estimate_pdf($estimate, $tag = '')
{
    $CI =& get_instance();
    load_pdf_language($estimate->clientid);
    $CI->load->library('pdf');
    $estimate_number = format_estimate_number($estimate->id);
    $font_name = get_option('pdf_font');
    $font_size = get_option('pdf_font_size');
    if($font_size == ''){
        $font_size = 10;
    }

    $selected_format = strtoupper(get_option('pdf_format_estimate'));
    $format_short = ($selected_format == 'A4' ? 'P' : 'L');
    $pdf            = new Pdf($format_short, 'mm', $selected_format, true, 'UTF-8', false);

    $pdf->SetTitle($estimate_number);
    $CI->pdf->SetMargins(PDF_MARGIN_LEFT, 26, PDF_MARGIN_RIGHT);
    $CI->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $CI->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $CI->pdf->SetAutoPageBreak(TRUE, 30);
    $pdf->SetAuthor(get_option('company'));
    $pdf->SetFont($font_name, '', $font_size);
    $pdf->setJPEGQuality(100);
    $pdf->AddPage();
     if($CI->input->get('print') == 'true'){
        // force print dialog
        $js = 'print(true);';
        $pdf->IncludeJS($js);
    }
    $status = $estimate->status;
    $swap = get_option('swap_pdf_info');
    $CI->load->library('numberword',array('clientid'=>$estimate->clientid));
    if (file_exists(APPPATH . 'views/themes/' . active_clients_theme() . '/views/my_estimatepdf.php')) {
        include(APPPATH . 'views/themes/' . active_clients_theme() . '/views/my_estimatepdf.php');
    } else {
        include(APPPATH . 'views/themes/' . active_clients_theme() . '/views/estimatepdf.php');
    }
    return $pdf;
}
function proposal_pdf($proposal)
{
    $CI =& get_instance();
    if ($proposal->rel_id != NULL && $proposal->rel_type == 'customer') {
        load_pdf_language($proposal->rel_id);
    }
    $CI->load->library('pdf');

    $selected_format = strtoupper(get_option('pdf_format_proposal'));
    $format_short = ($selected_format == 'A4' ? 'P' : 'L');
    $pdf            = new Pdf($format_short, 'mm', $selected_format, true, 'UTF-8', false);

    $font_name = get_option('pdf_font');
    $font_size = get_option('pdf_font_size');
    if($font_size == ''){
        $font_size = 10;
    }

    $CI->pdf->SetMargins(PDF_MARGIN_LEFT, 26, PDF_MARGIN_RIGHT);
    $CI->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $CI->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->setImageScale(1.53);
    $pdf->SetAutoPageBreak(TRUE,0);
    $pdf->setJPEGQuality(100);
    $pdf->SetDisplayMode('default','OneColumn');
    $pdf->SetAuthor(get_option('company'));
    $pdf->SetFont($font_name, '', $font_size);
    $pdf->AddPage();
     if($CI->input->get('print') == 'true'){
        // force print dialog
        $js = 'print(true);';
        $pdf->IncludeJS($js);
    }
    $swap = get_option('swap_pdf_info');
    $CI->load->model('currencies_model');
    $total = '';
    if ($proposal->total != 0) {
        $total = format_money($proposal->total, $CI->currencies_model->get($proposal->currency)->symbol);
        $total = _l('proposal_total') . ': ' . $total;
    }
    # Dont remove these lines - important for the PDF layout
    // Add <br /> tag and wrap over div element every image to prevent overlaping over text
    $proposal->content = preg_replace('/(<img[^>]+>(?:<\/img>)?)/i', '<br><br><div>$1</div><br><br>', $proposal->content);
    // Add cellpadding to all tables inside the html
    $proposal->content = preg_replace('/(<table\b[^><]*)>/i', '$1 cellpadding="4">', $proposal->content);
    // Remove white spaces cased by the html editor ex. <td>  item</td>
    $proposal->content = preg_replace('/[\t\n\r\0\x0B]/', '', $proposal->content);
    $proposal->content = preg_replace('/([\s])\1+/', ' ', $proposal->content);
    if (file_exists(APPPATH . 'views/themes/' . active_clients_theme() . '/views/my_proposalpdf.php')) {
        include(APPPATH . 'views/themes/' . active_clients_theme() . '/views/my_proposalpdf.php');
    } else {
        include(APPPATH . 'views/themes/' . active_clients_theme() . '/views/proposalpdf.php');
    }
    return $pdf;
}
function get_estimates_percent_by_status($status,$total_estimates = ''){
    if(!is_numeric($total_estimates)){
        $total_estimates = total_rows('tblestimates');
    }
    $data = array();
    $data['total_by_status'] = total_rows('tblestimates',array('status'=>$status));
    $data['percent'] = ($total_estimates > 0 ? number_format(($data['total_by_status'] * 100) / $total_estimates,2) : 0);
    $data['total'] = $total_estimates;
    return $data;
}
function get_proposals_percent_by_status($status,$total_proposals = ''){
    if(!is_numeric($total_proposals)){
        $total_proposals = total_rows('tblproposals');
    }
    $data = array();
    $data['total_by_status'] = total_rows('tblproposals',array('status'=>$status));
    $data['percent'] = ($total_proposals  > 0 ? number_format(($data['total_by_status'] * 100) / $total_proposals  ,2) : 0);
    $data['total'] = $total_proposals;
    return $data;
}
