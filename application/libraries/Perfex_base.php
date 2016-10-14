<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Perfex_Base
{
    private $options = array();
    // Quick actions aide
    private $quick_actions = array();
    // Instance CI
    private $_instance;
    // Dynamic options
    private $dynamic_options = array('next_invoice_number', 'next_estimate_number');
    // Show or hide setup menu
    private $show_setup_menu = true;
    // Currently reminders
    private $available_reminders = array(
        'customer','lead','estimate','invoice','proposal'
        );
    private $tables_with_currency = array();
    // Media folder
    private $media_folder;

    function __construct()
    {
        $this->_instance =& get_instance();
        if ($this->_instance->config->item('installed') == true) {
            $options = $this->_instance->db->get('tbloptions')->result_array();
            foreach ($options as $option) {
                $this->options[$option['name']] = $option['value'];
            }

            $this->tables_with_currency = array(
                array(
                    'table'=>'tblinvoices',
                    'field'=>'currency',
                    ),
                array(
                    'table'=>'tblexpenses',
                    'field'=>'currency',
                    ),
                 array(
                    'table'=>'tblproposals',
                    'field'=>'currency',
                    ),
                 array(
                    'table'=>'tblestimates',
                    'field'=>'currency',
                    ),
                array(
                    'table'=>'tblclients',
                    'field'=>'default_currency',
                    ),
                );

            $this->media_folder = do_action('before_set_media_folder','media');
        }
    }
    public function get_table_data($table, $params = array())
    {
        $hook_data = do_action('before_render_table_data', array(
            'table' => $table,
            'params' => $params
        ));
        foreach ($hook_data['params'] as $key => $val) {
            $$key = $val;
        }
        $table = $hook_data['table'];
        if (file_exists(VIEWPATH . 'admin/tables/my_' . $table . '.php')) {
            include_once(VIEWPATH . 'admin/tables/my_' . $table . '.php');
        } else {
            include_once(VIEWPATH . 'admin/tables/' . $table . '.php');
        }
       echo json_encode($output);
        die;
    }
    public function get_available_reminders_keys(){
        return $this->available_reminders;
    }
    public function get_options()
    {
        return $this->options;
    }
    public function get_option($name)
    {
        if (isset($this->options[$name])) {
            if (in_array($name, $this->dynamic_options)) {
                $this->_instance->db->where('name', $name);
                return $this->_instance->db->get('tbloptions')->row()->value;
            } else {
                return $this->options[$name];
            }
        }
        return '';
    }

    public function add_quick_actions_link($item = array())
    {
        $this->quick_actions[] = $item;
    }
    public function get_quick_actions_links()
    {
        $this->quick_actions = do_action('before_build_quick_actions_links', $this->quick_actions);
        return $this->quick_actions;
    }
    public function get_contact_permissions()
    {
        $permissions = array(
            array(
                'id' => 1,
                'name' => _l('customer_permission_invoice'),
                'short_name' => 'invoices'
            ),
            array(
                'id' => 2,
                'name' => _l('customer_permission_estimate'),
                'short_name' => 'estimates'
            ),
            array(
                'id' => 3,
                'name' => _l('customer_permission_contract'),
                'short_name' => 'contracts'
            ),
            array(
                'id' => 4,
                'name' => _l('customer_permission_proposal'),
                'short_name' => 'proposals'
            ),
            array(
                'id' => 5,
                'name' => _l('customer_permission_support'),
                'short_name' => 'support'
            ),
            array(
                'id'=>6,
                'name'=>_l('customer_permission_projects'),
                'short_name'=>'projects'
                ),
        );
        return do_action('get_contact_permissions', $permissions);
    }
    public function set_setup_menu_visibility($total_setup_menu_items){
        if($total_setup_menu_items == 0){
            $this->show_setup_menu = false;
        } else {
            $this->show_setup_menu = true;
        }
    }
    public function show_setup_menu(){
        return $this->show_setup_menu;
    }
    public function get_tables_with_currency(){
        return $this->tables_with_currency;
    }
    public function get_media_folder(){
        return $this->media_folder;
    }
}

