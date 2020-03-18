   
    <section class="content-header">
      <h1>
        Add Table        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url().'admin/viewtable' ?>">View Table</a></li>
        <li class="active">Add Table</li>
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
		  <form id="table_form" method="post">
           <div class="col-md-12"> 		   
			<div class="form-group">
			  <div class="col-md-6">
                <label>Branch Name</label>               
				<select name="branch_id" id="branch_id" class="form-control">
                  <?php if($userdata['roles']=='manager')
				 {
				  foreach($branch as $val)
				  {
				   if($val['id']==$userdata['branch_id']){
				   ?>				    
				    <option value="<?php echo $val['id']; ?>"><?php echo $val['branch_name']; ?></option>
				   <?php 
				  }
				  else
				  {
					continue; 
				  }
				 }
				}
				else
				{ 
			    ?>
				 <option value="">select branch</option>
				<?php foreach($branch as $val)
				 { 
				?>
			    <option value="<?php echo $val['id']; ?>" <?php if($val['id']==$result[0]['branch_id']){ echo 'selected="selected"'; }?>><?php echo $val['branch_name']; ?></option>
				<?php 
				 }
				}                       
				?> 
				</select>
				<input type="hidden" id="editid" name="editid" value="<?php echo $result[0]['id']; ?>">
			  </div>
			  <div class="col-md-6">
                <label>Table Number</label>               
				<input type="text" name="table_number" id="table_number" class="form-control" value="<?php echo $result[0]['table_number'];?>">
			  </div>			  
            </div>	
			
			<div id='loader' style='display: none; position: fixed; z-index: 999; height:50%; width:2em; overflow:show; margin:auto; top: 0; left: 0; bottom: 0; right: 0;'>
              <img src='<?php echo base_url().'assets/img/giphy.gif' ?>' width=auto height=auto>
            </div>
			
		    <div class="col-md-12"><br></div>		   
		    <div class="col-md-12"> 
			  <div class="alert alert-danger alert-dismissible" style="display:none" id="table_error">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                
              </div>		
              <div class="alert alert-success alert-dismissible" style="display:none" id="table_success">
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
				 url :"<?php echo base_url().'admin/saveTable' ?>",
                 data:$('#table_form').serialize(),
                      success: function(data)
		              {       
                         var response = JSON.parse(data);
					     if(response.status=="error")
					     {
					        $('#table_error').html(response.errors);
					        $('#table_error').show();
					        $('#table_error').delay(2000).fadeOut();
							//$("#loader").hide();
					     }
					     else
					     {					   
					        $('#table_success').html(response.status);
					        $('#table_success').show();
					        $('#table_success').delay(2000).fadeOut();
					        $('#table_form')[0].reset();
							setTimeout(function(){window.location.href = window.location.pathname;}, 2000);
							//$("#loader").hide();
					     }					
                      }
              });		
	 }	 
   </script>
	
	