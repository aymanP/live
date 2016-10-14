<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings_model extends CRM_Model
{
    private $encrypted_fields = array(
        'smtp_password',
        'paymentmethod_paypal_username',
        'paymentmethod_paypal_password',
        'paymentmethod_paypal_signature',
        'paymentmethod_stripe_api_secret_key',
        );
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Update all settings
     * @param  array $data all settings
     * @return integer
     */
    public function update($data)
    {
        $original_encrypted_fields = array();
        foreach($this->encrypted_fields as $ef){
            $original_encrypted_fields[$ef] = get_option($ef);
        }
        $affectedRows = 0;
        $data         = do_action('before_settings_updated', $data);
        if (!isset($data['settings']['default_tax']) && isset($data['settings']['finance_settings'])) {
            $data['settings']['default_tax'] = array();
        }
        $all_settings_looped = array();
        foreach ($data['settings'] as $name => $val) {

            array_push($all_settings_looped,$name);
            $hook_data['name'] = $name;
            $hook_data['value'] = $val;
            $hook_data = do_action('before_single_setting_updated_in_loop',$hook_data);
            $name = $hook_data['name'];
            $val = $hook_data['value'];
            if($name == 'default_contact_permissions'){
                $val = serialize($val);
            }
            // Check if the option exists
            $this->db->where('name', $name);
            $exists = $this->db->count_all_results('tbloptions');
            if ($exists == 0) {
                continue;
            }
            if ($name == 'email_signature') {
                $val = nl2br($val);
            } else if ($name == 'default_tax') {
                $_temp_val = $val;
                $val       = '';
                foreach ($_temp_val as $_tax) {
                    if ($_tax != '') {
                        $_temp = explode('|', $_tax);
                        $tax   = get_tax_by_name($_temp[0]);
                        $val .= $tax->name . '|' . $tax->taxrate . '+';
                    }
                }
                if ($val != '') {
                    $val = substr($val, 0, -1);
                }
            } else if(in_array($name,$this->encrypted_fields)){
                // Check if not empty $val password
                // Get original
                // Decrypt original
                // Compare with $val password
                // If equal unset
                // If not encrypt and save
                if(!empty($val)){
                    $or_decrypted = $this->encryption->decrypt($original_encrypted_fields[$name]);
                    if($or_decrypted == $val){
                        continue;
                    } else {
                        $val = $this->encryption->encrypt($val);
                    }
                }
            }
            $this->db->where('name', $name);
            $this->db->update('tbloptions', array(
                'value' => $val
            ));
            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }
        }
        // Contact permission default none
        if(!in_array('default_contact_permissions',$all_settings_looped) && isset($all_settings_looped['customer_settings'])){
            $this->db->where('name', 'default_contact_permissions');
            $this->db->update('tbloptions', array(
                'value' => serialize(array())
            ));
            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }
        }
        if ($affectedRows > 0) {
            logActivity('Settings Updated []');
        }

        return $affectedRows;
    }
    public function add_new_company_pdf_field($data)
    {
        $field = 'custom_company_field_' . trim($data['field']);
        $field = preg_replace('/\s+/', '_', $field);
        if (add_option($field, $data['value'])) {
            return true;
        }
        return false;
    }
}
