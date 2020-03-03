<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$this->load->helper('url');
		$this->load->library('upload');
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
                $postData["image"] = base_url('/uploads/support/'.$img_unique);
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
				$ordersData=[
					'user_id' 		=> $this->session->userdata('user_id'),
					'order_id'		=> $postData['order_id'],
		'parent_id'	=> (($this->input->post('parent_id'))?$this->input->post('parent_id'):'0'),
					'subject'		=> $postData['subject'],
					'description'	=> $postData['description'],
					'priority'		=> $postData['priority'],
					'status' => (($this->input->post('status'))?$this->input->post('status'):'13'),
					'image'		=> $postData['image'],
					'department'=>	$postData['department'],
					'datetime'	=> date('Y-m-d H:i:s')
				];
				if(!empty($postData['support_id']))	
				{
					$this->Basic->updatedata($ordersData,['support_id' => $postData['support_id']],'support');
					 addactivity($postData['order_id'],'Support','Support has been Updated');

					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully</div>');

				}else{				
					$supportid = $this->Basic->insertdata($ordersData,'support');
					addactivity($postData['order_id'],'Support','Support has been Inserted');


					//$this->Myaccount_model->addsupportemail($supportid);

					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Inserted Successfully</div>');
				}


				if($this->session->userdata('user_type')==1)
				redirect($_SERVER['HTTP_REFERER']);
				else
				echo "success";die;

				$this->session->set_userdata('tab','support');
				redirect($_SERVER['HTTP_REFERER']);

			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');

					if($this->session->userdata('user_type')==1)
					redirect($_SERVER['HTTP_REFERER']);
					else
					echo "failed";die;
		}
	}


	function priorityupdate()
	{
		try
		{
		 $support_id = $this->input->post('support_id');
		 $value = $this->input->post('value');
		 $type = $this->input->post('type');
		 $field = ($type=='1')?'status':'priority';
		 $postData[$field]	= $value;
		 $this->Basic->updatedata($postData,['support_id' => $support_id],'support');
		 }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function loadsupport()
	{
	   try
		{
		$support_id = $this->input->post('support_id');

       	$order = 'id'.' '.'asc';
		$where = array();
		$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');

		$where = array('support_id'=>$support_id);
        $data['support'] = $this->Basic->getsinglerow($where,'support');

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

        if(empty($support_id))
        {
		throw new Exception('Invalid Request');
	    }

        $this->load->view('theme/myaccount/loadsupport',$data);
         }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function deletesupport($id)
	{
	  if($id)
        {
            
            $data = ['is_delete'=>2];
            $where = array('support_id'=>$id);
            $this->Basic->updatedata($data,$where,'support');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Support has been  deleted Successfully</div>');
           $where1 = array('support_id'=>$id);
           $support = $this->Basic->getsinglerow($where1,'support');
            addactivity($support->order_id,'Support','Support has been Deleted');
            $this->session->set_userdata('tab','support');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}


	function  deletesupportreply()
	{
		$id = $this->input->post('support_id');
		  if($id)
        {
            
            $data = ['is_delete'=>2];
            $where = array('support_id'=>$id);
            $this->Basic->updatedata($data,$where,'support');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Support has been  deleted Successfully</div>');
           $where1 = array('support_id'=>$id);
           $support = $this->Basic->getsinglerow($where1,'support');
            addactivity($support->order_id,'Support','Support has been Deleted');
            $this->session->set_userdata('tab','support');

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
			$where = array('support_id'=>$id);
			$this->Basic->updatedata($data,$where,'support');
          	}
          }

			$where1 = array('support_id'=>$id);
			$support = $this->Basic->getsinglerow($where1,'support');
			addactivity($support->order_id,'Support','Support has been Deleted');

       $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Support has been Deleted successfully</div>');
       $this->session->set_userdata('tab','support');
           redirect($_SERVER['HTTP_REFERER']);

             }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function replyus()
	{
        try
		{
	    $id = $this->input->post('support_id');

		$order = 'id'.' '.'asc';
		$where = array();
		$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');

		$where = array('support_id'=>$id);
        $data['support'] = $this->Basic->getsinglerow($where,'support');



        $data['order_dynamic_block'] 	= $this->Global_model->getOrderBlockListbyOrderId($data['support']->order_id);

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

		echo  $this->load->view('theme/myaccount/supportreplyus',$data,true);

		  }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function reply($id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
	   try
		{
        $data['title'] = 'Support Reply'; 
		$order = 'id'.' '.'asc';
		$where = array();
		$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');

		$where = array('support_id'=>$id);
        $data['support'] = $this->Basic->getsinglerow($where,'support');

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


		$dataupdatestatus = ['status'=>2];
		$wherestatus = array('support_id'=>$id,'user_id !='=>$this->session->userdata('user_id'));
		$this->Basic->updatedata($dataupdatestatus,$wherestatus,'support_support_reply');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/supportreply',$data);
		$this->load->view('theme/layout/footer',$data);
		  }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function replysave()
	{
		$postData = $this->input->post();
		
		if(isset($postData['parent_id']))
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
                $postData["image"] = base_url('/uploads/support/'.$img_unique);
                }
	       }
	       else
	       {
	       	 $postData["image"] ='';
	       } 

	       $support_ticket_replydata=[
						'user_id' 		=> $this->session->userdata('user_id'),
						'support_id'		=> $this->input->post('parent_id'),
						'order_id'		=> $this->input->post('order_id'),
						'message'	=> $postData['description'],
						'image'			=> $postData['image'],
						'created_date'		=> date('Y-m-d H:i:s')
					];

		$this->Basic->insertdata($support_ticket_replydata,'support_support_reply');	

  if($postData['status'])
  {
		$ordersData=['status'=> $postData['status']];
	$this->Basic->updatedata($ordersData,['support_id' => $this->input->post('parent_id')],'support');

	  }

			$this->session->set_flashdata('msg', '<div class="alert alert-success">Reply Inserted Successfully</div>');	
          redirect($_SERVER['HTTP_REFERER']);
	   }
	}

	

}
