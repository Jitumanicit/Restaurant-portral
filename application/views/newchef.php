   
   <section class="content-header">
      <h1>
        Add Chef        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'admin/viewchef' ?>">View Chef</a></li>
        <li class="active">Add Chef</li>
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
		  <form id="chef_form" method="post">
           <div class="col-md-12"> 		   
			<div class="form-group">
			  <div class="col-md-6">
                <label>Chef Name</label>               
				<input type="text" name="chef_name" id="chef_name" class="form-control" style='text-transform:capitalize'>
			  </div>
			  <div class="col-md-6">
			    <label>Chef City</label>               
				<input type="text" name="chef_city" id="chef_city" class="form-control" style='text-transform:capitalize'>
			  </div> 
            </div>
			<div class="form-group">			   
			  <div class="col-md-6">
			    <label>Chef Pincode</label>               
				<input type="text" name="chef_pincode" id="chef_pincode" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6">
			  </div>
			  <div class="col-md-6">
                <label>Chef Address</label>               
				<input type="text" name="chef_address" id="chef_address" class="form-control" style='text-transform:capitalize'>
			  </div>
            </div>
			
			<div class="form-group">			   
			  <div class="col-md-6">
			    <label>Chef Mobile</label>               
				<input type="text" name="chef_mobile" id="chef_mobile" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
			  </div>
			  <div class="col-md-6">
                <label>Chef Email</label>               
				<input type="text" name="chef_email" id="chef_email" class="form-control">
			  </div>
            </div>
			
			<div class="form-group">			   
			  <div class="col-md-6">
			    <label>Chef Username</label>               
				<input type="text" name="username" id="username" class="form-control">
			  </div>
			  <div class="col-md-6">
                <label>Chef Password</label>               
				<input type="text" name="password" id="password" class="form-control">
			  </div>
            </div>
			
			<div id='loader' style='display: none; position:fixed; z-index:999; height:50%; width:2em; overflow: show; margin: auto; top:0; left:0; bottom:0; right:0;'>
              <img src='<?php echo base_url().'assets/img/giphy.gif' ?>' width=auto height=auto>
            </div>
			
			<div class="col-md-12"><br></div>		   
		    <div class="col-md-12"> 
			  <div class="alert alert-danger alert-dismissible" style="display:none" id="chef_error">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                
              </div>		
              <div class="alert alert-success alert-dismissible" style="display:none" id="chef_success">
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
				 url :"<?php echo base_url().'admin/saveChef'?>",
                 data:$('#chef_form').serialize(),
                 success: function(data)
		         {        
                    var response = JSON.parse(data);
					if(response.status=="error")
					{
					  $('#chef_error').html(response.errors);
					  $('#chef_error').show();
					  $('#chef_error').delay(2000).fadeOut();
					  //$("#loader").hide();
					}
					else
					{					   
					  $('#chef_success').html(response.status);
					  $('#chef_success').show();
					  $('#chef_success').delay(2000).fadeOut();
					  $('#chef_form')[0].reset();
					  //$("#loader").hide();
					}					
                 }
              });
		
	 }
	 
   </script>
	
	