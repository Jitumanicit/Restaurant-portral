    <section class="content-header">
      <h1> View <font color="red;"><?php echo @date('d-m-Y'); ?></font> Order</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View <?php echo @date('d-m-Y'); ?> Order</li>
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
				   <th>Order Id</th>
				   <th>Ordered At</th>
				   <th>Branch Name</th>
                   <th>Table Number</th>
				   <th>Manager Code</th>				   
				   <th>Waiter Code</th>
				   <th>View and Print</th>
				   <th>Action</th>
                 </tr>
                </thead>
                <tbody id="chafmenu_id">
                 
                </tbody> 
              </table>
            </div>           
          </div>         
    </section>
	
	<script>
	$(document).ready(function() 
	{
	    window.setTimeout(function(){ getorder(); },500);
	    window.setInterval(function(){ getorder(); }, 2000);
    }); 
     
//-------------------------------------------------------------
    /*  
    function getorder()
	{
	  $.ajax({
               type:'post', 
			   url : "<?php echo base_url().'admin/getmainchefOrder'?>",
               data:{ id:'id' },
			   success: function(data)
		       {        
                var response = JSON.parse(data);					
			    var option ='';	
			    var action = '';
			    for(var i=0;i<response.results.length;i++)
			    {
				  if('1' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]["id"];
				    action ='<a class="label label-primary">Order</a>'; 
				  }
				  else if('2' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]['id'];
				    action = '<a class="label label-success">Accept</a>';  
				  }
				  else if('3' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]['id'];
				    action = '<a class="label label-warning">Ready</a>';  
				  }
				  else
				  {
				    action = '<a class="label label-info">Complete</a>';  
				  }				 
				  option+='<tr><td>'+ (i+1) +'</td><td>'+ response.results[i]['branch_name'] +'</td><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['manager_code'] +'</td><td>'+ response.results[i]['waiter_code'] +'</td><td>'+ response.results[i]['chef_code'] +'</td><td>'+ response.results[i]['category_name'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td><td>'+ response.results[i]['suggestion'] +'</td><td>'+ action +'</td></tr>'
			    }
			    $('#chafmenu_id').html(option);
               }
           });		 
	}	
     */
	function getorder()
	{
	 $.ajax({
              type:'post', 
			  url : "<?php echo base_url().'admin/getTodayOrders'?>",
              data:{ id:'id' },
			  success: function(data)
		      {        
                var response = JSON.parse(data);					
			    var option ='';	
			    var action = '';
			    for(var i=0;i<response.results.length;i++)
			    {				   
				   //option+='<tr><td>'+ (i+1) +'</td><td>'+ response.results[i]['branch_name'] +'</td><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['manager_code'] +'</td><td>'+ response.results[i]['waiter_code'] +'</td><td>'+ response.results[i]['chef_code'] +'</td><td>'+ response.results[i]['category_name'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td><td>'+ response.results[i]['suggestion'] +'</td><td>'+ action +'</td></tr>'
			       option+='<tr><td>'+ (i+1) +'</td><td>'+ response.results[i]['orderid'] +'</td><td>'+ response.results[i]['created_at'] +'</td><td>'+ response.results[i]['branch_name'] +'</td><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['manager_code'] +'</td><td>'+ response.results[i]['waiter_code'] +'</td><td><a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal1"  onclick="getorders('+ response.results[i]['orderid'] +')">View Details</a></td><td><a data-toggle="modal" data-target="#myModal" onclick="vieworders('+ response.results[i]['orderid'] +')"><span class="badge badge-pill badge-primary" style="cursor: pointer; background-color:red;">VIEW</span></a> <a data-toggle="modal" data-target="#myModals" onclick="printBills('+ response.results[i]['orderid'] +')"><span class="badge badge-pill badge-primary" style="cursor: pointer;background-color:green;">PRINT</span></a></td></tr>'
			    }
			    $('#chafmenu_id').html(option);
              }
           });		 
	 }	
	 function getorders(val)
	{	  
	  $.ajax({
              type:'post', 
			  //url : "<?php echo base_url().'admin/getmainchefOrder'?>",
              url : "<?php echo base_url().'admin/orders'?>",			  
			  data:{ order_id:val , id:'id' },
			  success: function(data)
		      {        
                var response = JSON.parse(data);
				var option = '';  var action = '';  var actions = '';  var myStart = '';   var myEnd  = '';  var diff  = '';				
				var dt = new Date();
                var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
			    for(var i=0;i<response.results.length;i++)
			    {
				  myStart = response.results[i]['starttime'];                  
				  myEnd   = time; 				  
				  diff    = getTimeDiff(myStart, myEnd);
				  option+='<tr><td>'+ response.results[i]['orderid'] +'</td><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td><td>'+ parseInt(response.results[i]['menu_time']*response.results[i]['qty']) +' Min</td><td><a data-toggle="modal" data-target="#myIndividualModals" onclick="printIndividualBills('+ response.results[i]['id'] +')"><span class="badge badge-pill badge-primary" style="cursor: pointer;background-color:Blue;">PRINT</span></a></td></tr>'
			    }
			    $('#chafemenu_id').html(option);
			    actions ='<a class="label label-primary" onclick="actions(2,'+ response.results[0]['orderid'] +')">Proceed</a> | <a class="label label-success" onclick="actions(5,'+ response.results[0]['orderid'] +')">Complete</a>';
			    $('#actionsbtn').html(actions);
              }
           });		 
	}
	 function vieworders(vals)
	 {	   
      $.ajax({
               type:'post', 
			   url : "<?php echo base_url().'admin/getOrderMenu'?>",
               data:{ id : vals },
			   success: function(data)
		       {        
                var response = JSON.parse(data);					
			    var option  = '';	
			    var action  = '';
				var myStart = '';
				var myEnd   = '';
				var diff    = '';
				var diffs   = '';
			    for(var i=0;i<response.results.length;i++)
			    {
				  if('1' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]["id"];					   
				    action ='<a class="label label-primary">Order</a>'; 
				  }
				  else if('2' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]['id'];
				    action = '<a class="label label-info">Proceed</a>';  
				  } 
				  else if('3' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]['id'];
				    action ='<a class="label label-warning">Hold</a>'; 
				  }
				  else if('4' == response.results[i]['order_status'])
				  {				  
				    action = '<a class="label label-danger">Reject</a>'; 
				  }
				  else if('5' == response.results[i]['order_status'])
				  {				  
				    action = '<a class="label label-success">Complete</a>';  
				  }
				  else
				  {
				    action = '';  
				  }
				  myStart = response.results[i]['starttime'];
                  myEnd = response.results[i]['endtime']; 				  
				  diff = getTimeDiff(myStart, myEnd);
				  
				 //if(diff!='')
				 //{
					 diffs = diff.hours() +':'+ diff.minutes(); 
				 //}
				 // else
				 // {
				 //diffs = "00:00";  
				 //}
				  option+='<tr><td>'+ (i+1) +'</td><td>'+ response.results[i]['manager_code'] +'</td><td>'+ response.results[i]['waiter_code'] +'</td><td>'+ response.results[i]['category_name'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td></tr>'
			    }
			    $('#order_menu_id').html(option);
               }
            });
	 }
	 
	 function getTimeDiff(start, end) 
	 {
       return moment.duration(moment(end, "HH:mm:ss a").diff(moment(start, "HH:mm:ss a")));
     }

     function printBills(vals)
	 {	   
      $.ajax({
               type:'post', 
			   url : "<?php echo base_url().'admin/getOrderMenu'?>",
               data:{ id : vals },
			   success: function(data)
		       {        
                var response = JSON.parse(data);					
			    var option  = '';	
			    var action  = '';
				var myStart = '';
				var myEnd   = '';
				var diff    = '';
				var diffs   = '';
			    for(var i=0;i<response.results.length;i++)
			    {
				  if('1' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]["id"];					   
				    action ='<a class="label label-primary">Order</a>'; 
				  }
				  else if('2' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]['id'];
				    action = '<a class="label label-info">Proceed</a>';  
				  } 
				  else if('3' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]['id'];
				    action ='<a class="label label-warning">Hold</a>'; 
				  }
				  else if('4' == response.results[i]['order_status'])
				  {				  
				    action = '<a class="label label-danger">Reject</a>'; 
				  }
				  else if('5' == response.results[i]['order_status'])
				  {				  
				    action = '<a class="label label-success">Complete</a>';  
				  }
				  else
				  {
				    action = '';  
				  }
				  myStart = response.results[i]['starttime'];
                  myEnd = response.results[i]['endtime'];				  
				  diff = getTimeDiff(myStart, myEnd);
				  
				 //if(diff!='')
				 //{
					 diffs = diff.hours() +':'+ diff.minutes(); 
				 //}
				 // else
				 // {
				 //diffs = "00:00";  
				 //}
				  option+='<tr><td>'+ (i+1) +'</td><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td><td>'+ response.results[i]['suggestion'] +'</td></tr>'
			    }
			    $('#order_chef_id').html(option);
               }
            });
	 }
	 
	 function printIndividualBills(vals)
	 {	   
      $.ajax({
               type:'post', 
			   url : "<?php echo base_url().'admin/getIndividualOrderMenu'?>",
               data:{ id : vals },
			   success: function(data)
		       {        
                var response = JSON.parse(data);					
			    var option  = '';	
			    var action  = '';
				var myStart = '';
				var myEnd   = '';
				var diff    = '';
				var diffs   = '';
			    for(var i=0;i<response.results.length;i++)
			    {
				  if('1' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]["id"];					   
				    action ='<a class="label label-primary">Order</a>'; 
				  }
				  else if('2' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]['id'];
				    action = '<a class="label label-info">Proceed</a>';  
				  } 
				  else if('3' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]['id'];
				    action ='<a class="label label-warning">Hold</a>'; 
				  }
				  else if('4' == response.results[i]['order_status'])
				  {				  
				    action = '<a class="label label-danger">Reject</a>'; 
				  }
				  else if('5' == response.results[i]['order_status'])
				  {				  
				    action = '<a class="label label-success">Complete</a>';  
				  }
				  else
				  {
				    action = '';  
				  }
				  myStart = response.results[i]['starttime'];
                  myEnd = response.results[i]['endtime'];				  
				  diff = getTimeDiff(myStart, myEnd);
				  
				 //if(diff!='')
				 //{
					 diffs = diff.hours() +':'+ diff.minutes(); 
				 //}
				 // else
				 // {
				 //diffs = "00:00";  
				 //}
				  option+='<tr><td>'+ (i+1) +'</td><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td></tr>'
			    }
			    $('#order_print_chef_id').html(option);
               }
            });
	 }

	 function getTimeDiff(start, end) 
	 {
       return moment.duration(moment(end, "HH:mm:ss a").diff(moment(start, "HH:mm:ss a")));
     }
     function printbill()
	  {
	     window.print();
	  }
	  function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
	</script>

    <div class="modal fade" id="myModal" role="dialog">
     <div class="modal-dialog modal-lg">
      <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">View Order</h4>
       </div>
       <div class="modal-body table-responsive">
        <table class="table">
		 <thead>
		   <th>SRNO</th>
		   <!--<th>Ord Id</th>
		   <th>Branch Name</th>
           <th>Table No</th>-->
		   <th>Manager Code</th>				   
		   <th>Waiter Code</th>				   
		   <th>Category</th>
		   <th>Menu</th>	
		   <th>Qty</th>
		 </thead>
		 <tbody id="order_menu_id"></tbody>
		</table>
	   </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
      </div>
     </div>
    </div> 
    <div class="modal fade" id="myModals" role="dialog">
	     <div class="modal-dialog modal-sm">
	      <div class="modal-content">       
		   <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title text-center">POS</h4>
	       </div>       
		   <div class="modal-body table-responsive">
		   		<div id="invoice-POS" style="width: 70mm;">
		   			<h6 class="modal-title text-center">POS</h6>
			       	<table class="table">
						<thead>
						  <th>SRNO</th>
						  <th>Table</th>				  			   
						  <th>Menu</th>	
						  <th>Qty</th>
						</thead>
					 	<tbody id="order_chef_id"></tbody>	
					</table>
					<div id="legalcopy">
				    	<p class="legal text-right"><strong>Thank you!</strong></p>
				   	</div> 
				</div>  
			   <div align="center">
				   <a class="btn btn-primary" onclick="printDiv('invoice-POS')">Print</a>
			   </div>  
	       </div> 
	      </div> 
	     </div> 
    </div>
    <div class="modal fade" id="myModal1" role="dialog">
      <div class="modal-dialog modal-lg">
       <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">View Individual Order Record</h4>
        </div>
        <div class="modal-body table-responsive">
         <table class="table"> 
		  <thead>
            <tr>
              <th>Order No</th>
              <th>T No</th>			
			  <th>Menu Name</th>
			  <th>Qty</th>
			  <th>Prep Time</th>
			  <th>Status</th>
            </tr>
          </thead>
          <tbody id="chafemenu_id"> </tbody> 
		 </table>
	    </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
       </div>
      </div>
     </div>
     <div class="modal fade" id="myIndividualModals" role="dialog">
     <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <div id="DivIdToPrint">       
	   <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Print Bill</h4>
       </div>       
	   <div class="modal-body table-responsive">
	   	<div id="invoice-POS1" style="width: 70mm;">
	   	<h6 class="modal-title text-center">POS</h6>
	       <table class="table">
				 <thead>
				   <th>SRNO</th>
				   <th>Table</th>				  			   
				   <th>Menu</th>	
				   <th>Qty</th>
				 </thead>
			 	 <tbody id="order_print_chef_id"></tbody>	
			</table>  
			<div id="legalcopy">
		    	<p class="legal text-right"><strong>Thank you!</strong></p>
		   </div>
		</div> 
		   <div align="center">
			   <a class="btn btn-primary" onclick="printDiv('invoice-POS1')">Print</a>
		   </div>  
       </div> 
      </div> 
 	 </div>
     </div> 
    </div>