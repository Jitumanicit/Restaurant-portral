   <section class="content-header">
      <h1>View Coupons</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <!---<li><a href="#">Tables</a></li>--->
        <li class="active">View Coupons</li>
      </ol>	  
    </section>	
    <section class="content">	
     <div class="row">
      <div class="col-xs-12">		
       <div class="box">
        <div class="box-header"></div>			
         <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
           <thead>
            <tr>
             <th>SrNo</th>
			       <th>Coupan Code</th>
             <th>Coupan Type</th>
             <th>Amount</th>
             <th>Percentage</th>
             <th>From Date</th>
			       <th>To Date</th>
			       <th>Status</th>
            </tr>
           </thead>
           <tbody>
            <?php if($result!=""){ $i=1; foreach($result as $val){ ?>  
			      <tr>
              <td><?php echo $i; ?></td>
			        <td><?php echo $val['coupan_code'];?></td>
              <td><?php echo $val['discount_type'];?></td>
              <td><?php echo $val['amount'];?>.00</td>
              <td><?php echo $val['percentage'];?>%</td>
              <td><?php echo $val['from_date'];?></td>
			        <td><?php echo $val['to_date'];?></td>
			        <td><?php if(date('Y-m-d')<=$val['from_date'] || $val['to_date']>=date('Y-m-d')){ ?><span class="label label-success"> Live </span> <?php }else{?> <span class="label label-danger"> Expire </span> <?php } ?></td>			  
			      </tr> 
			      <?php $i++;}} ?>    
           </tbody> 
         </table>
        </div>           
       </div>
	    </div> 
	   </div>  
    </section>