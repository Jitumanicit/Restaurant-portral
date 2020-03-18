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
			  
			 
			 <ul  class="nav nav-pills">
			  <li class="active">
               <a  href="#1a" data-toggle="tab">Overview</a>
			  </li>
			  <li>
			   <a href="#2a" data-toggle="tab">Using nav-pills</a>
			  </li>
			  <li>
			   <a href="#3a" data-toggle="tab">Applying clearfix</a>
			  </li>
  		      <li>
			   <a href="#4a" data-toggle="tab">Background color</a>
			  </li>
		     </ul>
			 
			 <div class="tab-content clearfix">
			  <div class="tab-pane active" id="1a">
               <h3>Content's background color is the same for the tab</h3>
			  </div>
			  <div class="tab-pane" id="2a">
               <h3>We use the class nav-pills instead of nav-tabs which automatically creates a background color for the tab</h3>
			  </div>
              <div class="tab-pane" id="3a">
               <h3>We applied clearfix to the tab-content to rid of the gap between the tab and the content</h3>
			  </div>
              <div class="tab-pane" id="4a">
               <h3>We use css to change the background color of the content to be equal to the tab</h3>
			  </div>
			 </div>
  			
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
			    <input type="hidden" name="customer_id" id="customer_id">
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
			 
			 <!---			 
			  <div class="form-group"> 
			   <div class="col-md-12"></div>
			  </div>			 
			  <div class="form-group"> 
			   <div class="col-md-6">
			     <a class="btn btn-social-icon btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus "></i></a> 	 
               </div>
			  </div>			 
			 --->
			 
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
            <div class="panel-heading active">Menu Card</div>
		     <div class="panel-body">
			 
			  <input type="hidden" id="orderid" name="orderid">
			  
			  <form id="menucard">			   
			   <div class="col-md-4">
			    <div class="panel panel-primary">
                 <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                   <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    SOUP <i class="more-less glyphicon glyphicon-plus" style="font-size:24px;color:#ffffff"></i>
                   </a>
                  </h4>
                 </div>
                 <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                   <table>				     
					 <tbody>				   
					  <?php $i=0; foreach($soup as $val){   ?>					  
					   <tr>
						<td><?php echo $val['menu_name'];?>&nbsp;&nbsp;</td>
						<td><input type="hidden" id="catergory_id" name="catergory_id[]" value="<?php echo $val['catergory_id']; ?>"><input type="checkbox" id="menu" name="menu[]" value="<?php echo $val['id']; ?>" onclick="menus(<?php echo $i; ?>)">&nbsp;&nbsp;</td>
						<td><input type="text" id="sQty<?php echo $i; ?>" name="Qty[]" class="input-sm" size="1">&nbsp;&nbsp;</td>
					    <td>
						 <!--<select type="text" id="sugestion" name="sugestion[]" class="input-sm"><option value="">select</option><option value="normal">normal</option><option value="less spicy">less spicy</option><option value="spicy">Spicy</option></select>-->
						 <input type="text" id="ssugestion<?php echo $i; ?>" name="sugestion[]" class="input-sm">
						</td>
					   </tr>					 
					  <?php $i++; } ?>
					 </tbody>
				   </table>				   
                  </div>
                 </div>
                </div>
				
			    <div class="panel panel-primary">
                 <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                   <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    ROTI<i class="more-less glyphicon glyphicon-plus" style="font-size:24px;color:#ffffff"></i>
                   </a>
                  </h4>
                 </div>
                 <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                   <table>				     
					<tbody>					 
					 <?php $i=0; foreach($roti as $val){  ?>
					  <span> 
					   <tr>
						<td><?php echo $val['menu_name'];?>&nbsp;&nbsp;</td>
						<td><input type="hidden" id="catergory_id" name="catergory_id[]" value="<?php echo $val['catergory_id']; ?>"><input type="checkbox" id="menu" name="menu[]" value="<?php echo $val['id']; ?>" onclick="menur(<?php echo $i; ?>)">&nbsp;&nbsp;</td>
						<td><input type="text" id="rQty<?php echo $i; ?>" name="Qty[]" class="input-sm" size="1">&nbsp;&nbsp;</td>
					    <td>
						 <!--<select type="text" id="sugestion" name="sugestion[]" class="input-sm"><option value="">select</option><option value="normal">normal</option><option value="less spicy">less spicy</option><option value="spicy">Spicy</option></select>-->
						 <input type="text" id="rsugestion<?php echo $i; ?>" name="sugestion[]" class="input-sm"> 
						</td>
					   </tr>					  
					  </span> 
					 <?php $i++; } ?>					   
					</tbody>
				   </table>				  
                  </div>
                </div>
               </div>

               <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingseven">
                 <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseseven" aria-expanded="true" aria-controls="collapseseven">
                    BEER<i class="more-less glyphicon glyphicon-plus" style="font-size:24px;color:#ffffff"></i>
                  </a>
                 </h4>
                </div> 
				<div id="collapseseven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingseven">
                 <div class="panel-body">				    
				  <table>				     
					<tbody>
					 <?php $i=0; foreach($beer as $val){  ?>
					 <span>
					  <tr>
						<td><?php echo $val['menu_name'];?>&nbsp;&nbsp;</td>
						<td><input type="hidden" id="catergory_id" name="catergory_id[]" value="<?php echo $val['catergory_id']; ?>"><input type="checkbox" id="menu" name="menu[]" value="<?php echo $val['id']; ?>" onclick="menube(<?php echo $i; ?>)">&nbsp;&nbsp;</td>
						<td><input type="text" id="beQty<?php echo $i; ?>" name="Qty[]" class="input-sm" size="1">&nbsp;&nbsp;</td>
					    <td>
						<!--<select type="text" id="sugestion" name="sugestion[]" class="input-sm"><option value="">select</option><option value="normal">normal</option></select>-->
						 <input type="text" id="besugestion<?php echo $i; ?>" name="sugestion[]" class="input-sm"> 
						</td>
					  </tr>					   
					 </span> 
					 <?php $i++; } ?>					   
				    </tbody>  
				   </table>	
				  </div>
				 </div> 
				</div>
			  </div>						   
			
			  <div class="col-md-4">
				<div class="panel panel-primary">
                 <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                   <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    PARATA<i class="more-less glyphicon glyphicon-plus" style="font-size:24px;color:#ffffff"></i>
                   </a>
                  </h4>
                 </div>
                 <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                    <table>				     
					 <tbody>					 
					  <?php $i=0; foreach($parata as $val){  ?>
					  <span> 
					   <tr>
						<td><?php echo $val['menu_name'];?>&nbsp;&nbsp;</td>
						<td><input type="hidden" id="catergory_id" name="catergory_id[]" value="<?php echo $val['catergory_id']; ?>"><input type="checkbox" id="menu" name="menu[]" value="<?php echo $val['id']; ?>" onclick="menup(<?php echo $i; ?>)">&nbsp;&nbsp;</td>
						<td><input type="text" id="pQty<?php echo $i; ?>" name="Qty[]" class="input-sm" size="1">&nbsp;&nbsp;</td>
					    <td>
						<!--<select type="text" id="sugestion" name="sugestion[]" class="input-sm"><option value="">select</option><option value="normal">normal</option><option value="less spicy">less spicy</option><option value="spicy">Spicy</option></select>-->
						  <input type="text" id="psugestion<?php echo $i; ?>" name="sugestion[]" class="input-sm"> 
						</td>
					   </tr>					  
					  </span>
					  <?php $i++; } ?>					   
					 </tbody>
				    </table>				   
                  </div>
                 </div>
               </div>
			   
			   <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="headingfour">
                  <h4 class="panel-title">
                   <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                    BIRIYANI<i class="more-less glyphicon glyphicon-plus" style="font-size:24px;color:#ffffff"></i>
                   </a>
                  </h4>
                </div>
                <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour">
                 <div class="panel-body">
                   <table>				     
					 <tbody>
					  <?php $i=0; foreach($biriyani as $val){  ?>
					  <span>
					   <tr>
						<td><?php echo $val['menu_name'];?>&nbsp;&nbsp;</td>
						<td><input type="hidden" id="catergory_id" name="catergory_id[]" value="<?php echo $val['catergory_id']; ?>"><input type="checkbox" id="menu" name="menu[]" value="<?php echo $val['id']; ?>" onclick="menub(<?php echo $i; ?>)">&nbsp;&nbsp;</td>
						<td><input type="text" id="bQty<?php echo $i; ?>" name="Qty[]" class="input-sm" size="1">&nbsp;&nbsp;</td>
					    <td>
						<!--<select type="text" id="sugestion" name="sugestion[]" class="input-sm"><option value="">select</option><option value="normal">normal</option><option value="less spicy">less spicy</option><option value="spicy">Spicy</option></select>-->
						 <input type="text" id="bsugestion<?php echo $i; ?>" name="sugestion[]" class="input-sm"> 
						</td>
					   </tr>					  
					  </span> 
					  <?php $i++; } ?>					   
					 </tbody>
				    </table>				   
                  </div>
                 </div>
                </div>
                
				<div class="panel panel-primary">
                  <div class="panel-heading" role="tab" id="headingeight">
                   <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseeight" aria-expanded="true" aria-controls="collapseeight">
                     VODKA<i class="more-less glyphicon glyphicon-plus" style="font-size:24px;color:#ffffff"></i>
                    </a>
                   </h4>
                  </div> 
				  <div id="collapseeight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingeight">
                   <div class="panel-body">				    
				    <table>				     
					 <tbody>
					  <?php $i=0; foreach($vodka as $val){  ?>
					  <span>
					   <tr>
						 <td><?php echo $val['menu_name'];?>&nbsp;&nbsp;</td>
						 <td><input type="hidden" id="catergory_id" name="catergory_id[]" value="<?php echo $val['catergory_id']; ?>"><input type="checkbox" id="menu" name="menu[]" value="<?php echo $val['id']; ?>" onclick="menuv(<?php echo $i; ?>)">&nbsp;&nbsp;</td>
						 <td><input type="text" id="vQty<?php echo $i; ?>" name="Qty[]" class="input-sm" size="1">&nbsp;&nbsp;</td>
					     <td>
						 <!--<select type="text" id="sugestion" name="sugestion[]" class="input-sm"><option value="">select</option><option value="normal">normal</option></select>-->
						  <input type="text" id="vsugestion<?php echo $i; ?>" name="sugestion[]" class="input-sm"> 
						 </td>
					   </tr>					   
					  </span> 
					  <?php $i++; } ?>					   
					 </tbody>
				    </table>	
				   </div>
				  </div> 
				 </div>				
			   </div>
			  
			   <div class="col-md-4">				
				<div class="panel panel-primary">
                 <div class="panel-heading" role="tab" id="headingfive">
                  <h4 class="panel-title">
                   <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
                    CHICKEN GRAVY<i class="more-less glyphicon glyphicon-plus" style="font-size:24px;color:#ffffff"></i>
                   </a>
                  </h4>
                 </div> 
				 <div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive">
                  <div class="panel-body">				    
				   <table>				     
					<tbody>
					 <?php $i=0; foreach($chincken as $val){  ?>
					 <span>
					  <tr>
						<td><?php echo $val['menu_name'];?>&nbsp;&nbsp;</td>
						<td><input type="hidden" id="catergory_id" name="catergory_id[]" value="<?php echo $val['catergory_id']; ?>"><input type="checkbox" id="menu" name="menu[]" value="<?php echo $val['id']; ?>" onclick="menucg(<?php echo $i; ?>)">&nbsp;&nbsp;</td>
						<td><input type="text" id="cgQty<?php echo $i; ?>" name="Qty[]" class="input-sm" size="1">&nbsp;&nbsp;</td>
					    <td>
						<!--<select type="text" id="sugestion" name="sugestion[]" class="input-sm"><option value="">select</option><option value="normal">normal</option><option value="less spicy">less spicy</option><option value="spicy">Spicy</option></select>-->
						 <input type="text" id="cgsugestion<?php echo $i; ?>" name="sugestion[]" class="input-sm"> 
						</td>
					  </tr>					  
					 </span> 
					 <?php $i; } ?>					   
					</tbody>
				   </table>
				  </div>
				 </div>				 
				</div>
				
				<div class="panel panel-primary">
                  <div class="panel-heading" role="tab" id="headingsix">
                   <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="true" aria-controls="collapsesix">
                     COLD DRINK<i class="more-less glyphicon glyphicon-plus" style="font-size:24px;color:#ffffff"></i>
                    </a>
                   </h4>
                  </div> 
				  <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix">
                   <div class="panel-body">				    
				    <table>				     
					 <tbody>
					  <?php $i=0; foreach($colddrink as $val){  ?>
					  <span>
					   <tr>
						 <td><?php echo $val['menu_name'];?>&nbsp;&nbsp;</td>
						 <td><input type="hidden" id="catergory_id" name="catergory_id[]" value="<?php echo $val['catergory_id']; ?>"><input type="checkbox" id="menu" name="menu[]" value="<?php echo $val['id']; ?>" onclick="menucd(<?php echo $i; ?>)">&nbsp;&nbsp;</td>
						 <td><input type="text" id="cdQty<?php echo $i; ?>" name="Qty[]" class="input-sm" size="1">&nbsp;&nbsp;</td>
					     <td>
						 <!--<select type="text" id="sugestion" name="sugestion[]" class="input-sm"><option value="">select</option><option value="normal">normal</option></select>-->
						  <input type="text" id="cdsugestion<?php echo $i; ?>" name="sugestion[]" class="input-sm" onclick="menucd(<?php echo $i; ?>)"> 
						 </td>
					   </tr>					   
					  </span> 
					  <?php $i++; } ?>					   
					 </tbody>
				    </table>	
				   </div>
				  </div> 
				 </div>
				 
				 <div class="panel panel-primary">
                  <div class="panel-heading" role="tab" id="headingten">
                   <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseten" aria-expanded="true" aria-controls="collapseten">
                     WHISKY<i class="more-less glyphicon glyphicon-plus" style="font-size:24px;color:#ffffff"></i>
                    </a>
                   </h4>
                  </div> 
				  <div id="collapseten" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingten">
                   <div class="panel-body">				    
				    <table>				     
					 <tbody>
					  <?php $i=0; foreach($whisky as $val){  ?>
					  <span>
					   <tr>
						 <td><?php echo $val['menu_name'];?>&nbsp;&nbsp;</td>
						 <td><input type="hidden" id="catergory_id" name="catergory_id[]" value="<?php echo $val['catergory_id']; ?>"><input type="checkbox" id="menu" name="menu[]" value="<?php echo $val['id']; ?>" onclick="menuw(<?php echo $i; ?>)">&nbsp;&nbsp;</td>
						 <td><input type="text" id="wQty<?php echo $i; ?>" name="Qty[]" class="input-sm" size="1">&nbsp;&nbsp;</td>
					     <td>
						 <!--<select type="text" id="sugestion" name="sugestion[]" class="input-sm"><option value="">select</option><option value="normal">normal</option></select>-->
						   <input type="text" id="wsugestion<?php echo $i; ?>" name="sugestion[]" class="input-sm"> 
						 </td>
					   </tr>					   
					  </span> 
					  <?php $i++; } ?>					   
					 </tbody>
				    </table>	
				   </div>
				  </div> 
				 </div>	
			   </div>				
			  </form>			  
			 <div class="col-md-12" align="center">		    
		      <input type="submit" name="submit" value="Save Menu" class="btn btn-primary btn-sm" onclick="saveMenus()"> 
		     </div>			  
			</div>
		   </div>			
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
		           <th>Note</th>
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
		           <th>Note</th>
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
					$('#customer_name').val(response.customer_name);
					$('#customer_email').val(response.customer_email);
					$('#customer_id').val(response.customer_id);
					$('#menucard')[0].reset();
					gettemporder();
					getorder();
					//$("#loader").hide();
				 }					
               }
            });		
	 }
      
