    <section class="content-header">
      <h1> Report Staff </h1>
      <ol class="breadcrumb">
       <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-dashboard"></i> Home</a></li>
       <li class="active"> Report Staff </li>
      </ol>
    </section>
	<!-- Main content -->
    <section class="content">      
      <div class="box box-default">        
		<div class="box-header with-border">         
         <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div>
        </div> 		
        <div class="box-body">
         <div class="row"> 
		  <form method="post" action="<?php echo base_url().'admin/reportWaiter'; ?>">
           <div class="col-md-12">
			<div class="form-group">			  
			  <div class="col-md-4">
               <label>Branch Name</label>               
			   <select name="branch_id" id="branch_id" class="form-control">				
				<?php         
                 if($userdata['roles']=='manager'){
                  foreach($branch as $val){
                    if($val['id']==$userdata['branch_id']){
                    ?>           
                      <option value="<?php echo $val['id']; ?>"><?php echo $val['branch_name']; ?></option>
                    <?php 
                     }else{ continue; }
                   }
                 }
                 else
                 { ?>
                  <option value="">select</option>
                 <?php 
                   foreach($branch as $val){ ?>
                       <option value="<?php echo $val['id']; ?>"><?php echo $val['branch_name']; ?></option>
                   <?php }
                 }
               ?> 
			   </select>
			  </div>
			  <div class="col-md-4">
               <label>Roles</label>               
			   <select name="roles" id="roles" class="form-control" onchange="roless(this.value)">
				<option value="">select</option>
				<option value="waiter">Waiter</option>				
			   </select>
			  </div>
			  <div class="col-md-4">
               <label>Waiter / Chef Code</label>               
			   <select name="ids" id="ids" class="form-control">							
			   </select>
			  </div>			  
            </div>			
			<div class="form-group">
			  <div class="col-md-4">
			    <label>From Date</label>               
			    <div class="input-group date">
                 <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                 </div>
                 <input type="text" class="form-control pull-right datepicker" id="from_date" name="from_date" required>
                </div>
			  </div>	
			  <div class="col-md-4">
			   <label>To Date</label>               
			   <div class="input-group date">
                <div class="input-group-addon">
                 <i class="fa fa-calendar"></i>
                </div>
				<input type="text" class="form-control pull-right datepicker" name="to_date" id="to_date" required>
			   </div>
			  </div>
			  <div class="col-md-4">			  
			  </div>			  
			</div>			
			<div class="col-md-12"><br></div>
           </div>
		   <div class="col-md-12" align="center">		
		    <input type="submit" name="submit" value="Download" class="btn btn-success"> 
		   </div>
		  </form> 
         </div>
        </div>	  
	   </div>
      </section>
	  <script>
	   function roless(val)
	   {		
		 var roles    = val;
		 var branchid = $('#branch_id').val();
		 $.ajax({
                  type:'POST', 
				  url :"<?php echo base_url().'admin/getwaiterRecord' ?>",
                  data:{ 
				         roles    : roles,
				         branchid : branchid
				       },
					   success: function(data)
		               {        
                         var response = JSON.parse(data);
					     if('waiter' == response.results[0]['roles'])
					     {							
						   var option ='<option value="">select</option>';	
						   for(var i=0;i<response.results.length;i++)
					       { 
						     option+='<option value="'+ response.results[i]['id'] +'">'+ response.results[i]['waiter_code'] +'</option>'  
					       }
						   $('#ids').html(option);
					     }
					     else
					     {						
						   var option ='<option value="">select</option>';	
						   for(var i=0;i<response.results.length;i++)
					       {	 
						     option+='<option value="'+ response.results[i]['id'] +'">'+ response.results[i]['chef_code'] +'</option>'  
					       }
						   $('#ids').html(option);
					     }						
                       }
                });
	    }
	  </script>
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
                   <th>Branch Name</th>
                   <th>Table No</th>
                   <th>Order Id</th>           
                   <th>Manager Code</th>
                   <th>Waiter Code</th>
                   <th>Order Date/Time</th>
                 </tr>
                </thead>
                <tbody id="get_item">
                 
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
        url : "<?php echo base_url().'admin/getWaiterReport'?>",
              data:{ id:'id' },
        success: function(data)
          {        
                var response = JSON.parse(data);          
          var option =''; 
          var action = '';
          for(var i=0;i<response.results.length;i++)
          {
             option+='<tr><td>'+ (i+1) +'</td><td>'+ response.results[i]['branch_name'] +'</td><td>'+ response.results[i]['table_number'] +'</td><td>'+ response.results[i]['orderid'] +'</td><td>'+ response.results[i]['manager_code'] +'</td><td>'+ response.results[i]['waiter_code'] +'</td><td>'+ response.results[i]['created_at'] +'</td></tr>'
          }
          $('#get_item').html(option);
              }
           });     
   }  
  </script> 