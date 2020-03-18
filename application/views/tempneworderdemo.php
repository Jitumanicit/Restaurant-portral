    <section class="content-header">
      <h1>
        Place Your Order        
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <!--<li><a href="<?php echo base_url().'admin/viewbranch' ?>">View Order</a></li>-->
        <li class="active">Place Your Order</li>
      </ol>
    </section>	
	
	<!-- Main content -->
    <section class="content" style="padding-left: 5px; padding-right: 5px;">      
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
           <div class="col-md-12">			 
			<div class="tab-content clearfix">			  
			  <div class="tab-pane active" id="1a">
			   <form id="order_form" method="post">
				<div class="form-group">
			     <div class="col-md-6">
                  <label>Table Number</label>               
				  <select name="table_id" id="table_id" class="form-control">
				    
				  </select>
			     </div>			  
			     <div class="col-md-6"> 
			      <label>Customer Name</label>               
				  <input type="text" name="customer_name" id="customer_name" class="form-control" style='text-transform:capitalize'>
			      <input type="hidden" name="customer_id" id="customer_id">
			     </div>			  
                </div>
				
				<div class="form-group">
			     <div class="col-md-6">
                  <label>Customer Mobile</label>               
				  <input type="text" name="customer_mobile" id="customer_mobile" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
			     </div>
			     <div class="col-md-6">
			      <label>Customer Email</label>               
				  <input type="text" name="customer_email" id="customer_email" class="form-control">
			     </div> 
                </div>
				
				<div class="form-group">
			     <div class="col-md-12"><br></div>
				 <div class="col-md-12" align="center">
				  <a href="#2a" data-toggle="tab" class="btn btn-success btn-block">Next</a>
			     </div>
				</div> 
               </form>
			   
               <table id="tableno"></table>
			  </div>			  
			 
			  <div class="tab-pane" id="2a">
               <div class="col-md-12">		          			 
			       <input type="hidden" id="orderid" name="orderid">			  
			       <form id="menucard" style="margin-left: -15px; margin-right: -15px;">  
			        <div class="col-md-12">
			        	<table id="example2" class="table table-bordered table-striped">
			                <thead>
			                 <tr>
			                    <th>SRNo</th>
								<th>Product Name</th>
								<th>Price</th>
								<th></th>
								<th>Quantity</th>					   
			                 </tr>
			                </thead>
                			<tbody>			   
						      <?php $i=1; foreach($FoodItems as $val){   ?>					  
							    <tr>
							      <td><?php echo $i; ?></td>
								  <td><?php echo $val['menu_name'];?>&nbsp;&nbsp;</td>
								  <td><span class="badge badge-danger"><i class="fa fa-rupee"><?php echo $val['menu_price'];?></i></span></td>
							      <td><input type="hidden" id="catergory_id" name="catergory_id[]" value="<?php echo $val['catergory_id']; ?>"><input type="hidden" id="menumcv<?php echo $i; ?>" name="menu[]">&nbsp;&nbsp;</td>
							      <td><input type="text" onclick="set1(<?php echo $i;?>,<?php echo $val['id']; ?>)" id="mcvQty<?php echo $i; ?>" name="Qty[]" class="input-sm" size="1" onkeyup="menumcv(<?php echo $i;?>,<?php echo $val['id']; ?>)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">&nbsp;&nbsp;</td>
						        </tr>
						      <?php $i++; } ?>
					     	</tbody> 
              			</table> 				   			    
				       <table id="example3" class="table table-bordered table-striped table-hover">	
				       	<thead>
			                 <tr>
			                    <th>SRNo</th>
								<th>Product Name</th>
								<th>Price</th>
								<th></th>
								<th>Quantity</th>					   
			                 </tr>
			                </thead>			     
					    <tbody>
					     <?php $i=1; foreach($HardDrinks as $val){  ?>
					       <tr>
					       	<td><?php echo $i; ?></td>
						    <td><?php echo $val['menu_name'];?>&nbsp;&nbsp;</td>
						    <td><span class="badge badge-danger"><i class="fa fa-rupee"><?php echo $val['menu_price'];?></i></span></td>
						    <td><input type="hidden" id="catergory_id" name="catergory_id[]" value="<?php echo $val['catergory_id']; ?>"><input type="hidden" id="menuharddrinks<?php echo $i; ?>" name="menu[]">&nbsp;&nbsp;</td>
						    <td><input type="text" id="harddrinksQty<?php echo $i; ?>"  onclick="set2(<?php echo $i; ?>,<?php echo $val['id']; ?>)" name="Qty[]" class="input-sm" size="1" onchange="menuharddrinks(<?php echo $i; ?>,<?php echo $val['id']; ?>)" onkeypress="return event.charCode >= 48 && event.charCode <= 57">&nbsp;&nbsp;</td>
					       </tr>
					     <?php $i++; } ?>					   
					    </tbody>
				       </table>	
				      </div>					 
			      </form>
				  	<div id="fixed" style="margin-left: 10px; margin-right: 10px; align-items: center; position: fixed; bottom: 25px; right: 0px; left: 0px; height: 30px;">
					  <div class="form-group">
					   <div class="col-md-12" align="center" style="margin-top: 5px; padding: 10px; background-color: black;">
					    <span>
						 <a href="#1a" data-toggle="tab" class="btn btn-danger">Back</a>
				       	 <a href="#3a" data-toggle="tab" class="btn btn-success" onclick="saveMenus()">Generate Order</a> 
			             <a href="#3a" data-toggle="tab" class="btn btn-primary">Next</a>
						</span>
					   </div>
					  </div>
					</div>			
		       </div>			   
			 </div>
              
			 <div class="tab-pane" id="3a">  
		        <div class="panel panel-primary">
                 <div class="panel-heading" style="background-color: white; color: black;">Temporary Order</div>
		          <div class="panel-body" style="padding: 0px;">			 
		           <div class="table-responsive">
			        <table class="table" style="margin-bottom: 0px;">
		             <thead>
		              <tr> 
					   <th>Action</th>
		               <th>Menu Name</th>
		               <th>Qty</th>
		               <th>Note</th>				      
		              </tr>
		             </thead>
		             <tbody id="tepmenu_id"></tbody>
					 <th colspan="3"></th><th><a href="#2a" data-toggle="tab" class="btn btn-info">Add Menu</a><th>
	                </table>
                   </div>
		          </div>
		        </div>	  
		       <div class="col-md-12" align="center" style="background-color: black; padding: 10px">	 
		         <a href="#2a" data-toggle="tab" class="btn btn-danger">Back</a>			   
			     <a href="#4a" data-toggle="tab" class="btn btn-success" onclick="saveform()">Order Confirm</a>
		         <a href="#4a" data-toggle="tab" class="btn btn-primary">Next</a>
			   </div>			   
		    </div>
           
  		    <div class="tab-pane" id="4a">            
		     <div class="col-md-12"><br></div>
			  <div class="col-md-12" id="chafmenu">	      			   
		     
		      </div>			  
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
		   </div>	 
	   </div> 		 
     </div>
   </section>	
   <script>
    
    $(document).ready(function()
	{ 
	   window.setTimeout(function(){gettable(); }, 3000);
	   window.setTimeout(function(){gettemporder(); getorder();}, 2000);
	   window.setInterval(function(){gettemporder(); getorder();}, 6000);
    });
	
	function saveform()
	{	    
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
				   $('#order_error').delay(3000).fadeOut();					
				 }
				 else
				 {	
				   $('#order_success').html(response.status);
				   $('#order_success').show();
				   $('#order_success').delay(3000).fadeOut();
				   $('#order_form')[0].reset();
				   $('#menucard')[0].reset();
				   gettemporder();
				   getorder();
				   gettable();
				 }					
               }
            });		
	 }
     
