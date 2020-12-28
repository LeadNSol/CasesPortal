        <div class="right_col change_ps_w_ord" role="main">        
         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Change <small>Password</small></h2>                    
                    <div class="clearfix"></div>
                  </div>
				  <?php
						if(isset($flash_message)){
						   if($flash_message == TRUE)
							{
						 ?>
						 
						  <div class="alert alert-success">
							<a class="close" data-dismiss="alert">×</a>
							<strong>Well done!</strong> Site  logo updated successfully.
						  </div>
								<?php }else { ?>
									  <div class="alert alert-danger">
										<a class="close" data-dismiss="alert">×</a>
										<strong>Oops!</strong> Please Try Again...
									  </div>     
							   <?php } } ?> 
                  <div class="x_content">
                    <br />                  
                    <div class="u_p_l_a_img_d">
						<div class="col-sm-12">
							<div class="img_d_sec">
								 <img src="<?php echo site_base_url();?>images/<?php echo $site_logo[0]['logo'];?>">
							</div>
						</div>					
						<div class="col-sm-12">
						   <?php 					   
							$attributes = array('class' => 'form-horizontal');					
							echo  form_open_multipart('admin_main/logo_change/', $attributes);
							?>
							<div class="upload_2">
								<input type="file" name="change_logo"/>
							</div>
							<div class="uplod_d">
								<input type="submit" value="Upload" name="submit" class="uplod"/>
							</div>							
						    <?php echo form_close(); ?>
						</div>						
					  <div class="clearfix"></div>
				    </div>          
                  </div>
                </div>
              </div>
            </div>
          
        </div>
        <!-- /page content -->

        <!-- footer content -->
  

  