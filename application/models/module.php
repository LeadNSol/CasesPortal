<?php
//echo "Prak"; exit;
class Module extends CI_Model
{
    function __construct()
    {
		$this->load->database();
        parent::__construct();
    }


	function check_user($user_email){
	//echo 1; exit;
	$this->db->select('*');
	$this->db->where('status','0' );
	$this->db->where('email',$user_email );
	$this->db->from('user');
	$query = $this->db->get();
	return $query->result_array();

    }
	function create_member($member_email)
	{
		$this->db->select('*');
		$this->db->where('email',$member_email);
		$query = $this->db->get('user');
		$data=$query->result_array();
        //print_r($data); exit;
        if($query->num_rows > 0)
		{
			$data[0]['id'];
			$usersdata = array(
				'email' => $member_email,
		      );
            $this->db->where('id', $data[0]['id']);
		    if($update=$this->db->update('user',$usersdata))
			{
			  return $data[0]['id'];
			}
		}else{
			$usersdata = array(
				'email'=> $member_email
		      );
			  //print_r($usersdata);exit;
			  $insert = $this->db->insert('user', $usersdata);
		    // return $query->result_array();
			   return $this->db->insert_id();
		}

	}

	function get_contents_create_members()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->where('user_type !=','admin' );
        $this->db->from('create_members');
		$query = $this->db->get();
		return $query->result_array();

    }











	function forgot_password($member_email)
	{
		//echo $member_email; exit;
		$this->db->select('*');
		$this->db->where('email',$member_email);
		$query = $this->db->get('create_members');
		$data=$query->result_array();
        //print_r($data); exit;
        if($query->num_rows == 1)
		{
			  $data[0]['id'];
			  return $data[0]['id'];
		}

	}





	function get_registration($data)
	{
		$insert = $this->db->insert('deal_member', $data);
		return $insert;
	}

	function get_user_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('deal_member');
		$this->db->where('member_id', $id);
		$query = $this->db->get();
		return $query->result_array();
    }
    function getallsubscription ($id)
    {
		$this->db->select('*');
		$this->db->from('packege');
		$this->db->where('pack_id', $id);
		$query = $this->db->get();
		return $query->result_array();
    }

 function getalltsubject($id)
    {
		$this->db->select('*');
		$this->db->from('subject');
		$this->db->where('class_id', $id);
		$query = $this->db->get();
		return $query->result_array();
    }

function getalltchapter($id)
    {
		$this->db->select('*');
		$this->db->from('chapter_name');
		$this->db->where('sub_id', $id);
		$query = $this->db->get();
		return $query->result_array();
    }
	function get_sliders()
    {
		$this->db->select('*');
		$this->db->where('gallery_status', 'Active');
		$this->db->from('deal_slider_gallery');

		$query = $this->db->get();
		//return $query->result_array();
    }
	public function get_helpfaq()

	 {

	$this->db->select('*');

		//$this->db->where('category_status', 'Active');
		$this->db->where('page_content_id', 5);
		$this->db->from('deal_page_content');
		$query = $this->db->get();
		return $query->result_array();
    }

    	function get_categories()
    {

		$this->db->select('*');

		$this->db->where('category_status', 'Active');
		$this->db->where('category_parent_id', 0);
		$this->db->from('deal_category`');

		$query = $this->db->get();
		//return $query->result_array();
    }
	public function get_blog() {

	$this->db->select('*');

		//$this->db->where('category_status', 'Active');
		$this->db->where('page_content_id', 7);
		$this->db->from('deal_page_content');

		$query = $this->db->get();
		return $query->result_array();
    }

	public function get_careers()

	 {

	$this->db->select('*');

		//$this->db->where('category_status', 'Active');
		$this->db->where('page_content_id', 6);
		$this->db->from('deal_page_content');

		$query = $this->db->get();
		return $query->result_array();
    }
    	function get_api_cat($id)
        {

		$this->db->select('*');

		$this->db->where('category_status', 'Active');
		$this->db->from('deal_api_category`');

		$query = $this->db->get();
		return $query->result_array();
       }

	 	function get_maincategories()
        {

		$this->db->select('*');
		$this->db->where('category_status', 'Active');
		$this->db->where('category_parent_id', '0');
		$this->db->from('deal_category`');

		$query = $this->db->get();
		return $query->result_array();
      }






	public function get_contect()
    {

		$this->db->select('*');

		//$this->db->where('category_status', 'Active');
		$this->db->where('page_content_id', 1);
		$this->db->from('deal_page_content');

		$query = $this->db->get();
		return $query->result_array();
    }

	public function get_parent_name($id)
    {
		$this->db->select('*');
		$this->db->from('deal_category');
		$this->db->where('category_id', $id);
		//$this->db->where('category_id IS NOT NULL');
		$query = $this->db->get();
		return $query->result_array();
    }

		function get_categories_api()
    {

		$this->db->select('category_name,category_id');
		//$this->db->group_by('category_id');
		$this->db->where('category_parent_id',0);
		$this->db->from('`deal_api_category`');
		$query = $this->db->get();

		return $query->result_array();

    }

		function get_categories_map($category_id)
    {
		//echo $category_id;die;
		$this->db->select('deal_api_category_id');
		$this->db->where('category_id',$category_id);
		$this->db->from('`deal_category_api_mapping`');
		$query = $this->db->get();
		return $query->result_array();
    }
		function get_sub_categories($id)
         {

			$this->db->select('category_name,category_id,category_parent_id');
			$this->db->group_by('category_name');

			$this->db->where('category_parent_id',$id);
			$this->db->from('deal_api_category`');
			$query = $this->db->get();
			return $query->result_array();

          }
		  function get_similarpro($category_id)
         {

			$this->db->select('*');
			$this->db->where('product_category',$category_id);
			$this->db->from('`deal_product`');
			$query = $this->db->get();
			return $query->result_array();

          }

		  function get_subcategories($category_id)
         {

			$this->db->select('product_subcategory');
			$this->db->where('product_id',$category_id);
			$this->db->from('`deal_product`');
			$query = $this->db->get();
			return $query->result_array();

          }

		  	  function get_catname($cat_id)
         {

			$this->db->select('category_name');
			$this->db->where('category_id',$cat_id);
			$this->db->from('`deal_api_category`');
			$query = $this->db->get();
			return $query->result_array();

          }

		   	  function get_subcatname($subcat_id)
         {

			$this->db->select('category_name');
			$this->db->where('category_id',$subcat_id);
			$this->db->from('`deal_api_category`');
			$query = $this->db->get();
			return $query->result_array();

          }

		function search($id,$val)
         {
		  //echo $id;
		  //echo $val;
			$this->db->select('product_name,product_id');
			$this->db->from('deal_product');
			$this->db->like('product_name',$val);
			$this->db->where('product_subcategory',$id);
			$query = $this->db->get();
			//print_r($query);
			return $query->result_array();

          }

     function get_product_details($id)
       {
		//echo $id;die;
		$this->db->select('*');

		$this->db->from('deal_product');

		$this->db->where('product_id',$id);
        $query = $this->db->get();
		return $query->result_array();
     }
	  function get_product_name($name)
       {
		//echo $id;die;
		$this->db->select('*');
		$this->db->where('product_name',$name);
		$this->db->from('deal_product');
		$this->db->join('deal_api', 'deal_product.api_id = deal_api.id');
        $query = $this->db->get();
		return $query->result_array();
     }

	/*member section start here*/
  function check_useremail($email)
	{
		$this->db->select('id');
	    $this->db->where('email',$email);
		$this->db->from('create_members');
		$query = $this->db->get();
		return $query->num_rows();
	}
		function member_insert($data)
		{
		  $insert = $this->db->insert('create_members',$data);
		}

	/*member section End */
    	function get_product()
        {
			$sql_query="product_id,product_name,product_med_image,product_startdate, 	product_expdate,((product_price-product_discountprice)/product_price)*100 as price";
			$this->db->select($sql_query);

			$this->db->where('product_status', 'Active');
			$this->db->from('deal_product');
			 $query = $this->db->get();
			return $query->result_array();
        }

