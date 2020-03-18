<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Commonmodel extends CI_Model
{  
   function __construct()
   { 
       parent::__construct (); 
   }
   
   function CheckLogin($table,$array)
   {	 
	 $data = $this->db->get_where($table,$array)->result_array();
	 return $data; 	 
   }
   
//------------------------------------------------------------   
   
   function counts($table) 
   { 
     $sql   = "SELECT count(*) as unique_total FROM $table";
     $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row; 
   } 
   
   function data_count($table,$filed,$id)
   {
	 $sql   = "SELECT count(*) as unique_total FROM $table where $filed=$id";
     $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;   
   }
   
   function ordercount()
   {
	 //$sql   =  "SELECT * FROM create_order_id";
	 $sql   =  "SELECT count(*) as counts FROM create_order_id";
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row; 
   }	   
    
   function getorderss($roles,$id,$ordid)
   {
     $sql   = "SELECT tbl_order.id,tbl_order.orderid,tbl_order.suggestion,tbl_order.starttime,tbl_order.endtime,tbl_order.order_status,tbl_order.table_id,tbl_order.qty,tbl_category.category_name,tbl_customer.customer_name,tbl_customer.customer_email,tbl_menu.menu_name,tbl_menu.menu_time,tbl_customer.customer_mobile,tbl_order.customer_id,tbl_table.table_number FROM tbl_order,tbl_category,tbl_menu,tbl_customer,tbl_table WHERE tbl_order.category_id=tbl_category.id and tbl_order.menu_id=tbl_menu.id and tbl_order.customer_id=tbl_customer.id and tbl_table.id=tbl_order.table_id and tbl_order.bill_request!=1 and tbl_order.waiter_id=$id and tbl_order.orderid=$ordid order by tbl_order.orderid ASC";
     $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;  
   }
   
   function getpreviousorder($id,$ordid)
   {
	 $sql   = "SELECT tbl_order.id,tbl_order.orderid,tbl_order.suggestion,tbl_order.starttime,tbl_order.endtime,tbl_order.order_status,tbl_order.table_id,tbl_order.qty,tbl_category.category_name,tbl_customer.customer_name,tbl_customer.customer_email,tbl_menu.menu_name,tbl_menu.menu_time,tbl_customer.customer_mobile,tbl_order.customer_id,tbl_table.table_number FROM tbl_order,tbl_category,tbl_menu,tbl_customer,tbl_table WHERE tbl_order.category_id=tbl_category.id and tbl_order.menu_id=tbl_menu.id and tbl_order.customer_id=tbl_customer.id and tbl_table.id=tbl_order.table_id and tbl_order.bill_request!=1 and tbl_order.waiter_id=$id and tbl_order.orderid=$ordid group by tbl_order.table_id ASC";
     $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;  
   }
   
   function getordersgroup($roles,$id)
   {
     $sql   = "SELECT tbl_order.id,tbl_order.orderid,tbl_order.suggestion,tbl_order.starttime,tbl_order.endtime,tbl_order.order_status,tbl_order.table_id,tbl_order.qty,tbl_category.category_name,tbl_customer.customer_name,tbl_customer.customer_email,tbl_menu.menu_name,tbl_menu.menu_time,tbl_customer.customer_mobile,tbl_order.customer_id,tbl_table.table_number FROM tbl_order,tbl_category,tbl_menu,tbl_customer,tbl_table WHERE tbl_order.category_id=tbl_category.id and tbl_order.menu_id=tbl_menu.id and tbl_order.customer_id=tbl_customer.id and tbl_table.id=tbl_order.table_id and tbl_order.bill_request NOT IN(1,2) and tbl_order.waiter_id=$id group by tbl_order.orderid ASC";
     $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;  
   }
    
//------------------------------------------------------------   
  
  /* function data_count($table,$filed,$id) 
   { 
     $sql   = "SELECT count(*) as unique_total FROM $table where $filed=$id";
     $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row; 
   }*/
   
//-------------------------------------------------------------
   
   function InsertData($table,$array)
   {
     $this->db->insert($table,$array);
     return $this->db->insert_id();
   }
   
//-------------------------------------------------------------  
   
   function deleteRecord($table,$filed,$id) 
   {
     $this->db->where($filed,$id);
     $num_rows = $this->db->delete($table);
	 return $num_rows;	  
   }
   
//------------------------------------------------------------- 
   
   function getWhere($table,$filed,$id)
   {
	 $a=1;
	 $ids  = array($filed=>$id,'status'=>$a); 
	 $data = $this->db->get_where($table,$ids)->result_array();	
	 return $data; 	    
   } 
   
//-------------------------------------------------------------
   
   function getWheres($table,$filed,$id,$manager_code)
   {
	 $a=1;
	 $b=1;
	 $ids  = array($filed=>$id,'status'=>$a,'menu_aval'=>$b ,'manager_code'=>$manager_code); 
	 $data = $this->db->get_where($table,$ids)->result_array();	
	 return $data; 	    
   } 
   
//-------------------------------------------------------------
   
   function get_Record($table,$ord)
   {	 
	 $arr  = array('status'=>1);
	 $this->db->order_by("id", $ord);
	 $data = $this->db->get_where($table,$arr)->result_array();	
	 return $data; 	 
   } 
   
//-------------------------------------------------------------

   function getManager()
   {
	 $sql  = "SELECT tbl_branch.branch_name,tbl_manager.manager_code,tbl_manager.manager_name,tbl_manager.manager_city,tbl_manager.manager_pincode,tbl_manager.manager_mobile,tbl_manager.manager_email,tbl_manager.id,tbl_manager.username,tbl_manager.password FROM tbl_manager,tbl_branch where tbl_manager.branch_id=tbl_branch.id";
     $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;   
   }
   
//------------------------------------------------------------- 
   
   function UpdateData($table,$data,$field,$id)
   {
	 $this->db->where($field, $id);
     $this->db->update($table, $data);  
	 return $id;
   }
   
//--------------------------------------------------------------  
   
   function get_join_Record($table, $id)
   {	
	 $sql   = "SELECT tbl_menu.id,tbl_menu.menu_name,tbl_menu.menu_price,tbl_category.category_name,tbl_menu.menu_aval FROM tbl_menu,tbl_category WHERE tbl_menu.catergory_id=tbl_category.id and tbl_menu.manager_code = $id order by tbl_menu.id DESC";
     $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row; 	 
   }  
   
//------------------------------------------------------------
   
   function getTable($id)
   {
	 $sql="SELECT tbl_table.id,tbl_table.table_number FROM tbl_table WHERE tbl_table.id NOT IN(select table_id from tbl_order where tbl_order.bill_request=0 group by tbl_order.table_id) and tbl_table.manager_code=$id";   
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;   
   }
   
   function All_join_Record($table,$roles,$id)
   {
	 if('tbl_branch'==$table)
	 {	 
	   $sql = "SELECT tbl_branch.branch_name,tbl_table.manager_code,tbl_table.id,tbl_table.table_number,tbl_table.created_at FROM tbl_table,tbl_branch WHERE tbl_table.branch_id=tbl_branch.id and tbl_table.status=1 and tbl_table.branch_id=$id order by tbl_table.id DESC";
     }
	 
	 if('tbl_waiter'==$table)
	 {
	   if('manager'==$roles)
	   {   
	     $sql = "SELECT tbl_manager.branch_id,tbl_waiter.waiter_code,tbl_waiter.id,tbl_waiter.manager_code,tbl_waiter.waiter_name,tbl_waiter.waiter_address,tbl_waiter.waiter_city,tbl_waiter.waiter_pincode,tbl_waiter.waiter_mobile,tbl_waiter.waiter_mobile,tbl_waiter.waiter_email,tbl_waiter.username,tbl_waiter.password FROM tbl_waiter,tbl_manager WHERE tbl_waiter.manager_code=tbl_manager.manager_code AND tbl_manager.manager_code=$id order by tbl_waiter.id DESC"; 
	   }
	   else
	   {
		 $sql = "SELECT tbl_manager.branch_id,tbl_waiter.waiter_code,tbl_waiter.id,tbl_waiter.manager_code,tbl_waiter.waiter_name,tbl_waiter.waiter_address,tbl_waiter.waiter_city,tbl_waiter.waiter_pincode,tbl_waiter.waiter_mobile,tbl_waiter.waiter_mobile,tbl_waiter.waiter_email,tbl_waiter.username,tbl_waiter.password FROM tbl_waiter,tbl_manager WHERE tbl_waiter.manager_code=tbl_manager.manager_code order by tbl_waiter.id DESC";   
	   }	   
	 }
 	 
	 if('tbl_chef'==$table)
	 {
		if('manager'==$roles)
	    {
		  $sql = "SELECT tbl_manager.branch_id,tbl_chef.id,tbl_chef.manager_code,tbl_chef.chef_code,tbl_chef.chef_name,tbl_chef.chef_city,tbl_chef.chef_pincode,tbl_chef.chef_mobile,tbl_chef.chef_email,tbl_chef.created_at,tbl_chef.username,tbl_chef.password FROM tbl_chef,tbl_manager WHERE tbl_chef.manager_code=tbl_manager.manager_code AND tbl_chef.manager_code=$id order by tbl_chef.id DESC";
		}
		else
		{
		  $sql = "SELECT tbl_manager.branch_id,tbl_chef.id,tbl_chef.manager_code,tbl_chef.chef_code,tbl_chef.chef_name,tbl_chef.chef_city,tbl_chef.chef_pincode,tbl_chef.chef_mobile,tbl_chef.chef_email,tbl_chef.created_at,tbl_chef.username,tbl_chef.password FROM tbl_chef,tbl_manager WHERE tbl_chef.manager_code=tbl_manager.manager_code order by tbl_chef.id DESC";	
		}
	 }	 
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;   
   }
    
//------------------------------------------------------------   
   
   function gettemp_order($id)
   {
     $sql="SELECT tbl_category.category_name,tbl_menu.menu_name,tbl_temp_order.qty,tbl_temp_order.ordid,tbl_temp_order.suggestion,tbl_temp_order.id FROM tbl_temp_order,tbl_category,tbl_menu WHERE tbl_menu.id=tbl_temp_order.menu_id AND tbl_category.id=tbl_temp_order.category_id AND tbl_temp_order.status=1 AND tbl_temp_order.waiter_id=$id";
     $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row; 
   } 
   
   function get_order($roles,$id)
   {
	 if('waiter'==$roles)
	 {
	   //$sql="SELECT tbl_order.id,tbl_order.suggestion,tbl_order.order_status,tbl_order.table_id,tbl_order.qty,tbl_category.category_name,tbl_menu.menu_name,tbl_order.table_id FROM tbl_order,tbl_category,tbl_menu WHERE tbl_order.category_id=tbl_category.id and tbl_order.menu_id=tbl_menu.id and tbl_order.bill_request!=1 and tbl_order.waiter_id=$id";
       //24-09-2019
	   //$sql="SELECT tbl_order.id,tbl_order.suggestion,tbl_order.order_status,tbl_order.table_id,tbl_order.qty,tbl_category.category_name,tbl_menu.menu_name,tbl_order.table_id,tbl_customer.customer_mobile FROM tbl_order,tbl_category,tbl_menu,tbl_customer WHERE tbl_order.category_id=tbl_category.id and tbl_order.menu_id=tbl_menu.id and tbl_order.customer_id=tbl_customer.id and tbl_order.bill_request!=1 and tbl_order.waiter_id=$id";
	   $sql="SELECT tbl_order.id,tbl_order.orderid,tbl_order.suggestion,tbl_order.starttime,tbl_order.endtime,tbl_order.order_status,tbl_order.table_id,tbl_order.qty,tbl_category.category_name,tbl_customer.customer_name,tbl_customer.customer_email,tbl_menu.menu_name,tbl_menu.menu_time,tbl_customer.customer_mobile,tbl_order.customer_id,tbl_table.table_number FROM tbl_order,tbl_category,tbl_menu,tbl_customer,tbl_table WHERE tbl_order.category_id=tbl_category.id and tbl_order.menu_id=tbl_menu.id and tbl_order.customer_id=tbl_customer.id and tbl_table.id=tbl_order.table_id and tbl_order.bill_request!=1 and tbl_order.waiter_id=$id";
	 }
	 
	 if('chef'==$roles)
	 {
	   //$sql="SELECT tbl_order.id,tbl_order.suggestion,tbl_order.order_status,tbl_order.table_id,tbl_order.qty,tbl_category.category_name,tbl_menu.menu_name,tbl_order.table_id FROM tbl_order,tbl_category,tbl_menu WHERE tbl_order.category_id=tbl_category.id and tbl_order.menu_id=tbl_menu.id and tbl_order.bill_request!=1 and tbl_order.manager_code=$id"; 
	   $sql="SELECT tbl_order.id,tbl_order.orderid,tbl_order.suggestion,tbl_order.starttime,tbl_order.endtime,tbl_order.order_status,tbl_order.table_id,tbl_order.qty,tbl_category.category_name,tbl_menu.menu_name,tbl_menu.menu_time,tbl_table.table_number FROM tbl_order,tbl_category,tbl_menu,tbl_table WHERE tbl_order.category_id=tbl_category.id and tbl_table.id=tbl_order.table_id and tbl_order.menu_id=tbl_menu.id and tbl_order.order_status!=5   and tbl_order.bill_request!=1 and tbl_order.bill_request!=2 and tbl_order.manager_code=$id";
	 }
	 
	 if('admin'==$roles)
	 {
	   //$sql="SELECT tbl_manager.manager_code,tbl_branch.branch_name,tbl_order.id,tbl_order.order_status,tbl_order.suggestion,tbl_order.qty,tbl_waiter.waiter_code,tbl_category.category_name,tbl_menu.menu_name,tbl_order.table_id,tbl_chef.chef_code FROM tbl_order,tbl_manager,tbl_branch,tbl_waiter,tbl_category,tbl_menu,tbl_chef WHERE tbl_order.manager_code = tbl_manager.manager_code AND tbl_branch.id=tbl_manager.branch_id and tbl_waiter.id=tbl_order.waiter_id and tbl_category.id=tbl_order.category_id and tbl_menu.id=tbl_order.menu_id and tbl_chef.id=tbl_order.chef_id"; 
	   $sql="SELECT tbl_manager.manager_code,tbl_branch.branch_name,tbl_order.id,tbl_order.order_status,tbl_order.suggestion,tbl_order.starttime,tbl_order.endtime,tbl_order.qty,tbl_waiter.waiter_code,tbl_category.category_name,tbl_menu.menu_name,tbl_menu.menu_time,tbl_order.table_id,tbl_chef.chef_code,tbl_table.table_number FROM tbl_order,tbl_manager,tbl_branch,tbl_waiter,tbl_category,tbl_menu,tbl_chef,tbl_table WHERE tbl_order.manager_code = tbl_manager.manager_code AND tbl_branch.id=tbl_manager.branch_id and tbl_waiter.id=tbl_order.waiter_id and tbl_category.id=tbl_order.category_id and tbl_menu.id=tbl_order.menu_id and tbl_table.id=tbl_order.table_id and tbl_chef.id=tbl_order.chef_id";
	 }
     
     if('manager'==$roles)
	 {
	   //$sql="SELECT tbl_manager.manager_code,tbl_branch.branch_name,tbl_order.id,tbl_order.order_status,tbl_order.suggestion,tbl_order.qty,tbl_order.table_id,tbl_waiter.waiter_code,tbl_category.category_name,tbl_menu.menu_name,tbl_chef.chef_code FROM tbl_order,tbl_manager,tbl_branch,tbl_waiter,tbl_category,tbl_menu,tbl_chef WHERE tbl_order.manager_code = tbl_manager.manager_code AND tbl_branch.id=tbl_manager.branch_id and tbl_waiter.id=tbl_order.waiter_id and tbl_category.id=tbl_order.category_id and tbl_menu.id=tbl_order.menu_id and tbl_chef.id=tbl_order.chef_id and tbl_order.manager_code=$id"; 
	   //24-09-2019
	   //$sql="SELECT tbl_manager.manager_code, WHERE   tbl_order.manager_code=$id";
	   $sql="SELECT tbl_manager.manager_code,tbl_branch.branch_name,tbl_order.id,tbl_order.order_status,tbl_order.suggestion,tbl_order.starttime,tbl_order.endtime,tbl_order.qty,tbl_order.table_id,tbl_waiter.waiter_code,tbl_category.category_name,tbl_menu.menu_name,tbl_menu.menu_time,tbl_chef.chef_code,tbl_customer.customer_mobile,tbl_table.table_number FROM tbl_order,tbl_manager,tbl_branch,tbl_waiter,tbl_category,tbl_menu,tbl_chef,tbl_customer,tbl_table WHERE tbl_order.manager_code = tbl_manager.manager_code AND tbl_branch.id=tbl_manager.branch_id and tbl_waiter.id=tbl_order.waiter_id and tbl_category.id=tbl_order.category_id and tbl_menu.id=tbl_order.menu_id and tbl_chef.id=tbl_order.chef_id and tbl_customer.id=tbl_order.customer_id and tbl_table.id=tbl_order.table_id and tbl_order.manager_code=$id";
	 }	 
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;   
   }
   
   
   function orders($id,$ordid)
   {
	 $sql   = "SELECT tbl_order.id,tbl_order.orderid,tbl_order.suggestion,tbl_order.starttime,tbl_order.endtime,tbl_order.order_status,tbl_order.table_id,tbl_order.qty,tbl_category.category_name,tbl_menu.menu_name,tbl_menu.menu_time,tbl_table.table_number FROM tbl_order,tbl_category,tbl_menu,tbl_table WHERE tbl_order.category_id=tbl_category.id and tbl_table.id=tbl_order.table_id and tbl_order.menu_id=tbl_menu.id and tbl_order.bill_request!=1 and tbl_order.bill_request!=2 and tbl_order.manager_code=$id and tbl_order.orderid=$ordid";
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;   
   }
   
   
   function get_orders($roles,$id)
   {
     $sql="SELECT tbl_order.created_at,tbl_order.orderid,tbl_table.table_number FROM tbl_order,tbl_table where tbl_order.table_id=tbl_table.id and  bill_request=0 and tbl_order.manager_code=$id GROUP BY tbl_order.orderid ASC";
     $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;  
   }
   
   public function BillRequest($id)
   {
     //$sql   = "SELECT create_order_id.order_id,tbl_order.manager_code,tbl_order.table_id,tbl_waiter.waiter_code,tbl_chef.chef_code,tbl_order.bill_request FROM create_order_id,tbl_order,tbl_waiter,tbl_chef WHERE tbl_order.orderid=create_order_id.order_id and tbl_waiter.id=tbl_order.waiter_id and tbl_chef.id=tbl_order.chef_id and tbl_order.bill_request!=0 and tbl_order.bill_request!=2 and tbl_order.manager_code=$id group by tbl_order.orderid";
     //$sql   = "SELECT create_order_id.order_id,tbl_order.manager_code,tbl_order.table_id,tbl_waiter.waiter_code,tbl_chef.chef_code,tbl_order.bill_request FROM create_order_id,tbl_order,tbl_waiter,tbl_chef,tbl_payment WHERE tbl_order.orderid=create_order_id.order_id and tbl_waiter.id=tbl_order.waiter_id and tbl_chef.id=tbl_order.chef_id and tbl_order.bill_request!=0 and tbl_order.manager_code=$id and tbl_order.orderid!=tbl_payment.order_id group by tbl_order.orderid";
     //$sql="SELECT create_order_id.order_id,tbl_order.manager_code,tbl_order.table_id,tbl_waiter.waiter_code,tbl_chef.chef_code,tbl_order.bill_request,tbl_table.table_number FROM create_order_id,tbl_order,tbl_waiter,tbl_chef,tbl_table WHERE tbl_order.orderid=create_order_id.order_id and tbl_waiter.id=tbl_order.waiter_id and tbl_chef.id=tbl_order.chef_id and tbl_table.id=tbl_order.table_id and tbl_order.bill_request!=0 and tbl_order.bill_request!=2 and tbl_order.manager_code=$id group by tbl_order.orderid";
   	//$sql="SELECT create_order_id.order_id,tbl_order.orderid,tbl_order.manager_code,tbl_order.table_id,tbl_waiter.waiter_code,tbl_chef.chef_code,tbl_order.bill_request,tbl_table.table_number FROM create_order_id,tbl_order,tbl_waiter,tbl_chef,tbl_table WHERE tbl_order.orderid=create_order_id.id and tbl_waiter.id=tbl_order.waiter_id and tbl_chef.id=tbl_order.chef_id and tbl_table.id=tbl_order.table_id and tbl_order.bill_request!=0 and tbl_order.bill_request!=2 and tbl_order.manager_code=$id group by tbl_order.orderid ORDER BY tbl_order.orderid DESC";
   	$sql="SELECT create_order_id.order_id,tbl_order.orderid, tbl_order.table_id,tbl_order.manager_code,tbl_waiter.waiter_code,tbl_branch.branch_name,tbl_table.table_number, tbl_order.bill_request FROM tbl_order,create_order_id,tbl_branch,tbl_waiter,tbl_table,tbl_manager WHERE tbl_order.manager_code=tbl_manager.manager_code and tbl_order.table_id=tbl_table.id and tbl_branch.id=tbl_manager.branch_id and tbl_order.waiter_id=tbl_waiter.id and tbl_manager.manager_code=$id and tbl_order.bill_request=1  GROUP BY tbl_order.orderid DESC";	 
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row; 
   }
   
   public function Paymentview($roles,$id)
   {     
	 if('manager'==$roles)
	 {
       //$sql = "SELECT tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.discount,tbl_payment.total,tbl_payment.payment_amount,tbl_order.manager_code,tbl_payment.created_at,tbl_waiter.waiter_code,tbl_chef.chef_code FROM tbl_payment,tbl_order,tbl_waiter,tbl_chef WHERE tbl_payment.order_id=tbl_order.orderid and tbl_waiter.id=tbl_order.waiter_id and tbl_chef.id=tbl_order.chef_id and tbl_order.bill_request=2 and tbl_order.manager_code=$id group by tbl_order.orderid DESC";
       //$sql = "SELECT tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.discount,tbl_payment.total,tbl_payment.payment_amount,tbl_order.manager_code,tbl_payment.created_at,tbl_waiter.waiter_code,tbl_chef.chef_code,tbl_table.table_number FROM tbl_payment,tbl_order,tbl_waiter,tbl_chef,tbl_table WHERE tbl_payment.order_id=tbl_order.orderid and tbl_waiter.id=tbl_order.waiter_id and tbl_chef.id=tbl_order.chef_id and tbl_table.id=tbl_order.table_id and tbl_order.bill_request=2 and tbl_order.manager_code=$id group by tbl_order.orderid DESC";
	 	$sql = "SELECT tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.discount,tbl_payment.total,tbl_payment.payment_amount,tbl_order.manager_code,tbl_payment.created_at,tbl_waiter.waiter_code,tbl_table.table_number FROM tbl_payment,tbl_order,tbl_waiter,tbl_table WHERE tbl_payment.order_id=tbl_order.orderid and tbl_waiter.id=tbl_order.waiter_id and tbl_table.id=tbl_order.table_id and tbl_order.bill_request=2 and tbl_order.manager_code=$id group by tbl_order.orderid DESC";
	 }
	 else
	 {
	   //$sql = "SELECT tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.discount,tbl_payment.total,tbl_payment.payment_amount,tbl_order.manager_code,tbl_payment.created_at,tbl_waiter.waiter_code,tbl_chef.chef_code FROM tbl_payment,tbl_order,tbl_waiter,tbl_chef WHERE tbl_payment.order_id=tbl_order.orderid and tbl_waiter.id=tbl_order.waiter_id and tbl_chef.id=tbl_order.chef_id and tbl_order.bill_request=2 group by tbl_order.orderid DESC";   
	   //$sql = "SELECT tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.discount,tbl_payment.total,tbl_payment.payment_amount,tbl_order.manager_code,tbl_payment.created_at,tbl_waiter.waiter_code,tbl_chef.chef_code,tbl_table.table_number FROM tbl_payment,tbl_order,tbl_waiter,tbl_chef,tbl_table WHERE tbl_payment.order_id=tbl_order.orderid and tbl_waiter.id=tbl_order.waiter_id and tbl_chef.id=tbl_order.chef_id and tbl_table.id=tbl_order.table_id and tbl_order.bill_request=2 group by tbl_order.orderid DESC";
	   //$sql = "SELECT tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.discount,tbl_payment.total,tbl_payment.payment_amount,tbl_order.manager_code,tbl_payment.created_at,tbl_waiter.waiter_code,tbl_table.table_number FROM tbl_payment,tbl_order,tbl_waiter,tbl_table WHERE tbl_payment.order_id=tbl_order.orderid and tbl_waiter.id=tbl_order.waiter_id and tbl_table.id=tbl_order.table_id and tbl_order.bill_request=2 group by tbl_order.orderid DESC";
	 }
     $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row; 
   }
    
   //------------Updated by Jitu------------
   public function PaymentTodayview($roles,$id)
   {
   	$payment_date = @date('Y-m-d');     
	 if('manager'==$roles)
	 {
       //$sql = "SELECT tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.discount,tbl_payment.total,tbl_payment.payment_amount,tbl_order.manager_code,tbl_payment.created_at,tbl_waiter.waiter_code,tbl_chef.chef_code FROM tbl_payment,tbl_order,tbl_waiter,tbl_chef WHERE tbl_payment.order_id=tbl_order.orderid and tbl_waiter.id=tbl_order.waiter_id and tbl_chef.id=tbl_order.chef_id and tbl_order.bill_request=2 and tbl_order.manager_code=$id group by tbl_order.orderid DESC";
       $sql = "SELECT tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.discount,tbl_payment.total,tbl_payment.payment_amount,tbl_order.manager_code,tbl_payment.created_at,tbl_waiter.waiter_code,tbl_table.table_number FROM tbl_payment,tbl_order,tbl_waiter,tbl_table WHERE tbl_payment.order_id=tbl_order.orderid and tbl_waiter.id=tbl_order.waiter_id and tbl_table.id=tbl_order.table_id and tbl_order.bill_request=2 and tbl_order.manager_code=$id and DATE(tbl_payment.created_at) = DATE('$payment_date') group by tbl_order.orderid DESC";
	 }
	 else
	 {
	   //$sql = "SELECT tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.discount,tbl_payment.total,tbl_payment.payment_amount,tbl_order.manager_code,tbl_payment.created_at,tbl_waiter.waiter_code,tbl_chef.chef_code FROM tbl_payment,tbl_order,tbl_waiter,tbl_chef WHERE tbl_payment.order_id=tbl_order.orderid and tbl_waiter.id=tbl_order.waiter_id and tbl_chef.id=tbl_order.chef_id and tbl_order.bill_request=2 group by tbl_order.orderid DESC";   
	   $sql = "SELECT tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.discount,tbl_payment.total,tbl_payment.payment_amount,tbl_order.manager_code,tbl_payment.created_at,tbl_waiter.waiter_code,tbl_table.table_number FROM tbl_payment,tbl_order,tbl_waiter,tbl_table WHERE tbl_payment.order_id=tbl_order.orderid and tbl_waiter.id=tbl_order.waiter_id and tbl_table.id=tbl_order.table_id and tbl_order.bill_request=2 and DATE(tbl_payment.created_at) = DATE('$payment_date') group by tbl_order.orderid DESC";
	 }
     $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row; 
   }
   //-------------Updated by Jitu-----------
      
   public function getBill($id)
   { 
	   //$sql   = "SELECT tbl_order.orderid,tbl_order.menu_type,tbl_menu.menu_name,tbl_menu.menu_price,sum(tbl_order.qty) as qty ,tbl_order.table_id,tbl_customer.customer_mobile,tbl_customer.id,tbl_customer.customer_name,tbl_customer.customer_email FROM tbl_order,tbl_menu,tbl_customer WHERE tbl_customer.id=tbl_order.customer_id and tbl_menu.id=tbl_order.menu_id and tbl_order.orderid=$id group by tbl_order.menu_id";
       //$sql   = "SELECT tbl_order.orderid,tbl_order.menu_type,tbl_menu.menu_name,tbl_menu.menu_price,sum(tbl_order.qty) as qty ,tbl_order.table_id,tbl_customer.customer_mobile,tbl_customer.id,tbl_customer.customer_name,tbl_customer.customer_email FROM tbl_order,tbl_menu,tbl_customer WHERE tbl_customer.id=tbl_order.customer_id and tbl_menu.id=tbl_order.menu_id and tbl_order.orderid=$id and tbl_order.order_status IN(2,5) group by tbl_order.menu_id";	 
	   //$sql   = "SELECT tbl_order.orderid,tbl_order.menu_type,tbl_menu.menu_name,tbl_menu.menu_price,sum(tbl_order.qty) as qty ,tbl_order.table_id,tbl_customer.customer_mobile,tbl_customer.id,tbl_customer.customer_name,tbl_customer.customer_email,tbl_table.table_number,tbl_branch.branch_address FROM tbl_order,tbl_menu,tbl_customer,tbl_table,tbl_branch,tbl_manager WHERE tbl_customer.id=tbl_order.customer_id and tbl_menu.id=tbl_order.menu_id and tbl_order.orderid=$id and tbl_table.id=tbl_order.table_id and tbl_branch.id=tbl_manager.branch_id and tbl_manager.manager_code=tbl_order.manager_code and tbl_order.order_status IN(2,5) group by tbl_order.menu_id";
   	   $sql	="SELECT tbl_order.orderid,tbl_order.menu_type,tbl_menu.menu_name,tbl_menu.menu_price,sum(tbl_order.qty) as qty ,tbl_order.table_id,tbl_customer.customer_mobile,tbl_customer.id,tbl_customer.customer_name,tbl_customer.customer_email,tbl_table.table_number,tbl_branch.branch_name,tbl_branch.branch_address FROM tbl_order,tbl_menu,tbl_customer,tbl_table,tbl_branch,tbl_manager WHERE tbl_customer.id=tbl_order.customer_id and tbl_menu.id=tbl_order.menu_id and tbl_order.orderid=$id and tbl_table.id=tbl_order.table_id and tbl_branch.id=tbl_manager.branch_id and tbl_manager.manager_code=tbl_order.manager_code and tbl_order.bill_request=1 group by tbl_order.menu_id";
	 
	   $query = $this->db->query($sql);
	   $row   = $query->result_array();
	   return $row;   
   }
   public function getBill5($id)
   { 
	   //$sql   = "SELECT tbl_order.orderid,tbl_order.menu_type,tbl_menu.menu_name,tbl_menu.menu_price,sum(tbl_order.qty) as qty ,tbl_order.table_id,tbl_customer.customer_mobile,tbl_customer.id,tbl_customer.customer_name,tbl_customer.customer_email FROM tbl_order,tbl_menu,tbl_customer WHERE tbl_customer.id=tbl_order.customer_id and tbl_menu.id=tbl_order.menu_id and tbl_order.orderid=$id group by tbl_order.menu_id";
       //$sql   = "SELECT tbl_order.orderid,tbl_order.menu_type,tbl_menu.menu_name,tbl_menu.menu_price,sum(tbl_order.qty) as qty ,tbl_order.table_id,tbl_customer.customer_mobile,tbl_customer.id,tbl_customer.customer_name,tbl_customer.customer_email FROM tbl_order,tbl_menu,tbl_customer WHERE tbl_customer.id=tbl_order.customer_id and tbl_menu.id=tbl_order.menu_id and tbl_order.orderid=$id and tbl_order.order_status IN(2,5) group by tbl_order.menu_id";	 
	   //$sql   = "SELECT tbl_order.orderid,tbl_order.menu_type,tbl_menu.menu_name,tbl_menu.menu_price,sum(tbl_order.qty) as qty ,tbl_order.table_id,tbl_customer.customer_mobile,tbl_customer.id,tbl_customer.customer_name,tbl_customer.customer_email,tbl_table.table_number,tbl_branch.branch_address FROM tbl_order,tbl_menu,tbl_customer,tbl_table,tbl_branch,tbl_manager WHERE tbl_customer.id=tbl_order.customer_id and tbl_menu.id=tbl_order.menu_id and tbl_order.orderid=$id and tbl_table.id=tbl_order.table_id and tbl_branch.id=tbl_manager.branch_id and tbl_manager.manager_code=tbl_order.manager_code and tbl_order.order_status IN(2,5) group by tbl_order.menu_id";
   	   $sql	="SELECT tbl_order.orderid,tbl_order.menu_type,tbl_menu.menu_name,tbl_menu.menu_price,sum(tbl_order.qty) as qty ,tbl_order.table_id,tbl_customer.customer_mobile,tbl_customer.id,tbl_customer.customer_name,tbl_customer.customer_email,tbl_table.table_number,tbl_branch.branch_address FROM tbl_order,tbl_menu,tbl_customer,tbl_table,tbl_branch,tbl_manager WHERE tbl_customer.id=tbl_order.customer_id and tbl_menu.id=tbl_order.menu_id and tbl_order.orderid=$id and tbl_table.id=tbl_order.table_id and tbl_branch.id=tbl_manager.branch_id and tbl_manager.manager_code=tbl_order.manager_code and tbl_order.bill_request=2 group by tbl_order.menu_id";
	 
	   $query = $this->db->query($sql);
	   $row   = $query->result_array();
	   return $row;   
   }
    
   public function getBill1($orderid)
   {	 
   	   $sql	="SELECT tbl_tax.tax_name,tbl_tax.tax_percentage,tbl_tax.menu_type,tbl_payment.discount FROM tbl_order,tbl_tax,tbl_payment WHERE tbl_order.menu_type=tbl_tax.menu_type AND tbl_order.orderid=$orderid GROUP BY tbl_tax.tax_name";	 
	   $query = $this->db->query($sql);
	   $row   = $query->result_array();
	   return $row;   
   }

   function getcustomer($roles,$id)
   {
	  //$sql = "SELECT tbl_order.orderid,tbl_customer.customer_name,tbl_customer.customer_mobile,tbl_customer.customer_email FROM tbl_order,tbl_customer,tbl_branch,tbl_manager WHERE tbl_order.customer_id=tbl_customer.id and tbl_manager.manager_code=tbl_order.manager_code group by tbl_order.customer_id";   
      if('admin'==$roles)
	  {
        $sql = "SELECT tbl_branch.branch_name,tbl_order.id,tbl_order.customer_id,tbl_customer.customer_name,tbl_customer.customer_mobile,tbl_customer.customer_email FROM tbl_order,tbl_customer,tbl_branch,tbl_manager WHERE tbl_order.customer_id=tbl_customer.id and tbl_manager.manager_code=tbl_order.manager_code and tbl_branch.id=tbl_manager.branch_id and tbl_customer.status!=0 group by tbl_order.customer_id";
	  }
	  else
	  {
	    $sql = "SELECT tbl_branch.branch_name,tbl_order.id,tbl_order.customer_id,tbl_customer.customer_name,tbl_customer.customer_mobile,tbl_customer.customer_email FROM tbl_order,tbl_customer,tbl_branch,tbl_manager WHERE tbl_order.customer_id=tbl_customer.id and tbl_manager.manager_code=tbl_order.manager_code and tbl_branch.id=tbl_manager.branch_id and tbl_customer.status!=0 and tbl_manager.manager_code=$id group by tbl_order.customer_id"; 
	  }
	  $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row; 
   }
   
   function getallorder($roles,$id)
   {
	 if('admin'==$roles)
	 {	 
	   $sql = "SELECT tbl_order.orderid,tbl_order.created_at,tbl_order.table_id,tbl_manager.manager_code,tbl_waiter.waiter_code,tbl_branch.branch_name,tbl_table.table_number FROM tbl_order,tbl_manager,tbl_branch,tbl_waiter,tbl_table WHERE tbl_order.manager_code=tbl_manager.manager_code and tbl_order.table_id=tbl_table.id and tbl_branch.id=tbl_manager.branch_id and tbl_order.waiter_id=tbl_waiter.id GROUP BY tbl_order.orderid DESC";
	 }
	 else
	 {
	   $sql = "SELECT tbl_order.orderid,tbl_order.created_at,tbl_order.table_id,tbl_manager.manager_code,tbl_waiter.waiter_code,tbl_branch.branch_name,tbl_table.table_number FROM tbl_order,tbl_manager,tbl_branch,tbl_waiter,tbl_table WHERE tbl_order.manager_code=tbl_manager.manager_code and tbl_order.table_id=tbl_table.id and tbl_branch.id=tbl_manager.branch_id and tbl_order.waiter_id=tbl_waiter.id and tbl_manager.manager_code=$id GROUP BY tbl_order.orderid DESC"; 
	 }
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;
   }
   //----------update by Jitu---------------
   function getTodayorder($roles,$id)
   {
   	 $today_date = @date('Y-m-d');
	 if('admin'==$roles)
	 {	 
	   $sql = "SELECT tbl_order.orderid,tbl_order.created_at,tbl_order.table_id,tbl_manager.manager_code,tbl_waiter.waiter_code,tbl_branch.branch_name,tbl_table.table_number FROM tbl_order,tbl_manager,tbl_branch,tbl_waiter,tbl_table WHERE tbl_order.manager_code=tbl_manager.manager_code and tbl_order.table_id=tbl_table.id and tbl_branch.id=tbl_manager.branch_id and tbl_order.waiter_id=tbl_waiter.id and DATE(tbl_order.created_at) = DATE('$today_date') GROUP BY tbl_order.orderid DESC";
	 }
	 else
	 {
	   $sql = "SELECT tbl_order.orderid,tbl_order.created_at,tbl_order.table_id,tbl_manager.manager_code,tbl_waiter.waiter_code,tbl_branch.branch_name,tbl_table.table_number FROM tbl_order,tbl_manager,tbl_branch,tbl_waiter,tbl_table WHERE tbl_order.manager_code=tbl_manager.manager_code and tbl_order.table_id=tbl_table.id and tbl_branch.id=tbl_manager.branch_id and tbl_order.waiter_id=tbl_waiter.id and tbl_manager.manager_code=$id and DATE(tbl_order.created_at) = DATE('$today_date') GROUP BY tbl_order.orderid DESC"; 
	 }
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;
   }
   //------------Update by Jitu-------------
   function getWhereOrder($id)
   {
	  //$sql   = "SELECT tbl_order.orderid,tbl_order.suggestion,tbl_order.order_status,tbl_order.qty,tbl_order.manager_code,tbl_table.table_number,tbl_order.table_id,tbl_waiter.waiter_code,tbl_chef.chef_code,tbl_branch.branch_name,tbl_category.category_name,tbl_menu.menu_name FROM tbl_order,tbl_waiter,tbl_table,tbl_chef,tbl_branch,tbl_manager,tbl_category,tbl_menu where tbl_order.waiter_id=tbl_waiter.id and tbl_table.id=tbl_order.table_id and tbl_chef.id=tbl_order.chef_id and tbl_branch.id=tbl_manager.branch_id and tbl_category.id=tbl_order.category_id and tbl_menu.id=tbl_order.menu_id and tbl_order.orderid=$id";   
      //$sql   = "SELECT tbl_order.orderid,tbl_order.manager_code,sum(tbl_order.qty) as qty,tbl_order.order_status,tbl_order.created_at,tbl_table.table_number,tbl_order.suggestion,tbl_branch.branch_name,tbl_category.category_name,tbl_order.starttime,tbl_order.endtime,tbl_menu.menu_name,tbl_menu.menu_time,tbl_waiter.waiter_code,tbl_chef.chef_code FROM tbl_order,tbl_branch,tbl_manager,tbl_table,tbl_menu,tbl_category,tbl_waiter,tbl_chef WHERE tbl_manager.manager_code=tbl_order.manager_code and tbl_branch.id=tbl_manager.branch_id and tbl_table.id=tbl_order.table_id and tbl_category.id=tbl_order.category_id and tbl_menu.id=tbl_order.menu_id and tbl_waiter.id=tbl_order.waiter_id and tbl_chef.id=tbl_order.chef_id and tbl_order.orderid=$id group by menu_id";
   	  $sql	= "SELECT tbl_order.orderid, tbl_order.manager_code, sum(tbl_order.qty) as qty,tbl_order.created_at,tbl_table.table_number,tbl_order.suggestion,tbl_menu.menu_name,tbl_waiter.waiter_code, tbl_category.category_name FROM tbl_order,tbl_branch,tbl_manager,tbl_table,tbl_menu,tbl_category,tbl_waiter WHERE tbl_manager.manager_code=tbl_order.manager_code and tbl_branch.id=tbl_manager.branch_id and tbl_table.id=tbl_order.table_id and tbl_category.id=tbl_order.category_id and tbl_menu.id=tbl_order.menu_id and tbl_waiter.id=tbl_order.waiter_id and tbl_order.orderid=$id group by menu_id";
	  $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row;
   }

   function getWheresOrders($id)
   {
   	  $sql	= "SELECT tbl_order.orderid, tbl_order.manager_code, sum(tbl_order.qty) as qty,tbl_order.created_at,tbl_table.table_number,tbl_order.suggestion,tbl_menu.menu_name,tbl_waiter.waiter_code, tbl_category.category_name FROM tbl_order,tbl_branch,tbl_manager,tbl_table,tbl_menu,tbl_category,tbl_waiter WHERE tbl_manager.manager_code=tbl_order.manager_code and tbl_branch.id=tbl_manager.branch_id and tbl_table.id=tbl_order.table_id and tbl_category.id=tbl_order.category_id and tbl_menu.id=tbl_order.menu_id and tbl_waiter.id=tbl_order.waiter_id and tbl_order.id=$id group by menu_id";
	  $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row;
   }
   //----------------Updated By Jitu---------------
   
   function reportOrder($branchid,$from,$to)
   {  
      $sql = "SELECT tbl_branch.branch_name,tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.coupan_code,tbl_payment.discount,tbl_payment.total,tbl_payment.payment_amount,tbl_payment.created_at FROM tbl_payment,tbl_order,tbl_manager,tbl_branch WHERE tbl_order.orderid=tbl_payment.order_id AND tbl_manager.manager_code=tbl_order.manager_code AND tbl_branch.id=tbl_manager.branch_id AND tbl_branch.id=$branchid AND DATE_FORMAT(tbl_payment.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to' GROUP BY tbl_order.orderid";
	  $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row;
   }
   
   function getPayment($roles,$id)
   {
	 if('admin'==$roles)
	 {	 
	   $sql = "SELECT tbl_branch.branch_name,tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.coupan_code,tbl_payment.discount,tbl_payment.total, tbl_payment.packaging_amount, tbl_payment.payment_amount,tbl_payment.created_at FROM tbl_payment,tbl_order,tbl_manager,tbl_branch WHERE tbl_order.orderid=tbl_payment.order_id AND tbl_manager.manager_code=tbl_order.manager_code AND tbl_branch.id=tbl_manager.branch_id GROUP BY tbl_order.orderid ORDER BY tbl_order.orderid DESC";
	 }
	 else
	 {
	   $sql = "SELECT tbl_branch.branch_name,tbl_payment.order_id,tbl_payment.payment_mode,tbl_payment.coupan_code,tbl_payment.discount,tbl_payment.total,tbl_payment.packaging_amount,tbl_payment.payment_amount,tbl_payment.created_at FROM tbl_payment,tbl_order,tbl_manager,tbl_branch WHERE tbl_order.orderid=tbl_payment.order_id AND tbl_manager.manager_code=tbl_order.manager_code AND tbl_branch.id=tbl_manager.branch_id AND tbl_manager.manager_code = $id GROUP BY tbl_order.orderid ORDER BY tbl_order.orderid DESC"; 
	 }
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;
   }

   function reportMaximumfood($branchid,$from,$to)
   {  
      //$sql   = "SELECT tbl_menu.menu_name,tbl_order.orderid,tbl_order.qty,tbl_order.created_at,tbl_branch.branch_name FROM tbl_order,tbl_menu,tbl_branch,tbl_manager WHERE tbl_menu.id=tbl_order.menu_id AND tbl_branch.id=tbl_manager.branch_id AND tbl_order.manager_code=tbl_manager.manager_code AND tbl_branch.id=$branchid AND DATE_FORMAT(tbl_order.created_at,'%Y-%m-%d') BETWEEN $from AND $to";
      $sql   = "SELECT tbl_menu.menu_name,tbl_order.orderid,SUM(tbl_order.qty) as qty,tbl_order.created_at,tbl_branch.branch_name FROM tbl_order,tbl_menu,tbl_branch,tbl_manager WHERE tbl_menu.id=tbl_order.menu_id AND tbl_branch.id=tbl_manager.branch_id AND tbl_order.manager_code=tbl_manager.manager_code AND tbl_branch.id=$branchid AND DATE_FORMAT(tbl_order.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to' GROUP BY tbl_menu.id";
	  $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row;
   }

   function getMaximumitem($roles,$id)
   {
	 if('admin'==$roles)
	 {	 
	   $sql = "SELECT tbl_menu.menu_name,tbl_order.orderid,SUM(tbl_order.qty) as qty,tbl_order.created_at,tbl_branch.branch_name FROM tbl_order,tbl_menu,tbl_branch,tbl_manager WHERE tbl_menu.id=tbl_order.menu_id AND tbl_branch.id=tbl_manager.branch_id AND tbl_order.manager_code=tbl_manager.manager_code GROUP BY tbl_menu.id";
	 }
	 else
	 {
	   $sql = "SELECT tbl_menu.menu_name,tbl_order.orderid,SUM(tbl_order.qty) as qty,tbl_order.created_at,tbl_branch.branch_name FROM tbl_order,tbl_menu,tbl_branch,tbl_manager WHERE tbl_menu.id=tbl_order.menu_id AND tbl_branch.id=tbl_manager.branch_id AND tbl_order.manager_code=tbl_manager.manager_code AND tbl_manager.manager_code = $id GROUP BY tbl_menu.id"; 
	 }
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;
   }

   //--------------Updated By Jitu--------------
   function reportMaximumitem($branchid,$from,$to,$item)
   {  
      $sql   = "SELECT tbl_menu.menu_name,tbl_order.orderid,SUM(tbl_order.qty) as qty,tbl_order.created_at,tbl_branch.branch_name FROM tbl_order,tbl_menu,tbl_branch,tbl_manager WHERE tbl_menu.id=tbl_order.menu_id AND tbl_branch.id=tbl_manager.branch_id AND tbl_order.manager_code=tbl_manager.manager_code AND tbl_branch.id=$branchid AND tbl_menu.menu_name='$item' AND DATE_FORMAT(tbl_order.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to' GROUP BY tbl_menu.id";
      //SELECT tbl_menu.menu_name, tbl_order.orderid, SUM(tbl_order.qty) as qty, tbl_order.created_at, tbl_branch.branch_name FROM tbl_menu, tbl_order, tbl_branch, tbl_manager WHERE tbl_menu.id = tbl_order.menu_id AND tbl_branch.id = tbl_manager.branch_id AND tbl_order.manager_code = tbl_manager.manager_code AND tbl_branch.id = 1 AND tbl_menu.menu_name = 'Jeera Rice'
	  $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row;
   }
   
   function getallitem($roles,$id)
   {
	 if('admin'==$roles)
	 {	 
	   $sql = "SELECT tbl_menu.menu_name,tbl_order.orderid,SUM(tbl_order.qty) as qty,tbl_order.created_at,tbl_branch.branch_name FROM tbl_order,tbl_menu,tbl_branch,tbl_manager WHERE tbl_menu.id=tbl_order.menu_id AND tbl_branch.id=tbl_manager.branch_id AND tbl_order.manager_code=tbl_manager.manager_code GROUP BY tbl_menu.id";
	 }
	 else
	 {
	   $sql = "SELECT tbl_menu.menu_name,tbl_order.orderid,SUM(tbl_order.qty) as qty,tbl_order.created_at,tbl_branch.branch_name FROM tbl_order,tbl_menu,tbl_branch,tbl_manager WHERE tbl_menu.id=tbl_order.menu_id AND tbl_branch.id=tbl_manager.branch_id AND tbl_order.manager_code=tbl_manager.manager_code AND tbl_manager.manager_code = $id GROUP BY tbl_menu.id"; 
	 }
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;
   }

   function reportMaximumCategory($branchid,$from,$to,$category)
   {
   		$sql   = "SELECT tbl_category.category_name, tbl_order.orderid, SUM(tbl_order.qty) as qty, tbl_order.created_at, tbl_branch.branch_name FROM tbl_category, tbl_menu, tbl_order, tbl_branch, tbl_manager WHERE tbl_menu.id = tbl_order.menu_id AND tbl_branch.id = tbl_manager.branch_id AND tbl_order.manager_code = tbl_manager.manager_code AND tbl_branch.id = $branchid AND tbl_category.id = tbl_menu.catergory_id AND tbl_category.category_name = '$category' AND DATE_FORMAT(tbl_order.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to' GROUP BY tbl_menu.id";
   		//SELECT tbl_category.category_name, tbl_order.orderid, SUM(tbl_order.qty) as qty, tbl_order.created_at, tbl_branch.branch_name FROM tbl_category, tbl_menu, tbl_order, tbl_branch, tbl_manager WHERE tbl_menu.id = tbl_order.menu_id AND tbl_branch.id = tbl_manager.branch_id AND tbl_order.manager_code = tbl_manager.manager_code AND tbl_branch.id = 1 AND tbl_category.id = tbl_menu.catergory_id AND tbl_category.category_name = 'Rice'
	  $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row;
   }

   function getallcategory($roles,$id)
   {
	 if('admin'==$roles)
	 {	 
	   $sql = "SELECT tbl_category.category_name,tbl_order.orderid,SUM(tbl_order.qty) as qty,tbl_order.created_at,tbl_branch.branch_name FROM tbl_order,tbl_menu,tbl_branch,tbl_manager, tbl_category WHERE tbl_category.id = tbl_menu.catergory_id AND tbl_menu.id=tbl_order.menu_id AND tbl_branch.id=tbl_manager.branch_id AND tbl_order.manager_code=tbl_manager.manager_code GROUP BY tbl_category.id";
	 }
	 else
	 {
	   $sql = "SELECT tbl_category.category_name,tbl_order.orderid,SUM(tbl_order.qty) as qty,tbl_order.created_at,tbl_branch.branch_name FROM tbl_order,tbl_menu,tbl_branch,tbl_manager, tbl_category WHERE tbl_category.id = tbl_menu.catergory_id AND tbl_menu.id=tbl_order.menu_id AND tbl_branch.id=tbl_manager.branch_id AND tbl_order.manager_code=tbl_manager.manager_code AND tbl_manager.manager_code = $id GROUP BY tbl_category.id"; 
	 }
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;
   }

   function reportMaximumCustomer($branchid,$from,$to)
   {
   		$sql   = "SELECT tbl_branch.branch_name, tbl_customer.customer_name, tbl_customer.customer_mobile, tbl_customer.customer_email, tbl_payment.payment_amount, tbl_payment.payment_mode FROM tbl_branch , tbl_customer, tbl_order, tbl_manager, tbl_payment WHERE tbl_branch.id = $branchid AND tbl_order.customer_id = tbl_customer.id AND tbl_order.manager_code = tbl_manager.manager_code AND tbl_manager.branch_id = tbl_branch.id AND tbl_payment.order_id = tbl_order.orderid AND DATE_FORMAT(tbl_order.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to' GROUP BY tbl_order.orderid";
	  $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row;
   }

   function getallCustomer($roles,$id)
   {
	 if('admin'==$roles)
	 {	 
	   $sql = "SELECT tbl_branch.branch_name, tbl_customer.customer_name, tbl_customer.customer_mobile, tbl_customer.customer_email, tbl_payment.payment_amount, tbl_payment.payment_mode FROM tbl_branch , tbl_customer, tbl_order, tbl_manager, tbl_payment WHERE tbl_order.customer_id = tbl_customer.id AND tbl_order.manager_code = tbl_manager.manager_code AND tbl_manager.branch_id = tbl_branch.id AND tbl_payment.order_id = tbl_order.orderid GROUP BY tbl_payment.id ORDER BY tbl_payment.id DESC";
	 }
	 else
	 {
	   $sql = "SELECT tbl_branch.branch_name, tbl_customer.customer_name, tbl_customer.customer_mobile, tbl_customer.customer_email, tbl_payment.payment_amount, tbl_payment.payment_mode FROM tbl_branch , tbl_customer, tbl_order, tbl_manager, tbl_payment WHERE tbl_order.customer_id = tbl_customer.id AND tbl_order.manager_code = tbl_manager.manager_code AND tbl_manager.branch_id = tbl_branch.id AND tbl_payment.order_id = tbl_order.orderid AND tbl_manager.manager_code = $id GROUP BY tbl_payment.id ORDER BY tbl_payment.id DESC";
	 }
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;
   }
   function getWaiterAllRecord($roles,$id)
   {
	 if('admin'==$roles)
	 {	 
	   $sql = "SELECT tbl_order.orderid,tbl_branch.branch_name,tbl_manager.manager_code,tbl_waiter.waiter_code,tbl_table.table_number,tbl_order.created_at FROM tbl_order,tbl_branch,tbl_manager,tbl_waiter,tbl_table WHERE tbl_order.manager_code=tbl_manager.manager_code AND tbl_branch.id=tbl_manager.branch_id AND tbl_waiter.id=tbl_order.waiter_id AND tbl_table.id=tbl_order.table_id GROUP BY tbl_order.orderid ORDER BY tbl_order.orderid DESC";
	 }
	 else
	 {
	   $sql = "SELECT tbl_order.orderid,tbl_branch.branch_name,tbl_manager.manager_code,tbl_waiter.waiter_code,tbl_table.table_number,tbl_order.created_at FROM tbl_order,tbl_branch,tbl_manager,tbl_waiter,tbl_table WHERE tbl_order.manager_code=tbl_manager.manager_code AND tbl_branch.id=tbl_manager.branch_id AND tbl_waiter.id=tbl_order.waiter_id AND tbl_table.id=tbl_order.table_id AND tbl_manager.manager_code = $id GROUP BY tbl_order.orderid ORDER BY tbl_order.orderid DESC"; 
	 }
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;
   }
   function reportWaiter($branchid,$id,$roles,$from,$to)
   {  
      if('waiter'==$roles)
	  {	 
	    $sql = "SELECT tbl_order.orderid,tbl_branch.branch_name,tbl_manager.manager_code,tbl_waiter.waiter_code,tbl_table.table_number,tbl_order.created_at FROM tbl_order,tbl_branch,tbl_manager,tbl_waiter,tbl_table WHERE tbl_order.manager_code=tbl_manager.manager_code AND tbl_branch.id=tbl_manager.branch_id AND tbl_waiter.id=tbl_order.waiter_id AND tbl_table.id=tbl_order.table_id AND tbl_branch.id=$branchid AND tbl_waiter.id=$id AND DATE_FORMAT(tbl_order.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to' GROUP BY tbl_order.orderid";
	  }
	  else
	  {		 
	    $sql = "SELECT tbl_order.orderid,tbl_branch.branch_name,tbl_order.manager_code,tbl_chef.chef_code,tbl_table.table_number,tbl_order.created_at FROM tbl_order,tbl_branch,tbl_manager,tbl_chef,tbl_table WHERE tbl_order.manager_code=tbl_manager.manager_code AND tbl_manager.branch_id=tbl_branch.id AND tbl_chef.id=tbl_order.chef_id AND tbl_table.id=tbl_order.table_id AND tbl_branch.id=$branchid AND tbl_chef.id=$id AND DATE_FORMAT(tbl_order.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to' GROUP BY tbl_order.orderid"; 
	  }
	  $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row;
   }
   
   function GetRecords($roles,$branchid)
   {
     if('waiter'==$roles)
	 {	
	   $sql = "SELECT tbl_waiter.id,tbl_waiter.waiter_code,tbl_waiter.roles FROM tbl_waiter,tbl_manager WHERE tbl_waiter.manager_code=tbl_manager.manager_code and tbl_manager.branch_id=$branchid";
     }
	 else
	 {
	   $sql = "SELECT tbl_chef.id,tbl_chef.chef_code,tbl_chef.roles FROM tbl_chef,tbl_manager WHERE tbl_chef.manager_code=tbl_manager.manager_code and tbl_manager.branch_id=$branchid";	
	 }
	 $query = $this->db->query($sql);
	 $row   = $query->result_array();
	 return $row;
   }
   
   function GetTaxes($orderid)
   {
	  $sql   = "SELECT tbl_tax.tax_name,tbl_tax.tax_percentage,tbl_tax.menu_type FROM tbl_order,tbl_tax WHERE tbl_order.menu_type=tbl_tax.menu_type AND tbl_order.orderid=$orderid GROUP BY tbl_tax.tax_name";
	  $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row;   
   }
   
   function coupons($id)
   {  
      $sql   = "SELECT tbl_customer.id,tbl_customer.customer_mobile,tbl_branch.state_id FROM tbl_order,tbl_customer,tbl_manager,tbl_branch where tbl_customer.id=tbl_order.customer_id AND tbl_branch.id=tbl_manager.branch_id AND tbl_manager.manager_code=tbl_order.manager_code AND tbl_order.manager_code=$id GROUP BY tbl_order.customer_id";
	  $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row;
   }
   
   function getcoupons($id)
   {
	  //$sql   = "SELECT * FROM tbl_coupan WHERE state_id IN(select tbl_branch.state_id FROM tbl_manager,tbl_branch where tbl_manager.branch_id=tbl_branch.id and tbl_manager.manager_code=$id) and tbl_coupan.status=1";
	  $sql   = "SELECT * FROM tbl_coupan WHERE tbl_coupan.manager_code=$id order by id desc";
	  $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row;
   }
   // and customer_mobile=$mobile
   function checkcoupon($mobile,$cou_co)
   {
	  $sql   = "SELECT * FROM tbl_coupan where coupan_code='$cou_co' and CURRENT_DATE()>=from_date and CURRENT_DATE()<=to_date and status=1";  
      $query = $this->db->query($sql);
	  $row   = $query->result_array();
	  return $row;
   }
    
}