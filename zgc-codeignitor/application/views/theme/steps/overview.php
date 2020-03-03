<?php 
	$obj = json_decode($order->billing_info);
	$name =  $address =  $citytown =  $postalcode =  $phone = $email ='';   
    if($obj){
          $name 		= $obj->fname.' '.$obj->lname;
          $address  	= $obj->address;
          $citytown  	= $obj->citytown;
          $postalcode  	= $obj->postalcode;
          $phone  		= $obj->phone;
          $email  		= $obj->email;
    }
?>
<div id="step-<?php echo $stepno ;?>">
	<h4 class="order-card-title"> ORDER OVERVIEW <hr/></h4>
		<div class="row">
			<div class="col-lg-5">
				<div class="tableData">	
				<h5> PROJECT INFORMATION </h5>
					<div class="row">
						<div class="col-lg-6 col-6 col-title">Order Number</div>
						<div class="col-lg-6 col-6"><?php echo $order->order_number; ?></div>
						<div class="w-100"></div>
						<div class="col-lg-6 col-6 col-title">Product Name</div>
						<div class="col-lg-6 col-6"><?php echo $order->product_name;?></div>
						<div class="w-100"></div>
						<div class="col-lg-6 col-6 col-title">Order Qty</div>
						<div class="col-lg-6 col-6"><?php echo $order->order_qty;?></div>
						<div class="w-100"></div>
						<div class="col-lg-6 col-6 col-title">Selling Price</div>
						<div class="col-lg-6 col-6"><?php echo $order->selling_price;?></div>
						<div class="w-100"></div>
						<div class="col-lg-6 col-6 col-title">Payment Method</div>
						<div class="col-lg-6 col-6"><?php echo $order->payment_method;?></div>
						<div class="w-100"></div>
						<div class="col-lg-6 col-6 col-title">Order Date</div>
						<div class="col-lg-6 col-6"><?php echo date('m/d/Y',strtotime($order->added_date));?></div>
						<div class="w-100"></div>
						<div class="col-lg-6 col-6 col-title">Order Amount </div>
						<div class="col-lg-6 col-6">$<?php echo $order->order_amount;?></div>
						<div class="w-100"></div>
					</div>
				</div>
			</div>
			<?php /*?>
			<div class="col-lg-7">
				<div class="tableData">	
				<h5> BILLING ADDRESS </h5>
					<div class="row">
						<div class="col-lg-2 col-4 col-title">Name </div>
						<div class="col-lg-10 col-8"><?php echo $name;?></div>
						<div class="w-100"></div>
						<div class="col-lg-2 col-4 col-title">Address </div>
						<div class="col-lg-10 col-8"><?php echo $address;?></div>
						<div class="w-100"></div>
					   <div class="col-lg-2 col-4 col-title">City </div>
						<div class="col-lg-10 col-8"><?php echo $address;?> <?php echo $citytown.' '.$postalcode; ?>
						</div>
						<div class="w-100"></div>
						<div class="col-lg-2 col-4 col-title">Phone </div>
						<div class="col-lg-10 col-8"><?php echo $phone;?></div>
						<div class="w-100"></div>
						<div class="col-lg-2 col-title col-4">Email </div>
						<div class="col-lg-10 col-8"><?php echo $email;?></div>
						<div class="w-100"></div>
					</div>
				</div>
			</div>
			<?php */ ?>
		</div>
		
  </div>
