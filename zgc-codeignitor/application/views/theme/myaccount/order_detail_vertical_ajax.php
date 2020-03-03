<style>#image-step { margin-bottom:25px;}</style>
<div class="page-body-wrapper">

  <div class="page-body">
    <div class="container-fluid">
      <div class="myaccount-profile">
	  
	   <?php if(isMobile()){?>
	   <div class="backButton-menu"> <i class="fa fa-chevron-left" aria-hidden="true"></i> <a href="<?php echo base_url('order/getOrderDetail/'.$orderId); ?>">BACK </a></div>
	  <div class="orderview-row">

	  	 <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 

	  		<div class="tab-content" id="myTabContent">

	  			 <div class="orderview-col row">
				<?php
					$c=1;

					$currentStep = 1;
					 $totalStepCount=0;

					foreach($dynamic_block as $getRes){
						$displayblock ='display:none;';
						$block_name 		= $getRes->block_name;
						$block_field_name	= str_replace(' ', '-', strtolower($block_name));
						$product_block_id 	= $getRes->block_id;
						$getcustom_fields 	= $getRes->custom_fields;
						$active='';
						if($c==1 && $currentStep==$c){
							$displayblock ='display:block;';
							$active='active show';
						}else if($currentStep==$c){
							$displayblock ='display:block;';
							$active='active show';
						}
						
						$module_selected 	= $getRes->module_selected;
						$submitBtn ='Submit';
						$btnType 	='submit';
						$btnTypeId  ='form_submit';
						$formId = $block_field_name;
						$onclickMethod='';
						$actionMethod='invoice/savestepmobile';
						if($module_selected=='identityiq'){
							$submitBtn ='Import Your Credit Report Now';
							$btnType ='button';
						//	$btnTypeId  ='identity_submit';
							$formId = 'indentityiqform';
							//$onclickMethod='onclick="checkindentityiq('.$c.')"';
						}else if($module_selected=='contract' && isMobile()){
							$actionMethod='invoice/saveContractmobile';
							$formId = 'contract';
							$btnType ='button';
						}
						else
						{
						     $formId ='singleupdate';	
						}
						
						if($product_block_id==8){
							$actionMethod='invoice/saveDisputemobile';
						}
					?>
	  
	<?php if($c==$stepno) { ?>
				<h2 class="orderview-title"> <?php echo $block_name; ?></h2>
				  <div class="order-details-content">
					  <div class="personal-Details">
					  <div class="row">
							<form id="<?php echo $formId; ?>" name="checkout-step<?php echo $c;?>" method="post" enctype="multipart/form-data" action="<?php echo base_url($actionMethod);?>"> 
								 <input type="hidden" name="orderId" value="<?php echo $orderId ;?>" />
								 <input type="hidden" name="totalsteps" value="<?php echo $totalStepCount ;?>" />
								 <input type="hidden" name="step" value="<?php echo $c ;?>" />
								<?php if(!empty($getcustom_fields) || $product_block_id==8){?>
									<input type="hidden" name="block_id" value="<?php echo $product_block_id ;?>" id="block_id" />	
									<input type="hidden" name="block_name" value="<?php echo $block_name ;?>" />
									<input type="hidden" name="block_field_name" value="<?php echo $block_field_name ;?>" />
									<input type="hidden" name="module_selected" value="<?php echo $module_selected ;?>" />
								  <?php } ?>
								  
							  <div class="row">
								<?php 
									if($product_block_id==8){
										echo $dispute_items;
										$submitBtn ='Submit';
									}else {
										if($module_selected=='contract' && isMobile()){
											echo $contract_sign_letter;
											$btnType ='button';
												$submitBtn ='Submit';
										}else{
										
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
									<input type="hidden" name="custom_block_field_id[]" value="<?php echo $PBC_field_id;?>" />
									<input type="hidden" name="fieldtype[]" value="<?php echo $fieldtype;?>" />
									<input type="hidden" name="fieldname[]" value="<?php echo $field_name;?>" />

								<div class="form-group col-12">
								  <label for="<?php echo $uniquelabel;?>"><?php echo $label_name;?></label>

								  <?php if($fieldtype=='textarea'){?>
										<textarea class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> <?php echo $lengthtext;?> placeholder="<?php echo $place_holder;?>" ><?php echo $valuetext;?> </textarea>
								  <?php }
									else if($fieldtype=='checkbox' || $fieldtype=='select' || $fieldtype=='multiple'){
										$option_fields 		= explode(',',$getCustomField->option_fields);
										
										if($fieldtype=='checkbox'){
											foreach($option_fields as $getOptionValue){
											$valuetext=$getOptionValue;
										?>
											<input class="form-control" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> value="<?php echo $valuetext;?>" <?php echo $lengthtext;?> />
											<?php echo $getOptionValue;?>
										<?php 
										}
										}
											if ($fieldtype=='select'){ ?>
										  <select class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> <?php echo $lengthtext;?>>
											<option value="">Select</option>
											<?php foreach($option_fields as $restype){?>
											<option value="<?php echo $restype;?>"><?php echo $restype;?></option>
											<?php } ?>
										  </select>
								  <?php }
										  if ($fieldtype=='multiple'){ ?>
										  <select class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> <?php echo $lengthtext;?> multiple="multiple">
											<option value="">Select</option>
											<?php foreach($option_fields as $restype){?>
											<option value="<?php echo $restype;?>"><?php echo $restype;?></option>
											<?php } ?>
										  </select>
								  <?php }
									}else if($fieldtype=='file'){
											if(!empty($valuetext) && !empty($valueExist)){
												$required='';
											}
											?>
											
						
											<div class="file-upload-wrapper card" style="background-color:#f0f8ff;">
												<input class="file-upload" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="<?php echo $PBC_field_id;?>_dynamic_file" <?php echo $required;?> <?php echo $lengthtext;?>  />
											</div>

										<?php if(!empty($valuetext) && !empty($valueExist)){?>
											<input type="hidden" name="<?php echo $PBC_field_id;?>_dynamic_filevalue" value="<?php echo $valuetext;?>" />
												<div class="col-lg-4">
												<div id="image-step">
												<?php
													$supported_image = array('gif','jpg','jpeg','png');
													$src_file_name = $valuetext;
													$ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
													if (in_array($ext, $supported_image)) {?>
													<div class="card" style="padding:15px;">
						<a href="<?php echo $valuetext;?>" target="_blank"><img class="card-img-top img-fluid" src="<?php echo $valuetext;?>" /></a>
													</div>
													</div>
													</div>
													<?php } else { ?>
														<a href="<?php echo $valuetext;?>" target="_blank">View</a>
													<?php }
											}
											?>
									<?php }else{ ?>
										<input class="form-control" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> value="<?php echo $valuetext;?>" placeholder="<?php echo $place_holder;?>" <?php echo $lengthtext;?> />
								  <?php } ?>
								</div>
										<?php } }?>
								
								<?php } ?>
							   
							   <div class="form-group col-lg-12"><button class="btn btn-primary" id="submitbutton"  <?php if($product_block_id==6) { ?> onclick="return timerhere('<?php echo $uniquelabel; ?>');" <?php } ?>  type="<?php echo $btnType;?>"  <?php if(($module_selected=='contract') && empty($contract_sign->sign)) { ?>  onclick="return submitsign('<?php echo $formId; ?>')"   <?php } ?>  > <?php echo $submitBtn;?></button></div>
							  </div>
							
							</form>

				</div>
				</div>
				</div>
			<?php } ?>	
                <?php $c++; } ?>
					  
				</div>
				</div>

  <?php if($stepno=='task') { ?>

<div id="step-<?php echo $stepno ;?>">
	<h4 class="order-card-title"> TASK <hr/></h4>
			<div class="row">
				<?php
				if($task){
					foreach($task as $key=>$tas){
						$start_date = date("m-d-Y", strtotime($tas->start_date));
						$due_date = date("m-d-Y", strtotime($tas->due_date));
						$assigned_to = orderusersname($order->user_id);
						if($tas->order_detail_ids!=0) 
							$tas_fields = getalltaskfields($tas->order_id,$tas->order_detail_ids);
						else
							$tas_fields ='nil'; 
						if(($tas->task_status==26 || $tas->task_status==27)){
							$tas_fields ='nil';  
						}
							$counter = $key+1;
				?>
				<div class="col-lg-6"> 
				<div class="custom-orderBox customTabs">
				<div class="custom-header">
				  <div class="row">
					  <div class="col-lg-12"> 
						  <div class="orderplaced-row">
							  <div class="order-col">
								  <p class="otitle"> Start Date </p>
								  <p class="osubtitle"> <?php echo $start_date; ?>	 </p>
							  </div>
							  <div class="order-col">
								  <p class="otitle"> Due Date </p>
								  <p class="osubtitle"> <?php echo $due_date; ?> </p>
							  </div>
						  </div>
					  </div>
				  </div>
				  </div>
				<div class="order-details-section">
					  <div class="row">
						  <div class="col-lg-9"> 
							<h2 class="order-title"> <?php echo $tas->task_subject; ?> </h2>
							  <div class="row productDetails">
								  <div class="col-lg-12"> 
								  <?php  if($tas_fields!='nil' ) {?>	
									 <h3> TASK FIELDS </h3>
									 <p> TASK FIELDS : <?php echo $tas_fields; ?> </p>
								 <?php } ?> 
									<p> Status : <?php echo $task_status[$tas->task_status]; ?> </p> 
									<p> Priority : <?php echo $priority_array[$tas->priority]; ?> </p> 
								  </div>
							  </div>
						  </div>
						  <div class="col-lg-3 d-flex"> 
							  <div class="order-btn-group">
								  <?php  if($tas_fields!='nil') {?>	
								  <a href="javascript:void(0);" class="btn btn-orderDetails" onclick="showselectpopup('<?php echo $order->order_id; ?>','<?php echo $order->product_id; ?>','<?php echo $tas->order_detail_ids; ?>')"> Fix Now </a>
								  <?php } ?> 
							
							  </div>
						  </div>
					  </div>
				  </div>
				</div>	   
				</div>
				<?php  } } ?>   
				</div>
  </div>

  <?php } ?>


    <?php if($stepno=='notes') { ?>

	 <div class="orderview-col row">
	 <h2 class="orderview-title"> Notes <a href="#" class="pull-right"  data-toggle="modal" data-target="#createnotes" > Add New Notes </a> </h2>
	 				  <?php
								if($notes){
									foreach ($notes as $key => $value) {
									$date = date("m/d/Y", strtotime($value->datetime));
									$small = substr($value->notes, 0, 45).'...';
									?>
				<div class="col-lg-6"> 
				<div class="custom-orderBox customTabs">
				<div class="custom-header">
				  <div class="row">
				  <div class="col-lg-12"> 
				  <div class="orderplaced-row">
				  <div class="order-col">
				  <p class="otitle"> <?php //echo $value->subject; ?></p>
				  </div>
				  </div>
				  </div>
				  </div>
				  </div>
				<div class="order-details-section">
				  <div class="row">
				  <div class="col-lg-9"> 
				  <h2 class="order-title"><?php echo $value->subject; ?>  </h2>
				  <div class="row productDetails">
				  <div class="col-lg-12"> 
				    <p> Description :  <?php echo $value->notes;?></p>  
				    <p>Date & Time : <?php echo $date; ?></p>
				  </div>
				  </div>
				  </div>
				  <div class="col-lg-3 d-flex"> 
				  <div class="order-btn-group">
				  </div>
				  </div>
				  </div>
				  </div>



			<?php 
$replyData = $notes[$key]->reply_support_list;

			if(!empty($replyData)){
			foreach($replyData as $getResponse){
			$replyMsg 		= $getResponse->message;
			$replyusername 	= orderusersname($getResponse->user_id);
			$replyDate 		= date('m/d/Y H:i:s',strtotime($getResponse->created_date));?>

			<div class=""> 

			<div class="col-lg-12">
			<div class="productDetails"> <hr/>Reply : <?php echo $replyMsg?> </div> <br/>
			<br>
			<?php echo $replyDate;?> 
			<br/>
			<?php echo $replyusername;?>


			</div>	</div>	

			<?php } ?>


			<?php } ?>
			<?php   //if(count($replyData)>0) { ?>
			 <div class="order-btn-group">
				  <a href="javascript:void(0);" class="btn btn-orderDetails" onclick="replynotes('<?php echo $value->notes_id;  ?>');" style="margin-top:10px;float:right;width:25%;"> Reply </a>

			</div>
			<?php //} ?>



				  
				</div>	   
				</div>

				<?php } } ?> 

	</div>

	<?php } ?>
	  
	   <?php if($stepno=='support') { ?>


<div>
	<h4 class="order-card-title"> Support <hr/></h4>
		<div class="row">
				<div class="col-lg-4 col"> <h2 class="tab-title"> Support </h2> </div>
				<div class="col-lg-8 col"> <a href="javascript:void(0);"  data-toggle="modal" data-target="#createticket" class="btn btn-info addNew mbot25 pull-right">Add New ticket</a> </div>
			</div>		 
	 
				<?php
				$prionrityhere= [];
				if($priority)
				{
				foreach ($priority as $key => $value) 
				{
				$prionrityhere[$value->id] = $value->priority;	
				}
				}
				?>
							<div class="row">
									  <?php
										 if($support)
										 {
										   foreach($support as $key=>$supp)
										   {
										   	$date = date("m/d/Y", strtotime($supp->datetime));

				$priority = ($prionrityhere[$supp->priority])?$prionrityhere[$supp->priority]:'';

				$status = ($support_status[$supp->status])?($support_status[$supp->status]):'';
										 ?>
				<div class="col-lg-6"> 
				<div class="custom-orderBox customTabs">
				<div class="custom-header">
				  <div class="row">
				  <div class="col-lg-12"> 
				  <div class="orderplaced-row">
				  <div class="order-col">
				  <p class="otitle"> <?php //echo $supp->subject; ?></p>
				  </div>
				  </div>
				  </div>
				  </div>
				  </div>
				<div class="order-details-section">
				  <div class="row">
				  <div class="col-lg-9"> 
				  <h2 class="order-title"><?php echo $supp->subject; ?>  </h2>
				  <div class="row productDetails">
				  <div class="col-lg-12"> 
				<p> Priority : <?php echo $priority; ?> </p> 
				<p> Status :  <?php echo $status; ?> </p>
				<p> Department :  <?php echo getdepartment($supp->department);?></p>
				<p> Description :  <?php echo $supp->description;?></p>  
				<p>Date & Time : <?php echo $date; ?></p>
				  </div>
				  </div>
				  </div>



				  			<?php 
$replyData = $support[$key]->reply_support_list;

			if(!empty($replyData)){
			foreach($replyData as $getResponse){
			$replyMsg 		= $getResponse->message;
			$replyusername 	= orderusersname($getResponse->user_id);
			$replyDate 		= date('m/d/Y H:i:s',strtotime($getResponse->created_date));?>
			<div class="col-lg-12">
			<div class="productDetails"> <hr/>Reply : <?php echo $replyMsg?> </div> <br/>
			<?php
			if($getResponse && $getResponse->image!='')
			{
			?>
			<img id="image_upload_preview" src="<?php echo $getResponse->image; ?>" alt="your image" height="100" width="100"/>
			<?php } ?>
			<br>
			<?php echo $replyDate;?> 
			<br/>
			<?php echo $replyusername;?>


			</div>
			<?php } ?>


			<?php } ?>



				  <div class="col-lg-3 d-flex"> 
				  <div class="order-btn-group">
				  <a href="javascript:void(0);" class="btn btn-orderDetails" onclick="replysupport('<?php echo $supp->support_id; ?>');"> Reply </a>
					<!-- <a target="_blank"  onclick="loadsupport('<?php echo $supp->support_id;  ?>','<?php echo base_url('support/save'); ?>');"  class="btn btn-orderDelete"> Update </a>-->

					<!--<a   href="javascript:void(0);" onclick="return deletesupportreply('<?php echo $supp->support_id; ?>');"  class="btn btn-orderDelete"> Delete </a>-->

				  </div>
				  </div>
				  </div>
				  </div>
				  
				</div>	   
				</div>

				<?php } } ?> 

				</div> 
  </div>

	<?php } ?>

	  </div>
	  <?php }else { ?>
	coming soon...
	  <?php } ?>
	  
	  </div>
	  </div>
	  </div>
	  </div>
	  
