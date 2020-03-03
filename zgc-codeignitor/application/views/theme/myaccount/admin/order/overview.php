<style>
form#singleupdate, form#indentityiqform {
    width: 100%;
}
.horizontal-steeper {
    width: 100%;
}
.form-group.col-lg-4 {
    margin: 0 auto;
}
.row .row {
    margin: 0 auto !important;
}
.form-group.submis-btn {
    margin: 0 auto;
    width: 100%;
    text-align: center;
}
.form-group.submis-btn button {
    background: #1e73be;
    color: #fff;
    border: 0;
    padding: 8px 30px;
    font-weight: bold;
}
img.card-img-top {
    width: 100px;
}
.form-group.submis-btn button:hover {
	opacity: .8;
}
.section-contract1 .col-lg-12{
    padding: 0px;
}
.section-contract1 .iddocuemnt-col {
    margin-top: 20px;
}
.card {
    padding-bottom: 30px;
}
.section-contract1 .btn-group {
    margin-bottom: 10px;
}
form#indentityiqform .form-group.submis-btn button, form#singleupdate .form-group.submis-btn button {
    margin-top: 20px;
}
.vertical-menu-mt .card.overview-project {
    margin-bottom: 0;
    padding-bottom: 0;
}
/**/
@media (min-width: 768px) and (max-width: 1560px){
	
}
</style>  
  <?php include_once ('top_content.php'); ?>
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/projectoverivew.css" />
  <?php
      $product_name = (isset($orders->product_name))?$orders->product_name:'';
      $user_id = (isset($orders->user_id))?$orders->user_id:''; 
      $order_amount = (isset($orders->order_amount))?$orders->order_amount:''; 
      $broker_amount = (isset($orders->product_name))?$orders->broker_amount:''; 
      $product_name = (isset($orders->product_name))?$orders->product_name:'';  
  ?>
  <?php
	  $clientdetailscheck = clientdetails($orders->user_id);
	  $clientdetails = $clientdetailscheck[0];
	  $phone = (isset($clientdetails->phone))?$clientdetails->phone:'Nil';
	  $brokernamecheck = orderusersname($clientdetails->parent_user_id);
	  $brokername = ($brokernamecheck)?$brokernamecheck:'Nil';
	  $brokerphone = getphonenumbers($clientdetails->parent_user_id);
	  $siteurl = getsitename($clientdetails->parent_user_id);
  ?>

