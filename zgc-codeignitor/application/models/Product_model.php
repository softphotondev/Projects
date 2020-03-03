<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
	/*********************************
	 @User - Get user details by user_id.	
	********************************/
	function getProductList($cate='',$produt_id='')
	{
		$this->db->select('products.*,product_image.product_image,product_image.image_name,product_image.thump_path,product_image.last_date_time');
        $this->db->from('products');
        $this->db->join('product_image', 'products.product_id = product_image.product_id','left');
        $this->db->join('category', 'category.category_id = products.category_id');
		$this->db->where('products.status',1);
		$this->db->where('category.status',1);
			
		if(!empty($cate))
		{
		    $this->db->where('products.category_id',$cate);
		}

		if(!empty($produt_id))
		{
		    $this->db->where('products.product_id',$produt_id);
		}
		$this->db->order_by('products.product_id', 'ASC');
		$this->db->group_by('products.product_id'); 
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}

	function getProductfilter($filter,$category_id)
	{
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('product_image', 'products.product_id = product_image.product_id');
	    $this->db->where('products.status',1);
			
		if($filter=='lowtohigh')
		$this->db->order_by("products.selling_price", "asc");
		else if($filter=='hightolow')
		$this->db->order_by("products.selling_price", "desc");
		else
		$this->db->order_by("products.product_id", "desc");	

		if(!empty($category_id))
		{
		    $this->db->where('products.category_id',$category_id);
		}
		
		 $this->db->order_by('products.product_id', 'desc'); 
		 $this->db->group_by('products.product_id'); 
        $query = $this->db->get();
		return $query->result();
	}


	function getProductDetailsByID($produt_id)
	{
		$this->db->select('*');
        $this->db->from('products');
		$this->db->where('products.status',1);
			
		if(!empty($produt_id))
		{
		    $this->db->where('products.product_id',$produt_id);
		}
		
		 $this->db->order_by('products.product_id', 'desc'); 
		 $this->db->group_by('products.product_id'); 
        $query = $this->db->get();
		return $query->result();
	}


	function getProductImagesByID($produt_id)
	{
		$this->db->select('*');
        $this->db->from('product_image');
		$this->db->where('product_image.status',1);
			
		if(!empty($produt_id))
		{
		    $this->db->where('product_image.product_id',$produt_id);
		}
		
		 $this->db->order_by('product_image.product_id', 'asc');  
        $query = $this->db->get();
		return $query->result();
	}
	
	
	function getCategoryList($catelev='')
	{
	    $this->db->select('*');
        $this->db->from('category');
		$this->db->where('category.status',1);
        $query = $this->db->get();
		return $query->result();
	}


		function getProductcategory($cate='')
	{
		$this->db->select('*');
        $this->db->from('products');
        $this->db->join('product_image', 'products.product_id = product_image.product_id');
       // $this->db->join('product_user_price', 'products.product_id = product_user_price.product_id');
			$this->db->where('products.status',1);
			
		if(!empty($cate))
		{
		    $this->db->where_in('products.category_id',$cate);
		}
		
		 $this->db->order_by('products.product_id', 'desc'); 
		 $this->db->group_by('products.product_id'); 
        $query = $this->db->get();
		return $query->result();
	}
	
	/***** Get Block Relted chnages *************/
	
	
	function getblockRelatedDetails($parent_id=0,$block_type='category'){
		if($block_type=='category'){
			$this->db->select('category_block.*')->from('category_block');
			$this->db->join('category', 'category.category_id = category_block.category_id');
			$this->db->where('category_block.status',1);
			$this->db->where('category.status',1);
			$this->db->where('category_block.category_id',$parent_id);
		}else if($block_type=='product'){
			$this->db->select('products_block.*')->from('products_block');
			$this->db->join('products', 'products.product_id = products_block.product_id');
			$this->db->where('products.status',1);
			$this->db->where('products_block.status',1);
			$this->db->where('products_block.product_id',$parent_id);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	function getfieldtype(){
		$this->db->select('*')->from('field_type');
		$query = $this->db->get();
		return $query->result();
	}

	/*******Get Custom Field List ********/
	function getcustomFieldList($blockId=0,$block_type='category'){
		if($block_type=='category'){
			$this->db->select('category_block_custom_field.*')->from('category_block_custom_field');
			$this->db->join('category_block', 'category_block.category_block_id = category_block_custom_field.category_block_id');
			$this->db->where('category_block_custom_field.status',1);
			$this->db->where('category_block_custom_field.status',1);
			$this->db->where('category_block.category_block_id',$blockId);
		}else if($block_type=='product'){
			$this->db->select('products_block_custom_field.*')->from('products_block_custom_field');
			$this->db->join('products_block', 'products_block.product_block_id = products_block_custom_field.product_block_id');
			$this->db->where('products_block.status',1);
			$this->db->where('products_block_custom_field.status',1);
			$this->db->where('products_block.product_block_id',$blockId);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getShopItems($array_items=[])
    {
        $this->db->select('products.product_id, products.slug_url, products.qty,products.selling_price, products.product_cost, products.product_name,product_image.image_name,products.category_id,products.product_type');
        $this->db->from('products');
        if (count($array_items) > 1) {
            $i = 1;
            $where = '';
            foreach ($array_items as $id) {
                $i == 1 ? $open = '(' : $open = '';
                $i == count($array_items) ? $or = '' : $or = ' OR ';
                $where .= $open . 'products.product_id = ' . $id . $or;
                $i++;
            }
            $where .= ')';
            $this->db->where($where);
        } else {
            $this->db->where('products.product_id =', current($array_items));
        }
        $this->db->join('product_image', 'product_image.product_id = products.product_id', 'left');
        $this->db->where('products.status', 1);
		$this->db->group_by('products.product_id'); 
        $query = $this->db->get();
		
		//echo $this->db->last_query();exit;
        return $query->result_array();
    }
	function getdynamicBlockByProductId($productId){
		$dynamicBlockField=[];
		$productblocksIds =$this->getblockIdsByProductId($productId);
		if(!empty($productblocksIds->block_ids)){
			$block_ids = json_decode($productblocksIds->block_ids);
		
			$getblocksDetail = $this->getblocklist($block_ids);
			if(!empty($getblocksDetail)){
				foreach($getblocksDetail as $resBlock){
					$finalarray 	 = $resBlock;
					$block_id 		 = $resBlock->block_id;
					$getcustomfields = $this->getcustomBlockFieldList($block_id);

					if(!empty($getcustomfields) || $block_id==8){
						$finalarray->custom_fields = $getcustomfields;
						$dynamicBlockField[] = $finalarray;
					}
				}
			}
		}
		return $dynamicBlockField;
	}


function getdynamicBlockByProductIdandblock($productId,$product_block_id){
		$dynamicBlockField=[];
		$productblocksIds =$this->getblockIdsByProductId($productId);
		if(!empty($productblocksIds->block_ids)){
			$block_ids = json_decode($productblocksIds->block_ids);
		
			$getblocksDetail = $this->getblocklist($block_ids);
			if(!empty($getblocksDetail)){
				foreach($getblocksDetail as $resBlock){
					$finalarray 	 = $resBlock;
					$block_id 		 = $resBlock->block_id;

					if($resBlock->block_id==$product_block_id)
					{
					$getcustomfields = $this->getcustomBlockFieldList($block_id);
					
					if(!empty($getcustomfields)){
					$finalarray->custom_fields = $getcustomfields;
					$dynamicBlockField[] = $finalarray;
					}
					}
				}
			}
		}
		return $dynamicBlockField;
	}
	
	/**************Manage Dynamic Blocks ************/
	
	function getblocklist($blocksId=[]){
		$this->db->select('*')->from('manage_block');
		$this->db->where('status',1);
		if(!empty($blocksId) && isset($blocksId)){
			$this->db->where_in('block_id',$blocksId);
		}
		$this->db->order_by('sort','ASC');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	function getcustomBlockFieldList($blockId=0){
		$this->db->select('custom_block_field.*')->from('custom_block_field');
		$this->db->join('manage_block', 'manage_block.block_id = custom_block_field.block_id');
		$this->db->where('manage_block.status',1);
		$this->db->where('custom_block_field.status',1);
		$this->db->where('manage_block.block_id',$blockId);
		$this->db->order_by('sort','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getblockIdsByProductId($product_id)
	{
		$this->db->select('block_ids')->from('products');
		$this->db->where('product_id',$product_id);
		$query = $this->db->get();
		return $query->row();
	}
	function getblocklistByOrderId($orderId=0,$blockId=0){
		$this->db->select('*')->from('order_step');
		$this->db->where('order_id',$orderId);
		if(!empty($blockId) && isset($blockId)){
			$this->db->where('block_id',$blockId);
		}
		//$this->db->order_by('block_id','ASC');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}
	function getcustomfieldlistByOrderId($orderId=0,$blockId=0){
		$this->db->select('*')->from('order_detail');
		$this->db->where('order_id',$orderId);
		if(!empty($blockId) && isset($blockId)){
			$this->db->where_in('block_id',$blockId);
		}
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}

	function getcustomfieldlistByOrderIdDetails($orderId=0,$blockId=0){
		$this->db->select('*')->from('order_detail');
		$this->db->where('order_id',$orderId);
		if(!empty($blockId) && isset($blockId)){
			$this->db->where_in('block_id',$blockId);
		}
		$this->db->order_by('order_detail_id', 'asc'); 
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result();
	}


	function getdynamicBlockByOrderId($orderId){
		$dynamicBlockField=[];
			$getblocksDetail = $this->getblocklistByOrderId($orderId);
			if(!empty($getblocksDetail)){
				foreach($getblocksDetail as $resBlock){
					$block_id 		= $resBlock->block_id;
					$block_name 	= $resBlock->block_name;
					$order_step_id 	= $resBlock->order_step_id;
					
					$customField=[];
					$getcustomFieldDetail = $this->getcustomfieldlistByOrderId($orderId,$block_id);
					foreach($getcustomFieldDetail as $key=>$rescustom){
						$customField[$rescustom->custom_field_name] = $rescustom->custom_field_values;
					}

					$module_selected = $this->Common->get_name_byId('manage_block',['block_id' => $block_id],'module_selected');
					$dynamicBlockField[$block_id]=[
						'block_id' 		=> $block_id,
						'block_name' 	=> $block_name,
						'customfields'	=> $customField,
						'module_selected'	=> $module_selected,
						

					];
				}
			}
		return $dynamicBlockField;
	}

       ///kalidas code starts here-->


	function getproductcustomfields($product_id,$product_block_id,$orders_id)
	{
    	$data['dynamic_block'] = $this->Product_model->getdynamicBlockByProductIdandblock($product_id,$product_block_id);
		$data['pre_dynamic_block'] 	= $this->Product_model->getdynamicBlockByOrderId($orders_id);
		$data['orderId'] = $orders_id;
		$data['product_block_id'] = $product_block_id;
		$data['product_id'] = $product_id;
		echo $this->load->view('theme/myaccount/loaddynamicfieldload',$data,true);
	}
	function getcustomBlockFieldId($customblockfieldId=0){
		$this->db->select('custom_block_field.*,manage_block.block_name')->from('custom_block_field');
		$this->db->join('manage_block', 'manage_block.block_id = custom_block_field.block_id');
		$this->db->where('manage_block.status',1);
		$this->db->where('custom_block_field.status',1);
		$this->db->where('custom_block_field.custom_block_field_id',$customblockfieldId);
		$query = $this->db->get();
		return $query->result();
	}

	function getorderdetailid($valuetext,$orderId,$product_block_id,$field_name)
	{
		 $where = array('custom_field_values'=>$valuetext,'order_id'=>$orderId,'block_id'=>$product_block_id,'custom_field_name'=>$field_name);
		 $order_detail_array = $this->Basic->getsinglerow($where,'order_detail');
		 $order_detail_id = ($order_detail_array)?$order_detail_array->order_detail_id:'';

		 return $order_detail_id;
	}
	function getmembershipDetailByIdUserId($userId){
		$this->db->select('membership_plan.*,users.*')->from('users');
		$this->db->join('membership_plan', 'membership_plan.membership_plan_id = users.membership_plan_id');
		$this->db->where('users.id',$userId);
		$query = $this->db->get();
		return $query->row();
	}
	
	function getProductOptionList($productId=0)
	{
		$this->db->select('products_options.*');
        $this->db->from('products_options');
        $this->db->join('products', 'products.product_id = products_options.product_id');
		$this->db->where('products_options.sub_status',1);
		$this->db->where('products_options.product_id',$productId);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getProductOptionRow($products_options_id=0)
	{
		$this->db->select('*');
        $this->db->from('products_options');
		$this->db->where('products_options_id',$products_options_id);
		$query = $this->db->get();
		return $query->row();
	}

}
