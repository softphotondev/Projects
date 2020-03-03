<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myaccount extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$this->load->helper('url');
	}


	function dashboard()
	{
		$data['title'] = 'Dashbaord'; 

	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/userdashboard',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}


	function myinformation()
	  {
		 if($this->input->post('first_name'))
	     {
	     if(!empty($_FILES["profile_image"]["name"]))
            {
				$image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$_FILES["profile_image"]["name"]));
                $uniqueID                 = uniqid();
                $img                     = $uniqueID.'_'.$image;
                $img_unique              = basename($img);
                $config['upload_path']   = './uploads/logo/';
                $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
                $config['file_name']     = $img_unique;  
                $this->load->library("upload", $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload("profile_image",$img_unique))
                {
                echo $this->upload->display_errors();die;
                }
                else
                {
                $profile_image = base_url('/uploads/logo/'.$img_unique);
                }
	       }
	       else
	       {
	       	$profile_image = (isset($postData['profile_image_old']))?$postData['profile_image_old']:'';
	       }
					$usersdata =['email'=>$this->input->post('email'),
					   'first_name'=>$this->input->post('first_name'),
					   'last_name'=>$this->input->post('last_name'),
					   'intial_password'=>$this->input->post('intial_password'),
					   'password'=>sha1($this->input->post('intial_password')),
	               ];
					$user_detailsdata = ['first_name'=>$this->input->post('first_name'),
			               'last_name'=>$this->input->post('last_name'),
			               'phone'=>$this->input->post('phone'),
			               'email'=>$this->input->post('email'),
			               'dob'=>$this->input->post('dob'),
			               'ssn'=>$this->input->post('ssn'),
			               'address'=>$this->input->post('address'),
			               'city'=>$this->input->post('city'),
			               'state'=>$this->input->post('state'),
			               'zipcode'=>$this->input->post('zipcode'),
			               'profile_image'=>$profile_image,
			               'added_date'=>date('Y-m-d H:i:s')
			              ];

              $whereusers = ['id'=>$this->input->post('id')];
	          $this->Basic->updatedata($usersdata,$whereusers,'users');
	          $where = ['user_id'=>$this->input->post('id')];
	          $this->Basic->updatedata($user_detailsdata,$where,'user_details');

			   $this->session->set_flashdata('msg', '<div class="alert alert-success">Information has been  updated Successfully</div>');

			redirect($_SERVER['HTTP_REFERER']);
	     }


		$data['title'] = 'My Account Details';
		$data['page'] 	= 'myaccount';
		$order = 'state_id'.' '.'asc';
		$where = array();
		$data['state'] = $this->Basic->getmultiplerow($order,$where,'state');

		$data['users'] = $this->User_model->getUserDetailById($this->session->userdata('user_id'));
 
	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/myinformation',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}

	function myuploads()
	{
		$data['title'] = 'My Uploads'; 
		$data['page'] 	= 'myupload';
		if($this->session->userdata('user_type')==4)
		{
               $user_ids = getclientids($this->session->userdata('user_id'));
               $myuploads = $this->Myaccount_model->getmyuploadsbroker($this->session->userdata('user_id'));
        }
        else
        {
             $myuploads = $this->Myaccount_model->getmyuploadsclient($this->session->userdata('user_id'));
        }
        

        $data['myuploads'] = $myuploads;

	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/myuploads',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}

	function creditreport()
	{
		$data['title'] = 'Credit Report';
		$data['page'] 	= 'creditreport';

		$order = 'id'.' '.'desc';
		$where = array('user_id'=>$this->session->userdata('user_id'));
		$data['order_identity_report'] = $this->Basic->getmultiplerow($order,$where,'identity_report');
 

	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/creditreport',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}

	function invoices()
	{
		$data['title'] 	= 'Invoices'; 
		$data['page'] 	= 'invoice';
        $invoices 		= $this->Myaccount_model->getinvoicelist();
        $data['invoices'] = $invoices;

	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/invoices',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}
	
	

    function tracking()
	{
		$data['title'] = 'Tracking'; 
		$data['page'] 	= 'tracking';
		/*
		if($this->session->userdata('user_type')==4)
		{
            $user_ids = getclientids($this->session->userdata('user_id'));
			foreach ($user_ids as $key => $value){
			  $where = array('user_id'=>$value);
			  $track = $this->Basic->getsinglerow($where,'usertrack');
				if(!isset($track)){
					$insertdatatrack = array('user_id'=>$value,'created_at'=>date('Y-m-d H:i:s'));
					$this->Basic->insertdata($insertdatatrack,'usertrack');
					$this->db->flush_cache();
				}
			}
			$usertrack = $this->User_model->usertrack($this->session->userdata('user_id'));
		}
		else{
			$where = array('user_id'=>$this->session->userdata('user_id'));
			$track = $this->Basic->getsinglerow($where,'usertrack');
			
			if(!isset($track)){
				$insertdatatrack = array('user_id'=>$this->session->userdata('user_id'),'created_at'=>date('Y-m-d H:i:s'));
				$requltids = $this->Basic->insertdata($insertdatatrack,'usertrack');
				$this->db->flush_cache();
			}
			
		}*/
		$order = 'id'.' '.'asc';
		$where = array('user_id'=>$this->session->userdata('user_id'));
		$usertrack = $this->Basic->getmultiplerow($order,$where,'usertrack');
			
		$data['usertrackhere'] = $usertrack;
	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/tracking',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}

	function support()
	{
	    $data['title'] = 'Support Ticket';
		$data['ticket'] = $this->Project_model->gatallticketorderbased();
		$data['page'] 	= 'support';
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

			$support_all = $this->Project_model->gatallticketorderbased('',$supp->status_id);
			$support_count[$suppkey] = count($support_all);
		}

		unset($support_status['13']);
		unset($support_status['15']);
		unset($support_status['16']);


		$data['support_status'] = $support_status;
		$data['support_count'] = $support_count;
		$data['support_status_output'] = $support_status_output;

		//print_r($support_status);

	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/support',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}

	function  clientlist()
	{
		$data['title'] = 'Client List'; 
		$data['page'] 	= 'clientlist';
		$data['clients'] = $this->User_model->getclients();

	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/clientlist',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}


	function addclient($id='')
	{
		if($this->session->userdata('usertype')==5){
			redirect('myinformation');
		}else{
		
	    if($this->input->post('first_name'))
	     {
	     if(!empty($_FILES["profile_image"]["name"]))
            {
				$image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$_FILES["profile_image"]["name"]));
                
                $uniqueID                 = uniqid();
                $img                     = $uniqueID.'_'.$image;
                $img_unique              = basename($img);
                $config['upload_path']   = './uploads/logo/';
                $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
                $config['file_name']     = $img_unique;  
                $this->load->library("upload", $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload("profile_image",$img_unique))
                {
                echo $this->upload->display_errors();die;
                }
                else
                {
                $profile_image = base_url('/uploads/logo/'.$img_unique);
                }
	       }
	       else
	       {
			$profile_image = (($this->input->post('profile_image_old')))?$this->input->post('profile_image_old'):'';
	       }

            if($this->input->post('password') && $this->input->post('user_id'))
            {
               $user_password 	= $this->input->post('password');  
               $username 		= $this->input->post('username_old');     
            }
            else
            {
				$user_password = get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
				$username = $this->input->post('username');  
	        }

           $usersdata = [
					'email'				=> $this->input->post('email'),
					'first_name'		=> $this->input->post('first_name'),
					'last_name'			=> $this->input->post('last_name'),
					'username'			=> $username,
					'intial_password'	=> $user_password,
					'password'			=> sha1($user_password),
					'user_from'			=> base_url(),
					'role_id'			=> 5,
					'user_type' 		=> 5,
					'parent_user_id'	=> $this->session->userdata('user_id'),
					'refid'             => $this->session->userdata('user_id'),
					'created_at'        => date("Y-m-d H:i:s"),
					'updated_at'        => date("Y-m-d H:i:s"),
					'status'            => '1'
				];
			$user_detailsdata = [
			   'first_name'		=> $this->input->post('first_name'),
			   'last_name'		=> $this->input->post('last_name'),
			   'phone'			=> $this->input->post('phone'),
			   'email'			=> $this->input->post('email'),
			   'dob'			=> $this->input->post('dob'),
			   'ssn'			=> $this->input->post('ssn'),
			   'address'		=> $this->input->post('address'),
			   'city'			=> $this->input->post('city'),
			   'state'			=> $this->input->post('state'),
			   'zipcode'		=> $this->input->post('zipcode'),
			   'profile_image'  => $profile_image,
			   'added_date'		=> date('Y-m-d H:i:s')
			  ];
            if($this->input->post('user_id')){
				$whereusers = ['id'=>$this->input->post('id')];
				$this->Basic->updatedata($usersdata,$whereusers,'users');
				$where 		= ['user_id'=>$this->input->post('user_id')];
				$this->Basic->updatedata($user_detailsdata,$where,'user_details');
	             
				$this->session->set_flashdata('msg', '<div class="alert alert-success">Client has been  updated Successfully</div>');
	         }
	         else
	         {
	         	  $where 		= array('username'=>$this->input->post('username'));
                  $existuser 	= $this->Basic->getsinglerow($where,'users');
            
          if(!$existuser)
          {
	      $user_id 	= $this->Basic->insertdata($usersdata,'users');
	      $user_detailsdata['id'] = $user_id;
	      $this->Basic->insertdata($user_detailsdata,'user_details');

	      //Customers tables data added here
         /************ Commeted Scheduled *************/ 
		 /*$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
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
							$this->Basic->insertdata($customerdetails,'rzvy_customers');
								*/
                            //admin email start here
                            /*$email_templates = getemail(2);
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
                            'message'   =>  $message
                            );
                            
                            $this->Email_model->send_mail($clentemail);*/
	       
					$this->session->set_flashdata('msg', '<div class="alert alert-success">client has been added Successfully</div>');
          }  
          else
          {
           $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left"><strong>Username already exist..</strong></div>');
          }
	    }
	       redirect($_SERVER['HTTP_REFERER']);
	     }

	    if($id)
	    {
	       $data['title'] = 'Update User';  
	       
		   $data['users'] = $this->User_model->getUserDetailById($id,'','');
	    }
	    else
	    {
	      $data['title'] = 'Add User';   
	    }
		
	    $order = 'state_id'.' '.'asc';
		$where = array();
		$data['state'] = $this->Basic->getmultiplerow($order,$where,'state'); 
		$data['page'] 	= 'addclient';	
	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/addclient',$data);
		$this->load->view('theme/prelayout/footer',$data);
	  }
	}

	function changepassword()
	{
		$data['title'] = 'Change Password'; 
		$data['page'] 	= 'chnagepassword';	
	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/changepassword',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}


	function invoiceadmin()
	{
	    $data['title'] = 'Invoice Admin'; 
		$data['page'] 	= 'invoiceadmin';
	     $invoices = $this->Myaccount_model->getinvoicelist();
         $data['invoices']  =$invoices;

	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/invoices',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}


	function pricesettings()
	{
	    $data['title'] = 'Set Pricing';
		$data['page'] 	= 'setprice';	
		$this->load->model('Myaccount_model');
		
	    	if(isset($cateid) && $cateid!='')
			$cateid = $cateid;
			else
			$cateid= 2;

			$data['cateid'] = $cateid;


			$order = 'product_id'.'  '.'desc';
			$where = array('category_id'=>$cateid,'status'=>'1');
			$list = $this->Basic->getmultiplerow($order,$where,'products');


			$where = array('id'=>$this->session->userdata('user_id'));
			$userbroker = $this->Basic->getsinglerow($where,'users');

			if($userbroker)
			{
			$where = array('user_id'=>$userbroker->id);
			$broker = $this->Basic->getsinglerow($where,'user_details');
			$discount = $broker->discount;

			$discount = ($discount!='')?$discount:0;
			}
			

			$newarray =[];


 if($list)
  {
  foreach($list as $key=>$Response)
  {
          if($discount!='0')
            {
            $offer_amount = ($discount / 100) * $Response->selling_price;
            $cost = $Response->selling_price - $offer_amount;
            $cost = round($cost);
            }
            else
            $cost = round($Response->selling_price);

          $where = array('product_id'=>$Response->product_id,'broker_id'=>$this->session->userdata('user_id'));
          $priceexist = $this->Basic->getsinglerow($where,'product_brokers_price');

          $price = ($priceexist)?$priceexist->price:'';

          if($priceexist)
          {
            $status = $priceexist->status;
          }
          else
          {
            $status = 'Active';
          }

         $newarray[] =  ['class_name'=>$Response->product_name,'cost'=>$Response->selling_price,'product_id'=>$Response->product_id,'status'=>$status,'price'=>$price];
		 
		 $imgs[] = $this->Myaccount_model->getProductImageById($Response->product_id);
		 
      }
  }

        $data['list_price'] = $newarray; 
		$data['list_images'] = $imgs;
		
		//print_r($imgs);

    	$order = 'category_id'.'  '.'asc';
		$where = array();
		$data['productcategory'] = $this->Basic->getmultiplerow($order,$where,'category');				
		

	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/pricesettings',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}
	
	
	function searchresultprice()
	{
		$category = $this->input->post('category');
		$search = $this->input->post('search');

		$sql = 'SELECT * FROM `products` where `category_id`="'.$category.'" and `product_name` LIKE "%'.$search.'%" ORDER BY product_id desc ';
		$query = $this->db->query($sql);
		$list = $query->result_array();
		
		$where = array('user_id' => $this->session->userdata('id'));
		$broker = $this->Basic->getsinglerow($where,'user_details');
		$discount = $broker->discount ?? 0;

		$discount = ($discount!='')?$discount:0;

		$newarray =[];


 if($list)
  {
  foreach($list as $key=>$Response1)
  {
  	$Response = (object) $Response1;

          if($discount!='0')
            {
            $offer_amount = ($discount / 100) * $Response->selling_price;
            $cost = $Response->selling_price - $offer_amount;
            $cost = round($cost);
            }
            else
            $cost = round($Response->selling_price);

          $where = array('product_id'=>$Response->product_id,'broker_id'=>$this->session->userdata('user_id'));
          $priceexist = $this->Basic->getsinglerow($where,'product_brokers_price');

          $price = ($priceexist)?$priceexist->price:'';

          if($priceexist)
          {
            $status = $priceexist->status;
          }
          else
          {
            $status = 'Active';
          }

         $newarray[] =  ['class_name'=>$Response->product_name,'cost'=>$Response->selling_price,'product_id'=>$Response->product_id,'status'=>$status,'price'=>$price];
      }
  }

    $data['list_price'] = $newarray;

	
	$this->load->view('theme/myaccount/front/price_setting_ajax',$data);

	}


	function changecategoryprice()
	{
		$category = $this->input->post('category');
		$search = $this->input->post('search');

		$sql = 'SELECT * FROM `products` where `category_id`="'.$category.'" and `product_name` LIKE "%'.$search.'%" ORDER BY product_id desc ';
		$query 		= $this->db->query($sql);
		$list 		= $query->result_array();
		$userId 	= $this->session->userdata('id');
		$where 		= array('user_id' => $userId);
		$broker 	= $this->Basic->getsinglerow($where,'user_details');
		$discount 	= $broker->discount;

		$discount 	= ($discount!='')?$discount:0;
			
		$newarray =[];
		if($list){
		  foreach($list as $key=>$Response1){
			$Response = (object) $Response1;
				  if($discount!='0'){
					$offer_amount 	= ($discount / 100) * $Response->selling_price;
					$cost 			= $Response->selling_price - $offer_amount;
					$cost 			= round($cost);
				}else{
					$cost = round($Response->selling_price);
				}
				$where 		= array('product_id'=>$Response->product_id,'broker_id' => $userId);
				$priceexist = $this->Basic->getsinglerow($where,'product_brokers_price');
					
				$price = ($priceexist)?$priceexist->price:'';
				if($priceexist){
					$status = $priceexist->status;
				}
				else{
					$status = 'Active';
				}
				$newarray[] =  ['class_name'=>$Response->product_name,'cost'=>$Response->selling_price,'product_id'=>$Response->product_id,'status'=>$status,'price'=>$price];
			}
		}
			$data['list_price'] = $newarray;
			$this->load->view('theme/myaccount/front/price_setting_ajax',$data);
	}


	function updatedatas()
	{
		$category = $this->input->post('category');
	    $update  = $this->input->post('update');

    	$order = 'product_id'.'  '.'asc';
		$where = array('category_id'=>$category);
		$list = $this->Basic->getmultiplerow($order,$where,'products');

		if($list)
		{
			foreach ($list as $key => $vendor) 
			{
                  $offer_amount = ($update/100) * $vendor->selling_price;
                  $cost = $vendor->selling_price + $offer_amount;
                  $cost = round($cost);

          $updateprice = array('price'=>$cost);
          $where = array('product_id'=>$vendor->product_id,'broker_id'=>$this->session->userdata('user_id'));
          $this->Basic->updatedata($updateprice,$where,'product_brokers_price');
			}
		}
		
		$this->session->set_userdata('setpricing','setpricing');

		  $this->session->set_flashdata('msg', '<div class="alert alert-success">Common Price update has been updated Successfully</div>');
	}


	function sitesettings()
	{
	    $data['title'] 	= 'Site Settings'; 
		$data['page'] 	= 'sitesetting';
		
	      if($this->input->post())
    	  {
            if(!empty($_FILES["sitelogo"]["name"]))
            {
                $image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$_FILES["sitelogo"]["name"]));
                
                $uniqueID                 = uniqid();
                $img                     = $uniqueID.'_'.$image;
                $img_unique              = basename($img);
                $config['upload_path']   = './uploads/logo/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name']     = $img_unique;  
                $this->load->library("upload", $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload("sitelogo",$img_unique))
                {
					echo $this->upload->display_errors();
                }
                else
                {
                $_POST['sitelogo'] = base_url('uploads/logo/'.$img_unique);
                }
	       }
				
			$data = array_filter($_POST);
			if(!empty($_POST['id']) && isset($_POST['id'])){
				$where = array('id'=>$_POST['id']);
				$this->Basic->updatedata($data,$where,'site_settings');
			}else{
				$data['user_id']=$this->session->userdata('user_id');
				$this->Basic->insertdata($data,'site_settings');
			}
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Setting updated successfully.</div>');
				redirect($_SERVER['HTTP_REFERER']);
    	}


		$where = array('user_id' => $this->session->userdata('user_id'));
        $data['site_settings'] = $this->Basic->getsinglerow($where,'site_settings');

        $data['statelist'] = $this->Common->select('state');

	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/sitesettings',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}


	function mailaccess()
	{
	    $data['title'] = 'Mail Access'; 
		$data['page'] 	= 'mailaccess';	
	    $this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/mailaccess',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}


	function loadtrack()
	{
		 $track_id =$this->input->post('track_id');

         $where = array('id'=>$track_id);
		$data['usertrack'] = $this->Basic->getsinglerow($where,'usertrack');

		echo $this->load->view('theme/myaccount/front/loadtrack',$data,true);
	}


	function savetrack()
	{
		 if($this->input->post('exp_track'))
		 {
		 	$updatedata = ['exp_track'=>$this->input->post('exp_track'),
		 	               'equ_track'=>$this->input->post('equ_track'),
		 	               'trans_track'=>$this->input->post('trans_track'),
		 	               'created_at'=>date('Y-m-d H:i:s'),
		 	               'updated_at'=>date('Y-m-d H:i:s')
		                  ];
		   $where = ['id'=>$this->input->post('id')];
	       $this->Basic->updatedata($updatedata,$where,'usertrack');

	          $this->session->set_flashdata('msg', '<div class="alert alert-success">Tracking has been  updated Successfully</div>');

	       redirect($_SERVER['HTTP_REFERER']);
	     }
	}


	function creditreport_load()
	{
		 if($this->input->post('id'))
		 {
			$id = $this->input->post('id');
			$where = array('id'=>$id);
			$data['order_identity_report'] = $this->Basic->getsinglerow($where,'identity_report');
			echo $this->load->view('theme/myaccount/front/loadreport',$data,true);
		 }
	}

		function showclientdetails()
	{
	    $orderid = $this->input->post('id');
	    
	    $data['ordersrow'] = $this->Project_model->getallorders('',$orderid);
		$data['orders']  = $data['ordersrow'][0]; 
	    
	    $where = array('user_id'=>$data['orders']->user_id);
	    $data['user_details'] = $this->Basic->getsinglerow($where,'user_details');
	       
	    
        /*$order = 'id'.'  '.'desc';
        $where = array('user_id'=>1);
        $data['payment_methods'] = $this->Basic->getmultiplerow($order,$where,'payment_methods');*/
	    
        echo $this->load->view('theme/showclientdetails',$data,true);
	}

	function checkpassword()
	{
		 $oldpass = $this->input->post('oldpass');
		 $md5pass = md5($oldpass);
		 $newpass = $this->input->post('newpass');

$where = array('id'=>$this->session->userdata('user_id'),'intial_password'=>$oldpass,'password'=>$md5pass);
	     $user = $this->Basic->getsinglerow($where,'users');

	     if(!$user)
	     {
	     	echo "nomatch";
	     }
	     else
	     {
	     	 $updatedata = ['intial_password'=>$this->input->post('newpass'),
		 	               'password'=>md5($this->input->post('newpass'))
		                   ];
		   $where = ['id'=>$this->session->userdata('user_id')];
	       $this->Basic->updatedata($updatedata,$where,'users');

	       echo "success";
	     }
	}



	   function productpriceupdate()
    {
    	$product_id = $this->input->post('product_id');
    	$price = $this->input->post('price');
    	$status = $this->input->post('status');

    	if($this->input->post('price')!='' && $this->input->post('status')!='')
    	{
	    	$where = array('product_id'=>$product_id,'broker_id'=>$this->session->userdata('user_id'));
			$priceexist = $this->Basic->getsinglerow($where,'product_brokers_price');

			if($priceexist)
			{
				$data = array('price'=>$this->input->post('price'),'status'=>$this->input->post('status'));
				$where = array('product_id'=>$product_id,'broker_id'=>$this->session->userdata('user_id'));
				$this->Basic->updatedata($data,$where,'product_brokers_price');
			}
			else
			{
							$data = array('product_id'=>$product_id,
										  'broker_id'=>$this->session->userdata('user_id'),
										  'price'=>$this->input->post('price'),
										  'status'=>$this->input->post('status') );
	                         $this->Basic->insertdata($data,'product_brokers_price');
			}

			echo "success";
	    }
	    else
	    {
	    	echo "Enter Price";
	    }
    }


    function mycontact()
    {
    	$data['title'] = 'Contact';
		$data['page'] 	= 'contact';
    	$order = 'id'.'  '.'desc';
		$where = array('from_url'=>base_url());
		$data['contact'] = $this->Basic->getmultiplerow($order,$where,'contact');

		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/mycontact',$data);
		$this->load->view('theme/prelayout/footer',$data);
    }


    function loadcontact()
    {
    	 $contactid = $this->input->post('contactid');

    	 	$where = array('id'=>$contactid);
			$data['contact'] = $this->Basic->getsinglerow($where,'contact');

    	  echo $this->load->view('theme/myaccount/front/loadcontact',$data,true);
    }

    function replycontact()
    {
    	if($this->input->post('id'))
    	{
				$id = $this->input->post('id');
				$reply = $this->input->post('reply');
				$data = array('reply'=>$reply);
				$where = array('id'=>$id);
				$this->Basic->updatedata($data,$where,'contact');

				$where = array('id'=>$id);
				$contact = $this->Basic->getsinglerow($where,'contact');


		$email_templates = getemail(35);
		$subject  = 'Reply from Admin Contact Us';
		$messageemail  = $email_templates->message;

		$tempvalues = array(
		'##SITENAME##'=>sitename(),
		'##NAME##'=>$contact->First_Name.' '.$contact->Last_Name,
		'##EMAIL##'=>$contact->Email_Address,
		'##MESSAGE##'=>$reply,
		"##SITEURL##" =>base_url()
		);

		$subject1 = strtr($subject,$tempvalues);
		$messageemail = strtr($messageemail,$tempvalues);
		$admin_email = array(
							'to'  =>$contact->Email_Address,  
							'subject'   => $subject1,
							'message'   =>  $messageemail,
							'site'=>base_url()
							);

		$this->Email_model->send_mail($admin_email);

				$this->session->set_flashdata('msg', '<div class="alert alert-success">Reply has been sent Successfully</div>');
				redirect($_SERVER['HTTP_REFERER']);
    	}
    }


    function  deletecontact($id)
    {
    	if($id)
        {
             $where = array('id'=>$id);
            $this->Basic->deletedata($where,'contact');

    $this->session->set_flashdata('msg', '<div class="alert alert-success">Contact has been  deleted Successfully</div>');
            redirect($_SERVER['HTTP_REFERER']);   
        }	
    }


    function paymentsettings()
    {
    	$data['title'] = 'Payment Settings';
    	$data['page'] 	= 'paymentsetting';
    	$order = 'payment_id'.'  '.'desc';
		$where = array('broker_id'=> $this->session->userdata('user_id'));
		$data['paymentmethods'] = $this->Basic->getmultiplerow($order,$where,'payment_methods');

		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/front/paymentsettings',$data);
		$this->load->view('theme/prelayout/footer',$data);
    }


    function paymentsave()
    {
    	try{
			$postData = $this->input->post();

			if(isset($postData['name']))
			{
					if(!empty($postData['payment_id']))	
					{
						$ordersData=[
							'name'			=> $postData['name'],
							'description'	=> $postData['description'],
							'status'		=> $postData['status']
						];
						$this->Basic->updatedata($ordersData,['payment_id' => $postData['payment_id']],'payment_methods');
						$this->session->set_flashdata('msg', '<div class="alert alert-success">Payment Settings Updated Successfully</div>');;
					}else{
						$ordersData=[
							'broker_id'		=> $this->session->userdata('user_id'),	
							'domain'		=> '',
							'name'			=> $postData['name'],
							'description'	=> $postData['description'],
							'datetime'		=> date('Y-m-d H:i:s'),
							'status'		=> $postData['status']
						];
						
						 $this->Basic->insertdata($ordersData,'payment_methods');

						$this->session->set_flashdata('msg', '<div class="alert alert-success">Payment Settings added Successfully</div>');
					}
					redirect($_SERVER['HTTP_REFERER']);

                }
				}
				catch(Exception $e){
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			   redirect($_SERVER['HTTP_REFERER']);
		}
    }


    function loadpayment()
    {
    	 $payment_id = $this->input->post('payment_id');

    	 $where = array('payment_id'=>$payment_id);
			$data['payment'] = $this->Basic->getsinglerow($where,'payment_methods');

    	  echo $this->load->view('theme/myaccount/front/loadpayment',$data,true);
    }


    function deletepayment($id)
    {
    	if($id)
        {
             $where = array('payment_id'=>$id);
            $this->Basic->deletedata($where,'payment_methods');
				$this->session->set_flashdata('msg', '<div class="alert alert-success">Payment Settings has been  deleted Successfully</div>');
            redirect($_SERVER['HTTP_REFERER']);   
        }	
    }
}
