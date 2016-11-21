<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class purchase_model extends CRM_Model
{
    private $statuses = array(1, 2, 5, 3, 4);
    function __construct()
    {
        parent::__construct();
    }

    public function get_statuses()
    {
        return $this->statuses;
    }

    public function add($data)
    {
        $purchase =   array();
        if($this->input->post('reference') != null)
            $purchase['reference'] = $data['reference'];
        else
            $data['reference'] = 'ko';
        if($this->input->post('titre') != null)
             $data['titre'] ;
        else
            $data['titre'] = 'ko';
        if($this->input->post('TVA') != null)
            $data['TVA'] = $this->input->post('TVA');
        else
            $data['TVA']= 0;
        if($this->input->post('montant') != null)
            $data['montant'] = $this->input->post('montant');
        else
            $data['montant'] = 0;

        if($this->input->post('purchase_file') != null)
        {
            // le nom du fichier
            $purchase_file = $this->input->post('purchase_file');

        }


        $data['id_project'] = $this->input->post('id');
        $this->db->insert('tblpurchase', $data);
        $purchaseid = $this->db->insert_id();
        return $purchaseid;
    }

    public function get($id)
    {
        $this->db->where('id_project', $id);
        return $this->db->get('tblpurchase')->result_array();
    }
    public function get_purchase_files()
    {
        return $this->db->get('tblpurchase_file')->result_array();
    }
    public function get_file($id)
    {
        $this->db->where('id_purchase', $id);
        return $this->db->get('tblpurchase_file')->result_array();
    }
}
