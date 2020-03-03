<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Global_model extends CI_Model {
    public function __construct() {
        parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Common');
		$this->BASEURL = 'https://getthatcredit.com/';
    }
	function getContractLetterByUserId($userId=0,$orderId=0,$productId=0)
	{
		$getUserDetail 	= $this->User_model->getUserDetailById($userId);
		
		$getPersonalInfo = $this->getPersonalInfomationByOrderId($orderId);
			
		if(!empty($getUserDetail) && !empty($getPersonalInfo)){
			
			$first_name = $getPersonalInfo['first-name'];
			$last_name 	= $getPersonalInfo['last-name'];
			$address  	= $getPersonalInfo['address'];
			$city 		= $getPersonalInfo['city'];
			$state 		= $getPersonalInfo['state'];
			$zipcode 	= $getPersonalInfo['zip'];
			$phone	 	= $getPersonalInfo['phone'];
			$email	 	= $getPersonalInfo['email'];
			$dob		= $getPersonalInfo['date-of-birth'] ?? '';
			$ssn		= $getPersonalInfo['ssn-#'];			

			
			$resUser = $getUserDetail[0];
			//$first_name = $resUser->first_name;
			//$last_name 	= $resUser->last_name;
			//$phone 		= $resUser->phone;
			//$address 	= $resUser->address;
			$address1 	= $resUser->address1;
			$address2 	= $resUser->address2;
			$address3 	= $resUser->address3;
			//$city 		= $resUser->city;
			//$state 		= $resUser->state;
			$country 	= $resUser->country;
			//$zipcode 	= $resUser->zipcode;
			$user_type 		= $resUser->user_type;
			
			$parent_user_id = $resUser->parent_user_id;
			$user_id 		= $resUser->user_id;
			
			$parentName  ='';
			if(!empty($parent_user_id)){
				$parentName  = orderusersname($parent_user_id);
			}
			$where = array('user_id'=>$user_id,'order_id'=>$orderId);
            $contract_sign = $this->Basic->getsinglerow($where,'contract_sign');
			
            $data['contract_sign']=$contract_sign;
            if($contract_sign)
            	$sign = '<img alt="" src="'.$contract_sign->sign.'" style="height:80px; width:250px" />';
            else
            $sign = '';	
			
			
		if(empty($productId)){
            $where = array('user_id'=>$user_id,'order_id'=>$orderId);
            $order = $this->Basic->getsinglerow($where,'orders');
            if(!empty($orderId)){
            	 $productId = $order->product_id;
            }
		}
			
            if(!empty($productId) || !empty($orderId)){
				$where = array('product_id'=>$productId);
				$products = $this->Basic->getsinglerow($where,'products');
				$type='';
				if(!empty($products)){
					$where = array('id'=>$products->category_id);
					$categories = $this->Basic->getsinglerow($where,'categories');
					
					if($categories){ 
						$categoryname = $categories->name;
					}
					else{
						$categoryname = $products->product_name; 	
					}				
					if(strpos($categoryname,'CREDIT') !== false)
						$type = "credit";
					else if (strpos($categoryname,'credit') !== false) 
						$type = "credit";
					else if (strpos($categoryname,'Credit') !== false) 
						$type = "credit";
					else if(strpos($categoryname,'FUNDING') !== false)
						$type = "funding";
					else if(strpos($categoryname,'funding') !== false)
						$type = "funding";
					else if(strpos($categoryname,'Funding') !== false)
						$type = "funding";
				}
            }
           
            //if(!isset($type))
            //$type = 'credit';

			$creditwhere=[];
		    if($type=='credit')
				$creditwhere = array('id' => (isMobile() ? 17:18));
		    else if($type=='funding')
            	$creditwhere = array('id' => (isMobile() ? 19:11));
			if(!empty($creditwhere)){
				$creditcontracthere = $this->Basic->getsinglerow($creditwhere,'letter_templates');
				$message  = $creditcontracthere->message;
				$siteName=sitename();
				$siteLogo=sitelogo();
				if(!empty($parent_user_id)){
					$siteInfo = $this->getSiteSettingBybrokerId($parent_user_id); // broker id 
				
					$siteName = $siteInfo->sitename ?? $siteName;
					$siteLogo = $siteInfo->sitelogo ?? $siteLogo;
				}
				$tempvalues = array('##SITENAME##'=> $siteName,'##LOGO##' => $siteLogo,'##FIRSTNAME##'=>$first_name,'##LASTNAME##'=>$last_name,'##ADDRESS##'=>$address,'##CITY##'=>$city,'##date##'=>date('m/d/Y'),'##STATE##'=>$state,'##ZIP##'=>$zipcode,'##DATE##'=>date('m/d/Y'),'##BROKERNAME##'=>$parentName,'##SIGN##'=>$sign);
				$message = strtr($message,$tempvalues);
				$data['message']=$message;
			}
				$this->load->library('pdf');

				if($sign==''){
					$where = array('user_id'=>$user_id);
					$old_contract_sign = $this->Basic->getsinglerow($where,'contract_sign');
					$oldsign='';
					if($old_contract_sign)
						$oldsign = $old_contract_sign->sign; 
				}
				if(empty($contract_sign)){
					$withoutsign_filename = $user_id.''.$orderId.''.strtotime("now");
					@$this->pdf->generate($user_id,$data['message'],$withoutsign_filename);
					$signedContractUrl = base_url('uploads/pdffiles/'.$user_id.'/'.$withoutsign_filename.".pdf");
						$ordersData=[
							'user_id' 		=> $user_id,
							'order_id'		=> $orderId,
							'sign'	        => $oldsign,
							'before_sign_contract'=>$signedContractUrl,
							'added_date'	=> date('Y-m-d H:i:s')
						];
						$this->Basic->insertdata($ordersData,'contract_sign');
				 }else{
					if($contract_sign && $contract_sign->before_sign_contract=='')
					{
						$withoutsign_filename = $user_id.''.$orderId.''.strtotime("now");
						@$this->pdf->generate($user_id,$data['message'],$withoutsign_filename);
						$signedContractUrl = base_url('uploads/pdffiles/'.$user_id.'/'.$withoutsign_filename.".pdf");

						$ordersData=[
							'before_sign_contract'	=>$signedContractUrl,
							'sign'	=> $oldsign,
							'added_date'=> date('Y-m-d H:i:s')
						];
						$this->Basic->updatedata($ordersData,['order_id' => $orderId,'user_id' =>$user_id],'contract_sign');
					}
				 }

				$contractsign = $this->load->view('theme/steps/contract',$data,true);
			
			return $contractsign;
		}
	}

	function getOrderItemDetailByOrderId($orderId=0){
		$this->db->select('orders.user_id,order_items_detail.*')->from('orders');
		$this->db->join('order_items_detail','order_items_detail.order_id = orders.order_id');
		$this->db->where('orders.order_id',$orderId);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	
	function selectYouDisputeItem($order_id=0,$userId=0,$order_step_no=0){
		//$userId = $data['purchase']->student_id;
		
		$disputeList['creditstatus'] 	= $this->Common->select('creditstatus');
		$disputeList['instruction'] 	= $this->Common->select('instruction');
		$disputeList['credit_report_reason'] = $this->Common->select('credit_report_reason',array('parent_id'=>'0'));
		$disputeList['ins'] = $this->Common->select('credit_report_reason',array('parent_id !='=>'0'));
		
		$order = 'id'.'  '.'asc';
		$personalinfo = $this->Basic->getmultiplerow($order,['user_id'=>$userId,'status'=>1],'dispute_personal_info');

		$order = 'dispute_creditInq_id'.'  '.'asc';
		$creditinfo = $this->Basic->getmultiplerow($order,['user_id'=>$userId,'status'=>1],'dispute_credit_inquiry');

		$order = 'dispute_account_id'.' '.'asc';
		$dispute_account_history = $this->Basic->getmultiplerow($order,['user_id'=>$userId,'status'=>1],'dispute_account_history');
		$totalNoOfAccount = count($dispute_account_history);
		$totalSteps = round($totalNoOfAccount/2); 
		$accounthistory=[];
		if($dispute_account_history){	
			foreach($dispute_account_history as $keyhere => $acchis){
				$number = $keyhere+1;
				$order = 'dispute_account_id'.' '.'asc';
				$where = array('dispute_account_id'=>$acchis->dispute_account_id,'status'=>1);
				$inner_array = $this->Basic->getmultiplerow($order,$where,'dispute_account_history_details');
				$checkvalues = array();
				$accountHistoryList=[];
				if($inner_array){
					foreach ($inner_array as $inner_value) 
					{
						$accountHistoryList[]= [
							'dispute_acct_his_detail_id' => $inner_value->dispute_acct_his_detail_id,
							'company_title'	=>	$inner_value->name,
							'accountno'	=>	$inner_value->accountno,
							'paymentstatus'	=>	$inner_value->paymentstatus,
							'comments'	=>	$inner_value->comments,
							'dateopened'	=>	$inner_value->dateopened,
							'balance'	=>	$inner_value->balance,
							'account_status'=>$inner_value->account_status,
							'reason'	=>	$inner_value->reason,
							'instruction'	=>	$inner_value->instructions,
						];
					}
				}

				$accounthistory[]=[
					'dispute_account_id' 	=> $acchis->dispute_account_id,
					'company_title' 		=> $acchis->company_title,
					'account_type_id' 		=> $acchis->account_type_id,
					'account_ins_id' 		=> $acchis->account_ins_id,
					'is_checked' 			=> (int) $acchis->is_checked,
					'account_historylist' 	=> $accountHistoryList
				];
			}
		}
		
		//$accounthistory = array_chunk($accounthistory,2);
		$disputeList['personalInfo'] 	= $personalinfo;
		$disputeList['creditInquiry'] 	= $creditinfo;
		$disputeList['accountHistory'] 	= $accounthistory;
		$disputeList['selectedDisputeItem'] 	= $this->selectedYourOrderDisputeItem($order_id);
		$disputeItem = $this->load->view('theme/steps/dispute_items',$disputeList,true);
		return $disputeItem;
	}
	
	/******Dispute Personal Info  *****/
	function getDisputePersonalInfoSelected($personalinfoIds=0,$user_id=0){
		$this->db->select('*')->from('dispute_personal_info');
		$this->db->where('status',1);
		if(!empty($user_id) && isset($user_id)){
			$this->db->where('user_id',$user_id);
		}
		if(!empty($personalinfoIds) && isset($personalinfoIds)){
			$this->db->where_in('id',$personalinfoIds);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	/******Dispute Credit Enquiry *****/
	function getDisputeCreditEnquirySelected($dispute_creditInq_ids=0,$user_id=0){
		$this->db->select('*')->from('dispute_credit_inquiry');
		$this->db->where('status',1);
		if(!empty($user_id) && isset($user_id)){
			$this->db->where('user_id',$user_id);
		}
		if(!empty($dispute_creditInq_ids) && isset($dispute_creditInq_ids)){
			$this->db->where_in('dispute_creditInq_id',$dispute_creditInq_ids);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	/******Dispute Account History *****/
	function getAccountHistorySelected($dispute_account_ids=0,$user_id=0){
		$this->db->select('*')->from('dispute_account_history');
		$this->db->where('status',1);
		if(!empty($user_id) && isset($user_id)){
			$this->db->where('user_id',$user_id);
		}
		if(!empty($dispute_account_ids) && isset($dispute_account_ids)){
			$this->db->where_in('dispute_account_id',$dispute_account_ids);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	/******Dispute Account History Detail*****/
	function getAccountHistoryDetailSelected($dispute_account_id=0){
		$this->db->select('*')->from('dispute_account_history_details');
		$this->db->where('status',1);
		if(!empty($dispute_account_id) && isset($dispute_account_id)){
			$this->db->where_in('dispute_account_id',$dispute_account_id);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}

	function selectedYourOrderDisputeItem($order_id=0,$userId=0){
	
		$order = 'dispute_pf_id'.'  '.'asc';
		$where = array('order_id'=>$order_id,'status'=>1);
		$personalinfo = $this->Basic->getmultiplerow($order,$where,'order_dispute_personal_info');
		
		$personalinfoData=[];
		foreach($personalinfo as $getPersonal){
			$personalinfoData[$getPersonal->dispute_pf_id]=[
					'id' 				=> $getPersonal->dispute_pf_id,
					'order_id' 			=> $getPersonal->order_id,
					'is_name_checked' 	=> $getPersonal->is_name_checked,
					'is_knows_checked' 	=> $getPersonal->is_knows_checked,
					'is_dob_checked' 	=> $getPersonal->is_dob_checked,
					'address' 			=> $getPersonal->address
				];
		}
			
		$personalinfo = json_decode(json_encode($personalinfoData), FALSE);
		
		$order = 'dispute_creditInq_id'.'  '.'asc';
		$where = array('order_id'=>$order_id,'status'=>1);
		$creditinfo = $this->Basic->getmultiplerow($order,$where,'order_dispute_credit_inquiry');
		$creditInfoData=[];
		if($creditinfo){	
			foreach($creditinfo as $getcreditinfo){
				$accounthistory[$getcreditinfo->dispute_creditInq_id]=[
					'dispute_creditInq_id' 	=> $getcreditinfo->dispute_creditInq_id
				];
			}
		}
		$order = 'dispute_account_id'.' '.'asc';
		$where = array('order_id'=>$order_id,'status'=>1);
		$dispute_account_history = $this->Basic->getmultiplerow($order,$where,'order_dispute_account_history');

		$accounthistory=[];
		if($dispute_account_history){	
			foreach($dispute_account_history as $keyhere => $acchis){
				$accounthistory[$acchis->dispute_account_id]=[
					'dispute_account_id' 	=> $acchis->dispute_account_id,
					'is_checked' 			=> (int) $acchis->is_checked,
				];
			}
		}
		
		$disputeList['personalInfo'] 	= $personalinfo;
		$disputeList['creditInquiry'] 	= $creditinfo;
		$disputeList['accountHistory'] 	= $accounthistory;
		$disputeList['accountHistoryselected'] 	= $accounthistory;



		return $disputeList;
	}
	
	function getOrderStepDetailData($orderId=0,$blockId=0,$stepno=0){
		error_reporting(1);
		ini_set('display_errors', 1);
		if(isset($orderId) && !empty($orderId) && !empty($blockId)){
			//$orderData = $this->Basic->getsinglerow(['order_id'=>$orderId],'orders');
			//$blockData = $this->Basic->getsinglerow(['block_id'=>$blockId],'manage_block');
			//$module_selected = $blockData->module_selected;
			switch($blockId)
			{
				/*case  7:
					$orderdetail = $this->contract($orderId,$blockId,$stepno);
					break;
				case	8:
					$orderdetail = $this->selectYouDisputeItem($orderId,$blockId,$stepno);
					break;*/
				case 30:
					$orderdetail = $this->selectfundingcontract($orderId,$blockId,$stepno);
					break;
				default:
					$orderdetail = $this->commonDetails($orderId,$blockId,$stepno);
					break;
			}
			return $orderdetail;
		}
	}
	
	function commonDetails($orderId=0,$blockId=0,$stepno=0){
		if(!empty($orderId) && !empty($blockId)){
			$getblockData 		= $this->Common->get_name_byId('manage_block',['block_id' => $blockId],'module_selected');
			$getblocksDetail 	= $this->Common->get_name_byId('order_step',['order_id' => $orderId,'block_id' => $blockId]);
			$getorders 			= $this->Common->get_name_byId('orders',['order_id' => $orderId],'user_id');
			$module_selected=FALSE;
			if($getblockData!=FALSE){
				$module_selected = $getblockData->module_selected;
			}
			if(!empty($getblocksDetail)){
					$userId 		= $getorders->user_id;
					$block_id 		= $getblocksDetail->block_id;
					$block_name 	= $getblocksDetail->block_name;
					$order_step_id 	= $getblocksDetail->order_step_id;
					
					$customField=[];
					$getcustomFieldDetail = $this->Product_model->getcustomfieldlistByOrderId($orderId,$block_id);
					
					foreach($getcustomFieldDetail as $key=>$rescustom){
						$customField[$rescustom->custom_field_name] = $rescustom->custom_field_values;
					}
				$data['contract_sign_letter'] 	= $this->getContractLetterByUserId($userId,$orderId);
				$data['dispute_items'] 			= $this->selectYouDisputeItem($orderId,$userId);
				$data['getcustom_fields'] 		= $this->Product_model->getcustomBlockFieldList($block_id);
				$data['stepno'] 			= $stepno;
				$data['orderId'] 			= $orderId;
				$data['block_id'] 			= $block_id;
				$data['block_name'] 		= $block_name;
				$data['order_step_id'] 		= $order_step_id;
				$data['customfields'] 		= $customField;
				$data['module_selected'] 	= $module_selected;
				echo $this->load->view('theme/steps/common_detail',$data,true);	
				exit;
			}else {
				echo "No Data Found!";
			}
		}
	}
	function getOrderBlockListbyOrderId($orderId=0){
		$this->db->select('order_step.*,manage_block.icon')->from('order_step');
		$this->db->join('manage_block','manage_block.block_id = order_step.block_id','inner');
		$this->db->where('order_step.order_id',$orderId);
		$this->db->group_by('order_step.block_id');
		$this->db->order_by('manage_block.sort','ASC');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	function getModuleByRole($role_id=0){
		$this->db->select('modules.*,module_role_access.role_id,module_role_access.status as module_role_status,module_role_access.id as module_role_access_id')->from('modules');
		$this->db->join('module_role_access','module_role_access.module_id = modules.id','left');
		//$this->db->where('modules.status','Active');
		$this->db->where('module_role_access.role_id',$role_id);
		//$this->db->group_by('modules.id');
		$this->db->order_by('modules.id','ASC');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	function getModuleAccessByRole($role_id=0){
		$this->db->select('modules.*,module_role_access.role_id,roles_module_access_map.read,roles_module_access_map.write,roles_module_access_map.create,roles_module_access_map.delete,roles_module_access_map.import,roles_module_access_map.export,roles_module_access_map.id as roles_module_access_map_id')->from('modules');
		$this->db->join('module_role_access','module_role_access.module_id = modules.id');
		$this->db->join('roles_module_access_map','roles_module_access_map.module_id = modules.id','left');
		$this->db->where('module_role_access.role_id',$role_id);
		//$this->db->group_by('modules.id');
		$this->db->order_by('modules.id','ASC');
	
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}

	function getPersonalInfomationByOrderId($orderId=0){
		$this->db->select('order_detail.*,order_step.block_name,orders.order_id,orders.user_id,orders.order_number,orders.billing_info')->from('orders');
		$this->db->join('order_step','order_step.order_id = orders.order_id','inner');
		$this->db->join('order_detail','order_detail.order_step_id = order_step.order_step_id','inner');
		$this->db->where('orders.order_id',$orderId);
		$this->db->where('order_detail.order_id',$orderId);
		$this->db->where('order_detail.order_id',$orderId);
		$this->db->where('order_step.block_id',2);
		$this->db->where('order_detail.block_id',2);
		$query = $this->db->get();
		$personalData=[];
		foreach($query->result() as $getResponse){
			$personalData[$getResponse->custom_field_name] = $getResponse->custom_field_values;
		}
		return $personalData;
	}
	function getUserIdByOrderId($orderId=0){
		$this->db->select('orders.order_id,orders.user_id,orders.order_number,orders.billing_info,orders.added_date')->from('orders');
		$this->db->where('orders.order_id',$orderId);
		$query = $this->db->get();
		return $query->row();
	}
	function getClientInfo($user_id=0){
		if(!empty($user_id)){
			$this->db->select('*')->from('users');
			$this->db->where('id',$user_id);
			$query = $this->db->get();
			return $query->row();
		}
	}
	/*function importBrokers(){
		$this->db->select('users_backup.user_id,users_backup.username,users_backup.password,users_backup.email as user_email,teachers.*')->from('users_backup');
		$this->db->join('teachers','teachers.id = users_backup.user_id','inner');
		$this->db->where('users_backup.role','teacher');
		$this->db->where('users_backup.user_id >',168);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	function importBrokersSites(){
		$this->db->select('users.id,broker_site_setting_backup.*')->from('broker_site_setting_backup');
		$this->db->join('users','users.old_user_id = broker_site_setting_backup.user_id','inner');
		$this->db->where('broker_site_setting_backup.role','teacher');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	
	
	function getOldClientList(){
		$this->db->select('users.id AS new_user_id,users.refid,users.referal_code,users_backup.user_id,users_backup.username,users_backup.email,users_backup.password,users_backup.from_site,users_backup.user_id,students.id,students.roll_no AS ssn,students.firstname,students.lastname,students.teacher_id AS broker_id,students.mobileno,students.state,students.city,students.pincode,students.dob,students.current_address,students.created_at')->from('users_backup');
		$this->db->join('students','students.id = users_backup.user_id','inner');
		$this->db->join('users','users.old_user_id = students.teacher_id','inner');
		$this->db->where('users_backup.role','parent');
		$this->db->where('users.refid',NULL);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}*/
		
	function getSiteSettingBybrokerId($broker_id=0){
		if(!empty($broker_id)){
			$this->db->select('*')->from('site_settings');
			$this->db->where('user_id',$broker_id);
			$query = $this->db->get();
			return $query->row();
		}
	}
	function isUserAccessOfProductById($productId=0,$userId=0){
		if(!empty($productId) && !empty($userId)){
			$this->db->select('*')->from('products_user_association');
			$this->db->where('product_id',$productId);
			$this->db->where('user_id',$userId);
			$query = $this->db->get();
			return $query->row();
		}
	}
	function getOrderTaskByOrderId($orderId=0){
		if(!empty($orderId)){
			$this->db->select('task.*,status.status_name,priority.priority as priority_name')->from('task');
			$this->db->join('status','status.status_id = task.task_status');
			$this->db->join('orders','orders.order_id = task.order_id');
			$this->db->join('priority','priority.id = task.priority');
			$this->db->where('orders.order_id',$orderId);
			$this->db->where('task.is_delete <>',2);
			$query = $this->db->get();
			return $query->result();
		}
	}
	function getCommonBlockFieldsList($orderId=0,$blockId=0){
		if(!empty($orderId) && !empty($blockId)){
			$getblockData 		= $this->Common->get_name_byId('manage_block',['block_id' => $blockId],'module_selected');
			$getblocksDetail 	= $this->Common->get_name_byId('order_step',['order_id' => $orderId,'block_id' => $blockId]);
			$getorders 			= $this->Common->get_name_byId('orders',['order_id' => $orderId],'user_id');
			$module_selected=FALSE;
			if($getblockData!=FALSE){
				$module_selected = $getblockData->module_selected;
			}
			if(!empty($getblocksDetail)){
					$userId 		= $getorders->user_id;
					$block_id 		= $getblocksDetail->block_id;
					$block_name 	= $getblocksDetail->block_name;
					$order_step_id 	= $getblocksDetail->order_step_id;
					
					$customField=[];
					$customFieldOrderId=[];
					$flagFieldValue=[];
					$getcustomFieldDetail = $this->Product_model->getcustomfieldlistByOrderId($orderId,$block_id);
					
					foreach($getcustomFieldDetail as $key=>$rescustom){
						$customField[$rescustom->custom_field_name] = $rescustom->custom_field_values;
						$customFieldOrderId[$rescustom->custom_field_name] = $rescustom->order_detail_id;
						$flagFieldValue[$rescustom->order_detail_id] = $rescustom->flag;
					}
				$data['getcustom_fields'] 	= $this->Product_model->getcustomBlockFieldList($block_id);
				$data['orderId'] 			= $orderId;
				$data['block_id'] 			= $block_id;
				$data['block_name'] 		= $block_name;
				$data['order_step_id'] 		= $order_step_id;
				$data['customfields'] 		= $customField;
				$data['customfields_orderDetailId']= $customFieldOrderId;
				$data['flag_fieldValue']	= $flagFieldValue;
				$data['module_selected'] 	= $module_selected;
				echo $this->load->view('theme/myaccount/funder/block_fields_flag',$data,true);	
				exit;
			}else {
				echo "No Data Found!";
			}
		}
	}
}
