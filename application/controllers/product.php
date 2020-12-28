<?php
//print_r($main_content);exit;
/*class Main extends Secure_area */

//require_once APPPATH.'libraries/facebook/facebook.php';
//require_once APPPATH."/libraries/PHPExcel.php";
//require_once APPPATH."/libraries/excel.php";

class Product extends CI_Controller
{
	/*
	Controllers that are considered secure extend Main, optionally a $module_id can
	be set to also check if a user can access a particular module in the system.
	*/
	public function __construct()
	{
		//$this->load->model('files');
		//echo "Prak"; exit;
		parent::__construct();
		$this->load->model('module');
		$this->load->model('apps_model');
		$this->load->model('product_module');
		$this->load->library('pagination');
		$this->load->library('session');
		date_default_timezone_set('Asia/Kolkata');
      //  $this->load->model('files');
      
        /*if(!$this->session->userdata('is_logged_in')){
          redirect(base_url());
        }*/
	}
	
	

	function index()
	{

	}
	function edit_contactus ()
	{
      $id=$this->uri->segment(2);
	  $userdata=$this->session->all_userdata();
      @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 if($this->input->server('REQUEST_METHOD')=='POST')
		{
		    
		    $update_cateorgy=array(
		        'description'=>$this->input->post('description'),
				'title'=>$this->input->post('title'),
				'email'=>$this->input->post('email')
				);
				if($ffff=$this->product_module->update_contacts($id,$update_cateorgy))
				{
					$data['flash_message'] =TRUE;
				}
				else{
					$data['flash_message'] =FALSE;
				}
		            $data['results'] = $this->product_module->list_contact_details();
                    $data['main_content'] = 'admin/list_contactus';
                    $this->load->view('includes/template', $data);
		    
		}
		$data['get_contacts'] = $this->product_module->get_contacts($id);
		
        $data['main_content'] = 'admin/edit_contactus';
        $this->load->view('includes/template', $data);
	}
	function edit_chapter_name()
	{
      $id=$this->uri->segment(2);
	  $userdata=$this->session->all_userdata();
      @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 if($this->input->server('REQUEST_METHOD')=='POST')
		{
		    	$cat_arr=array(
				'chapter_name'=>$this->input->post('name'),
				'classs_id'=>$this->input->post('class_id'),
				'sub_id'=>$this->input->post('sub_id')
					);

				if($insert_home=$this->product_module->update_chapter_name($id,$cat_arr))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
				    }
		           $data['results'] = $this->product_module->get_chapter_name_list();
        $data['main_content'] = 'admin/list_chaptername';
        $this->load->view('includes/template', $data);
		}
		$data['get_chapter_name'] = $this->product_module->get_chapter_name_list_byid($id);
//echo"<pre>";
//print_r($data['get_chapter_name']);exit;
       	$data['results'] = $this->product_module->get_class();
		 $data['main_content'] = 'admin/edit_chapter_name';
         $this->load->view('includes/template', $data);
	}
	
	
	public function delete_chapter_name()
    {
        $id=$this->uri->segment(2);
	  $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 
     $this->product_module->delete_chapter_name($id);

    
		  $data['results'] = $this->product_module->get_chapter_name_list();
    	$data['main_content'] = 'admin/list_chaptername';
        $this->load->view('includes/template', $data);
    }


function list_contact_details(){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

	 {
         $data['results'] = $this->product_module->list_contact_details();
		
        $data['main_content'] = 'admin/list_contactus';
        $this->load->view('includes/template', $data);
    }
}
function list_user_qureys()
	 {
       $userdata=$this->session->all_userdata();
       @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	    $data['results'] = $this->product_module->list_user_qureys();
	    
	    //echo "<pre>";
	    //print_r($data['results']);exit;
        $data['main_content'] = 'admin/list_qureys';
        $this->load->view('includes/template', $data);
    }
    function list_order()
	 {
       $userdata=$this->session->all_userdata();
       @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	    $data['results'] = $this->product_module->list_order();
        $data['main_content'] = 'admin/list_orders';
        $this->load->view('includes/template', $data);
    }
function list_message(){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

	 {
         $data['results'] = $this->product_module->get_message_list();
		
        $data['main_content'] = 'admin/list_user';
        $this->load->view('includes/template', $data);
    }
}



function add_service()
	{ 

		$userdata=$this->session->all_userdata();
        @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

		$data['main_content'] = 'admin/add_service';
        $this->load->view('includes/template', $data);


	}

function add_service_details()
		{

		$userdata=$this->session->all_userdata();
        @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('images/')) {
						umask(0);
						mkdir('images/',0777);
					}

					$time=time();
					$config['upload_path'] = 'images/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']           = 400;
						$config['new_image']       =    'images/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']          = 400;
						$config['new_image']       =    'images/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}

		   $cat_arr=array(
				'title'=>$this->input->post('title'),
				'description'=>$this->input->post('description'),
				'image'=>$UploadFile
					);

				if($insert_home=$this->product_module->add_service_details($cat_arr))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
					}
				$data['main_content'] = 'admin/add_service';
       		$this->load->view('includes/template', $data);

		}
}

 function list_service(){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

	 {
         $data['results'] = $this->product_module->get_service_list();
		
        $data['main_content'] = 'admin/list_service';
        $this->load->view('includes/template', $data);
    }
}


   function edit_service($id){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
   	 $data['get_service']=$this->product_module->get_service_byid($id);

    $data['main_content'] = 'admin/edit_service';
        $this->load->view('includes/template', $data);

   }

	function update_service1($id)
	{

	 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('images/')) {
						umask(0);
						mkdir('images/',0777);
					}

					$time=time();
					$config['upload_path'] = 'images/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']           = 400;
						$config['new_image']       =    'images/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']          = 400;
						$config['new_image']       =    'images/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}

				   }

				$update_cateorgy=array(
				'description'=>$this->input->post('description'),
				'title'=>$this->input->post('title'),
				
				'image'=>$UploadFile
				);

            

				if($ffff=$this->product_module->update_service($id,$update_cateorgy))
				{
					$data['flash_message'] =TRUE;
				}
				else{
					$data['flash_message'] =FALSE;
				}
		 $data['results'] = $this->product_module->get_service_list();
        $data['main_content'] = 'admin/list_service';
        $this->load->view('includes/template', $data);
}


public function delete_service_details($id)
    {
	  $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 
     $this->product_module->delete_service_details($id);
		 	
		 $data['results'] = $this->product_module->get_service_list();
        $data['main_content'] = 'admin/list_service';
        $this->load->view('includes/template', $data);
    }

    function add_user()
	{ 

		$userdata=$this->session->all_userdata();
        @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
        $data['results'] = $this->product_module->get_class();
		$data['main_content'] = 'admin/add_user';
        $this->load->view('includes/template', $data);


	}

function add_user_details()
		{

		$userdata=$this->session->all_userdata();
        @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	/*if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('images/')) {
						umask(0);
						mkdir('images/',0777);
					}

					$time=time();
					$config['upload_path'] = 'images/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']           = 400;
						$config['new_image']       =    'images/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']          = 400;
						$config['new_image']       =    'images/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}*/

		   $cat_arr=array(
				'Class_id'=>$this->input->post('class_id'),
				'first_name'=>$this->input->post('fast_name'),
				'last_name'=>$this->input->post('last_name'),
				'email'=>$this->input->post('email'),
				'phone'=>$this->input->post('phone'),
				'password'=>$this->input->post('password'),
				'login_type'=>$this->input->post('login_type'),
				'social_key'=>$this->input->post('social_key'),
				'mac_id'=>$this->input->post('mac_id')
				//'user_image'=>$UploadFile
					);

				if($insert_home=$this->product_module->add_user_details($cat_arr))
				{
				  redirect('add_user');
				   
				   	//	$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
					}
			$data['main_content'] = 'admin/add_user';
       		$this->load->view('includes/template', $data);
            //}
		
}

 function list_user(){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

	 {
         $data['results'] = $this->product_module->get_user_list();
		
        $data['main_content'] = 'admin/list_user';
        $this->load->view('includes/template', $data);
    }
}


   function edit_user($id){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
   	 $data['get_user']=$this->product_module->get_user_byid($id);

    $data['main_content'] = 'admin/edit_user';
        $this->load->view('includes/template', $data);

   }

	function update_user($id)
	{

	 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

/*if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('images/')) {
						umask(0);
						mkdir('images/',0777);
					}

					$time=time();
					$config['upload_path'] = 'images/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']           = 400;
						$config['new_image']       =    'images/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']          = 400;
						$config['new_image']       =    'images/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}

				   }*/

				$update_cateorgy=array(
				'first_name'=>$this->input->post('fast_name'),
				'last_name'=>$this->input->post('last_name'),
				'email'=>$this->input->post('email'),
				'phone'=>$this->input->post('phone'),
				'password'=>$this->input->post('password'),
				'login_type'=>$this->input->post('login_type'),
				'social_key'=>$this->input->post('social_key'),
				'mac_id'=>$this->input->post('mac_id')
				//'user_image'=>$UploadFile
				);

            

				if($ffff=$this->product_module->update_user($id,$update_cateorgy))
				{
					$data['flash_message'] =TRUE;
				}
				else{
					$data['flash_message'] =FALSE;
				}
		 $data['results'] = $this->product_module->get_user_list();
        $data['main_content'] = 'admin/list_user';
        $this->load->view('includes/template', $data);
}


public function delete_user_details($id)
    {
	  $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 
     $this->product_module->delete_user_details($id);
		 	
		 $data['results'] = $this->product_module->get_user_list();
        $data['main_content'] = 'admin/list_user';
        $this->load->view('includes/template', $data);
    }


function add_project()
	{ 

		$userdata=$this->session->all_userdata();
        @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

		$data['main_content'] = 'admin/add_project';
        $this->load->view('includes/template', $data);


	}

function add_project_details()
		{

		$userdata=$this->session->all_userdata();
        @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	

		   $cat_arr=array(
				'title'=>$this->input->post('title'),
				'description'=>$this->input->post('description')
				
					);

				if($insert_home=$this->product_module->add_privacy_details($cat_arr))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
					}
				$data['main_content'] = 'admin/add_project';
       		$this->load->view('includes/template', $data);

		
}

 function list_project(){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

	 {
         $data['results'] = $this->product_module->get_privacy_list();
		
        $data['main_content'] = 'admin/list_privacy';
        $this->load->view('includes/template', $data);
    }
}


   function edit_project($id){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
   	 $data['get_service']=$this->product_module->get_privacy_byid($id);

    $data['main_content'] = 'admin/edit_privacy';
        $this->load->view('includes/template', $data);

   }

	function update_project($id)
	{

	 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
				$update_cateorgy=array(
				'description'=>$this->input->post('description'),
				'title'=>$this->input->post('title')
				
				
				);

            

				if($ffff=$this->product_module->update_privacy($id,$update_cateorgy))
				{
					$data['flash_message'] =TRUE;
				}
				else{
					$data['flash_message'] =FALSE;
				}
		 $data['results'] = $this->product_module->get_privacy_list();
        $data['main_content'] = 'admin/list_privacy';
        $this->load->view('includes/template', $data);
}


public function delete_project_details($id)
    {
	  $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 
     $this->product_module->delete_privacy_details($id);
		 	
		 $data['results'] = $this->product_module->get_privacy_list();
        $data['main_content'] = 'admin/list_privacy';
        $this->load->view('includes/template', $data);
    }


function add_testmonials()
	{ 
		 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

		 $data['main_content'] = 'admin/add_testmonials';
         $this->load->view('includes/template', $data);

	}
	function add_testmonials_details()
		{
			 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	
		   $cat_arr=array(
				'description'=>$this->input->post('description'),
				'title'=>$this->input->post('title')
					);

				if($insert_home=$this->product_module->add_testmonials_details($cat_arr))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
				}

			$data['main_content'] = 'admin/add_testmonials';
         $this->load->view('includes/template', $data);	
}

 function list_testmonials(){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

	 {
         $data['results'] = $this->product_module->get_testmonials_list();
		
        $data['main_content'] = 'admin/list_testmonials';
        $this->load->view('includes/template', $data);
    }
}


   function edit_testmonials($id){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
   	 $data['get_testmonials']=$this->product_module->get_testmonials_byid($id);

    $data['main_content'] = 'admin/edit_testmonials';
        $this->load->view('includes/template', $data);

   }

	function update_testmonials($id)
	{
	 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
				
				$update_cateorgy=array(
				'description'=>$this->input->post('description'),
				'title'=>$this->input->post('title')
				);

             //echo "<pre>";print_r($update_cateorgy);exit;

				if($ffff=$this->product_module->update_testmonials($id,$update_cateorgy))
				{
					$data['flash_message'] =TRUE;
				}
				else{
					$data['flash_message'] =FALSE;
				}

			$data['results'] = $this->product_module->get_testmonials_list();
		
        $data['main_content'] = 'admin/list_testmonials';
        $this->load->view('includes/template', $data);
}


