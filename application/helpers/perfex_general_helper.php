<?php
header('Content-Type: text/html; charset=utf-8');
/**
 * Update the config variable to installed / used in update and install
 * @since  Version 1.0.2
 * @param  string $config_path config path
 * @return boolean
 */
function update_config_installed()
{
    $CI =& get_instance();
    $config_path = APPPATH . 'config/config.php';
    $CI->load->helper('file');
    @chmod($config_path, FILE_WRITE_MODE);
    $config_file = read_file($config_path);
    $config_file = trim($config_file);
    $prefix      = "http://";
    if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
        $prefix = 'https://';
    }
    $base_url = $prefix . $_SERVER['HTTP_HOST'];
    $base_url .= preg_replace('@/+$@', '', dirname($_SERVER['SCRIPT_NAME'])) . '/';
    $config_file = str_replace("\$config['installed'] = false;", "\$config['installed'] = true;", $config_file);
    $config_file = str_replace("\$config['base_url'] = '';", "\$config['base_url'] = '" . $base_url . "';", $config_file);
    if (!$fp = fopen($config_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
        return FALSE;
    }
    flock($fp, LOCK_EX);
    fwrite($fp, $config_file, strlen($config_file));
    flock($fp, LOCK_UN);
    fclose($fp);
    @chmod($config_path, FILE_READ_MODE);
    return TRUE;
}
function add_encryption_key(){
   $CI =& get_instance();
   $key = generate_encryption_key();
   $config_path = APPPATH . 'config/config.php';
   $CI->load->helper('file');
   @chmod($config_path, FILE_WRITE_MODE);
   $config_file = read_file($config_path);
   $config_file = trim($config_file);
   $config_file = str_replace("\$config['encryption_key'] = '';", "\$config['encryption_key'] = '".$key."';", $config_file);
   if (!$fp = fopen($config_path, FOPEN_WRITE_CREATE_DESTRUCTIVE)) {
    return FALSE;
    }
    flock($fp, LOCK_EX);
    fwrite($fp, $config_file, strlen($config_file));
    flock($fp, LOCK_UN);
    fclose($fp);
    @chmod($config_path, FILE_READ_MODE);
    return $key;
}
function generate_encryption_key(){
   $CI =& get_instance();
   // In case accessed from my_functions_helper.php
   $CI->load->library('encryption');
   $key = bin2hex($CI->encryption->create_key(16));
   return $key;
}
function do_recaptcha_validation($str = ''){
    $CI =& get_instance();
     $CI->load->library('form_validation');
        $google_url = "https://www.google.com/recaptcha/api/siteverify";
        $secret     = get_option('recaptcha_secret_key');
        $ip         = $CI->input->ip_address();
        $url        = $google_url . "?secret=" . $secret . "&response=" . $str . "&remoteip=" . $ip;
        $curl       = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        $res = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($res, true);
        //reCaptcha success check
        if ($res['success']) {
            return TRUE;
        } else {
            $CI->form_validation->set_message('recaptcha', _l('recaptcha_error'));
            return FALSE;
        }
}
/**
 * Get current date format from options
 * @return string
 */
function get_current_date_format($php = false)
{
    $format = get_option('dateformat');
    $format = explode('|', $format);
    if($php == false){
        return $format[1];
    } else {
        return $format[0];
    }
}
/**
 * Check if current user is admin
 * @param  mixed $staffid
 * @return boolean if user is not admin
 */
function is_admin($staffid = '')
{
    $_staffid = get_staff_user_id();
    if (is_numeric($staffid)) {
        $_staffid = $staffid;
    }
    $CI =& get_instance();
    $CI->db->select('1');
    $CI->db->where('admin', 1);
    $CI->db->where('staffid', $_staffid);
    $admin = $CI->db->get('tblstaff')->row();
    if ($admin) {
        return true;
    }
    return false;
    ;
}
/**
 * Is user logged in
 * @return boolean
 */
function is_logged_in()
{
    $CI =& get_instance();
    if (!$CI->session->has_userdata('client_logged_in') && !$CI->session->has_userdata('staff_logged_in')) {
        return false;
    }
    return true;
}
/**
 * Is client logged in
 * @return boolean
 */
function is_client_logged_in()
{
    $CI =& get_instance();
    if ($CI->session->has_userdata('client_logged_in') && $CI->session->get_userdata('client_logged_in') != false) {
        return true;
    }
    return false;
}
/**
 * Is staff logged in
 * @return boolean
 */
function is_staff_logged_in()
{
    $CI =& get_instance();
    if ($CI->session->has_userdata('staff_logged_in')) {
        return true;
    }
    return false;
}
/**
 * Return logged staff User ID from session
 * @return mixed
 */
