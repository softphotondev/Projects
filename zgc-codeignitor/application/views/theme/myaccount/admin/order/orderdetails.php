<style>
.myaccount-profile, .tab-content, .orderview-col { padding-top:0; margin:0;}
.myaccount-profile { padding:0px 25px;}
.order-details-content .form-group { border:none !important;}
.contractBlock h4 { font-size: 17px;
text-transform: uppercase;
font-weight: 600;
margin-bottom: 15px;}
.iddocuemnt-col{ margin-bottom:15px;} 
.btnview, .btnsubmit { 
background:#2b449c;
color:#fff;
text-transform: uppercase;
font-weight: 600;
font-size: 14px;
margin-top: 15px;
display: inline-block;
padding: 5px 25px; } 
.btnsubmit { background:#de0e0e;
border:none;
margin: 0;
padding: 5px 18px !important;
font-weight: 700; }
</style>

<?php include_once ('top_content.php'); ?>

<div class="page-body-wrapper">
  <div class="page-body" style="margin:0; padding:0; background:none !important;">
      <div class="myaccount-profile">
      <div class="orderview-row">
            <div class="tab-content" id="myTabContent">
                 <div class="orderview-col row">
                <?php
                    $c=1;

                    $currentStep = 1;
                     $totalStepCount=0;

                    foreach($dynamic_block as $getRes){
                        $displayblock ='display:none;';
                        $block_name         = $getRes->block_name;
                        $block_field_name   = str_replace(' ', '-', strtolower($block_name));
                        $product_block_id   = $getRes->block_id;
                        $getcustom_fields   = $getRes->custom_fields;
                        $active='';
                        if($c==1 && $currentStep==$c){
                            $displayblock ='display:block;';
                            $active='active show';
                        }else if($currentStep==$c){
                            $displayblock ='display:block;';
                            $active='active show';
                        }
                        
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
      
    <?php if($c==$stepno) { ?>
          <h2 class="orderview-title"> <?php echo $block_name; ?></h2>
          <div class="order-details-content">
          <div class="personal-Details">
          <div class="row">

   <?php if($product_block_id!=8){?>
    <form class="sss" id="<?php echo $formId; ?>" name="checkout-step<?php echo $c;?>" method="post" enctype="multipart/form-data" action="<?php echo base_url($actionMethod);?>"> 
            <?php } ?>
           <input type="hidden" name="orderId" value="<?php echo $orderId ;?>" />
           <input type="hidden" name="totalsteps" value="<?php echo $totalStepCount ;?>" />
           <input type="hidden" name="step" value="<?php echo $c ;?>" />
           <?php if(!empty($getcustom_fields) || $product_block_id==8){?>
           <input type="hidden" name="block_id" value="<?php echo $product_block_id ;?>" id="block_id" /><input type="hidden" name="block_name" value="<?php echo $block_name ;?>" />
           <input type="hidden" name="block_field_name" value="<?php echo $block_field_name ;?>" />
           <input type="hidden" name="module_selected" value="<?php echo $module_selected ;?>" />
          <?php } ?>
                                  
      <div class="row">
        <?php 
            if($product_block_id==8){
              ?>
          <div class="horizontal-steeper">
            <?php
            $order_id = $orders->order_id;
            $personalInfo = $dispute_items['personalInfo'];
            $creditInquiry = $dispute_items['creditInquiry'];
            $accountHistory = $dispute_items['accountHistory'];
            $selectedDisputeItem = $dispute_items['selectedDisputeItem'];
            if(isset($selectedDisputeItem['creditInquiry']))
            {
              $creditselected =[];
              foreach($selectedDisputeItem['creditInquiry'] as $credit)
              {
                 $creditselected[] = $credit->dispute_creditInq_id;
              }
            }
            if(isset($selectedDisputeItem['accountHistoryselected']))
            {
                $disputeitems =[];
                foreach($selectedDisputeItem['accountHistoryselected'] as $dispute)
                {
                $disputeitems[] = $dispute['dispute_account_id'];
                }
            }

            ?>
    <div>
    <div>
    <div class="card fullwidth-col personalProfile" >
      <div >
         <button type="button" class="btn btn-success" onclick="resetdata()" > Reset Data </button>
         <button type="button" class="btn btn-success" onclick="savedata()" > Save Data </button>
      </div>
      <div>
        <form id="savedispute">
          <input type="hidden" name="orderId" id="orderId" value="<?php echo $orders->order_id;  ?>">
          
            <input type="hidden" name="notcheck_reason" value="1">

              <div class="disputeItem-row">  
              <div class="personal-profile-desktop">
              <h2> PERSONAL PROFILE </h2>
              <table class="table">
                <thead>
                  <tr>
                    <th>Company</th>
                    <th>Name</th>
                    <th>Also Known As </th>
                    <th>Year of Birth</th>
                   <th>Address</th>
                  </tr>
                </thead>
                <tbody>
                 <?php 
                 foreach($personalInfo as $perinfo){
                  $id  = $perinfo->id;
                  if(isset($selectedDisputeItem['personalInfo']->$id)){
                    $is_name_checked = $selectedDisputeItem['personalInfo']->$id->is_name_checked;
                    $is_dob_checked = $selectedDisputeItem['personalInfo']->$id->is_dob_checked;
                    $is_knows_checked = $selectedDisputeItem['personalInfo']->$id->is_knows_checked;
                    $addressarray = json_decode($selectedDisputeItem['personalInfo']->$id->address);
                  }
                  else{
                     $is_name_checked = $is_dob_checked = $is_knows_checked='';
                     $addressarray = [];
                  }
                  ?>
                  <tr role="row">
                  <td valign="middle" data-label="Company"><?php echo strtoupper($perinfo->company_name); ?></td>
                  <td valign="middle" data-label="Name"> 
                   <input type="hidden" name="personal_profile[]" value="<?php echo $perinfo->id; ?>" />
                    <input name="is_name_checked[<?php echo $perinfo->id; ?>]" type="checkbox" value="1" <?php if($is_name_checked==1){ echo 'checked';}?> onClick="getupdatepersonal('<?php echo $perinfo->id; ?>','<?php echo $perinfo->is_name_checked; ?>','name','<?php echo $order_id;?>')"> <?php echo $perinfo->name; ?></td>
                    
                  <td valign="middle" data-label="Also Known As">  <input name="is_knows_checked[<?php echo $perinfo->id; ?>]" type="checkbox" value="1" <?php if($is_knows_checked==1){ echo 'checked';}?> onclick="getupdatepersonal('<?php echo $perinfo->id; ?>','<?php echo $perinfo->knownas; ?>','knownAs','<?php echo $order_id;?>')"><?php echo $perinfo->knownas; ?> </td>
                  
                  <td valign="middle" data-label="Year of Birth">
                  <input name="is_dob_checked[<?php echo $perinfo->id; ?>]" type="checkbox" value="1" <?php if($is_dob_checked==1){ echo 'checked';}?> onclick="getupdatepersonal('<?php echo $perinfo->id; ?>','<?php echo $perinfo->dob; ?>','dob','<?php echo $order_id;?>')"><?php echo $perinfo->dob; ?> </td>
                  <td valign="middle" data-label="Address" class="td-address"> 
                  <?php   
                    if(!empty($perinfo->address) && isset($perinfo->address)){
                      $address =@json_decode($perinfo->address) ?? [];
                      if(!empty($perinfo->address)){
                      foreach($address as $newkey=>$getaddress){
                      ?>
                        <address class="pfaddress">
                        <input name="address[<?php echo $perinfo->id; ?>][<?php echo $getaddress->id;?>]" type="checkbox" value="<?php echo $getaddress->id;?>" <?php if(isset($addressarray[$newkey]) && $addressarray[$newkey]->checked==1){ echo 'checked';}?> onclick="getupdatepersonal('<?php echo $perinfo->id; ?>','<?php echo $getaddress->id;?>','address','<?php echo $order_id;?>')"><?php echo $getaddress->text;?></address>
                      <?php } 
                      }
                    }?>
                   </td>
                </tr>
                 <?php } ?>
                </tbody>
              </table>
              </div>

              <div class="personal-profile-desktop">
              <h2> CREDIT INQUIRIES </h2>
              <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"> <button type="button" class="btn btn-success" id="selectcredit"> Select All </button>
                            </th>
                            <th scope="col"> Company </th>
                             <th scope="col"> Bureua </th>
                            <th scope="col"> Date </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($creditInquiry as $key => $creinfo){

                        if(in_array($creinfo->dispute_creditInq_id,$creditselected))
                        $checked ='checked';
                        else
                        $checked ='';
                          ?>
                                  <tr>
                               <td data-label="Select"> <input name="dispute_creditInq_id[]" type="checkbox" class="selectallcredit" value="<?php echo $creinfo->dispute_creditInq_id;?>" <?php echo $checked; ?>> </td>
                                    <td data-label="Company"><?php echo $creinfo->company;?>  </td>
                                    <td data-label="Company"><?php echo $creinfo->bureau;?>  </td>
                                    <td data-label="Date"> <?php echo $creinfo->date;?> </td>
                                  </tr>
                        <?php } ?>
                          </tbody>
                      </table>
              </div>

              <div class="account-history-row">
              <h2> ACCOUNTS HISTORY </h2>

                <?php 
                foreach($accountHistory as $acchis){


                   if(in_array($acchis['dispute_account_id'],$disputeitems))
                       $checked ='checked';
                        else
                        $checked ='';


                    $account_historylist = $acchis['account_historylist'];
                ?>
                <div class="ac-history-row">
                  <h3><?php echo $acchis['company_title'];?> </h3>
                  <div class="d-flex justify-content-between">
                  <?php 
                      foreach($account_historylist as $getaccthistory){
                        $dispute_acct_his_detail_id = $getaccthistory['dispute_acct_his_detail_id'];
                        $company_title  = $getaccthistory['company_title'];
                        $accountno    = $getaccthistory['accountno'];
                        $paymentstatus  = $getaccthistory['paymentstatus'];
                        $comments     = $getaccthistory['comments'];
                        $dateopened   = $getaccthistory['dateopened'];
                        $balance    = $getaccthistory['balance'];
                        $account_status = $getaccthistory['account_status'];
                        $reason     = $getaccthistory['reason'];
                        $instruction  = $getaccthistory['instruction'];
                      ?>
                    <div class="ah-data col">
                      <h4>  <?php echo strtoupper($company_title);?></h4>
                      <ul>
                        <li> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $accountno;?> </li>
                        <li> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $balance;?> </li>
                        <li> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $dateopened;?>  </li>
                        <li> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $paymentstatus;?> </li>
                        <li> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $paymentstatus;?> </li>
                      </ul>
                    </div>
                     <?php  } ?>
                     
                    <div class="disputeButton-desktop col-3">
                      <input name="dispute_account_id[]" type="checkbox" value="<?php echo $acchis['dispute_account_id'];?>" <?php  echo $checked;?> >dispute this item </div>
                  </div>
                  <div class="disputeButton-mobile">
                    <input name="dispute_account_id[]" type="checkbox" value="<?php echo $acchis['dispute_account_id'];?>" <?php  echo $checked;?> >dispute this item </div>
                </div>
                <?php } ?>

              </div>

              </div>

        </form>
      </div>
    </div>
    </div>
    </div>
</div>
                                      <?php
                                        //echo $dispute_items;
                                        $submitBtn ='Submit';
                                    }else {
                                        if($module_selected=='contract' && isMobile()){
                                            echo $contract_sign_letter;
                                            $btnType ='button';
                                                $submitBtn ='Submit';
                                        }else{
                                        
                                   foreach($getcustom_fields as $getCustomField){
                                    $fieldtype          = $getCustomField->field_type;
                                    $label_name         = $getCustomField->label_name;
                                    $field_name         = str_replace(' ', '-', strtolower($label_name));
                                    $length             = $getCustomField->length;
                                    $default_value      = $getCustomField->default_value;
                                    $place_holder       = $getCustomField->place_holder;
                                    $is_desktop_view    = $getCustomField->is_desktop_view;
                                    $is_mobile_view     = $getCustomField->is_mobile_view;
                                    $mandatory_field    = $getCustomField->mandatory_field;
                                    $PBC_field_id       = $getCustomField->custom_block_field_id;
                                    //$filedname            = slugurl($label_name);
                                    
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

                                <div class="form-group col-lg-4">
                                  <label for="<?php echo $uniquelabel;?>"><?php echo $label_name;?></label>

                                  <?php if($fieldtype=='textarea'){?>
                                        <textarea class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> <?php echo $lengthtext;?> placeholder="<?php echo $place_holder;?>" ><?php echo $valuetext;?> </textarea>
                                  <?php }
                                    else if($fieldtype=='checkbox' || $fieldtype=='select' || $fieldtype=='multiple'){
                                        $option_fields      = explode(',',$getCustomField->option_fields);
                                        
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


                  if($module_selected=='contract')
                      {
                        ?>
                       </div>
					   
	<div class="contractBlock">				   
    <div class="row">   
    <div class="col-lg-6">                 
   <h4>Without Signed Contract</h4>   
   
   <div class="btn-group">
   
  <a href="<?php echo $before_sign_contract; ?>" class="btn btn-primary" download=""  target="_blank" ><i class="fa fa-download" aria-hidden="true" ></i> Download</a>
  
  <a href="javascript:void(0);" class="btn btn-success"  onclick="printimage('<?php echo $before_sign_contract; ?>')"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
  
   <a href="<?php echo $before_sign_contract; ?>" class="btn btn-danger"   target="_blank" ><i class="fa fa-print" aria-hidden="true"></i>View </a>
   
   </div>
 </div> 
<div class="col-lg-6">
    <h4>With Signed Contract</h4> 
     <?php if($contract_url!='') { ?>
    
	<a href="<?php echo $contract_url; ?>" class="btn btn-primary" download=""  target="_blank" ><i class="fa fa-download" aria-hidden="true" ></i> View Signed Contract</a> 

      <a href="<?php echo $contract_url; ?>" class="btn btn-primary" download=""  target="_blank" ><i class="fa fa-download" aria-hidden="true" ></i> Download</a>
	  
  <?php } else { ?>
        
		<div class="file-upload-wrapper" style="margin-bottom:15px;">
		<input class="file-upload" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="<?php echo $PBC_field_id;?>_dynamic_file" <?php echo $required;?> <?php echo $lengthtext;?>  /> </div>

         <a href="<?php echo $before_sign_contract; ?>" class="btn btn-primary" download=""  target="_blank" ><i class="fa fa-download" aria-hidden="true" ></i> Download</a>
  <?php } ?>


    <a href="javascript:void(0);" class="btn btn-primary" onclick="uploadsign('<?php echo $orderId ;?>','<?php echo $userId; ?>')" ><i class="fa fa-download" aria-hidden="true" ></i> Upload Signature</a>

 <?php if($sign!='') { ?>
    <a href="<?php echo $sign; ?>" class="btn btn-primary"  target="_blank" ><i class="fa fa-download" aria-hidden="true" ></i> View Signature</a>
  <?php } ?>




</div>
</div> 

                      <?php
                      }



                                            ?>
											<div class="iddocuemnt-col">
                                            <div class="file-upload-wrapper">
                                                <input class="file-upload" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="<?php echo $PBC_field_id;?>_dynamic_file" <?php echo $required;?> <?php echo $lengthtext;?>  />
                                            </div>

                                        <?php if(!empty($valuetext) && !empty($valueExist)){?>
                                            <input type="hidden" name="<?php echo $PBC_field_id;?>_dynamic_filevalue" value="<?php echo $valuetext;?>" />
                                            
                                                <?php
                                                $supported_image = array('gif','jpg','jpeg','png');
                                                $src_file_name = $valuetext;
                                                $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
                                                    if (in_array($ext, $supported_image)) {?>
                                                    
                                                    <div class="card" style="padding:15px;">
                                                    
                                                    <a href="<?php echo $valuetext;?>" target="_blank"><img class="card-img-top" src="<?php echo $valuetext;?>" class="img-fluid" /></a>
                                                    </div>
													</div>
													
                                                    
                                                    <?php } else { ?>
                    <a href="<?php echo $valuetext;?>" class="btnview" target="_blank">View</a>
                                                    <?php }
                                            }
                                            ?>
                                    <?php }else{ ?>
                                        <input class="form-control" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> value="<?php echo $valuetext;?>" placeholder="<?php echo $place_holder;?>" <?php echo $lengthtext;?> />
                                  <?php } ?>
                                </div>
                                        <?php } }?>
                                
                                <?php } ?>

                                <?php
                                       if($product_block_id!=8)
                                       {     
                                ?>
                               <div class="form-group"><button class="btnsubmit" id="submitbutton"  <?php if($product_block_id==6) { ?> onclick="return timerhere('<?php echo $uniquelabel; ?>');" <?php } ?>  type="<?php echo $btnType;?>"  <?php if(($module_selected=='contract') && empty($contract_sign->sign)) { ?>  onclick="return submitsign('<?php echo $formId; ?>')"   <?php } ?>  > <?php echo $submitBtn;?></button></div>

                             <?php } ?>
                              </div>
                            
                            </form>

                </div>
                </div>
                </div>
            <?php } ?>  
                <?php $c++; } ?>
                      
                </div>
                </div>


      </div>

      
      </div>
      
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
      window.location.reload();
    }
}
});

  
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
         window.location.reload();
    }
}
});

}

}));


</script>
<style type="text/css">
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
        window.location.reload();
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


function printimage(img)
{
    var W = window.open(img);

    W.window.print();
}
 

 function uploadsign(orderId,user_id)
 {
    $('#orderId_upload_sign').val(orderId);
    $('#orderId_upload_user_id').val(user_id);
    $('#exampleModal').modal('show');
 }
 
 /*****Update dispute Data in bot Data *****/
 function getupdatepersonal(dispute_pf_id,value,field,orderId)
 {
   $.post("<?php echo base_url('Ajax/updateDisputePersonalInfo'); ?>",{dispute_pf_id: dispute_pf_id,value:value,field:field,order_id:orderId},function(data){
       
   });
 }
 
</script>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Signature</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('Projects/uploadsign'); ?>" method="post" enctype="multipart/form-data">

        <input type="hidden" name="orderId_upload_sign" id="orderId_upload_sign" >
        <input type="hidden" name="orderId_upload_user_id" id="orderId_upload_user_id" >
      <div class="modal-body">

         <div>
    <input type="file"  id="sign" name="sign" class="file-upload" required>
  </div>

      </div>
    
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>

      </form>
    </div>
  </div>
</div>

 <?php include_once ('bottom_content.php'); ?>
