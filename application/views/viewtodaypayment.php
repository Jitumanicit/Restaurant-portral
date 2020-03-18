   <section class="content-header">
      <h1> View <font color="red"><?php echo @date('d-m-Y'); ?></font> Payment</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <!---<li><a href="#">Tables</a></li>--->
        <li class="active">View Payment</li>
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
        				   <th>Order No</th>
        				   <th>Table No</th>
        				   <th>Manager Code</th>
        				   <th>Waiter Code</th>                  
        				   <th>Payment Mode</th>				   
        				   <th>Discount</th>
        				   <th>Total</th>
        				   <th>Payment Amount</th>
        				   <th>Paid At</th>				  
                 </tr>
                </thead>
                <tbody>
                 <?php if($result!=""){ $i=1; foreach($result as $val){ ?>  
				  <tr>
                    <td><?php echo $i; ?></td> 
					<td><?php echo $val['order_id'];?></td>
					<td><?php echo $val['table_number'];?></td>
					<td><?php echo $val['manager_code'];?></td>
					<td><?php echo $val['waiter_code'];?></td>                    
					<td><?php echo $val['payment_mode'];?></td>
					<td><?php echo $val['discount'];?></td>					
					<td><?php echo $val['total'];?></td>					
					<td><?php echo $val['payment_amount'];?></td>					
					<td><?php echo $val['created_at'];?></td>				
                  </tr> 
				 <?php $i++;}} ?>    
                </tbody> 
              </table>
            </div> 
		  </div> 
	    </div>  
      </div> 
    </section>	