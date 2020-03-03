<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$this->load->helper('url');
		$this->load->library('upload');
		$this->load->model('notes_model');
	}


	function save(){
		try{
			$postData = $this->input->post();
			if(isset($postData['subject']))
			{
				$order_id 	= $postData['order_id'];
				$subject 	= $postData['subject'];
				$parent_id 	= $postData['parent_id'] ?? 0;
				$notes 		= $postData['notes'];
				$is_client_enabled 	= $postData['is_client_enabled'] ?? 0;
				$is_broker_enabled 	= $postData['is_broker_enabled'] ?? 0;
				
				$ordersData=[
					'order_id'	=> $order_id,
					'subject'	=> $subject,
					'parent_id'	=> (($parent_id) ? $parent_id:'0'),
					'user_type_id'	=> $this->session->userdata('user_type'),
					'notes'		=> $notes,
					'added_by'	=> $this->session->userdata('user_id'),
					'datetime'	=> date('Y-m-d H:i:s'),
					'is_client_enabled'	=> $is_client_enabled,
					'is_broker_enabled'	=> $is_broker_enabled
				];
				
				if(!empty($postData['notes_id'])){
					$this->Basic->updatedata($ordersData,['notes_id' => $postData['notes_id']],'notes');
					 addactivity($order_id,'Notes','Notes has been Updated');
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully</div>');;
				}else{		
						//$newTime = strtotime('-15 minutes');
						//echo date('Y-m-d H:i:s', $newTime);
						///exit;
					//$checkDuplicateNotes = $this->Basic->getsinglerow(['order_id' => $order_id,'added_by' => $this->session->userdata('user_id'),'subject' => $subject,'datetime' => ],'notes');
						$notesid = $this->Basic->insertdata($ordersData,'notes');
						addactivity($order_id,'Notes','Notes has been Inserted');
						$this->Myaccount_model->addnotesemail($notesid);
						$this->session->set_flashdata('msg', '<div class="alert alert-success">Record added Successfully</div>');
				}
				if($this->session->userdata('user_type')==1)
					redirect($_SERVER['HTTP_REFERER']);
				else
					echo "success";die;
				
				$this->session->set_userdata('tab','notes');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');

			if($this->session->userdata('user_type')==1)
			redirect($_SERVER['HTTP_REFERER']);
			else
			echo "success";die;
		}
	}


	function loadnotes()
	{
	   try
		{
		$notes_id = $this->input->post('notes_id');

		$where = array('notes_id'=>$notes_id);
        $data['notes'] = $this->Basic->getsinglerow($where,'notes');

        if(empty($notes_id))
        {
		throw new Exception('Invalid Request');
	    }

        $this->load->view('theme/myaccount/loadnotes',$data);
         }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function deletenotes($id)
	{
	  if($id)
        {
            $data = ['is_delete'=>2];
            $where = array('notes_id'=>$id);
            $this->Basic->updatedata($data,$where,'notes');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Notes has been  deleted Successfully</div>');
           $where1 = array('notes_id'=>$id);
           $notes = $this->Basic->getsinglerow($where1,'notes');
            addactivity($notes->order_id,'Notes','Notes has been Deleted');
            $this->session->set_userdata('tab','notes');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}

	function deletesupportreply()
	{
		$id = $this->input->post('notes_id');

	   if($id)
        {
            $data = ['is_delete'=>2];
            $where = array('notes_id'=>$id);
            $this->Basic->updatedata($data,$where,'notes');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Notes has been  deleted Successfully</div>');
           $where1 = array('notes_id'=>$id);
           $notes = $this->Basic->getsinglerow($where1,'notes');
            addactivity($notes->order_id,'Notes','Notes has been Deleted');
            $this->session->set_userdata('tab','notes');
          
            if($this->session->userdata('user_type')==1)
			redirect($_SERVER['HTTP_REFERER']);
			else
			echo "success";die;
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
			$where = array('notes_id'=>$id);
			$this->Basic->updatedata($data,$where,'notes');


          	}
          }

			$where1 = array('notes_id'=>$id);
			$notes = $this->Basic->getsinglerow($where1,'notes');
			addactivity($notes->order_id,'Notes','Multi Notes has been Deleted');
			$this->session->set_userdata('tab','notes');

       $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Notes has been Deleted successfully</div>');
           redirect($_SERVER['HTTP_REFERER']);

             }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function loadnotesview()
	{
          $notes_id = $this->input->post('notes_id');

          $where1 = array('notes_id'=>$notes_id);
          $data['notes'] = $this->Basic->getsinglerow($where1,'notes');


        $order = 'notes_id'.' '.'desc';
		$where = array('is_delete'=>1,'parent_id'=>$notes_id);
		$data['notescomments'] = $this->Basic->getmultiplerow($order,$where,'notes');

          echo $this->load->view('theme/myaccount/viewnotes',$data,true);
	}
	
	function replynotes(){
		$notes_id = $this->input->post('notes_id');
		if(!empty($notes_id)){
			$data['notes'] = $this->notes_model->getNoteById($notes_id);
			$data['notesReply_list'] = $this->notes_model->getNoteReplyById($notes_id);
			echo $this->load->view('theme/myaccount/replynotes',$data,true);
		}
	}
	
	function replyadminnotes($notes_id){
		
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Notes Reply'; 
		$where = array('notes_id'=>$notes_id);
        $data['notes'] = $this->Basic->getsinglerow($where,'notes');
        $data['notescomments'] = $this->Project_model->getallnotesreply($notes_id);
        $dataupdatestatus = ['status'=>2];
		$wherestatus = array('notes_id'=>$notes_id,'user_id !='=>$this->session->userdata('user_id'));
		$this->Basic->updatedata($dataupdatestatus,$wherestatus,'notes_reply');
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/notesreply',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	
	function replysave()
	{
		$postData = $this->input->post();
		if(isset($postData['notes_id'])){
			 $support_ticket_replydata=[
				'user_id' 		=> $this->session->userdata('user_id'),
				'notes_id'		=> $this->input->post('notes_id'),
				'order_id'		=> $this->input->post('order_id'),
				'message'		=> $postData['description'],
				'created_date'	=> date('Y-m-d H:i:s')
			];
			$this->Basic->insertdata($support_ticket_replydata,'notes_reply');
			
			$this->session->set_flashdata('msg', '<div class="alert alert-success">Reply added Successfully</div>');	
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
