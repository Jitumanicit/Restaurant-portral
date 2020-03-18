    <section class="content-header">
     <h1>Dashboard  
      <?php if('buyer'!=$roles){ ?>  
		<small>Control panel</small>
	  <?php }else{ ?>	
	    <small>Payment Chart</small>
	  <?php } ?>
     </h1>
     <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
     </ol>
    </section>   
    <section class="content">
	 <div class="col-lg-9">
	   <div class="row">
	     <div class="col-md-12"> 
		  <div class="panel panel-primary">
            <div class="panel-heading">Billing Request</div>
            <div class="panel-body">
             <table class="table table-bordered">
              <thead>
                <tr>
                 <th>Table No</th>
                 <th>Order Id</th>
				 <th>Manager Code</th>
                 <th>Waiter Code</th>
				 <th>Action</th>
                </tr>
              </thead>
              <tbody id="billrequest">                  
              </tbody>
             </table>
			</div>
          </div>
		 </div>
	   </div>
	 </div>	 	 
	 <div class="col-lg-3">  
	   <div class="row">			 
		 <div class="col-md-10 col-xs-12">          
          <div class="small-box bg-yellow">
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
	   </div> 
	   
	   <!---<div class="row">			 
		<div class="col-md-10 col-xs-12">          
           <div class="small-box bg-blue">
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
	   </div>--->	
	   
	   <div class="row">			 
		<div class="col-md-10 col-xs-12">          
           <div class="small-box bg-maroon">
             <div class="inner">
              <h3><?php echo $table[0]['unique_total']; ?></h3>
              <p>Table</p>
             </div>
             <div class="icon">
              <i class="fa fa-table"></i>
             </div>
             <a href="<?php echo base_url().'admin/viewtable' ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           </div>
        </div>		
	   </div>		   
	   <div class="row">			 
		 <div class="col-md-10 col-xs-12">          
           <div class="small-box bg-green">
             <div class="inner">
              <h3><?php echo $menu[0]['unique_total']; ?></h3>
              <p>Menu</p>
             </div>
             <div class="icon">
              <i class="fa fa-bars"></i>
             </div>
             <a href="<?php echo base_url().'admin/viewmenu' ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
        <h4 class="modal-title">Bill Pay</h4>
       </div>       
	   <div class="modal-body">
	    <div class="row">
		 <div class="col-md-6"> 		  
		  <table class="table">		    
			<thead>
		     <tr>
		      <th>Menu</th>
		      <th>Price</th>
		      <th>qty</th>
			  <th>Amount</th>
		     </tr>	
		    </thead> 
		    <tbody id="billrequests"></tbody>
			<tbody id="subtotals"></tbody>	
            <tbody id="alchototals"></tbody>				
			<tbody id="taxbills"></tbody>
			<tbody id="total"></tbody>			
		  </table>
		 </div>
		 
		 <div class="col-md-6">
		  <form method="post" name="bill">
		   <div class="form-group"> 
			<div class="col-md-6">
			  <label>Customer Name</label> 
			  <input type="text" name="customer_name" id="customer_name" class="form-control" style='text-transform:capitalize'> 
			  <input type="hidden" name="customer_id" id="customer_id">
			</div>		
			<div class="col-md-6">
			  <label>Mobile</label> 
			  <input type="text" name="customer_mobile" id="customer_mobile" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57"> 
			</div>			
			<div class="col-md-6">
			  <label>Email Id</label> 
			  <input type="text" name="customer_email" id="customer_email" class="form-control"> 
			</div>			
			<div class="col-md-6">
			 <label>Total</label>
			 <input type="text" name="totals" id="totals" class="form-control" readonly> 
			 <input type="hidden" name="orderid" id="orderid">
			</div>
			<div class="col-md-6">
			 <label>Payment Mode</label>
			 <select name="payment_mode" id="payment_mode" class="form-control">
              <option value="">select</option>
			  <option value="card">card</option>
			  <option value="cash">cash</option>
			  <option value="Paytm">Paytm</option>
			  <option value="phonepe">phonepe</option>				
             </select>			  
			</div>
			<div class="col-md-6">
			 <label>CGST</label> 
			 <input type="text" name="cgst" id="cgst" class="form-control" readonly> 
			</div>
			<div class="col-md-6">
			 <label>SGST</label> 
			 <input type="text" name="sgst" id="sgst" class="form-control" readonly> 
			</div>
			<div class="col-md-6">
			 <label>VAT</label> 
			 <input type="text" name="vat" id="vat" class="form-control" readonly> 
			</div>
            <div class="col-md-6">
			 <label>Coupan Type</label> 
			 <input type="text" name="coupan_type" id="coupan_type" class="form-control" readonly>		 
			</div>			
			<div class="col-md-6">
			 <label>Coupan Code</label> 
			 <input type="text" name="coupan_code" id="coupan_code" class="form-control" onkeyup="coupanchecks(this.value)"> 
			</div>
			<div class="col-md-6"> 
			 <label>Discount</label>
			 <input type="text" name="discount" id="discount" class="form-control" onkeyup="diduction(this.value);" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  readonly> 
			</div>	
			<div class="col-md-6">
			 <label>Packaging Amount</label> 
			 <input type="text" name="packaging_amount" id="packaging_amount" class="form-control" onchange="addition(this.value);">
			</div>		
			<div class="col-md-6">
			 <label>Payment Amount</label>
			 <input type="text" name="payment_amount" id="payment_amount" class="form-control" readonly> 
			</div>			
			<div class="col-md-6">
			 </br>
			</div>
			<div class="col-md-12">
			 </br>
			</div>
		  </div>	
		 </form>		 
		 <div class="col-md-12" align="center">
		  <input type="submit" name="submit" class="btn btn-primary" value="submit" onclick="paymentsave()">
		 </div>		 
		 <div class="col-md-12"> 
		  <div class="alert alert-danger alert-dismissible" style="display:none" id="payment_error">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>                
          </div>		
          <div class="alert alert-success alert-dismissible" style="display:none" id="payment_success">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  
          </div>	 
		 </div>		 
		</div>
	   </div>
	  </div>	  
	 </div>	   
    </div>
   </div>     
   <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog modal-sm">
     <div class="modal-content">       
	  <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Print Bill</h4>
      </div>       
	 <div class="modal-body">
	  <div class="row">		 
       <div id="invoice-POS" style="width: 70mm;">    
        <center id="top">
          <!--<div class="logo"></div>-->
           <div class="info"> 
            <h2 id="restaurant_name"></h2>
			<p id="address"></p>
			<p>GST NO.: 18AVLPS8588B1ZV</p>
			<p>Phone : +91 8811037229</p>
           </div>
        </center>		 
        <div id="mid" style="min-height: 20px;">
          <div class="info" style="font-size: 11px;">
            <tr class="service">
             <td class="tableitem" colspan="2"><span id="billtableno"></span></td>
			 <td class="tableitem" colspan="2"><span id="billtabledate"></span></td>
			</tr>				  
			<tr class="service">
			 <td class="tableitem" colspan="2"><span id="billtablenos"></span></td>
			 <td class="tableitem" colspan="2"><span id="billtabletime"></span></td>
			</tr>
		  </div>
        </div>    
        <div id="bot">
         <div id="table">
		  <table>
			<thead>
			 <tr class="tabletitle">
			   <td class="item" style="width: 0mm;"><p><b>Menu</b></p></td>
			   <td class="Hours"><p><b>Qty</b></p></td>
			   <td class="Hours"><p><b>Price</b></p></td>
			   <td class="Rate"><p><b>Amount</b></p></td>
			 </tr>
			</thead>
			<tbody id="bills" style="font-weight: bold;"></tbody>
			<tbody id="subtotalsb" style="font-weight: bold;"></tbody>
			<tbody id="alchototalsb" style="font-weight: bold;"></tbody>			 
			<tbody id="taxbillss" style="font-weight: bold;"></tbody>			 
			<tbody id="totalbill" style="font-weight: bold;"></tbody>
		  </table>
		 </div>
		 <div id="legalcopy">
		   <p class="legal" align="right"><strong>Thank you!</strong></p>
		   <p class="legal" align="right"><strong>Please Visit Again !</strong></p>
		 </div>
		</div>		
       </div>	   
	   <div align="center">
		<a class="btn btn-primary" onclick="printDiv('invoice-POS')">Print</a>
	   </div> 
	  </div>        
     </div> 
    </div> 
   </div> 
  </div>

  <div class="modal fade" id="myModals1" role="dialog">
    <div class="modal-dialog modal-sm">
     <div class="modal-content">       
	  <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Print Bill</h4>
      </div>       
	 <div class="modal-body">
	  <div class="row">		 
       <div id="invoice-POS" style="width: 70mm;">
       <div id="print">    
        <center id="top">
          <!--<div class="logo"></div>-->
           <div class="info"> 
            <h2>Red Contemporary Dining</h2>
			<p id="address1"></p>
			<p>GST NO.: 18AVLPS8588B1ZV</p>
			<p>Phone : +91 8811037229</p>
           </div>
        </center>		 
        <div id="mid" style="min-height: 20px;">
          <div class="info" style="font-size: 11px;">
            <tr class="service">
             <td class="tableitem" colspan="2"><span id="billtableno1"></span></td>
			 <td class="tableitem" colspan="2"><span id="billtabledate1"></span></td>
			</tr>				  
			<tr class="service">
			 <td class="tableitem" colspan="2"><span id="billtablenos1"></span></td>
			 <td class="tableitem" colspan="2"><span id="billtabletime1"></span></td>
			</tr>
		  </div>
        </div>    
        <div id="bot">
         <div id="table">
		  <table>
			<thead>
			 <tr class="tabletitle">
			   <td class="item" style="width: 0mm;"><h2>Menu</h2></td>
			   <td class="Hours"><h2>Qty</h2></td>
			   <td class="Hours"><h2>Price</h2></td>
			   <td class="Rate"><h2>Amount</h2></td>
			 </tr>
			</thead>
			<tbody id="bills1" style="font-weight: bold;"></tbody>
			<tbody id="subtotalsb1" style="font-weight: bold;"></tbody>
			<tbody id="alchototalsb1" style="font-weight: bold;"></tbody>			 
			<tbody id="taxbillss1" style="font-weight: bold;"></tbody>
			<tbody id="packaging_amount1" style="font-weight: bold;"></tbody>
			<tbody id="discount1" style="font-weight: bold;"></tbody>			 
			<tbody id="totalbill1" style="font-weight: bold;"></tbody>
		  </table>
		 </div>
		 <div id="legalcopy">
		   <p class="legal" align="right"><strong>Thank you!</strong></p>
		   <p class="legal" align="right"><strong>Please Visit Again !</strong></p>
		 </div>
		</div>
		</div>
       </div>	   
	   <div align="center">
		<a class="btn btn-primary" onclick="printDiv('print')">Print</a>
	   </div> 
	  </div>        
     </div> 
    </div> 
   </div> 
  </div>
  
 <script>    
    $(document).ready(function(){
	  window.setTimeout(function(){ getbillRequest(); }, 1000);	
	  window.setInterval(function(){ getbillRequest(); }, 10000);
    }); 
    
	function coupancheck(val)
	{
	  if(val!='')
	  {
		var tot = $('#totals').val();
		$("#payment_amount").val(tot);
		$("#coupan_code").attr("readonly", false); 
		$("#discount").attr("readonly", false);
	    $("#coupan_code").val('');
		$("#discount").val('');
	  }
	  else
	  {
		var tot = $('#totals').val();
		$("#payment_amount").val(tot);
		$("#coupan_code").attr("readonly", true); 
		$("#discount").attr("readonly", true);
		$("#coupan_code").val('');
		$("#discount").val('');
	  }  
	}	
	
	function coupanchecks(val)
	{
	 var totals     = $('#totals').val();	 
	 if(val.length==6)
	 {
	   var mobile     = $('#customer_mobile').val();
	   var coupan     = $('#coupan_code').val();
	   var coupanType = $('#coupan_type').val();	   
	   $.ajax({
                type: 'post', 
			    url : "<?php echo base_url().'admin/coupon'?>",
                data: { mobile:mobile,coupan:coupan },
			    success: function(data)
		        {        
                  var response = JSON.parse(data);
			      if(response.results.length!=0)
			      { 
			        if('Amount'==response.results[0]['discount_type'])
			        {
			         $('#coupan_type').val(response.results[0]['discount_type']);
				     $('#discount').val(response.results[0]['amount']);
			         $('#payment_amount').val(parseInt(totals-response.results[0]['amount']));
				    }
			        else
			        {				     
				      $('#coupan_type').val(response.results[0]['discount_type']);
				      $('#discount').val(response.results[0]['percentage']); 
				      var per = parseFloat(totals)-parseFloat((totals/100)*response.results[0]['percentage']);
				      $('#payment_amount').val(per);
				    }
			       }
                   else	
			       {				 
				     $('#payment_error').html('<p>This coupon code is invalid or has expired.</p>');  
			         $('#payment_error').show();
				     $('#payment_error').delay(2000).fadeOut();		 
			         $('#coupan_type').val('');
				     $('#coupan_code').val('');
			       }				   
			     }
              });
	  }
	  else
	  {
		$('#coupan_type').val('');
		$('#discount').val('');
		$('#payment_amount').val(totals);
	  }
	}	
	
    function diduction(id)
	{       
	  if(id!='')
	  {	    
		var tot = $("#totals").val();
		var add = parseInt(tot)-parseInt(id);
	    $("#payment_amount").val(add);
	  }
	  else
	  {
		var tot = $("#totals").val(); 
		$("#payment_amount").val(tot);
	  }
	}
	//newly added
	function addition(id)
	{       
	  if(id!='')
	  {	    
		var payamount = $("#payment_amount").val();
		var add_package = parseFloat(payamount)+parseFloat(id);
	    $("#payment_amount").val(add_package);
	  }
	  else
	  {
	  	$("#packaging_amount").val('');
		var payamount = $("#payment_amount").val();
		$("#payment_amount").val(payamount);
	  }
	}		
	//newly added		
	
    function getbillRequest()
	{		
	 $.ajax({
             type:'post', 
			 url : "<?php echo base_url().'admin/Request'?>",
             data:{ id:'id' },
			 success: function(data)
		     {        
               var response = JSON.parse(data);					
			   var option ='';	
			   var action ="";
			   for(var i=0;i<response.results.length;i++)
			   {				
				 var ids = response.results[i]['orderid'];				
				 action = '<a class="label label-success" onclick="genretbill('+ ids +')" data-toggle="modal" data-target="#myModal">Payment</a> | <a class="label label-primary" onclick="pbill('+ ids +')" data-toggle="modal" data-target="#myModals"> Receipt </a>';
				 option+='<tr><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['orderid'] +'</td><td>'+ response.results[i]['manager_code'] +'</td><td>'+ response.results[i]['waiter_code'] +'</td><td>'+ action +'</td></tr>'
			   }
			   $('#billrequest').html(option);
             }
           });	 
	}
	
	function genretbill(id)
	{
	 $.ajax({
             type:'post', 
			 url :"<?php echo base_url().'admin/getbill'?>",
             data:{ order_id:id },
			 success: function(data)
		     {        
               var response = JSON.parse(data);					
			   var option   = ""; var options  = "";		       
			   var action   = ""; var add      = 0;	
			   var alcho    = 0;
			   
			   for(var i=0;i<response.results.length;i++)
			   {
				if('1'==response.results[i]['menu_type'])
				{
				  add += (response.results[i]['menu_price'] * response.results[i]['qty']);
				}				  
				if('2'==response.results[i]['menu_type'])
				{
				  alcho += (response.results[i]['menu_price'] * response.results[i]['qty']);  
				}				  
				option += '<tr><td>'+ response.results[i]['menu_name'] +'</td><td>'+ response.results[i]['menu_price'] +'</td><td>'+ response.results[i]['qty'] +'</td><td>'+ (response.results[i]['menu_price'] * response.results[i]['qty']) +'</td></tr>'
			   }
			   $('#subtotals').html('<tr><td colspan="3">SubTotal</td><td>'+ add +'</td></tr>');
			   $('#alchototals').html('<tr><td colspan="3">Alcohol</td><td>'+ alcho +'</td></tr>');
			   $('#customer_id').val(response.results[0]['id']);
			   $('#customer_name').val(response.results[0]['customer_name']);
			   $('#customer_email').val(response.results[0]['customer_email']);
			   $('#customer_mobile').val(response.results[0]['customer_mobile']);
			   $('#billrequests').html(option);
			   $('#orderid').val(id);
			   $.ajax({
                       type:'post', 
			           url :"<?php echo base_url().'admin/getTax'?>",
                       data:{ order_id:id },
			           success: function(data)
		               {        
                        var add1     = '';				          
				        var add2     = '';
						var add3     = '';						   
						var response = JSON.parse(data);	
						for(var j=0;j<response.results.length;j++)
			            {	                         
				          if('1' == response.results[j]['menu_type'])
						  {
							if('CGST'==response.results[j]['tax_name'])
							{
							 add1 += parseFloat((add/100)*response.results[j]['tax_percentage']).toFixed(2);
							 options += '<tr><td>'+ response.results[j]['tax_name'] +' ('+ response.results[j]['tax_percentage']+' %)</td><td></td><td></td><td>'+ ((add/100)*response.results[j]['tax_percentage']).toFixed(2) +'</td></tr>'
							}							   
							if('SGST'==response.results[j]['tax_name'])
							{ 							    
							 add3 += parseFloat((add/100)*response.results[j]['tax_percentage']).toFixed(2);
							 options += '<tr><td>'+ response.results[j]['tax_name'] +' ('+ response.results[j]['tax_percentage']+' %)</td><td></td><td></td><td>'+ ((add/100)*response.results[j]['tax_percentage']).toFixed(2) +'</td></tr>'
							}
						   }							 
						   if('2' == response.results[j]['menu_type'])
						   {
							add2 += parseFloat((alcho/100)*response.results[j]['tax_percentage']).toFixed(2);
							options += '<tr><td>'+ response.results[j]['tax_name'] +' ('+ response.results[j]['tax_percentage']+' %)</td><td></td><td></td><td>'+ ((alcho/100)*response.results[j]['tax_percentage']).toFixed(2) +'</td></tr>' 
						   }
						   else
						   {
							 add2=0; 
						   }
						}
						var adds = Math.round(parseFloat(add) + parseFloat(add1) + parseFloat(add3) + parseFloat(add2));  
						var amount = parseInt(parseInt(adds) + parseInt(alcho));
						$('#taxbills').html(options);						   
						$('#total').html('<tr><td colspan="3">Total</td><td>'+ amount +'</td></tr>');
						$('#totals').val(amount);
						$("#payment_amount").val(amount);						   
						$('#cgst').val(add1);
						$('#sgst').val(add3);
						$('#vat').val(add2);						 
						$('#coupan_type').val('');
				        $('#coupan_code').val('');	
						$('#discount').val('');	
					   }						 
				     });				   
                }
           });	
	}
    
	function pbill(id)
	{      
	  $.ajax({
               type:'post', 
			   url :"<?php echo base_url().'admin/getbill'?>",
               data:{ order_id:id },
			   success: function(data)
		       {        
                 var response = JSON.parse(data);					
			     var option   = ""; var options  = "";					
			     var action   = ""; var add      = 0;			    
				 var alcho    = 0; var d = new Date();
                 var strDate = d.getFullYear() + "-" + (d.getMonth()+1) +"-"+ d.getDate();
				 var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
				 var billno  = "TblNo : <span>"+ response.results[0]['table_number']+"</span>";
				 var date    = "&nbsp;Date : <span>"+ strDate +"<span>";
				 var billno1 = "OrdNo : <span>"+ response.results[0]['orderid']+"</span>";
				 var time    = "&nbsp;Time :<span>"+ time +"</span>";			
				 for(var i=0;i<response.results.length;i++)
			     {
	               if('1'==response.results[i]['menu_type'])
				   {
					 add += (response.results[i]['menu_price'] * response.results[i]['qty']);
				   }				  
				   if('2'==response.results[i]['menu_type'])
				   {
					 alcho += (response.results[i]['menu_price'] * response.results[i]['qty']);  
				   }				  
				   option += '<tr class="service"><td class="tableitem"><p class="itemtext">'+ response.results[i]['menu_name'] +'</p></td><td class="tableitem"><p class="itemtext">'+ response.results[i]['qty'] +'</p></td><td class="tableitem"><p class="itemtext">'+ response.results[i]['menu_price'] +'</td><td class="tableitem"><p class="itemtext">'+ (response.results[i]['menu_price'] * response.results[i]['qty']) +'</p></td></tr>'
	             }                 
			     $.ajax({
                          type:'post', 
			              url :"<?php echo base_url().'admin/getTax'?>",
                          data:{ order_id:id },
			              success: function(data)
		                  {        
                            var add1 = '';				          
				            var add2 = '';
						    var add3 = '';						   
						    var response = JSON.parse(data);	
						    for(var j=0;j<response.results.length;j++)
			                {	                         
				              if('1' == response.results[j]['menu_type'])
							  {
							    if('CGST'==response.results[j]['tax_name'])
							    {
								  add1 += parseFloat((add/100)*response.results[j]['tax_percentage']).toFixed(2);
							      options += '<tr class="service"><td class="tableitem" colspan="3"><p class="itemtext"><strong>'+ response.results[j]['tax_name'] +' ('+ response.results[j]['tax_percentage']+' %)</strong></p></td><td class="tableitem"><p class="itemtext"><strong>'+ ((add/100)*response.results[j]['tax_percentage']).toFixed(2) +'</strong></p></td></tr>'
							    }							   
							    if('SGST'==response.results[j]['tax_name'])
							    { 							    
								  add3 += parseFloat((add/100)*response.results[j]['tax_percentage']).toFixed(2);
							      options += '<tr class="service"><td class="tableitem" colspan="3"><p class="itemtext"><strong>'+ response.results[j]['tax_name'] +' ('+ response.results[j]['tax_percentage']+' %)</strong></p></td><td class="tableitem"><p class="itemtext"><strong>'+ ((add/100)*response.results[j]['tax_percentage']).toFixed(2) +'</strong></p></td></tr>'
							    }
							  }							 
							  if('2' == response.results[j]['menu_type'])
							  {
							    add2 += parseFloat((alcho/100)*response.results[j]['tax_percentage']).toFixed(2);
							    options += '<tr class="service"><td class="tableitem" colspan="3"><p class="itemtext"><strong>'+ response.results[j]['tax_name'] +' ('+ response.results[j]['tax_percentage']+' %)</strong></p></td><td class="tableitem"><p class="itemtext"><strong>'+ ((alcho/100)*response.results[j]['tax_percentage']).toFixed(2) +'</strong></p></td></tr>' 
							  }
							  else
							  {								 
							    add2=0; 
							  }
						    }
						    var adds = Math.round(parseFloat(add) + parseFloat(add1) + parseFloat(add3) + parseFloat(add2));  
						    var amount = parseInt(parseInt(adds) + parseInt(alcho));
						    $('#taxbillss').html(options);						   
						    $('#total').html('<tr class="service"><td colspan="3" class="tableitem"><p class="itemtext"><strong>Total</strong></p></td><td class="tableitem"><p class="itemtext"><strong>'+ amount +'</strong></p></td></tr>');
						    $('#totalbill').html('<tr class="service"><td colspan="3" class="tableitem"><strong>Total</strong></td><td class="tableitem"><p class="itemtext"><strong>'+ parseFloat(parseFloat(adds)+parseFloat(alcho)) +'</strong></p></td></tr>');
						   }						 
				         });
				     $('#subtotalsb').html('<tr class="service"><td colspan="3" class="tableitem"><p class="itemtext">SubTotal</p></td><td class="tableitem"><p class="itemtext">'+ add +'</p></td></tr>');
			         $('#alchototalsb').html('<tr class="service"><td colspan="3" class="tableitem"><p class="itemtext">Alcohol</p></td><td class="tableitem"><p class="itemtext">'+ alcho +'</p></td></tr>');
				     //$('#totalbill').html('<tr class="service"><td colspan="3" class="tableitem"><p class="itemtext">Total</p></td><td class="tableitem"><p class="itemtext">'+ parseFloat(parseFloat(add)+parseFloat(alcho)) +'</p></td></tr>');
			         $('#bills').html(option);
				     //alert(response.results[0]['branch_address']);
				     $('#restaurant_name').html('<span>'+response.results[0]['branch_name']+'</span>');
				     $('#address').html('<span>'+response.results[0]['branch_address']+'</span>');				  
				     $('#billtableno').html(billno);
				     $('#billtabledate').html(date);
				     $('#billtablenos').html(billno1);
				     $('#billtabletime').html(time);
			    }			  
             });  
	 }
	
	 function pbill1(id)
	{      
	  $.ajax({
               type:'post', 
			   url :"<?php echo base_url().'admin/getbill5'?>",
               data:{ order_id:id },
			   success: function(data)
		       {        
                 var response = JSON.parse(data);					
			     var option   = ""; var options  = "";					
			     var action   = ""; var add      = 0;			    
				 var alcho    = 0; var d = new Date();
                 var strDate = d.getFullYear() + "-" + (d.getMonth()+1) +"-"+ d.getDate();
				 var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
				 var billno  = "TableNo : <span>"+ response.results[0]['table_number']+"</span>";
				 var date    = "&nbsp;Date : <span>"+ strDate +"<span>";
				 var billno1 = "OrderNo : <span>"+ response.results[0]['orderid']+"</span>";
				 var time    = "&nbsp;Time :<span>"+ time +"</span>";
				 var package_amount = document.getElementById('packaging_amount').value;
				 var discount = document.getElementById('discount').value;	
				 for(var i=0;i<response.results.length;i++)
			     {
	               if('1'==response.results[i]['menu_type'])
				   {
					 add += (response.results[i]['menu_price'] * response.results[i]['qty']);
				   }				  
				   if('2'==response.results[i]['menu_type'])
				   {
					 alcho += (response.results[i]['menu_price'] * response.results[i]['qty']);  
				   }				  
				   option += '<tr class="service"><td class="tableitem"><p class="itemtext">'+ response.results[i]['menu_name'] +'</p></td><td class="tableitem"><p class="itemtext">'+ response.results[i]['qty'] +'</p></td><td class="tableitem"><p class="itemtext">'+ response.results[i]['menu_price'] +'</td><td class="tableitem"><p class="itemtext">'+ (response.results[i]['menu_price'] * response.results[i]['qty']) +'</p></td></tr>'
	             }                 
			     $.ajax({
                          type:'post', 
			              url :"<?php echo base_url().'admin/getTax'?>",
                          data:{ order_id:id },
			              success: function(data)
		                  {        
                            var add1 = '';				          
				            var add2 = '';
						    var add3 = '';
						    var package_amount = document.getElementById('packaging_amount').value;
						    var discount = document.getElementById('discount').value;

						    var response = JSON.parse(data);	
						    for(var j=0;j<response.results.length;j++)
			                {	                         
				              if('1' == response.results[j]['menu_type'])
							  {
							    if('CGST'==response.results[j]['tax_name'])
							    {
								  add1 += parseFloat((add/100)*response.results[j]['tax_percentage']).toFixed(2);
							      options += '<tr class="service"><td class="tableitem" colspan="3"><p class="itemtext"><strong>'+ response.results[j]['tax_name'] +' ('+ response.results[j]['tax_percentage']+' %)</strong></p></td><td class="tableitem"><p class="itemtext"><strong>'+ ((add/100)*response.results[j]['tax_percentage']).toFixed(2) +'</strong></p></td></tr>'
							    }							   
							    if('SGST'==response.results[j]['tax_name'])
							    { 							    
								  add3 += parseFloat((add/100)*response.results[j]['tax_percentage']).toFixed(2);
							      options += '<tr class="service"><td class="tableitem" colspan="3"><p class="itemtext"><strong>'+ response.results[j]['tax_name'] +' ('+ response.results[j]['tax_percentage']+' %)</strong></p></td><td class="tableitem"><p class="itemtext"><strong>'+ ((add/100)*response.results[j]['tax_percentage']).toFixed(2) +'</strong></p></td></tr>'
							    }
							  }							 
							  if('2' == response.results[j]['menu_type'])
							  {
							    add2 += parseFloat((alcho/100)*response.results[j]['tax_percentage']).toFixed(2);
							    options += '<tr class="service"><td class="tableitem" colspan="3"><p class="itemtext"><strong>'+ response.results[j]['tax_name'] +' ('+ response.results[j]['tax_percentage']+' %)</strong></p></td><td class="tableitem"><p class="itemtext"><strong>'+ ((alcho/100)*response.results[j]['tax_percentage']).toFixed(2) +'</strong></p></td></tr>' 
							  }
							  else
							  {								 
							    add2=0; 
							  }
						    }
						    var adds = Math.round(parseFloat(add) + parseFloat(add1) + parseFloat(add3) + parseFloat(add2));  
						    var amount = parseInt(parseInt(adds) + parseInt(alcho));
						    $('#taxbillss1').html(options);						   
						    $('#total').html('<tr class="service"><td colspan="3" class="tableitem"><p class="itemtext"><strong>Total</strong></p></td><td class="tableitem"><p class="itemtext"><strong>'+ amount +'</strong></p></td></tr>');
						    if(discount === ''){
						    	$('#totalbill1').html('<tr class="service"><td colspan="3" class="tableitem"><strong>Total</strong></td><td class="tableitem"><p class="itemtext"><strong>'+ parseFloat(parseFloat(adds)+parseFloat(alcho)+parseFloat(package_amount)) +'</strong></p></td></tr>');
						    }else if(package_amount === ''){
						    	$('#totalbill1').html('<tr class="service"><td colspan="3" class="tableitem"><strong>Total</strong></td><td class="tableitem"><p class="itemtext"><strong>'+ parseFloat((parseFloat(adds)+parseFloat(alcho))-parseFloat(discount)) +'</strong></p></td></tr>');
						    }else{
						    	$('#totalbill1').html('<tr class="service"><td colspan="3" class="tableitem"><strong>Total</strong></td><td class="tableitem"><p class="itemtext"><strong>'+ parseFloat((parseFloat(adds)+parseFloat(alcho)+parseFloat(package_amount))-parseFloat(discount)) +'</strong></p></td></tr>');
						    }
						   }						 
				         });
				     $('#subtotalsb1').html('<tr class="service"><td colspan="3" class="tableitem"><p class="itemtext">SubTotal</p></td><td class="tableitem"><p class="itemtext">'+ add +'</p></td></tr>');
			         $('#alchototalsb1').html('<tr class="service"><td colspan="3" class="tableitem"><p class="itemtext">Alcohol</p></td><td class="tableitem"><p class="itemtext">'+ alcho +'</p></td></tr>');
			         $('#packaging_amount1').html('<tr class="service"><td colspan="3" class="tableitem"><p class="itemtext">Packaging Amount</p></td><td class="tableitem"><p class="itemtext">'+ package_amount +'</p></td></tr>');
			         $('#discount1').html('<tr class="service"><td colspan="3" class="tableitem"><p class="itemtext">Coupon Discount</p></td><td class="tableitem"><p class="itemtext">'+ discount +'</p></td></tr>');
				     //$('#totalbill').html('<tr class="service"><td colspan="3" class="tableitem"><p class="itemtext">Total</p></td><td class="tableitem"><p class="itemtext">'+ parseFloat(parseFloat(add)+parseFloat(alcho)) +'</p></td></tr>');
			         $('#bills1').html(option);
				     //alert(response.results[0]['branch_address']);
				     $('#restaurant_name1').html('<span>'+response.results[0]['branch_name']+'</span>');
				     $('#address1').html('<span>'+response.results[0]['branch_address']+'</span>');				  
				     $('#billtableno1').html(billno);
				     $('#billtabledate1').html(date);
				     $('#billtablenos1').html(billno1);
				     $('#billtabletime1').html(time);		  
			    }			  
             });  
	 }
		
	 function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}
		
	 function paymentsave()
	 {
	   var customer_id     = $("#customer_id").val();	  
	   var customer_name   = $("#customer_name").val();
	   var customer_mobile = $("#customer_mobile").val();
	   var customer_email  = $("#customer_email").val();
	   var totals          = $("#totals").val();
	   var orderid         = $("#orderid").val();
	   var payment_mode    = $("#payment_mode").val();      
	   var cgst            = $("#cgst").val();
	   var sgst            = $("#sgst").val();
	   var vat             = $("#vat").val();
       var couptype        = $("#coupan_type").val();
	   var coupan_code     = $("#coupan_code").val();  
	   var discount        = $("#discount").val();
	   var packaging_amount = $("#packaging_amount").val();
	   var payment_amount  = $("#payment_amount").val();
	   $.ajax({
                type:'post', 
			    url :"<?php echo base_url().'admin/savebill'?>",
                data:{ 
			           customer_id     : customer_id,
					   customer_name   : customer_name, 
					   customer_mobile : customer_mobile,
					   customer_email  : customer_email,
					   totals          : totals,
					   orderid         : orderid,
					   payment_mode    : payment_mode,					 
					   cgst            : cgst,
					   sgst            : sgst,
					   vat             : vat,
					   couptype        : couptype,  
					   coupan_code     : coupan_code,
					   discount        : discount,
					   packaging_amount: packaging_amount,
					   payment_amount  : payment_amount
				    },
			        success: function(data)
		            {        
                      var response = JSON.parse(data);				
				      if(response.status=="error")
				      {
				        $('#payment_error').html(response.errors);
				        $('#payment_error').show();
				        $('#payment_error').delay(2000).fadeOut();					  
				      }
				      else
				      {	
                         if(coupan_code!='' || packaging_amount!='')
					     {
					    	$('#myModals1').modal('show');
					    	pbill1(orderid);					    		
					     } 
					     else
					     {
					     	$('#payment_success').html(response.status);
				            $('#payment_success').show();
				            $('#payment_success').delay(2000).fadeOut();								 
				            $('#myModal').modal('hide');
					        getbillRequest();
					     }
				        				    
					  }				
                    }
              });	
	 }	
   </script> 