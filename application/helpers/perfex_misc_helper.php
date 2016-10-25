<?php
/**
 * On each update there is message/code inserted in the database
 */
function show_just_updated_message()
{
    if (get_option('update_info_message') != '') {
        if (is_admin()) {
            $message = get_option('update_info_message');
            update_option('update_info_message', '');
            echo $message;
        }
    }
}
/**
 * CHeck missing key from the main english language
 * @param  string $language language to check
 * @return void
 */
function check_missing_language_strings($language)
{
    $langs = array();
    $CI =& get_instance();
    $CI->lang->load('english_lang', 'english');
    $english       = $CI->lang->language;
    $langs[]       = array(
        'english' => $english
    );
    $original      = $english;
    $keys_original = array();
    foreach ($original as $k => $val) {
        $keys_original[$k] = true;
    }
    $CI->lang->is_loaded = array();
    $CI->lang->language  = array();
    $CI->lang->load($language . '_lang', $language);
    $$language           = $CI->lang->language;
    $langs[]             = array(
        $language => $$language
    );
    $CI->lang->is_loaded = array();
    $CI->lang->language  = array();
    $missing_keys        = array();
    for ($i = 0; $i < count($langs); $i++) {
        foreach ($langs[$i] as $lang => $data) {
            if ($lang != 'english') {
                $keys_current = array();
                foreach ($data as $k => $v) {
                    $keys_current[$k] = true;
                }
                foreach ($keys_original as $k_original => $val_original) {
                    if (!array_key_exists($k_original, $keys_current)) {
                        $keys_missing = true;
                        array_push($missing_keys, $k_original);
                        echo '<b>Missing language key</b> from language:' . $lang . ' - <b>key</b>:' . $k_original . '<br />';
                    }
                }
            }
        }
    }
    if (isset($keys_missing)) {
        echo '<br />--<br />Language keys missing please create <a href="https://www.perfexcrm.com/knowledgebase/overwrite-translation-text/" target="_blank">custom_lang.php</a> and add the keys listed above.';
        echo '<br /> Here is how you should add the keys (You can just copy paste this text above and add your translations)<br /><br />';
        foreach ($missing_keys as $key) {
            echo '$lang[\'' . $key . '\'] = \'Add your translation\';<br />';
        }
    } else {
        echo '<h1>No Missing Language Keys Found</h1>';
    }
    die;
}
/**
 * Parse email template with the merge fields
 * @param  mixed $template     template
 * @param  array  $merge_fields
 * @return object
 */
function parse_email_template($template, $merge_fields = array())
{
    $CI =& get_instance();
    if (!is_object($template) || $CI->input->post('template_name')) {
        if ($CI->input->post('template_name')) {
            $template = $CI->input->post('template_name');
        }
        $CI->db->where('slug', $template);
        $template = $CI->db->get('tblemailtemplates')->row();
        if ($CI->input->post('email_template_custom')) {
            $template->message = $CI->input->post('email_template_custom');
        }
    }
    $merge_fields = array_merge($merge_fields, get_other_merge_fields());
    foreach ($merge_fields as $key => $val) {
        if (stripos($template->message, $key) !== false) {
            $template->message = str_ireplace($key, $val, $template->message);
        } else {
            $template->message = str_ireplace($key, '', $template->message);
        }
        if (stripos($template->fromname, $key) !== false) {
            $template->fromname = str_ireplace($key, $val, $template->fromname);
        } else {
            $template->fromname = str_ireplace($key, '', $template->fromname);
        }
        if (stripos($template->subject, $key) !== false) {
            $template->subject = str_ireplace($key, $val, $template->subject);
        } else {
            $template->subject = str_ireplace($key, '', $template->subject);
        }
    }
    return $template;
}
/**
 * Format seconds to quantity
 * @param  mixed  $sec      total seconds
 * @return [integer]
 */
function sec2qty($sec)
{
    $seconds = $sec / 3600;
    return round($seconds, 2);
}
/**
 * Format seconds to hours/minutes or seconds
 * @param  mixed $seconds
 * @return mixed
 */
function format_seconds($seconds)
{
    $minutes = $seconds / 60;
    $hours   = $minutes / 60;
    if ($minutes >= 60) {
        return round($hours, 2) . ' ' . _l('hours');
    } elseif ($seconds > 60) {
        return round($minutes, 2) . ' ' . _l('minutes');
    } else {
        return $seconds . ' ' . _l('seconds');
    }
}
/**
 * Get system favourite colors
 * @return array
 */
function get_system_favourite_colors()
{
    // dont delete any of these colors are used all over the system
    $colors = array(
        '#28B8DA',
        '#03a9f4',
        '#c53da9',
        '#757575',
        '#8e24aa',
        '#d81b60',
        '#0288d1',
        '#7cb342',
        '#fb8c00',
        '#84C529'
    );
    $colors = do_action('get_kan_ban_colors', $colors);
    return $colors;
}
function get_goal_types()
{
    $types = array(
        array(
            'key' => 1,
            'lang_key' => 'goal_type_total_income',
            'subtext' => 'goal_type_income_subtext'
        ),
        array(
            'key' => 2,
            'lang_key' => 'goal_type_convert_leads'
        ),
        array(
            'key' => 3,
            'lang_key' => 'goal_type_increase_customers_without_leads_conversions',
            'subtext' => 'goal_type_increase_customers_without_leads_conversions_subtext'
        ),
        array(
            'key' => 4,
            'lang_key' => 'goal_type_increase_customers_with_leads_conversions',
            'subtext' => 'goal_type_increase_customers_with_leads_conversions_subtext'
        ),
        array(
            'key' => 5,
            'lang_key' => 'goal_type_make_contracts_by_type_calc_database',
            'subtext' => 'goal_type_make_contracts_by_type_calc_database_subtext'
        ),
        array(
            'key' => 7,
            'lang_key' => 'goal_type_make_contracts_by_type_calc_date',
            'subtext' => 'goal_type_make_contracts_by_type_calc_date_subtext'
        ),
        array(
            'key' => 6,
            'lang_key' => 'goal_type_total_estimates_converted',
            'subtext' => 'goal_type_total_estimates_converted_subtext'
        )
    );
    return do_action('get_goal_types', $types);
}
function format_goal_type($key)
{
    foreach (get_goal_types() as $type) {
        if ($type['key'] == $key) {
            return _l($type['lang_key']);
        }
    }
    return $type;
}
/**
 * Set session alert / flashdata
 * @param string $type    Alert type
 * @param string $message Alert message
 */
