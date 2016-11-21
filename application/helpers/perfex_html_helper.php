<?php
/**
 * Remove <br /> html tags from string to show in textarea with new linke
 * @param  string $text
 * @return string formated text
 */
function clear_textarea_breaks($text)
{
    $_text  = '';
    $_text  = $text;
    $breaks = array(
        "<br />",
        "<br>",
        "<br/>"
    );
    $_text  = str_ireplace($breaks, "", $_text);
    $_text  = trim($_text);
    return $_text;
}
/**
 * For more readable code created this function to render only yes or not values for settings
 * @param  string $option_value option from database to compare
 * @param  string $label        input label
 * @param  string $tooltip      tooltip
 */
function render_yes_no_option($option_value, $label, $tooltip = '')
{
    ob_start();
    if ($tooltip != '') {
        $tooltip = ' data-toggle="tooltip" title="' . _l($tooltip) . '"';
    }
?>
    <div class="form-group"<?php
    echo $tooltip;
?>>
    <label for="<?php
    echo $option_value;
?>" class="control-label clearfix"><?php
    echo _l($label);
?></label>
    <div class="radio radio-primary radio-inline">
        <input type="radio" id="y_opt_1_<?php
    echo $label;
?>" name="settings[<?php
    echo $option_value;
?>]" value="1" <?php
    if (get_option($option_value) == '1') {
        echo 'checked';
    }
?>>
        <label for="y_opt_1_<?php
    echo $label;
?>"><?php
    echo _l('settings_yes');
?></label>
        </div>
        <div class="radio radio-primary radio-inline">
            <input type="radio" id="y_opt_2_<?php
    echo $label;
?>" name="settings[<?php
    echo $option_value;
?>]" value="0" <?php
    if (get_option($option_value) == '0') {
        echo 'checked';
    }
?>>
            <label for="y_opt_2_<?php
    echo $label;
?>"><?php
    echo _l('settings_no');
?></label>
            </div>
        </div>
        <?php
    $settings = ob_get_contents();
    ob_end_clean();
    echo $settings;
}
function init_relation_tasks_table($table_attributes = array())
{
    $table_data = array(
        _l('tasks_dt_name'),
        _l('tasks_dt_datestart'),
        _l('task_duedate'),
        _l('task_assigned'),
        _l('tasks_list_priority'),
        _l('tasks_dt_finished'),
    );
    if (has_permission('tasks', '', 'create') || has_permission('tasks', '', 'edit')) {
        array_push($table_data, _l('task_billable'));
        array_push($table_data, _l('task_billed'));
    }
    $custom_fields = get_custom_fields('tasks', array(
        'show_on_table' => 1
    ));
    foreach ($custom_fields as $field) {
        array_push($table_data, $field['name']);
    }
    array_push($table_data, _l('options'));
    $name = 'rel-tasks';
    if ($table_attributes['data-new-rel-type'] == 'lead') {
        $name = 'rel-tasks-leads';
    }
    $table = '';
    $CI = &get_instance();
    $table_name = '.table-'.$name;
    $CI->load->view('admin/tasks/tasks_filter_by',array('view_table_name'=>$table_name));
    if(has_permission('tasks','','create')){
        $table_name = addslashes($table_name);
       echo "<a href='#' class='btn btn-info pull-left' onclick=\"new_task_from_relation('$table_name'); return false;\" >"._l('new_task')."</a><div class='clearfix'></div>";
    }
    $table .= render_datatable($table_data, $name, array(), $table_attributes);
    $table .= '<div class="modal fade task-modal-single" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>';

    return $table;
}

