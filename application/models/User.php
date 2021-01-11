<?php


class User extends CI_Model
{
    function __construct()
    {
        $this->load->database();
        parent::__construct();
    }

    public function getSiteLogo()
    {
        $this->db->select('logo');
        $this->db->where('id', '1');
        $this->db->from('admin_option');
        $query_banner_data = $this->db->get();
        $query_banner_data->num_rows;
        return $query_banner_data->result_array();
    }

    function userLogin($email, $password)
    {
        //setting cookie

        //echo "okk"; exit;
        /*$email = $this->input->post('email');
        $password = md5($this->input->post('password'));*/
        //$user_password = md5($this->input->post('member_password'));
        //setting cookie
        $this->db->select('*');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('status', 'Active');
        $this->db->from('user');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $result = $query->num_rows();
        //print_r($result); die;
        if ($query->num_rows() == 0) {
            return false;
        } else {
            $data = $query->result_array();
            $user_email = $data[0]['email'];
            $user_id = $data[0]['id'];
            $user_f_name = $data[0]['first_name'];
            $user_l_name = $data[0]['last_namme'];
            $user_type = $data[0]['user_type'];
            $user_image = $data[0]['image'];

            $this->session->set_userdata('email', $user_email);
            $this->session->set_userdata('id', $user_id);
            $this->session->set_userdata('f_name', $user_f_name);
            $this->session->set_userdata('l_name', $user_l_name);
            $this->session->set_userdata('user_type', $user_type);
            $this->session->set_userdata('image', $user_image);
            $this->session->set_userdata('is_logged_in', TRUE);
            return true;
        }

    }


    /*
     * Home dashboard Data
     * */
    function getAdminData()
    {
        //echo 1;exit;

        $this->db->select('*');
        $this->db->where('user_type', 'admin');
        $this->db->from('user');
        $query_row_data = $this->db->get();
        return $admin_option = $query_row_data->result_array();
    }

    function getAllActiveCases()
    {
        //echo 1;exit;
        $this->db->select('status');
        $this->db->where('status', 'Active');
        $this->db->from('cases');
        $query_active_data = $this->db->get();
        return $query_active_data->num_rows;

    }

    function getAllCompletedCases()
    {
        //echo 1;exit;
        $this->db->select('status');
        $this->db->where('status', 'Closed');
        $this->db->from('cases');
        $query_active_data = $this->db->get();
        return $query_active_data->num_rows;

    }

    function getAllPendingCases()
    {
        //echo 1;exit;
        $this->db->select('status');
        $this->db->where('status', 'Pending');
        $this->db->from('cases');
        $query_active_data = $this->db->get();
        return $query_active_data->num_rows;

    }

    function getCasesListDetails()
    {
        $this->db->select('*');
        $this->db->from('cases');
        $query_active_data = $this->db->get();
        $data = $query_active_data->result_array();
        return $data;
    }

    /*
     * Cases details and hearing details
     * */
    function getCasesDetailsById($id)
    {
        $this->db->select('*');
        $this->db->from('cases');
        $this->db->where('id', $id);
        $query_active_data = $this->db->get();
        $data = $query_active_data->result_array();
        return $data;
    }

    function getHearingDetailsByCaseId($caseId){
        $this->db->select('*');
        $this->db->from('case_hearing');
        $this->db->where('case_id', $caseId);
        $query_active_data = $this->db->get();
        $data = $query_active_data->result_array();
        return $data;

    }



    /*
     * cases
     * */

    function insertCaseDetails($data)
    {
        if ($this->db->insert('cases', $data)) {
            return true;
        }

        return false;
    }


    function deleteCaseById($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete('cases')) {
            return true;
        }

        return false;
    }

    /*
     * case hearing
     * */
    function insertCaseHearingDetails($data)
    {
        if ($this->db->insert('case_hearing', $data)) {
            return true;
        }

        return false;
    }


    /*
     *
     * case images
     * */


    function insertCaseImages($data){
        if ($this->db->insert('image_files', $data)) {
            return true;
        }

        return false;
    }

    function getImagesByCaseId($id){

        //$where = "image_of ='Cases' AND image_of_id='".$id."' ";
        $this->db->select('*');
        $this->db->where('image_of','Cases');
        $this->db->where('image_of_id',$id);
        $this->db->from('image_files');
        $query_active_data = $this->db->get();
        $data = $query_active_data->result_array();
        return $data;
    }
}