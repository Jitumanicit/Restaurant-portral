    <section class="content-header">
      <h1>
	    Dashboard<small>Control panel</small>	   
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
   </section>
    
   <section class="content">
	 <div class="row">	 
        <div class="col-lg-3 col-xs-6">         
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3><?php echo $branch[0]['unique_total']; ?></h3>              
              <p>Branch</p>			 		  
            </div>
            <div class="icon">
              <i class="fa fa-university"></i>
            </div>            
             <a href="<?php echo base_url().'admin/viewbranch' ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
        </div>
		
		<div class="col-lg-3 col-xs-6">          
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $manager[0]['unique_total']; ?></h3>
              <p>Manager</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url().'admin/viewmanager' ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>		
		
		<div class="col-lg-3 col-xs-6">          
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $waiter[0]['unique_total']; ?></h3>
              <p>Waiter</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url().'admin/viewwaiter' ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		<div class="col-lg-3 col-xs-6">          
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $chef[0]['unique_total']; ?></h3>
              <p>Chef</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url().'admin/viewchef' ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		<div class="col-lg-3 col-xs-6">          
         <div class="small-box bg-purple">
           <div class="inner">
             <h3><?php echo $payment[0]['unique_total']; ?></h3>
             <p>Payment</p>
           </div>
           <div class="icon">
              <i class="fa fa-inr"></i>
           </div>
           <a href="<?php echo base_url().'admin/viewpayment' ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
         </div>
        </div>
		
		<div class="col-lg-3 col-xs-6">          
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $chef[0]['unique_total']; ?></h3>
              <p>Menu</p>
            </div>
            <div class="icon">
              <i class="fa fa-bars"></i>
            </div>
            <a href="<?php echo base_url().'admin/viewmenu' ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		
		
      </div> 	 
	  <div class="row">	   
	   <div id="charts"></div>	     
      </div>
    </section>