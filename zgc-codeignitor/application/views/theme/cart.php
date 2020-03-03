<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700&display=swap" rel="stylesheet">
<style>
.cart-table {
	width: 100%;
	position: relative;
	font-family: 'Nunito Sans', sans-serif;
}
.cart-row-title {
	display: flex;
	justify-content: space-between;
	align-items: center;
	font-weight: 600;
	text-transform: uppercase;
	font-size: 14px;
	border-bottom: #f0f0f0 solid 1px;
	padding-bottom: 15px;
	margin-bottom: 25px;
}
.cart-product-details {
	display: flex;
	justify-content: space-between;
	align-items: center;
}
.prothumbnail {
	display: flex;
	justify-content: center;
	align-items: center;
}
.prothumbnail img {
	width: 60px;
}
.prothumbnail h2 {
	font-size: 15px;
	font-weight: 700;
	width: 150px;
	padding-left: 15px;
	text-align: left;
	color: #565656;
	font-family: 'Nunito Sans', sans-serif;
}
.cartproduct-total-price {
	display: flex;
	justify-content: space-between;
}
.cartproduct-quantity .qty-box {
	width: 60%;
}
.cartproduct-quantity {
	display: flex;
	justify-content: center;
}
.cartproduct-quantity .input-group {
	width: 100%;
}
.cartproduct-quantity .btn-primary {
	background: #fff !important;
	color: #000;
	padding: 5px 10px !important;
	border: #ccc solid 1px !important;
}
.cartproduct-quantity .bootstrap-touchspin input.touchspin {
	padding: 10px 5px;
	width: 50px !important;
	float: initial !important;
}
.cart-table table {
	border: 1px solid #ccc;
	border-collapse: collapse;
	margin: 0;
	padding: 0;
	width: 100%;
	table-layout: fixed;
}
.cart-table table caption {
	font-size: 1.5em;
	margin: .5em 0 .75em;
}
.cart-table table tr {
	background-color: #f8f8f8;
	border: 1px solid #ddd;
	padding: .35em;
}
.cart-table table th, .cart-table table td {
	padding: 1em;
	text-align: center;
}
.cart-table table th {
	font-size: 1.1em;
	text-transform: uppercase;
	color: #1e73be;
	background: #fff;
}
 @media screen and (max-width: 600px) {
.cart-table table {
	border: 0;
}
.cart-table table caption {
	font-size: 1.3em;
}
.cart-table table thead {
	border: none;
	clip: rect(0 0 0 0);
	height: 1px;
	margin: -1px;
	overflow: hidden;
	padding: 0;
	position: absolute;
	width: 1px;
}
.cart-table table tr {
	border-bottom: 3px solid #ddd;
	display: block;
	margin-bottom: .625em;
}
.cart-table table td {
	border-bottom: 1px solid #ddd;
	display: block;
	font-size: 1em;
	text-align: right;
}
.cart-table table td::before {
	/*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
	content: attr(data-label);
	float: left;
	font-weight: bold;
	text-transform: uppercase;
}
.cart-table table td:last-child {
	border-bottom: 0;
}
.cartproduct-quantity {
	display: flex;
	justify-content: flex-end;
}
.closetd {
	height: 54px;
	text-align: center;
	margin: 0 auto;
}
.card .card-body {
	padding: 10px;
}
button.close {
	padding: 0;
	background-color: transparent;
	border: 0;
	-webkit-appearance: none;
	background: #000;
	opacity: 1;
	color: #fff;
	width: 30px;
	height: 30px;
	border-radius: 100px;
	display: flex;
	justify-content: center;
	align-items: center;
}
}
.pro-price {
	color: #000;
	font-size: 17px;
	font-family: 'Nunito Sans', sans-serif;
	font-weight: 700;
}
.update-cart-btn {
	float: right;
	background: #1e73be;
	color: #fff;
	text-transform: uppercase;
	font-weight: 600;
	padding: 5px 15px;
	font-size: 16px;
}
.proceed-to-checkout {
	background: #dd3333;
	color: #fff;
	text-transform: uppercase;
	font-weight: 600;
	padding: 10px 15px;
	font-size: 16px;
	border: none;
	width: 100%;
}
.update-cart-btn:hover {
	background: #000;
	color: #fff;
}
.card-total {
	padding: 15px;
	border: #ccc solid 1px;
	font-weight: 700;
	text-transform: uppercase;
	font-size: 16px;
}
.card-total h2 {
	font-size: 20px;
	font-weight: 600;
	padding-bottom: 15px;
}
</style>

<div class="page-body">
  <!--<div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-12">
          <div class="page-header-left">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php //echo site_url();?>">Home</a></li>
              <li class="breadcrumb-item">Ecommerce</li>
              <li class="breadcrumb-item active">Cart</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>-->
  <!-- Container-fluid starts-->
  <div class="container-fluid">
	<?php if(isMobile()){?>
          <div class="col-lg-3"> <a class="btn mobile-backbtn" href="<?php echo site_url('order/myaccount');?>"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a></div>
          <?php } ?>
    <div class="row" style="width:100%; margin:0;">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>Cart</h5>
          </div>
          <div class="card-body cart">
		   <?php if(!empty($cartItems)){?>
            <div class="row">
              <div class="col-lg-8">
                <div class="cart-table">
                  <table>
                    <thead>
                      <tr>
                        <th width="31%" scope="col">PRODUCT</th>
                        <th width="14%" scope="col">PRICE</th>
                        <th width="33%" scope="col">QUANTITY</th>
                        <th width="14%" scope="col">TOTAL</th>
                        <th width="8%" scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
					
					<?php 
						$cartTotal=$cartItems['finalSum'];
						foreach($cartItems['array'] as $key => $Response){
								//$cartTotal+=$Response['sum_price'];
						?>
                      <tr>
                        <td><div class="prothumbnail"> <img src="<?php echo site_url()?>assets/images/45123-45899259.jpg" class="img-fluid">
                            <h2><?php echo $Response['product_name']; ?></h2>
                          </div></td>
                        <td data-label="Price" class="pro-price"> $<?php echo $Response['selling_price']; ?> </td>
                        <td data-label="Quantity"><?php echo $Response['num_added']; ?>
						
						<!-- <div class="cartproduct-quantity">
                            <fieldset class="qty-box">
                              <div class="input-group">
                               <input class="touchspin text-center" type="text" value="<?php //echo $Response['num_added']; ?>"> 
								
                              </div>
                            </fieldset>
                          </div>-->
						  
						  </td>
                        <td data-label="Total Price" class="pro-price"> $<?php echo $Response['sum_price']; ?> </td>
                        <td width="8%" class="closetd">
						
						<button type="button" class="close" aria-label="Close" onClick="removetocart('<?php echo $Response['product_id']?>');"><span aria-hidden="true">&times;</span> </button></td>
                      </tr>
					<?php } ?>
                
                      <tr style="height:60px;">
                       <!-- <td colspan="5"><a href="#" class="update-cart-btn"> Update Cart </a></td>-->
                      </tr>
                   

				   </tbody>
                  </table>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card-total">
                  <h2> CART TOTALS </h2>
				  <form name="checkout" method="post" action="<?php echo site_url('checkout/');?>">
                  <table class="table table-striped">
                    <tbody>
                      <tr>
                        <td>Subtotal</td>
                        <td>$<?php echo $cartTotal; ?></td>
                      </tr>
                     <!-- <tr>
                        <td>Shipping </td>
                        <td> 10% </td>
                      </tr>-->
                      <tr>
                        <td>Total</td>
                        <td>$<?php echo $cartTotal; ?></td>
                      </tr>
                      <tr>
                        <td colspan="2"><button type="submit" class="proceed-to-checkout"> Prceed to checkout </button></td>
                      </tr>
                    </tbody>
                  </table>
				  <form>
                </div>
              </div>
            </div>
			 <?php } else { echo 'No Item found in Cart';} ?>
          </div>
        </div>
      </div>
    </div>
  
 
  </div>
  <!-- Container-fluid Ends--> 
</div>
<script>
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
</script>