function init_relation_options($data, $type, $rel_id = '')
{
    echo '<option value=""></option>';
    foreach ($data as $relation) {
        $selected        = '';
        $relation_values = get_relation_values($relation, $type);
        if ($rel_id == $relation_values['id']) {
            $selected = ' selected';
        }
        echo '<option value="' . $relation_values['id'] . '"' . $selected . '>' . $relation_values['name'] . '</option>';
    }
}
function ticket_priority_translate($id){
     if($id == '' || is_null($id)){
        return '';
    }
    $line = _l('ticket_priority_db_'.$id);
    if($line == 'db_translate_not_found'){
        $CI = &get_instance();
        $CI->db->where('priorityid',$id);
        $priority = $CI->db->get('tblpriorities')->row();
        if(!$priority){
            return '';
        }
        return $priority->name;
    }
    return $line;
}
function ticket_status_translate($id){
    if($id == '' || is_null($id)){
        return '';
    }
    $line = _l('ticket_status_db_'.$id);
    if($line == 'db_translate_not_found'){
        $CI = &get_instance();
        $CI->db->where('ticketstatusid',$id);
        $status = $CI->db->get('tblticketstatus')->row();
        if(!$status){
            return '';
        }
        return $status->name;
    }
    return $line;
}
function task_priority($id)
{
    if ($id == '1') {
        $priority = _l('task_priority_low');
    } else if ($id == '2') {
        $priority = _l('task_priority_medium');
    } else if ($id == '3') {
        $priority = _l('task_priority_high');
    } else if ($id == '4') {
        $priority = _l('task_priority_urgent');
    } else {
        $priority = $id;
    }
    return $priority;
}
function get_task_priority_class($id){
    if ($id == 1) {
        $class = 'default';
    } else if ($id == 2) {
        $class = 'info';
    } else if ($id == 3) {
        $class = 'warning';
    } else {
        $class = 'danger';
    }
    return $class;
}
function get_project_label($status){
    if($status == 1){
        $label = 'muted';
    } else if($status == 2){
        $label = 'info';
    } else if($status == 3){
        $label = 'warning';
    } else {
        $label = 'success';
    }

    return $label;
}
function render_input($name, $label = '', $value = '', $type = 'text', $input_attrs = array(), $form_group_attr = array(), $form_group_class = '', $input_class = '')
{
    $input            = '';
    $_form_group_attr = '';
    $_input_attrs     = '';
    foreach ($input_attrs as $key => $val) {
        // tooltips
        if ($key == 'title') {
            $val = _l($val);
        }
        $_input_attrs .= $key . '=' . '"' . $val . '"';
    }
    foreach ($form_group_attr as $key => $val) {
        // tooltips
        if ($key == 'title') {
            $val = _l($val);
        }
        $_form_group_attr .= $key . '=' . '"' . $val . '"';
    }
    if (!empty($form_group_class)) {
        $form_group_class = ' ' . $form_group_class;
    }
    if (!empty($input_class)) {
        $input_class = ' ' . $input_class;
    }
    $input .= '<div class="form-group' . $form_group_class . '" ' . $_form_group_attr . '>';
    if ($label != '') {
        $input .= '<label for="' . $name . '" class="control-label">' . _l($label) . '</label>';
    }
    $input .= '<input type="' . $type . '" id="' . $name . '" name="' . $name . '" class="form-control' . $input_class . '" ' . $_input_attrs . ' value="' . set_value($name, $value) . '">';
    $input .= '</div>';
    return $input;
}
function render_color_picker( $name, $label = '', $value = '' ){
    $picker = '';
    $picker .='<div class="form-group">';
    $picker .= '<label for="name" class="control-label">'.$label.'</label>';
   $picker .= '<div class="input-group mbot15 colorpicker-input">
    <input type="text" value="'.$value.'" name="'.$name.'" id="'.$name.'" class="form-control" />
    <span class="input-group-addon"><i></i></span>
</div>';
$picker .= '</div>';
return $picker;
}
function render_date_input($name, $label = '', $value = '', $input_attrs = array(), $form_group_attr = array(), $form_group_class = '', $input_class = '')
{
    $input            = '';
    $_form_group_attr = '';
    $_input_attrs     = '';
    foreach ($input_attrs as $key => $val) {
        // tooltips
        if ($key == 'title') {
            $val = _l($val);
        }
        $_input_attrs .= $key . '=' . '"' . $val . '"';
    }
    foreach ($form_group_attr as $key => $val) {
        // tooltips
        if ($key == 'title') {
            $val = _l($val);
        }
        $_form_group_attr .= $key . '=' . '"' . $val . '"';
    }
    if (!empty($form_group_class)) {
        $form_group_class = ' ' . $form_group_class;
    }
    if (!empty($input_class)) {
        $input_class = ' ' . $input_class;
    }
    $input .= '<div class="form-group' . $form_group_class . '" ' . $_form_group_attr . '>';
    if ($label != '') {
        $input .= '<label for="' . $name . '" class="control-label">' . _l($label) . '</label>';
    }
    $input .= '<div class="input-group date">';
    $input .= '<input type="text" id="' . $name . '" name="' . $name . '" class="form-control datepicker' . $input_class . '" ' . $_input_attrs . ' value="' . $value . '">';
    $input .= '<div class="input-group-addon">
    <i class="fa fa-calendar calendar-icon"></i>
</div>';
    $input .= '</div>';
    $input .= '</div>';
    return $input;
}
function render_datetime_input($name, $label = '', $value = '', $input_attrs = array(), $form_group_attr = array(), $form_group_class = '', $input_class = '')
{
    $html = render_date_input($name, $label, $value, $input_attrs, $form_group_attr, $form_group_class, $input_class);
    $html = str_replace('datepicker', 'datetimepicker', $html);
    return $html;
}
function render_textarea($name, $label = '', $value = '', $textarea_attrs = array(), $form_group_attr = array(), $form_group_class = '', $textarea_class = '')
{
    $textarea         = '';
    $_form_group_attr = '';
    $_textarea_attrs  = '';
    if (!isset($textarea_attrs['rows'])) {
        $textarea_attrs['rows'] = 4;
    }
    foreach ($textarea_attrs as $key => $val) {
        // tooltips
        if ($key == 'title') {
            $val = _l($val);
        }
        $_textarea_attrs .= $key . '=' . '"' . $val . '"';
    }
    foreach ($form_group_attr as $key => $val) {
        if ($key == 'title') {
            $val = _l($val);
        }
        $_form_group_attr .= $key . '=' . '"' . $val . '"';
    }
    if (!empty($textarea_class)) {
        $textarea_class = ' ' . $textarea_class;
    }
    if (!empty($form_group_class)) {
        $form_group_class = ' ' . $form_group_class;
    }
    $textarea .= '<div class="form-group' . $form_group_class . '" ' . $_form_group_attr . '>';
    if ($label != '') {
        $textarea .= '<label for="' . $name . '" class="control-label">' . _l($label) . '</label>';
    }

    $v = clear_textarea_breaks($value);
    if(strpos($textarea_class,'tinymce') !== false){
        $v = $value;
    }
    $textarea .= '<textarea id="' . $name . '" name="' . $name . '" class="form-control' . $textarea_class . '" ' . $_textarea_attrs . '>' . set_value($name, $v ). '</textarea>';
    $textarea .= '</div>';
    return $textarea;
}
//render_select('clientid',$customers,array('userid',array('company')),'project_customer',$selected,array(),array(),'',$auto_toggle_class)
function render_select($name, $options, $option_attrs = array(), $label = '', $selected = '', $select_attrs = array(), $form_group_attr = array(), $form_group_class = '', $select_class = '', $include_blank = true)
{

    $callback_translate = '';
    if(isset($options['callback_translate'])){
            $callback_translate = $options['callback_translate'];
            unset($options['callback_translate']);
    }
    $select           = '';
    $_form_group_attr = '';
    $_select_attrs    = '';
    if (!isset($select_attrs['data-width'])) {
        $select_attrs['data-width'] = '100%';
    }
    if (!isset($select_attrs['data-none-selected-text'])) {
        $select_attrs['data-none-selected-text'] = _l('dropdown_non_selected_tex');
    }
    foreach ($select_attrs as $key => $val) {
        // tooltips
        if ($key == 'title') {
            $val = _l($val);
        }
        $_select_attrs .= $key . '=' . '"' . $val . '"';
    }
    foreach ($form_group_attr as $key => $val) {
        // tooltips
        if ($key == 'title') {
            $val = _l($val);
        }
        $_form_group_attr .= $key . '=' . '"' . $val . '"';
    }
    if (!empty($select_class)) {
        $select_class = ' ' . $select_class;
    }
    if (!empty($form_group_class)) {
        $form_group_class = ' ' . $form_group_class;
    }
    $select .= '<div class="form-group' . $form_group_class . '" ' . $_form_group_attr . '>';
    if ($label != '') {
        $select .= '<label for="' . $name . '" class="control-label">' . _l($label) . '</label>';
    }
    $select .= '<select id="' . $name . '" name="' . $name . '" class="selectpicker' . $select_class . '" ' . $_select_attrs . ' data-live-search="true">';
    if ($include_blank == true) {
        $select .= '<option value=""></option>';
    }
    foreach ($options as $option) {
        $val       = '';
        $_selected = '';
        $key       = '';
        if (isset($option[$option_attrs[0]]) && !empty($option[$option_attrs[0]])) {
            $key = $option[$option_attrs[0]];
        }
        if (!is_array($option_attrs[1])) {
            $val = $option[$option_attrs[1]];
        } else {
            foreach ($option_attrs[1] as $_val) {
                $val .= $option[$_val] . ' ';
            }
        }
        $val           = trim($val);
        if($callback_translate != ''){
            if(function_exists($callback_translate) && is_callable($callback_translate)){
               $val = call_user_func($callback_translate,$key);
            }
        }
        $data_sub_text = '';
        if (!is_array($selected)) {
            if ($selected != '') {
                if ($selected == $key) {
                    $_selected = ' selected';
                }
            }
        } else {
            foreach ($selected as $id) {
                if ($key == $id) {
                    $_selected = ' selected';
                }
            }
        }
        if (isset($option_attrs[2])) {
            if (strpos($option_attrs[2], ',') !== false) {
                $sub_text = '';
                $_temp    = explode(',', $option_attrs[2]);
                foreach ($_temp as $t) {
                    if (isset($option[$t])) {
                        $sub_text .= $option[$t] . ' ';
                    }
                }
            } else {
                if (isset($option[$option_attrs[2]])) {
                    $sub_text = $option[$option_attrs[2]];
                } else {
                    $sub_text = $option_attrs[2];
                }
            }
            $data_sub_text = ' data-subtext=' . '"' . $sub_text . '"';
        }
        $select .= '<option value="' . $key . '"' . $_selected . '' . $data_sub_text . '>' . $val . '</option>';
    }
    $select .= '</select>';
    $select .= '</div>';
    return $select;
}
/**
 * Init admin head
 * @param  boolean $aside should include aside
 */
