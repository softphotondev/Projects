	<div class="pendingProducts-col">				
		<div class="row proRow">					
			<form id="confirm-order-pay" method="post" action="<?php echo base_url('order/confirmPayment');?>">
				<input type="hidden" name="order_id" value="<?php echo $order_id;?>" />
				<input type="hidden" name="comment" value="<?php echo $message;?>" />
				<input type="hidden" name="type" value="<?php echo $type;?>" />
				<div class="form-group">
					<label for="name"> Amount</label>
					<input class="form-control" name="payment_amount" type="text" value="<?php echo $price; ?>" />
				</div>
				<label for="name"> Paid </label>
				<div class="form-group">
					
					Yes <input  name="status" type="radio" value="1" checked="checked"  />
					No <input  name="status" type="radio" value="0" />
				</div>
				<?php if(!empty($payment_method_list) && isset($payment_method_list)){?>
					<!--<div class="form-group">
						<label for="name"> Payment Method </label>
						<select name="payment_method" class="form-control">
							<option value="">Select Payment Mode</option>
							<?php //foreach($payment_method_list as $getPaymode){?>
							<option value="<?php //echo $getPaymode->name;?>"><?php //echo $getPaymode->name;?></option>
							<?php //} ?>
						</select>
						
					</div>-->
					<div class="form-group">
					<label for="name"> Payment Method </label>
					</div>
					<?php foreach($payment_method_list as $getPaymode){?>
					<div class="list-group">
					  <a class="list-group-item list-group-item-action flex-column align-items-start">
						<div class="d-flex w-100 justify-content-between">
						  <h5 class="mb-1"><input type="radio" class="form-check-input" name="payment_method" value="<?php echo $getPaymode->name;?>" <?php if($getPaymode->name=='ZELLE'){ echo checked;}?>><?php echo $getPaymode->name;?></h5>
						  
						</div>
						<p class="mb-1" align="left"><?php echo $getPaymode->description;?></p>
					  </a>
					  
					</div>
					<?php } ?>
					
				<?php } ?>
				
				

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Confirm</button>
				</div>
			</form>
		</div>
	</div>
