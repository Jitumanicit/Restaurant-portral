<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Restaurant</title> 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/blue.css">  
  <!-- jQuery 3 -->
  <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>"><b> <span style="color: #8B0000;">R</span>estaurant<span style="color: #8B0000;">P</span>ortal</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><b>Login</b></p>
    <?php 
	if($msg!='' || $msg1!='' || $msg2!='')
	{				  
      echo '<script>$(document).ready(function(){ success(); });</script>'; 
	?>
    <div class="alert alert-danger" id="successmsg" role="alert"> <?php if($msg!='' && $msg1!='' && $msg2!=''){ echo "Please enter your correct username and password.";  }else{ if($msg!=''){ echo $msg."<br>";} if($msg1!=''){ echo $msg1."<br>";} if($msg2!=''){ echo $msg2."<br>";} } ?></div>
	<?php			 
	} 
	?>
    <form action="<?php echo base_url().'admin/loginverify'?>" method="post">
      
	  <div class="form-group has-feedback">
        <select name="roles" id="roles" class="form-control">
           <option value="">select roles</option>
		   <option value="admin">Admin</option>
		   <option value="manager">Manager</option>
		   <option value="waiter">Waiter</option>		  
		</select>
      </div>
	  <div class="form-group has-feedback">
        <input type="text" name="Username" id="Username" class="form-control" placeholder="User Name">        
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="Password" id="Password" class="form-control" placeholder="Password">        
      </div>
      <div class="row" align="center"> 
        <div class="col-xs-4">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>       
      </div>
    </form>  
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/js/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script>
	function success()
   	{
		$('#successmsg').delay(2000).fadeOut('slow');	
		var hostname = "<?php echo base_url().'admin'; ?>";		
		var delay = 2000; 
		setTimeout(function(){window.location.href =  hostname;}, delay);		
    } 
</script>
</body>
</html>
