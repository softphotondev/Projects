<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'user');
		$this->load->helper('captcha');
		$this->load->model('email_model');
	}
	function index(){
		$data['page'] ='home';
		$data['membershipPlan'] =$this->Common->select('membership_plan');
		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/index',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}
	public function login()
	{
		if($this->session->userdata('id')){
			redirect('myaccount');
		}else{

			$data=array();
			if(!empty($_POST['username']) && !empty($_POST['password']))
			{
				$usertype 	= 0;
				$user 		= $_POST['username'];
				$password 	= $_POST['password'];
				
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				if($this->form_validation->run() == FALSE) 
				{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left"><strong>Invalid Username/Password</strong></div>');


				$response = ['status'=>'failure','message'=>'<div class="alert alert-danger text-left"><strong>Invalid Username or Password</strong></div>'];
				
				   //redirect('login');
				} 
				else{
						$where = array('username'=>$_POST['username'],'password'=>sha1($_POST['password']));
						$users = $this->Basic->getsinglerow($where,'users');
						
					
						 if(!empty($users)){
							$user_id = $users->id;
							$this->Common->updatedata('users',['online' => '1'],['id' => $user_id]);
							$first_name = $users->first_name ?? '';
							$last_name 	= $users->last_name ?? '';
							if($users->user_type==4){
								$broker_id = $users->id;
							}else{
								$broker_id = $users->refid;
							}
							
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
								
						 
						 if($users->role_id==1)
						 {
							if($users->role_id==1)
							{
							  $login_id = 1;
							  $login_type = "admin";
							}
							else
							{
							  $login_id =  $login_type = '';
							}
							$url = base_url('myaccount');
						 }
						  else
						  {
							$whereq = array('username'=>$_POST['username'],'password'=>md5($_POST['password']));
							$rzvy_customers = $this->Basic->getsinglerow($whereq,'rzvy_customers');
							if($rzvy_customers)
							{
							$login_id = $rzvy_customers->id;
							$login_type = "customer";
							}
							else
							{
							  $login_id =  $login_type = '';
							}
							$_SESSION['login_type'] = $login_type;
							$_SESSION['login_ids'] = $login_id;
							$url = base_url('order/myaccount');
						  }
							$response = ['login_type'=>$login_type,'login_id'=>$login_id,'status'=>'success','message'=>$url]; 
						 }
						 else
						 {        
							$response = ['status'=>'failure','message'=>'<div class="alert alert-danger text-left"><strong>Invalid Username or Password</strong></div>'];  
						 }
				}

				 echo json_encode($response); die;
				
			}
		}

			// $data['captchaImg'] = $this->Basic->getcapcha();

		$this->load->view('theme/prelayout/header');
		$this->load->view('theme/login',$data);
		$this->load->view('theme/prelayout/footer');
	}
	public function createaccount()
	{
	    try{
			$requestData=$this->input->post();
			if(empty($this->input->post('referal_code'))){
				throw new Exception('Referral Code can not be empty!.');
			}
			if($this->input->post('username') && $this->input->post('username')!='' && !empty($this->input->post('referal_code')))
			{
				$this->form_validation->set_rules('referal_code', 'Referral Code', 'required');
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('first_name', 'First name', 'required');
				$this->form_validation->set_rules('last_name', 'Last name', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('phone', 'Phone', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				
				if($this->form_validation->run() == FALSE){
					throw new Exception('Enter Valid Details');
				} 
				else{
					$referal_code = $requestData['referal_code'];
					$username 	= $requestData['username'];
					$email 		= $requestData['email'];
					$password 	= $requestData['password'];
					$first_name = $requestData['first_name'];
					$last_name 	= $requestData['last_name'];
					$phone 		= $requestData['phone'];
					
					$isCheckReferralCode = $this->Basic->getsinglerow(['referal_code' => $referal_code],'users');
					if(empty($isCheckReferralCode)){
						throw new Exception('Invalid Referral Code,Please enter valid Referral Code!.');
					}
					//$isEmailCheck 	= $this->Basic->getsinglerow(['email' => $email],'users');
					$isUsernameCheck 	= $this->Basic->getsinglerow(['username' => $username],'users');
					  
					  /*if(!empty($isEmailCheck)){
						  throw new Exception('Email address Already Exist.Please retry with other email address!');
					  }*/
					  if(!empty($isUsernameCheck)){
						  throw new Exception('UserName Already Exist! Please retry with other user name!');
					  }
					 
					  if(empty($isEmailCheck) && empty($isUsernameCheck)){
						/********User Add ***********/
						$user_type = 'user';
						$membershipType = 'Basic';
						$geo = $this->ip_info();
						
						$country = $geo['country'] ?? ''; 
						$city 	 = $geo['city'] ?? '';
						$refid=0;
						if(!empty($isCheckReferralCode)){
							$refid = $isCheckReferralCode->id;
						}
						$user_id = $this->user->insert(array(
							'user_type' 				=> 5,
							'role_id'		  			=> 5,
							'user_from'	  				=>	base_url(),
							'firstname'                 => $first_name,
							'lastname'                  => $last_name,
							'first_name'                => $first_name,
							'last_name'                 => $last_name,
							'email'                     => $email,
							'username'                  => $username,
							'password'                  => sha1($password),
							'intial_password'           => $password,
							'parent_user_id'			=> $refid,
							'refid'                     => $refid,
							'type'                      => $user_type,
                            //'Country'                 => (int)$geo['id'],
							'Country'                   => (string) $country,
							'City'                      => (string)$city,
							'phone'                     => $phone,
							'twaddress'                 => '',
							'address1'                  => '',
							'address2'                  => '',
							'ucity'                     => '',
							'ucountry'                  => '',
							'state'                     => '',
							'uzip'                      => '',
							'avatar'                    => '',
							'online'                    => '0',
							'unique_url'                => '',
							'bitly_unique_url'          => '',
							'created_at'                => date("Y-m-d H:i:s"),
							'updated_at'                => date("Y-m-d H:i:s"),
							'google_id'                 => '',
							'facebook_id'               => '',
							'twitter_id'                => '',
							'umode'                     => '',
							'PhoneNumber'               => $phone,
							'Addressone'                => '',
							'Addresstwo'                => '',
							'StateProvince'             => '',
							'Zip'                       => '',
							'f_link'                    => '',
							't_link'                    => '',
							'l_link'                    => '',
							'product_commission'        => '0',
							'affiliate_commission'      => '0',
							'product_commission_paid'   => '0',
							'affiliate_commission_paid' => '0',
							'product_total_click'       => '0',
							'product_total_sale'        => '0',
							'affiliate_total_click'     => '0',
							'sale_commission'           => '0',
							'sale_commission_paid'      => '0',
							'status'                    => '1'
						));

						$checkValue = $this->Common->updatedata('users',['id' => $user_id],['id' => $user_id]);
						$post['refid'] = !empty($refid) ? base64_decode($refid) : 0;
						if(!empty($user_id) && $user_type == 'user'){
							$notificationData = array(
								'notification_url'          => '/userslist/'.$user_id,
								'notification_type'         =>  'user',
								'notification_title'        =>  'New User Registration',
								'notification_viewfor'      =>  'admin',
								'notification_actionID'     =>  $user_id,
								'notification_description'  =>  $first_name.' '.$last_name.' register as a '. $membershipType . ' on Membership Program on '.date('Y-m-d H:i:s'),
								'notification_is_read'      =>  '0',
								'notification_created_date' =>  date('Y-m-d H:i:s'),
								'notification_ipaddress'    =>  $_SERVER['REMOTE_ADDR']
							);
							$this->Common->insert('notification',$notificationData);
							
							$json['success']  =  "You've Successfully registered";
		                   
						}
							/**********End ***************/

						if(!empty($user_id)){
							$insertuserdetails = [
								'user_id'		=> $user_id,
								'first_name'	=> $first_name,
								'last_name'		=> $last_name,
								'email'			=> $email,
								'phone'			=> $phone
							 ];		 
							$this->Basic->insertdata($insertuserdetails,'user_details');
							
							
						}
									
						/*if($_SERVER['HTTP_HOST']!='localhost'){	
							//admin email start here
							$email_templates = getemail(2);
							$subject  = $email_templates->subject;
							$message  = $email_templates->message;
							
							$user_password = $this->input->post('password');
							$tempvalues = array('##SITEURL##'=>base_url(),'##FIRSTNAME##'=>$this->input->post('first_name'),'##SITENAME##'=>sitename(),'##LOGO##'=>sitelogo(),'##USERNAME##'=>$this->input->post('username'),'##ROLE##'=>'Client','##PASSWORD##'=>$user_password,'##LASTNAME##'=>$this->input->post('last_name'));
							$message = strtr($message,$tempvalues);
							$subtemp = array('##SITENAME##'=>sitename());
							$subject = strtr($subject,$subtemp);
							$adminemail = array(
							'to' 		=> siteemail(),
							'subject' 	=> $subject,
							'message'   =>  $message,
							);
							$this->Email_model->send_mail($adminemail);
							
							
							$clentemail = array(
							'to' 		=> $this->input->post('email'),
							'subject' 	=> $subject,
							'message'   =>  $message,
							'userfrom' =>base_url()
							);
							
							$this->Email_model->send_mail($clentemail);
						}*/
						$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">You have Successfully registered</div>');
			   
						$response = ['status'=>'success','message'=>'<div class="alert alert-success text-left">Thank you for the registration! You can login now</div>'];

						redirect('login/');
						//redirect('order/myaccount');
					  }
				}
			
			}
			
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	public function resetpassword()
	{
	     if($this->input->post('username'))
		{
		    $this->form_validation->set_rules('username', 'Email', 'required');
		    
		if($this->form_validation->run() == FALSE)
		{
		$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Enter Valid Username</div>');
		
		redirect(base_url('resetpassword'), 'refresh');
		}
		else
		{
			if($this->input->post('username'))
			{
				$username = $this->input->post('username');

				$where = array('username'=>$username);
				$admindetailstatus = $this->Basic->getsinglerow($where,'users');
				
				if($admindetailstatus)
				{
				    
			$where = array('user_id'=>$admindetailstatus->id);
			$user_details = $this->Basic->getsinglerow($where,'user_details');
			
			    $firstname =  $user_details->first_name;
				$lastname =  $user_details->last_name;
				
				$username =  $admindetailstatus->username;
   
				    
            $to = $admindetailstatus->email;

            $email_templates = getemail(6);
            $subject  = $email_templates->subject;
            $message  = $email_templates->message;
            $token = rand('0000000','9999999');
            
            $user_password = get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);           
            
            $tempvalues = array('##SITEURL##'=>base_url(),'##SITENAME##'=>sitename(),'##LOGO##'=>sitelogo(),'##USERNAME##'=>$username,'##FIRSTNAME##'=>$firstname,'##LASTNAME##'=>$lastname,'##NAME##'=>$to,'##EMAIL##'=>$to,'##PASSWORD##'=>$user_password);
            
            $message = strtr($message,$tempvalues);
            
            
            $subject = strtr($subject,$tempvalues);
            
            $teacher_login_detail = array(
            'to' 		=> $to,
            'subject' 	=> $subject,
            'message'   =>  $message,
            'userfrom' =>$admindetailstatus->user_from
            );
            
            $this->Email_model->send_mail($teacher_login_detail);
            
            $data = array('password'=>sha1($user_password),'intial_password'=>$user_password);
            $where = array('username'=>$username);
            $this->Basic->updatedata($data,$where,'users');

            $where = array('username'=>$username);
            $rzvy_customers = $this->Basic->getsinglerow($where,'rzvy_customers');

            if($rzvy_customers)
            {
            $data = array('password'=>md5($user_password));
            $where = array('username'=>$username);
            $this->Basic->updatedata($data,$where,'rzvy_customers');
            }
            
        
    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Your login details sent to your email.</div>');
                
               redirect('resetpassword');
                
				}
				else
				{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Invalid Username</div>');
				 redirect('resetpassword');	
				}
			}
		 }
		}

		$this->load->view('theme/prelayout/header');
		$this->load->view('theme/password_recovery');
		$this->load->view('theme/prelayout/footer');
	}
	

	function contact()
	{

		$data['title'] = 'Contact Us';

	    $this->load->view('theme/prelayout/header');
		$this->load->view('theme/contact_us');
		$this->load->view('theme/prelayout/footer');
	}

	
    function terms()
	{
	  $this->load->view('theme/prelayout/header');
		$this->load->view('theme/terms');
		$this->load->view('theme/prelayout/footer');
	}
	
	function policy()
	{
	   $this->load->view('policy'); 
	}
	
	function refund()
	{
	   $this->load->view('refund'); 
	}
	
	function about()
	{
		$this->load->view('theme/prelayout/header');
		$this->load->view('theme/aboutus');
		$this->load->view('theme/prelayout/footer');
	}
	
	

	public function logout()
	{
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('login', 'refresh');
	}


	public function becomeBroker()
	{
		if($this->input->post('teacher_fname')){
			$teacher_fname = $this->input->post('teacher_fname');
			$teacher_lname = $this->input->post('teacher_lname');
			$email 		= $this->input->post('email');
			$phone 		= $this->input->post('phone');
			$companyname 	= $this->input->post('companyname');
			$client 		= $this->input->post('client');
			$cpn 			= $this->input->post('cpn');
			$report 		= $this->input->post('report');
			$income 		= $this->input->post('income');

			$where 			= array('username'=>$this->input->post('email'));
			$checkExist 	= $this->Basic->getsinglerow($where,'users');

		if($checkExist){
			$this->session->set_flashdata('msg', '<div class="alert alert-warning text-left">The Username or Email already exist..</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$user_password = get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);

		$insert_users = [
			'user_type'=>4,
			'username'=>$this->input->post('email'),
			'password'=>sha1($user_password),
			'intial_password'=>$user_password,
			'email'=>$this->input->post('email'),
			'role_id'=>4,
			'parent_user_id'=>1
		];
		
		$user_id = $this->Basic->insertdata($insert_users,'users');  
		$json_array = ['client'=>$client,'cpn'=>$cpn,'report'=>$report,'income'=>$income];
		
		$insertuserdetails = ['user_id'=>$user_id,
			'first_name'=>$teacher_fname,
			'last_name'=>$teacher_lname,
			'email'=>$email,
			'phone'=>$phone,
			'companyname'   => $companyname,
			'external_fields'=>serialize($json_array)
		 ];
			$this->Basic->insertdata($insertuserdetails,'user_details');
		
			//Customers tables data added here
			$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$refferral_code = "";
			for ($i = 0; $i < 15; $i++) {
				$refferral_code .= $chars[mt_rand(0, strlen($chars)-1)];
			}
			$customerdetails = [
				'email'			=> $email,
				'username'		=> $this->input->post('email'),
				'password'		=> md5($user_password),
				'firstname'		=> $teacher_fname,
				'lastname'		=> $teacher_lname,
				'phone'			=> $phone,
				'status'		=> 'Y',
				'refferral_code'=>$refferral_code
			];
														 
				    $this->Basic->insertdata($customerdetails,'rzvy_customers');

                    $email_templates = getemail(2);
                    $subject  = $email_templates->subject;
                    $message  = $email_templates->message;
                    
                    $tempvalues = array('##SITEURL##'=>base_url(),'##SITENAME##'=>sitename(),'##LOGO##'=>sitelogo(),'##FIRSTNAME##'=>$teacher_fname,'##USERNAME##'=>$email,'##ROLE##'=>'Broker','##PASSWORD##'=>$user_password,'##LASTNAME##'=>$teacher_lname);
                    $message = strtr($message,$tempvalues);
                    $subtemp = array('##SITENAME##'=>sitename());
                    $subject = strtr($subject,$subtemp);
                    
                    
                    $adminemail = array(
                    'to' 		=> siteemail(),
                    'subject' 	=> $subject,
                    'message'   =>  $message,
                    'type'		=>'admin',
                    'site'		=> sitename(),
                    );
                    
                    $this->Email_model->send_mail($adminemail);
                    
                    
                    $broekremail = array(
                    'to' 		=> $email,
                    'subject' 	=> $subject,
                    'message'   =>  $message,
                    'site'		=> sitename(),
                    );
                    
                    $this->Email_model->send_mail($broekremail);
                    
                    
                    //adminsms starte here
                    /*$sms_templates_text = getsms(8);
                    $message1  = $sms_templates_text->message;
                    $smscontentclient = strtr($message1,$tempvalues);
                    $adminmobile = preg_replace('/[^0-9]/', '', str_replace(' ', '-',adminmobile()));
                    $this->TwilioModel->sendMessage("+1".$adminmobile,$smscontentclient);
                    
                    $brokermobils = preg_replace('/[^0-9]/', '', str_replace(' ', '-',$phone));
                    $this->TwilioModel->sendMessage("+1".$brokermobils,$smscontentclient);*/

		$this->session->set_flashdata('msg', '<div class="alert alert-success">Thank you for the Request...Please wait admin will response soon.</div>');
				redirect($_SERVER['HTTP_REFERER']);
        }

		$this->load->view('theme/prelayout/header');
		$this->load->view('theme/become_broker');
		$this->load->view('theme/prelayout/footer');
	}


	  function contactus()
     {
        if($this->input->post('First_Name'))
        {
            $First_Name = $this->input->post('First_Name');
            $Last_Name = $this->input->post('Last_Name');
            $phone = $this->input->post('phone');
            $Email_Address = $this->input->post('Email_Address');
            $message = $this->input->post('message');
            $from_url = base_url();

                  $data = array('First_Name'=>$First_Name,
                  'Last_Name'=>$Last_Name,
                  'phone'=>$phone,
                  'Email_Address'=>$Email_Address,
                  'message'=>$message,
                  'from_url'=>$from_url,
                  'datetime'=>date('Y-m-d H:i:s'));
      $this->Basic->insertdata($data,'contact');


       $email_templates = getemail(35);
	   $subject  = $email_templates->subject;
	   $messageemail  = $email_templates->message;

	    $tempvalues = array(
                    '##SITENAME##'=>sitename(),
                    '##NAME##'=>$First_Name.' '.$Last_Name,
                    '##EMAIL##'=>$Email_Address,
                    '##MESSAGE##'=>$message,
                    "##SITEURL##" =>base_url()
                );

                $subject1 = strtr($subject,$tempvalues);

                $messageemail = strtr($messageemail,$tempvalues);

					$admin_email = array(
										'to'  =>siteemail(),  
										'subject'   => $subject1,
										'message'   =>  $messageemail,
										'site'=>base_url()
										);

                $this->Email_model->send_mail($admin_email);

      $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Request has been submitted successfully</div>');
          redirect($_SERVER['HTTP_REFERER']);
        }
        $this->load->view('theme/prelayout/header');
		$this->load->view('theme/contactus');
		$this->load->view('theme/prelayout/footer');
    }
	
	function appointment()
  {
        if($this->input->post('firstname'))
        {
		   $postdata = $this->input->post();
		   $postdata['create_at'] = date('Y-m-d H:i:s');
		   $postdata['datetime']  = date("Y-m-d", strtotime($this->input->post('datetime')));
		   $this->Basic->insertdata($postdata,'appointment');

          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Appointment has been submitted successfully</div>');
          redirect($_SERVER['HTTP_REFERER']);
        }

		$order = 'cat_name'.' '.'ASC';
		$data['category'] = $this->Basic->getmultiplerow($order,['status' => 'Y'],'rzvy_categories');
		

		$this->load->view('theme/prelayout/header');
		$this->load->view('theme/appointment',$data);
		$this->load->view('theme/prelayout/footer');
	}


  function selectservice()
  {
     $service_id = $this->input->post('service_id');

      $where = array('username'=>$this->input->post('email'));
      $checkExist = $this->Basic->getsinglerow($where,'service');
  }
	
	function register(){
		$data['titile']='Register';

    //$data['captchaImg'] = $this->Basic->getcapcha();


		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/register',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}


    public function refresh(){
      
    // Captcha configuration
   $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'font_path'     => 'system/fonts/texb.ttf',
            'img_width'     => '160',
            'img_height'    => 50,
            'word_length'   => 5,
            'font_size'     => 18
        );
        $captcha = create_captcha($config);
        
    
    // Unset previous captcha and store new captcha word
    $this->session->unset_userdata('captchaCode');
    $this->session->set_userdata('captchaCode',$captcha['word']);
    
    // Display captcha image
    echo $captcha['image'];
  }

	function faq()
	{
		$data['title'] = 'FAQ';
        $order = 'sort'.'  '.'asc';
        $where = array();
        $faqbroker = $this->Basic->getmultiplerow($order,$where,' faqbrokerquestype');
        
        $array = [];
        
        if($faqbroker)
        {
          foreach ($faqbroker as $key => $value) 
          {
             array_push($array, $value->id);
          }
        }

        $type  = array_unique($array);

        $typename = [];

        if($type)
        {
          foreach ($type as $key => $value) 
          {
          $order = 'sort'.'  '.'asc';
          $where = array('type'=>$value);
          $pathto = $this->Basic->getmultiplerow($order,$where,'faqbroker');
          $result [$value] = $pathto;

          $where = array('id'=>$value);
    $faqbrokerquestype = $this->Basic->getsinglerow($where,'faqbrokerquestype');
          $typename[$value] = $faqbrokerquestype->title;
          }
        }


        $data['faq'] = $result;
        $data['titlehere'] = $typename;


		$this->load->view('theme/prelayout/header');
		$this->load->view('theme/faq',$data);
		$this->load->view('theme/prelayout/footer');
	}
	/********get Location Detail Info ***********/
	public function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
	    $output = NULL;
	    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
	        $ip = $_SERVER["REMOTE_ADDR"];
	        if ($deep_detect) {
	            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
	                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
	                $ip = $_SERVER['HTTP_CLIENT_IP'];
	        }
	    }
	    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
		$support    = array("country", "countrycode", "state", "region", "city", "location", "address");
	    $continents = array(
			"IN" => "India",
	        "AF" => "Africa",
	        "AN" => "Antarctica",
	        "AS" => "Asia",
	        "EU" => "Europe",
	        "OC" => "Australia (Oceania)",
	        "NA" => "North America",
	        "SA" => "South America"
	    );
	    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
	        
	        $curl = curl_init("http://www.geoplugin.net/json.gp?ip=" . $ip);
	        $request = '';
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($curl, CURLOPT_HEADER, false);
	        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	        
	        $ipdat = json_decode(curl_exec($curl));
	        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
	            switch ($purpose) {
	                case "location":
		                $id = 0;
	                    $code = @$ipdat->geoplugin_countryCode;
	                    $data = $this->db->query("SELECT id FROM countries WHERE sortname LIKE '{$code}' ")->row();
	                    if($data){
	                    	$id = $data->id;
	                    }
	                    $output = array(
							"city"           => @$ipdat->geoplugin_city,
							"state"          => @$ipdat->geoplugin_regionName,
							"country"        => @$ipdat->geoplugin_countryName,
							"country_code"   => @$ipdat->geoplugin_countryCode,
							"continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
							"continent_code" => @$ipdat->geoplugin_continentCode,
							"id"             => $id
	                    );
	                    break;
	                case "address":
	                    $address = array($ipdat->geoplugin_countryName);
	                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
	                        $address[] = $ipdat->geoplugin_regionName;
	                    if (@strlen($ipdat->geoplugin_city) >= 1)
	                        $address[] = $ipdat->geoplugin_city;
	                    $output = implode(", ", array_reverse($address));
	                    break;
	                case "city":
	                    $output = @$ipdat->geoplugin_city;
	                    break;
	                case "state":
	                    $output = @$ipdat->geoplugin_regionName;
	                    break;
	                case "region":
	                    $output = @$ipdat->geoplugin_regionName;
	                    break;
	                case "country":
	                    //$output = @$ipdat->geoplugin_countryName;
	                    $output = 0;
	                    $code = @$ipdat->geoplugin_countryCode;
	                    $data = $this->db->query("SELECT id FROM countries WHERE sortname LIKE '{$code}' ")->row();
	                    if($data){
	                    	$output = $data->id;
	                    }
	                    break;
	                case "countrycode":
	                    $output = @$ipdat->geoplugin_countryCode;
	                    break;
	            }
	        }
	    }
	   
	    return $output;
	}



	function privacypolicy()
	{
			$where = array('id' =>3);
			$pages = $this->Basic->getsinglerow($where,'pages');
			$data['title'] 		= $pages->title;
			$data['message']  	= $pages->page_content;	

			$this->load->view('theme/prelayout/header',$data);
			$this->load->view('theme/prelayout/cms',$data);
			$this->load->view('theme/prelayout/footer',$data);
	}


	function termsofservice()
	{
			$where = array('id' =>2);
            $pages = $this->Basic->getsinglerow($where,'pages');
            $data['title'] 		= $pages->title;
            $data['message']  	= $pages->page_content;	
			$this->load->view('theme/prelayout/header',$data);
			$this->load->view('theme/prelayout/cms',$data);
			$this->load->view('theme/prelayout/footer',$data);
	}


	function refundpolicy()
	{
		    $where = array('id' =>4);
            $pages = $this->Basic->getsinglerow($where,'pages');
            $data['title'] 		= $pages->title;
            $data['message']  	= $pages->page_content;	
			
			$this->load->view('theme/prelayout/header',$data);
			$this->load->view('theme/prelayout/cms',$data);
			$this->load->view('theme/prelayout/footer',$data);
	}

	function aboutus()
	{
		$where = array('id' =>1);
		$pages = $this->Basic->getsinglerow($where,'pages');
		$data['title'] 		= $pages->title;
		$data['message']  	= $pages->page_content;	

		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/prelayout/cms',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}


	function termsofsale()
	{
			$where = array('id' =>6);
			$pages = $this->Basic->getsinglerow($where,'pages');
			$data['title'] 		= $pages->title;
			$data['message']  	= $pages->page_content;	

			$this->load->view('theme/prelayout/header',$data);
			$this->load->view('theme/prelayout/cms',$data);
			$this->load->view('theme/prelayout/footer',$data);
	}

	function testmail(){
		$message ='Register the first time';
		$login_detail = array(
			'to' 		=> 'pankaj.academiccrm@gmail.com',
			'subject' 	=> 'Register GetthatCredit',
			'message'   =>  $message
		);
		$this->email_model->send_mail($login_detail);
	}
}
