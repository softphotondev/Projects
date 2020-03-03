<div class="modal-content">
        <div class="modal-body">


	 <div class="col-lg-12"> 
                <?php
					$c=1;

					//echo "<pre>";
					 //print_r($pre_dynamic_block);


					foreach($dynamic_block as $getRes){
						$displayblock ='display:none;';
						$block_name 		= $getRes->block_name;
						$block_field_name	= str_replace(' ', '-', strtolower($block_name));
						$product_block_id 	= $getRes->block_id;
						$getcustom_fields 	= $getRes->custom_fields;
						$module_selected 	= $getRes->module_selected;
					?>
                <div id="step-<?php echo $c ;?>">
				<form id="step" name="checkout-step<?php echo $c;?>" method="post" enctype="multipart/form-data" action="<?php echo base_url('projects/savesteporderflag');?>"> 
					<?php if(!empty($orderId)){?>
					 <input type="hidden" name="orderId" value="<?php echo $orderId ;?>" />
					<?php } ?>
					 <input type="hidden" name="step" value="<?php echo $c ;?>" />
					<?php if(!empty($getcustom_fields)){?>
						<input type="hidden" name="block_id" value="<?php echo $product_block_id; ?>" />	
						<input type="hidden" name="module_selected" value="<?php echo $module_selected ;?>" />
					  <?php } ?>
                  <div class="col-sm-12 pl-0">
					<div class="modal-header">
					  <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $block_name;?></h5>
					  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					</div>
                    <?php 
                    $order_detail_ids = $this->Product_model->getcustomfieldlistByOrderIdDetails($orderId,$product_block_id);

					   foreach($getcustom_fields as $key=>$getCustomField)
					   {
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

						$flag = isset($order_detail_ids[$key]->flag) ? $order_detail_ids[$key]->flag : 0;

						$valueExist=0;
						//print_r($predynamicBlock);exit;
						if(!empty($predynamicBlock)){
							$valuetext = isset($predynamicBlock['customfields'][$field_name]) ? $predynamicBlock['customfields'][$field_name] : $valuetext;
							$valueExist=1;
						}
					   $order_detail_id = $this->Product_model->getorderdetailid($valuetext,$orderId,$product_block_id,$field_name);
						?>
						<input type="hidden" name="order_detail_id[]" value="<?php echo $order_detail_id;?>" />
						<input type="hidden" name="custom_block_field_id[]" value="<?php echo $PBC_field_id;?>" />

				         <label for="<?php echo $uniquelabel;?>"><?php echo $label_name;?></label>
					 	 <br>
						<div class="form-group">
						<div class="col-lg-12">	
						

                          <?php
                           if($fieldtype=='file')
                           {
                           	?>
                           	<div>
							<?php if(!empty($valuetext) && !empty($valueExist)){?>
							<input type="hidden" name="<?php echo $PBC_field_id;?>_dynamic_filevalue" value="<?php echo $valuetext;?>" />
							<?php
							$supported_image = array('gif','jpg','jpeg','png');
							$src_file_name = $valuetext;
							$ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
							if (in_array($ext, $supported_image)) {?>
							<a href="<?php echo $valuetext;?>" target="_blank"><img src="<?php echo $valuetext;?>" width="35%" height="50%"/></a>
							<?php } else { ?>
							<a href="<?php echo $valuetext;?>" target="_blank">View</a>
							<?php }
							}
							?>
                          <?php
                           }
                           else
                           {
                          ?>
                          <div class="input-group">
							<label for="<?php echo $uniquelabel;?>"><?php echo $valuetext;?></label>
						<?php } ?>


							<input type="checkbox" name="flag[]" value="<?php echo $key; ?>" style="margin-left: 20px;margin-top:-5px;"   <?php echo ($flag==1)?'checked':''; ?>></div>
						</div>	
						</div>


				<?php } ?>
	
                    </div>
                  
				   <div class="form-group"><button class="btn btn-primary" type="submit">Submit</button></div>
				  </div>
                
				</form>
				</div>
				
                <?php $c++; } ?>
				
				<!------ Dispute ITem ---------------->
				<!------- End Dispute  -------------> 
				 
				</div>
			</div>
		</div>
<script type="text/javascript">
$("#step").on('submit',(function(e) {
e.preventDefault();
// Get form
var form = $('#step')[0];
// Create an FormData object 
var data = new FormData(form);
$.ajax({
url: "<?php echo base_url('projects/savesteporderflag');?>",
type: "POST",
enctype: 'multipart/form-data',
data: data,
processData: false,
contentType: false,
cache: false,
timeout: 600000,
success: function(data)   // A function to be called if request succeeds
{
   $('#exampleModaldynamicfield').modal('hide');
}
});
}));
</script>		
