<?php 
$id = $this->uri->segment(2);
?>
<style>
    .form-gap {
    padding-top: 70px;
}
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


<!------ Include the above in your HEAD tag ---------->

 
 <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                          <input name="newpass" id="newpass" placeholder="Enter new password" class="form-control"  type="password">
                          <span id="new_passs"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                          <input name="conpass" id="conpass" placeholder="Confirm password" class="form-control"  type="password">
                          <span id="pass_missmatch"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" onclick="chngpasss()" value="Reset Password" type="submit">
                      </div>
                     
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
                    /*	function vfpass(){
                        var old_pass=$("#old_pass").val();
                        var email='<?php //echo $user_email;?>'
                        if(!old_pass==""){
                $.ajax({
				type: "POST",
				url: "<?php //echo base_url(); ?>chn_password_new",
				data: {old_pass:old_pass,email:email},
				success: function(data) 
				{
					//alert(data);
					if(data==1)
					{   $("#vfpass").hide();
					    $("#error_password").hide();
					    $("#chngpass").show();
					    $("#old_pass").prop('disabled',true);
						$("#conpass").prop('disabled',false);
						$("#newpass").prop('disabled',false);
		
					}
					else
					{						
					$("#error_password").html('<font color="red"><b>Invalid old Password!!!</font>');
					
					}
					//console.log(data);					
				}										
			    });
                  	}else{
                  	    $("#error_password").html('<font color="yellow"><b>Please Enter Old Password!!!</font>');
                  	}
                  	
                    	}*/
                    	
                    	function chngpasss(){
                                var newpass=$("#newpass").val();
                                var conpass=$("#conpass").val();
                                var id='<?php echo $id;?>'
                               // alert(id);
                                if(newpass==""||conpass==""){
                                  $("#pass_missmatch").html('<font color="yellow"><b>Must Type  Password!!!!</font>');   
                                }
                                else if(newpass==conpass){
                                    $("#pass_missmatch").hide();
                                $.ajax({
        				            type: "POST",
                    				url: "<?php echo base_url(); ?>set_new_userpass",
                    				data: {newpass:newpass, id:id},
                    				success: function(data) 
                    				{
                    				    //alert(data);
        					           if(data == 1){
        					               alert("Your Password Has been Updated.");
        					           }else{
        					               alert("Password not Updated.");
                                     }
                    				}
                                });
                                }
                                    else{
                                       $("#pass_missmatch").html('<font color="red"><b>Password Not Matched!!!</font>'); 
                                    }
                    	}
                    	
                    	
                </script>