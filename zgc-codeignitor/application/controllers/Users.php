<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

			if(!$this->session->userdata('user_id')) {
			redirect('login');
		}

		$this->load->library('grocery_CRUD');
	}

	/// users starts here
	public function getuserlist($type='')
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		if($type!='')
		$data['users'] = $this->User_model->getUserDetailById('','',$type);
		else
	    $data['users'] = $this->User_model->getUserDetailById();
 
	    $status = ['1'=>'Active','2'=>'Blocked','3'=>'Inactive','4'=>'Deleted'];
	    
	    $data['status'] = ['1'=>'Active','2'=>'Blocked','3'=>'Inactive','4'=>'Deleted'];
	    
	    $roleshere = $this->User_model->getUserroles();
	    
	     foreach($roleshere as $role)
	     {
	         $userrole[$role->user_type] = $role->user_type_name; 
	     }
	     
	     $data['roles'] = $userrole;
	     $data['title'] =  (isset($userrole[$type]))?$userrole[$type].' List':'User'.' List';
		
		$head = ['First Name','Last Name','Username','Email','Role','Referral Code','Status','Actions'];
		if($type==4){
		$head = ['First Name','Last Name','Username','Email','Role','Referral Code','Status','Actions'];
		}
	   
	     $headrows = [];


	      foreach($data['users'] as $user)
	      {
			  $referal_code='';
			  if($type==4){
				$referal_code = $user->referal_code.',';
			  }
               $headrows[] = [$user->user_id,ucfirst($user->first_name),ucfirst($user->last_name),$user->username,$user->email,$userrole[$user->user_type],$referal_code.$status[$user->status],'<a class="btn btn-success btn-xs" href='.base_url('copyuser/'.$user->user_id).' data-original-title="btn btn-danger btn-xs" title="">Copy</a>
			   <a class="btn btn-success btn-xs" href='.base_url('adduser/'.$user->user_id).' data-original-title="btn btn-danger btn-xs" title="">Edit</a><a class="btn btn-danger btn-xs"  href='.base_url('users/deleteuser/'.$user->user_id).' onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>'];
	      }

          $datas3333['formaction'] = base_url('users/multidelete');
	      $datas3333['head'] = $head;
	      $datas3333['headrows'] = $headrows;

			//$this->load->view('theme/layout/header',$data);
			//$this->load->view('theme/myaccount/dynamictable',$datas3333);
			//$this->load->view('theme/layout/footer',$data);
			
	    $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/userslist',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function copyuser($id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		
			$data['title'] = 'Copy User';  
			$data['users'] = $this->User_model->getUserDetailById($id,'','');
			$roles = $this->User_model->getUserroles();
			foreach($roles as $role){
				$userrole[$role->user_type] = $role->user_type_name; 
			}
			$data['roles'] = $userrole;
			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/adduser',$data);
			$this->load->view('theme/layout/footer',$data);
	}

	function multidelete()
	{
		   $RequestData = $this->input->post();

          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
			$data = array('status'=>4);
			$where = array('id'=>$id);
			$this->Basic->updatedata($data,$where,'users');
          	}
          }

          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Users has been Deleted successfully</div>');

           redirect($_SERVER['HTTP_REFERER']);
	}
	
	function adduser($id='')
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
	   try{
		    $lastReferURL = $_SERVER['HTTP_REFERER'] ?? 'getuserlist/';
		    if(!empty($this->input->post('username'))){
				$parent_user_id = ($this->input->post('parent_user_id'))? $this->input->post('parent_user_id'):0;
				$first_name = $this->input->post('first_name');
				$last_name 	= $this->input->post('last_name');
				$userType	= $this->input->post('user_type');
				$email		= $this->input->post('email');
				$phone		= $this->input->post('phone');
				$username	= $this->input->post('username');				
				$usersdata = [
					'username'		  => $username,
					'password'		  => sha1($this->input->post('password')),
					'intial_password' => $this->input->post('password'),
					'user_type'		  => $userType,
					'email'			  => $email,
					'role_id'		  => $userType,
					'parent_user_id'  => $parent_user_id,
					'first_name'	  => $first_name,
					'firstname'		  => $first_name,
					'last_name'		  => $last_name,
					'lastname'		  => $last_name
				];
				$user_detailsdata =[
					'first_name'	=> $first_name,
					'last_name'		=> $last_name,
					'phone'			=> $phone,
					'email'			=> $email,
					'added_date'	=> date('Y-m-d H:i:s')
				];
				if(!empty($this->input->post('id'))){
					 $userId = $this->input->post('id');
					 unset($usersdata['password']);
					 $this->Basic->updatedata($usersdata,['id' => $userId],'users');
					 $this->Basic->updatedata($user_detailsdata,['user_id' => $userId],'user_details');
					 $this->session->set_flashdata('msg', '<div class="alert alert-success">User Updated Successfully</div>');
				 }
				 else{
					 
					$ischeckUserExist = $this->Basic->getsinglerow(['username'=>$username],'users');
					
					if(empty($ischeckUserExist)){
						if($userType==4){
							$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
							$refferral_code = "";
							for ($i = 0; $i < 5; $i++) {
								$refferral_code .= $chars[mt_rand(0, strlen($chars)-1)];
							}
							$referal_code = $refferral_code;
							$usersdata['referal_code'] = $referal_code;
						}
						  $user_id = $this->Basic->insertdata($usersdata,'users');
						  $user_detailsdata['user_id'] = $user_id;
						  $this->Basic->insertdata($user_detailsdata,'user_details');
						  
						   //user_referal_code
							//Customers tables data added here
							/*************
							$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
							$refferral_code = "";
							for ($i = 0; $i < 15; $i++) {
								$refferral_code .= $chars[mt_rand(0, strlen($chars)-1)];
							}
							$customerdetails = ['email'=>$this->input->post('email'),
								'username'=>$this->input->post('username'),
								'password'=>md5($this->input->post('password')),
								'firstname'=>$this->input->post('first_name'),
								'lastname'=>$this->input->post('last_name'),
								'phone'=>$this->input->post('phone'),
								'status'=>'Y',
								'refferral_code'=>$refferral_code
							 ];                                           
							$this->Basic->insertdata($customerdetails,'rzvy_customers');******/
						
						  $this->session->set_flashdata('msg', '<div class="alert alert-success">User has been  added Successfully</div>');
				  
					}else{
						if(!empty($ischeckUserExist->username)){
							throw new Exception('Username Alreay Taken, Please try with other username');
						}
						if($ischeckUserExist->email==$email){
							throw new Exception('Email Address is Already Registered, Please enter other email!');
						}
					}
					
				 }
				redirect($lastReferURL);
			} 

		if($id){
		   $data['title'] = 'Update User';  
		   $data['users'] = $this->User_model->getUserDetailById($id,'','');
		}
		else{
		  $data['title'] = 'Add User';   
		}
	     $roles = $this->User_model->getUserroles();
	     foreach($roles as $role){
			$userrole[$role->user_type] = $role->user_type_name; 
	     }
		 $data['roles'] = $userrole;

	    $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/adduser',$data);
		$this->load->view('theme/layout/footer',$data);
		
	   }catch(Exception $e){
		    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left"><strong>'.$e->getMessage().'</strong></div>');
            redirect($_SERVER['HTTP_REFERER']);
	   }
	}

	function deleteuser($id)
	{
	  if($id)
        {
            
            $data = ['status'=>4];
            $where = array('id'=>$id);
            $this->Basic->updatedata($data,$where,'users');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">User has been  deleted Successfully</div>');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}


	function deletemultiusertype()
	{
			   $RequestData = $this->input->post();

          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
			$data = array('status'=>2);
			$where = array('user_type'=>$id);
			$this->Basic->updatedata($data,$where,'user_type');
          	}
          }

          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Users has been Deleted successfully</div>');

           redirect($_SERVER['HTTP_REFERER']);
	}
	
	///user types starts here
	public function getusertypelist()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
	    $data['title'] = 'User Types';
        $roles = $this->User_model->getUserroles();
		$head = ['User Type','Status','Actions'];
		$headrows = [];
	      foreach($roles as $user){
	      	 $status = ($user->status==1)?'Active':'Inactive';
               $headrows[] = [$user->user_type,$user->user_type_name,$status,'<a class="btn btn-success btn-xs" href='.base_url('copyusertype/'.$user->user_type).' data-original-title="btn btn-danger btn-xs" title="">Copy</a>

               <a class="btn btn-success btn-xs" href='.base_url('addusertype/'.$user->user_type).' data-original-title="btn btn-danger btn-xs" title="">Edit</a>

                          <a class="btn btn-danger btn-xs"  href='.base_url('users/deleteusertype/'.$user->user_type).' onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>'];
	      }

          $datas3333['formaction'] = base_url('users/deletemultiusertype');
	      $datas3333['head'] = $head;
	      $datas3333['headrows'] = $headrows;

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/dynamictable',$datas3333);
		$this->load->view('theme/layout/footer',$data);

		//$this->load->view('theme/layout/header',$data);
		//$this->load->view('theme/myaccount/usersroles',$data);
		//$this->load->view('theme/layout/footer',$data);
	}

	function copyusertype($id='')
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
	    $data['title'] = 'Copy User Types';
		$where = array('user_type'=>$id);
		$data['user_type'] = $this->Basic->getsinglerow($where,'user_type');
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addusertype',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	function addusertype($id='')
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
	    if($this->input->post('user_type_name'))
	    {
			$adddata = ['user_type_name'=>$this->input->post('user_type_name'),
			   'status'=>$this->input->post('status'),
			 ];
	         if($this->input->post('id'))
	         {
	             $where = ['user_type'=>$this->input->post('id')];
	             
	             $this->Basic->updatedata($adddata,$where,'user_type');
	             
	                  $this->session->set_flashdata('msg', '<div class="alert alert-success">User Type has been  updated Successfully</div>');
	         }
	         else
	         {

	        $where = array('user_type_name'=>$this->input->post('user_type_name'));
		   $user_type = $this->Basic->getsinglerow($where,'user_type');

		   if($user_type)
		   {
		   	 $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left"><strong>User Types already exist..</strong></div>');
            redirect($_SERVER['HTTP_REFERER']);
		   }

	    		$this->Basic->insertdata($adddata,'user_type');
	   			$this->session->set_flashdata('msg', '<div class="alert alert-success">User Type has been  added Successfully</div>');
	         }
	         redirect('getusertypelist');
	    }
	    if($id){
	       $data['title'] = 'Update User Types';
	        $where = array('user_type'=>$id);
		    $data['user_type'] = $this->Basic->getsinglerow($where,'user_type');
	    }
	    else
	    {
	      $data['title'] = 'Add User Types';   
	    }


	   	$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addusertype',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	
	function deleteusertype($id)
	{
	   if($id)
        {
            $data = ['status'=>2];
            $where = array('user_type'=>$id);
            $this->Basic->updatedata($data,$where,'user_type');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">User Type has been  deleted Successfully</div>');
           redirect('getusertypelist');
        }
	}
	function clientlogin($userId=0){
		try{
			if($this->session->userdata('user_type')==1){
				$users= $this->Common->selectrow('users',['id' => $userId,'user_type' => 5]);
					 if(!empty($users)){
							$user_id = $users->id;
							$this->Common->updatedata('users',['online' => '1'],['id' => $user_id]);
							$first_name = $users->first_name ?? '';
							$last_name 	= $users->last_name ?? '';
							$broker_id  = $users->refid;
							if(empty($first_name) && empty($last_name)){
								$where = array('user_id'=>$user_id);
								$user_details = $this->Basic->getsinglerow($where,'user_details');
								$first_name = $user_details->first_name;
								$last_name 	= $user_details->last_name;
							}
							$this->session->set_userdata(array(
								'id' 		=> $users->id,
								'username' 	=> $users->username,
								'user_id' 	=> $users->id,
								'broker_id' => $broker_id,
								'user_type' => $users->user_type,
								'role_id' 	=> $users->role_id,
								'first_name'=>	$first_name,
								'last_name'	=>	$last_name,
								'user'		=>	(array) $users
							));
							$_SESSION['user'] = (array) $users;
							$_SESSION['is_login_from_admin'] = true;
							$_SESSION['is_admin_user_id'] 	= 1;
							redirect('order/myaccount');
				}else {
					throw new Exception('Invalid User ID!');
				}
			}else{
				if($this->session->userdata('user_type')!=1){
					redirect('order/myaccount');
				}
				//throw new Exception('You have not permission to access this funtioanlity');
			}
			redirect($_SERVER['HTTP_REFERER']);
		}
		catch(Exception $e){
			 $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
            redirect($_SERVER['HTTP_REFERER']);
		}
	}
	function clientlogout(){
		
		if($this->session->userdata('is_login_from_admin')==1){
			$users= $this->Common->selectrow('users',['id' => 1,'user_type' => 1]);
			 if(!empty($users)){
					$user_id = $users->id;
					$this->Common->updatedata('users',['online' => '1'],['id' => $user_id]);
					$first_name = $users->first_name ?? '';
					$last_name 	= $users->last_name ?? '';
					$broker_id  = $users->refid;
					if(empty($first_name) && empty($last_name)){
						$where = array('user_id'=>$user_id);
						$user_details = $this->Basic->getsinglerow($where,'user_details');
						$first_name = $user_details->first_name;
						$last_name 	= $user_details->last_name;
					}
					/*******Start****/
				
					unset($_SESSION['is_admin_user_id']);
					unset($_SESSION['is_login_from_admin']);
					
					/***** End ********/
					$this->session->set_userdata(array(
						'id' 		=> $users->id,
						'username' 	=> $users->username,
						'user_id' 	=> $users->id,
						'broker_id' => $broker_id,
						'user_type' => $users->user_type,
						'role_id' 	=> $users->role_id,
						'first_name'=>	$first_name,
						'last_name'	=>	$last_name,
						'user'		=>	(array) $users
					));
					$_SESSION['user'] = (array) $users;
					redirect('getorders');
					
				}else {
					$this->session->sess_destroy();
					$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
					$this->output->set_header("Pragma: no-cache");
					redirect('login', 'refresh');
				}
		}
	}
}