<!---pop up for task starts here--->
<div class="modal fade" id="exampleModaldynamicfield" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div id="loadedittaskdynamicfield" style="padding-top:200px;"></div>
  </div>
</div>

<div class="modal fade" id="createticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog" role="document" style="margin-top: 320px;">
  <form name="addsupport" id="addsupport" method="POST" action="<?php echo base_url('Support/save')?>"  enctype="multipart/form-data">

    <input type="hidden" name="order_id" value="<?php echo $order->order_id; ?>">

        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Add New Ticket </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
     
        <div class="form-group">
        <label for="name"> Subject </label>
        <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required="required" data-original-title="" title="">
        </div>

        <div class="form-group">
        <label for="name"> Priority </label>
      <select class="custom-select" name="priority" id="priority" required="required">
      <option value="" >--Select Priority--</option>
      <?php
      if($prionrityhere)
      {
      foreach ($prionrityhere as $key => $value) 
      {
      ?>
      <option value="<?php echo  $key; ?>" ><?php echo  $value; ?></option>
      <?php } } ?>
      </select>
        </div>

        <input type="hidden" name="status" id="status" value="13">


       <!-- <div class="form-group">
        <label for="name"> Status </label>
        <select class="custom-select" name="status" id="status">
        <option value=""> Choose One...</option>
        <?php foreach($support_status as $keysup=>$supp) { ?>
          <option value="<?php echo $keysup; ?>"><?php echo $supp; ?></option>
        <?php } ?>
        </select>
        </div>-->

        <div class="form-group">
        <label for="name"> Department </label>
        <select class="custom-select" name="department" id="department" onclick="chanagerelate(this.value)">
        <option value=""> Choose One...</option>
         <?php foreach($support_depart as $supp) { ?>
        <option value="<?php echo $supp->id; ?>"><?php echo $supp->dept; ?></option>
         <?php } ?>
        <option value="custom">Custom</option>
        </select>
        </div>

         <div class="form-group" id="showdept" style="display: none;">
      <input class="form-control" id="dept" name="dept" type="text" placeholder="Department" data-original-title="" title="">
         </div>
            

        <div class="form-group">
        <label for="name"> Description </label>
        <textarea  class="form-control" id="description" name="description"  required="required"></textarea>
        </div> 


        <div class="form-group">
        <label for="name"> Attach Files </label>
         <input type="file" name="image" id="image"  class="form-control" >
        </div> 

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit" >Save changes</button>
        </div>
        </div>
      </form>
        </div>
        </div>

