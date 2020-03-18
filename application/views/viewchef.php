   <section class="content-header">
      <h1> View Chef</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <!---<li><a href="#">Tables</a></li>--->
        <li class="active">View Chef</li>
      </ol>	  
    </section>	
    <section class="content">	
      <div class="row">
        <div class="col-xs-12">		
          <div class="box">
            <div class="box-header">
             <!-- <h3 class="box-title"> Data Table With Full Features </h3> -->	
            </div>			
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                 <tr>
                   <th>SRNO</th>
				   <th>Branch Id</th>
				   <th>Manager Code</th>
				   <th>Chef Code</th>
                   <th>Chef Name</th>
				   <th>Chef City</th>	
				   <th>Chef Pincode</th>
				   <th>Chef Email</th>
				   <th>Chef Mobile</th>
				   <?php if('manager'==$roles){ ?> 
				   <th>Action</th>
				   <?php } ?>
                 </tr>
                </thead>
                <tbody>
                 <?php if($result!=""){ $i=1; foreach($result as $val){ ?>  
				  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $val['branch_id'];?></td>
					<td><?php echo $val['manager_code'];?></td>
					<td><?php echo $val['chef_code'];?></td>
                    <td><?php echo $val['chef_name'];?></td>
					<td><?php echo $val['chef_city'];?></td>
					<td><?php echo $val['chef_pincode'];?></td>
					<td><?php echo $val['chef_email'];?></td>
				    <td><?php echo $val['chef_mobile'];?></td>
				   <?php if('manager'==$roles){ ?> 
					<td>
                     <a class="btn btn-social-icon btn-success" href="<?php echo base_url().'admin/editchef/'.$val['id']; ?>"><i class="fa fa-pencil"></i></a>
                     <a class="btn btn-social-icon btn-danger" onclick="deleteRecord(<?php echo $val['id']; ?>)"><i class="fa fa-trash-o"></i></a>				  
					 <a class="btn btn-social-icon btn-primary" onclick="viewpassword('<?php echo $val['username']; ?>','<?php echo $val['password']; ?>')" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i></a>
					</td>
				   <?php } ?>
                  </tr> 
				 <?php $i++;}} ?>    
                </tbody> 
              </table>
            </div>           
          </div>         
        <!--</div>
      </div>---> 
    </section>
	
	<script>
	 function deleteRecord(val)
	 {		
		if(confirm("Are you sure?"))
		{
		  var id = val;		
		  $.ajax({
                   type: 'POST', 
				   url: "<?php echo base_url().'admin/deletechef'?>",
                   data: { id : id },
                   success: function(data)
		           {
					 var url="<?php echo base_url().'admin/viewchef'?>";
					 window.location.href = url;
                   }
                });
		}
		return false; 		
	 }	

	 function viewpassword(user,pass)
	 {
		$("#username").html(user);
		$("#password").html(pass);
	 }	
	</script>	
	
	<div class="modal fade" id="myModal" role="dialog">
     <div class="modal-dialog modal-sm">
      <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Login Details</h4>
       </div>
       <div class="modal-body">
        <table class="table">
		  <tr> 
		   <td>User Name</td>
		   <td><span id="username"></span></td>	   
		  </tr>
		  <tr>
		   <td>Password</td>
		   <td><span id="password"></span></td>
		  </tr>
		</table>
	   </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
      </div>
     </div>
    </div>