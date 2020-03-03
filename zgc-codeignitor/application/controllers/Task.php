<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$this->load->helper('url');
	}



	function save(){
		try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){

	       $postData['created_by'] = $this->session->userdata('user_id');
	       unset($postData['task_relate']);
				if(!empty($postData['task_id'])){
					$postData['last_update_date']	= date('Y-m-d H:i:s');
					$postData['start_date']	= date("Y-m-d", strtotime($this->input->post('start_date')));
					$postData['due_date']	= date("Y-m-d", strtotime($this->input->post('due_date')));
					$postData['order_detail_ids']	= $postData['related_to'];
					$this->Basic->updatedata($postData,['task_id' => $postData['task_id']],'task');
					addactivity($postData['order_id'],'Task','Task has been Updated');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
				}else{
					$postData['created_date']			= date('Y-m-d H:i:s');
					$postData['last_update_date']	= date('Y-m-d H:i:s');
				    $postData['start_date']	= date("Y-m-d", strtotime($this->input->post('start_date')));
					$postData['due_date']	= date("Y-m-d", strtotime($this->input->post('due_date')));
					$postData['order_detail_ids']	= $postData['related_to'];
					$task_id = $this->Basic->insertdata($postData,'task');

					$this->Myaccount_model->taskemail($task_id);

					addactivity($postData['order_id'],'Task','Task has been Added');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Added Successfully</div>');
				}
				$this->session->unset_userdata('task_flag');
				$this->session->set_userdata('tab','task');
				  //echo $this->session->userdata('tab'); die;
				redirect($_SERVER['HTTP_REFERER']);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function multitaskdelete()
	{
		
		 $RequestData = $this->input->post();

          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
			$data = array('is_delete'=>2);
			$where = array('task_id'=>$id);
			$this->Basic->updatedata($data,$where,'task');
          	}
          }

           $where = array('task_id'=>$id);
           $task = $this->Basic->getsinglerow($where,'task');

          addactivity($task->order_id,'Task','Multi Task has been Deleted');
          $this->session->set_userdata('tab','task');

          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Task has been Deleted successfully</div>');

           redirect($_SERVER['HTTP_REFERER']);
	}


	function deletetask($id)
	{
	  if($id)
        {
            $data = ['is_delete'=>2];
            $where = array('task_id'=>$id);
            $this->Basic->updatedata($data,$where,'task');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Task has been  deleted Successfully</div>');
           $where = array('task_id'=>$id);
           $task = $this->Basic->getsinglerow($where,'task');
            addactivity($task->order_id,'Task','Task has been Deleted');
            $this->session->set_userdata('tab','task');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}


	function loadtask()
	{
        $task_id = $this->input->post('task_id');

		$where = array('task_id'=>$task_id);
        $data['task'] = $this->Basic->getsinglerow($where,'task');

        $order = 'id'.' '.'desc';
		$where = array();
		$data['priority'] = $this->Basic->getmultiplerow($order,$where,'priority');


	$data['order_dynamic_block'] = $this->Product_model->getdynamicBlockByOrderId($data['task']->order_id);

	$data['ordersrow'] = $this->Project_model->getallorders('',$data['task']->order_id);
	$data['orders']  = $data['ordersrow'][0]; 

		// task status count
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'task');
		$task_status_all = $this->Basic->getmultiplerow($order,$where,'status');

		$task_status=[];

		if($task_status_all)
		{
			foreach ($task_status_all as $key => $task) 
			{
        $task_status[$task->status_id] =  $task->status_name;
			}
		}

		$data['task_status'] = $task_status;

        $this->load->view('theme/myaccount/loadtask',$data);
	}


	function statuspriority()
	{
		 $task_id = $this->input->post('task_id');
		 $value = $this->input->post('value');
		 $type = $this->input->post('type');
		 $field = ($type=='1')?'task_status':'priority';
		 $postData[$field]	= $value;
		 $this->Basic->updatedata($postData,['task_id' => $task_id],'task');
	}


	function statuspriorityfinal()
	{
		 $task_id = $this->input->post('task_id');
		 $value = $this->input->post('value');
		 $type = $this->input->post('type');
		 $field = ($type=='1')?'task_status':'priority';
		 $postData[$field]	= $value;
		 $this->Basic->updatedata($postData,['task_id' => $task_id],'task');

		 $where = array('task_id'=>$task_id);
         $task = $this->Basic->getsinglerow($where,'task');

         if($value==27)
         {
         $updatedata['flag']	= 0;
$this->Basic->updatedata($updatedata,['order_id' =>$task->order_id,'block_id'=>$task->related_to],'order_detail');
         }
	}


}
