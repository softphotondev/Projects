  <?php
    if($orders)
    {
        foreach($orders as $order)
        {
$status=(isset($orderstatus[$order->status])&&$orderstatus[$order->status])?$orderstatus[$order->status]:'';

$added_date = (isset($order->added_date)&&$order->added_date!=NULL)?date("d F Y", strtotime($order->added_date)):date("d F Y", strtotime($order->last_updated_date));

$order_amount = '$ '.$order->order_amount;
$payment_method = $order->payment_method;

$order_id =  $order->order_number;

$getimage = getimageproduct($order->product_id);


   ?>
	  <div class="custom-orderBox">
	  <div class="custom-header">
	  <div class="row">
	  <div class="col-lg-9"> 
	  <div class="orderplaced-row">
	  
	  <div class="order-col">
	  <p class="otitle"> <?php echo $status; ?> </p>
	  <p class="osubtitle"> <?php echo $added_date; ?> </p>
	  </div>
	  
	  <div class="order-col">
	  <p class="otitle"> Total </p>
	  <p class="osubtitle"> <?php echo $order_amount; ?>  </p>
	  </div>
	  
	  <div class="order-col">
	  <p class="otitle"> Payment Method	 </p>
	  <p class="osubtitle"> <?php echo $payment_method; ?> </p>
	  </div>
	  </div>

	  </div>
	  <div class="col-lg-3"> 
	<div class="order-right-col">  
	<p class="orderid"> Order Id #<?php echo $order_id; ?> </p>
	<ul class="orderlistcate">
	<li><a href="<?php echo base_url('order/orderdetails/'.$order->order_id); ?>" > Order Details </a> </li>
	<li><a target="_blank" href="<?php echo base_url('viewinvoice/'.$order->order_id); ?>"> Invoice </a> </li>
	</ul>
</div>
	  </div>
	  </div>
	  </div>
	  <div class="order-details-section">
	  <div class="row">
	  <div class="col-lg-9"> 
	  <h2 class="order-title"> <?php echo orderusersname($order->user_id); ?> </h2>
	  <div class="row productDetails">
	  <div class="col-lg-3"> <img src="<?php echo $getimage; ?>" class="img-fluid pro-photo">
	<p class="mobile-orderid"> 
	Order Id #<?php echo $order_id; ?> </p>
	  </div>
	  <div class="col-lg-9"> 
	 <h3> <?php echo $order->product_name; ?></h3>
	 <p> Order Status : <?php echo $status; ?> </p> 
	 <p class="orderprice"> <?php echo $order_amount; ?> </p>
	  </div>
	  </div>
	  </div>
	  <div class="col-lg-3 d-flex"> 
	  <div class="order-btn-group">
	  <a  href="<?php echo base_url('order/orderdetails/'.$order->order_id); ?>" class="btn btn-orderDetails mobile-orderDetails"> View Details </a>
	  
	  <a href="<?php echo base_url('order/orderdetails/'.$order->order_id); ?>" class="btn btn-orderDetails mobileOrderdetails"> Go To Order Overview </a>
	    
	  <a href="<?php echo base_url('projects/deleteorder/'.$order->order_id); ?>" class="btn btn-orderDelete" onClick="return doconfirm();"  > Cancel </a>
	  
	  <a target="_blank" href="<?php echo base_url('viewinvoice/'.$order->order_id); ?>" class="mobileinvoice btn btn-orderDelete"> Pay Invoice </a>
	  
	  </div>
	  </div>
	  </div>
	  </div>
	  </div>
         <?php    
        }
    }
    ?>