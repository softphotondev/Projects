<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('id')) {
			redirect('login');
		}
		
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}

		$this->load->helper('url');
	}

	function index(){

		$data['title'] = 'Dashbaord';
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/dashboard',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	
	function myaccount()
	{
		$data['title'] = 'Myaccount';
		$data['activeclients'] = $this->Myaccount_model->getActiveClients();
		$data['newclients'] = $this->Myaccount_model->getNewClients();
		$data['totalsale'] = $this->Myaccount_model->getTotalSale();
		$data['totalorders'] = $this->Myaccount_model->getTotalOrders();
		$data['totalbrokers'] = $this->Myaccount_model->getTotalBrokers();
		$data['ticket'] = $this->Myaccount_model->tickets_dashboard();	
		
		$data['support_status_output'] = $this->Myaccount_model->support_button();
		$data['support_count'] = $this->Myaccount_model->support_button_count();
		$data['title'] = 'Myaccount';
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/dashboard',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function lettertemplates()
	{
        $data['title'] = 'Letter Templates';
		$order = 'id'.' '.'asc';
		$where = array();
		$data['letter'] = $this->Basic->getmultiplerow($order,$where,'letter_templates');
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/letter',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function addletters()
	{
		$data['title'] = 'Add Letter Templates';

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/addletter',$data);
		$this->load->view('theme/layout/footer',$data);
	}



	function save()
	{
		try{
			$postData = $this->input->post();

			if(isset($postData['subject']))
			{
		$ordersData=[
					'subject'		=> $postData['subject'],
					'message'		=> $postData['message']
				    ];

				if(!empty($postData['id']))	
				{
					$this->Basic->updatedata($ordersData,['id' => $postData['id']],'letter_templates');
					 
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Letter Templates  Updated Successfully</div>');;
				}else{				
					$notesid = $this->Basic->insertdata($ordersData,'letter_templates');

				$this->session->set_flashdata('msg', '<div class="alert alert-success">Letter Templates has been added Successfully</div>');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
					redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function editletters($id)
	{
		$data['title'] = 'Update Letter Templates';

		$where = array('id'=>$id);
        $data['letter'] = $this->Basic->getsinglerow($where,'letter_templates');

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editletters',$data);
		$this->load->view('theme/layout/footer',$data);
	}



	function deleteletters($id)
	{
	  if($id)
        {
            $where = array('id'=>$id);
            $this->Basic->deletedata($where,'letter_templates');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Letter Templates has been deleted Successfully</div>');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}


	function marketemail()
	{
		$data['title'] = 'Marketing Letter Templates';
		$order = 'id'.' '.'asc';
		$where = array();
		$data['marketing'] = $this->Basic->getmultiplerow($order,$where,'marketing_email_templates');
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/market',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function editmarkets($id)
	{
		$data['title'] = 'Update Marketing Letter Templates';

		$where = array('id'=>$id);
        $data['market'] = $this->Basic->getsinglerow($where,'marketing_email_templates');

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editmarket',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function marketsave()
	{
		try{
			$postData = $this->input->post();

			if(isset($postData['subject']))
			{
		$ordersData=[
					'subject'		=> $postData['subject'],
					'message'		=> $postData['message']
				    ];

				if(!empty($postData['id']))	
				{
					$this->Basic->updatedata($ordersData,['id' => $postData['id']],'marketing_email_templates');
					 
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Marketing Letter Templates  Updated Successfully</div>');;
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}



	function smstemplates()
	{
	    $data['title'] = 'SMS Templates';
		$order = 'id'.' '.'desc';
		$where = array();
		$data['sms'] = $this->Basic->getmultiplerow($order,$where,'sms_templates');
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/smstemplates',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function editsms($id)
	{
		$data['title'] = 'Update SMS Templates';

		$where = array('id'=>$id);
        $data['sms'] = $this->Basic->getsinglerow($where,'sms_templates');

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editsms',$data);
		$this->load->view('theme/layout/footer',$data);
	}



	function smssave()
	   {
		try{
			$postData = $this->input->post();

			if(isset($postData['subject']))
			{
		$ordersData=[
					'subject'		=> $postData['subject'],
					'message'		=> $postData['message']
				    ];

				if(!empty($postData['id']))	
				{
					$this->Basic->updatedata($ordersData,['id' => $postData['id']],'sms_templates');
					 
					$this->session->set_flashdata('msg', '<div class="alert alert-success">SMS Letter Templates  Updated Successfully</div>');;
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function banklist()
	{
		$data['title'] = 'Banks';
		$order = 'id'.' '.'desc';
		$where = array();
		$data['bank'] = $this->Basic->getmultiplerow($order,$where,'bank');
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/bank',$data);
		$this->load->view('theme/layout/footer',$data);
	} 


	function addbanks()
	{
		$data['title'] = 'Add Banks';

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/addbanks',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function savebank()
	{
	   try{
			$postData = $this->input->post();

			if(isset($postData['bank_name']))
			{
		$ordersData=['bank_name' => $postData['bank_name']];

				if(!empty($postData['id']))	
				{
					$this->Basic->updatedata($ordersData,['id' => $postData['id']],'bank');
					 
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Bank  Updated Successfully</div>');;
				}else{				
					$notesid = $this->Basic->insertdata($ordersData,'bank');

				$this->session->set_flashdata('msg', '<div class="alert alert-success">Bank has been added Successfully</div>');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
					redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function editbanks($id)
	{
		$data['title'] = 'Update Banks';

		$where = array('id'=>$id);
        $data['bank'] = $this->Basic->getsinglerow($where,'bank');

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editbanks',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function deletebanks($id)
	{
	  if($id)
        {
            $where = array('id'=>$id);
            $this->Basic->deletedata($where,'bank');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Bank Templates has been deleted Successfully</div>');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}


	function creditlist()
	{
		$data['title'] = 'Credit List';
		$order = 'id'.' '.'asc';
		$where = array();
		$data['creditlist'] = $this->Basic->getmultiplerow($order,$where,'creditlist');
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/creditlist',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function addcredit()
	{
		$data['title'] = 'Add Credit';

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/addcredit',$data);
		$this->load->view('theme/layout/footer',$data);
	}



		function savecredit()
	{
	   try{
			$postData = $this->input->post();

			if(isset($postData['sites']))
			{
		$ordersData=['sites' => $postData['sites']];

				if(!empty($postData['id']))	
				{
					$this->Basic->updatedata($ordersData,['id' => $postData['id']],'creditlist');
					 
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Credit Site Updated Successfully</div>');;
				}else{				
					$notesid = $this->Basic->insertdata($ordersData,'creditlist');

				$this->session->set_flashdata('msg', '<div class="alert alert-success">Credit Site has been added Successfully</div>');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
					redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function editcredit($id)
	{
		$data['title'] = 'Update Credit';

		$where = array('id'=>$id);
        $data['creditlist'] = $this->Basic->getsinglerow($where,'creditlist');

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editcredit',$data);
		$this->load->view('theme/layout/footer',$data);
	}



	function deletecredit($id)
	{
	  if($id)
        {
            $where = array('id'=>$id);
            $this->Basic->deletedata($where,'creditlist');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Credit Site has been deleted Successfully</div>');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}

	function  callstatuslist()
	{
		$data['title'] = 'Call Status List';
		$order = 'id'.' '.'asc';
		$where = array();
		$data['callstatuslist'] = $this->Basic->getmultiplerow($order,$where,'callstatuslist');
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/callstatuslist',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function addcallstatus()
	{
		$data['title'] = 'Add Call Status';

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/addcallstatus',$data);
		$this->load->view('theme/layout/footer',$data);
	}




		function savecallstatus()
	{
	   try{
			$postData = $this->input->post();

			if(isset($postData['status']))
			{
		$ordersData=['status' => $postData['status'],'color' => $postData['color']];

				if(!empty($postData['id']))	
				{
					$this->Basic->updatedata($ordersData,['id' => $postData['id']],'callstatuslist');
					 
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Call Status Updated Successfully</div>');;
				}else{				
					$notesid = $this->Basic->insertdata($ordersData,'callstatuslist');

				$this->session->set_flashdata('msg', '<div class="alert alert-success">Call Status has been added Successfully</div>');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
					redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function editcallstatus($id)
	{
	    $data['title'] = 'Update Call Status';

		$where = array('id'=>$id);
        $data['callstatuslist'] = $this->Basic->getsinglerow($where,'callstatuslist');

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editcallstatus',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function deletecallstatus($id)
	{
		 if($id)
        {
            $where = array('id'=>$id);
            $this->Basic->deletedata($where,'callstatuslist');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Call Status has been deleted Successfully</div>');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}
	/********************
	function moveoldclient(){
		$checkData=$this->db->query("SELECT users_backup.user_id,students.id AS student_id,students.teacher_id AS broker_id,users_backup.username,users_backup.password,users_backup.from_site,students.firstname,students.lastname,students.mobileno,students.email,students.city,students.pincode,students.current_address,students.dob,students.state FROM users_backup INNER JOIN students ON students.id = users_backup.user_id WHERE users_backup.role='parent' AND students.teacher_id=186 ORDER BY students.id ASC");
		echo "Total =" . count($checkData->result_array());
		echo "<pre>";
		//print_r($checkData->result_array());
		//exit;
		$countnew=0;
		$countExist=0;
		$countupdate=0;
		$countnewArray=[];
		foreach($checkData->result_array() as $getOldRes){
			$username		= $getOldRes['username'];
			$password		= $getOldRes['password'];
			$from_site		= $getOldRes['from_site'];
			$old_user_id	= $getOldRes['user_id'];
			$broker_id		= $getOldRes['broker_id'];
			$first_name		= $getOldRes['firstname'];
			$last_name		= $getOldRes['lastname'];
			$email			= $getOldRes['email'];
			$city			= $getOldRes['city'];
			$pincode		= $getOldRes['pincode'];
			$current_address = $getOldRes['current_address'];
			$dob			= $getOldRes['dob'];
			$state			= $getOldRes['state'];
			$phone			= $getOldRes['mobileno'];
			$parent_user_id=1201;
			$checkusersData=$this->db->query("SELECT * FROM users WHERE username='".$username."'");
			if(!empty($checkusersData->row())){
				$userdata= $checkusersData->row();
				$current_userId = $userdata->id;
				$parentuserid = $userdata->parent_user_id;
				if($parentuserid==$parent_user_id){
					$countExist+=1;
					$updatecondition=['old_user_id' => $old_user_id];
					$this->Basic->updatedata($updatecondition,['id' => $current_userId],'users');
				}else{
					 $countupdate+=1;
					 $updatecondition=['parent_user_id' => $parent_user_id,'old_user_id' => $old_user_id];
					 $this->Basic->updatedata($updatecondition,['id' => $current_userId],'users');
				}
				
			}else{
				 $countnew+=1;
				// $countnewArray[]=$getOldRes;
				 	$userType	=5;
					$usersdata = [
							'username'		  => $username,
							'password'		  => sha1($password),
							'intial_password' => $password,
							'user_type'		  => $userType,
							'email'			  => $email,
							'role_id'		  => $userType,
							'parent_user_id'  => $parent_user_id,
							'first_name'	  => $first_name,
							'firstname'		  => $first_name,
							'last_name'		  => $last_name,
							'lastname'		  => $last_name,
							'old_user_id'	  => $old_user_id,
							'refid'			  => $parent_user_id,
							'site_name'	  	  => $from_site
					];
					$user_id = $this->Basic->insertdata($usersdata,'users');
					if(!empty($user_id)){
						$user_detailsdata =[
							'user_id'		=> $user_id,
							'first_name'	=> $first_name,
							'last_name'		=> $last_name,
							'phone'			=> $phone,
							'email'			=> $email,
							'city'			=> $city,
							'zipcode'		=> $pincode,
							'address'		=> $current_address,
							'dob'			=> $dob,
							'state'			=> $state,
							'website'		=> $from_site,
							'added_date'	=> date('Y-m-d H:i:s')
						];
						$this->Basic->insertdata($user_detailsdata,'user_details');
					}
			}
		}
		echo "Count New =". $countnew;
		echo "<br/>";
		echo "Count Exist =". $countExist;
		echo "Count countupdate =". $countupdate;
		
		echo "<pre>";
		//print_r($countnewArray);
		exit;
	}********/
}
