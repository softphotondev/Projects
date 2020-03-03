  <?php include_once ('top_content.php'); ?>
  <style>
  .heading-row{
	  background-color: lightslategrey;height: 38px;
  }
  </style>
   <?php
       $totalStepCount=0;
        $c=1;
        foreach($dynamic_block as $getRes){
            $block_name 		= $getRes->block_name;
            $block_field_name	= str_replace(' ', '-', strtolower($block_name));
            $product_block_id 	= $getRes->block_id;
            $getcustom_fields 	= $getRes->custom_fields;
            
            $module_selected 	= $getRes->module_selected;
            $submitBtn ='Submit';
            $btnType 	='submit';
            $btnTypeId  ='form_submit'.$c;
            $formId = $block_field_name;
            $onclickMethod='';
            $actionMethod='order/savestepmobile';
            //$actionMethod='order/savestep';
            if($module_selected=='identityiq'){
                $submitBtn ='Import Your Credit Report Now';
                $btnType ='submit';
                $formId = 'indentityiqform';
            }
            else if($module_selected=='contract' && empty($contract_sign->sign)){
                //$actionMethod='order/saveContract';
                 $actionMethod='order/saveContractmobile';
            }
            if($product_block_id==8){
               // $actionMethod='order/saveDispute';
                $actionMethod='order/saveDisputemobile';
            }           
        ?>
      <div class="default-according" id="accordion<?php echo $c;?>">
        <div class="card">
             <h2 class="orderview-title" id="headingstep_<?php echo $c;?>" data-toggle="collapse" data-target="#collapsestep_<?php echo $c;?>"> <?php echo $block_name ;?></h2>
            <div class="collapse" id="collapsestep_<?php echo $c;?>" aria-labelledby="headingstep_<?php echo $c;?>" data-parent="#accordion<?php echo $c;?>" style="">
                <div class="card-body">
                     <form id="<?php echo $formId;?>" name="checkout-step<?php echo $c;?>" method="post" enctype="multipart/form-data" action="<?php echo base_url($actionMethod);?>"> 
							 <input type="hidden" name="orderId" value="<?php echo $orderId ;?>" />
							 <input type="hidden" name="totalsteps" value="<?php echo $totalStepCount ;?>" />
							 <input type="hidden" name="step" value="<?php echo $c ;?>" />
                            <?php if(!empty($getcustom_fields) || $product_block_id==8){?>
							<input type="hidden" name="block_id" value="<?php echo $product_block_id ;?>" />	
							<input type="hidden" name="block_name" value="<?php echo $block_name ;?>" />
							<input type="hidden" name="block_field_name" value="<?php echo $block_field_name ;?>" />
							<input type="hidden" name="module_selected" value="<?php echo $module_selected ;?>" />
                            <?php } ?>
							<div class="row">
							<?php $disputeflag=0;
								if($product_block_id==8){
									if(!empty($dispute_items) && isset($dispute_items)){
									 echo $dispute_items;
									 //$submitBtn ='Procced to Checkout';
									}else{
										echo 'IdentityIQ Report Not Avaialble! Please Fetch the Report Now!';
										$disputeflag=1;
									}
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
										$astrisk='';
										if($mandatory_field==1){
											$required='required';
											$astrisk='<span class="astrisk">*</span>';
										}
										$valuetext='';
										if(!empty($default_value)){
											$valuetext=$default_value;
										}
										$lengthtext='';
										if(!empty($length) && ($fieldtype=='text' || $fieldtype=='number')){
											$lengthtext='maxlength="'.$length.'"';
										}
										
										$predynamicBlock = isset($pre_dynamic_block[$product_block_id]) ? $pre_dynamic_block[$product_block_id] : 0;
										$valueExist=0;
										//print_r($predynamicBlock);exit;
										if(!empty($predynamicBlock)){
											$valuetext = isset($predynamicBlock['customfields'][$field_name]) ? $predynamicBlock['customfields'][$field_name] : $valuetext;
											$valueExist=1;
										}

										  if($place_holder=='XXX-XXX-XXXX')
										  {
											$onkey = " onkeypress='addDashesphone(this)'  minlength='12' maxlength='12' ";
										  }
										  else  if($place_holder=='00000')
										  {
											$onkey = " onkeypress='return isNumberKey(this)'  maxlength='5' minlength='5' ";
										  }
										  else if($place_holder=='00/00/0000')
										  {
											$onkey = " onkeypress='addDashesdob(this)' ";
										  }
										  else if($place_holder=='XXX-XX-XXXX')
										  {
											$onkey = " onkeypress='addDashesssn(this)'   maxlength='11' minlength='11' ";
										  }
										  else
										  {
											 $onkey ='';
										  }
										?>
										<input type="hidden" name="custom_block_field_id[]" value="<?php echo $PBC_field_id;?>" />
										<input type="hidden" name="fieldtype[]" value="<?php echo $fieldtype;?>" />
										<input type="hidden" name="fieldname[]" value="<?php echo $field_name;?>" />
										<?php $coloumn='col-lg-6'; if($fieldtype=='file'){$coloumn='col-lg-12';}?>
											<div class="form-group <?php echo $coloumn;?>">
											<h2 for="<?php echo $uniquelabel;?>" class="checklist-title"><?php echo $label_name;?><?php echo $astrisk;?></h2>
									  <?php if($fieldtype=='textarea'){?>
											<textarea class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> <?php echo $lengthtext;?> placeholder="<?php echo $place_holder;?>" ><?php echo $valuetext;?> </textarea>
									  <?php }
										else if($fieldtype=='checkbox' || $fieldtype=='select' || $fieldtype=='multiple'){
											$option_fields 		= explode(',',$getCustomField->option_fields);
											
												if($fieldtype=='checkbox'){
													foreach($option_fields as $getOptionValue){
													$valuetext=$getOptionValue;
												?>
													<input class="form-control" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> value="<?php echo $valuetext;?>" />
													<?php echo $getOptionValue;?>
												<?php 
													}
												}
												if ($fieldtype=='select'){ ?>
												  <select class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?>>
													<option value="">Select</option>
													<?php foreach($option_fields as $restype){?>
													<option value="<?php echo $restype;?>"><?php echo $restype;?></option>
													<?php } ?>
												  </select>
										  <?php }
												if ($fieldtype=='multiple'){ ?>
												  <select class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> multiple="multiple">
													<option value="">Select</option>
													<?php foreach($option_fields as $restype){?>
													<option value="<?php echo $restype;?>"><?php echo $restype;?></option>
													<?php } ?>
												  </select>
											<?php }
										}
										else if($fieldtype=='file'){
												if(!empty($valuetext) && !empty($valueExist)){
													$required='';
												}
												  if($module_selected=='contract')
												  {
													?>
													<?php if(isset($downloadlink) && isset($iscontractUploaded)){?>
														<div class="download-section">										
															<p>Download contract and upload the sign contract. </p>
															<div class="btn-group">
															<a href="<?php echo $downloadlink; ?>" class="btn btn-primary downloadpdf" download=""  target="_blank" ><i class="fa fa-download" aria-hidden="true" ></i> Download</a>
															<a href="javascript:void(0);" class="btn btn-primary print"  onclick="printimage('<?php echo $downloadlink; ?>')"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
															</div> 
															<?php if($iscontractUploaded==1){ $required=''; ?>
															<a href="<?php echo $downloadlink;?>" class="btn btn-primary" target="_blank">View Your Uploaded Document</a>
															<?php } ?>
														</div>
													<?php } ?>
												  <?php
												  }
												?>
											<div class="row">	
												<div class="col-lg-6">									
													<div class="file-upload-wrapper card" style="background-color:#f0f8ff;">
														<i class="fa fa-cloud-upload" aria-hidden="true"></i>
															<input class="file-upload" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="<?php echo $PBC_field_id;?>_dynamic_file" <?php echo $required;?> <?php echo $lengthtext;?>  />
													</div>
												</div>
										
											<?php if(!empty($valuetext) && !empty($valueExist)){?>
													<input type="hidden" name="<?php echo $PBC_field_id;?>_dynamic_filevalue" value="<?php echo $valuetext;?>" />
													<div class="card col-lg-6">
														<div class="uploadImg">
														<?php
															$supported_image = array('gif','jpg','jpeg','png');
															$src_file_name = $valuetext;
															$ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
															if (in_array($ext, $supported_image)) {?>
																<a href="<?php echo $valuetext;?>" target="_blank"><img class="card-img-top img-fluid" src="<?php echo $valuetext;?>"/></a>
																<?php } else { ?>
																<a href="<?php echo $valuetext;?>" class="btn btn-primary" target="_blank">View Your Uploaded Document</a>
																<?php }?> 
														</div>
													</div>
												<?php } ?>

											</div>
												
									<?php }else{?>
											<input class="form-control" <?php echo $onkey; ?> id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> value="<?php echo $valuetext;?>" placeholder="<?php echo $place_holder;?>" <?php echo $lengthtext;?> />
									  <?php } ?>
									</div>
									<?php } ?>
									
								<?php } ?>
								<div class="form-group col-lg-12">
									<button class="btn btn-primary" id="<?php echo $btnTypeId; ?>" type="<?php echo $btnType;?>"> <?php echo $submitBtn;?></button>
								</div>
							</div>
					</form>
                </div>
          </div>
        </div>
      </div>
    <?php 
      $totalStepCount+=1;
		$c++;} ?>
		
  <!-- 6. Bot Table -->
   <div class="default-according" id="accordion_botable">
      <div class="card">
           <h2 class="orderview-title" id="heading_bottable" data-toggle="collapse" data-target="#collapse_bottable">Bot Table </h2>
            <div class="collapse" id="collapse_bottable" aria-labelledby="heading_bottable" data-parent="#accordion_botable" style="">
				<?php if(isset($bot_dispute_items)){?>
                <div class="card-body">
					<div class="card-header">
					  <a  class="btn btn-danger" href="<?php echo base_url('Order/getrunbot/'.$order_id); ?>" > Run </a>
					  <button type="button" class="btn btn-success" onclick="resetBotdata()" > Reset Data </button>
					  <button type="button" class="btn btn-success" onclick="saveBotdata()" > Save Data </button>
					</div>
					<?php echo $bot_dispute_items;?>
				</div>
				<?php } else { echo 'Dispute Item Not Found!';}?>
				
					<!-- FTC Download -->
				  <div class="card">
					   <h2 class="orderview-title">FTC Download</h2>
						<div class="card-body">
							<?php echo $get_ftcdownload;?>
						</div>
				  </div>
				   <div class="card">
					   <h2 class="orderview-title">FTC Upload</h2>
						<div class="card-body">
							<?php echo $get_ftcupload;?>
						</div>
				  </div>
	  
			</div>
      </div>
	  
	  
   </div>
   <!-- 7. SignatureUpload -->
    <div class="default-according" id="accordion_SignatureUpload">
      <div class="card">
           <h2 class="orderview-title" id="heading_SignatureUpload" data-toggle="collapse" data-target="#collapse_SignatureUpload">Signature Upload </h2>
            <div class="collapse" id="collapse_SignatureUpload" aria-labelledby="heading_SignatureUpload" data-parent="#accordion_SignatureUpload" style="">
                <div class="card-body">
					<?php echo $get_signatureUpload;?>
				</div>
			</div>
      </div>
   </div>
   
   <!--- 8. Create Letter-->
    <div class="default-according" id="accordion_createletter">
      <div class="card">
           <h2 class="orderview-title" id="heading_createletter" data-toggle="collapse" data-target="#collapse_createletter">Create Letter</h2>
            <div class="collapse" id="collapse_createletter" aria-labelledby="heading_createletter" data-parent="#accordion_createletter" style="">
                <div class="card-body">
					<?php echo $get_create_letter;?>
				</div>
			</div>
      </div>
   </div>
   
	<!---9. USP Labels--->
	
	<div class="default-according" id="accordion_usplabel">
      <div class="card">
           <h2 class="orderview-title" id="heading_uspletter" data-toggle="collapse" data-target="#collapse_uspletter">USP Labels</h2>
            <div class="collapse" id="collapse_uspletter" aria-labelledby="heading_uspletter" data-parent="#accordion_usplabel" style="">
                <div class="card-body">
					
				</div>
			</div>
      </div>
   </div>
	<?php /*?>
	<!---10. FTC Download  --->
	<div class="default-according" id="accordion_ftcdownload">
      <div class="card">
           <h2 class="orderview-title" id="heading_ftcdownload" data-toggle="collapse" data-target="#collapse_ftcdownload">FTC Download</h2>
            <div class="collapse" id="collapse_ftcdownload" aria-labelledby="heading_ftcdownload" data-parent="#accordion_ftcdownload" style="">
                <div class="card-body">
					<?php echo $get_ftcdownload;?>
				</div>
			</div>
      </div>
   </div>
 
	<!---11. FTC Upload  --->
	<div class="default-according" id="accordion_ftcupload">
      <div class="card">
           <h2 class="orderview-title" id="heading_ftcupload" data-toggle="collapse" data-target="#collapse_ftcupload">FTC Upload</h2>
            <div class="collapse" id="collapse_ftcupload" aria-labelledby="heading_ftcupload" data-parent="#accordion_ftcupload" style="">
                <div class="card-body">
					<?php echo $get_ftcupload;?>
				</div>
			</div>
      </div>
   </div>  
   <?php */ ?>
	<!---12. Documents --->
	<div class="default-according" id="accordion_document">
      <div class="card">
           <h2 class="orderview-title" id="heading_document" data-toggle="collapse" data-target="#collapse_document">Documents</h2>
            <div class="collapse" id="collapse_document" aria-labelledby="heading_document" data-parent="#accordion_document" style="">
			<div class="card-body">
			 <!--<form id="submit" enctype="multipart/form-data" method="post" action="<?php //echo base_url('order/documentupload'); ?>"> -->
				  <input type="hidden" name="order_detail_id" id="order_detail_id">
				  <input type="hidden" name="custom_field_name" id="custom_field_name">
						<div class="table-responsive">
						  <table class="display" width="100%">
							  <thead>
								<tr class="heading-row">
									<th>Title</th>
									<th>Uploaded By</th>
									<th>Uploaded To</th>
									<th>Uploaded On</th>
									<!--<th>Upload</th>-->
									<th>Download</th>
								</tr>
						  </thead>
						  <tbody>
							<?php 
							  foreach($order_documents as $getorderdocs){
								  $uplaoded_to = $getorderdocs->first_name .' '.$getorderdocs->last_name;
								  ?>
								  <tr>
									<td><?php echo strtoupper($getorderdocs->title); ?></td>
									<td><?php echo usersname($getorderdocs->added_by); ?></td>
									<td><?php echo $uplaoded_to; ?></td>
									<td><?php echo date('m/d/Y h:i:s A', strtotime($getorderdocs->created_at)); ?></td>
									  <td>
										<a href="<?php echo $getorderdocs->path;?>" target="_blank"  download  class="btn btn-success btn-xs">Download</a>
										<a href="javascript:void(0);" class="btn btn-success btn-xs" onclick="printimage('<?php echo $getorderdocs->path;?>')">Print</a>
										<a  href="<?php echo $getorderdocs->path;?>" target="_blank" class="btn btn-success btn-xs" >View</a>
									  </td>
									</tr>
							 <?php  }?>
							  <?php
								$i=2;
							   foreach($documents as $key => $docResponse){
									$fieldname = str_replace('-', ' ',$docResponse->custom_field_name);
									$added_by = $docResponse->first_name .' '.$docResponse->last_name;
									$added_date = date('m/d/Y h:i:s A', strtotime($docResponse->added_date));
									?>
									<tr>
									<td><?php echo strtoupper($fieldname); ?></td>
									<td><?php echo $added_by; ?></td>
									<td><?php echo $added_by; ?></td>
									<td><?php echo $added_date; ?></td>
									<!--<td><input type="file" name="image_<?php //echo $docResponse->custom_field_name; ?>" id="<?php //echo $docResponse->order_detail_id; ?>"  onChange="chkFile(this,'<?php //echo $docResponse->order_detail_id; ?>','<?php //echo $docResponse->custom_field_name; ?>')"></td> -->
									  <td>
										<a href="<?php echo $docResponse->custom_field_values;?>" target="_blank"  download  class="btn btn-success btn-xs">Download</a>
										<a href="javascript:void(0);" class="btn btn-success btn-xs" onclick="printimage('<?php echo $docResponse->custom_field_values; ?>')">Print</a>
										<a  href="<?php echo $docResponse->custom_field_values;?>" target="_blank" class="btn btn-success btn-xs" >View</a>
										<?php if($this->session->userdata('user_id')=='1') { ?>
											<input name="do_this[]" type="checkbox" value="<?php echo $docResponse->custom_field_values; ?>"/>
										<?php if(!empty($docResponse->generated_pdf)) {?> <br>
											<a title="View Generated PDF" class="generatedpdf" href="<?php echo $baseurl.'uploads/pdffiles/'.$docResponse->generated_pdf;?>" target="_blank" >View Generated PDF</a><?php echo $document->file_name; ?>
										<?php
										} } 
										?>
									  </td>
									</tr>
							<?php $i++;} ?>
									</tbody>
									  </table>
								</div>
						<!-- </form>-->
				</div>
			</div>
      </div>
   </div>
	<!---13. Letters  --->
	<div class="default-according" id="accordion_letters">
      <div class="card">
           <h2 class="orderview-title" id="heading_letters" data-toggle="collapse" data-target="#collapse_letter">Letters</h2>
            <div class="collapse" id="collapse_letter" aria-labelledby="heading_letters" data-parent="#accordion_letters" style="">
                <div class="card-body">
					  <?php echo $get_letters;?>
				</div>
			</div>
      </div>
   </div>
	
	<!---14. Tracking  --->
	
	<div class="default-according" id="accordion_tracking">
      <div class="card">
           <h2 class="orderview-title" id="heading_tracking" data-toggle="collapse" data-target="#collapse_tracking">Tracking</h2>
            <div class="collapse" id="collapse_tracking" aria-labelledby="heading_tracking" data-parent="#accordion_tracking" style="">
                <div class="card-body">
						<div class="table-responsive" style="margin-top: 50px;">
						  <table id="1_wrapper_datatable" class="display"  >
							  <thead>
								<tr>
								  <th>S.No</th>
								  <th>Experian</th>
								  <th>Equifax</th>
								  <th>Transunion</th>
								  <th>Create Date & Time</th>
								  <th>Action</th>
								  </tr>
							  </thead>
							  <tbody>
									  <?php 
										$i=1;
										$due_date = date("m/d/Y H:i:s", strtotime($usertrack->created_at));
									  ?>
									  <tr>
										<td><?php echo $i; ?></td>
										<td>
										<span class="txt_<?php echo $usertrack->id; ?>"><?php echo $usertrack->exp_track; ?><br />
										  <a href="<?php echo $usertrack->exp_link; ?>" target="_blank">Print Label</a>
										</span>
										<input id="exp_track" name="exp_track" type="text"  value="<?php echo $usertrack->exp_track; ?>" class="form-control ctrl_<?php echo $usertrack->id; ?>" style="display:none;width: 210px;box-shadow: 3px 3px 3px 3px #888888;"   />
										</td>

										<td>
										<span class="txt_<?php echo $usertrack->id; ?>"><?php echo $usertrack->equ_track; ?>
										  <br />
										   <a href="<?php echo $usertrack->equ_link; ?>" target="_blank">Print Label</a>
										</span>
										<input id="equ_track" name="exp_track" type="text"  value="<?php echo $usertrack->equ_track; ?>" class="form-control ctrl_<?php echo $usertrack->id; ?>" style="display:none;width: 210px;box-shadow: 3px 3px 3px 3px #888888;"   />
										</td>


										<td >
										<span class="txt_<?php echo $usertrack->id; ?>"><?php echo $usertrack->trans_track; ?>
										  <br />
										   <a href="<?php echo $usertrack->trans_link; ?>" target="_blank">Print Label</a>
										</span>
									  <input id="trans_track" name="exp_track" type="text"  value="<?php echo $usertrack->trans_track; ?>" class="form-control ctrl_<?php echo $usertrack->id; ?>" style="display:none;width: 210px;box-shadow: 3px 3px 3px 3px #888888;"   />
										</td>

										<td><?php echo $due_date; ?></td>
										<td>
										<a href="javascript:void();"  onclick="enableEdit('<?php echo $usertrack->id; ?>')" class="btn btn-success btn-xs editbutton_<?php echo $usertrack->id; ?>" >Edit
										</a>

										<button type="button" value="update" class="btn btn-success btn-xs updatebutton_<?php echo $usertrack->id; ?>" style="display:none" onclick="formsubmitbuttion('<?php echo $usertrack->id;  ?>')">Update</button>&nbsp;
										</td>
									  </tr>
										
							</tbody>
						   </table>
						</div>
				</div>
			</div>
      </div>
   </div>
	
	<!---15. BOT  --->
	
	
	<div class="default-according" id="accordion_bot">
      <div class="card">
           <h2 class="orderview-title" id="heading_bot" data-toggle="collapse" data-target="#collapse_bot">BOT</h2>
            <div class="collapse" id="collapse_bot" aria-labelledby="heading_bot" data-parent="#accordion_bot" style="">
                <div class="card-body">
					<table id="basic-5" role="table" width="100%" class="display">
					  <thead>
						<tr role="row">
							<th>Bot Name</th>
							<th>Link to run</th>
							<!-- <th>Link to place</th> -->
						</tr>
					  </thead>
						<tbody>
						  <tr>
							  <td>FTC Report</td>
							  <td><a class="btn bg-dark" style="color: white;" href="<?php echo site_url('Order/getFtcBotReport/'.$order_id);?>">Run FTC Report Manually</a></td> 
						  </tr>
						   <tr>
							  <td>USPS - Certified Mail Label Creator BOT</td>
							  <td><a class="btn bg-dark" style="color: white;" href="<?php echo site_url('Order/runbotusps/'.$user_id);?>">Run</a></td>
						  </tr>
						  
						  <tr>
							  <td>LexisNexis</td>
							  <td><a class="btn bg-dark" style="color: white;" href="<?php echo base_url("Order/runLexisnexis/".$user_id); ?>">Run</a></td>
							  <!-- <td><a class="btn-link" href="<?php //echo base_url("Order/lexisnexis/$Response->id"); ?>">Go</a></td> -->
						  </tr>
						  <tr>
							  <td>Innovis</td>
							  <td><a class="btn bg-dark" style="color: white;" href="<?php echo base_url("Order/runInnovis/".$user_id); ?>">Run</a></td>
							  <!-- <td><a class="btn-link" href="<?php //echo base_url("Order/innovis/$Response->id"); ?>">Go</a></td> -->
						  </tr>
					   </tbody>
					 </table>
				</div>
			</div>
      </div>
   </div>
	
	<!---16. Status UPDATE --->
	<div class="default-according" id="accordion_statusupdate">
      <div class="card">
           <h2 class="orderview-title" id="heading_statusupdate" data-toggle="collapse" data-target="#collapse_statusupdate">STATUS UPDATE</h2>
            <div class="collapse" id="collapse_statusupdate" aria-labelledby="heading_statusupdate" data-parent="#accordion_statusupdate" style="">
                <div class="card-body">
					YET to BE Update
				</div>
			</div>
      </div>
   </div>


