    <section class="content-header">
      <h1>
        Add Order        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <!--<li><a href="<?php echo base_url().'admin/viewbranch' ?>">View Order</a></li>-->
        <li class="active">Add Order</li>
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
		  <form id="order_form" method="post">
           <div class="col-md-12"> 
			<div class="form-group">
			   <div class="col-md-6">
                <label>Table Number</label>               
				<select name="table_id" id="table_id" class="form-control">
				  <option value="">select</option>
				  <?php foreach($table as $val){ ?>
				  <option value="<?php echo $val['id']; ?>"><?php echo $val['table_number']; ?></option>
				  <?php } ?>
				</select>
			   </div>
			   <div class="col-md-6"> 
			    <label>Customer Name</label>               
				<input type="text" name="customer_name" id="customer_name" class="form-control">
			   </div> 
             </div>
			
			 <div class="form-group">
			  <div class="col-md-6">
                <label>Customer Mobile</label>               
				<input type="text" name="customer_mobile" id="customer_mobile" class="form-control">
			  </div>
			  <div class="col-md-6">
			    <label>Customer Email</label>               
				<input type="text" name="customer_email" id="customer_email" class="form-control">
			  </div> 
             </div>	
			 
			 <div class="form-group"> 
			   <div class="col-md-12"></div>
			 </div>
			 
			 <div class="form-group"> 
			  <div class="col-md-6">
			   <a class="btn btn-social-icon btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus "></i></a> 	 
              </div>
			 </div>
			 
			 <div id='loader' style='display: none; position: fixed; z-index: 999; height: 50%; width: 2em; overflow: show; margin: auto; top: 0; left: 0; bottom: 0; right: 0;'>
               <img src='<?php echo base_url().'assets/img/giphy.gif' ?>' width=auto height=auto>
             </div>	
			 
			 <div class="col-md-12"><br></div>		   
		     
			 <div class="col-md-12"> 
			   <div class="alert alert-danger alert-dismissible" style="display:none" id="branch_error">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                
               </div>		
               <div class="alert alert-success alert-dismissible" style="display:none" id="branch_success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                
               </div>	 
		     </div>			 
		     <div class="col-md-12"><br></div>			
            </div>			
		   </form> 
		   </div>
		   
		   <div class="col-md-12"> 
		    <div class="panel panel-primary">
             <div class="panel-heading">Temporary Order</div>
		      <div class="panel-body">			 
		       <div class="table-responsive">
			    <table class="table">
		         <thead>
		          <tr> 
		           <th>Category Name</th>
		           <th>Menu Name</th>
		           <th>Qty</th>
		           <th>Suggestion</th>
				   <th>Action</th>
		          </tr>
		         </thead>
		         <tbody id="tepmenu_id"></tbody>
	            </table>
               </div>
		      </div>
		     </div>
		   </div>
		  <div class="col-md-12" align="center">		    
		    <input type="submit" name="submit" value="Order Confirm" class="btn btn-primary btn-sm" onclick="saveform()"> 
		  </div>
		  
		  <div class="col-md-12"><br></div>	
		  
		  <div class="col-md-12"> 
		   <div class="panel panel-primary">
            <div class="panel-heading">Chef Order</div>
		     <div class="panel-body">
			  <div class="table-responsive">
		       <table class="table">
		         <thead>
		          <tr> 
		           <th>T No</th>
				   <th>Category Name</th>
		           <th>Menu Name</th>
		           <th>Qty</th>
		           <th>Suggestion</th>
				   <th>Action</th>
		          </tr>
		         </thead>
		         <tbody id="chafmenu_id"></tbody>
	           </table>
			  </div>  
			 </div>
		   </div>
		   <?php if('waiter'==$roles){ ?>
		    <div class="col-md-12"> 
		      <p align="center"><a class="btn btn-success" onclick="billrequest(1)">Bill Request</a></p>
		    </div>
		   <?php } ?>
		  </div>
	    </div> 		 
      </div>		
	</div>
   </section>	
   <script>
    $(document).ready(function() 
	{
	  window.setInterval(function(){ getorder(); gettemporder(); }, 5000);
    }); 
	
	function saveform()
	{
	  //$("#loader").show();		
	  var mobile =$('#customer_mobile').val();	  
	  $.ajax({
               type:'post', 
			   url :"<?php echo base_url().'admin/saveOrder'?>",
               data:$('#order_form').serialize(),
               success: function(data)
		       {        
                 var response = JSON.parse(data);				   
				 if(response.status=="error")
				 {
				   $('#order_error').html(response.errors);
				   $('#order_error').show();
				   $('#order_error').delay(2000).fadeOut();					
				 }
				 else
				 {	
				   $('#order_success').html(response.status);
				   $('#order_success').show();
				   $('#order_success').delay(2000).fadeOut();
				   $('#order_form')[0].reset();
				   $('#customer_mobile').val(mobile);
				   gettemporder();
				   getorder();
				   //$("#loader").hide();
				 }					
               }
            });		
	 }
      
//-------------------------------------------------------------	 
	 
	 function getMenu(val)
	 {	   
	   $.ajax({
                type:'post', 
				url : "<?php echo base_url().'admin/getMenu'?>",
                data:{
					   id          : val,
					   category_id : 'category_id'
				     },
					 success: function(data)
		             {        
                       var response = JSON.parse(data);					
					   var option ='<option value="">select</option>';	
					   for(var i=0;i<response.results.length;i++)
					   {
					     option+='<option value="'+ response.results[i]['id'] +'">'+ response.results[i]['menu_name']+'</option>'   
					   }
					   $('#menu_id').html(option);
                     }
             });
	 }
      
