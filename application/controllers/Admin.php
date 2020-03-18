<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Admin extends CI_Controller {
	
	public function __construct()
    {
       parent::__construct();      
       date_default_timezone_set('Asia/Kolkata');
    }
		
	public function index()
	{
		$data['msg']="";
		$data['msg1']="";
		$data['msg2']="";
		$this->load->view('login',$data);
	}
	
	public function loginverify()
    { 
	    $Username = $this->input->post('Username');   
        $Password = $this->input->post('Password');
		$Roles    = $this->input->post('roles');				
		
		if($Roles=='admin')
        {
	      $login    = array('username'=>$Username);  
	      $result1  = $this->Commonmodel->CheckLogin('tbl_super_admin',$login);
		  $logins   = array('password'=>$Password);  
		  $result2  = $this->Commonmodel->CheckLogin('tbl_super_admin',$logins);
		}
		else if($Roles=='manager')
        {
		  $login    = array('username'=>$Username);  
	      $result1  = $this->Commonmodel->CheckLogin('tbl_manager',$login);
		  $logins   = array('password'=>$Password);  
		  $result2  = $this->Commonmodel->CheckLogin('tbl_manager',$logins);		          
		}
		else if($Roles=='waiter')
        {		
		  $login    = array('username'=>$Username);  
	      $result1  = $this->Commonmodel->CheckLogin('tbl_waiter',$login);
		  $logins   = array('password'=>$Password);  
		  $result2  = $this->Commonmodel->CheckLogin('tbl_waiter',$logins);		            
		}
		else if($Roles=='chef')
        {		  
		  $login    = array('username'=>$Username);  
	      $result1  = $this->Commonmodel->CheckLogin('tbl_chef',$login);
		  $logins   = array('password'=>$Password);  
		  $result2  = $this->Commonmodel->CheckLogin('tbl_chef',$logins);			      
		}		
		else
		{
		  $result1 = [];
		  $result2 = [];
		}		
		
		if(count($result1)!=0)
		{
		  $abc = array($result1[0]['username']);
		}
		else
		{		  
		  $abc = array();
		}
		
		if(in_array($Username,$abc))	
	    {
		  $data['msg'] = ""; 			
		}
		else
		{
		  $data['msg'] = "Please enter your correct username."; 	
		}
		
		if(count($result2)!=0)
		{
		  $xyz = array($result2[0]['password']);
		}
		else
		{		  
		  $xyz = array();
		}
		
		if(in_array($Password,$xyz))	
	    {
		   $data['msg1'] = ""; 			   
		}
		else
		{
		  $data['msg1'] = "Please enter your correct password."; 	
		}
		
		if($Roles=='')
        {
		  $data['msg2'] = "Please select your rolls.";	
		}
		else
		{
		  $data['msg2'] = ""; 	
		}
		
		if($data['msg1']!='' || $data['msg2']!='' || $data['msg']!='')
		{		 
		  $this->load->view('login',$data);	
		}
		else
		{           
		   if($Roles=='admin')   
           {
			 $login    = array('username'=>$Username,'password'=>$Password,'status'=>1);
		     $result   = $this->Commonmodel->CheckLogin('tbl_super_admin',$login);           
		   }
		   else if($Roles=='manager')
           {
			 $login    = array('username'=>$Username,'password'=>$Password,'status'=>1);
		     $result   = $this->Commonmodel->CheckLogin('tbl_manager',$login);           
		   }
		   else if($Roles=='waiter')
           {
			 $login    = array('username'=>$Username,'password'=>$Password,'status'=>1);
		     $result   = $this->Commonmodel->CheckLogin('tbl_waiter',$login);           
		   }
		   else if($Roles=='chef')
           {
			 $login    = array('username'=>$Username,'password'=>$Password,'status'=>1);
		     $result   = $this->Commonmodel->CheckLogin('tbl_chef',$login);           
		   }		   		  	   
		   else
		   {
			 $result = [];  
		   }
			
		   if(count($result)!=0)
		   {
			 $this->session->set_userdata('sessdata',$result[0]);
		     $sessarr  = $this->session->userdata('sessdata');	
		     if($result[0]['status']==1)
		     {
			   if('admin' == $result[0]['roles'] || 'manager' == $result[0]['roles'])
			   {	
				 redirect('admin/dashboard');
			   }
			   
			  else if('waiter' == $result[0]['roles'])
			  {
				redirect('admin/neworder');	
			  }
			  else
			  {
				redirect('admin/viewcheforder');	
			  }
		    }
            else
			{			    
              $data['msg'] = "";
			  $data['msg1'] = "Your account is inactive. Contact your administrator to activate it."; 
			  $this->load->view('login',$data);
			}	 
		   } 
		   else
		   {
			 $data['msg'] = "";
			 $data['msg1'] = "Your account is inactive. Contact your administrator to activate it."; 
			 $this->load->view('login',$data);
		   }		   
		}
    }
//----------------------------------------------------------------------	
	
	function logoutadmin()
	{
	   $this->session->sess_destroy(); 
	   $log=base_url().'admin';
	   redirect("$log");	  
    }
	
//----------------------------------------------------------------------	
	public function dashboard()
	{
	   $sessarr               = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
		 if('admin'==$sessarr['roles'])
		 {
			$result['branch']  = $this->Commonmodel->counts('tbl_branch');
			$result['manager'] = $this->Commonmodel->counts('tbl_manager');
			$result['waiter']  = $this->Commonmodel->counts('tbl_waiter');
			$result['chef']    = $this->Commonmodel->counts('tbl_chef');
			$result['payment'] = $this->Commonmodel->counts('tbl_payment');
			$result['menu']    = $this->Commonmodel->counts('tbl_menu');
		 }
		 else if('manager'==$sessarr['roles'])  
		 {
		    $result['waiter']  = $this->Commonmodel->data_count('tbl_waiter','manager_code',$sessarr['id']);
		    $result['chef']    = $this->Commonmodel->data_count('tbl_chef','manager_code',$sessarr['id']); 
		    $result['table']   = $this->Commonmodel->data_count('tbl_table','manager_code',$sessarr['id']);
		    $result['menu']    = $this->Commonmodel->counts('tbl_menu');  
		 }		
		 else
		 {			
		 }		 
		 $data['userdata']   = $sessarr;
		 $result['roles']    = $sessarr['roles'];
		 $this->load->view('header',$data);
	     if('manager'==$sessarr['roles'])
		 {
		   $this->load->view('billrequest',$result);		
	     }else{
		   $this->load->view('dashboard',$result);	 
		 }		 
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   }	 
	}
//------------------------------------------------------------------------       
	public function newbranch()
	{
	   $sessarr    = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
          $data['userdata']        = $sessarr; 
          $result['state']   = $this->Commonmodel->get_Record('tbl_state',"ASC");
		  $this->load->view('header',$data);
		  $this->load->view('newbranch',$result);		
		  $this->load->view('footer');
	   }
	   else
	   {			
		  $url=base_url().'admin';
		  redirect($url);		 
	   }
	} 	
//----------------------------------------------------------------------	
	function saveBranch()
	{		
	  $sessarr     = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		 $this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
		 $this->form_validation->set_rules('branch_city', 'Branch City', 'required');
		 //$this->form_validation->set_rules('branch_pincode', 'Branch Pincode', 'required|numeric|max_length[6]|min_length[6]');
		 if($this->input->post('editid')=='')
		 {		
		   if($this->input->post('branch_pincode')=='')
		   {
		     $this->form_validation->set_rules('branch_pincode','Branch Pincode', 'required|numeric|max_length[6]|min_length[6]');	
		   }
		   else if($this->input->post('editid')=='' && $this->input->post('branch_pincode')!='')
		   { 
		     $this->form_validation->set_rules('branch_pincode','Branch Pincode', 'required|numeric|max_length[6]|min_length[6]|is_unique[tbl_branch.branch_pincode]');		
		   }		  
		 }
		
		 if($this->input->post('editid')!='')
		 {		
		   if($this->input->post('branch_pincode')=='')
		   {
		     $this->form_validation->set_rules('branch_pincode','Branch Pincode', 'required|numeric|max_length[6]|min_length[6]');	
		   } 		    	  
           $ids     = $this->input->post('editid');
		   $pincode = $this->input->post('branch_pincode');			   
		   $datas   = $this->Commonmodel->getWhere('tbl_branch','id',$ids);		  
		   $data    = $this->Commonmodel->get_Record('tbl_branch',"desc");	
		   if($this->input->post('branch_pincode')==$datas[0]['branch_pincode'])
		   {}
		   else
		   {
			 if(in_array("$pincode",(array_column($data,'branch_pincode'))))
			 {
			   $this->form_validation->set_rules('branch_pincode','Branch Pincode', 'required|numeric|max_length[6]|min_length[6]|is_unique[tbl_branch.branch_pincode]');	 
			 }
			 else{}
		   }
		 }	
		 $this->form_validation->set_rules('state_id', 'Branch State', 'required');
		 $this->form_validation->set_rules('branch_address', 'Branch Address', 'required');		 
		 if($this->form_validation->run() == FALSE)
         {
		   $data['errors'] = validation_errors();
           $data['status'] = 'error';
           echo json_encode($data);          
         }
         else
         { 	
		   $branch_name    = $this->input->post('branch_name');
		   $branch_city    = $this->input->post('branch_city');
		   $branch_pincode = $this->input->post('branch_pincode');
		   $state_id       = $this->input->post('state_id');
		   $branch_address = $this->input->post('branch_address');    
		   $branchArray = array(
		                         'branch_name'    => ucwords($branch_name),
							     'branch_city'    => ucwords($branch_city),
							     'branch_pincode' => $branch_pincode,
							     'state_id'       => $state_id,
							     'branch_address' => ucwords($branch_address)							       
							   );									 
		   if($this->input->post('editid')!='') 
		   {
			 $editid = $this->input->post('editid');
			 $insert = $this->Commonmodel->UpdateData('tbl_branch',$branchArray,'id',$editid);  
		   }
		   else
		   {
		     $insert = $this->Commonmodel->InsertData('tbl_branch',$branchArray);
		   }		    
		   if($insert!='')
		   {
		     $data['status'] = 'success';
             echo json_encode($data);
		   }       
		 }		 
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	  
	}
	
//----------------------------------------------------------------------	
	
	public function viewbranch()
	{
	   $sessarr              = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
         $data['userdata']  = $sessarr;
		 $result['result']  = $this->Commonmodel->get_Record('tbl_branch',"desc");
		 $this->load->view('header',$data);		
		 $this->load->view('viewbranch',$result);
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   } 
	}
	
//----------------------------------------------------------------------		
	
	function editbranch()
	{
	  $sessarr       =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$data['userdata']        = $sessarr;
		$id              = $this->uri->segment(3);
		$result['result']  = $this->Commonmodel->getWhere('tbl_branch','id',$id);
		$result['state']   = $this->Commonmodel->get_Record('tbl_state',"ASC");
		$this->load->view('header',$data);		
		$this->load->view('editbranch',$result);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	
	}
	
