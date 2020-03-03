<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

	function getallorders($status='',$order_id='',$search='')
	{
		  if($this->session->userdata('user_type')==4){
			$userids = getclientids($this->session->userdata('user_id'));
			$broker_id = $this->session->userdata('user_id');
				if(empty($userids)){
					$userids=[$broker_id];
				}
		  }
		    $where = array('is_delete <>'=>2);
			
			$this->db->select('orders.*,products.category_id,products.product_type,products.product_name,products.description,products.selling_price,user_details.first_name,user_details.last_name,user_details.email,user_details.phone,order_items_detail.order_qty');
			$this->db->from('orders');
			$this->db->join('products','products.product_id=orders.product_id');
			$this->db->join('order_items_detail','order_items_detail.order_id=orders.order_id','left');
			$this->db->join('user_details','orders.user_id=user_details.user_id','left');			

			if($where!='')
            	$this->db->where($where);

            if($status)
            	$this->db->where('orders.status',$status);

            if($order_id)
            	$this->db->where('orders.order_id',$order_id);

           if($search && $search!='')
           {
           	$where ='';
        	$where .= "(products.product_name LIKE '%".$search."%' or ";
        	$where .= "orders.order_amount LIKE '%".$search."%' or ";
        	$where .= "orders.payment_method LIKE '%".$search."%' ) "; 
        	$this->db->where($where);
           }
           if($this->session->userdata('user_type')==4)
           {
                $this->db->where_in('orders.user_id',$userids);  
           }
           else if($this->session->userdata('user_type')==5)
           {
               $this->db->where('orders.user_id',$this->session->userdata('user_id'));
           }
          
		    $this->db->group_by('orders.order_id');
		  	$this->db->order_by('orders.order_id','desc');
			$query=$this->db->get();
			//echo $this->db->last_query();exit;
			return $query->result();
	}


	function gatallsupportorderbased($order_id)
	{
		$this->db->select('support.*,users.username,users.first_name,users.last_name,users.firstname,users.lastname,priority.priority as priority_name,status.status_name,support_depart.dept as department_name');
		$this->db->from('support');
		$this->db->join('users','users.id=support.user_id');
		$this->db->join('priority','priority.id=support.priority','left');
		$this->db->join('status','status.status_id=support.status','left');
		$this->db->join('support_depart','support_depart.id=support.department','left');


		$this->db->where('status.type','support');

		$this->db->where('support.order_id',$order_id);
		$this->db->where('support.is_delete',1);
		$this->db->where('support.parent_id',0);
		$this->db->order_by('support_id','desc');
		$query=$this->db->get();


		$allSupport =[];

		foreach($query->result() as $getSupportList)
		{
		    $supportTicketId = $getSupportList->support_id;
			$replyData 		 = $this->getSupportReplyBySupportId($supportTicketId);
			$getSupportList->reply_support_list = $replyData;
			$allSupport[]=$getSupportList;
		}

		return $allSupport;
	}


	function getSupportReplyBySupportId($support_id)
	{
		$this->db->select('support_support_reply.*,users.username')->from('support_support_reply');
		$this->db->join('users','users.id = support_support_reply.user_id');
		$this->db->where('support_id',$support_id);
		$query=$this->db->get();
		return $query->result();
	}


	function gatallticketorderbased($search='',$status_id='')
	{
		 if($this->session->userdata('user_type')==4){
		  /* $this->db->select('id')->from('users');
		   $this->db->where('parent_user_id',$this->session->userdata('user_id'));
		   $query=$this->db->get();
		   $userids = $query->result_array();*/

		   $userids = getclientids($this->session->userdata('user_id'));
		}
	    $this->db->select('tickets.*,users.username,users.first_name,users.last_name,users.firstname,users.lastname,priority.priority as priority_name,status.status_name,support_depart.dept as department_name');
		$this->db->from('tickets');
		$this->db->join('users','users.id=tickets.user_id');
		$this->db->join('priority','priority.id=tickets.priority','left');
		$this->db->join('status','status.status_id=tickets.status','left');
		$this->db->join('support_depart','support_depart.id=tickets.department','left');
		
		$this->db->where('status.type','support');
		
		if($this->session->userdata('user_type')==5){
			$this->db->where('tickets.user_id',$this->session->userdata('user_id'));
		}
        else if($this->session->userdata('user_type')==4){
			if(!empty($userids)){
				$this->db->where_in('tickets.user_id',$userids);
			}else{
				$this->db->where('tickets.user_id',$this->session->userdata('user_id'));
			}
		}
		if($search && $search!=''){
			$where ='';
			$where .= "(users.first_name LIKE '%".$search."%' or ";
			$where .= "users.last_name LIKE '%".$search."%' or ";
			$where .= "users.firstname LIKE '%".$search."%' or ";
			$where .= "users.lastname LIKE '%".$search."%' or ";
			$where .= "tickets.subject LIKE '%".$search."%' ) "; 
			$this->db->where($where);
		}
		/****@is_delete- 2 - Deleted, 1 - Active ****/
		$this->db->where('tickets.is_delete',1);
		//$this->db->where('tickets.parent_id',0);

		if($status_id)
		$this->db->where('tickets.status',$status_id);
		$this->db->order_by('tickets.ticket_id','desc');
		$query=$this->db->get();
		
		$allSupportTicket =[];
		/********Get Support Ticket List ***********/
		foreach($query->result() as $getSupportList){
			$supportTicketId = $getSupportList->ticket_id;
			$replyData 		 = $this->getSupportReplyByTicketId($supportTicketId);
			$getSupportList->reply_support_list = $replyData;
			$allSupportTicket[]=$getSupportList;
		}
		return $allSupportTicket;
	}
	/*********************************************
	@Get All Reply of Support Ticket by Ticket Id
	***********************************************/
	function getSupportReplyByTicketId($supportTicketId=0){
		$this->db->select('support_ticket_reply.*,users.username')->from('support_ticket_reply');
		$this->db->join('users','users.id = support_ticket_reply.user_id');
		$this->db->where('ticket_id',$supportTicketId);
		$query=$this->db->get();
		return $query->result();
	}

	 function disputeitems($order_id)
    {
       $where = array('order_id'=>$order_id);
       $orders = $this->Basic->getsinglerow($where,'orders');
	   
	   if($orders)
       {
		$data['orders']=$orders;
		   
		//$userId = $data['orders']->user_id;

		$userId = '1122';
		$data['creditstatus'] 	= $this->Common->select('creditstatus');
		$data['instruction'] 	= $this->Common->select('instruction');
	$data['credit_report_reason'] = $this->Common->select('credit_report_reason',array('parent_id'=>'0'));
		
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
		$data['personalInfo'] 	= $personalinfo;
		$data['creditInquiry'] 	= $creditinfo;
		$data['accountHistory'] 	= $accounthistory;

		$where = array('id'=>$userId);
		$users = $this->Basic->getsinglerow($where,'users');
		$isfinal = ($users && $users->isfinal)?(int)$users->isfinal:0;	
		$data['isfinal'] 	= (int) $isfinal;
		
	    return $data; 
	   }
	}


	function sentorderemail($orderid)
	{
		$order 	= $this->Basic->getsinglerow(['order_id' =>$orderid],'orders');

		if($order)
		{
		$user_detailsarray = $this->User_model->getUserDetailById($order->user_id);

		if($user_detailsarray)
		{
		$user_details = $user_detailsarray[0];

		$firstname = $user_details->first_name;

		$lastname = $user_details->last_name;

		$purchase_orderno =  $order->order_number;

		$order_items_detail = $this->Basic->getsinglerow(['order_id' =>$orderid],'order_items_detail');

		if($order_items_detail)
		{
		$product = $order_items_detail->product_name;

			    /********** send email ******/
				/*$email_templates = getemail(8);
				$subject  = $email_templates->subject;
				$message  = $email_templates->message;
                $tempvalues = array('##SITEURL##'=>base_url(),'##SITENAME##'=>sitename(),'##LOGO##'=>sitelogo(),'##FIRSTNAME##'=>$firstname,'##LASTNAME##'=>$lastname,'##ORDERID##'=>$purchase_orderno,'##PRODUCT##'=>$product,'##DATETIME##'=>date('m/d/Y  h:i:s a'),'##STATUS##'=>'Order Progress');    
                $message = strtr($message,$tempvalues);

				$subtemp = array('##SITENAME##'=>sitename());
				$subject = strtr($subject,$subtemp);
				
			
				$admin_emailId = siteemail();
			
					$admin_email = array(
					'to' 		=> $admin_emailId,
					'subject' 	=> $subject,
					'message'   =>  $message,
					'site'		=> $user_details->user_from
					);

				$this->Email_model->send_mail($admin_email);

				$client_email = array(
					'to' 		=> $user_details->email,
					'subject' 	=> $subject,
					'message'   =>  $message,
					'site'=>$user_details->user_from
					);
				$this->Email_model->send_mail($client_email);
				/****** End *****/
				
			/*if($user_details->parent_user_id<>0)
			{
				$brokerdetailsarray = $this->User_model->getUserDetailById($user_details->parent_user_id);

				$brokerdetails = $brokerdetailsarray[0];
               
                 if($brokerdetails)
                 {
				$broker_email = array(
				'to' 		=> $brokerdetails->email,
				'subject' 	=> $subject,
				'message'   =>  $message,
				'site'=>$brokerdetails->user_from
				);

				$this->Email_model->send_mail($broker_email);
			   }
			}*/
			return true;
		    }
		  }
	   } 
	}
	


	function getbalanceorder()
	{
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->join('products','orders.product_id=products.product_id');
		$this->db->order_by('orders.order_id','desc');
		$this->db->where('orders.status',0);
		$this->db->where('orders.is_delete',1);
		if($this->session->userdata('user_type') ==4){
			$this->db->where('orders.created_by',$this->session->userdata('id'));
		}else{
			$this->db->where('orders.user_id',$this->session->userdata('id'));
		}
		$this->db->limit(1);
		$query=$this->db->get();
		return $query->result();
	}
	function getallnotesbasedonorder($order_id)
	{
		$this->db->select('notes.*,users.username,users.first_name,users.last_name,users.firstname,users.lastname');
		$this->db->from('notes');
		$this->db->join('users','users.id=notes.added_by');
		$this->db->where('notes.order_id',$order_id);
		$this->db->where('notes.is_delete',1);
		$this->db->where('notes.parent_id',0);
		$this->db->order_by('notes_id','desc');
		$query=$this->db->get();

		$allSupport =[];

		foreach($query->result() as $getSupportList)
		{
		    $supportTicketId = $getSupportList->notes_id;
			$replyData 		 = $this->getallnotesreply($supportTicketId);
			$getSupportList->reply_support_list = $replyData;
			$allSupport[]=$getSupportList;
		}

		return $allSupport;
	}


	function getallnotesreply($notes_id)
	{
     	$this->db->select('notes_reply.*,users.username')->from('notes_reply');
		$this->db->join('users','users.id = notes_reply.user_id');
		$this->db->where('notes_id',$notes_id);
		$query=$this->db->get();
		return $query->result();
	}

	function searchpayment($search)
	{
		$this->db->select('*');
		$this->db->from('payment_methods');
		$this->db->like('name', $search);
		$this->db->or_like('description', $search);
		$this->db->order_by('payment_id','desc');
		$query=$this->db->get();
		return $query->result();
	}


	


}