function get_staff_user_id()
{
    $CI =& get_instance();
    if (!$CI->session->has_userdata('staff_logged_in')) {
        return false;
    }
    return $CI->session->userdata('staff_user_id');
}
/**
 * Return logged client User ID from session
 * @return mixed
 */
function get_client_user_id()
{
    $CI =& get_instance();
    if (!$CI->session->has_userdata('client_logged_in')) {
        return false;
    }
    return $CI->session->userdata('client_user_id');
}



function get_contact_user_id()
{
    $CI =& get_instance();
    if (!$CI->session->has_userdata('client_logged_in')) {
        return false;
    }
    return $CI->session->userdata('contact_user_id');
}
/**
 * Get admin url
 * @param string url to append (Optional)
 * @return string admin url
 */
function admin_url($url = '')
{
    if ($url == '') {
        return site_url(ADMIN_URL) . '/';
    } else {
        return site_url(ADMIN_URL . '/' . $url);
    }
}
/**
 * Outputs language string based on passed line
 * @since  Version 1.0.1
 * @param  string $line  language line string
 * @param  string $label sprint_f label
 * @return string        formated language
 */
function _l($line, $label = '')
{
    $CI =& get_instance();
    if (is_array($label) && count($label) > 0) {
        $_line = vsprintf($CI->lang->line(trim($line)), $label);
    } else {
        $_line = @sprintf($CI->lang->line(trim($line)), $label);
    }

    $CI->load->library('encoding_lib');
    if($_line != ''){
        return $CI->encoding_lib->toUTF8($_line);
    }
    if(mb_strpos($line,'_db_') !== false){
        return 'db_translate_not_found';
    }
    return $CI->encoding_lib->toUTF8($line);
}
/**
 * Format date to selected dateformat
 * @param  date $date Valid date
 * @return date/string
 */
function _d($date)
{
    if($date == '' || is_null($date) || $date == '0000-00-00'){return '';}
    $format = get_current_date_format();
    return strftime($format,strtotime($date));
}
/**
 * Format datetime to selected datetime format
 * @param  datetime $date datetime date
 * @return datetime/string
 */
function _dt($date)
{   if($date == '' || is_null($date) || $date == '0000-00-00 00:00:00'){return '';}
    $format = get_current_date_format();
    return strftime($format. ' %H:%M:%S',strtotime($date));
}
/**
 * Convert string to sql date based on current date format from options
 * @param  string $date date string
 * @return mixed
 */
function to_sql_date($date, $datetime = false)
{
    if ($date == '') {
        return NULL;
    }
    $to_date = 'Y-m-d';
    $format = get_current_date_format();
    $from_format = get_current_date_format(true);
    if($datetime == false){
        return date_format(date_create_from_format($from_format, $date), $to_date);
    } else {
        if(strpos($date,' ') === false){
            $date .= ' 00:00:00';
        } else {
            $_temp = explode(' ',$date);
            $time = explode(':',$_temp[1]);
            if(count($time) == 2){
                $date .= ':00';
            }
        }

        if($from_format == 'd/m/Y'){
            $date = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $date);
        } else if($from_format == 'm/d/Y'){
            $date = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$1-$2 $4', $date);
        } else if($from_format == 'm.d.Y'){
            $date = preg_replace('#(\d{2}).(\d{2}).(\d{4})\s(.*)#', '$3-$1-$2 $4', $date);
        } else if($from_format == 'm-d-Y'){
            $date = preg_replace('#(\d{2})-(\d{2})-(\d{4})\s(.*)#', '$3-$1-$2 $4', $date);
        }

        $d = strftime('%Y-%m-%d %H:%M:%S',strtotime($date));
        return $d;
    }
}
/**
 * Check if passed string is valid date
 * @param  string  $date
 * @return boolean
 */
function is_date($date)
{
    return (bool) strtotime($date);
}
/**
 * Get locale key by system language
 * @param  string $language language name from (application/languages) folder name
 * @return string
 */
function get_locale_key($language = 'english')
{
    if ($language == '') {
        return 'en';
    }

    $locales = get_locales();
    if (isset($locales[$language])) {
        return $locales[$language];
    } else if (isset($locales[ucfirst($language)])) {
        return $locales[ucfirst($language)];
    } else {
        foreach ($locales as $key => $val) {
            $key      = strtolower($key);
            $language = strtolower($language);
            if (strpos($key, $language) !== false) {
                return $val;
            }
        }
    }
    return 'en';
}
/**
 * Check if staff user has permission
 * @param  string  $permission permission shortname
 * @param  mixed  $staffid if you want to check for particular staff
 * @return boolean
 */
