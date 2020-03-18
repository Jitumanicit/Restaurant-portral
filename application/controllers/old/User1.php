<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
       parent::__construct();      
       $this->load->library('cart');
 	   $this->load->library('encrypt');	   
    }
	
	
	public function index()
	{
		  $data['msg']="";
		  $data['msg1']="";		 	 
          $sessarr  = $this->session->userdata('sessdata');			  
          
		  $data['menu']         =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
		  $data['category']     =  $this->Commonmodel->get_All_Active_Record('tbl_category');
		  $data['subcategory']  =  $this->Commonmodel->get_All_Active_Record('tbl_sub_category');
		  
		  $data['handloom']     =  $this->Commonmodel->getWhereUser('tbl_product','menu_id',1);
		  $data['handcraft']    =  $this->Commonmodel->getWhereUser('tbl_product','menu_id',2);
		  $data['food']         =  $this->Commonmodel->getWhereUser('tbl_product','menu_id',3);	
		  
		  $data['handloomdis']  =  $this->Commonmodel->getWheres(1);
		  $data['handcraftdis'] =  $this->Commonmodel->getWheres(2);
		  $data['fooddis']      =  $this->Commonmodel->getWheres(3); 		  
		  $data['country']      =  $this->Commonmodel->get_All_Active_Record('tbl_country'); 
		  $data['status']       =  $sessarr['status'];
		  $data['user']         =  $sessarr['customer_first_name'];
		  $this->load->view('user/index',$data);
		  $this->load->view("user/democode");
	}

	
	public function category()
	{		
		$sessarr              =  $this->session->userdata('sessdata');		
		$subcategory          =  $this->uri->segment(3);
	    $data['subcategory']  =  $this->Commonmodel->getWhere('tbl_sub_category','sub_category_name',$subcategory);
	    $id = $data['subcategory'][0]['sub_category_id'];
		$datas['product']      =  $this->Commonmodel->getWhereUser('tbl_product','sub_category_id',$id);
	    $datas['productdisc']  =  $this->Commonmodel->getWheressubcat($id);	   
		$datas['menu']         =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
		$datas['category']     =  $this->Commonmodel->get_All_Active_Record('tbl_category');
		$datas['subcategory']  =  $this->Commonmodel->get_All_Active_Record('tbl_sub_category');
		$datas['status']= $sessarr['status'];
		$datas['user']= $sessarr['customer_first_name']; 
		$datas['title']=$subcategory;
		$this->load->view('user/single',$datas);
		$this->load->view("user/democode");
    }
	
	public function product()
	{		
		$sessarr               =  $this->session->userdata('sessdata');	
		$url                   =  $this->uri->segment(3);
		$var                   =  str_replace("-"," ",$url);
		$data                  =  $this->Commonmodel->getWhere('tbl_product','product_name',$var);	    
		$product               =  $data[0]['product_id'];
		$sub_category          =  $data[0]['sub_category_id'];		
	    $data['product']       =  $this->Commonmodel->getWhere('tbl_product','product_id',$product);  
        $data['productss']     =  $this->Commonmodel->getWhere('tbl_product_image','product_id',$product);
		$data['discount']      =  $this->Commonmodel->getWhereDiscount($product);
		$data['menu']          =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
		$data['category']      =  $this->Commonmodel->get_All_Active_Record('tbl_category');
		$data['subcategory']   =  $this->Commonmodel->get_All_Active_Record('tbl_sub_category');		
		$data['products']      =  $this->Commonmodel->getWhereArrivals('tbl_product','sub_category_id',$sub_category,4,$product);
	    $data['review']        =  $this->Commonmodel->get_All_Where_Record('tbl_review',$product);
		$data['reting']        =  $this->Commonmodel->reatingcount($product);		
		$data['status']        =  $sessarr['status'];
		$data['user']          =  $sessarr['customer_first_name'];		
		$this->load->view('user/addcart',$data);
		$this->load->view("user/democode");
    }
	
	function logout()
	{	    
		$this->session->set_userdata('sessdata');		
        $log=base_url().'user';
		redirect($log);	  
    }	
	
	
	function getCart()
	{
	    $datas['results']  =  $this->Commonmodel->get_All_Record('tbl_cart');
	    echo json_encode($datas);
	}
		
	
	public function saveSignUp()
	{
	   
	   if($this->input->post('editid')==''&&$this->input->post('first_name')=='')
	   { 
	     $this->form_validation->set_rules('first_name', 'First Name', 'required');  
	   }
	   else
	   {
		 $this->form_validation->set_rules('first_name', 'First Name', 'required|callback_alpha_dash_space');    
	   }
	  
	   if($this->input->post('editid')==''&&$this->input->post('last_name')=='')
	   {
	    $this->form_validation->set_rules('last_name', 'Last Name', 'required');  
	   }
	   else
	   {
		 $this->form_validation->set_rules('last_name', 'Last Name', 'required|callback_alpha_dash_space');    
	   }
	   
	   $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[8]');
	    
	   if($this->input->post('editid')=='')
	   {   
	      $this->form_validation->set_rules('email_address', 'Email', 'required|valid_email|is_unique[tbl_customer.customer_email_address]');
	      $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|min_length[10]|max_length[14]|is_unique[tbl_customer.customer_mobile]');
	   }
	   else
	   {
		 $ids    = $this->input->post('editid');
		 $email  = $this->input->post('email_address');		  
		 $data   = $this->Commonmodel->getWhere('tbl_customer','customer_id',$ids);
		 
		 if($data[0]['customer_email_address']==$email)
		 { 	  
		   $this->form_validation->set_rules('email_address', 'Email', 'required|valid_email');	 	
		 }
		 else
		 {
		   $this->form_validation->set_rules('email_address', 'Email', 'required|valid_email|is_unique[tbl_customer.email_address]');	 	  
		 }
		 
		 $mobile  = $this->input->post('mobile');
		 $data1   = $this->Commonmodel->getWhere('tbl_customer','customer_id',$ids);
		 if($data1[0]['customer_mobile']==$mobile)
		 { 	  
		   $this->form_validation->set_rules('mobile', 'Mobile', 'required|min_length[10]|max_length[14]|numeric');	 	
		 }
		 else
		 {
		   $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|min_length[10]|max_length[14]|is_unique[tbl_customer.customer_mobile]');	 	  
		 }
	   }
	   
	   
	   if($this->input->post('editid')==''&&$this->input->post('address')=='')
	   {
	      $this->form_validation->set_rules('address', 'Address', 'required');  
	   }
	   else
	   {
		  $this->form_validation->set_rules('address', 'Address', 'required|callback_alphanumeric_dash_space');    
	   } 
	   
	   //$this->form_validation->set_rules('address', 'Address', 'required|callback_alphanumeric_dash_space');
	   $this->form_validation->set_rules('country_id', 'Country', 'required');	   
	   $this->form_validation->set_rules('state_id', 'State', 'required');
	   $this->form_validation->set_rules('city_id', 'City', 'required');
	   $this->form_validation->set_rules('pincode_id', 'Pincode', 'required');
	  
	   if($this->form_validation->run() == FALSE)
       {			
           $data['errors'] = validation_errors();
           $data['status'] = 'error';
           echo json_encode($data);
       }
       else
       {	   
	     $first_name      = $this->input->post('first_name');
	     $last_name       = $this->input->post('last_name');		   
	     $email_address   = $this->input->post('email_address');	
	     $password        = $this->input->post('password');	
	     $mobile          = $this->input->post('mobile');	
	     $address         = $this->input->post('address');	
	     $country_id      = $this->input->post('country_id');
	     $state_id        = $this->input->post('state_id');
	     $city_id         = $this->input->post('city_id');
	     $pincode_id      = $this->input->post('pincode_id');
		 $editid          = $this->input->post('editid');
	  
	     $signupArray    = array(
	                              'customer_first_name'    => $first_name,
								  'customer_last_name'     => $last_name,
								  'customer_email_address' => $email_address,
								  'customer_password'      => $password,
								  'customer_mobile'        => $mobile,
								  'customer_address'       => $address,
								  'customer_country_id'    => $country_id,
								  'customer_state_id'      => $state_id,
								  'customer_city_id'       => $city_id,
								  'customer_pincode'       => $pincode_id								 
							    );	   
	     
		 if($this->input->post('editid')!='') 
		 {
			$edit_id = $this->input->post('editid');
			$insert  = $this->Commonmodel->UpdateData('tbl_customer',$signupArray,'customer_id',$editid);  
		 }
		 else
		 {		 
		    $insert  = $this->Commonmodel->InsertData('tbl_customer',$signupArray);		
	     }
		 
		 if($insert!='')
	     {
		   if($this->input->post('editid')=='') 
		   {
		      $this->sendsignupmail($sessarr['customer_email_address']);
			  $data['status'] = 'success';
			  $data['email'] = 'Yes';
              echo json_encode($data);
		   }
		   else
		   {			   
		         $data['status'] = 'success';
				 $data['email'] = 'No';
                 echo json_encode($data);
		   }
	     }
	     else
	     {
		   $data['status'] = 'error';
           echo json_encode($data); 
	     }
	  } 
	}
		
