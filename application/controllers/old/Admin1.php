<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function index()
	{
		//$this->load->view('header');
		 $data['msg']="";
		 $data['msg1']="";
		 $this->load->view('login',$data);		
		//$this->load->view('footer');
	}
	
//----------------------------------Create Login-----------------------------	
	
	public function loginverify()
    { 
	    $Username = $this->input->post('Username');   
        $Password = $this->input->post('Password');		
	    $login    = array('username'=>$Username);  
	    $result1  = $this->Commonmodel->CheckLogin('tbl_users',$login);
		$logins   = array('password'=>$Password);  
		$result2  = $this->Commonmodel->CheckLogin('tbl_users',$logins);
		
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
		
		if($data['msg1']!=''||$data['msg']!='')
		{
		  $this->load->view('login',$data);	
		}
		else
		{
            $login    = array('username'=>$Username,'password'=>$Password,'status'=>1);
		    $result   = $this->Commonmodel->CheckLogin('tbl_users',$login);           
			if(count($result)!=0)
			{
		      $this->session->set_userdata('sessdata',$result[0]);
		      $sessarr  = $this->session->userdata('sessdata');				
		      if($result[0]['status']==1)
		      {			
			    redirect('admin/dashboard');	
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
	
	function logoutadmin()
	{
	    $this->session->sess_destroy(); 
		$log=base_url().'admin';
		redirect("$log");	  
    }	
	
    function logout()
	{
	    $this->session->sess_destroy();     
        $log=base_url();
		redirect($log);	  
    }	
	
//---------------------------------------------------------------------------
    public function dashboard()
	{
	   $sessarr               = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {	     
		 $result['order']     = $this->Commonmodel->data_count('tbl_order');
		 $result['customer']  = $this->Commonmodel->data_count('tbl_customer'); 
		 $result['product']   = $this->Commonmodel->data_count('tbl_product'); 
		 $result['wishlist']  = $this->Commonmodel->data_count('tbl_wishlist'); 
		 //print_r($result['order']);
		 
		 $this->load->view('header');
	     $this->load->view('dashboard',$result);		
	     $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   }	 
	}
	
//-----------------------------------Create Menu-----------------------------
	
	public function newMenu()
	{
	   $sessarr              = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
		 $this->load->view('header');
		 $this->load->view('newMenu');		
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   }
	}	
	
	
	public function viewMenu()
	{
	   $sessarr              = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
		 $data['result']  =  $this->Commonmodel->get_All_Record('tbl_menu');
		 $this->load->view('header');		
		 $this->load->view('viewMenu',$data);
		 $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   } 
	}
	
	
	function saveMenu()
	{		
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	  
		if($this->input->post('editid')==''&&$this->input->post('menu_name')=='')
		{	
		  $this->form_validation->set_rules('menu_name', 'Menu Name', 'required'); 
		}
		else if($this->input->post('editid')=='')
		{
		  $this->form_validation->set_rules('menu_name', 'Menu Name', 'required|callback_alpha_dash_space|is_unique[tbl_menu.menu_name]');	/*callback_alpha_dash_space*/		
		}	
		else
		{
		  $ids  =$this->input->post('editid');
		  $menu = $this->input->post('menu_name');		  
		  $data =  $this->Commonmodel->getWhere('tbl_menu','menu_id',$ids);
		  if($data[0]['menu_name']==$menu)
		  { 	  
		    $this->form_validation->set_rules('menu_name', 'Menu Name', 'required|callback_alpha_dash_space');	 	
		  }
		  else
		  {
			$this->form_validation->set_rules('menu_name', 'Menu Name', 'required|callback_alpha_dash_space|is_unique[tbl_menu.menu_name]');	 	  
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
		   $menu_name = $this->input->post('menu_name');
		   $menuArray = array('menu_name'=>$menu_name);		  
		   if($this->input->post('editid')!='') 
		   {
			 $edit_id = $this->input->post('editid');
			 $insert  = $this->Commonmodel->UpdateData('tbl_menu',$menuArray,'menu_id',$edit_id);  
		   }
		   else
		   {
		     $insert  =  $this->Commonmodel->InsertData('tbl_menu',$menuArray);
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
	
	
	function alpha_dash_space($str)
    {
        //return ( ! preg_match("/^([-a-zA-Z_ ])+$/i", $str)) ? FALSE : TRUE;
		
		/*if ( !preg_match('/^[a-zA-Z .,\-]+$/i',$str))
        {
            $this->form_validation->set_message('alpha_dash_space', 'error message');
			return false;
        }
		else{
			return true;			
		}
		*/
		
		
	
    if (! preg_match('/^[a-zA-Z\s]+$/', $str)) {
        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
        return FALSE;
    } else {
        return TRUE;
    }

		
		
    }
	
	
	
	function alpha_dash($str)
    {       	
       if (! preg_match('/^[a-zA-Z -]+$/', $str))
	   {
           $this->form_validation->set_message('alpha_dash', 'The %s field may only contain alpha characters & dash');
           return FALSE;
       }
	   else
	   {
           return TRUE;
       }
    }
		
	
	
	
		
	
	function editMenu()
	{
	  $sessarr           = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$id              = $this->uri->segment(3);
		$data['result']  = $this->Commonmodel->getWhere('tbl_menu','menu_id',$id);		
		$this->load->view('header');		
		$this->load->view('editMenu',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	
	}
	
	
	function deleteMenu()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids = $this->input->post('menu_id');		
		$data['result']   =  $this->Commonmodel->deleteRecord('tbl_menu','menu_id',$ids);
		                     $this->Commonmodel->deleteRecord('tbl_category','menu_id',$ids);
							 $this->Commonmodel->deleteRecord('tbl_sub_category','menu_id',$ids);
							 $this->Commonmodel->deleteRecord('tbl_product','menu_id',$ids);							 
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
	function statuschangeMenu()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids             = $this->input->post('id');
		$status          = $this->input->post('status');
		$menuArray       = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_menu',$menuArray,'menu_id',$ids);
		                   $this->Commonmodel->UpdateData('tbl_category',$menuArray,'menu_id',$ids);
						   $this->Commonmodel->UpdateData('tbl_sub_category',$menuArray,'menu_id',$ids);
						   $this->Commonmodel->UpdateData('tbl_product',$menuArray,'menu_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
//-----------------------------------Create Category-----------------------------
	
	public function newCategory()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['menu']  =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
		//$data['menu']  =  $this->Commonmodel->get_All_Record('tbl_menu');
		$this->load->view('header');		
		$this->load->view('newCategory',$data);		
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
	}	
	
	
	public function viewCategory()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$data['result']  =  $this->Commonmodel->get_all_joins('tbl_category');
		$this->load->view('header');		
		$this->load->view('viewCategory',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
	}

	
	function saveCategory()
	{		
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('menu_id', 'Menu Name', 'required');
        
		
		if($this->input->post('editid')==''&&$this->input->post('category_name')=='')
		{	
		  $this->form_validation->set_rules('category_name', 'Category Name', 'required'); 
		}
		else if($this->input->post('editid')=='')
		{	
		 $this->form_validation->set_rules('category_name', 'Category Name', 'required|callback_alpha_dash_space|is_unique[tbl_category.category_name]');/*callback_alpha_dash_space*/
        }
		else
		{
		  $ids  =$this->input->post('editid');
		  $category = $this->input->post('category_name');		  
		  $data =  $this->Commonmodel->getWhere('tbl_category','category_id',$ids);
		  if($data[0]['category_name']==$category)
		  { 	  
		    $this->form_validation->set_rules('category_name', 'Category Name', 'required|callback_alpha_dash_space');	 	
		  }
		  else
		  {
			$this->form_validation->set_rules('category_name', 'Category Name', 'required|callback_alpha_dash_space|is_unique[tbl_category.category_name]');	 	  
		  }
		}
		
		$this->form_validation->set_rules('meta_tag_title', 'Meta Tag Title', 'required');
		$this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'required');
		
		if($this->form_validation->run() == FALSE)
        {
			$data['errors'] = validation_errors();
            $data['status'] = 'error';
            echo json_encode($data);
          //$this->load->view('myform');
        }
        else
        {
           $menu_id        = $this->input->post('menu_id');
		   $category_name  = $this->input->post('category_name');
		   $meta_tag_title = $this->input->post('meta_tag_title');
		   $meta_keyword   = $this->input->post('meta_keyword');
		   
		   $categoryArray = array(
		                           'menu_id'        => $menu_id,
		                           'category_name'  => $category_name,
								   'meta_tag_title' => $meta_tag_title,
		                           'meta_keyword'   => $meta_keyword								   
								 );
		  
		   
		   if($this->input->post('editid')!='') 
		   {
			 $edit_id = $this->input->post('editid');
			 $insert  = $this->Commonmodel->UpdateData('tbl_category',$categoryArray,'category_id',$edit_id);  
		   }
		   else
		   {
		     $insert =  $this->Commonmodel->InsertData('tbl_category',$categoryArray);
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
	
	
	function editCategory()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$id              =  $this->uri->segment(3);
		$data['result']  =  $this->Commonmodel->getWhere('tbl_category','category_id',$id);	
		$data['menu']    =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
		//$data['menu']    =  $this->Commonmodel->get_All_Record('tbl_menu');
		$this->load->view('header');		
		$this->load->view('editCategory',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
	}
	
	
	function deleteCategory()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids = $this->input->post('category_id');		
		$data['result']   =  $this->Commonmodel->deleteRecord('tbl_category','category_id',$ids);		                    
							 $this->Commonmodel->deleteRecord('tbl_sub_category','category_id',$ids);
							 $this->Commonmodel->deleteRecord('tbl_product','category_id',$ids);	 
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
	function statuschangeCategory()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$ids             = $this->input->post('id');
		$status          = $this->input->post('status');
		$categoryArray   = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_category',$categoryArray,'category_id',$ids);
		                   $this->Commonmodel->UpdateData('tbl_sub_category',$categoryArray,'category_id',$ids);
						   $this->Commonmodel->UpdateData('tbl_product',$categoryArray,'category_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
	
//-----------------------------------Create Sub Category-----------------------------
	
	public function newSubCategory()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		//$data['menu']  =  $this->Commonmodel->get_All_Record('tbl_menu');
		$data['menu']  =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
		$this->load->view('header');
		$this->load->view('newSubCategory',$data);		
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	 	
	}	
	
	
	public function getCategory()
    {        
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  { 
	    $id                 =  $this->input->post('id');
	    $filed              =  $this->input->post('menu_id');
		
        $data['results']    =  $this->Commonmodel->get_All_Wheres_Record('tbl_category',$filed,$id);	 
		//$data['results']    =  $this->Commonmodel->getWhere('tbl_category',$filed,$id);	     
	    
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	  
    }
	
	
	public function viewSubCategory()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['result']  =  $this->Commonmodel->get_all_joins('tbl_sub_category');
		$this->load->view('header');		
		$this->load->view('viewSubCategory',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
	}	

	
	function saveSubCategory()
	{		
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('category_id', 'Category', 'required');
        
		
		if($this->input->post('editid')==''&&$this->input->post('sub_category_name')=='')
		{	
		  $this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'required'); 
		}
		else if($this->input->post('editid')=='')
		{
		  $this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'required|callback_alpha_dash|is_unique[tbl_sub_category.sub_category_name]');/*callback_alpha_dash_space*/		
		}
		else
		{
		  $ids  =$this->input->post('editid');
		  $sub_category = $this->input->post('sub_category_name');		  
		  $data =  $this->Commonmodel->getWhere('tbl_sub_category','sub_category_id',$ids);
		  if($data[0]['sub_category_name']==$sub_category)
		  { 	  
		    $this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'required|callback_alpha_dash');	 	
		  }
		  else
		  {
			$this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'required|callback_alpha_dash|is_unique[tbl_sub_category.sub_category_name]');	 	  
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
           $menu_id           = $this->input->post('menu_id');
		   $category_id       = $this->input->post('category_id');
		   $sub_category_name = $this->input->post('sub_category_name'); 
		   $sub_categoryArray = array(
		                               'menu_id'            => $menu_id,
									   'category_id'        => $category_id,
		                               'sub_category_name'  => $sub_category_name								  						   
								     );
			
		   if($this->input->post('editid')!='') 
		   {
			 $edit_id = $this->input->post('editid');
			 $insert  = $this->Commonmodel->UpdateData('tbl_sub_category',$sub_categoryArray,'sub_category_id',$edit_id);  
		   }
		   else
		   {
		     $insert =  $this->Commonmodel->InsertData('tbl_sub_category',$sub_categoryArray);		  
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

	function editSubCategory()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$id              =  $this->uri->segment(3);
		$data['result']  =  $this->Commonmodel->getWhere('tbl_sub_category','sub_category_id',$id);	
		
		$data['menu']    =  $this->Commonmodel->get_All_Active_Record('tbl_menu');		
		//$data['menu']    =  $this->Commonmodel->get_All_Record('tbl_menu');
		
		$this->load->view('header');		
		$this->load->view('editSubCategory',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }  
	}
	
	
	function deleteSubCategory()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids = $this->input->post('sub_category_id');		
		$data['result']   =  $this->Commonmodel->deleteRecord('tbl_sub_category','sub_category_id',$ids);
		                     $this->Commonmodel->deleteRecord('tbl_product','sub_category_id',$ids);	
		echo json_encode($data);
      }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 
	}
	
	function statuschangeSubCategory()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids             = $this->input->post('id');
		$status          = $this->input->post('status');
		$subcategoryArray   = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_sub_category',$subcategoryArray,'sub_category_id',$ids);
		                   $this->Commonmodel->UpdateData('tbl_product',$subcategoryArray,'sub_category_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
    }
	
	
//-----------------------------------Create Product-----------------------------
	
	public function newProduct()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		
		$data['menu']  =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
		$data['unit']  =  $this->Commonmodel->get_All_Active_Record('tbl_unit');
		//$data['menu']  =  $this->Commonmodel->get_All_Record('tbl_menu');
		$this->load->view('header');
		$this->load->view('newProduct',$data);		
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
	}	
	
	
	public function viewProduct()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['result']  =  $this->Commonmodel->get_all_joins('tbl_product');
		$this->load->view('header');		
		$this->load->view('viewProduct',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
	}	
	
	
	public function getsubCategory()
    {        
	  $sessarr            = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {  
	    $id               =  $this->input->post('id');
	    $filed            =  $this->input->post('category_id');//sub_category_id
        $data['results']  =  $this->Commonmodel->get_All_Wheres_Record('tbl_sub_category',$filed,$id);
		//$data['results']  =  $this->Commonmodel->getWhere('tbl_sub_category',$filed,$id);
		
	    echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }  
    }
		
	public function getProducts()
    {        
	  $sessarr           = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {  
	    $id              =  $this->input->post('id');
	    $filed           =  $this->input->post('sub_category_id');
        $data['results'] =  $this->Commonmodel->get_All_Wheres_Record('tbl_product',$filed,$id);		
	    echo json_encode($data);
	  }
	  else 
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }  
    }
	
	
	function saveProduct()
	{		
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
		
		//$this->form_validation->set_rules('sub_category_id', 'Sub Category', 'required');
		//$this->form_validation->set_rules('product_name', 'Product Name', 'required|callback_alpha_dash_space|is_unique[tbl_product.product_name]');		
		
		if($this->input->post('editid')==''&&$this->input->post('product_name')=='')
		{	
		  $this->form_validation->set_rules('product_name', 'Product Name', 'required'); 
		}
		else if($this->input->post('editid')=='')
		{
		  $this->form_validation->set_rules('product_name', 'Product Name', 'required|callback_alpha_dash_space|is_unique[tbl_product.product_name]');/*callback_alpha_dash_space*/	      
		}
		else
		{
		  $ids     = $this->input->post('editid');
		  $product = $this->input->post('product_name');		  
		  $data =  $this->Commonmodel->getWhere('tbl_product','product_id',$ids);
		  if($data[0]['product_name']==$product)
		  { 	  
		    $this->form_validation->set_rules('product_name', 'Product Name', 'required|callback_alpha_dash_space');	 	
		  }
		  else
		  {
			$this->form_validation->set_rules('product_name', 'Product Name', 'required|callback_alpha_dash_space|is_unique[tbl_product.product_name]');	 	  
		  }
		}
		
		$this->form_validation->set_rules('product_price', 'Product Price', 'required|numeric');
		//$this->form_validation->set_rules('product_quantity', 'Product Quantity', 'required');
		$this->form_validation->set_rules('product_description', 'Product Description', 'required');
        $this->form_validation->set_rules('product_model', 'Product Model', 'required');		
		$this->form_validation->set_rules('product_meta_tag', 'Product Meta Tag', 'required');
		$this->form_validation->set_rules('product_keyword', 'Product Keyword', 'required');		
		$this->form_validation->set_rules('unit_id', 'Product Unit', 'required');
		
		/*if($_FILES['files']['name'][0]=='')
		{			
		  	 $this->form_validation->set_rules('files', 'Product Image','required');	  
		}*/
		
		$allowed  = array('gif','png' ,'jpg','jpeg');
        $filename = $_FILES['files']['name'];
        
		  $arr=[];
		  for($i=0;$i<count($_FILES['files']['name']);$i++)
		  {
			 
		     $filename = $_FILES['files']['name'][$i];
			 $ext = pathinfo($filename, PATHINFO_EXTENSION);
			 
			 $arr[]=$ext;
		  }
		// print_r($arr);
		 
		//$result = array_diff($arr);
		
        if(in_array('jpg',$arr) || in_array('png',$arr) || in_array('gif',$arr))
		{
		  
		}
        else
		{
			 $this->form_validation->set_rules('files', 'Product Image','required',array('required'=>'your selected file format only accept jpg,png,gif'));	
		}
         

	   // print_r($result);		
		
		//print_r($filename);
		
		//$string_version = implode('.', $filename);
		
		//print_r($string_version);
		
		//echo substr(strrchr($string_version,'.'),1);
		
		
		
		//echo $ext;
		
        /*if(!in_array($ext,$allowed)) {
			
           $this->form_validation->set_rules('files', 'Product Image','required',array('required'=>'your custom message'));
		   
        }*/
		
		if($this->form_validation->run() == FALSE)
        {			
		   $data['errors'] = validation_errors();
           $data['status'] = 'error';
           echo json_encode($data);
          //$this->load->view('myform');
        }
        else
        {
           $menu_id              = $this->input->post('menu_id');
		   $category_id          = $this->input->post('category_id');
		   //$sub_category_id      = $this->input->post('sub_category_id'); 
           if($this->input->post('sub_category_id')!='') 
		   {
			  $sub_category_id      = $this->input->post('sub_category_id');  
		   }
           else
		   {
			  $sub_category_id      = 0; 
		   }		   
		   
		   $product_name         = $this->input->post('product_name');
		   $product_price        = $this->input->post('product_price');
           //$product_quantity     = $this->input->post('product_quantity');		   
           $product_description  = $this->input->post('product_description');		   
		   $product_model        = $this->input->post('product_model');		   
		   $product_meta_tag     = $this->input->post('product_meta_tag');
		   $product_keyword      = $this->input->post('product_keyword');
		   $stock_status         = $this->input->post('stock_status');		   
		   $unit_id              = $this->input->post('unit_id');
		   
		   //$product_image        = $this->input->post('product_image');		   
		        
		     
		   
		       /* $config['upload_path']   = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name']     = $_FILES['product_image']['name'];
				$config['file_name']    = $_FILES['product_image1']['name'];
				$config['file_name']    = $_FILES['product_image2']['name'];
				
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('product_image'))
				{
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }
				else
				{
                    $picture = $this->input->post('pictures');
                }

                if($this->upload->do_upload('product_image1'))
				{
                    $uploadData = $this->upload->data();
                    $picture1 = $uploadData['file_name'];
                }
				else
				{
                    $picture1 = $this->input->post('pictures2');
                }
				
				if($this->upload->do_upload('product_image2'))
				{
                    $uploadData = $this->upload->data();
                    $picture2 = $uploadData['file_name'];
                }
				else
				{
                    $picture2 = $this->input->post('pictures2');
                }*/
		      if($this->input->post('editid')=='')
		      { 
			    $picture = $_FILES['files']['name'][0];
			  }
			  else
			  {
				$picture = $this->input->post('product_image'); 
			  }
			  
		      $productArray = array(
		                               'menu_id'              => $menu_id,
									   'category_id'          => $category_id,
		                               'sub_category_id'      => $sub_category_id,
									   'product_name'         => $product_name,
		                               'product_price'        => $product_price,
									   //'product_quantity'     => $product_quantity,
		                               'product_description'  => $product_description,									   
									   'product_model'        => $product_model,									   
									   'product_meta_tag'     => $product_meta_tag,
		                               'product_keyword'      => $product_keyword,
									   'product_image'        => $picture,
									   'stock_status'         => $stock_status,
									   'unit_id'              => $unit_id									    
									   //'product_image1'       => $picture1,
									   //'product_image2'       => $picture2,
								);   
		   
		   
		   
		   if($this->input->post('editid')!='') 
		   {
			 //$edit_id = $this->input->post('editid');
			 //$insert  = $this->Commonmodel->UpdateData('tbl_product',$productArray,'product_id',$edit_id);  
		     
			 $data = array();
             // Count total files
             $countfiles = count($_FILES['files']['name']);     
      
	         for($i=0;$i<$countfiles;$i++){ 
			    $tmpFilePath  = $_FILES['files']['tmp_name'][$i];    
                if ($tmpFilePath != "")
                { 
			      $name = $_FILES['files']['name'][$i]; 
                  $path='uploads/'.$_FILES['files']['name'][$i];;
		          //$name = $_FILES['files']['name'][$i];
                  if(move_uploaded_file($tmpFilePath, $path)) 
                  { 
			         // $imgArray      = array('product_id'=>$insert,'product_image'=>$name);					
		             // $productinsert =  $this->Commonmodel->InsertData('tbl_product_image',$imgArray);   
                  }	
			    } 
			 }
			 
		   }
		   else
		   {		   
		      //$insert =  $this->Commonmodel->InsertData('tbl_product',$productArray);
		     
			 
			 
			 
			 
			 
			 
			 
			 
			 
			     // Check form submit or not
    //if($this->input->post('upload') != NULL ){
 
      $data = array();

      // Count total files
      $countfiles = count($_FILES['files']['name']);     
      
	  for($i=0;$i<$countfiles;$i++){       
        
		 
		 $tmpFilePath  = $_FILES['files']['tmp_name'][$i];    
         if ($tmpFilePath != "")
         {   
		    $name = $_FILES['files']['name'][$i]; 
            $path='uploads/'.$_FILES['files']['name'][$i];;
		    //$name = $_FILES['files']['name'][$i];
            if(move_uploaded_file($tmpFilePath, $path)) 
            { 
			    //$imgArray      = array('product_id'=>$insert,'product_image'=>$name);					
		       // $productinsert =  $this->Commonmodel->InsertData('tbl_product_image',$imgArray);   
            }		  
        }  
         
		 
		 /* // Define new $_FILES array - $_FILES['file']
          $_FILES['file']['name'] = $_FILES['files']['name'][$i];
          $_FILES['file']['type'] = $_FILES['files']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['files']['error'][$i];
          $_FILES['file']['size'] = $_FILES['files']['size'][$i];

          // Set preference
          $config['upload_path'] = 'uploads/'; 
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          $config['max_size'] = '5000'; // max_size in kb
          $config['file_name'] = $_FILES['files']['name'][$i];
 
          //Load upload library
          $this->load->library('upload',$config); 
 
          // File upload
          if($this->upload->do_upload('file')){
            // Get data about the file
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];
            // Initialize array
            $data['filenames'][] = $filename;
          }*/
        
         
      }
       
      // load view
      //$this->load->view('user_view',$data);
    //}else{

      // load view
      //$this->load->view('user_view');
   // } 
 
  //}
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			   /*$config = array();
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;

    $this->load->library('upload');

    $files = $_FILES;
    for($i=0; $i< count($_FILES['files2']['name']); $i++)
    {           
        $_FILES['files2']['name']= $files['files2']['name'][$i];
        $_FILES['files2']['type']= $files['files2']['type'][$i];
        $_FILES['files2']['tmp_name']= $files['files2']['tmp_name'][$i];
        $_FILES['files2']['error']= $files['files2']['error'][$i];
        $_FILES['files2']['size']= $files['files2']['size'][$i];    

        $this->upload->initialize($config);
        $this->upload->do_upload();
    }  
		*/	   
			 
              /*$cpt   = count($_FILES['files']['name']);
		      for($i=0; $i<$cpt; $i++)
              {		     
			    $config['upload_path']   = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name']     = $_FILES['files']['name'][$i];		
				
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
				
                if($this->upload->do_upload('files'))
				{
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];                    
					
					$imgArray = array('product_id'=>$insert,'product_image'=>$picture);					
					$productinsert =  $this->Commonmodel->InsertData('tbl_product_image',$imgArray);
				}
				else
				{
                    $picture = $this->input->post('pictures');
                }
			  }*/
			 
		   
		   
	/*	        $this->load->library('upload');
    $dataInfo = array();
    $files = $_FILES;
    $cpt = count($_FILES['files']['name']);
    for($i=0; $i<$cpt; $i++)
    {           
        $_FILES['files']['name']     = $files['files']['name'][$i];
        $_FILES['files']['type']     = $files['files']['type'][$i];
        $_FILES['files']['tmp_name'] = $files['files']['tmp_name'][$i];
        $_FILES['files']['error']    = $files['files']['error'][$i];
        $_FILES['files']['size']     = $files['files']['size'][$i];

        $this->upload->initialize($this->set_upload_options());
        $this->upload->do_upload();
        $dataInfo[] = $this->upload->data();
    }

    $imgArray = array(
        'product_id' => $insert,
        'product_image' => $dataInfo[0]['file_name']        
     );
     $result_set = $this->Commonmodel->InsertData('tbl_product_image',$imgArray);*/
		   
		   
		   
		   
		   
		   
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


    private function set_upload_options()
    {   
       //upload an image options
       $config = array();
       $config['upload_path'] = 'uploads/';
       $config['allowed_types'] = 'gif|jpg|png';
       $config['max_size']      = '0';
       $config['overwrite']     = FALSE;
       return $config;
    }




	
	function editProduct()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$id              =  $this->uri->segment(3);
		$data['result']  =  $this->Commonmodel->getWhere('tbl_product','product_id',$id);
		$data['results'] =  $this->Commonmodel->getWhere('tbl_product_image','product_id',$id);
		
		$data['menu']    =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
		$data['unit']  =  $this->Commonmodel->get_All_Active_Record('tbl_unit');
		//$data['menu']    =  $this->Commonmodel->get_All_Record('tbl_menu');		
		
		$this->load->view('header');		
		$this->load->view('editProduct',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
	}
	
	
	
	function deleteProduct()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids             = $this->input->post('product_id');		
		$data['result']  = $this->Commonmodel->deleteRecord('tbl_product','product_id',$ids);
		                   $this->Commonmodel->deleteRecord('tbl_product_image','product_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
    }
	
	function deleteProductimages()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids             = $this->input->post('id');		
		$data['result']  = $this->Commonmodel->deleteRecord('tbl_product_image','id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
    }
	
	
	function statuschangeProduct()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$ids             = $this->input->post('id');
		$status          = $this->input->post('status');
		$productArray    = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_product',$productArray,'product_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
    }	
	
		
//--------------------------------------------------------------------------	
	
	
	// public function file_check($str){
     public function file_check($str){  
        $this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file.');
		
	   /*$allowed_mime_type_arr = array('application/pdf','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['product_image']['name']);
        if(isset($_FILES['product_image']['name']) && $_FILES['product_image']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }*/
    }
	

//-----------------------------------Create Unit-----------------------------
		
	public function newUnit()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$this->load->view('header');
		$this->load->view('newUnit');		
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
	}	
	
	
	public function viewUnit()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['result']  =  $this->Commonmodel->get_All_Record('tbl_unit');	
		$this->load->view('header');		
		$this->load->view('viewUnit',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
	}
	
		
	function saveUnit()
	{		
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
  	    
		if($this->input->post('editid')==''&&$this->input->post('unit_name')=='')
		{	
		  $this->form_validation->set_rules('unit_name', 'Unit Name', 'required'); 
		}
		else if($this->input->post('editid')=='')
		{
		  $this->form_validation->set_rules('unit_name', 'Unit Name', 'required|callback_alpha_dash_space|is_unique[tbl_unit.unit_name]'); /*callback_alpha_dash_space*/      
		}
		else
		{
		  $ids  =$this->input->post('editid');
		  $unit = $this->input->post('unit_name');		  
		  $data =  $this->Commonmodel->getWhere('tbl_unit','unit_id',$ids);
		  if($data[0]['unit_name']==$unit)
		  { 	  
		    $this->form_validation->set_rules('unit_name', 'Unit Name', 'required|callback_alpha_dash_space');	 	
		  }
		  else
		  {
			$this->form_validation->set_rules('unit_name', 'Unit Name', 'required|callback_alpha_dash_space|is_unique[tbl_unit.unit_name]');	 	  
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
           $unit_name    = $this->input->post('unit_name');		   
		   $unitArray    = array('unit_name' => $unit_name);
		   
		   if($this->input->post('editid')!='') 
		   {
			 $edit_id = $this->input->post('editid');
			 $insert  = $this->Commonmodel->UpdateData('tbl_unit',$unitArray,'unit_id',$edit_id);  
		   }
		   else
		   {		   
		     $insert       = $this->Commonmodel->InsertData('tbl_unit',$unitArray);
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
	
	function editUnit()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$id              =  $this->uri->segment(3);
		$data['result']  =  $this->Commonmodel->getWhere('tbl_unit','unit_id',$id);			
		$this->load->view('header');		
		$this->load->view('editUnit',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
	}
	
	
	function deleteUnit()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids = $this->input->post('unit_id');		
		$data['result']   =  $this->Commonmodel->deleteRecord('tbl_unit','unit_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
    }
	
	
	function statuschangeUnit()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids             = $this->input->post('id');
		$status          = $this->input->post('status');
		$uniArray        = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_unit',$uniArray,'unit_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
    }
		

	
//-----------------------------------Create Country -----------------------------
		
	public function newCountry()
	{
	   $sessarr              = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {		
		  $this->load->view('header');
		  $this->load->view('newCountry');		
		  $this->load->view('footer');
       }
	   else
	   {			
		  $url=base_url().'admin';
		  redirect($url);		 
	   } 
	}	
	
	
	public function viewCountry()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['result']  =  $this->Commonmodel->get_All_Record('tbl_country');	
		$this->load->view('header');		
		$this->load->view('viewCountry',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		  $url=base_url().'admin';
		  redirect($url);		 
	  }  
	}
	
		
	function saveCountry()
	{		
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		if($this->input->post('editid')==''&&$this->input->post('country_name')=='')
		{	
		  $this->form_validation->set_rules('country_name', 'Country Name', 'required'); 
		}
		else if($this->input->post('editid')=='')
		{	
		  $this->form_validation->set_rules('country_name', 'Country Name', 'required|callback_alpha_dash_space|is_unique[tbl_country.country_name]'); 
		}
		else
		{
		  $ids     = $this->input->post('editid');
		  $country = $this->input->post('country_name');		  
		  $data    = $this->Commonmodel->getWhere('tbl_country','country_id',$ids);
		  if($data[0]['country_name']==$country)
		  { 	  
		    $this->form_validation->set_rules('country_name', 'Country Name', 'required|callback_alpha_dash_space');	 	
		  }
		  else
		  {
			$this->form_validation->set_rules('country_name', 'Country Name', 'required|callback_alpha_dash_space|is_unique[tbl_country.country_name]');	 	  
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
           $country_name    = $this->input->post('country_name');
		   $countryArray    = array('country_name'  => $country_name);
		   
		   if($this->input->post('editid')!='') 
		   {
			 $edit_id = $this->input->post('editid');
			 $insert  = $this->Commonmodel->UpdateData('tbl_country',$countryArray,'country_id',$edit_id);  
		   }
		   else
		   {		   
		     $insert  = $this->Commonmodel->InsertData('tbl_country',$countryArray);
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
	
	function editCountry()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$id              =  $this->uri->segment(3);
		$data['result']  =  $this->Commonmodel->getWhere('tbl_country','country_id',$id);			
		$this->load->view('header');		
		$this->load->view('editCountry',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		  $url=base_url().'admin';
		  redirect($url);		 
	  }	
	}
	
	
	
	function deleteCountry()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids = $this->input->post('country_id');		
		$data['result']   =  $this->Commonmodel->deleteRecord('tbl_country','country_id',$ids);
		                     $this->Commonmodel->deleteRecord('tbl_state','country_id',$ids);
							 $this->Commonmodel->deleteRecord('tbl_city','country_id',$ids);
							 $this->Commonmodel->deleteRecord('tbl_pincode','country_id',$ids);
							 $this->Commonmodel->deleteRecord('tbl_shipping_charges','country_id',$ids);
							 $this->Commonmodel->deleteRecord('tbl_tax','country_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		  $url=base_url().'admin';
		  redirect($url);		 
	  }	
    }
	
	
	function statuschangeCountry()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids             = $this->input->post('id');
		$status          = $this->input->post('status');
		$countryArray    = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_country',$countryArray,'country_id',$ids);		                   
						   $this->Commonmodel->UpdateData('tbl_state',$countryArray,'country_id',$ids);
						   $this->Commonmodel->UpdateData('tbl_city',$countryArray,'country_id',$ids);
						   $this->Commonmodel->UpdateData('tbl_pincode',$countryArray,'country_id',$ids);
						   $this->Commonmodel->UpdateData('tbl_shipping_charges',$countryArray,'country_id',$ids);
						   $this->Commonmodel->UpdateData('tbl_tax',$countryArray,'country_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		  $url=base_url().'admin';
		  redirect($url);		 
	  }	 	
    }

	
//-----------------------------------Create State -----------------------------

		
	public function newState()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		
		$data['country']  =  $this->Commonmodel->get_All_Active_Record('tbl_country');
		//$data['country']  =  $this->Commonmodel->get_All_Record('tbl_country');
		
		$this->load->view('header');
		$this->load->view('newState',$data);		
		$this->load->view('footer');
	  }
	  else
	  {			
		  $url=base_url().'admin';
		  redirect($url);		 
	  }		
	}	
	
	
	public function viewState()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['result']  =  $this->Commonmodel->get_all_joins('tbl_state');
		$this->load->view('header');		
		$this->load->view('viewState',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		  $url=base_url().'admin';
		  redirect($url);		 
	  }		
	}
	
		
	function saveState()
	{		
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$this->form_validation->set_rules('country_id', 'Country Name', 'required');  
		
		if($this->input->post('editid')==''&&$this->input->post('state_name')=='')
		{	
		  $this->form_validation->set_rules('state_name', 'State Name', 'required'); 
		}
		else if($this->input->post('editid')=='')
		{	
		  $this->form_validation->set_rules('state_name', 'State Name', 'required|callback_alpha_dash_space|is_unique[tbl_state.state_name]');
		}
		else
		{
		  $ids     = $this->input->post('editid');
		  $state   = $this->input->post('state_name');		  
		  $data    = $this->Commonmodel->getWhere('tbl_state','state_id',$ids);
		  if($data[0]['state_name']==$state)
		  { 	  
		    $this->form_validation->set_rules('state_name', 'State Name', 'required|callback_alpha_dash_space');	 	
		  }
		  else
		  {
			$this->form_validation->set_rules('state_name', 'State Name', 'required|callback_alpha_dash_space|is_unique[tbl_state.state_name]');	 	  
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
           $country_id    = $this->input->post('country_id');
		   $state_name    = $this->input->post('state_name');		   
		   $stateArray    = array('country_id' => $country_id,'state_name' => $state_name);
		   
		   if($this->input->post('editid')!='') 
		   {
			  $edit_id = $this->input->post('editid');
			  $insert  = $this->Commonmodel->UpdateData('tbl_state',$stateArray,'state_id',$edit_id);  
		   }
		   else
		   {
		      $insert        = $this->Commonmodel->InsertData('tbl_state',$stateArray);
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
	
	function editState()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$id               =  $this->uri->segment(3);
		$data['result']   =  $this->Commonmodel->getWhere('tbl_state','state_id',$id);
		$data['country']  =  $this->Commonmodel->get_All_Active_Record('tbl_country');
		//$data['country']  =  $this->Commonmodel->get_All_Record('tbl_country');
		$this->load->view('header');		
		$this->load->view('editState',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		  $url=base_url().'admin';
		  redirect($url);		 
	  }		
	}
	
	
	function deleteState()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids = $this->input->post('state_id');		
		$data['result']   =  $this->Commonmodel->deleteRecord('tbl_state','state_id',$ids);
		                     $this->Commonmodel->deleteRecord('tbl_city','state_id',$ids);
							 $this->Commonmodel->deleteRecord('tbl_pincode','state_id',$ids);
							 $this->Commonmodel->deleteRecord('tbl_shipping_charges','state_id',$ids);
							 //$this->Commonmodel->deleteRecord('tbl_tax','state_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		  $url=base_url().'admin';
		  redirect($url);		 
	  }		
    }
	
	
	function statuschangeState()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids             = $this->input->post('id');
		$status          = $this->input->post('status');
		$stateArray    = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_state',$stateArray,'state_id',$ids);
		                   $this->Commonmodel->UpdateData('tbl_city',$stateArray,'state_id',$ids);
						   $this->Commonmodel->UpdateData('tbl_pincode',$stateArray,'state_id',$ids);
						   $this->Commonmodel->UpdateData('tbl_shipping_charges',$stateArray,'state_id',$ids);
						   //$this->Commonmodel->UpdateData('tbl_tax',$stateArray,'state_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		  $url=base_url().'admin';
		  redirect($url);		 
	  }		
    }
	
	
	
//-----------------------------------Create City -----------------------------
		
	public function newCity()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['country']  =  $this->Commonmodel->get_All_Active_Record('tbl_country');
		//$data['country']  =  $this->Commonmodel->get_All_Record('tbl_country');
		$this->load->view('header');
		$this->load->view('newCity',$data);		
		$this->load->view('footer');
	  }
	  else
	  {			
		  $url=base_url().'admin';
		  redirect($url);		 
	  }		
	}	
	
	public function getState()
    {        
	  //$sessarr              = $this->session->userdata('sessdata');
	  //if($sessarr['status']==1)
	  //{
	    $id               =  $this->input->post('id');
	    $filed            =  $this->input->post('country_id');        
		$data['results']  =  $this->Commonmodel->get_All_Wheres_Record('tbl_state',$filed,$id);
		//$data['results']  =  $this->Commonmodel->getWhere('tbl_state',$filed,$id);	     
	    
		echo json_encode($data);
	  //}
	 // else
	  //{			
		 // $url=base_url();
		//  redirect($url);		 
	  //}  
    }
	
	
	
	public function viewCity()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['result']  =  $this->Commonmodel->get_all_joins('tbl_city');
		$this->load->view('header');		
		$this->load->view('viewCity',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		  $url=base_url().'admin';
		  redirect($url);		 
	  } 
	}
	
		
	function saveCity()
	{		
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('country_id','Country Name','required');        
		$this->form_validation->set_rules('state_id','State Name','required');
		
		
		if($this->input->post('editid')==''&&$this->input->post('city_name')=='')
		{	
		  $this->form_validation->set_rules('city_name', 'City Name', 'required'); 
		}
		else if($this->input->post('editid')=='')
		{	
		  $this->form_validation->set_rules('city_name','City Name','required|callback_alpha_dash_space|is_unique[tbl_city.city_name]');
		}
		else
		{
		  $ids     = $this->input->post('editid');
		  $city    = $this->input->post('city_name');		  
		  $data    = $this->Commonmodel->getWhere('tbl_city','city_id',$ids);
		  if($data[0]['city_name']==$city)
		  { 	  
		    $this->form_validation->set_rules('city_name', 'City Name', 'required|callback_alpha_dash_space');	 	
		  }
		  else
		  {
			$this->form_validation->set_rules('city_name', 'City Name', 'required|callback_alpha_dash_space|is_unique[tbl_city.city_name]');	 	  
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
           $country_id   = $this->input->post('country_id');
		   $state_id     = $this->input->post('state_id');
		   $city_name    = $this->input->post('city_name');
		   
		   $cityArray   = array('country_id'=>$country_id,'state_id'=>$state_id,'city_name' => $city_name);
		   
		   if($this->input->post('editid')!='') 
		   {
			  $edit_id = $this->input->post('editid');
			  $insert  = $this->Commonmodel->UpdateData('tbl_city',$cityArray,'city_id',$edit_id);  
		   }
		   else
		   {
		     $insert      = $this->Commonmodel->InsertData('tbl_city',$cityArray);
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
	
    function editCity()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		$id               =  $this->uri->segment(3);
		$data['result']   =  $this->Commonmodel->getWhere('tbl_city','city_id',$id);			
		$data['country']  =  $this->Commonmodel->get_All_Active_Record('tbl_country');
		//$data['country']  =  $this->Commonmodel->get_All_Record('tbl_country');
		$this->load->view('header');		
		$this->load->view('editCity',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 
	}
	
	
	function deleteCity()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
  	    $ids = $this->input->post('city_id');		
		$data['result']   =  $this->Commonmodel->deleteRecord('tbl_city','city_id',$ids);
		                     $this->Commonmodel->deleteRecord('tbl_pincode','city_id',$ids);
							 $this->Commonmodel->deleteRecord('tbl_shipping_charges','city_id',$ids);
							 //$this->Commonmodel->deleteRecord('tbl_tax','city_id',$ids);
		echo json_encode($data);
      }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }
	}
	
	
	function statuschangeCity()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids          = $this->input->post('id');
		$status       = $this->input->post('status');
		$cityArray    = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_city',$cityArray,'city_id',$ids);
		                   $this->Commonmodel->UpdateData('tbl_pincode',$cityArray,'city_id',$ids);
						   $this->Commonmodel->UpdateData('tbl_shipping_charges',$cityArray,'city_id',$ids);
						   //$this->Commonmodel->UpdateData('tbl_tax',$cityArray,'city_id',$ids);
		echo json_encode($data);
      }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }
	}
		