function init_head($aside = true)
{
    $CI =& get_instance();
    $CI->load->view('admin/includes/head');
    $CI->load->view('admin/includes/header');
    $CI->load->view('admin/includes/customizer-sidebar');
    if ($aside == true) {
        $CI->load->view('admin/includes/aside');
    }
}
/**
 * Init admin footer/tails
 */
function init_tail()
{
    $CI =& get_instance();
    $CI->load->view('admin/includes/scripts');
}
/**
 * Render table used for datatables
 * @param  array  $headings           [description]
 * @param  string $class              table class / added prefix table-$class
 * @param  array  $additional_classes
 * @return string                     formated table
 */
function render_datatable($headings = array(), $class = '', $additional_classes = array(''), $table_attributes = array())
{
    $_additional_classes = '';
    $_table_attributes   = '';
    if (count($additional_classes) > 0) {
        $_additional_classes = ' ' . implode(' ', $additional_classes);
    }
    $CI =& get_instance();
    $CI->load->library('user_agent');
    $browser = $CI->agent->browser();
    $IEfix   = '';
    if ($browser == 'Internet Explorer') {
        $IEfix = ' ie-dt-fix';
    }
    foreach ($table_attributes as $key => $val) {
        $_table_attributes .= $key . '=' . '"' . $val . '"';
    }

    $table = '<div class="mtop15' . $IEfix . '"><table ' . $_table_attributes . ' class="table table-striped table-' . $class . ' ' . $_additional_classes . '">';
    $table .= '<thead>';
    $table .= '<tr>';
    foreach ($headings as $heading) {
        $table .= '<th>' . $heading . '</th>';
    }
    $table .= '</tr>';
    $table .= '</thead>';
    $table .= '<tbody></tbody>';
    $table .= '</table></div>';
    echo $table;
}
/**
 * Get company logo from company uploads folder
 * @param  string $url     href url of image
 * @param  string $classes Additional classes on href
 */
