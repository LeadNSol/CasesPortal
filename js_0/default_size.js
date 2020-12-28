var xmlHttp_size;

function set_default(size_id,base_url)
{
	
	//alert(base_url);
	xmlHttp_size=GetXmlHttpObject_amount_time();
	if (xmlHttp_size==null)
	 {
		alert ("Browser does not support HTTP Request");
		return;
	 }
		var	url=base_url+"set_default_size.php?size_id="+size_id; 
	
		alert(url);
		url=url+"&sid="+Math.random();
		xmlHttp_size.onreadystatechange=stateChanged_size ;
		xmlHttp_size.open("GET",url,true);
		xmlHttp_size.send(null);
		return false;

}

function stateChanged_size() 
 { 
	if (xmlHttp_size.readyState==4)
	{
		
		 var temp=xmlHttp_size.responseText;
		 //alert(temp);
		 var arr = temp.split("@@@"); 
		 var country_code= arr[1];
		 if(country_code=='US')
		 {
		 

		  document.getElementById("region_div").innerHTML=arr[0];
		 }
		 else
		 {
		  document.getElementById("region").style.visibility='visible';
		  document.getElementById("region").style.display='block';
		  document.getElementById("region_id").style.visibility='hidden';
		  document.getElementById("region_id").style.display='none';
		  document.getElementById("region").value='';
		  document.getElementById("region_id").selectedIndex=0;
		  
		 }
		  	
			
	}
 }
	 
	 
function GetXmlHttpObject_amount_time()
	{
		if (window.XMLHttpRequest)
	  	{
	     	// code for IE7+, Firefox, Chrome, Opera, Safari
	  		return new XMLHttpRequest();
	  	}
		if (window.ActiveXObject)
	  	{
	 		 // code for IE6, IE5
	  		return new ActiveXObject("Microsoft.XMLHTTP");
	  	}
		return null;
	}
	
