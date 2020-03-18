   
   <section class="content-header">
      <h1>
        Edit Manager        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'admin/viewmanager' ?>">View Manager</a></li>
        <li class="active">Edit Manager</li>
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
		  <form id="manager_form" method="post">
           <div class="col-md-12"> 		   
			<div class="form-group">
			  <div class="col-md-6">
                <label>Branch Name</label>               
				<select name="branch_id" id="branch_id" class="form-control">
                  <option value="">select branch</option>
				  <?php foreach($result as $val){ ?>				   
					<option value="<?php echo $val['id']; ?>" <?php if($val['id']==$results[0]['branch_id']){ echo 'selected="selected"';} ?>><?php echo $val['branch_name']; ?></option>					
				  <?php } ?>
				</select>
				<input type="hidden" name="manager_code" id="manager_code" class="form-control" value="<?php echo $results[0]['manager_code']; ?>">
				<input type="hidden" name="editid" id="editid" class="form-control" value="<?php echo $results[0]['id']; ?>">
			  </div>
			  <div class="col-md-6">
                <label>Manager Name</label>               
				<input type="text" name="manager_name" id="manager_name" class="form-control" value="<?php echo $results[0]['manager_name'];?>" style='text-transform:capitalize'>
			  </div>			  
            </div>
			
			<div class="form-group">			   
			 <div class="col-md-6">
			  <label>Manager City</label>               
			  <input type="text" name="manager_city" id="manager_city" class="form-control" value="<?php echo $results[0]['manager_city'];?>" style='text-transform:capitalize'>
			 </div> 
			 <div class="col-md-6">
			  <label>Manager Pincode</label>               
			  <input type="text" name="manager_pincode" id="manager_pincode" class="form-control" value="<?php echo $results[0]['manager_pincode'];?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6">
			 </div>			  
            </div>			
			
			<div class="form-group">
			 <div class="col-md-6">
              <label>Manager Address</label>               
			  <input type="text" name="manager_address" id="manager_address" class="form-control" value="<?php echo $results[0]['manager_address'];?>" style='text-transform:capitalize'>
			 </div>
			 <div class="col-md-6">
			  <label>Manager Mobile</label>               
			  <input type="text" name="manager_mobile" id="manager_mobile" class="form-control" value="<?php echo $results[0]['manager_mobile'];?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10">
			 </div>			  
            </div>
            
			<div class="form-group">			  
			 <div class="col-md-6">
              <label>Manager Email</label>               
			  <input type="text" name="manager_email" id="manager_email" class="form-control" value="<?php echo $results[0]['manager_email'];?>">
			 </div>
			 <div class="col-md-6">
			  <label>Manager Username</label>               
			  <input type="text" name="username" id="username" class="form-control" value="<?php echo $results[0]['username'];?>">
			 </div>
            </div>
			
			<div class="form-group">			   
			  <div class="col-md-6">
			    <label>Manager Password</label>               
			    <input type="text" name="password" id="password" class="form-control" value="<?php echo $results[0]['password'];?>">
			  </div>
			  <div class="col-md-6">               
			  </div>
            </div>
			
			<div id='loader' style='display: none; position:fixed; z-index: 999; height: 50%; width:2em; overflow: show; margin: auto; top: 0; left: 0; bottom: 0; right: 0;'>
              <img src='<?php echo base_url().'assets/img/giphy.gif' ?>' width=auto height=auto>
            </div>
			
			<div class="col-md-12"><br></div>		   
		    <div class="col-md-12"> 
			 <div class="alert alert-danger alert-dismissible" style="display:none" id="manager_error">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                
             </div>		
             <div class="alert alert-success alert-dismissible" style="display:none" id="manager_success">
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
                 type:'POST', 
				 url :"<?php echo base_url().'admin/saveManager' ?>",
                 data:$('#manager_form').serialize(),
                      success: function(data)
		              {       
                         var response = JSON.parse(data);
					     if(response.status=="error")
					     {
					        $('#manager_error').html(response.errors);
					        $('#manager_error').show();
					        $('#manager_error').delay(2000).fadeOut();
							//$("#loader").hide();
					     }
					     else
					     {					   
					        $('#manager_success').html(response.status);
					        $('#manager_success').show();
					        $('#manager_success').delay(2000).fadeOut();
					        $('#manager_form')[0].reset();
							setTimeout(function(){window.location.href = window.location.pathname;}, 2000);
							//$("#loader").hide();
					     }					
                      }
              });		
	 }	 
   </script>
	
	