<div class="modal fade" id="createnotes" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
  <form name="addCMS" id="addnotes" action="<?php echo base_url('Notes/save')?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="order_id" value="<?php echo $order->order_id; ?>">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Add New Notes </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            
        <div class="form-group">
        <label for="name"> Subject </label>
        <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required="required" data-original-title="" title="">
        </div>

        <div class="form-group">
        <label for="name"> Description </label>
        <textarea  class="form-control" id="notes" name="notes"  required="required" rows="6" cols="100"></textarea>
        </div> 

        </div>
        <div class="modal-footer">
  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
        </div>

    </form>
  </div>
</div>
	

<script>
$(document).ready(function(){
  $("#reply").click(function(){
    $("#openfield").fadeToggle();
  });
});


$("#singleupdate").on('submit',(function(e) {
e.preventDefault();

var block_id = $('#block_id').val();

if(block_id==7)
{
if($("#terms").prop('checked') == true)
{
  // Get form
var form = $('#singleupdate')[0];
var action = $('#singleupdate').attr('action');
// Create an FormData object 
var data = new FormData(form);
$.ajax({
url: action,
type: "POST",
enctype: 'multipart/form-data',
data: data,
processData: false,
contentType: false,
cache: false,
timeout: 600000,
success: function(data)   // A function to be called if request succeeds
{
	if(data=='success')
	{
		alert('Data saved successfully');
	}
}
});
}
else
{
	alert('Please read contract and then sign');
	return false;
}	
}
else
{

  // Get form
var form = $('#singleupdate')[0];
var action = $('#singleupdate').attr('action');
// Create an FormData object 
var data = new FormData(form);
$.ajax({
url: action,
type: "POST",
enctype: 'multipart/form-data',
data: data,
processData: false,
contentType: false,
cache: false,
timeout: 600000,
success: function(data)   // A function to be called if request succeeds
{
	if(data=='success')
	{
		alert('Data saved successfully');
	}
}
});

}

}));