function set_alert($type, $message)
{
    $CI =& get_instance();
    $CI->session->set_flashdata('message-' . $type, $message);
}
/**
 * Redirect to blank page
 * @param  string $message Alert message
 * @param  string $alert   Alert type
 */
function blank_page($message = '', $alert = 'danger')
{
    set_alert($alert, $message);
    redirect(admin_url('not_found'));
}
/**
 * Redirect to access danied page and log activity
 * @param  string $permission If permission based to check where user tried to acces
 */
function access_denied($permission = '')
{
    set_alert('danger', _l('access_denied'));
    logActivity('Tried to access page where dont have permission [' . $permission . ']');
    if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
        redirect($_SERVER['HTTP_REFERER']);
    } else {
        redirect(admin_url('access_denied'));
    }
}
/**
 * Set debug message - message wont be hidden in X seconds from javascript
 * @since  Version 1.0.1
 * @param string $message debug message
 */
function set_debug_alert($message)
{
    $CI =& get_instance();
    $CI->session->set_flashdata('debug', $message);
}
/**
 * Available date formats
 * @return array
 */
function get_available_date_formats()
{
    $date_formats = array(
        'd-m-Y|%d-%m-%Y' => 'd-m-Y',
        'd/m/Y|%d/%m/%Y' => 'd/m/Y',
        'm-d-Y|%m-%d-%Y' => 'm-d-Y',
        'm.d.Y|%m.%d.%Y' => 'm.d.Y',
        'm/d/Y|%m/%d/%Y' => 'm/d/Y',
        'Y-m-d|%Y-%m-%d' => 'Y-m-d',
        'd.m.Y|%d.%m.%Y' => 'd.m.Y'
    );
    return do_action('get_available_date_formats', $date_formats);
}
/**
 * Get weekdays as array
 * @return array
 */
function get_weekdays()
{
    return array(
        _l('wd_monday'),
        _l('wd_tuesday'),
        _l('wd_wednesday'),
        _l('wd_thursday'),
        _l('wd_friday'),
        _l('wd_saturday'),
        _l('wd_sunday')
    );
}
/**
 * Get non translated week days for query help
 * @return array
 */
function get_weekdays_original()
{
    return array(
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday'
    );
}
/**
 * Format datetime to time ago with specific hours mins and seconds
 * @param  datetime $lastreply
 * @param  string $from      Optional
 * @return mixed
 */
function time_ago_specific($date, $from = "now")
{
    $datetime   = strtotime("now");
    $date2      = strtotime("" . $date);
    $holdtotsec = $datetime - $date2;
    $holdtotmin = ($datetime - $date2) / 60;
    $holdtothr  = ($datetime - $date2) / 3600;
    $holdtotday = intval(($datetime - $date2) / 86400);
    $str        = '';
    if (0 < $holdtotday) {
        $str .= $holdtotday . "d ";
    }
    $holdhr = intval($holdtothr - $holdtotday * 24);
    $str .= $holdhr . "h ";
    $holdmr = intval($holdtotmin - ($holdhr * 60 + $holdtotday * 1440));
    $str .= $holdmr . "m";
    return $str;
}
/**
 * Short Time ago function
 * @param  datetime $time_ago
 * @return mixed
 */
function time_ago($time_ago)
{
    $time_ago     = strtotime($time_ago);
    $cur_time     = time();
    $time_elapsed = $cur_time - $time_ago;
    $seconds      = $time_elapsed;
    $minutes      = round($time_elapsed / 60);
    $hours        = round($time_elapsed / 3600);
    $days         = round($time_elapsed / 86400);
    $weeks        = round($time_elapsed / 604800);
    $months       = round($time_elapsed / 2600640);
    $years        = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        return _l('time_ago_just_now');
    }
    //Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            return _l('time_ago_minute');
        } else {
            return _l('time_ago_minutes', $minutes);
        }
    }
    //Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            return _l('time_ago_hour');
        } else {
            return _l('time_ago_hours', $hours);
        }
    }
    //Days
    else if ($days <= 7) {
        if ($days == 1) {
            return _l('time_ago_yesterday');
        } else {
            return _l('time_ago_days', $days);
        }
    }
    //Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            return _l('time_ago_week');
        } else {
            return _l('time_ago_weeks', $weeks);
        }
    }
    //Months
    else if ($months <= 12) {
        if ($months == 1) {
            return _l('time_ago_month');
        } else {
            return _l('time_ago_months', $months);
        }
    }
    //Years
    else {
        if ($years == 1) {
            return _l('time_ago_year');
        } else {
            return _l('time_ago_years', $years);
        }
    }
}
/**
 * Helper function to get text question answers
 * @param  integer $questionid
 * @param  itneger $surveyid
 * @return array
 */