public function get_aboutus()
 {

		$this->db->select('*');
		$this->db->where('id', 1);
		$this->db->from('about_us');

		$query = $this->db->get();
		return $query->result_array();
    }
	public function get_contact_us()
	{

			$this->db->select('*');
			$this->db->where('contact_id', 1);
			$this->db->from('contact_us');

			$query = $this->db->get();
			return $query->result_array();
	}


public function update_contact($contact_arr)
{
	     //echo "<pre>";
		// print_r($about_arr);exit;
	     $this->db->where('contact_id',1);
		 if($this->db->update('contact_us',$contact_arr))
		 {
			 return true;
		 }
}


	public function get_termsofuse()
 {

		$this->db->select('*');

		//$this->db->where('category_status', 'Active');
		$this->db->where('page_content_id', 8);
		$this->db->from('deal_page_content');

		$query = $this->db->get();
		return $query->result_array();
    }
	public function get_security()
 {

		$this->db->select('*');

		//$this->db->where('category_status', 'Active');
		$this->db->where('page_content_id', 10);
		$this->db->from('deal_page_content');

		$query = $this->db->get();
		return $query->result_array();
    }


	public function get_privacy()
 {

		$this->db->select('*');

		//$this->db->where('category_status', 'Active');
		$this->db->where('page_content_id', 9);
		$this->db->from('deal_page_content');

		$query = $this->db->get();
		return $query->result_array();
    }

	public function get_termsconditions()
 {

		$this->db->select('*');

		//$this->db->where('category_status', 'Active');
		$this->db->where('page_content_id', 3);
		$this->db->from('deal_page_content');

		$query = $this->db->get();
		return $query->result_array();
    }


	 public function get_faq()
	 {
		$this->db->select('*');
		//$this->db->where('category_status', 'Active');
		//$this->db->where('page_content_id', 2);
		$this->db->from('deal_faq');
		$query = $this->db->get();
		return $query->result_array();
    }
	public function get_pressrelease()
	 {
	   $this->db->select('*');
		//$this->db->where('category_status', 'Active');
		$this->db->where('page_content_id', 4);
		$this->db->from('deal_page_content');

		$query = $this->db->get();
		return $query->result_array();
    }

	public function get_detailsby_id($id)
	 {
		 //echo $id; exit;
	   $this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('project_tracking');
		$query = $this->db->get();
		return $query->result_array();
    }

	//Suranjana 25-10-2016

function user_login_profile()
	{
		//setting cookie

		//echo "okk"; exit;
	     $email = $this->input->post('email');
		 $password = md5($this->input->post('password'));
		//$user_password = md5($this->input->post('member_password'));
		//setting cookie
		$this->db->select('id,email,password,status,first_name,user_type,image');
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$this->db->where('status','Active');
		$this->db->from('create_members');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$result = $query->num_rows();
		//print_r($result); die;
		if($result==0)
		{
			return false;
		}
		else
		{
			$data = $query->result_array();
		    $user_email=$data[0]['email'];
			$user_id=$data[0]['id'];
			$user_f_name= $data[0]['first_name'];
			$user_l_name= $data[0]['last_namme'];
			$user_type= $data[0]['user_type'];
			$user_image= $data[0]['image'];

			$this->session->set_userdata('email',$user_email);
			$this->session->set_userdata('id', $user_id);
			$this->session->set_userdata('f_name', $user_f_name);
			$this->session->set_userdata('l_name', $user_l_name);
			$this->session->set_userdata('user_type', $user_type);
			$this->session->set_userdata('image', $user_image);
			$this->session->set_userdata('is_logged_in', TRUE);
			return true;
		}

	}


	function member_forgot_password($member_email)  // Changed by Suranjana 25-06-2016
	{
		//echo 1; exit;

	    $member_email= $member_email;

		$this->db->select('*');
		$this->db->from('user');
		$this->db->where("email",$member_email);
		//$this->db->where("id",$id);
		$k=$this->db->get();
		$result = $k->num_rows();
		if($result==0)
		{
			//return false;
			echo "False"; exit;
		}
		else
		{
			//echo "True";
			$data = $k->result_array();
			$id =stripslashes($data[0]['id']);
			$member_email=stripslashes($data[0]['email']);

			$new_password=$this->module->get_random_password(6, 8, true, true, false);


			$this->module->update_user_password($id,$new_password);

			   return $id ;
		}

	}

function get_web_link_arr()
    {
		$this->db->select('setting_value');
		$this->db->where('setting_id',5);
		$this->db->or_where('setting_id',6);
		$this->db->or_where('setting_id',8);
		$this->db->from('deal_setting');
		$query = $this->db->get();
		return $query->result_array();
	}


function user_forget_password($member_email)
	{
		//echo $member_email;
		$this->load->library('email');
		$member_email=$member_email;


		$this->db->select('*');
		$this->db->from('deal_member');
		$this->db->where("member_email",$member_email);
		$k=$this->db->get();
		$result = $k->num_rows();
		if($result==0)
		{
			return false;
		}
		else
		{
			$data = $k->result_array();
			$member_fname=stripslashes($data[0]['fname']);
			$id=stripslashes($data[0]['id']);
			$member_email=stripslashes($data[0]['email']);

			$new_password=$this->module->get_random_password(6, 8, true, true, false);
			$this->module->update_user_password($id,$new_password);
			$message='<html><body><table width="80%" border="0">
			<tr>
			<td colspan="2">
			<a href="#"><img src="'.base_url().'images/logo.png" border="0"></a>
			</td>
			</tr>
			<tr>
			<td colspan="2" style="height:10px;"></td>
			</tr>
			<tr>
			<td width="429" colspan="2">
			<table width="97%" border="0" style="margin:15px;font-family:Arial, Helvetica, sans-serif;font-size:15px;color:#4a4a4a;font-weight:normal;margin-bottom:2px;">
			<tr>
			<td colspan="2">Dear '.$member_fname.',</td>
			</tr>
			<tr>
			<td colspan="2" height="10px;"></td>
			</tr>
			<tr>
			<td colspan="2" height="10px;">Your password has been changed suceessfuly.Your Username and New Password is given below..</td>
			</tr>
			<tr>
			<td colspan="2" height="10px;">Email: '.$member_email.'<br> Password : '.$new_password.'</td>
			</tr>
			<tr>
			<td colspan="2" height="10px;"></td>
			</tr>

			<tr>

			<td colspan="2" height="10px;"><p>Thanks,</p>
			  <p>Deal sheal.</p></td>
			</tr>
</table>';


			//echo $message;die;

				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';


				$this->email->initialize($config);
				$this->email->from($admin_email);
				$this->email->to($member_email);
				$this->email->cc('6412tapas@gmail.com');
				$this->email->bcc('webhawks@gmail.com');
				$this->email->subject('Confirmation Mail for Forget Password');
				$this->email->message($message);
				$this->email->send();
				//echo $this->email->print_debugger();


			   return true;
		}

	}