public function delete_testmonials_details($id)
    {
	  $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 
     $this->product_module->delete_testmonials_details($id);
		 	
			$data['results'] = $this->product_module->get_testmonials_list();
		
        $data['main_content'] = 'admin/list_testmonials';
        $this->load->view('includes/template', $data);
    }


function add_member()
	{ 
		 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
 		$data['results'] = $this->product_module->get_class();
		 $data['main_content'] = 'admin/add_team_member';
         $this->load->view('includes/template', $data);

	}
	
	function add_chapter_details()
		{
			 $userdata=$this->session->all_userdata();
			 @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		
		$cat_arr=array(
				'chapter_name'=>$this->input->post('name'),
				'classs_id'=>$this->input->post('class_id'),
				'sub_id'=>$this->input->post('sub_id')
					);

				if($insert_home=$this->product_module->add_chapter_name($cat_arr))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
				}
		$data['results'] = $this->product_module->get_class();
		 $data['main_content'] = 'admin/add_team_member';
         $this->load->view('includes/template', $data);


		
		}
		
	function add_chapter()
	{ 
		 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		
		
		
		//$data['results'] = $this->product_module->get_class();
 		$data['results'] = $this->product_module->get_class();
		 $data['main_content'] = 'admin/add_chpter_video';
         $this->load->view('includes/template', $data);

	}


	public function fetchsubject()
	{
		 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		    $iddata=$this->input->post('iddata');
   			$class_id = $this->input->post('class_id');
            $getsubject = $this->module->getalltsubject($class_id);
            $get_team=$this->product_module->get_team_byid($iddata);
            
            //print_r($getsubject);die;
              echo '<option value="">Select</option>';
            foreach ($getsubject as $key => $value) {
                if($value['s_id']==$get_team[0]['subject_id']){
                $select_attribute = "selected"; 
                
                }else{
                   $select_attribute = ""; 
                }
			 	echo '<option value="'.$value['s_id'].'" '.$select_attribute.'>'.$value['subject_name'].'</option>';
				}
//'..'selected'.}
	}
	public function fetchchapter()
	{
		 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		
   			$sub_id = $this->input->post('subject_id');
   			$iddata=$this->input->post('iddata');
   			$get_team=$this->product_module->get_team_byid($iddata);
            $getsubject = $this->module->getalltchapter($sub_id);
            //print_r($get_team);die;
              echo'  <option value="">Select</option>';
            foreach ($getsubject as $key => $value) {
                if($value['chapter_name_id']==$get_team[0]['chapter_id_name']){
                $select_attribute = "selected"; 
                }else{
                   $select_attribute = ""; 
                }
			 	echo '<option value="'.$value['chapter_name_id'].'" '.$select_attribute.'>'.$value['chapter_name'].'</option>';
				}

	}



	function add_member_details()
		{
		    echo "jkhkjdhjkhdgjkdghfghjkhsdfjkhjjksdhjksdfhjkhjkhjkhsdkjjhkjhdshjkhhd";die;
		$userdata=$this->session->all_userdata();
     	@$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		$vid=$_FILES['uploadFile']['tmp_name'];
		$img=$_FILES['site_image']['name'];
		echo $vid."jkfdhfdj".$img;die;
		if(!empty($_FILES))
{
	if(is_uploaded_file($_FILES['uploadFile']['tmp_name']))
	{
	sleep(1);
	$time=time();
	$source_path = $_FILES['uploadFile']['tmp_name'];
	$target_path = 'images/' . $_FILES['uploadFile']['name'];
	$video_name1=$_FILES['uploadFile']['name'];
    $config['new_video']='images/'.$time."_".$_FILES['uploadFile']['name'];

 	$fileExtension = strtolower(end(explode('.',$video_name1)));
    $video_name=$time.".".$fileExtension;
 	$newname = 'images/'.$time.".".$fileExtension;
		if(move_uploaded_file($source_path, $newname))
		{
			//echo '<img src="'.$target_path.'" class="img-thumbnail" width="300" height="250" />';
		}
	}
}
	if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('images/')) {
						umask(0);
						mkdir('images/',0777);
					}

					$time=time();
					$config['upload_path'] = 'images/';
					$video_name12=$_FILES['site_image']['name'];
					$fileExtension22 = strtolower(end(explode('.',$video_name12)));
					$config['file_name'] = $time.".".$fileExtension22;//."_".$_FILES['site_image']['name'];

				//	$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']           = 400;
						$config['new_image']       =    'images/'.$time.".".$fileExtension22;
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']          = 400;
						$config['new_image']       =    'images/thumb/'.$time.".".$fileExtension22;
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}

		   $cat_arr=array(
				'chapter_id_name'=>$this->input->post('name'),
				'chapter_name'=>$this->input->post('chapter_name'),
				'description'=>$this->input->post('description'),
				'class_id'=>$this->input->post('class_id'),
				'subject_id'=>$this->input->post('sub_id'),
				'video_title'=>$this->input->post('video_title'),
                'video_name'=>$video_name,
				'chapter_image'=>$UploadFile
					);

				if($insert_home=$this->product_module->add_member_details($cat_arr))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
				}
		
			$data['main_content'] = 'admin/add_chpter_video';
         $this->load->view('includes/template', $data);	
		}
}




 function list_member(){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
         $data['results'] = $this->product_module->get_team_list();
         //print_r($data);exit;
        $data['main_content'] = 'admin/list_team_member';
        $this->load->view('includes/template', $data);
}
function list_chaptername(){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

	 {
         $data['results'] = $this->product_module->get_chapter_name_list();
        $data['main_content'] = 'admin/list_chaptername';
        $this->load->view('includes/template', $data);
    }
}


function edit_member($id){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
   	 $data['get_team']=$this->product_module->get_team_byid($id);
   	 //print_r($data['get_team']);exit;
	$data['results'] = $this->product_module->get_class();
    $data['main_content'] = 'admin/edit_team_member';
        $this->load->view('includes/template', $data);

   }
   function update_member($id)
	{
	 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
			
		if($this->input->post('vid_source_name')!='')
{
	$video_name=$this->input->post('vid_source_name');
	/*if(is_uploaded_file($_FILES['vid_source_name']['tmp_name']))
	{
		$video_name=$this->input->post('vid_source_name');
		/*sleep(1);
	 $source_path = $_FILES['uploadFile']['tmp_name'];
		$target_path = 'images/' . $_FILES['uploadFile']['name'];
	$video_name=$_FILES['uploadFile']['name'];
		if(move_uploaded_file($source_path, $target_path))
		{
			//echo '<img src="'.$target_path.'" class="img-thumbnail" width="300" height="250" />';
		}
	}*/
}else{
	$video_name=$this->input->post('old_videoss');
	
}

if($this->input->post('img_source_name') !="")
				{
					$UploadFile=$this->input->post('img_source_name');
					/*//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('images/')) {
						umask(0);
						mkdir('images/',0777);
					}

					$time=time();
					$config['upload_path'] = 'images/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']           = 400;
						$config['new_image']       =    'images/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']          = 400;
						$config['new_image']       =    'images/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}*/

				   }else {
					$UploadFile=$this->input->post('old_photo', TRUE);
					}
				if($video_name != "" && $UploadFile !=""){
				$update_cateorgy=array(

				'chapter_name'=>$this->input->post('name'),
				'description'=>$this->input->post('description'),
				'class_id'=>$this->input->post('class_id'),
				'subject_id'=>$this->input->post('sub_id'),
				'video_title'=>$this->input->post('video_title'),
                'video_name'=>$video_name,
				'chapter_image'=>$UploadFile
				);

             //echo "<pre>";print_r($update_cateorgy);exit;

				if($ffff=$this->product_module->update_team($id,$update_cateorgy))
				{
					$data['flash_message'] =TRUE;
				}
				else{
					$data['flash_message'] =FALSE;
				}
				}else{
				$data['flash_message'] =FALSE;	
				}
		 $data['results'] = $this->product_module->get_team_list();
		 //$data['results'] = $this->product_module->get_class();
    		$data['main_content'] = 'admin/list_team_member';
        $this->load->view('includes/template', $data);
}


public function delete_member_details($id)
    {
	  $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 
     $this->product_module->delete_member_details($id);

    
		  $data['results'] = $this->product_module->get_team_list();
		 
    		$data['main_content'] = 'admin/list_team_member';
        $this->load->view('includes/template', $data);
    }


    public function delete_chapter_details($id)
    {
	  $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 
     $this->product_module->delete_chapter_details($id);

    
		  $data['results'] = $this->product_module->get_chapter_name_list();
    	$data['main_content'] = 'admin/list_chaptername';
        $this->load->view('includes/template', $data);
    }



function add_subscription($id)
	{ 
		$userdata=$this->session->all_userdata();
    	@$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		 $data['results1'] = $this->product_module->get_student_byid($id);
		 $data['allclasses'] = $this->product_module->get_class();
 		 $data['results'] = $this->product_module->get_package();
		 $data['main_content'] = 'admin/add_subscription';
         $this->load->view('includes/template', $data);

	}
	function add_subject_subs($id)
	{ 
	$userdata=$this->session->all_userdata();
    @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		 $data['results1'] = $this->product_module->get_student_byid($id);
		 $data['allclasses'] = $this->product_module->get_class();
 		 //$data['results'] = $this->product_module->get_package();
		 $data['main_content'] = 'admin/add_subject_subs';
         $this->load->view('includes/template', $data);

	}

	public function fetchsubscription()
	{
		 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		
   			$pack_id = $this->input->post('package_id');
            $getpack = $this->module->getallsubscription($pack_id);
            //print_r($getallbrand);
             // echo'  <option value="">Select</option>';
            foreach ($getpack as $key => $value) {
			 	echo $value['price'].'_'.$value['month']*30;
			 
			 	
				}

	}


	function add_subscription_details()
		{
			 $userdata=$this->session->all_userdata();
    		 @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

			//$subscription=$this->input->post('subscription')
		    	$user_id=$this->input->post('user_id');
		        $pack_id=$this->input->post('pack_id');
            	$class_id=$this->input->post('class_id');
			
			$indays=$this->input->post('end_date');
			 if($enddate_date=$this->product_module->user_subscription_status($user_id,$class_id,$pack_id,$indays))
			  {
			echo $enddate_date;exit;
		   $cat_arr=array(
                'end_date'=>$enddate_date,
                'start_date'=>$this->input->post('start_date'),
                'order_id'=>$this->input->post('order_id'),
				'package_id'=>$pack_id,
				'price'=>$this->input->post('subscribtio_amount'),
				'user_name'=>$this->input->post('user_name'),
				'user_id'=>$user_id,
				'user_mail'=>$this->input->post('user_email'),
				'user_classs_id'=>$class_id
				);
				if($insert_home=$this->product_module->user_payment_status_update($cat_arr,$user_id,$class_id,$pack_id))
				{
						$data['flash_message'] =TRUE;

				}
				
			  }
				else{ 
			    
                $today_datestill=date('d-m-Y');
                    $date =  $today_datestill;
                    $date = strtotime($date);
                    $date = strtotime("+$indays day", $date);
                    $enddate_date= date('d-m-Y', $date);
			    $cat_arr=array(
                'end_date'=>$enddate_date,
                'start_date'=>$this->input->post('start_date'),
                'order_id'=>$this->input->post('order_id'),
				'package_id'=>$pack_id,
				'price'=>$this->input->post('subscribtio_amount'),
				'user_name'=>$this->input->post('user_name'),
				'user_id'=>$user_id,
				'user_mail'=>$this->input->post('user_email'),
				'user_classs_id'=>$class_id
				);
            	if($insert_home=$this->product_module->user_payment_status($cat_arr))
				        {
						$data['flash_message'] =TRUE;

			            }
	
				}

		 $data['results'] = $this->product_module->get_message_list();
        $data['main_content'] = 'admin/list_subscription';
        $this->load->view('includes/template', $data);
}
function add_subject_subs_details()
	{
		$userdata=$this->session->all_userdata();
    	@$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
			//$subscription=$this->input->post('subscription')
			$user_id=$this->input->post('user_id');
			$class_id=$this->input->post('class_id');
		    $subject_id=$this->input->post('subject_id');
			$expiry_months=$this->input->post('expiry_months');
			 if($enddate_date=$this->product_module->user_subject_subs_status($user_id,$class_id,$subject_id,$expiry_months))
			  {
			
		   $cat_arr=array(
				'user_id'=>$user_id,
				'class_id'=>$class_id,
				'subject_id'=>$subject_id,
                'end_date'=>$enddate_date,
                'order_id'=>$this->input->post('order_id')
				
				);
				if($insert_home=$this->product_module->user_subject_payment_status_update($cat_arr,$user_id,$class_id,$subject_id))
				{
						$data['flash_message'] =TRUE;
				}
				
			  }
				else{ 
					$expiry_months_days=$expiry_months * 30;
                	$date_today=date('Y-m-d');
                    $date = strtotime($date_today);
                    $expiry_date = strtotime("+$expiry_months_days day", $date);
                    $enddate_date= date('Y-m-d', $expiry_date);
			    $cat_arr=array(
				'user_id'=>$user_id,
				'class_id'=>$class_id,
				'subject_id'=>$subject_id,
				'order_id'=>$this->input->post('order_id'),	
                'end_date'=>$enddate_date,
                'start_date'=>$date_today
				//'price'=>$this->input->post('subscribtio_amount'),
				
				);
            	if($insert_home=$this->product_module->user_payment_status($cat_arr))
				        {
						$data['flash_message'] =TRUE;

			            }
	
				}
			}	
		 $data['results'] = $this->product_module->get_message_list();
        $data['main_content'] = 'admin/list_subscription';
        $this->load->view('includes/template', $data);
}
function updateuser(){

	$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

		$u_id = $this->input->post('u_id');
		 if($this->product_module->update_user_subscription($u_id));
		 {
		 	echo "sucess";
		 }


}

 function list_subscription(){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

	 
         //$data['results'] = $this->product_module->get_subscription_list();

         //print_r($data);exit;
		$data['results'] = $this->product_module->get_message_list();
		
        $data['main_content'] = 'admin/list_subscription';
        $this->load->view('includes/template', $data);
}


   function edit_subscription($id){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
   	 $data['get_team']=$this->product_module->get_subscription_byid($id);
   	 //print_r($data);exit;
	$data['results'] = $this->product_module->get_subscription();
    $data['main_content'] = 'admin/edit_team_member';
        $this->load->view('includes/template', $data);

   }

	function update_subscription($id)
	{
	 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}


				$update_cateorgy=array(

				'chapter_name'=>$this->input->post('name'),
				'description'=>$this->input->post('description'),
				'class_id'=>$this->input->post('class_id'),
				'subject_id'=>$this->input->post('sub_id')
				);

             //echo "<pre>";print_r($update_cateorgy);exit;

				if($ffff=$this->product_module->update_subscription($id,$update_cateorgy))
				{
					$data['flash_message'] =TRUE;
				}
				else{
					$data['flash_message'] =FALSE;
				}

		 $data['results'] = $this->product_module->get_subscription_list();
		 //$data['results'] = $this->product_module->get_class();
    		$data['main_content'] = 'admin/list_team_member';
        $this->load->view('includes/template', $data);
}


