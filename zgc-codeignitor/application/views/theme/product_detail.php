<style>
.product-wrapper {
	padding: 50px 0px;
}
.productDetails-content { padding:15px 0px;}
.product-page-details h2 { color: #1e73be; font-weight: 600;}
.product-price del { color: #dd3333; padding-right: 20px;}
.product-page-width {
    width: 100%;
    line-height: 28px;
    font-weight: 600;
}
.productDetails { padding:0px 15px;}
button.btn-buy {
    background: transparent;
    padding: 0;
}
button.btn-buy img {
    width: 180px;
	border: 0;
}
.card .card-body h2 {
    font-weight: 600;
    font-size: 30px;
    text-align: center;    
	text-transform: uppercase;
}
.card {
    border-radius: 5px;
    box-shadow: 0 10px 6px -6px #989898;
}
</style>

<?php
	$product_id = $products[0]->product_id;
	$product_type = $products[0]->product_type;
	if(isset($_SESSION['products_options_id']) && $product_type==4){
	$getProductOption = getProductOptionRecord($_SESSION['products_options_id']);
		$products_options_id = $getProductOption->products_options_id;
		$product_id 		 = $getProductOption->product_id;
		$productName 	 	 = $getProductOption->sub_product_name;
		$sellingPrice   	 = $getProductOption->sub_selling_price;
	}else{
		$sellingPrice = $price;
		$productName  = $products[0]->product_name;
		$products_options_id='';
	}?>
<div class="product-wrapper grayBg">
<div class="container">

  <div class="productDetails">
    <div class="card">
      <div class="row product-page-main">
        <div class="col-xl-6">
		<img src="<?php echo site_url();?>uploads/product/1570558483_568_SCOREUP.png" class="img-fluid">
          <div class="owl-carousel owl-theme" id="sync1">		
				<img src="<?php echo $productsimages[0]->thump_path; ?>" class="img-fluid">
          </div>
          <div class="owl-carousel owl-theme" id="sync2">
            <?php  if($productsimages) { 
					foreach ($productsimages as $key => $value) {
              ?>
            <div class="item"><img src="<?php  echo $value->thump_path ?>" alt=""></div>
          <?php } } ?>
          </div>
        </div>
		<div class="col-xl-6">
		<form name="product_detailpage" method="POST" action="<?php echo base_url('cart/addtocart');?>">
			<input type="hidden" name="action" value="add" />
			<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
			<input type="hidden" name="product_name" value="<?php echo $productName; ?>" />
			<input type="hidden" name="totalsteps" value="<?php echo $total_steps; ?>" />
			<input type="hidden" name="price" id="price" value="<?php echo $sellingPrice; ?>" />
			<span id="add-product-option-field"></span>
			<div class="product-page-details">
            <h2 class="productTitle" id="newProduct_name"><?php echo $productName; ?></h2>
			   <div class="row"> 
					<div class="col-lg-2 col-4"> 
						<select id="u-rating-fontawesome" name="qty" autocomplete="off" class="custom-select">
							<option value="1" selected>1</option>
						</select>
					</div>
					<div class="col-lg-6 col-8"> 
						<span class="product-price digits" id="update-product-price-option"> $<?php echo $sellingPrice; ?></span>
					</div>
			   </div>
			   <?php 
			   if(!empty($product_options)){
						$onchangemethod='';
						if($products[0]->product_type==4){
						   $onchangemethod = 'onchange="getupdatedPrice(this.value);"';
						}
				   ?>
				<select class="form-control" name="products_options_id" required <?php echo $onchangemethod;?>>
					<option value="">Select Options</option>
					<?php foreach($product_options as $getProductOptions){?>
					<option value="<?php echo $getProductOptions->products_options_id;?>" <?php if($products_options_id==$getProductOptions->products_options_id){ echo 'selected';}?>><?php echo $getProductOptions->sub_product_name;?></option>
				<?php } ?>
				</select>
			<?php } ?>
			 <div class="clearfix"></div> 
			 <button class="btn-buy" type="submit" title="Buy Now"><img src="<?php echo site_url();?>assets/images/buynow1.png" class="img-fluid"></button>
			</div>
		</form>
          </div>
        </div>
			<div class="card-body">
			 <h2>Product Information</h2>
			  <ul class="nav nav-tabs productTabs" id="myTab" role="tablist">
				<li class="nav-item"><a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" data-original-title="" title="">Description</a></li>
				<li class="nav-item"><a class="nav-link" id="profile-tabs" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" data-original-title="" title="">Refund Policy</a></li>
				
			  </ul>
			  <div class="tab-content" id="myTabContent">
				<div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
				  <p class="mb-0 m-t-30"><?php echo $products[0]->description; ?></p>
				</div>
				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				  <p class="mb-0 m-t-30"><?php echo $products[0]->refund_policy; ?></p>
				</div>
				
			  </div>
			</div>
		  </div>
      </div>
 </div>
</div>

<script>
   function buynow(productId){
		$('#loader').show();
		//var productOptionValue = $('#product-options-field').val();
		//alert(productOptionValue);
		  $.ajax({
			url: '<?php echo site_url('cart/addtocart')?>',
			type: 'POST',
			data: { action: "add", product_id: productId,product_option_id:productOptionValue },
			cache: false,
			success: function(response) {
			   $('#loader').hide();
				console.log(response);
			 //$('#shoppingcart-sidebar-close').addClass('opened');
			// $('#shoppingcart-sidebar').addClass('active');
			//location.href = "<?php echo site_url('checkout/')?>";
			//location.reload();
			}
		});
	}
	function getupdatedPrice(product_option_id){
		$('#update-product-price-option').html('<img src="<?php echo base_url();?>assets/loader.jpg" />');
		 $.ajax({
			url: '<?php echo site_url('ajax/getproductOptionPrice')?>',
			type: 'GET',
			data: 'productOptionId='+product_option_id,
			cache: false,
			success: function(response) {
				 $('#loader').hide();
				console.log(response);
				var obj = jQuery.parseJSON(response);
				console.log(obj);
				var productname = obj.product_name;
				console.log(productname);
				var sellingprice=obj.selling_price;
				console.log(sellingprice);
					$('#price').val(sellingprice);
					$('#update-product-price-option').html('$'+sellingprice);
					$('#newProduct_name').html(productname);
			}
		});
	}
 </script>