function get_text_question_answers($questionid, $surveyid)
{
    $CI =& get_instance();
    $CI->db->select('answer,resultid');
    $CI->db->from('tblsurveyresults');
    $CI->db->where('questionid', $questionid);
    $CI->db->where('surveyid', $surveyid);
    return $CI->db->get()->result_array();
}
/**
 * Get department email address
 * @param  mixed $id department id
 * @return mixed
 */
function get_department_email($id)
{
    $CI =& get_instance();
    $CI->db->where('departmentid', $id);
    return $CI->db->get('tbldepartments')->row()->email;
}
/**
 * Helper function to get all knowledbase groups
 * @return array
 */
function get_kb_groups()
{
    $CI =& get_instance();
    return $CI->db->get('tblknowledgebasegroups')->result_array();
}
/**
 * Get all countries stored in database
 * @return array
 */
function get_all_countries()
{
    $CI =& get_instance();
    return $CI->db->get('tblcountries')->result_array();
}
function get_country($id){
    $CI =& get_instance();
    $CI->db->where('country_id',$id);
    return $CI->db->get('tblcountries')->row();
}
/**
 * Get country short name by passed id
 * @param  mixed $id county id
 * @return mixed
 */
function get_country_short_name($id)
{
    $CI =& get_instance();
    $CI->db->where('country_id', $id);
    $country = $CI->db->get('tblcountries')->row();
    if ($country) {
        return $country->iso2;
    }
    return '';
}
function contract_pdf($contract)
{
    $CI =& get_instance();
    $CI->load->library('pdf');
    $selected_format = strtoupper(get_option('pdf_format_contract'));
    $format_short    = ($selected_format == 'A4' ? 'P' : 'L');
    $pdf             = new Pdf($format_short, 'mm', $selected_format, true, 'UTF-8', false);
    $font_name       = get_option('pdf_font');
    $font_size       = get_option('pdf_font_size');
    if ($font_size == '') {
        $font_size = 10;
    }
    $CI->pdf->SetMargins(PDF_MARGIN_LEFT, 26, PDF_MARGIN_RIGHT);
    $CI->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $CI->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $CI->pdf->SetAutoPageBreak(TRUE, 30);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    $pdf->SetAuthor(get_option('company'));
    $pdf->SetFont($font_name, '', $font_size);
    $pdf->AddPage();
    if ($CI->input->get('print') == 'true') {
        // force print dialog
        $js = 'print(true);';
        $pdf->IncludeJS($js);
    }
    # Dont remove these lines - important for the PDF layout
    // Add <br /> tag and wrap over div element every image to prevent overlaping over text
    $contract->content = preg_replace('/(<img[^>]+>(?:<\/img>)?)/i', '<br><br><div>$1</div><br><br>', $contract->content);
    // Add cellpadding to all tables inside the html
    $contract->content = preg_replace('/(<table\b[^><]*)>/i', '$1 cellpadding="4">', $contract->content);
    // Remove white spaces cased by the html editor ex. <td>  item</td>
    $contract->content = preg_replace('/[\t\n\r\0\x0B]/', '', $contract->content);
    $contract->content = preg_replace('/([\s])\1+/', ' ', $contract->content);
    if (file_exists(APPPATH . 'views/themes/' . active_clients_theme() . '/views/my_contractpdf.php')) {
        include(APPPATH . 'views/themes/' . active_clients_theme() . '/views/my_contractpdf.php');
    } else {
        include(APPPATH . 'views/themes/' . active_clients_theme() . '/views/contractpdf.php');
    }
    return $pdf;
}
/**
 * Helper function to get all knowledge base groups in the parents groups
 * @param  boolean $include_inactive inactive groups all articles if passed true
 * @return array
 */
function get_all_knowledge_base_articles_grouped()
{
    $CI =& get_instance();
    $CI->load->model('knowledge_base_model');
    $groups = $CI->knowledge_base_model->get_kbg('', 1);
    $i      = 0;
    foreach ($groups as $group) {
        $CI->db->select('slug,subject,description,tblknowledgebase.active as active_article,articlegroup,articleid');
        $CI->db->from('tblknowledgebase');
        $CI->db->where('articlegroup', $group['groupid']);
        $CI->db->order_by('article_order', 'asc');
        $articles = $CI->db->get()->result_array();
        if (count($articles) == 0) {
            unset($groups[$i]);
            $i++;
            continue;
        }
        $groups[$i]['articles'] = $articles;
        $i++;
    }
    return $groups;
}
/**
 * Helper function to get all announcements for user
 * @param  boolean $staff Is this client or staff
 * @return array
 */