function get_company_logo($url = '', $classes = '')
{
    $company_logo = get_option('company_logo');
    $company_name = get_option('companyname');
    if ($url == '') {
        $url = site_url();
    } else {
        $url = site_url($url);
    }
    if ($company_logo != '') {
?>
        <a href="<?php
        echo $url;
?>" class="<?php
        echo $classes;
?> logo">
        <img src="<?php
        echo site_url('uploads/company/' . $company_logo);
?>" alt="<?php
        echo $company_name;
?>"></a>
        <?php
    } else if ($company_name != '') {
?>
        <a href="<?php
        echo $url;
?>" class="<?php
        echo $classes;
?> logo"><?php
        echo $company_name;
?></a>
        <?php
    } else {
        echo '';
    }
}
function staff_profile_image_url($staff_id, $type = 'small')
{
    $url = site_url('assets/images/user-placeholder.jpg');
    $CI =& get_instance();
    $CI->db->select('profile_image');
    $CI->db->from('tblstaff');
    $CI->db->where('staffid', $staff_id);
    $staff = $CI->db->get()->row();
    if ($staff) {
        if (!is_null($staff->profile_image)) {
            $url = site_url('uploads/staff_profile_images/' . $staff_id . '/' . $type . '_' . $staff->profile_image);
        }
    }
    return $url;
}
function contact_profile_image_url($contact_id, $type = 'small')
{
    $url = site_url('assets/images/user-placeholder.jpg');
    $CI =& get_instance();
    $CI->db->select('profile_image');
    $CI->db->from('tblcontacts');
    $CI->db->where('id', $contact_id);
    $contact = $CI->db->get()->row();
    if ($contact) {
        if (!is_null($contact->profile_image)) {
            $url = site_url('uploads/client_profile_images/' . $contact_id . '/' . $type . '_' . $contact->profile_image);
        }
    }
    return $url;
}