//----------------------------------------------------------------------
	
	function deletebranch()
    {	     
	  $sessarr         =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
		$ids = $this->input->post('id');		
		$Array = array('status'=>0);
		$this->Commonmodel->UpdateData('tbl_branch',$Array,'id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
//----------------------------------------------------------------------------------------------   
   	
	public function newmanager()
	{
	   $sessarr    = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
		 $data['userdata']  = $sessarr; 
		 $result['result']  = $this->Commonmodel->get_Record('tbl_branch',"desc");
		 $this->load->view('header',$data);
		 $this->load->view('newmanager',$result);		
		 $this->load->view('footer');
	   }
	   else
	   {			
		  $url=base_url().'admin';
		  redirect($url);		 
	   }
	} 
	
//---------------------------------------------------------------
    
	function saveManager()
	{		
	  $sessarr     = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
		$this->form_validation->set_rules('manager_name', 'Manager Name', 'required');
		$this->form_validation->set_rules('manager_city', 'Manager City', 'required');
		$this->form_validation->set_rules('manager_pincode', 'Manager Pincode', 'required|numeric|max_length[6]|min_length[6]');		 
		$this->form_validation->set_rules('manager_address', 'Manager Address', 'required');
		$this->form_validation->set_rules('manager_mobile', 'Manager Mobile', 'required|numeric|max_length[10]|min_length[10]');
		$this->form_validation->set_rules('manager_email', 'Manager Email', 'required');
		//$this->form_validation->set_rules('username', 'Manager Username', 'required');
		//$this->form_validation->set_rules('password', 'Manager Password', 'required');        
        if($this->input->post('editid')=='')
		{		
		   if($this->input->post('username')=='')
		   {
		     $this->form_validation->set_rules('username','Manager Username', 'required');	
		   }
		   else if($this->input->post('editid')=='' && $this->input->post('username')!='')
		   { 
		     $this->form_validation->set_rules('username','Manager Username', 'required|is_unique[tbl_manager.username]');		
		   }	
		  
		   if($this->input->post('password')=='')
		   {
		     $this->form_validation->set_rules('password','Manager Password', 'required');	
		   }
		   else if($this->input->post('editid')=='' && $this->input->post('password')!='')
		   { 
		     $this->form_validation->set_rules('password','Manager Password', 'required|is_unique[tbl_manager.password]');		
		   }	

           if($this->input->post('manager_mobile')=='')
		   {
		     $this->form_validation->set_rules('manager_mobile','Manager Mobile', 'required');	
		   }
		   else if($this->input->post('editid')=='' && $this->input->post('manager_mobile')!='')
		   { 
		     $this->form_validation->set_rules('manager_mobile','Manager Mobile', 'required|is_unique[tbl_manager.manager_mobile]');		
		   }	

		}
		
		if($this->input->post('editid')!='')
		{		
		   if($this->input->post('username')=='')
		   {
		     $this->form_validation->set_rules('username','Manager Username', 'required');	
		   }		  
		   if($this->input->post('password')=='')
		   { 
		     $this->form_validation->set_rules('password','Manager Password', 'required');	
		   }	
		   if($this->input->post('manager_mobile')=='')
		   {
		     $this->form_validation->set_rules('manager_mobile','Manager Mobile', 'required');	
		   }	  
           $ids    = $this->input->post('editid');
		   $user   = $this->input->post('username');
		   $pass   = $this->input->post('password');
		   $mob    = $this->input->post('manager_mobile');
		   $data   = $this->Commonmodel->get_Record('tbl_manager',"desc");		  
		   $result = $this->Commonmodel->getWhere('tbl_manager','id',$ids);		  

		   if($user==$result[0]['username'])
		   { }
		   else
		   {
			  if(in_array("$user",(array_column($data,'username'))))
			  {
			    $this->form_validation->set_rules('username','Manager Username', 'required|is_unique[tbl_manager.username]');	 
			  }
			  else{	}
		   }	
		  
		   if($pass==$result[0]['password'])
		   { }
		   else
		   {
			  if(in_array("$pass",(array_column($data,'password'))))
			  {
			    $this->form_validation->set_rules('password','Manager Password', 'required|is_unique[tbl_manager.password]');	 
			  }else{ }
		   }	

		   if($mob==$result[0]['manager_mobile'])
		   { }
		   else
		   {
			  if(in_array("$mob",(array_column($data,'manager_mobile'))))
			  {
			    $this->form_validation->set_rules('manager_mobile','Manager Manager', 'required|is_unique[tbl_manager.manager_mobile]');	 
			  }else{ }
		   }		   	
		}
        
        if($this->form_validation->run() == FALSE)
        {
		   $data['errors'] = validation_errors();
           $data['status'] = 'error';
           echo json_encode($data);          
        }
        else
        { 	
		   $branch_id       = $this->input->post('branch_id');
		   $manager_name    = $this->input->post('manager_name');
		   $manager_city    = $this->input->post('manager_city');
		   $manager_pincode = $this->input->post('manager_pincode');
		   $manager_address = $this->input->post('manager_address');
		   $manager_mobile  = $this->input->post('manager_mobile');
		   $manager_email   = $this->input->post('manager_email');		   
		   $username        = $this->input->post('username');
		   $password        = $this->input->post('password');		   
		   if($this->input->post('editid')=="")
		   {
			 $result       = $this->Commonmodel->counts('tbl_manager');
			 $manager_code = sprintf("%'.05d", $result[0]['unique_total']+1);
		   }
		   else
		   {
			 $manager_code = $this->input->post('manager_code');
		   }
		   $managerArray = array(
		                          'branch_id'       => $branch_id,
							      'manager_code'    => $manager_code,
								  'manager_name'    => ucwords($manager_name),
							      'manager_city'    => ucwords($manager_city),
							      'manager_pincode' => $manager_pincode,
								  'manager_address' => ucwords($manager_address),
								  'manager_mobile'  => $manager_mobile,
								  'manager_email'   => $manager_email,
								  'username'        => trim($username),
								  'password'        => trim($password)
							    );
		   if($this->input->post('editid')!='') 
		   {
			 $editid  = $this->input->post('editid');
			 $insert  = $this->Commonmodel->UpdateData('tbl_manager',$managerArray,'id',$editid);  
		   }
		   else
		   {
		     $insert  = $this->Commonmodel->InsertData('tbl_manager',$managerArray);
		   }		    
		   if($insert!='')
		   {
		     $data['status'] = 'success';
             echo json_encode($data);
		   }       
		}		 
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	  
	}
	
//----------------------------------------------------------
    
	function viewmanager()
	{
	   $sessarr             = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
         $data['userdata']  = $sessarr;
		 //$result['result']  = $this->Commonmodel->get_Record('tbl_manager',"desc");
		 $result['result'] = $this->Commonmodel->getManager();
		 $this->load->view('header',$data);		
		 $this->load->view('viewmanager',$result);
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   } 
	}
	
//---------------------------------------------------------
    
	function editmanager()
	{
	  $sessarr             = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$data['userdata']  = $sessarr;
		$id                = $this->uri->segment(3);
		$result['result']  = $this->Commonmodel->get_Record('tbl_branch',"desc");
		$result['results'] = $this->Commonmodel->getWhere('tbl_manager','id',$id);
		$this->load->view('header',$data);		
		$this->load->view('editmanager',$result);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	
	}
	
//-------------------------------------------------------------
	
	function deletemanager()
    {	     
	  $sessarr         =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
		$ids   = $this->input->post('id');		
		$Array = array('status'=>0);
		$this->Commonmodel->UpdateData('tbl_manager',$Array,'id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
//------------------------------------------------------------	
    
   	public function newwaiter()
	{
	   $sessarr    = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
		 $data['userdata']  = $sessarr; 
		 //$result['result']  = $this->Commonmodel->get_Record('tbl_waiter');
		 $this->load->view('header',$data);
		 $this->load->view('newwaiter');		
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   }
	} 
	
//-------------------------------------------------------------	
	
	function saveWaiter()
	{		
	  $sessarr     = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('waiter_name', 'Waiter Name', 'required');
		$this->form_validation->set_rules('waiter_city', 'Waiter Name', 'required');
        $this->form_validation->set_rules('waiter_pincode', 'Waiter Pincode', 'required|numeric|max_length[6]|min_length[6]');		 
		$this->form_validation->set_rules('waiter_address', 'Waiter Address', 'required');
		$this->form_validation->set_rules('waiter_mobile', 'Waiter Mobile', 'required|numeric|max_length[10]|min_length[10]');
		$this->form_validation->set_rules('waiter_email', 'Waiter Email', 'required');		 
		//$this->form_validation->set_rules('username', 'Waiter Username', 'required');
		//$this->form_validation->set_rules('password', 'Waiter Password', 'required');
         if($this->input->post('editid')=='')
		 {		
		   if($this->input->post('username')=='')
		   {
		     $this->form_validation->set_rules('username','Waiter Username', 'required');	
		   }
		   else if($this->input->post('editid')=='' && $this->input->post('username')!='')
		   { 
		     $this->form_validation->set_rules('username','Waiter Username', 'required|is_unique[tbl_waiter.username]');		
		   }	
		  
		   if($this->input->post('password')=='')
		   {
		     $this->form_validation->set_rules('password','Waiter Password', 'required');	
		   }
		   else if($this->input->post('editid')=='' && $this->input->post('password')!='')
		   { 
		     $this->form_validation->set_rules('password','Waiter Password', 'required|is_unique[tbl_waiter.password]');		
		   }	

           if($this->input->post('waiter_mobile')=='')
		   {
		     $this->form_validation->set_rules('waiter_mobile','Waiter Mobile', 'required');	
		   }
		   else if($this->input->post('editid')=='' && $this->input->post('waiter_mobile')!='')
		   { 
		     $this->form_validation->set_rules('waiter_mobile','Waiter Mobile', 'required|is_unique[tbl_waiter.waiter_mobile]');		
		   }
		   
		 }
		
		 if($this->input->post('editid')!='')
		 {		
		   if($this->input->post('username')=='')
		   {
		     $this->form_validation->set_rules('username','Waiter Username', 'required');	
		   }		   
		   if($this->input->post('password')=='')
		   {
		     $this->form_validation->set_rules('password','Waiter Password', 'required');	
		   }
		   if($this->input->post('waiter_mobile')=='')
		   {
		     $this->form_validation->set_rules('waiter_mobile','Waiter Mobile', 'required');	
		   }		  
           $ids    = $this->input->post('editid');
		   $user   = $this->input->post('username');
		   $pass   = $this->input->post('password');
		   $mob    = $this->input->post('waiter_mobile');
		   $data   = $this->Commonmodel->get_Record('tbl_waiter',"desc");		  
		   $result = $this->Commonmodel->getWhere('tbl_waiter','id',$ids);

		   if($user==$result[0]['username'])
		   {
			 //$this->form_validation->set_rules('username','Manager Username', 'required|is_unique[tbl_manager.username]');	  
		   }
		   else
		   {
			 if(in_array("$user",(array_column($data,'username'))))
			 {
			   $this->form_validation->set_rules('username','Waiter Username', 'required|is_unique[tbl_waiter.username]');	 
			 }else{ }
		   }	
		  
		   if($pass==$result[0]['password'])
		   {
			 //$this->form_validation->set_rules('username','Manager Username', 'required|is_unique[tbl_manager.username]');	  
		   }
		   else
		   {
			 if(in_array("$pass",(array_column($data,'password'))))
			 {
			   $this->form_validation->set_rules('password','Waiter Password', 'required|is_unique[tbl_waiter.password]');	 
			 }else{ }
		   }
           
           if($mob==$result[0]['waiter_mobile'])
		   {
			 //$this->form_validation->set_rules('username','Manager Username', 'required|is_unique[tbl_manager.username]');	  
		   }
		   else
		   {
			 if(in_array("$mob",(array_column($data,'waiter_mobile'))))
			 {
			   $this->form_validation->set_rules('waiter_mobile','Waiter Mobile', 'required|is_unique[tbl_waiter.waiter_mobile]');	 
			 }else{ }
		   } 
		 }   
         
		if($this->form_validation->run() == FALSE)
        {
		  $data['errors'] = validation_errors();
          $data['status'] = 'error';
          echo json_encode($data);          
        }
        else
        { 	
		  $waiter_name    = $this->input->post('waiter_name');
		  $waiter_city    = $this->input->post('waiter_city');
		  $waiter_pincode = $this->input->post('waiter_pincode');
		  $waiter_address = $this->input->post('waiter_address');
		  $waiter_mobile  = $this->input->post('waiter_mobile');
		  $waiter_email   = $this->input->post('waiter_email');		  	   
		  $username       = $this->input->post('username');
		  $password       = $this->input->post('password');
		   
		  if($this->input->post('editid')=="")
		  {
			$result       = $this->Commonmodel->counts('tbl_waiter');
			$waiter_code  = sprintf("%'.05d", $result[0]['unique_total']+1);
		  }
		  else
		  {
			$waiter_code = $this->input->post('waiter_code');
		  }	
		  $waiterArray = array(
		                        'manager_code'   => $sessarr['manager_code'],
							    'waiter_code'    => $waiter_code,
								'waiter_name'    => ucwords($waiter_name),
							    'waiter_city'    => ucwords($waiter_city),
							    'waiter_pincode' => $waiter_pincode,
								'waiter_address' => ucwords($waiter_address),
								'waiter_mobile'  => $waiter_mobile,
								'waiter_email'   => $waiter_email,
								'username'       => trim($username),
								'password'       => trim($password)
							  );								 
		   if($this->input->post('editid')!='') 
		   {
			 $editid  = $this->input->post('editid');
			 $insert  = $this->Commonmodel->UpdateData('tbl_waiter',$waiterArray,'id',$editid);  
		   }
		   else
		   {
		     $insert  = $this->Commonmodel->InsertData('tbl_waiter',$waiterArray);
		   }		    
		   if($insert!='')
		   {
		     $data['status'] = 'success';
             echo json_encode($data);
		   }       
		}		 
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	  
	}
	
//--------------------------------------------------------------
    
	public function viewwaiter()
	{
	   $sessarr              = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
         $data['userdata']  = $sessarr;
		 //$result['result']  = $this->Commonmodel->get_Record('tbl_waiter');
		 $result['result']  = $this->Commonmodel->All_join_Record('tbl_waiter',$sessarr['roles'],$sessarr['id']);
		 $result['roles']   = $sessarr['roles']; 
		 $this->load->view('header',$data);		
		 $this->load->view('viewwaiter',$result);
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   } 
	}
	
