<div class="col-md-10">
<div class="form-group">
<label>Client Name : <?php echo $user_details->first_name.' '.$user_details->last_name; ?> </label>
</div>
</div>

<div class="col-md-10">
<div class="form-group">
<label>Invoice No  : #<?php echo $orders->order_number; ?> </label>
</div>
</div>


<div class="col-md-10">
<div class="form-group">
<label>Product Name : <?php echo $orders->product_name; ?> </label>
</div>
</div>


<div class="col-md-10">
<div class="form-group">
<label>Client Price : $<?php echo $orders->order_amount; ?> </label>
</div>
</div>
<?php
  $order_price = getorderprice($orders->order_id);
?>

<div class="col-md-10">
<div class="form-group">
<label>Broker Price (Need to pay Admin): $<?php echo $order_price; ?> </label>
</div>
</div>

<!--
<div class="col-md-10">
<div class="form-group">
<label>Broker Price (Need to pay admin): $<?php echo $brokerrcost; ?> </label>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Select Payment Method </label>
<select name="payment_type_broker" id="payment_type_broker" required="" class="form-control">
<option value="">--Select--</option>
<?php foreach($payment_methods as $payment) { ?>
<option value="<?php echo $payment->name; ?>"><?php echo $payment->name; ?></option>
<?php } ?>

</select>
</div>
</div>

-->