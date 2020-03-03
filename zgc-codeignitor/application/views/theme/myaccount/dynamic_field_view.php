
				<?php
					$c=1;
					foreach($dynamic_block as $getRes){
						$displayblock ='display:none;';
						$block_name 		= $getRes->block_name;
						$block_field_name	= str_replace(' ', '-', strtolower($block_name));
						$product_block_id 	= $getRes->block_id;
						$getcustom_fields 	= $getRes->custom_fields;
						$module_selected 	= $getRes->module_selected;


					   foreach($getcustom_fields as $getCustomField){
							$fieldtype 			= $getCustomField->field_type;
							$label_name 		= $getCustomField->label_name;
							$field_name			= str_replace(' ', '-', strtolower($label_name));
							$length 			= $getCustomField->length;
							$default_value 		= $getCustomField->default_value;
							$place_holder 		= $getCustomField->place_holder;
							$is_desktop_view 	= $getCustomField->is_desktop_view;
							$is_mobile_view 	= $getCustomField->is_mobile_view;
							$mandatory_field 	= $getCustomField->mandatory_field;
							$PBC_field_id 		= $getCustomField->custom_block_field_id;
							//$filedname 			= slugurl($label_name);
							$uniquelabel=$fieldtype.$PBC_field_id;
							$valuetext='';
							if(!empty($default_value)){
								$valuetext=$default_value;
							}
						
							$predynamicBlock = isset($pre_dynamic_block[$product_block_id]) ? $pre_dynamic_block[$product_block_id] : 0;
							$valueExist=0;
							
							if(!empty($predynamicBlock)){
								$valuetext = isset($predynamicBlock['customfields'][$field_name]) ? $predynamicBlock['customfields'][$field_name] : $valuetext;
								$valueExist=1;
							}
						?>
							 <?php if($fieldtype=='textarea'){?>
								<div class="list-group">
								  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
									<div class="d-flex w-100 justify-content-between">
									  <h5 class="mb-1"><?php echo $label_name;?></h5>
									</div>
									<p class="mb-1"><?php echo $valuetext;?></small>
								  </a>
								</div>

							  <?php }else if($fieldtype=='file'){ 
									if(!empty($valuetext) && !empty($valueExist)){	
									?>
									<div class="card bg-dark text-white">
									  <div class="card-body">
										<h5 class="card-title"><?php echo $label_name;?></h5>
									  </div>
										<?php
										$supported_image = array('gif','jpg','jpeg','png');
										$src_file_name = $valuetext;
										$ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION));
											if(in_array($ext, $supported_image)) {?>
											<img class="card-img-bottom" src="<?php echo $valuetext;?>" width="60%" height="40%">
										<?php } else { ?>
											<a href="<?php echo $valuetext;?>" target="_blank">View</a>
										<?php } ?>
									</div>
								<?php }
									}else { ?>
									<div class="form-group row">
										<label for="staticEmail" class="col-sm-2 col-form-label"><?php echo $label_name;?></label>
										<div class="col-sm-10">
										  <input type="text" readonly class="form-control-plaintext" id="<?php echo $uniquelabel;?>" value="<?php echo $valuetext;?>">
										</div>
									</div>
								<?php } ?>
                    <?php } 
					$c++; } ?>