//---------------------------------------------------------
    
	function editwaiter()
	{
	  $sessarr       =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$data['userdata']   = $sessarr;
		$id                 = $this->uri->segment(3);
		//$result['result']   = $this->Commonmodel->get_Record('tbl_branch');
		$result['result']  = $this->Commonmodel->getWhere('tbl_waiter','id',$id);
		$this->load->view('header',$data);		
		$this->load->view('editwaiter',$result);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	
	}
	
//--------------------------------------------------------------
    
	function deletewaiter()
    {	     
	  $sessarr         =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
		$ids   = $this->input->post('id');		
		$Array = array('status'=>0);
		$this->Commonmodel->UpdateData('tbl_waiter',$Array,'id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
//-----------------------------------------------------------
	
	public function newchef()
	{
	   $sessarr    = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
		 $data['userdata']  = $sessarr; 
		 //$result['result']  = $this->Commonmodel->get_Record('tbl_chef');
		 $this->load->view('header',$data);
		 $this->load->view('newchef');		
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   }
	}
	
//--------------------------------------------------------------
    
	function saveChef()
	{		
	  $sessarr     = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		  $this->form_validation->set_rules('chef_name', 'Chef Name', 'required');
		  $this->form_validation->set_rules('chef_city', 'Chef Name', 'required');
          $this->form_validation->set_rules('chef_pincode', 'Chef Pincode', 'required|numeric|max_length[6]|min_length[6]');		 
		  $this->form_validation->set_rules('chef_address', 'Chef Address', 'required');
		  $this->form_validation->set_rules('chef_mobile', 'Chef Mobile', 'required|numeric|max_length[10]|min_length[10]');
		  $this->form_validation->set_rules('chef_email', 'Chef Email', 'required');		 
		  //$this->form_validation->set_rules('username', 'Chef Username', 'required');
		  //$this->form_validation->set_rules('password', 'Chef Password', 'required');		
		  if($this->input->post('editid')=='')
		  {		
		    if($this->input->post('username')=='')
		    {
		      $this->form_validation->set_rules('username','Chef Username', 'required');	
		    }
		    else if($this->input->post('editid')=='' && $this->input->post('username')!='')
		    { 
		      $this->form_validation->set_rules('username','Chef Username', 'required|is_unique[tbl_chef.username]');		
		    }	
		  
		    if($this->input->post('password')=='')
		    {
		      $this->form_validation->set_rules('password','Chef Password', 'required');	
		    }
		    else if($this->input->post('editid')=='' && $this->input->post('password')!='')
		    { 
		      $this->form_validation->set_rules('password','Chef Password', 'required|is_unique[tbl_chef.password]');		
		    }
           
            if($this->input->post('chef_mobile')=='')
		    {
		      $this->form_validation->set_rules('chef_mobile','Chef Mobile', 'required');	
		    }
		    else if($this->input->post('editid')=='' && $this->input->post('chef_mobile')!='')
		    { 
		       $this->form_validation->set_rules('chef_mobile','Chef Mobile', 'required|is_unique[tbl_chef.chef_mobile]');		
		    }	


		  }
		
		  if($this->input->post('editid')!='')
		  {		
		    if($this->input->post('username')=='')
		    {
		      $this->form_validation->set_rules('username','Chef Username', 'required');	
		    }		   
		    if($this->input->post('password')=='')
		    {
		      $this->form_validation->set_rules('password','Chef Password', 'required');	
		    }	
            if($this->input->post('chef_mobile')=='')
		    {
		      $this->form_validation->set_rules('chef_mobile','Chef Mobile', 'required');	
		    }	

            $ids  =$this->input->post('editid');
		    $user = $this->input->post('username');
		    $pass = $this->input->post('password');
		    $mob = $this->input->post('chef_mobile');
		    $data =  $this->Commonmodel->get_Record('tbl_chef',"desc");
		    $result = $this->Commonmodel->getWhere('tbl_chef','id',$ids);		  
		   
		    if($user==$result[0]['username'])
		    {
			  //$this->form_validation->set_rules('username','Manager Username','required|is_unique[tbl_manager.username]');	  
		    }
		    else
		    {
			  if(in_array("$user",(array_column($data,'username'))))
			  {
			    $this->form_validation->set_rules('username','Chef Username', 'required|is_unique[tbl_chef.username]');	 
			  }else{ }
		    }	
		    
		    if($pass==$result[0]['password'])
		    {
			  //$this->form_validation->set_rules('username','Manager Username', 'required|is_unique[tbl_manager.username]');	  
		    }
		    else
		    {
			  if(in_array("$pass",(array_column($data,'password'))))
			  {
			     $this->form_validation->set_rules('password','Chef Password', 'required|is_unique[tbl_chef.password]');	 
			  }else{ }
		    }	

            if($mob==$result[0]['chef_mobile'])
		    {
			  //$this->form_validation->set_rules('username','Manager Username', 'required|is_unique[tbl_manager.username]');	  
		    }
		    else
		    {
			  if(in_array("$mob",(array_column($data,'chef_mobile'))))
			  {
			     $this->form_validation->set_rules('chef_mobile','Chef Mobile', 'required|is_unique[tbl_chef.chef_mobile]');	 
			  }else{ }
		    }

		}
        
		if($this->form_validation->run() == FALSE)
        {
		  $data['errors'] = validation_errors();
          $data['status'] = 'error';
          echo json_encode($data);          
        }
        else
        { 	
		  $chef_name    = $this->input->post('chef_name');
		  $chef_city    = $this->input->post('chef_city');
		  $chef_pincode = $this->input->post('chef_pincode');
		  $chef_address = $this->input->post('chef_address');
		  $chef_mobile  = $this->input->post('chef_mobile');
		  $chef_email   = $this->input->post('chef_email');		  	   
		  $username     = $this->input->post('username');
		  $password     = $this->input->post('password');		   
		  if($this->input->post('editid')=="")
		  {
			$result     = $this->Commonmodel->counts('tbl_chef');
			$chef_code  = sprintf("%'.05d", $result[0]['unique_total']+1);
		  }
		  else
		  {
			$chef_code = $this->input->post('chef_code');
		  }
		  $chefArray = array(
		                      'manager_code' => $sessarr['manager_code'],
							  'chef_code'    => $chef_code,
							  'chef_name'    => ucwords($chef_name),
							  'chef_city'    => ucwords($chef_city),
							  'chef_pincode' => $chef_pincode,
							  'chef_address' => ucwords($chef_address),
							  'chef_mobile'  => $chef_mobile,
							  'chef_email'   => $chef_email,
							  'username'     => trim($username),
							  'password'     => trim($password)
							);								 
		   if($this->input->post('editid')!='') 
		   {
			 $editid  = $this->input->post('editid');
			 $insert  = $this->Commonmodel->UpdateData('tbl_chef',$chefArray,'id',$editid);  
		   }
		   else
		   {
		     $insert  = $this->Commonmodel->InsertData('tbl_chef',$chefArray);
		   }		    
		   if($insert!='')
		   {
		     $data['status'] = 'success';
             echo json_encode($data);
		   }       
		}		 
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	  
	}
	
//--------------------------------------------------------------	
    
	public function viewchef()
	{
	   $sessarr              = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
         $data['userdata']  = $sessarr;
		 //$result['result']  = $this->Commonmodel->get_Record('tbl_chef');
		 $result['result']  = $this->Commonmodel->All_join_Record('tbl_chef',$sessarr['roles'],$sessarr['id']);
		 $result['roles']   = $sessarr['roles'];
		 $this->load->view('header',$data);		
		 $this->load->view('viewchef',$result);
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   } 
	}
	