</script>
<style type="text/css">
.order-details-content
{
	padding: 30px;
}
.fade:not(.show)
{
	opacity: 1;
}
.modal-dialog
{
	margin-top: 200px;
}	
</style>

<div id="divLoading" class="orderstatu-loading">
<div class="loadingBox">
<img src="<?php echo base_url('assets/images/loading.gif'); ?>" style="width:100px;">
<span id="timer" class="timer"></span>
<p class="loaderContent"> Please be patient as this process <br> 
can take you 1-2 minutes to complete.... </p>  
</div></div>     


    
<script>
var count=0;

function timerhere(field)
{
    var field1 = $('#'+field).val();

    if(field1=='')
    {
      alert('Please fill all the fields');
      return false;
    }
    else
    {
     $('#divLoading').show();
      count= 90;
      var counter=setInterval(timer, 1000); 
      setTimeout(function(){

var form = $('#singleupdate')[0];
var action = $('#singleupdate').attr('action');
// Create an FormData object 
var data = new FormData(form);
$.ajax({
url: action,
type: "POST",
enctype: 'multipart/form-data',
data: data,
processData: false,
contentType: false,
cache: false,
timeout: 600000,
success: function(data)   // A function to be called if request succeeds
{
	if(data=='success')
	{
		$('#divLoading').css('display','none');
		alert('Data saved successfully');
	}
}
});




       }, 90000);
    }
}
</script>