function supplier_contact_profile_image_url($contact_id, $type = 'small')
{
    $url = site_url('assets/images/user-placeholder.jpg');
    $CI =& get_instance();
    $CI->db->select('profile_image');
    $CI->db->from('tblsuppliercontacts');
    $CI->db->where('id', $contact_id);
    $contact = $CI->db->get()->row();
    if ($contact) {
        if (!is_null($contact->profile_image)) {
            $url = site_url('uploads/supplier_profile_images/' . $contact_id . '/' . $type . '_' . $contact->profile_image);
        }
    }
    return $url;
}
function contact_profile_image_url1($contact_id, $classes = array('staff-profile-image'),$type = 'small')
{
    $url = site_url('assets/images/user-placeholder.jpg');
    $CI =& get_instance();
    $CI->db->select('profile_image,firstname,lastname');
    $CI->db->where('id', $contact_id);
    $contact = $CI->db->get('tblcontacts')->row();
    //$profile_image= $contact->firstname;
    if ($contact && $contact->profile_image !== null)
    {
           // $url = site_url('uploads/client_profile_images/' . $contact_id . '/' . $type . '_' . $contact->profile_image);
            $profile_image = '<img  src="' . site_url('uploads/client_profile_images/' . $contact_id . '/' . $type . '_' . $contact->profile_image) . '"  alt="' . $contact->firstname . ' ' . $contact->lastname . '" />';
    }else{
        $profile_image = '<img src="' . site_url('assets/images/user-placeholder.jpg') . '"  class="' . implode(' ', $classes) . '" alt="' . $contact->firstname . ' ' . $contact->lastname . '" />';

    }
    return $profile_image;
}

