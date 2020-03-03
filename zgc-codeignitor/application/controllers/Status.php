<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
	}
	
	function statusmanage()
	{
		try{
			$data['title'] = 'Status Manage List'; 
			$order = 'status_id'.' '.'desc';
			$where = array('status <>'=>2,'type <>'=>'payment');
			$status = $this->Basic->getmultiplerow($order,$where,'status');

			$type = ['order'=>'Order','payment'=>'Payment','task'=>'Task','support'=>'Support'];

	 $head = ['Type','Status','Actions'];
	     $headrows = [];


		      foreach($status as $stat)
	      {
               $headrows[] = [$stat->status_id,$type[$stat->type],$stat->status_name,'<a class="btn btn-success btn-xs" href='.base_url('copystatus/'.$stat->status_id).' data-original-title="btn btn-danger btn-xs" title="">Copy</a>

               <a class="btn btn-success btn-xs" href='.base_url('addstatus/'.$stat->status_id).' data-original-title="btn btn-danger btn-xs" title="">Edit</a>

                          <a class="btn btn-danger btn-xs"  href='.base_url('status/deletestatus/'.$stat->status_id).' onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>'];
	      }


	      $datas3333['formaction'] = base_url('Status/multideletestatus');
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


	function addstatus($id='')
	{
          if($id)
			{
			$data['title'] 		= 'Update Status';
	        $data['subtitle'] 	= 'Update Status';

			$where = array('status_id' => $id);
            $data['status'] = $this->Basic->getsinglerow($where,'status');
			}
			else
			{	
			$data['title'] 		= 'Create New Status';
	        $data['subtitle'] 	= 'Create New Status';
	        }

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addstatus',$data);
		$this->load->view('theme/layout/footer',$data);
	}


		function save()
	{
		$postData = $this->input->post();
		try{
			if(isset($postData['status_name'])){
				if(!empty($postData['status_id']))	{
					unset($postData['save']);
					$status_id = $postData['status_id'];
					$this->Basic->updatedata($postData,['status_id' => $status_id],'status');
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Updated Successfully</div>');
				}else{
					$result= $this->Basic->select('status',array('status_name'=>$postData['status_name'],'type'=>$postData['type']));
					if(isset($result) && !empty($result)){
						throw new Exception('Status already Exist');
					}
					unset($postData['save']);					
					$this->Basic->insertdata($postData,'status');
				
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Record Inserted Successfully</div>');
				}
			}
			redirect('statusmanage');
		}
		catch(Exception $e){
			$message ="Invalid Request Exception ". $e->getMessage();
			$this->session->set_flashdata('message', $message);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}


	function copystatus($id)
	{
			$data['title'] 		= 'Copy Status';
	        $data['subtitle'] 	= 'Copy Status';

			$where = array('status_id' => $id);
            $data['status'] = $this->Basic->getsinglerow($where,'status');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addstatus',$data);
		$this->load->view('theme/layout/footer',$data);
	}



	function deletestatus($id) 
	{
        $where = array('status_id'=>$id);
        $this->Basic->deletedata($where,'status');
        
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Status Deleted Successfully</div>');
        
      redirect($_SERVER['HTTP_REFERER']);
    }


    function multideletestatus()
    {
           $RequestData = $this->input->post();

          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
			$data = array('status'=>2);
			$where = array('status_id'=>$id);
			$this->Basic->updatedata($data,$where,'status');
          	}
          }

          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Status has been Deleted successfully</div>');

           redirect($_SERVER['HTTP_REFERER']);
    }

    function appoinmentshow()
    {
    	try{
			$data['title'] = 'Status Manage List'; 
			$order = 'id'.' '.'desc';
			$where = array('status <>'=>3);
			$data['appointment'] = $this->Basic->getmultiplerow($order,$where,'appointment');

			$data['status'] = ['0'=>'New Appoinment','1'=>'Approved','2'=>'Rejected'];

			$order = 'id'.' '.'desc';
			$where = array('status <>'=>2);
			$service = $this->Basic->getmultiplerow($order,$where,'service');

			$servicearray = [];

			foreach($service as $ser)
			{
			$servicearray[$ser->id] = $ser->service;
			}

			$order = 'id'.' '.'desc';
			$where = array('status <>'=>2);
			$provider = $this->Basic->getmultiplerow($order,$where,'provider');

			$providerarray = [];

			foreach($provider as $ser)
			{
			$providerarray[$ser->id] = $ser->provider;
			}

			$data['servicearray'] = $servicearray; 

			$data['providerarray']  = $providerarray;

		 $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/appoinmentshow',$data);
		$this->load->view('theme/layout/footer',$data);
      }catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
    }


    function changeappoinstatus()
    {
    	 $appoinid = $this->input->post('appoinid');
    	 $value = $this->input->post('value');
    	 $postData['status'] = $value;
		 $this->Basic->updatedata($postData,['id' => $appoinid],'appointment');
    }


        function viewappoin()
    {
    	    $appoinid = $this->input->post('appoinid');
    	 	$where = array('id' => $appoinid);
            $data['appointment'] = $this->Basic->getsinglerow($where,'appointment');

            $data['status'] = ['0'=>'New Appoinment','1'=>'Approved','2'=>'Rejected'];

			$order = 'id'.' '.'desc';
			$where = array('status <>'=>2);
			$service = $this->Basic->getmultiplerow($order,$where,'service');

			$servicearray = [];

			foreach($service as $ser)
			{
			$servicearray[$ser->id] = $ser->service;
			}

			$order = 'id'.' '.'desc';
			$where = array('status <>'=>2);
			$provider = $this->Basic->getmultiplerow($order,$where,'provider');

			$providerarray = [];

			foreach($provider as $ser)
			{
			$providerarray[$ser->id] = $ser->provider;
			}

			$data['servicearray'] = $servicearray; 

			$data['providerarray']  = $providerarray;


             echo $this->load->view('theme/myaccount/loadappoinment',$data,true);
    }


    function deleteappoin($id)
    {
            $data = array('status'=>3);
			$where = array('id'=>$id);
			$this->Basic->updatedata($data,$where,'appointment');

        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Appoinment Deleted Successfully</div>');
        
      redirect($_SERVER['HTTP_REFERER']);
    }



        function multideleteappoinment()
    {
           $RequestData = $this->input->post();

          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
			$data = array('status'=>3);
			$where = array('id'=>$id);
			$this->Basic->updatedata($data,$where,'appointment');
          	}
          }

          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Appoinment has been Deleted successfully</div>');

           redirect($_SERVER['HTTP_REFERER']);
    }
	
	
}
