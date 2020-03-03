<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tickets extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

	   if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$this->load->model('support_model');

	}

	function index()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] 		= 'Support Ticket';
		$data['ticket'] = $this->Project_model->gatallticketorderbased();

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

			$order = 'ticket_id'.' '.'desc';
			$where = array('status'=>$supp->status_id,'parent_id'=>0);
			$support_all = $this->Basic->getmultiplerow($order,$where,'tickets');
			$support_count[$suppkey] = count($support_all);
		}	
		$data['support_status'] = $support_status;
		$data['support_count'] = $support_count;
		$data['support_status_output'] = $support_status_output;


		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/support_ticket',$data);
		$this->load->view('theme/layout/footer',$data);
	}



	function save()
	{
		try{
			$postData = $this->input->post();

			if(isset($postData['subject']))
			{

		    if(!empty($_FILES["image"]["name"]))
            {
                $image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$_FILES["image"]["name"]));
                
                $uniqueID                 = uniqid();
                $img                     = $uniqueID.'_'.$image;
                $img_unique              = basename($img);
                $config['upload_path']   = './uploads/support/';
                $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
                $config['file_name']     = $img_unique;  
                $this->load->library("upload", $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload("image",$img_unique))
                {
                echo $this->upload->display_errors();die;
                }
                else
                {
                //$postData["image"] = base_url('/uploads/support/'.$img_unique);
				$postData["image"] = '/uploads/support/'.$img_unique;
                }
	       }
	       else
	       {
	       	 $postData["image"] = (isset($postData['image_old']))?$postData['image_old']:'';
	       	 unset($postData['image_old']);
	       }


	      if($this->input->post('dept') && ($this->input->post('dept')!=''))
	       {
	       	   $task['dept'] = $this->input->post('dept');
               $postData['department'] = $this->Basic->insertdata($task,'support_depart');
	       }
	       unset($postData['dept']);
		   
			
				if(!empty($postData['ticket_id']))	
				{
					$ordersData=[
						'priority'		=> $postData['priority'],
						'status'		=> $postData['status'] ?? 13,
						'department'	=>	$postData['department']
					];
					$this->Basic->updatedata($ordersData,['ticket_id' => $postData['ticket_id']],'tickets');
					
					$addreplyData = [
						'ticket_id'	=> $postData['ticket_id'],
						'message'	=> $postData['description'],
						'user_id' 	=> $this->session->userdata('id'),
						'created_date' => date('Y-m-d :H:i:s')
					];
					 $this->Basic->insertdata($addreplyData,'support_ticket_reply');
						// addactivity($postData['order_id'],'Support Ticket','Support Ticket has been Updated');
						$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully Reply</div>');
				}else{	

					$ordersData=[
						'support_ticket_number' => 'INC-'.$this->session->userdata('user_id').time(),
						'added_by' 		=> $this->session->userdata('user_id'),
						'parent_id'		=> (($this->input->post('parent_id'))?$this->input->post('parent_id'):'0'),
						'subject'		=> $postData['subject'],
						'description'	=> $postData['description'],
						'priority'		=> $postData['priority'],
						'status'		=> $postData['status'] ?? 13,
						'order_number'	=> $postData['ordernumber'],
						'image'			=> $postData['image'],
						'department'	=>	$postData['department'],
						'datetime'		=> date('Y-m-d H:i:s'),
						'updated_date'	=> date('Y-m-d H:i:s'),
						'user_id' 		=> $postData['user_id'],
					];
					
					$ticket_id = $this->Basic->insertdata($ordersData,'tickets');

					//$this->Myaccount_model->addsupportemailnormal($ticket_id);

					//addactivity($postData['order_id'],'Support','Support has been Inserted');
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Inserted Successfully</div>');
				}
				redirect($_SERVER['HTTP_REFERER']);

			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function replysave()
	{
		$postData = $this->input->post();
		
		if(isset($postData['ticket_id']))
			{

		    if(!empty($_FILES["image"]["name"]))
            {
                $image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$_FILES["image"]["name"]));
                
                $uniqueID                 = uniqid();
                $img                     = $uniqueID.'_'.$image;
                $img_unique              = basename($img);
                $config['upload_path']   = './uploads/support/';
                $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
                $config['file_name']     = $img_unique;  
                $this->load->library("upload", $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload("image",$img_unique))
                {
                echo $this->upload->display_errors();die;
                }
                else
                {
                //$postData["image"] = base_url('/uploads/support/'.$img_unique);
				$postData["image"] = '/uploads/support/'.$img_unique;
                }
	       }
	       else
	       {
	       	 $postData["image"] ='';
	       } 

	       $support_ticket_replydata=[
						'user_id' 		=> $this->session->userdata('user_id'),
						'ticket_id'		=> $this->input->post('ticket_id'),
						'message'	=> $postData['description'],
						'image'			=> $postData['image'],
						'created_date'		=> date('Y-m-d H:i:s')
					];

		$this->Basic->insertdata($support_ticket_replydata,'support_ticket_reply');	

		$ordersData=['status'=> $postData['status']];
	$this->Basic->updatedata($ordersData,['ticket_id' => $this->input->post('parent_id')],'tickets');

		$this->session->set_flashdata('msg', '<div class="alert alert-success">Reply Inserted Successfully</div>');	
          redirect($_SERVER['HTTP_REFERER']);
	   }
	}
	
	function replysupport(){
		 $ticket_id = $this->input->post('ticketId');
		if(!empty($ticket_id)){
			$data['supports'] 			= $this->support_model->getSupportById($ticket_id);
			$data['supportReply_list'] 	= $this->support_model->getSupportReplyById($ticket_id);
			echo $this->load->view('theme/myaccount/front/ajax/support_reply',$data,true);exit;
		}
	}
	
   function replyorderssupport(){
		
		 $user_id = $this->session->userdata('user_id');
		if(!empty($user_id)){
			
			$data['ordersnumberlist'] = $this->support_model->getOrdersSupportById($user_id);

				if($data['ordersnumberlist']){
					echo $this->load->view('theme/myaccount/front/ajax/add_orderlist_dropdown', $data,true);exit;
				} else {
					 echo "Fail";
				}			
			
		}
	} 
	
	function reply($id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
	   try
		{
        $data['title'] = 'Ticket Reply'; 
		$order = 'id'.' '.'asc';
		$where = array();
		$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');

		$where = array('ticket_id'=>$id);
        $data['tickets'] = $this->Basic->getsinglerow($where,'tickets');

        if(empty($id))
        {
		throw new Exception('Invalid Request');
	    }


	    $order = 'status_id'.' '.'asc';
		$where = array('type'=>'support');
		$support_status_all = $this->Basic->getmultiplerow($order,$where,'status');

        $support_status = $support_count = $support_status_output = [];
		foreach($support_status_all as $suppkey=>$supp)
		{
			$support_status[$supp->status_id] = $supp->status_name;
		}

		$data['support_status'] = $support_status;

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/ticketreply',$data);
		$this->load->view('theme/layout/footer',$data);
		  }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function deleteticket($id)
	{
	  if($id)
        {
            
            $data = ['is_delete'=>2];
            $where = array('ticket_id'=>$id);
            $this->Basic->updatedata($data,$where,'tickets');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Ticket has been  deleted Successfully</div>');
           //$where1 = array('support_id'=>$id);
           //$support = $this->Basic->getsinglerow($where1,'support');
            //addactivity($support->order_id,'Support','Support has been Deleted');
            //$this->session->set_userdata('tab','support');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}


		function priorityupdate()
	{
		try
		{
		 $ticket_id = $this->input->post('support_id');
		 $value = $this->input->post('value');
		 $type = $this->input->post('type');
		 $field = ($type=='1')?'status':'priority';
		 $postData[$field]	= $value;
		 $this->Basic->updatedata($postData,['ticket_id' => $ticket_id],'tickets');
		 }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


		function loadticket()
	{
	   try
		{
		$ticket_id = $this->input->post('ticket_id');

       	$order = 'id'.' '.'asc';
		$where = array();
		$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');

		$data['users'] = $this->User_model->getUserDetailById('','',5);

		$where = array('ticket_id'=>$ticket_id);
        $data['tickets'] = $this->Basic->getsinglerow($where,'tickets');

        $order = 'id'.' '.'desc';
		$where = array();
		$data['priority'] = $this->Basic->getmultiplerow($order,$where,'priority');


		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'support');
		$support_status_all = $this->Basic->getmultiplerow($order,$where,'status');

        $support_status = $support_count = $support_status_output = [];

		foreach($support_status_all as $suppkey=>$supp)
		{
			$support_status[$supp->status_id] = $supp->status_name;

			$support_status_output[$suppkey] =  $supp->status_name;
		}

		$data['support_status'] = $support_status;
		$data['support_status_output'] = $support_status_output;

        if(empty($ticket_id))
        {
		throw new Exception('Invalid Request');
	    }

        $this->load->view('theme/myaccount/loadtickets',$data);
         }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function multidelete()
	{
		  $RequestData = $this->input->post();
		 try
		{
          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
          		if(empty($id))
				{
				throw new Exception('Invalid Request');
				}

			$data = array('is_delete'=>2);
			$where = array('ticket_id'=>$id);
			$this->Basic->updatedata($data,$where,'tickets');
          	}
          }

			//$where1 = array('support_id'=>$id);
			//$support = $this->Basic->getsinglerow($where1,'support');
			//addactivity($support->order_id,'Support','Support has been Deleted');

       $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Tickets has been Deleted successfully</div>');
           redirect($_SERVER['HTTP_REFERER']);

             }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function departmentshow()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Department List';
        
    	$order = 'id'.'  '.'desc';
        $where = array();
        $data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');
        

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/supportdepart',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function adddepart()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
			$data['title'] = "Add Department";
			$data['subtitle'] = "Add Department";

			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/adddepart',$data);
			$this->load->view('theme/layout/footer',$data);
	}



	function savedept()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		
		$postData = $this->input->post();
		
		try{
			if(isset($postData['dept'])){
				if(!empty($postData['id']))	{
					unset($postData['save']);
					$id = $postData['id'];
					$this->Basic->updatedata($postData,['id' => $id],'support_depart');
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully</div>');
				}else{				
					$this->Basic->insertdata($postData,'support_depart');
				
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Inserted Successfully</div>');
				}
			}
			redirect('departmentshow');
		}
		catch(Exception $e){
			$message ="Invalid Request Exception ". $e->getMessage();
			$this->session->set_flashdata('message', $message);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	function editdepart($id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = "Update Department";
		$data['subtitle'] = "Update Department";
		
		$where = array('id'=>$id);
		$data['support_depart'] = $this->Basic->getsinglerow($where,'support_depart');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/editdepart',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function deletedepart($id)
	{
	   if($id)
        {
             $where = array('id'=>$id);
        $this->Basic->deletedata($where,'support_depart');

            $this->session->set_flashdata('msg', '<div class="alert alert-success">Department has been  deleted Successfully</div>');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}
}