//----------------------------------Create Login-----------------------------	
	
	
	public function loginverify()
    { 	  
	   $this->form_validation->set_rules('Email','Email', 'required');  
	   $this->form_validation->set_rules('Password','Password', 'required');
	   
	   if($this->form_validation->run() == FALSE)
       {			
           $data['errors'] = validation_errors();
           $data['status'] = 'error';
           echo json_encode($data);
       }
       else
       {	   
	       $Email      = $this->input->post('Email');
	       $Password   = $this->input->post('Password');
		   $login      = array('customer_email_address'=>$Email,'customer_password '=>$Password);  
	       $result     = $this->Commonmodel->CheckLogin('tbl_customer',$login);
		   $status     = 1;
		   $login1     = array('customer_email_address'=>$Email,'customer_password '=>$Password,'status'=>$status);  
	       $result1    = $this->Commonmodel->CheckLogin('tbl_customer',$login1);
		   
		   
		   //$sessarr = $this->session->set_userdata('sessdata',$result[0]);
		   if(count($result)==0)
		   {
			  $data['errors'] = 'checked user Email & password';
			  $data['status'] = 'error';
              echo json_encode($data);   
		   }
		   else if(count($result1)==0&&count($result)!=0)
		   {
			  $data['errors'] = 'Your account is inactive. Contact your administrator to activate it';
			  $data['status'] = 'error';
              echo json_encode($data);  
		   }
		   else
		   {
		     $this->session->set_userdata('sessdata',$result[0]);
		     $sessarr  = $this->session->userdata('sessdata');		   
		     if($result[0]['status']==1)			   
		     {
			   $fefe = count($this->cart->contents());
			   if($fefe==0)
			   {
			     $data['status'] = 'success';	
			     $data['cart']   = 'success';
			   }	
			   else
			   {
			     $data['status'] = 'success';
			     $data['cart']   = '';
			   }
               echo json_encode($data);			 
		     }
		   } 
	   }	
	
	}
		