//---------------------------------------------------------
    
	function editchef()
	{
	  $sessarr       =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$data['userdata']   = $sessarr;
		$id                 = $this->uri->segment(3);
		//$result['result']   = $this->Commonmodel->get_Record('tbl_branch');
		$result['result']  = $this->Commonmodel->getWhere('tbl_chef','id',$id);
		$this->load->view('header',$data);		
		$this->load->view('editchef',$result);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	
	}
	
//--------------------------------------------------------------
    
	function deletechef()
    {	     
	  $sessarr         =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
		$ids   = $this->input->post('id');		
		$Array = array('status'=>0);
		$this->Commonmodel->UpdateData('tbl_chef',$Array,'id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
//--------------------------------------------------------------
	
	public function newtax()
	{
	   $sessarr    = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
		 $data['userdata']  = $sessarr;		 
		 $result['result']  = $this->Commonmodel->get_Record('tbl_category',"desc");
		 $this->load->view('header',$data);
		 $this->load->view('newtax',$result);		
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   }
	} 
	
//----------------------------------------------------------------
	
	function saveTax()
	{		
	  $sessarr     = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('menu_type', 'Menu Type', 'required');
		$this->form_validation->set_rules('tax_name', 'Tax Name', 'required');
        $this->form_validation->set_rules('tax_percentage', 'Tax Percentage', 'required|numeric');		 
		if($this->form_validation->run() == FALSE)
        {
		  $data['errors'] = validation_errors();
          $data['status'] = 'error';
          echo json_encode($data);          
        }
        else
        { 	
		  $menu_type      = $this->input->post('menu_type');
		  $tax_name       = $this->input->post('tax_name');
		  $tax_percentage = $this->input->post('tax_percentage');		   
		  $taxArray       = array(
		                           'menu_type'      => $menu_type,
							       'tax_name'       => strtoupper($tax_name),
							       'tax_percentage' => $tax_percentage							    
							     );									 
		  if($this->input->post('editid')!='') 
		  {
			$editid  = $this->input->post('editid');
			$insert  = $this->Commonmodel->UpdateData('tbl_tax',$taxArray,'id',$editid);  
		  }
		  else
		  {
		    $insert  = $this->Commonmodel->InsertData('tbl_tax',$taxArray);
		  }		  
		  if($insert!='')
		  {
		    $data['status'] = 'success';
            echo json_encode($data);
		  } 		  
		}		 
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	  
	}
	
//------------------------------------------------------------
	
	public function viewtax()
	{
	   $sessarr              = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
         $data['userdata']  = $sessarr;
		 $result['result']  = $this->Commonmodel->get_Record('tbl_tax',"desc");
		 $this->load->view('header',$data);		
		 $this->load->view('viewtax',$result);
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   } 
	}
	
//---------------------------------------------------------------
	
	function edittax()
	{
	  $sessarr       =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		 $data['userdata']  = $sessarr;
		 $id                = $this->uri->segment(3);		
		 $result['result']  = $this->Commonmodel->getWhere('tbl_tax','id',$id);
		 $this->load->view('header',$data);		
		 $this->load->view('edittax',$result);
		 $this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	
	}
	
