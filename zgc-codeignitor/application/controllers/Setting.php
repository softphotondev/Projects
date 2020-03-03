<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

	   if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}

		$this->load->library('grocery_CRUD');
		$this->load->model('Global_model');
	}

	function sitesettings()
	{
		$data['title'] 		= 'Site Settings';
	    $data['subtitle'] 	= 'Site Settings';
		//$where = array('domain' =>base_url());
		$where = array('user_id' => $this->session->userdata('user_id'));
	    $data['site_settings'] = $this->Basic->getsinglerow($where,'site_settings');
	    $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function save()
	{
		$postData = $this->input->post();


		   if(!empty($_FILES["sitelogo"]["name"]))
            {
                $image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$_FILES["sitelogo"]["name"]));
                
                $uniqueID                 = uniqid();
                $img                     = $uniqueID.'_'.$image;
                $img_unique              = basename($img);
                $config['upload_path']   = './uploads/logo/';
                $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
                $config['file_name']     = $img_unique;  
                $this->load->library("upload", $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload("sitelogo",$img_unique))
                {
                echo $this->upload->display_errors();die;
                }
                else
                {
                $postData["sitelogo"] = base_url('/uploads/logo/'.$img_unique);
                }
	       }
	       else
	       {
	       	$postData["sitelogo"] = $postData['image_old'];
	       }

	       unset($postData['image_old']);

			if(!empty($postData['id']))	
				{
					unset($postData['save']);
					$pageId = $postData['id'];
					$this->Basic->updatedata($postData,['id' => $pageId],'site_settings');
					$this->session->set_flashdata('msg', '<div class="alert alert-success">Settings Updated Successfully</div>');
				}

			redirect('sitesettings');
	}

	function emailtemplates()
	{
		$data['title'] 		= 'Email Templates';
	    $data['subtitle'] 	= 'Email Templates';

		$order = 'id'.' '.'asc';
		$where = array('status !='=>2);
		$email = $this->Basic->getmultiplerow($order,$where,'email_templates');


		$head = ['Subject','Message','Actions'];
	    $headrows = [];

	      foreach($email as $ema)
	      {

	      	$status = ($ema->status==1)?'Active':'Inactive';

               $headrows[] = [$ema->id,$ema->subject,$status,'<a class="btn btn-success btn-xs" href='.base_url('copyemail/'.$ema->id).' data-original-title="btn btn-danger btn-xs" title="">Copy</a>

               <a class="btn btn-success btn-xs" href='.base_url('editemail/'.$ema->id).' data-original-title="btn btn-danger btn-xs" title="">Edit</a>

                  <a class="btn btn-danger btn-xs"  href='.base_url('setting/deleteemail/'.$ema->id).' onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>'];
	      }

          $datasdable['formaction'] = base_url('Setting/multiemaildelete');
	      $datasdable['head'] = $head;
	      $datasdable['headrows'] = $headrows;

		  $this->load->view('theme/layout/header',$data);
		  $this->load->view('theme/myaccount/dynamictable',$datasdable);
		 $this->load->view('theme/layout/footer',$data);
	  }

	  function copyemail($id)
	  {
	  	 $data['title'] = 'Copy Email Templates';  

	  	$where = array('id' =>$id);
	    $data['email'] = $this->Basic->getsinglerow($where,'email_templates');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/copyemail',$data);
		$this->load->view('theme/layout/footer',$data);
	  }


	  function editemail($id)
	  {
	  	$data['title'] = 'Update Email Templates';  

	  	$where = array('id' =>$id);
	    $data['email'] = $this->Basic->getsinglerow($where,'email_templates');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/copyemail',$data);
		$this->load->view('theme/layout/footer',$data);
	  }


	  function savemail()
	  {
		try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){
				
				if(!empty($postData['id'])){
					$postData['last_updated_date']	= date('Y-m-d H:i:s');

					$this->Basic->updatedata($postData,['id' =>$postData['id']],'email_templates');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
				}else{
					$postData['last_updated_date']	= date('Y-m-d H:i:s');
					$this->Basic->insertdata($postData,'email_templates');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Copied Successfully</div>');
				}
				redirect('emailtemplates');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function deleteemail($id)
	{
	    if($id)
        {
            $data = ['status'=>2];
            $where = array('id'=>$id);
            $this->Basic->updatedata($data,$where,'email_templates');
           $this->session->set_flashdata('msg', '<div class="alert alert-success">Email Templates has been  deleted Successfully</div>');
         redirect($_SERVER['HTTP_REFERER']);
        }
	}

	function multiemaildelete()
	{
		 $RequestData = $this->input->post();

          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
			$data = array('status'=>2);
			$where = array('id'=>$id);
			$this->Basic->updatedata($data,$where,'email_templates');
          	}
          }

       $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Email Templates has been Deleted successfully</div>');

           redirect($_SERVER['HTTP_REFERER']);
	}

	function blocklist(){
		$data['title'] = 'Manage Block List';
		$data['field_type'] 	= $this->Product_model->getfieldtype();
		$data['blocklist'] 		= $this->Product_model->getblocklist();
		$data['contactlist'] 	= $this->Common->select('letter_templates',['is_visible_block' => 1]);
		//$data['customer_block'] 	= $this->Product_model->getcustomBlockFieldList();
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/block_list',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	function blockView(){
		$urlstring=$this->uri->uri_string();
		$blockId = substr(strrchr($urlstring, "/"), 1);
		if(isset($blockId) && !empty($blockId)){
			$data['title'] 		= 'Block Orverview';
			$data['blockview'] 	= $this->Basic->getsinglerow(['block_id' => $blockId],'manage_block');
			$data['block_id'] 	= $blockId;
			$data['getCustomerFieldList'] 	= $this->Product_model->getcustomBlockFieldList($blockId);

			$data['field_type'] = $this->Product_model->getfieldtype();
			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/block_view',$data);
			$this->load->view('theme/layout/footer',$data);
		}
	}
	function editcustomBlock(){
		$urlstring=$this->uri->uri_string();
		$customBlockFieldId = substr(strrchr($urlstring, "/"), 1);
		if(isset($customBlockFieldId) && !empty($customBlockFieldId)){
			$data['title'] 		= 'Custom Block Orverview';
			//$data['getCustomerFieldList'] 	= $this->Basic->getsinglerow(['custom_block_field_id' => $customBlockFieldId],'custom_block_field');
			
			$data['getCustomerFieldList'] = $this->Product_model->getcustomBlockFieldId($customBlockFieldId);
			$data['field_type'] = $this->Product_model->getfieldtype();
			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/editcustom_block',$data);
			$this->load->view('theme/layout/footer',$data);
		}
	}
	
	function saveBlock(){
		try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){


		if(!empty($_FILES["icon"]["name"]))
            {
   $image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$_FILES["icon"]["name"]));
                
                $uniqueID                 = uniqid();
                $img                     = $uniqueID.'_'.$image;
                $img_unique              = basename($img);
                $config['upload_path']   = './uploads/product/';
                $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
                $config['file_name']     = $img_unique;  
                $this->load->library("upload", $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload("icon",$img_unique))
                {
                echo $this->upload->display_errors();die;
                }
                else
                {
                $icon_image = base_url('/uploads/product/'.$img_unique);
                }
	       }
	       else
	       {
	       	$icon_image = (isset($postData['icon_old']))?$postData['icon_old']:'';
	       	unset($postData['icon_old']);
	       }


				if(!empty($postData['block_id'])){
					$blockId=$postData['block_id'];
					$postData['updated_at']	= date('Y-m-d H:i:s');
					$postData['icon']	= $icon_image;
					$this->Basic->updatedata($postData,['block_id'=> $blockId],'manage_block');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
				}else{
					$order = 'block_id'.' '.'desc';
					$where = array();
					$manage_block = $this->Basic->getmultiplerow($order,$where,'manage_block');
		            $totalcount = count($manage_block)+1;
					$postData['created_at']	= date('Y-m-d H:i:s');
					$postData['updated_at']	= date('Y-m-d H:i:s');
					$postData['sort']	= date('Y-m-d H:i:s');
					$postData['icon']	= $icon_image;
					$postData['sort']	= $totalcount;
					$this->Basic->insertdata($postData,'manage_block');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Added Successfully</div>');
				}
				redirect($_SERVER['HTTP_REFERER']);
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	function saveCustomfield(){
		try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){
				$block_id = $postData['block_id'];
				if($block_id){
					if(!empty($postData['block_id']) && !empty($postData['custom_block_field_id'])){
						$custom_block_field_id = $postData['custom_block_field_id'];
							$postData['field_name']			= str_replace(' ', '-', strtolower($postData['label_name']));
							$this->Basic->updatedata($postData,['custom_block_field_id'=> $custom_block_field_id],'custom_block_field');
							$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
							redirect('blockView/'.$block_id);
					}else{
						//unset($postData['product_id']);

							$order = 'custom_block_field_id'.' '.'asc';
							$where = array('block_id'=>$block_id);
							$custom_block_field_total = $this->Basic->getmultiplerow($order,$where,'custom_block_field');

				         $postData['sort'] = count($custom_block_field_total)+1;

						$postData['field_name']			= str_replace(' ', '-', strtolower($postData['label_name']));
						$postData['created_at']			= date('Y-m-d H:i:s');
						$this->Basic->insertdata($postData,'custom_block_field');
						$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
					}
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	function ticket(){
		$data['title'] 		= 'Support Ticket';
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/support_ticket',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	
	function editmanageblock(){
		try {
			$blockId = $this->input->post('block_id');
			if(isset($blockId)){
			$data['getBlock'] = $this->Common->select('manage_block',['block_id' => $blockId]);

			 echo $this->load->view('theme/myaccount/loadblocklist',$data,true);

			}
		}catch(Exception $e){
			
		}
	}
	
		function updateblockOrder()
		{
			$position = $_POST['position'];
				$i=1;
				foreach($position as $k=>$v)
				{
					$postData['sort']	= $i;
					$this->Basic->updatedata($postData,['block_id'=>$v],'manage_block');
				$i++;
				}
		}


		function updateCustomorder()
		{
			   $position = $_POST['position'];
			   $block_id = $_POST['block_id'];
				$i=1;
				foreach($position as $k=>$v)
				{
					$postData['sort']	= $i;
			$this->Basic->updatedata($postData,['custom_block_field_id'=>$v,'block_id'=>$block_id],'custom_block_field');
				$i++;
				}
		}

	function rolePermission(){
		$data['title'] 		= 'Role & Permission';
		
		$data['list'] = $this->Common->select('user_type');
		$data['moduleslist'] = $this->Common->select('modules');
		$data['modulesAccessList'] = $this->Global_model->getModuleAccessByRole();
		//$data['moduleslist'] = $this->Global_model->getModuleByRole();
		$data['role_id'] =1;
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/admin/role_permission',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	function updateRoleMoudleMap(){
		$postData = $this->input->post();
		if(isset($postData) && !empty($postData)){
			$roleId 	= $postData['roleId'];
			$moduleId 	= $postData['moduleId'];
			$fieldName 	= $postData['fieldName'];
			
			$getData = $this->Common->get_name_byId('roles_module_access_map',['role_id' =>$roleId,'module_id' => $moduleId]);
			if(!empty($getData) && $getData!='FALSE'){
				$existingVal = $getData->$fieldName;
				$roles_module_access_map_id = $getData->id;
				$updateFieldValue='';
				if($existingVal=='Yes'){
					$updateFieldValue='No';
				}else if($existingVal=='No'){
					$updateFieldValue='Yes';
				}
				$updateData=[
					$fieldName  	=> $updateFieldValue,
					'updated_by' 	=> $this->session->userdata('id'),
					'updated_date'	=> date('Y-m-d H:i:s')
				];
				$this->Common->updatedata('roles_module_access_map',$updateData,['id' => $roles_module_access_map_id]);
			}else{
				$insertData=[
					'role_id'		=> $roleId,
					'module_id'		=> $moduleId,
					$fieldName  	=> 'Yes',
					'updated_by' 	=> $this->session->userdata('id'),
					'updated_date'	=> date('Y-m-d H:i:s')
				];
				$this->Common->insert('roles_module_access_map',$insertData);
			}
		}
	}
	function updateModuleByRole(){
		$postData = $this->input->post();
		if(isset($postData) && !empty($postData)){
			$roleId 	= $postData['roleId'];
			$moduleId 	= $postData['moduleId'];
			$getData = $this->Common->get_name_byId('module_role_access',['role_id' =>$roleId,'module_id' => $moduleId]);
			if(!empty($getData) && $getData!='FALSE'){
				$existingVal = $getData->status;
				$module_role_access_id = $getData->id;
				$updateFieldValue='';
				if($existingVal=='Enabled'){
					$updateFieldValue='Disabled';
				}else if($existingVal=='Disabled'){
					$updateFieldValue='Enabled';
				}
				$updateData=[
					'status'  		=> $updateFieldValue,
					'updated_by' 	=> $this->session->userdata('id'),
					'updated_date'	=> date('Y-m-d H:i:s')
				];
				$this->Common->updatedata('module_role_access',$updateData,['id' => $module_role_access_id]);
			}else{
				$insertData=[
					'role_id'		=> $roleId,
					'module_id'		=> $moduleId,
					'status'  		=> 'Enabled',
					'updated_by' 	=> $this->session->userdata('id'),
					'updated_date'	=> date('Y-m-d H:i:s')
				];
				$this->Common->insert('module_role_access',$insertData);
			}
		}
	}


	function smssubject()
	{
		$data['title'] = 'SMS Templates';

		$order = 'id'.' '.'desc';
		$where = array();
		$data['sms_subject'] = $this->Basic->getmultiplerow($order,$where,'sms_subject');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/sms_subject',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function editsubject($id)
	{
	  	$data['title'] = 'Update SMS Subjects';  

	  	$where = array('id' =>$id);
	    $data['sms_subject'] = $this->Basic->getsinglerow($where,'sms_subject');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editsubject',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function savesubject()
	{
          try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){
				
				if(!empty($postData['id'])){
					$this->Basic->updatedata($postData,['id' =>$postData['id']],'sms_subject');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
				}
				redirect('smssubject');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function manageques()
	{
		$data['title'] = 'Manage Question';
        $data['subtitle'] = 'Manage Question';

        $order = 'id'.'  '.'desc';
        $where = array();
        $data['list'] = $this->Basic->getmultiplerow($order,$where,'pre_order_question');

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/manageques',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function addques()
	{
	  	$data['title'] = 'Add Question';  

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/addques',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function editques($id)
	{
	  	$data['title'] = 'Update Question';  

	  	$where = array('id' =>$id);
	    $data['pre_order_question'] = $this->Basic->getsinglerow($where,'pre_order_question');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editques',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function saveques()
	{
	try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){
				
				if(!empty($postData['id'])){

					$this->Basic->updatedata($postData,['id' =>$postData['id']],'pre_order_question');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
				}else{
					$this->Basic->insertdata($postData,'pre_order_question');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Added Successfully</div>');
				}
				redirect('manageques');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function deleteques($id)
	{
       if($id)
        {
            $where = array('id'=>$id);
            $this->Basic->deletedata($where,'pre_order_question');
           $this->session->set_flashdata('msg', '<div class="alert alert-success">Question has been  deleted Successfully</div>');
         redirect($_SERVER['HTTP_REFERER']);
        }
	}


	  function brokercontract()
    {
         $data['title'] = 'Broker Contract';
         $data['subtitle'] = 'Broker Contract';
         
          if($this->input->post('contract'))
         {
            $RequestData['contract'] = $this->input->post('contract');
            $where = array('id'=>'1');
            $result = $this->Basic->updatedata($RequestData,$where,'site_settings');
            
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Contract(%) has been  updated for all broker sites successfully</div>');
             redirect($_SERVER['HTTP_REFERER']); 
         }

         $where = array('id' =>'1');
	     $data['site_settings'] = $this->Basic->getsinglerow($where,'site_settings');

         $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editcontract',$data);
		$this->load->view('theme/layout/footer',$data);
    }

    function fundingstatus()
    {
    	$data['title'] = 'Funding status';
        $data['subtitle'] = 'Funding status';

        $order = 'id'.'  '.'desc';
        $where = array();
        $data['fundingstatus'] = $this->Basic->getmultiplerow($order,$where,'fundingstatus');

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/fundingstatus',$data);
		$this->load->view('theme/layout/footer',$data);
    }


    function addfundstatus()
	{
	  	$data['title'] = 'Add Funding status';  

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editfundstatus',$data);
		$this->load->view('theme/layout/footer',$data);
	}



    function editfundstatus($id)
    {
       $data['title'] = 'Update Funding status';  

	  	$where = array('id' =>$id);
	    $data['fundingstatus'] = $this->Basic->getsinglerow($where,'fundingstatus');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editfundstatus',$data);
		$this->load->view('theme/layout/footer',$data);
    }


    function savefund()
    {
	   try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){
				
				if(!empty($postData['id'])){

					$this->Basic->updatedata($postData,['id' =>$postData['id']],'fundingstatus');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
				}else{
					$this->Basic->insertdata($postData,'fundingstatus');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Added Successfully</div>');
				}
				redirect('fundingstatus');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
    }


    function deletefundstatus($id)
	{
       if($id)
        {
            $where = array('id'=>$id);
            $this->Basic->deletedata($where,'fundingstatus');
           $this->session->set_flashdata('msg', '<div class="alert alert-success">Funding status has been  deleted Successfully</div>');
         redirect($_SERVER['HTTP_REFERER']);
        }
	}


	function sitemanagement()
	{
		$data['title'] = 'Site Management';
        $data['subtitle'] = 'Site Management';

        $data['site'] = $this->Basic->getsitedetails();

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/sitemanage',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function addsite()
	{
  	     $data['title'] = 'Add Site';  

  	     $data['statelist'] = $this->Common->select('state');
  	     $type =4;
  	     $data['users'] = $this->User_model->getUserDetailById('','',$type);

  	     $data['site'] = $this->Basic->getsitedetails('1');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/addsite',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function savesite()
	{
		try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){

			if(!empty($_FILES["sitelogo"]["name"]))
            {
                $image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$_FILES["sitelogo"]["name"]));
                
                $uniqueID                 = uniqid();
                $img                     = $uniqueID.'_'.$image;
                $img_unique              = basename($img);
                $config['upload_path']   = './uploads/logo/';
                $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
                $config['file_name']     = $img_unique;  
                $this->load->library("upload", $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload("sitelogo",$img_unique))
                {
                echo $this->upload->display_errors();die;
                }
                else
                {
                $postData["sitelogo"] = base_url('/uploads/logo/'.$img_unique);
                }
	       }
	       else
	       {
	       	$postData["sitelogo"] = $postData['image_old'];
	       }

	       unset($postData['image_old']);
				
				if(!empty($postData['id'])){

					$this->Basic->updatedata($postData,['id' =>$postData['id']],'site_settings');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
				}else{

			$where = array('domain'=>$this->input->post('domain'));
			$last = $this->Basic->getsinglerow($where,'site_settings');

					  // if exist then don't run it.
					/*if(is_null($last)) {
					$res = json_decode($this->botapi->addDomain($domain, $isStandAlone));

					$result = $res->Output;
					$re = '/Gonna Purchase:(.*)/m';
					$result = $res->Output;
					preg_match_all($re, $result, $matches, PREG_SET_ORDER, 0);
					$phone_number = trim($matches[0][1]);
					if(preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $phone_number,  $p_matches)) {
					$friendly_phone_number = $p_matches[1] . '-' .$p_matches[2] . '-' . $p_matches[3];
					}
					$email = 'sales@'.$domain;
					$data['sms_mobile'] = strip_tags($phone_number);
					$data['s_phone'] = '<strong>'.$phone_number.'</strong>';

					$data['s_email'] = '<strong>'.$email.'</strong>';
					$data['username'] = $email;
					}*/
					$this->Basic->insertdata($postData,'site_settings');

					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Added Successfully</div>');
				}
				redirect('sitemanagement');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}


	function checkbroker()
	{
		 $value = $this->input->post('value');

		 $where = array('user_id' =>$value);
	     $site_settings = $this->Basic->getsinglerow($where,'site_settings');

	     if($site_settings)
	     echo "failed";
	     else
	     echo "success";	
	}


	function editsite($site_id)
	{
           //$where = array('id'=>$site_id);
		  // $data['site_settings'] = $this->Basic->getsinglerow($where,'site_settings');

		$data['title'] = 'Update Site'; 

        $data['statelist'] = $this->Common->select('state');

		$data['site'] = $this->Basic->getsitedetails($site_id);

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editsite',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	   function deletesite($id)
    {
        if($id)
        {
            $where = array('id'=>$id);
            $result = $this->Basic->deletedata($where,'site_settings');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Site has been  deleted Successfully</div>');
            redirect($_SERVER['HTTP_REFERER']);      
        }
    }


    function loadmessage()
    {
       $message_to = $this->input->post('message_to');
        
        $data = array();
        
        $emails = array();
        
        $phones = array();
        
        foreach($message_to as $ids)
        {
        	 $userbasic = $this->User_model->getUserDetailById($ids);
        	 if($userbasic)
        	 {
        	 	 $user = $userbasic[0];
        	 	 array_push($emails,$user->email);
        	 	  if($user->phone!='')
        	 	  array_push($phones,$user->phone);
        	 }
        }

        $data['emails'] = $emails;
        
        $data['phones'] = $phones;
        
        $order = 'id'.'  '.'desc';
        $where = array();
        $data['oldsubject'] = $this->Basic->getmultiplerow($order,$where,'sms_subject');
        
        echo $this->load->view('theme/myaccount/settings/loadmessage_owner',$data,TRUE);
    }


    function selectsub()
	{
		  $where = array('subject'=>$this->input->post('oldsubject'));
          $sms_template = $this->Basic->getsinglerow($where,'sms_subject');
          
          echo $sms_template->message;
	}



	 function sentmessage()
    {
        if($this->input->post('emails'))
        {
            $emails = $this->input->post('emails');
            $phones = $this->input->post('phones');
            $message123 = $this->input->post('message');
            $subjectadmin = ($this->input->post('subject')=='')?$this->input->post('selsubject'):$this->input->post('subject');

             foreach($emails as $key=>$email)
             {
                 //Email start here
                    $email_templates = getemail(36);
                    $subject  = $email_templates->subject;
                    $message  = $email_templates->message;
                    $emails = explode(',', $email);

                    foreach($emails as $email):

                            $where = array('email'=>$email);
                   $users= $this->Basic->getsinglerow($where,'users');

                   $url = $users->user_from;
                   $sitename = sitefieldwithurl('sitename',$url);
                   $logo = sitefieldwithurl('sitelogo',$url);

            $tempvalues = array('##SITEURL##'=>$url,'##SITENAME##'=>$sitename,'##LOGO##'=>$logo,'##EMAIL##'=>$email,'##MESSAGE##'=>$message123,'##DATETIME##'=>date('m-d-Y'));

                    $teacher_login_detail = array(
                    'to'        => $email,
                    'subject'   => $subjectadmin,
                    'message'   =>  strtr($message,$tempvalues),
                    'site'=>$url
                    );
                    
                    $this->Email_model->send_mail($teacher_login_detail, False);
                    endforeach;
                
                //email ends here and sms  starts here
                $ph1 = str_replace('', '-',$phones[$key]);
                $phones = explode(',', $ph1);
                $phones = array_map(function ($phone) {
                    $phone = str_replace('-', '', $phone);
                    if("0000000000" != $phone) {
                        return '+1' . $phone;
                    }
                 }, $phones);
                $phones = array_filter($phones);

                foreach($phones as $phone){

                     $this->TwilioModel->sendMessage($phone,$message123);
                    //$this->Twilio->sendMessage($phone,$message123);
                }
             }
             
            if($this->input->post('savesms'))
            {
                $where = array('subject'=>$subjectadmin);
                $oldsubject = $this->Basic->getsinglerow($where,'sms_subject');
    
                if(!$oldsubject)
                {
                    $dataadd = array('subject'=>$subjectadmin,'message'=>$message123,'datetime'=>date('Y-m-d H:i:s'));
                    $this->Basic->insertdata($dataadd,'sms_subject');
                }
            }
         
             $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Email and SMS has been sent successfully</div>');
             redirect($_SERVER['HTTP_REFERER']);
        }
    }


    function reasonmanage()
    {
    	$data['title'] = 'Reason Management';
        $data['subtitle'] = 'Reason Management';

        $order = 'id'.'  '.'desc';
        $where = array('parent_id'=>'0');
        $data['list'] = $this->Basic->getmultiplerow($order,$where,'credit_report_reason');

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/reasonmanage',$data);
		$this->load->view('theme/layout/footer',$data);
    }

    function addreason()
    {
    	 $data['title'] = 'Add Reason';  

    	//$order = 'id'.'  '.'desc';
       // $where = array('parent_id'=>'0');
       // $data['list'] = $this->Basic->getmultiplerow($order,$where,'credit_report_reason');


		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/addreason',$data);
		$this->load->view('theme/layout/footer',$data);
    }


     function savereason()
    {
	   try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){

				unset($postData['type']);
				
				if(!empty($postData['id'])){

					$this->Basic->updatedata($postData,['id' =>$postData['id']],'credit_report_reason');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
				}else{
					$this->Basic->insertdata($postData,'credit_report_reason');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Added Successfully</div>');
				}

				if($this->input->post('type')=='ins')
				redirect('instructmanage');
				else	
				redirect('reasonmanage');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
    }


    function editreason($id)
    {
		$data['title'] = 'Update Reason'; 

		$where = array('id'=>$id);
        $data['credit_report_reason'] = $this->Basic->getsinglerow($where,'credit_report_reason');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editreason',$data);
		$this->load->view('theme/layout/footer',$data);
    }


      function deletereason($id)
    {
        if($id)
        {
            $where = array('id'=>$id);
            $result = $this->Basic->deletedata($where,'credit_report_reason');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Reason has been  deleted Successfully</div>');
            redirect($_SERVER['HTTP_REFERER']);      
        }
    }

    function instructmanage()
    {
        $data['title'] = 'Instruction Management';
        $data['subtitle'] = 'Instruction Management';

        $order = 'id'.'  '.'desc';
        $where = array('parent_id !='=>'0');
        $data['list'] = $this->Basic->getmultiplerow($order,$where,'credit_report_reason');

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/instructmanage',$data);
		$this->load->view('theme/layout/footer',$data);	
    }

    function addinstruction()
    {
    	  $data['title'] = 'Add Instruction';  

        $order = 'id'.'  '.'desc';
        $where = array('parent_id'=>'0');
        $data['list'] = $this->Basic->getmultiplerow($order,$where,'credit_report_reason');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/addinstruction',$data);
		$this->load->view('theme/layout/footer',$data);
    }

    function editinstruction($id)
    {
        $data['title'] = 'Update Instruction'; 

		$where = array('id'=>$id);
        $data['credit_report_reason'] = $this->Basic->getsinglerow($where,'credit_report_reason');

           $order = 'id'.'  '.'desc';
        $where = array('parent_id'=>'0');
        $data['list'] = $this->Basic->getmultiplerow($order,$where,'credit_report_reason');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editinstruction',$data);
		$this->load->view('theme/layout/footer',$data);
    }

    function paymentmethod()
    {
    	$data['title'] = 'Add Payment Method';
        $data['subtitle'] = 'Add Payment Method';

        $order = 'payment_id'.'  '.'desc';
        $where = array('domain'=>base_url());
        $data['list'] = $this->Basic->getmultiplerow($order,$where,'payment_methods');

        $this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/paymentmethod',$data);
		$this->load->view('theme/layout/footer',$data);
    }

    function addpayment()
    {
    	$data['title'] = 'Add Payment';  

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/addpayment',$data);
		$this->load->view('theme/layout/footer',$data);
    }

    function savepayment()
    {
         try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){

				$postData['domain'] = base_url();

				if(!empty($postData['payment_id'])){
$this->Basic->updatedata($postData,['payment_id' =>$postData['payment_id']],'payment_methods');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
				}else{
					$this->Basic->insertdata($postData,'payment_methods');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Added Successfully</div>');
				}
				redirect('paymentmethod');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
    }

    function editpayment($id)
    {
		$data['title'] = 'Update Payment'; 

		$where = array('payment_id'=>$id);
        $data['payment_methods'] = $this->Basic->getsinglerow($where,'payment_methods');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/settings/editpayment',$data);
		$this->load->view('theme/layout/footer',$data);
    }



      function deletepayment($id)
    {
        if($id)
        {
            $where = array('payment_id'=>$id);
            $result = $this->Basic->deletedata($where,'payment_methods');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Payment has been  deleted Successfully</div>');
            redirect($_SERVER['HTTP_REFERER']);      
        }
    }
    

}
