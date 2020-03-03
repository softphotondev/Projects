
	<div class="card card-body">
		<?php
			$order_id 			= $orderId;
			$block_name 		= $block_name;
			$block_field_name	= str_replace(' ', '-', strtolower($block_name));
			$block_id 			= $block_id;
			$predynamicBlock 	= $customfields;
			$module_selected 	= $module_selected;
			$orderDetailFieldId = $customfields_orderDetailId;
			?>
			 <label for="name"><?php echo $block_name;?> <hr/></label>
			<?php				
			   foreach($getcustom_fields as $getCustomField){
					$fieldtype 			= $getCustomField->field_type;
					$label_name 		= $getCustomField->label_name;
					$field_name			= str_replace(' ', '-', strtolower($label_name));
					$length 			= $getCustomField->length;
					$default_value 		= $getCustomField->default_value;
				
					$PBC_field_id 		= $getCustomField->custom_block_field_id;
				
					$valuetext='';
					$valueExist=0;
					$order_detail_id=0;
					$flag=0;
					if(!empty($block_id)){
						$valuetext = isset($predynamicBlock[$field_name]) ? $predynamicBlock[$field_name] : $valuetext;
						$order_detail_id = isset($orderDetailFieldId[$field_name]) ? $orderDetailFieldId[$field_name] : $order_detail_id;
						$flag = isset($flag_fieldValue[$order_detail_id]) ? $flag_fieldValue[$order_detail_id] : $flag;
						$valueExist=1;
					}
			?>
				 	<?php if($fieldtype=='file'){ 
				  			if(!empty($valuetext) && !empty($valueExist)){	?>
								<div class="form-group row">
									<div id="image-step">
									<h5 class="card-title"><?php echo $label_name;?></h5>
									<?php
										$supported_image = array('gif','jpg','jpeg','png');
										$src_file_name = $valuetext;
										$ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION));
											if(in_array($ext, $supported_image)) {?>
											<img class="img-fluid" src="<?php echo $valuetext;?>">
										<?php } else { ?>
											<a href="<?php echo $valuetext;?>" target="_blank" class="view-pdf"> VIEW DOCUEMENT </a>
										<?php } ?>
									</div>
								</div>
					<?php }
						}else { ?>
						<div class="form-group row">
							<label for="staticEmail" class="col-sm-4 col-form-label"><?php echo $label_name;?></label>
							<div class="col-sm-6"><?php echo $valuetext;?></div>
							<div class="col-sm-2">
						<input type="checkbox" name="flag[]" value="<?php echo $order_detail_id;?>" onclick="getUpdateBlockFieldItem('<?php echo $order_detail_id;?>','<?php echo $order_id;?>','<?php echo $block_id;?>');" <?php if($flag==1){ echo "checked";}?> />Mark Flag </div>
						</div>
					<?php } ?>
		<?php } ?>
  </div>
