<style>
.checkout .checkout-details {
	background-color: #f9f9f9;
	border: 1px solid #dddddd;
	padding: 40px;
}
.order-box .title-box {
	padding-bottom: 20px;
	color: #444444;
	font-size: 22px;
	border-bottom: 1px solid #ededed;
	margin-bottom: 20px;
}
.order-box .title-box span {
	width: 35%;
	float: right;
	font-weight: 600;
}
.order-box .title-box h4 {
	font-weight: 600;
}
.order-box .title-box .checkbox-title {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	-webkit-box-pack: justify;
	-ms-flex-pack: justify;
	justify-content: space-between;
}
.order-box .sub-total li {
	position: relative;
	display: inline-block;
	font-size: 16px;
	font-weight: 600;
	color: #333333;
	line-height: 20px;
	margin-bottom: 20px;
	width: 100%;
}
.order-box .sub-total li .count {
	position: relative;
	font-size: 18px;
	line-height: 20px;
	color: #158df7;
	font-weight: 400;
	width: 35%;
	float: right;
}
.order-box .sub-total .shipping-class {
	margin-bottom: 12px;
}
.order-box .sub-total .shipping-class .shopping-checkout-option {
	margin-top: -4px;
	position: relative;
	font-size: 18px;
	line-height: 20px;
	color: #158df7;
	font-weight: 400;
	width: 35%;
	float: right;
}
.order-box .total {
	position: relative;
	margin-bottom: 30px;
}
.order-box .total li {
	position: relative;
	display: block;
	font-weight: 400;
	color: #333333;
	line-height: 20px;
	font-size: 18px;
}
.order-box .qty {
	position: relative;
	border-bottom: 1px solid #ededed;
	margin-bottom: 30px;
}
.order-box .qty li {
	position: relative;
	display: block;
	font-size: 15px;
	color: #444444;
	line-height: 20px;
	margin-bottom: 20px;
}
.order-box .qty li span {
	float: right;
	font-size: 18px;
	line-height: 20px;
	color: #232323;
	font-weight: 400;
	width: 35%;
}
.radio-option {
	position: relative;
}
.img-paypal {
	width: 50%;
	margin-left: 15px;
}

.wizard-4 { display:content;}
.wizard-4 ul.anchor {
    position: relative;
    display: block;
    float: left;
    list-style: none;
    margin: 0;
    padding: 0;
    border: 0 solid #e8ebf2;
    background: transparent;
    width: 30%;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    padding-right: 30px;
}

.wizard-4 ul.anchor li a.completed {
    color: #fff;
    background: #14750a;
    cursor: text;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: 600;
}
.steeperBtn {
	position: relative;
    display: block;
    list-style: none;
    margin: 0;
    padding: 0;
    border: 0 solid #e8ebf2;
    background: transparent;
	}
	
.steeperBtn.completed { color: #fff;
    background: #14750a;
    cursor: text;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: 600; }
	
.steeperBtn li a {
    display: block;
    position: relative;
    margin: 0;
    padding: 10px 20px;
    width: 100%;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    text-decoration: none;
    outline-style: none;
    z-index: 1;
    font-size: 15px; line-height:22px; margin-bottom:10px; }
	
.steeperBtn li a.completed { color: #fff;
    background: #14750a;
    cursor: text;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: 600; }
	
.steeperBtn li a.selected { color: #fff;
    background: #ed3a25;
    cursor: text;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: 600; }
	
.steeperBtn li a.deselected { color: #fff;
    background: #363d8e;
    cursor: text;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: 600; }	
	
.steeperBtn li a.disable {     
	color: #898989;
    background: #e8f4fe;
    cursor: text;
    border-radius: 5px; }	

.billing-details { position:relative;}
.disable-billingform { background: rgba(255,255,255,0.7);
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    z-index: 1;}
	
	

.disputeItem-row { display:inline-block; width:100%; padding:30px 0px;}

@media (max-width:767px){
	.personal-profile-desktop { display:none;}
}