//------------------------------------------------------------
	 
	 function saveMenus()
	 {
	  var orderid = $('#orderid').val();	   
	  //alert(orderid);
	  $.ajax({
               type:'post', 
			   url :"<?php echo base_url().'admin/savetemporder'?>",
               data:$( "#menucard" ).serialize()+'&orderid='+orderid,
               success: function(data)
		       {        
                var response = JSON.parse(data);					
				if(response.status=="error")
				{
				  $('#order_error').html(response.errors);
				  $('#order_error').show();
				  $('#order_error').delay(1000).fadeOut();					
				}
				else
				{										
				  $('#order_success').html(response.status);
				  $('#order_success').show();
				  $('#order_success').delay(1000).fadeOut();									
				  $('#orderid').val(response.id);	
				  $('#menucard')[0].reset();
				  $('.sug').hide();
				  gettemporder();
				}					
               }
            });	
	 }
	 	 
	function gettemporder()
	{		
	 $.ajax({
             type:'get', 
			 dataType:"json",
			 url : "<?php echo base_url().'admin/getOrder'?>",
             data:{ id:'id' },
			 success: function(response)
		     {			
			   var option ='';	
			   for(var i=0;i<response.results.length;i++)
			   { 
				option+='<tr><td><a onclick=RemoveMenu('+ response.results[i]['id'] +')><i class="fa fa-trash" aria-hidden="true" style="font-size:24px;color:red"></i></a></td><td>'+ response.results[i]['menu_name'] +'</td><td><div class="quantity buttons_added"> <input type="button" value="-" class="minus"><input type="text" id="qty'+i+'" readonly="readonly" step="1" value="'+ response.results[i]['qty'] +'" class="input-text qty text" size="4"><input type="button" value="+" class="plus"> </div><button type="button" style="" class="btn btn-outline-danger btn-sm" onclick="addQty('+i+','+response.results[i]['id']+')"><i class="fa fa-refresh" style="font-size:24px"></i></button></td><td>'+ response.results[i]['suggestion'] +'</td></tr>'}
			   $('#tepmenu_id').html(option);				   
			   if(response.results.length!=0){ 
			   $('#orderid').val(response.results[0]['ordid']); }               
			   if(response.results.length==0)
			   {
				 $('#tepmenu_id').html('<tr><td colspan="5"><h4 align="center">Order Share Admin and Chef</h4></td></tr>');  
			   }					  
			 }
           });		 
	}
	      
    function getorder()
	{
	 $.ajax({
             type:'get', 
			 dataType:"json",
			 url : "<?php echo base_url().'admin/getordersgroup'?>",
             data:{ id:'id' },
			 success: function(response)
		     {				
	          var options = '';
			  for(var j=0;j<response.results.length;j++)
			  { 
	           var ids  = response.results[j]['orderid'];	
			   //<th>Table No</th>
			   options+='<div class="panel panel-primary" style="margin-bottom: 3px;"><div class="panel-heading" style="padding: 7px 2px; color: black; background-color: white; border: none;">Order Table No  ( '+ response.results[j]['table_number'] +' )</div><div class="panel-body" style="padding: 0px;"><div class="table-responsive"><table class="table" style="padding-bottom:40px; margin-bottom: 0px;"><thead><tr><th>Action</th><th>Menu Name</th><th>Qty</th></tr></thead><tbody id="chafmenu_id'+ids+'"></tbody></table><div class="col-md-12"></div><div class="col-md-12" style="background-color:black; padding:5px;"><p align="center"><a href="#3a" data-toggle="tab" class="btn btn-danger">BACK</a> <a class="btn btn-success" onclick="billrequest(1,'+ response.results[j]['orderid'] +')">BILL</a> <a href="#2a" data-toggle="tab" class="btn btn-primary" onclick="getprevious('+ response.results[j]['orderid'] +')">ADD MORE</a></p></div></div></div></div>'
			   $.ajax({
                       type:'post', 
			           dataType:"json",
			           url :"<?php echo base_url().'admin/getmainOrders'?>",
                       data:{ id:ids },
			           success: function(response)
		               {					  					   
						var option = '';	
				        var action = '';				 
				        var temp = 0;
				        for(var i=0;i<response.result.length;i++)
				        { 
				          if('1' == response.result[i]['order_status'])
				          {
					       action ='<a class="label label-primary">Order</a>';  
				          }
				          else if('2' == response.result[i]['order_status'])
				          {
					       action ='<a class="label label-info">Proceed</a>';  
				          }
				          else if('3' == response.result[i]['order_status'])
				          {
					       action ='<a class="label label-warning">Hold</a>';     
				          }
				          else if('4' == response.result[i]['order_status'])
				          {
					       action ='<a class="label label-danger">Reject</a>';  
				          }
				          else if('5' == response.result[i]['order_status'])
				          {
					       action ='<a class="label label-success">Complete</a>';  
				          }
				          else
				          {
					       action = '';  
				          }
				         option+='<tr><td>'+ action +'</td><td>'+ response.result[i]['menu_name'] +'</td><td>'+ response.result[i]['qty'] +'</td></tr>'
				        }											
				         $('#chafmenu_id'+response.result[0]['orderid']).html(option);
						}
                      });
			  }
			  $('#chafmenu').html(options); 	
			}			 
	      });	  
	 }
	 
	 function getprevious(val)
	 {	  
	  $.ajax({
               type:'post', 
			   dataType:"json",
			   url : "<?php echo base_url().'admin/getpreviousorder'?>",
               data:{ id:val },
			   success: function(response)
		       {
			     for(var j=0;j<response.results.length;j++)
			     { 
                   var optbl='<option value="'+response.results[0]['table_id']+'">'+ response.results[0]['table_number'] +'</option>';
				   $('#table_id').html(optbl);				 
				   $('#customer_mobile').val(response.results[0]['customer_mobile']);
				   $('#customer_id').val(response.results[0]['customer_id']);				 
				   $('#customer_name').val(response.results[0]['customer_name']);
				   $('#customer_email').val(response.results[0]['customer_email']);				 
				   $('#orderid').val(response.results[0]['orderid']);	
                 }
			   }
	         });
	 }
	 
	 function gettable()
	 {	  
	   $.ajax({
                type:'get', 
			    dataType:"json",
			    url : "<?php echo base_url().'admin/gettable'?>",
                data:{ id:'id' },
			    success: function(response)
		        {				
	              var option = "";
			      option+="<option value=''>select</option>"
				  for(var j=0;j<response.results.length;j++)
			      { 
	                option+="<option value="+ response.results[j]['id'] +">"+ response.results[j]['table_number'] +"</option>"
	              }
				  $('#table_id').html(option);
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
	 
	 function billrequest(val,ordid)
	 {
	   //var tbid = $('#table_id').val();	   
	   $.ajax({
                type:'post', 
			    url :"<?php echo base_url().'admin/billRequestOrder'?>",
                data:{ ordid:ordid , status : val },
			    success: function(data)
		        {        
                  var response = JSON.parse(data);
			      if('success' == response.status)
				  {	
				  	swal("Done!","Your order successfully placed!","success");
                    //window.setTimeout(function(){ location.reload(true); }, 1000);
					getorder();  
				  }
                }
             });
	 }	
     function set1(val,menumcv)
	 {       
	   var varq = "#mcvQty"+val;
	   var Qty = $(varq).val();	   
	   var sug  = "#FoodItems"+val;
	   var menu = "#menumcv"+val;
	   var suge = "#mcvsugestion"+val;
	   var sugeval = $(suge).val();	
	   if(Qty=='')
	   {
		  $(varq).val();
		  $(menu).val(menumcv);
		  $(sug).show(); 
	   }
       else
	   {
		  $(menu).val(menusmcv);
		  $(varq).val(Qty);   
       }	   
	   if(sugeval=="")
	   {
		 $(suge).val('Note');  
	   }   
	 }
	 
     function menumcv(val,menumcv) 
	 { 		
		var suge   = "#mcvsugestion"+val;
		var c   = "#mcvQty"+val;
		var d   = "#menumcv"+val;
		var sug = "#FoodItems"+val;	
		var ck  = $(c).val();
        
		if(ck=="" || ck==0){
		   $(suge).val(''); 
		   $(d).val(''); 
		   $(sug).hide(); 
		}
		else
		{		   
		  $(sug).show();
		  $(d).val(menu);
		  $(suge).val('Note');
		}			
	 } 
	 function set2(val,menuharddrinks)
	 {       
	   var varq = "#harddrinksQty"+val;
	   var Qty = $(varq).val();	   
	   var sug  = "#HardDrinks"+val;
	   var menu = "#menuharddrinks"+val;
	   var suge = "#harddrinkssugestion"+val;
	   var sugeval = $(suge).val();	
	   if(Qty=='')
	   {
		  $(varq).val();
		  $(menu).val(menuharddrinks);
		  $(sug).show(); 
	   }
       else
	   {
		  $(menu).val(menuharddrinks);
		  $(varq).val(Qty);   
       }		   	
	   if(sugeval=="")
	   {
		 $(suge).val('Note');  
	   }   
	 }

     function menuharddrinks(val,menuharddrinks) 
	 { 
		var suge   = "#harddrinkssugestion"+val;
		var c      = "#harddrinksQty"+val;		
		var d      = "#menuharddrinks"+val;
		var sug    = "#HardDrinks"+val;		
		var ck  = $(c).val();        
		if(ck=="" || ck==0){
		   $(suge).val(''); 
		   $(d).val(''); 
		   $(sug).hide(); 
		}
		else
		{   
		  $(sug).show();
		  $(d).val(menuharddrinks);
		  $(suge).val('Note');
		}       	
	 }
     function addQty(val,id)
	 {	  
	   var a = "#qty"+val;	  	
	   var qty = $(a).val();	   
	   $.ajax({
               type:'post', 
			   dataType:"json",
			   url : "<?php echo base_url().'admin/postQty'?>",
               data:{ id:id,qty:qty },
			   success: function(response)
		       {
			      gettemporder();
	           } 
	        });
	 }
   </script> 