function get_announcements_for_user($staff = true)
{
    if (!is_logged_in()) {
        return array();
    }
    $CI =& get_instance();
    $CI->db->select('firstname,lastname,announcementid,name,message,showtousers,showtostaff,showname,tblannouncements.dateadded,tblannouncements.userid')->join('tblstaff', 'tblstaff.staffid = tblannouncements.userid', 'left')->from('tblannouncements');
    $announcements = $CI->db->get()->result_array();
    $i             = 0;
    foreach ($announcements as $annoucement) {
        if ($staff == true) {
            if ($annoucement['showtostaff'] != 1) {
                unset($announcements[$i]);
            }
        } else {
            if ($annoucement['showtousers'] != 1) {
                unset($announcements[$i]);
            }
        }
        $i++;
    }
    // Refresh array keys
    $announcements = array_values($announcements);
    if ($staff == true) {
        $userid = get_staff_user_id();
    } else {
        $userid = get_contact_user_id();
    }
    $i = 0;
    foreach ($announcements as $announcement) {
        $CI->db->where('announcementid', $announcement['announcementid']);
        $CI->db->where('staff', $staff);
        $CI->db->where('userid', $userid);
        $dismissed = $CI->db->get('tbldismissedannouncements')->row();
        if ($dismissed) {
            unset($announcements[$i]);
        }
        $i++;
    }
    return $announcements;
}
/*
function mode_alami(){
    $CI =& get_instance();

    $CI->db->where('email','i.ab@deepmaroc.com');

    $name = $CI->db->get('tblstaff')->result_array();

    return $name;//['firstname'].' '.$name=['lastname_alami'];
}

function get_mode($id){
    $CI =& get_instance();

    $CI->db->where('userid',$id);

    $mode = $CI->db->get('tblclients')->result_array();

    return $mode ;
}*/
/**
 * Slug function
 * @param  string $str
 * @param  array  $options Additional Options
 * @return mixed
 */
function slug_it($str, $options = array())
{
    // Make sure string is in UTF-8 and strip invalid UTF-8 characters
    $str      = mb_convert_encoding((string) $str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(
            '
            /\b(ѓ)\b/i' => 'gj',
            '/\b(ч)\b/i' => 'ch',
            '/\b(ш)\b/i' => 'sh',
            '/\b(љ)\b/i' => 'lj'
        ),
        'transliterate' => true
    );
    // Merge options
    $options  = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A',
        'Á' => 'A',
        'Â' => 'A',
        'Ã' => 'A',
        'Ä' => 'A',
        'Å' => 'A',
        'Æ' => 'AE',
        'Ç' => 'C',
        'È' => 'E',
        'É' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Ì' => 'I',
        'Í' => 'I',
        'Î' => 'I',
        'Ï' => 'I',
        'Ð' => 'D',
        'Ñ' => 'N',
        'Ò' => 'O',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ö' => 'O',
        'Ő' => 'O',
        'Ø' => 'O',
        'Ù' => 'U',
        'Ú' => 'U',
        'Û' => 'U',
        'Ü' => 'U',
        'Ű' => 'U',
        'Ý' => 'Y',
        'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a',
        'á' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'ä' => 'a',
        'å' => 'a',
        'æ' => 'ae',
        'ç' => 'c',
        'è' => 'e',
        'é' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'ì' => 'i',
        'í' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ð' => 'd',
        'ñ' => 'n',
        'ò' => 'o',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'o',
        'ő' => 'o',
        'ø' => 'o',
        'ù' => 'u',
        'ú' => 'u',
        'û' => 'u',
        'ü' => 'u',
        'ű' => 'u',
        'ý' => 'y',
        'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A',
        'Β' => 'B',
        'Γ' => 'G',
        'Δ' => 'D',
        'Ε' => 'E',
        'Ζ' => 'Z',
        'Η' => 'H',
        'Θ' => '8',
        'Ι' => 'I',
        'Κ' => 'K',
        'Λ' => 'L',
        'Μ' => 'M',
        'Ν' => 'N',
        'Ξ' => '3',
        'Ο' => 'O',
        'Π' => 'P',
        'Ρ' => 'R',
        'Σ' => 'S',
        'Τ' => 'T',
        'Υ' => 'Y',
        'Φ' => 'F',
        'Χ' => 'X',
        'Ψ' => 'PS',
        'Ω' => 'W',
        'Ά' => 'A',
        'Έ' => 'E',
        'Ί' => 'I',
        'Ό' => 'O',
        'Ύ' => 'Y',
        'Ή' => 'H',
        'Ώ' => 'W',
        'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a',
        'β' => 'b',
        'γ' => 'g',
        'δ' => 'd',
        'ε' => 'e',
        'ζ' => 'z',
        'η' => 'h',
        'θ' => '8',
        'ι' => 'i',
        'κ' => 'k',
        'λ' => 'l',
        'μ' => 'm',
        'ν' => 'n',
        'ξ' => '3',
        'ο' => 'o',
        'π' => 'p',
        'ρ' => 'r',
        'σ' => 's',
        'τ' => 't',
        'υ' => 'y',
        'φ' => 'f',
        'χ' => 'x',
        'ψ' => 'ps',
        'ω' => 'w',
        'ά' => 'a',
        'έ' => 'e',
        'ί' => 'i',
        'ό' => 'o',
        'ύ' => 'y',
        'ή' => 'h',
        'ώ' => 'w',
        'ς' => 's',
        'ϊ' => 'i',
        'ΰ' => 'y',
        'ϋ' => 'y',
        'ΐ' => 'i',
        // Turkish
        'Ş' => 'S',
        'İ' => 'I',
        'Ç' => 'C',
        'Ü' => 'U',
        'Ö' => 'O',
        'Ğ' => 'G',
        'ş' => 's',
        'ı' => 'i',
        'ç' => 'c',
        'ü' => 'u',
        'ö' => 'o',
        'ğ' => 'g',
        // Russian
        'А' => 'A',
        'Б' => 'B',
        'В' => 'V',
        'Г' => 'G',
        'Д' => 'D',
        'Е' => 'E',
        'Ё' => 'Yo',
        'Ж' => 'Zh',
        'З' => 'Z',
        'И' => 'I',
        'Й' => 'J',
        'К' => 'K',
        'Л' => 'L',
        'М' => 'M',
        'Н' => 'N',
        'О' => 'O',
        'П' => 'P',
        'Р' => 'R',
        'С' => 'S',
        'Т' => 'T',
        'У' => 'U',
        'Ф' => 'F',
        'Х' => 'H',
        'Ц' => 'C',
        'Ч' => 'Ch',
        'Ш' => 'Sh',
        'Щ' => 'Sh',
        'Ъ' => '',
        'Ы' => 'Y',
        'Ь' => '',
        'Э' => 'E',
        'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'yo',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'j',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'c',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sh',
        'ъ' => '',
        'ы' => 'y',
        'ь' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye',
        'І' => 'I',
        'Ї' => 'Yi',
        'Ґ' => 'G',
        'є' => 'ye',
        'і' => 'i',
        'ї' => 'yi',
        'ґ' => 'g',
        // Czech
        'Č' => 'C',
        'Ď' => 'D',
        'Ě' => 'E',
        'Ň' => 'N',
        'Ř' => 'R',
        'Š' => 'S',
        'Ť' => 'T',
        'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c',
        'ď' => 'd',
        'ě' => 'e',
        'ň' => 'n',
        'ř' => 'r',
        'š' => 's',
        'ť' => 't',
        'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A',
        'Ć' => 'C',
        'Ę' => 'e',
        'Ł' => 'L',
        'Ń' => 'N',
        'Ó' => 'o',
        'Ś' => 'S',
        'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a',
        'ć' => 'c',
        'ę' => 'e',
        'ł' => 'l',
        'ń' => 'n',
        'ó' => 'o',
        'ś' => 's',
        'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A',
        'Č' => 'C',
        'Ē' => 'E',
        'Ģ' => 'G',
        'Ī' => 'i',
        'Ķ' => 'k',
        'Ļ' => 'L',
        'Ņ' => 'N',
        'Š' => 'S',
        'Ū' => 'u',
        'Ž' => 'Z',
        'ā' => 'a',
        'č' => 'c',
        'ē' => 'e',
        'ģ' => 'g',
        'ī' => 'i',
        'ķ' => 'k',
        'ļ' => 'l',
        'ņ' => 'n',
        'š' => 's',
        'ū' => 'u',
        'ž' => 'z'
    );
    // Make custom replacements
    $str      = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    // Transliterate characters to ASCII
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    // Replace non-alphanumeric characters with our delimiter
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    // Remove duplicate delimiters
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    // Truncate slug to max. characters
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    // Remove delimiter from ends
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}
/**
 * Get string bettween words
 * @param  string $string the string to get from
 * @param  string $start  where to start
 * @param  string $end    where to end
 * @return string formated string
 */