<script type="text/javascript">
function timer()
{
  count=count-1;
  if (count <= 0)
  {
     clearInterval(counter);
     //counter ended, do something here
     return;
  }

  //Do code for showing the number of seconds here
}

function timer()
{
  count=count-1;
  if (count <= 0)
  {
     clearInterval(counter);
     return;
  }

 document.getElementById("timer").innerHTML=count + " secs"; // watch for spelling
}


function showselectpopup(orders_id,product_id,product_block_id)
{
  $.post("<?php echo base_url('projects/getproductcustomfieldsfixnow'); ?>",{orders_id:orders_id,product_id:product_id,product_block_id:product_block_id},function(data) 
    {
      $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    });
}


function replysupport(support_id)
{
	 $.post("<?php echo base_url('Support/replyus'); ?>",{support_id:support_id},function(data) 
    {
      $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    });
}


function deletesupportreply(support_id)
{
  job=confirm("Are you sure to delete permanently?");
  if(job!=true)
  {
    return false;
  }
  else
  {
    $.post("<?php echo base_url('support/deletesupportreply'); ?>",{support_id:support_id},function(data) 
    {
          $('#exampleModaldynamicfield').modal('hide');
     
    }); 
  }
}



function  deletenotesreply(notes_id)
{
	job=confirm("Are you sure to delete permanently?");
  if(job!=true)
  {
    return false;
  }
  else
  {
    $.post("<?php echo base_url('notes/deletenotesreply'); ?>",{notes_id:notes_id},function(data) 
    {          
   
    }); 
  }
}


function replynotes(notes_id)
{
   $.post("<?php echo base_url('Notes/replynotes'); ?>",{notes_id:notes_id},function(data) 
    {
      $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    });
}



function loadnotesview(notes_id)
{
    $.post("<?php echo base_url('notes/loadnotesview'); ?>",{notes_id:notes_id},function(data) 
    {
           $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    }); 
}


$("#addsupport").on('submit',(function(e) {
e.preventDefault();
// Get form
var form = $('#addsupport')[0];
// Create an FormData object 
var data = new FormData(form);
$.ajax({
url: "<?php echo base_url('Support/save');?>",
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
       //$('#createticket').modal('hide');

}
});
}));




$("#addnotes").on('submit',(function(e) {
e.preventDefault();
// Get form
var form = $('#addnotes')[0];
// Create an FormData object 
var data = new FormData(form);
$.ajax({
url: "<?php echo base_url('Notes/save');?>",
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
      // $('#createnotes').modal('hide');

}
});
}));
</script>