<div class="container-fluid">
	<div class="card">
		  <div class="card-header">
			  <div class="row">
				  <div class="col-lg-12">
						<div class="row">
							<div class="col-lg-6">Broker Name: <strong><?php echo $brokername; ?></strong></div>
							<div class="col-lg-6">Broker Phone: <strong><?php echo $brokerphone; ?></strong></div>
						</div>
						<div class="row">
							<div class="col-lg-6">Client Name: <strong><?php echo orderusersname($user_id); ?></strong></div>
							<div class="col-lg-6">Client Price: <strong>$<?php echo $order_amount; ?></strong></div>
						</div>
						<div class="row">
							<div class="col-lg-6">Payment Method: <strong><?php echo $orders->payment_method; ?></strong></div>
							<div class="col-lg-6">Client Phone: <strong><?php echo $phone; ?></strong></div>
						</div>
				  </div>
			  </div>
		  </div>
		  <div class="card-body">
		  <div class="row">
			<?php if(!empty($dynamic_block)){
					$currentStep = isset($_GET['step']) ? $_GET['step'] :1;
					$identityIqFlag  = isset($_GET['identityIq']) ? $_GET['identityIq'] :0;
					  $totalblock = count($dynamic_block);
					?>
			<div class="col-lg-12 col-sm-12"> 
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			   <?php
				   $totalStepCount=0;
					$b=1;
					foreach($dynamic_block as $getRes){
						$class ='nav-link deselected';
						$block_name 		= $getRes->block_name;
						$block_field_name	= str_replace(' ', '-', strtolower($block_name));
						$product_block_id 	= $getRes->block_id;
						$getcustom_fields 	= $getRes->custom_fields;
						$active='';
						if($b==1 && $currentStep==$b){
							$class ='nav-link selected';
							$active='active';
						}else if($currentStep==$b){
							$class ='nav-link selected';
						}?>
						<li> <a class="nav-link <?php echo $class;?> <?php echo $active;?>" id="stepmenu_<?php echo $b ;?>" data-toggle="tab" href="#step-<?php echo $b ;?>" role="tab" onclick="stepno(<?php echo $b ;?>,'<?php echo $totalblock;?>')" aria-controls="profile" aria-selected="false"><?php echo $b; ?> - <?php echo $block_name ;?></a> </li>
						
					<?php $totalStepCount+=1;
					$b++;} ?>

			</ul>
		
		<div class="tab-arrow-group">
			<div class="tab-next-arrow"> <i class="fa fa-chevron-left" aria-hidden="true"></i> </div>
			<div class="tab-next-prev"> <i class="fa fa-chevron-right" aria-hidden="true"></i>  </div> 
		</div>
		<div class="tab-content" id="myTabContent">
		<?php
		$c=1;
		$currentStep = 1;
		$totalStepCount=0;

		foreach($dynamic_block as $getRes){
			//$displayblock ='display:none;';
			$block_name         = $getRes->block_name;
			$block_field_name   = str_replace(' ', '-', strtolower($block_name));
			$product_block_id   = $getRes->block_id;
			$getcustom_fields   = $getRes->custom_fields;
			$active='';
			if($c==1 && $currentStep==$c){
				$displayblock ='display:block;';
				$active='active show';
			}/*else if($currentStep==$c){
				$displayblock ='display:block;';
				$active='active show';
			}*/
			
			$module_selected    = $getRes->module_selected;
			$submitBtn ='Submit';
			$btnType    ='submit';
			$btnTypeId  ='form_submit';
			$formId = $block_field_name;
			$onclickMethod='';
			$actionMethod='invoice/savestepmobile';
			if($module_selected=='identityiq'){
				$submitBtn ='Import Your Credit Report Now';
				$btnType ='button';
			//  $btnTypeId  ='identity_submit';
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
				 <div class="tab-pane fade <?php echo $active;?>" id="step-<?php echo $c ;?>" role="tabpanel" aria-labelledby="profile-tab">
					<div class="col-lg-12 checklist-padd"> 
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
							 $submitBtn ='SAVE';
							}else{
								echo 'IdentityIQ Report Not Found';
								$disputeflag=1;
							}
						}else {
							if($module_selected=='contract' && isMobile()){
								echo $contract_sign_letter;
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
								}else if($fieldtype=='file'){
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
									
							
										
								<?php }else{ 
									?>
									<input class="form-control" <?php echo $onkey; ?> id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> value="<?php echo $valuetext;?>" placeholder="<?php echo $place_holder;?>" <?php echo $lengthtext;?> />
							  <?php } ?>
							</div>
							<?php } 
							}?>
							
						<?php } ?>
								<div class="form-group col-lg-12">
								<?php if($product_block_id==6) { ?>		
										<!--onclick="return timerhere('<?php //echo $uniquelabel;?>')"-->
									<button class="btn btn-primary" id="<?php echo $btnTypeId; ?>"  type="<?php echo $btnType;?>"> <?php echo $submitBtn;?></button>
									
								<?php }else if($module_selected=='contract' && isMobile() && empty($contract_sign->sign)){ ?>
										<button class="btn btn-primary" id="<?php echo $btnTypeId; ?>" onclick="return submitsign('<?php echo $formId;?>')"  type="button"> <?php echo $submitBtn;?></button>
								<?php }else { 
										if($disputeflag!=1){										
										?>
											<button class="btn btn-primary" id="<?php echo $btnTypeId; ?>" type="<?php echo $btnType;?>"> <?php echo $submitBtn;?></button>
										<?php }
										} ?>
								</div>
						  </div>
						</form>
					
					</div>
				</div>
			
		<?php $c++; } ?>
		</div>
		
		</div>
			<?php } ?>
		</div>
		</div>
	</div>
</div>

<script src="<?php echo ASSETSPATH; ?>js/jquery-3.2.1.min.js"></script>
<script>
$('#selectAll2').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectall').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectall').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 


function stepno(stepId,totalsteps)
{
	for(var i=1;i<=totalsteps;i++){
		if(i==stepId){
			$('#step-'+stepId).show();
			$('#step-'+stepId).addClass('show');
			$('#stepmenu_'+stepId).removeClass();
			$('#stepmenu_'+stepId).addClass('selected');
		}else{
			$('#step-'+i).hide();
			$('#stepmenu_'+i).removeClass();
			$('#stepmenu_'+i).addClass('nav-link deselected');
		}
	}
}

