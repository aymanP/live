<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoice_items extends Admin_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('invoice_items_model');

    }
    /* List all available items */
    public function index()
    {
        if (!is_admin()) {
            access_denied('Invoice Items');
        }
        if ($this->input->is_ajax_request()) {
            $this->perfex_base->get_table_data('invoice_items');
        }
        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $data['title'] = _l('invoice_items');
        $this->load->view('admin/invoice_items/manage', $data);
    }
    /* Edit or update items / ajax request /*/
    public function manage()
    {
        if (is_admin()) {
            if ($this->input->post()) {
                $data = $this->input->post();
                if ($data['itemid'] == '') {
                    $success = $this->invoice_items_model->add($data);
                    $message = '';
                    if ($success) {
                        $message = _l('added_successfuly', _l('invoice_item'));
                    }
                    echo json_encode(array(
                        'success' => $success,
                        'message' => $message
                        ));
                } else {
                    $success = $this->invoice_items_model->edit($data);
                    $message = '';
                    if ($success) {
                        $message = _l('updated_successfuly', _l('invoice_item'));
                    }
                    echo json_encode(array(
                        'success' => $success,
                        'message' => $message
                        ));
                }
            }
        }
    }
    /* Delete item*/
    public function delete($id)
    {
        if (!is_admin()) {
            access_denied('Invoice Items');
        }

        if (!$id) {
            redirect(admin_url('invoice_items'));
        }
        $response = $this->invoice_items_model->delete($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', _l('invoice_item_lowercase')));
        } else if ($response == true) {
            set_alert('success', _l('deleted', _l('invoice_item')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('invoice_item_lowercase')));
        }
        redirect(admin_url('invoice_items'));
    }
    /* Get item by id / ajax */
    public function get_item_by_id($id)
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->invoice_items_model->get($id));
        }
    }
    /* Get all items */
    public function get_all_items_ajax()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->invoice_items_model->get_all_items_ajax());
        }
    }
}
