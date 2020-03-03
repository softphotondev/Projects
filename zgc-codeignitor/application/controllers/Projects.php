<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$this->load->helper('url');
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
	}

	function index()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		
		$data['title'] = 'Order List'; 
	    $data['products'] = $this->Product_model->getProductList();
		$category = $this->Product_model->getCategoryList();
		foreach($category as $cate){
			 $userrole[$cate->category_id] = $cate->category_name; 
		}
	    $data['category'] = $userrole;
		
		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'order');
		$orderstatusall = $this->Basic->getmultiplerow($order,$where,'status');

		$orderstatus = [];
		$orderstatus_count = [];
		if($orderstatusall)
		{
			foreach ($orderstatusall as $key => $value) 
			{
				$ordersorderstatus = $this->order_model->getallorders($value->status_id);
				$orderstatus[$value->status_id] = $value->status_name;
				$orderstatus_count[$value->status_id] = count($ordersorderstatus);
			}
		}
		
		$data['orderstatusall'] = $orderstatusall;
		$data['orders'] = $this->order_model->getallorders();
		$data['orderstatus_count'] = $orderstatus_count;

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/order-history',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	
	function projectoverview()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Page Overview';
		
        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/projectoverview',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	
	function view($orderId='')
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Project Orverview'; 
		$data['tabname'] ='overview';
		$data['sidebar'] = $this->Basic->orderbasicdetails($orderId);
		
		$getOrders = $this->Common->selectrow('orders',['order_id' =>$orderId]);
		//$data['order_dynamic_block_menu'] = $this->Global_model->getOrderBlockListbyOrderId($orderId);
		$userId = $getOrders->user_id;
		$productId = $getOrders->product_id;
		
		$data['pre_dynamic_block'] 	= $this->Product_model->getdynamicBlockByOrderId($orderId);
		$data['order'] 		= $getOrders;
		$data['orderId'] 		= $orderId;
		$data['userId'] 		= $userId;
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
		//$data['dispute_items'] = $this->Basic->Getdisputeitems($orderId,$userId);
		$data['dispute_items'] = $this->Basic->getSelectedDisputeitems($orderId,$userId);
		
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/admin/order/overview',$data);
		//$this->load->view('theme/myaccount/admin/order/overview_new',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function multideleteorder()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}		  
		  $RequestData = $this->input->post();

          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
			$data = array('is_delete'=>2);
			$where = array('order_id'=>$id);
			$this->Basic->updatedata($data,$where,'orders');
          	}
          }

          $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Orders has been Deleted successfully</div>');

           redirect($_SERVER['HTTP_REFERER']);
	}

	function deleteorder($id)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
	  if($id)
        {
            
            $data = ['is_delete'=>2];
            $where = array('order_id'=>$id);
            $this->Basic->updatedata($data,$where,'orders');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Orders has been  deleted Successfully</div>');
           redirect($_SERVER['HTTP_REFERER']);
        }
	}

	function getproductcustomfields()
	{
		$product_id = $this->input->post('product_id');
		$product_block_id = $this->input->post('product_block_id');
		$orders_id = $this->input->post('orders_id');
		$data['dynamic_block'] = $this->Product_model->getdynamicBlockByProductIdandblock($product_id,$product_block_id);
		$data['pre_dynamic_block'] 	= $this->Product_model->getdynamicBlockByOrderId($orders_id);
		$data['orderId'] = $orders_id;
		$data['product_block_id'] = $product_block_id;
		$data['product_id'] = $product_id;

		 echo $this->load->view('theme/myaccount/loaddynamicfield',$data,true);
	}


	function getproductcustomfieldsfixnow()
	{
		 $product_id = $this->input->post('product_id');
		 $product_block_id = $this->input->post('product_block_id');
		 $orders_id = $this->input->post('orders_id');
		 $task_id = $this->input->post('task_id');
 $data['dynamic_block'] = $this->Product_model->getdynamicBlockByProductIdandblock($product_id,$product_block_id);
$data['pre_dynamic_block'] 	= $this->Product_model->getdynamicBlockByOrderId($orders_id);
		$data['orderId'] = $orders_id;
		$data['product_block_id'] = $product_block_id;
		$data['product_id'] = $product_id;

		$data['task_id'] = $task_id;


		$order = 'status_id'.' '.'asc';
		$where = array('type'=>'task','status'=>1);
		$task_status_all = $this->Basic->getmultiplerow($order,$where,'status');


		$task_status=$task_count=[];

		if($task_status_all)
		{
			foreach ($task_status_all as $key => $task) 
			{
        $task_status[$task->status_id] =  $task->status_name;
			}
		}

		$data['task_status'] = $task_status;

		if($this->session->userdata('user_id')==1)
		{
           echo $this->load->view('theme/myaccount/loaddynamicfieldfixnowadmin',$data,true);
		}
		else
		{
		echo $this->load->view('theme/myaccount/loaddynamicfieldfixnow',$data,true);
		}

		
	}


	function savesteporderflag()
	{
		 $postData = $this->input->post();

		 if(!empty($postData['order_detail_id']))
		 {
		 	 $order_detail_id = $postData['order_detail_id'];

		 	 foreach($order_detail_id as $key=>$orderdetailids)
		 	 {
		 	 $flagdata = ['flag'=>(isset($postData['flag']) && (in_array($key,$postData['flag'])))?'1':'0'];
              $where = ['order_detail_id'=>$orderdetailids];
	          $this->Basic->updatedata($flagdata,$where,'order_detail');

	          //echo $this->db->last_query().'<br>';
		 	 }
		 }
	}

	function savesteporder()
	{
		try{
			$postData = $this->input->post();
	
			if(!empty($postData['block_name']) && !empty($postData['block_id'])){
				
				$orderId 			= isset($postData['orderId']) ? $postData['orderId'] : 0;
				$user_id 			= $this->session->userdata('user_id');
				$totalsteps 		= 1;
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
							$config['file_name'] 		= $filename;
							//Load upload library and initialize configuration
							$this->load->library('upload',$config);
							$this->upload->initialize($config);
							if($this->upload->do_upload($dynamicfile)){
								$uploadData = $this->upload->data();
								$filename = $uploadData['file_name'];
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
							$ordersData=[
								'user_id' 			=> $this->session->userdata('user_id'),
								'status' 			=> 0,
								'totalsteps'		=> $totalsteps,
								'added_date'		=> date('Y-m-d H:i:s'),
								'last_updated_date'	=> date('Y-m-d H:i:s')
							];
							
							$orderId = $this->Basic->insertdata($ordersData,'orders');
							$_SESSION["order_id"] = $orderId;
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
							
							foreach($block_custom_fields as $key=>$getcustomFields){
								$orderDetailData	= $getcustomFields;
								$orderDetailData['order_id']		= $orderId;
								$orderDetailData['order_step_id']	= $order_step_Id ?? 0;
								$orderDetailData['added_date']		= date('Y-m-d H:i:s');
								$orderDetailData['last_added_date']	= date('Y-m-d H:i:s');
								$orderDetailData['upload_by']	= $this->session->userdata('user_id');
								$orderDetailData['flag'] =  (isset($postData['flag']) && (in_array($key,$postData['flag'])))?'1':'0';
								$order_detail_id =$this->Basic->insertdata($orderDetailData,'order_detail');
							}

					          $updateprice = array('task_status'=>'26');
						      $where = array('order_id'=>$orderId,'related_to'=>$block_id);
						      $this->Basic->updatedata($updateprice,$where,'task');

							if($module_selected=='identityiq'){
								$identityIq_url='zgtv.personalfundingteam.com/api/identity-iq/report/parser';
								$request_headers = array();
								$request_headers[] = 'Content-Type:application/json';
								$request_headers[] = 'User-Agent:test';
								
								$postdata =json_encode([
									'identity_password' 	=> $identityIq['password'],
									'identity_security_ans' => $identityIq['ssn'],
									'identity_username' 	=> $identityIq['username'],
									'user_id' 				=> $this->session->userdata('user_id') 
								]);
								
								
								$result =json_decode(sendPostData($identityIq_url,$postdata,$request_headers),TRUE);
							}
						}
					}

					echo "success";
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function getOrderajaxsingle($orderId,$blockId,$stepno)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		 if(!empty($orderId) && !empty($blockId) && !empty($stepno))
           {

           		$data['sidebar'] = $this->Basic->orderbasicdetails($orderId);

           	    $getOrderData = $this->Project_model->getallorders('',$orderId);
				$data['order']  = $getOrderData[0]; 

				$data['pre_dynamic_block'] 	= $this->Product_model->getdynamicBlockByOrderId($orderId);
				$data['orderId'] 		= $orderId;

				$data['stepno'] 		= $stepno;

				$orders = $this->Basic->getsinglerow(array('order_id'=>$orderId),'orders');	

				$userId = $orders->user_id;

				$order_details = $this->Basic->getsinglerow(array('order_id'=>$orderId),'order_items_detail');

				$productId = $order_details->product_id;

				$data['dynamic_block'] = $this->Product_model->getdynamicBlockByProductId($productId);

				$data['contract_sign_letter'] = $this->Global_model->getContractLetterByUserId($userId,$orderId);

				$data['userId'] = $orders->user_id;


			$where = array('user_id'=>$userId,'order_id'=>$orderId);
            $data['contract_sign'] = $this->Basic->getsinglerow($where,'contract_sign');

			if($data['contract_sign'])
			{
					$data['before_sign_contract'] =  $data['contract_sign']->before_sign_contract;
					$data['sign'] =  $data['contract_sign']->sign;
					$data['contract_url'] =  $data['contract_sign']->contract_url;
			}


			$data['dispute_items'] = $this->Basic->Getdisputeitems($orderId,$userId);

			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/admin/order/orderdetails',$data);
			$this->load->view('theme/layout/footer',$data);
		}
	}
	
	function uploadsign()
	{

		if(!empty($this->input->post('orderId_upload_sign')) && !empty($this->input->post('orderId_upload_user_id')))
           {
			$order_id = $this->input->post('orderId_upload_sign');
			$user_id = $this->input->post('orderId_upload_user_id');


			if(!empty($_FILES["sign"]["name"]))
            {
   			$image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$_FILES["sign"]["name"]));
                
                $uniqueID                 = uniqid();
                $img                     = $uniqueID.'_'.$image;
                $img_unique              = basename($img);
                $config['upload_path']   = './uploads/pdffiles/'.$user_id;
                $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
                $config['file_name']     = $img_unique;  
                $this->load->library("upload", $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload("sign",$img_unique))
                {
                echo $this->upload->display_errors();die;
                }
                else
                {
                $sign = base_url('/uploads/pdffiles/'.$user_id.'/'.$img_unique);
                }
	       }
	       else
	       $sign ='';	


			$postData['sign']= $sign;
			$this->Basic->updatedata($postData,['user_id'=> $user_id,'order_id'=>$order_id],'contract_sign'); 

			$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Signature has been uploaded Successfully</div>');
		}
				redirect($_SERVER['HTTP_REFERER']);
	}

	function generateapplicationPdf($order_id=0){
		$this->load->library('pdf');
		ini_set('memory_limit', '200M');
		$data['orderdata'] = $this->order_model->getdynamicApplicationBlock($order_id);
		$data['order_id'] = $order_id;
		$application_file = $this->load->view('theme/pdfgenerate/jewelry_account',$data,true);
		
		echo $application_file;
		//$filename='Application_Form'.$order_id;
		//@$this->pdf->generateReport($application_file, $filename, false, 'A4', 'portrait');
		exit;

		$this->session->set_flashdata('msg', $e->getMessage());
		redirect($_SERVER['HTTP_REFERER']);
	}
	function saveapplicatedate(){
		$order_id 	= $this->input->post('order_id');
		$date 		= $this->input->post('date');
		if(!empty($order_id) && !empty($date)){
			$getORders = $this->Common->selectrow('order_application_generate',['order_id' => $order_id]);
			if(!empty($getORders)){
				$application_id = $getORders->application_id;
				$this->Common->updatedata('order_application_generate',['date' => $date],['application_id' => $application_id]);
			}else{
				$insertdata=[
					'order_id'  => $order_id,
					'date' 		=> $date
				];
				$this->Common->insert('order_application_generate',$insertdata);
			}
			redirect('projects/view/'.$order_id);
		}
	}
	
	function generatePdf($order_id=0){
		$this->load->library('pdf');
		ini_set('memory_limit', '200M');
		$data['orderdata'] = $this->order_model->getdynamicApplicationBlock($order_id);
		$getORders = $this->Common->selectrow('order_application_generate',['order_id' => $order_id]);
		$data['order_id'] = $order_id;
		$data['savedate'] = $getORders->date;
		$data['isflag'] = 1;
		$application_file = $this->load->view('theme/pdfgenerate/jewelry_account',$data,true);
		$filename='Application_Form'.$order_id;
		@$this->pdf->generateReport($application_file, $filename, false, 'A4', 'portrait');
		exit;
		$this->session->set_flashdata('msg', $e->getMessage());
		redirect($_SERVER['HTTP_REFERER']);
	}
}
