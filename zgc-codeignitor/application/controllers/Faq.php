<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		
		if(!$this->session->userdata('id')) {
			redirect('login');
		}
        
        $this->load->library('form_validation');
		
    }
	
	public function index()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'FAQ List';
        $role= $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');
        
    	$order = 'id'.'  '.'desc';
        $where = array();
        $data['faqbroker'] = $this->Basic->getmultiplerow($order,$where,'faqbroker');
        

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/faqlist',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function manageques()
	{
		
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Question Title List';
        
    	$order = 'id'.'  '.'desc';
        $where = array();
        $data['list'] = $this->Basic->getmultiplerow($order,$where,'faqbrokerquestype');


        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/faqlistques',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function addquestype()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		if($this->input->post('title'))
		{
			$data = array('title'=>$this->input->post('title'));
			$this->Basic->insertdata($data,'faqbrokerquestype');
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Question Type has been updated successfully</div>');
			redirect('Faq/manageques');

		}
			$data['title'] = "Add Type";
			$data['subtitle'] = "Add Type";


	      $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addquestype',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function  editfaqques($id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}	

			$data['title'] = 'Update Question';
       
               if($this->input->post('title'))
               {
                   	$data = array('title'=>$this->input->post('title'));
        			$where = array('id'=>$this->input->post('id'));
        			$this->Basic->updatedata($data,$where,'faqbrokerquestype');
        
                   	$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Question Type updated successfully</div>');
        					redirect('manageques');
               }
			$where = array('id'=>$id);
			$data['faqbrokerquestype'] = $this->Basic->getsinglerow($where,'faqbrokerquestype');

			 $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/editquestype',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function deletefaqques($id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
	     if($id)
        {
             $where = array('id'=>$id);
            $this->Basic->deletedata($where,'faqbrokerquestype');

			$this->session->set_flashdata('msg', '<div class="alert alert-success">Question Type has been  deleted Successfully</div>');
            redirect('Faq/manageques');    
        }	
	}

	function addfaq()
	{
        if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		 
		 if($this->input->post('title')){
		    
            $order = 'id'.'  '.'desc';
            $where = array();
            $faqbroker = $this->Basic->getmultiplerow($order,$where,'faqbroker');

            $neworder = count($faqbroker) + 1 ;
           
			$data = array('title'=>$this->input->post('title'),
				         'type'=>$this->input->post('type'),
				         'description'=>$this->input->post('description'),
				          'sort'=>$neworder);
			$this->Basic->insertdata($data,'faqbroker');
		
			
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">FAQ has been updated successfully</div>');
			redirect('Faq');

		}
			$data['title'] = "Add FAQ";
			$data['subtitle'] = "Add FAQ";

				$order = 'id'.'  '.'desc';
        $where = array();
        $data['questype'] = $this->Basic->getmultiplerow($order,$where,'faqbrokerquestype');


			 $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addfaq',$data);
		$this->load->view('theme/layout/footer',$data);

	}

	function editfaq($id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
        
		if($this->input->post('title'))
		{
			$data = array('title'=>$this->input->post('title'),
				         'type'=>$this->input->post('type'),
				         'description'=>$this->input->post('description'));

			$where = array('id'=>$this->input->post('id'));
        			$this->Basic->updatedata($data,$where,'faqbroker');
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">FAQ has been updated successfully</div>');
			redirect('Faq');

		}
			$data['title'] = "Add FAQ";
			$data['subtitle'] = "Add FAQ";
			
			$order = 'id'.'  '.'desc';
			$where = array();
			$data['questype'] = $this->Basic->getmultiplerow($order,$where,'faqbrokerquestype');
			
			$where = array('id'=>$id);
			$data['faqbroker'] = $this->Basic->getsinglerow($where,'faqbroker');
			
			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/editfaq',$data);
			$this->load->view('theme/layout/footer',$data);
				
	}

	function deletefaq($id)
	{
		 if($id){
             $where = array('id'=>$id);
            $this->Basic->deletedata($where,'faqbroker');

			$this->session->set_flashdata('msg', '<div class="alert alert-success">FAQ has been  deleted Successfully</div>');
            redirect('Faq');    
        }	
	}


	function delete($id) 
	{
        $where = array('id'=>$id);
        $this->Basic->deletedata($where,'sms_template');
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Subject Deleted Successfully</div>');
        
       redirect('Subject');
    }
	
	  function edit($id) 
	  {
            $data['title'] = 'Update Subject';
       
               if($this->input->post('subject'))
               {
                   	$data = array('subject'=>$this->input->post('subject'),'message'=>$this->input->post('message'));
        			$where = array('id'=>$this->input->post('id'));
        			$this->Basic->updatedata($data,$where,'sms_template');
        
                   	$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Subject updated successfully</div>');
        				redirect('Subject');
               }
			$where = array('id'=>$id);
			$data['smstemplate'] = $this->Basic->getsinglerow($where,'sms_template');
			 $this->load->view('admin/subject/edit',$data);
       }
       
       
     function updateorder()
    {
         $id = $this->input->post('id');
         $value = $this->input->post('value');
          $type = $this->input->post('type');

          $where = array('sort'=>$value,'type'=>$type);
          $product_category = $this->Basic->getsinglerow($where,'faqbroker');
          
          $where = array('id'=>$id,'type'=>$type);
          $oldproduct_category = $this->Basic->getsinglerow($where,'faqbroker');
          
           $updata_old = ['sort'=>$oldproduct_category->sort];
           $where1 = array('id'=>$product_category->id,'type'=>$type);
           $resulthwre = $this->Basic->updatedata($updata_old,$where1,'faqbroker');


           $updatafdata = ['sort'=>$value];
           $where1 = array('id'=>$id,'type'=>$type);
           $result = $this->Basic->updatedata($updatafdata,$where1,'faqbroker');

           echo $product_category->id.'--'.$oldproduct_category->sort;
    }
    
    
    
         function updateordermanage()
    {
         $id = $this->input->post('id');
         $value = $this->input->post('value');

          $where = array('sort'=>$value);
          $product_category = $this->Basic->getsinglerow($where,'faqbrokerquestype');
          
          $where = array('id'=>$id);
          $oldproduct_category = $this->Basic->getsinglerow($where,'faqbrokerquestype');
          
           $updata_old = ['sort'=>$oldproduct_category->sort];
           $where1 = array('id'=>$product_category->id);
           $resulthwre = $this->Basic->updatedata($updata_old,$where1,'faqbrokerquestype');


           $updatafdata = ['sort'=>$value];
           $where1 = array('id'=>$id);
           $result = $this->Basic->updatedata($updatafdata,$where1,'faqbrokerquestype');

           echo $product_category->id.'--'.$oldproduct_category->sort;
    }
     
     
}