public function delete_subscription_details($id)
    {
	  $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 
     if($this->product_module->delete_subscription_details($id))
                    {
					$data['flash_message'] =TRUE;
				}
				else{
					$data['flash_message'] =FALSE;
				}
    $data['results'] = $this->product_module->list_order();
	    
	    //echo "<pre>";
	    //print_r($data['results']);exit;
        $data['main_content'] = 'admin/list_orders';
        $this->load->view('includes/template', $data);
    }







function add_about()
	{ 
		$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		 $data['results'] = $this->product_module->get_class();
		 $data['main_content'] = 'admin/add_about';
         $this->load->view('includes/template', $data);

	}


	function add_about_details()
		{
		$userdata=$this->session->all_userdata();
		@$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		
			if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('images/')) {
						umask(0);
						mkdir('images/',0777);
					}

					$time=time();
					$config['upload_path'] = 'images/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']           = 400;
						$config['new_image']       =    'images/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']          = 400;
						$config['new_image']       =    'images/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}
				}
   			$cat_arr=array(
				'subject_name'=>$this->input->post('name'),
				'class_id'=>$this->input->post('class_id'),
				'image'=>$UploadFile,
				'amount'=>$this->input->post('amount'),
				'month'=>$this->input->post('duration')
				
					);

				if($insert_home=$this->product_module->add_subject_details($cat_arr))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
				}
		$data['results'] = $this->product_module->get_class();
		$data['main_content'] = 'admin/add_about';
		$this->load->view('includes/template', $data);
}

 function list_about(){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

	 {
         $data['results'] = $this->product_module->get_about_list();
        $data['main_content'] = 'admin/list_about';
        $this->load->view('includes/template', $data);
    }
}


   function edit_about($id){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
   	 $data['get_about']=$this->product_module->get_about_byid($id);
 	$data['result'] = $this->product_module->get_class();
    $data['main_content'] = 'admin/edit_about';
        $this->load->view('includes/template', $data);

   }

	function update_about($id)
	{
	 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
			if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('images/')) {
						umask(0);
						mkdir('images/',0777);
					}

					$time=time();
					$config['upload_path'] = 'images/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']           = 400;
						$config['new_image']       =    'images/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']          = 400;
						$config['new_image']       =    'images/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}
				}



			$update_cateorgy=array(
				'subject_name'=>$this->input->post('name'),
				'class_id'=>$this->input->post('class_id'),
					'image'=>$UploadFile
				);

             //echo "<pre>";print_r($update_cateorgy);exit;

				if($ffff=$this->product_module->update_about($id,$update_cateorgy))
				{
					$data['flash_message'] =TRUE;
				}
				else{
					$data['flash_message'] =FALSE;
				}

		 $data['results'] = $this->product_module->get_about_list();
		  $data['result'] = $this->product_module->get_class();
    		$data['main_content'] = 'admin/list_about';
        $this->load->view('includes/template', $data);
}


public function delete_about_details($id)
    {
	  $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 
     $this->product_module->delete_about_details($id);

    
		 $data['results'] = $this->product_module->get_about_list();

        $data['main_content'] = 'admin/list_about';
        $this->load->view('includes/template', $data);


    }

function add_package()
	{ 
		$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		 //$data['results'] = $this->product_module->get_class();
		 $data['main_content'] = 'admin/add_package';
         $this->load->view('includes/template', $data);

	}


	function add_package_details()
		{
			$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
   			$cat_arr=array(
				'month'=>$this->input->post('duration'),
				'pack_name'=>$this->input->post('name'),
				'price'=>$this->input->post('price')
				//'class_id'=>$this->input->post('class_id')
					);

				if($insert_home=$this->product_module->add_package_details($cat_arr))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
				}
			//$data['results'] = $this->product_module->get_class();
			$data['main_content'] = 'admin/add_package';
         $this->load->view('includes/template', $data);
}

function add_plan()
	{ 
		$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		  $data['list_exam'] = $this->product_module->get_about_list();
		 $data['main_content'] = 'admin/add_plan';
         $this->load->view('includes/template', $data);

	}
function add_plan_details()
		{
			$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

		$totalAmount = 0.0;
	    $amountAfterDiscount =0.0;
		$subject =$this->input->post('subject');
		$discount = $this->input->post('discount');

 		$data['result'] = $this->product_module->get_about_list();
 		foreach($result as $key=>$value){
 				if ($subject == $value['s_id']) {
 					$totalAmount += $value['amount'];
 				}
 		}

 		$amountAfterDiscount = ($totalAmount*$discount)/100;

		 
   			$cat_arr=array(
				'plan_name'=>$this->input->post('name'),
				'discount'=>@$discount,
				'total_amount'=>@$totalAmount,
				'subject_ids'=>json_encode($subject),
				'amount_after_discount'=>@$amount_after_discount,
				//'class_id'=>$this->input->post('class_id')
					);

				if($insert_home=$this->product_module->add_plan_details($cat_arr))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
				}
			 $data['all_exam']= $this->product_module->get_about_list();
			$data['main_content'] = 'admin/add_plan';
         $this->load->view('includes/template', $data);
}

 function list_package(){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

	 {
         $data['results'] = $this->product_module->get_package_list();

          //print_r($data); exit;
		//echo "<pre>"; print_r($data['results']);exit;
        $data['main_content'] = 'admin/list_package';
        $this->load->view('includes/template', $data);
    }
}


   function edit_package($id){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
   	 $data['get_about']=$this->product_module->get_package_byid($id);
 	//$data['result'] = $this->product_module->get_class();
    $data['main_content'] = 'admin/edit_package';
        $this->load->view('includes/template', $data);

   }

	function update_package($id)
	{
	 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}



			$update_cateorgy=array(
			    'pack_name'=>$this->input->post('name'),
				'month'=>$this->input->post('duration'),
				'price'=>$this->input->post('price')
				//'class_id'=>$this->input->post('class_id')
				);

             //echo "<pre>";print_r($update_cateorgy);exit;

				if($ffff=$this->product_module->update_package($id,$update_cateorgy))
				{
					$data['flash_message'] =TRUE;
				}
				else{
					$data['flash_message'] =FALSE;
				}

		 $data['results'] = $this->product_module->get_package_list();
		  //$data['result'] = $this->product_module->get_class();
    		$data['main_content'] = 'admin/list_package';
        $this->load->view('includes/template', $data);
}


public function delete_package_details($id)
    {
	  $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 
     $this->product_module->delete_package_details($id);

    
		 $data['results'] = $this->product_module->get_package_list();

        $data['main_content'] = 'admin/list_package';
        $this->load->view('includes/template', $data);


    }



 function add_home()
	{
	 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
        //$data['results1'] = $this->product_module->get_packages_list();
		 $data['main_content'] = 'admin/add_category';
         $this->load->view('includes/template', $data);

	}
function add_home_details()
{
	$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		} 
	

	   $cat_arr=([
	        //'package_id'=>$this->input->post('pack_id'),
				'name'=>$this->input->post('name')
					]);

				if($insert_home=$this->product_module->add_home_details($cat_arr))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
				}
            //$data['results1'] = $this->product_module->get_packages_list();
			$data['main_content'] = 'admin/add_category';
         $this->load->view('includes/template', $data);	
}

 function list_home(){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

	 {
	      //$data['results1'] = $this->product_module->get_packages_list();
         $data['results'] = $this->product_module->get_category_list();
		//echo "<pre>"; print_r($data['results']);exit;
        $data['main_content'] = 'admin/list_category';
        $this->load->view('includes/template', $data);
    }
}

   function edit_home($id){

$userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
   	 $data['get_home']=$this->product_module->get_category_byid($id);
 //$data['results1'] = $this->product_module->get_packages_list();
    $data['main_content'] = 'admin/edit_category';
        $this->load->view('includes/template', $data);

   }
   
   
   
   
   	function updatepopular_video1()
	{
	 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
            $id=$this->input->post('po_id');

			if($this->product_module->update_chapter_video1($id)){
			    echo 1;
			}
			
	}
	
	
	
	function updatepopular_video2()
	{
	 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
            $id=$this->input->post('po_id2');
           if($this->product_module->update_chapter_video2($id))
           {
               echo 0;
           }
	}


	function update_home($id)
	{
	 $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}


				$update_cateorgy=array(
                //'package_id'=>$this->input->post('pack_id'),
				'name'=>$this->input->post('name')
				);

             //echo "<pre>";print_r($update_cateorgy);exit;

				if($ffff=$this->product_module->update_home($id,$update_cateorgy))
				{
					$data['flash_message'] =TRUE;
				}
				else{
					$data['flash_message'] =FALSE;
				}

		 $data['results'] = $this->product_module->get_category_list();
 //$data['results1'] = $this->product_module->get_packages_list();
    		$data['main_content'] = 'admin/list_category';
        $this->load->view('includes/template', $data);
}


