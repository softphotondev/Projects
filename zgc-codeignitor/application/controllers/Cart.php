<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {


	 public $sumValues;
    /*
     * 1 month expire time
     */
    private $cookieExpTime = 2678400;
	
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('id')) {
			redirect('login');
		}
		$this->load->helper('url');
		//$this->load->library('shoppingcart');
		$this->userId =$this->session->userdata('user_id');
		$this->userTypeId =$this->session->userdata('user_type');
	}

	function index(){
		$data['title'] = 'Cart'; 
		//echo "<pre>";
		// $getCartItems = $this->shoppingcart->getCartItems();
		//print_r($getCartItems);exit;
		$data['cartItems'] 	= $this->shoppingcart->getCartItems();
		$data['sumOfItems'] = $this->shoppingcart->sumValues;

		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/cart',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}
	function checkout(){		
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		if($this->session->userdata('user_type')==4)
		{
			$data['clients'] = $this->User_model->getclients();
		}
		$userId = $this->session->userdata('user_id');
		
		$data['title'] = 'Checkout'; 
		$data['pre_dynamic_block']=[];
		$data['orderId']='';
		$orderId=0;
		$getCartItems = $this->shoppingcart->getCartItems();
		$productId = $getCartItems['array'][0]['product_id'];
	
		if($this->session->userdata('order_id')){
			$orderId = $this->session->userdata('order_id');
			$data['pre_dynamic_block'] 	= $this->Product_model->getdynamicBlockByOrderId($orderId);
			$data['orderId'] 		= $orderId;
			$data['contract_sign_letter'] = $this->Global_model->getContractLetterByUserId($userId,$orderId,$productId);
			$data['dispute_items'] = $this->Global_model->selectYouDisputeItem($orderId,$userId);
		
		}

		$isIncompleteOrderExist = $this->Common->checkIncompleteOrderInCart($productId,$userId);
		if(!empty($isIncompleteOrderExist)){
			$order_id 	= $isIncompleteOrderExist->order_id;
			$step_stage = $isIncompleteOrderExist->step_stage;
			$totalsteps = $isIncompleteOrderExist->totalsteps;
			$step=$step_stage;
			if($totalsteps>$step_stage){
				$step=$step_stage+1;
			}
			redirect('completecheckout/'.$order_id.'?step='.$step);
		}else{
			$data['cartItems'] 	= $getCartItems;
			$data['sumOfItems'] = $this->shoppingcart->sumValues;
			$data['dynamic_block'] = $this->Product_model->getdynamicBlockByProductId($productId);
			if(!empty($_SESSION['products_options_id'])){
				$data['product_options'] = $this->Common->selectrow('products_options',['products_options_id'=>$_SESSION['products_options_id']]);
			}
			//print_r($data['dynamic_block']);exit;
			$this->load->view('theme/prelayout/header',$data);
			//$this->load->view('theme/checkout',$data);
			$this->load->view('theme/process_checkout',$data);
			$this->load->view('theme/prelayout/footer',$data);
		}
		
	}

	function getproductCategory($cate='')
	{
		$data['title'] = 'Shop By Category';
		$data['cartItems'] 	= $this->shoppingcart->getCartItems();
		$data['sumOfItems'] = $this->shoppingcart->sumValues;
		$data['page'] 		=	$cate;
		$data['category_list'] = $this->Basic->select('category',['status' => 1],'sort_no','ASC');
		   if($cate!='')
		   {
				if(is_numeric($cate)){
					$category = $this->Basic->getsinglerow(array('category_id' =>$cate,'status' => 1),'category');
				}			
				else{		
					$category = $this->Basic->getsinglerow(array('slug_url' =>$cate,'status' => 1),'category');
				}
				
				if(!empty($category)){
					$data['products'] = $this->Product_model->getProductList($category->category_id);
					$data['category']= $category;
				}
				else{
					$data['products'] = $this->Product_model->getProductList();
				}
			}else{
					$data['products'] = $this->Product_model->getProductList();
			}
				
			$category_ids = [];
			foreach($data['category_list'] as $cate){
				 $products = $this->Product_model->getProductList($cate->category_id);
				 $category_ids[$cate->category_id] =  count($products);
			}

	    	$data['productcount'] = $category_ids;

			$this->load->view('theme/prelayout/header',$data);
			if(isMobile()){
				$this->load->view('theme/mobile/category',$data);	
			}else{
				$this->load->view('theme/category_product',$data);
			}
			$this->load->view('theme/prelayout/footer',$data);
			
	}

	function getCategorysearch($product_id='')
	{
		$data['title'] = 'Shop By Category';
		$data['category_list'] = $this->Basic->select('category',['status' => 1]);

	    $data['products'] = $this->Product_model->getProductList('',$product_id);
	    $data['category'] = $this->Basic->getsinglerow(array('category_id' =>$data['products'][0]->category_id),'category');	
	    $category_ids = [];

	    foreach($data['category_list'] as $cate)
	    {
	    	 $products = $this->Product_model->getProductList($cate->category_id);

	    	 $category_ids[$cate->category_id] =  count($products);
	    }

	    $data['productcount'] = $category_ids;

		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/category_product',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}

	function loadsearch()
	{
		$filter = $this->input->post('filter');
		$category_id = $this->input->post('category_id');

		if($filter)
		$data['products'] = $this->Product_model->getProductfilter($filter,$category_id);
      

		echo  $this->load->view('theme/loadsearch',$data,true);
	}
	
	function addtocart(){
		try{
			 // Add product to the cart
			if ($_POST['action'] == 'add') {
				unset($_SESSION['shopping_cart']);
				if (!isset($_SESSION['shopping_cart'])) {
					$_SESSION['shopping_cart'] = array();
				}
				@$_SESSION['shopping_cart'][] = (int) $_POST['product_id'];
				if(isset($_POST['products_options_id'])){
					@$_SESSION['products_options_id'] = (int) $_POST['products_options_id'];
				}
				$this->createorder($_POST);
			}
			else if ($_POST['action'] == 'remove') {
				if (($key = array_search($_POST['product_id'], $_SESSION['shopping_cart'])) !== false) {
					unset($_SESSION['shopping_cart'][$key]);
				}
			}
			$domain = $this->config->item('base_url');
			@set_cookie('shopping_cart', serialize($_SESSION['shopping_cart']), $this->cookieExpTime,'',$domain);
			redirect('checkout/');

		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
    }
	
	function productDetail($product_id=''){
		$data['title'] = 'Product Detail'; 
		if(isset($_SESSION['products_options_id'])){
			unset($_SESSION['products_options_id']);
		}	
		$data['products'] = $this->Product_model->getProductList('',$product_id);
		if(isset($data['products'][0]->block_ids)){
			$data['total_steps'] = count(json_decode($data['products'][0]->block_ids)) ??  0 ;
		}
		$order = 'product_image'.' '.'asc';
		$where = array('product_id'=>$product_id);
		$data['productsimages'] = $this->Basic->getmultiplerow($order,$where,'product_image');
	
		$data['price'] = getroleprice($product_id);
		
		$data['category'] = $this->Basic->getsinglerow(array('category_id' =>$data['products'][0]->category_id),'category');	
		
		$data['product_options'] = $this->Common->select('products_options',['product_id' => $product_id]);

		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/product_detail',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}

	/***********
	@UserType : 5 - Client , 
	************/
	function completeCheckout(){
		error_reporting(-1);
		ini_set('display_errors', 1);
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$urlstring=$this->uri->uri_string();
		$orderId = substr(strrchr($urlstring, "/"), 1);
		if(isset($orderId) && !empty($orderId)){
			$data['title'] 	= 'Complete Checkout Process';
			$data['page'] 	= 'precheckout'; 
			$data['pre_dynamic_block']=[];

			$OrderItems = $this->Global_model->getOrderItemDetailByOrderId($orderId);
			//$productId = isset($OrderItems[0]->product_id) ? $OrderItems[0]->product_id : 0;
			
			$OrderData = $this->Basic->getsinglerow(['order_id'=>$orderId],'orders');
			
			$productId  = isset($OrderData->product_id) ? $OrderData->product_id : 0;
			$userId 	= $OrderData->user_id;
			
			$data['product_data'] 	= $this->Basic->getsinglerow(['product_id'=>$productId],'products');
			$data['users_data'] 	= $this->Basic->getsinglerow(['id'=>$userId],'users');
			
			$data['orders']= $OrderData;
			if($this->session->userdata('user_type')==4){
				$data['clients'] = $this->User_model->getclients();
			}
			$getCartItems = $this->shoppingcart->getCartItems();
			if(empty($productId)){
				
				$productId = $getCartItems['array'][0]['product_id'];
				//$data['cartItems'] 	= $getCartItems;
				$data['sumOfItems'] = $this->shoppingcart->sumValues;
			}
			$data['cartItems'] 	= $getCartItems;
			$data['pre_dynamic_block'] 	= $this->Product_model->getdynamicBlockByOrderId($orderId);
			$data['orderId'] 		= $orderId;
			$data['userId'] 		= $userId;
			$data['dynamic_block'] = $this->Product_model->getdynamicBlockByProductId($productId);
			
			
			$data['contract_sign_letter'] = $this->Global_model->getContractLetterByUserId($userId,$orderId,$productId);

			$where = array('user_id'=>$userId,'order_id'=>$orderId);
            $data['contract_sign'] = $this->Basic->getsinglerow($where,'contract_sign');
			if(isset($data['contract_sign']) && !empty($data['contract_sign'])){
				if($data['contract_sign']->contract_url==NULL)
				{
					$data['iscontractUploaded']=0;
					$data['downloadlink'] =  $data['contract_sign']->before_sign_contract;
					//$viewurl = '';    
				}
				else
				{
					 $data['iscontractUploaded']=1;
					 $data['downloadlink'] =  $data['contract_sign']->contract_url;
					 //$viewurl = $data['contract_sign']->contract_url;   
				}
			}
			$data['dispute_items'] = $this->Global_model->selectYouDisputeItem($orderId,$userId);

			//print_r($data['dynamic_block']);exit;
			$this->load->view('theme/prelayout/header',$data);
			$this->load->view('theme/process_checkout',$data);
			$this->load->view('theme/prelayout/footer',$data);
		}
	}
	
	function payment(){		
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		
		$userId = $this->session->userdata('user_id');
		
		$broker_id = $this->session->userdata('broker_id');
		
		$urlstring=$this->uri->uri_string();
		$orderId = substr(strrchr($urlstring, "/"), 1);
		if(isset($orderId) && !empty($orderId)){
			$data['orderId'] 		= $orderId;
			$getCartItems = $this->shoppingcart->getCartItems();
			if(!empty($getCartItems)){
				$productId = $getCartItems['array'][0]['product_id'];
				$data['cartItems'] 	= $getCartItems;
				$data['sumOfItems'] = $this->shoppingcart->sumValues;
			}else{
				$OrderData = $this->Basic->getsinglerow(['order_id'=>$orderId],'orders');
				$productId 			= $OrderData->product_id;
				if(!empty($productId)){
					$productData = $this->Product_model->getProductDetailsByID($productId);
					$product_name  = $productData[0]->product_name;
					$selling_price = $productData[0]->selling_price;
					$getCartItems=[
					'finalSum' 	=> $selling_price,
					'array'		=> [[
						'product_name' 	=> $product_name,
						'num_added'		=> 1,
						'selling_price'	=> $selling_price,
						'product_id' 	=> $productId
						]]
					];
					$data['cartItems'] 	= (array) $getCartItems;
					$data['sumOfItems'] = $selling_price;
				}
			}
			
			$data['dynamic_block'] = $this->Product_model->getdynamicBlockByProductId($productId);
			
			$data['contract_sign_letter'] = $this->Global_model->getContractLetterByUserId($userId,$orderId,$productId);
			
			if($this->userTypeId==1){
				$data['payment_methods'] =  $this->Common->select('payment_methods',['user_id' => $userId]);
			}else if($this->userTypeId==4 || $this->userTypeId==5) {
				$data['payment_methods'] =  $this->Common->select('payment_methods',['broker_id' => $broker_id ]);
			}
			//print_r($data['dynamic_block']);exit;
			$this->load->view('theme/prelayout/header',$data);
			$this->load->view('theme/checkout',$data);
			//$this->load->view('theme/process_checkout',$data);
			$this->load->view('theme/prelayout/footer',$data);
		}
	}
	
	function getproductlistByCategory($cate='')
	{
		$data['title'] = 'Shop By Category';
		$data['cartItems'] 	= $this->shoppingcart->getCartItems();
		$data['sumOfItems'] = $this->shoppingcart->sumValues;
		
		$data['category_list'] = $this->Basic->select('category',['status' => 1]);

       if($cate!='')
       {
       	if(is_numeric($cate)) 
       	$category = $this->Basic->getsinglerow(array('category_id' =>$cate),'category');	
        else		
	    $category = $this->Basic->getsinglerow(array('slug_url' =>$cate),'category');

		    if($category)
		    {
		    $data['products'] = $this->Product_model->getProductList($category->category_id);
		    $data['category']= $category;
		    }
		    else
		    $data['products'] = $this->Product_model->getProductList();
	    }
	    else
	    {
	    	$data['products'] = $this->Product_model->getProductList();
	    }

	    $category_ids = [];

	    foreach($data['category_list'] as $cate)
	    {
	    	 $products = $this->Product_model->getProductList($cate->category_id);

	    	 $category_ids[$cate->category_id] =  count($products);
	    }

	    $data['productcount'] = $category_ids;

		$this->load->view('theme/prelayout/header',$data);
		$this->load->view('theme/category_product',$data);
		$this->load->view('theme/prelayout/footer',$data);
	}

	function membershipCheckout(){
		if(!$this->session->userdata('id')) {
			redirect('login');
		}
		$userId = $this->session->userdata('id');
		if(isset($userId) && !empty($userId)){
			$data['membership']=$this->Product_model->getmembershipDetailByIdUserId($userId);
			$this->load->view('theme/prelayout/header',$data);
			$this->load->view('theme/membership_checkout',$data);
			$this->load->view('theme/prelayout/footer',$data);
		}
	}
	
	function createorder(){
		try{
			$user_id = $this->session->userdata('user_id');
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){
				
				$productId 		= $postData['product_id'];
				$product_name 	= $postData['product_name'];
				$selling_price 	= $postData['price'];
				$qty 			= $postData['qty'];
				$totalsteps 	= $postData['totalsteps'] ?? 0;
				$order_amount	= $selling_price * $qty;
				$products_options_id = $postData['products_options_id'] ?? 0;
				
				$product_options='';
				if(!empty($postData['products_options_id'])){
					$product_options = $this->Common->selectrow('products_options',['products_options_id'=> $products_options_id]);
					if(!empty($product_options) && isset($product_options)){
						$product_options 	= $product_options->sub_product_name ?? '';
					 	//$selling_price 		= $product_options->sub_selling_price ?? 0;
					}
				}
				if(!empty($productId) && isset($product_name) && isset($selling_price) && isset($qty)){
					$isIncompleteOrderExist = $this->Common->checkIncompleteOrderInCart($productId,$user_id);
					if(!empty($isIncompleteOrderExist)){
						$order_id 	= $isIncompleteOrderExist->order_id;
						$step_stage = $isIncompleteOrderExist->step_stage;
						redirect('completecheckout/'.$order_id.'?step='.$step_stage);
					}else{
						$nextOrderId = $this->Common->getMaxNumber('orders',[] ,'order_id');
						$today = strtotime(date("Ymd"));
						$rand = sprintf("%04d", rand(0,9999));
						$orderNumber = $nextOrderId.'-'.$today . $rand;
						$ordersData=[
							'order_number'		=> $orderNumber,
							'user_id' 			=> $user_id,
							'order_amount'		=> $order_amount,
							'status'			=> 0,
							'payment_status'	=> 0,
							'product_id'		=> $productId,
							'product_options'	=> $product_options,
							'product_info'		=> '',
							'totalsteps'		=> $totalsteps,
							'step_stage'		=> 1,
							'created_by'		=> $user_id,
							'added_date'		=> date('Y-m-d H:i:s'),
							'last_updated_date'	=> date('Y-m-d H:i:s')
						];
						$orderId = $this->Basic->insertdata($ordersData,'orders');
						if(!empty($orderId)){
							$ItemData=[
								'order_id' 			=> $orderId,
								'product_id'		=> $productId,
								'product_name'		=> $product_name,
								'order_qty'			=> $qty,
								'selling_price'		=> $selling_price,
								'added_date'		=> date('Y-m-d H:i:s'),
								'last_updated_date'	=> date('Y-m-d H:i:s')
							];
							$this->Basic->insertdata($ItemData,'order_items_detail');
						}
					  redirect('completecheckout/'.$orderId.'?step=1');
					}
				}else{
					throw new Exception('Soemthing went wrong in Products, Please check with administrator!');
				}
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

}
