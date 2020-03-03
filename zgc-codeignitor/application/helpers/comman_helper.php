<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}
	
	function getPaymentStatus($statusId=0){
		
		$status='Pending Payment';
		if($statusId==1){
			$status='Client Confirmed Payment';
		}
		
	}
        function get_client_ip()  
		{
			$ipaddress = '';
			if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
			else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
			else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
			else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
			else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
			else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
			else
			$ipaddress = 'UNKNOWN';
			return $ipaddress;
         }
		
			function sitename()
			{
				return 'GET THAT CREDIT';
			}
			
			function sitelogo()
			{
				$sitelog=base_url().'assets/images/logo.jpg';
				return $sitelog;
			}
			function sitepurelogo()
			{
				$ci =& get_instance();
				$where = array('domain'=>base_url());
				$layout_text_colors = $ci->Basic->getsinglerow($where,'site_settings');

				if($layout_text_colors)
				$logo = $layout_text_colors->sitelogo;
				else    
				$logo ='https://portal.zerogravitycredit.com/uploads/5d361de911560_5cdb4b585af9a.png';
			
				return $logo;
			}
		/*************
		function siteemail()
		{
			$ci =& get_instance();
			$where = array('domain'=>base_url());
			$admindetails = $ci->Basic->getsinglerow($where,'site_settings');
			return  ($admindetails && $admindetails->siteemail)?$admindetails->siteemail:'info@zerogravitycredit.com';
		}

		function sitephone()
		{
			$ci =& get_instance();
			$where = array('domain'=>base_url());
			$admindetails = $ci->Basic->getsinglerow($where,'site_settings');

			return  ($admindetails && $admindetails->sitephone)?$admindetails->sitephone:'951-698-9339';
		}
		*************/

		function sitefield($key)
		{
			$ci =& get_instance();
			$where = array('domain'=>base_url());
			$admindetails = $ci->Basic->getsinglerow($where,'site_settings');
			return ($admindetails && $admindetails->$key)?$admindetails->$key:'zerogravitycredit';
		}

		function sitefieldwithurl($key,$url)
		{
			$ci =& get_instance();
			$where = array('domain'=>$url);
			$admindetails = $ci->Basic->getsinglerow($where,'site_settings');
			return ($admindetails && $admindetails->$key)?$admindetails->$key:'zerogravitycredit';
		}


	function siteaddress()
		{
			$ci =& get_instance();
			$where = array('domain'=>base_url());
			$admindetails = $ci->Basic->getsinglerow($where,'site_settings');
			return ($admindetails && $admindetails->site_address)?$admindetails->site_address:'zerogravitycredit'; 
		}
		
		
	 function get_random_password($chars_min = 6, $chars_max = 8, $use_upper_case = false, $include_numbers = false, $include_special_chars = false) 
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if ($include_numbers) {
            $selection .= "1234567890";
        }
        if ($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }

        $password = "";
        for ($i = 0; $i < $length; $i++) {
            $current_letter = $use_upper_case ? (rand(0, 1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
            $password .= $current_letter;
        }
        return $password;
    }
		
		function getemailbroker($id)
		{
			$ci =& get_instance();
			$where = array('id'=>$id);
			$email_templates= $ci->Basic->getsinglerow($where,'email_templates_broker');
			return $email_templates;
		}
		
		function getsmsbroker($id)
		{
		$ci =& get_instance();
		$where = array('id'=>$id);
		$email_templates= $ci->Basic->getsinglerow($where,'sms_templates_broker');
		return $email_templates;
		}
		
		function getemail($id)
		{
			$ci =& get_instance();
			$where = array('id'=>$id);
		    $email_templates= $ci->Basic->getsinglerow($where,'email_templates');
			return $email_templates;
	    }
	    
	     	    function getsms($id)
	{
		$ci =& get_instance();
		$where = array('id'=>$id);
	    $email_templates= $ci->Basic->getsinglerow($where,'sms_templates');
		return $email_templates;
    }


    function getallcategory()
	{
		$ci =& get_instance();
	    $ci->db->select('*');
        $ci->db->from('category');
		$ci->db->where('status',1);
		$ci->db->order_by('sort_no','ASC');
        $query = $ci->db->get();
		return $query->result();
	}

	function getProductList()
	{
		$ci =& get_instance();
		$ci->db->select('*');
        $ci->db->from('products');
        $ci->db->join('product_image', 'products.product_id = product_image.product_id');
		$ci->db->where('products.status',1);
		$ci->db->order_by('products.product_id', 'desc'); 
		$ci->db->group_by('products.product_id'); 
        $query = $ci->db->get();
		return $query->result();
	}
	
	function getcustomFieldByBlockId($blockId=0)
	{
		$ci =& get_instance();
		$query = $ci->Product_model->getcustomBlockFieldList($blockId);
		return $query;
	}
	function slugurl($string) {
		//Lower case everything
		$string = strtolower($string);
		//Make alphanumeric (removes all other characters)
		$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
		//Clean up multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", " ", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		return $string;
	}
	function getStatus($statusId=0){
		$status='Inactive';
		if($statusId==1){
			$status='Active';
		}
		return $status;
	}
	function getCategoryName($category_id)
	{
		$ci =& get_instance();
		$where = array('category_id'=>$category_id);
		$name= $ci->Basic->getsinglerow($where,'category');
		return $name->category_name;
	}
	function getTotalItem()
	{
		$sumOfItems=0;
		if(isset($_SESSION['shopping_cart'])){
		$count_articles = array_count_values($_SESSION['shopping_cart']);
        $sumOfItems = array_sum($count_articles);
		}
		/*$ci =& get_instance();
		$sumOfItems = $ci->shoppingcart->sumValues;*/
		return $sumOfItems;
	}


	function getheadermenu()
	{
		$ci =& get_instance();

		$order = 'id'.' '.'asc';
		$where = array('status'=>1,'group_position'=>1);
		$navigationhead = $ci->Basic->getmultiplerow($order,$where,'navigation');

		$headerarray = [];

		foreach($navigationhead as $head)
		{
		$where = array('id'=>$head->parent_id);
		$pages = $ci->Basic->getsinglerow($where,'pages');

		if($pages)
		$headerarray[$head->menu] = base_url('page/'.$pages->page_url);
		}


		return $headerarray;
	}


	function getfootermenu()
	{
        $ci =& get_instance();

		$order = 'id'.' '.'asc';
		$where = array('status'=>1,'group_position'=>2);
		$navigationhead = $ci->Basic->getmultiplerow($order,$where,'navigation');

		$footerarray = [];

		foreach($navigationhead as $head)
		{
		$where = array('id'=>$head->parent_id);
		$pages = $ci->Basic->getsinglerow($where,'pages');

		if($pages)
		$footerarray[$head->menu] = base_url('page/'.$pages->page_url);
		}

		return $footerarray;
	}


	function getorderproducts($order_id)
	{
		$ci =& get_instance();

          	$where = array('order_id'=>$order_id);
		    $order = $ci->Basic->getsinglerow($where,'orders');

                     $temp1 =str_replace("[","",$order->product_block_ids);

                     $temp = str_replace("]","",$temp1);

                     $productarray = explode(",",$temp);

                     $productsname ='';

                     if(count($productarray))
                     {
                     	foreach($productarray as $prod)
                     	{
                     		if($prod!='')
                     		{
                     		$prod1 =str_replace('"',"",$prod);

                     		$where = array('product_id'=>$prod1);
					        $products = $ci->Basic->getsinglerow($where,'products');
                             
                             if($products)
                             {
                                 $productsname .= $products->product_name.',';
                             }
                         }
                    }
               }

        return $productsname;
	}

	function getimageproduct($product_id)
	{
           $ci =& get_instance();

           $where = array('product_id'=>$product_id);
		   $product_image = $ci->Basic->getsinglerow($where,'product_image');

		   if($product_image)
		   	$image =  $product_image->image_name;
		   else
		   	$image = base_url('assets/images/noimage.png');

		   return $image;
	}


	function orderusersname($user_id)
	{
		$ci =& get_instance();
		$where = array('user_id'=>$user_id);
		$userdetails = $ci->Basic->getsinglerow($where,'user_details');
		if($userdetails)
		$name = ucfirst($userdetails->first_name).' '.ucfirst($userdetails->last_name);
		else
		$name = '';
		return $name;
	}
	function getRefrenceNumber($user_id){
		$ci =& get_instance();
		$where = array('id'=>$user_id);
		$users = $ci->Basic->getsinglerow($where,'users');
		$name = $users->referal_code ?? '';
		return $name;
	}
	function getprofileimage($user_id)
	{
		   $ci =& get_instance();
			$where = array('user_id'=>$user_id);
			$userdetails = $ci->Basic->getsinglerow($where,'user_details');
			if($userdetails && $userdetails->profile_image!=NULL)
			$image = $userdetails->profile_image;
			else
			$image = base_url().'assets/images/avatar_2x.png';
			return $image;
	}

	function getphonenumbers($user_id)
	{
		    $ci =& get_instance();

			$where = array('user_id'=>$user_id);
			$userdetails = $ci->Basic->getsinglerow($where,'user_details');

			if($userdetails)
			$phone = $userdetails->phone;
			else
			$phone = '';

			return $phone;
	}


	function getsitename($user_id)
	{
		  $ci =& get_instance();

			$where = array('id'=>$user_id);
			$userdetails = $ci->Basic->getsinglerow($where,'users');

			if($userdetails)
			$user_from = $userdetails->user_from;
			else
			$user_from = '';

			return $user_from;
	}

	 function getsitenamefromadmin($site_url)
	 {
	 	   $ci =& get_instance();

			$where = array('domain'=>$site_url);
			$site_settings = $ci->Basic->getsinglerow($where,'site_settings');

			if($site_settings)
			$sitename = $site_settings->sitename;
			else
			$sitename = '';

			return $sitename;
	}

	function getsiteemailfromadmin($site_url)
	{
		$ci =& get_instance();

			$where = array('domain'=>$site_url);
			$site_settings = $ci->Basic->getsinglerow($where,'site_settings');

			if($site_settings)
			$siteemail = $site_settings->siteemail;
			else
			$siteemail = '';

			return $siteemail;
	}

	
	
	function sendPostData($url='',$postdata=[],$headers=[])
    {
        $url = $url;
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 480);
		//curl_setopt($ch, CURLOPT_HEADERFUNCTION, "HandleHeaderLine");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		$response = curl_exec($ch);
		return $response;
		
		// Then, after your curl_exec call:
		//$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		//$header = substr($response, 0, $header_size);
		//$body = substr($response, $header_size);
    }
	
	function HandleHeaderLine($curl, $header_line ) {
    	echo "<br>".$header_line; // or do whatever
    	return strlen($header_line);
	}

    function getallcommentssupportfornew($support_id)
    {
        $ci =& get_instance();
		$ci->db->select('*');
        $ci->db->from('support_support_reply');
		$ci->db->where('support_id',$support_id);
		$ci->db->where('user_id !=',$ci->session->userdata('user_id'));
		$ci->db->where('status',1);
		$ci->db->order_by('support_id','desc'); 
        $query = $ci->db->get();
        $support = $query->result();

		return count($support);
    }


    function allcommentsnotes($notes_id)
    {
        $ci =& get_instance();
		$ci->db->select('*');
        $ci->db->from('notes_reply');
		$ci->db->where('notes_id',$notes_id);
		$ci->db->where('user_id !=',$ci->session->userdata('user_id'));
		$ci->db->where('status',1);
		$ci->db->order_by('notes_id','desc'); 
        $query = $ci->db->get();
        $support = $query->result();
		return count($support);
    }


    function getallcomments($ticket_id)
    {
    	$ci =& get_instance();

		$order = 'support_id'.' '.'asc';
		$where = array('support_id'=>$ticket_id);
		$support = $ci->Basic->getmultiplerow($order,$where,'support_support_reply');

		return $support;
    }


    function getallcommentsticket($ticket_id)
    {
    	$ci =& get_instance();

		$order = 'ticket_id'.' '.'asc';
		$where = array('ticket_id'=>$ticket_id);
		$tickets = $ci->Basic->getmultiplerow($order,$where,'support_ticket_reply');

		return $tickets;
    }

    function getstatusname($status_id)
    {
    	    $ci =& get_instance();
			$where = array('status_id'=>$status_id);
			$status = $ci->Basic->getsinglerow($where,'status');
			return $status->status_name;
    }

    function addactivity($order_id,$subject,$message)
    {
    	$ci =& get_instance();
        $user_activity = ['order_id'=>$order_id,
                          'subject'=>$subject,
                          'message'=>$message,
                          'added_by'=>$ci->session->userdata('user_id'),
                          'datetime'=>date('Y-m-d H:i:s')
                         ];
    	$activity = $ci->Basic->insertdata($user_activity,'user_activity');
    	return $activity;
    }

    function getalltaskfields($order_id,$order_detail_ids)
    {
    	$ci =& get_instance();
    	$order = 'order_detail_id'.' '.'asc';
		$where = array('order_id'=>$order_id,'block_id'=>$order_detail_ids,'flag'=>1);
		$order_detail = $ci->Basic->getmultiplerow($order,$where,'order_detail');
		$names = [];
		if($order_detail)
		{
			foreach($order_detail as $fields)
			{
				$names[] = ucfirst(  str_replace("-"," ",$fields->custom_field_name));
			}
		}
		return implode(",",$names); 
    }


    function clientdetails($user_id)
    {
    	$ci =& get_instance();
        $ci->db->select('*');
        $ci->db->from('users');
        $ci->db->join('user_details', 'user_details.user_id = users.id');
        $ci->db->where('users.id',$user_id); 
        $ci->db->where('users.status',1);
        $query = $ci->db->get();
		return $query->result();
    }


    function getclientids($broker_id)
    {
    	$ci =& get_instance();

            $order = 'id'.'  '.'desc';
			$where = array('users.parent_user_id'=>$broker_id,'user_type'=>5);
			$Res = $ci->Basic->getmultiplerow($order,$where,'users');
			
			$userids = array();

			foreach ($Res as $key => $value)
			{
				array_push($userids, $value->id); 
			}

			return $userids;
    }

    function getdepartment($id)
    {
    	    $ci =& get_instance();
            $where = array('id'=>$id);
			$support_depart = $ci->Basic->getsinglerow($where,'support_depart');

			if($support_depart)
			$dept = $support_depart->dept;
			else
			$dept = '';

		    return $dept;
    }
	
	function slugify($text)
	{
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
		return 'n-a';
	  }

	  return $text;
	}
	
	function getroleprice($product_id){
		$ci =& get_instance();
		$price=0.00;
		if(!empty($product_id)){
			$products = $ci->Basic->getsinglerow(['product_id'=>$product_id],'products');
			if(!empty($products)){
				$selling_price = $products->selling_price;
				if($ci->session->userdata('user_type')==4){
					$price = $selling_price;
				}
				else  if($ci->session->userdata('user_type')==5){
					//$users = $ci->Basic->getsinglerow(['id'=>$ci->session->userdata('user_id')],'users');
						$broker_prices = $ci->Basic->getsinglerow(['product_id'=>$product_id,'broker_id'=>$ci->session->userdata('broker_id')],'product_brokers_price');
						  if($broker_prices){
							  $price = $broker_prices->price;
						  }
						  else{
							 $price = $selling_price;
						  }
				}
				else{
					 $price = $products->selling_price;
					 $users = $ci->Basic->getsinglerow(['user_type'=>4,'user_from'=>base_url()],'users');
					 if($users){
						$broker_prices = $ci->Basic->getsinglerow(['product_id'=>$product_id,'broker_id'=>$users->id],'product_brokers_price');
						if($broker_prices){
							$price = $broker_prices->price;
						}
					}
				}
			}
		}
		return $price;
		
	}
	
	function getorderprice($order_id)
	{
		$ci =& get_instance();
		$orders = $ci->Basic->getsinglerow(['order_id'=>$order_id],'orders');
		if($ci->session->userdata('user_type')==4)
		{
	  	$orderprice = ($orders->broker_amount!='0.00')?$orders->broker_amount:$orders->order_amount;
		}
		else
		{
            $orderprice = $orders->order_amount;
		}
		return $orderprice;
	}
	

	function disclaimer()
	{
			$ci =& get_instance();
			 $where = array('page_url' =>'disclaimer');
			$pages = $ci->Basic->getsinglerow($where,'pages');

			//$tempvalues = array('##SITEURL##'=>base_url(),'##SITENAME##'=>sitename());

			$message =$pages->page_content;

			return $message;
	}
	function getModuleRole($role_id=0,$module_id=0)
	{
		$ci =& get_instance();
		$where = array('role_id' =>$role_id,'module_id' =>$module_id);
		$name = $ci->Basic->getsinglerow($where,'module_role_access');
		$status = $name->status ?? '';
		return $status;
	}
	function getModuleAccessRole($role_id=0,$module_id=0)
	{
		$ci =& get_instance();
		$where = array('role_id' =>$role_id,'module_id' =>$module_id);
		$result = $ci->Basic->getsinglerow($where,'roles_module_access_map');
		return $result;
	}

	function getlastreply($ticket_id)
	{
		$ci =& get_instance();

		$where = array('ticket_id' =>$ticket_id);
		$support_ticket_reply = $ci->Basic->getsinglerow($where,'support_ticket_reply','ticket_id','desc');

		if(!$support_ticket_reply)
		{
	$where = array('ticket_id' =>$ticket_id);
		$support_ticket_reply = $ci->Basic->getsinglerow($where,'tickets');

		$text = $support_ticket_reply->description;
		}
		else
		$text = $support_ticket_reply->message;	

		return $text;
	}


	function getaccounttypeid($dispute_account_id)
	{
			$ci =& get_instance();

		$where = array('dispute_account_id' =>$dispute_account_id);
		$order_dispute_account_history = $ci->Basic->getsinglerow($where,'order_dispute_account_history','account_type_id','desc');

			if($order_dispute_account_history)
			$account_type_id = $order_dispute_account_history->account_type_id;
			else
			$account_type_id = '';

		return $account_type_id;
	}

	function getaccountinsid($dispute_account_id)
	{
			$ci =& get_instance();

		$where = array('dispute_account_id' =>$dispute_account_id);
		$order_dispute_account_history = $ci->Basic->getsinglerow($where,'order_dispute_account_history','account_type_id','desc');

			if($order_dispute_account_history)
			$account_ins_id = $order_dispute_account_history->account_ins_id;
			else
			$account_ins_id = '';

		return $account_ins_id;
	}
	
	function getBrokerInfoByBrokerId($broker_id){
		$ci =& get_instance();
        $ci->db->select('*');
        $ci->db->from('site_settings');
        $ci->db->where('user_id',$broker_id); 
        $query = $ci->db->get();
		return $query->row();
	}
	function getOrderPaymentStatus($order_id,$type)
	{
		$ci =& get_instance();
		$paymentdetails = $ci->Basic->getsinglerow(['order_id'=>$order_id,'type' => $type,'status' => 1],'order_payment_status');
		return $paymentdetails;
	}
	function getclientProductPrice($product_id){
		$ci =& get_instance();
		$price=0;
		if(!empty($product_id)){
			$broker_prices = $ci->Basic->getsinglerow(['product_id'=>$product_id,'broker_id'=>$ci->session->userdata('broker_id')],'product_brokers_price');
			  if($broker_prices){
				  $price = $broker_prices->price;
			  }
		}
		return $price;
	}
	function getProductOptions($product_id){
		$ci =& get_instance();
		if(!empty($product_id)){
			$product_options = $ci->Product_model->getProductOptionList($product_id);
			return $product_options;
		}
	}
	function getProductOptionRecord($products_options_id){
		$ci =& get_instance();
		if(!empty($products_options_id)){
			$product_options = $ci->Product_model->getProductOptionRow($products_options_id);
			return $product_options;
		}
	}
	function getBrokerName($parent_user_id=0){
		$ci =& get_instance();
		$brokername='';
		if(!empty($parent_user_id)){
			$name = $ci->Common->selectrow('users',['id'=>$parent_user_id,'user_type'=>4]);
			$brokername = $name->first_name .' '. $name->last_name;
		}
		return $brokername;
	}
	function getlastreplysupport($ticket_id=0){
		$ci =& get_instance();
        $ci->load->model('support_model');		
		if(!empty($ticket_id)){
			$getlastReply= $ci->support_model->getLastReplyById($ticket_id);
			return $getlastReply;
		}
	}
	function getCategoryId($product_id=0){
		$ci =& get_instance();
		$category_id=0;
		if(!empty($product_id)){
			$name = $ci->Common->selectrow('products',['product_id'=>$product_id],'category_id');
			$category_id = $name->category_id;
		}
		return $category_id;
	}
	//
	function getTotalTicketsNoti(){
		$ci =& get_instance();
		$ci->load->model('Myaccount_model');
		$getticketnoti = $ci->Myaccount_model->getTotalTicketsNotification();
		return $getticketnoti;
		
	}
	function getTotalTasksNotifi(){
		$ci =& get_instance();
		$ci->load->model('Myaccount_model');
		$gettasknoti = $ci->Myaccount_model->getTotalTasksNotification();
		return $gettasknoti;		
	}
	function getTicketsNotifi(){
		$ci =& get_instance();
		$ci->load->model('Myaccount_model');
		$gettinoti = $ci->Myaccount_model->getTicketsNotification();
		return $gettinoti;		
	}
	function getTasksNotifi(){
		$ci =& get_instance();
		$ci->load->model('Myaccount_model');
		$gettinoti = $ci->Myaccount_model->getTasksNotification();
		return $gettinoti;
		
	}

	function usersname($user_id)
	{
		$name = '';
		$ci =& get_instance();
		$where = array('id'=>$user_id);
		$userdetails = $ci->Basic->getsinglerow($where,'users');
		
		if($userdetails){
		$name = ucfirst($userdetails->first_name).' '.ucfirst($userdetails->last_name);
		}
		return $name;
	}