function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $ini    = strpos($string, $start);
    if ($ini == 0)
        return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
/**
 * Get projcet billing type
 * @param  mixed $project_id
 * @return mixed
 */
function get_project_billing_type($project_id)
{
    $CI =& get_instance();
    $CI->db->where('id', $project_id);
    $project = $CI->db->get('tblprojects')->row();
    if ($project) {
        return $project->billing_type;
    }
    return false;
}
/**
 * Get client id by lead id
 * @since  Version 1.0.1
 * @param  mixed $id lead id
 * @return mixed     client id
 */
function get_client_id_by_lead_id($id)
{
    $CI =& get_instance();
    $CI->db->select('userid')->from('tblclients')->where('leadid', $id);
    return $CI->db->get()->row()->userid;
}
/**
 * Check if the user is lead creator
 * @since  Version 1.0.4
 * @param  mixed  $leadid leadid
 * @param  mixed  $id staff id (Optional)
 * @return boolean
 */
function is_lead_creator($leadid, $id = '')
{
    if (!is_numeric($id)) {
        $id = get_staff_user_id();
    }
    $is = total_rows('tblleads', array(
        'addedfrom' => $id,
        'id' => $leadid
    ));
    if ($is > 0) {
        return true;
    }
    return false;
}
/**
 * When ticket will be opened automatically set to open
 * @param integer  $current Current status
 * @param integer  $id      ticketid
 * @param boolean $admin   Admin opened or client opened
 */
function set_ticket_open($current, $id, $admin = true)
{
    if ($current == 1) {
        return;
    }
    $CI =& get_instance();
    $CI->db->where('ticketid', $id);
    $field = 'adminread';
    if ($admin == false) {
        $field = 'clientread';
    }
    $CI->db->update('tbltickets', array(
        $field => 1
    ));
}
/**
 * Get timezones list
 * @return array timezones
 */
