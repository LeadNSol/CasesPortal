<?php
//echo "kkPrak"; exit;
class Product_module extends CI_Model
{
    function __construct()
    {
		$this->load->database();
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
    }
    
    function add_user_check($email,$phone)
	{
		$this->db->select('*');
		//$this->db->where('phone', $phone);
		$this->db->where('email', $email);
		$this->db->from('user');
		$query = $this->db->get();
		$result = $query->num_rows();
		if($result==0)
		{
			$this->db->select('*');
			$this->db->where('phone', $phone);
			//$this->db->where('email', $email);
			$this->db->from('user');
			$query = $this->db->get();
			$result = $query->num_rows();
			if($result==0)
		{	
			return true;
		}else
		{
			return false; 
	 	}
		}
		else{
		   	return false; 
		}
		
}
    
    
    function delete_chapter_name($id){
		$this->db->where('chapter_name_id', $id);
		$this->db->delete('chapter_name');
	}
    
    function fetch_packages($id)
	{
        $this->db->select('*');
		$this->db->from('subscription');
		 $this->db->where('user_id',$id);
		$this->db->join('packege', 'packege.pack_id = subscription.package_id');
	    //$this->db->join('user', 'user.u_id = subscription.user_id');
	   // $this->db->join('class', 'class.id =subscription.user_classs_id');
		$query = $this->db->get();
		return $query->result_array();
	 }
    //   public function check_subscription($user_id,$class_id)
	//  {
	// 	   $this->db->select('*');
	// 	   $this->db->where('user_id',$user_id);
	// 	   $this->db->where('user_classs_id',$class_id);
    //        $this->db->from('subscription');
	// 	   $query_banner_data = $this->db->get();
	// 	  return $query_banner_data->result_array();
	// }
	
	public function check_subscription_expairy($class_id,$user_id)
	 {
		   $this->db->select('*');
		   $this->db->where('user_id',$user_id);
		   $this->db->where('user_classs_id',$class_id);
           $this->db->from('subscription');
		   $query_banner_data = $this->db->get();
		  return $query_banner_data->result_array();
	}
	
	 public function delete_subscription_details($id)
	 {
		   $this->db->where('subject_subs_id',$id);
         if($this->db->delete('subject_subscription'))
         {
             return true;
         }
		  
	}
	
	
    function list_user_qureys()
	{
        $this->db->select('*');
		$this->db->from('user_qurey');
	    $this->db->join('user', 'user.u_id = user_qurey.quirey_id');
		$query = $this->db->get();
		return $query->result_array();
	 }
    
  	  public function user_qureis($cat_arr)
	{

		   if($insert = $this->db->insert('user_qurey', $cat_arr))
		   {
			
			   return true;
		   }
	}
    	public function edit_profile_api($id,$update_cateorgy)
	{
		 $this->db->where('u_id',$id);
		 if($this->db->update('user',$update_cateorgy))
		 {
			 return true;

		 }
	}
public function update_contacts($id,$update_cateorgy)
	{
		 $this->db->where('contact_id',$id);
		 if($this->db->update('contact_us',$update_cateorgy))
		 {
			 return true;

		 }
	}


	  public function list_contacts()
	 {
		   $this->db->select('*');
		$this->db->from('contact_us');
		$query = $this->db->get();
		return $query->result_array();
	}

	  public function get_contacts($id)
	 {
		   $this->db->select('*');
		   $this->db->where('contact_id',$id);
           $this->db->from('contact_us');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
function list_order()
	{
        $this->db->select('*');
		$this->db->from('subject_subscription');
		//$this->db->join('packege', 'packege.pack_id = subscription.package_id');
	    $this->db->join('user', 'user.u_id = subject_subscription.user_id');
	    $this->db->join('class', 'class.id =subject_subscription.class_id');
	    $this->db->join('subject', 'subject.s_id =subject_subscription.subject_id');
		$query = $this->db->get();
		return $query->result_array();
	 }

function list_packages($id)
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('class');
		 $this->db->where('id',$id);
		$this->db->join('packege', 'packege.pack_id = class.package_id');
		//$this->db->order_by('a_id',"desc");
		//$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	 }

    function get_packages_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('packege');
		$query = $this->db->get();
		return $query->result_array();
	 }

function list_contact_details()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('contact_us');
		$query = $this->db->get();
		return $query->result_array();
	 }

function get_message_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		return $query->result_array();
	 }
	 function get_terms_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('term');
		$query = $this->db->get();
		return $query->result_array();
	 }



	  public function add_service_details($data)
	{

		   if($insert = $this->db->insert('about', $data))
		   {
			
			   return true;
		   }
	}
	
	  public function user_payment_status($cat_arr)
	{
		   if($insert = $this->db->insert('subject_subscription', $cat_arr))
		   {			
			   return true;
		   }
	}




