<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('user_id')) {
			redirect('login');
		}
		$this->load->helper('url');
	}

	function index()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Product List'; 
	    $data['products'] = $this->Product_model->getProductList();

	   $category = $this->Product_model->getCategoryList();
	    
	     foreach($category as $cate)
	     {
	         $userrole[$cate->category_id] = $cate->category_name; 
	     }

	     $data['category'] = $userrole;
		
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/product',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function productlist(){
		
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Product List'; 
	    $data['products'] = $this->Product_model->getProductList();

	   $category = $this->Product_model->getCategoryList();
	    
	     foreach($category as $cate)
	     {
	         $userrole[$cate->category_id] = $cate->category_name; 
	     }
	     $data['category'] = $userrole;
		
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/productlist',$data);
		$this->load->view('theme/layout/footer',$data);
	}


	function removeimage()
    {
        $product_id = $this->input->post('product_id');

        $id = $this->input->post('id');

        $old_image = $this->input->post('old_image');

        $value = $this->input->post('value');

         $array = explode(',',$old_image);

        if (($key = array_search($value, $array)) !== false) 
        {
         unset($array[$key]);
       }
       echo  implode(",",$array);
    }


    function deleteproduct($id)
    {
	   if($id)
        {
            $data = ['status'=>0];
            $where = array('product_id'=>$id);
            $this->Basic->updatedata($data,$where,'products');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Product has been  deleted Successfully</div>');
          redirect('productlist');
    }
	
    }


    function copycategory($id)
    {
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Copy Category';  
		$data['categorylist'] = $this->Basic->getsinglerow(['category_id' => $id],'category');

		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/editcategory',$data);
		$this->load->view('theme/layout/footer',$data);
    }


	// category starts here
	function categorylist()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Category List';
		$data['category'] = $this->Product_model->getCategoryList();
		$head = ['Category','Status','Actions'];
		$headrows = [];
	      foreach($data['category'] as $cate){
	      	   $status = ($cate->status==1)?'Active':'Inactive';
			   
               $headrows[] = [$cate->category_id,$cate->category_name,$status,'<a class="btn btn-success btn-xs" href='.base_url('copycategory/'.$cate->category_id).' data-original-title="btn btn-danger btn-xs" title="">Copy</a>
               <a class="btn btn-success btn-xs" href='.base_url('product/addcategory/'.$cate->category_id).' data-original-title="btn btn-danger btn-xs" title="">Edit</a>
                 <a class="btn btn-danger btn-xs"  href='.base_url('product/deletecategory/'.$cate->category_id).' onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>'];
	      }

          $datas3333['formaction'] = base_url('product/multicatedelete');
	      $datas3333['head'] = $head;
	      $datas3333['headrows'] = $headrows;
	   
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/dynamictable',$datas3333);
		//$this->load->view('theme/myaccount/category_list',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	function multicatedelete()
	{
		$RequestData = $this->input->post();

          if(count($RequestData['ids'])>0)
          {
          	foreach ($RequestData['ids'] as $key =>$id) 
          	{
			$data = array('status'=>2);
			$where = array('category_id'=>$id);
			$this->Basic->updatedata($data,$where,'category');
          	}
          }

       $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Category has been Deleted successfully</div>');

           redirect($_SERVER['HTTP_REFERER']);
	}

	function deletecategory($id)
	{
       if($id)
       {
       		$data = array('status'=>2);
			$where = array('category_id'=>$id);
			$this->Basic->updatedata($data,$where,'category');
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Category has been Deleted successfully</div>');
            redirect($_SERVER['HTTP_REFERER']);
       }
	}
	
	function addcategory(){
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$urlstring=$this->uri->uri_string();
		$categoryId = substr(strrchr($urlstring, "/"), 1);
		if(isset($categoryId) && !empty($categoryId)){
			$data['title'] = 'Update Category'; 
			$data['categorylist'] = $this->Basic->getsinglerow(['category_id' => $categoryId],'category');
			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/editcategory',$data);
			$this->load->view('theme/layout/footer',$data);
		}else{
			$data['title'] = 'Add Category'; 
			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/addcategory',$data);
			$this->load->view('theme/layout/footer',$data);
		}
	}

	function saveCategory(){
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){

		    if(!empty($_FILES["image"]["name"]))
            {
                $image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$_FILES["image"]["name"]));
                
                $uniqueID                 = uniqid();
                $img                     = $uniqueID.'_'.$image;
                $img_unique              = basename($img);
                $config['upload_path']   = './uploads/category/';
                $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
                $config['file_name']     = $img_unique;  
                $this->load->library("upload", $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload("image",$img_unique)){
					throw new Exception($this->upload->display_errors());
                }
                else
                {
                $postData["image"] = base_url('/uploads/category/'.$img_unique);
                }
	       }
	       else
	       {
	       	 $postData["image"] = $postData['image_old'];
	       }
	        if(!empty($_FILES["icon_url"]["name"])){
                $image = preg_replace('/[^a-zA-Z0-9.]/', '', str_replace(' ', '-',$_FILES["icon_url"]["name"]));
                $uniqueID                 = uniqid();
                $img                     = $uniqueID.'_'.$image;
                $img_unique              = basename($img);
                $config['upload_path']   = './uploads/category/';
                $config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
                $config['file_name']     = $img_unique;  
                $this->load->library("upload", $config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload("icon_url",$img_unique)){
               	 throw new Exception($this->upload->display_errors());
                }
                else
                {
                $postData["icon_url"] = base_url('/uploads/category/'.$img_unique);
                }
	       }
	       else
	       {
	       	 	$postData["icon_url"] = $postData['icon_url_old'];
	       }

          if(!empty($postData['icon_url_old']) || !empty($postData['image_old'])){ 
	       	unset($postData['image_old']);
	       	unset($postData['icon_url_old']);
	       }
			if(!empty($postData['category_id'])){
					if(empty($postData['slug_url'])){
						$postData['slug_url'] = slugify($postData['category_name']);
					}
					$postData['last_updated_date']	= date('Y-m-d H:i:s');
					$this->Basic->updatedata($postData,['category_id' => $postData['category_id']],'category');
					
					/******Add Update in Affiliaet*******/
					$checkexistCategory = $this->Basic->getsinglerow(['category_id' =>$postData['category_id']],'categories');
						$dataAffiCategory=[
							'category_id' 	=> $postData['category_id'],
							'name' 			=> $postData['category_name'],
							'slug' 			=> $postData['slug_url'],
							'description' 	=> $postData['description'],
							'image' 		=> $postData["image"],
							'parent_id' 	=> 0,
							'created_at' 	=> date('Y-m-d H:i:s')
						];
					if(empty($checkexistCategory)){
						$this->Basic->insertdata($dataAffiCategory,'categories');
					}else{
						$this->Basic->updatedata($dataAffiCategory,['category_id' => $postData['category_id']],'categories');
					}
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
				}else{
					$postData['added_date']			= date('Y-m-d H:i:s');
					$postData['last_updated_date']	= date('Y-m-d H:i:s');

					$existcate = $this->Basic->getsinglerow(['category_name' =>$postData['category_name']],'category');

					if($existcate){
						throw new Exception('Category Name already exist!');
					}

					$category_id = $this->Basic->insertdata($postData,'category');
					
					$dataAffiCategory=[
						'category_id' 	=> $category_id,
						'name' 			=> $postData['category_name'],
						'slug' 			=> slugify($postData['category_name']),
						'description' 	=> $postData['description'],
						'image' 		=> $postData["image"],
						'parent_id' 	=> 0,
						'created_at' 	=> date('Y-m-d H:i:s')
					];
					$this->Basic->insertdata($dataAffiCategory,'categories');
						
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Added Successfully</div>');
				}
				redirect('getcategory');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	function addproduct($id='')
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		if($this->input->post('product_name'))
	    {
	    	//image upload starts here
	    	$_POST['product_image'] = '';
        	$name_array = $default_array = $name_array_thumb= array();
        	$filesCount = count($_FILES['product_image']['name']);

            if($filesCount>0){
				for($i = 0; $i < $filesCount; $i++){
				 $random1 = substr(number_format(time() * rand(),0,'',''),0,10);

				if(!empty($_FILES["product_image"]["name"][$i])){
					$filename = $_FILES['product_image']['name'][$i];
					$_FILES['file']['name']     = $random1.'_'.$filename;
					$_FILES['file']['type']     = $_FILES['product_image']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['product_image']['tmp_name'][$i];
					$_FILES['file']['error']    = $_FILES['product_image']['error'][$i];
					$_FILES['file']['size']     = $_FILES['product_image']['size'][$i];

					$uploadPath = './uploads/product/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'jpg|jpeg|png|gif';


					$this->load->library('upload', $config);
					$this->upload->initialize($config);
				if($this->upload->do_upload('file'))
				{
					$fileData = $this->upload->data();
					array_push($name_array,base_url('/uploads/product/'.$fileData['file_name']));

						$thumb_path = './uploads/product/thumbnail/';

						if (!is_file($fileData['file_name'])) {
						$config = array(
						'source_image' => $fileData['full_path'], //get original image
						'new_image' => $thumb_path,
						'maintain_ratio' => true,
						'width' => 635,
						'height' => 340
						);

						$this->load->library('image_lib', $config); //load library
						$this->image_lib->resize(); //do whatever specified in config
						}
						array_push($name_array_thumb,base_url('/uploads/product/thumbnail/'.$fileData['file_name']));
				}
				else
					{
						echo $this->upload->display_errors();die;
					}
				}
				}
            } 

			$block_ids = $this->input->post('block_ids');
			
			$product_name 	= $this->input->post('product_name');
			$category_id 	= $this->input->post('category_id');
			$selling_price 	= $this->input->post('selling_price');
			$product_cost 	= $this->input->post('product_cost');
			$product_type 	= $this->input->post('product_type');
			$qty 			= $this->input->post('qty');
			$description 	= $this->input->post('description');
			$refund_policy 	= $this->input->post('refund_policy');
			
			
			$productdata = [
				'product_name'	=> $product_name,
				'category_id'	=> $category_id,
				'product_type'	=> $product_type,
				'block_ids'		=> json_encode($block_ids),
				'selling_price'	=> $selling_price,
				'product_cost'	=> $product_cost,
				'qty'			=> $qty,
				'description'	=> $description,
				'refund_policy'	=> $refund_policy,
				'added_date'	=> date('Y-m-d H:i:s'),
				'slug_url'		=> slugify($product_name)
	       ];

	         if($this->input->post('id')){
              $oldimage = $this->input->post('old_images');
				if($oldimage!=''){
					$sql1 = 'Delete FROM product_image WHERE product_image NOT IN ('.$oldimage.') and product_id='.$this->input->post('id').'  ';
					$query1 = $this->db->query($sql1);
				}
				
				$product_id = $this->input->post('id');
				
	            $where = ['product_id'=>$product_id];
	            $this->Basic->updatedata($productdata,$where,'products');
				
				/***** Products Options  ******/
					if(!empty($this->input->post('sub_product_name'))){
						foreach($_POST['sub_product_name'] as $key => $getsubProj){
							$products_options_id 	= $_POST['products_options_id'][$key] ?? 0;
							$sub_product_name 		= $_POST['sub_product_name'][$key] ?? '';
							$sub_qty				= $_POST['sub_qty'][$key] ?? 0;
							$sub_product_cost 		= $_POST['sub_product_cost'][$key] ?? 0;
							$sub_selling_price 		= $_POST['sub_selling_price'][$key] ?? 0;
							if(!empty($products_options_id) && !empty($sub_product_name) && !empty($sub_selling_price)){
								$updateProjOptions=[
									'sub_product_name' 	=> $sub_product_name,
									'sub_qty' 			=> $sub_qty,
									'sub_product_cost' 	=> $sub_product_cost,
									'sub_selling_price' => $sub_selling_price
								];
								$this->Basic->updatedata($updateProjOptions,['products_options_id' => $products_options_id],'products_options');
							}else{
								if(empty($products_options_id) && !empty($sub_product_name) && !empty($sub_selling_price)){
									$insertProjOptions=[
										'sub_product_name' 	=> $sub_product_name,
										'sub_qty' 			=> $sub_qty,
										'sub_product_cost' 	=> $sub_product_cost,
										'sub_selling_price' => $sub_selling_price,
										'product_id' 		=> $product_id,
										'added_date' 		=> date('Y-m-d H:i:s')
									];
									$this->Basic->insertdata($insertProjOptions,'products_options');
								}
							}
						}
					}
					
				/*******Check existing Products*******/
				
				$checkexistproduct = $this->Basic->getsinglerow(['product_id' =>$product_id],'product');
				
				/************Affiliate Product Sync **************/
					$product_sku = 'GTC-100'.$product_id;
					$affProductData =[
						'product_id'				   => $product_id,
						'product_name' 				   => $product_name,
						'product_price'				   => $selling_price,
						'product_sku'				   => $product_sku,
						'product_slug'				   => slugify($product_name),
						'product_short_description'	   => $description,
						'product_description'		   => $description,
						'product_commision_type'	   => 'percentage',
						'product_commision_value'	   => '0',
						'product_click_commision_type' => '',
						'product_click_commision_ppc'  => '',
						'product_click_commision_per'  => '',
						'product_featured_image'	   => '',
						'product_type'					=> '0',
						'product_status'				=> '1',
						'on_store'						=> 1,
						'product_ipaddress'				=> get_client_ip(),
						'product_created_date'			=> date('Y-m-d H:i:s'),
						'product_updated_date'			=> date('Y-m-d H:i:s'),
						'product_created_by'			=> $this->session->userdata('user_id'),
						'product_updated_by'			=> $this->session->userdata('user_id')
					];
					if(empty($checkexistproduct)){
						$this->Basic->insertdata($affProductData,'product');
						$this->Basic->insertdata(['product_id' => $product_id, 'category_id' => $category_id],'product_categories');
					}else{
						$this->Basic->updatedata($affProductData,['product_id' => $product_id],'product');
						$this->Basic->updatedata(['category_id' => $category_id],['product_id' => $product_id, 'category_id' => $category_id],'product_categories');
					}
				/*********** End Affiliate Product Sync **********/
				
			   if($name_array){
				 foreach($name_array as $keyimage=>$image){
						$imagedata = ['product_id'=>$this->input->post('id'),'image_name'=>$image,'thump_path'=>$name_array_thumb[$keyimage],'status'=>1,'added_date'=>date('Y-m-d H:i:s')];
						$this->Basic->insertdata($imagedata,'product_image');
				 }
			   }
				$this->session->set_flashdata('msg', '<div class="alert alert-success">Product has been  updated Successfully</div>');
	         }
	         else
	         {
				$product_id = $this->Basic->insertdata($productdata,'products');
				
				/*************Add Product Options************/
					if(!empty($this->input->post('sub_product_name'))){
						$productOptions=[];
						foreach($_POST['sub_product_name'] as $key => $getsubProj){
							if(!empty($getsubProj)){
								$productOptions[]=[
									'sub_product_name' 	=> $getsubProj,
									'sub_qty' 			=> $_POST['sub_qty'][$key],
									'sub_product_cost' 	=> $_POST['sub_product_cost'][$key],
									'sub_selling_price' => $_POST['sub_selling_price'][$key]
								];
							}
						}
						if(isset($productOptions) && !empty($product_id)){
							foreach($productOptions as $getProjOptions){
								if(!empty($getProjOptions)){
									$insertProjOption=$getProjOptions;
									$insertProjOption['product_id'] = $product_id;
									$insertProjOption['added_date'] = date('Y-m-d h:i:s');
									$this->Basic->insertdata($insertProjOption,'products_options');
								}
							}
						}
					}				
				
				/***********End Production *************/
				/************Affiliate Product Sync **************/
					$product_sku = 'GTC-100'.$product_id;
					$affProductData =[
						'product_id'				   => $product_id,
						'product_name' 				   => $product_name,
						'product_price'				   => $selling_price,
						'product_sku'				   => $product_sku,
						'product_slug'				   => slugify($product_name),
						'product_short_description'	   => $description,
						'product_description'		   => $description,
						'product_commision_type'	   => 'percentage',
						'product_commision_value'	   => '0',
						'product_click_commision_type' => '',
						'product_click_commision_ppc'  => '',
						'product_click_commision_per'  => '',
						'product_featured_image'	   => '',
						'product_type'					=> '0',
						'product_status'				=> '1',
						'on_store'						=> 1,
						'product_ipaddress'				=> get_client_ip(),
						'product_created_date'			=> date('Y-m-d H:i:s'),
						'product_updated_date'			=> date('Y-m-d H:i:s'),
						'product_created_by'			=> $this->session->userdata('user_id'),
						'product_updated_by'			=> $this->session->userdata('user_id')
					];
					$this->Basic->insertdata($affProductData,'product');
					$this->Basic->insertdata(['product_id' => $product_id, 'category_id' => $category_id],'product_categories');

				/*********** End Affiliate Product Sync **********/
				   if($name_array){
					 foreach($name_array as $keyimage=>$image){
							$imagedata = ['product_id'=>$product_id,'image_name'=>$image,'thump_path'=>$name_array_thumb[$keyimage],'status'=>1,'added_date'=>date('Y-m-d H:i:s')];
							$this->Basic->insertdata($imagedata,'product_image');
					 }
				   }
				$this->session->set_flashdata('msg', '<div class="alert alert-success">Product has been added Successfully</div>');
	       }
	     redirect('productlist');
	    }
	    
	    if($id)
	    {
	       $data['title'] = 'Update Product';  
	       $data['is_copy_enabled'] = 0;
		   $data['product'] = $this->Product_model->getProductDetailsByID($id);
		   
		   $data['productimages'] 	= $this->Product_model->getProductImagesByID($id);
		   $data['product_options']	= $this->Common->select('products_options',['sub_status' => 1,'product_id' => $id]);
		   
	    }
	    else
	    {
	      $data['title'] = 'Add Product';  
		  $data['is_copy_enabled'] = 1;
	    }

	      $category = $this->Product_model->getCategoryList();
	    
	     foreach($category as $cate)
	     {
	         $userrole[$cate->category_id] = $cate->category_name; 
	     }
	     
	      $data['category'] = $userrole;
		
		$data['category_list'] 	= $this->Basic->select('category',['status' => 1]); 
		$data['productType'] 	= $this->Basic->select('product_type',['status' => 1]); 
		$data['blocklist'] 		= $this->Product_model->getblocklist();
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addproduct',$data);
		$this->load->view('theme/layout/footer',$data);
	}

	
	/*****Product *****/
	function save(){
		try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){
				
				if(!empty($postData['product_id'])){
					$postData['last_updated_date']	= date('Y-m-d H:i:s');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
				}else{
					$postData['added_date']			= date('Y-m-d H:i:s');
					$postData['last_updated_date']	= date('Y-m-d H:i:s');
					$this->Basic->insertdata($postData,'products');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Added Successfully</div>');
				}
				redirect('getproductlist');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	/****Dynamic Block*******/
	function getblock(){
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$urlstring=$this->uri->uri_string();
		$categoryId = substr(strrchr($urlstring, "/"), 1);
		if(isset($categoryId) && !empty($categoryId)){
			$data['title'] 			= 'Category Dynamic Block';
			$data['category_id'] 	= $categoryId;
			$data['block_list'] 	= $this->Product_model->getblockRelatedDetails($categoryId,'category');
			$data['field_type'] 	= $this->Product_model->getfieldtype();
			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/block_custom_field.php',$data);
			$this->load->view('theme/layout/footer',$data);
		}
	}
	function saveBlock(){
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){
				$categoryId = $postData['category_id'];
				if($categoryId){
					if(!empty($postData['category_block_id']) && !empty($categoryId)){
						$postData['updated_at']	= date('Y-m-d H:i:s');
						$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
					}else{
						$postData['created_at']			= date('Y-m-d H:i:s');
						$postData['updated_at']	= date('Y-m-d H:i:s');
						$this->Basic->insertdata($postData,'category_block');
						$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Added Successfully</div>');
					}
					redirect('getblock/'.$categoryId);
				}
				
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	function savecustomfield(){
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){
				$categoryId = $postData['category_id'];
				if($categoryId){
					if(!empty($postData['category_block_id'])){
						unset($postData['category_id']);
						$postData['created_at']			= date('Y-m-d H:i:s');
						$this->Basic->insertdata($postData,'category_block_custom_field');
						$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
					}
					redirect('getblock/'.$categoryId);
				}
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	/**********Product ****************/
	
	function view(){
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$urlstring=$this->uri->uri_string();
		$productId = substr(strrchr($urlstring, "/"), 1);
		if(isset($productId) && !empty($productId)){
			$data['title'] = 'Product Orverview';
			$ProductData = $this->Product_model->getProductDetailsByID($productId);
			$block_ids =json_decode($ProductData[0]->block_ids);
			$data['productview'] = $ProductData;
			$data['product_id'] 	= $productId;
			$data['block_list'] 	= $this->Product_model->getblocklist($block_ids);
			$data['field_type'] 	= $this->Product_model->getfieldtype();
			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/view_product',$data);
			$this->load->view('theme/layout/footer',$data);
		}
	}

	function saveProductBlock(){
		try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){
				$product_id = $postData['product_id'];
				if($product_id){
					if(!empty($postData['product_block_id']) && !empty($product_id)){
						$postData['updated_at']	= date('Y-m-d H:i:s');
						$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
					}else{
						$postData['created_at']	= date('Y-m-d H:i:s');
						$postData['updated_at']	= date('Y-m-d H:i:s');
						$this->Basic->insertdata($postData,'products_block');
						$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Added Successfully</div>');
					}
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	function saveProductCustomfield(){
		try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){
				$product_id = $postData['product_id'];
				if($product_id){
					if(!empty($postData['product_block_id'])){
						unset($postData['product_id']);
						$postData['field_name']			= str_replace(' ', '-', strtolower($postData['label_name']));
						$postData['created_at']			= date('Y-m-d H:i:s');
						$this->Basic->insertdata($postData,'products_block_custom_field');
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

	function addmembership($id=''){
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		if(isset($id) && !empty($id)){
			$data['title'] = 'Update Membership';
			$data['page'] = 'editmembership';
			$data['membership'] = $this->Basic->getsinglerow(['membership_plan_id' => $id],'membership_plan');
			$data['membershiplist'] = $this->Common->select('user_type',['status' => 1]);
			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/addmembership',$data);
			$this->load->view('theme/layout/footer',$data);
		}else{
			$data['title'] = 'Add Membership';
			$data['page'] = 'addmembership';
			$data['membershiplist'] = $this->Common->select('user_type',['status' => 1]);
			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/addmembership',$data);
			$this->load->view('theme/layout/footer',$data);
		}
	}
	function saveMembership(){
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		try{
			$postData= $this->input->post();
			if(!empty($postData) && isset($postData)){
				
				if(!empty($postData['membership_plan_id'])){
					$postData['last_updated_date']	= date('Y-m-d H:i:s');
					$this->Basic->updatedata($postData,['membership_plan_id' => $postData['membership_plan_id']],'membership_plan');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Updated Successfully</div>');
				}else{
					$postData['added_date']			= date('Y-m-d H:i:s');
					$postData['last_updated_date']	= date('Y-m-d H:i:s');
					$this->Basic->insertdata($postData,'membership_plan');
					$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Added Successfully</div>');
				}
				redirect('product/membershiptlist');
			}
		}catch(Exception $e){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">'.$e->getMessage().'</div>');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	function membershiptlist()
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		$data['title'] = 'Membership Plan List';
		$data['page'] = 'membershiplist';
		$data['membership'] = $this->Common->select('membership_plan');
		$this->load->view('theme/layout/header',$data);
		$this->load->view('theme/myaccount/addmembership',$data);
		$this->load->view('theme/layout/footer',$data);
	}
	function deletemembership($id=''){
       if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
	   if($id){
			$where = array('membership_plan_id'=>$id);
			$this->Basic->deletedata($where,'membership_plan');
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Memberhsip Place Deleted Successfully!</div>');
            redirect($_SERVER['HTTP_REFERER']);
       }
	}
	
	function copyproduct($product_id=0)
	{
		if($this->session->userdata('user_type')!=1){
			redirect('order/myaccount');
		}
		if($product_id){
			$data['title'] 			= 'Add Product';
			$data['is_copy_enabled'] = 1;
			
			 $category = $this->Product_model->getCategoryList();
			 foreach($category as $cate){
				 $userrole[$cate->category_id] = $cate->category_name; 
			 }
	     
	      	$data['category'] = $userrole;
		  
			$data['product'] 		= $this->Common->select('products',['product_id' =>$product_id]);
			$data['category_list'] 	= $this->Basic->select('category',['status' => 1]); 
			$data['productType'] 	= $this->Basic->select('product_type',['status' => 1]); 
			$data['blocklist'] 		= $this->Product_model->getblocklist();
			$this->load->view('theme/layout/header',$data);
			$this->load->view('theme/myaccount/addproduct',$data);
			$this->load->view('theme/layout/footer',$data);
		}
	}
}
