$(document).ready(function() {
    function opencart()
     {
         //alert('hiiiiiiiiiiii');
	     $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('user/opencart');?>",
                  data: "",
                  success: function (response) {                  
				   $(".displaycontent").html(response);
                  }
                });
     }
	
	 
	 function openlogin()
     {
         //alert('hiiiiiiiiiiii');
	     $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('user/openlogin');?>",
                  data: "",
                  success: function (response) {
                  $(".displaylogin").html(response);
                  }
                });
     }
	
	 function opensignup()
     {      	     
		$.ajax({
                   type: "POST",
                   url: "<?php echo site_url('user/opensignup');?>",
                   data: "",
                   success: function (response) {					
                     $(".displaysignup").html(response);					 
                   }
               });
     }
	      
});