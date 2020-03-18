    <section class="content-header">
      <h1> View All Order</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View All Order</li>
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
				   <!--<th>Chef Code</th>				   
				   <th>Category Name</th>
				   <th>Menu Name</th>	
				   <th>Qty</th>
				   <th>Suggestion</th>-->
				   <th>Action</th>
                 </tr>
                </thead>
                <tbody id="chafmenu_id">
                 
                </tbody> 
              </table>
            </div>           
          </div>         
        <!--</div>
      </div>---> 
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
			  url : "<?php echo base_url().'admin/getOrders'?>",
              data:{ id:'id' },
			  success: function(data)
		      {        
                var response = JSON.parse(data);					
			    var option ='';	
			    var action = '';
			    for(var i=0;i<response.results.length;i++)
			    {				   
				   //option+='<tr><td>'+ (i+1) +'</td><td>'+ response.results[i]['branch_name'] +'</td><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['manager_code'] +'</td><td>'+ response.results[i]['waiter_code'] +'</td><td>'+ response.results[i]['chef_code'] +'</td><td>'+ response.results[i]['category_name'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td><td>'+ response.results[i]['suggestion'] +'</td><td>'+ action +'</td></tr>'
			       option+='<tr><td>'+ (i+1) +'</td><td>'+ response.results[i]['orderid'] +'</td><td>'+ response.results[i]['created_at'] +'</td><td>'+ response.results[i]['branch_name'] +'</td><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['manager_code'] +'</td><td>'+ response.results[i]['waiter_code'] +'</td><td><a data-toggle="modal" data-target="#myModal" onclick="vieworders('+ response.results[i]['orderid'] +')"><i class="fa fa-eye"></i></a></td></tr>'
			    }
			    $('#chafmenu_id').html(option);
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
				  
				  <!--<td>'+ response.results[i]['branch_name'] +'</td><td>'+ response.results[i]['orderid'] +'</td><td>'+ response.results[i]['table_number'] +'</td>-->
				  option+='<tr><td>'+ (i+1) +'</td><td>'+ response.results[i]['manager_code'] +'</td><td>'+ response.results[i]['waiter_code'] +'</td><td>'+ response.results[i]['category_name'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td><td>'+ response.results[i]['suggestion'] +'</td></tr>'
			    }
			    $('#order_menu_id').html(option);
               }
            });
	 }
	 
	 function getTimeDiff(start, end) 
	 {
       return moment.duration(moment(end, "HH:mm:ss a").diff(moment(start, "HH:mm:ss a")));
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
		   <th>Note</th>
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