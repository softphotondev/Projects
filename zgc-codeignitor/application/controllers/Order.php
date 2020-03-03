<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('id')) {
			redirect('login');
		}
		$this->load->helper('url');
		$this->load->library('upload');
		$this->load->model('BotJobs');
		$this->load->model('order_model');
	}

	function index(){
		
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Proejcts List'; 
	    $data['products'] = $this->Product_model->getProductList();
		$category = $this->Product_model->getCategoryList();
		foreach($category as $cate){
			 $userrole[$cate->category_id] = $cate->category_name; 
		}
	    $data['category'] = $userrole;
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/order-history',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function save(){
		try{
			//echo "<pre>";
			$postData = $this->input->post();
			if(isset($postData['order_id'])){
				$billing_info 		= '';//json_encode($postData['billing_info']);
				$totalprice			= $postData['totalprice'];
				$payment_method		= $postData['payment_method'] ?? 2;
				$orderId			= $postData['order_id'];
				
				if(!empty($orderId)){
					/*$nextOrderId = $this->Common->getMaxNumber('orders',[] ,'order_id');
					$today = strtotime(date("Ymd"));
					$rand = sprintf("%04d", rand(0,9999));
					$orderNumber = $nextOrderId.'-'.$today . $rand;
					*/
					  $where = array('product_id'=>$postData['product_id']);
					  $products = $this->Basic->getsinglerow($where,'products');
					  $broker_price =($products) ? $products->selling_price: $postData['selling_price'];
					  $totalprice = str_replace(",","",$totalprice);
					  $broker_price = str_replace(",","",$broker_price);

						$ordersData=[
							'order_amount' 		=> $totalprice,
							'broker_amount' 	=> $broker_price,
							'billing_info'		=> $billing_info,
							'payment_method'	=> $payment_method,
							'status'			=> 1,
							'payment_status'	=> 1,
							'last_updated_date'	=> date('Y-m-d H:i:s')
						];

						$this->Basic->updatedata($ordersData,['order_id' => $orderId],'orders');
					
						$ischeckExsit = $this->Common->selectrow('order_items_detail',['order_id' => $orderId,'product_id' => $postData['product_id']]);
						if(empty($ischeckExsit)){
							$selling_price = str_replace(",","",$postData['selling_price']);
							$ItemData=[
								'order_id' 			=> $orderId,
								'product_id'		=> $postData['product_id'],
								'product_name'		=> $postData['product_name'],
								'order_qty'			=> $postData['order_qty'],
								'selling_price'		=> $selling_price,
								'added_date'		=> date('Y-m-d H:i:s'),
								'last_updated_date'	=> date('Y-m-d H:i:s')
							];
							$this->Basic->insertdata($ItemData,'order_items_detail');
						}	
						unset($_SESSION['shopping_cart']);
						unset($_SESSION['products_options_id']);
						unset($_SESSION['order_id']);
					
					//$this->Project_model->sentorderemail($orderId);

					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Order Place Successfully!</div>');
					//redirect('completecheckout/'.$orderId);
					redirect('order/myaccount/');
				}else{
					throw new Exception('Order Could not process !Please try again.');
				}
			}		
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function orderstatus()
	{
		
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Order Status'; 

		$order = 'id'.' '.'desc';
		$where = array('status !='=>2);
		$orderstatus = $this->Basic->getmultiplerow($order,$where,'orderstatus');

	     $head = ['Order Status','Status','Actions'];
	     $headrows = [];

	      foreach($orderstatus as $status)
	      {

	      	$orde_st= ($status->status=='1')?'Active':'Inactive';

               $headrows[] = [$status->id,$status->orderstatus,$orde_st,'<a class="btn btn-success btn-xs" href='.base_url('copyorderstatus/'.$status->id).' data-original-title="btn btn-danger btn-xs" title="">Copy</a>

               <a class="btn btn-success btn-xs" href='.base_url('addorderstatus/'.$status->id).' data-original-title="btn btn-danger btn-xs" title="">Edit</a>

                          <a class="btn btn-danger btn-xs"  href='.base_url('order/deleteorderstatus/'.$status->id).' onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>'];
	      }

          $datas3333['formaction'] = base_url('order/multideleteorderstatus');
	      $datas3333['head'] = $head;
	      $datas3333['headrows'] = $headrows;

		  $this->load->view('theme/layout/header',$data);
		  $this->load->view('theme/myaccount/dynamictable',$datas3333);
		  $this->load->view('theme/layout/footer',$data);
	}

	function addorderstatus($id='')
	{
		 
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		 if($this->input->post('orderstatus'))
	     {
             if($this->input->post('id'))
	         {
	             $where = ['id'=>$this->input->post('id')];

	             $orderdata['orderstatus'] = $this->input->post('orderstatus');
	             $orderdata['created_date'] = date('Y-m-d H:i:s');
	             $this->Basic->updatedata($orderdata,$where,'orderstatus');

	  $this->session->set_flashdata('msg', '<div class="alert alert-success">Order status has been  updated Successfully</div>');
	         }
	         else
	         {
	         	  $where = array('orderstatus'=>$this->input->post('orderstatus'));
                  $orstatus = $this->Basic->getsinglerow($where,'orderstatus');

                  if(!$orstatus)
                  {
                  $orderdata['created_date'] = date('Y-m-d H:i:s');
                  $orderdata['orderstatus'] = $this->input->post('orderstatus');
                  $this->Basic->insertdata($orderdata,'orderstatus');

                  $this->session->set_flashdata('msg', '<div class="alert alert-success">Order status has been  added Successfully</div>');
                  }
                  else
                  {
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left"><strong>Order status already exist..</strong></div>');
            redirect($_SERVER['HTTP_REFERER']);
                  }
             }

             redirect('orderstatus');
         }

		 if($id)
	    {
				$data['title'] = 'Update Order Status';  
				$where = array('id'=>$id);
				$data['orderstatus'] = $this->Basic->getsinglerow($where,'orderstatus');
	    }
	    else
	    {
	      $data['title'] = 'Add Order Status';   
	    }

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addorderstatus',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function copyorderstatus($id)
	{
		$data['title'] = 'Copy Order Status';  

		$where = array('id'=>$id);
		$data['orderstatus'] = $this->Basic->getsinglerow($where,'orderstatus'); 

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addorderstatus',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function deleteorderstatus($id)
	{
	  if($id)
        {
            $data = ['status'=>2];
            $where = array('id'=>$id);
            $this->Basic->updatedata($data,$where,'orderstatus');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Order Status has been  deleted Successfully</div>');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}

    function multideleteorderstatus()
	{
		$RequestData = $this->input->post();

          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
			$data = array('status'=>2);
			$where = array('id'=>$id);
			$this->Basic->updatedata($data,$where,'orderstatus');
          	}
          }

          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Order Status has been Deleted successfully</div>');

           redirect($_SERVER['HTTP_REFERER']);
	}


	function savestep(){
		try{
			//echo "<pre>";
			$postData = $this->input->post();

			if(!empty($postData['block_name']) && !empty($postData['block_id'])){
				if(isset($postData['user_id']) && $postData['user_id']!='')
				{
				$user_id =($this->session->userdata('user_type')==4)?$postData['user_id']:$this->session->userdata('user_id');
				}
				else
				{
					 $user_id = $this->session->userdata('user_id');
				}

				$orderId 			= isset($postData['orderId']) ? $postData['orderId'] : 0;
				$user_id 			= $user_id;
				$totalsteps 		= $postData['totalsteps'];
				$step 				= $postData['step'];
				$block_name 		= $postData['block_name'];
				$block_id 			= $postData['block_id'];
				$block_field_name	= $postData['block_field_name'];
				$custom_block_field	= $postData['custom_block_field_id'];
				$fieldtype			= $postData['fieldtype'];
				$fieldname			= $postData['fieldname'];
				$blockArray 		= isset($postData['block_'.$block_id]) ? $postData['block_'.$block_id] :[];
				$module_selected	= $postData['module_selected'];
				$block_custom_fields=[];
				
				$username='';
				$password= '';
				$ssn='';
				$identityIq=[];
				//$customfieldArray = array_keys($blockArray);
				foreach($fieldtype as $key => $getfieldType){
					
					$custom_block_fieldId = $custom_block_field[$key];
					
					/*********Start Images ******/
					if($getfieldType=='file'){
						$dynamicfile=$custom_block_fieldId.'_dynamic_file';
						$filename = $_FILES[$dynamicfile]['name'];
						
						if(!empty($filename)){
							$randNumber = rand(3,1000);
							$filename=$randNumber.'_'.$user_id.'_'.$block_id.'_'.$filename;
							
							$uploadFilePath = 'uploads/orders/'.$user_id;
							if(!file_exists($uploadFilePath)) {
								mkdir($uploadFilePath, 0777, true);
							}

							$config['upload_path'] 		= $uploadFilePath.'/';
							$config['allowed_types'] 	= 'jpg|jpeg|png|gif|pdf';
							$config['encrypt_name'] 	= TRUE;
							$config['file_name'] 		= $filename;
							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);
							if($this->upload->do_upload($dynamicfile)){
								$uploadData = $this->upload->data();
								$filename 	= $uploadData['file_name'];
								$custom_field_values =base_url().$uploadFilePath.'/'.$filename;	
							}
							else{
								$this->success  = FALSE;
								throw new Exception($this->upload->display_errors());
							}
						}
						else{
							$dynamic_filevalue =isset($postData[$custom_block_fieldId.'_dynamic_filevalue']) ? $postData[$custom_block_fieldId.'_dynamic_filevalue'] : '';
							if(isset($dynamic_filevalue) && !empty($dynamic_filevalue)){
								$custom_field_values =$dynamic_filevalue;
							}
						}
						/*********END Images********/
					}else{
						$custom_field_values 	= $blockArray[$custom_block_fieldId];
					}
					$custom_field_name 		= $fieldname[$key];
					$block_custom_fields[]=[
						'block_id' 				=> $block_id,
						'custom_field_name' 	=> $custom_field_name,
						'custom_field_values' 	=> $custom_field_values ?? ''
					];
					/********Checking identityIQ*******/	
					if($module_selected=='identityiq'){
						if (strstr( $custom_field_name, 'user')) {
						 $username = $custom_field_values;
						 $identityIq['username']= $username;
						}
						if (strstr($custom_field_name, 'password')) {
						 $password = $custom_field_values;
						  $identityIq['password']= $password;
						}
						if (strstr($custom_field_name, 'ssn')) {
						 $ssn = $custom_field_values;
						  $identityIq['ssn']= $ssn;
						}
					}
					/********** End IdentityIQ *************/
				}
					//print_r($identityIq);exit;
				if(!empty($block_custom_fields)){
					
					if(empty($orderId)){
						
						$getCartItems = $this->shoppingcart->getCartItems();
						$productId = $getCartItems['array'][0]['product_id'];
						
						//$getProducts = $this->Common->selectrow('products',['product_id' => $productId]);
						
						$product_options='';
						$selling_price=0;
						if(!empty($_SESSION['products_options_id'])){
							$product_options = $this->Common->selectrow('products_options',['products_options_id'=>$_SESSION['products_options_id']]);
							if(!empty($product_options)){
							 $product_options = $product_options->sub_product_name ?? '';
							 $selling_price = $product_options->sub_selling_price ?? 0;
							}
						}
						
						$isIncompleteOrderExist = $this->Common->checkIncompleteOrderInCart($productId,$user_id);
						if(!empty($isIncompleteOrderExist)){
							$orderId 	= $isIncompleteOrderExist->order_id;
							$ordersData=[
								'product_options'	=> $product_options,
								'order_amount'		=> $selling_price,
								'totalsteps'		=> $totalsteps,
								'step_stage'		=> $step,
								'created_by'		=> $this->session->userdata('user_id'),
								'added_date'		=> date('Y-m-d H:i:s'),
								'last_updated_date'	=> date('Y-m-d H:i:s')
							];
							$this->Basic->updatedata($ordersData,['order_id' => $orderId],'orders');
						}else {
							$nextOrderId = $this->Common->getMaxNumber('orders',[] ,'order_id');
							$today = strtotime(date("Ymd"));
							$rand = sprintf("%04d", rand(0,9999));
							$orderNumber = $nextOrderId.'-'.$today . $rand;
							$ordersData=[
								'order_number'		=> $orderNumber,
								'user_id' 			=> $user_id,
								'order_amount'		=> $selling_price,
								'status'			=> 0,
								'payment_status'	=> 0,
								'product_id'		=> $productId,
								'product_options'	=> $product_options,
								'product_info'		=> json_encode($getCartItems),
								'totalsteps'		=> $totalsteps,
								'step_stage'		=> $step,
								'created_by'		=> $this->session->userdata('user_id'),
								'added_date'		=> date('Y-m-d H:i:s'),
								'last_updated_date'	=> date('Y-m-d H:i:s')
							];
							$orderId = $this->Basic->insertdata($ordersData,'orders');
						}
						//unset($_SESSION['products_options_id']);
					}else{
						$ordersData=[
							'totalsteps'		=> $totalsteps,
							'step_stage'		=> $step,
							'last_updated_date'	=> date('Y-m-d H:i:s')
						];
						$this->Basic->updatedata($ordersData,['order_id' => $orderId],'orders');	
					}
					
					if(!empty($orderId)){
						$orderStepData=[
							'order_id' 			=> $orderId,
							'step' 				=> $step,
							'block_id'			=> $block_id,
							'block_name'		=> $block_name,
							'block_field_name'	=> $block_field_name,
							'field_type'		=> json_encode($fieldtype),
							'added_date'		=> date('Y-m-d H:i:s'),
							'last_updated_date'	=> date('Y-m-d H:i:s')
						];
						
						$this->Basic->deletedata(['order_id' => $orderId,'block_id' => $block_id],'order_step');
						$this->Basic->deletedata(['order_id' => $orderId,'block_id' => $block_id],'order_detail');
						
						$order_step_Id = $this->Basic->insertdata($orderStepData,'order_step');
						
						foreach($block_custom_fields as $getcustomFields){
							$orderDetailData	= $getcustomFields;
							$orderDetailData['order_id']		= $orderId;
							$orderDetailData['order_step_id']	= $order_step_Id ?? 0;
							$orderDetailData['added_date']		= date('Y-m-d H:i:s');
							$orderDetailData['last_added_date']	= date('Y-m-d H:i:s');
							$orderDetailData['upload_by']	= $this->session->userdata('user_id');

							$this->Basic->insertdata($orderDetailData,'order_detail');
						}
						if($module_selected=='identityiq'){
							$identityIq_url='https://zgtv.cpnexpress.com/api/identity-iq/report/parser';
							$request_headers = array();
							$request_headers[] = 'Content-Type:application/json';
							$request_headers[] = 'User-Agent:test';
							log_message('info', json_encode($request_headers));
							log_message('info', json_encode($identityIq_url));
							$postdata =json_encode([
								'identity_password' 	=> $identityIq['password'],
								'identity_security_ans' => $identityIq['ssn'],
								'identity_username' 	=> $identityIq['username'],
								'user_id' 				=> $this->session->userdata('user_id'),
								'order_id' 				=> $orderId 
							]);
							$result =json_decode(sendPostData($identityIq_url,$postdata,$request_headers),TRUE);
						}
					}
				}

				$this->session->set_flashdata('msg', ucfirst($block_name).' Updated Successfully!');
				
				$stepurl='';
				$redirectURL = 'completecheckout/';
				if($step<$totalsteps){
					$step =$step+1;
					$stepurl ='?step='.$step;
					if($module_selected=='identityiq'){
							$messageLog = $this->Basic->getsinglerow(['user_id' => $this->session->userdata('user_id')],'message_log');
							if(!empty($messageLog->message)){
							 $this->session->set_flashdata('msg', $messageLog->message);
							}
					$stepurl ='?step='.$step.'&identityIq=1';	
					}
				}else if($step==$totalsteps){
					$stepurl ='?step='.$step.'&isbilling=1';
					$redirectURL = 'getpayment/';
				}
				redirect($redirectURL.$orderId.$stepurl);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', $e->getMessage());
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function myaccount()
	{
		$data['title'] 	= 'My Orders';
		$data['page'] 	= 'order';
		$orders 		= $this->Project_model->getallorders();
		
		$data['orders'] = $orders;
		$order 			= 'status_id'.' '.'asc';
		$where 			= array('type'=>'order');
		$orderstatusall = $this->Basic->getmultiplerow($order,$where,'status');
		$data['balanceorder'] = $this->Project_model->getbalanceorder();
		$data['balanceordercount'] = count($data['balanceorder']);
		$orderstatus 		= [];
		$orderstatus_count 	= [];
		if($orderstatusall)
		{
			foreach ($orderstatusall as $key => $value){
				$ordersorderstatus = $this->Project_model->getallorders($value->status_id);
				$orderstatus[$value->status_id] = $value->status_name;
				$orderstatus_count[$value->status_id] = count($ordersorderstatus);
			}
		}

	    $data['orderstatusall'] 	= $orderstatusall;
	    $data['orderstatus_count'] 	= $orderstatus_count;
	    $data['orderstatus'] 		= $orderstatus;
		
		$data['cartItems'] 	= $this->shoppingcart->getCartItems();
		$data['sumOfItems'] = $this->shoppingcart->sumValues;
		
		$this->load->view('theme/prelayout/header',$data);
		if(isMobile()){
			$this->load->view('theme/myaccount/user_mobile_account',$data);
		}else{
			$this->load->view('theme/myaccount/user_account',$data);	
		}
		$this->load->view('theme/prelayout/footer',$data);
	}

	function orderdetails($id='')
	{
		$data['title'] = 'Order Details'; 

        //support data starte here
        $data['support'] = $this->Project_model->gatallsupportorderbased($id);
		$data['ordersrow'] = $this->Project_model->getallorders('',$id);

		$data['order']  = $data['ordersrow'][0]; 
		$userId = $data['order']->user_id;
		$orderId = $data['order']->order_id;
        // task status count
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'task','status'=>1);
		$task_status_all = $this->Basic->getmultiplerow($order,$where,'status');


			$order = 'id'.' '.'asc';
		$where = array();
		$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');

		$task_status=$task_count=[];

		if($task_status_all)
		{
			foreach ($task_status_all as $key => $task) 
			{
        $task_status[$task->status_id] =  $task->status_name;

        $task_status_output[$key] =  $task->status_name;
        $order = 'task_id'.' '.'desc';
		$where = array('task_status'=>$task->status_id,'order_id'=>$id,'is_delete'=>1);
		$task_all = $this->Basic->getmultiplerow($order,$where,'task');
		$task_count[$key] = count($task_all);
			}
		}

		$data['task_status'] = $task_status;
		$data['task_count'] = $task_count;
		$data['task_status_output'] = $task_status_output;

       // get all task status
		$order = 'task_id'.' '.'desc';
		$where = array('is_delete <>'=>2,'order_id'=>$id);
		$data['task'] = $this->Basic->getmultiplerow($order,$where,'task');
		// priority taken from table
        $order = 'id'.' '.'desc';
		$where = array();
		$data['priority'] = $this->Basic->getmultiplerow($order,$where,'priority');

        $priority_array = []; 
		foreach($data['priority'] as $priority)
		{
            $priority_array[$priority->id] =  $priority->priority;
		}

		$data['priority_array'] = $priority_array;
		
		$data['order_id'] = $orderId;
		
		//support related values
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'support','status'=>0);
		$support_status_all = $this->Basic->getmultiplerow($order,$where,'status');

        $support_status = $support_count = $support_status_output = [];
		foreach($support_status_all as $suppkey=>$supp)
		{
			$support_status[$supp->status_id] = $supp->status_name;

			$support_status_output[$suppkey] =  $supp->status_name;

			$order = 'support_id'.' '.'desc';
			$where = array('status'=>$supp->status_id,'order_id'=>$id,'parent_id'=>0);
			$support_all = $this->Basic->getmultiplerow($order,$where,'support');
			$support_count[$suppkey] = count($support_all);
		}

		$data['support_status'] = $support_status;
		$data['support_count'] = $support_count;
		$data['support_status_output'] = $support_status_output;

		//Get all activity
		$order = 'activity_id'.' '.'desc';
		$where = array('order_id'=>$id);
		$data['user_activity'] = $this->Basic->getmultiplerow($order,$where,'user_activity');

        
        //dispute items
		//$data['disputeitems'] = $this->Project_model->disputeitems($id);

		$data['contract_sign_letter'] = '';
		
		$data['contract_sign_letter'] = $this->Global_model->getContractLetterByUserId($userId,$orderId);
			
		$data['dispute_items'] = $this->Global_model->selectYouDisputeItem($orderId,$userId);
		
        if(!$this->session->userdata('tab'))
		$this->session->set_userdata('tab','project');

			//Get all activity
		$order = 'notes_id'.' '.'desc';
		$where = array('order_id'=>$id,'is_delete <>'=>2);
		$data['notes'] = $this->Basic->getmultiplerow($order,$where,'notes');
		$orderId=$id;
		$data['order_dynamic_block'] 	= $this->Product_model->getdynamicBlockByOrderId($orderId);


		$this->load->view('theme/prelayout/header',$data);
		//$this->load->view('theme/myaccount/demo_order_detail',$data);
		$this->load->view('theme/myaccount/order_detail_vertical',$data);
		//$this->load->view('theme/myaccount/orderdetails',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}


	function loadsearch()
	{
		$value = $this->input->post('value');
		$type = $this->input->post('type');
        
        if($type==1)
		$orders = $this->Project_model->getallorders('','',$value);
	    else
	    $orders = $this->Project_model->getallorders($value);

	    $data['orders'] = $orders;

		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'order');
		$orderstatusall = $this->Basic->getmultiplerow($order,$where,'status');

		$orderstatus = [];

		$orderstatus_count = [];

		if($orderstatusall)
		{
			foreach ($orderstatusall as $key => $value) 
			{
				$ordersorderstatus = $this->Project_model->getallorders($value->status_id);
				$orderstatus[$value->status_id] = $value->status_name;
				$orderstatus_count[$value->status_id] = count($ordersorderstatus);
			}
		}

	    $data['orderstatusall'] = $orderstatusall;
	    $data['orderstatus_count'] = $orderstatus_count;
	    $data['orderstatus'] = $orderstatus; 
	    echo $this->load->view('theme/myaccount/useraccountsearch',$data,TRUE);	
	}

	function saveDispute(){
		try{
			$postData = $this->input->post();
			if(!empty($postData['block_name']) && !empty($postData['block_id'])){
				
				$orderId 			= isset($postData['orderId']) ? $postData['orderId'] : 0;
				$user_id 			= $this->session->userdata('user_id');
				$totalsteps 		= $postData['totalsteps'];
				$step 				= $postData['step'];
				$block_name 		= $postData['block_name'];
				$block_id 			= $postData['block_id'];
				$block_field_name	= $postData['block_field_name'];
				$module_selected	= $postData['module_selected'];
				
				//$dispute_Pf_id		= $postData['personal_profile'];
				//$is_name_checked	= $postData['is_name_checked'];
				//$is_knows_checked	= $postData['is_knows_checked'];
				//$is_dob_checked		= $postData['is_dob_checked'];
				//$address			= $postData['address'];
				
				//$dispute_creditInq_id 	= $postData['dispute_creditInq_id'];
				//$dispute_account_id		= $postData['dispute_account_id'];


				$dispute_Pf_id = (isset($postData['personal_profile']))?$postData['personal_profile']:[];
				$dispute_creditInq_id=(isset($postData['dispute_creditInq_id']))?$postData['dispute_creditInq_id']:[];
				$dispute_account_id = (isset($postData['dispute_account_id']))?$postData['dispute_account_id']:[];

				
				$dispute_personal_info  	= $this->Global_model->getDisputePersonalInfoSelected($dispute_Pf_id);
				
				//$orderDisputeProfile=[];
				if(!empty($dispute_Pf_id) && !empty($dispute_personal_info)){
					
					$this->Basic->deletedata(['order_id' => $orderId],'order_dispute_personal_info');
					
					foreach($dispute_personal_info as $resProfile){
						$disputePfId = $resProfile->id;
						
						$is_checked = $resProfile->is_checked;
						if (in_array($disputePfId,$postData['personal_profile'])){ 
							$is_checked = 1;
						}
						$is_name_checked 	= $postData['is_name_checked'][$disputePfId] ?? $resProfile->is_name_checked;
						$is_dob_checked 	= $postData['is_dob_checked'][$disputePfId] ?? $resProfile->is_dob_checked;
						$is_knows_checked 	= $postData['is_knows_checked'][$disputePfId] ?? $resProfile->is_knows_checked;
						
						$address 	= $postData['address'][$disputePfId] ?? [];
						
						$addressData = json_decode($resProfile->address);
						
						$personalAddress=[];
						if(!empty($address) && isset($address)){
							foreach($address as $getSelectedAddress){
								$addressId = $getSelectedAddress;
								foreach($addressData as $resAddress){
									if($addressId ==$resAddress->id){
										$personalAddress[]=[
											'id'		=> $resAddress->id,
											'checked'	=> 1,
											'text'		=> $resAddress->text,
										];
									}
								}
							}
						}
						
						$orderDisputeProfile=[
							'dispute_pf_id' 	=> $disputePfId,
							'user_id' 			=> $resProfile->user_id,
							'order_id' 			=> $orderId,
							'company_name' 		=> $resProfile->company_name,
							'name' 				=> $resProfile->name,
							'knownas' 			=> $resProfile->knownas,
							'dob'				=> $resProfile->dob,
							'address'			=> json_encode($personalAddress),
							'is_checked'		=> $is_checked,
							'is_name_checked'	=> $is_name_checked,
							'is_dob_checked'	=> $is_dob_checked,
							'is_knows_checked'	=> $is_knows_checked,
							'status'			=> $resProfile->status,
							'added_date'		=> date('Y-m-d H:i:s'),
							'last_updated_date' => date('Y-m-d H:i:s'),
							'is_bot_table'		=> $resProfile->is_bot_table
						];
						
						$this->Common->insert('order_dispute_personal_info',$orderDisputeProfile);
					}
				}
				
				$dispute_credit_enquiry 	= $this->Global_model->getDisputeCreditEnquirySelected($dispute_creditInq_id);
				
				if(!empty($dispute_credit_enquiry) && isset($dispute_credit_enquiry)){
					
					$this->Basic->deletedata(['order_id' => $orderId],'order_dispute_credit_inquiry');
					
					foreach($dispute_credit_enquiry as $getCreditEnquiry){
						$orderDisputeCredit=[
						'dispute_creditInq_id' => $getCreditEnquiry->dispute_creditInq_id,
						'user_id' 			=> $getCreditEnquiry->user_id,
						'order_id' 			=> $orderId,
						'company' 			=> $getCreditEnquiry->company,
						'date' 				=> $getCreditEnquiry->date,
						'bureau'			=> $getCreditEnquiry->bureau,
						'is_checked'		=> 1,
						'status'			=> $getCreditEnquiry->status,
						'added_date'		=> date('Y-m-d H:i:s'),
						'last_updated_date' => date('Y-m-d H:i:s'),
						];
						
						$this->Common->insert('order_dispute_credit_inquiry',$orderDisputeCredit);
					}
				}
				
				$dispute_account_history 	= $this->Global_model->getAccountHistorySelected($dispute_account_id);
				
				if(!empty($dispute_account_history) && isset($dispute_account_history)){
					
					$this->Basic->deletedata(['order_id' => $orderId],'order_dispute_account_history');
					
					foreach($dispute_account_history as $getaccountHistory){
						$orderAccountHistory=[
							'dispute_account_id' => $getaccountHistory->dispute_account_id,
							'user_id' 			 => $getaccountHistory->user_id,
							'order_id' 			 => $orderId,
							'company_title' 	 => $getaccountHistory->company_title,
							'account_type_id' 	 => $getaccountHistory->account_type_id,
							'account_ins_id' 	 => $getaccountHistory->account_ins_id,
							'is_checked'		 => 1,
							'status'			 => $getaccountHistory->status,
							'added_date'		 => date('Y-m-d H:i:s'),
							'last_updated_date'  => date('Y-m-d H:i:s')
						];
						
						$this->Common->insert('order_dispute_account_history',$orderAccountHistory);
					}
				}
				
				if(!empty($orderId)){
					$ordersData=[
						//'status'			=> 1,
						'step_stage'		=> $step,
						'last_updated_date'	=> date('Y-m-d H:i:s')
					];
					$this->Basic->updatedata($ordersData,['order_id' => $orderId],'orders');	
					
					$orderStepData=[
						'order_id' 			=> $orderId,
						'step' 				=> $step,
						'block_id'			=> $block_id,
						'block_name'		=> $block_name,
						'block_field_name'	=> $block_field_name,
						'added_date'		=> date('Y-m-d H:i:s'),
						'last_updated_date'	=> date('Y-m-d H:i:s')
					];
					
					$this->Basic->deletedata(['order_id' => $orderId,'block_id' => $block_id],'order_step');
					$this->Basic->deletedata(['order_id' => $orderId,'block_id' => $block_id],'order_detail');
					
					$order_step_Id = $this->Basic->insertdata($orderStepData,'order_step');
					
				}
				$this->session->set_flashdata('msg', 'Order Place Successfully!');
				
				$stepurl='';
				$redirectURL = 'completecheckout/';
				if($step<$totalsteps){
					$step =$step+1;
					$stepurl ='?step='.$step;
				}else if($step==$totalsteps){
					$stepurl ='?step='.$step.'&isbilling=1';
					$redirectURL = 'getpayment/';
				}
				redirect($redirectURL.$orderId.$stepurl);
				
				//redirect('order/myaccount/');
				//redirect('getpayment/'.$orderId);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', $e->getMessage());
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function demoOrderDetail($id=''){
				$data['title'] = 'Order Details'; 

        //support data starte here
        $data['support'] = $this->Project_model->gatallsupportorderbased($id);
		$data['ordersrow'] = $this->Project_model->getallorders('',$id);
		$data['order']  = $data['ordersrow'][0]; 

        // task status count
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'task');
		$task_status_all = $this->Basic->getmultiplerow($order,$where,'status');


			$order = 'id'.' '.'asc';
		$where = array();
		$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');

		$task_status=$task_count=[];

		if($task_status_all)
		{
			foreach ($task_status_all as $key => $task) 
			{
        $task_status[$task->status_id] =  $task->status_name;

        $task_status_output[$key] =  $task->status_name;
        $order = 'task_id'.' '.'desc';
		$where = array('task_status'=>$task->status_id,'order_id'=>$id,'is_delete'=>1);
		$task_all = $this->Basic->getmultiplerow($order,$where,'task');
		$task_count[$key] = count($task_all);
			}
		}

		$data['task_status'] = $task_status;
		$data['task_count'] = $task_count;
		$data['task_status_output'] = $task_status_output;

       // get all task status
		$order = 'task_id'.' '.'desc';
		$where = array('is_delete <>'=>2,'order_id'=>$id);
		$data['task'] = $this->Basic->getmultiplerow($order,$where,'task');
		// priority taken from table
        $order = 'id'.' '.'desc';
		$where = array();
		$data['priority'] = $this->Basic->getmultiplerow($order,$where,'priority');

        $priority_array = []; 
		foreach($data['priority'] as $priority)
		{
            $priority_array[$priority->id] =  $priority->priority;
		}

		$data['priority_array'] = $priority_array;

		$data['order_id'] = $id;

		//support related values
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'support');
		$support_status_all = $this->Basic->getmultiplerow($order,$where,'status');

        $support_status = $support_count = $support_status_output = [];
		foreach($support_status_all as $suppkey=>$supp)
		{
			$support_status[$supp->status_id] = $supp->status_name;

			$support_status_output[$suppkey] =  $supp->status_name;

			$order = 'support_id'.' '.'desc';
			$where = array('status'=>$supp->status_id,'order_id'=>$id,'parent_id'=>0);
			$support_all = $this->Basic->getmultiplerow($order,$where,'support');
			$support_count[$suppkey] = count($support_all);
		}

		$data['support_status'] = $support_status;
		$data['support_count'] = $support_count;
		$data['support_status_output'] = $support_status_output;

		//Get all activity
		$order = 'activity_id'.' '.'desc';
		$where = array('order_id'=>$id);
		$data['user_activity'] = $this->Basic->getmultiplerow($order,$where,'user_activity');

        
        //dispute items
		$data['disputeitems'] = $this->Project_model->disputeitems($id);

		$data['contract_sign_letter'] = '';


        if(!$this->session->userdata('tab'))
		$this->session->set_userdata('tab','project');

			//Get all activity
		$order = 'notes_id'.' '.'desc';
		$where = array('order_id'=>$id,'is_delete <>'=>2);
		$data['notes'] = $this->Basic->getmultiplerow($order,$where,'notes');
		$orderId=$id;
		$data['order_dynamic_block'] 	= $this->Product_model->getdynamicBlockByOrderId($orderId);

		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/demo_order_detail',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}
	function saveContract(){
		try{
			$postData = $this->input->post();
			if(!empty($postData['block_name']) && !empty($postData['block_id'])){
				
				$orderId 			= isset($postData['orderId']) ? $postData['orderId'] : 0;
				$user_id 			= $this->session->userdata('user_id');
				$totalsteps 		= $postData['totalsteps'];
				$step 				= $postData['step'];
				$block_name 		= $postData['block_name'];
				$block_id 			= $postData['block_id'];
				$block_field_name	= $postData['block_field_name'];
				$module_selected	= $postData['module_selected'];

				$orders = $this->Basic->getsinglerow(array('order_id'=>$orderId),'orders');
		        $user_id =  $orders->user_id;

				if(!empty($orderId))
				{
				$getUserDetail 	= $this->User_model->getUserDetailById($user_id);

		        if(!empty($getUserDetail))
		        {
		
			$resUser = $getUserDetail[0];

			$first_name = $resUser->first_name;
			$last_name 	= $resUser->last_name;
			$phone 		= $resUser->phone;
			$address 	= $resUser->address;
			$address1 	= $resUser->address1;
			$address2 	= $resUser->address2;
			$address3 	= $resUser->address3;
			$city 		= $resUser->city;
			$state 		= $resUser->state;
			$country 	= $resUser->country;
			$zipcode 	= $resUser->zipcode;
			
			$parent_user_id 	= $resUser->parent_user_id;
			$parentName  ='';
			if(!empty($parent_user_id)){
				$parentName  = orderusersname($parent_user_id);
			}
		}

			$this->load->library('pdf');

		    $where = array('user_id'=>$user_id,'order_id'=>$orderId);
            $contract_sign = $this->Basic->getsinglerow($where,'contract_sign');
            $data['contract_sign']=$contract_sign;
            if($contract_sign)
            $sign = '<img alt="" src="'.$contract_sign->sign.'" style="height:80px; width:250px" />';
            else
            $sign = '';	

        	// 17 - mobile , 18 - desktop
			$where = array('id' => (isMobile() ? 17:18));
			//$where = array('id' => (isMobile() ? 19:11)); // funding contract
		
			$creditcontracthere = $this->Basic->getsinglerow($where,'letter_templates');
			$message  = $creditcontracthere->message;
			
			$tempvalues = array('##SITENAME##'=>sitename(),'##LOGO##'=>sitelogo(),'##FIRSTNAME##'=>$first_name,'##LASTNAME##'=>$last_name,'##ADDRESS##'=>$address,'##CITY##'=>$city,'##date##'=>date('m/d/Y'),'##STATE##'=>$state,'##ZIP##'=>$zipcode,'##DATE##'=>date('m/d/Y'),'##BROKERNAME##'=>$parentName,'##SIGN##'=>$sign);
			$message = strtr($message,$tempvalues);
			$data['message']=$message;


		$signed_filename = $user_id.''.$orderId.''.strtotime("now");
		$this->pdf->generate($user_id,$data['message'],$signed_filename,'FALSE');
		
		$signedContractUrl = base_url('uploads/pdffiles/'.$user_id.'/'.$signed_filename.".pdf");

				$ordersData=[
					'contract_url'=>$signedContractUrl,
					'added_date'=> date('Y-m-d H:i:s')
				];
				$this->Basic->updatedata($ordersData,['order_id' => $orderId,'user_id' =>$user_id],'contract_sign');
				}

				$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Order Place Successfully!</div>');
			
				$stepurl='';
				if($step<$totalsteps){
					$step =$step+1;
					$stepurl ='?step='.$step;
				}else if($step==$totalsteps){
					$stepurl ='?step='.$step;
				}
				redirect('completecheckout/'.$orderId.$stepurl);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function creditcontract()
	  {
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$result = array();
		$imagedata = base64_decode($_POST['img_data']);
		$filename = md5(date("dmYhisA"));
		//Location to where you want to created sign image
		$file_name = 'uploads/pad/'.$filename.'.png';
		file_put_contents($file_name,$imagedata);
		$result['status'] = 1;
		$result['file_name'] = $file_name;
		
		$signed_url = base_url($file_name);

	    $order_id = $this->input->post('order_id');

		$orders = $this->Basic->getsinglerow(array('order_id'=>$order_id),'orders');

		$user_id =  $orders->user_id;

		$contract_sign = $this->Basic->getsinglerow(array('order_id'=>$order_id),'contract_sign');

		if(!$contract_sign)
		{
		$ordersData=[
					'user_id' 		=> $user_id,
					'order_id'		=> $order_id,
					'sign'	        => $signed_url,
					'added_date'	=> date('Y-m-d H:i:s')
				];
	     $this->Basic->insertdata($ordersData,'contract_sign');
		}
		else
		{
        	$ordersData=[
					'user_id' 		=> $user_id,
					'sign'	        => $signed_url,
					'added_date'	=> date('Y-m-d H:i:s')
				];

		$this->Basic->updatedata($ordersData,['order_id' => $order_id],'contract_sign');		
		}

		echo  "success";
	}


	function updatestatus()
	{
		$order_id = $this->input->post('order_id');
		$payment_status = $this->input->post('value');

		$ordersData=['payment_status' => $payment_status];

		$this->Basic->updatedata($ordersData,['order_id' => $order_id],'orders');

		$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Order Status Successfully!</div>');

		redirect($_SERVER['HTTP_REFERER']);
	}

	function getAllOrders()
	{
		$data['title'] = 'My Orders';

		 $orders = $this->Project_model->getallorders();

		 $data['orders'] = $orders;

		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'order');
		$orderstatusall = $this->Basic->getmultiplerow($order,$where,'status');

		$orderstatus = [];

		$orderstatus_count = [];

		if($orderstatusall)
		{
			foreach ($orderstatusall as $key => $value) 
			{
				$ordersorderstatus = $this->Project_model->getallorders($value->status_id);
				$orderstatus[$value->status_id] = $value->status_name;
				$orderstatus_count[$value->status_id] = count($ordersorderstatus);
			}
		}

	    $data['orderstatusall'] = $orderstatusall;

	    $data['orderstatus_count'] = $orderstatus_count;

	    $data['orderstatus'] = $orderstatus;

		$this->load->view('theme/prelayout/header',$data);	
		$this->load->view('theme/myaccount/user_account',$data);	

		$this->load->view('theme/prelayout/footer',$data);
	}

	function getOrderDetail($id='')
	{
		$data['title'] = 'Order Details'; 

		 //support data starte here
		$data['ordersrow'] = $this->Project_model->getallorders('',$id);
		$data['order']  = $data['ordersrow'][0]; 
		$userId = $data['order']->user_id;
		$orderId = $data['order']->order_id;
        // task status count
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'task','status'=>1);
		$task_status_all = $this->Basic->getmultiplerow($order,$where,'status');


		$order = 'id'.' '.'asc';
		$where = array();
		$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');

		$task_status=$task_count=[];

		if($task_status_all)
		{
			foreach ($task_status_all as $key => $task) 
			{
        $task_status[$task->status_id] =  $task->status_name;

        $task_status_output[$key] =  $task->status_name;
        $order = 'task_id'.' '.'desc';
		$where = array('task_status'=>$task->status_id,'order_id'=>$id,'is_delete'=>1);
		$task_all = $this->Basic->getmultiplerow($order,$where,'task');
		$task_count[$key] = count($task_all);
			}
		}

		$data['task_status'] = $task_status;
		$data['task_count'] = $task_count;
		$data['task_status_output'] = $task_status_output;

		// priority taken from table
        $order = 'id'.' '.'desc';
		$where = array();
		$data['priority'] = $this->Basic->getmultiplerow($order,$where,'priority');

        $priority_array = []; 
		foreach($data['priority'] as $priority)
		{
            $priority_array[$priority->id] =  $priority->priority;
		}

		$data['priority_array'] = $priority_array;
		
		$data['order_id'] = $orderId;
		
		//support related values
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'support','status'=>1);
		$support_status_all = $this->Basic->getmultiplerow($order,$where,'status');

        $support_status = $support_count = $support_status_output = [];
		foreach($support_status_all as $suppkey=>$supp)
		{
			$support_status[$supp->status_id] = $supp->status_name;

			$support_status_output[$suppkey] =  $supp->status_name;

			$order = 'support_id'.' '.'desc';
			$where = array('status'=>$supp->status_id,'order_id'=>$id,'parent_id'=>0,'is_delete'=>1);
			$support_all = $this->Basic->getmultiplerow($order,$where,'support');
			$support_count[$suppkey] = count($support_all);
		}

		$data['support_status'] = $support_status;
		$data['support_count'] = $support_count;
		$data['support_status_output'] = $support_status_output;


		$ordersrow = $this->Project_model->getallorders('',$id);
		$data['order']  = $ordersrow[0]; 
		$userId 		= $data['order']->user_id;
		$orderId 		= $data['order']->order_id;
		$data['order_id'] = $orderId;
		$data['order_dynamic_block'] 	= $this->Global_model->getOrderBlockListbyOrderId($orderId);

		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/order_detail_vertical',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}

	function getOrderDetailAjax($id='')
	{
		$data['title'] = 'Order Details'; 

		 //support data starte here
		$data['ordersrow'] = $this->Project_model->getallorders('',$id);
		$data['order']  = $data['ordersrow'][0]; 
		$userId = $data['order']->user_id;
		$orderId = $data['order']->order_id;
        // task status count
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'task','status'=>1);
		$task_status_all = $this->Basic->getmultiplerow($order,$where,'status');


		$order = 'id'.' '.'asc';
		$where = array();
		$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');

		$task_status=$task_count=[];

		if($task_status_all)
		{
			foreach ($task_status_all as $key => $task) 
			{
        $task_status[$task->status_id] =  $task->status_name;

        $task_status_output[$key] =  $task->status_name;
        $order = 'task_id'.' '.'desc';
		$where = array('task_status'=>$task->status_id,'order_id'=>$id,'is_delete'=>1);
		$task_all = $this->Basic->getmultiplerow($order,$where,'task');
		$task_count[$key] = count($task_all);
			}
		}

		$data['task_status'] = $task_status;
		$data['task_count'] = $task_count;
		$data['task_status_output'] = $task_status_output;

		// priority taken from table
        $order = 'id'.' '.'desc';
		$where = array();
		$data['priority'] = $this->Basic->getmultiplerow($order,$where,'priority');

        $priority_array = []; 
		foreach($data['priority'] as $priority)
		{
            $priority_array[$priority->id] =  $priority->priority;
		}

		$data['priority_array'] = $priority_array;
		
		$data['order_id'] = $orderId;
		
		//support related values
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'support','status'=>1);
		$support_status_all = $this->Basic->getmultiplerow($order,$where,'status');

        $support_status = $support_count = $support_status_output = [];
		foreach($support_status_all as $suppkey=>$supp)
		{
			$support_status[$supp->status_id] = $supp->status_name;

			$support_status_output[$suppkey] =  $supp->status_name;

			$order = 'support_id'.' '.'desc';
			$where = array('status'=>$supp->status_id,'order_id'=>$id,'parent_id'=>0,'is_delete'=>1);
			$support_all = $this->Basic->getmultiplerow($order,$where,'support');
			$support_count[$suppkey] = count($support_all);
		}

		$data['support_status'] = $support_status;
		$data['support_count'] = $support_count;
		$data['support_status_output'] = $support_status_output;


		$ordersrow = $this->Project_model->getallorders('',$id);
		$data['order']  = $ordersrow[0]; 
		$userId 		= $data['order']->user_id;
		$orderId 		= $data['order']->order_id;
		$data['order_id'] = $orderId;
		$data['order_dynamic_block'] 	= $this->Global_model->getOrderBlockListbyOrderId($orderId);
		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/order_detail_vertical_ajax',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}


	function getOrderajaxsingle($orderId,$blockId,$stepno)
	{
           if(!empty($orderId) && !empty($blockId) && !empty($stepno))
           {
           	    $getOrderData = $this->Project_model->getallorders('',$orderId);
				$data['order']  = $getOrderData[0]; 

				$data['pre_dynamic_block'] 	= $this->Product_model->getdynamicBlockByOrderId($orderId);
				$data['orderId'] 		= $orderId;

				$data['stepno'] 		= $stepno;

				$order = 'id'.' '.'desc';
				$where = array();
				$data['priority'] = $this->Basic->getmultiplerow($order,$where,'priority');
				$priority_array = []; 
				foreach($data['priority'] as $priority){
					$priority_array[$priority->id] =  $priority->priority;
				}
				$data['priority_array'] = $priority_array;

				$orders = $this->Basic->getsinglerow(array('order_id'=>$orderId),'orders');	

				$userId = $orders->user_id;

				//$order_details = $this->Basic->getsinglerow(array('order_id'=>$orderId),'order_items_detail');

				$productId = $orders->product_id;

				$data['dynamic_block'] = $this->Product_model->getdynamicBlockByProductId($productId);

				$data['contract_sign_letter'] = $this->Global_model->getContractLetterByUserId($userId,$orderId);
				$data['dispute_items'] = $this->Global_model->selectYouDisputeItem($orderId,$userId);


	             $order = 'status_id'.' '.'asc';
					$where = array('type'=>'task','status'=>1);
					$task_status_all = $this->Basic->getmultiplerow($order,$where,'status');
					$task_status=$task_count=[];

					if($task_status_all){
						foreach ($task_status_all as $key => $task){
							$task_status[$task->status_id] =  $task->status_name;
							$task_status_output[$key] =  $task->status_name;
							$order = 'task_id'.' '.'desc';
							$where = array('task_status'=>$task->status_id,'order_id'=>$orderId,'is_delete'=>1);
							$task_all = $this->Basic->getmultiplerow($order,$where,'task');
							$task_count[$key] = count($task_all);
						}
					}

					$data['task_status'] = $task_status;
					$data['task_count'] = $task_count;
					$data['task_status_output'] = $task_status_output;

					$order = 'task_id'.' '.'desc';
					$where = array('is_delete <>'=>2,'order_id'=>$orderId);
					$data['task'] = $this->Basic->getmultiplerow($order,$where,'task');

					/*$order = 'notes_id'.' '.'desc';
					$where = array('order_id'=>$orderId,'is_delete <>'=>2,'parent_id'=>0);
					$data['notes'] = $this->Basic->getmultiplerow($order,$where,'notes');*/

					 $data['notes'] = $this->Project_model->getallnotesbasedonorder($orderId);




						$order = 'id'.' '.'asc';
					$where = array();
					$data['support_depart'] = $this->Basic->getmultiplerow($order,$where,'support_depart');
					$data['support'] = $this->Project_model->gatallsupportorderbased($orderId);

					
					
					//support related values
					$order = 'status_id'.' '.'asc';
					$where = array('type'=>'support','status'=>1);
					$support_status_all = $this->Basic->getmultiplerow($order,$where,'status');

					$support_status = $support_count = $support_status_output = [];
					foreach($support_status_all as $suppkey=>$supp)
					{
						$support_status[$supp->status_id] = $supp->status_name;

						$support_status_output[$suppkey] =  $supp->status_name;

						$order = 'support_id'.' '.'desc';
						$where = array('status'=>$supp->status_id,'order_id'=>$orderId,'parent_id'=>0);
						$support_all = $this->Basic->getmultiplerow($order,$where,'support');
						$support_count[$suppkey] = count($support_all);
					}

					$data['support_status'] = $support_status;
					$data['support_count'] = $support_count;
					$data['support_status_output'] = $support_status_output;


		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/myaccount/order_detail_vertical_ajax',$data);
		$this->load->view('theme/prelayout/footer',$data);
		}
	}
	function payment(){
		try{
			//echo "<pre>";
			$postData = $this->input->post();
			if(isset($postData['billing_info'])){
				$billing_info 		= json_encode($postData['billing_info']);
				$price				= $postData['price'];
				$payment_method		= $postData['payment_method'];
				$price = preg_replace("/[^0-9]/", "", $price);
				
					$nextOrderId = $this->Common->getMaxNumber('orders',[] ,'order_id');
					$today = strtotime(date("Ymd"));
					$rand = sprintf("%04d", rand(0,9999));
					$orderNumber = $nextOrderId.'-'.$today . $rand;
						
					$ordersData=[
						'order_number'		=> $orderNumber,
						'user_id' 			=> $this->session->userdata('id'),
						'order_amount' 		=> $price,
						'billing_info'		=> $billing_info,
						'payment_method'	=> $payment_method,
						'order_type'		=> 2,
						'membership_plan'	=> $postData['product_name'],
						'membership_price'	=> $price,
						'status'			=> 1,
						'payment_status'	=> 1,
						'created_by'		=> $this->session->userdata('id'),
						'added_date'		=> date('Y-m-d H:i:s'),
						'last_updated_date'	=> date('Y-m-d H:i:s')
					];
					$orderId = $this->Basic->insertdata($ordersData,'orders');
					if($orderId){
						$this->Basic->updatedata(['is_membership_activated' => 1],['id' => $this->session->userdata('id')],'users');
						unset($_SESSION['membership_plan_id']);
					}
					
					//$this->Project_model->sentorderemail($orderId);

					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Order Place Successfully!</div>');
				
					redirect('order/myaccount/');
			}		
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	function bottable($order_id){
		
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['titile'] = 'Bot Table';
		
		$data['instruction'] 	= $this->Common->select('instruction');
		$data['credit_report_reason'] = $this->Common->select('credit_report_reason',array('parent_id'=>'0'));
		
		$data['ins'] = $this->Common->select('credit_report_reason',array('parent_id !='=>'0'));
		$data['sidebar'] = $this->Basic->orderbasicdetails($order_id);
		$data['ordersrow'] = $this->Project_model->getallorders('',$order_id);
		$data['orders']  = $data['ordersrow'][0]; 

		$data['order_id'] = $order_id;

		//$data['dispute_items'] = $this->Basic->Getdisputeitems($order_id,$data['orders']->user_id);
		$data['dispute_items'] = $this->Basic->getSelectedDisputeitems($order_id,$data['orders']->user_id,'bottable');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/admin/order/bot_table',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function changereason()
	{
		$value = $this->input->post('value');
		$order = 'id'.'  '.'desc';
		$where = array('parent_id'=>$value);
		$credit_report_reason = $this->Basic->getmultiplerow($order,$where,'credit_report_reason');

		$option = '';

		foreach ($credit_report_reason as $key => $valuearray) 
		{
           $option .= '<option value="'.$valuearray->title.'">'.$valuearray->title.'</option>';	
		}

		echo $option;
	}

	function createletter($order_id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['titile'] = 'Create Letter';

		$data['sidebar'] = $this->Basic->orderbasicdetails($order_id);

		$data['ordersrow'] = $this->Project_model->getallorders('',$order_id);
		$data['orders']  = $data['ordersrow'][0]; 

		$data['order_id'] = $order_id;

		//$data['dispute_items'] = $this->Basic->Getdisputeitems($order_id,$data['orders']->user_id);
		
		$data['dispute_items'] = $this->Basic->getSelectedDisputeitems($order_id,$data['orders']->user_id);

		$data['letter_templates'] = $this->Common->select('letter_templates');
		
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/admin/order/createletter',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function generateLetter($order_id)
	{
      
       if($this->input->post('letter_id'))
       {
       	$letter_id = $this->input->post('letter_id');
       	$this->session->set_userdata('letter_id',$this->input->post('letter_id'));
       }
       else
       {
       	$letter_id = $this->session->userdata('letter_id');
       }

		$data['ordersrow'] = $this->Project_model->getallorders('',$order_id);
		$data['orders']  = $data['ordersrow'][0]; 

		$data['order_id'] = $order_id;
		$dispute_items = $this->Basic->Getdisputeitems($order_id,$data['orders']->user_id);

		$personalInfo = $dispute_items['personalInfo'];
		$creditInquiry = $dispute_items['creditInquiry'];
		$accountHistory = $dispute_items['accountHistory'];
		$selectedDisputeItem = $dispute_items['selectedDisputeItem'];


		if(isset($selectedDisputeItem['creditInquiry']))
		{
		  $creditselected =[];
		  foreach($selectedDisputeItem['creditInquiry'] as $credit)
		  {
			 $creditselected[] = $credit->dispute_creditInq_id;
		  }
		}


		if(isset($selectedDisputeItem['accountHistoryselected']))
		{
			$disputeitems =[];
			foreach($selectedDisputeItem['accountHistoryselected'] as $dispute)
			{
			$disputeitems[] = $dispute['dispute_account_id'];
			}
		}


		$persoanaldetails =[];    

		foreach($personalInfo as $perinfo){
			$name = $knownas = $dob = $company ='';
			$name = $perinfo->name;
			$knownas = $perinfo->knownas;
			$dob = $perinfo->dob;
			$company = $perinfo->company_name;
			$addresshereexp = [];
			$id  = $perinfo->id;

				if(isset($selectedDisputeItem['personalInfo']->$id))
				{
				  $is_name_checked = $selectedDisputeItem['personalInfo']->$id->is_name_checked;
				  $is_dob_checked = $selectedDisputeItem['personalInfo']->$id->is_dob_checked;
				  $is_knows_checked = $selectedDisputeItem['personalInfo']->$id->is_knows_checked;
				  $addressarray = json_decode($selectedDisputeItem['personalInfo']->$id->address);
				}
				else
				{
				   $is_name_checked = $is_dob_checked = $is_knows_checked='';
				   $addressarray = [];
				}
			
			  if(!empty($perinfo->address) && isset($perinfo->address)){
				$address =@json_decode($perinfo->address) ?? [];
				if(!empty($perinfo->address)){
				foreach($address as $newkey=>$getaddress){
				  if(isset($addressarray[$newkey]) && $addressarray[$newkey]->checked==1) {
					$addresshereexp[] =$addressarray[$newkey]->text;
				} }}
			  }


				$add1=$add2=$add3='';
				 if(isset($addresshereexp))
				{
				$add1 = (isset($addresshereexp[0]) && $addresshereexp)?$addresshereexp[0]:'';
				$add2 = (isset($addresshereexp[1]) && $addresshereexp)?$addresshereexp[1]:'';
				$add3 = (isset($addresshereexp[2]) && $addresshereexp)?$addresshereexp[2]:'';
				}
				else
				{
					$add1=$add2=$add3='';
				}

				$personal ='';
				$personal .= ($name!='')?'Name : '.$name.'<br>':'';
				$personal .= ($knownas!='')?'Also Known As : '.$knownas.'<br>':'';
				$personal .= ($dob!='')?'Year of Birth : '.$dob.'<br>':'';
				$personal .= ($add1!='')?''.$add1.'<br>':'';
				$personal .= ($add2!='')?''.$add2.'<br>':'';
				$personal .= ($add3!='')?''.$add3.'<br>':'';
				$persoanaldetails[$company] = $personal;
		  }

		$experian = $equaifax = $transunion = '';

		foreach ($creditInquiry as $key => $credit) 
		{
			if($credit->bureau=='Experian')
			{
               $experian .= $credit->company.'---'.$credit->date.'<br>'; 
			}
			else if($credit->bureau=='Equifax')
			{
               $equaifax .= $credit->company.'---'.$credit->date.'<br>'; 
			}
			else
			{
                $transunion .= $credit->company.'---'.$credit->date.'<br>'; 
			}
		}


		$number1 = $number2 = $number3 = 1;
		$textnewexperian = $textnewequifax = $textnewtrans ='';



		 foreach($accountHistory as $acchis){
				if(in_array($acchis['dispute_account_id'],$disputeitems))
					$checked ='checked';
				else
					$checked ='';

				if($checked=='checked'){
					$account_historylist = $acchis['account_historylist'];
					foreach($account_historylist as $getaccthistory)
					{
					  $dispute_acct_his_detail_id = $getaccthistory['dispute_acct_his_detail_id'];
					  $company_title  = $getaccthistory['company_title'];
					  $accountno    = $getaccthistory['accountno'];
					  $paymentstatus  = $getaccthistory['paymentstatus'];
					  $comments     = $getaccthistory['comments'];
					  $dateopened   = $getaccthistory['dateopened'];
					  $balance    = $getaccthistory['balance'];
					  $account_status = $getaccthistory['account_status'];
					  $reason     = $getaccthistory['reason'];
					  $instruction  = $getaccthistory['instruction'];

						$reason = 'Identity Theft';
						$instart = 'Remove From My Report';

						if($company_title=='experian'){
							 $textnewexperian .= $number1.'. '.$company_title.'<br>'.
								' Account  #: '.$accountno.'<br>'.
								' Balance  : '.$balance.'<br>'.
								' Reason  : '.$reason.'<br>'.$instart.'<br>';
								 $number1 = $number1 + 1;
						}
						else if($company_title=='equifax'){
							$textnewequifax .= $number2.'. '.$company_title.'<br>'.
								' Account  #: '.$accountno.'<br>'.
								' Balance  : '.$balance.'<br>'.
								' Reason  : '.$reason.'<br>'.$instart.'<br>';
								 $number2 = $number2 + 1;
						}
						else{
							   $textnewtrans .= $number3.'. '.$company_title.'<br>'.
								' Account  #: '.$accountno.'<br>'.
								' Balance  : '.$balance.'<br>'.
								' Reason  : '.$reason.'<br>'.$instart.'<br>';
								 $number3 = $number3 + 1;
						}   
					} 
				} 
		  }


		$users 			= $this->User_model->getUserDetailById($data['orders']->user_id);
		
		$getPersonalInfo = $this->Global_model->getPersonalInfomationByOrderId($order_id);
		
		$usersdetails 	= $users[0];
		$firstname 		= $getPersonalInfo['first-name'];
		$lastname 		= $getPersonalInfo['last-name'];
		$addressclient  = $getPersonalInfo['address'];
		$city 			= $getPersonalInfo['city'];
		$state 			= $getPersonalInfo['state'];
		$pincode 		= $getPersonalInfo['zip'];
		$mobileno	 	= $getPersonalInfo['phone'];
		$email	 		= $getPersonalInfo['email'];
		$dob			= $getPersonalInfo['date-of-birth'] ?? '';
		$ssn			= $getPersonalInfo['ssn-#'];
		$gender 		= 'Male';

        $mother_name 		= (isset($usersdetails->mother_name))? $usersdetails->mother_name:'';
        $old_address 		= (isset($usersdetails->old_address))? $usersdetails->old_address:'';
        $old_city 			= (isset($usersdetails->old_city))? $usersdetails->old_city:'';
        $old_state 			= (isset($usersdetails->old_state))? $usersdetails->old_state:'';
        $old_zip 			= (isset($usersdetails->old_zip))? $usersdetails->old_zip:'';
        $old_month_payment  = (isset($usersdetails->old_month_payment))? $usersdetails->old_month_payment:
        $license 			= (isset($usersdetails->license))? $usersdetails->license:'';
        $state_issue 		=(isset($usersdetails->state_issue))? $usersdetails->state_issue:'';
        $exp_date 			= (isset($usersdetails->exp_date))? $usersdetails->exp_date:'';
        $primary_bank 		= (isset($usersdetails->primary_bank))? $usersdetails->primary_bank:'';
        $current_employer 	= (isset($usersdetails->current_employer))? $usersdetails->current_employer:'';
        $emp_how_long 		= (isset($usersdetails->emp_how_long))? $usersdetails->emp_how_long:'';
        $emp_address 		= (isset($usersdetails->emp_address))? $usersdetails->emp_address:'';
        $emp_city 			= (isset($usersdetails->emp_city))? $usersdetails->emp_city:'';
        $emp_state 			= (isset($usersdetails->emp_state))? $usersdetails->emp_state:'';
        $emp_zip 			= (isset($usersdetails->emp_zip))? $usersdetails->emp_zip:'';
        $emp_phone 			= (isset($usersdetails->emp_phone))? $usersdetails->emp_phone:'';
        $emp_fax 			= (isset($usersdetails->emp_fax))? $usersdetails->emp_fax:'';
        $emp_email 			= (isset($usersdetails->emp_email))? $usersdetails->emp_email:'';
        $emp_position 		= (isset($usersdetails->emp_position))? $usersdetails->emp_position:'';
        $hour_salary 		= (isset($usersdetails->hour_salary))? $usersdetails->hour_salary:'';
        $annual_income 		= (isset($usersdetails->annual_income))? $usersdetails->annual_income:'';
        $middlename 		= (isset($usersdetails->middlename))? $usersdetails->middlename:'';
        $date = date('m/d/Y');
        $time = date('H:i:s');

       /* if($usersdetails->dob!='')
            $dob = date("m/d/Y", strtotime($usersdetails->dob));
        else
            $dob ='';*/

        //$ssn = $usersdetails->ssn;

        //$mobileno = $usersdetails->phone;

        $where = array('sign !='=>NULL,'order_id'=>$order_id);
        $contract_sign = $this->Basic->getsinglerow($where,'contract_sign');

		if($contract_sign)
		$sign ="<img  src='".$contract_sign->sign."' width='250' >";
		else
		$sign='';	
 

         $where = array('id'=>$letter_id);
         $data['letter'] = $this->Basic->getsinglerow($where,'letter_templates');


		$personalexp  = $persoanaldetails['experian'];

           //experian message
        $tempvalues = array('##SIGN##'=>$sign,'##FIRSTNAME##'=>$firstname,'##LASTNAME##'=>$lastname,'##ADDRESS##'=>$addressclient,'##CITY##'=>$city,'##STATE##'=>$state,'##ZIP##'=>$pincode,'##DOB##'=>$dob,'##SSN##'=>$ssn,'##MOBILE##'=>$mobileno,'##GENDER##'=>$gender,'##MOTHERNAME##'=>$mother_name,'##PREVIOUSADDRESS##'=>$old_address,'##OLDCITY##'=>$old_city,'##OLDSTATE##'=>$old_state,'##OLDZIP##'=>$old_zip,'##OLDPAYMENT##'=>$old_month_payment,'##LICENSE##'=>$license,'##LICENSESTATE##'=>$state_issue,'##EXPIREDATE##'=>$exp_date,'##BANK##'=>$primary_bank,'##EMPLOYER##'=>$current_employer,'##HOWLONG##'=>$emp_how_long,'##EMPADDRESS##'=>$emp_address,'##EMPCITY##'=>$emp_city,'##EMPSTATE##'=>$emp_state,'##EMPZIP##'=>$emp_zip,'##EMPPHONE##'=>$emp_phone,'##EMPFAX##'=>$emp_fax,'##EMPEMAIL##'=>$emp_email,'##EMPPOSITION##'=>$emp_position ,'##HOURSALARY##'=>$hour_salary,'##EMPANNUAL##'=>$annual_income,'##DATE##'=>$date,'##TIME##'=>$time,'##PERSONAL##'=>$personalexp,'##CREDIT##'=>$experian,'##ACCOUNT##'=>trim($textnewexperian),'##EXPERIAN##'=>'Experian <br> P.O. Box 4500 <br> Allen , TX 75013 <br>');

        $message = strtr($data['letter']->message,$tempvalues);
		

		$personalequ  = $persoanaldetails['equifax'];      

        //equafix message
         $tempvalues1 = array('##SIGN##'=>$sign,'##FIRSTNAME##'=>$firstname,'##LASTNAME##'=>$lastname,'##ADDRESS##'=>$addressclient,'##CITY##'=>$city,'##STATE##'=>$state,'##ZIP##'=>$pincode,'##DOB##'=>$dob,'##SSN##'=>$ssn,'##MOBILE##'=>$mobileno,'##GENDER##'=>$gender,'##MOTHERNAME##'=>$mother_name,'##PREVIOUSADDRESS##'=>$old_address,'##OLDCITY##'=>$old_city,'##OLDSTATE##'=>$old_state,'##OLDZIP##'=>$old_zip,'##OLDPAYMENT##'=>$old_month_payment,'##LICENSE##'=>$license,'##LICENSESTATE##'=>$state_issue,'##EXPIREDATE##'=>$exp_date,'##BANK##'=>$primary_bank,'##EMPLOYER##'=>$current_employer,'##HOWLONG##'=>$emp_how_long,'##EMPADDRESS##'=>$emp_address,'##EMPCITY##'=>$emp_city,'##EMPSTATE##'=>$emp_state,'##EMPZIP##'=>$emp_zip,'##EMPPHONE##'=>$emp_phone,'##EMPFAX##'=>$emp_fax,'##EMPEMAIL##'=>$emp_email,'##EMPPOSITION##'=>$emp_position ,'##HOURSALARY##'=>$hour_salary,'##EMPANNUAL##'=>$annual_income,'##DATE##'=>$date,'##TIME##'=>$time,'##PERSONAL##'=>$personalequ,'##CREDIT##'=>$equaifax,'##ACCOUNT##'=>trim($textnewequifax),'##EXPERIAN##'=>'Equifax Information Services LLC <br> P.O. Box 740256 <br> Atlanta , GA 30374 - 0256 <br>');

			$message1 = strtr($data['letter']->message,$tempvalues1);

          $personaltrans  = $persoanaldetails['transUnion']; 

        //transunion message2

         $tempvalues2 = array('##SIGN##'=>$sign,'##FIRSTNAME##'=>$firstname,'##LASTNAME##'=>$lastname,'##ADDRESS##'=>$addressclient,'##CITY##'=>$city,'##STATE##'=>$state,'##ZIP##'=>$pincode,'##DOB##'=>$dob,'##SSN##'=>$ssn,'##MOBILE##'=>$mobileno,'##GENDER##'=>$gender,'##MOTHERNAME##'=>$mother_name,'##PREVIOUSADDRESS##'=>$old_address,'##OLDCITY##'=>$old_city,'##OLDSTATE##'=>$old_state,'##OLDZIP##'=>$old_zip,'##OLDPAYMENT##'=>$old_month_payment,'##LICENSE##'=>$license,'##LICENSESTATE##'=>$state_issue,'##EXPIREDATE##'=>$exp_date,'##BANK##'=>$primary_bank,'##EMPLOYER##'=>$current_employer,'##HOWLONG##'=>$emp_how_long,'##EMPADDRESS##'=>$emp_address,'##EMPCITY##'=>$emp_city,'##EMPSTATE##'=>$emp_state,'##EMPZIP##'=>$emp_zip,'##EMPPHONE##'=>$emp_phone,'##EMPFAX##'=>$emp_fax,'##EMPEMAIL##'=>$emp_email,'##EMPPOSITION##'=>$emp_position ,'##HOURSALARY##'=>$hour_salary,'##EMPANNUAL##'=>$annual_income,'##DATE##'=>$date,'##TIME##'=>$time,'##PERSONAL##'=>$personaltrans,'##CREDIT##'=>$transunion,'##ACCOUNT##'=>trim($textnewtrans),'##EXPERIAN##'=>'TransUnion LLC Consumer Dispute Center <br> PO Box 2000 <br> Chester , PA 19016 <br>');

        $message2 = strtr($data['letter']->message,$tempvalues2);

        $this->load->library('pdf');

        $where = array('id'=>$letter_id);
        $dynamic_letters = $this->Basic->getsinglerow($where,'letter_templates');

        $words = explode(" ",$dynamic_letters->subject);
        $acronym = "";
        foreach ($words as $w) {
			
			if(isset($w[0]))
            $acronym .= $w[0];
        }

        $user_id = $data['orders']->user_id;

        $message = str_replace('&nbsp;'," " ,$message);
        $message1 = str_replace('&nbsp;'," " ,$message1);
        $message2 = str_replace('&nbsp;'," " ,$message2);

        $message = str_replace('&',"",$message);
        $message1 = str_replace('&',"" ,$message1);
        $message2 = str_replace('&',"" ,$message2);

        $expe = $lastname.'_experian_'.strtotime("now");
        $this->pdf->generate($user_id,$message,$expe,'FALSE');

        $equifax = $lastname.'_equifax_'.strtotime("now");
        $this->pdf->generate($user_id,$message1,$equifax,'FALSE');

        $trans = $lastname.'_transunion_'.strtotime("now");
        $this->pdf->generate($user_id,$message2,$trans,'FALSE');
        $insertdata = array('user_id'=>$user_id,
            'letter_format'=>$data['letter']->subject,
            'experian'=>$message,
            'equifax'=>$message1,
            'transunion'=>$message2,
            'exprian_pdf'=>base_url('uploads/pdffiles/'.$user_id.'/'.$expe.'.pdf'),
            'equifax_pdf'=>base_url('uploads/pdffiles/'.$user_id.'/'.$equifax.'.pdf'),
            'trans_pdf'=>base_url('uploads/pdffiles/'.$user_id.'/'.$trans.'.pdf'),
            'final_trans_pdf'=>$trans.'.pdf',
            'final_exprian_pdf'=>$expe.'.pdf',
            'final_equifax_pdf'=>$equifax.'.pdf',
            'datetime'=>date('Y-m-d H;i:s'));

        $commonletterid = $this->Basic->insertdata($insertdata,'letters');

        $common[] = ['title'=>'Experian','message'=>$message];
        $common[] = ['title'=>'Equifax','message'=>$message1];
        $common[] = ['title'=>'Transunioin','message'=>$message2];

		$ItemList['letters'] = $common;
		$ItemList['user_id'] = $user_id;
        $ItemList['letter_format'] = $data['letter']->subject;
        $ItemList['letter_id'] = $letter_id;
        $ItemList['commonletterid'] = $commonletterid;
        $ItemList['order_id'] =$order_id;
      
        redirect('Order/submitlettersbefore/'.$order_id.'/'.$commonletterid);
		exit();
	}


	function submitlettersbefore($order_id,$commonletterid)
	{
				$data['titile'] = 'Generate Letters';
				$data['sidebar'] = $this->Basic->orderbasicdetails($order_id);

				$data['ordersrow'] = $this->Project_model->getallorders('',$order_id);
				$data['orders']  = $data['ordersrow'][0]; 

				$data['order_id'] = $order_id;

				$user_id  = $data['orders']->user_id; 

				$where = array('id'=>$commonletterid);
				$letters = $this->Basic->getsinglerow($where,'letters');

				$message = $letters->experian;
				$message1 = $letters->equifax;
				$message2 = $letters->transunion;

				$common[] = ['title'=>'Experian','message'=>$message];
				$common[] = ['title'=>'Equifax','message'=>$message1];
				$common[] = ['title'=>'Transunioin','message'=>$message2];

				$ItemList['letters'] = $common;
				$ItemList['user_id'] = $user_id;
				$ItemList['letter_format'] = $letters->letter_format;
				$ItemList['letter_id'] = $commonletterid;
				$ItemList['commonletterid'] = $commonletterid;
				$ItemList['order_id'] =$order_id;


				$this->load->view('theme/layout/header',$data);
				$this->load->view('theme/myaccount/admin/order/submitletter',$ItemList);
				$this->load->view('theme/layout/footer',$data);    
	}


	function submitletters()
	{
		    $message = $this->input->post('message');
			$message1 = $this->input->post('message1');
			$message2 = $this->input->post('message2');

			$letterid = $this->input->post('letter_id');
			$user_id = $this->input->post('user_id');
			$order_id = $this->input->post('OrderId');
			$commonletterid = $this->input->post('commonletterid');


		if($message)
		{
			$where = array('id'=>$commonletterid);
			$letters = $this->Basic->getsinglerow($where,'letters');


			if(file_exists(base_url('uploads/pdffiles/'.$letters->user_id.'/'.$letters->exprian_pdf)))
			unlink(base_url('uploads/pdffiles/'.$letters->user_id.'/'.$letters->exprian_pdf));

			if(file_exists(base_url('uploads/pdffiles/'.$letters->user_id.'/'.$letters->equifax_pdf)))
			unlink(base_url('uploads/pdffiles/'.$letters->user_id.'/'.$letters->equifax_pdf));

			if(file_exists(base_url('uploads/pdffiles/'.$letters->user_id.'/'.$letters->trans_pdf)))
			unlink(base_url('uploads/pdffiles/'.$letters->user_id.'/'.$letters->trans_pdf));

		    $this->load->library('pdf');

			$words = explode(" ",$letters->letter_format);
			$acronym = "";
			foreach ($words as $w) {
				$acronym .= $w[0];
			}

			$expe = $acronym.'_experian_'.strtotime("now");
			$this->pdf->generate($user_id,$message,$expe,'FALSE');
			
			$equifax = $acronym.'_equifax_'.strtotime("now");
			$this->pdf->generate($user_id,$message1,$equifax,'FALSE');		
			
			$trans = $acronym.'_transunion_'.strtotime("now");
			$this->pdf->generate($user_id,$message2,$trans,'FALSE');

			$where = array('id'=>$letterid);
			$update_data = array('exprian_pdf'=>base_url('uploads/pdffiles/'.$user_id.'/'.$expe.'.pdf'),
	                'equifax_pdf'=>base_url('uploads/pdffiles/'.$user_id.'/'.$equifax.'.pdf'),
	                'trans_pdf'=>base_url('uploads/pdffiles/'.$user_id.'/'.$trans.'.pdf'),
					'final_trans_pdf'=>$trans.'.pdf',
					'final_exprian_pdf'=>$expe.'.pdf',
					'final_equifax_pdf'=>$equifax.'.pdf',
	                 );
			 		$this->Basic->updatedata($update_data,$where,'letters');

					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Letters has been added successfully</div>');

  				redirect('Order/letters/'.$order_id);
		}
	}


	function letters($order_id)
	{
		$data['titile'] = 'Letters';

		$data['sidebar'] = $this->Basic->orderbasicdetails($order_id);

		$data['ordersrow'] = $this->Project_model->getallorders('',$order_id);
		$data['orders']  = $data['ordersrow'][0]; 

		$data['order_id'] = $order_id;

		$user_id  = $data['orders']->user_id; 

		$order = 'id'.'  '.'desc';
		$where = array('user_id'=>$user_id);
		$data['letters'] = $this->Basic->getmultiplerow($order,$where,'letters');


		/*$data['statelist'] = $this->Common->select('state');
        $data['countrylist'] = $this->Common->select('countries');
        $data['status_list'] = $this->Common->select('status');


        $data["consumer"] = $this->getBotLogIds("CONSUMERFINANCE", $id);
        $data["lexisnexis"] = $this->getBotLogIds("LEXISNEXIS", $id);
        $data["bot_labels"] = $this->getBotLogIds("CERTIFIEDLABELCREATOR", $id);
        $data["iptv_sub_extender"] = $this->getBotLogIds("IPTVSubscriptionUpdater", $id);
        $data["ftc"] = $this->getBotLogIds("FTC", $id);
        // var_dump($this->getBotLogIds("FTC", $id));
        // die;

        $data["consumerWhichBots"] = $this->getWhichBots($id, "CONSUMERFINANCE");
        $data["rssUrls"] = null;
        $data["iptv_login"] = $this->Basic->getsinglerow([
            "user_id" => $id
        ],'iptv_logins');


		$users = $this->User_model->getUserDetailById($user_id); 
		$usersdetails = $users[0];
		$mobileno = $usersdetails->phone;
		$firstname = $usersdetails->first_name;
		$lastname = $usersdetails->last_name;

        $phone = substr(str_replace("-", "", $mobileno), 0, 3);
        $first_name = trim($user->first_name);
        $last_name = trim($user->last_name);

        $val = "{$last_name}{$first_name}{$phone}@yopmail.com";
        $ItemList['yopmail'] = $val;

        $atom = $this->Basic->getsinglerow([
            "user_id"   => $id
        ], "users_yopmail_rss_links");*/

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/admin/order/letters',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function deletereport($id)
	{
		if($id!="")
		{
		    
		    $where = array('id'=>$id);
			$letters = $this->Basic->getsinglerow($where,'letters');
			
			if(file_exists('uploads/pdffiles/'.$letters->user_id.'/'.$letters->final_exprian_pdf))
				unlink('uploads/pdffiles/'.$letters->user_id.'/'.$letters->final_exprian_pdf);

			if(file_exists('uploads/pdffiles/'.$letters->user_id.'/'.$letters->final_equifax_pdf))
				unlink('uploads/pdffiles/'.$letters->user_id.'/'.$letters->final_equifax_pdf);

			if(file_exists('uploads/pdffiles/'.$letters->user_id.'/'.$letters->final_trans_pdf))
				unlink('uploads/pdffiles/'.$letters->user_id.'/'.$letters->final_trans_pdf);
				
		    
			$where = array('id'=>$id);
			$result = $this->Basic->deletedata($where,'letters');
			if($result == 1)
			{

				$this->session->set_flashdata('msg',"<div class='alert alert-success text-left'>Letter has been deleted permanently.</div>");

				redirect($_SERVER['HTTP_REFERER']);
			}
			else
			{
				$this->session->set_flashdata('msg',"<div class='alert alert-danger text-left'>Letter not deleted.</div>");
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}



  protected function getBotLogIds($bot_type, $userId, $lastNIds = 3) 
	    {
        $data = $this->Basic->getmultiplerow('id'.'  '.'desc', [
            "bot_type"  => $bot_type,
            "user_id"   => $userId
        ], "bot_logs");

        if(count($data) >= 1){
            $ids = $data[0];
        } else {
            $ids = null;
        }

        if(!is_null($ids)) {
            $ids = explode(",", $ids->bot_ids);
        } else {
            return [];
        }

        $datas = [];
         # get bot status and its link to logs
        foreach ($ids as $id) {
            array_push($datas, $this->getBotJobInfo($id));
        }

        return $datas;
    }


	function runInnovis($orderId){
		try{
			if(empty($orderId)){
				throw new Exception('User Id can not be blank! Please retry!');
			}
			if(!empty($orderId) && isset($orderId)){
				$headers=array();
				$headers['Content-Type']='application/json';
				$headers['Accept']='application/json';
				$headers['User-Agent']='test';
				
				$password	='Ecgdist48';
				$loginUser	='creditfixlab@gmail.com';
				$userId		=1122;
				$orderId	=74;
				$userInfoAddress =[
					'first_name' 	=> $first_name ?? 'Gary',
					'last_name'		=> $last_name ?? 'Jackson',
					'dob'			=> $dob ?? '1977-09-03',
					'mobile_no'		=> $mobile_no ?? '3176570577',
					'email'			=> $email ?? 'garyojackson@yahoo.com',
					'address' 		=> $address ?? '3324 N. Chester Ave.',
					'city'			=> $city ?? 'Indianapolis',
					'state_code'	=> $state_code ?? 'IN',
					'zip_code'		=> $zip_code ?? '46218'
				];
				$bodyRequest =[
					'login_password' => $password,
					'login_user' 	 => $loginUser,
					'user_id' 		 => $userId,
					'order_id' 		 => $orderId,
					'user_info' 	 => $userInfoAddress
				];
			
				$bodyJsonRequest = json_encode($bodyRequest);
				
				$url	= CERTIFIED_MAIL_LABEL;
				$response = json_decode(sendPostData($url,$bodyJsonRequest,$headers),true);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-success">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function runbotusps($orderId){
		try{
			if(empty($orderId)){
				throw new Exception('User Id can not be blank! Please retry!');
			}
			if(!empty($orderId) && isset($orderId)){
				$headers=array();
				$headers['Content-Type']='application/json';
				$headers['Accept']='application/json';
				$headers['User-Agent']='test';
				$getPersonalInfo = $this->Global_model->getPersonalInfomationByOrderId($orderId);
				$getOrderInfo = $this->Global_model->getUserIdByOrderId($orderId);
				
				$userId = $getOrderInfo->user_id;
				
				$first_name = $getPersonalInfo['first-name'] ?? '';
				$last_name 	= $getPersonalInfo['last-name'] ?? '';
				$dob 		= $getPersonalInfo['date-of-birth'] ?? '';
				$mobile_no 	= $getPersonalInfo['phone'] ?? '';
				$email 		= $getPersonalInfo['email'] ?? '';
				$email 	= $getPersonalInfo['address'] ?? '';
				$city 		= $getPersonalInfo['city'] ?? '';
				$state_code = $getPersonalInfo['state'] ?? '';
				$zip_code 	= $getPersonalInfo['zip'] ?? '';
				
				if(empty($first_name)){
					throw new Exception('First Name can not be blank!');
				}
				if(empty($last_name)){
					throw new Exception('Last Name can not be blank!');
				}
				if(empty($dob)){
					throw new Exception('Date of Birth can not be blank!');
				}
				if(empty($mobile_no)){
					throw new Exception('Mobile No can not be blank!');
				}
				if(empty($email)){
					throw new Exception('Email can not be blank!');
				}
				if(empty($city)){
					throw new Exception('city can not be blank!');
				}
				if(empty($state_code)){
					throw new Exception('State Code can not be blank!');
				}
				if(empty($zip_code)){
					throw new Exception('ZIP Code can not be blank!');
				}
				
				$password	='Ecgdist48';
				$loginUser	='creditfixlab@gmail.com';
				
				$userInfoAddress =[
					'first_name' 	=> $first_name,
					'last_name'		=> $last_name,
					'dob'			=> $dob,
					'mobile_no'		=> $mobile_no,
					'email'			=> $email,
					'address' 		=> $address,
					'city'			=> $city,
					'state_code'	=> $state_code,
					'zip_code'		=> $zip_code
				];
				$bodyRequest =[
					'login_password' => $password,
					'login_user' 	 => $loginUser,
					'user_id' 		 => $userId,
					'order_id' 		 => $orderId,
					'user_info' 	 => $userInfoAddress
				];
			
				$bodyJsonRequest = json_encode($bodyRequest);
				
				$url	= BOT_MAIN_DOMAIN.CERTIFIED_MAIL_LABEL;
				$response = json_decode(sendPostData($url,$bodyJsonRequest,$headers),true);
				var_dump($response);
				exit;
			}
			
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-success">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	function runLexisnexis($orderId){
		try{
			if(empty($orderId)){
				throw new Exception('User Id can not be blank! Please retry!');
			}
			if(!empty($orderId) && isset($orderId)){
				$headers=array();
				$headers['Content-Type']='application/json';
				$headers['Accept']='application/json';
				$headers['User-Agent']='test';
				
				$password	='Ecgdist48';
				$loginUser	='creditfixlab@gmail.com';
				$userId		=1122;
				$orderId	=74;
				$userInfoAddress =[
					'first_name' 	=> $first_name ?? 'Gary',
					'last_name'		=> $last_name ?? 'Jackson',
					'dob'			=> $dob ?? '1977-09-03',
					'mobile_no'		=> $mobile_no ?? '3176570577',
					'email'			=> $email ?? 'garyojackson@yahoo.com',
					'address' 		=> $address ?? '3324 N. Chester Ave.',
					'city'			=> $city ?? 'Indianapolis',
					'state_code'	=> $state_code ?? 'IN',
					'zip_code'		=> $zip_code ?? '46218'
				];
				$bodyRequest =[
					'login_password' => $password,
					'login_user' 	 => $loginUser,
					'user_id' 		 => $userId,
					'order_id' 		 => $orderId,
					'user_info' 	 => $userInfoAddress
				];
			
				$bodyJsonRequest = json_encode($bodyRequest);
				
				$url	= CERTIFIED_MAIL_LABEL;
				$response = json_decode(sendPostData($url,$bodyJsonRequest,$headers),true);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-success">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function documents($order_id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['titile'] = 'Documents';
		$data['tabname'] ='document';
		$data['sidebar'] = $this->Basic->orderbasicdetails($order_id);

		$data['ordersrow'] = $this->Project_model->getallorders('',$order_id);
		$data['orders']  = $data['ordersrow'][0]; 

		$data['order_id'] = $order_id;

		$user_id  = $data['orders']->user_id; 

		$data['user_id']  = $data['orders']->user_id;

		/********Letter ******/
		$order = 'id'.'  '.'desc';
		$where = array('user_id'=>$user_id);
		$data['letters'] = $this->Basic->getmultiplerow($order,$where,'letters');
		/*********Docuements *********/
		/**********************************************
		 @UpatedBy  - Pankaj
		 @Fetch Docuemnts from Dynamic form
		*******************************************/
		$data['documents'] = $this->order_model->getOrderDocuments($order_id);
		/*********Fetch Docuemnts only uploaded by admin *******/
		$data['order_documents'] = $this->order_model->getAdminOrderDocuments($order_id);		
	
		$where = array('user_id'=>$user_id);
		$track = $this->Basic->getsinglerow($where,'usertrack');

		if(!isset($track))
		{
			$insertdatatrack = array('user_id'=>$user_id,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
			$requltids = $this->Basic->insertdata($insertdatatrack,'usertrack');
			$this->db->flush_cache();

			$where = array('user_id'=>$user_id);
			$data['usertrack'] = $this->Basic->getsinglerow($where,'usertrack');
		}
		else
		{
			$where = array('user_id'=>$user_id);
			$data['usertrack'] = $this->Basic->getsinglerow($where,'usertrack');	
		}

		/***********Get Dynamic Blocks ****************/
		$orderId = $order_id;
		$getOrders = $this->Common->selectrow('orders',['order_id' =>$order_id]);
		$userId =$getOrders->user_id;
		$data['pre_dynamic_block'] 	= $this->Product_model->getdynamicBlockByOrderId($order_id);
		$data['order'] 			= $getOrders;
		$data['orderId'] 		= $orderId;
		$data['userId'] 		= $userId;
		$productId = $getOrders->product_id;
		$data['dynamic_block'] 	= $this->Product_model->getdynamicBlockByProductId($productId);
		
		$order_details = $this->Basic->getsinglerow(array('order_id'=>$orderId),'order_items_detail');
		$data['contract_sign_letter'] = $this->Global_model->getContractLetterByUserId($userId,$orderId);
		
		$where = array('user_id'=>$userId,'order_id'=>$orderId);
       	$data['contract_sign'] = $this->Basic->getsinglerow($where,'contract_sign');
		
		if($data['contract_sign']){
			$data['before_sign_contract'] =  $data['contract_sign']->before_sign_contract;
			$data['sign'] =  $data['contract_sign']->sign;
			$data['contract_url'] =  $data['contract_sign']->contract_url;
		}
		$data['dispute_items'] = $this->Basic->getSelectedDisputeitems($orderId,$userId);
		/*************End ***************/
		
		/*********Bot Table *************/
		
		$data['instruction'] 	= $this->Common->select('instruction');
		$data['credit_report_reason'] = $this->Common->select('credit_report_reason',array('parent_id'=>'0'));
		$data['ins'] = $this->Common->select('credit_report_reason',array('parent_id !='=>'0'));
		$data['bot_dispute_items'] = $this->Basic->getSelectedBotTableDisputeitems($orderId,$userId,'bottable');
		/****Create Letter ***/
		$data['letter_templates'] = $this->Common->select('letter_templates');
		$createletter = $this->load->view('theme/myaccount/admin/order/steps/createletter',$data,true);
		$data['get_create_letter'] =$createletter;
		
		/*********Letter *********/
		
		$data['get_letters']= $this->load->view('theme/myaccount/admin/order/steps/letter',$data,true);
		/******* Get FTC Downlaod ********/
		
		$ftcdata=[];
		$ftcdata['ftc_report'] 	= $this->order_model->getFTCReportbyOrderId($orderId);
		$ftcdata['order_id']	= $orderId;
		$data['get_ftcdownload']= $this->load->view('theme/myaccount/admin/order/steps/ftc_report_download',$ftcdata,true);
		
		$ftcupload=[];
		$ftcupload['user_id']	= $userId;
		$ftcupload['order_id']	= $orderId;
		$data['get_ftcupload']= $this->load->view('theme/myaccount/admin/order/steps/ftc_upload',$ftcupload,true);
		$data['get_signatureUpload']= $this->load->view('theme/myaccount/admin/order/steps/signature_upload',$ftcupload,true);
		
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/admin/order/documents',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function documentupload()
	{
        if($this->input->post('order_detail_id'))
	     {
	     	$order_detail_id= $this->input->post('order_detail_id');
	     	$name = 'image_'.$this->input->post('custom_field_name');

	     	$where = array('order_detail_id'=>$order_detail_id);
			$order_detail = $this->Basic->getsinglerow($where,'order_detail');

		if($order_detail)
		{
			$where = array('order_id'=>$order_detail->order_id);
		    $orders = $this->Basic->getsinglerow($where,'orders');

		    $user_id = $orders->user_id;

		 if(!empty($_FILES[$name]["name"]))
            {
       		$image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$_FILES[$name]["name"]));
                
                $uniqueID                 = uniqid();
                $img                     = $uniqueID.'_'.$image;
                $img_unique              = basename($img);
                $config['upload_path']   = './uploads/orders/'.$user_id;
                $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
                $config['file_name']     = $img_unique;  
                $this->load->library("upload", $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload($name,$img_unique))
                {
                echo $this->upload->display_errors();die;
                }
                else
                {
                $profile_image = base_url('/uploads/orders/'.$user_id.'/'.$img_unique);
                }


                $dataimage = array('custom_field_values' => $profile_image);

			$where = array('order_detail_id'=>$this->input->post('order_detail_id'));
			$this->Basic->updatedata($dataimage,$where,'order_detail');

			 $this->session->set_flashdata('msg', '<div class="alert alert-success">Document has  been updated Successfully</div>');

                 redirect($_SERVER['HTTP_REFERER']);
	         }
	      }
	   }
	}

	function tracking($order_id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['titile'] = 'Tracking';

		$data['tabname'] ='tracking';
		$data['sidebar'] = $this->Basic->orderbasicdetails($order_id);

		$data['order_id'] = $order_id;

		$data['ordersrow'] = $this->Project_model->getallorders('',$order_id);
		$data['orders']  = $data['ordersrow'][0]; 

		$user_id  = $data['orders']->user_id; 


			$where = array('user_id'=>$user_id);
			$track = $this->Basic->getsinglerow($where,'usertrack');

			if(!isset($track))
			{
			$insertdatatrack = array('user_id'=>$user_id,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
			$requltids = $this->Basic->insertdata($insertdatatrack,'usertrack');
			$this->db->flush_cache();

			$where = array('user_id'=>$user_id);
			$data['usertrack'] = $this->Basic->getsinglerow($where,'usertrack');
			}
			else
			{
			$where = array('user_id'=>$user_id);
			$data['usertrack'] = $this->Basic->getsinglerow($where,'usertrack');	
			}


		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/admin/order/tracking',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function creditreport($order_id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['sidebar'] = $this->Basic->orderbasicdetails($order_id);

		$data['order_id'] = $order_id;
		$data['tabname'] ='creditrepair';
		$data['ordersrow'] = $this->Project_model->getallorders('',$order_id);
		$data['orders']  = $data['ordersrow'][0]; 

		$data['order_id'] = $order_id;

		$order = 'id'.' '.'desc';
		$where = array('user_id'=>$data['orders']->user_id);
		$data['order_identity_report'] = $this->Basic->getmultiplerow($order,$where,'identity_report');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/admin/order/creditreport',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function clientdetails($order_id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['sidebar'] = $this->Basic->orderbasicdetails($order_id);
		$data['order_id'] = $order_id;
		$data['tabname'] ='client';
     	$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/admin/order/clientdetails',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function updatetrack()
	{
		if($this->input->post('id'))
		{
			$data = array(
				'exp_track' => $this->input->post('exp_track'),
				'equ_track' => $this->input->post('equ_track'),
				'trans_track' => $this->input->post('trans_track'),
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
			);

			$where = array('id'=>$this->input->post('id'));
			$this->Basic->updatedata($data,$where,'usertrack');

			$this->session->set_flashdata('msg',"<div class='alert alert-success text-left'>Tracking has been updated successfully.</div>");
			die;
		}
	}


	function getrunbot($order_id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		try{
			$userId = $this->getUserIdFromOrder($order_id);
			
			$order = 'order_dispute_creditInq_id'.'  '.'asc';
			$where = array('user_id'=>$userId,'order_id' => $order_id,'status'=>1,'is_checked'=>1);
			//$creditinquiry = $this->Basic->getmultiplerow($order,$where,'dispute_credit_inquiry');
			$creditinquiry = $this->Basic->getmultiplerow($order,$where,'order_dispute_credit_inquiry');
			$creditarray=[];
			foreach($creditinquiry as $key => $credit){
				$creditarray[] = $credit->company;
			}

			// account history
			$order = 'dispute_account_id'.'  '.'asc';
			$where = array('user_id'=>$userId,'order_id' => $order_id,'status'=>1,'is_checked'=>1);
			//$accounthistory = $this->Basic->getmultiplerow($order,$where,'dispute_account_history');
			$accounthistory = $this->Basic->getmultiplerow($order,$where,'order_dispute_account_history');
		
			foreach($accounthistory as $key => $acchis){
				
				$dispute_account_idhere = $acchis->dispute_account_id;
				$experian = $this->Basic->getsinglerow(['dispute_account_id'=>$dispute_account_idhere,'name'=>'experian'],'dispute_account_history_details');
				
				$experianacchis=[];
				$experian_acc='';
				$experian_date='';
				$experian_balance='';
				if(!empty($experian)){
					$experianacchis=[
						'experian_acc'		=> $experian->accountno,
						'experian_date'		=> $experian->dateopened,
						'experian_balance' 	=> $experian->balance
					];
					$experian_acc		= $experian->accountno;
					$experian_date		= $experian->dateopened;
					$experian_balance 	= $experian->balance;
				}	
				
				$equifax = $this->Basic->getsinglerow(['dispute_account_id'=>$dispute_account_idhere,'name'=>'equifax'],'dispute_account_history_details');
				
				
				$equifaxAcchistory=[];
				$equifax_acc='';
				$equifax_date='';
				$equifax_balance='';
				if(!empty($equifax)){
					$equifaxAcchistory=[
						'equifax_acc'		=> $equifax->accountno,
						'equifax_date'		=> $equifax->dateopened,
						'equifax_balance' 	=> $equifax->balance
					];
					
					$equifax_acc		= $equifax->accountno;
					$equifax_date		= $equifax->dateopened;
					$equifax_balance 	= $equifax->balance;
				}
				
				$transunion = $this->Basic->getsinglerow(['dispute_account_id'=>$dispute_account_idhere,'name'=>'transunion'],'dispute_account_history_details');
				
				$transunionAcchistory=[];
				$equifax_acc='';
				$equifax_date='';
				$equifax_balance='';
				if(!empty($transunion)){
					$transunionAcchistory=[
						'trans_acc'		=> $transunion->accountno,
						'trans_date'	=> $transunion->dateopened,
						'trans_balance' => $transunion->balance
					];
					$trans_acc		= $transunion->accountno;
					$trans_date		= $transunion->dateopened;
					$trans_balance 	= $transunion->balance;
				}
			///	echo "<pre>";
				$allthreeAccountHistory = array_merge($experianacchis, $equifaxAcchistory, $transunionAcchistory);
			
				$allthreeAccountHistory = array_filter($allthreeAccountHistory); 
				
				$where = array('id'=>$acchis->account_type_id);
				$credit_report_reason = $this->Basic->getsinglerow($where,'credit_report_reason');
				$reason = ($credit_report_reason) ? $credit_report_reason->title:'';
			
				if(empty($acchis->account_type_id)){
					throw new Exception('Reason can not be blank!');
				}
				if(empty($acchis->account_ins_id)){
					throw new Exception('instruction can not be blank!');
				}
				$instruction ='';
				$inneraccount = [
				   'experian' 		=> $acchis->company_title,
				   'equifax' 		=> $acchis->company_title,
				   'trans' 			=> $acchis->company_title,
				   'experian_acc'	=> $experian_acc,
				   'equifax_acc'	=> $equifax_acc,
				   'trans_acc'		=> $trans_acc,
				   'experian_date'	=> $experian_date,
				   'equifax_date'	=> $equifax_date,
				   'trans_date'		=> $trans_date,
				   'experian_balance' => $experian_balance,
				   'equifax_balance' => $equifax_balance,
				   'trans_balance'	=> $trans_balance,
				   'reason'			=> $acchis->account_type_id,
				   'instruction'	=> $acchis->account_ins_id,
				   'status'			=> $acchis->status
				];
			
				//$inneraccount =array_merge($allthreeAccountHistory,$inneraccount);
				$acchisarray[$acchis->company_title] =$inneraccount;
			}
		
			$getPersonalInfo 	= $this->Global_model->getPersonalInfomationByOrderId($order_id);
			$orderInfoData 		= $this->Global_model->getUserIdByOrderId($order_id);
				
			$first_name = $getPersonalInfo['first-name'] ?? '';
			$last_name 	= $getPersonalInfo['last-name'] ?? '';
			$dob 		= $getPersonalInfo['date-of-birth'] ?? '';
			$mobile_no 	= $getPersonalInfo['phone'] ?? '';
			$email 		= $getPersonalInfo['email'] ?? '';
			$address 	= $getPersonalInfo['address'] ?? '';
			$city 		= $getPersonalInfo['city'] ?? '';
			$state_code = $getPersonalInfo['state'] ?? '';
			$zip_code 	= $getPersonalInfo['zip'] ?? '';
			$orderdate	= $orderInfoData->added_date;
			
			if(empty($first_name)){
				throw new Exception('First Name can not be blank!');
			}
			if(empty($last_name)){
				throw new Exception('Last Name can not be blank!');
			}
			if(empty($mobile_no)){
				throw new Exception('Phone Number can not be blank!');
			}
			if(empty($email)){
				throw new Exception('Email can not be blank!');
			}
			if(empty($address)){
				throw new Exception('Address can not be blank!');
			}
			if(empty($city)){
				throw new Exception('City can not be blank!');
			}
			if(empty($state_code)){
				throw new Exception('State code can not be blank!');
			}
			if(empty($zip_code)){
				throw new Exception('Zip Code can not be blank!');
			}
			if(empty($orderdate)){
				throw new Exception('Date can not be blank!');
			}
			
			$userInfo=[
				'first_name' 	=> $first_name,
				'middle_name'	=> '',
				'last_name'		=> $last_name,
				'phone_number'	=> $mobile_no,
				'email'			=> $email,
				'state'			=> $state_code,
				'city'			=> $city,
				'zip_code'		=> $zip_code,
				'dob'			=> $dob,
				'current_address'=> $address,
				'created_at'	=> $orderdate,
				'date'			=> date('Y-m-d',strtotime($orderdate))	
			];
			
			//$userInfo = $this->Basic->getsinglerow(['id'=> $userId], 'users');
			//$url='https://portal.pft.cpnexpress.com/restapi/bot/runftc';
			
			$botdata['json_data'] = $acchisarray;
			$botdata['user_info'] = $userInfo;
			$botdata['companies'] = is_null($creditarray) ? [] : $creditarray;
            $debug = false;
			
			$bot_type='FTC';
			//$colId = $this->getBotJob($bot_type, $userId);
			# insert into bot logs
			//$this->insertBogLog($colId, $bot_type, $userId);
			//$this->identity->setPositionalArgumentDashes("-");
			//$this->identity->addPositionalArgument('run-ftc-bot')
            $FTCRequestData=json_encode([
                'companies' => json_encode($botdata['companies']),
				'json_data' => json_encode($botdata['json_data']),
				'user_id' 	=> $userId,
                'user_info' =>  json_encode($botdata['user_info'])
            ]);
			$url		= BOT_MAIN_DOMAIN.FTC_BOT;
			$curl = curl_init();
			curl_setopt_array($curl, array(
				  CURLOPT_URL => $url,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING  => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT   => 30,
				  CURLOPT_VERBOSE   => 1,
				  CURLOPT_HEADER 	=> 1,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => $FTCRequestData,
				  CURLOPT_HTTPHEADER => array(
					"accept: application/json",
					"cache-control: no-cache",
					"content-type: application/json",
					"postman-token: 1df09676-4491-b10c-2c45-15cfa53b7b11",
					"user-agent: test"
				  ),
				  //CURLOPT_HEADERFUNCTION => "HandleHeaderLine",
			));
			
			$response = curl_exec($curl);
			$err = curl_error($curl);

			$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			
			if($http_code==200){
				$this->session->set_flashdata('msg', "<div class=\"alert alert-success\">".$http_code."Bot has been run in background</div>");
			}else {
				log_message('error', json_encode($response));
				throw new Exception('Unexpected HTTP code: '.$http_code);
			}
			curl_close($curl);
			if ($err) {
			  //echo "cURL Error #:" . $err;
			  log_message('error', json_encode($err));
			  throw new Exception('cURL Error: ', $err, "\n");
			} else {
				log_message('info', json_encode($response));
			  //$this->session->set_flashdata('msg', "<div class=\"alert alert-success\">Bot has been run in background</div>");
			}
			
			redirect($_SERVER['HTTP_REFERER']);
			
		}catch(Exception $e){
			$this->session->set_flashdata('msg', "<div class=\"alert alert-success\">Bot has been run in background</div>");
			redirect($_SERVER['HTTP_REFERER']);
		}
        //$ItemList['command']= $command;
	}
	function getinnovis($orderId){
		
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		
		$userId = $this->getUserIdFromOrder($orderId);
    	$innovis = $this->getBotLogIds("INNOVIS", $userId);
    	//$data = $this->getOrderStuff($orderId);
		$data['sidebar'] = $this->Basic->orderbasicdetails($orderId);
    	$data['botName'] = 'innovis';
    	$data['userId'] = $userId;
		$data['order_id'] = $orderId;
		$data['tabname'] ='innovis';
    	$data['botRunLink'] = site_url()."Order/runInnovis/".$userId;
    	if(count($innovis) < 1) {
    		$data['obj'] = null;
    	} else {
    		$data['obj'] = $innovis;
    	}

		$this->load->view('theme/layout/header',$data);
    	//$this->load->view('theme/myaccount/admin/order/top_content',$data);
    	$this->load->view('theme/myaccount/admin/order/bot_innovis',$data);
    	//$this->load->view('theme/myaccount/admin/order/bottom_content',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	function getusps($orderId){
		
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$userId = $this->getUserIdFromOrder($orderId);
    	$innovis = $this->getBotLogIds("CERTIFIEDLABELCREATOR", $userId);
    	$data = $this->getOrderStuff($orderId);
		$data['sidebar'] = $this->Basic->orderbasicdetails($orderId);
    	$data['botName'] = 'Certified Mail Label Creator BOT';
    	$data['userId'] = $userId;
		$data['order_id'] = $orderId;
		$data['tabname'] ='usps';
    	$data['botRunLink'] = site_url()."Order/runbotusps/".$userId;
    	if(count($innovis) < 1) {
    		$data['obj'] = null;
    	} else {
    		$data['obj'] = $innovis;
    	}
		$this->load->view('theme/layout/header',$data);
    	$this->load->view('theme/myaccount/admin/order/bot_usps',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	function getLexisnexis($orderId){
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$userId = $this->getUserIdFromOrder($orderId);
    	$lexisnexis = $this->getBotLogIds("LEXISNEXIS", $userId);
    	$data = $this->getOrderStuff($orderId);
		$data['tabname'] ='lexisnexis';
		$data['sidebar'] = $this->Basic->orderbasicdetails($orderId);
    	$data['botName'] = 'Lexisnexis Bot';
    	$data['userId'] = $userId;
		$data['order_id'] = $orderId;
    	$data['botRunLink'] = site_url()."Order/runLexisnexis/".$userId;

    	if(count($lexisnexis) < 1) {
    		$data['obj'] = null;
    	} else {
    		$data['obj'] = $lexisnexis[0];
    	}
		$this->load->view('theme/layout/header',$data);
    	$this->load->view('theme/myaccount/admin/order/bot_innovis',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	function getFTC($orderId){
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$userId = $this->getUserIdFromOrder($orderId);
    	$ftc = $this->getBotLogIds("FTC", $userId);
    	# check if extra is filled then grab the user pdf file.
    	$data = $this->getOrderStuff($orderId);
		$data['tabname'] ='ftc';
		$data['sidebar'] = $this->Basic->orderbasicdetails($orderId);
		$data['titile'] = 'FTC Bot';
		$data['order_id'] = $orderId;
		
		$ischeckExist = $this->order_model->getFTCReportbyOrderId($orderId);
		
		$ftc=[];
		if(!empty($ischeckExist)){
			$api_name 	= $ischeckExist->api_name;
			$order_id 	= $ischeckExist->order_id;
			$user_id 	= $ischeckExist->user_id;
			$ftcdownload = $ischeckExist->donwload_url;
			$task_id 	= $ischeckExist->task_id;
			$task_status 	= $ischeckExist->task_status;
			$ftc['bot_status'] =$task_status;
			$ftc['task_id'] =$task_id;
			if(!empty($ftcdownload)){
				$ftc['extra'] =$ftcdownload;
			}else{
				$domain = "http://pft.cpnexpress.com/static/bot/ftc-report-submitter/screenshot/{$task_id}.jpg";
				$ftc['screenshot'] = $domain;
			}
		}
			$data['ftc'] = (object) $ftc;
			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/admin/order/bot_ftc',$data);
			$this->load->view('theme/layout/footer',$data);
		
	}
	
	protected function getUserIdFromOrder($order_id) {
    	$where = array('order_id'=>$order_id);
       	$order = $this->Basic->getsinglerow($where,'orders');
       	if($order) {
       		return $order->user_id;
       	}
    }
	protected function getOrderStuff($orderId)
    {
		$ordersrow = $this->Project_model->getallorders('',$orderId);
		$data['order']  = $ordersrow[0]; 
		$userId 		= $data['order']->user_id;
		$data['notes'] = $this->Project_model->getallnotesbasedonorder($orderId);
        $data['funding'] = [];
		//$condition = array('client_id'=>$userId);
		//$order = 'id'.'  '.'desc';
		//$data['document'] = $this->Basic->getmultiplerow($order,$condition,'document');
       return $data;
    }
	
    
    protected function getBotJobInfo($id)
	{
        return $this->Basic->getsinglerow([
            "id" => $id
        ], "bot_jobs");
    }
       
       
    protected function getWhichBots($userId, $bot_type) 
    {
        $data = $this->Basic->getmultiplerow('id'.'  '.'desc', [
            "bot_type"  => $bot_type,
            "user_id"   => $userId
        ], "bot_logs");

        if(count($data) < 1) {
            return null;
        }

        $bots = $data[0];
        return property_exists($bots, "which_bots") ? $bots->which_bots : null;
    }
    
	function runCertifiedMailBalance($order_id){
		$this->getUserIdFromOrder($order_id);
		//$this->BotJobs->getCertifiedMailBalance($username,$password);
	}
	
	 public function call_new_ftc_bot_api($order_id=null) {
		 
		 if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
      //$order_id = end($this->uri->segment_array());
      $where = array('id'=>$order_id);
    $purchase = $this->Basic->getsinglerow($where,'purchase');


    $order = 'dispute_creditInq_id'.'  '.'asc';
    $where = array('user_id'=>$purchase->student_id,'status'=>1,'is_checked'=>1);
    $creditinquiry = $this->Basic->getmultiplerow($order,$where,'dispute_credit_inquiry');
    
    foreach ($creditinquiry as $key => $credit) 
    {
      $creditarray[] = $credit->company;
    }

    // account history
    $order = 'dispute_account_id'.'  '.'asc';
    $where = array('user_id'=>$purchase->student_id,'status'=>1,'is_checked'=>1);
    $accounthistory = $this->Basic->getmultiplerow($order,$where,'dispute_account_history');



    foreach ($accounthistory as $key => $acchis) 
    {
  $dispute_account_idhere = $acchis->dispute_account_id;

  $where = array('dispute_account_id'=>$dispute_account_idhere,'status'=>1,'name'=>'experian');
  $experian = $this->Basic->getsinglerow($where,'dispute_account_history_details');

  $where1 = array('dispute_account_id'=>$dispute_account_idhere,'status'=>1,'name'=>'equifax');
  $equifax = $this->Basic->getsinglerow($where1,'dispute_account_history_details'); 

  $where2 = array('dispute_account_id'=>$dispute_account_idhere,'status'=>1,'name'=>'transunion');
  $transunion = $this->Basic->getsinglerow($where2,'dispute_account_history_details');  


  $where = array('id'=>$acchis->account_type_id);
      $credit_report_reason = $this->Basic->getsinglerow($where,'credit_report_reason');

      $reason = ($credit_report_reason)?$credit_report_reason->title:'';

      $instruction ='';

      $inneraccount = [
             'experian' => $acchis->company_title,
                   'equifax' => $acchis->company_title,
                   'trans' => $acchis->company_title,
                   'experian_acc'=>$experian->accountno,
                   'equifax_acc'=>$equifax->accountno,
                   'trans_acc'=>$transunion->accountno,
                   'experian_date'=>$experian->dateopened,
                   'equifax_date'=>$equifax->dateopened,
                   'trans_date'=>$transunion->dateopened,
                   'experian_balance'=>$experian->balance,
                   'equifax_balance'=>$equifax->balance,
                   'trans_balance'=>$transunion->balance,
                   'reason'=>$acchis->account_type_id,
                   'instruction'=>$acchis->account_ins_id,
                   'status'=>$acchis->status];

                   $acchisarray[$acchis->company_title] =$inneraccount;
    }
    

     $userInfo = $this->Basic->getsinglerow(['user_id'=> $purchase->student_id,'role'=>'parent'], 'users');
     
     
        $studentsindfo = $this->Basic->getsinglerow(['id'=> $purchase->student_id], 'students');

      $student = $this->Basic->getsinglerow(['id'=> $purchase->student_id], 'students');
       $acchisarray = json_encode($acchisarray);

       $userInfo = json_encode($studentsindfo);
      $companies = is_null($creditarray) ? [] : $creditarray;
      $companies = json_encode($companies);

      // var_dump($acchisarray, $purchase->student_id,$companies,$userInfo);die;

      $res = $this->callNewFtcBot($acchisarray, $purchase->student_id,$companies,$userInfo);
      var_dump($res, is_bool($res), $purchase->student_id);
    }

    public function getNewBotReport($order_id = null) {
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
      $this->getFtcBotReport($order_id);
    }


    private function callNewFtcBot($json_data, $user_id, $companies, $user_info) {
      try {
        $res = $this->newBotApis->post("/api/ftc/report/submitter", [
            GuzzleHttp\RequestOptions::JSON => [
              'companies' => $companies,
              'json_data' => $companies,
              'user_id' => $user_id,
              'user_info' => $user_info
            ],
            'headers' => [
              'User-Agent' => 'test',
            ]
        ]);
      } catch (GuzzleHttp\Exception\ClientException $e) {
        $response = $e->getResponse();
        $responseBodyAsString = json_decode($response->getBody()->getContents(), true);
        return $responseBodyAsString;
      }
      return $res->getStatusCode() == 202;
    }

	function getFtcBotReport($order_id){
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		try{
			
			$userId = $this->getUserIdFromOrder($order_id);
			if(!empty($order_id) && !empty($userId)){
			   $ischeckExist = $this->Common->selectrow('order_ftc_report',['order_id' =>$order_id,'user_id'=>$userId]);
				$download_url ='';
				$order_ftc_report_id =0;
				/*if(!empty($ischeckExist)){
					$download_url 		 = $ischeckExist->donwload_url;
					$order_ftc_report_id = $ischeckExist->order_ftc_report_id;
				}*/
				if(empty($download_url)){
					$url		= BOT_MAIN_DOMAIN.FILE_TRANSFER.'/'.$userId;
					$curl = curl_init();
					curl_setopt_array($curl, array(
						  CURLOPT_URL => $url,
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING  => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT   => 30,
						  CURLOPT_VERBOSE   => 0,
						  CURLOPT_HEADER 	=> 0,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "GET",
						  CURLOPT_HTTPHEADER => array(
							"user-agent: test"
						  ),
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);
					
						//$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
						$responseData=json_decode($response);

						if(!empty($responseData) && isset($responseData)){
							if(isset($responseData->download) && !empty($responseData->download)){
								$downloadPdfURL = $responseData->download;
								$taskId 	= $responseData->task->id;
								$taskstatus = $responseData->task->status;
								if($taskstatus=='FAILURE'){
									throw new Exception('FTC REPORT Status FAILURE');
								}
								$downloadPdfURL = str_replace('http://localhost:8003','https://zgtv.cpnexpress.com',$downloadPdfURL);
								
								//if(empty($order_ftc_report_id)){
									$insertData=[
										'order_id' 		=> $order_id,
										'user_id'  		=> $userId,
										'donwload_url' 	=> $downloadPdfURL,
										'api_name' 		=> 'FTC REPORT',
										'added_date' 	=> date('Y-m-d'),
										'task_id' 		=> $taskId,
										'task_status' 	=> $taskstatus
									];
									$this->Common->insert('order_ftc_report',$insertData);
								//}
								/*else{
									$updateData=[
										'donwload_url' 	=> $downloadPdfURL,
										'api_name' 		=> 'FTC REPORT',
										'added_date' 	=> date('Y-m-d')
									];
									$this->Common->updatedata('order_ftc_report',$updateData,['order_ftc_report_id' => $order_ftc_report_id]);
								}*/
							}else{
								if(isset($responseData->task) && !empty($responseData->task)){
									throw new Exception('FTC REPORT Status -'.$responseData->task->status.'');
								}
							}
						}
						curl_close($curl);
						if ($err) {
						  //echo "cURL Error #:" . $err;
						  log_message('error', json_encode($err));
						  throw new Exception('cURL Error: ', $err, "\n");
						} else {
							log_message('info', json_encode($response));
						}
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', $e->getMessage());
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	function confirmPayment(){
		$postData=$this->input->post();
		if(isset($postData) && !empty($postData)){
			$userId = $this->session->userdata('user_id');
			$postData['user_id'] 	= $userId;
			$postData['added_date'] = date('Y-m-d H:i:s');
			//$this->Common->selectrow('order_payment_status',['order_id' =>$postData['order_id'],'user_id' => $userId,'type' => ]);
			$this->Common->insert('order_payment_status',$postData);
			
			$this->session->set_flashdata('msg', 'Updated Sucessfully');
			redirect('order/myaccount');
		}
	}
	function viewInvoice($order_id=0){
		if(!empty($order_id)){
			
			//$invoiceEmail = $this->load->view('email/invoice',$data,true);
			//$data['invoice_html'] = $invoiceEmail;
		}
	}
	
	function ftcupload(){
		try{
			$requestData = $this->input->post();
			if(!empty($requestData['order_id']) && !empty($requestData['user_id'])){
				$order_id 	= $requestData['order_id'];
				$user_id  	= $requestData['user_id'];
				$title  	= $requestData['title'];
				$type  		= $requestData['type'];
				
				$filename 	= $_FILES['file_name']['name'];
				$image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$filename));
				$uniqueID  = uniqid();
				$img       = $uniqueID.'_'.$image;
				$filename  = basename($img);
				if($type=='SIGNATURE'){
					$uploadFilePath = 'uploads/orders/'.$user_id.'/sign';
				}else{
					$uploadFilePath = 'uploads/orders/'.$user_id.'/ftc';
				}
				if(!file_exists($uploadFilePath)) {
					mkdir($uploadFilePath, 0777, true);
				}
				$config['upload_path'] 	= $uploadFilePath.'/';
				$config['allowed_types'] = 'docx|jpg|gif|png|jpeg|JPG|PNG|pdf';
				$config['encrypt_name'] = TRUE;
				$config['file_name'] 	= $filename;
				//Load upload library and initialize configuration
				
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file_name')){
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					$path =base_url().$uploadFilePath.'/'.$filename;	
						$orderDocumentData=[
							'order_id'		=> $order_id,
							'user_id' 		=> $user_id,
							'title'			=> $title,
							'file_name' 	=> $filename,
							'added_for'		=> $user_id,
							'added_by'  	=> $this->session->userdata('id'),
							'path'			=> $path,
							'type'			=> $type,
							'is_active'		=> 1,
							'status'		=> 'New',
							'created_at'	=> date('Y-m-d H:i:s'),
							'updated_at'	=> date('Y-m-d H:i:s')
						];
					 $this->Common->insert('order_document',$orderDocumentData);
					 $this->session->set_flashdata('msg', '<div class="alert alert-success">Document Updated Successfully</div>');
				}
				else{
					$this->success  = FALSE;
					throw new Exception($this->upload->display_errors());
				}
			}
			redirect($_SERVER['HTTP_REFERER']);
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