//-------------------------------------------------------------	 
	 
	/*
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
    */
	  
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
					$('#order_error').delay(2000).fadeOut();
					//$("#loader").hide();
				  }
				  else
				  {										
					$('#order_success').html(response.status);
					$('#order_success').show();
					$('#order_success').delay(2000).fadeOut();									
					$('#orderid').val(response.id);	
					$('#menucard')[0].reset();
					gettemporder();
				  }					
                }
              });	
	 }
	 
	 
	 
	 /*
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
					 //$('#orderid').val(response.id);					  
					 //gettemporder();					  					  
				   }					
                }
              });		
	 }	 
	 */
	 
	 function gettemporder()
	 {		
	   $.ajax({
                type:'get', 
				dataType:"json",
				url : "<?php echo base_url().'admin/getOrder'?>",
                data:{ id:'id' },
				success: function(response)
		        {
				   //var response = JSON.parse(data);					
				   var option ='';	
				   for(var i=0;i<response.results.length;i++)
				   {
				     option+='<tr><td>'+ response.results[i]['category_name'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td><td>'+ response.results[i]['suggestion'] +'</td><td><a onclick=RemoveMenu('+ response.results[i]['id'] +')><i class="fa fa-trash" aria-hidden="true" style="font-size:24px;color:red"></i></a></td></tr>'
				   }
				   $('#tepmenu_id').html(option);
				   //alert(response.results[0]['ordid']);
				   if(response.results.length!=0){ 
				   $('#orderid').val(response.results[0]['ordid']);  }               
				}
             });		 
	 }
	      
     function getorder()
	 {
	  $.ajax({
               type:'get', 
			   dataType:"json",
			   url : "<?php echo base_url().'admin/getmainOrder'?>",
               data:{ id:'id' },
			   success: function(response)
		       {        
                 //var response = JSON.parse(data);					
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
					 action ='<a class="label label-info">Proceed</a>';  
				   }
				   else if('3' == response.results[i]['order_status'])
				   {
					 action ='<a class="label label-warning">Hold</a>';     
				   }
				   else if('4' == response.results[i]['order_status'])
				   {
					 action ='<a class="label label-danger">Reject</a>';  
				   }
				   else if('5' == response.results[i]['order_status'])
				   {
					 action ='<a class="label label-success">Complete</a>';  
				   }
				   else
				   {
					 action ='';  
				   }					   
				   option+='<tr><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['category_name'] +'</td><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['qty'] +'</td><td>'+ response.results[i]['suggestion'] +'</td><td>'+ action +'</td></tr>'
				 }				 
				 var optbl='<option value="'+response.results[0]['table_id']+'">'+ response.results[0]['table_number'] +'</option>';
				 $('#table_id').html(optbl);
				 //$('#table_id').val(response.results[0]['table_id']);
				 $('#customer_mobile').val(response.results[0]['customer_mobile']);
				 $('#customer_id').val(response.results[0]['customer_id']);				 
				 $('#customer_name').val(response.results[0]['customer_name']);
				 $('#customer_email').val(response.results[0]['customer_email']);				 
				 $('#orderid').val(response.results[0]['orderid']);
				 //alert(response.results[0]['id']);	
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
					getorder();  
				  }
                }
             });
	 }	

     function menus(val)
	 {		
		var a = "#ssugestion"+val;
		var c = "#sQty"+val;
		var b = $(a).val();		
		if(b!=""){ $(a).val(''); $(c).val(''); }else{ $(a).val("NA"); }			
	 } 
	 
	 function menur(val)
	 {		
		var a = "#rsugestion"+val;
		var c = "#rQty"+val;
		var b = $(a).val();		
		if(b!=""){ $(a).val(''); $(c).val('');}else{ $(a).val("NA"); }			
	 } 
	 
	 function menube(val)
	 {		
		var a = "#besugestion"+val;		
		var c = "#beQty"+val;
		var b = $(a).val();		
		if(b!=""){ $(a).val(''); $(c).val(''); }else{ $(a).val("NA"); }			
	 } 
	 
	 function menup(val)
	 {		
		var a = "#psugestion"+val;		
		var c = "#pQty"+val;
		var b = $(a).val();		
		if(b!=""){ $(a).val(''); $(c).val(''); }else{ $(a).val("NA"); }			
	 } 
	 
	 function menub(val)
	 {		
		var a = "#bsugestion"+val;		
		var c = "#bQty"+val;
		var b = $(a).val();		
		if(b!=""){ $(a).val('');$(c).val(''); }else{ $(a).val("NA"); }			
	 } 
	 
	 function menuv(val)
	 {		
		var a = "#vsugestion"+val;		
		var c = "#vQty"+val;
		var b = $(a).val();		
		if(b!=""){ $(a).val('');$(c).val(''); }else{ $(a).val("NA"); }			
	 } 
	 
	 function menucg(val)
	 {		
		var a = "#cgsugestion"+val;		
		var c = "#cgQty"+val;
		var b = $(a).val();		
		if(b!=""){ $(a).val(''); $(c).val(''); }else{ $(a).val("NA"); }			
	 } 
	 
	 function menucd(val)
	 {		
		var a = "#cdsugestion"+val;		
		var c = "#cdQty"+val;
		var b = $(a).val();		
		if(b!=""){ $(a).val(''); $(c).val(''); }else{ $(a).val("NA"); }			
	 } 
	 
	 function menuw(val)
	 {		
		var a = "#wsugestion"+val;		
		var c = "#wQty"+val;
		var b = $(a).val();		
		if(b!=""){ $(a).val(''); $(c).val(''); }else{ $(a).val("NA"); }			
	 } 
   </script> 
   
   <!--<div class="modal fade" id="myModal" role="dialog">
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
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
     </div>
    </div>-->   