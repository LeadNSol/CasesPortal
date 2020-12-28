<!DOCTYPE html>
<html lang="en">
  <head>
      
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <style>
          .top{width:100%;height:90px; background:#76c7b6 !important;}
      </style>

   <title>CourtCasePortal | Login</title>

    <!-- Bootstrap -->
   <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">-->
    <!-- NProgress -->
    <!--<link href="<?php /*echo base_url(); */?>css/nprogress.css" rel="stylesheet">-->
    <!-- iCheck -->
   <!-- <link href="<?php /*echo base_url(); */?>css/green.css" rel="stylesheet">-->
	<!-- JQVMap -->
    <!--<link href="<?php /*echo base_url(); */?>css/jqvmap.min.css" rel="stylesheet"/>-->
    <!-- bootstrap-progressbar -->
   <!-- <link href="<?php /*echo base_url(); */?>css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">-->
   
    <!-- bootstrap-daterangepicker -->
    <!--<link href="<?php /*echo base_url(); */?>css/daterangepicker.css" rel="stylesheet">-->

    <!-- Custom Theme Style -->
    <!--<link href="<?php /*echo base_url(); */?>css/custom.min.css" rel="stylesheet">-->
	
    <link href="css/ubk_style.css" rel="stylesheet">
  </head>
    <?php  @$admin_details=$this->User->getAdminData();?>
    
  <body class="log_bod">
	<div class="log_in_wrapper">
		  <header>
			  <div class="top">
				  <div class="col-sm-1">
					  <div class="logo_admin">
						 <img src="<?php echo base_url();?>uploads/images/<?php echo @$admin_details[0]['image'];?>" alt="CasesPortal">
					  </div>
				  </div>
			  </div>
		  </header>
		  
		  
		 <div class="containerlogin">
			 <div class="row">
				 <div class="con-sm-12 log_in_padd">

				
				      <div class="con-sm-12 retrive_password">
							<h2>Log in</h2> 
							<p>Enter your account's email address</p>
				      </div>
						 
						<?php
						if(isset($flash_message)){
						   if($flash_message == TRUE)
							{
						 ?>
						  <div class="alert alert-success">
							<a class="close" data-dismiss="alert">×</a>
							<strong>Well done!</strong> new created created with success.
						  </div>
						<?php
						}else { ?>
						<div class="col-md-12">
							  <div class="alert alert-danger">
								<a class="close" data-dismiss="alert">×</a>
								<strong>Oops!</strong> Invalid email or password.
							  </div> 
                        </div>							  
					   <?php } } ?> 
										   
										  
					   <?php 
                      $attributes = array('class' => 'form-horizontal', 'id' => 'myForm545', 'enctype' => 'multipart/form-data');
		              echo form_open_multipart('admin_main', $attributes);?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email Id <span class="star_login">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="email" required="required" class="form-control col-md-7 col-xs-12" name="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Password <span class="star_login">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="password" name="password" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                     
                      <div class="ln_solid"></div>
						  <div class="form-group">
							<div class="col-sm-12 sumit_but_login">
								<input type="submit" class="btn btn-success minglrfit_login" value="Login">
							</div>
						  </div>
						  
						  <div class="form-group">
							<div class="col-sm-12 sumit_but_login">
								<a href="<?php echo base_url()?>/forgot_password" class="login_forgot">Forgot Pasword ?</a>
							</div>
						  </div>
						  

                     <?php echo form_close(); ?>
				 </div> 
			 </div> 
		 </div> 
		  
		  
		  
		  <footer class="login_foter">
		       <div class="login_foter"></div>
		  </footer>
	  </div>
  
  
  

       <!-- jQuery -->
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>js/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>js/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url(); ?>js/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url(); ?>js/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>js/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url(); ?>js/skycons.js"></script>
   
   <script type="text/javascript">
   function preventback(){
    window.history.forward();}
    setTimeout("preventback()",0);
   window.onunload= function() { null };
    </script>
    <!-- DateJS -->
    <script src="<?php echo base_url(); ?>js/date.js"></script>
    
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>js/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>js/custom.min.js"></script>

  </body>
</html>
