<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	function getallorders($status_id=0)
	{
		$this->db->select('orders.*,products.category_id,products.product_type,products.product_name,products.description,products.selling_price,users.first_name,users.last_name,user_details.email,user_details.phone,order_items_detail.order_qty');
		$this->db->from('orders');
		$this->db->join('products','products.product_id=orders.product_id');
		$this->db->join('order_items_detail','order_items_detail.order_id=orders.order_id','left');
		$this->db->join('user_details','orders.user_id=user_details.user_id','left');
		$this->db->join('users','users.id=orders.user_id');
		$this->db->where('orders.is_delete <>',2);
		if(!empty($status_id)){
			$this->db->where('orders.status',$status_id);
		}
		$this->db->order_by('orders.order_id','desc');
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	
	function getFTCReportbyOrderId($orderId=0){
		$this->db->select('*');
		$this->db->from('order_ftc_report');
		$this->db->where('order_id',$orderId);
		$this->db->order_by('order_ftc_report_id','desc');
		$this->db->limit(1);
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		return $query->row();
	}
	function getOrderDocuments($order_id=0){
		$this->db->select('order_detail.*,users.first_name,users.last_name');
		$this->db->from('order_detail');
		$this->db->join('users','users.id=order_detail.upload_by');
		$this->db->where('order_detail.order_id',$order_id);
		$this->db->where('order_detail.block_id',5);
		$this->db->order_by('order_detail.order_detail_id','desc');
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();	
	}
	function getAdminOrderDocuments($order_id=0){
		$this->db->select('order_document.*,users.first_name,users.last_name');
		$this->db->from('order_document');
		$this->db->join('users','users.id=order_document.user_id');
		$this->db->where('order_document.order_id',$order_id);
		$this->db->order_by('order_document.document_id','desc');
		$query=$this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();	
	}
	
	function getdynamicApplicationBlock($order_id=0){
		if(!empty($order_id)){
			$orderdata = $this->Common->select('order_detail',['order_id' => $order_id,'block_id' =>10]);
			
			$orders = $this->Common->selectrow('orders',['order_id' => $order_id]);
			$product_id 		= $orders->product_id;
			$add_month 	= strtok($orders->product_options, ' ');
			$monthstr = '+'.$add_month.' month';
			$created_date 		= date('Y-m-d');
			$date = strtotime(date("Y-m-d", strtotime($created_date)) . $monthstr);
			$actualdate = date("m-d-Y",$date);
			$orderdate = date('m/d/Y',strtotime($created_date));
			
			$employerstate='';
			$employercity='';
			$employeraddress='';
			$employer='';
			$yearsataddress='';
			$housingtype='';
			$zip='';
			$state='';
			$city='';
			$address='';
			$driverslicense='';
			$driverslicenseexp='';
			$email='';
			$phone='';
			$ssn='';
			$dob='';
			$firstname='';
			$lastname='';
			$employerzip='';
			$employerphone='';
			$yearsonjob='';
			$grossannualincome='';
			$signature='';
		
			foreach($orderdata as $getOrders){
				if($getOrders->custom_field_name=='employer-state'){
					$employerstate = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='employer-city'){
					$employercity = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='employer-address'){
					$employeraddress = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='employer'){
					$employer = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='years-at-address'){
					$yearsataddress = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='housing-type:-rent/own/other'){
					$housingtype = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='zip'){
					$zip = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='state'){
					$state = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='city'){
					$city = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='address'){
					$address = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='drivers-license-exp-date'){
					$driverslicenseexp = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='driver-license-#'){
					$driverslicense = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='email'){
					$email = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='phone'){
					$phone = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='ssn-#'){
					$ssn = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='date-of-birth'){
					$dob = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='last-name'){
					$lastname = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='first-name'){
					$firstname = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='employer-zip'){
					$employerzip = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='employer-phone'){
					$employerphone = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='years-on-job'){
					$yearsonjob = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='gross-monthly-income'){
					$grossmonthlyincome = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='gross-annual--income'){
					$grossannualincome = $getOrders->custom_field_values;
				}
				else if($getOrders->custom_field_name=='signature'){
					$signature = $getOrders->custom_field_values;
				}
			}
			
			$applicationdata=[
				'employerstate' 	=> 	$employerstate,
				'employercity'		=>	$employercity,
				'employeraddress'	=>	$employeraddress,
				'employer'			=>	$employer,
				'yearsataddress'	=>	$yearsataddress,
				'housingtype'		=>	$housingtype,
				'zip'				=>	$zip,
				'state'				=>	$state,
				'city'				=>	$city,
				'address'			=>	$address,
				'driverslicense'	=>	$driverslicense,
				'driverslicenseexp'	=>	$driverslicenseexp,
				'email'				=>	$email,
				'phone'				=>	$phone,
				'ssn'				=>	$ssn,
				'dob'				=>	$dob,
				'firstname'			=>	$firstname,
				'lastname'			=>	$lastname,
				'employerzip'		=>	$employerzip,
				'employerphone'		=>	$employerphone,
				'yearsonjob'		=>	$yearsonjob,
				'grossannualincome'	=>	$grossannualincome,
				'signature'			=>	$signature,
				'orderdate'			=>	$orderdate,
				'actualdate'		=>	$actualdate
			];
	 	return (object) $applicationdata;
		}
	}
}
