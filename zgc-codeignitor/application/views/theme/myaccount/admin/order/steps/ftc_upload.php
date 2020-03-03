	<form name="ftcupload" enctype="multipart/form-data" method="post" action="<?php echo base_url('order/ftcupload'); ?>">
		<input name="user_id"  type="hidden" value="<?php echo $user_id;?>" />
		<input name="order_id" type="hidden" value="<?php echo $order_id;?>" />
		  <input name="type" type="hidden" value="FTC" />
		   <div class="form-group">
			<label for="title">Title</label>
			<input type="text" name="title" class="form-control" value="FTC REPORT" required />
		  </div>
		  <div class="form-group">
			<label for="title">FTC File</label>
			<input type="file" name="file_name" class="form-control" required />
		  </div>
		<button type="submit" class="btn btn-primary">Upload FTC Report</button>
	</form>
