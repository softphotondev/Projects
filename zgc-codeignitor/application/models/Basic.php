<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic extends CI_Model {

	function getsinglerow($where, $table, $order = null, $by = null)
	{
		$this->db->where($where);

		if(!( is_null($order) && is_null($by) )) {
			$this->db->order_by($order, $by);
		}

		$query = $this->db->get($table);
		return $query->row();
	}
	
	function getmultiplerow($order,$where,$table)
	{
		//echo $order;
		$this->db->order_by($order);
		$this->db->where($where);
		$query = $this->db->get($table);
		return $query->result();
		
	}
	
	function insertdata($data,$table)
	{
       $this->db->insert($table,$data);
	   $last_id = $this->db->insert_id();
	   return $last_id;
	}
	
	function updatedata($data,$where,$table)
	{
        $this->db->where($where);
        $this->db->update($table,$data);
        return true;
	}
	
	function deletedata($where,$table)
	{
		$this->db->where($where);
        $this->db->delete($table); 
        return true;
	}
	function select($table,$where,$order = null, $by = null)
	{
		$this->db->where($where);
		if(!( is_null($order) && is_null($by) )) {
			$this->db->order_by($order, $by);
		}
		$query = $this->db->get($table);
		return $query->result();
	}


	function jointwotablesquery($table1,$join,$where,$order)
	{
			$this->db->select('*');
			$this->db->from($table1);
			$this->db->join($join);

			if($where!='')
            $this->db->where($where);

            if($order!='')
            $this->db->order_by($order['orderby'], $order['orderas']);
                 
			$query=$this->db->get();
			return $query->result();
	}

	function getcapcha()
	{
	    // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => 'system/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 5,
            'font_size'     => 18
        );
        $captcha = create_captcha($config);
        
		 // Unset previous captcha and set new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);
        
        return $captcha['image'];
	}


	function Getdisputeitems($order_id=0,$userId=0,$order_step_no=0)
	{
		$disputeList['creditstatus'] 	= $this->Common->select('creditstatus');
		$disputeList['instruction'] 	= $this->Common->select('instruction');
		$disputeList['credit_report_reason'] = $this->Common->select('credit_report_reason',array('parent_id'=>'0'));
		$disputeList['ins'] = $this->Common->select('credit_report_reason',array('parent_id !='=>'0'));
		
		$order = 'id'.'  '.'asc';
		$where = array('user_id'=>$userId,'status'=>1);
		$personalinfo = $this->Basic->getmultiplerow($order,$where,'dispute_personal_info');
		
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
							'instruction'	=>	$inner_value->instructions,
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
		$disputeList['selectedDisputeItem'] 	= $this->Global_model->selectedYourOrderDisputeItem($order_id);

		return $disputeList;
	}
	/*****Get Selected Dispute Item ******/
	function getSelectedDisputeitems($order_id=0,$userId=0,$isbotcheck='')
	{
		$disputeList['isbotcheck'] 		= $isbotcheck;
		
		$disputeList['creditstatus'] 	= $this->Common->select('creditstatus');
		//$disputeList['instruction'] 	= $this->Common->select('instruction');
		$disputeList['credit_report_reason'] = $this->Common->select('credit_report_reason',array('parent_id'=>'0'));
		$disputeList['ins'] = $this->Common->select('credit_report_reason',array('parent_id !='=>'0'));
		$order = 'dispute_pf_id'.'  '.'asc';
		$personalinfo = $this->Basic->getmultiplerow($order,['order_id'=>$order_id,'status'=>1],'order_dispute_personal_info');
		
		$order = 'dispute_creditInq_id'.'  '.'asc';
		$creditinfo = $this->Basic->getmultiplerow($order,['order_id'=>$order_id,'status'=>1],'order_dispute_credit_inquiry');

		$order = 'dispute_account_id'.' '.'asc';
		$dispute_account_history = $this->Basic->getmultiplerow($order,['order_id'=>$order_id,'status'=>1],'order_dispute_account_history');
		
		$totalNoOfAccount = count($dispute_account_history);
		$totalSteps = round($totalNoOfAccount/2); 
		$accounthistory=[];
		if($dispute_account_history){	
			foreach($dispute_account_history as $keyhere => $acchis){
				$number = $keyhere+1;
				$order = 'dispute_account_id'.' '.'asc';
				$where = array('dispute_account_id'=>$acchis->dispute_account_id);
				$inner_array = $this->Basic->getmultiplerow($order,$where,'dispute_account_history_details');
				$checkvalues = array();
				$accountHistoryList=[];
				if($inner_array){
					foreach ($inner_array as $inner_value) 
					{
						$accountHistoryList[]= [
							'dispute_acct_his_detail_id' => $inner_value->dispute_acct_his_detail_id,
							'company_title'		=>	$inner_value->name,
							'accountno'			=>	$inner_value->accountno,
							'paymentstatus'		=>	$inner_value->paymentstatus,
							'comments'			=>	$inner_value->comments,
							'dateopened'		=>	$inner_value->dateopened,
							'balance'			=>	$inner_value->balance,
							'account_status'	=>$inner_value->account_status,
							'reason'			=>	$inner_value->reason,
							'instruction'		=>	$inner_value->instructions,
						];
					}
				}
				$accounthistory[]=[
					'dispute_account_id' 	=> $acchis->dispute_account_id,
					'company_title' 		=> $acchis->company_title,
					'account_type_id' 		=> $acchis->account_type_id,
					'account_ins_id'		=> $acchis->account_ins_id,
					'is_checked' 			=> (int) $acchis->is_checked,
					'is_bot_table' 			=> $acchis->is_bot_table,
					'status' 				=> (int) $acchis->status,
					'account_historylist' 	=> $accountHistoryList
				];
			}
		}
		
		$disputeList['personalInfo'] 	= $personalinfo;
		$disputeList['creditInquiry'] 	= $creditinfo;
		$disputeList['accountHistory'] 	= $accounthistory;
		$disputeList['order_id'] = $order_id;
		$disputeItem = $this->load->view('theme/myaccount/admin/order/selected_dispute_items',$disputeList,true);
		return $disputeItem;
	}

	function orderbasicdetails($id)
	{
		$data['title'] = 'Project Orverview'; 

        //support data starte here
        $data['support'] = $this->Project_model->gatallsupportorderbased($id);
		$data['ordersrow'] = $this->Project_model->getallorders('',$id);
		$data['orders']  = $data['ordersrow'][0]; 

        // task status count
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'task','status'=>1);
		$task_status_all = $this->Basic->getmultiplerow($order,$where,'status');


		$order = 'id'.' '.'asc';
		$where = array();
		$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');

		$task_status=$task_count=[];

		if($task_status_all)
		{
			foreach ($task_status_all as $key => $task) 
			{
				$task_status[$task->status_id] =  $task->status_name;

				$task_status_output[$key] =  $task->status_name;
				$order = 'task_id'.' '.'desc';
				$where = array('task_status'=>$task->status_id,'order_id'=>$id,'is_delete'=>1);
				$task_all = $this->Basic->getmultiplerow($order,$where,'task');
				$task_count[$key] = count($task_all);
			}
		}

		$data['task_status'] = $task_status;
		$data['task_count'] = $task_count;
		$data['task_status_output'] = $task_status_output;

       // get all task status
		$order = 'task_id'.' '.'desc';
		$where = array('is_delete <>'=>2,'order_id'=>$id);
		$data['task'] = $this->Basic->getmultiplerow($order,$where,'task');
		// priority taken from table
        $order = 'id'.' '.'desc';
		$where = array();
		$data['priority'] = $this->Basic->getmultiplerow($order,$where,'priority');

		$data['order_id'] = $id;


		//support related values
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'support');
		$support_status_all = $this->Basic->getmultiplerow($order,$where,'status');

        $support_status = $support_count = $support_status_output = [];
		foreach($support_status_all as $suppkey=>$supp)
		{
			$support_status[$supp->status_id] = $supp->status_name;

			$support_status_output[$suppkey] =  $supp->status_name;

			$order = 'support_id'.' '.'desc';
			$where = array('status'=>$supp->status_id,'order_id'=>$id,'parent_id'=>0);
			$support_all = $this->Basic->getmultiplerow($order,$where,'support');
			$support_count[$suppkey] = count($support_all);
		}

		$data['support_status'] = $support_status;
		$data['support_count'] = $support_count;
		$data['support_status_output'] = $support_status_output;

		//Get all activity
		$order = 'activity_id'.' '.'desc';
		$where = array('order_id'=>$id);
		$data['user_activity'] = $this->Basic->getmultiplerow($order,$where,'user_activity');

			//Get all activity
		$data['notes'] = $this->Project_model->getallnotesbasedonorder($id);

		$orderId=$id;
	
		$data['order_dynamic_block_menu'] = $this->Global_model->getOrderBlockListbyOrderId($orderId);

		return $data;
	}


	function getsitedetails($site_id='',$user_id='')
	{
		$this->db->select('site_settings.*,users.first_name,users.last_name,users.username,users.password,users.intial_password as passworduser');
        $this->db->from('site_settings');
        $this->db->join('users', 'site_settings.user_id = users.id');
		$this->db->where('users.status',1);
		$this->db->where('users.user_type',4);

		if($user_id!='')
		$this->db->where('users.user_id',$user_id);

	    if($site_id!='')
		$this->db->where('site_settings.id',$site_id);

        $query = $this->db->get();
		return $query->result();
	}

	/*****Get Selected Dispute Item ******/
	function getSelectedBotTableDisputeitems($order_id=0,$userId=0,$isbotcheck='')
	{
		$disputeList['isbotcheck'] 		= $isbotcheck;
		
		$disputeList['creditstatus'] 	= $this->Common->select('creditstatus');
		//$disputeList['instruction'] 	= $this->Common->select('instruction');
		$disputeList['credit_report_reason'] = $this->Common->select('credit_report_reason',array('parent_id'=>'0'));
		$disputeList['ins'] = $this->Common->select('credit_report_reason',array('parent_id !='=>'0'));
		$order = 'dispute_pf_id'.'  '.'asc';
		$personalinfo = $this->Basic->getmultiplerow($order,['order_id'=>$order_id,'status'=>1],'order_dispute_personal_info');
		
		$order = 'dispute_creditInq_id'.'  '.'asc';
		$creditinfo = $this->Basic->getmultiplerow($order,['order_id'=>$order_id,'status'=>1,'is_checked'=>1],'order_dispute_credit_inquiry');

		$order = 'dispute_account_id'.' '.'asc';
		$dispute_account_history = $this->Basic->getmultiplerow($order,['order_id'=>$order_id,'status'=>1,'is_checked'=>1],'order_dispute_account_history');
		
		$totalNoOfAccount = count($dispute_account_history);
		$totalSteps = round($totalNoOfAccount/2); 
		$accounthistory=[];
		if($dispute_account_history){	
			foreach($dispute_account_history as $keyhere => $acchis){
				$number = $keyhere+1;
				$order = 'dispute_account_id'.' '.'asc';
				$where = array('dispute_account_id'=>$acchis->dispute_account_id);
				$inner_array = $this->Basic->getmultiplerow($order,$where,'dispute_account_history_details');
				$checkvalues = array();
				$accountHistoryList=[];
				if($inner_array){
					foreach ($inner_array as $inner_value) 
					{
						$accountHistoryList[]= [
							'dispute_acct_his_detail_id' => $inner_value->dispute_acct_his_detail_id,
							'company_title'		=>	$inner_value->name,
							'accountno'			=>	$inner_value->accountno,
							'paymentstatus'		=>	$inner_value->paymentstatus,
							'comments'			=>	$inner_value->comments,
							'dateopened'		=>	$inner_value->dateopened,
							'balance'			=>	$inner_value->balance,
							'account_status'	=>$inner_value->account_status,
							'reason'			=>	$inner_value->reason,
							'instruction'		=>	$inner_value->instructions,
						];
					}
				}
				$accounthistory[]=[
					'dispute_account_id' 	=> $acchis->dispute_account_id,
					'company_title' 		=> $acchis->company_title,
					'account_type_id' 		=> $acchis->account_type_id,
					'account_ins_id'		=> $acchis->account_ins_id,
					'is_checked' 			=> (int) $acchis->is_checked,
					'is_bot_table' 			=> $acchis->is_bot_table,
					'status' 				=> (int) $acchis->status,
					'account_historylist' 	=> $accountHistoryList
				];
			}
		}
		
		$disputeList['personalInfo'] 	= $personalinfo;
		$disputeList['creditInquiry'] 	= $creditinfo;
		$disputeList['accountHistory'] 	= $accounthistory;
		$disputeList['order_id'] = $order_id;
		$disputeItem = $this->load->view('theme/myaccount/admin/order/selected_dispute_items',$disputeList,true);
		return $disputeItem;
	}

}
