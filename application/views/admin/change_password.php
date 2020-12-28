<?php 
$this->load->model('module');
$admin_details=$this->module->get_admindata(); 
$user_email=$admin_details[0]['email'];

?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col change_ps_w_ord" role="main">        
         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Change <small>Password</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group profile_ed_f_rm">
							<label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="first-name">Old Password <span class="required">*</span>
							</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
							     <input type="password" id="password" required="required" class="form-control col-md-7 col-xs-12">
							</div>
							<span id="error_password" class="error_msg"></span> 
                      </div>
                      <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="last-name">New Password <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="password" id="new_password" name="last-name" required="required" class="form-control col-md-7 col-xs-12" value="" disabled="disabled">
                        </div>
						 <span class="error_msg" id="error_new_password"></span>
                      </div>
                      <div class="form-group profile_ed_f_rm">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme">Confirm Password  <span class="required">*</span>
						</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input id="confirm_password" class="form-control col-md-7 col-xs-12" type="password" name="middle-name" disabled="disabled">
                        </div>
						 <span class="error_msg" id="error_confirm_password"></span>
						  <span class="error_msg" id="pass_miss"></span>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group profile_ed_f_rm">
                        <div class="col-md- col-sm-9 col-xs-12 col-md-offset-3">
                          <a class="btn btn-success" id="change_pass">Change password</a>
                        </div>
						<span class="sucess_msg" id="chng_sucess"></span>
						<span class="error_msg" id="chng_wait"></span>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          
        </div>
        <!-- /page content -->

        <!-- footer content -->
  
<style>
.change_ps_w_ord{min-height:611px !important;}
</style>
<script>
		  
		 $(document).ready(function(){
		  // alert();
			$("#password").change(function (e) {
				//alert('okkkk');
			 var email='<?php echo $user_email;?>';
			 var password=$("#password").val();
			//var email='uttam';
			var datastring='email='+email+'&password='+password;  
			 //alert(datastring);
			 $.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>admin_main/chn_password_new",
				data: datastring,
				 beforeSend: function() {     
                  $("#wait_msg").html('please wait.....');
                  },
				success: function(data) 
				{
					//alert(data);
					if(data==1)
					{    $("#wait_msg").hide();
						 $("#new_password").prop('disabled',false);
						 $("#confirm_password").prop('disabled',false);
						 $("#new_password").focus();
						 $("#error_password").fadeOut();
						 document.getElementById("invalid_oldpassword").value=1;
		
					}
					else
					{						
						//alert('Invalid password');
						$("#error_password").html('Invalid old Password');
						
						$("#wait_msg").hide();
						return false;
					}
					//console.log(data);					
				}										
			});
		 
        });
		
			 $("#change_pass").click(function (e) {
				// alert()
			 var email='<?php echo $user_email;?>';
			 var password=$("#password").val();
			 var new_password=$("#new_password").val();
			 var confirm_password=$("#confirm_password").val();
			 var set_password_data=$("#invalid_oldpassword").val();
			 
			 //alert(confirm_password);
			//var email='uttam';
			var datastring='email='+email+'&password='+password+'&new_password='+new_password; 
			if(set_password_data==0)
			{
				$("#error_password").html('Invalid old Password')
				$("#password").focus();
				return false;
			}
			if(password=='')
			{
				$("#error_password").hide();
			    $("#error_password").html('Please enter password')
				$("#password").focus();
				return false;
				
			}
			if(new_password=='')
			{  $("#error_password").hide();
			  $("#error_new_password").html('Please enter new password')
				$("#new_password").focus();
				return false;
				
			}
			//alert(confirm_password);
			if(confirm_password=='')
			{  $("#error_new_password").hide();
			   $("#error_confirm_password").html('Please Confirm password')				
				$("#confirm_password").focus();
				return false;
			}
			if(new_password!=confirm_password)
			{
				$("#error_confirm_password").html('Password miss match')					
				$("#confirm_password").focus();
				return false;
			}
			
			else
			{				
			 //alert(datastring);
				 $.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>admin_main/set_newpassword",
					data: datastring,
					beforeSend: function() {     
                       $("#chng_wait").html('please wait.....');
                    },
					success: function(data) 
					{
						if(data==1)
						{   $("#chng_wait").hide();
					        $("#error_confirm_password").html('Password has been changed successfully')
							
						}
						//console.log(data);					
					}										
				});
			}
		 
        });
			 
});
		  
	</script>
  