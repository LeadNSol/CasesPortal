<?php


class Property_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        parent::__construct();
    }

    function insertHibaNamaDetails($hibaNamaArr){
        if ($this->db->insert('hiba_nama', $hibaNamaArr)) {
            return true;
        }

        return false;
    }

    function getHibaNamaList(){
        $this->db->select('*');
        $this->db->from('hiba_nama');
        $query_active_data = $this->db->get();
        $data = $query_active_data->result_array();
        return $data;
    }

    function getHibaNamaById($id){
        $this->db->select('*');
        $this->db->from('hiba_nama');
        $this->db->where('h_id',$id);
        $query_active_data = $this->db->get();
        $data = $query_active_data->result_array();
        return $data;
    }


}