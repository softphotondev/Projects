<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$this->load->helper('url');
		$this->load->library('upload');
		$this->load->model('Common');
	}
	
	function brokerinvoice()
	{
        if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Broker  Invoice List'; 

	   $orders = $this->Project_model->getallorders();

	    $data['orders'] = $orders;

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/brokerinvoice',$data);
		$this->load->view('theme/layout/footer',$data);
		
	}


	function clientinvoicezgc()
	{

		  $this->load->view('client/clientinvoicezgc'); 
	}

	function viewinvoice($id)
	{
		$data['title'] = 'View Invoice';

        $data['ordersrow'] = $this->Project_model->getallorders('',$id);
		$data['orders']  = $data['ordersrow'][0]; 

		$data['users'] = $this->User_model->getUserDetailById($data['ordersrow'][0]->user_id);
		$data['userdetails'] = $data['users'][0];

		$data['product'] = $this->Product_model->getProductDetailsByID($data['ordersrow'][0]->product_id);
		$data['productdetails'] = $data['product'][0];

		//$message = $this->load->view('theme/myaccount/invoicetemplate',$data,TRUE);

		//$this->load->library('pdf');

       // echo $signed_filename = $data['ordersrow'][0]->user_id.''.$data['orders']->order_id.''.strtotime("now");

		//$this->pdf->generate($data['ordersrow'][0]->user_id,$message,$signed_filename,'FALSE');
		
	//echo $signedContractUrl = base_url('uploads/pdffiles/'.$data['ordersrow'][0]->user_id.'/'.$signed_filename.".pdf");
		$this->load->view('theme/myaccount/invoicetemplate',$data);
	}


	function printpdf()
	{

	}

	/***********************************
	 @UpdatedBy - Pankaj
	 @Update 	- Dynamic Form inside Admin	
	 ************************************/
	function savestepmobile(){
		try{
			$postData = $this->input->post();
			if(!empty($postData['block_name']) && !empty($postData['block_id'])){
				if(empty($postData['orderId'])){
					throw new Exception('Order ID is Invalid in Request!');
				}
				$getorders= $this->Common->selectrow('orders',['order_id' => $postData['orderId']]);
				
				$orderId = $postData['orderId'];
				$user_id = $getorders->user_id;
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
						if (strstr($custom_field_name, 'user')) {
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
				if(!empty($block_custom_fields)){
					if(!empty($orderId)){
						
						$ordersData=[
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
							$orderDetailData['upload_by']		= $user_id;
							$orderDetailData['updated_by']		= $this->session->userdata('user_id');

							$this->Basic->insertdata($orderDetailData,'order_detail');
						}
						if($module_selected=='identityiq'){
							$identityIq_url='https://zgtv.cpnexpress.com/api/identity-iq/report/parser';
							$request_headers = array();
							$request_headers[] = 'Content-Type:application/json';
							$request_headers[] = 'User-Agent:test';
							
							$postdata =json_encode([
								'identity_password' 	=> $identityIq['password'],
								'identity_security_ans' => $identityIq['ssn'],
								'identity_username' 	=> $identityIq['username'],
								'user_id' 				=> $user_id,
								'order_id' 				=> $orderId 
							]);
							$result =json_decode(sendPostData($identityIq_url,$postdata,$request_headers),TRUE);
						}
					}
					$this->session->set_flashdata('msg', 'Update Successfully!');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg',$e->getMessage());
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	function saveContractmobile()
	{
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

		        if(!empty($getUserDetail)){
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
				$this->session->set_flashdata('msg', 'Updated Successfully!');
			
				redirect($_SERVER['HTTP_REFERER']);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', $e->getMessage());
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function saveDisputemobileajax()
	{
        $postData = $this->input->post();
		if(!empty($postData['orderId'])){
			$orderId = $postData['orderId'];
			unset($postData['personal_profile']);
			unset($postData['is_name_checked']);
			unset($postData['is_knows_checked']);
			unset($postData['is_dob_checked']);
			unset($postData['address']);
			
			if(!empty($postData['dispute_creditInq_id']) && isset($postData['dispute_creditInq_id'])){
				$this->Common->updatedata('order_dispute_credit_inquiry',['is_checked' => 0],['order_id'=> $orderId]);
				foreach($postData['dispute_creditInq_id'] as $getCreditEnquiry){
					$dispute_creditInq_id = $getCreditEnquiry;						
					$orderDisputeCredit=[
						'is_checked'		=> 1,
						'is_bot_table' 		=> 1,
						'last_updated_date' => date('Y-m-d H:i:s')
					];
					$where=['dispute_creditInq_id'=>$dispute_creditInq_id,'order_id'=> $orderId];
					$this->Common->updatedata('order_dispute_credit_inquiry',$orderDisputeCredit,$where);
				}
			}else {
				if(empty($postData['dispute_creditInq_id'])){
					$this->Common->updatedata('order_dispute_credit_inquiry',['is_checked' => 0],['order_id'=> $orderId]);
				}
			}
			if(!empty($postData['dispute_account_id']) && isset($postData['dispute_account_id'])){
				$this->Common->updatedata('order_dispute_account_history',['is_checked' => 0],['order_id'=> $orderId]);
				foreach($postData['dispute_account_id'] as $getaccountHistory){
					$dispute_account_id = $getaccountHistory;
					$account_type_id='';
					$account_ins_id='';
					if($postData['notcheck_reason']!=1){
					 	$account_type_id = $postData['statusselect_'.$dispute_account_id];
						$account_ins_id  = $postData['statusins_'.$dispute_account_id];
					}
					$orderAccountHistory=[
						'dispute_account_id' => $dispute_account_id,
						'is_checked'		 => 1,
						'is_bot_table' 		 => 1,
						'account_type_id'	 => $account_type_id,
						'account_ins_id'	 => $account_ins_id ,
						'last_updated_date'  => date('Y-m-d H:i:s')
					];
					$where=['dispute_account_id'=>$dispute_account_id,'order_id'=> $orderId];
					$this->Common->updatedata('order_dispute_account_history',$orderAccountHistory,$where);
				}
			}else{
				if(empty($postData['dispute_account_id'])){
					$this->Common->updatedata('order_dispute_account_history',['is_checked' => 0],['order_id'=> $orderId]);
				}
			}
		 }
		$this->session->set_flashdata('msg', 'Updated Successfully!');
     	redirect($_SERVER['HTTP_REFERER']);
	}
	function saveDisputemobile(){
		try{
			$postData = $this->input->post();

			if(!empty($postData['block_name']) && !empty($postData['block_id'])){
				
				$orderId 			= isset($postData['orderId']) ? $postData['orderId'] : 0;
				$user_id 			= $this->session->userdata('user_id');
				$totalsteps 		= isset($postData['totalsteps']) ? $postData['totalsteps'] : 0; 
				$step 				= isset($postData['step']) ? $postData['step'] : 0;
				$block_name 		= isset($postData['block_name']) ? $postData['block_name'] : 0;
				$block_id 			= isset($postData['block_id']) ? $postData['block_id'] : 0;
				$block_field_name	= isset($postData['block_field_name']) ? $postData['block_field_name'] : 0;
				$module_selected	= isset($postData['module_selected']) ? $postData['module_selected'] : 0;
				
				$dispute_Pf_id		= $postData['personal_profile'];
				//$is_name_checked	= $postData['is_name_checked'];
				//$is_knows_checked	= $postData['is_knows_checked'];
				//$is_dob_checked		= $postData['is_dob_checked'];
				//$address			= $postData['address'];
				
				$dispute_creditInq_id 	= $postData['dispute_creditInq_id'];
				$dispute_account_id		= $postData['dispute_account_id'];
				
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
				$this->session->set_flashdata('msg', 'Updated Successfully!');

				echo "success";
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', $e->getMessage());
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function resetreport()
	{
		$orderId = $this->input->post('order_id');
		$user_id = $this->input->post('user_id');
		 $this->Basic->deletedata(['order_id' => $orderId],'order_dispute_personal_info');
		 $this->Basic->deletedata(['order_id' => $orderId],'order_dispute_credit_inquiry');
		 $this->Basic->deletedata(['order_id' => $orderId],'order_dispute_account_history');
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Datas are reset Successfully!</div>');
		 	
		 echo "success";
	}
	
}
