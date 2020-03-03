<style>
  .file-upload {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    position: relative;
    cursor: pointer;
    overflow: hidden;
    width: 100%;
    max-width: 100%;
    height: 150px;
    padding: 5px 10px;
    font-size: 1rem;
    text-align: center;
    color: #ccc
  }

  .file-upload-wrapper .card.card-body.has-error .file-upload-message .file-upload-error,
  .file-upload-wrapper .card.card-body.has-preview .btn.btn-sm.btn-danger {
    display: block
  }

  .file-upload i {
    font-size: 3rem
  }

  .file-upload .mask.rgba-stylish-slight {
    opacity: 0;
    -webkit-transition: all .15s linear;
    -o-transition: all .15s linear;
    transition: all .15s linear
  }

  .file-upload:hover .mask.rgba-stylish-slight {
    opacity: .8
  }

 /* .file-upload-wrapper .card.card-body.has-error {
    border-color: #f34141
  }*/

  .file-upload-wrapper .card.card-body.has-error:hover .file-upload-errors-container {
    visibility: visible;
    opacity: 1;
    -webkit-transition-delay: 0s;
    -o-transition-delay: 0s;
    transition-delay: 0s
  }

  .file-upload-wrapper .card.card-body.disabled input {
    cursor: not-allowed
  }

  .file-upload-wrapper .card.card-body.disabled:hover {
    background-image: none;
    -webkit-animation: none;
    animation: none
  }

  .file-upload-wrapper .card.card-body.disabled .file-upload-message {
    opacity: .5;
    text-decoration: line-through
  }

  .file-upload-wrapper .card.card-body.disabled .file-upload-infos-message {
    display: none
  }

  .file-upload-wrapper .card.card-body input {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    height: 100%;
    width: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 5
  }

  .file-upload-wrapper .card.card-body .file-upload-message {
    position: relative;
    <!-- top: 50px;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%) -->
  }

  .file-upload-wrapper .card.card-body .file-upload-message span.file-icon {
    font-size: 50px;
    color: #ccc
  }

  .file-upload-wrapper .card.card-body .file-upload-message p {
    margin: 5px 0 0;
	font-size: 1.2rem;
    color: #797878;
  }

  .file-upload-wrapper .card.card-body .file-upload-message p.file-upload-error {
    color: #f34141;
    font-weight: 700;
    display: none
  }

  .file-upload-wrapper .card.card-body .btn.btn-sm.btn-danger {
    display: none;
    position: absolute;
    opacity: 0;
    z-index: 7;
    top: 10px;
    right: 10px;
    -webkit-transition: all .15s linear;
    -o-transition: all .15s linear;
    transition: all .15s linear
  }

  .file-upload-wrapper .card.card-body .file-upload-preview {
    display: none;
    position: absolute;
    z-index: 1;
    background-color: #fff;
    padding: 5px;
    width: 100%;
    height: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    overflow: hidden;
    text-align: center
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-render .file-upload-preview-img {
    width: 100%;
    height: 100%;
    background-color: #fff;
    -webkit-transition: border-color .15s linear;
    -o-transition: border-color .15s linear;
    transition: border-color .15s linear;
    -o-object-fit: cover;
    object-fit: cover
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-render i {
    font-size: 80px;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    position: absolute;
    color: #777
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-render .file-upload-extension {
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    margin-top: 10px;
    text-transform: uppercase;
    font-weight: 900;
    letter-spacing: -.03em;
    font-size: 1rem;
    color: #fff;
    width: 42px;
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-infos {
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 3;
    background: rgba(0, 0, 0, .7);
    opacity: 0;
    -webkit-transition: opacity .15s linear;
    -o-transition: opacity .15s linear;
    transition: opacity .15s linear
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-infos .file-upload-infos-inner {
    position: absolute;
    top: 50%;
    -webkit-transform: translate(0, -40%);
    -ms-transform: translate(0, -40%);
    transform: translate(0, -40%);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    width: 100%;
    padding: 0 20px;
    -webkit-transition: all .2s ease;
    -o-transition: all .2s ease;
    transition: all .2s ease
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-infos .file-upload-infos-inner p {
    padding: 0;
    margin: 0;
    position: relative;
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis;
    color: #fff;
    text-align: center;
    line-height: 25px;
    font-weight: 700
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-infos .file-upload-infos-inner p.file-upload-infos-message {
    margin-top: 15px;
    padding-top: 15px;
    font-size: 12px;
    position: relative;
    opacity: .5
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-infos .file-upload-infos-inner p.file-upload-infos-message::before {
    content: "";
    position: absolute;
    top: 0;
    left: 50%;
    -webkit-transform: translate(-50%, 0);
    -ms-transform: translate(-50%, 0);
    transform: translate(-50%, 0);
    background: #fff;
    width: 30px;
    height: 2px
  }

  .file-upload-wrapper .card.card-body:hover .btn.btn-sm.btn-danger,
  .file-upload-wrapper .card.card-body:hover .file-upload-preview .file-upload-infos {
    opacity: 1
  }

  .file-upload-wrapper .card.card-body:hover .file-upload-preview .file-upload-infos .file-upload-infos-inner {
    margin-top: -5px
  }

  .file-upload-wrapper .card.card-body.touch-fallback {
    height: auto !important
  }

  .file-upload-wrapper .card.card-body.touch-fallback:hover {
    background-image: none;
    -webkit-animation: none;
    animation: none
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview {
    position: relative;
    padding: 0
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-render {
    display: block;
    position: relative
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-infos .file-upload-infos-inner p.file-upload-infos-message::before,
  .file-upload-wrapper .card.card-body.touch-fallback.has-preview .file-upload-message {
    display: none
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-render .file-upload-font-file {
    position: relative;
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    transform: translate(0, 0);
    top: 0;
    left: 0
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-render .file-upload-font-file::before {
    margin-top: 30px;
    margin-bottom: 30px
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-render img {
    position: relative;
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    transform: translate(0, 0)
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-infos {
    position: relative;
    opacity: 1;
    background: 0 0
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-infos .file-upload-infos-inner {
    position: relative;
    top: 0;
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    transform: translate(0, 0);
    padding: 5px 90px 5px 0
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-infos .file-upload-infos-inner p {
    padding: 0;
    margin: 0;
    position: relative;
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis;
    color: #777;
    text-align: left;
    line-height: 25px
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-infos .file-upload-infos-inner p.file-upload-infos-message {
    margin-top: 0;
    padding-top: 0;
    font-size: 18px;
    position: relative;
    opacity: 1
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-message {
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    transform: translate(0, 0);
    padding: 40px 0
  }

  .file-upload-wrapper .card.card-body.touch-fallback .btn.btn-sm.btn-danger {
    top: auto;
    bottom: 23px;
    opacity: 1
  }

  .file-upload-wrapper .card.card-body.touch-fallback:hover .file-upload-preview .file-upload-infos .file-upload-infos-inner {
    margin-top: 5rem
  }

  .file-upload-wrapper .card.card-body .file-upload-loader {
    position: absolute;
    top: 15px;
    right: 15px;
    display: none;
    z-index: 9
  }

  .file-upload-wrapper .card.card-body .file-upload-loader::after {
    display: block;
    position: relative;
    width: 20px;
    height: 20px;
    -webkit-animation: rotate .6s linear infinite;
    animation: rotate .6s linear infinite;
    -webkit-border-radius: 100%;
    border-radius: 100%;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #777;
    border-left: 1px solid #ccc;
    border-right: 1px solid #777;
    content: ""
  }

  .file-upload-wrapper .card.card-body .file-upload-errors-container {
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 3;
    background: rgba(243, 65, 65, .8);
    text-align: left;
    visibility: hidden;
    opacity: 0;
    -webkit-transition: visibility 0s linear .15s, opacity .15s linear;
    -o-transition: visibility 0s linear .15s, opacity .15s linear;
    transition: visibility 0s linear .15s, opacity .15s linear
  }

  .file-upload-wrapper .card.card-body .file-upload-errors-container ul {
    padding: 10px 20px;
    margin: 0;
    position: absolute;
    left: 0;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%)
  }

  .file-upload-wrapper .card.card-body .file-upload-errors-container ul li {
    margin-left: 20px;
    color: #fff;
    font-weight: 700
  }

  .file-upload-wrapper .card.card-body .file-upload-errors-container.visible {
    visibility: visible;
    opacity: 1;
    -webkit-transition-delay: 0s;
    -o-transition-delay: 0s;
    transition-delay: 0s
  }

  .file-upload-wrapper .card.card-body~.file-upload-errors-container ul {
    padding: 0;
    margin: 15px 0
  }

  .file-upload-wrapper .card.card-body~.file-upload-errors-container ul li {
    margin-left: 20px;
    color: #f34141;
    font-weight: 700
  }
</style>
<div class="modal-content">
        <div class="modal-body">
	 <div class="col-lg-12">

	 	<?php 		
											$totalblock = count($dynamic_block);
											$newcount = $totalblock + 4;
											?>


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
				<form id="step" name="checkout-step<?php echo $c;?>" method="post" enctype="multipart/form-data" action="<?php echo base_url('projects/savesteporder');?>"> 
					<?php if(!empty($orderId)){?>
					 <input type="hidden" name="orderId" value="<?php echo $orderId ;?>" />
					<?php } ?>
					 <input type="hidden" name="step" value="<?php echo $c ;?>" />
					<?php if(!empty($getcustom_fields)){?>
						<input type="hidden" name="block_id" value="<?php echo $product_block_id ;?>" />	
						<input type="hidden" name="block_name" value="<?php echo $block_name ;?>" />
						<input type="hidden" name="block_field_name" value="<?php echo $block_field_name ;?>" />
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
						
						
						?>
						<input type="hidden" name="custom_block_field_id[]" value="<?php echo $PBC_field_id;?>" />
						<input type="hidden" name="fieldtype[]" value="<?php echo $fieldtype;?>" />
						<input type="hidden" name="fieldname[]" value="<?php echo $field_name;?>" />

<?php if($flag==1){ ?>
            <input type="hidden" name="flag[]" value="<?php echo $key; ?>"  style="margin-top: 20px;" >
 <?php } ?>


                       <?php if($flag==1){ ?>
                      <label for="<?php echo $uniquelabel;?>"><?php echo $label_name;?></label>
                      <?php } ?>


				<?php if($fieldtype=='textarea'  && $flag==1){?>

				<div class="form-group">
				<div class="col-lg-12">
				<div class="input-group">	
				<textarea class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> <?php echo $lengthtext;?> placeholder="<?php echo $place_holder;?>" ><?php echo $valuetext;?> </textarea>
				</div>
				</div>
				</div>


                      <?php }
						else if($fieldtype=='checkbox' || $fieldtype=='select' || $fieldtype=='multiple'){ ?>
						
						<?php	

						$option_fields 		= explode(',',$getCustomField->option_fields);
							
							if($fieldtype=='checkbox'  && $flag==1){
								foreach($option_fields as $getOptionValue){
								$valuetext=$getOptionValue;
							?>
		<div class="form-group">
		<div class="col-lg-12">
		<div class="input-group">
		<input class="form-control" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> value="<?php echo $valuetext;?>" <?php echo $lengthtext;?> />
		<?php echo $getOptionValue;?>
		</div>
		</div>
		</div>


							<?php 
							}
							}
							else  if ($fieldtype=='select'  && $flag==1){ ?>				 
	<div class="form-group">
	<div class="col-lg-12">
	<div class="input-group">
	<select class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> <?php echo $lengthtext;?>>
	<option value="">Select</option>
	<?php foreach($option_fields as $restype){?>
	<option value="<?php echo $restype;?>"><?php echo $restype;?></option>
	<?php } ?>
	</select>
	</div>
	</div> 	
	</div>

                      <?php } else if ($fieldtype=='multiple'  && $flag==1){ ?>
		<div class="form-group">
		<div class="col-lg-12">
		<div class="input-group">
		<select class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> <?php echo $lengthtext;?> multiple="multiple">
		<option value="">Select</option>
		<?php foreach($option_fields as $restype){?>
		<option value="<?php echo $restype;?>"><?php echo $restype;?></option>
		<?php } ?>
		</select>

		</div>
		</div>
		</div>


                      <?php }
						}else if($fieldtype=='file'  && $flag==1){
								if(!empty($valuetext) && !empty($valueExist)){
									$required='';
								}
								?>
	<div class="form-group">
	<div class="col-lg-12">
	<div class="input-group">
	<div class="file-upload-wrapper card" style="background-color:#f0f8ff;">
	<input class="file-upload" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="<?php echo $PBC_field_id;?>_dynamic_file" <?php echo $required;?> <?php echo $lengthtext;?>  />
	</div>
	</div> 	
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
	</div>
	</div>
							
												<?php }else{ if($flag==1) { ?>
			<div class="form-group">
			<div class="col-lg-12">
			<div class="input-group">
			<input class="form-control" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> value="<?php echo $valuetext;?>" placeholder="<?php echo $place_holder;?>" <?php echo $lengthtext;?> />
			</div>
			</div>
			</div>
                      <?php } } ?>
                    <?php } ?>
                    <div style="height: 30px; width: 100%;"></div>

                    </div> <br>
                  <div style="height: 30px; width: 100%;"></div> 
				   <div class="form-group"><button class="btn btn-primary" type="submit" style="margin-top:30px;margin-left:15px;">Submit</button></div>
				</form>
				 </div>
				</div>
				
                <?php $c++; } ?>
				
				<!------ Dispute ITem ---------------->
				<!------- End Dispute  -------------> 
				 
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
	//window.location.reload();
getOrderCustomDetail('<?php echo $orderId;?>','task','<?php echo $totalblock+4;?>','<?php echo $newcount;?>');
   $('#exampleModaldynamicfield').modal('hide');
}
});
}));
</script>		