//------------------------------------------------------------------------------	
	
	public function addtocart()
	{
	    $cartArray = array(
                             'id'     => $this->input->post('product_id'),
                             'name'   => $this->input->post('product_name'),
                             'price'  => $this->input->post('product_price'),
                             'image'  => $this->input->post('product_image'),
                             'qty'    => 1
                          );   
	   
        $this->cart->insert($cartArray);
        echo $fefe = count($this->cart->contents());
	}
			
	public function opencart()
    {
        //$this->load->model('cart_model');
		$sessarr        = $this->session->userdata('sessdata');
		$data['status'] = $sessarr['status'];
		$data['cart']   = $this->cart->contents();
        $this->load->view("user/cart_modal", $data);
    }
		
	function remove() {
           $rowid = $this->input->post('rowid');
           // Check rowid value.
           if ($rowid==="all"){
             // Destroy data which store in session.
             $this->cart->destroy();
            }
			else
			{
              // Destroy selected rowid in session.
              $data = array(
                'rowid' => $rowid,
                'qty' => 0
              );
              // Update cart data, after cancel.
              $this->cart->update($data);
           }
           echo $fefe = count($this->cart->contents());
           // This will show cancel data in cart.
     }




    function update_cart()
	{
        // Recieve post values,calcute them and update
        $rowid = $_POST['rowid'];
        $price = $_POST['price'];
        $amount = $price * $_POST['qty'];
        $qty = $_POST['qty'];

        $data = array(
               'rowid' => $rowid,
               'price' => $price,
               'amount' => $amount,
               'qty' => $qty
           );
           $this->cart->update($data);
           echo $data['amount'];
    }
	

