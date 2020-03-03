<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

	if(!$this->session->userdata('user_id')) {
			redirect('login');
		}

	}
	
	function servicemanage()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		try{
			$data['title'] = 'Service Manage'; 
			$order = 'id'.' '.'desc';
			$where = array('status <>'=>2);
			$service = $this->Basic->getmultiplerow($order,$where,'service');


	 $head = ['Service','Actions'];
	     $headrows = [];


		   foreach($service as $stat)
	      {
      $headrows[] = [$stat->id,$stat->service,'<a class="btn btn-success btn-xs" href='.base_url('copyservice/'.$stat->id).' data-original-title="btn btn-danger btn-xs" title="">Copy</a>

     <a class="btn btn-success btn-xs" href='.base_url('addservice/'.$stat->id).' data-original-title="btn btn-danger btn-xs" title="">Edit</a>

     <a class="btn btn-danger btn-xs"  href='.base_url('service/deleteservice/'.$stat->id).' onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>'];
	      }


	      $datas3333['formaction'] = base_url('Service/multideleteservice');
	      $datas3333['head'] = $head;
	      $datas3333['headrows'] = $headrows;

		 $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/dynamictable',$datas3333);
		$this->load->view('theme/layout/footer',$data);
      }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function addservice($id='')
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
          if($id)
			{
			$data['title'] 		= 'Update Service';
	        $data['subtitle'] 	= 'Update Service';

			$where = array('id' => $id);
            $data['service'] = $this->Basic->getsinglerow($where,'service');
			}
			else
			{	
			$data['title'] 		= 'Create New Service';
	        $data['subtitle'] 	= 'Create New Service';
	        }

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addservice',$data);
		$this->load->view('theme/layout/footer',$data);
	}


		function save()
	{
		$postData = $this->input->post();
		
		try{
			if(isset($postData['service'])){
				if(!empty($postData['id']))	{
					unset($postData['save']);
					$id = $postData['id'];
					$this->Basic->updatedata($postData,['id' => $id],'service');
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully</div>');
				}else{
					$result= $this->Basic->select('service',array('service'=>$postData['service'],'id'));
					if(isset($result) && !empty($result)){
						throw new Exception('Service already Exist');
					}
					unset($postData['save']);					
					$this->Basic->insertdata($postData,'service');
				
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Inserted Successfully</div>');
				}
			}
			
			redirect('servicemanage');
		}
		catch(Exception $e){
			$message ="Invalid Request Exception ". $e->getMessage();
			$this->session->set_flashdata('message', $message);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}


	function copyservice($id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] 		= 'Copy Service';
		$data['subtitle'] 	= 'Copy Service';

		$where = array('id' => $id);
		$data['service'] = $this->Basic->getsinglerow($where,'service');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addservice',$data);
		$this->load->view('theme/layout/footer',$data);
	}



	function deleteservice($id) 
	{
        $where = array('id'=>$id);
        $this->Basic->deletedata($where,'service');
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Service Deleted Successfully</div>');
        
      redirect($_SERVER['HTTP_REFERER']);
    }


    function multideleteservice()
    {
           $RequestData = $this->input->post();

          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
			$data = array('status'=>2);
			$where = array('id'=>$id);
			$this->Basic->updatedata($data,$where,'service');
          	}
          }

          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Service has been Deleted successfully</div>');

           redirect($_SERVER['HTTP_REFERER']);
    }

    function providermanage()
    {
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
    	try{
			$data['title'] = 'Provider Manage'; 
			$order = 'id'.' '.'desc';
			$where = array('status <>'=>2);
			$provider = $this->Basic->getmultiplerow($order,$where,'provider');

			$order = 'id'.' '.'desc';
			$where = array('status <>'=>2);
			$service = $this->Basic->getmultiplerow($order,$where,'service');

			$servicearray = [];

			foreach($service as $ser)
			{
			$servicearray[$ser->id] = $ser->service;
			}


		$head = ['Service','Provider','Actions'];
	     $headrows = [];

		   foreach($provider as $stat){
			  $headrows[] = [$stat->id,$servicearray[$stat->service_id],$stat->provider,'<a class="btn btn-success btn-xs" href='.base_url('copyprovider/'.$stat->id).' data-original-title="btn btn-danger btn-xs" title="">Copy</a>

			 <a class="btn btn-success btn-xs" href='.base_url('addprovider/'.$stat->id).' data-original-title="btn btn-danger btn-xs" title="">Edit</a>

			 <a class="btn btn-danger btn-xs"  href='.base_url('service/deleteprovider/'.$stat->id).' onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>'];
	      }


	      $datas3333['formaction'] = base_url('Service/multideleteprovider');
	      $datas3333['head'] = $head;
	      $datas3333['headrows'] = $headrows;

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/dynamictable',$datas3333);
		$this->load->view('theme/layout/footer',$data);
      }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
    }



    function addprovider($id='')
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
          if($id)
			{
			$data['title'] 		= 'Update Provider';
	        $data['subtitle'] 	= 'Update Provider';

			$where = array('id' => $id);
            $data['provider'] = $this->Basic->getsinglerow($where,'provider');
			}
			else
			{	
			$data['title'] 		= 'Create New Provider';
	        $data['subtitle'] 	= 'Create New Provider';
	        }

	        $order = 'id'.' '.'desc';
			$where = array('status <>'=>2);
			$data['service'] = $this->Basic->getmultiplerow($order,$where,'service');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addprovider',$data);
		$this->load->view('theme/layout/footer',$data);
	}


		function saveprovider()
	{
		$postData = $this->input->post();
		
		try{
			if(isset($postData['provider'])){
				if(!empty($postData['id']))	{
					unset($postData['save']);
					$id = $postData['id'];
					$this->Basic->updatedata($postData,['id' => $id],'provider');
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully</div>');
				}else{
					$result= $this->Basic->select('service',array('service'=>$postData['service'],'id'));
					if(isset($result) && !empty($result)){
						throw new Exception('Provider already Exist');
					}
					unset($postData['save']);					
					$this->Basic->insertdata($postData,'provider');
				
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Inserted Successfully</div>');
				}
			}
			
			redirect('providermanage');
		}
		catch(Exception $e){
			$message ="Invalid Request Exception ". $e->getMessage();
			$this->session->set_flashdata('message', $message);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}


		function copyprovider($id)
		{
			if($this->session->userdata('user_type')!=1){
				redirect('order/myaccount');
			}
			
			$data['title'] 		= 'Copy Provider';
			$data['subtitle'] 	= 'Copy Provider';

			$where = array('id' => $id);
			$data['provider'] = $this->Basic->getsinglerow($where,'provider');

			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/addprovider',$data);
			$this->load->view('theme/layout/footer',$data);
	}


	function deleteprovider($id) 
	{
    	$data = array('status'=>2);
		$where = array('id'=>$id);
		$this->Basic->updatedata($data,$where,'provider');
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Provider Deleted Successfully</div>');
        
      redirect($_SERVER['HTTP_REFERER']);
    }


    function multideleteprovider()
    {
           $RequestData = $this->input->post();

          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
			$data = array('status'=>2);
			$where = array('id'=>$id);
			$this->Basic->updatedata($data,$where,'provider');
          	}
          }

          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Provider has been Deleted successfully</div>');

           redirect($_SERVER['HTTP_REFERER']);
    }

	function getServiceList(){
		$categoryId = $this->input->post('category_id');
		$servicetext='<option value="">Select Services</option>';
		if(!empty($categoryId)){
			$order = 'id'.' '.'ASC';
			$service = $this->Basic->getmultiplerow($order,['status' => 'Y','cat_id' => $categoryId],'rzvy_services');
			foreach($service as $getservice){
				$servicetext.='<option value="'.$getservice->id.'">'.strtoupper($getservice->title).'</option>';
			} 
		}
		echo $servicetext;
	}
	
	
}
