<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Common extends CI_Model{

	function __construct() {
		parent::__construct();
		$this->load->model('Basic');
	}
	
	function get_name_byId($table,$condition = [],$selectField ='*')
	{
		$this->db->select($selectField);
		$this->db->from($table);
		if(isset($condition) && !empty($condition)){
			$this->db->where($condition);
		}
		$result =$this->db->get()->row();
						
	    if(!empty($result)):
	    	return $result;
	    else:
	    	return 'FALSE';
	    endif;	

	}
	
	function get_single_data($data)
	{
		$result = $this->db->select($data['val'])->from($data['table'])
	            	->where($data['where'])
	            		->get()->row();
	    if(!empty($result)):
	    	return $result;
	    else:
	    	return 'FALSE';
	    endif;	

	}
	function get_data_where_orderby($data, $limit=1, $start=0)
	{
		$query = $this->db->select($data['val'])->from($data['table'])
	            ->where($data['where'])->order_by($data['orderby'], $data['orderas'])->limit($limit, $start)
	            ->get();
	    if($query->num_rows() > 0){
           $result = $query->result();
           return $result;
       }else{
           return false;
       }
	}

	//=============== Add or Insert Data ===============
	function add_data($data)
	{
		$insert = $this->db->insert($data['table'], $data['val']);
		return  $insert;
	}
	function add_data_get_id($data)
	{
		$this->db->insert($data['table'], $data['val']);
   		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	//=============== Update Data ===============
	function update_data($data)
	{
		$this->db->set($data['set']);
		$this->db->where($data['where']);
		return 	$this->db->update($data['table']);
	}

	function delete_data($data)
	{
		$this->db->where($data['where']);
		return $this->db->delete($data['table']);

	} //delete_data closed

	function multijoin($data,$multijoin,$limit=0, $start=0)
	{  
            if($limit > 0){
                $this->db->limit($limit, $start);
            }
            
            $this->db->select($data['val']);
            $this->db->from($data['table']);
            
            for($i=0; $i < count($multijoin); $i++){
                
                $this->db->join($multijoin[$i]['table'], $multijoin[$i]['on'],$multijoin[$i]['join_type']);
            }
            
            if(isset($data['group_by'])){
                $this->db->group_by($data['group_by']);
            }
           
            if($data['where']!=''){
            $this->db->where($data['where']);
            }
            
            if(isset($data['or_where'])){
            $this->db->group_start();
            $this->db->or_where($data['or_where']);
            $this->db->group_end();
            }
            
            if($data['orderby']!=''){
                $this->db->order_by($data['orderby'], $data['orderas']);
            }
            
            $query=$this->db->get();  

            if($query -> num_rows() > 0)
            {
                $result=array('res'=>true,'rows'=>$query->result());
                return $result;
            }
            else
            {
                $result=array('res'=>false, 'rows'=> NULL);
                return $result;
            }
	}

	function selectrow($table,$condition = [] ,$selectField = '*',$condition2 = []){
		$this->db->select($selectField);
		$this->db->from($table);
		if(isset($condition) && !empty($condition)){
			$this->db->where($condition);
		}
		if(isset($condition2) && !empty($condition2)){
			$this->db->where($condition2);
		}
		$query = $this->db->get();
		return $query->row();
	}
	
	function select($table,$condition = [] ,$selectField = '*',$condition2 = []){
		$this->db->select($selectField);
		$this->db->from($table);
		if(isset($condition) && !empty($condition)){
			$this->db->where($condition);
		}
		if(isset($condition2) && !empty($condition2)){
			$this->db->where($condition2);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	function insert($table,$data){
		$insdata=$this->db->insert($table, $data);
		if($insdata){
			$insert_id = $this->db->insert_id();
			return  $insert_id;
		}
	}
	function update($table,$data,$id){
		$uptdata=$this->db->update($table, $data , array('id'=>$id));	
		if($uptdata){
			return "Record Updated Successfully";
		}
	}
	function updatedata($table,$data,$where){
		$uptdata=$this->db->update($table, $data , $where);	
		return $uptdata; 
	}
	function remove($table,$data =[]){
		$this->db->where($data);
		$isSuccess = $this->db->delete($table); 
		return $isSuccess;
	}
	function selectCountRecords($table,$condition = [] ,$selectField = '*',$condition2 = []){
		$this->db->select($selectField);
		$this->db->from($table);
		if(isset($condition) && !empty($condition)){
			$this->db->where($condition);
		}
		if(isset($condition2) && !empty($condition2)){
			$this->db->where($condition2);
		}
		$result = $this->db->count_all_results();
	
		return $result;
	}
	
	function selectCountClient($table,$condition = [] ,$selectField = '*',$condition2 = []){
		$this->db->select($selectField);
		$this->db->from($table);
		 
			$this->db->where('is_active="1"');
		 
		$result = $this->db->count_all_results();
	
		return $result;
	}
	function selectCountTask($table,$condition = [] ,$selectField = '*',$condition2 = []){
		$this->db->select($selectField);
		$this->db->from($table);
	 
			$this->db->where('completion!="completed"');
	 
		 
		$result = $this->db->count_all_results();
	
		return $result;
	}
	function getMaxNumber($table,$condition = [] ,$selectField=''){
		$this->db->select_max($selectField);
		$this->db->from($table);
		if(isset($condition) && !empty($condition)){
			$this->db->where($condition);
		}
		$query = $this->db->get();
		$result = $query->row();
	
		$data = $result->$selectField + 1;

		return $data;
	
	}
	
	/*** get order steps details ******/
	function getProductOrderStep_detailsByProductId($productId=0,$orderStepId=0) {
		$this->db->select('porder_step_detail_id,vendor_class_id,order_step_detail.*,entity_attribute.*')->from('product_order_step_detail');
		$this->db->join('order_step_detail', 'order_step_detail.order_step_detail_id = product_order_step_detail.order_step_detail_id');
		$this->db->join('entity_attribute', 'entity_attribute.attribute_id = order_step_detail.attribute_id');
		$this->db->where('product_order_step_detail.vendor_class_id', $productId);
		$this->db->where('product_order_step_detail.order_step_id', $orderStepId);
		$this->db->order_by('order_step_detail.sortno','ASC');
        $query = $this->db->get();
        return $query->result();
    }
	function getOrderStepDetailById($orderStepId=0) {
		$this->db->select('*')->from('order_steps');
		$this->db->where('order_step_id', $orderStepId);
        $query = $this->db->get();
        return $query->row();
    }
	
	function getPurchaseStepListByPurchase($purchase_id=0,$order_stepId=0) {
		$this->db->select('purchase_order_step_details.*,order_step_detail.field_name,order_step_detail.sortno,entity_attribute.*')->from('purchase_order_step_details');
		$this->db->join('order_step_detail', 'order_step_detail.order_step_detail_id = purchase_order_step_details.order_step_detail_id');
		$this->db->join('entity_attribute', 'entity_attribute.attribute_id = order_step_detail.attribute_id');
		$this->db->where('purchase_order_step_details.purchase_id', $purchase_id);
		$this->db->where('purchase_order_step_details.order_step_id', $order_stepId);
		$this->db->order_by('order_step_detail.sortno','ASC');
        $query = $this->db->get();
        return $query->result();
    }
	function getOrderDetailbyOrderId($order_id){
		$this->db->select('purchase.*,vendor_class.class_name,vendor_class.vendor_id,students.firstname,students.lastname,students.mobileno,students.dob,students.roll_no,students.current_address,students.city as stud_city,students.state,students.pincode,users.is_deleted,users.password,users.username,users.email as usemail,users.id as userid')->from('purchase');
        $this->db->join('vendor_class', 'vendor_class.id = purchase.class_id');
		$this->db->join('students', 'students.id = purchase.student_id');
		$this->db->join('users', 'users.user_id = purchase.student_id');
		$this->db->where('purchase.id', $order_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function getIdentityIQDetail($clientId=0){
		$this->db->select('userguard.*,students.roll_no')->from('userguard');
		$this->db->join('students', 'students.id = purchase.student_id');
		$this->db->where('userguard.user_id', $clientId);
		$this->db->where('students.id', $clientId);
		$query = $this->db->get();
		return $query->result();
	}
	function getdisputeListByUserId($userId=0,$purchaseId=0){
		$disputeList=[];
		
		$disputeList['creditstatus'] 	= $this->select('creditstatus');
		$disputeList['instruction'] 	= $this->select('instruction');
		$disputeList['credit_report_reason'] = $this->select('credit_report_reason',array('parent_id'=>'0'));
		
		$order = 'dispute_pf_id'.'  '.'asc';
		$where = array('user_id'=>$userId,'status'=>1);
		$personalinfo = $this->Basic->select($order,$where,'dispute_personal_info');

		$order = 'dispute_creditInq_id'.'  '.'asc';
		$where = array('user_id'=>$userId,'status'=>1);
		$creditinfo = $this->Basic->getmultiplerow($order,$where,'dispute_credit_inquiry');

		$order = 'dispute_account_id'.' '.'asc';
		$where = array('user_id'=>$userId,'status'=>1);
		$dispute_account_history = $this->Basic->getmultiplerow($order,$where,'dispute_account_history');
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
							'instruction'	=>	$inner_value->instruction,
						];
					}
				}

				$accounthistory[]=[
					'dispute_account_id' 	=> $acchis->dispute_account_id,
					'company_title' 		=> $acchis->company_title,
					'account_type_id' 		=> $acchis->account_type_id,
					'is_checked' 			=> (int) $acchis->is_checked,
					'account_historylist' 	=> $accountHistoryList
				];
			}
		}
		
		//$accounthistory = array_chunk($accounthistory,2);
		$disputeList['personalInfo'] 	= $personalinfo;
		$disputeList['creditInquiry'] 	= $creditinfo;
		$disputeList['accountHistory'] 	= $accounthistory;

		$where = array('user_id'=>$userId,'role'=>'parent');
		$users = $this->Basic->getsinglerow($where,'users');
		$isfinal = ($users && $users->isfinal)?(int)$users->isfinal:0;	
		$disputeList['isfinal'] 	= (int) $isfinal;
		
		return $disputeList;
	}
	

	function getOrderStatus($purchase_id=0,$order_stepId=0,$order_step_no=0){
		if(isset($purchase_id) && !empty($purchase_id) && !empty($order_stepId)){			
			switch($order_stepId){
				case	2:
					$orderstatus = $this->personalInfo($purchase_id,$order_stepId,$order_step_no);
					break;
				/*case	3:
					$orderstatus = $this->preOrderQuestion($purchase_id,$order_stepId,$order_step_no);
					break;*/
				case	11:
					$orderstatus = $this->contract($purchase_id,$order_stepId,$order_step_no);
					break;
				case	13:
					$orderstatus = $this->identityIq($purchase_id,$order_stepId,$order_step_no);
					break;
				/*case	15:
					$orderstatus = $this->applications($purchase_id,$order_stepId,$order_step_no);
					break;
				case	27:
					$orderstatus = $this->uploadDocument($purchase_id,$order_stepId,$order_step_no);
					break;*/
				case	29:
					$orderstatus = $this->selectYouDisputeItem($purchase_id,$order_stepId,$order_step_no);
					break;
				default:
					$orderstatus = $this->commonDetailStatus($purchase_id,$order_stepId,$order_step_no);
					break;
			}
			return $orderstatus;
		}
	}
	

	function commonDetailStatus($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
	    $where = array('id'=>$purchase_id);
        $purchase = $this->Basic->getsinglerow($where,'purchase');
		
		$productId = $purchase->class_id;
		$client_id = $purchase->student_id;
		$list = (array) $this->Common->getProductOrderStepByProdId($productId,$order_stepId);
		$existlist= (array) $this->Common->select('dynamic_document_steps',['client_id' => $client_id,'order_step_id' => $order_stepId,'status' => 1],'order_step_id,order_step_detail_id,value');
		$match=0;
		
		$totalItemCount=count($list);
		$matched=0;
		foreach($list as $key => $response) {
			$order_step_detail_id 	= $response->order_step_detail_id;
			$order_step_id 			= $response->order_step_id;
			if(isset($existlist) && !empty($existlist)){
				foreach($existlist as $existingRes){
					if($existingRes->order_step_detail_id==$order_step_detail_id && $existingRes->value!=""){
						$matched +=1;
						break;
					}
				}
			}
		}
		if($totalItemCount==$matched){
			echo '<img src="https://zerogravitycredit.com/assets/images/complete-icon.png" class="completeIcon">';
		}else{
			echo '<img src="https://zerogravitycredit.com/assets/images/urgent-seal-icon.png" class="completeIcon">';
		}
	}
	
    function personalInfo($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
	   $where = array('id'=>$purchase_id);
       $purchase = $this->Basic->getsinglerow($where,'purchase');

	   $where = array('id'=>$purchase->student_id);
       $client = $this->Basic->getsinglerow($where,'students');
      
       $where = array('id'=>$purchase->student_id,'role'=>'parent');
       $usersclient = $this->Basic->getsinglerow($where,'users');

       $firstname = ($client->firstname!='')?$client->firstname:'';
       $lastname = ($client->lastname!='')?$client->lastname:'';
       $mobileno = ($client->mobileno!='')?$client->mobileno:'';
       $dob = ($client->dob!='')?$client->dob:'';
       $ssn = ($client->roll_no!='')?$client->roll_no:'';
       $current_address = ($client->current_address!='')?$client->current_address:'';
       $city = ($client->city!='')?$client->city:'';
       $state = ($client->current_address!='')?$client->state:'';
       $pincode = ($client->pincode!='')?$client->pincode:'';
       $dob = date('m/d/Y', strtotime($dob));
       $ssn = ($client->roll_no!='')?$client->roll_no:'';

      if($usersclient->username!='' && $firstname!='' && $lastname!=''  && $usersclient->email!='' && $mobileno!='' && $dob!='' && $ssn!='' && $current_address!='' && $city!='' && $state!='' && $pincode!='' && $usersclient->password!='')
      {
          echo '<img src="https://zerogravitycredit.com/assets/images/complete-icon.png" class="completeIcon">';
      }
      else
      {
          echo '<img src="https://zerogravitycredit.com/assets/images/urgent-seal-icon.png" class="completeIcon">';
      }
	}
	

	function preOrderQuestion($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
		echo $status='<img src="https://zerogravitycredit.com/assets/images/complete-icon.png" class="completeIcon">';	
	}


	function contract($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
		$where = array('id'=>$purchase_id);
        $purchase = $this->Basic->getsinglerow($where,'purchase');

		 $where = array('user_id'=>$purchase->student_id,'order_id'=>$purchase->id,'sign!='=>'');
	     $contract_sign = $this->Basic->getsinglerow($where,'contract_sign');
	     
		 if(!($contract_sign))
		 {
			$where = array('added_for'=>$purchase->student_id,'title'=> 'Signature');
			$contract_sign = $this->Basic->getsinglerow($where,'document');
			
		 }
		 
		if(!($contract_sign))
		{
		    $where = array('added_for'=>$purchase->student_id,'title'=> 'Credit Repair Contract','order_id'=>$purchase->id);
			$contract_sign = $this->Basic->getsinglerow($where,'document');
		}
		 
		if($contract_sign)
        echo '<img src="https://zerogravitycredit.com/assets/images/complete-icon.png" class="completeIcon">';
        else
		echo '<img src="https://zerogravitycredit.com/assets/images/urgent-seal-icon.png" class="completeIcon">';
	}
	

	function identityIq($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
		$where = array('id'=>$purchase_id);
        $purchase = $this->Basic->getsinglerow($where,'purchase');

		$where = array('guard'=>'indentityiq.com','user_id'=>$purchase->student_id);
		$userguard = $this->Basic->getsinglerow($where,'userguard');

		if($userguard)
		{
		echo '<img src="https://zerogravitycredit.com/assets/images/complete-icon.png" class="completeIcon">';
		}
		else
		{
			echo '<img src="https://zerogravitycredit.com/assets/images/urgent-seal-icon.png" class="completeIcon">';
		}
	}
	

	function applications($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
		echo $status='<img src="https://zerogravitycredit.com/assets/images/urgent-seal-icon.png" class="completeIcon">';
	}

	function uploadDocument($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
		$updata['fieldList']=$this->Common->getPurchaseStepListByPurchase($purchase_id,$order_stepId);

		$where = array('id'=>$purchase_id);
        $purchase = $this->Basic->getsinglerow($where,'purchase');

        $number = 0;
        
        
        $data['existlist'] = (array) $this->Common->select('dynamic_document_steps',['client_id' =>$purchase->student_id,'order_step_id' => $order_stepId,'status' => 1]);

		foreach ($updata['fieldList'] as $key => $value) 
		{
              $where = ['title'=>$value->field_name,'client_id'=>$purchase->student_id];
		       $document= $this->Basic->getsinglerow($where,'document');

		       $number = ($document) ? $number+1:'';
		}

		//if($number==count($updata['fieldList']))
		
		if(count($data['existlist'])==count($updata['fieldList']))
        echo '<img src="https://zerogravitycredit.com/assets/images/complete-icon.png" class="completeIcon">';
        else
		echo '<img src="https://zerogravitycredit.com/assets/images/urgent-seal-icon.png" class="completeIcon">';
	}
	

	function selectYouDisputeItem($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
		$where = array('id'=>$purchase_id);
        $purchase = $this->Basic->getsinglerow($where,'purchase');

		$order = 'dispute_pf_id'.'  '.'asc';
		$where = array('user_id'=>$purchase->student_id,'status'=>1,'is_checked'=>1);
		$personalinfo = $this->Basic->getmultiplerow($order,$where,'dispute_personal_info');

		$order = 'dispute_creditInq_id'.'  '.'asc';
		$where = array('user_id'=>$purchase->student_id,'status'=>1,'is_checked'=>1);
		$creditinfo = $this->Basic->getmultiplerow($order,$where,'dispute_credit_inquiry');

		$order = 'dispute_account_id'.' '.'asc';
		$where = array('user_id'=>$purchase->student_id,'status'=>1,'is_checked'=>1);
		$dispute_account_history = $this->Basic->getmultiplerow($order,$where,'dispute_account_history');
		
		//echo $this->db->last_query();

		if($dispute_account_history)
		{	
			foreach($dispute_account_history as $keyhere => $acchis)
			{
				$order = 'dispute_account_id'.' '.'asc';
				$where = array('dispute_account_id'=>$acchis->dispute_account_id,'status'=>1);
				$inner_array = $this->Basic->getmultiplerow($order,$where,'dispute_account_history_details');
			}
		}

        if(isset($personalinfo) && isset($creditinfo) && isset($dispute_account_history) && isset($inner_array))
        echo '<img src="https://zerogravitycredit.com/assets/images/complete-icon.png" class="completeIcon">';
        else	
		echo $status='<img src="https://zerogravitycredit.com/assets/images/urgent-seal-icon.png" class="completeIcon">';
	}
	
	/*** get order steps details ******/
	function getProductOrderStepByProdId($productId=0,$orderStepId=0) {
		$this->db->select('product_order_step_detail.order_step_id,product_order_step_detail.order_step_detail_id')->from('product_order_step_detail');
		$this->db->join('order_step_detail', 'order_step_detail.order_step_detail_id = product_order_step_detail.order_step_detail_id');
		$this->db->join('entity_attribute', 'entity_attribute.attribute_id = order_step_detail.attribute_id');
		$this->db->where('product_order_step_detail.vendor_class_id', $productId);
		$this->db->where('product_order_step_detail.order_step_id', $orderStepId);
		$this->db->order_by('order_step_detail.sortno','ASC');
        $query = $this->db->get();
        return $query->result();
    }
	/*** get order steps details ******/
	function getProductOrderStep_detailsByFlag($productId=0,$orderStepId=0,$flag=0) {
		$this->db->select('porder_step_detail_id,vendor_class_id,order_step_detail.*,entity_attribute.*')->from('dynamic_document_steps');
		$this->db->join('order_step_detail', 'order_step_detail.order_step_detail_id = dynamic_document_steps.order_step_detail_id','inner');
		$this->db->join('product_order_step_detail', 'product_order_step_detail.order_step_detail_id = order_step_detail.order_step_detail_id','inner');
		$this->db->join('entity_attribute', 'entity_attribute.attribute_id = order_step_detail.attribute_id');
		$this->db->where('product_order_step_detail.vendor_class_id', $productId);
		$this->db->where('dynamic_document_steps.order_step_id', $orderStepId);
		$this->db->where('dynamic_document_steps.flag', 1);	
		$this->db->order_by('order_step_detail.sortno','ASC');
		
		 $this->db->group_by('porder_step_detail_id'); 
        $query = $this->db->get();
		//echo $this->db->last_query();
        return $query->result();
    }
    
    
    
    /// only get status for all steps
    
    function getOrderStatusonlystatus($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
	    if(isset($purchase_id) && !empty($purchase_id) && !empty($order_stepId))
	    		{			
			switch($order_stepId){
				case	2:
					$orderstatus = $this->personalInfoonlystatus($purchase_id,$order_stepId,$order_step_no);
					break;
				case	11:
					$orderstatus = $this->contractonlystatus($purchase_id,$order_stepId,$order_step_no);
					break;
				case	13:
					$orderstatus = $this->identityIqonlystatus($purchase_id,$order_stepId,$order_step_no);
					break;
				case	29:
					$orderstatus = $this->selectYouDisputeItemonlystatus($purchase_id,$order_stepId,$order_step_no);
					break;
				default:
					$orderstatus = $this->commonDetailStatusonlystatus($purchase_id,$order_stepId,$order_step_no);
					break;
			}
			return $orderstatus;
		}
	}
    
    function selectYouDisputeItemonlystatus($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
	    $where = array('id'=>$purchase_id);
        $purchase = $this->Basic->getsinglerow($where,'purchase');

		$order = 'dispute_pf_id'.'  '.'asc';
		$where = array('user_id'=>$purchase->student_id,'status'=>1,'is_checked'=>1);
		$personalinfo = $this->Basic->getmultiplerow($order,$where,'dispute_personal_info');

		$order = 'dispute_creditInq_id'.'  '.'asc';
		$where = array('user_id'=>$purchase->student_id,'status'=>1,'is_checked'=>1);
		$creditinfo = $this->Basic->getmultiplerow($order,$where,'dispute_credit_inquiry');

		$order = 'dispute_account_id'.' '.'asc';
		$where = array('user_id'=>$purchase->student_id,'status'=>1,'is_checked'=>1);
		$dispute_account_history = $this->Basic->getmultiplerow($order,$where,'dispute_account_history');
		
		//echo $this->db->last_query();

		if($dispute_account_history)
		{	
			foreach($dispute_account_history as $keyhere => $acchis)
			{
				$order = 'dispute_account_id'.' '.'asc';
				$where = array('dispute_account_id'=>$acchis->dispute_account_id,'status'=>1);
				$inner_array = $this->Basic->getmultiplerow($order,$where,'dispute_account_history_details');
			}
		}

        if(isset($personalinfo) && isset($creditinfo) && isset($dispute_account_history) && isset($inner_array))
       	return 'Completed';
        else	
		return 'Not';
	}
	
	
	function identityIqonlystatus($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
		$where = array('id'=>$purchase_id);
        $purchase = $this->Basic->getsinglerow($where,'purchase');

		$where = array('guard'=>'indentityiq.com','user_id'=>$purchase->student_id);
		$userguard = $this->Basic->getsinglerow($where,'userguard');
		
            $where222 = array('user_id'=>$purchase->student_id);
            $identity_report = $this->Basic->getsinglerow($where222,'identity_report');

		if($userguard && $identity_report->message!='')
		{
		return 'Completed';
		}
		else
		{
		return 'Not';
		}
	}
	
	function contractonlystatus($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
	     $where = array('id'=>$purchase_id);
	    $purchase = $this->Basic->getsinglerow($where,'purchase');

		 $where = array('user_id'=>$purchase->student_id,'order_id'=>$purchase->id);
	     $contract_sign = $this->Basic->getsinglerow($where,'contract_sign');
	     
		 if(!($contract_sign))
		 {
			$where = array('added_for'=>$purchase->student_id,'title'=> 'Signature');
			$contract_sign = $this->Basic->getsinglerow($where,'document');
			
		 }
		 
		if($contract_sign)
        return 'Completed';
        else
		return 'Not';
	}
	
	function personalInfoonlystatus($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
	   $where = array('id'=>$purchase_id);
       $purchase = $this->Basic->getsinglerow($where,'purchase');

	   $where = array('id'=>$purchase->student_id);
       $client = $this->Basic->getsinglerow($where,'students');
      
       $where = array('user_id'=>$purchase->student_id,'role'=>'parent');
       $usersclient = $this->Basic->getsinglerow($where,'users');

       $firstname = ($client->firstname!='')?$client->firstname:'';
       $lastname = ($client->lastname!='')?$client->lastname:'';
       $mobileno = ($client->mobileno!='')?$client->mobileno:'';
       $dob = ($client->dob!='')?$client->dob:'';
       $ssn = ($client->roll_no!='')?$client->roll_no:'';
       $current_address = ($client->current_address!='')?$client->current_address:'';
       $city = ($client->city!='')?$client->city:'';
       $state = ($client->current_address!='')?$client->state:'';
       $pincode = ($client->pincode!='')?$client->pincode:'';
       $dob = date('m/d/Y', strtotime($dob));
       $ssn = ($client->roll_no!='')?$client->roll_no:'';

      if($usersclient->username!='' && $firstname!='' && $lastname!=''  && $usersclient->email!='' && $mobileno!='' && $dob!='' && $ssn!='' && $current_address!='' && $city!='' && $state!='' && $pincode!='' && $usersclient->password!='')
      {
          return 'Completed';
      }
      else
      {
          return 'Not';
      }
	}
	
	function commonDetailStatusonlystatus($purchase_id=0,$order_stepId=0,$order_step_no=0)
	{
	    $where = array('id'=>$purchase_id);
        $purchase = $this->Basic->getsinglerow($where,'purchase');
		
		$productId = $purchase->class_id;
		$client_id = $purchase->student_id;
		$list = (array) $this->Common->getProductOrderStepByProdId($productId,$order_stepId);
		$existlist= (array) $this->Common->select('dynamic_document_steps',['client_id' => $client_id,'order_step_id' => $order_stepId,'status' => 1],'order_step_id,order_step_detail_id,value');
		$match=0;
		
		$totalItemCount=count($list);
		$matched=0;
		foreach($list as $key => $response) {
			$order_step_detail_id 	= $response->order_step_detail_id;
			$order_step_id 			= $response->order_step_id;
			if(isset($existlist) && !empty($existlist)){
				foreach($existlist as $existingRes){
					if($existingRes->order_step_detail_id==$order_step_detail_id && $existingRes->value!=""){
						$matched +=1;
						break;
					}
				}
			}
		}
		if($totalItemCount==$matched){
			 return 'Completed';
		}else{
			 return 'Not';
		}
	}
	
	function getDownloadPdfLink($orderstepId=11,$order_id=0,$client_id=0,$order_step_detail_id=0){
		$contract_donwload_link ='';
		if($orderstepId==11 && !empty($order_id) && !empty($client_id) && !empty($order_step_detail_id) ){
			
			$where 			= array('user_id'=>$client_id,'order_id'=>$order_id);
			$contract_sign 	= $this->Basic->getsinglerow($where,'contract_sign');
			
			$sign = '';
			if($contract_sign  && !empty($order_step_detail_id))
			{
				if($order_step_detail_id=='35'){
					/*if(isMobile())
						$contract_donwload_link = $contract_sign->creditcontract_elec;
					else*/
						$contract_donwload_link = $contract_sign->creditcontracturl;
				}else if($order_step_detail_id=='36'){
					/*if(isMobile())
						$contract_donwload_link = $contract_sign->contract_url_elec;
					else*/
						$contract_donwload_link = $contract_sign->contract_url;
				}
				
				$sign = '<img alt="" src="'.$contract_sign->sign.'" style="height:80px; width:250px" />';
			}
			
			if(empty($contract_sign)){
				$this->load->library('pdf');
				$where 		= array('id'=>$client_id);
				$students 	= $this->Basic->getsinglerow($where,'students');
				$firstname 	= $students->firstname;
				$middlename = $students->middlename;
				$lastname 	= $students->lastname;
				$address 	= $students->current_address;
				$city 		= $students->city;
				$state 		= $students->state;
				$pincode 	= $students->pincode;
					
				$where = array('id'=>$students->teacher_id);
				$users = $this->Basic->getsinglerow($where,'teachers');
				
				$brokername =  $users->teacher_fname.' '.$users->teacher_lname;
			
				$letterTemplateId =0;
				if($order_step_detail_id=='35'){
					$letterTemplateId = (isMobile() ? 17 : 18);
				}else if($order_step_detail_id=='36'){
					$letterTemplateId = (isMobile() ? 19 : 11);
				}
				if(!empty($letterTemplateId)){
					$where = ['id' => $letterTemplateId]; 
					$creditcontracthere = $this->Basic->getsinglerow($where,'letter_templates');
					$message  = $creditcontracthere->message;
					
					$where = array('base_url'=>base_url());
					$admindetails= $this->Basic->getsinglerow($where,'layout_text_colors_new');
					$percentage = $admindetails->contract;

					$tempvalues = array('##PERCENTAGE##'=>$percentage,'##SITENAME##'=>sitename(),'##LOGO##'=>sitelogo(),'##FIRSTNAME##'=>$firstname,'##LASTNAME##'=>$lastname,'##ADDRESS##'=>$address,'##CITY##'=>$city,'##date##'=>date('m/d/Y'),'##STATE##'=>$state,'##ZIP##'=>$pincode,'##DATE##'=>date('m/d/Y'),'##BROKERNAME##'=>$brokername,'##SIGN##'=>$sign);
					
					$message = strtr($message,$tempvalues);
					
					$filename = $client_id.''.$order_id.''.strtotime("now");
					$this->pdf->generate($client_id,$message,$filename,'FALSE');
					
					$contract_donwload_link = base_url('uploads/pdffiles/'.$client_id.'/'.$filename.".pdf");
				}
			}
		 return $contract_donwload_link;
		}
	}
    
	function getContractTemplateDownloadSample($orderstepId=11,$order_id=0,$client_id=0,$order_step_detail_id=0){
		$contract_template='';
		if($orderstepId==11 && !empty($order_id) && !empty($client_id) && !empty($order_step_detail_id) ){
			
			$where 			= array('user_id'=>$client_id,'order_id'=>$order_id);
			$contract_sign 	= $this->Basic->getsinglerow($where,'contract_sign');
			$sign = '';
			if(empty($contract_sign)){
				$where 		= array('id'=>$client_id);
				$students 	= $this->Basic->getsinglerow($where,'students');
				$firstname 	= $students->firstname;
				$middlename = $students->middlename;
				$lastname 	= $students->lastname;
				$address 	= $students->current_address;
				$city 		= $students->city;
				$state 		= $students->state;
				$pincode 	= $students->pincode;
					
				$where = array('id'=>$students->teacher_id);
				$users = $this->Basic->getsinglerow($where,'teachers');
				
				$brokername =  $users->teacher_fname.' '.$users->teacher_lname;
			
				$letterTemplateId =0;
				if($order_step_detail_id=='35'){
					$letterTemplateId = (isMobile() ? 17 : 18);
				}else if($order_step_detail_id=='36'){
					$letterTemplateId = (isMobile() ? 19 : 11);
				}
				if(!empty($letterTemplateId)){
					$where = ['id' => $letterTemplateId]; 
					$creditcontracthere = $this->Basic->getsinglerow($where,'letter_templates');
					$message  = $creditcontracthere->message;
					
					$where = array('base_url'=>base_url());
					$admindetails= $this->Basic->getsinglerow($where,'layout_text_colors_new');
					$percentage = $admindetails->contract;

					$tempvalues = array('##PERCENTAGE##'=>$percentage,'##SITENAME##'=>sitename(),'##LOGO##'=>sitelogo(),'##FIRSTNAME##'=>$firstname,'##LASTNAME##'=>$lastname,'##ADDRESS##'=>$address,'##CITY##'=>$city,'##date##'=>date('m/d/Y'),'##STATE##'=>$state,'##ZIP##'=>$pincode,'##DATE##'=>date('m/d/Y'),'##BROKERNAME##'=>$brokername,'##SIGN##'=>$sign);
					
					$contract_template = strtr($message,$tempvalues);	
				}
			}
		 return $contract_template;
		}
	}
	function select_whereIn($table,$condition = [] ,$selectField = '*',$whereIn = []){
		$this->db->select($selectField);
		$this->db->from($table);
		if(isset($condition) && !empty($condition)){
			$this->db->where($condition);
		}
		if(isset($whereIn) && !empty($whereIn)){
			$this->db->where_in('id',$whereIn);
		}
		
		$query = $this->db->get();
		return $query->result();
	}
	/**********Check imcomplete order in cart**********/
	function checkIncompleteOrderInCart($productId=0,$user_id=0){
		if(!empty($productId) && !empty($user_id)){
			$this->db->select('order_id,step_stage,totalsteps')->from('orders');
			$this->db->where('status',0);
			$this->db->where('product_id',$productId);
			$this->db->where('user_id',$user_id);
			$this->db->where('is_delete <>',2);
			$this->db->order_by('order_id','DESC');
			$query = $this->db->get();
			return $query->row();
		}
	} 
}