public function delete_home_details($id)
    {
	  $userdata=$this->session->all_userdata();
     @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 
     $this->product_module->delete_home_details($id);
 $data['results1'] = $this->product_module->get_packages_list();
      $data['results'] = $this->product_module->get_category_list();
        $data['main_content'] = 'admin/list_category';
        $this->load->view('includes/template', $data);
    }


		function edit_app_img($id)
	{
		 $userdata=$this->session->all_userdata();
        @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

		if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				//echo $id; exit;
          if($_FILES['apps_site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
				   //echo $_FILES['apps_site_image']['name']."koko";exit;
                $type_profile=$this->input->post('type_profile');
					if(!is_dir('../uploads/main_cat_image/')) {
						umask(0);
						mkdir('../uploads/main_cat_image/',0777);
					}

					$time=time();
					$config['upload_path'] = '../uploads/main_cat_image/';
					$config['file_name'] = $time."_".$_FILES['apps_site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;
					$config['max_size']   = '1024';

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('apps_site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('../uploads/main_cat_image/'.$UploadFile);
						$config['image_library']   = 'gd2';
                        $config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 204;
						$config['height']           = 200;
						$config['new_image']       =    '../uploads/main_cat_image/'.$time."_".$_FILES['apps_site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('../uploads/main_cat_image/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 200;
						$config['height']          = 221;
						$config['new_image']       =    '../uploads/main_cat_image/thumb/'.$time."_".$_FILES['apps_site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}

				   $old_photo=$this->input->post('old_photo', TRUE);
					if($old_photo != '')
					{
						if(file_exists(realpath('../uploads/main_cat_image/'.$old_photo)))
						{
						unlink(realpath('../uploads/main_cat_image/'.$old_photo));
						}
					}

				} else {
					$UploadFile=$this->input->post('old_photo', TRUE);
				}
				$update_cateorgy=array(
			   'name'=>$this->input->post('name'),
			  'description'=>$this->input->post('deccription'),
			  'site_image'=>$this->input->post('site_image'),
				'apps_image'=>$UploadFile
				);

			 //echo "<pre>";print_r($update_cateorgy);exit;
				if($site_image=$this->product_module->edit_category($id,$update_cateorgy))
				{
					//echo 1;exit;
					//redirect('edit_category');
				}

			}
		      $data['get_cateory']=$this->product_module->get_category_byid($id);
           //echo "<pre>"; print_r( $data['get_cateory']);exit;
		       $data['main_content'] = 'admin/edit_category';
        $this->load->view('includes/template', $data);

		//$this->load->view('admin/home');
	}

		function edit_category($id)
	    {
			 $userdata=$this->session->all_userdata();
			 @$user_id=$userdata['id'];
				if($user_id=='')
				{
					redirect(base_url());
				}

		if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				//echo $id; exit;

				$update_cateorgy=array(


			    'site_image'=>$this->input->post('site_image'),
			     'apps_image'=>$this->input->post('apps_site_image'),
				  'name'=>$this->input->post('name'),
				 'description'=>$this->input->post('deccription')
				);

		       //echo "<pre>";print_r($update_cateorgy);exit;
				if($site_image=$this->product_module->edit_category($id,$update_cateorgy))
				{
					//echo 1;exit;
					//redirect('edit_category');
				}

			}
		      $data['get_cateory']=$this->product_module->get_category_byid($id);
           //echo "<pre>"; print_r( $data['get_cateory']);exit;
		       $data['main_content'] = 'admin/edit_category';
        $this->load->view('includes/template', $data);

		//$this->load->view('admin/home');
	}


	function list_product()
	 {
          $userdata=$this->session->all_userdata();
       @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		 $data['results'] = $this->product_module->get_product_list();
	     $data['main_category']=$this->product_module->category_list_details();
		  //echo "<pre>"; print_r($data['main_category']); exit;
		 //$data['get_cateory']=$this->product_module->get_category_byid($id);
		 //pagination settings
         $config['per_page'] = 10;
        $config['base_url'] = base_url().'list_product';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 10;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';


        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        }



		  //echo "<pre>"; print_r($data['results']);exit;
			$data['category']=$this->product_module->getallcategory();
    	$data['allbrand']=$this->product_module->allbrand();
        $data['main_content'] = 'admin/list_product';
        $this->load->view('includes/template', $data);
    }
 function list_subcategory()
	 {
         $data['results'] = $this->product_module->get_subcategory_list();
		    //echo "<pre>"; print_r($data['results']);exit;
        $data['main_content'] = 'admin/list_subcategory';
        $this->load->view('includes/template', $data);
    }

	


		public function delete_subcategory()
			{
			$userdata=$this->session->all_userdata();
			 @$user_id=$userdata['id'];
			if($user_id=='')
			{
				redirect(base_url());
			}
		      $id = $this->uri->segment(2);
			    $this->product_module->delete_sbcategory($id);
					redirect('list_subcategory');
			}
		function site_img_product($id)
	{

		if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				//echo $id; exit;
          if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
				   //echo $_FILES['site_image']['name']."koko";exit;
                $type_profile=$this->input->post('type_profile');
					if(!is_dir('../uploads/sub_category/')) {
						umask(0);
						mkdir('../uploads/sub_category/',0777);
					}

					$time=time();
					$config['upload_path'] = '../uploads/sub_category/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;
					$config['max_size']   = '1024';

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('../uploads/sub_category/'.$UploadFile);
						$config['image_library']   = 'gd2';
                        $config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 600;
						$config['height']           = 400;
						$config['new_image']       =    '../uploads/sub_category/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('../uploads/sub_category/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 200;
						$config['height']          = 221;
						$config['new_image']       =    '../uploads/sub_category/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}

				   $old_photo=$this->input->post('old_photo', TRUE);
					if($old_photo != '')
					{
						if(file_exists(realpath('../uploads/sub_category/'.$old_photo)))
						{
						unlink(realpath('../uploads/sub_category/'.$old_photo));
						}
					}

				} else {
					$UploadFile=$this->input->post('old_photo', TRUE);
				}
				$update_cateorgy=array(
				 //'apps_image'=>$this->input->post('site_imagee'),
				  'p_id'=>$this->input->post('main_category'),
				   'product_name'=>$this->input->post('name'),
				    'price'=>$this->input->post('price'),
					 'des'=>$this->input->post('deccription'),
				      'image'=>$UploadFile

				);

			//echo "<pre>";print_r($update_cateorgy);exit;
				if($site_image=$this->product_module->edit_product($id,$update_cateorgy))
				{
					//echo 1;exit;
					//redirect('product/edit_product');
				}

			}
		      $data['get_cateory']=$this->product_module->get_product_byid($id);
			  $data['main_category']=$this->product_module->get_category();
           //echo "<pre>"; print_r( $data['get_cateory']);exit;
		       $data['main_content'] = 'admin/edit_product';
           $this->load->view('includes/template', $data);

		//$this->load->view('admin/home');
	}
		function app_img_product($id)
	{
	    $userdata=$this->session->all_userdata();
        @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				//echo $id; exit;
          if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
				   //echo $_FILES['site_image']['name']."koko";exit;
                $type_profile=$this->input->post('type_profile');
					if(!is_dir('../uploads/sub_category/')) {
						umask(0);
						mkdir('../uploads/sub_category/',0777);
					}

					$time=time();
					$config['upload_path'] = '../uploads/sub_category/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;
					$config['max_size']   = '1024';

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('../uploads/sub_category/'.$UploadFile);
						$config['image_library']   = 'gd2';
                        $config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 600;
						$config['height']           = 400;
						$config['new_image']       =    '../uploads/sub_category/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('../uploads/sub_category/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 200;
						$config['height']          = 221;
						$config['new_image']       =    '../uploads/sub_category/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}

				   $old_photo=$this->input->post('old_photo', TRUE);
					if($old_photo != '')
					{
						if(file_exists(realpath('../uploads/sub_category/'.$old_photo)))
						{
						unlink(realpath('../uploads/sub_category/'.$old_photo));
						}
					}

				} else {
					$UploadFile=$this->input->post('old_photo', TRUE);
				}
				$update_cateorgy=array(
				 //'p_id'=>$this->input->post('p_id'),
				   //'product_name'=>$this->input->post('product_name'),
				    //'price'=>$this->input->post('price'),
					 //'des'=>$this->input->post('des'),
				      //'image'=>$this->input->post('site_image'),
				       'apps_image'=>$UploadFile,

				);

			//echo "<pre>";print_r($update_cateorgy);exit;
				if($site_image=$this->product_module->edit_product($id,$update_cateorgy))
				{
					//echo 1;exit;
					//redirect('product/edit_product');
				}

			}
		      $data['get_cateory']=$this->product_module->get_product_byid($id);
			  $data['main_category']=$this->product_module->get_category();
           //echo "<pre>"; print_r( $data['get_cateory']);exit;
		       $data['main_content'] = 'admin/edit_product';
           $this->load->view('includes/template', $data);

		//$this->load->view('admin/home');
	}

	function edit_product($id)
	{
	    $id = $this->uri->segment(2);
	  $userdata=$this->session->all_userdata();
      @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
				//echo $id; exit;

				$update_cateorgy=array(
				   	'name'=> $this->input->post('product_name'),
						'cat_id'=> $this->input->post('main_category'),
						'gender'=> $this->input->post('submain_category'),
						'fk_subcat'=>$this->input->post('product_category'),
						'product_color'=>$this->input->post('product_color'),
						'brand'=> $this->input->post('brand'),
						'price'=> $this->input->post('sale_price'),
						'offer_price'=> $this->input->post('offer_price'),
						'noItems'=> $this->input->post('items'),
						'dec'=> $this->input->post('description'),
						'details'=> $this->input->post('details'),
						'size_product'=> $produc_size,
						'product_color'=>$produc_color,
						'shipping_return'=>$this->input->post('shipping_return'),
						'important_note'=>$this->input->post('important_note'),

				);

			  //echo "<pre>";print_r($update_cateorgy);exit;
				if($site_image=$this->product_module->edit_product($id,$update_cateorgy))
				{
					//echo 1;exit;
					//redirect('product/edit_product');
				}

			}
		    $data['get_product']=$this->product_module->get_product_byid($id);
		    // $data['main_category']=$this->product_module->get_category();
		   $data['category']=$this->product_module->get_category_list();
           //echo "<pre>"; print_r( $data['get_cateory']);exit;
		   $data['main_content'] = 'admin/edit_product';
           $this->load->view('includes/template', $data);

		//$this->load->view('admin/home');
	}

	public function delete_product()
    {
       $id = $this->uri->segment(2);
	  // echo $id ; die;
       $this->product_module->delete_product_all($id);
        redirect('list_product');
     }
  public function add_city(){
      $userdata=$this->session->all_userdata();
       @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
  if($this->input->server('REQUEST_METHOD') === 'POST')
	{
		$add_city=array(
		'city'=>$this->input->post('city_name')
		);
        if($this->product_module->add_city($add_city))
		{
			$data['flash_message']=TRUE;
		}
	   else{
		$data['flash_message']=FALSE;
	   }
       //print_r($add_city);	exit;
	}
		   $data['main_content'] = 'admin/add_city';
           $this->load->view('includes/template', $data);

}
public function add_model()
{  $userdata=$this->session->all_userdata();
       @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

    if($this->input->server('REQUEST_METHOD') === 'POST')
	{
		 $rsa=$this->input->post('rsa');
		 if($rsa=='no'){
			$add_model_name=array(
			'car_model_name'=>$this->input->post('model_name'),
			'Segment'=>$this->input->post('Segment'),
			'rsa'=>$this->input->post('rsa')
			);
		 }else{
			$add_model_name=array(
			'car_model_name'=>$this->input->post('model_name'),
			'Segment'=>$this->input->post('Segment'),
			'rsa'=>$this->input->post('rsa'),
			'first_year'=>$this->input->post('first_year'),
			'second_year'=>$this->input->post('second_year'),
			'third_year'=>$this->input->post('third_year'),
			'forth_year'=>$this->input->post('forth_year'),
			'fivth_year'=>$this->input->post('fivth_year'),
			);

		 }

		//print_r($add_model_name);exit;
		if($this->product_module->add_model($add_model_name))
		{
			$data['flash_message']=TRUE;
		}
		else{
			$data['flash_message']=FALSE;
		}
		//print_r($add_pincode);exit;

	}
		   //$data['service_city']=$this->product_module->getserivce_location();
		   $data['main_content'] = 'admin/add_model';
           $this->load->view('includes/template', $data);
}


function add_subcategory()
	{
     if($this->input->server('REQUEST_METHOD')=='POST')
		{

			if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('../uploads/main_cat_image/')) {
						umask(0);
						mkdir('../uploads/main_cat_image/',0777);
					}

					$time=time();
					$config['upload_path'] = '../uploads/main_cat_image/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;
					$config['max_size']   = '1024';

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('../uploads/main_cat_image/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 590;
						$config['height']           = 400;
						$config['new_image']       =    '../uploads/main_cat_image/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('../uploads/main_cat_image/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 590;
						$config['height']          = 400;
						$config['new_image']       =    '../uploads/main_cat_image/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}



				   $cat_arr=array(
						'main_category'=>$this->input->post('main_category'),
						'type'=>$this->input->post('type'),
						'subcategory_name'=> $this->input->post('subcategory_name'),
						'site_image'=>$UploadFile,
						 );

					//echo "<pre>"; print_r($cat_arr);exit;

						if($insert_category=$this->product_module->add_subcatagory($cat_arr))
						{
								$data['flash_message'] =TRUE;
						}
						else
						{
							$data['flash_message'] =FALSE;
						}

			}


        }

       $data['results'] = $this->product_module->get_category_list();
		 $data['main_content'] = 'admin/add_subcatagory';
         $this->load->view('includes/template', $data);

	}