//---------------------------------------Billing Details------------------------------
	 
	function billingDetails()
	{
	  $sessarr  = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
		$data['menu']          =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
		$data['category']      =  $this->Commonmodel->get_All_Active_Record('tbl_category');
		$data['subcategory']   =  $this->Commonmodel->get_All_Active_Record('tbl_sub_category');		
		$data['country']       =  $this->Commonmodel->get_All_Active_Record('tbl_country');
		$sessarr               =  $this->session->userdata('sessdata');
		$data['customername']  =  $sessarr['customer_first_name'];
		$data['status']        =  $sessarr['status'];		
		$data['customer']      =  $this->Commonmodel->get_all_joins_data($sessarr['customer_id']);
		$this->load->view('user/billing-details',$data);
		$this->load->view("user/democode");		
	  }
	  else
	  {
		$this->index();  
	  }
	}
	
	function get_last_shipping()
	{
	  $sessarr  = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	            
		 $data['results'] = $this->Commonmodel->get_shipping_Where();		
		 echo json_encode($data);
	  }
	  else
	  {
		$this->index();  
	  }  
	}

	
	function saveDetails()
	{		
	  
	  $sessarr  = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		if($this->input->post('editid')==''&&$this->input->post('first_name')=='')
	    { 
	      $this->form_validation->set_rules('first_name', 'First Name', 'required');  
	    }
	    else
	    {
		 $this->form_validation->set_rules('first_name', 'First Name', 'required|callback_alpha_dash_space');    
	    }
	  
	    if($this->input->post('editid')==''&&$this->input->post('last_name')=='')
	    {
	     $this->form_validation->set_rules('last_name', 'Last Name', 'required');  
	    }
	    else
	    {
		  $this->form_validation->set_rules('last_name', 'Last Name', 'required|callback_alpha_dash_space');    
	    }
		
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('mobile','Mobile','required|numeric|min_length[10]|max_length[14]');
		
		//$this->form_validation->set_rules('password','Password','required');
		
		if($this->input->post('editid')==''&&$this->input->post('address')=='')
	    {
	      $this->form_validation->set_rules('address', 'Address', 'required');  
	    }
	    else
	    {
		  $this->form_validation->set_rules('address', 'Address', 'required|callback_alphanumeric_dash_space');    
	    } 
		//$this->form_validation->set_rules('address','Address','required');
		
		$this->form_validation->set_rules('country_id','Country Name','required');
		$this->form_validation->set_rules('state_id','State Name','required');
		$this->form_validation->set_rules('city_id','City Name','required');
		$this->form_validation->set_rules('pincode_id','Pincode','required');		
		
		if($this->form_validation->run() == FALSE)
        {			
           $data['errors'] = validation_errors();
           $data['status'] = 'error'; 
           $data['id'] = "5";		   
		   //$data['id']     = $this->encrypt->encode($plain_text);
		   echo json_encode($data);
        }
        else
        {		
		  $first_name   = $this->input->post('first_name');
	      $last_name    = $this->input->post('last_name');		   
	      $email        = $this->input->post('email');	
	      $mobile       = $this->input->post('mobile');
	      //$password     = $this->input->post('password');        
		  $address      = $this->input->post('address');
		  $country_id   = $this->input->post('country_id');
		  $state_id     = $this->input->post('state_id');
		  $city_id      = $this->input->post('city_id');
          $pincode_id   = $this->input->post('pincode_id');
		  $customer_id  = $this->input->post('customer_id');
		  $editid       = $this->input->post('editid');
		
		  $shippingArray = array( 
	                              'shipping_first_name'     => $first_name,
								  'shipping_last_name'      => $last_name,
								  'shipping_email_address'  => $email,
								  //'shipping_password'       => $password,
								  'shipping_telephone'      => $mobile,                                     
								  'shipping_address'        => $address,
								  'shipping_country'        => $country_id, 
                                  'shipping_state'          => $state_id,
								  'shipping_city '          => $city_id,
								  'shipping_pincode'        => $pincode_id,
								  'shipping_customer_id'    => $customer_id
	                            );			
		
		   
		   if($this->input->post('editid')!='') 
		   {
			 $edit_id = $this->input->post('editid');
			 $insert  = $this->Commonmodel->UpdateData('tbl_shipping',$shippingArray,'shipping_id',$editid);  
		   }
		   else
		   {		   
		     $insert   =  $this->Commonmodel->InsertData('tbl_shipping',$shippingArray);    
		   }
		   
		   if($insert!='')
		   {		     
			 $this->session->set_userdata('shipping',$insert);
			 $data['status'] = 'success';			 	 
             echo json_encode($data);
		   } 	
		}
	  }
	  else
	  {
		$this->index();  
	  }
	}	

