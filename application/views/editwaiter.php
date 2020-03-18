   
   <section class="content-header">
      <h1>
        Add Waiter        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'admin/viewwaiter' ?>">View Waiter</a></li>
        <li class="active">Add Waiter</li>
      </ol>
    </section>	
	
	<!-- Main content -->
    <section class="content">      
      <div class="box box-default">        
		<div class="box-header with-border">
         <!-- <h3 class="box-title">Select2</h3>--->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!----<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>--->
          </div>
        </div>  
		
        <div class="box-body">
         <div class="row"> 
		  <form id="waiter_form" method="post">
           <div class="col-md-12"> 		   
			
			<div class="form-group">
			  <div class="col-md-6">
                <label>Waiter Name</label>               
				<input type="text" name="waiter_name" id="waiter_name" class="form-control" value="<?php echo $result[0]['waiter_name'];?>" style='text-transform:capitalize'>
			    <input type="hidden" name="editid" id="editid" value="<?php echo $result[0]['id'];?>">
			    <input type="hidden" name="waiter_code" id="waiter_code" value="<?php echo $result[0]['waiter_code'];?>">
			  </div>
			  <div class="col-md-6">
			    <label>Waiter City</label>               
				<input type="text" name="waiter_city" id="waiter_city" class="form-control" value="<?php echo $result[0]['waiter_city'];?>" style='text-transform:capitalize'>
			  </div> 
            </div>
            
			<div class="form-group">			   
			  <div class="col-md-6">
			   <label>Waiter Pincode</label>               
			   <input type="text" name="waiter_pincode" id="waiter_pincode" class="form-control" value="<?php echo $result[0]['waiter_pincode'];?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6">
			  </div>
			  <div class="col-md-6">
               <label>Waiter Address</label>               
			   <input type="text" name="waiter_address" id="waiter_address" class="form-control" value="<?php echo $result[0]['waiter_address'];?>" style='text-transform:capitalize'>
			  </div>
            </div>
			
			<div class="form-group">			   
			 <div class="col-md-6">
			  <label>Waiter Mobile</label>               
			  <input type="text" name="waiter_mobile" id="waiter_mobile" class="form-control" value="<?php echo $result[0]['waiter_mobile'];?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
			 </div>
			 <div class="col-md-6">
              <label>Waiter Email</label>               
			  <input type="text" name="waiter_email" id="waiter_email" class="form-control" value="<?php echo $result[0]['waiter_email'];?>">
			 </div>
            </div>
			
			<div class="form-group">			   
			  <div class="col-md-6">
			    <label>Waiter Username</label>               
				<input type="text" name="username" id="username" class="form-control" value="<?php echo $result[0]['username'];?>">
			  </div>
			  <div class="col-md-6">
                <label>Waiter Password</label>               
				<input type="text" name="password" id="password" class="form-control" value="<?php echo $result[0]['password'];?>">
			  </div>
            </div>
			
			<div id='loader' style='display: none; position: fixed; z-index: 999; height: 50%; width: 2em; overflow: show; margin: auto; top:0; left:0; bottom:0; right:0;'>
              <img src='<?php echo base_url().'assets/img/giphy.gif' ?>' width=auto height=auto>
            </div>
			
			<div class="col-md-12"><br></div>		   
		    <div class="col-md-12"> 
			  <div class="alert alert-danger alert-dismissible" style="display:none" id="waiter_error">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                
              </div>		
              <div class="alert alert-success alert-dismissible" style="display:none" id="waiter_success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                
              </div>	 
		    </div>			
		    <div class="col-md-12"><br></div>
			
           </div>
		  </form>
		  <div class="col-md-12" align="center">		    
		    <input type="submit" name="submit" value="save" class="btn btn-primary btn-sm" onclick="saveform()"> 
		  </div>		  
        </div>
      </div>    
	</div>
   </section>
	
   <script>	
	function saveform()
	{
		//$("#loader").show();		
	  $.ajax({
               type:'post', 
			   url :"<?php echo base_url().'admin/saveWaiter'?>",
               data:$('#waiter_form').serialize(),
               success: function(data)
		       {        
                 var response = JSON.parse(data);
				 if(response.status=="error")
				 {
				   $('#waiter_error').html(response.errors);
				   $('#waiter_error').show();
				   $('#waiter_error').delay(2000).fadeOut();
				   //$("#loader").hide();
				 }
				 else
				 {					   
				   $('#waiter_success').html(response.status);
				   $('#waiter_success').show();
				   $('#waiter_success').delay(2000).fadeOut();
				   $('#waiter_form')[0].reset();
				   setTimeout(function(){window.location.href = window.location.pathname;}, 2000);
				   //$("#loader").hide();
				 }					
               }
             });		
	}	 
   </script>	