public function edit_model()
{
   $id=$this->uri->segment(2);
    $userdata=$this->session->all_userdata();
       @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

    if($this->input->server('REQUEST_METHOD') === 'POST')
	{
		 $rsa=$this->input->post('rsa');
		 if($rsa=='no'){
			$add_model_name=array(
			'car_model_name'=>$this->input->post('model_name'),
			'Segment'=>$this->input->post('Segment'),
			'rsa'=>$this->input->post('rsa')
			);
		 }else{
			$add_model_name=array(
			'car_model_name'=>$this->input->post('model_name'),
			'Segment'=>$this->input->post('Segment'),
			'rsa'=>$this->input->post('rsa'),
			'first_year'=>$this->input->post('first_year'),
			'second_year'=>$this->input->post('second_year'),
			'third_year'=>$this->input->post('third_year'),
			'forth_year'=>$this->input->post('forth_year'),
			'fivth_year'=>$this->input->post('fivth_year'),
			);

		 }
		//print_r($add_model_name);exit;
		if($this->product_module->edit_model($id,$add_model_name))
		{
			$data['flash_message']=TRUE;
		}
		else{
			$data['flash_message']=FALSE;
		}
		//print_r($add_pincode);exit;

	}

		   //$data['model_data']=$this->
		   $data['get_model']=$this->product_module->get_model_byid($id);
		   $data['main_content'] = 'admin/edit_model';
           $this->load->view('includes/template', $data);
}
public function home_cms()
{
	  $userdata=$this->session->all_userdata();
       @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	$data['home_welocme']=$this->product_module->home_welocme();
	$data['main_content'] = 'admin/home_pagecms';
    $this->load->view('includes/template', $data);
}
public function edit_welcome()
{
	  $userdata=$this->session->all_userdata();
       @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	if($this->input->server('REQUEST_METHOD') === 'POST')
	{
	//echo "sdsd";exit;
		if($_FILES['site_image']['name']!='')
			{
					//echo "<pre>" ; print_r("$_FILES"); exit;
				//echo $_FILES['site_image']['name']."koko";exit;
					if(!is_dir('../uploads/offer_img/')) {
						umask(0);
						mkdir('../uploads/offer_img/',0777);
					}

					$time=time();
					$config['upload_path'] = '../uploads/offer_img/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;
					$config['max_size']   = '1024';

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('../uploads/offer_img/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 1000;
						$config['height']           = 706;
						$config['new_image']       =    '../uploads/offer_img/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('../uploads/offer_img/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 600;
						$config['height']          = 300;
						$config['new_image']       =    '../uploads/offer_img/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}



				}
				else{
					$UploadFile=$this->input->post('old_photo');
				}
				   $welcome_home=array(
						'title'=> $this->input->post('title'),
						'des'=> $this->input->post('description'),
						//'first_dec'=> $this->input->post('first_pera'),
						//'second_dec'=> $this->input->post('second_pera'),
						//'third_dec'=> $this->input->post('third_pera'),
						//'third_dec'=> $this->input->post('forth_pera'),
						'image'=>$UploadFile

						 );
						if($this->product_module->update_homewelcome($welcome_home))
						{
							$data['flash_message']=TRUE;
						}
						else{
							$data['flash_message']=FALSE;
						}
	}
	$data['home_welocme']=$this->product_module->home_welocme();
	$data['main_content'] = 'admin/edit_welcome';
    $this->load->view('includes/template', $data);
}
public function add_offers()
 {
   $userdata=$this->session->all_userdata();
      @$user_id=$userdata['id'];
  if($user_id=='')
  {
   redirect(base_url());
  }
  if($this->input->server('REQUEST_METHOD')=='POST')
 {

  $add_offer=array(

  'offer_price'=>$this->input->post('offer_price')

  );
  $id=$this->input->post('get_cat_name');
  //print_r($add_offer);
  if($this->product_module->add_offers($id,$add_offer))
  {
     redirect('offers_list');
  }
  else{
   $data['flash_message']=FALSE;
  }
 }

   //$data['all_model'] = $this->product_module->get_model_list();
      $data['main_content'] = 'admin/add_offers';
   $this->load->view('includes/template', $data);
 }

 public function offers_list()
 {
      $userdata=$this->session->all_userdata();
      @$user_id=$userdata['id'];
	  if($user_id=='')
	  {
	   redirect(base_url());
	  }
      $data['offer_list']=$this->product_module->offer_details();
      $data['main_content'] = 'admin/offer_list';
      $this->load->view('includes/template', $data);

 }
 public function remove_offer()
 {
	$id=$this->uri->segment(2);
	 if($this->product_module-> remove_offer($id))
	 {
		 redirect('offers_list');
	 }
 }
	public function edit_offers()
 {

  //echo 1;exit;
   //echo  $id=$this->uri->segment(2);exit;

    $id=$this->uri->segment(2);
     $userdata=$this->session->all_userdata();
   @$user_id=$userdata['id'];

   $data_ofers=$this->product_module->car_detais_byid($id);
   $model_name = $data_ofers[0]['model_name'];
   $car_condition = $data_ofers[0]['car_condition'];


  if($user_id=='')
  {
   redirect(base_url());
  }

     $data['all_model'] = $this->product_module->get_model_list();
     $data['car_details_byid']=$this->product_module->car_detais_byid($id);
     $data['car_name']=$this->product_module->get_carname_bysegment($car_condition,$model_name);
    $data['main_content'] = 'admin/edit_offer';
        $this->load->view('includes/template', $data);

 }
	public function list_car()
	{
		$data['allcar_list']=$this->product_module->car_list();
		$data['main_content'] = 'admin/list_car';
        $this->load->view('includes/template', $data);

	}
	public function more_car_images()
	{
		$id=$this->uri->segment(2);


		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			 $field_name=$this->uri->segment(3);
			 $image_type=$this->uri->segment(4);
				 if($_FILES[$field_name]['name']!='')
			{
					//echo "<pre>" ; print_r("$_FILES"); exit;
				// $_FILES[$field_name]['name']."koko";exit;
					if(!is_dir('../uploads/car_image/')) {
						umask(0);
						mkdir('../uploads/car_image/',0777);
					}

					$time=time();
					$config['upload_path'] = '../uploads/car_image/';
					$config['file_name'] = $time."_".$_FILES[$field_name]['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;
					$config['max_size']   = '1024';

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload($field_name))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('../uploads/car_image/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 1400;
						$config['height']           = 1050;
						$config['new_image']       =    '../uploads/car_image/'.$time."_".$_FILES[$field_name]['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('../uploads/car_image/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 600;
						$config['height']          = 300;
						$config['new_image']       =    '../uploads/car_image/thumb/'.$time."_".$_FILES[$field_name]['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if (! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}

						 //echo "<pre>";print_r($cat_arr); exit;
				}

			$array_image_upload=array(
			"$field_name"=>$UploadFile
			);
			if($this->product_module->update_moreimage($id,$array_image_upload,$image_type))
			{
				//echo 1;exit;
				redirect('more_car_images/'.$id);
			}
		//print_r($array_image_upload);exit;


		}
		$data['car_details_byid']=$this->product_module->car_detais_byid($id);
		$data['car_exterior_image']=$this->product_module->get_exterior_imagebyid($id);
		$data['car_interior_image']=$this->product_module->car_get_interior_image_byid($id);
		$data['main_content'] = 'admin/more_car_images';
        $this->load->view('includes/template', $data);

	}
	public function edit_exterior_image()
	{

		//$data['car_exterior_image']=$this->product_module->exterior_byid($id);
		$data['main_content'] = 'admin/edit_exterior_image';
        $this->load->view('includes/template', $data);

	}
	public function get_model_bysegment()
	{
		//echo 1;exit;
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$segment=$this->input->post('segment');
	     	$data=$this->product_module->get_model_bysegment($segment);
			//print_r($data);
			echo'<option value="">Select</option>';
			foreach($data as $key=>$value){

				echo'<option value="'.$value['model_id'].'">'.$value['car_model_name'].'</option>';
			}
		}

	}
	public function old_list_car()
	{
		$data['allcar_list']=$this->product_module->old_car_list();
		$data['main_content'] = 'admin/old_list_car';
        $this->load->view('includes/template', $data);

	}

	function edit_old_car ()
	{
      $id=$this->uri->segment(2);
	  $userdata=$this->session->all_userdata();
      @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 if($this->input->server('REQUEST_METHOD')=='POST')
		{

			if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('../uploads/car_image/')) {
						umask(0);
						mkdir('../uploads/car_image/',0777);
					}

					$time=time();
					$config['upload_path'] = '../uploads/car_image/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;
					$config['max_size']   = '1024';

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('../uploads/car_image/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 1400;
						$config['height']           = 1050;
						$config['new_image']       =    '../uploads/car_image/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('../uploads/car_image/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 200;
						$config['height']          = 221;
						$config['new_image']       =    '../uploads/car_image/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}

			}
			else{

			$UploadFile=$this->input->post('old_img');
			}
			//echo $UploadFile;exit;
			$model_name=$this->input->post('model_name');
			$price=$this->input->post('price');
			$year=$this->input->post('year');
			$fuel_type=$this->input->post('fuel_type');

			$specification=array(
			'car_name'=>$this->input->post('car_name'),
			'car_des'=>$this->input->post('car_des'),
			'engine_size'=>$this->input->post('engine_size'),
			'engine_power'=>$this->input->post('engine_power'),
			'mileage'=>$this->input->post('mileage'),
			'exterior'=>$this->input->post('exterior'),
			'interior'=>$this->input->post('interior'),
			);

			//echo "<pre>";
			//print_r($specification);exit;
			$Features=array(
			'horsepower'=>$this->input->post('horsepower'),
			'car_torque'=>$this->input->post('car_torque'),
			'airbag'=>$this->input->post('airbag'),
			'disc_brakes'=>$this->input->post('disc_brakes'),
			'ac'=>$this->input->post('ac'),
			'steering'=>$this->input->post('steering'),
			'seating_capacity'=>$this->input->post('seating_capacity'),
			'armrest'=>$this->input->post('armrest'),
			'Seatbelt'=>$this->input->post('Seatbelt'),
			'audio'=>$this->input->post('audio'),
			'body_color'=>$this->input->post('body_color'),
			'indicator'=>$this->input->post('indicator'),
			'lock'=>$this->input->post('lock')
);
			//echo"<pre>";
			//print_r($Features);
			$specifictin_json=json_encode($specification);
			$Features_json=json_encode($Features);

			$edit_car=array(
			'specification'=>$specifictin_json,
			'Features'=>$Features_json,
			'price'=>$price,
			'Fuel_Type'=>$fuel_type,
			'image'=>$UploadFile,
			'Vechile_type'=>$this->input->post('vechile_type'),
			'car_condition'=>$this->input->post('car_condition'),
			'model_name'=>$model_name,
			'Scheme'=>$this->input->post('Scheme')
			);
         // echo "<pre>";
		//print_r($add_car);
			//exit;
			if($last_id=$this->product_module->edit_old_car($id,$edit_car))
			{
				$data['flash_message']=TRUE;

			}
			else{
				$data['flash_message']=FALSE;
			}
        }
		 $data['car_details_byid']=$this->product_module->car_detais_byid($id);
		 $data['all_model'] = $this->product_module->get_model_list();
		 $data['main_content'] = 'admin/edit_old_car';
         $this->load->view('includes/template', $data);

	}

	 function add_old_car()
	{
      $userdata=$this->session->all_userdata();
      @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 if($this->input->server('REQUEST_METHOD')=='POST')
		{

			if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('../uploads/car_image/')) {
						umask(0);
						mkdir('../uploads/car_image/',0777);
					}

					$time=time();
					$config['upload_path'] = '../uploads/car_image/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;
					$config['max_size']   = '1024';

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('../uploads/car_image/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 1400;
						$config['height']           = 1050;
						$config['new_image']       =    '../uploads/car_image/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('../uploads/car_image/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 200;
						$config['height']          = 221;
						$config['new_image']       =    '../uploads/car_image/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}

			}
			//echo $UploadFile;exit;
			$model_name=$this->input->post('model_name');
			$price=$this->input->post('price');
			$year=$this->input->post('year');
			$fuel_type=$this->input->post('fuel_type');

			$specification=array(
			'car_name'=>$this->input->post('car_name'),
			'car_des'=>$this->input->post('car_des'),
			'engine_size'=>$this->input->post('engine_size'),
			'engine_power'=>$this->input->post('engine_power'),
			'mileage'=>$this->input->post('mileage'),
			'exterior'=>$this->input->post('exterior'),
			'interior'=>$this->input->post('interior'),
			);

			//echo "<pre>";
			//print_r($specification);exit;
			$Features=array(
			'horsepower'=>$this->input->post('horsepower'),
			'car_torque'=>$this->input->post('car_torque'),
			'airbag'=>$this->input->post('airbag'),
			'disc_brakes'=>$this->input->post('disc_brakes'),
			'ac'=>$this->input->post('ac'),
			'steering'=>$this->input->post('steering'),
			'seating_capacity'=>$this->input->post('seating_capacity'),
			'armrest'=>$this->input->post('armrest'),
			'Seatbelt'=>$this->input->post('Seatbelt'),
			'audio'=>$this->input->post('audio'),
			'body_color'=>$this->input->post('body_color'),
			'indicator'=>$this->input->post('indicator'),
			'lock'=>$this->input->post('lock')
);
			//echo"<pre>";
			//print_r($Features);
			$specifictin_json=json_encode($specification);
			$Features_json=json_encode($Features);

			$add_car=array(
			'specification'=>$specifictin_json,
			'Features'=>$Features_json,
			'price'=>$price,
			'Fuel_Type'=>$fuel_type,
			'image'=>$UploadFile,
			'Vechile_type'=>$this->input->post('vechile_type'),
			'car_condition'=>$this->input->post('car_condition'),
			'model_name'=>$model_name,
			'Scheme'=>$this->input->post('Scheme')
			);
        //  echo "<pre>";
		//	print_r($add_car);
			//exit;
			if($last_id=$this->product_module->add_car($add_car))
			{
				$exterior_image_array=array(
				'fk_carid'=>$last_id,
				'exterior_image1'=>'',
				'exterior_image2'=>'',
				'exterior_image3'=>'',
				'exterior_image4'=>'',
				'exterior_image5'=>''

				);
				$interior_image_array=array(
				'fk_carid'=>$last_id,
				'Interior_image1'=>'',
				'Interior_image2'=>'',
				'Interior_image3'=>'',
				'Interior_image4'=>'',
				'Interior_image5'=>'',
				);

				$this->product_module->add_exterior_image($exterior_image_array);
				if($this->product_module->add_interior_image($interior_image_array))
				{
				//echo 1;exit;
				   $data['flash_message']=TRUE;
				}
				else{

					 $data['flash_message']=FALSE;
				}

			}
        }
		 $data['all_model'] = $this->product_module->get_model_list();
		 $data['main_content'] = 'admin/add_old_car';
         $this->load->view('includes/template', $data);

	}

	 public function edit_welcome1()
{
   $id=$this->uri->segment(2);
  // echo "<pre>" ; print_r($id); exit;
   $userdata=$this->session->all_userdata();
       @$user_id=$userdata['id'];
  if($user_id=='')
  {
   redirect(base_url());
  }
 if($this->input->server('REQUEST_METHOD') === 'POST')
 {
 //echo "sdsd";exit;
  if($_FILES['site_image']['name']!='')
   {
     //echo "<pre>" ; print_r("$_FILES"); exit;
    //echo $_FILES['site_image']['name']."koko";exit;
     if(!is_dir('../uploads/offer_img/')) {
      umask(0);
      mkdir('../uploads/offer_img/',0777);
     }

     $time=time();
     $config['upload_path'] = '../uploads/offer_img/';
     $config['file_name'] = $time."_".$_FILES['site_image']['name'];

     //$main_image=$time."_".$_FILES['small_image']['name'];
     $UploadFile=$config['file_name'];

     $config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
        $config['image_library'] = 'gd2';
     $config['overwrite'] = TRUE;
     $config['encrypt_name'] = FALSE;
     $config['remove_spaces'] = TRUE;
     $config['max_size']   = '1024';

     $this->load->library('upload',$config);

     if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
     if ( ! $this->upload->do_upload('site_image'))
     {
      echo 'error';
     } else {

      $this->upload->initialize($config);

      $source_image=realpath('../uploads/offer_img/'.$UploadFile);
      $config['image_library']   = 'gd2';
      $config['source_image']    = $source_image;
      $config['create_thumb']    = TRUE;
      $config['maintain_ratio']  = FALSE;
      $config['width']           = 1000;
      $config['height']           = 706;
      $config['new_image']       =    '../uploads/offer_img/'.$time."_".$_FILES['site_image']['name'];
      $config['thumb_marker']    = '';
      //$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

      $this->load->library('image_lib',$config);

      if ( ! $this->image_lib->resize())
      {
      $data['error'] = strip_tags($this->image_lib->display_errors());

      }
      $this->image_lib->clear();


      $source_image=realpath('../uploads/offer_img/'.$UploadFile);
      $config['image_library']   = 'gd2';
      $config['source_image']    = $source_image;
      $config['create_thumb']    = TRUE;
      $config['maintain_ratio']  = FALSE;
      $config['width']           = 600;
      $config['height']          = 300;
      $config['new_image']       =    '../uploads/offer_img/thumb/'.$time."_".$_FILES['site_image']['name'];
      $config['thumb_marker']    = '';
      //$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
      $this->image_lib->initialize($config);

      if ( ! $this->image_lib->resize())
      {
      $data['error'] = strip_tags($this->image_lib->display_errors());
      }
      $this->image_lib->clear();
        }
    }
    else{
     $UploadFile=$this->input->post('old_photo');
    }
       $welcome_home=array(
      'title'=> $this->input->post('title'),
      'des'=> $this->input->post('description'),
      //'first_dec'=> $this->input->post('first_pera'),
      //'second_dec'=> $this->input->post('second_pera'),
      //'third_dec'=> $this->input->post('third_pera'),
      //'third_dec'=> $this->input->post('forth_pera'),
      'image'=>$UploadFile

       );
      if($this->product_module->update_homewelcome1($id,$welcome_home))
      {
       $data['flash_message']=TRUE;
      }
      else{
       $data['flash_message']=FALSE;
      }
 }
 $data['home_welocme1']=$this->product_module->home_welocme1($id);
   $data['main_content'] = 'admin/edit_welcome1';
    $this->load->view('includes/template', $data);
}
public function get_price_bysegment()
 {
  //echo 1;exit;
  if($this->input->server('REQUEST_METHOD') === 'POST')
  {
   $car_id=$this->input->post('car_id');
   //$model_name=$this->input->post('model_name');
       $data=$this->product_module->get_price_bysegment($car_id);
   //print_r($data);
   //exit;
   //$data=$this->product_module->car_detais_byid($id);



                 echo $price=$data[0]['price'];


  }

 }
 public function get_carname_bysegment()
 {
  //echo 1;exit;
  if($this->input->server('REQUEST_METHOD') === 'POST')
  {
   $carconedition=$this->input->post('carconedition');
   $model_name=$this->input->post('model_name');
       $data=$this->product_module->get_carname_bysegment($carconedition,$model_name);
  // print_r($data);
   //$data=$this->product_module->car_detais_byid($id);
     echo'<option value="">Select</option>';
    foreach($data as $key=>$value)
    {

                  $specification=$data[$key]['specification'];
                   $car_id=$data[$key]['car_id'];
                   $car_specification= json_decode($specification,true);
          echo'<option value="'.$car_id.'">'.$car_specification['car_name'].'</option>';
         }
  }

 }
 public function exchange_vehicle()
 {
	// echo 1;exit;

	   $data['data']=$this->product_module->get_allexchage();
	   $data['main_content'] = 'admin/exchange_vehicle';
       $this->load->view('includes/template', $data);

 }
  /*============================================= nargis 06-04-18 ================================================*/


