
$("#cng_cover").change(function(){
	//alert('hiiiii');
    readURL_cover(this);
	//alert()
});	
	  $("#imgInp").change(function() {
		 // alert('okk');
    var val = $(this).val();
    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':
            //alert("an image");
			$("#profile_pic" ).submit();
			
			
            break;
        default:
            $(this).val('');
            // error message here
            alert("Sorry, only JPG, JPEG, & PNG  files are allowed");
            break;
    }
}); 