//-----------------------------------Create Pincode -----------------------------
		
	public function newPincode()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['country']  =  $this->Commonmodel->get_All_Active_Record('tbl_country');
		//$data['country']  =  $this->Commonmodel->get_All_Record('tbl_country');
		$this->load->view('header');
		$this->load->view('newPincode',$data);		
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
	}	
	
	public function getCity()
    {        
	  //$sessarr              = $this->session->userdata('sessdata');
	  //if($sessarr['status']==1)
	  //{ 
	     $id               =  $this->input->post('id');
	     $filed            =  $this->input->post('state_id');
		 $data['results']  =  $this->Commonmodel->get_All_Wheres_Record('tbl_city',$filed,$id);
         //$data['results']  =  $this->Commonmodel->getWhere('tbl_city',$filed,$id);	     
	     echo json_encode($data);
	  //}
	  //else
	 // {			
		//$url=base_url();
		//redirect($url);		 
	  //} 
    }
	
	public function viewPincode()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['result']  =  $this->Commonmodel->get_all_joins('tbl_pincode');
		$this->load->view('header');		
		$this->load->view('viewPincode',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	
	}
	
	function savePincode()
	{		
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('country_id','Country Name','required');        
		$this->form_validation->set_rules('state_id','State Name','required');
		$this->form_validation->set_rules('city_id','City Name','required');
		
		if($this->input->post('editid')==''&&$this->input->post('pincode')=='')
		{	
		  $this->form_validation->set_rules('pincode', 'Pincode', 'required'); 
		}
		else if($this->input->post('editid')=='')
		{	
		  $this->form_validation->set_rules('pincode','Pincode','required|numeric|is_unique[tbl_pincode.pincode]');
		}
		else
		{
		  $ids     = $this->input->post('editid');
		  $pincode = $this->input->post('city_name');		  
		  $data    = $this->Commonmodel->getWhere('tbl_pincode','pincode_id',$ids);
		  if($data[0]['pincode']==$pincode)
		  { 	  
		    $this->form_validation->set_rules('pincode', 'Pincode', 'required|numeric');	 	
		  }
		  else
		  {
			$this->form_validation->set_rules('pincode', 'Pincode', 'required|numeric|is_unique[tbl_pincode.pincode]');	 	  
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
           $country_id   = $this->input->post('country_id');
		   $state_id     = $this->input->post('state_id');
		   $city_id      = $this->input->post('city_id');
		   $pincode      = $this->input->post('pincode');
		   
		   $pincodeArray   = array('country_id'=>$country_id,'state_id'=>$state_id,'city_id' => $city_id,'pincode' => $pincode);
		   
		   if($this->input->post('editid')!='') 
		   {
			  $edit_id = $this->input->post('editid');
			  $insert  = $this->Commonmodel->UpdateData('tbl_pincode',$pincodeArray,'pincode_id',$edit_id);  
		   }
		   else
		   {
		     $insert      = $this->Commonmodel->InsertData('tbl_pincode',$pincodeArray);
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
	
	function editPincode()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$id               =  $this->uri->segment(3);
		$data['result']   =  $this->Commonmodel->getWhere('tbl_pincode','pincode_id',$id);			
		$data['country']  =  $this->Commonmodel->get_All_Active_Record('tbl_country');
		//$data['country']  =  $this->Commonmodel->get_All_Record('tbl_country');
		$this->load->view('header');		
		$this->load->view('editPincode',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
	}
	
	function deletePincode()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids = $this->input->post('city_id');		
		$data['result']   =  $this->Commonmodel->deleteRecord('tbl_pincode','city_id',$ids);
		                     $this->Commonmodel->deleteRecord('tbl_shipping_charges','pincode_id',$ids);
							 //$this->Commonmodel->deleteRecord('tbl_tax','pincode_id',$ids); 
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
	
	function statuschangePincode()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids             = $this->input->post('id');
		$status          = $this->input->post('status');
		$PincodeArray    = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_pincode',$PincodeArray,'pincode_id',$ids);
		                   $this->Commonmodel->UpdateData('tbl_shipping_charges',$PincodeArray,'pincode_id',$ids);
						   //$this->Commonmodel->UpdateData('tbl_tax',$PincodeArray,'pincode_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }

//-----------------------------------Create Shipping Charges -----------------------------
		
	public function newShippingCharges()
	{
	  $sessarr        = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['country']  =  $this->Commonmodel->get_All_Active_Record('tbl_country');
		//$data['country']  =  $this->Commonmodel->get_All_Record('tbl_country');
		$this->load->view('header');
		$this->load->view('newShippingCharges',$data);		
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
	}	
	
	
	public function getPincodes()
    {        
	  //$sessarr             = $this->session->userdata('sessdata');
	  //if($sessarr['status']==1)
	  //{ 
	     $id               =  $this->input->post('id');
	     $filed            =  $this->input->post('city_id');
         $data['results']  =  $this->Commonmodel->get_All_Wheres_Record('tbl_pincode',$filed,$id);
	     //$data['results']  =  $this->Commonmodel->getWhere('tbl_pincode',$filed,$id);
	     echo json_encode($data);
	 // }
	  //else
	  //{			
		//$url=base_url();
		//redirect($url);		 
	  //} 
    }
	
	
	
	public function viewShippingCharges()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['result']  =  $this->Commonmodel->get_all_joins('tbl_shipping_charges');
		$this->load->view('header');		
		$this->load->view('viewShippingCharges',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	
	}
    
	
	function saveShippingCharges()
	{		
	  $sessarr     = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('country_id','Country Name','required');        
		$this->form_validation->set_rules('state_id','State Name','required');
		$this->form_validation->set_rules('city_id','City Name','required');
		
		if($this->input->post('editid')==''&&$this->input->post('pincode_id')=='')
		{	
		  $this->form_validation->set_rules('pincode_id', 'Pincode', 'required'); 
		}
		else if($this->input->post('editid')=='')
		{	
		  $this->form_validation->set_rules('pincode_id','Pincode','required|is_unique[tbl_shipping_charges.pincode_id]');		
		}
		else
		{
		  $ids     = $this->input->post('editid');
		  $pincode = $this->input->post('pincode_id');		  
		  $data    = $this->Commonmodel->getWhere('tbl_shipping_charges','pincode_id',$ids);
		  if($data[0]['pincode_id']==$pincode)
		  { 	  
		    $this->form_validation->set_rules('pincode_id', 'Pincode', 'required|numeric');	 	
		  }
		  else
		  {
			$this->form_validation->set_rules('pincode_id', 'Pincode', 'required|numeric|is_unique[tbl_shipping_charges.pincode_id]');	 	  
		  }
		}
		
		
		$this->form_validation->set_rules('shipping_amount','Shipping Amount','required|numeric');
		
		if($this->form_validation->run() == FALSE)
        {			
           $data['errors'] = validation_errors();
           $data['status'] = 'error';
           echo json_encode($data);
        }
        else
        {
           $country_id       = $this->input->post('country_id');
		   $state_id         = $this->input->post('state_id');
		   $city_id          = $this->input->post('city_id');
		   $pincode_id       = $this->input->post('pincode_id');
		   $shipping_amount  = $this->input->post('shipping_amount');
		   
		   $pincodeArray   = array('country_id'=>$country_id,'state_id'=>$state_id,'city_id' => $city_id,'pincode_id' => $pincode_id,'shipping_amount'=>$shipping_amount);
		   
		   if($this->input->post('editid')!='') 
		   {
			  $edit_id = $this->input->post('editid');
			  $insert  = $this->Commonmodel->UpdateData('tbl_shipping_charges',$pincodeArray,'shipping_charges_id',$edit_id);  
		   }
		   else
		   {
		     $insert   = $this->Commonmodel->InsertData('tbl_shipping_charges',$pincodeArray);
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
	
	
	function editShippingCharges()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$id               =  $this->uri->segment(3);
		$data['result']   =  $this->Commonmodel->getWhere('tbl_shipping_charges','shipping_charges_id',$id);			
		$data['country']  =  $this->Commonmodel->get_All_Active_Record('tbl_country');
		//$data['country']  =  $this->Commonmodel->get_All_Record('tbl_country');
		$this->load->view('header');		
		$this->load->view('editShippingCharges',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
	}
	
	
	
	function deleteShippingCharges()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids = $this->input->post('shipping_charges_id');		
		$data['result']   =  $this->Commonmodel->deleteRecord('tbl_shipping_charges','shipping_charges_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
	
	function statuschangeShippingCharges()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids                   = $this->input->post('id');
		$status                = $this->input->post('status');
		$ShippingChargesArray  = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_shipping_charges',$ShippingChargesArray,'shipping_charges_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }

//-----------------------------------Create Discount-------------------------
		
	public function newDiscount()
	{
	  $sessarr        = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['menu']  =  $this->Commonmodel->get_All_Active_Record('tbl_menu');//tbl_product
		//$data['product']  =  $this->Commonmodel->get_All_Record('tbl_product');
		$this->load->view('header');
		$this->load->view('newDiscount',$data);		
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
	}	



	public function viewDiscount()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['result']  =  $this->Commonmodel->get_all_joins('tbl_discount');
		$this->load->view('header');		
		$this->load->view('viewDiscount',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	
	}
	
	
	
	function saveDiscount()
	{		
	  $sessarr     = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('menu_id','Menu Name','required');        
		$this->form_validation->set_rules('category_id','Category Name','required');
		$this->form_validation->set_rules('sub_category_id','Sub Category Name','required');		
		$this->form_validation->set_rules('product_id','Product Name','required');        
		$this->form_validation->set_rules('discount_rate','Discount Rate','required|numeric');
		$this->form_validation->set_rules('start_date','Start Date','required');
		$this->form_validation->set_rules('end_date','End Date','required');
		
		
		if($this->form_validation->run() == FALSE)
        {			
           $data['errors'] = validation_errors();
           $data['status'] = 'error';
           echo json_encode($data);
        }
        else
        {
           $menu_id           = $this->input->post('menu_id');
		   $category_id       = $this->input->post('category_id');
		   $sub_category_id   = $this->input->post('sub_category_id');		   
		   $product_id        = $this->input->post('product_id');
		   $discount_rate     = $this->input->post('discount_rate');
		   $start_date        = $this->input->post('start_date');
		   $end_date          = $this->input->post('end_date');		   
		   
		   $discountArray   = array('menu_id'=>$menu_id,'category_id'=>$category_id,'sub_category_id'=>$sub_category_id,'product_id'=>$product_id,'discount_rate'=>$discount_rate,'start_date' => $start_date,'end_date' => $end_date);
		   
		    if($this->input->post('editid')!='') 
		   {
			  $edit_id = $this->input->post('editid');
			  $insert  = $this->Commonmodel->UpdateData('tbl_discount',$discountArray,'discount_id',$edit_id);  
		   }
		   else
		   {
		     $insert   = $this->Commonmodel->InsertData('tbl_discount',$discountArray);
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
	
	
	function editDiscount()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$id               =  $this->uri->segment(3);
		$data['result']   =  $this->Commonmodel->getWhere('tbl_discount','discount_id',$id);			
		
		$data['menu']  =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
		//$data['product']  =  $this->Commonmodel->get_All_Active_Record('tbl_product');
		
		//$data['product']  =  $this->Commonmodel->get_All_Record('tbl_product');
		
		$this->load->view('header');		
		$this->load->view('editDiscount',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
	}
	
	
	function deleteDiscount()
    {	     
	  $sessarr        = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids = $this->input->post('discount_id');		
		$data['result']   =  $this->Commonmodel->deleteRecord('tbl_discount','discount_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
	
	function statuschangeDiscount()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids             = $this->input->post('id');
		$status          = $this->input->post('status');
		$discountArray   = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_discount',$discountArray,'discount_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }

//-----------------------------------Create Offer-------------------------
		
	public function newOffer()
	{
	  $sessarr        = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		//$data['product']  =  $this->Commonmodel->get_All_Record('tbl_product');
		$this->load->view('header');
		$this->load->view('newOffer');		
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
	}
	

	public function viewOffer()
	{
	   $sessarr            = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {	
		  $data['result']  =  $this->Commonmodel->get_All_Record('tbl_offer');
		  $this->load->view('header');		
		  $this->load->view('viewOffer',$data);
		  $this->load->view('footer');
	   }
	   else
	   {			
		 $url=base_url().'admin';
		 redirect($url);		 
	   }	
	}
	
		
	function saveOffer()
	{		
	   $sessarr     = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {		        
		 $this->form_validation->set_rules('offer_rate','Offer Amount','required');
		 $this->form_validation->set_rules('offer_percentage','Offer Percentage','required');
		 $this->form_validation->set_rules('start_date','Start Date','required');
		 $this->form_validation->set_rules('end_date','End Date','required');
		
		 if($this->form_validation->run() == FALSE)
         {			
           $data['errors'] = validation_errors();
           $data['status'] = 'error';
           echo json_encode($data);
         }
         else
         {            
		    $offer_rate        = $this->input->post('offer_rate');
			$offer_percentage  = $this->input->post('offer_percentage');
		    $start_date        = $this->input->post('start_date');
		    $end_date          = $this->input->post('end_date');  
		    $offerArray        = array('offer_rate'=>$offer_rate,'offer_percentage'=>$offer_percentage,'start_date'=>$start_date,'end_date'=>$end_date);
		   
		    if($this->input->post('editid')!='') 
		    {
			  $edit_id = $this->input->post('editid');
			  $insert  = $this->Commonmodel->UpdateData('tbl_offer',$offerArray,'offer_id',$edit_id);  
		    }
		    else
		    {
		      $insert  = $this->Commonmodel->InsertData('tbl_offer',$offerArray);
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
	
	
	function editOffer()
	{
	  $sessarr            = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$id               =  $this->uri->segment(3);
		$data['result']   =  $this->Commonmodel->getWhere('tbl_offer','offer_id',$id);			
		//$data['product']  =  $this->Commonmodel->get_All_Record('tbl_offer');
		$this->load->view('header');		
		$this->load->view('editOffer',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
	}
	
	
	function deleteOffer()
    {	     
	  $sessarr          = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids            = $this->input->post('offer_id');		
		$data['result'] = $this->Commonmodel->deleteRecord('tbl_offer','offer_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
	
	function statuschangeOffer()
    {	     
	  $sessarr           = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids             = $this->input->post('id');
		$status          = $this->input->post('status');
		$offerArray      = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_offer',$offerArray,'offer_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
	
//---------------------------------Create Customer-------------------------------

    public function viewCustomer()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		 $data['result']  =  $this->Commonmodel->get_all_joins('tbl_customer');
		 $this->load->view('header');		
		 $this->load->view('viewCustomer',$data);
		 $this->load->view('footer');
	  }
	  else
	  {			
		 $url=base_url().'admin';
		 redirect($url);		 
	  }	
	}	
	
	function statuschangeCustomer()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids             = $this->input->post('id');
		$status          = $this->input->post('status');
		$CustomerArray    = array('status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_customer',$CustomerArray,'customer_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
	
//----------------------------------Create Order----------------------------
    
    function viewOrders()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['result']  =  $this->Commonmodel->get_all_joins('tbl_order');
		$this->load->view('header');		
		$this->load->view('viewOrder',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	 	
	}
	
	function Orderviews()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$id              =  $this->uri->segment(3);
		$data['result']  =  $this->Commonmodel->get_all_joins_orders($id);
		$this->load->view('header');		
		$this->load->view('orderviews',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	 	
	}
	
	
	function statuschangeOrder()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids             = $this->input->post('id');
		$status          = $this->input->post('status');
		$ReviewsArray    = array('order_status'=>$status);
		$data['result']  = $this->Commonmodel->UpdateData('tbl_order',$ReviewsArray,'order_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
	
	
//------------------------------------------ Reviews ------------------------------------
    function viewReviews()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$data['result']  =  $this->Commonmodel->get_All_Record('tbl_review');
		$this->load->view('header');		
		$this->load->view('viewReviews',$data);
		$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	 	
	}
	
	
	function deleteReviews()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids = $this->input->post('id');		
		$data['result']   =  $this->Commonmodel->deleteRecord('tbl_review','review_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
	
	function statuschangeReviews()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		 $ids             = $this->input->post('id');
		 $status          = $this->input->post('status');
		 $ReviewsArray    = array('status'=>$status);
		 $data['result']  = $this->Commonmodel->UpdateData('tbl_review',$ReviewsArray,'review_id',$ids);
		 echo json_encode($data);
	  }
	  else
	  {			
		 $url=base_url().'admin';
		 redirect($url);		 
	  }		
    }
	
	//-----------------------------------Create Tax-------------------------
		
	public function newTax()
	{
	  $sessarr        = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		 $data['country']  =  $this->Commonmodel->get_All_Active_Record('tbl_country');
		 //$data['country']  =  $this->Commonmodel->get_All_Record('tbl_country');		 
		 
		 $this->load->view('header');
		 $this->load->view('newTax',$data);		
		 $this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  } 	
	}	

	public function viewTax()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		 $data['result']  =  $this->Commonmodel->get_all_joins('tbl_tax');
		 $this->load->view('header');		
		 $this->load->view('viewTax',$data);
		 $this->load->view('footer');
	  }
	  else
	  {			
		 $url=base_url().'admin';
		 redirect($url);		 
	  }	
	}
	
	
	function saveTax()
	{		
	  $sessarr     = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('country_id','Country Name','required');        
		//$this->form_validation->set_rules('state_id','State Name','required');
		//$this->form_validation->set_rules('city_id','City Name','required');
		//$this->form_validation->set_rules('pincode_id','Pincode Name','required');
		
		if($this->input->post('editid')==''&&$this->input->post('tax_name')=='')
		{	
		   $this->form_validation->set_rules('tax_name', 'Tax Name', 'required'); 
		}
		else if($this->input->post('editid')=='')
		{			
		  $this->form_validation->set_rules('tax_name','Tax Name','required|callback_alpha_dash_space|is_unique[tbl_tax.tax_name]');
		}
		else
		{
		  $ids  =$this->input->post('editid');
		  $menu = $this->input->post('tax_name');		  
		  $data =  $this->Commonmodel->getWhere('tbl_tax','tax_id',$ids);
		  if($data[0]['tax_name']==$menu)
		  { 	  
		    $this->form_validation->set_rules('tax_name', 'Tax Name', 'required|callback_alpha_dash_space');	 	
		  }
		  else
		  {
			$this->form_validation->set_rules('tax_name', 'Tax Name', 'required|callback_alpha_dash_space|is_unique[tbl_tax.tax_name]');	 	  
		  }
		  
		}
		
		$this->form_validation->set_rules('tax_rate','Tax Rate','required|numeric');
		
		if($this->form_validation->run() == FALSE)
        {			
           $data['errors'] = validation_errors();
           $data['status'] = 'error';
           echo json_encode($data);
        }
        else
        {
           $country_id     = $this->input->post('country_id');
		   //$state_id       = $this->input->post('state_id');
		   $tax_name       = $this->input->post('tax_name');
		   $tax_rate       = $this->input->post('tax_rate');		   
		   
		   $taxArray   = array('country_id'=>$country_id,'tax_name' => $tax_name,'tax_rate' => $tax_rate);/*'state_id'=>$state_id,*/
		   
		   if($this->input->post('editid')!='') 
		   {
			  $edit_id = $this->input->post('editid');
			  $insert  = $this->Commonmodel->UpdateData('tbl_tax',$taxArray,'tax_id',$edit_id);  
		   }
		   else
		   {
		     $insert   = $this->Commonmodel->InsertData('tbl_tax',$taxArray);
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

	
	
	function editTax()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		 $id               =  $this->uri->segment(3);
		 $data['result']   =  $this->Commonmodel->getWhere('tbl_tax','tax_id',$id);			
		 $data['country']  =  $this->Commonmodel->get_All_Active_Record('tbl_country');
		//$data['country']  =  $this->Commonmodel->get_All_Record('tbl_country');
		 $this->load->view('header');		
		 $this->load->view('editTax',$data);
		 $this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
	}
	
	
	function deleteTax()
    {	     
	  $sessarr        = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		 $ids = $this->input->post('tax_id');		
		 $data['result']   =  $this->Commonmodel->deleteRecord('tbl_tax','tax_id',$ids);
		 echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
	
	function statuschangeTax()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		 $ids             = $this->input->post('id');
		 $status          = $this->input->post('status');
		 $discountArray   = array('status'=>$status);
		 $data['result']  = $this->Commonmodel->UpdateData('tbl_tax',$discountArray,'tax_id',$ids);
		 echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }
	
   //-------------------------------------Create Delivery-----------------------------
  	function saveDelivery()
	{		
	  $sessarr     = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$this->form_validation->set_rules('delivery_date','Delivery Date','required');        
		$this->form_validation->set_rules('delivery_location','Delivery location','required');		
		$this->form_validation->set_rules('delivery_activity','Delivery Activity','required');
		$this->form_validation->set_rules('delivery_sheet','Delivery Sheet','required');
		$this->form_validation->set_rules('delivery_status','Delivery status','required');
		
		if($this->form_validation->run() == FALSE)
        {			
           $data['errors'] = validation_errors();
           $data['status'] = 'error';
           echo json_encode($data);
        }
        else
        {
           $order_id          = $this->input->post('order_id');
		   $delivery_date     = $this->input->post('delivery_date');		   
		   $delivery_location = $this->input->post('delivery_location');
		   $delivery_activity = $this->input->post('delivery_activity');
		   $delivery_sheet    = $this->input->post('delivery_sheet');
		   $delivery_status   = $this->input->post('delivery_status'); 
		   $deliveryArray     = array('order_id'=>$order_id,'delivery_date'=>$delivery_date,'delivery_location' => $delivery_location,'delivery_activity' => $delivery_activity,'delivery_sheet' => $delivery_sheet,'delivery_status' => $delivery_status);
		   $orderstatusArray  = array('order_status'=>$delivery_status);
		   $insert  = $this->Commonmodel->InsertData('tbl_delivery',$deliveryArray);
		   if($insert!='')
		   {
			 //$insert  = $this->Commonmodel->InsertData('tbl_order',$orderstatusArray);
			 
			 $insert  = $this->Commonmodel->UpdateData('tbl_order',$orderstatusArray,'order_id',$order_id);
			 $data['result']   =  $this->Commonmodel->getWhere('tbl_delivery','order_id',$order_id);	  
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
	
	function getDelivery()
	{
		$order_id          = $this->input->post('id');
		$data['result']   =  $this->Commonmodel->getWhere('tbl_delivery','order_id',$order_id);	  
		//$data['status'] = 'success';
        echo json_encode($data);
	}
//----------------------------------------------------------------------------------------
    
	public function viewWishlist()
	{	  
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {		
		 $data['result']  =  $this->Commonmodel->get_all_joins('tbl_wishlist');
		 $this->load->view('header');		
		 $this->load->view('viewWishlist',$data);
		 $this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }	  
	}
	
	
	function deleteWishlist()
    {	     
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$ids = $this->input->post('wishlist_id');		
		$data['result']   =  $this->Commonmodel->deleteRecord('tbl_wishlist','wishlist_id',$ids);
		echo json_encode($data);
	  }
	  else
	  {			
		$url=base_url().'admin';
		redirect($url);		 
	  }		
    }

//----------------------------------------------------------------------------------------	
	
	function sendemail() {
        //$this->load->config('email');
        //$this->load->library('email');
        
		//$config = array();
        //$config['protocol']  = 'smtp';
        //$config['smtp_host'] = 'ssl://googlemail.com';
       // $config['smtp_user'] = 'shoponlineindia100@gmail.com';
       // $config['smtp_pass'] = 'mobi@123';
        //$config['smtp_port'] = 465;//587
        //$this->email->initialize($config);
		
		
		
        //$from = $this->config->item('smtp_user');
        //$to = $this->input->post('to');
        
		//$subject = $this->input->post('subject');
       // $message = $this->input->post('message');

        //$this->email->set_newline("\r\n");
        $this->load->library('email');
		$this->email->from("shoponlineindia100@gmail.com");
        $this->email->to("avishkar.s@mobisofttech.co.in");
        $this->email->subject('Send Email Codeigniter');
        $this->email->message('The email send using codeigniter library');  
        $this->email->send();     

       
    }
	
	
}