function supplier_contact_profile_image_url1($contact_id, $classes = array('staff-profile-image'),$type = 'small')
{
    $url = site_url('assets/images/user-placeholder.jpg');
    $CI =& get_instance();
    $CI->db->select('profile_image,firstname,lastname');
    $CI->db->where('id', $contact_id);
    $contact = $CI->db->get('tblsuppliercontacts')->row();
    //$profile_image= $contact->firstname;
    if ($contact && $contact->profile_image !== null)
    {
           // $url = site_url('uploads/client_profile_images/' . $contact_id . '/' . $type . '_' . $contact->profile_image);
            $profile_image = '<img  src="' . site_url('uploads/supplier_profile_images/' . $contact_id . '/' . $type . '_' . $contact->profile_image) . '"  alt="' . $contact->firstname . ' ' . $contact->lastname . '" />';
    }else{
        $profile_image = '<img src="' . $url . '"  class="' . implode(' ', $classes) . '" alt="' . $contact->firstname . ' ' . $contact->lastname . '" />';

    }
    return $profile_image;
}
/**
 * Get staff profile image
 * @param  boolean $id      staff ID
 * @param  array   $classes Additional image classes
 * @param  string  $type    small/thumb
 * @return string           Image link
 */
function staff_profile_image($id = false, $classes = array('staff-profile-image'), $type = 'small', $img_attrs = array())
{
    $CI =& get_instance();
    $CI->db->select('profile_image,firstname,lastname');
    $CI->db->where('staffid', $id);
    $result      = $CI->db->get('tblstaff')->row();
    $_attributes = '';
    foreach ($img_attrs as $key => $val) {
        $_attributes .= $key . '=' . '"' . $val . '" ';
    }
    if ($result && $result->profile_image !== null) {
        $profile_image = '<img ' . $_attributes . ' src="' . site_url('uploads/staff_profile_images/' . $id . '/' . $type . '_' . $result->profile_image) . '" class="' . implode(' ', $classes) . '" alt="' . $result->firstname . ' ' . $result->lastname . '" />';
    } else {
        $profile_image = '<img src="' . site_url('assets/images/user-placeholder.jpg') . '" ' . $_attributes . ' class="' . implode(' ', $classes) . '" alt="' . $result->firstname . ' ' . $result->lastname . '" />';
    }
    return $profile_image;
}

/**
 * Get client profile image
 * @param  boolean $id      staff ID
 * @param  array   $classes Additional image classes
 * @param  string  $type    small/thumb
 * @return string           Image link
 */
function client_profile_image($id = false, $classes = array('client-profile-image'), $type = 'small', $img_attrs = array())
{
    $CI =& get_instance();
    $CI->db->select('profile_image,company,city');
    $CI->db->where('userid', $id);
    $result      = $CI->db->get('tblclients')->row();
    $_attributes = '';
    foreach ($img_attrs as $key => $val) {
        $_attributes .= $key . '=' . '"' . $val . '" ';
    }
    if ($result && $result->profile_image !== null) {
        $profile_image = '<img width="38px !important" height="38px !important"' . $_attributes . ' src="' . site_url('uploads/client_profile_images/' . $id . '/' . $type . '_' . $result->profile_image) .  '" alt="' . $result->company . ' ' . $result->city . '" />';
    } else {
        $profile_image = '<img width="38px" height="38px" src="' . site_url('assets/images/user-placeholder.jpg') . '" ' . $_attributes  . '" alt="' . $result->firstname . ' ' . $result->lastname . '" />';
    }
    return $profile_image;
}

function supplier_profile_image($id = false, $classes = array('supplier-profile-image'), $type = 'small', $img_attrs = array())
{
    $CI =& get_instance();
    $CI->db->select('profile_image,company,city');
    $CI->db->where('supplierid', $id);
    $result      = $CI->db->get('tblsuppliers')->row();
    $_attributes = '';
    foreach ($img_attrs as $key => $val) {
        $_attributes .= $key . '=' . '"' . $val . '" ';
    }
    if ($result && $result->profile_image !== null) {
        $profile_image = '<img width="38px !important" height="38px !important"' . $_attributes . ' src="' . site_url('uploads/supplier_profile_images/' . $id . '/' . $type . '_' . $result->profile_image) .  '" alt="' . $result->company . ' ' . $result->city . '" />';
    } else {
        $profile_image = '<img width="38px" height="38px" src="' . site_url('assets/images/user-placeholder.jpg') . '" ' . $_attributes  . '" alt="' . $result->firstname . ' ' . $result->lastname . '" />';
    }
    return $profile_image;
}

