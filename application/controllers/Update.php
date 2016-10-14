<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Update extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if (!is_really_writable(APPPATH . 'config/config.php')) {
            show_error('/config/config.php file is not writable. You need to change the permissions to 755');
            die;
        }
        $base_url = $this->config->item('base_url');
        if ($base_url == '') {
            show_error('Please set base url in application/config/config.php. This should be the url where Perfex CRM is installed. Typically this will be your base URL, WITH a trailing slash');
            die;
        }
        $this->load->library('migration');
        if ($this->migration->current() === FALSE) {
            show_error($this->migration->error_string());
        } else {
            echo '<h1>Your database is up to date</h1>';
        }
    }
}
