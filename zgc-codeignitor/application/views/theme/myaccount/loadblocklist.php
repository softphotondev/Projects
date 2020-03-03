<?php
		     $block_id 			= $getBlock[0]->block_id;
			 $block_name 		= $getBlock[0]->block_name;
			 $module_selected 	= $getBlock[0]->module_selected;
			 $sort_id 			= $getBlock[0]->sort;
			 $icon 			= $getBlock[0]->icon;
			 
			 $moduleselect='';
			 if($module_selected=='identityiq'){
				 $moduleselect.='<option value="identityiq" selected="selected">IDENTITYIQ</option>';
			 }else {
				  $moduleselect.='<option value="identityiq">IDENTITYIQ</option>';
			 }
			 if($module_selected=='contract'){
				 $moduleselect.='<option value="contract" selected>CONTRACT</option>';
			 }else{
				  $moduleselect.='<option value="contract">CONTRACT</option>';
			 }
?>
	<div class="form-group">
		<label class="col-form-label" for="recipient-name">Block Name:</label>
		<input class="form-control" type="text" name="block_name" value="<?php echo $block_name; ?>" required />
		<input type="hidden" name="block_id" value="<?php echo $block_id; ?>" />
	</div>
	<div class="form-group">
		<label class="col-form-label" for="module_selected">Select Module for API Seperate Call:</label>
		<select class="form-control" name="module_selected">
		<option value="">Select</option>
		<?php echo $moduleselect; ?>
		</select>
	</div>
	<div class="form-group">
		<label class="col-form-label" for="recipient-name">Mobile Icon:</label>
		<input type="file" name="icon" class="form-control">
	</div>

	<?php if($icon!=''){ ?>
	<div class="form-group">
		<label class="col-form-label" for="recipient-name">Icon:</label>
		<img src="<?php echo $icon; ?>" height="150" width="150"> 

		<input  type="hidden" name="icon_old" value="<?php echo $icon;  ?>" />
	</div>	
	<?php  } ?>	


<!--<div class="form-group">
<label class="col-form-label" for="recipient-name">Sort:</label>
<input class="form-control" type="text" name="sort" value="<?php //echo $sort_id;  ?>" />
</div>-->