/**
 * Generate small icon button / font awesome
 * @param  string $url        href url
 * @param  string $type       icon type
 * @param  string $class      button class
 * @param  array  $attributes additional attributes
 * @return string
 */
function icon_btn($url = '', $type = '', $class = 'btn-default', $attributes = array())
{
    $_attributes = '';
    foreach ($attributes as $key => $val) {
        $_attributes .= $key . '=' . '"' . $val . '" ';
    }
    $_url = '#';
    if (_startsWith($url, 'http')) {
        $_url = $url;
    } else if ($url !== '#') {
        $_url = admin_url($url);
    }
    return '<a href="' . $_url . '" class="btn ' . $class . ' btn-icon" ' . $_attributes . '><i class="fa fa-' . $type . '"></i></a>';
}
/**
 * Render admin tickets table structure
 */
function AdminTicketsTableStructure($name = '')
{
    if ($name == '') {
        $name = 'tickets-table';
    }
    ob_start();
?>
<table class="table <?php
    echo $name;
?>">
<thead>
<tr>
<th><?php echo _l('id'); ?></th>
<th><?php echo _l('ticket_dt_subject'); ?></th>
<th><?php echo _l('ticket_dt_department'); ?></th>
<?php if (get_option('services') == 1) { ?>
<th><?php echo _l('ticket_dt_service'); ?></th>
<?php } ?>
<th><?php echo _l('ticket_dt_submitter');?></th>
<th><?php echo _l('ticket_dt_status');?></th>
<th><?php echo _l('ticket_dt_priority'); ?></th>
<th><?php echo _l('ticket_dt_last_reply'); ?></th>
<th>
<?php echo _l('ticket_date_created'); ?></th>
<?php
$custom_fields = get_custom_fields('tickets',array('show_on_table'=>1));
foreach($custom_fields as $field){ ?>
    <th><?php echo $field['name']; ?></th>
<?php } ?>
<th><?php echo _l('options');?></th>
</tr>
</thead>
<tbody>
</tbody>
</table>

<?php
$table = ob_get_contents();
ob_end_clean();
return $table;
}
/**
 * Callback for check_for_links
 */
function _make_url_clickable_cb($matches)
{
    $ret = '';
    $url = $matches[2];
    if (empty($url))
        return $matches[0];
    // removed trailing [.,;:] from URL
    if (in_array(substr($url, -1), array(
        '.',
        ',',
        ';',
        ':'
    )) === true) {
        $ret = substr($url, -1);
        $url = substr($url, 0, strlen($url) - 1);
    }
    return $matches[1] . "<a href=\"$url\" rel=\"nofollow\" target='_blank'>$url</a>" . $ret;
}
/**
 * Callback for check_for_links
 */
function _make_web_ftp_clickable_cb($matches)
{
    $ret  = '';
    $dest = $matches[2];
    $dest = 'http://' . $dest;
    if (empty($dest))
        return $matches[0];
    // removed trailing [,;:] from URL
    if (in_array(substr($dest, -1), array(
        '.',
        ',',
        ';',
        ':'
    )) === true) {
        $ret  = substr($dest, -1);
        $dest = substr($dest, 0, strlen($dest) - 1);
    }
    return $matches[1] . "<a href=\"$dest\" rel=\"nofollow\" target='_blank'>$dest</a>" . $ret;
}
/**
 * Callback for check_for_links
 */
function _make_email_clickable_cb($matches)
{
    $email = $matches[2] . '@' . $matches[3];
    return $matches[1] . "<a href=\"mailto:$email\">$email</a>";
}
/**
 * Check for links/emails/ftp in string to wrap in href
 * @param  string $ret
 * @return string      formatted string with href in any found
 */
