    <section class="content-header">
      <h1> View Customer</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <!---<li><a href="#">Tables</a></li>--->
        <li class="active">View Customer</li>
      </ol>	  
    </section>	
    <section class="content">	
     <div class="row">
      <div class="col-xs-12">		
        <div class="box">
         <div class="box-header">
          <!--<h3 class="box-title">Data Table With Full Features</h3>-->	
         </div>			
         <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
           <thead>
            <tr>
             <th>SRNO</th>				   
			 <th>Branch Name</th>
             <th>Customer Name</th>
			 <th>Customer Mobile</th>	
			 <th>Customer Email</th>				   
			 <th>Action</th>
            </tr>
           </thead>
           <tbody>
             <?php if($result!=""){ $i=1; foreach($result as $val){ ?>  
			 <tr>
               <td><?php echo $i; ?></td>                    
			   <td><?php echo $val['branch_name'];?></td>
			   <td><?php echo $val['customer_name'];?></td>
               <td><?php echo $val['customer_mobile'];?></td>
			   <td><?php echo $val['customer_email'];?></td>										
			   <td>                     
                 <a class="btn btn-social-icon btn-danger" onclick="deleteRecord(<?php echo $val['id']; ?>)"><i class="fa fa-trash-o"></i></a>				  
			   </td>
             </tr> 
			<?php $i++;}} ?>    
           </tbody> 
          </table>
        </div>           
      </div> 
    </section>
	
	<script>
	 function deleteRecord(val)
	 {		
	   if(confirm("Are you sure?"))
	   {
		 var id = val;		
		 $.ajax({
                  type: 'POST', 
				  url: "<?php echo base_url().'admin/deletecustomer'?>",
                  data:{ id : id },
                  success: function(data)
		          {
					var url="<?php echo base_url().'admin/viewcustomer'?>";
					window.location.href = url;
                  }
               });
		}
		return false; 		
	 }	  
	</script>	