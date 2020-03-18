<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Restaurant</title>  
  <!--Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!--Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  <!--Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
  <!--Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ionicons.min.css">
  <!--daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.css">
  <!--bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css">
  <!--iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/all.css">
  <!----------plus minus quantity---------------->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/quantity.css">
  <!--Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-colorpicker.min.css">
  <!--Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-timepicker.min.css">
  <!--Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.min.css">  
  <!--Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">  
  <!--AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/_all-skins.min.css">
  <!--Google Font-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/morris.css">  
  <!--jQuery 3-->
  <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/raphael-min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/morris.min.js"></script>
  <script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
  <script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <style>
    input[type="file"] {
      display: block;
    }
   .imageThumb {
      max-height: 75px;
      border: 2px solid;
      padding: 1px;
      cursor: pointer;
    }
   .pip {
      display: inline-block;
      margin: 10px 10px 0 0;
    }
   .remove {
      display: block;
      background: #444;
      border: 1px solid black;
      color: white;
      text-align: center;
      cursor: pointer;
    }
   .remove:hover {
      background: white;
      color: black;
   }
   #invoice-POS {
     box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
     padding: 2mm;
     margin: 0 auto;
     /*width: 44mm;*/
	 width: 60mm;
     background: #fff;
   }
   #invoice-POS ::selection {
     background: #f31544;
     color: #fff;
   }
   #invoice-POS ::moz-selection {
     background: #f31544;
     color: #fff;
   }
   #invoice-POS h1 {
     font-size: 1.5em;
     color: #222;
   }
   #invoice-POS h2 {
     font-size: 0.9em;
   }
   #invoice-POS h3 {
     font-size: 1.2em;
     font-weight: 300;
     line-height: 2em;
   }
   #invoice-POS p {
      font-size: 0.7em;
      color: #666;
      line-height: 1.2em;
   }
   #invoice-POS #top,
   #invoice-POS #mid,
   #invoice-POS #bot {
      /* Targets all id with 'col-' */
      border-bottom: 1px solid #eee;
   }
   #invoice-POS #top {
     /*min-height: 100px;*/
     min-height: 30px;
   }
   #invoice-POS #mid {
     /*min-height: 80px;*/
     min-height: 30px;
   }
   #invoice-POS #bot {
      min-height: 50px;
   } 
   #invoice-POS #top .logo {
      height: 60px;
      width: 60px;
      background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
      background-size: 60px 60px;
    }
    #invoice-POS .clientlogo {
       float: left;
       height: 60px;
       width: 60px;
       background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
       background-size: 60px 60px;
       border-radius: 50px;
    }
    #invoice-POS .info {
      display: block;
      margin-left: 0;
    }
    #invoice-POS .title {
       float: right;
    }
    #invoice-POS .title p {
      text-align: right;
    }
    #invoice-POS table {
      width: 100%;
      border-collapse: collapse;
    }
    #invoice-POS .tabletitle {
      /*font-size: 0.5em;*/
      font-size: 0.6em;
      background: #eee;
    }
    #invoice-POS .service {
      border-bottom: 1px solid #eee;
    }
    #invoice-POS .item {
      width: 24mm;
    }
    #invoice-POS .itemtext {
      font-size: 0.5em;
    }
    #invoice-POS #legalcopy {
      margin-top: 5mm;
    } 
   .panel-group .panel {
        border-radius: 0;
        box-shadow: none;
        border-color: #EEEEEE;
    }
    .panel-default > .panel-heading {
        padding: 0;
        border-radius: 0;
        color: #212121;
        background-color: #FAFAFA;
        border-color: #EEEEEE;
    }
    .panel-title {
        font-size: 14px;
    }
    .panel-title > a {
        display: block;
        padding: 15px;
        text-decoration: none;
    }
    .more-less {
        float: right;
        color: #212121;
    } 

    .input-sm{
      border-radius: 0px;
    }
    .collapse.in{
      display: flex;
      justify-content: center;
    }
  </style>
 </head>
