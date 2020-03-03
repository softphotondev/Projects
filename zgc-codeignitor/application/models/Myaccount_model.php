<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myaccount_model extends CI_Model {


	function getmyuploadsbroker($broker_id,$search='')
	{
		$user_ids = getclientids($this->session->userdata('user_id'));

			$this->db->select('order_detail.*,user_details.first_name,user_details.last_name');
			$this->db->from('order_detail');
			$this->db->join('orders','order_detail.order_id=orders.order_id');
			$this->db->join('users','orders.user_id=users.id');
			$this->db->join('user_details','user_details.user_id=users.id');


      if($search && $search!='')
       {
          $where ='';
          $where .= "(user_details.first_name LIKE '%".$search."%' or ";
          $where .= "user_details.last_name LIKE '%".$search."%' or ";
          $where .= "order_detail.custom_field_name LIKE '%".$search."%' ) "; 
          $this->db->where($where);
       }

      if($broker_id!='')
      $this->db->where('users.parent_user_id',$broker_id);

      $this->db->where('order_detail.block_id',5);

       $this->db->where('order_detail.custom_field_values !=','');

      $this->db->order_by('order_detail.order_detail_id','desc');
      
			$query=$this->db->get();
			return $query->result();
	}


	function getmyuploadsclient($clinet_id,$search='')
	{
			$this->db->select('order_detail.*,user_details.first_name,user_details.last_name');
			$this->db->from('order_detail');
			$this->db->join('orders','order_detail.order_id=orders.order_id');
			$this->db->join('users','orders.user_id=users.id');
			$this->db->join('user_details','user_details.user_id=users.id');


      if($search && $search!='')
       {
          $where ='';
          $where .= "(user_details.first_name LIKE '%".$search."%' or ";
          $where .= "user_details.last_name LIKE '%".$search."%' or ";
          $where .= "order_detail.custom_field_name LIKE '%".$search."%' ) "; 
          $this->db->where($where);
       }

			if($clinet_id!='')
            $this->db->where('orders.user_id',$clinet_id);

            $this->db->where('order_detail.block_id',5);
            $this->db->where('order_detail.custom_field_values !=','');

            $this->db->order_by('order_detail.order_detail_id','desc');
                 
			$query=$this->db->get();
			return $query->result();
	}


	function getinvoicelist($status='',$order_id='',$search='')
	{
          if($this->session->userdata('user_type')==4)
          {
           $userids = getclientids($this->session->userdata('user_id'));
          }
	      
		    $where = array('is_delete <>'=>2,'status >'=>0);

			$this->db->select('*');
			$this->db->from('orders');
			$this->db->join('order_items_detail','orders.order_id=order_items_detail.order_id');
			$this->db->join('user_details','orders.user_id=user_details.user_id');

			if($where!='')
            $this->db->where($where);
            if($status)
            $this->db->where('orders.status',$status);

            if($order_id)
            $this->db->where('orders.order_id',$order_id);

           if($search && $search!='')
           {
            $where ='';
            $where .= "(order_items_detail.product_name LIKE '%".$search."%' or ";
            $where .= "orders.order_amount LIKE '%".$search."%' or ";
            $where .= "user_details.first_name LIKE '%".$search."%' or ";
            $where .= "user_details.last_name LIKE '%".$search."%' or ";
            $where .= "orders.order_number LIKE '%".$search."%' or ";
            $where .= "orders.payment_method LIKE '%".$search."%' ) "; 
            $this->db->where($where);
           }

            if($this->session->userdata('user_type')==4)
           {
                $broker_id = $this->session->userdata('user_id');
                if(!empty($userids)){
                  $this->db->where_in('orders.user_id',$userids);
			    }else {
				   $this->db->where('orders.user_id',$this->session->userdata('user_id'));
				}
           }
           else if($this->session->userdata('user_type')==5)
           {
               $this->db->where('orders.user_id',$this->session->userdata('user_id'));
           }
			 $this->db->group_by('orders.order_id');
			$this->db->order_by('orders.order_id','desc');
			$query=$this->db->get();
			return $query->result();
	}

  function addsupportemailnormal($ticket_id)
  {
          $tickets  = $this->Basic->getsinglerow(['ticket_id' =>$ticket_id],'tickets');

          if($tickets)
          {
              $user_detailsarray = $this->User_model->getUserDetailById($tickets->user_id);

              $user_details = $user_detailsarray[0];
              $firstname = $user_details->first_name;
              $lastname = $user_details->last_name;


               if($this->session->userdata('user_type')==1)
              {
                $name = $firstname.' '.$lastname;
                $to = $user_details->email;
                $sender = 'Admin';
                $receiver = $name;
              }
              else
              {
                   $name = 'Admin';
                   $to = getsiteemailfromadmin($user_details->user_from);
                   $sender =  $firstname.' '.$lastname;
                   $receiver = $name;
              }

                $email_templates = getemail(14);
                $subject  = $email_templates->subject;
                $message  = $email_templates->message;

                $tempvalues = array(
                    '##SITENAME##'=>getsitenamefromadmin($user_details->user_from),
                    '##RECEIVER##'=>$receiver,
                    '##SENDER##'=>$sender,
                    "##SITEURL##" =>$user_details->user_from
                );

                $subject1 = strtr($subject,$tempvalues);
                $message = strtr($message,$tempvalues);
                $admin_email = array(
                                      'to'  => $to,
                                      'subject'   => $subject1,
                                      'message'   =>  $message,
                                      'site'=>$user_details->user_from
                                      );

                $this->Email_model->send_mail($admin_email);
          }
       return true;
  }


  function addsupportemail($support_id)
  {
          $support  = $this->Basic->getsinglerow(['support_id' =>$support_id],'support');

            if($support)
            {
              $order  = $this->Basic->getsinglerow(['order_id' =>$support->order_id],'orders');

              if($order)
              {
                $user_detailsarray = $this->User_model->getUserDetailById($order->user_id);

                $user_details = $user_detailsarray[0];
                $firstname = $user_details->first_name;
                $lastname = $user_details->last_name;

                if($this->session->userdata('user_type')==1)
                {
                  $name = $firstname.' '.$lastname;
                  $to = $user_details->email;
                  $sender = 'Admin';
                  $receiver = $name;
                }
                else
                {
                     $name = 'Admin';
                     $to = getsiteemailfromadmin($user_details->user_from);
                     $sender =  $firstname.' '.$lastname;
                     $receiver = $name;
                }


                $email_templates = getemail(14);
                $subject  = $email_templates->subject;
                $message  = $email_templates->message;

                $tempvalues = array(
                    '##SITENAME##'=>getsitenamefromadmin($user_details->user_from),
                    '##RECEIVER##'=>$receiver,
                    '##SENDER##'=>$sender,
                    "##SITEURL##" =>$user_details->user_from
                );

                $subject1 = strtr($subject,$tempvalues);

                $message = strtr($message,$tempvalues);

                $admin_email = array(
                                      'to'  => $to,
                                      'subject'   => $subject1,
                                      'message'   =>  $message,
                                      'site'=>$user_details->user_from
                                      );

                $this->Email_model->send_mail($admin_email);
              }
            }
        return true;
  }


  function addnotesemail($notes_id)
  {
            $notes  = $this->Basic->getsinglerow(['notes_id' =>$notes_id],'notes');

            if($notes)
            {
              $order  = $this->Basic->getsinglerow(['order_id' =>$notes->order_id],'orders');

              if($order)
              {
                $user_detailsarray = $this->User_model->getUserDetailById($order->user_id);

                $user_details = $user_detailsarray[0];
                $firstname = $user_details->first_name;
                $lastname = $user_details->last_name;

                if($this->session->userdata('user_type')==1)
                {
                  $name = $firstname.' '.$lastname;
                  $to = $user_details->email;
                }
                else
                {
                     $name = 'Admin';
                     $to = getsiteemailfromadmin($user_details->user_from);
                }

                $email_templates = getemail(15);
                $subject  = $email_templates->subject;
                $message  = $email_templates->message;

                $tempvalues = array(
                    '##SITENAME##'=>getsitenamefromadmin($user_details->user_from),
                    '##NAME##'=>$name,
                    '##SUBJECT##'=>$notes->subject,
                    '##NOTES##'=>$notes->notes,
                    "##SITEURL##" =>$user_details->user_from
                );

                $subject1 = strtr($subject,$tempvalues);

                $message = strtr($message,$tempvalues);

                $admin_email = array(
                                      'to'  => $to,
                                      'subject'   => $subject1,
                                      'message'   =>  $message,
                                      'site'=>$user_details->user_from
                                      );

                $this->Email_model->send_mail($admin_email);
              }
          }
          return true;
      }



      function taskemail($task_id)
      {
               $task  = $this->Basic->getsinglerow(['task_id' =>$task_id],'task');

               if($task)
               {
                 $order  = $this->Basic->getsinglerow(['order_id' =>$task->order_id],'orders');

              if($order)
              {
                $user_detailsarray = $this->User_model->getUserDetailById($order->user_id);

                $user_details = $user_detailsarray[0];
                $firstname = $user_details->first_name;
                $lastname = $user_details->last_name;

                $name = $firstname.' '.$lastname;
                $to = $user_details->email;
               
                $email_templates = getemail(13);
                $subject  = $email_templates->subject;
                $message  = $email_templates->message;

                $tempvalues = array(
                    '##SITENAME##'=>getsitenamefromadmin($user_details->user_from),
                    '##NAME##'=>$name,
                    '##SUBJECT##'=>$task->task_subject,
                    '##DESCRIPTION##'=>$task->description,
                    "##SITEURL##" =>$user_details->user_from
                );

                $subject1 = strtr($subject,$tempvalues);

                $message = strtr($message,$tempvalues);

                $admin_email = array(
                                      'to'  => $to,
                                      'subject'   => $subject1,
                                      'message'   =>  $message,
                                      'site'=>$user_details->user_from
                                      );

                $this->Email_model->send_mail($admin_email);
                }
             }
          return true;   
      }

  function getActiveClients()
  {
    // 5 is for client type
    $this->db->select("users.id");
    // $this->db->where("users.status", 1); // commented by instructions to get all clients
    $this->db->where("users.user_type", 5);
    $this->db->from("users");
    $queryActiveClients = $this->db->get()->num_rows();
    return $queryActiveClients;
  }

  function getNewClients()
  {
    // 5 is for client type
    $this->db->select("users.id");
    $this->db->where("users.status", 1);
    $this->db->where("users.user_type", 5);
    $this->db->where("'date_format(users.created_at, %Y-%m-%d)'", date("Y-m-d"));
    $this->db->from("users");
    $queryNewActiveClients = $this->db->get()->num_rows();
    return $queryNewActiveClients;
  }

  function getTotalSale()
  {
    $this->db->select("orders.order_id, sum(orders.order_amount) as totalsale");
    $this->db->where("orders.status > ", 0);
    $this->db->where("orders.is_delete <>", 2);
    $this->db->from("orders");
    $queryTotalSale = $this->db->get()->result();
    return $queryTotalSale[0]->totalsale;
  }

  function getTotalOrders()
  {
    $this->db->select("orders.order_id");
    // $this->db->where("orders.status > ", 0);
    $this->db->where("orders.is_delete <>", 2);
    $this->db->from("orders");
    $queryTotalSale = $this->db->get()->num_rows();
    return $queryTotalSale;
  }

  function getTotalBrokers()
  {
    // 4 is for broker type
    $this->db->select("users.id");
    // $this->db->where("users.status", 1);
    $this->db->where("users.user_type", 4);
    $this->db->from("users");
    $queryBrokers = $this->db->get()->num_rows();
    return $queryBrokers;
  }
  
    //
    function getTotalTicketsNotification()
    {    
    $this->db->select("tickets.ticket_id");    
    $this->db->from("tickets");
	$this->db->where('tickets.status != ',0,FALSE);
    $queryNoti = $this->db->get()->num_rows();
    return $queryNoti;
    }
	
    function getTotalTasksNotification()
    {    
    $this->db->select("task.task_id");    
    $this->db->from("task");	
    $querytask = $this->db->get()->num_rows();
    return $querytask;
    }
	
	 function getTicketsNotification()
    {    
    $this->db->select("*");    
    $this->db->from("tickets");
	$this->db->order_by("ticket_id", "desc");
	$this->db->limit(5);
    $query = $this->db->get();
	return $query->result();
    }
	
	 function getTasksNotification()
    {    
    $this->db->select("*");    
    $this->db->from("task");
	$this->db->order_by("task_id", "desc");
	$this->db->limit(5);
    $query = $this->db->get();
	return $query->result();
    }
   //
 
  function tickets_dashboard()
  {
    // function added by sanjeev on 11-12-2020
    $search= "";
    $status_id = 0;
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

    if($this->session->userdata('user_type')==5){
      $this->db->where('tickets.user_id',$this->session->userdata('user_id'));
    }
        else if($this->session->userdata('user_type')==4){
      $this->db->where_in('tickets.user_id',$userids);
    }
    $this->db->where('status.type','support');


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
    $this->db->where('tickets.parent_id',0);

    if($status_id)
    $this->db->where('tickets.status',$status_id);

    $this->db->limit(100);
    $this->db->order_by('tickets.ticket_id','desc');
    $query=$this->db->get();
    
    $allSupportTicket =[];
    /********Get Support Ticket List ***********/
    foreach($query->result() as $getSupportList){
      $supportTicketId = $getSupportList->ticket_id;
      $replyData     = $this->Project_model->getSupportReplyByTicketId($supportTicketId);
      $getSupportList->reply_support_list = $replyData;
      $allSupportTicket[]=$getSupportList;
    }
    return $allSupportTicket;
  }
  
  function support_button(){
	  
	    $data['title'] = 'Support Ticket';
		$data['ticket'] = $this->Project_model->gatallticketorderbased();
		$data['page'] 	= 'support';
		$order = 'id'.' '.'asc';
		$where = array();
		$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');

		//$data['users'] = $this->User_model->getUserDetailById('','',5);

		$data['users'] = $this->User_model->getclients();

		$order = 'id'.' '.'desc';
		$where = array();
		$data['priority'] = $this->Basic->getmultiplerow($order,$where,'priority');
	
		//support related values
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'support');
		$support_status_all = $this->Basic->getmultiplerow($order,$where,'status');
	
        $support_status = $support_count = $support_status_output = [];

		foreach($support_status_all as $suppkey=>$supp)
		{
			$support_status[$supp->status_id] = $supp->status_name;

			$support_status_output[$suppkey] =  $supp->status_name;

			$support_all = $this->Project_model->gatallticketorderbased('',$supp->status_id);
			$support_count[$suppkey] = count($support_all);
		}

		unset($support_status['13']);
		unset($support_status['15']);
		unset($support_status['16']);


		$data['support_status'] = $support_status;
		$data['support_count'] = $support_count;
		$data['support_status_output'] = $support_status_output;
		
		return $support_status_output;
		
  }
  
  function getProductImageById($productId=0){
		    $this->db->select('image_name');
			$this->db->from('product_image');
			$this->db->where('product_id', $productId);
		    $query = $this->db->get();
		    return $query->result();
	} 
  
  function support_button_count(){
	  
	    $data['title'] = 'Support Ticket';
		$data['ticket'] = $this->Project_model->gatallticketorderbased();
		$data['page'] 	= 'support';
		$order = 'id'.' '.'asc';
		$where = array();
		$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');

		//$data['users'] = $this->User_model->getUserDetailById('','',5);

		$data['users'] = $this->User_model->getclients();

		$order = 'id'.' '.'desc';
		$where = array();
		$data['priority'] = $this->Basic->getmultiplerow($order,$where,'priority');
	
		//support related values
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'support');
		$support_status_all = $this->Basic->getmultiplerow($order,$where,'status');
	
        $support_status = $support_count = $support_status_output = [];

		foreach($support_status_all as $suppkey=>$supp)
		{
			$support_status[$supp->status_id] = $supp->status_name;

			$support_status_output[$suppkey] =  $supp->status_name;

			$support_all = $this->Project_model->gatallticketorderbased('',$supp->status_id);
			$support_count[$suppkey] = count($support_all);
		}

		unset($support_status['13']);
		unset($support_status['15']);
		unset($support_status['16']);


		$data['support_status'] = $support_status;
		$data['support_count'] = $support_count;
		$data['support_status_output'] = $support_status_output;
		
		return $support_count;
		
  }

}