<script type="text/javascript">

 function doconfirm()
{
  job=confirm("Are you sure to delete permanently?");
  if(job!=true)
  {
	return false;
  }
}


function printimage(img)
{
    var W = window.open(img);

    W.window.print();
}

</script>

<script type="text/javascript">

function enableEdit(frmid)
  {
    $(".txt_"+frmid).css({"display":"none"});
    $(".ctrl_"+frmid).css({"display":"block"});
    $(".editbutton_"+frmid).css({"display":"none"});
    $(".updatebutton_"+frmid).css({"display":"block"});
  }


function formsubmitbuttion(id)
{
      var exp_track = $('#exp_track').val();
      var equ_track = $('#equ_track').val();
            var trans_track = $('#trans_track').val();


  $.post("<?php echo base_url('order/updatetrack'); ?>",{id: id,exp_track:exp_track,equ_track:equ_track,trans_track:trans_track},function(html) 
    {
      window.location.reload();
    });
}



function chkFile(file1,filetype,custom_field_name) 
{
  $('#order_detail_id').val(filetype);
  $('#custom_field_name').val(custom_field_name);
  setTimeout(function(){ $('#submit').submit(); }, 1000);
}

/*******Save Bot Table **********/
 function saveBotdata(){
      // Get form
      var form = $('#savedispute')[0];
      // Create an FormData object 
      var data = new FormData(form);
      $.ajax({
		  url: '<?php echo base_url('Invoice/saveDisputemobileajax'); ?>',
		  type: "POST",
		  enctype: 'multipart/form-data',
		  data: data,
		  processData: false,
		  contentType: false,
		  cache: false,
		  timeout: 600000,
	  success: function(data)   // A function to be called if request succeeds
	  {
		window.location.reload();
	  }
      });
  }
function resetBotdata()
{
   var order_id = '<?php echo $order_id; ?>';
   var user_id = '<?php echo $orders->user_id; ?>';

  job=confirm("Are you sure to reset dispute items?");
  if(job!=true)
  {
    return false;
  }
  else
  {
    $.post("<?php echo base_url('Invoice/resetreport'); ?>",{order_id:order_id,user_id:user_id},function(data) 
    {
       window.location.reload();
    });
  }

} 

 function changereason(value,id)
 {
     $.post("<?php echo base_url('order/changereason'); ?>",{value:value},function(html) 
    {
     $('#'+id+'_instruction').html(html);
    });
 } 
 
 /*****Update dispute Data in bot Data *****/
 function getupdatepersonal(dispute_pf_id,value,field,orderId)
 {
   $.post("<?php echo base_url('Ajax/updateDisputePersonalInfo'); ?>",{dispute_pf_id: dispute_pf_id,value:value,field:field,order_id:orderId},function(data){
       
   });
 }
</script>


  <?php include_once ('bottom_content.php');
