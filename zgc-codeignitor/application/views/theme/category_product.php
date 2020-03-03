<style>
.product-wrapper { padding:50px 0px;}
.productsColumn { position:relative; background-color:#fff; 
padding:15px; text-align:center; margin:15px 0px; border:#eeeeee solid 1px;}
.pc-left { position:absolute; top: 15px; left: 15px;}
.pc-left p { margin:0; padding:0; text-align:left; text-transform:uppercase; }
.proName { font-weight:600; font-size:1.1rem;}
.proImg { padding:0px; display: block;}
.productsColumn:hover .proName { color:#294ca0;}
.productsColumn:hover .heartIcon { background:#294ca0;}
.heartIcon:hover .fa-heart-o { color:#fff !important; text-decoration:none !important;}
.productsColumn:hover .heartIcon .fa-heart-o { -moz-transform: rotate(360deg);
	-webkit-transform: rotate(360deg);
	-ms--transform: rotate(360deg);
	transform: rotate(360deg);
	-webkit-transition: all 0.2s;
	-moz-transition: all 0.2s;
	-o-transition: all 0.2s;
	-ms-transition: all 0.2s;
	transition: all 0.2s; }
	
.productsColumn .heartIcon .fa-heart-o { -webkit-transition: all 0.8s;
	-moz-transition: all 0.8s;
	-o-transition: all 0.8s;
	-ms-transition: all 0.8s;
	transition: all 0.8s; }
	
.featured-products-col { position:relative; background:#fff; -webkit-box-shadow: 0px 0px 26px 0px rgba(0,0,0,0.1);
-moz-box-shadow: 0px 0px 26px 0px rgba(0,0,0,0.1);
box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); 
text-align:center; border:#fff solid 2px; margin:15px 0px;}
.swiper3 .swiper-slide { padding:15px 10px;}
.fpImg { background: #f6f6f6;
    padding: 25px 15px;
    display: block;}
.fp-content { padding:25px 15px;}
.fpName { color:#023754; font-size:1.1rem; font-weight:600;}
.fpPrice { color:#2756a8; font-size:1.2rem; font-weight:600;}
.addTocart-btn { background:#b21466; border-radius:50px; padding:5px 25px; color:#fff; font-weight:600;}
.addTocart-btn:hover { background:#2c419a; color:#fff; text-decoration:none;}
.featured-products-col:hover .addTocart-btn { background:#2c419a; color:#fff; text-decoration:none;}


.left-sidebar {
	/* background: #fff;
	padding: 15px 15px 75px 15px; */
}



/** Sidebar Search **/

.sidebar-search {
	padding: 5px 10px 5px 10px;
    background: #fff;
    margin-bottom: 20px;
    display: inline-block !important;
    width: 100% !important;
    border: #ededed solid 1px;
}
.select-box {
	cursor: pointer;
	position : relative;
	width: 100%;
}
.select, .label {
	color: #414141;
	display: block;
	font: 400 14px/2.1em 'Open Sans', sans-serif;
}
.select {
	width: 100%;
	position: absolute;
	top: 0;
	padding: 0px 0;
	height: 30px;
	opacity: 0;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
	background: none transparent;
	border: 0 none;
}
.select-box1, .select-box2, .select-box3 {
	background: #ececec;
}
.label {
	position: relative;
	padding: 0px 10px;
	cursor: pointer;
}
.open .label::after {
	content: "\f106";
}
.label::after {
	content: "\f107";
	font-family: 'FontAwesome';
	font-size: 14px;
	position: absolute;
	right: 0;
	top: 0;
	padding: 0px 10px;
	color: #fff;
	border-left: 0px solid #fff;
	background: #221919;
}
.sidebar-search .form-group {
	margin: 0;
	padding: 0;
	font-size: 0.9rem;
	padding-top: 5px;
	text-align: left;
	color: #b00040; padding-left:20px;
}
 @media ( max-width: 991px ) {
.sidebar-search {
	margin-bottom: 55px;
}
.sidebar-search .form-group {
	padding-left: 15px;
	padding-bottom: 10px;
	text-align: left;
}
}
.alert-info {
	color: #fff;
	background-color: #d40e0e;
	border-color: #d40e0e;
	border-radius: 0px;
	text-align: center;
	margin: 0;
}
.alert-info h5 {
	margin: 0;
	font-size: 1rem;
}


.product-info { text-align:left; position:relative;}
.product-cats a { color:#000; text-transform:uppercase; font-size:11px;}
.product-title a { color:#000; font-size:15px; font-weight:600;}
.product-price .price { color:#000; font-weight:600;}
.product-info .product-title { margin:0;}

.productsColumn:hover {
    box-shadow: 0 0 10px rgba(0, 0, 0, .15);
    z-index: 91;
}


.productsColumn {
    transition: box-shadow .3s ease-in-out;
    padding: 15px;
    position: relative;
}

.productsColumn:hover .product-buttons {

}

.productsColumn .product-buttons {
    left: 0;
    right: 0;
    position: absolute;
    top: 0;
    -ms-flex-pack: justify;
    justify-content: center;
    opacity: 1;
    -webkit-transition: all 300ms ease;
    -moz-transition: all 300ms ease;
    transition: all 300ms ease;
    -moz-transform: translateY(15px);
    -webkit-transform: translateY(15px);
    transform: translateY(15px);
    visibility: hidden;
    z-index: 9;

}

.productsColumn .product-buttons .cart-button a { color: #fff;
    text-decoration: none;
    padding: 5px 8px;
    display: block;
    text-transform: uppercase;
    font-size: 13px;
    font-weight: 600; margin:0 10px; }

.productsColumn .product-buttons {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-direction: row;
    flex-direction: row;
}

.category-title { border-bottom:
#e9e9e9 solid 1px;
color:
#000;
text-transform: uppercase;
font-size: 16px;
font-weight: 600;
padding-bottom: ;
background:
#1e73be;
color:
#fff;
text-align: center;
padding: 10px;
border-radius: 5px;}

.categoryList ul { margin:0; padding:0;}
.categoryList ul li { background:#fff; margin-bottom:10px;} 
.categoryList ul li a { color:#333333; display:block; padding:0px; position:relative; }
.categoryList ul li a img { width:30px;}
.categoryList ul li a .cateImg {
	background: #dd3333;
	color:#fff;
	padding: 6px 5px;
	position: absolute;
	top: 0;
	left: 0;
}

.categoryList ul li a:hover { color:#000;}
.categoryList ul li a .lcount { color:#000; font-size:12px; font-weight:600;}

.catebanner { margin-bottom:20px;}
.btn-reset { padding: 3px 10px;
    border-radius: 0px;
    background: #000;
    color: #fff;}

.pro-image { min-height: 174px;
    display: flex;
    align-items: center;
    justify-content: center; }
	
	


.cart-sidebar {
	position: fixed;
    right: -100%;
    top: 0;
    width: 300px;
    background: #fff;
    padding: 0;
    z-index: 9999;
    height: 100vh;
}

.cart-sidebar.active {
	right:0;
}

.kapee-mask-overaly {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 998;
    opacity: 0;
    visibility: hidden;
    background-color: rgba(0,0,0,.6);
    -webkit-transition: opacity .50s ease,visibility 0s ease .50s;
    transition: opacity .50s ease,visibility 0s ease .50s;
}
.kapee-mask-overaly.opened {
    opacity: 1;
    visibility: visible;
    -webkit-transition: opacity .25s ease,visibility 0s ease;
    transition: opacity .25s ease,visibility 0s ease;
}
.cart-sidebar-header { width: 100%;
    background: #cc1c1c;
    color: #fff;
    display: flex;
    justify-content: space-between;
    padding: 5px;
    align-items: center; margin-bottom:15px; }

.cartheadertitle { float:left; font-size:16px; font-weight:600; text-transform:uppercase; margin:0;}

.closeButton { 
    padding: 5px;
    color: #fff;
    cursor: pointer;
    margin: 0;
    width: 30px;
    height: 30px;
    border-radius: 100px;
    text-align: center;
    font-size: 15px;
    align-items: center;
    justify-content: center;
    display: flex;}
	
.cart_list { margin:0; padding:10px;}
.cart_list li.cart_item { list-style: none;
    margin-bottom: 15px;
    position: relative;
    border-bottom: #ccc solid 1px;
    display: inline-block;
    width: 100%;
    padding-bottom: 10px;}
.cart_list li .remove { position:absolute; right:0; color:#000;}
.cart_list li .cart_item_img { float:left; margin-right:10px;}
.cart_item_content { font-size:15px; color:#000; font-weight:600;}
.quantity { margin:0; padding:0; font-size:13px;}
.remove .fa-times { color: #525252; font-size: 12px;}
.shopping_cart_footer { padding-bottom:15px; flex:0 0 auto; -webkit-flex:0;}

.shopping_cart_scroll { -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden; }
	
.shopping_cart_footer { position: absolute;
    bottom: 0;
    width: 100%;
    border-top: #ccc solid 1px;
    background: #fff;
    padding: 15px; }
	
.shopping_cart_total {     width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between; }

.cart_button { margin-top:15px;}
.btn-viewcart { background: #1e73be;
    color: #fff;
    font-size: 16px;
    padding: 5px 15px;
    width: 100%;
    margin-bottom: 10px;
    display: inline-block;
    text-align: center;
    text-transform: uppercase;
    font-weight: 600; margin-top:0;}
	
.btn-checkout { background: #ae1414;
    color: #fff;
    font-size: 16px;
    padding: 5px 15px;
    width: 100%;
    margin-bottom: 10px;
    display: inline-block;
    text-align: center;
    text-transform: uppercase;
    font-weight: 600; margin-top:0; }
.btn-checkout:hover, .btn-viewcart:hover { background:#000; color:#fff; text-decoration:none;}	
	
.cart_button { margin:0; padding:0;}
.slideCategory { margin:0; padding:0;}
.slideCategory li { list-style:none; display:block; line-height:35px;}
.category-dropdown .category-tab { display:none;}
.category-dropdown .category-tab.active-category { display:block;}
.arrowtab { float:right;}

.buynow-btn { background:#cc1c1c; color:#fff; margin:5px;}
.cart-btn { background:#000; color:#fff; margin:0px;}
.footerProduct { display:flex; width:100%; margin-top:15px; justify-content:space-between; align-items:center;}

.viewButton { background: none;
    text-transform: uppercase;
    font-size: 12px;
    padding: 5px 10px;
    font-weight: 800; color:#000; }
	
.viewButton:hover { color:#1e73be;}


.nav-tabs .nav-link { text-align: center;
    font-weight: 700;
    background: #fff;
    color: #000;
    font-size: 14px;
    text-transform: uppercase; }
	
.nav-tabs .nav-link.active { color: #fff !important; background-color: #1e73be !important; }

.nav-tabs .nav-link.active, .nav-tabs .nav-link.selected {
    color: #fff !important;
    background-color: #dd3333 !important;
}

.nav-tabs .nav-link, .nav-tabs .nav-link.deselected {
    text-align: center;
    font-weight: 700;
    background: #1e73be;
    color: #fff;
    font-size: 14px;
    text-transform: uppercase;
    border: #fff solid 2px;
}

.nav-tabs .nav-link.deselected { padding:.5rem 1rem;}
.nav-tabs .selected { display:block; text-align: center;
    font-weight: 700;
    background: #dd3333;
    color: #fff;
    font-size: 14px;
    text-transform: uppercase;
    border: #fff solid 2px; padding:.5rem 1rem;}
	
.tab-content { padding:20px; background:#fff; margin-bottom:25px;}
.productsColumn .product-buttons {
    left: 0;
    right: 0;
    position: relative;
    top: 0;
    -ms-flex-pack: justify;
    justify-content: center;
    opacity: 1;
    -webkit-transition: all 300ms ease;
    -moz-transition: all 300ms ease;
    transition: all 300ms ease;
    -moz-transform: translateY(15px);
    -webkit-transform: translateY(15px);
    transform: translateY(15px);
    visibility: visible;
    z-index: 9;
}

.btn-group, .btn-group-vertical {
    position: relative;
    display: -ms-inline-flexbox;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding-bottom: 15px;
}

.productsColumn .product-buttons .cart-button a {
    padding: 5px 8px;
    display: block;
    text-transform: uppercase;
    font-size: 15px;
    font-weight: 700;
    margin: 0;
}
.page-body { padding:0px 15px 0px 15px;}
.mobile-backbtn {
	background: #dd3333;
    padding: 5px 10px;
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    display: inline-block;
    float: right;
    position: relative;
    margin-top: 0;
    margin-bottom: 10px;
    text-transform: uppercase;
	}
	.mobile-backbtn:hover { background:#000; color:#fff; }
	.mobile-backbtn:hover .fa { color:#fff; }
	
/****Grid view ***/

.aps-col {
    background: #fff;
    border-radius: 5px;
    padding: 5px;
    position: relative;
    z-index: 0;
    margin-bottom: 40px;
    -webkit-box-shadow: 0 10px 6px -6px #989898;
    -moz-box-shadow: 0 10px 6px -6px #989898;
    box-shadow: 0 10px 6px -6px #989898;
}
.aps-colImg {
    background: #f3f4f4;
    padding: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 264px;
}
.aps-content {
    padding: 15px 25px;
}
.aps-content p {
    line-height: 23px;
}
#more_10 {
    display: none;
}

@media (min-width: 1200px)
.col-lg-2 {
    width: 16.66667%;
}
.contentFooter {
    margin-top: 25px;
    width: 100%;
    text-align: right;
}
.priceButton {
    float: left;
    color: #9d1d24;
    font-size: 14px;
    font-weight: 800;
}
.learnMore-btn {
    text-transform: uppercase;
    font-size: 14px;
    color: #fff;
    padding: 5px 20px;
    border-radius: 50px;
    font-weight: bold;
    background: #4c567d;
    background: -moz-linear-gradient(top, #4c567d 0%, #171d34 100%);
    background: -webkit-linear-gradient(top, #4c567d 0%,#171d34 100%);
    background: linear-gradient(to bottom, #4c567d 0%,#171d34 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4c567d', endColorstr='#171d34',GradientType=0 );
}
.porderNow {
    text-transform: uppercase;
    font-size: 14px;
    color: #fff !important;
    padding: 5px 20px;
    border-radius: 50px;
    font-weight: bold;
    background: #f15a2a;
    background: -moz-linear-gradient(top, #f15a2a 0%, #a32224 100%);
    background: -webkit-linear-gradient(top, #f15a2a 0%,#a32224 100%);
    background: linear-gradient(to bottom, #f15a2a 0%,#a32224 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f15a2a', endColorstr='#a32224',GradientType=0 );
}
.aps-guranteeBox {
    background: #f5a311;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    height: 100%;
    min-height: 273px;
    text-align: right;
    padding-left: 25px;
    margin-left: -5px;
    position: relative;
}
img {
    vertical-align: middle;
    max-width: 100%;
    height: auto;
}
a.btn.mobile-backbtn {
    background: #d33;
}
@media (max-width: 991px){
.col-lg-2.aps-guranteeBox {
    display: none;
}
img.img-fluid.aps-colImg-innr {
    display: inline-block !important;
    position: absolute;
    top: 5px;
    right: 5px;
    width: 80px;
}
}
</style>
<div class="page-body-wrapper">
<div class="page-body" style="padding:2px;">
<div class="container-fluid">
<div id="loader" class="loader-box" style="height:15px;display:none;">
<div class="loader-7"></div>
</div>
<div class="kapee-mask-overaly" id="shoppingcart-sidebar-close" onclick="closeSideBar();"></div>
<div class="cart-sidebar" id="shoppingcart-sidebar">
    <div class="cart-sidebar-header">
        <h3 class="cartheadertitle"> My Shopping cart </h3>
        <p class="closeButton" onclick="closeSideBar();"> <i class="fa fa-times" aria-hidden="true"></i> </p>
    </div>
 <?php 
	$cartTotal=0;
	if(!empty($cartItems)){?>
    <div class="shopping_cart_scroll">
        <ul class="cart_list">
			<?php 
				$cartTotal=$cartItems['finalSum'];
				foreach($cartItems['array'] as $key => $Response){
				?>
            <li class="cart_item">
                <a href="javascript:void();" class="remove"  onClick="removetocart('<?php echo $Response['product_id']?>');"> <i class="fa fa-times" aria-hidden="true"></i> </a>
                <a href="#" class="cart_item_img">
                    <img width="50" height="50" src="<?php echo site_url();?>assets/images/45123-45899259.jpg" class="cartThumbnail" alt=""> </a>
                <a href="javascript:void();" class="cart_item_content"><?php echo $Response['product_name']; ?></a>
                <p class="quantity"> <?php echo $Response['num_added']; ?> X
                    <strong> $<?php echo $Response['selling_price']; ?> </strong>
                </p>
            </li>
          <?php } ?>
        </ul>
    </div>
	<?php } ?>
    <div class="shopping_cart_footer">
        <p class="shopping_cart_total"> <strong> Subtotal: </strong> <span class="priceAmount"> $ <?php echo $cartTotal; ?> </span> </p>
        <p class="cart_button">
            <a href="<?php echo site_url('cart/');?>" class="btn-viewcart"> View Cart </a>
            <a href="<?php echo site_url('checkout/');?>" class="btn-checkout"> Checkout </a>
        </p>
    </div>

</div>

<!-- Container-fluid starts-->
<div class="container product-wrapper">

<div class="row">
<?php if(!isMobile()){?>
<div id="mySidenav" class="col-lg-3 col-md-4 left-sidebar-mobile">
<div class="left-sidebar">
<div class="categoryList">
<h2 class="category-title">SERVICES CATEGORY </h2>

<ul class="profile-usermenu">
<?php foreach($category_list as $cate) {
		
		$productCount = $productcount[$cate->category_id];
		
		if($productCount>0){
		?>
		<a href="<?php echo base_url('services/'.$cate->slug_url); ?>" class="thumb-col colbefore <?php if($page==$cate->slug_url){ echo 'active';}?>">
			<!--<div class="thumbImg"> <img src="<?php //echo site_url();?>assets/images/order-icon.png"></div>-->
			<p> <?php echo $cate->category_name; ?> <span class="lcount"> (<?php echo $productCount; ?>)</span> </p>
		</a>

<?php } } ?>
</ul>


</div>

</div>
</div>

<?php
$category_image = (isset($category) && $category->image)?$category->image:site_url().'assets/images/category_banner.png';
}
?>
	<div class="col-lg-9 col-md-12">
		<div class="row right-side">
			<?php /*if(!isMobile()){?>
			<div class="catebanner"> <img src="<?php echo $category_image; ?>" class="img-fluid"> </div>
			<?php }*/ ?>
		<?php if(isMobile()){?>
			<div class="col-lg-12 pull-right">
				<a class="btn mobile-backbtn" href="<?php echo site_url('services/');?>"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
			</div>	
		<?php } ?>
			<div class="col-lg-12">  
				<div id="loadresultnew" class="row">
				 <?php 
				   if($products){
					foreach($products as $key => $value) {
						$productId = $value->product_id;
						$price 		= getroleprice($productId);
						$yourCost 	= $value->selling_price;
						$clientCost = getclientProductPrice($productId);
						if(empty($clientCost)){
							$clientCost =$price;
						}
						$message = strip_tags($value->description);
						$strlen = strlen($message);
						$small = substr($message,0,250);
						$large = substr($message, 250);
						$textcost = "";
						if($this->session->userdata('user_type')==4){
							$textcost = "CLIENT'S COST:";
						}
						$productOptions = count(getProductOptions($productId));
						?>
						<div class="col-lg-12"> 
							<div class="aps-col row">
								<div class="col-lg-3 aps-colImg col-0"> 
									<img src="<?php echo $value->image_name; ?>" class="img-fluid" alt="<?php echo $value->product_name; ?>" title="<?php echo $value->product_name; ?>" />
									<img src="<?php echo base_url()?>assets/images/authorizedIcon.png" class="img-fluid aps-colImg-innr" style="display: none;">
								</div>
								<div class="col-lg-7 col-0">
									<div class="aps-content"> 
										<h2> <?php echo $value->product_name; ?> </h2>
											<p><?php echo $small; ?>
												<?php if($strlen>250){ ?>
													<span id="dots_<?php echo  $value->product_id; ?>">...</span>
												<?php } ?>
													<span id="more_<?php echo  $value->product_id; ?>"><?php echo $large; ?>.</span>
												<?php if($strlen>250){ ?>
													<a  onclick="myFunctionhere('<?php echo  $value->product_id; ?>')" id="myBtn_<?php echo  $value->product_id; ?>" class="viewmore-btn"> View More </a>
												<?php } ?>
											</p>
										<div class="contentFooter"> 
											<a href="javascript:void(0);" class="priceButton"><?php echo $textcost;?>
											<?php if($productOptions>1){
												echo $productOptions.' Options Available';
											}else{ echo '$'.$price; }?>
											</a>
											<?php if($this->session->userdata('user_type')==5){?>
											<a href="<?php echo base_url('productdetail/'.$value->product_id); ?>" class="learnMore-btn"> LEARN MORE </a> 
											<a class="porderNow" href="<?php echo base_url('productdetail/'.$value->product_id); ?>"> Order now </a>
											<?php }else { ?>
											<a href="javascript:void();" onClick="alertmsg()" class="learnMore-btn"> LEARN MORE </a> 
											<a class="porderNow" onClick="alertmsg()" href="javascript:void();"> Order now </a>
											<?php } ?>
										</div>
										<?php if($this->session->userdata('user_type')==4){?>
												<div class="contentFooter"> 
													<span class="priceButton">YOUR COST: $<?php echo $yourCost; ?></span>
												</div>
											<?php } ?>
									</div>
									
								</div>
								<div class="col-lg-2 aps-guranteeBox"> 
									<img src="<?php echo base_url()?>assets/images/authorizedIcon.png" class="img-fluid">
								</div>
								
							</div> 
						</div>
						 <style>#more_<?php echo $value->product_id; ?> {display: none;}</style>
					 <?php
					  }
					}
				?>
				</div>
			</div>
		</div>
	</div>   
	</div>
</div>
</div>
</div>
</div>
	
  
<script src="<?php echo  base_url(); ?>assets/js/touchspin/vendors.min.js"></script>
<script src="<?php echo  base_url(); ?>assets/js/product-tab.js"></script>
<!-- Theme js-->
<script type="text/javascript">
 function changefilter(filter,category_id)
 { 
    if(filter=='newest')
    $('#sort').html('Newest');  
    else if(filter=='hightolow')
    $('#sort').html('Price High to Low'); 
    else if(filter=='lowtohigh')
    $('#sort').html('Price Low to High'); 

  $.post("<?php echo site_url('cart/loadsearch')?>",{filter: filter,category_id:category_id},function(html) 
    {
    $('#loadresultnew').html(html);
    }); 
 } 
 function addtocart(productId){

	$('#shoppingcart-sidebar-close').addClass('opened');
	$('#shoppingcart-sidebar').addClass('active');

	 $('#loader').show();

	$.ajax({
		url: '<?php echo site_url('cart/addtocart')?>',
		type: 'POST',
		data: { action: "add", product_id: productId },
		cache: false,
		success: function(response) {
		console.log(response);
		 $('#loader').hide();
		 $('#shoppingcart-sidebar-close').addClass('opened');
		 $('#shoppingcart-sidebar').addClass('active');
		location.reload();
		}
	});
 }
 function buynow(productId){
	 $('#loader').show();
	$.ajax({
		url: '<?php echo site_url('cart/addtocart')?>',
		type: 'POST',
		data: { action: "add", product_id: productId },
		cache: false,
		success: function(response) {
			 $('#loader').hide();
		console.log(response);
		 //$('#shoppingcart-sidebar-close').addClass('opened');
		// $('#shoppingcart-sidebar').addClass('active');
		location.href = "<?php echo site_url('checkout/')?>";
		//location.reload();
		}
	});
 }
  function removetocart(productId){
	$.ajax({
		url: '<?php echo site_url('cart/addtocart')?>',
		type: 'POST',
		data: { action: "remove", product_id: productId },
		cache: false,
		success: function(response) {
			location.reload();
			console.log(response);
		}
		
	});
 }
 
 function alertmsg(){
	var aletmsg = alert('You need to login with client account and then place order!.');
 }
</script>
 <!-- Plugins JS start-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
var availableTags = [
  <?php foreach($products as $key=>$values) { 
    echo "{ value:".$values->product_id." , label:'".$values->product_name."' },";
 } ?>
];
$('#product_id').each(function(i, el) {
    var that = $(el);
    that.autocomplete({
        source: availableTags,
        select: function( event , ui ) {
            $('#product_id_value').val(ui.item.value);
            $.post("<?php echo site_url('cart/loadsearch')?>",{product_id: ui.item.value},function(html) 
            {
            $('#loadresult').html(html);
            }); 
            setTimeout(function(){  $("#product_id").val(ui.item.label); }, 1);
        }
    });
});
function closeSideBar()
{
$('#shoppingcart-sidebar-close').removeClass('opened');
$('#shoppingcart-sidebar').removeClass('active');
}
</script> 
