    <section class="content-header">
      <h1>
        Edit Tax        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'admin/viewtax' ?>">View Tax</a></li>
        <li class="active">Edit Tax</li>
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
			     <label>Service Type</label> 
				 <select name="menu_type" id="menu_type" class="form-control">
				   <option value="">select</option>
				   <option value="1" <?php if("1"==$result[0]['menu_type']){ echo 'selected="selected"';} ?>>Food</option>
				   <option value="2" <?php if("2"==$result[0]['menu_type']){ echo 'selected="selected"';} ?>>Alcohol</option>
				 </select>
				 <input type="hidden" name="editid" id="editid" value="<?php echo $result[0]['id']; ?>">
			   </div> 
			   <div class="col-md-6">
                 <label>Tax Name</label>               
				 <input type="text" name="tax_name" id="tax_name" class="form-control" value="<?php echo $result[0]['tax_name'];?>" style='text-transform:uppercase'>
			   </div>			   
            </div>
            
			<div class="form-group">			   
			  <div class="col-md-6">
			    <label>Tax Percentage</label>               
				<input type="text" name="tax_percentage" id="tax_percentage" class="form-control" value="<?php echo $result[0]['tax_percentage']; ?>">
			  </div>
			  <div class="col-md-6">                
			  </div>
            </div> 
			
			<div id='loader' style='display: none; position: fixed; z-index:999; height:50%; width: 2em; overflow: show; margin:auto; top:0; left:0; bottom:0; right:0;'>
              <img src='<?php echo base_url().'assets/img/giphy.gif' ?>' width=auto height=auto>
            </div>
			
			<div class="col-md-12"><br></div>		   
		    <div class="col-md-12"> 
			  <div class="alert alert-danger alert-dismissible" style="display:none" id="tax_error">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                
              </div>		
              <div class="alert alert-success alert-dismissible" style="display:none" id="tax_success">
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
				url :"<?php echo base_url().'admin/saveTax'?>",
                data:$('#branch_form').serialize(),
                success: function(data)
		        {        
                  var response = JSON.parse(data);				   
				  if(response.status=="error")
				  {
					$('#tax_error').html(response.errors);
					$('#tax_error').show();
					$('#tax_error').delay(2000).fadeOut();
					//$("#loader").hide();
				  }
				  else
				  {					   
					$('#tax_success').html(response.status);
					$('#tax_success').show();
					$('#tax_success').delay(2000).fadeOut();
					$('#tax_form')[0].reset();
					setTimeout(function(){window.location.href = window.location.pathname;}, 2000);
					//$("#loader").hide();
				  }					
                }
              });		
	 }	 
   </script>	