<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$this->load->helper('url');
		$this->load->library('upload');
		$this->load->model('funder_model');
	}

	function getOrderCustomStepDetail()
	{
		$postData 	= $this->input->get();
		try{
			$orderId 	= $postData['orderId'];
			$type 		= $postData['type'];
			$stepno 	= $postData['stepId'];
			$stepDetailHtml='';
			if(!empty($orderId) && !empty($type)){
				$getOrderData = $this->Project_model->getallorders('',$orderId);
				$data['order']  = $getOrderData[0]; 
				$data['stepno']=$stepno;
				$data['order_id']=$orderId;
				
				$order = 'id'.' '.'desc';
				$where = array();
				$data['priority'] = $this->Basic->getmultiplerow($order,$where,'priority');
				$priority_array = []; 
				foreach($data['priority'] as $priority){
					$priority_array[$priority->id] =  $priority->priority;
				}
				$data['priority_array'] = $priority_array;
				if($type=='overview'){
					$userId = $data['order']->user_id;
					
					$stepDetailHtml = $this->load->view('theme/steps/overview',$data,true);
					
				}else if($type=='task'){

					$data['task'] = $this->Global_model->getOrderTaskByOrderId($orderId);
					
					if($this->session->userdata('user_type')==3){
						$data['order_dynamic_block_menu'] = $this->Global_model->getOrderBlockListbyOrderId($orderId);
						
						$stepDetailHtml = $this->load->view('theme/myaccount/funder/task',$data,true);
					}else {
						$stepDetailHtml = $this->load->view('theme/steps/task',$data,true);
					}
					
				}else if($type=='funding'){
					$data['fundinglist'] = $this->funder_model->getFunderList($orderId);
					 $data['banklist'] = $this->Common->select('bank');
					if($this->session->userdata('user_type')==3){
						$stepDetailHtml = $this->load->view('theme/myaccount/funder/funding',$data,true);
					}
					
				}else if($type=='notes'){

                    $data['notes'] = $this->Project_model->getallnotesbasedonorder($orderId);

	
					$stepDetailHtml = $this->load->view('theme/steps/notes',$data,true);
		
				}else if($type=='support'){
					
					$order = 'id'.' '.'asc';
					$where = array();
					$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');
					$data['support'] = $this->Project_model->gatallsupportorderbased($orderId);
					
					//support related values
					$order = 'status_id'.' '.'asc';
					$where = array('type'=>'support','status'=>1);
					$support_status_all = $this->Basic->getmultiplerow($order,$where,'status');

					$support_status = $support_count = $support_status_output = [];
					foreach($support_status_all as $suppkey=>$supp)
					{
						$support_status[$supp->status_id] = $supp->status_name;

						$support_status_output[$suppkey] =  $supp->status_name;

						$order = 'support_id'.' '.'desc';
						$where = array('status'=>$supp->status_id,'order_id'=>$orderId,'parent_id'=>0);
						$support_all = $this->Basic->getmultiplerow($order,$where,'support');
						$support_count[$suppkey] = count($support_all);
					}

					$data['support_status'] = $support_status;
					$data['support_count'] = $support_count;
					$data['support_status_output'] = $support_status_output;
					
					$stepDetailHtml = $this->load->view('theme/steps/support',$data,true);
		
				}
				
			  echo $stepDetailHtml;exit;
			}
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
	}


	function getOrderStepDetail(){
		$postData 	= $this->input->get();
		try{
			$orderId 	= $postData['orderId'];
			$blockId 	= $postData['blockId'];
			$stepno 	= $postData['stepId'];
			if(!empty($orderId) && !empty($blockId) && !empty($stepno)){
				$this->Global_model->getOrderStepDetailData($orderId,$blockId,$stepno);
			}
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
	}
	
	function getModuleByRole(){
		$postData 	= $this->input->get();
		try{
			$role_id 	= $postData['roleId'];
			if(!empty($role_id)){
				$data['modulesAccessList'] = $this->Global_model->getModuleAccessByRole($role_id);
				//$data['moduleslist'] = $this->Global_model->getModuleByRole($role_id);
				$data['moduleslist'] = $this->Common->select('modules');
				$data['role_id'] =$role_id;
				$moduleHtml = $this->load->view('theme/myaccount/admin/module_access',$data,true);
				 echo $moduleHtml;exit;
			}
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
	}
	function addRole(){
		$postData 	= $this->input->post();
		try{
			$roleName = $postData['roleName'];
			if(!empty($roleName)){
				$this->Common->insert('role',['role' => $roleName,'allowed_scopes' => $roleName]);
				$rolelist = $this->Common->select('role');
				$role_list='';
				foreach($rolelist as $getRoles){
					$role_list.='<li class="active"> <a href="javascript:void(0);" onclick="getModule('.$getRoles->role_id.')">'.$getRoles->role.'</a> </li>';
				}
			echo $role_list;exit;
			}
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
	}

	function getOrderBotDetail(){
		error_reporting(1);
		ini_set('display_errors', 1);
		$postData 	= $this->input->get();
		try{
			$orderId 	= $postData['orderId'];
			$tabname 	= $postData['tabname'];
			if(!empty($orderId) && !empty($tabname)){
				switch($tabname)
				{
					case	'innovis':
						$orderdetail = $this->getinnovis($orderId,$tabname);
						break;
					case	'usps':
						$orderdetail = $this->getusps($orderId,$tabname);
						break;
					case   'lexisnexis':
						$orderdetail = $this->getLexisnexis($orderId,$tabname);
						break;
					case   'ftc':
						$orderdetail = $this->getFTC($orderId,$tabname);
						break;
					case   'document':
						$orderdetail = $this->getdocument($orderId,$tabname);
						break;
					case   'tracking':
						$orderdetail = $this->getTracking($orderId,$tabname);
						break;
				}
			}
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
	}
	function getinnovis($orderId=0,$tabname=''){
		$userId = $this->getUserIdFromOrder($orderId);
    	$innovis = $this->getBotLogIds("INNOVIS", $userId);
    	$data = $this->getOrderStuff($orderId);
    	$data['botName'] = 'innovis';
    	$data['userId'] = $userId;
		$data['order_id'] = $orderId;
		$data['tabname'] = $tabname;
    	$data['botRunLink'] = site_url()."Order/runInnovis/".$userId;
    	if(count($innovis) < 1) {
    		$data['obj'] = null;
    	} else {
    		$data['obj'] = $innovis;
    	}
    	return $this->load->view('theme/myaccount/admin/order/bot_innovis',$data);
	}
	function getusps($orderId=0,$tabname=''){
		$userId = $this->getUserIdFromOrder($orderId);
    	$innovis = $this->getBotLogIds("CERTIFIEDLABELCREATOR", $userId);
    	$data = $this->getOrderStuff($orderId);
    	$data['botName'] = 'Certified Mail Label Creator BOT';
    	$data['userId'] = $userId;
		$data['order_id'] = $orderId;
		$data['tabname'] = $tabname;
    	$data['botRunLink'] = site_url()."Order/runbotusps/".$userId;

    	if(count($innovis) < 1) {
    		$data['obj'] = null;
    	} else {
    		$data['obj'] = $innovis;
    	}

    	return $this->load->view('theme/myaccount/admin/order/bot_usps',$data);
	}
	function getLexisnexis($orderId=0,$tabname=''){
		$userId = $this->getUserIdFromOrder($orderId);
    	$lexisnexis = $this->getBotLogIds("LEXISNEXIS", $userId);
    	$data = $this->getOrderStuff($orderId);
    	$data['botName'] = 'Lexisnexis Bot';
    	$data['userId'] = $userId;
		$data['order_id'] = $orderId;
		$data['tabname'] = $tabname;
    	$data['botRunLink'] = site_url()."Order/runLexisnexis/".$userId;

    	if(count($lexisnexis) < 1) {
    		$data['obj'] = null;
    	} else {
    		$data['obj'] = $lexisnexis[0];
    	}
    	return $this->load->view('theme/myaccount/admin/order/bot_innovis',$data);
	}
	function getFTC($orderId=0,$tabname=''){
		$userId = $this->getUserIdFromOrder($orderId);
    	$ftc = $this->getBotLogIds("FTC", $userId);
    	# check if extra is filled then grab the user pdf file.
    	$data = $this->getOrderStuff($orderId);
		$data['titile'] = 'FTC Bot';
		$data['order_id'] = $orderId;
		$data['tabname'] = $tabname;
    	if(count($ftc) < 1) {
    		$data['ftc'] = null;
    	} else {
    		$ftc = $ftc[0];
    	}

       if(!is_null($ftc->extra) && $ftc->extra != '') {
    		$pdf = json_decode($ftc->extra);
			 $domain = "http://pft.cpnexpress.com/uploads/bot_reports/zrc-identity/ftc_downloads/{$pdf->pdf}";
			 $ftc->extra = $domain;
    	} else {
    		$ftc->extra = null;
    	}

    	if(!is_null($ftc->screenshot)) {
    		$domain = "http://pft.cpnexpress.com/image/bots/zrc-identity/{$ftc->screenshot}";
    		$ftc->screenshot = $domain;
    	}
    	
    	$data['ftc'] = $ftc;

    	return $this->load->view('theme/myaccount/admin/order/bot_ftc',$data);
		
	}
	function getTracking($orderId=0,$tabname=''){
		
	}
	protected function getUserIdFromOrder($order_id) {
    	$where = array('order_id'=>$order_id);
       	$order = $this->Basic->getsinglerow($where,'orders');
       	if($order) {
       		return $order->user_id;
       	}
    }
	protected function getOrderStuff($orderId)
    {
		$ordersrow = $this->Project_model->getallorders('',$orderId);
		$data['order']  = $ordersrow[0]; 
		$userId 		= $data['order']->user_id;
		$data['notes'] = $this->Project_model->getallnotesbasedonorder($orderId);
        $data['funding'] = [];
		//$condition = array('client_id'=>$userId);
		//$order = 'id'.'  '.'desc';
		//$data['document'] = $this->Basic->getmultiplerow($order,$condition,'document');
       return $data;
    }
	protected function getBotLogIds($bot_type, $userId, $lastNIds = 3)
	{
        $data = $this->Basic->getmultiplerow('id'.'  '.'desc', [
            "bot_type"  => $bot_type,
            "user_id"   => $userId
        ], "bot_logs");

        if(count($data) >= 1){
            $ids = $data[0];
        } else {
            $ids = null;
        }

        if(!is_null($ids)) {
            $ids = explode(",", $ids->bot_ids);
        } else {
            return [];
        }

        $datas = [];
         # get bot status and its link to logs
        foreach ($ids as $id) {
            array_push($datas, $this->getBotJobInfo($id));
        }

        return $datas;
    }
    
    protected function getBotJobInfo($id)
	{
        return $this->Basic->getsinglerow([
            "id" => $id
        ], "bot_jobs");
    }
       
       
    protected function getWhichBots($userId, $bot_type) 
    {
        $data = $this->Basic->getmultiplerow('id'.'  '.'desc', [
            "bot_type"  => $bot_type,
            "user_id"   => $userId
        ], "bot_logs");

        if(count($data) < 1) {
            return null;
        }

        $bots = $data[0];
        return property_exists($bots, "which_bots") ? $bots->which_bots : null;
    }
    
	function runBotAPI(){
		error_reporting(1);
		ini_set('display_errors', 1);
		$postData 	= $this->input->get();
		try{
			$orderId 	= $postData['orderId'];
			$tabname 	= $postData['tabname'];
			if(!empty($orderId) && !empty($tabname)){
				switch($tabname)
				{
					case	'innovis':
						$orderdetail = $this->runInnovis($orderId,$tabname);
						break;
					case	'usps':
						$orderdetail = $this->runbotusps($orderId,$tabname);
						break;
					case   'lexisnexis':
						$orderdetail = $this->runLexisnexis($orderId,$tabname);
						break;
					case   'ftc':
						$orderdetail = $this->runFTC($orderId,$tabname);
						break;
				}
			}
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
	}
	/**************
	function importBrokers(){
		error_reporting(1);
		ini_set('display_errors', 1);
		$importData = $this->Global_model->importBrokers();
		$count=0;
		if(!empty($importData)){
			$i=0;
			foreach($importData as $resbroker){
				
				$parent_user_id =2;
				$first_name = $resbroker->teacher_fname;
				$last_name 	= $resbroker->teacher_lname;
				$userType	= 4;
				$email		= $resbroker->user_email;
				$phone		= $resbroker->phone;
				$username	= $resbroker->username;
				$password	= $resbroker->password;
				$added_date	= $resbroker->created_at;
				$old_user_id = $resbroker->user_id;
				$site_name	= $resbroker->site_name;
				
				$ischeckUserExist = $this->Basic->getsinglerow(['username'=>$username],'users');
			
				if(empty($ischeckUserExist) && $ischeckUserExist->email!=$email){
					$usersdata = [
						'username'		  => $username,
						'password'		  => sha1($password),
						'intial_password' => $password,
						'user_type'		  => $userType,
						'email'			  => $email,
						'role_id'		  => $userType,
						'parent_user_id'  => $parent_user_id,
						'first_name'	  => $first_name,
						'firstname'		  => $first_name,
						'last_name'		  => $last_name,
						'lastname'		  => $last_name,
						'old_user_id'	  => $old_user_id,
						'site_name'	  		=> $site_name
					];
					$user_detailsdata =[
						'first_name'	=> $first_name,
						'last_name'		=> $last_name,
						'phone'			=> $phone,
						'email'			=> $email,
						'added_date'	=> $added_date
					];
					
					$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
					$refferral_code = "";
					for ($i = 0; $i < 5; $i++) {
						$refferral_code .= $chars[mt_rand(0, strlen($chars)-1)];
					}
					$referal_code = $refferral_code;
					$usersdata['referal_code'] = $referal_code;
				   $user_id = $this->Basic->insertdata($usersdata,'users');
				   $user_detailsdata['user_id'] = $user_id;
				   $this->Basic->insertdata($user_detailsdata,'user_details');
				   $count+=1;
				}
			$i++;}
		}
		echo $count."Records are process";
	}
	
	function importbrokerSetting(){
		
		error_reporting(1);
		ini_set('display_errors', 1);
		$importData = $this->Global_model->importBrokersSites();
		$count=0;
		if(!empty($importData)){
			$i=0;
			foreach($importData as $resbroker){
				
				$parent_user_id =2;
				$sitelogo 	= $resbroker->s_logo;
				$sitename 	= $resbroker->s_heading7;
				$userType	= 4;
				$siteemail	= $resbroker->s_email;
				$sitephone	= $resbroker->s_phone;
				$domain		= $resbroker->base_url;
				$SMTP_host	= $resbroker->host;
				$SMTP_username	= $resbroker->username;
				$SMTP_password 	= $resbroker->password;
				$siteunique		= $resbroker->siteunique;
				$old_user_id	= $resbroker->user_id;
				$user_id		= $resbroker->id;
				
				$ischeckUserExist = $this->Basic->getsinglerow(['domain'=>$domain],'site_settings');
			
				if(empty($ischeckUserExist)){
					$usersdata = [
						'sitename' 	=> $sitename,
						'siteemail'	=> $siteemail,
						'sitephone'	=> $sitephone,
						'sitelogo'  => $sitelogo,
						'domain'	=> $domain,
						'SMTP_host' => $SMTP_host,
						'SMTP_username' => $SMTP_username,
						'SMTP_password'	=> $SMTP_password,
						'SMTP_port'	  	=> 487,
						'old_user_id'	=> $old_user_id,
						'user_id'		=> $user_id
					];
				   $this->Basic->insertdata($usersdata,'site_settings');
				   $count+=1;
				}
			$i++;}
		}
		echo $count."Records are process";
	}
	
	
	function consumeClientAndAssociatewithBroker(){
		
		$importData = $this->Global_model->getOldClientList();
		$count=0;
		$notprocess=[];
		if(!empty($importData)){
			
			foreach($importData as $resbroker){
				$parent_user_id =$resbroker->new_user_id;
				$first_name = $resbroker->firstname;
				$last_name 	= $resbroker->lastname;
				$userType	= 5;
				$email		= $resbroker->email;
				$phone		= $resbroker->mobileno;
				$username	= $resbroker->username;
				$password	= $resbroker->password;
				$added_date	= $resbroker->created_at;
				$old_user_id = $resbroker->user_id;
				$site_name	= $resbroker->from_site;
				$ssn		= $resbroker->ssn;
				$state		= $resbroker->state;
				$city		= $resbroker->city;
				$pincode	= $resbroker->pincode;
				$dob		= $resbroker->dob;
				$current_address = $resbroker->current_address;

				if($old_user_id>536){
					$ischeckUserExist = $this->Basic->getsinglerow(['username'=>$username],'users');
					$ischeckEmailExist = $this->Basic->getsinglerow(['email'=>$email],'users');
				
					if(empty($ischeckUserExist) && empty($ischeckEmailExist)){
						$usersdata = [
							'username'		  => $username,
							'password'		  => sha1($password),
							'intial_password' => $password,
							'user_type'		  => $userType,
							'email'			  => $email,
							'role_id'		  => $userType,
							'parent_user_id'  => $parent_user_id,
							'first_name'	  => $first_name,
							'firstname'		  => $first_name,
							'last_name'		  => $last_name,
							'lastname'		  => $last_name,
							'old_user_id'	  => $old_user_id,
							'refid'			  => $parent_user_id,
							'site_name'	  	  => $site_name
						];
						$user_detailsdata =[
							'ssn'			=> $ssn,
							'first_name'	=> $first_name,
							'last_name'		=> $last_name,
							'phone'			=> $phone,
							'email'			=> $email,
							'dob'			=> $dob,
							'state'			=> $state,
							'city'			=> $city,
							'zipcode'		=> $pincode,
							'address'		=> $current_address,
							'website'		=> $site_name,
							'added_date'	=> $added_date
						];
						   $user_id = $this->Basic->insertdata($usersdata,'users');
						   $user_detailsdata['user_id'] = $user_id;
						   $this->Basic->insertdata($user_detailsdata,'user_details');
					   $count+=1;
					}else{
						
						$notprocess=$resbroker;
					}
				
				}
			
			}
			
		}
		
		echo $count."Client Process";
		echo "Not Process =".count($notprocess);
		echo "<pre>";
		print_r($notprocess);
		exit;
	}
	***********/
	
	
	function updateDisputePersonalInfo()
	{
		try{
			$flag=false;
			$dispute_pf_id 	= $this->input->post('dispute_pf_id');
			$value 			= $this->input->post('value');
			$field 			= $this->input->post('field');
			$order_id 		= $this->input->post('order_id');
			$isbotenabled 	= $this->input->post('isbotenabled') ?? 0;
			$dispute = $this->Basic->getsinglerow(['dispute_pf_id'=>$dispute_pf_id,'order_id'=> $order_id],'order_dispute_personal_info');
			if($isbotenabled==1){
				$newvalue = ($dispute->is_bot_table==0) ? 1:0;
				$RequestData = ['is_bot_table'=>$newvalue];
			}
			if($field=='name'){
				$newvalue = ($dispute->is_name_checked==0) ? 1:0;
				$RequestData = ['is_name_checked'=>$newvalue];
			}
			else if($field=='knownAs'){
				$newvalue = ($dispute->is_knows_checked==0)?1:0;
				$RequestData = ['is_knows_checked'=>$newvalue];
			}
			else if($field=='dob'){
				$newvalue = ($dispute->is_dob_checked==0)?1:0;
				$RequestData = ['is_dob_checked'=>$newvalue];
			}
			else if($field=='address'){
				$dataddress = json_decode($dispute->address,true);
				$newarray = array();
				foreach($dataddress as $key => $address) 
				{
					if($value==$address['id']){
						$newvalue = ($address['checked']==1)?0:1;
						$tempaaray = array('id'=>$address['id'],'checked'=>$newvalue,'text'=>$address['text']);
						$newarray[] = $tempaaray;
					}
					else{
						$newarray[] = $address;
					}
				}
				$RequestData = ['address'=>json_encode($newarray)];
			}
			
			$where = ['dispute_pf_id'=>$dispute_pf_id,'order_id'=> $order_id];
            $this->Basic->updatedata($RequestData,$where,'order_dispute_personal_info');
			
			echo "success";
			exit;
		}catch(Exception $e){
			echo $e->getMessage();
		}	
	}
	/*****get dynamic block fields*******/
	
	function getallFieldsofBlock(){
		$postData 	= $this->input->get();
		try{
			$orderId 	= $postData['orderId'];
			$blockId 	= $postData['blockId'];
			if(!empty($orderId) && !empty($blockId)){
				$this->Global_model->getCommonBlockFieldsList($orderId,$blockId);
			}
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
	}
	
	function getUpdateBlockFieldItem(){
		$postData 	= $this->input->post();
		try{
			$orderId 		= $postData['orderId'];
			$order_detailId = $postData['order_detail_id'];
			$block_id = $postData['block_id'];
			if(!empty($orderId) && !empty($order_detailId)){
				$getOrderDetail = $this->Basic->getsinglerow(['order_detail_id'=>$order_detailId,'order_id'=> $orderId,'block_id' =>$block_id],'order_detail');
				if(!empty($getOrderDetail)){
					$newvalue 	= ($getOrderDetail->flag==0) ? 1:0;
					$flagdata 	= ['flag'=>$newvalue];
					$where 		= ['order_detail_id'=>$order_detailId];
					$this->Basic->updatedata($flagdata,$where,'order_detail');
					echo "sucess";exit;
				}
			}{
				echo 'Invalid Request!';
			}
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
	}
	
	
	function addupdateFunding(){
		$postData 	= $this->input->post();
		try{
			if(!empty($postData['order_id'])){
				$order_id 	= $postData['order_id'];		
				$user_id 	= $this->session->userdata('user_id');
				//$postData['user_id'] 	= $user_id;
				$postData['created_at'] = date('Y-m-d H:i:s');
				$postData['added_by'] 	= $user_id;
				$isSucess = $this->Common->insert('funding',$postData);
				if($isSucess){
					echo "Funding Added Sucessfully!";
				}else{
					echo "Soemthong Went wrong , Please retry";
				}
			}
		}catch(Exception $e){
			echo $e->getMessage();exit;
		}
	}
	
	function savenotesReply()
	{
		$postData = $this->input->post();
		if(isset($postData['notes_id'])){
			 $support_ticket_replydata=[
				'user_id' 		=> $this->session->userdata('user_id'),
				'notes_id'		=> $this->input->post('notes_id'),
				'order_id'		=> $this->input->post('order_id'),
				'message'		=> $postData['message'],
				'created_date'	=> date('Y-m-d H:i:s')
			];
			$isSucess = $this->Basic->insertdata($support_ticket_replydata,'notes_reply');
			if($isSucess){
				$customerName = orderusersname($this->session->userdata('user_id'));
				$message ='<div class="ticket-message-box"><div class="ticket-info-icon pull-left"><span class="messageTitle"> S </span></div><div class="ticket-message-info"><div class="ticket-message-customer-name">'.$customerName.'</div><div class="ticket-message-message-time">'.date('Y-m-d H:i:s').' </div><hr><div class="custome-content"><p class="ticket-description">'.$postData['message'].'</p></div></div></div>';
				echo $message;exit;
			}else{
				echo "Soemthong Went wrong , Please retry";exit;
			}
		}
	}
	function getPaymentconfirm(){
		$getPaymentData=$this->input->get();
		$data['order_id'] 	= $getPaymentData['order_id'];
		$data['price'] 		= $getPaymentData['price'];
		$data['payment_method_list']=[];
		if($getPaymentData['type']==2){
			$data['message'] 		= 'Confirmed Cleint Payment';
		}else {
			$data['message'] 		= 'Pay Admin for Order';
			$data['payment_method_list'] = $this->Common->select('payment_methods',['broker_id' => 0]);
		}
		$data['type'] 		= $getPaymentData['type'];

		echo $this->load->view('theme/myaccount/front/payment_confirm',$data,true);exit;
	}
	function getproductOptionPrice(){
		$productOptionId=$this->input->get('productOptionId');
		if(!empty($productOptionId)){
			$getProductOptions = $this->Common->selectrow('products_options',['products_options_id' => $productOptionId]);
			$poptions=[
				'product_name' => $getProductOptions->sub_product_name,
				'selling_price' => $getProductOptions->sub_selling_price
			];
			echo json_encode($poptions);exit;
		}
	}
}
