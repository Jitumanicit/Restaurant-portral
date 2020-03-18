    <section class="content-header">
      <h1> View Chef Order</h1>
      <ol class="breadcrumb">
       <li><a href="<?php echo base_url().'admin/viewcheforder' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <li class="active">View Chef Order</li>
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
               <th>Created At</th>
			   <th>Order No</th>
               <th>Table No</th>
			   <th>Order View</th>
			   <th>Status</th>
             </tr>
            </thead>
            <tbody id="chafmenu_order"></tbody> 
          </table>
         </div>           
       </div> 
	  </div>
	 </div>	
    </section>	
	
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
		    <tr><th colspan="6"></th><th><span id="actionsbtn"></span></th></tr>
		  </thead> 
		  <thead>
            <tr>
              <th>Order No</th>
              <th>T No</th> 			
			  <th>Menu Name</th>	
			  <th>Qty</th>
			  <th>Note</th>
			  <th>Time Left</th>
			  <th>Prep Time</th>
			  <th>Status</th>
            </tr>
          </thead>
          <tbody id="chafmenu_id"> </tbody> 
		 </table>
	    </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
       </div>
      </div>
     </div> 
    
	<script>
	 $(document).ready(function() 
	 {	   
	   window.setInterval(function(){ getorder(); }, 2000);
	   window.setInterval(function(){ getmainorder(); }, 2000);
	   
     }); 
      
//-------------------------------------------------------------
     
	function getmainorder()
	{
	  $.ajax({
              type:'post', 
			  url : "<?php echo base_url().'admin/getmainchefOrders'?>",
              data:{ id:'id' },
			  success: function(data)
		      {        
                var response = JSON.parse(data);					
			    var option = '';	
			    var view   = '';
				var action = '';				
				for(var i=0;i<response.results.length;i++)
			    {
				  option+='<tr><td>'+ response.results[i]['created_at'] +'</td><td>'+ response.results[i]['orderid'] +'</td><td>'+ response.results[i]['table_number'] +'</td><td><a class="btn btn-social-icon btn-primary" data-toggle="modal" data-target="#myModal"  onclick="getorder('+ response.results[i]['orderid'] +')"><i class="fa fa-eye"></i></a></td><td><a class="btn btn-primary" onclick="actions(2,'+ response.results[i]['orderid'] +')">Proceed</a></td></tr>'
			    }
			    $('#chafmenu_order').html(option); 
			 }  
           });	 
	}
		 
    function getorder(val)
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
				  if('1' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]["id"];					   
				    action ='<a class="label label-primary" onclick="action(2,'+ id +','+ response.results[i]['orderid'] +')">Proceed</a> | <a class="label label-warning" onclick="action(3,'+ id +','+ response.results[i]['orderid'] +')">Hold</a> | <a class="label label-danger" onclick="action(4,'+ id +','+ response.results[i]['orderid'] +')">Reject</a>'; 
				  }
				  else if('2' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]['id'];
				    action = '<a class="text-secondary">Proceed</a> | <a class="label label-success" onclick="action(5,'+ id +','+ response.results[i]['orderid'] +')">Complete</a>';  
				  } 
				  else if('3' == response.results[i]['order_status'])
				  {
				    var id = response.results[i]['id'];
				    action ='<a class="label label-primary" onclick="action(2,'+ id +','+ response.results[i]['orderid'] +')">Proceed</a> | <a class="text-dark">Hold</a> | <a class="label label-danger" onclick="action(4,'+ id +','+ response.results[i]['orderid'] +')">Reject</a>'; 
				  }
				  else if('4' == response.results[i]['order_status'])
				  {				 
				    action = '<a class="label label-danger">Reject</a>'; 
				  }
				  else if('5' == response.results[i]['order_status'])
				  {				  
				    action = '<a class="label label-primary">Complete</a>';  
				  }
				  else
				  {
				    action = '';  
				  }
				  myStart = response.results[i]['starttime'];                  
				  myEnd   = time; 				  
				  diff    = getTimeDiff(myStart, myEnd);
                  <!--<td>'+ response.results[i]['category_name'] +'</td>-->
				  option+='<tr><td>'+ response.results[i]['orderid'] +'</td><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td><td>'+ response.results[i]['suggestion'] +'</td><td>'+ diff.hours() +':'+ diff.minutes() +' Min</td><td>'+ parseInt(response.results[i]['menu_time']*response.results[i]['qty']) +' Min</td><td>'+ action +'</td></tr>'
			    }
			    $('#chafmenu_id').html(option);
			    actions ='<a class="label label-primary" onclick="actions(2,'+ response.results[0]['orderid'] +')">Proceed</a> | <a class="label label-success" onclick="actions(5,'+ response.results[0]['orderid'] +')">Complete</a>';
			    $('#actionsbtn').html(actions);
              }
           });		 
	}
		 	 
	function action(val,id,ordid)
	{		
	  if(confirm("Are you sure?"))
	  {
		var status = val;
		var id     = id;
		$('#myModal').hide();
		$.ajax({
                 type:'post', 
				 url :"<?php echo base_url().'admin/orderstatus'?>",
                 data:{ status:status , id : id },
                 success: function(data)
		         {
				    getorder(ordid);	
					$('#myModal').show();
                 }
              });
	  }
	  return false;  
	}
     
	function actions(val,id)
	{		
	  if(confirm("Are you sure?"))
	  {
		var status = val;
		var id     = id;		
		$.ajax({
                 type:'post', 
				 url :"<?php echo base_url().'admin/orderallstatus'?>",
                 data:{ status:status , id : id },
                 success: function(data)
		         {
				    getorder(id);					
                 }
               });
	  }
	  return false;  
	} 
		 
	function getTimeDiff(start, end) {
       return moment.duration(moment(end, "HH:mm:ss a").diff(moment(start, "HH:mm:ss a")));
    }    
 </script>	