public function hospitalization_List()
	  {
		$data['service_list']=$this->product_module->post_hospitalization_List();
		$data['main_content'] = 'admin/hospitalization_List';
        $this->load->view('includes/template', $data);
	  }

 public function edit_service_hospitalization()
	{
		//echo 1; exit;
		$id=$this->uri->segment(2);
		$userdata=$this->session->all_userdata();
        @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		 if($this->input->server('REQUEST_METHOD') === 'POST')
			{
				//echo 1; exit;
				 if($_FILES['site_image']['name']!='')
			{
					//echo "<pre>" ; print_r("$_FILES"); exit;
				//echo $_FILES['site_image']['name']."koko";exit;
					if(!is_dir('../uploads/service_banner/')) {
						umask(0);
						mkdir('../uploads/service_banner/',0777);
					}

					$time=time();
					$config['upload_path'] = '../uploads/service_banner/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;
					$config['max_size']   = '1024';

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('../uploads/service_banner/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 408;
						//$config['height']           = 333;
						$config['new_image']       =    '../uploads/service_banner/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('../uploads/service_banner/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						$config['width']           = 600;
						$config['height']          = 300;
						$config['new_image']       =    '../uploads/service_banner/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if (! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}

						 //echo "<pre>";print_r($cat_arr); exit;
				}
               else{
				  $UploadFile= $this->input->post('old_pic');

			   }
				$updateservice=array(
				'hospitalization_how_can_help'=>$this->input->post('hospitalization_how_can_help'),
				'hospitalization_description'=>$this->input->post('hospitalization_description'),
				'post_hospital_service_icon'=>$UploadFile,
				'hospitalization_title1'=>$this->input->post('hospitalization_title1'),
				'hospitalization_title2'=>$this->input->post('hospitalization_title2'),
				'hospitalization_title3'=>$this->input->post('hospitalization_title3'),
				'hospitalization_title4'=>$this->input->post('hospitalization_title4'),
				'hospitalization_title5'=>$this->input->post('hospitalization_title5'),
				'hospitalization_title6'=>$this->input->post('hospitalization_title6'),
				'hospitalization_desc1'=>$this->input->post('hospitalization_desc1'),
				'hospitalization_desc2'=>$this->input->post('hospitalization_desc2'),
				'hospitalization_desc3'=>$this->input->post('hospitalization_desc3'),
				'hospitalization_desc4'=>$this->input->post('hospitalization_desc4'),
				'hospitalization_desc5'=>$this->input->post('hospitalization_desc5'),
				'hospitalization_desc6'=>$this->input->post('hospitalization_desc6')
				);
				if($this->product_module->update_service_page($id,$updateservice))
				{
					$data['flash_message']=TRUE;
				}
				else{
					$data['flash_message']=FALSE;
				}
				//print_r($updateservice);exit;
			}
	       	$data['get_service']=$this->product_module->get_service_page_id($id);
		      $data['main_content'] = 'admin/edit_service_hospitalization';
          $this->load->view('includes/template', $data);

	}
	  public function del_hospitalization()
    {
       $id = $this->uri->segment(2);
	  //echo $id ; die;
       $this->product_module->del_hospitalization($id);
        redirect('post_hospitalization_List');
     }
		 public function productcategory()
		 {

		  	$gender= $this->input->post('gender');
			  $getallproduct= $this->product_module->getallsubproductdata($gender);
			//	print_r($getallproduct);
				echo '<option value="">Select</option>';
			foreach ($getallproduct as $key => $value) {
				// code...

				  echo '<option value="'.$value['subcat_id'].'">'. $value['subcategory_name'].'</option>';
			}
		 }
		public function edit_subcategory()
		{
		//	echo 1;
		$userdata=$this->session->all_userdata();
      @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

       $id = $this->uri->segment(2);

			 //echo 1; exit;
			 if($this->input->server('REQUEST_METHOD') === 'POST')
			 {
			 if($_FILES['site_image']['name']!='')
				 {
					 //echo "<pre>" ; print_r("$_FILES"); exit;
					 //echo $_FILES['site_image']['name']."koko";exit;
										$type_profile=$this->input->post('type_profile');
					 if(!is_dir('../uploads/main_cat_image/')) {
						 umask(0);
						 mkdir('../uploads/main_cat_image/',0777);
					 }

					 $time=time();
					 $config['upload_path'] = '../uploads/main_cat_image/';
					 $config['file_name'] = $time."_".$_FILES['site_image']['name'];

					 //$main_image=$time."_".$_FILES['small_image']['name'];
					 $UploadFile=$config['file_name'];

					 $config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
						 $config['image_library'] = 'gd2';
					 $config['overwrite'] = TRUE;
					 $config['encrypt_name'] = FALSE;
					 $config['remove_spaces'] = TRUE;
					 $config['max_size']   = '1024';

					 $this->load->library('upload',$config);

					 if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					 if ( ! $this->upload->do_upload('site_image'))
					 {
						 echo 'error';
					 } else {

						 $this->upload->initialize($config);

						 $source_image=realpath('../uploads/main_cat_image/'.$UploadFile);
						 $config['image_library']   = 'gd2';
						 $config['source_image']    = $source_image;
						 $config['create_thumb']    = TRUE;
						 $config['maintain_ratio']  = FALSE;
						 $config['width']           = 590;
						 $config['height']           = 400;
						 $config['new_image']       =    '../uploads/main_cat_image/'.$time."_".$_FILES['site_image']['name'];
						 $config['thumb_marker']    = '';
						 //$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						 $this->load->library('image_lib',$config);

						 if ( ! $this->image_lib->resize())
						 {
						 $data['error'] = strip_tags($this->image_lib->display_errors());

						 }
						 $this->image_lib->clear();


						 $source_image=realpath('../uploads/main_cat_image/'.$UploadFile);
						 $config['image_library']   = 'gd2';
						 $config['source_image']    = $source_image;
						 $config['create_thumb']    = TRUE;
						 $config['maintain_ratio']  = FALSE;
						 $config['width']           = 590;
						 $config['height']          = 400;
						 $config['new_image']       =    '../uploads/main_cat_image/thumb/'.$time."_".$_FILES['site_image']['name'];
						 $config['thumb_marker']    = '';
						 //$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						 $this->image_lib->initialize($config);

						 if ( ! $this->image_lib->resize())
						 {
						 $data['error'] = strip_tags($this->image_lib->display_errors());
						 }
						 $this->image_lib->clear();
						 }



						$cat_arr=array(
						 'main_category'=>$this->input->post('main_category'),
						 'type'=>$this->input->post('type'),
						 'subcategory_name'=> $this->input->post('subcategory_name'),
						 'site_image'=>$UploadFile,
							);

					 //echo "<pre>"; print_r($cat_arr);exit;

						 if($this->product_module->update_subcatagory($cat_arr,$id))
						 {
								 $data['flash_message'] =TRUE;
						 }
						 else
						 {
							 $data['flash_message'] =FALSE;
						 }

			 }
		 }
      $data['results'] = $this->product_module->get_category_list();
      $data['sub_categoryfetch']= $this->product_module->getsubcategoery($id);
			$data['main_content'] = 'admin/edit_subcategory';
			$this->load->view('includes/template', $data);

		}
		
			function add_slider_details()
		{
		    
		  
    
         $data['results'] = $this->product_module->get_slider_list2();
      	 $data['main_content'] = 'admin/list_slider';
         $this->load->view('includes/template', $data);	
     }
    public function edit_slider()
    {
             $userdata=$this->session->all_userdata();
      @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		
             $id=$this->uri->segment(2);
               if($this->input->server('REQUEST_METHOD') === 'POST')
			 {
            	if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('uploads/main_cat_image/')) {
						umask(0);
						mkdir('uploads/main_cat_image/',0777);
					}

					$time=time();
					$config['upload_path'] = 'uploads/main_cat_image/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('uploads/main_cat_image/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']           = 400;
						$config['new_image']       =    'uploads/main_cat_image/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('uploads/main_cat_image/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']          = 400;
						$config['new_image']       =    'uploads/main_cat_image/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}

		

		
		}else{
		    
		    $UploadFile= $this->input->post('old_image');
		}
		
		   $cat_arr=array(
				'name'=>$this->input->post('name'),
				'image'=>$UploadFile
					);
					
					//print_r($cat_arr);

				if($insert_home=$this->product_module->update_slider_details($cat_arr,$id))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
				}
    }
             
             
             $data['results'] = $this->product_module->get_slider_listbyid($id);
          	 $data['main_content'] = 'admin/edit_slider';
             $this->load->view('includes/template', $data);	
        
    }

		function fetchsubject_byid()
		{
			$userdata=$this->session->all_userdata();
			  @$user_id=$userdata['id'];
				if($user_id=='')
				{
					redirect(base_url());
				}
			  if($this->input->server('REQUEST_METHOD') === 'POST')
			 {
			    //echo 1;
				$class_id =$this->input->post('class_id');
			    $data= $this->product_module->getallsubject_byclassid($class_id);
			    
			   // print_r($data);
			   echo '<option value="">select</option>';
			   foreach($data as $key=>$val)
			   {
				   echo '<option value="'.$val['s_id'].'" >'.$val['subject_name'].'</option>';
			   }
			 }
		}
		function fetchamountsubject_byid()
		{
			$userdata=$this->session->all_userdata();
			  @$user_id=$userdata['id'];
				if($user_id=='')
				{
					redirect(base_url());
				}
			  if($this->input->server('REQUEST_METHOD') === 'POST')
			 {
			    //echo 1;
				$subject_id =$this->input->post('subject_id');
			    if($data= $this->product_module->fetchamountsubject_byid($subject_id)){
				//print_r($data);
			   echo $data[0]['amount'].'_'.$data[0]['month'];
				}
			 }
		}
		function create_exam()
		{
			 $userdata=$this->session->all_userdata();
              @$user_id=$userdata['id'];
				if($user_id=='')
				{
					redirect(base_url());
				}
			  if($this->input->server('REQUEST_METHOD') === 'POST')
			 {
				 if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('images/')) {
						umask(0);
						mkdir('images/',0777);
					}

					$time=time();
					$config['upload_path'] = 'images/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die ("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {
						$this->upload->initialize($config);
						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']           = 400;
						$config['new_image']       =    'images/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->load->library('image_lib',$config);
						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']          = 400;
						$config['new_image']       =    'images/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);
						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}
				}
			    //echo 1;
				//date_default_timezone_set('Asia/Calcutta'); 
				//$date=date('Y-m-d');
				$name =$this->input->post('name');
				$amount =$this->input->post('amount');
				$type =$this->input->post('type');
				$date =$this->input->post('date');
				$valid =$this->input->post('valid');
				$subject =$this->input->post('subject');
				$total_marks =$this->input->post('totalmarks');
				$exam_instruction =$this->input->post('exam_instruction');
				$exam_time =$this->input->post('exam_time');
					//echo $date;die;
				//$numquestion =$this->input->post('numquestion_5');
				//$num_array=array();
				//foreach($subject as $val){
				//$num_array[] .=$this->input->post('numquestion_'.$val);
				//}
				//echo json_encode($subject);exit;
				$sub_arr=array(
					'eaxm_name'=>$name,
					'type'=>$type,
					'amount'=>$amount,
					'live_date'=>@$date,
					'validation'=>@$valid,
					'subject_ids'=>json_encode($subject),
					'total_marks'=>$total_marks,
					'exam_instruction'=>$exam_instruction,
					'exam_time'=>$exam_time,
					'image'=>$UploadFile
				);
			    if($data['result']= $this->product_module->create_exam($sub_arr))
				{
					$data['flash_message'] =TRUE;
					}
				else{
					$data['flash_message'] =FALSE;
					}
			 }					
			 $data['all_exam']= $this->product_module->get_about_list();
			 $data['main_content'] = 'admin/exam/add_exam';
             $this->load->view('includes/template', $data);	
		}
	function list_exam()
	 {
       $userdata=$this->session->all_userdata();
       @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	    $data['results'] = $this->product_module->list_exam_api();
	    
	    //echo "<pre>";
	    //print_r($data['results']);exit;
        $data['main_content'] = 'admin/exam/list_exam';
        $this->load->view('includes/template', $data);
    }
	
	public function edit_exam()
    {
      $userdata=$this->session->all_userdata();
      @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		
             $id=$this->uri->segment(2);
               if($this->input->server('REQUEST_METHOD') === 'POST')
			 {
            	if($_FILES['site_image']['name']!='')
				{
					//echo "<pre>" ; print_r("$_FILES"); exit;
					//echo $_FILES['site_image']['name']."koko";exit;
                  $type_profile=$this->input->post('type_profile');
					if(!is_dir('images/')) {
						umask(0);
						mkdir('images/',0777);
					}

					$time=time();
					$config['upload_path'] = 'images/';
					$config['file_name'] = $time."_".$_FILES['site_image']['name'];

					//$main_image=$time."_".$_FILES['small_image']['name'];
					$UploadFile=$config['file_name'];

					$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
				    $config['image_library'] = 'gd2';
					$config['overwrite'] = TRUE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;

					$this->load->library('upload',$config);

					if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
					if ( ! $this->upload->do_upload('site_image'))
					{
						echo 'error';
					} else {

						$this->upload->initialize($config);

						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']           = 400;
						$config['new_image']       =    'images/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];

						$this->load->library('image_lib',$config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());

						}
						$this->image_lib->clear();


						$source_image=realpath('images/'.$UploadFile);
						$config['image_library']   = 'gd2';
						$config['source_image']    = $source_image;
						$config['create_thumb']    = TRUE;
						$config['maintain_ratio']  = FALSE;
						//$config['width']           = 590;
						//$config['height']          = 400;
						$config['new_image']       =    'images/thumb/'.$time."_".$_FILES['site_image']['name'];
						$config['thumb_marker']    = '';
						//$product_small_image=thumb_'.$time."_".$_FILES['small_image']['name'];
						$this->image_lib->initialize($config);

						if ( ! $this->image_lib->resize())
						{
						$data['error'] = strip_tags($this->image_lib->display_errors());
						}
						$this->image_lib->clear();
				   	}
				}else{
		    
		    $UploadFile= $this->input->post('old_image');
		}
			$name =$this->input->post('name');
			$amount =$this->input->post('amount');
			$type =$this->input->post('type');
			$date =$this->input->post('date');
			$subject =$this->input->post('subject');
		$cat_arr=array(
			'eaxm_name'=>$name,
			'type'=>$type,
			'amount'=>$amount,
			'live_date'=>@$date,
			'subject_ids'=>json_encode($subject),
			'image'=>$UploadFile
					);
				if($insert_home=$this->product_module->update_exam($cat_arr,$id))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
				}
    }
             
             
			 $data['results'] = $this->product_module->get_exam_listbyid($id);
			 $data['all_exam']= $this->product_module->get_about_list();
			
          	 $data['main_content'] = 'admin/exam/edit_exam';
             $this->load->view('includes/template', $data);	
        
    }
	function delete_exam($id)
	{
		$userdata=$this->session->all_userdata();
		@$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}

		$this->product_module->delete_exam($id);


		$data['results'] = $this->product_module->list_exam_api();

		//echo "<pre>";
		//print_r($data['results']);exit;
		$data['main_content'] = 'admin/exam/list_exam';
		$this->load->view('includes/template', $data);
	}
	function add_questionbank()
	 {
       $userdata=$this->session->all_userdata();
       @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	    //$data['results'] = $this->apps_model->list_exam_api();
	    
	    //echo "<pre>";
	    //print_r($data['results']);exit;
        $data['main_content'] = 'admin/add_questionbank';
        $this->load->view('includes/template', $data);
    }	
	function fetch_exambyid()
		{
			$userdata=$this->session->all_userdata();
			  @$user_id=$userdata['id'];
				if($user_id=='')
				{
					redirect(base_url());
				}
			  if($this->input->server('REQUEST_METHOD') === 'POST')
			 {
			    //echo 1;
				$id =$this->input->post('id');
			    $data= $this->apps_model->list_exambyid_api($id);
				//print_r($data);exit;
				echo '<div  class="form-group profile_ed_f_rm">';
				echo '<label class="control-label col-md-3 col-sm-3 col-xs-12 " for="first-name">Add Question <span class="required">*</span>
					</label>';
				echo '<div class="col-md-9 col-sm-9 col-xs-12">';	
				echo '<ul class="nav nav-tabs">';
				foreach($data as $val){
					
				
				echo '<li><a href="'.base_url().'add_question?exam_id='.$id.'&subject_id='.$val["s_id"].'">'.$val["subject_name"].'</a></li>';
			   
				}
				echo '</div>';
				echo '</ul>'.'</div>';
			 }
		}	
	function add_question()
	 {
       $userdata=$this->session->all_userdata();
       @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	    if($this->input->server('REQUEST_METHOD') === 'POST')
			 {
			    //echo 1;
				$exam_id =$this->input->post('exam_id');
				$subject_id =$this->input->post('subject_id');
				$question_type =$this->input->post('qtype');
				$question =$this->input->post('question');
				$tot_no_answer =$this->input->post('totans');
				$answer =$this->input->post('answer');
				$total_no_corect_ans =$this->input->post('totcrans');
				$total_corect_answer =$this->input->post('carect_answer');
				$marks =$this->input->post('marks');
				$nagative_mark =$this->input->post('nagative_mark');
				$time_to_spend =$this->input->post('ttspend');
				$difficulty_level =$this->input->post('diff_level');
				$hint =$this->input->post('hint');
				$explanation =$this->input->post('explation');
				
				$cat_arr=array(
				'exam_id'=>$exam_id,
				'subject_id'=>$subject_id,
				'question_type'=>$question_type,
				'question'=>$question,
				'total_answers'=>$tot_no_answer,
				'answers'=>json_encode($answer),
				'total_correct_answers'=>$total_no_corect_ans,
				'correct_answers'=>json_encode($total_corect_answer),
				'marks'=>$marks,
				'nagative_mark'=>$nagative_mark,
				'time_to_spend'=>$time_to_spend,
				'difficulty_level'=>$difficulty_level,
				'hint'=>$hint,
				'explanation'=>$explanation
				);
			 //print_r($cat_arr);exit;  
				if($data['result']=$this->product_module->insert_question($cat_arr))
				{
					$data['flash_message'] =TRUE;
					}
				else{

					$data['flash_message'] =FALSE;
					}
			 }
        $data['main_content']='admin/add_questions';
        $this->load->view('includes/template', $data);
    }

	function list_questionbank()
	{
	  $userdata=$this->session->all_userdata();
	  @$user_id=$userdata['id'];
	   if($user_id=='')
	   {
		   redirect(base_url());
	   }
	   $data['results'] = $this->product_module->list_examsubject();
	   
	//    echo "<pre>";
	//    print_r($data['results']);exit;
	   $data['main_content'] = 'admin/list_questionbank';
	   $this->load->view('includes/template', $data);
   }
   public function edit_questionbank(){
	//header('Content-Type: application/json');
	  $userdata=$this->session->all_userdata();
	  @$user_id=$userdata['id'];
	if($user_id=='')
	{
		redirect(base_url());
	}
	$id=$this->uri->segment(2);
	$subject_id=$this->uri->segment(3);
	$exam_id=$this->uri->segment(4);
	if ($this->input->server('REQUEST_METHOD') === 'POST')
		{	
			$question_type =$this->input->post('qtype');
			$question =$this->input->post('question');
			$tot_no_answer =$this->input->post('totans');
			$answer =$this->input->post('answer');
			$total_no_corect_ans =$this->input->post('totcrans');
			$total_corect_answer =$this->input->post('carect_answer');
			$marks =$this->input->post('marks');
			$nagative_mark =$this->input->post('nagative_mark');
			$time_to_spend =$this->input->post('ttspend');
			$difficulty_level =$this->input->post('diff_level');
			$hint =$this->input->post('hint');
			$explanation =$this->input->post('explation');
			
			$cat_arr=array(
			'exam_id'=>$exam_id,
			'subject_id'=>$subject_id,
			'question_type'=>$question_type,
			'question'=>$question,
			'total_answers'=>$tot_no_answer,
			'answers'=>json_encode($answer),
			'total_correct_answers'=>$total_no_corect_ans,
			'correct_answers'=>json_encode($total_corect_answer),
			'marks'=>$marks,
			'nagative_mark'=>$nagative_mark,
			'time_to_spend'=>$time_to_spend,
			'difficulty_level'=>$difficulty_level,
			'hint'=>$hint,
			'explanation'=>$explanation
			);
				if($insert_home=$this->product_module->update_questionbank($cat_arr,$id))
				{
				$data['flash_message'] =TRUE;
				}
			else{

				$data['flash_message'] =FALSE;
				}
				}
	$data['results']=$this->product_module->edit_questionbank($id);
	$data['main_content'] = 'admin/edit_questionbank';
	$this->load->view('includes/template',$data);
}
function list_exam_subscription()
	{
	  $userdata=$this->session->all_userdata();
	  @$user_id=$userdata['id'];
	   if($user_id=='')
	   {
		   redirect(base_url());
	   }
	   $data['results'] = $this->product_module->list_exam_subscription();
	   
	   //echo "<pre>";
	   //print_r($data['results']);exit;
	   $data['main_content'] = 'admin/exam/list_exam_subscription';
	   $this->load->view('includes/template', $data);
   }