//------------------------------------------------------------------------------------
	 
	 function paymentMethod()
	 {
	   $sessarr  = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   {
		 $shipping             = $this->session->userdata('shipping');
		 $data['ids']          = $shipping;		
		 $data['menu']         = $this->Commonmodel->get_All_Active_Record('tbl_menu');
		 $data['category']     =  $this->Commonmodel->get_All_Active_Record('tbl_category');
		 $data['subcategory']  =  $this->Commonmodel->get_All_Active_Record('tbl_sub_category');
		 $data['user']         = $sessarr['customer_first_name'];
		 $data['status']       = $sessarr['status'];
		 $this->load->view('user/payment-method',$data);
		 $this->load->view("user/democode");
	   }
	   else
	   {
		 $this->index();  
	   } 
	 }	 
	 
	 function saveMethod()
	 {
	   $sessarr  = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   { 
		 $this->form_validation->set_rules('payment_method','Payment Method','required');
		 $this->form_validation->set_rules('paymentcomments','Add Comments','required');		
		
		 if($this->form_validation->run() == FALSE)
         {			
           $data['errors'] = validation_errors();
           $data['status'] = 'error';          
		   //$data['id']     = $this->encrypt->encode($plain_text);
		   echo json_encode($data);
         }
         else
         {		
		   $payment_method   = $this->input->post('payment_method');
	       $paymentcomments  = $this->input->post('paymentcomments');	
		   $shipping         = $this->session->userdata('shipping');
		   $methodArray = array( 
	                             'payment_method'   => $payment_method,
								 'paymentcomments'  => $paymentcomments,
								 'shipping_id'      => $shipping, 
							  );								  
								  
		   $insert   =  $this->Commonmodel->InsertData('tbl_paymentMethod',$methodArray); 
		   if($insert!='')
		   {
		     $this->session->set_userdata('method',$insert); 
		     $method   = $this->session->userdata('method');			 
			 $data['status'] = 'success';			
             echo json_encode($data);
		   } 					  
		 } 
	   }
	   else
	   {
		 $this->index();  
	   } 
	 }	 
	 
//------------------------------------------------------------------------------------
	 
	 function confirmOrder()
	 {
       $sessarr  = $this->session->userdata('sessdata');
	   if($sessarr['status']==1)
	   { 
		 $data['menu']         =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
		 $data['category']     =  $this->Commonmodel->get_All_Active_Record('tbl_category');
		 $data['subcategory']  =  $this->Commonmodel->get_All_Active_Record('tbl_sub_category');		
		 $method               = $this->session->userdata('method');	
		 $data['result']       = $this->Commonmodel->get_all_joins_shipping($method);		
		 $data['cart']         = $this->cart->contents();
		 $data['user']         = $sessarr['customer_first_name'];
		 $data['status']       = $sessarr['status'];
		 $this->load->view('user/confirm-order',$data);
		 $this->load->view("user/democode");
	   }	   
	   else
	   {
		 $this->index();  
	   }  
	 }	
	 
	 
	 public function orderPlace()
     { 
		$sessarr  = $this->session->userdata('sessdata');
		if($sessarr['status']==1)
	    {
		  if($cart = $this->cart->contents())
		  { 
	        $shipping  = $this->session->userdata('shipping');
		    foreach($cart as $item)
		    {			
			  $cart_detail = array(                                   
                                   'product_id'        => $item['id'],
                                   'product_name'      => $item['name'],
                                   'product_price'     => $item['price'],
								   'product_image'     => $item['image'],								   
								   'product_qty'       => $item['qty'],
								   'product_sub_total' => $item['price']*$item['qty'],
								   'shipping_id'       => $shipping,
                                );
              $insert   =  $this->Commonmodel->InsertData('tbl_cart',$cart_detail);
		    }
		  
		     $sessarr     =  $this->session->userdata('sessdata');
             $total       = $this->input->post('total');	    
		     $delivery    = $this->input->post('delivery');		
		     $ordertotal  = $this->input->post('ordertotal');
			 //str_pad('1',5,'0',STR_PAD_LEFT);
			 
			 $orderArray = array( 	                               
								   'customer_id'       => $sessarr['customer_id'],
								   'shipping_id'	   => $shipping,							  
								   'order_price'       => $total,
								   'delivery_amount'   => $delivery,
								   'order_total_price' => $ordertotal, 
							    );								  
								  
		     $insert1   =  $this->Commonmodel->InsertData('tbl_order',$orderArray);
		     
			 $this->sendusermail($sessarr['customer_email_address'],$insert1);
			 $data['status'] = 'success';			
             echo json_encode($data);
		  }
        }
		else
	    {
		 $this->index();  
	    }     
		
     }
		
	
//-------------------------------------------------------------------------------------	
	
	public function openlogin()
    {       
        $data['order']='';
		$this->load->view("user/login_modal",$data);
		$this->load->view("user/democode");
    }
//-------------------------------------------------------------------------------------	
	
	public function ForgetPassword()
    {
		$this->load->view("user/forgetpassword_modal");
		$this->load->view("user/democode");
    }
