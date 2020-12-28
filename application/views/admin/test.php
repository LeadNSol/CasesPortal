    <?php 
	
		 $id=$this->uri->segment(2);
	//echo"<pre>";
		//print_r($get_cateory);exit;
	?>
	<!-- /top navigation -->
        <!-- page content -->
		
        <div class="right_col change_ps_w_ord" role="main">        
         <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add <small>Gallery</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                   zfgdfgd
				   
				   
				   <div class="container">

 <div class="col-md-6" align="right">
  <label>Select Multiple Files</label>
 </div>
 <div class="col-md-6">
  <input type="file" name="files" id="files" multiple />
 </div>
 <div style="clear:both"></div>
 <br />
 <br />
 <div id="uploaded_images"></div>
</div>

                   xxxx
                  </div>
                </div>
              </div>
            </div>
          
        </div>
        <!-- /page content -->

        <!-- footer content -->
  
<script>
$(document).ready(function(){
	//alert();
 $('#files').change(function(){
  var files = $('#files')[0].files;
  var error = '';
  var form_data = new FormData();
  for(var count = 0; count<files.length; count++)
  {
   var name = files[count].name;
   var extension = name.split('.').pop().toLowerCase();
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
    error += "Invalid " + count + " Image File"
   }
   else
   {
    form_data.append("files[]", files[count]);
   }
  }
  if(error == '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>upload_multiple/upload",
    method:"POST",
    data:form_data,
    contentType:false,
    cache:false,
    processData:false,
    beforeSend:function()
    {
     $('#uploaded_images').html("<label class='text-success'>Uploading...</label>");
    },
    success:function(data)
    {
		
     $('#uploaded_images').html(data);
     $('#files').val('');
    }
   })
  }
  else
  {
   alert(error);
  }
 });
});
</script>

  