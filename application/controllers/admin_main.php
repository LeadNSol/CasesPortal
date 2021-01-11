<?php


class Admin_main extends CI_Controller
{
    function __construct()
    {
        //echo "Prak"; exit;
        parent::__construct();
        $this->load->model('User');
        $this->load->library('session');
        date_default_timezone_set('Asia/Karachi');
    }

    /* login*/
    function index()
    {


        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $user_email = $this->input->post('email');
            $password = md5($this->input->post('password'));


            $is_valid = $this->User->userLogin($user_email, $password);

            if (!empty($is_valid)) {

                redirect('go_home');
            } else // incorrect username or password
            {
                //echo "called";
                $data['flash_message'] = FALSE;
                //$this->load->view('');
            }
        }
        $data['site_logo'] = $this->User->getSiteLogo();
        $this->load->view('admin/login', $data);


    }

    /*
     * cases
     * */

    public function go_home()
    {
        //$this->load->model('User');
        $userdata = $this->session->all_userdata();
        @$user_type = $userdata['user_type'];
        @$user_id = $userdata['id'];
        if ($user_id == '') {
            redirect('admin_main');
        }

        $data['results'] = $this->User->getCasesListDetails();
        $data['main_content'] = 'admin/home';
        $this->load->view('includes/template', $data);
    }

    public function add_new_case()
    {

        $data['main_content'] = 'admin/add_new_case';
        $this->load->view('includes/template', $data);
    }

    public function submit_case_details()
    {

        $userdata = $this->session->all_userdata();
        @$user_id = $userdata['id'];
        if ($user_id == '') {
            redirect(base_url());
        }
        $startingDate = $this->input->post('starting_date');
        $endingDate = $this->input->post('ending_date');
        if(!empty($endingDate) && isset($endingDate)){

        }

        $cases_arr = array(
            'case_name' => $this->input->post('case_name'),
            'case_type' => $this->input->post('case_type'),
            'against' => $this->input->post('case_against'),
            'lawyer_name' => $this->input->post('lawyer_name'),
            'lawyer_contact_no' => $this->input->post('phone'),
            'case_district' => $this->input->post('case_district'),
            'region' => $this->input->post('region'),
            'starting_date' => $this->input->post('starting_date'),
            'ending_date' => $this->input->post('ending_date'),
            'duration' => $this->$duration,
            'status' => $this->input->post('case_status'),
            'remarks' => $this->input->post('remarks'));

        if ($this->User->insertCaseDetails($cases_arr)) {
            $data['flash_message'] = TRUE;
            $this->add_new_case();
        } else {

            $data['flash_message'] = FALSE;
        }

    }


    /*
     * view Case details
     * */
    public function view_case_details($id)
    {
        $userdata = $this->session->all_userdata();
        @$user_type = $userdata['user_type'];
        @$user_id = $userdata['id'];
        if ($user_id == '') {
            redirect('admin_main');
        }
        $data['caseImages'] = $this->User->getImagesByCaseId($id);
        $data['hearingDetails'] = $this->User->getHearingDetailsByCaseId($id);
        $data['caseArr'] = $this->User->getCasesDetailsById($id);
        $data['main_content'] = 'admin/view_case_details';
        $this->load->view('includes/template', $data);

    }

    /*
     * Case images or Files
     * */

    public function load_case_images_view()
    {


        $data['cases'] = $this->User->getCasesListDetails();
        $data['main_content'] = 'admin/add_case_images';
        $this->load->view('includes/template', $data);

    }

    public function submit_case_images()
    {
        if (!empty($_FILES['case_images']['name']) && count(array_filter($_FILES['case_images']['name'])) > 0) {
            $imagesCount = count($_FILES['case_images']['name']);

            for ($i = 0; $i < $imagesCount; $i++) {
                $_FILES['file']['name'] = $_FILES['case_images']['name'][$i];
                $_FILES['file']['type'] = $_FILES['case_images']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['case_images']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['case_images']['error'][$i];
                $_FILES['file']['size'] = $_FILES['case_images']['size'][$i];

                // File upload configuration
                $uploadPath = 'uploads/images/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000'; // max_size in kb
                //$config['max_width'] = '1024';
                //$config['max_height'] = '768';
                $config['file_name'] = $_FILES['case_images']['name'][$i];

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

                $images_arr = array(
                    'image_of' => "Cases",
                    'image_of_id' => $this->input->post('case_id'),
                    'created_date' => date('d-m-Y h:i:sa'),
                    'images' => $imageFiles
                );

                if ($this->User->insertCaseImages($images_arr)) {
                    $data['flash_message'] = TRUE;
                    $this->load_case_images_view();
                } else {
                    $data['flash_message'] = FALSE;
                }

            } else {
                $data['flash_message'] = FALSE;
            }
        } else {
            $data['flash_message'] = FALSE;
        }
    }

    /*
     * delete and update case
     * */
    public function delete_case($id)
    {
        if ($this->User->deleteCaseById($id)) {
            $data['flash_message'] = TRUE;
        } else {
            $data['flash_message'] = FALSE;
        }

        $this->go_home();
    }


    /*
     * Case Hearing
     * */

    public function add_case_hearing()
    {
        $userdata = $this->session->all_userdata();
        @$user_id = $userdata['id'];
        if ($user_id == '') {
            redirect(base_url());
        }


        $data['cases'] = $this->User->getCasesListDetails();
        $data['main_content'] = 'admin/add_case_hearing';
        $this->load->view('includes/template', $data);

    }

    public function add_case_hearing_details()
    {

        if (!empty($_FILES['case_images']['name']) && count(array_filter($_FILES['case_images']['name'])) > 0) {
            $imagesCount = count($_FILES['case_images']['name']);

            for ($i = 0; $i < $imagesCount; $i++) {
                $_FILES['file']['name'] = $_FILES['case_images']['name'][$i];
                $_FILES['file']['type'] = $_FILES['case_images']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['case_images']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['case_images']['error'][$i];
                $_FILES['file']['size'] = $_FILES['case_images']['size'][$i];

                // File upload configuration
                $uploadPath = 'uploads/images/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000'; // max_size in kb
                //$config['max_width'] = '1024';
                //$config['max_height'] = '768';
                $config['file_name'] = $_FILES['case_images']['name'][$i];

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
                $images_arr = array(
                    'image_of' => "Cases",
                    'image_of_id' => $this->input->post('case_id'),
                    'created_date' => date('d-m-Y h:i:sa'),
                    'images' => $imageFiles
                );

                if ($this->User->insertCaseImages($images_arr)) {
                    $data['flash_message'] = TRUE;
                    $hearing_arr = array(
                        'case_id' => $this->input->post('case_id'),
                        'hearing_date' => $this->input->post('hearing_date'),
                        'remarks' => $this->input->post('remarks')
                    );
                    if ($this->User->insertCaseHearingDetails($hearing_arr)) {
                        $data['flash_message'] = TRUE;
                        $this->add_case_hearing();
                    } else {
                        $data['flash_message'] = FALSE;
                    }
                } else {
                    $data['flash_message'] = FALSE;
                }




            } else {
                $data['flash_message'] = FALSE;
            }
        } else {
            $data['flash_message'] = FALSE;
        }
    }

}