<?php if('chef'==$userdata['roles']){ ?>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<?php  }else{ ?>
<body class="hold-transition skin-blue sidebar-mini">
<?php } ?>
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url().'admin/dashboard'; ?>" class="logo">     
      <span class="logo-mini"><b style="color: #8B0000;">RP</b></span>     
      <span class="logo-lg"><b> <span style="color: #8B0000;">R</span>estaurant<span style="color: #8B0000;">P</span>ortal</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="user-footer">
            <div class="pull-center" align="center" style="margin-top: 8px;">
              <a href="<?php echo base_url(); ?>admin/logoutadmin" class="btn btn-danger btn-sm">Sign out</a>
            </div>
          </li>  
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $userdata['roles']; ?></span>
            </a>
            <ul class="dropdown-menu">             
              <li class="user-header">
                <img src="<?php echo base_url(); ?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
                 <?php if("admin"==$userdata['roles'])
				         {
				           echo 'Admin';                 
                 }
				        else if("manager"==$userdata['roles'])
				        {
					        echo  $userdata['manager_name'].' - '.$userdata['roles'];
				        }
				        else if("waiter"==$userdata['roles'])
				       {
					       echo  $userdata['waiter_name'].' - '.$userdata['roles'];
				       }
				       else if("chef"==$userdata['roles'])
				       {
					       echo  $userdata['chef_name'].' - '.$userdata['roles'];
				       } 					   
				       else
				       {						   
				       }
				     ?> 
				   </p>
         </li>
         <!-- Menu Body -->              
         <!-- Menu Footer-->         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
         <p>
		     <?php 
			    if("admin"==$userdata['roles'])
			   	{
				     echo 'Admin';                 
          }
				  else if("manager"==$userdata['roles'])
				 {
				   echo ucfirst($userdata['manager_name']);
				}
				else if("waiter"==$userdata['roles'])
				{
				  echo ucfirst($userdata['waiter_name']);
				}
				else if("chef"==$userdata['roles'])
				{
				  echo ucfirst($userdata['chef_name']);
				}				
				else
				{						   
				}
			 ?>
		  </p>         
     </div>
    </div>      
      <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
       <?php if($userdata['roles']=='manager' || $userdata['roles']=='admin')
	      {
	      ?>
	      <li class="treeview">
         <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-circle-o"></i>Dashboard</a></li>           
        </ul>
      </li>  	   
	   <?php 
	   } 
	   ?>
	   
	   <?php if($userdata['roles']=='manager' || $userdata['roles']=='admin') { ?>	   
	   <li class="treeview">
      <a href="#">
         <i class="fa fa-laptop"></i> <span>Master</span>
         <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
         </span>
     </a>
     <ul class="treeview-menu"> 
	  <?php } ?>
	  
	  <?php if($userdata['roles']!='manager' && $userdata['roles']!='waiter' && $userdata['roles']!='chef'){?> 
		<li class="treeview">
      <a href="#">
        <i class="fa fa-laptop"></i>
        <span>Branch</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <?php if($userdata['roles']=='admin'){ ?> 
			    <li><a href="<?php echo base_url().'admin/newbranch' ?>"><i class="fa fa-circle-o"></i> New Branch</a></li>
          <li><a href="<?php echo base_url().'admin/viewbranch' ?>"><i class="fa fa-circle-o"></i> View Branch</a></li>
		    <?php } ?>
      </ul>
    </li>
		
		<li class="treeview">
      <a href="#">
       <i class="fa fa-laptop"></i>
        <span>Manager</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>
      <ul class="treeview-menu">
       <?php if($userdata['roles']=='admin'){ ?>	
			  <li><a href="<?php echo base_url().'admin/newmanager' ?>"><i class="fa fa-circle-o"></i> New Manager</a></li>
        <li><a href="<?php echo base_url().'admin/viewmanager' ?>"><i class="fa fa-circle-o"></i> View Manager</a></li>
       <?php } ?>
      </ul>
     </li>
	  <?php } ?>
	   
	  <?php if($userdata['roles']!='waiter' && $userdata['roles']!='chef'){ ?> 
		 <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Waiter</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <?php if($userdata['roles']=='manager'){ ?> 
			       <li><a href="<?php echo base_url().'admin/newwaiter' ?>"><i class="fa fa-circle-o"></i> New Waiter</a></li>
           <?php } ?>
		       <?php if($userdata['roles']=='admin' || $userdata['roles']=='manager'){ ?> 
		       	<li><a href="<?php echo base_url().'admin/viewwaiter' ?>"><i class="fa fa-circle-o"></i> View Waiter</a></li>
		       <?php } ?>
          </ul>
      </li>		
		  <!--<li class="treeview">
        <a href="#">
         <i class="fa fa-laptop"></i>
          <span>Chef</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
       </a>
       <ul class="treeview-menu">
        <?php if($userdata['roles']=='manager'){ ?> 			
			   <li><a href="<?php echo base_url().'admin/newchef' ?>"><i class="fa fa-circle-o"></i> New Chef</a></li>
         <?php } ?> 
		     <?php if($userdata['roles']=='admin' || $userdata['roles']=='manager'){ ?> 
			    <li><a href="<?php echo base_url().'admin/viewchef' ?>"><i class="fa fa-circle-o"></i> View Chef</a></li>
        <?php } ?> 
       </ul>
     </li>-->
	   <?php } ?>	   
	   <?php if($userdata['roles']=='admin' || $userdata['roles']=='manager'){ ?>         
	  	<li class="treeview">
        <a href="#">
         <i class="fa fa-laptop"></i>
          <span>Tax</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
        </a>
        <ul class="treeview-menu">           			
			     <li><a href="<?php echo base_url().'admin/newtax' ?>"><i class="fa fa-circle-o"></i>New Tax</a></li>
           <li><a href="<?php echo base_url().'admin/viewtax' ?>"><i class="fa fa-circle-o"></i>View Tax</a></li>
        </ul>
      </li>
     <?php } ?>
      
     <?php if($userdata['roles']=='manager'){ ?> 
      <li class="treeview">
        <a href="#">
         <i class="fa fa-laptop"></i>
         <span>Table</span>
         <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
         </span>
       </a>
       <ul class="treeview-menu">           			
			   <li><a href="<?php echo base_url().'admin/newtable' ?>"><i class="fa fa-circle-o"></i> New Table</a></li>
         <li><a href="<?php echo base_url().'admin/viewtable' ?>"><i class="fa fa-circle-o"></i> View Table</a></li>
       </ul>
     </li>
    <?php } ?>	 
	   
    <?php if($userdata['roles']=='admin' || $userdata['roles']=='manager'){ ?> 
     <li class="treeview">
      <a href="#">
        <i class="fa fa-laptop"></i>
         <span>Menu</span>
         <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
         </span>
      </a>
      <ul class="treeview-menu">           			
			  <li><a href="<?php echo base_url().'admin/newmenu' ?>"><i class="fa fa-circle-o"></i> New Menu</a></li>
        <li><a href="<?php echo base_url().'admin/viewmenu' ?>"><i class="fa fa-circle-o"></i> View Menu</a></li>
      </ul>
     </li>
    <?php } ?> 	   
    </ul>	   
	   	  
	  <?php if($userdata['roles']=='manager' || $userdata['roles']=='admin'){ ?>
	   <li class="treeview">
      <a href="#">
       <i class="fa fa-laptop"></i> <span>Customer</span>
        <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
        </span>
     </a>
     <ul class="treeview-menu">
		  <?php if($userdata['roles']=='admin' || $userdata['roles']=='manager'){ ?> 
       <li class="treeview">
        <a href="#">
         <i class="fa fa-laptop"></i>
          <span>view Customer</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
       </a>
       <ul class="treeview-menu">		  
		    <?php if($userdata['roles']=='admin' || $userdata['roles']=='manager'){ ?> 
			   <li><a href="<?php echo base_url().'admin/viewcustomer' ?>"><i class="fa fa-circle-o"></i>View Customer</a></li>
         <?php } ?> 
       </ul>
      </li>
		  <?php	} ?>		   
      </ul>
     </li>  	   
	   <?php } ?>
	   
	   <?php if($userdata['roles']=='manager' || $userdata['roles']=='admin'){ ?>
	    <li class="treeview">
        <a href="#">
          <i class="fa fa-laptop"></i> <span>Order</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
		     <?php if($userdata['roles']=='admin' || $userdata['roles']=='manager'){ ?> 
          <li class="treeview">
            <a href="#">
             <i class="fa fa-laptop"></i>
             <span>All Order</span>
              <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">		  
		         <?php if($userdata['roles']=='admin' || $userdata['roles']=='manager'){ ?>
               <li><a href="<?php echo base_url().'admin/viewtodayorder' ?>"><i class="fa fa-circle-o"></i><?php echo @date('d-m-Y'); ?> Order</a></li> 
			         <li><a href="<?php echo base_url().'admin/viewallorder' ?>"><i class="fa fa-circle-o"></i>All Order View</a></li>
            <?php } ?> 
            </ul>
         </li>
		     <?php	} ?>
        </ul>
      </li>  	   
	   <?php } ?>
	   
	   <?php if($userdata['roles']=='manager' || $userdata['roles']=='admin'){ ?>
	    <li class="treeview">
         <a href="#">
          <i class="fa fa-laptop"></i> <span>Payment</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
         </a>
         <ul class="treeview-menu">
		      <?php if($userdata['roles']=='admin' || $userdata['roles']=='manager'){ ?> 
           <li class="treeview">
            <a href="#">
              <i class="fa fa-laptop"></i>
               <span>Received Payment</span>
               <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url().'admin/viewtodaypayment' ?>"><i class="fa fa-circle-o"></i><?php echo @date('d-m-Y'); ?> Payment</a></li>           			
		           <li><a href="<?php echo base_url().'admin/viewpayment' ?>"><i class="fa fa-circle-o"></i>View Payment</a></li>
            </ul>
           </li>
		      <?php	} ?>
        </ul>
       </li>  	   
	   <?php  }  ?>

     <?php if($userdata['roles']=='manager'){ ?>
       <li class="treeview">
         <a href="#">
          <i class="fa fa-laptop"></i><span> Coupons </span>
          <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
          </span>
         </a>        
        <ul class="treeview-menu">                 
          <li><a href="<?php echo base_url().'admin/newCoupons' ?>"><i class="fa fa-circle-o"></i>Create Coupons</a></li>
          <li><a href="<?php echo base_url().'admin/viewCoupons' ?>"><i class="fa fa-circle-o"></i>Manage Coupons</a></li>       
        </ul>
      </li> 
     <?php } ?> 

      
	   <?php if($userdata['roles']=='manager' || $userdata['roles']=='admin'){ ?>
	    <li class="treeview">
         <a href="#">
          <i class="fa fa-laptop"></i> <span>All Report</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
         </a>
         <ul class="treeview-menu">
		      <?php if($userdata['roles']=='admin' || $userdata['roles']=='manager'){ ?> 
           <li class="treeview">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>Report</span>
              <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">  
              <li><a href="<?php echo base_url().'admin/itemReport' ?>"><i class="fa fa-circle-o"></i>Sale By Item</a></li>
              <li><a href="<?php echo base_url().'admin/consolidatedReport' ?>"><i class="fa fa-circle-o"></i>Sale By Category</a></li>               
              <li><a href="<?php echo base_url().'admin/paymentReport' ?>"><i class="fa fa-circle-o"></i>Payment Report</a></li>
              <li><a href="<?php echo base_url().'admin/maximumReport' ?>"><i class="fa fa-circle-o"></i>Maximum Food Report</a></li>
              <li><a href="<?php echo base_url().'admin/waiterchefReport' ?>"><i class="fa fa-circle-o"></i>Waiter Report</a></li>
              <li><a href="<?php echo base_url().'admin/customerReport' ?>"><i class="fa fa-circle-o"></i>Customer Report</a></li>
            </ul>
          </li>
		     <?php	} ?>
        </ul>
       </li>  	   
	     <?php } ?>
	    </ul>
     </li>	 
    </section>
    <!-- sidebar -->
  </aside>
  <div class="content-wrapper"> 