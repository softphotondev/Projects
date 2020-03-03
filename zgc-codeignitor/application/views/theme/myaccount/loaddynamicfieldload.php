         <div class="col-lg-4"> 
                <?php
					$c=1;
					foreach($dynamic_block as $getRes){
						$displayblock ='display:none;';
						$block_name 		= $getRes->block_name;
						$block_field_name	= str_replace(' ', '-', strtolower($block_name));
						$product_block_id 	= $getRes->block_id;
						$getcustom_fields 	= $getRes->custom_fields;
						$module_selected 	= $getRes->module_selected;
					?>
                <div id="step-<?php echo $c ;?>">
				<form id="step_<?php echo $product_block_id; ?>" name="checkout-step<?php echo $c;?>" method="post" enctype="multipart/form-data" action="<?php echo base_url('projects/savesteporder');?>"> 
					<?php if(!empty($orderId)){?>
					 <input type="hidden" name="orderId" value="<?php echo $orderId ;?>" />
					<?php } ?>
					 <input type="hidden" name="step" value="<?php echo $c ;?>" />
                  <div class="col-sm-12 pl-0">
                    <?php
                    	if($module_selected=='contract'){
							echo $contract_sign_letter;
							
						}else if($product_block_id==8){
							echo $dispute_items;
							$submitBtn ='Final Step to Complete';
						}else {

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
						$required='';
						if($mandatory_field==1){
							$required='required';
						}
						$valuetext='';
						if(!empty($default_value)){
							$valuetext=$default_value;
						}
						$lengthtext='';
						if(!empty($default_value)){
							$lengthtext='maxlength="'.$length.'"';
						}
						
						$predynamicBlock = isset($pre_dynamic_block[$product_block_id]) ? $pre_dynamic_block[$product_block_id] : 0;
						$valueExist=0;
						//print_r($predynamicBlock);exit;
						if(!empty($predynamicBlock)){
							$valuetext = isset($predynamicBlock['customfields'][$field_name]) ? $predynamicBlock['customfields'][$field_name] : $valuetext;
							$valueExist=1;
						}
						
						
						?>
						
                    <div class="form-group">
                      <label for="<?php echo $uniquelabel;?>"><?php echo $label_name;?></label>
                      <?php if($fieldtype=='textarea'){ echo $valuetext; }
						else if($fieldtype=='checkbox' || $fieldtype=='select' || $fieldtype=='multiple'){
							$option_fields 		= explode(',',$getCustomField->option_fields);
							
							if($fieldtype=='checkbox'){
								foreach($option_fields as $getOptionValue){
									$valuetext=$getOptionValue;
								
									echo $getOptionValue;
								}
							}
						}else if($fieldtype=='file'){
							if(!empty($valuetext) && !empty($valueExist)){
								$required='';
							}
								
							if(!empty($valuetext) && !empty($valueExist)){
								$supported_image = array('gif','jpg','jpeg','png');
								$src_file_name = $valuetext;
								$ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
									if (in_array($ext, $supported_image)) {?>
									<a href="<?php echo $valuetext;?>" target="_blank"><img src="<?php echo $valuetext;?>" width="60%" height="40%"/></a>
									<?php } else { ?>
										<a href="<?php echo $valuetext;?>" target="_blank">View</a>
									<?php }
							}
						}else{ 
							echo $valuetext; 
						} ?>
                    </div>
                    <?php } } ?>
				  </div>
                
				</form>
				</div>
				
                <?php $c++; } ?>
				
				<!------ Dispute ITem ---------------->
				<!------- End Dispute  -------------> 
				 
				</div>
		
<script type="text/javascript">
$("#step_<?php echo $product_block_id; ?>").on('submit',(function(e) {
e.preventDefault();
// Get form
var form = $('#step_<?php echo $product_block_id; ?>')[0];
// Create an FormData object 
var data = new FormData(form);
$.ajax({
url: "<?php echo base_url('projects/savesteporder');?>",
type: "POST",
enctype: 'multipart/form-data',
data: data,
processData: false,
contentType: false,
cache: false,
timeout: 600000,
success: function(data)   // A function to be called if request succeeds
{
	 $('#loadmessageload').css('display','block');
}
});
}));
</script>		