function get_timezones_list()
{
    return $timezones = array(
        'Pacific/Midway' => "(GMT-11:00) Midway Island",
        'US/Samoa' => "(GMT-11:00) Samoa",
        'US/Hawaii' => "(GMT-10:00) Hawaii",
        'US/Alaska' => "(GMT-09:00) Alaska",
        'US/Pacific' => "(GMT-08:00) Pacific Time (US &amp; Canada)",
        'America/Tijuana' => "(GMT-08:00) Tijuana",
        'US/Arizona' => "(GMT-07:00) Arizona",
        'US/Mountain' => "(GMT-07:00) Mountain Time (US &amp; Canada)",
        'America/Chihuahua' => "(GMT-07:00) Chihuahua",
        'America/Mazatlan' => "(GMT-07:00) Mazatlan",
        'America/Mexico_City' => "(GMT-06:00) Mexico City",
        'America/Monterrey' => "(GMT-06:00) Monterrey",
        'Canada/Saskatchewan' => "(GMT-06:00) Saskatchewan",
        'US/Central' => "(GMT-06:00) Central Time (US &amp; Canada)",
        'US/Eastern' => "(GMT-05:00) Eastern Time (US &amp; Canada)",
        'US/East-Indiana' => "(GMT-05:00) Indiana (East)",
        'America/Bogota' => "(GMT-05:00) Bogota",
        'America/Lima' => "(GMT-05:00) Lima",
        'America/Caracas' => "(GMT-04:30) Caracas",
        'Canada/Atlantic' => "(GMT-04:00) Atlantic Time (Canada)",
        'America/La_Paz' => "(GMT-04:00) La Paz",
        'America/Santiago' => "(GMT-04:00) Santiago",
        'Canada/Newfoundland' => "(GMT-03:30) Newfoundland",
        'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
        'Greenland' => "(GMT-03:00) Greenland",
        'Atlantic/Stanley' => "(GMT-02:00) Stanley",
        'Atlantic/Azores' => "(GMT-01:00) Azores",
        'Atlantic/Cape_Verde' => "(GMT-01:00) Cape Verde Is.",
        'Africa/Casablanca' => "(GMT) Casablanca",
        'Europe/Dublin' => "(GMT) Dublin",
        'Europe/Lisbon' => "(GMT) Lisbon",
        'Europe/London' => "(GMT) London",
        'Africa/Monrovia' => "(GMT) Monrovia",
        'Europe/Amsterdam' => "(GMT+01:00) Amsterdam",
        'Europe/Belgrade' => "(GMT+01:00) Belgrade",
        'Europe/Berlin' => "(GMT+01:00) Berlin",
        'Europe/Bratislava' => "(GMT+01:00) Bratislava",
        'Europe/Brussels' => "(GMT+01:00) Brussels",
        'Europe/Budapest' => "(GMT+01:00) Budapest",
        'Europe/Copenhagen' => "(GMT+01:00) Copenhagen",
        'Europe/Ljubljana' => "(GMT+01:00) Ljubljana",
        'Europe/Madrid' => "(GMT+01:00) Madrid",
        'Europe/Paris' => "(GMT+01:00) Paris",
        'Europe/Prague' => "(GMT+01:00) Prague",
        'Europe/Rome' => "(GMT+01:00) Rome",
        'Europe/Sarajevo' => "(GMT+01:00) Sarajevo",
        'Europe/Skopje' => "(GMT+01:00) Skopje",
        'Europe/Stockholm' => "(GMT+01:00) Stockholm",
        'Europe/Vienna' => "(GMT+01:00) Vienna",
        'Europe/Warsaw' => "(GMT+01:00) Warsaw",
        'Europe/Zagreb' => "(GMT+01:00) Zagreb",
        'Europe/Athens' => "(GMT+02:00) Athens",
        'Europe/Bucharest' => "(GMT+02:00) Bucharest",
        'Africa/Cairo' => "(GMT+02:00) Cairo",
        'Africa/Harare' => "(GMT+02:00) Harare",
        'Europe/Helsinki' => "(GMT+02:00) Helsinki",
        'Europe/Istanbul' => "(GMT+02:00) Istanbul",
        'Asia/Jerusalem' => "(GMT+02:00) Jerusalem",
        'Europe/Kiev' => "(GMT+02:00) Kyiv",
        'Europe/Minsk' => "(GMT+02:00) Minsk",
        'Europe/Riga' => "(GMT+02:00) Riga",
        'Europe/Sofia' => "(GMT+02:00) Sofia",
        'Europe/Tallinn' => "(GMT+02:00) Tallinn",
        'Europe/Vilnius' => "(GMT+02:00) Vilnius",
        'Asia/Baghdad' => "(GMT+03:00) Baghdad",
        'Asia/Kuwait' => "(GMT+03:00) Kuwait",
        'Africa/Nairobi' => "(GMT+03:00) Nairobi",
        'Asia/Riyadh' => "(GMT+03:00) Riyadh",
        'Europe/Moscow' => "(GMT+03:00) Moscow",
        'Asia/Tehran' => "(GMT+03:30) Tehran",
        'Asia/Baku' => "(GMT+04:00) Baku",
        'Europe/Volgograd' => "(GMT+04:00) Volgograd",
        'Asia/Muscat' => "(GMT+04:00) Muscat",
        'Asia/Tbilisi' => "(GMT+04:00) Tbilisi",
        'Asia/Yerevan' => "(GMT+04:00) Yerevan",
        'Asia/Kabul' => "(GMT+04:30) Kabul",
        'Asia/Karachi' => "(GMT+05:00) Karachi",
        'Asia/Tashkent' => "(GMT+05:00) Tashkent",
        'Asia/Kolkata' => "(GMT+05:30) Kolkata",
        'Asia/Kathmandu' => "(GMT+05:45) Kathmandu",
        'Asia/Yekaterinburg' => "(GMT+06:00) Ekaterinburg",
        'Asia/Almaty' => "(GMT+06:00) Almaty",
        'Asia/Dhaka' => "(GMT+06:00) Dhaka",
        'Asia/Novosibirsk' => "(GMT+07:00) Novosibirsk",
        'Asia/Bangkok' => "(GMT+07:00) Bangkok",
        'Asia/Jakarta' => "(GMT+07:00) Jakarta",
        'Asia/Krasnoyarsk' => "(GMT+08:00) Krasnoyarsk",
        'Asia/Chongqing' => "(GMT+08:00) Chongqing",
        'Asia/Hong_Kong' => "(GMT+08:00) Hong Kong",
        'Asia/Kuala_Lumpur' => "(GMT+08:00) Kuala Lumpur",
        'Australia/Perth' => "(GMT+08:00) Perth",
        'Asia/Singapore' => "(GMT+08:00) Singapore",
        'Asia/Taipei' => "(GMT+08:00) Taipei",
        'Asia/Ulaanbaatar' => "(GMT+08:00) Ulaan Bataar",
        'Asia/Urumqi' => "(GMT+08:00) Urumqi",
        'Asia/Irkutsk' => "(GMT+09:00) Irkutsk",
        'Asia/Seoul' => "(GMT+09:00) Seoul",
        'Asia/Tokyo' => "(GMT+09:00) Tokyo",
        'Australia/Adelaide' => "(GMT+09:30) Adelaide",
        'Australia/Darwin' => "(GMT+09:30) Darwin",
        'Asia/Yakutsk' => "(GMT+10:00) Yakutsk",
        'Australia/Brisbane' => "(GMT+10:00) Brisbane",
        'Australia/Canberra' => "(GMT+10:00) Canberra",
        'Pacific/Guam' => "(GMT+10:00) Guam",
        'Australia/Hobart' => "(GMT+10:00) Hobart",
        'Australia/Melbourne' => "(GMT+10:00) Melbourne",
        'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
        'Australia/Sydney' => "(GMT+10:00) Sydney",
        'Asia/Vladivostok' => "(GMT+11:00) Vladivostok",
        'Asia/Magadan' => "(GMT+12:00) Magadan",
        'Pacific/Auckland' => "(GMT+12:00) Auckland",
        'Pacific/Fiji' => "(GMT+12:00) Fiji"
    );
}
function get_locales()
{
    $locales = array(
        "Arabic" => 'ar',
        "Bulgarian" => 'bg',
        "Catalan" => 'ca',
        "Czech" => 'cs',
        "Danish" => 'da',
        "German" => 'de',
        "Deutsch" => 'de',
        'Dutch' => 'de',
        "Greek" => 'el',
        "English" => 'en',
        "Spanish" => 'es',
        "Persian" => 'fa',
        "Finnish" => 'fi',
        "French" => 'fr',
        "Hebrew" => 'he',
        'Indonesian' => 'id',
        "Hindi" => 'hi',
        "Croatian" => 'hr',
        "Hungarian" => 'hu',
        "Indonesian" => 'id',
        "Icelandic" => 'is',
        "Italian" => 'it',
        "Japanese" => 'ja',
        "Korean" => 'ko',
        "Lithuanian" => 'lt',
        "Latvian" => 'lv',
        "Norwegian" => 'nb',
        "Dutch" => 'nl',
        "Polish" => 'pl',
        "Portuguese" => 'pt',
        "Romanian" => 'ro',
        "Russian" => 'ru',
        "Slovak" => 'sk',
        "Slovenian" => 'sl',
        "Serbian" => 'sr',
        "Swedish" => 'sv',
        "Thai" => 'th',
        "Turkish" => 'tr',
        "Ukrainian" => 'uk',
        "Vietnamese" => 'vi'
    );
    $locales = do_action('before_get_locales', $locales);
    return $locales;
}
function get_tinymce_language($locale)
{
    $av_lang = list_files(FCPATH . 'assets/plugins/tinymce/langs/');
    $_lang   = '';
    if ($locale == 'en') {
        return $_lang;
    }
    foreach ($av_lang as $lang) {
        $_temp_lang = explode('.', $lang);
        if ($locale == $_temp_lang[0]) {
            return $locale;
        } else if ($locale . '_' . strtoupper($locale) == $_temp_lang[0]) {
            return $locale . '_' . strtoupper($locale);
        }
    }
    return $_lang;
}
function get_permission_conditions()
{
    return array(
        'contracts' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        ),
        'tasks' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true,
            'help' => _l('help_tasks_permissions')
        ),
        'reports' => array(
            'view' => true,
            'edit' => false,
            'create' => false,
            'delete' => false
        ),
        'settings' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        ),
        'projects' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true,
            'help' => _l('help_project_permissions')
        ),
        'surveys' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        ),
        'staff' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => false
        ),
        'customers' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        ),
        'email_templates' => array(
            'view' => true,
            'edit' => true,
            'create' => false,
            'delete' => false
        ),
        'roles' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        ),
        'manageDepartments' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        ),
        'expenses' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        ),
        'bulk_pdf_exporter' => array(
            'view' => true,
            'edit' => false,
            'create' => false,
            'delete' => false
        ),
        'goals' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        ),
        'knowledge_base' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        ),
        'proposals' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        ),
        'estimates' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        ),
        'payments' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        ),
        'invoices' => array(
            'view' => true,
            'edit' => true,
            'create' => true,
            'delete' => true
        )
    );
}
function get_datatables_language_array()
{
    $lang = array(
        'emptyTable' => preg_replace("/{(\d+)}/", _l("dt_entries"), _l("dt_empty_table")),
        'info' => preg_replace("/{(\d+)}/", _l("dt_entries"), _l("dt_info")),
        'infoEmpty' => preg_replace("/{(\d+)}/", _l("dt_entries"), _l("dt_info_empty")),
        'infoFiltered' => preg_replace("/{(\d+)}/", _l("dt_entries"), _l("dt_info_filtered")),
        'lengthMenu' => preg_replace("/{(\d+)}/", _l("dt_entries"), _l("dt_length_menu")),
        'loadingRecords' => _l('dt_loading_records'),
        'processing' => '<div class="dt-loader"></div>',
        'search' => '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>',
        'searchPlaceholder' => _l('dt_search'),
        'zeroRecords' => _l('dt_zero_records'),
        'paginate' => array(
            'first' => _l('dt_paginate_first'),
            'last' => _l('dt_paginate_last'),
            'next' => _l('dt_paginate_next'),
            'previous' => _l('dt_paginate_previous')
        ),
        'aria' => array(
            'sortAscending' => _l('dt_sort_ascending'),
            'sortDescending' => _l('dt_sort_descending')
        )
    );
    return $lang;
}
function get_project_discussions_language_array()
{
    $lang = array(
        'discussion_add_comment' => _l('discussion_add_comment'),
        'discussion_newest' => _l('discussion_newest'),
        'discussion_oldest' => _l('discussion_oldest'),
        'discussion_attachments' => _l('discussion_attachments'),
        'discussion_send' => _l('discussion_send'),
        'discussion_reply' => _l('discussion_reply'),
        'discussion_edit' => _l('discussion_edit'),
        'discussion_edited' => _l('discussion_edited'),
        'discussion_you' => _l('discussion_you'),
        'discussion_save' => _l('discussion_save'),
        'discussion_delete' => _l('discussion_delete'),
        'discussion_view_all_replies' => _l('discussion_view_all_replies'),
        'discussion_hide_replies' => _l('discussion_hide_replies'),
        'discussion_no_comments' => _l('discussion_no_comments'),
        'discussion_no_attachments' => _l('discussion_no_attachments'),
        'discussion_attachments_drop' => _l('discussion_attachments_drop')
    );
    return $lang;
}
function render_admin_js_variables()
{
    $date_format = get_option('dateformat');
    $date_format = explode('|', $date_format);
    $date_format = $date_format[0];
    $js_vars     = array(
        'site_url' => site_url(),
        'admin_url' => admin_url(),
        'maximum_allowed_ticket_attachments' => get_option('maximum_allowed_ticket_attachments'),
        'auto_check_for_new_notifications' => get_option('auto_check_for_new_notifications'),
        'use_services' => get_option('services'),
        'tables_pagination_limit' => get_option('tables_pagination_limit'),
        'newsfeed_maximum_files_upload' => get_option('newsfeed_maximum_files_upload'),
        'newsfeed_maximum_file_size' => get_option('newsfeed_maximum_file_size'),
        'date_format' => $date_format,
        'decimal_separator' => get_option('decimal_separator'),
        'thousand_separator' => get_option('thousand_separator'),
        'currency_placement' => get_option('currency_placement'),
        'drop_files_here_to_upload' => _l('drop_files_here_to_upload'),
        'browser_not_support_drag_and_drop' => _l('browser_not_support_drag_and_drop'),
        'remove_file' => _l('remove_file'),
        'you_can_not_upload_any_more_files' => _l('you_can_not_upload_any_more_files'),
        'field_is_required' => _l('field_is_required'),
        'field_max_length' => _l('field_max_length'),
        'extension_not_allowed' => _l('extension_not_allowed'),
        'timezone' => get_option('default_timezone'),
        'dt_length_menu_all' => _l("dt_length_menu_all"),
        'dt_button_column_visibility' => _l('dt_button_column_visibility'),
        'dt_button_reload' => _l('dt_button_reload'),
        'dt_button_excel' => _l('dt_button_excel'),
        'dt_button_csv' => _l('dt_button_csv'),
        'dt_button_pdf' => _l('dt_button_pdf'),
        'dt_button_print' => _l('dt_button_print'),
        'dt_button_export' => _l('dt_button_export'),
        'item_field_not_formated' => _l('numbers_not_formated_while_editing'),
        'google_api' => '',
        'calendarIDs' => '',
        'has_tasks_permission' => has_permission('tasks', '', 'create'),
        'invoice_due_after' => get_option('invoice_due_after'),
        'media_files' => _l('media_files'),
        'proposal_save' => _l('proposal_save'),
        'contract_save' => _l('contract_save'),
        'calendar_expand' => _l('calendar_expand'),
        'allowed_files' => get_option('allowed_files'),
        'dropdown_non_selected_text' => _l('dropdown_non_selected_tex'),
        'confirm_action_prompt' => _l('confirm_action_prompt'),
        'mass_delete_btn' => _l('mass_delete'),
        'calendar_first_day' => get_option('calendar_first_day'),
        'dt_mass_delete_help' => _l('dt_mass_delete_help'),
        'estimate_number_exists' => _l('estimate_number_exists'),
        'invoice_number_exists' => _l('invoice_number_exists'),
        'no_results_text_search_dropdown' => _l('no_results_text_search_dropdown'),
        'email_exists' => _l('email_exists'),
        'has_delete_permission_customer' => has_permission('customers', '', 'delete'),
        'is_admin' => is_admin(),
        'is_staff_member' => is_staff_member()
    );
    $js_vars     = do_action('before_render_js_vars_admin', $js_vars);
    echo '<script>';
    foreach ($js_vars as $var => $val) {
        echo 'var ' . $var . '="' . $val . '";';
    }
    echo '</script>';
}
function get_ticket_form_accepted_mimes()
{
    $ticket_allowed_extensions  = get_option('ticket_attachments_file_extensions');
    $_ticket_allowed_extensions = explode(',', $ticket_allowed_extensions);
    $all_form_ext               = $ticket_allowed_extensions;
    if (is_array($_ticket_allowed_extensions)) {
        foreach ($_ticket_allowed_extensions as $ext) {
            $all_form_ext .= ',' . get_mime_by_extension($ext);
        }
    }
    return $all_form_ext;
}
function prepare_dt_filter($filter)
{
    $filter = implode(' ', $filter);
    if (_startsWith($filter, 'AND')) {
        $filter = substr($filter, 3);
    } else if (_startsWith($filter, 'OR')) {
        $filter = substr($filter, 2);
    }
    return $filter;
}
