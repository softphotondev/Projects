<style>
.view-pdf { background:#db4432;
color:#fff;
padding: 5px 15px;
text-transform: uppercase;
font-weight: 700;
float: right;
border-radius: 50px;}
.view-pdf:hover { background:#000; color:#fff;}
#image-step { margin-bottom:25px;}
.col-lg-4 { float:left;}
.whiteBg { display:inline-block; width:100%;}
.btn-print { background:#1e73be; color:#fff;
text-transform: uppercase; font-weight: 600; font-size: 16px; margin-top:15px;}
.btn-download { background:#ed3a25; color:#fff;
text-transform: uppercase; font-weight: 600; font-size: 16px; margin-top:15px;}
.btn-print:hover, .btn-download:hover { background:#000; color:#fff;} 
</style>
<div id="step-<?php echo $stepno ;?>">
	<?php
			$block_name 		= $block_name;
			$block_field_name	= str_replace(' ', '-', strtolower($block_name));
			$block_id 			= $block_id;
			$predynamicBlock 	= $customfields;
			$module_selected 	= $module_selected;
			?>
			<h4 class="order-card-title"><?php echo $block_name;?> <hr/></h4>

			<?php
			if($block_id==8){
				echo $dispute_items;
			}else {
				if($module_selected=='contract'){
					echo $contract_sign_letter;
				}else{
											
			   foreach($getcustom_fields as $getCustomField){
					$fieldtype 			= $getCustomField->field_type;
					$label_name 		= $getCustomField->label_name;
					$field_name			= str_replace(' ', '-', strtolower($label_name));
					$length 			= $getCustomField->length;
					$default_value 		= $getCustomField->default_value;
				
					$PBC_field_id 		= $getCustomField->custom_block_field_id;
				
					$valuetext='';
					$valueExist=0;
					if(!empty($block_id)){
						$valuetext = isset($predynamicBlock[$field_name]) ? $predynamicBlock[$field_name] : $valuetext;
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
						<div class="col-lg-4">
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
						
						<a href="<?php echo $valuetext; ?>" class="btn btn-download" download=""  target="_blank" ><i class="fa fa-download" aria-hidden="true" ></i> Download</a>
						<a href="javascript:void(0);" class="btn btn-print"  onclick="printimage('<?php echo $valuetext; ?>')"><i class="fa fa-print" aria-hidden="true"></i>Print</a>

						</div>
					<?php }
						}else { ?>
						<div class="form-group row">
							<label for="staticEmail" class="col-sm-2 col-form-label"><?php echo $label_name;?></label>
							<div class="col-sm-10"><?php echo $valuetext;?>
							</div>
						</div>
					<?php } ?>
					
		<?php }
			} 
			}?>
		
  </div>
<script>
function printimage(img)
{
    var W = window.open(img);

    W.window.print();
}
</script>
