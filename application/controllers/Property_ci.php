<?php


class Property_ci extends CI_Controller
{

    public function __construct()
    {
        //echo "Prak"; exit;
        parent::__construct();
        $this->load->model('Property_model');
        $this->load->model('User');
        $this->load->library('session');
    }

    public function load_hiba_nama()
    {

        $data['main_content'] = 'property/add_hibba_nama';
        $this->load->view('includes/template', $data);
    }

    public function add_hiba_nama_details(){
        if (!empty($_FILES['hiba_nama_images']['name']) && count(array_filter($_FILES['hiba_nama_images']['name'])) > 0) {
            $imagesCount = count($_FILES['hiba_nama_images']['name']);

            for ($i = 0; $i < $imagesCount; $i++) {
                $_FILES['file']['name'] = $_FILES['hiba_nama_images']['name'][$i];
                $_FILES['file']['type'] = $_FILES['hiba_nama_images']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['hiba_nama_images']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['hiba_nama_images']['error'][$i];
                $_FILES['file']['size'] = $_FILES['hiba_nama_images']['size'][$i];

                // File upload configuration
                $uploadPath = 'uploads/images/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000'; // max_size in kb
                //$config['max_width'] = '1024';
                //$config['max_height'] = '768';
                $config['file_name'] = $_FILES['hiba_nama_images']['name'][$i];

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {

                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $uploadData[$i] = $fileData['file_name'];
                    //$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");

                } else {
                    $data['flash_message'] = FALSE;
                }
            }
            if (!empty($uploadData)) {
                $imageFiles = json_encode($uploadData);

                $hearing_arr = array(
                    'relation' => $this->input->post('from_relation'),
                    'hiba_nama_date' => $this->input->post('hiba_nama_date'),
                    'remarks' => $this->input->post('remarks'),
                    'images' => $imageFiles
                );

                if ($this->Property_model->insertHibaNamaDetails($hearing_arr)) {
                    $data['flash_message'] = TRUE;
                    $this->load_hiba_nama();
                } else {
                    $data['flash_message'] = FALSE;
                }

            } else{
                $data['flash_message'] = FALSE;
            }
        }else{
            $data['flash_message'] = FALSE;
        }
    }


    public function list_hiba_nama_details(){

        $data['hibaNamaList'] = $this->Property_model->getHibaNamaList();
        $data['main_content'] = 'property/list_hiba_nama';
        $this->load->view('includes/template', $data);
    }


    /*
     * Edit and Update Hiba nnama
     * */

    public function edit_hiba_nama($id){

        $data['hibaNama'] = $this->Property_model->getHibaNamaById($id);
        $data['main_content'] = 'property/edit_hibba_nama';
        $this->load->view('includes/template', $data);

    }
}