function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false)
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@04f7c318ad0360bd7b04c980f950833f11c0b1d1quot;#$%&[]{}?|";
        }

        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
            $password .=  $current_letter;
        }

        return $password;
    }

	function update_user_password($id,$new_password)// Changed by Suranjana 25-10-16
	{
		//echo $new_password
		//echo $id;exit;
		$data = array(
				'password'=>$new_password
				);
		//print_r($data);
		$this->db->where('id', $id);

		if($this->db->update('user', $data)){
		//return true;
			echo 1;
		}
	}

	public function getUid($uid = null)
{
    while (! $this->isValid($uid)) {
        $uid = sprintf('%04x%04x%02x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xff));
    }
    return $uid;
}

	public function get_lowtohigh($name)
    {
		$this->db->select('*');

		$this->db->from('deal_product');
		$this->db->join('deal_api', 'deal_product.api_id = deal_api.id');
		$this->db->order_by("product_price", "asc");
		$this->db->where('product_name',$name);
        $query = $this->db->get();
		return $query->result_array();
    }


	public function get_hightolow($name)
    {
	$this->db->select('*');

		$this->db->from('deal_product');
		$this->db->join('deal_api', 'deal_product.api_id = deal_api.id');
		$this->db->order_by("product_price", "desc");
		$this->db->where('product_name',$name);
        $query = $this->db->get();
		return $query->result_array();



    }


	public function get_AtoZ($category_id)
    {
	        $this->db->select('*');
			$this->db->where('product_category',$category_id);
			$this->db->from('`deal_product`');
			$this->db->order_by("product_name", "asc");
			$query = $this->db->get();
			return $query->result_array();

          }
    public function get_ZtoA($category_id)
    {
	        $this->db->select('*');
			$this->db->where('product_category',$category_id);
			$this->db->from('`deal_product`');
			$this->db->order_by("product_name", "desc");
			$query = $this->db->get();
			return $query->result_array();

          }

		  public function get_lowtohighsp($category_id)
            {
	        $this->db->select('*');
			$this->db->where('product_name',$category_id);
			$this->db->from('deal_product');
			//$this->db->order_by("product_price", "asc");

			$query = $this->db->get();
			 $query->num_rows();
		if($query->num_rows()>0)
		{

			$row= $query->result_array();
			$id= $row[0]['product_category'];
			//echo $id;
		  $this->db->select('*');
			$this->db->where('product_category',$id);
			$this->db->from('`deal_product`');
			$this->db->order_by("product_price", "asc");
			$query = $this->db->get();
			return $query->result_array();

          }
			}


  public function get_hightolowsp($category_id)
			{
					$this->db->select('*');
					$this->db->where('product_name',$category_id);
					$this->db->from('deal_product');
					//$this->db->order_by("product_price", "asc");

					$query = $this->db->get();
					 $query->num_rows();
				if($query->num_rows()>0)
				{

					$row= $query->result_array();
					$id= $row[0]['product_category'];
					//echo $id;
				    $this->db->select('*');
					$this->db->where('product_category',$id);
					$this->db->from('`deal_product`');
					$this->db->order_by("product_price", "desc");
					$query = $this->db->get();
					return $query->result_array();

				  }
			}

		function insert_table($uniue_nu,$project_id,$row_id)
        {
			  $insert_project_deatils = array(
			  'unique_id'=> $uniue_nu,
			  'f_projectid'=>$project_id,
			  'row_id'=>$row_id

		      );

			  $insert = $this->db->insert('project_datails', $insert_project_deatils);
			  echo 1;


		}
		function insert_table2($uniue_nu,$project_id,$row_id)
        {
			     $insert_project_deatils = array(
				'unique_id'=>$uniue_nu,
				'f_projectid'=>$project_id,
				'row_id'=>$row_id

		      );

			  $insert = $this->db->insert('project_details_tbl2', $insert_project_deatils);
			  echo 1;


		}
			function get_table_data($id,$pid)
			{
			        $this->db->select('*');
					$this->db->where('row_id',$id);
					$this->db->where('f_projectid',$pid);
					$this->db->from('project_datails');
					$query = $this->db->get();
					return $query->result_array();

			}
			function get_table_data2($id,$pid)
			{
			        $this->db->select('*');
					$this->db->where('row_id',$id);
					$this->db->where('f_projectid',$pid);
					$this->db->from('project_details_tbl2');
					$query = $this->db->get();
					return $query->result_array();



			}
	         function save_table($unique_id,$data_to_save)
			 {
				 $this->db->where('unique_id', $unique_id);
				 if($this->db->update('project_datails',$data_to_save))
				 {

				   echo 1;
				}
			 }

		 	function delete_table_row($id)
			{
				$this->db->where('unique_id', $id);
				if($this->db->delete('project_datails'))
				{
				  return true;
				}

	        }

			 	function delete_table_row2($row_unique_id)
			{
				$this->db->where('unique_id', $row_unique_id);
				if($this->db->delete('project_details_tbl2'))
				{
				  return true;
				}

	        }

				function delete_member_data($id)
			{
				$this->db->where('id', $id);
				if($this->db->delete('create_members'))
				{
				   redirect('main/browse_members');
				}

	        }

			function save_data_table2($uniue_id,$tabl_data2)
			{
				 $this->db->where('unique_id',$uniue_id);
				 if($this->db->update('project_details_tbl2',$tabl_data2))
				 {

				   echo 1;
				}

			}
		function edit_member_details($id)
		{
		    $this->db->select('*');
			$this->db->where('id',$id);
			$this->db->from('create_members');
			$query = $this->db->get();
			return $query->result_array();
		}

       function update_member_details($id,$member_data)
       {
		  // print_r($member_data);exit;
		  //echo $id;exit;
		  $this->db->where('id',$id);
		 if($this->db->update('create_members',$member_data))
	     {

				 return true;
		 }

	   }

function get_member_name_by_type($user_type)
		{
		    $this->db->select('*');
			$this->db->where('user_type',$user_type);
			$this->db->from('create_members');
			$query = $this->db->get();
			return $query->result_array();
		}

function project_insert($data)
		{
		//echo 1; exit;
		  $insert = $this->db->insert('project_master',$data);

	      return true;

		}

function get_user_detail_by_uid($id)
		{
		    $this->db->select('*');
			$this->db->where('id',$id);
			$this->db->from('create_members');
	        $this->db->join('project_master', 'create_members.id = project_master.assign_to_user_id');
			$query = $this->db->get();
			return $query->result_array();
		}
function get_user_name_by_uid($id)
    {
		$this->db->select('name');
		$this->db->where('id',$id);
		$this->db->from('create_members');
		$query = $this->db->get();
		$admin_name=$query->row()->name;
		return $admin_name;
	}

function get_user_email_by_uid($id)
    {
		$this->db->select('email');
		$this->db->where('id',$id);
		$this->db->from('create_members');
		$query = $this->db->get();
		$admin_email=$query->row()->email;
		return $admin_email;
	}
/*
function get_contents_create_projects()
	{
        $this->db->select('*');
		//$this->db->where('user_type !=','admin' );
        $this->db->from('project_master');
        $this->db->join('create_members', 'create_members.id = project_master.assign_to_user_id');
		$query = $this->db->get();
		return $query->result_array();

    }

    function get_project_details_by_id($id)
		{
		    $this->db->select('*');
			$this->db->where('project_master_id',$id);
			$this->db->from('project_master');
            $this->db->join('create_members', 'create_members.id = project_master.assign_to_user_id');
			$query = $this->db->get();
			return $query->result_array();
		}

function update_project_by_id($id,$member_data)
       {
		  // print_r($member_data);exit;
		  //echo $id;exit;
		  $this->db->where('project_master_id',$id);
		 if($this->db->update('project_master',$member_data))
	     {

				 return true;
		 }

	   }

       function delete_project_data($id)
	{
				$this->db->where('project_master_id', $id);
				if($this->db->delete('project_master'))
				{
				    return true;
				}

	  }
*/
	  function check_password($email,$password)
	  {
	        $password_old=md5($password);
		    $this->db->select('id');
			$this->db->where('email',$email);
			$this->db->where('password',$password_old);
			$this->db->from('create_members');
			$query = $this->db->get();
			if($query->num_rows()==1)
			{
				echo 1;
			}
			else
			{
				echo 2;
			}
	  }

	    function check_password1($password)
	  {
	        $password_old=md5($password);
		    $this->db->select('admin_id');
			$this->db->where('admin_delete_password',$password_old);
			$this->db->from('admin_information');
			$query = $this->db->get();
			if($query->num_rows()==1)
			{
				echo 1;
			}
			else
			{
				echo 2;
			}
	  }
	  function setnew_password($email,$password,$password_data)
	  {
		    $password_old=md5($password);
		    $this->db->select('id');
			$this->db->where('email',$email);
			$this->db->where('password',$password_old);
			$this->db->from('create_members');
			$query = $this->db->get();
			$data=$query->result_array();
			if($query->num_rows()==1)
			{
               	$id=$data[0]['id'];

				 $this->db->where('id',$id);
				 if($this->db->update('create_members',$password_data))
				 {
					echo 1;

				 }
				 else
				 {
					 echo 2;
				 }
			}
	  }

	  function setnew_password1($password,$password_data)
	  {
		    $password_old=md5($password);
		    $this->db->select('admin_id');
			$this->db->where('admin_delete_password',$password_old);
			$this->db->from('admin_information');
			$query = $this->db->get();
			$data=$query->result_array();
			if($query->num_rows()==1)
			{
				 $this->db->where('admin_id','1');
				 if($this->db->update('admin_information',$password_data))
				 {
					echo 1;

				 }
				 else
				 {
					 echo 2;
				 }
			}
	  }

	  function setprofile($user_id,$image_data)
	  {
		//  echo $user_id;
		 // print_r($image_data);exit;
		   $this->db->where('id',$user_id);
		  if($this->db->update('create_members',$image_data))
	     {

				 return true;
		 }

	  }
	  function all_user_names()
	  {
		$this->db->select('first_name,last_name,id ,image');
		$this->db->where('user_type !=','admin' );
        $this->db->from('create_members');
		$query = $this->db->get();
		return $query->result_array();
	  }

	  function confirm_delete_password($admin_delete_pass)
	  {
	        $admin_delete_new=md5($admin_delete_pass);
		    $this->db->select('admin_id');
			$this->db->where('admin_delete_password',$admin_delete_new);
			$this->db->from('admin_information');
			$query = $this->db->get();
			if($query->num_rows()==1)
			{
				echo 1;
			}
			else
			{
				echo 2;
			}


	  }
	 function save_remark_data($fk_id,$filedname,$field_val)
	 {
		 $update_data=array(
		 "$filedname"=>$field_val
		 );
		 //print_r($update_data);
		 $this->db->where('row_id',$fk_id);
		 $this->db->update('excel_export',$update_data);


	 }



	  	function create_folder($create_folder){

			// print_r($create_folder);
			 $insert = $this->db->insert('project_folder', $create_folder);
			if($insert){

				$id = $this->db->insert_id();
				$this->db->select('*');
				$this->db->from('project_folder');
				$this->db->where('id', $id );
				$query = $this->db->get();
				if ( $query->num_rows() > 0 ){
					/* $row = $query->row_array();
					$name = $row['board_id'];
					return $name; */

		         return $query->result_array();
				}

			}
		}

		function create_board_for_project($create_project)
	 {

		// print_r($create_team);
		 $insert = $this->db->insert('create_project', $create_project);
		 if($insert)
		 {
			    $id = $this->db->insert_id();
				$this->db->select('*');
				$this->db->from('create_project');
				$this->db->where('project_id', $id );
				$query = $this->db->get();
				//print_r($query);
				if ( $query->num_rows() > 0 ){
					/* $row = $query->row_array();
					$name = $row['board_id'];
					return $name; */

		         return $query->result_array();

				}
		  }
		    // return $query->result_array();
			// return $this->db->insert_id();
	 }
	 function create_project_header($create_project_header)
	 {

		// print_r($create_team);
		 $insert = $this->db->insert('project_header', $create_project_header);
		 if($insert)
		 {
			 echo "1";

		  }

	 }

	 function create_project_row($create_project_row)
	 {

		// print_r($create_team);
		 $insert = $this->db->insert('project_rows', $create_project_row);
		 if($insert)
		 {
			 echo "1";

		  }

	 }
		function status_fetch_color($uid)
		{
			//header('Content-Type: application/json');
			$this->db->select('*');
			$this->db->from('status_text');
            $this->db->where('unique_id', $uid );
            //$this->db->where('fk_projectid', $fk_project_id );
			$query = $this->db->get();
		    return $data=$query->result_array();
			//echo json_encode($data);
		}

		function save_status($status_data,$uid)
		{

			$this->db->where('unique_id',$uid);
			if($this->db->update('status_text',$status_data))
			{
					//echo 1;

			}

		}
		function thead_data($fild_class,$fild_name,$fk_project_id,$group_name,$after_key,$set_direct)
	   	{
			//echo $fk_project_id;
           $new_add=array(
		   "$fild_name".'_'.$fild_class=>$fild_name);
		   $this->db->select('*');
		   $this->db->where('project_id',$fk_project_id);
           $this->db->from('project_header');
		   $query_header = $this->db->get();


		 if($query_header->num_rows > 0)
		  {
		   $data_header=$query_header->result_array();
		   //print_r($data_header);
		   $old_data=$data_header[0]['head_data'];

		    $je_ar4444=json_decode($old_data, true);

		    $offset = array_search($after_key, array_keys($je_ar4444));
           if($set_direct=='after')
		   {
             $set_posstion= $offset+1;
		   }
		   if($set_direct=='before')
		   {
			  $set_posstion= $offset;
		   }
		  //echo $offset;

		   //$total_data=array_merge($je_ar4444,$new_add);
		   $total_data=array_merge(array_slice($je_ar4444, 0, $set_posstion), $new_add, array_slice($je_ar4444, $set_posstion));
		  // print_r($total_data);
		   $final_data=json_encode($total_data);

		   //$final_footer_data=json_encode($total_footer);


			$insert_data=array(
			'head_data'=>$final_data
			);
          // print_r($insert_data)
		    $this->db->where('project_id',$fk_project_id);
		    if($this->db->update('project_header',$insert_data))
			{
			  //echo 1;
			}

		   $this->db->select('*');
		   $this->db->where('fk_project_id',$fk_project_id);
           $this->db->from('project_rows');
		   $query = $this->db->get();
		   $data_row=$query->result_array();
		   //print_r($data_row);
		   foreach($data_row as $key=>$value)
		   {
			    $old_row_data=$value['row_data'];
				$ar_data=json_decode($old_row_data, true);
				$offset_row = array_search($after_key, array_keys($ar_data));

            if($set_direct=='after')
		     {
			   $set_posstion_row= $offset_row+1;
			 }
			 if($set_direct=='before')
		     {
			   $set_posstion_row= $offset_row;
			 }

				//echo $set_posstion_row;
				 $tota_row_data=array_merge(array_slice($ar_data, 0, $set_posstion_row), $new_add, array_slice($ar_data, $set_posstion_row));
				//$tota_row_data=array_merge($ar_data,$new_add);

				$after_encode_row=json_encode($tota_row_data);
                $updte_row_data=array('row_data'=>$after_encode_row);

				$this->db->where('id',$value['id']);
		        if($this->db->update('project_rows',$updte_row_data))
			    {
			          //echo "All rows updated";
			    }


		   }
		  }

		   else
		  {
			  //echo"okkkkkk";die;
			  $insert_new_data=json_encode($new_add);
			  $insert_data_new=array(
			'head_data'=>$insert_new_data,
			'project_name'=>$group_name,
			'project_id'=>$fk_project_id
			);
          $insert = $this->db->insert('project_header', $insert_data_new);
		  }
		   /*
		       $this->db->where('fk_project_id','1');
		        if($this->db->update('project_rows',$updte_row_data))
			    {
			          //echo "All rows updated";
			    }
				*/

		}




	function tbody_data($first_id,$first_value,$uid,$project_id)
	{  //echo $uid;
		$add_row=array(
		'Firstrow_'.$first_id=>$first_value
		);
		   $this->db->select('*');
		   $this->db->where('project_id',$project_id);
           $this->db->from('project_header');
		   $query = $this->db->get();
		   $data=$query->result_array();
		   $old_data=$data[0]['head_data'];
		 // print_r($old_data);
		  if($old_data=='')
		  {
			  //echo"okkkkkk";
			  $insert_new=json_encode($add_row);
			  $insert_data=array(
			'row_data'=>$insert_new,
			'fk_project_id'=>$project_id,
			'unique_id'=>$uid


			);
		  }
		  else
		  {
			  //echo"okkkkkk";
		   $je_ar4444=json_decode($old_data, true);
           $total_data=array_merge($add_row,$je_ar4444);
		   //print_r($total_data);
		    $final_data=json_encode($total_data);
			$insert_data=array(
			'row_data'=>$final_data,
			'fk_project_id'=>$project_id,
			'unique_id'=>$uid
			);
		  }
		   $insert = $this->db->insert('project_rows', $insert_data);
	       if($insert)
		   {
			echo $my_id= $this->db->insert_id();

			 $inser_row_id=array(
			 'unique_id'=>$uid,
			 'f_projectid'=>$project_id,
			 'row_id'=>$my_id
			 );
			 $insert_excel_export=array(
			 'fk_poject_id'=>$project_id,
			 'row_id'=>$my_id

			 );
			  $this->db->insert('project_datails', $inser_row_id);
			  $this->db->insert('project_details_tbl2', $inser_row_id);
			  $this->db->insert('excel_export', $insert_excel_export);
		   }

	}

	function header_data()
	{
		   $this->db->select('*');
		   $this->db->where('project_id','1' );
           $this->db->from('project_header');
		   $query =$this->db->get();
		   return $query->result_array();
	}

	 function allrow_data()
	 {
		   $this->db->select('*');
		   $this->db->where('fk_project_id','1' );
           $this->db->from('project_rows');
		   $query =$this->db->get();
		   return $query->result_array();
	 }

	 function edit_header($field_key,$field_val,$id)
	 {
		   $this->db->select('*');
		   $this->db->where('project_id',$id );
           $this->db->from('project_header');
		   $query = $this->db->get();
		   $data_row=$query->result_array();
		  foreach($data_row as $key=>$value)
		  {
			  $hed_data=$value['head_data'];
			  $f_d=json_decode($hed_data, true);
			  foreach($f_d as $key=>$v)
			 {
				$f_d["$field_key"]="$field_val";
			}
		  }
		  $udate_data=json_encode($f_d);
	      $update_data=array('head_data'=>$udate_data);
	      $this->db->where('project_id',$id);
		    if($this->db->update('project_header',$update_data))
			{
			  echo 1;
			}
		}

		function save_field_all($fieldall_key,$fieldall_value,$row_id,$board_id)
		{
			   $this->db->select('*');
			   $this->db->where('unique_id',$row_id);
			   $this->db->from('project_rows');
			   $query = $this->db->get();
			   $persion_arr='';
			   $data_row=$query->result_array();
			  foreach($data_row as $key=>$value)
			  {
				  $row223_data=$value['row_data'];
				  $check_projecctid=$value['fk_project_id'];
				  $new_data=json_decode($row223_data, true);
				  $persion_key= explode("_",$fieldall_key);
			  }
			  foreach($new_data as $key=>$val2)
			  {
				 // echo
				 $new_data["$fieldall_key"]="$fieldall_value";
			  }

			  $up_newdata=json_encode($new_data);
			   // echo $assign_persion;
					$update_newdata=array(
				    'row_data'=>$up_newdata
				  );


			//  print_r($update_newdata);
	          $this->db->where('unique_id',$row_id);
		      if($this->db->update('project_rows',$update_newdata))
			   {
			     //echo 1;
			   }
			   $this->db->select('*');
			   $this->db->where('fk_project_id',$check_projecctid);
			   $this->db->from('project_rows');
			   $query = $this->db->get();
			   $header_data=$query->result_array();
			   foreach($header_data as $header_key=>$header_val)
			   {
				   $decode_row=json_decode($header_val['row_data'], true);
				   foreach($decode_row as $decode_key=>$decode_val)
				   {
					  $find_persion=explode("_",$decode_key);
					  if($find_persion[0]=='Person')
					  {
						 $persion_arr[].=$decode_val;
					  }
				   }

			   }
		       $arr_unique=array_unique($persion_arr);
			   $save_intohedare=implode(",",$arr_unique);

			     $save_array_header=array(
			     'persion_assign'=>$save_intohedare
			    );
			    $this->db->where('project_id',$check_projecctid);
		        $this->db->update('project_header',$save_array_header);

			   $this->db->select('assgin_user');
			   $this->db->where('board_id',$board_id);
			   $this->db->from('project_folder');
			   $query_fl= $this->db->get();
			   $header_data=$query_fl->result_array();
               $a=explode(",",$header_data[0]['assgin_user']);
               $b=array_merge($a,$arr_unique);
			   $b_uniue=array_unique($b);
			   $save_folder_user=implode(",",$b_uniue);


			   $save_folder_assign=array('assgin_user'=>$save_folder_user);
			   $this->db->where('board_id',$board_id);
		       $this->db->update('project_folder',$save_folder_assign);
		}
		function save_project_name($priject_id,$project_val)
		{
			  $updateproject=array('project_name'=>$project_val);
			  $this->db->where('project_id',$priject_id);
		      if($this->db->update('project_header',$updateproject))

			   {
			     echo 1;
			   }
		}

		function all_table($page_name,$search_data)
		{

			$this->db->select('create_project.*');
            $this->db->select('project_header.*');
            $this->db->from('create_project');
			if($search_data==2)
			{
			$this->db->where('create_project.page_name',"$page_name");
			}
			else{
            $this->db->where("project_header.project_name LIKE '$search_data%' ");
			}

		   $this->db->join('project_header', 'create_project.project_id = project_header.project_id');
            $this->db->order_by('create_project.project_id','desc');
			$query = $this->db->get();
			//echo $this->db->last_query();exit;
			return $table_row=$query->result_array();


		}
		function row_details($id)
		{
			$this->db->select('*');
            $this->db->from('project_rows');
			$this->db->where('fk_project_id',$id);
            $query = $this->db->get();
			return $table_row=$query->result_array();


		}
		function get_image($tbody)
		{
			$this->db->select('id,first_name,last_name,image');
            $this->db->from('create_members');
			$this->db->where('id',"$tbody");
            $query = $this->db->get();
			return $image_row=$query->result_array();

		}
		function get_header($id)
		{
			$this->db->select('head_data,project_name');
            $this->db->from('project_header');
			$this->db->where('project_id',"$id");
            $query = $this->db->get();
			return $header_data=$query->result_array();
		}

		function get_board_name($id)
		{
		    $this->db->select('menu_name');
            $this->db->from('project_folder');
			$this->db->where('board_id',"$id");
            $query1 = $this->db->get();
			return $project_data=$query1->result_array();
			//print_r($project_data); exit;
       }
	   function board_name($page_name)
	   {
		    $this->db->select('menu_name');
            $this->db->from('project_folder');
			$this->db->where('board_id',"$page_name");
            $query1 = $this->db->get();
			return $board_name=$query1->result_array();
	   }
	   function get_board_name_id()
		{
		    $this->db->select('board_id,menu_name,meny_type,id,assgin_user');
            $this->db->where('parent_id',0);
            $this->db->from('project_folder');
            $query1 = $this->db->get();
			return $board_name=$query1->result_array();


		}

		function get_submenu_id($id)
		{
	    	$this->db->select('board_id,menu_name,meny_type,id,assgin_user');
            $this->db->where('parent_id',$id);
            $this->db->from('project_folder');
            $query1 = $this->db->get();
			return $board_name=$query1->result_array();
		}
	  /*
	   function get_menu_name_id()
		{
		    $this->db->select('board_id,menu_name,meny_type');
            $this->db->from('project_folder');
            $query1 = $this->db->get();
			return $board_name=$query1->result_array();


		}
		*/
		 function get_board_name_by_parent_id($parent_id)
		{
			//echo $parent_id;die;
		    $this->db->select('id,board_id,menu_name');
            $this->db->from('project_folder');
			$this->db->where('parent_id',$parent_id);
			$this->db->where('meny_type','board');
            $query1 = $this->db->get();
			return $query1->result_array();


		}

		 function save_footer_all($fieldkey_all,$field_val,$project_id)
	 {
        //echo $field_val;

		   $this->db->select('*');
		   $this->db->where('project_id',$project_id);
           $this->db->from('project_header');
		   $query = $this->db->get();
		   $data_row=$query->result_array();
		  foreach($data_row as $key=>$value)
		  {
			  $hed_data=$value['footer_data'];
			  $f_d=json_decode($hed_data, true);
			  foreach($f_d as $key=>$v)
			 {
				$f_d["$fieldkey_all"]="$field_val";
			 }
		  }
		  $udate_data=json_encode($f_d);

		  $update_data=array('footer_data'=>$udate_data);
	      $this->db->where('project_id',$project_id);
		    if($this->db->update('project_header',$update_data))
			{
			  echo 1;
			}
		}
  function save_group_color($project_id,$color)
 {
		//echo $project_id.$color;
		$chng_colr=array('group_color'=>$color);
		$this->db->where('project_id',$project_id);
		if($this->db->update('project_header',$chng_colr))
	    {
			  echo 1;
	    }


 }

 function save_board_name($board_id,$board_name)
 {
	 $update_board=array('menu_name'=>$board_name);
	 $this->db->where('board_id',$board_id);
		if($this->db->update('project_folder',$update_board))
	    {
			 // echo 1;
	    }

 }

 function set_status($fild_class,$fild_name,$project_id)
 {
	       $unique_id=$fild_name.'_'.$fild_class;
		   $insert_status_data=array(
		   'unique_id'=>$unique_id,
		   'fk_projectid'=>$project_id
		   );
		  $insert = $this->db->insert('status_text', $insert_status_data);
 }

 public function delete_user($id)
 {
	$this->db->where('id', $id);
	if($this->db->delete('create_members'))
	{
	  echo 1;
	}
    else{
	   echo 2;
   }
 }

 function delete_group($project_id)
 {
	        $this->db->where('project_id', $project_id);
		    $this->db->delete('create_project');

			$this->db->where('project_id', $project_id);
		    $this->db->delete('project_header');

			$this->db->where('fk_project_id', $project_id);
		    $this->db->delete('project_rows');

		    $this->db->where('fk_projectid', $project_id);
		    $this->db->delete('status_text');

			$this->db->where('f_projectid', $project_id);
		    $this->db->delete('project_datails');

			$this->db->where('f_projectid', $project_id);
		    $this->db->delete('project_details_tbl2');


 }


 function fetch_boardname($boardid)
 {
	   $this->db->select('*');
	   $this->db->where('meny_type','board');
	   $this->db->where('board_id !=',$boardid);
       $this->db->from('project_folder');
	   $query = $this->db->get();
	   return $query->result_array();
 }

	 function search_person($serch_word)
	  {
		$this->db->select('first_name,last_name,id ,image');
		$this->db->where('user_type !=','admin' );
		$this->db->where("first_name LIKE '%$serch_word%' OR last_name LIKE '%$serch_word%' ");
        $this->db->from('create_members');
		$query = $this->db->get();
		return $query->result_array();
	  }
	  function setexcelexport($project_id)
	  {
		 $insert_project_id=array(
		 'fk_poject_id'=>$project_id

		 );
		  $insert = $this->db->insert('excel_export', $insert_project_id);
	  }
	  function create_new_group($id,$project_id,$group_name)
	  {
		  //echo $id.$project_id;
		   $this->db->select('head_data');
		   $this->db->where('project_id',$project_id);
           $this->db->from('project_header');
		   $query_row_data = $this->db->get();
		   $new_group=$query_row_data->result_array();
		   $new_group[0]['head_data'];
		   $insert_newgroup=array(
		   'head_data'=>$new_group[0]['head_data'],
           'project_id'=>$id,
           'project_name'=>$group_name
		   );
		   $insert = $this->db->insert('project_header', $insert_newgroup);

	  }

	  function check_alarm($id)
	  {
		   $this->db->select('set_alarm');
		   $this->db->where('row_id',$id);
           $this->db->from('excel_export');
		   $query_row_data = $this->db->get();
		   return $alerm_set=$query_row_data->result_array();
	  }
	  public function set_alarm($row_id,$type)
	  {
		  if($type==1)
		  {
			  $set_alerm='set';
		  }
		  else
		  {
			 $set_alerm='unset';
		  }
		      $updte_alarm=array('set_alarm'=>$set_alerm);
			  $this->db->where('row_id',$row_id);
			  $this->db->update('excel_export',$updte_alarm);


	  }
	public function get_adminoption()
	{
		    $this->db->select('*');
		    $this->db->where('id',1);
            $this->db->from('admin_option');
		    $query_row_data = $this->db->get();
		    return $admin_option=$query_row_data->result_array();
			//print_r($admin_option);exit;

	}
	public function set_adminoption($update_option)
	{
		//$update_option
		      $this->db->where('id',1);
			  $this->db->update('admin_option',$update_option);
	}
	public function get_admindata()
	{
        //echo 1;exit;

		   $this->db->select('*');
		    $this->db->where('user_type','admin');
            $this->db->from('create_members');
		    $query_row_data = $this->db->get();
		    return $admin_option=$query_row_data->result_array();
	}


	public function all_actveuser()
	{
		 //echo 1;exit;
		   $this->db->select('status');
		   $this->db->where('user_type','users');
		   $this->db->where('status','Active');
           $this->db->from('create_members');
		   $query_active_data = $this->db->get();
	       return $query_active_data->num_rows;

	}
	public function all_deactiveuser()
	{
		 //echo 1;exit;
		   $this->db->select('status');
		   $this->db->where('user_type','users');
		   $this->db->where('status','Inactive');
           $this->db->from('create_members');
		   $query_active_data = $this->db->get();
	       return $query_active_data->num_rows;

	}
	public function allbrowser()
	{
		   $this->db->select('*');
		   $this->db->where('id',1);
           $this->db->from('all_browser');
		   $query_active_data = $this->db->get();
	       $query_active_data->num_rows;

		   return $admin_option=$query_active_data->result_array();

	}
	public function get_banner_img()
	{ 
		   $this->db->select('*');
           $this->db->from('banner');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function get_banner_byid($id)
	{
		   $this->db->select('*');
		   $this->db->where('id',$id);
           $this->db->from('banner');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}

	public function edit_banner($id,$update_banner)
	{
		 $this->db->where('id',$id);
		 if($this->db->update('banner',$update_banner))
		 {
			 return true;
		 }
	}
	public function change_logo($chg_logo)
	{
		 $this->db->where('id','1');
		 if($this->db->update('admin_option',$chg_logo))
		 {
			 return true;
		 }
	}
	public function getsite_logo()
	{
		   $this->db->select('logo');
		   $this->db->where('id','1');
           $this->db->from('admin_option');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function get_menu()
	{
		   $this->db->select('*');
           $this->db->from('menu_items');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function get_menu_byid($id)
	{
		   $this->db->select('*');
		   $this->db->where('menu_id',$id);
           $this->db->from('menu_items');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function update_menu($update_item,$id)
	{

		 $this->db->where('menu_id',$id);
		 if($this->db->update('menu_items',$update_item))
		 {
			 return true;
		 }
	}
	public function update_social_media($social_arr)
{
	     //echo "<pre>";
		// print_r($about_arr);exit;
	     $this->db->where('id',1);
		 if($this->db->update('social_media',$social_arr))
		 {
			 return true;
		 }
}
public function get_social_media()
	{

			$this->db->select('*');
			$this->db->where('id', 1);
			$this->db->from('social_media');

			$query = $this->db->get();
			return $query->result_array();
	}

	function delete_faq($id){
		$this->db->where('faq_id', $id);
		$this->db->delete('faq');
	}
	 function add_gallery($data)
 {
  $insert = $this->db->insert('car_gallery', $data);
  return true;
 }



 public function get_gallery_img()
 {
     $this->db->select('*');
           $this->db->from('car_gallery');
     $query_gallery_data = $this->db->get();
        $query_gallery_data->num_rows;
     return $query_gallery_data->result_array();
 }

 public function edit_gallery($id,$update_gallery)
 {
   $this->db->where('id',$id);
   if($this->db->update('car_gallery',$update_gallery))
   {
    return true;
   }
 }

 public function get_gallery_data_by_id($id)
 {

       $this->db->select('*');
       $this->db->where('id',$id);
       $this->db->from('car_gallery');
       $query_gallery_data = $this->db->get();
       $query_gallery_data->num_rows;
       return $query_gallery_data->result_array();
 }

 public function del_gallery_img($id)
 {
         $this->db->where('id', $id);
    if($this->db->delete('car_gallery'))
    {
       return true;
    }
 }
 public function sercice_data()
 {
	   $this->db->select('*');
       $this->db->from('boook_service');
       $query_gallery_data = $this->db->get();
       return $query_gallery_data->result_array();
 }

public function sercice_data_limit() {

	  $page_no=$this->uri->segment(2);
	  $no_items=12;
	  if($page_no==''){
		$page_no=1;
	  }
	  $start=($page_no-1) * $no_items;
      $this->db->select('*');
      $this->db->from('boook_service');
	  $this->db->limit($no_items,$start);
	  $this->db->order_by("id", "desc");
      $query = $this->db->get();
      return $query->result_array();
}
public function test_drive()
 {
	   $this->db->select('*');
       $this->db->from('test_drive');
       $query_gallery_data = $this->db->get();
       return $query_gallery_data->result_array();
 }

public function test_drive_limit() {

	  $page_no=$this->uri->segment(2);
	  $no_items=12;
	  if($page_no==''){
		$page_no=1;
	  }
	  $start=($page_no-1) * $no_items;
      $this->db->select('*');
      $this->db->from('test_drive');
	  $this->db->limit($no_items,$start);
	  $this->db->order_by("id", "desc");
      $query = $this->db->get();
      return $query->result_array();
}
 function add_career($data)
 {
  $insert = $this->db->insert('career', $data);
  return true;
 }
 function career_list()
 {
  $this->db->select('*');
           $this->db->from('career');
     $query_gallery_data = $this->db->get();
        $query_gallery_data->num_rows;
     return $query_gallery_data->result_array();

 }

 function apply_job()
 {
  $this->db->select('*');
           $this->db->from('apply_job');
     $query_gallery_data = $this->db->get();
        $query_gallery_data->num_rows;
     return $query_gallery_data->result_array();


 }

 function get_career_byid($id)
 {
   $this->db->select('*');
    $this->db->where('id',$id);
           $this->db->from('career');
     $query_gallery_data = $this->db->get();
        $query_gallery_data->num_rows;
     return $query_gallery_data->result_array();
 }

  public function edit_career_by_id($id,$update_career)
 {
   $this->db->where('id',$id);
   if($this->db->update('career',$update_career))
   {
    return true;
   }
 }

  public function del_career($id)
 {
      $this->db->where('id', $id);
      if($this->db->delete('career'))
      {
       return true;
    }
 }
	function add_portfolio($data)
 {
 // print_r($data);exit;
  $insert = $this->db->insert('portfolio', $data);
  return true;
 }
  public function list_portfolio()
 {
     $this->db->select('*');
           $this->db->from('portfolio');
     $query_gallery_data = $this->db->get();
        $query_gallery_data->num_rows;
     return $query_gallery_data->result_array();
 }

  public function del_portfolio($id)
 {
         $this->db->where('id', $id);
    if($this->db->delete('portfolio'))
    {
       return true;
    }
 }


  function get_portfolio_data_by_id($id)
 {
   $this->db->select('*');
    $this->db->where('id',$id);
           $this->db->from('portfolio');
     $query_gallery_data = $this->db->get();
        $query_gallery_data->num_rows;
     return $query_gallery_data->result_array();
 }


  public function update_portfolio_by_id($id,$update_career)
 {
   $this->db->where('id',$id);
   if($this->db->update('portfolio',$update_career))
   {
    return true;
   }
 }


 //..............................................


 function add_news($data)
 {
 //print_r($data);exit;
  $insert = $this->db->insert('recent_news', $data);
  return true;
 }
  public function list_news()
 {
     $this->db->select('*');
           $this->db->from('recent_news');
     $query_gallery_data = $this->db->get();
        $query_gallery_data->num_rows;
     return $query_gallery_data->result_array();
 }

  public function del_news($id)
 {
         $this->db->where('id', $id);
    if($this->db->delete('recent_news'))
    {
       return true;
    }
 }


  function get_news_data_by_id($id)
 {
   $this->db->select('*');
    $this->db->where('id',$id);
           $this->db->from('recent_news');
     $query_gallery_data = $this->db->get();
        $query_gallery_data->num_rows;
     return $query_gallery_data->result_array();
 }


  public function update_news_by_id($id,$update_career)
 {
 //print_r($update_career);exit;

   $this->db->where('id',$id);
   if($this->db->update('recent_news',$update_career))
   {
    return true;
   }
 }

	public function update_aboutus($about_arr)
{
      //echo "<pre>";
  // print_r($about_arr);exit;
      $this->db->where('id',1);
   if($this->db->update('about_us',$about_arr))
   {
    return true;
   }
}
 public function list_about_data()
 {
     $this->db->select('*');
           $this->db->from('about_data');
     $query_gallery_data = $this->db->get();
        $query_gallery_data->num_rows;
     return $query_gallery_data->result_array();
 }  public function update_about_by_id($id,$update_career)
 {
   $this->db->where('id',$id);
   if($this->db->update('about_data',$update_career))
   {
    return true;
   }
 }
  public function get_about_data_by_id($id)
 {
 $this->db->where('id',$id);

  $this->db->select('*');
    $this->db->where('id',$id);
           $this->db->from('about_data');
     $query_gallery_data = $this->db->get();
        $query_gallery_data->num_rows;
     return $query_gallery_data->result_array();
 }
 public function get_banner_offer()
 {
   //echo 1; exit;
     $this->db->select('*');
           $this->db->from('offer_banner');
     $query_banner_data = $this->db->get();
  //echo $this->db->last_query();exit;

        $query_banner_data->num_rows;
     return $query_banner_data->result_array();
 }

  public function get_banner_offerid($id)
 {
     $this->db->select('*');
     $this->db->where('id',$id);
           $this->db->from('offer_banner');
     $query_banner_data = $this->db->get();
        $query_banner_data->num_rows;
     return $query_banner_data->result_array();
 }

 public function edit_banner_offer($id,$update_banner)
 {
   $this->db->where('id',$id);
   if($this->db->update('offer_banner',$update_banner))
   {
    return true;
   }
 }
 /**delete section start*/

 public function del_service($id)
 {
     $this->db->where('id', $id);
    if($this->db->delete('boook_service'))
    {
       return true;
    }
 }
 public function del_test($id)
 {
     $this->db->where('id', $id);
    if($this->db->delete('test_drive'))
    {
       return true;
    }
 }
 public function del_servicelist($id)
 {
     $this->db->where('service_id', $id);
    if($this->db->delete('our_service'))
    {
       return true;
    }
 }
 public function del_listmodel($id)
 {
     $this->db->where('model_id', $id);
    if($this->db->delete('car_model'))
    {
       return true;
    }
 }
 public function del_listcar($id)
 {
     $this->db->where('car_id', $id);
    if($this->db->delete('car'))
    {
		  $this->db->where('fk_carid', $id);
		  $this->db->delete('car_exterior_image');

		  $this->db->where('fk_carid', $id);
		  if($this->db->delete('car_interior_image')){
			  return true;
		  }
    }
 }
 public function del_excahnge($id)
 {
     $this->db->where('excahnge_id', $id);
    if($this->db->delete('exchange_vechile'))
    {
       return true;
    }
 }
   function add_mahindra_app($data)
 {
  $insert = $this->db->insert('mahindra_app', $data);
  return true;
 }

  function add_sleep($data)
 {
  $insert = $this->db->insert('sleep_page', $data);
  return true;
 }

  public function get_mahindra_app()
 {
     $this->db->select('*');
           $this->db->from('mahindra_app');
     $query_gallery_data = $this->db->get();
        $query_gallery_data->num_rows;
     return $query_gallery_data->result_array();
 }

 public function get_mehindra_app_by_id($id)
 {

       $this->db->select('*');
       $this->db->where('id',$id);
       $this->db->from('mahindra_app');
       $query_gallery_data = $this->db->get();
       $query_gallery_data->num_rows;
       return $query_gallery_data->result_array();
 }

  public function edit_mehindra_app($id,$update_gallery)
 {
   $this->db->where('id',$id);
   if($this->db->update('mahindra_app',$update_gallery))
   {
    return true;
   }
 }

  public function del_mahindra_app($id)
 {
         $this->db->where('id', $id);
    if($this->db->delete('mahindra_app'))
    {
       return true;
    }
 }
 public function get_allemailid()
 {
	   $this->db->select('email');
       $this->db->from('subscribe');
       $query_gallery_data = $this->db->get();
       return $query_gallery_data->result_array();
 }
 public function get_seo()
	{
			$this->db->select('*');
			$this->db->from('seo');
			$query = $this->db->get();
			return $query->result_array();
	}

 public function get_seobyid($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('seo');
		$query = $this->db->get();
		return $query->result_array();
	}
 public function updateseobyid($id,$seo_data)
	{
		$this->db->where('id',$id);
		 if($this->db->update('seo',$seo_data))
		 {
			 return true;
		 }
	}


 function add_doctors($data)
 {
  $insert = $this->db->insert('doctors_page', $data);
  return true;
 }
 function doctors_list()
	{
		 $this->db->select('*');
		// $this->db->where('product_id',$id);

         $this->db->from('doctors_page');
         $query = $this->db->get();
		 return $query->result_array();
	}

 public function get_doctors_by_id($id)
	 {
		   $this->db->select('*');
		   $this->db->where('id',$id);
           $this->db->from('doctors_page');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}

 public function edit_doctors($id,$edit_doctors)
	{
		 $this->db->where('id',$id);
		 if($this->db->update('doctors_page',$edit_doctors))
		 {
			//echo $this->db->last_query();exit;
			 return true;

		 }
	}
	//================================== 17-04-18 =======================================//
	function appointment_list()
 {
  $this->db->select('*');
           $this->db->from('book_an_appoinment');
          $query_gallery_data = $this->db->get();
        $query_gallery_data->num_rows;
     return $query_gallery_data->result_array();

 }

 public function appont_del($id)
 {
         $this->db->where('id', $id);
    if($this->db->delete('book_an_appoinment'))
    {
       return true;
    }
 }
 function get_doc_name_list(){
 	     $this->db->select('*');
		$this->db->from('doctors_page');
		$query = $this->db->get();
		return $query->result_array();
 }
 public function edit_appointment($id,$update_cateorgy)
	{
		 $this->db->where('id',$id);
		 if($this->db->update('book_an_appoinment',$update_cateorgy))
		 {
			 //echo $this->db->last_query();exit;
			 return true;

		 }
	}
	public function get_appont_byid($id)
	 {
		   $this->db->select('*');
		   $this->db->where('id',$id);
           $this->db->from('book_an_appoinment');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}

	function get_sleep_list(){
	    $this->db->select('*');
		$this->db->from('sleep_page');
		$query = $this->db->get();
		return $query->result_array();
	}
	 public function edit_sleep($id,$update_gallery)
 {
   $this->db->where('id',$id);
   if($this->db->update('sleep_page',$update_gallery))
   {
    return true;
   }
 }
  public function get_sleep_by_id($id)
 {

       $this->db->select('*');
       $this->db->where('id',$id);
       $this->db->from('sleep_page');
       $query_gallery_data = $this->db->get();
       $query_gallery_data->num_rows;
       return $query_gallery_data->result_array();
 }
 function get_order_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('order_table');
		$query = $this->db->get();
		return $query->result_array();
	 }
	  public function edit_order_id($id,$order_data)
  {
   $this->db->where('order_id',$id);
   if($this->db->update('order_table',$order_data))
   {
    return true;
   }
 }
 public function get_order_byid($id)
	{

		$this->db->select('*');
		$this->db->where('order_id',$id);
		$this->db->from('order_table');
		$query = $this->db->get();
		return $query->result_array();

	}
  public function allbrand($categoryid)
  {

    $this->db->select('*');
    $this->db->where('main_category',$categoryid);
    $this->db->from('brand');
    $query = $this->db->get();
    return $query->result_array();

  }

}
?>