//-------------------------------------------------------------------------------------

    public function saveforgetpassword()
	{
	  	$this->form_validation->set_rules('Email','Email', 'required|valid_email');  
	    $this->form_validation->set_rules('Password','Password', 'required');		
		if($this->form_validation->run() == FALSE)
        {			
           $data['errors'] = validation_errors();
           $data['status'] = 'error';
           echo json_encode($data);
        }
        else
        {			  
		  $Email          = $this->input->post('Email');
		  $Password       = $this->input->post('Password');
		  $data['result'] = $this->Commonmodel->getWhere('tbl_customer','customer_email_address',$Email);
		  $emails         = $data['result'][0]['customer_email_address'];		  
		  $fpArray        = array('customer_password'=>$Password);  
	      $insert         = $this->Commonmodel->UpdateData('tbl_customer',$fpArray,'customer_id',$data['result'][0]['customer_id']);
		  $data['status'] = 'success';
          echo json_encode($data);	
		}		
	}


//-------------------------------------------------------------------------------------

    public function openorderlogin()
    {       
        $data['order']='order';
		$this->load->view("user/login_modal",$data);
		$this->load->view("user/democode");
    }


//-------------------------------------------------------------------------------------

    public function openordercancel()
    {       
        $data['order']= $this->input->post('order_id');
		$data['order_date']= $this->input->post('order_date');
		$this->load->view("user/ordercancel_modal",$data);
		$this->load->view("user/democode");
    }	
	
//-------------------------------------------------------------------------------------

    public function openwishlistlogin()
    {       
        //$names   = $this->input->post('names');		
		$data['order']='wishlist';
		$this->load->view("user/login_modal",$data);
		$this->load->view("user/democode");
    }

//-------------------------------------------------------------------------------------
    
	public function wishlist()
    {
	  $sessarr  = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  { 
	     $data['user']        = $sessarr['customer_first_name'];
		 $data['status']      = $sessarr['status'];
		 $data['result']      = $this->Commonmodel->get_all_joins_wishlist($sessarr['customer_id']);
	     $data['menu']        = $this->Commonmodel->get_All_Active_Record('tbl_menu');
		 $data['category']    = $this->Commonmodel->get_All_Active_Record('tbl_category');
		 $data['subcategory'] = $this->Commonmodel->get_All_Active_Record('tbl_sub_category');
		 $this->load->view("user/wishlist",$data);
		 $this->load->view("user/democode");
	  }
	}
	
//-------------------------------------------------------------------------------------

	public function savewishlist()
    {
	  $sessarr  = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  { 
	    $productid  = $this->input->post('productid');
		$data       = $this->Commonmodel->getWherewishlist('tbl_wishlist',$sessarr['customer_id'],$productid);
		
		if(count($data)!=0 && $data[0]['product_id']==$productid)
		{ 	  
		   $data['status'] = 'error';
           echo json_encode($data);	
		}
		else
		{
		   $sessarr        = $this->session->userdata('sessdata');
		   $productid      = $this->input->post('productid');
		   $date           = date("Y-m-d");
	       $wishlistArray  = array('product_id'=>$productid,'customer_id'=>$sessarr['customer_id'],'created_at'=>$date);  
	       $insert         = $this->Commonmodel->InsertData('tbl_wishlist',$wishlistArray);		
		  
		   $data['status'] = 'success';
           echo json_encode($data);	
		}
		 
	  }
	}
	
//-------------------------------------------------------------------------------------
    
	public function opensignup()
    {       
        $data['country']      =  $this->Commonmodel->get_All_Active_Record('tbl_country');			
		$this->load->view("user/signup_modal",$data);
		$this->load->view("user/democode");
    }

//-------------------------------------------------------------------------------------
    
	public function openProfile()
    {       
      $sessarr  = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {
		$data['country']      =  $this->Commonmodel->get_All_Active_Record('tbl_country');		
		$data['result']       =  $this->Commonmodel->getWhere('tbl_customer','customer_id',$sessarr['customer_id']);
		$this->load->view("user/profile_modal",$data);
		$this->load->view("user/democode");
      }
	}
	
//-------------------------------------------------------------------------------------	

    public function ordersuccessful()
    {  
	  $sessarr  = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  { 
	    $data['menu']         =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
	    $data['category']     =  $this->Commonmodel->get_All_Active_Record('tbl_category');
	    $data['subcategory']  =  $this->Commonmodel->get_All_Active_Record('tbl_sub_category');	   
	    $data['user']         =  $sessarr['customer_first_name'];
		$data['status']       =  $sessarr['status'];
		$this->load->view("user/order-successful",$data);
	    $this->cart->destroy();
	    //$this->session->sess_destroy();
	  }
	  else
	  {
		$this->index();  
	  }	
    }