function stepnocontact(stepId,totalsteps)
{
	stepno(stepId,totalsteps);
	$('#step-'+stepId).show();
	$('#stepmenu_'+stepId).removeClass();
	$('#stepmenu_'+stepId).addClass('selected');
	
	
}

function readURL(input,path) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#'+path).attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

</script>

<script>
  $( function() {
	  
	$('.file-upload').file_upload();
	  
    var progressbar = $( "#progressbar" ),
      progressLabel = $( ".progress-label" );
 
    progressbar.progressbar({
      value: false,
      change: function() {
        progressLabel.text( progressbar.progressbar( "value" ) + "%" );
      },
      complete: function() {
        progressLabel.text( "Complete!" );
      }
    });
 
    function progress() {
      var val = progressbar.progressbar( "value" ) || 0;
 
      progressbar.progressbar( "value", val + 2 );
 
      if ( val < 99 ) {
        setTimeout( progress, 80 );
      }
    }
 
    setTimeout( progress, 2000 );
  } );
  </script>

<style type="text/css">
 #sign-pad
 {
  height: 175px !important;
  width: 400px !important;
 } 
</style>
  <!-- Small modal-->

<div id="divLoading" class="orderstatu-loading">
	<div class="loadingBox">
		<img src="<?php echo base_url('assets/images/loading.gif'); ?>" style="width:100px;">
		<span id="timer" class="timer"></span>
		<p class="loaderContent"> Please be patient as this process <br> can take you 2-4 minutes to complete.... </p>  
	</div>
</div>

<script>
var count=0;

<?php if(isset($_GET['identityIq'])==1 && $isdisputeflag==0){?>
showloading();
<?php } ?>
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
      count= 1;
      var counter=setInterval(timer, 60000); 
      setTimeout(function(){ $('#indentityiqform').submit(); }, 60000);
    }
}
function showloading(){
	$('#divLoading').show();
	count= 2;
	var counter=setInterval(timer, 60000); 
	setTimeout(function(){ window.location.reload(true); }, 120000);
}
</script>
<script type="text/javascript">


function timer()
{
  count=count-1;
  if (count <= 0)
  {
     clearInterval(counter);
     return;
  }

 document.getElementById("timer").innerHTML=count + " minutes"; // watch for spelling
}
</script>


<script>
function isNumberKey(evt)
  {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode != 45  && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

     return true;
  }

function addDashesssn(f) {
  var r = /(\D+)/g,
  npa = '',
  nxx = '',
  last4 = '';
  f.value = f.value.replace(r, '');
  npa = f.value.substr(0, 3);
  nxx = f.value.substr(3, 2);
  last4 = f.value.substr(5, 4);
  f.value = npa + '-' + nxx + '-' + last4;
}

function addDashesphone(f) {
  var r = /(\D+)/g,
  npa = '',
  nxx = '',
  last4 = '';
  f.value = f.value.replace(r, '');
  npa = f.value.substr(0, 3);
  nxx = f.value.substr(3, 3);
  last4 = f.value.substr(6, 3);
  f.value = npa + '-' + nxx + '-' + last4;
}

function addDashesdob(f)
{
  var r = /(\D+)/g,
  npa = '',
  nxx = '',
  last4 = '';
  f.value = f.value.replace(r, '');
  npa = f.value.substr(0,2);
  nxx = f.value.substr(2,2);
  last4 = f.value.substr(4, 3);
  f.value = npa + '/' + nxx + '/' + last4;
}

function printimage(img)
{
    var W = window.open(img);

    W.window.print();
}

<?php if($this->session->flashdata('msg')) { ?> 
	$(document).ready(function(){
		//$('#myModal').modal({backdrop: 'static', keyboard: false})  
		$("#myModal_message").modal();
	});
<?php } ?>

</script>



<div class="modal orderstep-status" id="myModal_message">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header"><?php if($this->session->flashdata('msg')) { ?> <?php echo $this->session->flashdata('msg');?><?php } ?><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button></div>
	  </div>
	</div>
</div>
  
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<?php include_once ('bottom_content.php'); ?>