function get_service_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('about');
		//$this->db->order_by('a_id',"desc");
		//$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	 }


	  public function get_service_byid($id)
	 {
		   $this->db->select('*');
		   $this->db->where('a_id',$id);
           $this->db->from('about');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function update_service($id,$update_cateorgy)
	{
		 $this->db->where('a_id',$id);
		 if($this->db->update('about',$update_cateorgy))
		 {
			 return true;

		 }
	}
	function delete_service_details($id){
		$this->db->where('a_id', $id);
		$this->db->delete('about');
	}

	  public function add_package_details($data)
	{

		   if($insert = $this->db->insert('packege', $data))
		   {
			
			   return true;
		   }
	}

 

function get_package_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('packege');
		//$this->db->join('class', 'class.id = packege.class_id');
		//$this->db->order_by('a_id',"desc");
		//$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	 }


	  public function get_package_byid($id)
	 {
		   $this->db->select('*');
		   $this->db->where('pack_id',$id);
           $this->db->from('packege');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function update_package($id,$update_cateorgy)
	{
		 $this->db->where('pack_id',$id);
		 if($this->db->update('packege',$update_cateorgy))
		 {
			 return true;
		 }
	}
	function delete_package_details($id){
		$this->db->where('pack_id', $id);
		$this->db->delete('packege');
	}

 public function add_plan_details($data)
	{

		   if($insert = $this->db->insert('plans_packages', $data))
		   {
			
			   return true;
		   }
	}

	function get_plans_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('plans_packages');
		//$this->db->join('class', 'class.id = packege.class_id');
		//$this->db->order_by('a_id',"desc");
		//$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	 }

	  public function get_plan_byid($id)
	 {
		   $this->db->select('*');
		   $this->db->where('id',$id);
           $this->db->from('plans_packages');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function update_plan($id,$update_cateorgy)
	{
		 $this->db->where('id',$id);
		 if($this->db->update('plans_packages',$update_cateorgy))
		 {
			 return true;
		 }
	}
	function delete_plan_details($id){
		$this->db->where('id', $id);
		$this->db->delete('plans_packages');
	}


	  public function add_user_details($data)
	{

		   if($insert = $this->db->insert('user', $data))
		   {
			
			   return $this->db->insert_id() ;//true;
		   }
	}



function get_user_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('user');
		//$this->db->order_by('a_id',"desc");
		//$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	 }


	  public function get_user_byid($id)
	 {
		   $this->db->select('*');
		   $this->db->where('u_id',$id);
           $this->db->from('user');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function update_user($id,$update_cateorgy)
	{
		 $this->db->where('u_id',$id);
		 if($this->db->update('user',$update_cateorgy))
		 {
			 return true;

		 }
	}
	function delete_user_details($id){
		$this->db->where('u_id', $id);
		$this->db->delete('user');
	}





	  public function add_privacy_details($data)
	{

		   if($insert = $this->db->insert('privacy_policy', $data))
		   {
			
			   return true;
		   }
	}



function get_privacy_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('privacy_policy');
		//$this->db->order_by('a_id',"desc");
		//$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	 }


	  public function get_privacy_byid($id)
	 {
		   $this->db->select('*');
		   $this->db->where('p_id',$id);
           $this->db->from('privacy_policy');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function update_privacy($id,$update_cateorgy)
	{
		 $this->db->where('p_id',$id);
		 if($this->db->update('privacy_policy',$update_cateorgy))
		 {
			 return true;

		 }
	}
	function delete_privacy_details($id){
		$this->db->where('p_id', $id);
		$this->db->delete('privacy_policy');
	}




	 public function add_testmonials_details($data)
	{

		   if($insert = $this->db->insert('term', $data))
		   {
			 //  print_r($add_category);exit;
			   return true;
		   }
	}



function get_testmonials_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('term');
		//$this->db->order_by('id',"desc");
		//$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	 }


	  public function get_testmonials_byid($id)
	 {
		   $this->db->select('*');
		   $this->db->where('t_id',$id);
           $this->db->from('term');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function update_testmonials($id,$update_cateorgy)
	{
		 $this->db->where('t_id',$id);
		 if($this->db->update('term',$update_cateorgy))
		 {
			 return true;

		 }
	}
	function delete_testmonials_details($id){
		$this->db->where('t_id', $id);
		$this->db->delete('term');
	}



 public function add_member_details($data)
	{

		   if($insert = $this->db->insert('chapter', $data))
		   {
			 //  print_r($add_category);exit;
			   return true;
		   }
	}
	public function add_chapter_name($data)
	{

		   if($insert = $this->db->insert('chapter_name', $data))
		   {
			 //  print_r($add_category);exit;
			   return true;
		   }
	}
	
	

function check_login_details($phone,$password,$mackid)
	{
	
		$this->db->select('*');
		$this->db->where('phone', $phone);
		$this->db->from('user');
		$query = $this->db->get();
		$result = $query->num_rows();
		if($result==1)
		{
			$this->db->select('*');
    		$this->db->where('phone', $phone);
    		$this->db->where('password', $password);
    		$this->db->from('user');
    		$query1 = $this->db->get();
    		$result1 = $query1->num_rows();
    		if($result1==1)
		{
		    $this->db->select('*');
    		$this->db->where('phone', $phone);
    		$this->db->where('mac_id', $mackid);
    		$this->db->where('password', $password);
    		$this->db->from('user');
    		$query2 = $this->db->get();
    		$result2 = $query2->num_rows();
    		if($result2==1)
		{
		    return $query2->result_array();
		}else{
		    return "Invalid Macid"; 
		}
		}else
		{
		   return "Incorrect Password"; 
		}
		}
		else{
		   return "Invalid Phone no.";
		}
}


function get_team_list()
	{
		//echo 1; exit;chapter_name_id
        $this->db->select('chapter.chapter_id,chapter.chapter_image,chapter.video_title,chapter.description,chapter.video_name,chapter.popular_video,chapter_name.chapter_name,class.name,subject.subject_name');
		$this->db->from('chapter');
		$this->db->join('chapter_name', 'chapter.chapter_id_name=chapter_name.chapter_name_id');
		$this->db->join('class', 'chapter.class_id=class.id');
 		$this->db->join('subject', 'chapter.subject_id=subject.s_id');
 	    //$this->db->limit(3);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result_array();
	 }
	 function get_chapter_name_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('chapter_name');
		$this->db->join('class', 'class.id=chapter_name.classs_id');
 		$this->db->join('subject', 'subject.s_id=chapter_name.sub_id');
		$query = $this->db->get();
		return $query->result_array();
	 }

 function get_chapter_name_list_byid($id)
	{
		//echo 1; exit;
        $this->db->select('*');
         $this->db->where('chapter_name_id',$id);
		$this->db->from('chapter_name');
		//$this->db->join('class', 'class.id=chapter_name.classs_id');
 		//$this->db->join('subject', 'subject.s_id=chapter_name.sub_id');
		$query = $this->db->get();
		return $query->result_array();
	 }

	  public function get_team_byid($id)
	 {
		   $this->db->select('*');
		   $this->db->where('chapter_id',$id);
           $this->db->from('chapter');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function update_team($id,$update_cateorgy)
	{
		 $this->db->where('chapter_id',$id);
		 if($this->db->update('chapter',$update_cateorgy))
		 {
			 return true;

		 }
	}
	function delete_member_details($id){
		$this->db->where('chapter_id', $id);
		$this->db->delete('chapter');
	}
        function delete_chapter_details($id){
		$this->db->where('chapter_name_id', $id);
		$this->db->delete('chapter_name');
	}


	function get_about_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('subject');
		$this->db->join('class', 'class.id = subject.class_id');
		$query = $this->db->get();
		return $query->result_array();
	 }


	  public function get_about_byid($id)
	 {
		   $this->db->select('*');
		   $this->db->where('s_id',$id);
           $this->db->from('subject');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}


	  public function get_chapter_bychap_id($id)
	 {
		   $this->db->select('*');
		   $this->db->where('chapter_id',$id);
           $this->db->from('chapter');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function get_chapter_bysub_id($id)
	 {
		   $this->db->select('*');
		   $this->db->where('subject_id',$id);
           $this->db->from('chapter');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	 public function get_subject_byid($id)
	 {
		   $this->db->select('*');
           $this->db->from('subject');
		   $this->db->where('class_id',$id);
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function list_cahpter_bysub_id($id)
	 {
		   $this->db->select('*');
		   $this->db->where('sub_id',$id);
           $this->db->from('chapter_name');
		   $query_banner_data = $this->db->get();
	       //$query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}


	public function list_cahpter($id)
	 {
		   $this->db->select('*');
		   $this->db->where('chapter_id_name',$id);
           $this->db->from('chapter');
		   $query_banner_data = $this->db->get();
	       //$query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}

	public function update_about($id,$update_cateorgy)
	{
		 $this->db->where('s_id',$id);
		 if($this->db->update('subject',$update_cateorgy))
		 {
			//echo $this->db->last_query();exit;
			 return true;

		 }
	}
	 function delete_about_details($id){
		$this->db->where('s_id', $id);
		$this->db->delete('subject');
	}



  public function add_home_details($data)
	{

//print_r($data); exit;
		   if($insert = $this->db->insert('class', $data))
		   {
			 //  print_r($add_category);exit;
			   return true;
		   }
	}

	public function get_category()
	{
		$this->db->select('*');
		$this->db->from('category');
		$query = $this->db->get();
		return $query->result_array();

	}

	public function add_product($data)
	{

		   if($insert = $this->db->insert('sub_category', $data))
		   {
			   return true;
		   }
	}

public function add_subscription_details($data,$user)
	{


		   if($insert = $this->db->insert('subscription', $data))
		   {
 				//$this->db->select('*');
				//$this->db->from('user');
				 $this->db->where('u_id',$user);
				$this->db->update('user',array('subscription' => '1'));

				return true;
			}
		 	
		   
	}

function update_user_subscription($id)
{
$this->db->where('user_id',$id);
$this->db->delete('subscription');

//$this->db->where('u_id',$id);
 if($this->db->update('user',array('subscription' => '0')))
 {
//$this->db->where('u_id', $id);
return true;
 }
 

}

function update_chapter_video1($id){
    $this->db->where('chapter_id',$id);
	$this->db->update('chapter',array('popular_video' => '1'));
	return true;
}
function update_chapter_video2($id){
    $this->db->where('chapter_id',$id);
	$this->db->update('chapter',array('popular_video' => '0'));
	return true;
}
	function get_model_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('car_model');
		$this->db->order_by("car_model_name", "asc");
		$query = $this->db->get();
		return $query->result_array();
	 }



	 public function get_category_byid($id)
	 {
		   $this->db->select('*');
		   $this->db->where('id',$id);
           $this->db->from('class');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}
	public function update_home($id,$update_cateorgy)
	{
		 $this->db->where('id',$id);
		 if($this->db->update('class',$update_cateorgy))
		 {
			//echo $this->db->last_query();exit;
			 return true;

		 }
	}
	public function update_chapter_name($id,$update_cateorgy)
	{
		 $this->db->where('chapter_name_id',$id);
		 if($this->db->update('chapter_name',$update_cateorgy))
		 {
			//echo $this->db->last_query();exit;
			 return true;

		 }
	}

	function get_class()
	{
        $this->db->select('*');
        $this->db->from('class');
		$query = $this->db->get();
		return $query->result_array();
	 }
	 function get_package()
	{
        $this->db->select('*');
        $this->db->from('packege');
		$query = $this->db->get();
		return $query->result_array();
	 }
	 function get_product_list()
	{
        $this->db->select('*');
        $this->db->from('product');
		$query = $this->db->get();
		return $query->result_array();
	 }

	 function delete_home_details($id){
		$this->db->where('id', $id);
		$this->db->delete('class');
	}
	function delete_product($id){
		$this->db->where('sub_id', $id);
		//echo $this->db->last_query();exit;
		$this->db->delete('sub_category');
	}
	public function edit_product($id,$update_cateorgy)
	{
		 $this->db->where('product_id',$id);
		 if($this->db->update('product',$update_cateorgy))
		 {
			 //echo $this->db->last_query();exit;
			 return true;

		 }
	}

	public function get_product_byid($id)
	 {
		   $this->db->select('*');
		   $this->db->where('product_id',$id);
           $this->db->from('product');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}

	public function get_student_byid($id)
	 {
		   $this->db->select('*');
		   $this->db->where('u_id',$id);
           $this->db->from('user');
		   $query_banner_data = $this->db->get();
	       $query_banner_data->num_rows;
		   return $query_banner_data->result_array();
	}

	function delete_product_all($id){
		$this->db->where('sub_id',$id);
		$this->db->delete('sub_category');
	}

	public function category_list_details()
	{
		$this->db->select('name');
		$this->db->from('category');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result_array();

	}
	public function add_city($city)
	{

		if($insert = $this->db->insert('location', $city))
		   {
			   return true;
		   }
	}
	public function getserivce_location()
	{
		$this->db->select('*');
		$this->db->from('location');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function add_model($add_model_name)
	{
		if($insert = $this->db->insert('car_model', $add_model_name))
		   {
			   return true;
		   }
	}
	public function add_offers($id,$offers)
 {

   $this->db->where('car_id',$id);
   if($this->db->update('car',$offers))
   {
   //echo $this->db->last_query();exit;
    return true;

   }

 }
	public function offer_details()
   {
     $this->db->select('*');
     $this->db->where('offer_price >','0');
     $this->db->from('car');
     $query = $this->db->get();
     return $query->result_array();
 }
 public function remove_offer($id)
 {
	   $offer_price=array(
	   'offer_price'=>0
	   );
		$this->db->where('car_id',$id);
		 if($this->db->update('car',$offer_price))
		 {
			 //echo $this->db->last_query();exit;
			 return true;

		 }

 }
	public function home_welocme()
	{
		$this->db->select('*');
		$this->db->from('model_fuels_welocome');
		$query = $this->db->get();
		return $query->result_array();

	}
	public function update_homewelcome($welcome_home)
	{

		// print_r($welcome_home);exit;
		 $this->db->where('id','1');
		 if($this->db->update('model_fuels_welocome',$welcome_home))
		 {
			 //echo $this->db->last_query();exit;
			 return true;

		 }
	}

	public function addservice($addservice)
	{
		if($insert = $this->db->insert('our_service', $addservice))
		   {
			   return true;
		   }

	}
	public function service_list()
	{
		$this->db->select('*');
		$this->db->from('our_service');
		$query = $this->db->get();
		return $query->result_array();

	}
	public function car_list()
	{
		$this->db->select('*');
		$this->db->from('car');
		$query = $this->db->get();
		return $query->result_array();

	}
	public function car_detais_byid($id)
	{
		$this->db->select('*');
		$this->db->where('car_id',$id);
		$this->db->from('car');
		$query = $this->db->get();
		return $query->result_array();

	}

	public function get_service_id($id)
	{
		$this->db->select('*');
		$this->db->where('service_id',$id);
		$this->db->from('our_service');
		$query = $this->db->get();
		return $query->result_array();

	}
	public function update_service1($id,$updateservice)
	{
		 $this->db->where('service_id',$id);
		 if($this->db->update('our_service',$updateservice))
		 {
			 return true;
		 }

	}
	public function add_car($add_car)
	{
		if($insert = $this->db->insert('car', $add_car))
		   {
			   return $this->db->insert_id();
		   }
	}
	public function add_exterior_image($exterior_image_array)
	{
		if($insert = $this->db->insert('car_exterior_image', $exterior_image_array))
		   {
			   return $this->db->insert_id();
		   }
	}
	public function add_interior_image($interior_image_array)
	{
		if($insert = $this->db->insert('car_interior_image', $interior_image_array))
		   {
			   return $this->db->insert_id();
		   }
	}
	public function edit_car($id,$edit_car)
	{
		 $this->db->where('car_id',$id);
		 if($this->db->update('car',$edit_car))
		 {
			 return true;
		 }

	}
	public function get_modelnamebyid($id)
	{
		$this->db->select('car_model_name');
		$this->db->where('model_id',$id);
		$this->db->from('car_model');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_exterior_imagebyid($id)
	{
		$this->db->select('*');
		$this->db->where('fk_carid',$id);
		$this->db->from('car_exterior_image');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function car_get_interior_image_byid($id)
	{
		$this->db->select('*');
		$this->db->where('fk_carid',$id);
		$this->db->from('car_interior_image');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function insert_product_image($img)
	{
		if($insert = $this->db->insert('product', $img))
		   {
			   return $this->db->insert_id();
		   }
	}
	public function update_product($id,$product_details)
	{
		 $this->db->where('product_id',$id);
		$data=$this->db->update('product',$product_details);
			if($data){
				return true;
			}

	}

	public function update_moreimage($id,$array_image_upload,$image_type)
	{
		 $this->db->where('fk_carid',$id);
		 if($image_type==1)
		 {
		    $data=$this->db->update('car_exterior_image',$array_image_upload);
			if($data){
				return true;
			}
		 }else{
		    $data=$this->db->update('car_interior_image',$array_image_upload);
			if($data){
				return true;

			}
		 }
	}
	public function get_service_center($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$this->db->from('branch_location');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_model_byid($id)
	{

		$this->db->select('*');
		$this->db->where('model_id',$id);
		$this->db->from('car_model');
		$query = $this->db->get();
		return $query->result_array();

	}
	public function edit_model($id,$add_model_name)
	{
	   $this->db->where('model_id',$id);
		if($this->db->update('car_model',$add_model_name))
		{
			return true;
		}

	}
	public function get_model_bysegment($segment)
	{
		$this->db->select('*');
		$this->db->where('Segment',$segment);
		$this->db->from('car_model');
		$query = $this->db->get();
		return $query->result_array();
	}

  public function old_car_list()
 {
  $this->db->select('*');
  $this->db->where('car_condition','used');
  $this->db->from('car');

  $query = $this->db->get();
  return $query->result_array();

 }

 public function edit_old_car($id,$edit_car)
 {
   $this->db->where('car_id',$id);
   if($this->db->update('car',$edit_car))
   {
    return true;
   }

 }
public function home_welocme1($id)
 {
  $this->db->select('*');
  $this->db->where('id',$id);
  $this->db->from('model_fuels_welocome');
  $query = $this->db->get();
  return $query->result_array();

 }
  public function update_homewelcome1($id,$welcome_home)
 {
   $this->db->where('id',$id);
   if($this->db->update('model_fuels_welocome',$welcome_home))
   {
    //echo $this->db->last_query();exit;
    return true;
   }
 }

 public function get_carname_bysegment($carconedition,$model_name)
 {
 //echo $carconedition;
 //echo $model_name;
 //exit;
  $this->db->select('*');
  $this->db->where('car_condition',$carconedition);
  $this->db->where('model_name',$model_name);
  $this->db->from('car');
  $query = $this->db->get();
  return $query->result_array();
 }
 public function get_carname_byid($id)
 {
 //echo $carconedition;
 //echo $model_name;
 //exit;
  $this->db->select('id');
  $this->db->where('car_id',$id);
  //$this->db->where('model_name',$model_name);
  $this->db->from('car');
  $query = $this->db->get();
  return $query->result_array();
 }
  public function get_price_bysegment($car_id)
 {
  $this->db->select('price');
  $this->db->where('car_id',$car_id);
  $this->db->from('car');
  $query = $this->db->get();
  return $query->result_array();
 }
 public function get_allexchage()
 {
	$this->db->select('*');
    $this->db->from('exchange_vechile');
    $query = $this->db->get();
    return $query->result_array();
 }
 public function get_upadtefeed($id,$feed_data)
 {
	   $this->db->where('id',$id);
	   if($this->db->update('portfolio',$feed_data))
	   {
		return true;
	   }

 }
 public function update_price($data,$id)
 {

	  $this->db->where('car_id',$id);
	   if($this->db->update('car',$data))
	   {
		return true;
	   }
 }

 function get_category_list()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('class');
		//$this->db->join('packege', 'packege.pack_id = class.package_id');
		$query = $this->db->get();
		return $query->result_array();
	 }
	 function get_popular_video()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('chapter');
		 $this->db->where('popular_video',1);
		//$this->db->join('packege', 'packege.pack_id = class.package_id');
		$query = $this->db->get();
		$this->db->limit(6); 
		return $query->result_array();
	 }




	  public function add_subject_details($data)
	{

		   if($insert = $this->db->insert('subject', $data))
		   {
			   return true;
		   }
	}

	 public function get_productcategory()
	 {
		 $this->db->select('*');
         $this->db->from('product');
         $query = $this->db->get();
         return $query->result_array();
	 }

	  /*============================================= nargis 06-04-18 ================================================*/
	 function del_hospitalization($id){
		$this->db->where('id', $id);
		//echo $this->db->last_query();exit;
		$this->db->delete('service_page');
	}public function get_service_page_id($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id);
		$this->db->from('service_page');
		$query = $this->db->get();
		return $query->result_array();

	}
public function service_list_page()
	{
		$this->db->select('*');
		$this->db->from('service_page');
		$query = $this->db->get();
		return $query->result_array();

	}
	public function post_hospitalization_List()
	{
		$this->db->select('*');
		$this->db->from('service_page');
		$query = $this->db->get();
		return $query->result_array();

	}
	public function nurse_home_list(){
		$this->db->select('*');
		$this->db->from('service_page');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function select_image($id)
	 {
		 $this->db->select('product_image');
		 $this->db->where('product_id',$id);
         $this->db->from('product');
         $query = $this->db->get();
         return $query->result_array();
	 }

   public function getallcategory()
   {
         $this->db->select('*');
         $this->db->from('category');
         $query = $this->db->get();
         return $query->result_array();
   }
   public function allbrand()
   {
         $this->db->select('*');
         $this->db->from('brand');
         $query = $this->db->get();
         return $query->result_array();
   }
   public function getallsubproductdata($gender)
   {
        $this->db->select('*');
        $this->db->where('type',$gender);
        $this->db->from('subcategory');
        $query = $this->db->get();
       return $query->result_array();

   }
     public function add_subcatagory($data)
	{

		   if($insert = $this->db->insert('subcategory', $data))
		   {
			   return true;
		   }
	}

  public function get_subcategory_list()
  {
    $this->db->select('*');
    $this->db->from('subcategory');
    $query = $this->db->get();
   return $query->result_array();

  }

  public function getsubcategoery($id)
  {
    $this->db->select('*');
    $this->db->where('subcat_id',$id);
    $this->db->from('subcategory');
    $query = $this->db->get();
   return $query->result_array();

  }
  public function update_subcatagory($cat_arr,$id)
  {
    $this->db->where('subcat_id',$id);
    if($this->db->update('subcategory',$cat_arr))
    {
      return true;
    }

  }

  public function delete_sbcategory($id)
  {
    $this->db->where('subcat_id', $id);
    $this->db->delete('subcategory');
  }
  
  public function user_subscription_paymentid($payment_id)
	 {
		   
		    $this->db->select('*');
		    $this->db->where('payment_id',$payment_id);
            $this->db->from('subscription');
		    $query_banner_data = $this->db->get();
		    $row=  $query_banner_data->num_rows;
		    //return $row;exit;
		    if($row)
		    {
		        return false;
		    }
		    else{
		        return true;
		    }
	 }
  public function user_subscription_status($user_id,$class_id,$package_id,$indays)
	 {
		   //echo $indays;exit;
		    $this->db->select('*');
		    $this->db->where('user_id',$user_id);
		    $this->db->where('user_classs_id',$class_id);
		    $this->db->where('package_id',$package_id);
            $this->db->from('subscription');
		    $query_banner_data = $this->db->get();
		    $row=  $query_banner_data->num_rows;
		    //echo $row;exit;
		    if($row)
		    {
		        
			   $data= $query_banner_data->result_array();
			   //print_r($data);exit;
			   $enddate=$data[0]['end_date'];
			   
		        $today_date=date('Y-m-d');
				//$enddate=$data[0]['end_date'];
                $datetime1 = strtotime($today_date);
               $datetime2 = strtotime($enddate);
			   $interval = $datetime2 - $datetime1;
			   //echo  $interval;exit;
               //$expiredate_time= $interval->format('%R%a');
               //echo  $expiredate_time;exit;
             if($interval>0){            
                    $enddate_easas =$data[0]['end_date'];
                    $date =  $enddate_easas;
                    $date = strtotime($date);
                    $date = strtotime("+$indays days", $date);
					$enddate_date= date('Y-m-d', $date);
					//
                    return $enddate_date;  
				// exit;
// 	  $date = "04-15-2013";
//    $date = strtotime($date);
//    $date = strtotime("+1 day", $date);
//    echo date('m-d-Y', $date);

//$dateA=date('Y-m-d', strtotime('+1 days'));                 
             }
            else{
			        $today_datestill=date('Y-m-d');
                    //$date =  $today_datestill;
                    $date = strtotime($today_datestill);
                    $date = strtotime("+$indays day", $date);
					$enddate_date= date('Y-m-d', $date);
					echo  $enddate_date;exit;
                   //return false;
                  return $enddate_date;                
             }             
		    }
		    else{
		        return false;
		    }   
	}
	public function user_subject_subs_status($user_id,$class_id,$subject_id,$expiry_months)
	{
		$validation_days=$expiry_months * 30;
		  //echo $validation_days;exit;
		   $this->db->select('*');
		   $this->db->where('user_id',$user_id);
		   $this->db->where('class_id',$class_id);
		   $this->db->where('subject_id',$subject_id);
		   $this->db->from('subject_subscription');
		   $query_banner_data = $this->db->get();
		   $row=  $query_banner_data->num_rows;
		   //echo $row;exit;
		   if($row==1)
		   {
			$data= $query_banner_data->result_array();
			  //print_r($data);exit;
			$enddate=$data[0]['end_date'];
			$today_date=date('Y-m-d');
			 // echo $enddate=$data[0]['end_date'];exit;
			$today_date = strtotime($today_date);
			$enddate = strtotime($enddate);
			$interval = $enddate - $today_date;
			  //echo  $interval;exit;
			  //$expiredate_time= $interval->format('%R%a');
			  //echo  $expiredate_time;exit;
			if($interval>=0){            
				   $enddate_date = strtotime("+$validation_days day", $enddate);
				   $enddate_date= date('Y-m-d', $enddate_date);
				   return $enddate_date;  
			   // exit;
// 	  $date = "04-15-2013";
//    $date = strtotime($date);
//    $date = strtotime("+1 day", $date);
//    echo date('m-d-Y', $date);

//$dateA=date('Y-m-d', strtotime('+1 days'));                 
			}
		   else{
				   $today_datestill = strtotime("+$validation_days day", $today_date);
				   $enddate_date= date('Y-m-d', $today_datestill);
				   return $enddate_date;                
			}             
		   }
		   else{
			   return false;
		   }   
   }
public function user_payment_status_update($cat_arr,$user_id,$class_id,$pack_id)
  {
     $this->db->where('user_id',$user_id);
     $this->db->where('user_classs_id',$class_id);
      $this->db->where('package_id',$pack_id);
    if($this->db->update('subscription',$cat_arr))
    {
      return true;
    }

  }
  public function user_subject_payment_status_update($cat_arr,$user_id,$class_id,$subject_id)
  {
     $this->db->where('user_id',$user_id);
     $this->db->where('class_id',$class_id);
      $this->db->where('subject_id',$subject_id);
    if($this->db->update('subject_subscription',$cat_arr))
    {
      return true;
    }

  }
  	function get_slider_list2()
	{
		//echo 1; exit;
        $this->db->select('*');
		$this->db->from('slider');
		//$this->db->order_by('a_id',"desc");
		//$this->db->limit(4);
		$query = $this->db->get();
		return $query->result_array();
	 }
	 public function get_slider_listbyid($id)
	 {
	     
	     $this->db->select('*');
         $this->db->where('id',$id);
         $this->db->from('slider');
         $query = $this->db->get();
         return $query->result_array();
	     
	 }
	 public function update_slider_details($cat_arr,$id)
	 {
	     
	        $this->db->where('id',$id);
            if($this->db->update('slider',$cat_arr))
            {
              return true;
            }
	     
	 }
	 public function getallsubject_byclassid($id)
	 {
		 $this->db->select('*');
         $this->db->where('class_id',$id);
         $this->db->from('subject');
         $query = $this->db->get();
         return $query->result_array();
		 
	 }
	 public function fetchamountsubject_byid($id)
	 {
		 $this->db->select('*');
         $this->db->where('s_id',$id);
         $this->db->from('subject');
         $query = $this->db->get();
         return $query->result_array();
		 
	 }
	  public function fetch_subjectbyid($id)
	 {
		 $this->db->select('subject_name');
         $this->db->where_in('s_id',$id);
         $this->db->from('subject');
         $query = $this->db->get();
         return $query->result_array();
		 
	 }
	 
	 public function create_exam($sub_arr)
	{

		   if($insert = $this->db->insert('exam', $sub_arr))
		   {
			
			   return true;
		   }
	}
	public function update_exam($cat_arr,$id)
	{
		$this->db->where('id',$id);
		if($update = $this->db->update('exam', $cat_arr))
		{
			return true;
		}
	}
	public function list_exam()
   {
            $this->db->select('*');
            $this->db->from('exam');
		    $query_banner_data = $this->db->get();
	       $data= $query_banner_data->result_array(); 	  
	           return $data;	      
	}
	public function fetchexam_ajax_byid($id)
	 {
		 $this->db->select('subject_name');
         $this->db->where_in('s_id',$id);
         $this->db->from('subject');
         $query = $this->db->get();
         return $query->result_array();
		 
	 }
	public function insert_question($cat_arr)
	 {
		 if($insert = $this->db->insert('questionbank', $cat_arr))
		   {
			
			   return true;
		   }
		 
	 }
	
	public function get_exam_listbyid($id)
	 {
		 $this->db->select('*');
         $this->db->where('id',$id);
         $this->db->from('exam');
         $query = $this->db->get();
         return $query->result_array();
		 
	 }
	 public function list_examsubject()
	 {
			  $this->db->select('questionbank.id,questionbank.subject_id,questionbank.exam_id,questionbank.question_type,
			  questionbank.question,questionbank.total_answers,questionbank.answers,questionbank.total_correct_answers,
			  questionbank.correct_answers,questionbank.marks,questionbank.time_to_spend,questionbank.difficulty_level,
			  questionbank.hint,questionbank.explanation,subject.subject_name,exam.eaxm_name');
			  $this->db->from('questionbank');
			  $this->db->join('subject', 'questionbank.subject_id = subject.s_id');
			  $this->db->join('exam', 'questionbank.exam_id = exam.id');
			  $query_banner_data = $this->db->get();
			 $data= $query_banner_data->result_array(); 	  
				 return $data;	      
	  }
	
	public function edit_questionbank($id){
        $this->db->select('*');
        $this->db->from('questionbank');
        $this->db->where('id',$id);
        $query=$this->db->get();
        return $query->result_array();
    }
    public function update_questionbank($data,$id){
        $this->db->where('id',$id);
        $this->db->update('questionbank',$data);
        return true;
    }
	public function list_exam_subscription()
   {
            $this->db->select('exam_subscription.ex_subs_id,exam_subscription.exam_id,exam_subscription.user_id,exam_subscription.order_id,exam_subscription.start_date,exam_subscription.end_date,user.u_id,user.first_name,user.last_name,exam.id,exam.eaxm_name,exam.amount');
			$this->db->from('exam_subscription');
			$this->db->join('user', 'exam_subscription.user_id = user.u_id');
			  $this->db->join('exam', 'exam_subscription.exam_id = exam.id');
		    $query = $this->db->get();
	       $data= $query->result_array(); 	  
	           return $data;	      
	}
	public function delete_exam_subscription($id){
        $this->db->where('ex_subs_id',$id);
        $this->db->delete('exam_subscription');
        return true;
    }
//<======================================exam_subscription=========================================
public function check_exam_subscription_api($user_id,$exam_id)
	 {
		   $this->db->select('*');
		   $this->db->where('user_id',$user_id);
		   $this->db->where('exam_id',$exam_id);
           $this->db->from('exam_subscription');
		   $query_banner_data = $this->db->get();
		   return $query_banner_data->result_array();
	}
	public function check_exam_subscription_expiry_api($exam_id,$user_id)
	{
		  $this->db->select('*');
		  $this->db->where('user_id',$user_id);
		  $this->db->where('exam_id',$exam_id);
		  $this->db->from('exam_subscription');
		  $query_banner_data = $this->db->get();
		 return $query_banner_data->result_array();
   }
public function exam_result_api($cat_arr,$user_id,$exam_id){
	if($this->db->insert('exam_result',$cat_arr)){
		$data=$this->db->query("SELECT exam_res_id,user_id,exam_id,result,date,FIND_IN_SET( result, ( SELECT GROUP_CONCAT( result ORDER BY result DESC ) FROM exam_result ) ) AS rank FROM exam_result WHERE user_id ='".$user_id."' && exam_id ='".$exam_id."' ")->result_array();
		return $data;
	}	
}
public function list_exam_result_api()
   {
            $this->db->select('*');
			$this->db->from('exam_result');
			$this->db->join('exam', 'exam_result.exam_id = exam.id');
		    $query = $this->db->get();
	       if($data= $query->result_array()){
			return $data;
		   }	  	           	      
	}
	public function list_examresultbyid_api($user_id)
   {
            $this->db->select('*');
			$this->db->from('exam_result');
			$this->db->where('user_id',$user_id);
			$this->db->join('exam', 'exam_result.exam_id = exam.id');
			$this->db->order_by('exam_res_id',"desc");
			$this->db->limit(5);			
		    $query = $this->db->get();
	       if($data= $query->result_array()){
			return $data;
		   }	  	           	      
	}
public function user_exam_subs_status($user_id,$exam_id,$expiry_months)
	{
		$validation_days=$expiry_months * 30;
		  //echo $validation_days;exit;
		   $this->db->select('*');
		   $this->db->where('user_id',$user_id);
		   $this->db->where('exam_id',$exam_id);
		   //$this->db->where('subject_id',$subject_id);
		   $this->db->from('exam_subscription');
		   $query_banner_data = $this->db->get();
		   $row=  $query_banner_data->num_rows;
		   //echo $row;exit;
		   if($row==1)
		   {
			$data= $query_banner_data->result_array();
			  //print_r($data);exit;
			$enddate=$data[0]['end_date'];
			$today_date=date('Y-m-d');
			 // echo $enddate=$data[0]['end_date'];exit;
			$today_date = strtotime($today_date);
			$enddate = strtotime($enddate);
			$interval = $enddate - $today_date;
			  //echo  $interval;exit;
			  //$expiredate_time= $interval->format('%R%a');
			  //echo  $expiredate_time;exit;
			if($interval>=0){            
				   $enddate_date = strtotime("+$validation_days day", $enddate);
				   $enddate_date= date('Y-m-d', $enddate_date);
				   return $enddate_date;  
			   // exit;
// 	  $date = "04-15-2013";
//    $date = strtotime($date);
//    $date = strtotime("+1 day", $date);
//    echo date('m-d-Y', $date);

//$dateA=date('Y-m-d', strtotime('+1 days'));                 
			}
		   else{
				   $today_datestill = strtotime("+$validation_days day", $today_date);
				   $enddate_date= date('Y-m-d', $today_datestill);
				   return $enddate_date;                
			}             
		   }
		   else{
			   return false;
		   }   
   }
   public function user_exam_payment_status($cat_arr)
   {
		  if($insert = $this->db->insert('exam_subscription', $cat_arr))
		  {			
			  return true;
		  }
   }
 public function user_exam_payment_status_update($cat_arr,$user_id,$exam_id)
 {
	$this->db->where('user_id',$user_id);
	$this->db->where('exam_id',$exam_id);
   if($this->db->update('exam_subscription',$cat_arr))
   {
	 return true;
   }

 }
 public function user_examsubscription_paymentid($payment_id)
 {
	   
		$this->db->select('*');
		$this->db->where('payment_id',$payment_id);
		$this->db->from('exam_subscription');
		$query_banner_data = $this->db->get();
		$row=  $query_banner_data->num_rows;
		//echo $row;exit;
		if($row)
		{
			return false;
		}
		else{
			return true;
		}
 }

//<======================================Subject subscription=========================================
public function check_subject_subscription_api($user_id,$class_id,$subject_id)
	 {
		   $this->db->select('*');
		   $this->db->where('user_id',$user_id);
		   $this->db->where('class_id',$class_id);
		   $this->db->where('subject_id',$subject_id);
           $this->db->from('subject_subscription');
		   $query_banner_data = $this->db->get();
		   return $query_banner_data->result_array();
	}
	public function check_subject_subscription_expiry_api($user_id,$class_id,$subject_id)
	{
		  $this->db->select('*');
		  $this->db->where('user_id',$user_id);
		   $this->db->where('class_id',$class_id);
		   $this->db->where('subject_id',$subject_id);
		  $this->db->from('subject_subscription');
		  $query_banner_data = $this->db->get();
		 return $query_banner_data->result_array();
   }
   public function user_subjectsubscription_paymentid($payment_id)
   {		 
		  $this->db->select('*');
		  $this->db->where('payment_id',$payment_id);
		  $this->db->from('subject_subscription');
		  $query= $this->db->get();
		  $row=  $query->num_rows;
		  //echo $row;exit;
		  /*if($row)
		  {
			  return false;
		  }
		  else{*/
			  return true;
		  //}
   }
   public function user_subject_payment_status($cat_arr)
   {
		  if($insert = $this->db->insert('subject_subscription', $cat_arr))
		  {			
			  return true;
		  }
   }
   public function check_subscription($user_id,$class_id)
   {
	$this->db->select('subject_id');
	$this->db->where('user_id',$user_id);
	$this->db->where('class_id',$class_id);
	//$this->db->where_in('subject_id',$id);
	$this->db->from('subject_subscription');
	$query_data = $this->db->get();
	$subject_ids= $query_data->result_array();
		$id=array();
		foreach($subject_ids as $val){
			$id[] .=$val['subject_id'];
		}
		//print_r($id);die;
		if($subject_ids){
			$this->db->select('*');
			$this->db->where('subject.class_id',$class_id);
			$this->db->where_in('subject.s_id',$id);
			$this->db->from('subject');
			$this->db->join('subject_subscription', 'subject.s_id = subject_subscription.subject_id AND subject.class_id = subject_subscription.class_id');
			$query_data = $this->db->get();
		 	return $query_data->result_array();
		}
  }
//<======================refer=============================>
function user_referid_api($user_id)
	{
		$this->db->select('refer_code');
		$this->db->where('u_id', $user_id);
		$this->db->from('user');
		$query = $this->db->get();
	    return	 $query->result_array();
    }
	public function referidcheck($refereid)
    {
          $this->db->select('u_id,refer_code,first_name');
          $this->db->where('refer_code',$refereid);
          $this->db->from('user');
          $query = $this->db->get();
          $return=$query->num_rows();
          if($return > 0){           
              return $query->result_array();
          }
        else{           
            return false;
         }       
    }

	public function registor_reward_admin($referalUserId,$refer_amount,$install_usrid){
		if($referalUserId!=0){
        $this->db->select('wallet');
        $this->db->from('user');
        $this->db->where('u_id', $referalUserId);
        $query=$this->db->get();
        $data=$query->result_array();
        $totalfund=$data[0]['wallet'];
		$new_fund=$totalfund + $refer_amount;
		$datass_usr=array(
			'wallet'=>$new_fund
			);
	  $this->db->where('u_id',$referalUserId);
	  if($this->db->update('user',$datass_usr)){
		$this->db->select('wallet');
        $this->db->from('user');
        $this->db->where('u_id', $install_usrid);
        $query1=$this->db->get();
        $data1=$query1->result_array();
        $totalfund1=$data1[0]['wallet'];
		$new_fund1=$totalfund1 + $refer_amount;
		$datass_usr1=array(
			'wallet'=>$new_fund1
			);
			
	  $this->db->where('u_id',$install_usrid);
	  if($this->db->update('user',$datass_usr1)){
	      return true;
	  }
	  }
	}
	}

//<======================user=============================>
function user_walletbyid_api($user_id)
	{
		$this->db->select('wallet');
		$this->db->where('u_id', $user_id);
		$this->db->from('user');
		$query = $this->db->get();
	    return	 $query->result_array();
    }

//==============================================================
public function store_pushdatabase_all($title,$message)
    {
        
         /*$this->db->select('u_id,fb_token');
		 $this->db->from('user');
		 $query=$this->db->get();
		 $userdata= $query->result_array();*/
		 //echo "<pre>";
		 //print_r($userdata); exit;
		 //foreach($userdata as $key=>$value)
		 //{
		     //$userid=$value['u_id'];
		     //$fb_token=$value['fb_token'];
		      $message_data= array(
             //'user_id'=>$userid,
             'msg'=>$message,
             'sub'=>$title,
             'date'=>date('Y-m-d')
             
             );
             //if($fb_token !=""){
               $this->db->insert('notification',$message_data);
             //}else{
                 //continue;
             //}
		 //}
        return true;
    }
function list_notification_byid_api($user_id)
	{
		$this->db->select('*');
		//$this->db->where('user_id', $user_id);
		$this->db->from('notification');
		$this->db->order_by('notif_id',"desc");
		$query = $this->db->get();
	    return	 $query->result_array();
    }
	
	
	function list_notification()
	{
		$this->db->select('*');
		//$this->db->where('user_id', $user_id);
		$this->db->from('notification');
		$this->db->order_by('notif_id',"desc");
		$query = $this->db->get();
	    return	 $query->result_array();
    }
	public function delete_notification($id){
        $this->db->where('notif_id',$id);
        $this->db->delete('notification');
        return true;
    }
	
public function update_token_api($id,$data)
	{
		 $this->db->where('u_id',$id);
		 if($this->db->update('user',$data))
		 {
			 return true;

		 }
	}	
    public function sub_sub_wallet_update($id,$data)
	{
		 $this->db->where('u_id',$id);
		 if($this->db->update('user',$data))
		 {
			 return true;

		 }
	}

public function chapter_details_addForm($data)
	{

		   if($insert = $this->db->insert('chapter', $data))
		   {
			 //  print_r($add_category);exit;
			   return true;
		   }
	}

	public function list_exam_api()
   {
    $this->db->select('*');
    $this->db->from('exam');
    $query_banner_data = $this->db->get();
    $data= $query_banner_data->result_array(); 	  
    return $data;	      
	}
	public function delete_exam($id){
		$this->db->where('id',$id);
		$this->db->delete('exam');
		return true;
	}
public function check_email_api($email)
	{
		$this->db->select('*');
		$this->db->where('email',$email);
		$this->db->from('user');
		$query = $this->db->get();
		$num=$query->num_rows();
		//echo $num;die;
	    if($num==1){
	       return $query->result_array(); 
	    }
	}
public function set_new_userpass($cat_arr,$id)
	{
    //  print_r($cardatadata);exit;
         $this->db->where('u_id',$id);
		 if($this->db->update('user',$cat_arr))
		 {
			return true;
		 }
	}
public function get_refer_amount()
   {
    $this->db->select('*');
    $this->db->from('refer_amount');
    $query_banner_data = $this->db->get();
    $data= $query_banner_data->result_array(); 	  
    return $data;	      
	}

public function update_refer_amount($cat_arr)
	{
    //  print_r($cardatadata);exit;
         $this->db->where('refer_id',1);
		 if($this->db->update('refer_amount',$cat_arr))
		 {
			return true;
		 }
	}

  public function update_subsdates($id,$cat_arr)
  {
     $this->db->where('subject_subs_id',$id);
    if($this->db->update('subject_subscription',$cat_arr))
    {
      return true;
    }

  }




	 
	
}
?>