//-----------------------------------------------------------------------------------------	
    public function addReview()
    { 
	   $this->form_validation->set_rules('names','Name', 'required');  
	   $this->form_validation->set_rules('review','Review', 'required');
	   $this->form_validation->set_rules('reting','Reting', 'required');
	   $this->form_validation->set_rules('product_id','product_id', 'required');
	   
	   if($this->form_validation->run() == FALSE)
       {			
           $data['errors'] = validation_errors();
           $data['status'] = 'error';
           echo json_encode($data);
       }
       else
       {	   
	       $names       = $this->input->post('names');
	       $review      = $this->input->post('review');
		   $reting      = $this->input->post('reting');
		   $product     = $this->input->post('product_id');
		   //$product     = $this->uri->segment(3);		   
		   $retingArray = array('names'=>$names,'review'=>$review,'reting'=>$reting,'product_id'=>$product);  
	       $insert      = $this->Commonmodel->InsertData('tbl_review',$retingArray);
		   
		   if($result[0]['status']==1)			   
		   {
			 $data['status'] = 'success';
             echo json_encode($data);  
		   }
	   }	
	
	}	
   //-------------------------------------------------------------------------------------
	
	public function order()
    {       
        $sessarr              = $this->session->userdata('sessdata');
		$data['user']         = $sessarr['customer_first_name'];
		//echo $sessarr['customer_id'];
		
		$data['status']       = $sessarr['status'];
		$data['menu']         = $this->Commonmodel->get_All_Active_Record('tbl_menu');
	    $data['category']     = $this->Commonmodel->get_All_Active_Record('tbl_category');
	    $data['subcategory']  = $this->Commonmodel->get_All_Active_Record('tbl_sub_category');
		//$data['delivery']      = $this->Commonmodel->get_All_Record('tbl_delivery');
		$data['order']        = $this->Commonmodel->get_cust_joins_orders($sessarr['customer_id']);		
		$this->load->view("user/order-tracking",$data);
		$this->load->view("user/democode");
    }
   
   //-------------------------------------------------------------------------------------
	
	function Orderviews()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$id                   =  $this->uri->segment(3);
		$data['result']       =  $this->Commonmodel->get_all_joins_orders($id);
		//$this->load->view('header');
        $data['status']       =  $sessarr['status'];
		$data['user']         =  $sessarr['customer_first_name'];
		$data['menu']         =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
	    $data['category']     =  $this->Commonmodel->get_All_Active_Record('tbl_category');
	    $data['subcategory']  =  $this->Commonmodel->get_All_Active_Record('tbl_sub_category');
		
		$this->load->view('user/orderviews',$data);
		$this->load->view("user/democode");
		//$this->load->view('footer');
	  }
	  else
	  {			
		$url=base_url();
		redirect($url);		 
	  }	 	
	}
	
//---------------------------------- Delivery Track ---------------------------------
	
	function Delivery()
	{
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  {	
		$id                   =  $this->uri->segment(3);
		$data['result']       =  $this->Commonmodel->getWhere('tbl_delivery','order_id',$id);		
        $data['status']       =  $sessarr['status'];		
		$data['user']         =  $sessarr['customer_first_name'];
		$data['menu']         =  $this->Commonmodel->get_All_Active_Record('tbl_menu');
	    $data['category']     =  $this->Commonmodel->get_All_Active_Record('tbl_category');
	    $data['subcategory']  =  $this->Commonmodel->get_All_Active_Record('tbl_sub_category');
		$this->load->view('user/delivery',$data);
		$this->load->view("user/democode");
	  }
	  else
	  {			
		$url=base_url();
		redirect($url);		 
	  }	 	
	}	
//---------------------------------------------------------------------------------------
    
	function orderCancel()
    {
	  $sessarr              = $this->session->userdata('sessdata');
	  if($sessarr['status']==1)
	  { 
	    $edit_id        = $this->input->post('order_id');
	    $cancellation   = $this->input->post('cancellation');			
		$data['result'] = $this->Commonmodel->getWhere('tbl_order','order_id',$edit_id);
		$order_date     = $data['result'][0]['order_date_time'];		
		$orderArray     = array('order_status'=>$cancellation);  
	    $insert         = $this->Commonmodel->UpdateData('tbl_order',$orderArray,'order_id',$edit_id);
	    if($insert!='')			   
	    {
		 $this->ordercancelmail($sessarr['customer_email_address'],$edit_id,$cancellation,$sessarr['customer_first_name'],$sessarr['customer_last_name'],$order_date);
		 $data['status'] = 'success';
         echo json_encode($data);  
	    }
	  }
	  else
	  {			
		$url=base_url();
		redirect($url);		 
	  }	
	}
	
