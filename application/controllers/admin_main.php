<?php


class Admin_main extends CI_Controller
{
     function __construct()
    {
        //echo "Prak"; exit;
        parent::__construct();
        $this->load->model('User');
        $this->load->library('session');
    }

    function index()
    {


        if($this->input->server('REQUEST_METHOD') === 'POST')
        {

            $user_email = $this->input->post('email');
            $password = md5($this->input->post('password'));


            $is_valid = $this->User->userLogin($user_email,$password);

            if(!empty($is_valid))
            {

                redirect('go_home');
            }
            else // incorrect username or password
            {
                //echo "called";
                $data['flash_message'] =FALSE;
                //$this->load->view('');
            }
        }
            $data['site_logo'] = $this->User->getSiteLogo();
            $this->load->view('admin/login', $data);


    }

    function go_home()
    {
        //$this->load->model('User');
        $userdata=$this->session->all_userdata();
        @$user_type=$userdata['user_type'];
        @$user_id=$userdata['id'];
        if($user_id=='')
        {
            redirect('admin_main');
        }

        $data['results'] = $this->User->getCasesListDetails();
        $data['main_content'] = 'admin/home';
        $this->load->view('includes/template', $data);
    }

    public function add_new_case(){

        $data['main_content'] = 'admin/add_new_case';
        $this->load->view('includes/template', $data);
    }

    public function submit_case_details(){

        $userdata=$this->session->all_userdata();
        @$user_id=$userdata['id'];
        if($user_id=='')
        {
            redirect(base_url());
        }


        $duration = "0";
        $cases_arr=array(
            'case_name'=>$this->input->post('case_name'),
            'case_type'=>$this->input->post('case_type'),
            'against'=>$this->input->post('case_against'),
            'lawyer_name'=>$this->input->post('lawyer_name'),
            'lawyer_contact_no'=>$this->input->post('phone'),
            'case_district'=>$this->input->post('case_district'),
            'region'=>$this->input->post('case_region'),
            'starting_date'=>$this->input->post('starting_date'),
            'ending_date'=>$this->input->post('ending_date'),
            'duration'=>$this->$duration,
            'status'=>$this->input->post('case_status'),
            'remarks'=>$this->input->post('remarks'));

        if($this->User->insertCaseDetails($cases_arr))
        {
            $data['flash_message'] =TRUE;
            $this->add_new_case();
        }
        else{

            $data['flash_message'] =FALSE;
        }

    }

    public function add_case_hearing(){

         if ($this->input->server('REQUEST_METHOD')=='POST'){


         }

        $data['cases'] = $this->User->getCasesListDetails();
        $data['main_content'] = 'admin/add_case_hearing';
        $this->load->view('includes/template', $data);

    }

    function update_multiple_images()
    {

        if($_FILES["case_image"]["name"] != '')
        {
            $config["upload_path"] = '../uploads/images/';
            $config["allowed_types"] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            //$img_array=array();

            for($count = 0; $count<count($_FILES["case_image"]["name"]); $count++)
            {
                $time=time();
                // $date = date("Y-m-d H:i:s");
                $_FILES["case_image"]["name"] = $time."_".$_FILES["case_image"]["name"][$count];
                $_FILES["case_image"]["type"] = $_FILES["case_image"]["type"][$count];
                $_FILES["case_image"]["tmp_name"] = $_FILES["case_image"]["tmp_name"][$count];
                $_FILES["case_image"]["error"] = $_FILES["case_image"]["error"][$count];
                $_FILES["case_image"]["size"] = $_FILES["case_image"]["size"][$count];
                if($this->upload->do_upload('case_image'))
                {
                    $data = $this->upload->data();
                    //array_push($img_array,$data["file_name"]);

                }
            }
            echo $eeeeee =json_encode($img_array);exit;
            $add_img=array(
                "$image_id"=>$data["file_name"]
            );
            $new_imag = $data["file_name"];
            foreach($old_data as $key=>$v)
            {
                if($key==$image_id)
                {
                    $old_data[$key]=$new_imag;
                }
            }

            //print_r($old_data);
            $new_update = json_encode($old_data);
            $upadte_data=array(
                'product_image'=>$new_update
            );
            print_r($upadte_data);//exit;

            //$new_array=perform_changes_on($aaaa,$add_img);
            //print_r($new_array);

        }


    }

}