<?php
/**
 * Render custom fields for particular area
 * @param  string  $belongs_to belongs to ex.leads,customers,staff
 * @param  boolean $rel_id     the main ID from the table
 * @return string
 */
function render_custom_fields($belongs_to, $rel_id = false, $where = array())
{
    $CI =& get_instance();
    $CI->db->where('active', 1);
    $CI->db->where('fieldto', $belongs_to);
    if (count($where) > 0) {
        $CI->db->where($where);
    }
    $CI->db->order_by('field_order', 'DESC');
    $fields = $CI->db->get('tblcustomfields')->result_array();
    $_field = '';
    $is_admin = is_admin();
    if (count($fields)) {
        foreach ($fields as $field) {
            if($field['only_admin'] == 1 && !$is_admin){continue;}
            $value = '';
            if ($rel_id !== false) {
                $value = get_custom_field_value($rel_id, $field['id'], $belongs_to);
            }
            $_input_attrs = array();
            if ($field['required'] == 1) {
                $_input_attrs['data-custom-field-required'] = true;
            }
            $_input_attrs['data-fieldto'] = $field['fieldto'];
            $_input_attrs['data-fieldid'] = $field['id'];

            $field_name = ucfirst($field['name']);
            if ($field['type'] == 'input') {
                $_field .= render_input('custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']', $field_name, $value, 'text', $_input_attrs);
            } else if ($field['type'] == 'date_picker') {
                $_field .= render_date_input('custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']', $field_name, _d($value), $_input_attrs);
            } else if ($field['type'] == 'textarea') {
                $_field .= render_textarea('custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']', $field_name, $value, $_input_attrs);
            } else if ($field['type'] == 'select') {
                $_select_attrs = array();
                $select_attrs = '';
                if ($field['required'] == 1) {
                    $_select_attrs['data-custom-field-required'] = true;
                }
                $_select_attrs['data-fieldto'] = $field['fieldto'];
                $_select_attrs['data-fieldid'] = $field['id'];
                foreach ($_select_attrs as $key => $val) {
                    $select_attrs .= $key . '=' . '"' . $val . '"';
                }
                $_field .= '<div class="form-group">';
                $_field .= '<label>' . $field_name . '</label>';
                $_field .= '<select ' . $select_attrs . ' name="custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']" class="selectpicker form-control" data-width="100%" data-none-selected-text="'._l('dropdown_non_selected_tex').'">';
                $_field .= '<option value=""></option>';
                $options = explode(',', $field['options']);
                foreach ($options as $option) {
                    $option   = trim($option);
                    $selected = '';
                    if ($option == $value) {
                        $selected = ' selected';
                    }
                    $_field .= '<option value="' . $option . '"' . $selected . '' . set_select('custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']', $option) . '>' . ucfirst($option) . '</option>';
                }
                $_field .= '</select>';
                $_field .= '</div>';
            }
            $_field .= form_error('custom_fields[' . $field['fieldto'] . '][' . $field['id'] . ']');
        }
    }
    return $_field;
}
/**
 * Get custom fields
 * @param  [type] $field_to belongs to ex.leads,customers,staff
 * @return array
 */
function get_custom_fields($field_to, $where = array())
{
    $is_admin = is_admin();
    $CI =& get_instance();
    $CI->db->where('fieldto', $field_to);
    if (count($where) > 0) {
        $CI->db->where($where);
    }
    if(!$is_admin){
        $CI->db->where('only_admin',0);
    }
    $CI->db->where('active', 1);
    $CI->db->order_by('field_order', 'asc');

    return $CI->db->get('tblcustomfields')->result_array();
}
/**
 * Get custom field value
 * @param  mixed $rel_id   the main ID from the table
 * @param  mixed $field_id field id
 * @param  string $field_to belongs to ex.leads,customers,staff
 * @return mixed
 */
function get_custom_field_value($rel_id, $field_id, $field_to)
{
    $CI =& get_instance();
    $CI->db->where('relid', $rel_id);
    $CI->db->where('fieldid', $field_id);
    $CI->db->where('fieldto', $field_to);
    $row    = $CI->db->get('tblcustomfieldsvalues')->row();
    $result = '';
    if ($row) {
        $result = $row->value;
    }
    return $result;
}
/**
 * Check for custom fields, update on $_POST
 * @param  mixed $rel_id        the main ID from the table
 * @param  array $custom_fields all custom fields with id and values
 * @return boolean
 */
function handle_custom_fields_post($rel_id, $custom_fields)
{
    $affectedRows = 0;
    $CI =& get_instance();
    foreach ($custom_fields as $key => $fields) {
        foreach ($fields as $field_id => $field_value) {
            $CI->db->where('relid', $rel_id);
            $CI->db->where('fieldid', $field_id);
            $CI->db->where('fieldto', $key);
            $row = $CI->db->get('tblcustomfieldsvalues')->row();
            if ($row) {
                // Make necessary checkings for fields
                $CI->db->where('id', $field_id);
                $field_checker = $CI->db->get('tblcustomfields')->row();
                if ($field_checker->type == 'date_picker') {
                    $field_value = to_sql_date($field_value);
                } else if ($field_checker->type == 'textarea') {
                    $field_value = nl2br($field_value);
                }
            }
            if ($row) {
                $CI->db->where('id', $row->id);
                $CI->db->update('tblcustomfieldsvalues', array(
                    'value' => $field_value
                    ));
                if ($CI->db->affected_rows() > 0) {
                    $affectedRows++;
                }
            } else {
                $CI->db->insert('tblcustomfieldsvalues', array(
                    'relid' => $rel_id,
                    'fieldid' => $field_id,
                    'fieldto' => $key,
                    'value' => $field_value
                    ));
                $insert_id = $CI->db->insert_id();
                if ($insert_id) {
                    $affectedRows++;
                }
            }
        }
    }
    if ($affectedRows > 0) {
        return true;
    }
    return false;
}
/**
 * Get manually added company custom fields
 * @since Version 1.0.4
 * @return array
 */
function get_company_custom_fields()
{
    $CI =& get_instance();
    $CI->db->like('name', 'custom_company_field_', 'after');
    $fields = $CI->db->get('tbloptions')->result_array();
    $i      = 0;
    foreach ($fields as $field) {
        $fields[$i]['label'] = str_replace('custom_company_field_', '', $field['name']);
        $fields[$i]['label'] = str_replace('_', ' ', $fields[$i]['label']);
        $fields[$i]['label'] = $fields[$i]['label'];
        $i++;
    }
    return $fields;
}