//---------------------------------------------------------------------------------------

    function ordercancelmail($send_email,$orderid,$order_status,$fname,$lname,$order_date)
    {

       $smtp_host = "smtp.gmail.com";
       $smtp_port = 465;
       $smtp_user = "shoponlineindia100@gmail.com";
       $smtp_pass = "mobi@123";       
       $subject = 'your subject';
       $date =date('Y-m-d H:i:s');
       $message = "Your Order Number is:# $orderid
	   Refunded/Canceled
	   Purchesed by $fname $lname($send_email) on $order_date
	   Refunded/Canceled on"; 
      
       $config = Array(
                         "protocol"    => "smtp",
                         "smtp_host"   => $smtp_host,
                         "smtp_port"   => $smtp_port,
                         "smtp_user"   => $smtp_user, 
                         "smtp_pass"   => $smtp_pass,
                         "smtp_crypto" => "ssl",
                         "mailtype"    => "html",
                         "charset"     => "iso-8859-1",
                         "wordwrap"    => TRUE,
                         "wordwrap"    => "\r\n" //use double quotes to comply with RFC 822
                    );

             $this->load->library("email", $config);
             $this->email->from($smtp_user,"shop online"); 
             $this->email->to($send_email);  
             $this->email->subject($subject);
             $this->email->message($message);
             $this->email->send();            
	}
	
//--------------------------------------------------------------------------------------- 
		
	function sendsignupmail($send_email)
    {
       $smtp_host = "smtp.gmail.com";
       $smtp_port = 465;
       $smtp_user = "shoponlineindia100@gmail.com";
       $smtp_pass = "mobi@123";       
       $subject = 'Registration Successfully';      
       $message = "<h3>Congratulation!</h3>";
       $message .= "<p>You have been successfully registered.To activate your account check your email and confirm your registration.</p>";
       $config = Array(
                         "protocol" => "smtp",
                         "smtp_host" => $smtp_host,
                         "smtp_port" => $smtp_port,
                         "smtp_user" => $smtp_user, 
                         "smtp_pass" => $smtp_pass,
                         "smtp_crypto" => "ssl",
                         "mailtype" => "html",
                         "charset" => "iso-8859-1",
                         "wordwrap" => TRUE,
                         "wordwrap" => "\r\n" //use double quotes to comply with RFC 822
                    );

             $this->load->library("email", $config);
             $this->email->from($smtp_user,"shop online"); 
             $this->email->to($send_email);  
             $this->email->subject($subject);
             $this->email->message($message);
             $this->email->send();            
	}	
	
//--------------------------------------------------------------------------------------- 
    
	function sendusermail($send_email,$orderid)
    {
       $smtp_host = "smtp.gmail.com";
       $smtp_port = 465;
       $smtp_user = "shoponlineindia100@gmail.com";
       $smtp_pass = "mobi@123";
       //$send_email = "suresh.n@mobisofttech.co.in";
       $subject = 'Your Order Confirmed';
       //$message = 'your message';
       $message = "<h3>Your Order Confirmed Number is:# $orderid</h3>";
       $message .= "<p>Order Placed On .</p>";
       $message .= "<p>As soon as your order is fulfilled and shipped,we`ll send you an email notification with tracking details.</p>";
       $message .= "<p>If you have any questions,feel free to reach out to us at no shoponlineindia100@gmail.com. Have a great day!</p>";
       $config = Array(
                         "protocol" => "smtp",
                         "smtp_host" => $smtp_host,
                         "smtp_port" => $smtp_port,
                         "smtp_user" => $smtp_user, 
                         "smtp_pass" => $smtp_pass,
                         "smtp_crypto" => "ssl",
                         "mailtype" => "html",
                         "charset" => "iso-8859-1",
                         "wordwrap" => TRUE,
                         "wordwrap" => "\r\n" //use double quotes to comply with RFC 822
                    );
             $this->load->library("email", $config);
             $this->email->from($smtp_user,"shop online"); 
             $this->email->to($send_email);  
             $this->email->subject($subject);
             $this->email->message($message);
             $this->email->send();
	}
 //----------------------------------------------------------------------------------
 
    function alpha_dash_space($str)
    {        
       if (! preg_match('/^[a-zA-Z\s]+$/', $str)) {
           $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
           return FALSE;
        } else {
             return TRUE;
        }
    }
    
	function alphanumeric_dash_space($str)
    {        
       if (! preg_match('/^[a-zA-Z0-9\s]+$/', $str)) {
           $this->form_validation->set_message('alphanumeric_dash_space', 'The %s field may only contain alpha numeric characters');
           return FALSE;
        } else {
             return TRUE;
        }
    }
 
}