public function delete_exam_subscription($id){
	$id=$this->uri->segment(2);
	  $userdata=$this->session->all_userdata();
	  @$user_id=$userdata['id'];
	if($user_id=='')
	{
		redirect(base_url());
	}
	$this->product_module->delete_exam_subscription($id);
	redirect('list_exam_subscription');
}
function list_exam_subscription_details(){

	$userdata=$this->session->all_userdata();
		 @$user_id=$userdata['id'];
			if($user_id=='')
			{
				redirect(base_url());
			}
	
		 
			 //$data['results'] = $this->product_module->get_subscription_list();
	
			 //print_r($data);exit;
			$data['results'] = $this->product_module->get_message_list();
			//echo "<pre>";
			//print_r($data);exit;
			$data['main_content'] = 'admin/exam/list_exam_subscription_details';
			$this->load->view('includes/template', $data);
	}
	// function add_exam_subs($id)
	// {
	// $userdata=$this->session->all_userdata();
    // @$user_id=$userdata['id'];
	// 	if($user_id=='')
	// 	{
	// 		redirect(base_url());
	// 	}
	// 	 $data['results1'] = $this->product_module->get_exam_listbyid($id);
	// 	 print_r($data);exit;
	// 	 //$data['allclasses'] = $this->product_module->get_class();
 	// 	 //$data['results'] = $this->product_module->get_package();
	// 	 $data['main_content'] = 'admin/add_exam_subs';
    //      $this->load->view('includes/template', $data);

	// }
	function add_exam_subs_details()
	{
		$userdata=$this->session->all_userdata();
    	@$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		$user_id=$this->uri->segment(2);
		if ($this->input->server('REQUEST_METHOD') === 'POST')
			{
			//$subscription=$this->input->post('subscription')
			//$user_id=$this->input->post('user_id');
			$exam_id=$this->input->post('exam_id');
		    $order_id=$this->input->post('order_id');
			$expiry_months=$this->input->post('expiry_months');
			 if($enddate_date=$this->product_module->user_exam_subs_status($user_id,$exam_id,$expiry_months))
			  {
			
		   $cat_arr=array(
				'user_id'=>$user_id,
				'exam_id'=>$exam_id,
				//'subject_id'=>$subject_id,
                'end_date'=>$enddate_date,
                'order_id'=>$order_id
				
				);
				if($insert_home=$this->product_module->user_exam_payment_status_update($cat_arr,$user_id,$exam_id))
				{
						$data['flash_message'] =TRUE;
				}
				
			  }
				else{ 
					$expiry_months_days=$expiry_months * 30;
                	$date_today=date('Y-m-d');
                    $date = strtotime($date_today);
                    $expiry_date = strtotime("+$expiry_months_days day", $date);
                    $enddate_date= date('Y-m-d', $expiry_date);
			    $cat_arr=array(
				'user_id'=>$user_id,
				'exam_id'=>$exam_id,
				'order_id'=>$order_id,	
                'end_date'=>$enddate_date,
                'start_date'=>$date_today
				
				);
            	if($insert_home=$this->product_module->user_exam_payment_status($cat_arr))
				        {
						$data['flash_message'] =TRUE;

			            }
	
				}
			}	
		 $data['results'] = $this->product_module->get_message_list();
        $data['main_content'] = 'admin/exam/add_exam_subs';
        $this->load->view('includes/template', $data);
}
function fetch_examsubs_byid()
		{
			$userdata=$this->session->all_userdata();
			  @$user_id=$userdata['id'];
				if($user_id=='')
				{
					redirect(base_url());
				}
			  if($this->input->server('REQUEST_METHOD') === 'POST')
			 {
			    //echo 1;
				$exam_id =$this->input->post('exam_id');
			    if($data= $this->product_module->get_exam_listbyid($exam_id)){
				//print_r($data);
			   echo $data[0]['amount'].'_'.$data[0]['validation'];
				}
			 }
		}