//-------------------------------------------------------------
	
	function deletetax()
    {	     
	  $sessarr         =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
		$ids   = $this->input->post('id');		
		$Array = array('status'=>0);
		$this->Commonmodel->UpdateData('tbl_tax',$Array,'id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
//-------------------------------------------------------------
	
	public function newtable()
	{
	   $sessarr    = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
		 $result['userdata'] = $sessarr;
		 $result['branch']   = $this->Commonmodel->get_Record('tbl_branch',"desc");
		 $this->load->view('header',$result);
		 $this->load->view('newtable',$result);		
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   }
	}
	
//--------------------------------------------------------------
	
	function saveTable()
	{		
	  $sessarr     = $this->session->userdata('sessdata');
	  /*if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');*/
		if($sessarr['status']==1)
	    {	
		  $this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
		  if($this->input->post('editid')=='')
		  {		
		    if($this->input->post('table_number')=='')
		    {
		      $this->form_validation->set_rules('table_number','Table Number', 'required');	
		    }
		    else if($this->input->post('editid')=='' && $this->input->post('table_number')!='')
		   { 
		     $this->form_validation->set_rules('table_number','Table Number', 'required|is_unique[tbl_table.table_number]');		
		   }
		 }
		
		 if($this->input->post('editid')!='')
		 {		
		    if($this->input->post('table_number')=='')
		    {
		      $this->form_validation->set_rules('table_number','Table Number', 'required');	
		    }	  
            $ids    = $this->input->post('editid');
		    $branch = $this->input->post('branch_id');
		    $tblnum = $this->input->post('table_number');
		    $data   = $this->Commonmodel->getWhere('tbl_table','branch_id',$branch);		  
		    if($this->input->post('table_number')==$data[0]['table_number'])
		    {}
	        else
		    {
			  if(in_array("$tblnum",(array_column($data,'table_number'))))
			  {
			    $this->form_validation->set_rules('table_number','Table Number', 'required|is_unique[tbl_table.table_number]');	 
			  }else{ }
		    }
		 }	

		//$this->form_validation->set_rules('table_number', 'Table Number', 'required');        
		if($this->form_validation->run() == FALSE)
        {
		  $data['errors'] = validation_errors();
          $data['status'] = 'error';
          echo json_encode($data);          
        }
        else
        { 	
		  $branch_id    = $this->input->post('branch_id');
		  $table_number = $this->input->post('table_number');
		  $tableArray = array(
		                       'branch_id'    => $branch_id,
							   'manager_code' => $sessarr['manager_code'],
							   'table_number' => $table_number
							  );								 
		  if($this->input->post('editid')!='') 
		  {
			$editid = $this->input->post('editid');
			$insert = $this->Commonmodel->UpdateData('tbl_table',$tableArray,'id',$editid);  
		  }
		  else
		  {
		    $insert = $this->Commonmodel->InsertData('tbl_table',$tableArray);
		  }		   
		  if($insert!='')
		  {
		    $data['status'] = 'success';
            echo json_encode($data);
		  }       
		}		 
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	  
	//}
  }
//--------------------------------------------------------------
	
	function viewtable()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
        $data['userdata']  = $sessarr;		 
		//$result['result']  = $this->Commonmodel->get_Record('tbl_table');
		$result['result']  = $this->Commonmodel->All_join_Record('tbl_branch',$sessarr['roles'],$sessarr['branch_id']);
		$this->load->view('header',$data);		
		$this->load->view('viewtable',$result);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 
	}
	
//-------------------------------------------------------------
	
	function edittable()
	{
	  $sessarr       =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		 $result['userdata'] = $sessarr;
		 $id               = $this->uri->segment(3);		
		 $result['result'] = $this->Commonmodel->getWhere('tbl_table','id',$id);
		 $result['branch'] = $this->Commonmodel->get_Record('tbl_branch',"desc");
		 $this->load->view('header',$result);		
		 $this->load->view('edittable',$result);
		 $this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	
	}
	
//------------------------------------------------------------
	
	function deletetable()
    {	     
	  $sessarr         =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
		$ids   = $this->input->post('id');		
		$Array = array('status'=>0);
		$this->Commonmodel->UpdateData('tbl_table',$Array,'id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
//-----------------------------------------------------------
	
	function newmenu()
	{
	   $sessarr    = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
		 $data['userdata']  = $sessarr;
		 $result['result']  = $this->Commonmodel->get_Record('tbl_category',"desc");
		 $this->load->view('header',$data);
		 $this->load->view('newmenu',$result);		
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   }
	}
	
//------------------------------------------------------------
	
	function saveMenu()
	{		
	  $sessarr     = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('catergory_id', 'Catergory Name', 'required');
		$this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
        $this->form_validation->set_rules('menu_price', 'Menu Price', 'required|numeric');
        $this->form_validation->set_rules('menu_time', 'Menu Time', 'required|numeric');
        $this->form_validation->set_rules('menu_aval', 'Menu Aval', 'required|numeric');
        if($this->form_validation->run() == FALSE)
        {
		  $data['errors'] = validation_errors();
          $data['status'] = 'error';
          echo json_encode($data);          
        }
        else
        { 	
		  $catergory_id = $this->input->post('catergory_id');
		  $menu_name    = $this->input->post('menu_name');
		  $menu_price   = $this->input->post('menu_price');		  
		  $menu_time    = $this->input->post('menu_time');
		  $menu_aval	= $this->input->post('menu_aval');  
		  
		  $menuArray = array(
		                       'catergory_id' => $catergory_id,
		                       'manager_code' => $sessarr['manager_code'],
							   'menu_name'    => $menu_name,
							   'menu_price'   => $menu_price,
							   'menu_time'    => $menu_time,
							   'menu_aval'	  => $menu_aval
							 );								 
		   if($this->input->post('editid')!='') 
		   {
			 $editid = $this->input->post('editid');
			 $insert = $this->Commonmodel->UpdateData('tbl_menu',$menuArray,'id',$editid);  
		   }
		   else
		   {
		     $insert = $this->Commonmodel->InsertData('tbl_menu',$menuArray);
		   }
		   if($insert!='')
		   {
		     $data['status'] = 'success';
             echo json_encode($data);
		   }		   
		}		 
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	  
	}	
	
//-----------------------------------------------------------
    
	function viewmenu()
	{
	   $sessarr      = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
         $data['userdata']  = $sessarr;		 
		 $result['result']  = $this->Commonmodel->get_join_Record('tbl_menu',$sessarr['manager_code']);
		 $this->load->view('header',$data);		
		 $this->load->view('viewmenu',$result);
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   } 
	}
	 
//------------------------------------------------------------
    
	function editmenu()
	{
	  $sessarr       =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$data['userdata']  = $sessarr;
		$id                = $this->uri->segment(3);		
		$result['result']  = $this->Commonmodel->getWhere('tbl_menu','id',$id);
		$result['results'] = $this->Commonmodel->get_Record('tbl_category',"desc");
		$this->load->view('header',$data);		
		$this->load->view('editmenu',$result);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	
	}
    
//---------------------------------------------------------
    
    function deletemenu()
    {	     
	  $sessarr  =  $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
		$ids   = $this->input->post('id');		
		$Array = array('status'=>0);
		$this->Commonmodel->UpdateData('tbl_menu',$Array,'id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
     
//-------------------------------------------------------------
    
	function neworder()
	{
	   $sessarr    = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
		 $data['userdata']    = $sessarr;
		 $result['result']    = $this->Commonmodel->get_Record('tbl_category',"desc");
		 $result['roles']     = $sessarr['roles'];		 
         $result['FoodItems'] = $this->Commonmodel->getWheres('tbl_menu','catergory_id',1,$sessarr['manager_code']);
		 $result['HardDrinks']   = $this->Commonmodel->getWheres('tbl_menu','catergory_id',43,$sessarr['manager_code']);
		 $this->load->view('header',$data);
		 //$this->load->view('neworder',$result);	
		 //$this->load->view('tempneworder',$result);		 
		 $this->load->view('tempneworderdemo',$result);
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   }
	}	

	function gettable()
	{
	  $sessarr           = $this->session->userdata('sessdata');
	  $data['userdata']  = $sessarr;	  
	  $result['results'] = $this->Commonmodel->getTable($sessarr['manager_code']);
	  echo json_encode($result); 
	}
    
//-----------------------------------------------------------
	
	function getMenu()
	{
	   $id     = $this->input->post('id');	   
	   $data['results']  =  $this->Commonmodel->getWhere('tbl_menu',"catergory_id",$id);
	   echo json_encode($data); 
	}
	
//---------------------------------------------------------
	
	function savetemporder()
	{
	  //$this->form_validation->set_rules('category_id', 'Category Name', 'required');
	  //$this->form_validation->set_rules('menu_id', 'Menu Name', 'required');
	  //$this->form_validation->set_rules('qty', 'Quantity', 'required');
	  $sessarr  = $this->session->userdata('sessdata');
	  //if($this->form_validation->run() == FALSE)
      //{
		//$data['errors'] = validation_errors();
      //  $data['status'] = 'error';
      //  echo json_encode($data);          
      //}
      //else 
      //{		  
		//if($this->input->post('orderid')!='')
		//{
		 // $ordids = $this->input->post('orderid');
		//}
		//else
		//{	
		  $data   = $this->Commonmodel->ordercount();	      
		  if(count($data)!=0)
		  {
			if($this->input->post('orderid')=='')
			{
		      $ordid  = $data[0]['counts']+1;				
		      $arrays = array('order_id' => $ordid);
			  $ordids = $this->Commonmodel->InsertData('create_order_id',$arrays);
			}
			else
			{
			  $ordids = $this->input->post('orderid');
			  //$arrays = array('order_id' => $ordids);
			  //$ordids = $this->Commonmodel->InsertData('create_order_id',$arrays);
			}
		  }			  
		 //echo $this->input->post('orderid');		  
		 //else
		 //{
			 //$ordid  = 0;
			 //$arrays = array('order_id' => $ordid);
		 //}
		//}
		//echo $ordids;		
		$catergory_id  = $this->input->post('catergory_id');
		$menu          = $this->input->post('menu');		
		$Qty           = $this->input->post('Qty');
		$sugestion     = $this->input->post('sugestion');	
        //print_r($menu);


		$arrMenu = array_values((array_filter($menu, function($value) { return !is_null($value) && $value !== ''; })));
		$arrQty = array_values((array_filter($Qty, function($value) { return !is_null($value) && $value !== ''; })));
		$arrSug = array_values((array_filter($sugestion, function($value) { return !is_null($value) && $value !== ''; })));		
		//for($i=0;$i<count($menu);$i++)

		print_r($menu);
		echo "\n";
		echo count($arrMenu);
        
		for($i=0;$i<count($arrMenu);$i++)
		{	
		  $data['results']  =  $this->Commonmodel->getWhere('tbl_menu',"id",$arrMenu[$i]);
		  $catid = $data['results'][0]['catergory_id'];
		  if('1'==$catid)
		  {
			$menu_type = 1;  
		  }
		  else
		  {
			$menu_type = 2;  
		  }
		  $orderArray = array(
		                       'waiter_id'   => $sessarr['id'],
							   'ordid'       => $ordids,
							   'category_id' => $data['results'][0]['catergory_id'],
							   'menu_id'     => $arrMenu[$i],
							   'qty'         => $arrQty[$i],
							   'suggestion'  => $arrSug[$i],
							   'menu_type'   => $menu_type,
						     );
		  $this->Commonmodel->InsertData('tbl_temp_order',$orderArray);	
		}		
		if(count($arrMenu) == $i)
		{
		  $data['status'] = 'success';
		  $data['id']     = $ordids;
		  echo json_encode($data);
		}		
		
		/*		
		$category_id  = $this->input->post('category_id');
	    $menu_id      = $this->input->post('menu_id');
	    $qty          = $this->input->post('qty');
	    $suggestion   = $this->input->post('suggestion');
	    
		$orderArray   = array(
		                       'waiter_id'   => $sessarr['id'],
							   'ordid'       => $ordid,
							   'category_id' => $category_id,
							   'menu_id'     => $menu_id,
							   'qty'         => $qty,
							   'suggestion'  => $suggestion
						      );	    
		$insert       = $this->Commonmodel->InsertData('tbl_temp_order',$orderArray);					   
	    if($insert!='')
		{
		  $data['status'] = 'success';
		  $data['id']     = $ordid;
          echo json_encode($data);
		}
		*/
	  //}
	}
		
//----------------------------------------------------------
	
	function getOrder()
	{	  
	  $sessarr         = $this->session->userdata('sessdata');
	  $data['results'] = $this->Commonmodel->gettemp_order($sessarr['id']);
	  echo json_encode($data); 
	}
	
//-----------------------------------------------------------	
    
	function saveOrder()
	{
	  $sessarr         = $this->session->userdata('sessdata');
	  $table_id        = $this->input->post('table_id');
	  $customer_name   = $this->input->post('customer_name');
	  $customer_mobile = $this->input->post('customer_mobile');
	  $customer_email  = $this->input->post('customer_email');	  
	  $data['results'] = $this->Commonmodel->getWhere('tbl_customer',"customer_mobile",9090909090);		
	  //if(count($data['results'])>0)
	  if($this->input->post('customer_id')!='')
	  {	    
		//$customerid = $data['results'][0]['id'];
		$customerid    = $this->input->post('customer_id');
		$customerArray = array(		                      
							   'customer_name'   => ucwords($customer_name),
							   'customer_mobile' => $customer_mobile,
							   'customer_email'  => $customer_email,
							  ); 							  
		$this->Commonmodel->UpdateData('tbl_customer',$customerArray,'id',$customerid);
	  }
	  else
	  {
	    $customerArray = array(		                      
							    'customer_name'   => ucwords($customer_name),
							    'customer_mobile' => $customer_mobile,
							    'customer_email'  => $customer_email,
							  );  
		$customerid = $this->Commonmodel->InsertData('tbl_customer',$customerArray);					
	  }	  
	  $sessarr         = $this->session->userdata('sessdata');
	  $data['results'] = $this->Commonmodel->getWhere('tbl_temp_order',"waiter_id",$sessarr['id']);	
	  for($i=0;$i<count($data['results']);$i++)
	  {
		$orderid     = $data['results'][$i]['ordid'];
		$waiter_id   = $data['results'][$i]['waiter_id']; 
		$category_id = $data['results'][$i]['category_id'];
		$menu_id     = $data['results'][$i]['menu_id'];
		$qty         = $data['results'][$i]['qty'];
		//$suggestion  = $data['results'][$i]['suggestion'];
		$menu_type   = $data['results'][$i]['menu_type'];		
		$orderArray  = array(		                      
							  'table_id'     => $table_id,
							  'customer_id'  => $customerid, 
							  'orderid'      => $orderid,
							  'manager_code' => $sessarr['manager_code'],
							  'waiter_id'    => $waiter_id,
							  'category_id'  => $category_id,
							  'menu_id'      => $menu_id,
							  'qty'          => $qty,
							  //'suggestion'   => $suggestion,
							  'menu_type'    => $menu_type
		                    );
		$this->Commonmodel->InsertData('tbl_order',$orderArray);
		$Array =array('status' =>0);
		$this->Commonmodel->UpdateData('tbl_temp_order',$Array,'id',$data['results'][$i]['id']);
	  }	  
	  if(count($data['results'])>=$i)
	  {
		$datas['status'] = 'success';
		$datas['customer_id'] = $customerid;
		echo json_encode($datas);	
	  }else{ } 
	}
	
//-----------------------------------------------------------
     
	function getmainOrder()
	{
	  $sessarr         = $this->session->userdata('sessdata');
	  $data['results'] = $this->Commonmodel->get_order($sessarr['roles'],$sessarr['id']);
	  echo json_encode($data); 	
	}
	 
    function getmainOrders()
	{
	  $sessarr  = $this->session->userdata('sessdata');
	  $ordid    = $this->input->post('id');
	  $data['result'] = $this->Commonmodel->getorderss($sessarr['roles'],$sessarr['waiter_code'],$ordid);
	  echo json_encode($data); 	
	}
    
    function getordersgroup()
	{
	  $sessarr  = $this->session->userdata('sessdata');
	  $ordid    = $this->input->post('id');
	  $data['results'] = $this->Commonmodel->getordersgroup($sessarr['roles'],$sessarr['waiter_code']);
	  echo json_encode($data); 	
	}

	function getmainchefOrder()
	{
	  $sessarr         = $this->session->userdata('sessdata');
	  if('admin'==$sessarr['roles'])
	  {
		$data['results'] = $this->Commonmodel->get_order($sessarr['roles'],$sessarr['id']);  
	  }	  
	  else
	  {	  
	    $data['results'] = $this->Commonmodel->get_order($sessarr['roles'],$sessarr['manager_code']);
	  }
	  echo json_encode($data); 	
	}
	
	function orders()
	{
	  $sessarr   = $this->session->userdata('sessdata');	  
	  $orderid   = $this->input->post('order_id');
	  $data['results'] = $this->Commonmodel->orders($sessarr['manager_code'],$orderid);
	  echo json_encode($data); 
	}
	
	function getchefOrder()
	{
	  $sessarr         = $this->session->userdata('sessdata');	  
	  $orderid         = $this->input->post('order_id');
	  $data['results'] = $this->Commonmodel->get_order($sessarr['roles'],$sessarr['manager_code'],$orderid);
	  echo json_encode($data); 	
	}
		
	function getmainchefOrders()
	{
	  $sessarr         = $this->session->userdata('sessdata');
	  $data['results'] = $this->Commonmodel->get_orders($sessarr['roles'],$sessarr['manager_code']);
	  echo json_encode($data); 	
	}
	
//-----------------------------------------------------------
    
	function RemoveTempOrder()
	{
	  $ids   = $this->input->post('id');		
	  $Array = array('status'=>0);
	  $this->Commonmodel->UpdateData('tbl_temp_order',$Array,'id',$ids);
	  $data['status'] = 'success';	
	  echo json_encode($data);	
	}
    
//-----------------------------------------------------------
    
	function viewcheforder()
	{
	  $sessarr    = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
		$data['userdata']  = $sessarr;		 
		//$result['order']   = $this->Commonmodel->getWhere('tbl_order','manager_code',$sessarr['manager_code']);
		$this->load->view('header',$data);
		$this->load->view('viewcheforder');		
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }
   }
   	
//------------------------------------------------------------
   
   function orderstatus()	
   {
	  $sessarr = $this->session->userdata('sessdata');
	  $ids     = $this->input->post('id');
	  $status  = $this->input->post('status');	  
	  $time    = date("h:i:s a");	  
	  if(2==$status)
	  {
		$Array  = array('chef_id'=>$sessarr['id'],'order_status'=>$status,'starttime'=>$time);  
	  }
	  else if(5==$status)
	  {
		$Array  = array('chef_id'=>$sessarr['id'],'order_status'=>$status,'endtime'=>$time);    
	  }
	  else
	  {
	    $Array  = array('chef_id'=>$sessarr['id'],'order_status'=>$status);
	  }	  
	  $this->Commonmodel->UpdateData('tbl_order',$Array,'id',$ids);
	  $data['status'] = 'success';	
	  echo json_encode($data);  
   }
   
   function orderallstatus()	
   {
	 $sessarr = $this->session->userdata('sessdata');
	 $ids     = $this->input->post('id');
	 $status  = $this->input->post('status');	  
	 $time    = date("h:i:s a");
     $result  = $this->Commonmodel->getWhere('tbl_order','orderid',$ids);
	 foreach($result as $val)
	 {
	   if($status==$val['order_status'])
	   {
		 continue;
	   }
	   else if('4'==$val['order_status'])
	   {
		 continue;  
	   }
	   else if('5'==$val['order_status'])
	   {
		 continue;  
	   }
	   else
	   {		 
		 $Array = array('chef_id'=>$sessarr['id'],'order_status'=>$status,'starttime'=>$time);    
	     $this->Commonmodel->UpdateData('tbl_order',$Array,'id',$val['id']);	
	   }
	 }
	 $data['status'] = 'success';	
	 echo json_encode($data);
   }
//------------------------------------------------------------
   //-----------update by Jitu------------------->
   function viewtodayorder()
   {
	 $sessarr    = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 {
	   $data['userdata']  = $sessarr; 
	   $this->load->view('header',$data);
	   $this->load->view('managerviewtodayorder');		
	   $this->load->view('footer');
	 }
	 else
	 {			
	   $url=base_url().'admin';
	   redirect($url);		 
	 }
	}
   //-----------update by Jitu------------------->
   
   function viewallorder()
   {
	 $sessarr    = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 {
	   $data['userdata']  = $sessarr; 
	   $this->load->view('header',$data);
	   $this->load->view('managervieworder');		
	   $this->load->view('footer');
	 }
	 else
	 {			
	   $url=base_url().'admin';
	   redirect($url);		 
	 }
	}	
	
	function getOrders()
	{
	  $sessarr      = $this->session->userdata('sessdata');
	  if('admin'==$sessarr['roles'])
	  {
		$id = $sessarr['id'];  
	  }
	  else
	  {
		$id = $sessarr['manager_code'];  
	  }
	  $data['results'] = $this->Commonmodel->getallorder($sessarr['roles'],$id);
	  echo json_encode($data); 	
	}
	//-----------Updated by Jitu------------------
	function getTodayOrders()
	{
	  $sessarr      = $this->session->userdata('sessdata');
	  if('admin'==$sessarr['roles'])
	  {
		$id = $sessarr['id'];  
	  }
	  else
	  {
		$id = $sessarr['manager_code'];  
	  }
	  $data['results'] = $this->Commonmodel->getTodayorder($sessarr['roles'],$id);
	  echo json_encode($data); 	
	}
	//-----------Updated by Jitu------------------
    function getpreviousorder()
	{
	  $sessarr = $this->session->userdata('sessdata');
	  $ordid   = $this->input->post('id');
	  $data['results'] = $this->Commonmodel->getpreviousorder($sessarr['id'],$ordid);
	  echo json_encode($data); 
	}

	function getOrderMenu()
	{
	  $sessarr = $this->session->userdata('sessdata');
	  $id      = $this->input->post('id');
	  $data['results'] = $this->Commonmodel->getWhereOrder($id);
	  echo json_encode($data); 
	}	
	
	function getIndividualOrderMenu()
	{
	  $sessarr = $this->session->userdata('sessdata');
	  $id      = $this->input->post('id');
	  $data['results'] = $this->Commonmodel->getWheresOrders($id);
	  echo json_encode($data); 
	}

	function viewbillrequest()
    {
	  $sessarr    = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
		$data['userdata']  = $sessarr; 
		$this->load->view('header',$data);
		$this->load->view('viewbillrequest');		
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }
	}
	
	function billRequestOrder()
	{
	  $status = $this->input->post('status');
	  //$tbid   = $this->input->post('tbid');
	  $ordid   = $this->input->post('ordid');	  
	  $Array  = array('bill_request'=>$status);
	  $this->Commonmodel->UpdateData('tbl_order',$Array,'orderid',$ordid);
	  //$this->Commonmodel->UpdateData('tbl_order',$Array,'table_id',$tbid);
	  $data['status'] = 'success';	
	  echo json_encode($data);	
	}
	
	function Request()
	{
	  $sessarr         = $this->session->userdata('sessdata');
	  $data['results'] = $this->Commonmodel->BillRequest($sessarr['manager_code']);
	  echo json_encode($data); 	
	}
	
	function getbill()
	{
	  $order_id        = $this->input->post('order_id');
	  $data['results'] = $this->Commonmodel->getBill($order_id);
	  echo json_encode($data);
	}
	function getbill5()
	{
	  $order_id        = $this->input->post('order_id');
	  $data['results'] = $this->Commonmodel->getBill5($order_id);
	  echo json_encode($data);
	}

	function getbill1()
	{
	  $order_id        = $this->input->post('order_id');
	  $data['results'] = $this->Commonmodel->getBill1($order_id);
	  echo json_encode($data);
	}
	
    function getTax()
	{	  
	  $order_id        = $this->input->post('order_id');
	  $data['results'] = $this->Commonmodel->GetTaxes($order_id);
	  echo json_encode($data);
	}
    	
	/*function savebill()
	{
	  $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required');
	  $sessarr  = $this->session->userdata('sessdata');
	  if($this->form_validation->run() == FALSE)
      {
		$data['errors'] = validation_errors();
        $data['status'] = 'error';
        echo json_encode($data);          
      }
      else 
      {	
	    $customer_id     = $this->input->post('customer_id');	  
	    $customer_name   = $this->input->post('customer_name');
	    $customer_mobile = $this->input->post('customer_mobile');
	    $customer_email  = $this->input->post('customer_email');	  
	    $totals          = $this->input->post('totals');	  
	    $orderid         = $this->input->post('orderid');
	    $payment_mode    = $this->input->post('payment_mode'); 
	    $cgst            = $this->input->post('cgst');
	    $sgst            = $this->input->post('sgst');
	    $vat             = $this->input->post('vat');	
	    $coupan_code     = $this->input->post('coupan_code');
	    $discount        = $this->input->post('discount');
	    $discount        = $this->input->post('discount');
	    $payment_amount  = $this->input->post('payment_amount');
        $billArray = array(		                      
						    'order_id'       => $orderid,
						    'customer_id'    => $customer_id,
						    'payment_mode'   => $payment_mode,
						    'coupan_code'    => $coupan_code,
						    'discount'       => $discount,
						    'total'          => $totals,
						    'payment_amount' => $payment_amount,
						    'cgst'           => $cgst,
						    'sgst'           => $sgst,
						    'vat'            => $vat,
						  );	 
	   $insert = $this->Commonmodel->InsertData('tbl_payment',$billArray);
	   $Arrays  = array('customer_name'=>$customer_name,'customer_mobile'=>$customer_mobile,'customer_email'=>$customer_email);
	   $this->Commonmodel->UpdateData('tbl_customer',$Arrays,'id',$customer_id);
	   $Array  = array('bill_request'=>2);
	   $this->Commonmodel->UpdateData('tbl_order',$Array,'orderid',$orderid);
	   if($insert!='')
	   {
	     $data['status'] = 'success';	
	     echo json_encode($data);  
	   }
	 }	 
   }
    */
  function savebill()
	{
	  $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required');
	  $this->form_validation->set_rules('customer_mobile', 'Customer Mobile', 'required|min_length[10]|max_length[10]');
	  $couptype = $this->input->post('couptype');
	  if($couptype!='')
	  { 
	   $mobile   = $this->input->post('customer_mobile');
	   $cou_co   = $this->input->post('coupan_code');
	   $cou      = $this->Commonmodel->checkcoupon($mobile,$cou_co);
	   $disc     = $this->input->post('discount');	 
	   if(count($cou)!=0)
	   {	   
	    if($couptype == $cou[0]['discount_type']&&'Amount'==$cou[0]['discount_type'])
	    {		
		  if($disc!=$cou[0]['amount'])
		  { 
		   $this->form_validation->set_rules('discount', 'Discount', 'callback_coupon_validation');	
		  }	
	    }	   
	    if($couptype == $cou[0]['discount_type']&&'Percentage'==$cou[0]['discount_type'])
	    {		
		  if($disc!=$cou[0]['percentage'])
		  {
		   $this->form_validation->set_rules('discount', 'Discount', 'callback_coupon_percentage_validation');	
		  }	
	    }	   
	   }	  
	   if(count($cou)==0)
	   { 
	    if($cou_co!='')
	    {
		 $this->form_validation->set_rules('coupan_code', 'Coupon code', 'callback_coupon_expire_validation');		
	    }			
	   }
	  }	  
	  $sessarr  = $this->session->userdata('sessdata');
	  if($this->form_validation->run() == FALSE)
      {
		$data['errors'] = validation_errors();
        $data['status'] = 'error';
        echo json_encode($data);          
      }
      else 
      {	
	    $customer_id     = $this->input->post('customer_id');	  
	    $customer_name   = $this->input->post('customer_name');
	    $customer_mobile = $this->input->post('customer_mobile');
	    $customer_email  = $this->input->post('customer_email');	  
	    $totals          = $this->input->post('totals');	  
	    $orderid         = $this->input->post('orderid');
	    $payment_mode    = $this->input->post('payment_mode'); 
	    $cgst            = $this->input->post('cgst');
	    $sgst            = $this->input->post('sgst');
	    $vat             = $this->input->post('vat');	
	    $coupan_code     = $this->input->post('coupan_code');	    
	    $discount        = $this->input->post('discount');
	    $packaging_amount= $this->input->post('packaging_amount');
	    $payment_amount  = $this->input->post('payment_amount');
        $billArray = array(		                      
						    'order_id'       => $orderid,
						    'customer_id'    => $customer_id,
						    'payment_mode'   => $payment_mode,
						    'coupan_code'    => $coupan_code,
						    'discount'       => $discount,
						    'total'          => $totals,
						    'packaging_amount'=> $packaging_amount,
						    'payment_amount' => $payment_amount,
						    'cgst'           => $cgst,
						    'sgst'           => $sgst,
						    'vat'            => $vat,
						  );	 
	    $insert = $this->Commonmodel->InsertData('tbl_payment',$billArray);
	    $Arrays  = array('customer_name'=>$customer_name,'customer_mobile'=>$customer_mobile,'customer_email'=>$customer_email);
	    $this->Commonmodel->UpdateData('tbl_customer',$Arrays,'id',$customer_id);
	    $Array  = array('bill_request'=>2);
	    $this->Commonmodel->UpdateData('tbl_order',$Array,'orderid',$orderid);
	    //$Arrays  = array('status'=>2);
	    //$this->Commonmodel->UpdateData('tbl_coupan',$Arrays,'coupan_code',$coupan_code);
	    if($insert!='')
	    {
	      $data['status'] = 'success';	
	      echo json_encode($data);  
	    }	
	  }
    }
    
    function coupon()
    {
	   $mobile          = $this->input->post('mobile');	  
	   $cou_co          = $this->input->post('coupan');	  
	   $data['results'] = $this->Commonmodel->checkcoupon($mobile,$cou_co);	
	   echo json_encode($data);
	}	
		
    public function coupon_validation($field_value) 
    {
      if ($field_value != '')
      {
        $this->form_validation->set_message('coupon_validation', "Please enter correct discount amount");
        return FALSE;
      }
	  else
	  {		  
        return TRUE;
      }
    }
   
    public function coupon_percentage_validation($field_value) 
    {
      if ($field_value != '')
      {
        $this->form_validation->set_message('coupon_percentage_validation', "Please enter correct discount percentage");
        return FALSE;
      }
      else
      {
        return TRUE;
      }
    }   
   
    public function coupon_expire_validation($field_value) 
    {
      if($field_value != '')
      {
        $this->form_validation->set_message('coupon_expire_validation', "This coupon code is invalid or has expired.");
        return FALSE;
      }
      else
      {
        return TRUE;
      }
    }

   
   function viewpayment()
   {
     $sessarr    = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 {
	   if('admin'==$sessarr['roles'])
	   {
		 $id = $sessarr['id'];	   
	   }else{		   
		 $id = $sessarr['manager_code']; 
	   }
	   $result['result'] = $this->Commonmodel->Paymentview($sessarr['roles'],$id);
	   $data['userdata']  = $sessarr; 
	   $this->load->view('header',$data);
	   $this->load->view('viewpayment',$result);		
	   $this->load->view('footer');
	 }
	 else
	 {			
	   $url=base_url().'admin';
	   redirect($url);		 
	 }   
   }

   //--------Updated by Jitu---------------
   function viewtodaypayment()
   {
     $sessarr    = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 {
	   if('admin'==$sessarr['roles'])
	   {
		 $id = $sessarr['id'];	   
	   }else{		   
		 $id = $sessarr['manager_code']; 
	   }
	   $result['result'] = $this->Commonmodel->PaymentTodayview($sessarr['roles'],$id);
	   $data['userdata']  = $sessarr; 
	   $this->load->view('header',$data);
	   $this->load->view('viewtodaypayment',$result);		
	   $this->load->view('footer');
	 }
	 else
	 {			
	   $url=base_url().'admin';
	   redirect($url);		 
	 }   
   }
   //---------------Updated by Jitu-------------

    
   function viewcustomer()
   {   
      $sessarr    = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
	    if('admin'==$sessarr['roles'])
	    {
		  $id = $sessarr['id'];
	    }
	    else
	    { 		   
		  $id = $sessarr['manager_code']; 
	    }	   
	    $result['result'] = $this->Commonmodel->getcustomer($sessarr['roles'],$id);
	    $data['userdata'] = $sessarr; 
	    $this->load->view('header',$data);
	    $this->load->view('viewcustomers',$result);		
	    $this->load->view('footer');
	  }
	  else
	  {			
	    $url=base_url().'admin';
	    redirect($url);		 
	  } 
   }
   
   function deletecustomer()
   {
     $ids   = $this->input->post('id');		
	 $Array = array('status'=>0);
	 $this->Commonmodel->UpdateData('tbl_customer',$Array,'id',$ids);
	 $data['status'] = 'success';	
	 echo json_encode($data);	
   }
   
   function paymentReport()
   {
      $sessarr    = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  { 
	    $result['branch'] = $this->Commonmodel->get_Record('tbl_branch',"desc");
	    $result['userdata'] = $sessarr; 
	    $this->load->view('header',$result);
	    $this->load->view('payment_report_form',$result);		
	    $this->load->view('footer');
	  }
	  else
	  {			
	    $url=base_url().'admin';
	    redirect($url);		 
	  }    
   }
    
   function getCustomerPayment()
	{
	  $sessarr      = $this->session->userdata('sessdata');
	  if('admin'==$sessarr['roles'])
	  {
		$id = $sessarr['id'];  
	  }
	  else
	  {
		$id = $sessarr['manager_code'];  
	  }
	  $data['results'] = $this->Commonmodel->getPayment($sessarr['roles'],$id);
	  echo json_encode($data); 	
	}

   function paymentexcelReport()
   {
     $sessarr    = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 { 
	    $branchid = $this->input->post('branch_id');
	    $from     = $this->input->post('from_date');
	    $to       = $this->input->post('to_date');
		$this->load->library("excel");
		$object = new PHPExcel();		
		$object->setActiveSheetIndex(0);
		$table_columns = array("SrNo","Order Id", "Branch Name", "Payment Mode", "Coupan Code", "Discount", "Total","Payment Amount","Created Date");
        $column = 0;		
		foreach($table_columns as $field)
		{
		  $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
		  $column++;
		}		
		$branchdata = $this->Commonmodel->reportOrder($branchid,$from,$to);
        $excel_row = 2; $i=1;		
		foreach($branchdata as $row)
		{
		  $date = date("d-m-Y H:i:s", strtotime($row['created_at']));
		  $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['order_id']);		  
		  $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['branch_name']);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['payment_mode']);		  
		  $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['coupan_code']);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['discount']);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['total']);
		  $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['payment_amount']);
          $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $date);		  
		  $excel_row++;
		  $i++;
		}		
		$object_writer = PHPExcel_IOFactory::createWriter($object,'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Report Data.xls"');
		$object_writer->save('php://output');		
	 }
	 else
	 {			
	    $url=base_url().'admin';
	    redirect($url);		 
	 }  
   }
      
   function maximumReport()
   {
     $sessarr = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 { 
	   $result['branch'] = $this->Commonmodel->get_Record('tbl_branch',"desc");
	   $result['userdata'] = $sessarr; 
	   $this->load->view('header',$result);
	   $this->load->view('maximum_report_form',$result);		
	   $this->load->view('footer');
	 }
	 else
	 {			
	   $url=base_url().'admin';
	   redirect($url);		 
	 }    
   }   
   
   function getMaximumItems()
	{
	  $sessarr      = $this->session->userdata('sessdata');
	  if('admin'==$sessarr['roles'])
	  {
		$id = $sessarr['id'];  
	  }
	  else
	  {
		$id = $sessarr['manager_code'];  
	  }
	  $data['results'] = $this->Commonmodel->getMaximumitem($sessarr['roles'],$id);
	  echo json_encode($data); 	
	}

   function MaximumFoodReport()
   {
     $sessarr    = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 {   
       $branchid = $this->input->post('branch_id');
	   $from     = $this->input->post('from_date');
	   $to       = $this->input->post('to_date');
	   $this->load->library("excel");
	   $object = new PHPExcel();		
	   $object->setActiveSheetIndex(0);
	   $table_columns = array("SrNo", "Branch Name", "Menu Name", "Qty");
       $column = 0;		
	   foreach($table_columns as $field)
	   {
		 $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
		 $column++;
	   }		
	   $branchdata = $this->Commonmodel->reportMaximumfood($branchid,$from,$to);
       $excel_row = 2; $i=1;		
	   foreach($branchdata as $row)
	   {		 
		 $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);		  		  
		 $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['branch_name']);	  
		 $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['menu_name']);
		 $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['qty']);	          
		 $excel_row++;
		 $i++;
	   }		
	   $object_writer = PHPExcel_IOFactory::createWriter($object,'Excel5');
	   header('Content-Type: application/vnd.ms-excel');
	   header('Content-Disposition: attachment;filename="Maximum Food Report.xls"');
	   $object_writer->save('php://output');
     }
	 else
	 {			
	    $url=base_url().'admin';
	    redirect($url);		 
	 }  
   }
      
   function waiterchefReport()
   {
     $sessarr = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 { 
	   $result['branch'] = $this->Commonmodel->get_Record('tbl_branch',"desc");
	   $result['userdata'] = $sessarr; 
	   $this->load->view('header',$result);
	   $this->load->view('waiter_chef_report_form',$result);		
	   $this->load->view('footer');
	 }
	 else
	 {			
	   $url=base_url().'admin';
	   redirect($url);		 
	 }    
   } 
   
   function getwaiterRecord()
   {
	 $roles = $this->input->post('roles');
	 $ids   = $this->input->post('branchid');
	 //if('waiter'==$roles)
	 //{	 
	   $data['results'] = $this->Commonmodel->GetRecords($roles,$ids);
	   echo json_encode($data);
	 /*}
	 else
	 {
	   $data['results'] = $this->Commonmodel->GetRecords('tbl_chef',$ids);
	   echo json_encode($data);
	 }*/	 
   }
   function getWaiterReport()
	{
	  $sessarr      = $this->session->userdata('sessdata');
	  if('admin'==$sessarr['roles'])
	  {
		$id = $sessarr['id'];  
	  }
	  else
	  {
		$id = $sessarr['manager_code'];  
	  }
	  $data['results'] = $this->Commonmodel->getWaiterAllRecord($sessarr['roles'],$id);
	  echo json_encode($data); 	
	}  
   function reportWaiter()
   {
     $sessarr    = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 {   
       $branchid = $this->input->post('branch_id');	   
	   $roles    = $this->input->post('roles');
	   $id       = $this->input->post('ids');	  
	   $from     = $this->input->post('from_date');
	   $to       = $this->input->post('to_date');	   
	   $this->load->library("excel");
	   $object = new PHPExcel();		
	   $object->setActiveSheetIndex(0);
	   if('waiter'==$roles)
	   {	   
	      $table_columns = array("SrNo", "Branch Name", "Table No", "Order Id", "Manager Code", "Waiter Code", "Created Date");
       }
	   else
	   {
		  $table_columns = array("SrNo", "Branch Name", "Table No", "Order Id", "Manager Code", "Chef Code", "Created Date");    
	   }
	   $column = 0;		
	   foreach($table_columns as $field)
	   {
		 $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
		 $column++;
	   }		
	   $branchdata = $this->Commonmodel->reportWaiter($branchid,$id,$roles,$from,$to);
       $excel_row = 2; $i=1;		
	   foreach($branchdata as $row)
	   {
		 $date = date("d-m-Y H:i:s", strtotime($row['created_at']));
		 if('waiter'==$roles)
	     {
		   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);		  		  
		   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['branch_name']);
		   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['table_number']);
		   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['orderid']);		  
		   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['manager_code']);
		   $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['waiter_code']);
		   $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $date);		  
		 }
		 else
		 {
		   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);		  		  
		   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['branch_name']);
		   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['table_number']);
		   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['orderid']);		  
		   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['manager_code']);
		  // $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['waiter_code']);
		   $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['chef_code']);
		   $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $date);	 
		 }		 
		 $excel_row++;
		 $i++;
	   }		
	   $object_writer = PHPExcel_IOFactory::createWriter($object,'Excel5');
	   header('Content-Type: application/vnd.ms-excel');
	   header('Content-Disposition: attachment;filename="Report.xls"');
	   $object_writer->save('php://output');
     }
	 else
	 {			
	   $url=base_url().'admin';
	   redirect($url);		 
	 }  
   } 
  
   function itemReport()
   {
     $sessarr = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 { 
	   $result['branch'] = $this->Commonmodel->get_Record('tbl_branch',"desc");
	   $result['userdata'] = $sessarr; 
	   $this->load->view('header',$result);
	   $this->load->view('item_report_form',$result);		
	   $this->load->view('footer');
	 }
	 else
	 {			
	   $url=base_url().'admin';
	   redirect($url);		 
	 }    
   }

   function getCustomer()
	{
	  $sessarr      = $this->session->userdata('sessdata');
	  if('admin'==$sessarr['roles'])
	  {
		$id = $sessarr['id'];  
	  }
	  else
	  {
		$id = $sessarr['manager_code'];  
	  }
	  $data['results'] = $this->Commonmodel->getallCustomer($sessarr['roles'],$id);
	  echo json_encode($data); 	
	}

   function getItems()
	{
	  $sessarr      = $this->session->userdata('sessdata');
	  if('admin'==$sessarr['roles'])
	  {
		$id = $sessarr['id'];  
	  }
	  else
	  {
		$id = $sessarr['manager_code'];  
	  }
	  $data['results'] = $this->Commonmodel->getallitem($sessarr['roles'],$id);
	  echo json_encode($data); 	
	}
   function itemexcelReport()
   {
     $sessarr    = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 {   
       $branchid = $this->input->post('branch_id');
	   $from     = $this->input->post('from_date');
	   $to       = $this->input->post('to_date');
	   $item 	 = $this->input->post('item');
	   $this->load->library("excel");
	   $object = new PHPExcel();		
	   $object->setActiveSheetIndex(0);
	   $table_columns = array("SrNo", "Branch Name", "Menu Name", "Qty", "Date");
       $column = 0;		
	   foreach($table_columns as $field)
	   {
		 $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
		 $column++;
	   }		
	   $branchdata = $this->Commonmodel->reportMaximumitem($branchid,$from,$to,$item);
       $excel_row = 2; $i=1;		
	   foreach($branchdata as $row)
	   {		 
		 $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);		  		  
		 $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['branch_name']);
		 $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['menu_name']);
		 $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['qty']);
		 $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['created_at']);   
		 $excel_row++;
		 $i++;
	   }		
	   $object_writer = PHPExcel_IOFactory::createWriter($object,'Excel5');
	   header('Content-Type: application/vnd.ms-excel');
	   header('Content-Disposition: attachment;filename="Item Food Report.xls"');
	   $object_writer->save('php://output');
     }
	 else
	 {			
	    $url=base_url().'admin';
	    redirect($url);		 
	 }  
   } 

   function consolidatedReport()
   {
     $sessarr = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 { 
	   $result['branch'] = $this->Commonmodel->get_Record('tbl_branch',"desc");
	   $result['userdata'] = $sessarr; 
	   $this->load->view('header',$result);
	   $this->load->view('consilidate_report_form',$result);		
	   $this->load->view('footer');
	 }
	 else
	 {			
	   $url=base_url().'admin';
	   redirect($url);		 
	 }    
   }

   function getCategory()
	{
	  $sessarr      = $this->session->userdata('sessdata');
	  if('admin'==$sessarr['roles'])
	  {
		$id = $sessarr['id'];  
	  }
	  else
	  {
		$id = $sessarr['manager_code'];  
	  }
	  $data['results'] = $this->Commonmodel->getallcategory($sessarr['roles'],$id);
	  echo json_encode($data); 	
	}

   function consolidateexcelReport()
   {
     $sessarr    = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 {   
       $branchid = $this->input->post('branch_id');
	   $from     = $this->input->post('from_date');
	   $to       = $this->input->post('to_date');
	   $category 	 = $this->input->post('category');
	   $this->load->library("excel");
	   $object = new PHPExcel();		
	   $object->setActiveSheetIndex(0);
	   $table_columns = array("SrNo", "Branch Name", "Category Name", "Qty", "Date");
       $column = 0;		
	   foreach($table_columns as $field)
	   {
		 $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
		 $column++;
	   }		
	   $branchdata = $this->Commonmodel->reportMaximumCategory($branchid,$from,$to,$category);
       $excel_row = 2; $i=1;		
	   foreach($branchdata as $row)
	   {		 
		 $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);		  		  
		 $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['branch_name']);
		 $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['category_name']);
		 $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['qty']);
		 $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['created_at']);   
		 $excel_row++;
		 $i++;
	   }		
	   $object_writer = PHPExcel_IOFactory::createWriter($object,'Excel5');
	   header('Content-Type: application/vnd.ms-excel');
	   header('Content-Disposition: attachment;filename="Category Food Report.xls"');
	   $object_writer->save('php://output');
     }
	 else
	 {			
	    $url=base_url().'admin';
	    redirect($url);		 
	 }  
   }
   function customerReport()
   {
     $sessarr = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 { 
	   $result['branch'] = $this->Commonmodel->get_Record('tbl_branch',"desc");
	   $result['userdata'] = $sessarr; 
	   $this->load->view('header',$result);
	   $this->load->view('customer_report_form',$result);		
	   $this->load->view('footer');
	 }
	 else
	 {			
	   $url=base_url().'admin';
	   redirect($url);		 
	 }    
   }
   function CustomerexcelReport()
   {
     $sessarr    = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 {   
       $branchid = $this->input->post('branch_id');
	   $from     = $this->input->post('from_date');
	   $to       = $this->input->post('to_date');
	   $this->load->library("excel");
	   $object = new PHPExcel();		
	   $object->setActiveSheetIndex(0);
	   $table_columns = array("SrNo","Branch Name", "Customer Name", "Customer Mobile", "Customer Email", "Amount","payment_mode");
       $column = 0;		
	   foreach($table_columns as $field)
	   {
		 $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
		 $column++;
	   }		
	   $branchdata = $this->Commonmodel->reportMaximumCustomer($branchid,$from,$to);
       $excel_row = 2; $i=1;		
	   foreach($branchdata as $row)
	   {		 
		 $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);		  		  
		 $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['branch_name']);
	   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['customer_name']);
		$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['customer_mobile']);
		$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['customer_email']);  
		$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['payment_amount']);
		$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['payment_mode']);
		 $excel_row++;
		 $i++;
	   }		
	   $object_writer = PHPExcel_IOFactory::createWriter($object,'Excel5');
	   header('Content-Type: application/vnd.ms-excel');
	   header('Content-Disposition: attachment;filename="Customer Report.xls"');
	   $object_writer->save('php://output');
     }
	 else
	 {			
	    $url=base_url().'admin';
	    redirect($url);		 
	 }  
   }

   function newCoupons()
   {
	 $sessarr = $this->session->userdata('sessdata');
	 if($sessarr['status']==1)
	 { 	   
	   $data['userdata'] = $sessarr; 
	   $this->load->view('header',$data);
	   $this->load->view('newcoupons');		
	   $this->load->view('footer');
	 }
	 else
	 {			
	   $url=base_url().'admin';
	   redirect($url);		 
	 }       
   }
     
   function saveCoupons()
   {
     $sessarr = $this->session->userdata('sessdata'); 
	 if($sessarr['status']==1)
	 {
	    $this->form_validation->set_rules('from_date', 'From Date', 'required');
	    $this->form_validation->set_rules('to_date', 'To Date', 'required');
	    $this->form_validation->set_rules('discount_type', 'Discount Type', 'required');
	    //$this->form_validation->set_rules('coupons', 'No Of Coupons', 'required');

	    if($this->input->post('discount_type')=='Amount')
	    {   
	      $this->form_validation->set_rules('amount', 'Amount', 'required');
	    }
	   
	    if($this->input->post('discount_type')=='Percentage')
	    {   
	      $this->form_validation->set_rules('percentage', 'Percentage', 'required');
	    }
	   
	    if($this->form_validation->run() == FALSE)
        {
		  $data['errors'] = validation_errors();
          $data['status'] = 'error';
          echo json_encode($data);          
        }
        else 
        {	
	       $from_date = $this->input->post('from_date');	   
	       $to_date   = $this->input->post('to_date');
	       $discount  = $this->input->post('discount_type');
	       $amount    = $this->input->post('amount');
	       $per       = $this->input->post('percentage');
	       //$coupons   = $this->input->post('coupons');
	       //$data      = $this->Commonmodel->coupons($sessarr['manager_code']);
	       //$j=0;
	       //foreach($data as $val)
	       //for($i=1;$i<$coupons;$i++)
	       //{
	         //$id     = $val['id'];
	         //$mobile = $val['customer_mobile'];
	         //$state  = $val['state_id'];
	        /* if($discount=="Percentage")
	         {
		        $mag = $per.'% '.'discount';		   
	         }else{			 
		        $mag = $amount.'rs '.'cash';	
	         }
	         */
	         $code    = strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 6));
	         //$message = "hurry up. $mag on total bill of your meal. Use the code $code and get the discount valid from $from_date to $from_date";
	         $couponsArray=array(
		                          // 'customer_id'     => $id,
							      // 'customer_mobile' => $mobile,
							      // 'message'         => $message,
							       'manager_code'    => $sessarr['manager_code'],
							       'coupan_code'     => $code,
							       'from_date'       => $from_date,
							       'to_date'         => $to_date,
							       'discount_type'   => $discount,
							       'amount'          => $amount,
							       'percentage'      => $per,
							      // 'state_id'        => $state
		                        );
	         $insert = $this->Commonmodel->InsertData('tbl_coupan',$couponsArray);
	         if($insert!='')
	         {
                $datas['status'] = 'success';	
	            echo json_encode($datas);  
             }
	        /* if($insert!='')
	         {
		       $username = "demo2";
	           $password = "demo@123";
	           $sender   = "MOBSFT";	   
	           $messages = urlencode($message);
	           $api_url  = "http://makemysms.in/api/sendsms.php?username=".$username."&password=".$password."&sender=".$sender."&mobile=".$mobile."&type=1&product=1&message=".$messages;
	           $output   = file_get_contents($api_url);
	        }*/		
	       // $j++;
	      //}	   
	     // if(count($data)==$i) 
	     /* if(coupons==$j) 
	      {		
		     $datas['status'] = 'success';	
	         echo json_encode($datas);  
	      }*/
	   }
	  }
	  else
	  {			
	    $url=base_url().'admin'; 
	    redirect($url);		 
	  }
    }
   
    function viewCoupons()
    {
       $sessarr    = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {	      
	     $result['result'] = $this->Commonmodel->getcoupons($sessarr['manager_code']);
	     $data['userdata'] = $sessarr; 
	     $this->load->view('header',$data);
	     $this->load->view('viewcoupons',$result);		
	     $this->load->view('footer');
	   }
	   else
	   {			
	     $url=base_url().'admin';
	     redirect($url);		 
	   }    
    }  

    function postQty()
	{
	  $id     = $this->input->post('id');	   
	  $qty    = $this->input->post('qty');
	  $Array  = array('qty'=>$qty);
	  $insert = $this->Commonmodel->UpdateData('tbl_temp_order',$Array,'id',$id);  
	  if($insert!='')
	  {
	    $data['status'] = 'success';	
	    echo json_encode($data);	  
	  }
	}	

  }
//-------------------IMPORTANT------------------