@media (min-width:768px){
	
.personal-profile-desktop { border: #ccc solid 1px;
    padding: 5px; background:#fff;}
	
.personal-profile-desktop h2 { font-weight: 600;
    font-size: 16px;
    background: #363d8e;
    color: #fff;
    padding: 10px 15px;
    margin: 0;}
	
.personal-profile-desktop .table thead th {
    text-transform: uppercase;
    font-weight: bold;
    background: #f2f2f2; }
	
.personal-profile-desktop .pfaddress { background: #fff7d4;
    border: #f9edb5 solid 1px;
    padding: 10px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 600;
    margin: 0 0 5px 0;}	

}

@media (min-width:768px){
	.personal-profile-mobile { display:none;}
}

@media (max-width:767px){
	
.personal-profile-mobile { border: #ccc solid 1px; padding: 5px; background:#fff;}
.personal-profile-mobile h2 { font-weight: 600;
    font-size: 16px;
    background: #363d8e;
    color: #fff;
    padding: 10px 15px;
    margin: 0;}

.pp-row { padding: 10px;
    background: #f5f5f5;
    border-bottom: #fff solid 2px;}
	
.pp-row h3 {     
	font-weight: 600;
    font-size: 16px;
    background: #dd3333;
    color: #fff;
    padding: 5px 15px;
    margin: 10px 0px 0px 0px;
    border-radius: 5px; text-transform:uppercase; }
	
.pp-row .d-flex { padding: 5px;
    border-bottom: #ececec solid 1px;
    line-height: 27px;
    font-weight: 600; }
	
.pp-row .pp-content { line-height: 20px; }
.creditEnquiry .pp-content { margin:0; padding:0;}
}









.account-history-row {     
	border: #ccc solid 1px;
    padding: 5px;
    background: #fff; }
.account-history-row h2 { 
	font-weight: 600;
    font-size: 16px;
    background: #363d8e;
    color: #fff;
    padding: 10px 15px;
    margin: 0;}
	
.account-history-row h3 {
	background: #f2f2f2;
    border-bottom: 2px solid #dee2e6;
    padding: 0.75rem;
    color: #1b3155;
    font-size: 16px;
    font-weight: 600;
	margin:5px 0px 0px 0px;
}	

.ah-data { background: #1e73be;
    color: #fff;
    padding: 10px; }
.ah-data h4 { font-weight: 600;
    font-size: 16px;
    padding-bottom: 10px; }	

@media(min-width:768px){
	.disputeButton-mobile { display:none;}
	.disputeButton-desktop { background: #a01f24;
    color: #fff;
    justify-content: center;
    align-items: center;
    display: flex;
    font-size: 13px;
    text-transform: uppercase;
    font-weight: bold; }
.disputeButton-desktop input { margin-right:5px;}
}

@media(max-width:767px){
	.disputeButton-desktop { display:none;}
	.disputeButton-mobile { background: #a01f24;
    color: #fff;
    justify-content: center;
    align-items: center;
    display: flex;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: bold; }
}
	








</style>
<!-- Right sidebar Ends-->
<div class="page-body checkout">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-12">
          <div class="page-header-left">
            <!--<ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                      <li class="breadcrumb-item">Ecommerce</li>
                      <li class="breadcrumb-item active">Checkout</li>
                    </ol>--> 
          </div>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h4>CHECKOUT</h4>
      </div>
      <div class="card-body">
          <form name="checkout_form" method="POST" action="<?php echo base_url('order/payment');?>" enctype="multipart/form-data">
		  <div class="row">
            <div class="col-lg-6 col-sm-12"> 
				<div class="checkbox-title">Billing Details</div>
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label for="inputEmail4">First Name</label>
                  <input class="form-control" name="billing_info[fname]" type="text" value="<?php echo $membership->firstname?>" />
                </div>
                <div class="form-group col-sm-6">
                  <label for="inputPassword4">Last Name</label>
                  <input class="form-control"  name="billing_info[lname]" type="text" value="<?php echo $membership->lastname?>" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label for="inputEmail5">Phone</label>
                  <input class="form-control"  name="billing_info[phone]" type="phone" value="<?php echo $membership->phone?>" />
                </div>
                <div class="form-group col-sm-6">
                  <label for="inputPassword7">Email Address</label>
                  <input class="form-control"  name="billing_info[email]" type="email"  value="<?php echo $membership->email?>" />
                </div>
              </div>
              <div class="form-group">
                <label for="inputAddress5">Address</label>
                <input class="form-control"  type="text" name="billing_info[address]"  />
              </div>
              <div class="form-group">
                <label for="inputCity">Town/City</label>
                <input class="form-control"  type="text" name="billing_info[citytown]" value="<?php echo $membership->ucity?>" />
              </div>
              <div class="form-group">
                <label for="inputAddress2">State</label>
                <input class="form-control"  type="text" name="billing_info[citytown]" value="<?php echo $membership->state?>" />
              </div>
              <div class="form-group">
                <label for="inputAddress6">Postal Code</label>
                <input class="form-control" type="number" maxlength="7" name="billing_info[postalcode]" value="<?php echo $membership->lastname?>" />
              </div>
            </div>
            <div class="col-lg-6 col-sm-12" >
			  <div class="checkout-details">
                <div class="order-box">
                  <div class="title-box">
                    <div class="checkbox-title">
                      <h4>Mebership Plan </h4>
                      <span>Total</span> </div>
                  </div>
				   <ul class="qty">
                    <li><?php echo $membership->title; ?>(1) <span><?php echo $membership->price; ?></span></li>
					<input type="hidden" name="product_name" value="<?php echo $membership->title; ?>" />
					<input type="hidden" name="price" value="<?php echo $membership->price; ?>" />
					<input type="hidden" name="membership_plan_id" value="<?php echo $membership->membership_plan_id; ?>" />
                  </ul>
				  
                  <ul class="sub-total total">
                    <li>Total <span class="count"><?php echo $membership->price; ?></span></li>
                  </ul>
                  <div class="animate-chk">
                    <div class="row">
                      <div class="col">
                        <label class="d-block" for="edo-ani2">
                          <input class="radio_animated" id="edo-ani2" type="radio" name="payment_method" value="PAYPAL" />
                          PayPal<img class="img-paypal" src="assets/images/checkout/paypal.png" alt=""> </label>
                      </div>
                    </div>
                  </div>
                  <div class="text-right">
                    <button class="btn btn-primary" type="submit">Pay Membership</button>
                  </div>
                </div>
              </div>
            
			</div>
          </div>
		  </form>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends--> 
</div>
