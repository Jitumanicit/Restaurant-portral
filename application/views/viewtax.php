   <section class="content-header">
      <h1>View Tax</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <!---<li><a href="#">Tables</a></li>--->
        <li class="active">View Tax</li>
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
				   <th>Service Type</th>
                   <th>Tax Name</th>
				   <th>Tax Percentage</th>				   
				   <th>Action</th>
                 </tr>
                </thead>
                <tbody>
                 <?php if($result!=""){ $i=1; foreach($result as $val){ ?>  
				  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php if('1'==$val['menu_type']){ echo 'Food'; }else{ echo 'Alcohol'; }?></td>
                    <td><?php echo $val['tax_name'];?></td>
					<td><?php echo $val['tax_percentage'];?></td>								
					<td>
                      <a class="btn btn-social-icon btn-success" href="<?php echo base_url().'admin/edittax/'.$val['id']; ?>"><i class="fa fa-pencil"></i></a>
                      <a class="btn btn-social-icon btn-danger" onclick="deleteRecord(<?php echo $val['id']; ?>)"><i class="fa fa-trash-o"></i></a>				  
					</td>
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
				   url: "<?php echo base_url().'admin/deletetax'?>",
                   data: { id : id },
                   success: function(data)
		           {
					 var url="<?php echo base_url().'admin/viewtax'?>";
					 window.location.href = url;
                   }
                });
		}
		return false; 		
	 }	  
	</script>	