function has_permission($permission, $staffid = '', $can = '')
{
    $_permission = $permission;
    $CI =& get_instance();
    // check for passed is_admin function
    if (function_exists($permission) && is_callable($permission)) {
        return call_user_func($permission, $staffid);
    }
    if (is_admin($staffid)) {
        return true;
    }
    $_userid = get_staff_user_id();
    if ($staffid != '') {
        $_userid = $staffid;
    }
    if ($can == '') {
        return false;
    }
    $CI->db->select('permissionid');
    $CI->db->where('shortname', $permission);
    $permission = $CI->db->get('tblpermissions')->row();
    if (!$permission) {
        return false;
    }
    $CI->db->select('1');
    $CI->db->from('tblstaffpermissions');
    $CI->db->where('permissionid', $permission->permissionid);
    $CI->db->where('staffid', $_userid);
    $CI->db->where('can_' . $can, 1);
    $perm = $CI->db->get()->row();
    if ($perm) {
        return true;
    }
    return false;
}
function is_customer_admin($id,$staff_id = ''){

    $_staff_id = get_staff_user_id();
    if(is_numeric($staff_id)){
        $_staff_id = $staff_id;
    }
    $customer_admin_found = total_rows('tblcustomeradmins',array('customer_id'=>$id,'staff_id'=>$_staff_id));
    if($customer_admin_found > 0){
        return true;
    }
    return false;
}


function is_supplier_admin($id,$staff_id = ''){

    $_staff_id = get_staff_user_id();
    if(is_numeric($staff_id)){
        $_staff_id = $staff_id;
    }
    $supplier_admin_found = total_rows('tblsupplieradmins',array('supplier_id'=>$id,'staff_id'=>$_staff_id));
    if($supplier_admin_found > 0){
        return true;
    }
    return false;
}


function have_assigned_customers($staff_id = ''){
    $_staff_id = get_staff_user_id();
    if(is_numeric($staff_id)){
        $_staff_id = $staff_id;
    }
    $customers_found = total_rows('tblcustomeradmins',array('staff_id'=>$_staff_id));
    if($customers_found > 0){
        return true;
    }
    return false;
}


function have_assigned_suppliers($staff_id = ''){
    $_staff_id = get_staff_user_id();
    if(is_numeric($staff_id)){
        $_staff_id = $staff_id;
    }
    $supplierss_found = total_rows('tblsupplieradmins',array('staff_id'=>$_staff_id));
    if($supplierss_found > 0){
        return true;
    }
    return false;
}
function has_contact_permission($permission, $userid = '')
{
    $CI =& get_instance();
    $CI->load->library('perfex_base');
    $permissions = $CI->perfex_base->get_contact_permissions();
    $_userid     = get_contact_user_id();
    if ($userid != '') {
        $_userid = $userid;
    }
    foreach ($permissions as $_permission) {
        if ($_permission['short_name'] == $permission)
        {
            if (total_rows('tblcontactpermissions', array('permission_id' => $_permission['id'], 'userid' => $_userid)) > 0)
            {
                return true;
            }
        }
    }
    return false;
}
function is_staff_member($id = '')
{
    $CI =& get_instance();
    $staffid = $id;
    if ($staffid == '') {
        $staffid = get_staff_user_id();
    }
    $CI->db->select('1')->from('tblstaff')->where('staffid', $staffid)->where('is_not_staff', 0);
    $row = $CI->db->get()->row();
    if ($row) {
        return true;
    }
    return false;
}
function load_admin_language($staff_id = '')
{
    $CI =& get_instance();

    $CI->lang->is_loaded = array();
    $CI->lang->language = array();

    $language = get_option('active_language');
    if (is_staff_logged_in() || $staff_id != '') {
        $staff_language = get_staff_default_language($staff_id);
        if (!empty($staff_language)) {
            if (file_exists(APPPATH . 'language/' . $staff_language)) {
                $language = $staff_language;
            }
        }
    }
    $CI->lang->load($language . '_lang', $language);
    if (file_exists(APPPATH . 'language/' . $language . '/custom_lang.php')) {
        $CI->lang->load('custom_lang', $language);
    }
    return $language;
}
function load_client_language($customer_id = '')
{
    $CI =& get_instance();
    $language = get_option('active_language');
    if (is_client_logged_in() || $customer_id != '') {
        $client_language = get_client_default_language($customer_id);
        if (!empty($client_language)) {
            if (file_exists(APPPATH . 'language/' . $client_language)) {
                $language = $client_language;
            }
        }
    }

    $CI->lang->load($language . '_lang', $language);
    if (file_exists(APPPATH . 'language/' . $language . '/custom_lang.php')) {
        $CI->lang->load('custom_lang', $language);
    }
    return $language;
}