public function alluser_notification(){
    
	  	$userdata=$this->session->all_userdata();
      	@$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		
		if(isset($_GET['title'])&&$_GET['title']!='')
	    {
	         $title= $_GET['title'];
	         $message= $_GET['message'];
	          $store_msg= $this->product_module->store_pushdatabase_all($title,$message);
	    
	   
		$data['user_data']=$this->product_module->get_user_list();
// 		echo "<pre>";
// 		print_r($data);
// 		die;
// 		foreach($data as $value){
// 		      $token_key=$value['fb_token'];
		    
// 		    if($token_key!=""){
// 		      $msg_url="http://ubkinfotech.com/demo/education/alluser_notification?regId=$token_key&title=$title&message=$message&push_type=individual";
// 		      echo "</br>";
// 		      echo $msg_url;exit;
		      
//             $data['response'] = file_get_contents($msg_url);  
// 		    }
// 		    //$msg_url="http://ubkinfotech.com/demo/education/alluser_notification?regId=$reg_id&title=$title&message=$message&push_type=individual";
		     
             
// 		}
	    }      
		 
		$data['main_content'] = 'admin/alluser_notification';
       	$this->load->view('includes/template',$data);
	}
	public function new_notification(){
    
	  	$userdata=$this->session->all_userdata();
      	@$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		
		if(isset($_POST['msg'])&&$_POST['msg']!='')
	    {
	       $title= $_POST['title'];
	       $message= $_POST['msg'];
	       //print_r($message);die;
	       $store_msg= $this->product_module->store_pushdatabase_all($title,$message);
		   
	    }      
		 $data['user_data']=$this->product_module->get_user_list();
		$data['main_content'] = 'admin/new_notification';
       	$this->load->view('includes/template',$data);
	}
	
	function list_notification(){

	$userdata=$this->session->all_userdata();
		 @$user_id=$userdata['id'];
			if($user_id=='')
			{
				redirect(base_url());
			}
	
		 
			 //$data['results'] = $this->product_module->get_subscription_list();
	
			 //print_r($data);exit;
			$data['results'] = $this->product_module->list_notification();
			//echo "<pre>";
			//print_r($data);exit;
			$data['main_content'] = 'admin/list_notification';
			$this->load->view('includes/template', $data);
	}
	
	public function delete_notification($id){
	$id=$this->uri->segment(2);
	  $userdata=$this->session->all_userdata();
	  @$user_id=$userdata['id'];
	if($user_id=='')
	{
		redirect(base_url());
	}
	$this->product_module->delete_notification($id);
	redirect('list_notification');
}
//====================================================================

public function chapter_uploadImage(){
	$return = "";		
	$time=time();
	$fileName = str_replace(' ', '_', $_FILES['file']['name']);
	$file = $time."_".$fileName;
	$file = str_replace(' ', '_', $file);
	$sourcePath = $_FILES['file']['tmp_name'];       // Storing source path of the file in a 
	$targetPath = "images/".$file; // Target path where file is to be stored
	//echo $sourcePath;exit;
	move_uploaded_file($sourcePath,$targetPath) ;    // Moving Uploaded file		
	$return = $file;	
	echo $return;
	}
public function chapter_uploadvideo() {
	if(!empty($_FILES))
	{
		if(is_uploaded_file($_FILES['file']['tmp_name']))
		{
		sleep(1);
		$return = ""; 
		$time=time();
		$config['max_size']=10*20*1024;
        $config['max_width']= 1024;
        $config['max_height']= 768;
		$fileName = str_replace(' ', '_', $_FILES['file']['name']);
		$file = $time.$fileName;
		$file = str_replace(' ', '_', $file);
		$sourcePath = $_FILES['file']['tmp_name'];       // Storing source path of the file in a 
		$targetPath = "images/".$file; // Target path where file is to be stored
			if(move_uploaded_file($sourcePath, $targetPath))
			{
				$return = $file;  
				echo $return; 
				//echo '<img src="'.$target_path.'" class="img-thumbnail" width="300" height="250" />';
			}
		}
	}
}
public function chapter_details_addForm()
	{
	  	$userdata=$this->session->all_userdata();
    	@$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$image=$this->input->post('img_source_name');
			$vid=$this->input->post('vid_source_name');
			if($vid==""){
				$vid=$this->input->post('vid_src_name');
			}
			
	   	$cat_arr=array(
				'chapter_id_name'=>$this->input->post('name'),
				'chapter_name'=>$this->input->post('chapter_name'),
				'description'=>$this->input->post('description'),
				'class_id'=>$this->input->post('class_id'),
				'subject_id'=>$this->input->post('sub_id'),
				'video_title'=>$this->input->post('video_title'),
                'video_name'=>$vid,
				'chapter_image'=>$image
					);
		    	if($task=$this->product_module->chapter_details_addForm($cat_arr))
				{
				$data['flash_message'] =TRUE;
				}
			else{

				$data['flash_message'] =FALSE;
				}
		}
		$data['results'] = $this->product_module->get_class();
		$data['main_content'] = 'admin/add_chpter_video';
         $this->load->view('includes/template', $data);
        }
		
	public function set_new_password()
		{
			 
       // $data['main_content'] = 'admin/set_new_password';
        $this->load->view('forgot_password');
	}	
	public function set_new_userpass()
		{
			 if($this->input->server('REQUEST_METHOD') === 'POST')
			 {
                $id=$this->input->post('id');
                $newpass=$this->input->post('newpass');
                //echo $newpass;die;
			   $cat_arr=array(
				 'password'=>$newpass
					);
					
				 if($data=$this->product_module->set_new_userpass($cat_arr,$id))
				 {
				     echo 1;
				 }
			 
			 }
	}	

function update_refer_amount()
	{
	  $userdata=$this->session->all_userdata();
      @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 if($this->input->server('REQUEST_METHOD')=='POST')
		{
		    	$cat_arr=array(
				'refer_amount'=>$this->input->post('refer_amount')
					);

				if($insert_home=$this->product_module->update_refer_amount($cat_arr))
				{
						$data['flash_message'] =TRUE;
				}
				else{
	
					$data['flash_message'] =FALSE;
				    }
		}
		$data['results'] = $this->product_module->get_refer_amount();
        $data['main_content'] = 'admin/update_refer_amount';
        $this->load->view('includes/template', $data);

	}

function update_subsdates()
	{
	  $userdata=$this->session->all_userdata();
      @$user_id=$userdata['id'];
		if($user_id=='')
		{
			redirect(base_url());
		}
	 if($this->input->server('REQUEST_METHOD')=='POST')
		{
		    $id=$this->input->post('id');
		    $start_date=$this->input->post('start_date');
		    $end_date=$this->input->post('end_date');
	    	$cat_arr=array(
			'start_date'=>$start_date,
			'end_date'=>$end_date
				);

			if($insert_home=$this->product_module->update_subsdates($id,$cat_arr))
			{
				echo 1;
			}
			else{
                    echo 2;
			    }
		}
	}






}
?>
