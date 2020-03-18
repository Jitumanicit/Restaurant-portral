    <section class="content-header">
      <h1>
        Add Branch        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'admin/viewbranch' ?>">View Branch</a></li>
        <li class="active">Add Branch</li>
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
		 
		  <form id="branch_form" method="post">
           <div class="col-md-12"> 		   
			
			<div class="form-group">
			   <div class="col-md-6">
                 <label>Branch Name</label>               
				 <input type="text" name="branch_name" id="branch_name" class="form-control" style='text-transform:capitalize'>
			   </div>
			   <div class="col-md-6">
			     <label>Branch City</label>               
				 <input type="text" name="branch_city" id="branch_city" class="form-control" style='text-transform:capitalize'>
			   </div> 
            </div>

			<div class="form-group">			   
			  <div class="col-md-6">
			     <label>Branch Pincode</label>               
				 <input type="text" name="branch_pincode" id="branch_pincode" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6">
			  </div>
			  <div class="col-md-6">
                <label>Branch State</label>               
                <select name="state_id" id="state_id" class="form-control">
				  <option value="">select</option>
				  <?php foreach($state as $val){ ?>
				  <option value="<?php echo $val['id']; ?>"><?php echo $val['state_name']; ?></option>
				  <?php } ?>
				</select>
			  </div>
            </div>	
            
            <div class="form-group">
              <div class="col-md-6">
                <label>Branch Address</label>               
				<input type="text" name="branch_address" id="branch_address" class="form-control" style='text-transform:capitalize'>
              </div>
              <div class="col-md-6"></div>	
            </div>	
		    

		    <div id='loader' style='display:none; position: fixed; z-index: 999; height: 50%; width: 2em; overflow: show; margin: auto; top: 0; left:0; bottom:0; right:0;'>
              <img src='<?php echo base_url().'assets/img/giphy.gif' ?>' width=auto height=auto>
            </div>
            
			<div class="col-md-12"><br></div>		   
		    <div class="col-md-12"> 
			  <div class="alert alert-danger alert-dismissible" style="display:none" id="branch_error">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                
              </div>		
              <div class="alert alert-success alert-dismissible" style="display:none" id="branch_success">
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
				 url :"<?php echo base_url().'admin/saveBranch'?>",
                 data:$('#branch_form').serialize(),
                 success: function(data)
		         {        
                   var response = JSON.parse(data);				   
				   if(response.status=="error")
				   {
					  $('#branch_error').html(response.errors);
					  $('#branch_error').show();
					  $('#branch_error').delay(2000).fadeOut();
					  //$("#loader").hide();
				   }
				   else
				   {					   
					  $('#branch_success').html(response.status);
					  $('#branch_success').show();
					  $('#branch_success').delay(2000).fadeOut();
					  $('#branch_form')[0].reset();
					  //$('#state_id').val('');
					  //$("#loader").hide();
					}					
                 }
              });		
	 }	 
   </script>
	
	