//------------------------------------------------------------
	 
	 function saveMenu()
	 {	    
	   var category_id = $('#category_id').val();		  
	   var menu_id     = $('#menu_id').val();
	   var qty         = $('#qty').val();
	   var suggestion  = $('#suggestion').val();
	   var orderid     = $('#orderid').val();
	   //$("#loader").show();		
	   $.ajax({
                type:'post', 
				url :"<?php echo base_url().'admin/savetemporder'?>",
                data:{
					    category_id : category_id,
						orderid     : orderid,
						menu_id     : menu_id,
						qty         : qty,
						suggestion  : suggestion
				 },
                 success: function(data)
		         {        
                   var response = JSON.parse(data);					
				   if(response.status=="error")
				   {
					 $('#order_error').html(response.errors);
					 $('#order_error').show();
					 $('#order_error').delay(2000).fadeOut();
					 //$("#loader").hide();
				   }
				   else
				   {
					 $('#order_success').html(response.status);
					 $('#order_success').show();
					 $('#order_success').delay(2000).fadeOut();
					 $('#category_id').val('');
					 $('#menu_id').val('');
					 $('#qty').val('');
					 $('#suggestion').val('');					  
					 $('#orderid').val(response.id);					  
					 gettemporder();					  					  
				   }					
                 }
              });		
	 }	 
	 
	 function gettemporder()
	 {		
	   $.ajax({
                type:'post', 
				url : "<?php echo base_url().'admin/getOrder'?>",
                data:{ id:'id' },
				success: function(data)
		        {        
                  var response = JSON.parse(data);					
				  var option ='';	
				  for(var i=0;i<response.results.length;i++)
				  {
				    option+='<tr><td>'+ response.results[i]['category_name'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td><td>'+ response.results[i]['suggestion'] +'</td><td><a onclick=RemoveMenu('+ response.results[i]['id'] +')><i class="fa fa-trash" aria-hidden="true" style="font-size:24px;color:red"></i></a></td></tr>'
				  }
				  $('#tepmenu_id').html(option);
                }
             });		 
	 }
     
     function getorder()
	 {
	  $.ajax({
               type:'post', 
			   url : "<?php echo base_url().'admin/getmainOrder'?>",
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
					 action ='<a class="label label-primary">Order</a>';  
				   }
				   else if('2' == response.results[i]['order_status'])
				   {
					 action ='<a class="label label-success">Proceed</a>';  
				   }
				   else if('3' == response.results[i]['order_status'])
				   {
					 action ='<a class="label label-warning">Hold</a>';     
				   }
				   else if('4' == response.results[i]['order_status'])
				   {
					 action ='<a class="label label-warning">Reject</a>';  
				   }
				   else if('5' == response.results[i]['order_status'])
				   {
					 action ='<a class="label label-warning">Complete</a>';  
				   }
				   else
				   {
					 action ='';  
				   }				   
				   option+='<tr><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['category_name'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td><td>'+ response.results[i]['suggestion'] +'</td><td>'+ action +'</td></tr>'
				 }
				 $('#table_id').val(response.results[0]['table_id']);
				 $('#customer_mobile').val(response.results[0]['customer_mobile']);
				 $('#chafmenu_id').html(option);
               }
            });		 
	 }	
      
     function RemoveMenu(val)
     { 
	   $.ajax({
                type:'post', 
				url : "<?php echo base_url().'admin/RemoveTempOrder'?>",
                data:{ id : val },
				success: function(data)
		        {        
                  var response = JSON.parse(data);
				  if('success' == response.status)
				  {					 
					gettemporder();  
				  }
                }
             });	
	 }
	 
	 function billrequest(val)
	 {
	   var tbid = $('#table_id').val();	   
	   $.ajax({
                type:'post', 
				url :"<?php echo base_url().'admin/billRequestOrder'?>",
                data:{ tbid:tbid , status : val },
				success: function(data)
		        {        
                  var response = JSON.parse(data);
				  if('success' == response.status)
				  {	
                    window.setTimeout(function(){ location.reload(true); }, 1000);
					//getorder();  
				  }
                }
             });
	 }
	 
   </script>   
   <div class="modal fade" id="myModal" role="dialog">
     <div class="modal-dialog modal-xl">
      <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Add Menu</h4>
       </div>
       <div class="modal-body">        
		<div class="col-md-12"> 		   
		 <div class="form-group">
		   <div class="col-md-3">
             <label>Category Name</label>  			
		     <select name="category_id" id="category_id" class="form-control" onchange="getMenu(this.value)">
			   <option value="">select</option>
			   <?php foreach($result as $val){ ?>
			   <option value="<?php echo $val['id']; ?>"><?php echo $val['category_name']; ?></option>	
			   <?php } ?>
			 </select>
			 <input type="hidden" name="orderid" id="orderid">
		   </div>
		   <div class="col-md-3">
			 <label>Menu Name</label>               
             <select name="menu_id" id="menu_id" class="form-control"></select>			 
		   </div> 
		   <div class="col-md-3">
             <label>Qty</label> 
			 <input type="text" name="qty" id="qty" class="form-control">
		   </div>
		   <div class="col-md-3">
			 <label>Suggestion</label>               
			 <select name="suggestion" id="suggestion" class="form-control">
			  <option value="">Food Test</option>
			  <option value="normal">Normal</option>
			  <option value="spicy">Spicy</option>
			 </select>			
		   </div> 
         </div>	
		 <div class="col-md-12"><br></div>
		 <div class="form-group" align="center">
		  <div class="col-md-12">
		    <input type="submit" name="submit" value="submit" class="btn btn-primary" onclick="saveMenu()">
		  </div>
	     </div>
	    </div>	   	   	
        <div class="modal-footer">
		  <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        </div>
      </div>
     </div>
    </div>   