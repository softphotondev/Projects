<form name="ftcupload" enctype="multipart/form-data" method="post" action="<?php echo base_url('order/ftcupload'); ?>">
	<input name="user_id"  type="hidden" value="<?php echo $user_id;?>" />
	<input name="order_id" type="hidden" value="<?php echo $order_id;?>" />
	  <input name="type" type="hidden" value="SIGNATURE" />
	   <div class="form-group">
		<label for="title">Title</label>
		<input type="text" name="title" class="form-control" value="SIGNATURE" required />
	  </div>
	  <div class="form-group">
		<label for="title">Upload Signature</label>
		<input type="file" name="file_name" class="form-control" required />
	  </div>
	<button type="submit" class="btn btn-primary">Upload Signature</button>
</form>