function check_for_links($ret)
{
    $ret = ' ' . $ret;
    // in testing, using arrays here was found to be faster
    $ret = preg_replace_callback('#([\s>])([\w]+?://[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', '_make_url_clickable_cb', $ret);
    $ret = preg_replace_callback('#([\s>])((www|ftp)\.[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', '_make_web_ftp_clickable_cb', $ret);
    $ret = preg_replace_callback('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', '_make_email_clickable_cb', $ret);
    // this one is not in an array because we need it to run last, for cleanup of accidental links within links
    $ret = preg_replace("#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i", "$1$3</a>", $ret);
    $ret = trim($ret);
    return $ret;
}
/**
 * Strip tags
 * @param  string $html string to strip tags
 * @return string
 */
function _strip_tags($html)
{
    return strip_tags($html, '<br>,<em>,<p>,<ul>,<ol>,<li>,<h4><h3><h2><h1>,<pre>,<code>,<a>,<img>,<strong>,<blockquote>,<table>,<thead>,<th>,<tr>,<td>,<tbody>,<tfoot>');
}

function adjust_color_brightness($hex, $steps)
{
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));
    // Normalize into a six character long hex string
    $hex   = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
    }
    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return      = '#';
    foreach ($color_parts as $color) {
        $color = hexdec($color); // Convert to decimal
        $color = max(0, min(255, $color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }
    return $return;
}
function hex2rgb($color){
    $color = str_replace('#', '', $color);
    if (strlen($color) != 6){ return array(0,0,0); }
    $rgb = array();
    for ($x=0;$x<3;$x++){
        $rgb[$x] = hexdec(substr($color,(2*$x),2));
    }
    return $rgb;
}

function strip_html_tags($str,$allowed = ''){
    $str = preg_replace('/(<|>)\1{2}/is', '', $str);
    $str = preg_replace(
        array(
          // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',
          // Add line breaks before and after blocks
            '@</?((address)|(blockquote)|(center)|(del))@iu',
            '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
            '@</?((table)|(th)|(td)|(caption))@iu',
            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
            '@</?((frameset)|(frame)|(iframe))@iu',
        ),
        array(
            ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
            "\n\$0", "\n\$0",
        ),
        $str );
    return strip_tags( $str, $allowed );
    return $str;
} //function strip_html_tags ENDS

function which_slider(){
    $CI = &get_instance();
    $CI->db->where('active',1);

    if(site_url('authentication/admin')) {
        $array_1 = array('0','2');
        $query = $CI->db->select('*')->from('tblsliders')->where_in('right_user',$array_1);
        $dbsliders = $query->get()->result();
        return $dbsliders;
    }
    if(site_url('clients/login')){
        $array_1 = array('1','2');
       $query = $CI->db->select('*')->from('tblsliders')->where_in('right_user',$array_1);
        $dbsliders = $query->get()->result();
        return $dbsliders;
    }else return 0 ;
}

function generate_slider($param)
{

    $sliders = array();
    $CI = &get_instance();
    $CI->db->where('active',1);
    if($param == 'clients/login'){
        $dbsliders = $CI->db->where_not_in('right_user',intval('0'))->get('tblsliders')->result_array();
    }
    else if ($param == 'authentication/admin') {
        $dbsliders = $CI->db->where_not_in('right_user',intval('1'))->get('tblsliders')->result_array();
    } else $dbsliders = $CI->db->get('tblsliders')->result_array();
   // $dbsliders = which_slider();->where('right_user',1)
    $countSliders = sizeof($dbsliders);

    $li = '';
    $css = '';
    $i = 1;
    $delay = 0;
    foreach($dbsliders as $dbslider){
       // if($this->uri->uri_string() == 'clients/login')
            $li .= '<li><span></span></li>';
            $css .= ".cb-slideshow li:nth-child($i) span {
                  background-image: url(".site_url("uploads/sliders/".$dbslider['image']).");
                  -webkit-animation-delay: ".$delay."s;
                  -moz-animation-delay: ".$delay."s;
                  -o-animation-delay: ".$delay."s;
                  -ms-animation-delay: ".$delay."s;
                  animation-delay: ".$delay."s;
                }
                ";
            $i++;
            $delay += 6;

    }
    $html ='';
    $html .= '<ul class="cb-slideshow">'.$li.'</ul>';




    $slider['html'] = $html;
    $slider['css'] = $css;

    return $slider;

}

