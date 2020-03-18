    <section class="content-header">
      <h1> Edit Menu </h1>
      <ol class="breadcrumb">
       <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <li><a href="<?php echo base_url().'admin/viewmenu' ?>">View Menu</a></li>
       <li class="active">Edit Menu</li>
      </ol>
    </section>	
	
	<!-- Main content -->
    <section class="content">      
      <div class="box box-default">        
		<div class="box-header with-border">
         <!--<h3 class="box-title">Select2</h3>--->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
          </div>
        </div>  
		
        <div class="box-body">
          <div class="row"> 
		  <form id="menu_form" method="post">
           <div class="col-md-12"> 		   
			<div class="form-group">
			  <div class="col-md-6">
                <label>Category Name</label>               
				<select name="catergory_id" id="catergory_id" class="form-control">
                 <option value="">Select Category</option>
				 <?php foreach($results as $val){ ?>				   
				  <option value="<?php echo $val['id']; ?>" <?php if($val['id']==$result[0]['catergory_id']){ echo 'selected="selected"'; } ?>><?php echo $val['category_name']; ?></option>					
				 <?php } ?>
				</select>
				<input type="hidden" name="editid" id="editid" value="<?php echo $result[0]['id']; ?>">
			  </div>
			  <div class="col-md-6">
                <label>Menu Name</label>               
				<input type="text" name="menu_name" id="menu_name" class="form-control" value="<?php echo $result[0]['menu_name'];?>" style='text-transform:capitalize'>
			  </div>			  
            </div>	
			
			<div class="form-group">
			  <div class="col-md-6">
			    <label>Menu Price</label>               
				<input type="text" name="menu_price" id="menu_price" class="form-control" value="<?php echo $result[0]['menu_price'];?>">
			  </div>
			  <div class="col-md-6"></div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
				  	<label>Time Required</label>               
					<input type="text" name="menu_time" id="menu_time" class="form-control" value="<?php echo $result[0]['menu_time'];?>">
			  </div>
			  <div class="col-md-6">
			  	<label>Product Availability</label>               
				<select name="menu_aval" id="menu_aval" class="form-control">
				<option value="">Select Availability</option>
				<option value="1">Available</option>
				<option value="0">Not Available</option>	
				</select>
			  </div>
			 </div>
			
			<div id='loader' style='display: none; position: fixed; z-index: 999; height: 50%; width: 2em; overflow: show; margin: auto; top: 0; left: 0; bottom: 0; right: 0;'>
              <img src='<?php echo base_url().'assets/img/giphy.gif' ?>' width=auto height=auto>
            </div>
			
			<div class="col-md-12"><br></div>		   
		    <div class="col-md-12"> 
			  <div class="alert alert-danger alert-dismissible" style="display:none" id="menu_error">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                
              </div>		
              <div class="alert alert-success alert-dismissible" style="display:none" id="menu_success">
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
			   url :"<?php echo base_url().'admin/saveMenu' ?>",
               data:$('#menu_form').serialize(),
               success: function(data)
		       {       
                 var response = JSON.parse(data);
				 if(response.status=="error")
				 {
					$('#menu_error').html(response.errors);
					$('#menu_error').show();
					$('#menu_error').delay(2000).fadeOut();
					//$("#loader").hide();
				 }
				 else
				 {					   
				    $('#menu_success').html(response.status);
				    $('#menu_success').show();
				    $('#menu_success').delay(2000).fadeOut();
				    $('#menu_form')[0].reset();
					setTimeout(function(){window.location.href = window.location.pathname;}, 2000);
					//$("#loader").hide();
				 }					
               }
            });		
	}	 
   </script>	