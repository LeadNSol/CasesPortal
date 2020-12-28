<?php
$userdata=$this->session->all_userdata();
		
 $user_id=$userdata['id'];
		
?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">        
         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>View Profile</h2>
                    
                    <div class="clearfix"></div>
                  </div>
				  <?php 				
					$attributes = array('class' => 'form-horizontal');					
					echo  form_open_multipart('admin_main/edit_profile_pic/'.$user_id, $attributes);
					?>
					<div class="col-sm-12">
					<div class="col-sm-3"></div>
					<div class="col-sm-8 no-padding" style="text-align:center;">
				     <label class="add_ad_img">
				  	  <img src="<?php echo site_base_url();?>images/<?php echo $admin_profile[0]['image'];?>" id="blah" class="ad_img_vw_prl" alt="your image">
					  <input type="hidden" name="old_photo" value="<?php echo $admin_profile[0]['image'];?>">
					<input type="hidden" value="2" name="type_profile">
					<input type="file" id="imgInp" name="gallery_image" style="display:none;">
				    </label>
					
					<label class="custom_upload">
						<input type="submit" name="sub" value="Upload" class="upload-button-for-edit-profile">
					</label>
				  </div>
				  </div>
				  <?php echo form_close(); ?>
                  <div class="x_content">
				   <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">

                      <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="first-name">First Name <span class="required">*</span>
                        </label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="first_name" id="first_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $admin_profile[0]['first_name']?>">
                        </div>
                      </div>
                      <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme" for="last-name">Last Name <span class="required">*</span>
                        </label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" id="last-name" name="last_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $admin_profile[0]['last_name']?>">
                        </div>
                      </div>
                      <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme">Email Id <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="email" class="form-control col-md-7 col-xs-12" name="email" type="Email" name="middle-name" value="<?php echo $admin_profile[0]['email']?>">
                        </div>
                      </div>
					  
					    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme">City<span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control col-md-7 col-xs-12" type="text" name="city" value="<?php echo $admin_profile[0]['city']?>">
                        </div>
                      </div>
					  
					    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme">State<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control col-md-7 col-xs-12" type="text" name="state" value="<?php echo $admin_profile[0]['state']?>">
                        </div>
                      </div>
					  
					  
					    <div class="form-group profile_ed_f_rm">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 view_le_nme">Country<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control col-md-7 col-xs-12" type="text" name="country" value="<?php echo $admin_profile[0]['country']?>">
                        </div>
                      </div>
					  
					  
                      
                      <div class="ln_solid"></div>
                      <div class="form-group profile_ed_f_rm">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 save_pr_v">
                          <button type="submit" class="btn btn-success sve_bot">Save</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          
        </div>
        <!-- /page content -->

        <!-- footer content -->
     