<?php 
   $this->load->model('User');
   $userdata=$this->session->all_userdata();
   @$user_type=$userdata['user_type'];
   @$user_id=$userdata['id'];
   $user_f_name = $this->session->userdata('f_name');
   $user_l_name = $this->session->userdata('l_name');
   $admin_details=$this->User->getAdminData();

    //echo"<pre>";   
    //print_r($admin_details); exit   
   ?>
   

    <!--<script src="/canvasjs.min.js"></script>-->
    
	<script src="<?php echo base_url();?>js/highcharts.js"></script>
    <script src="<?php echo base_url();?>js/highcharts-more.js"></script>
    <script src="<?php echo base_url();?>js/exporting.js"></script>
    <script src="<?php echo base_url();?>js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>js/ckeditor/ckeditor.js"></script>




	
<div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo site_base_url();?>images/<?php echo $admin_details[0]['image'];?>" alt=""><?php 
                    echo $user_f_name.' '.$user_l_name;?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right d_mnu_top">
                    <li><a href="<?php echo base_url()?>profile"><i class="fa fa-user"></i>&nbsp;&nbsp; Profile</a></li>                   
                    <li><a href="<?php echo base_url()?>chn_password"><i class="fa fa-pencil"></i>&nbsp;&nbsp; Change Password</a></li>
                    <li><a href="<?php echo base_url();?>admin_main/logout"><i class="fa fa-sign-out"></i>&nbsp;&nbsp; Logout</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        </div>