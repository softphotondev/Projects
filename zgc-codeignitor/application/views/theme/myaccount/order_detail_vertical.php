<style>
.steeperBtn {
	position: relative;
	display: block;
	list-style: none;
	margin: 0;
	padding: 0;
	border: 0 solid #e8ebf2;
	background: transparent;
}
.steeperBtn.completed {
	color: #fff;
	background: #14750a;
	cursor: text;
	border-radius: 5px;
	text-transform: uppercase;
	font-weight: 600;
}
.steeperBtn li a {
	display: block;
	position: relative;
	width: 100%;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	text-decoration: none;
	outline-style: none;
	z-index: 1;
	font-size: 15px;
}
.steeperBtn li a.completed {
	color: #fff;
	background: #14750a;
	cursor: text;
	border-radius: 5px;
	text-transform: uppercase;
	font-weight: 600;
}
.steeperBtn li a.selected {
	color: #fff;
	background: #ed3a25;
	cursor: text;
	border-radius: 5px;
	text-transform: uppercase;
	font-weight: 600;
}
.steeperBtn li a.deselected {
	color: #fff;
	background: #363d8e;
	cursor: text;
	border-radius: 5px;
	text-transform: uppercase;
	font-weight: 600;
}
.steeperBtn li a.disable {
	color: #898989;
	background: #e8f4fe;
	cursor: text;
	border-radius: 5px;
}
.page-body {
	padding: 0px 15px 0px 15px;
}
.mobile-backbtn {
	background: #dd3333;
	padding: 5px 10px;
	color: #fff;
	font-size: 16px;
	font-weight: 700;
	display: inline-block;
	float: right;
	position: relative;
	margin-top: 0;
	margin-bottom: 10px;
	text-transform: uppercase;
}
.mobile-backbtn:hover {
	background: #000;
	color: #fff;
}
.mobile-backbtn:hover .fa {
	color: #fff;
}
#step-1 {
	font-size: 16px;
}
#step-1 .form-group {
	margin: 0;
}
.col-form-label {
	padding: 0 15px;
	padding-bottom: 0;
	margin-bottom: 0;
	font-size: 15px;
	line-height: 1.5;
	font-weight: 700;
}
#image-step .bg-dark {
	width: 25%;
	float: left;
	margin: 15px;
	border-radius: 0px;
}
#image-step .bg-dark .card-body {
	padding: 5px;
	margin: 0;
}
#image-step .bg-dark .card-body .card-title {
	margin: 0;
	font-weight: 600;
}
.customTabs .tab-content h2 {
	margin: 0 !important;
}
 @media(max-width:767px) {
#step-2 .bg-dark {
	width: 100%;
}
}
.projects-status .list-staus {
	width: 19%;
}
.projects-status {
	display: flex;
	width: 100%;
}
 @media (max-width: 767px) {
.projects-status {
	display: inline-block;
	width: 100%;
}
.projects-status .list-staus {
	width: 45%;
}
}
.comment-list header {
	background: none;
}
.chatBox {
}
.chatBox .comment-user {
	color: #1e73be;
	font-size: 17px;
	font-weight: 600;
	margin-bottom: 5px;
}
.chatBox .comment-date {
	color: #000;
	margin-bottom: 15px;
	display: block;
}
.chatBox .comment-post {
	font-size: 16px;
	color: #565656;
}
.btn-reply {
	background: #065f15;
	border: #065f15 solid 1px;
	color: #fff;
	font-size: 13px;
	text-transform: capitalize;
}
.btn-update {
	background: #9f1a04;
	border: #065f15 solid 1px;
	color: #fff;
	font-size: 13px;
	text-transform: capitalize;
}
.btn-reply:hover, .btn-update:hover {
	background: #000;
	color: #fff !important;
}
.chatBox .comment-post {
	text-align: left;
}
.addNew {
	background: #db4432 !important;
	border: #db4432 solid 1px !important;
}
 @media (max-width: 767px) {
.tab-title {
	margin-left: 15px;
}
.addNew {
	margin-right: 15px;
}
}
.loader {
	border: 16px solid #f3f3f3; /* Light grey */
	border-top: 16px solid #3498db; /* Blue */
	border-radius: 50%;
	width: 120px;
	height: 120px;
	animation: spin 2s linear infinite;
}
 @keyframes spin {
 0% {
transform: rotate(0deg);
}
 100% {
transform: rotate(360deg);
}
}
.fade:not(.show) {
	opacity: 1 !important;
}

</style>
<?php
  $obj = json_decode($order->billing_info); 
    if($obj){
          $name 		= $obj->fname.' '.$obj->lname;
          $address  	= $obj->address;
          $citytown  	= $obj->citytown;
          $postalcode  	= $obj->postalcode;
          $phone  		= $obj->phone;
          $email  		= $obj->email;
    }
    else{
         $name =  $address =  $citytown =  $postalcode =  $phone = $email ='';   
    }
    $added_date = (isset($order->added_date)&&$order->added_date!=NULL)?date("d F Y", strtotime($order->added_date)):date("d F Y", strtotime($order->last_updated_date));

    $order_id =  $order->order_id;
	
	$projobj = json_decode($order->product_info); 
	
?>
<div class="page-body-wrapper">
  <div class="page-body">
    <div class="container-fluid">
      <div class="myaccount-profile">  
		<?php
			$totalblock = count($order_dynamic_block);
			$newcount = $totalblock + 4;
			$order_price = getorderprice($order->order_id);
			$order_qty 		=  isset($order->order_qty) ? $order->order_qty :1;
			$payment_method =  isset($order->payment_method) ? $order->payment_method :'Payment Failed';
			if(empty($order->status)){
				 $order_qty 	  	= 1;
				 //$order_price 	= $projobj->array[0]->sum_price;
			}
		?>
	  <?php if(isMobile()){?>
	  <div class="orderview-row">
		  <div class="orderview-col row">
			<h2 class="orderview-title"> ORDER OVERVIEW </h2>
			  <div class="order-details-content">
				  <ul class="orderList">
					  <li class="odid"> <?php echo $order->order_number; ?> <span><?php echo $payment_method;?></span> </li>
					  <li class="oddate">Order Date - <?php echo date('m/d/Y',strtotime($order->added_date));?> <span>QTY. <?php echo $order_qty;?></span></li>
					  <li class="odname"> <?php echo $order->product_name;?> <span>$<?php echo $order_price; ?></span></li>
				  </ul>
			  </div>
		  </div>
	  <div class="orderview-thumbicon">
	  <div class="row">
	 <?php
		 $b=1;
		 foreach($order_dynamic_block as $getResponse){
		  $block_name = $getResponse->block_name;
		  $block_id   = $getResponse->block_id;

		$img = (isset($getResponse->icon) && $getResponse->icon!='NULL')?$getResponse->icon:base_url('assets/home/images/personal-info-icon.png');
	  ?>
		<a class="thumb-col" href="<?php echo base_url('order/getOrderajaxsingle/'.$order_id.'/'.$block_id.'/'.$b); ?>" >
		<div class="thumbImg"> <img src="<?php echo $img; ?>" ></div> <p> <?php echo $block_name ;?> </p> </a>
		<?php $b++;} ?>

			<a class="thumb-col" href="<?php echo base_url('order/getOrderajaxsingle/'.$order_id.'/'.$block_id.'/task'); ?>">
			<div class="thumbImg"><img src="<?php echo base_url('assets/home/'); ?>images/task-icon.png"></div><p>TASK </p></a>
			<a class="thumb-col" href="<?php echo base_url('order/getOrderajaxsingle/'.$order_id.'/'.$block_id.'/notes'); ?>">
			<div class="thumbImg"><img src="<?php echo base_url('assets/home/'); ?>images/notes-icon.png"></div><p>NOTES</p></a>
			<a class="thumb-col" href="<?php echo base_url('order/getOrderajaxsingle/'.$order_id.'/'.$block_id.'/support'); ?>">
			<div class="thumbImg"><img src="<?php echo base_url('assets/home/'); ?>images/support.png"></div><p>SUPPORT</p></a>
	  </div>
	  </div>
	  </div>
	  <?php }else { ?>
	  
        <div class="row">
          <div class="col-lg-3">
            <div class="card myprofile-sidebarbg">
              <div class="myprofile-sidebar card-body">
                <div class="userprofile">
				
                  <ul class="profile-usermenu steeperBtn">
                    <?php 		
						$totalblock = count($order_dynamic_block);
						$newcount = $totalblock + 5;
						?>							
					<a style="cursor:pointer;" onclick="getOrderCustomDetail('<?php echo $order_id;?>','overview','<?php echo $totalblock+1;?>','<?php echo $newcount;?>');" id="stepmenu_<?php echo $totalblock+1; ?>" class="active thumb-col"> <div class="thumbImg"> <img src="<?php echo base_url();?>assets/images/order-icon.png"></div><p> ORDER OVERVIEW </p></a>
				
                    <?php
						$b=1;
						foreach($order_dynamic_block as $getResponse){
							$block_name = $getResponse->block_name;
							$block_id 	= $getResponse->block_id;
					?>
					<a style="cursor:pointer;" onclick="getOrderStepDetail('<?php echo $order_id;?>','<?php echo $block_id;?>','<?php echo $b;?>','<?php echo $newcount;?>');" id="stepmenu_<?php echo $b; ?>" class="thumb-col deselected"> 
					<div class="thumbImg"> <img src="<?php echo base_url();?>assets/home/images/personal-info-icon.png"></div><p> <?php echo $block_name ;?></p></a>
				<?php $b++;} ?>
					<a style="cursor:pointer;" onclick="getOrderCustomDetail('<?php echo $order_id;?>','task','<?php echo $totalblock+2;?>','<?php echo $newcount;?>');" id="stepmenu_<?php echo $totalblock+2; ?>" href="javascript:void();" class="deselected thumb-col"> <div class="thumbImg"><img src="<?php echo base_url();?>assets/images/invoice-icon.png"></div><p> Task </p></a>	
					<?php if($this->session->userdata('user_type')==3){?>
					<a style="cursor:pointer;" onclick="getOrderCustomDetail('<?php echo $order_id;?>','funding','<?php echo $totalblock+5;?>','<?php echo $newcount;?>');" id="stepmenu_<?php echo $totalblock+5; ?>" href="javascript:void();" class="deselected thumb-col"> <div class="thumbImg"><img src="<?php echo base_url();?>assets/images/invoice-icon.png"></div><p> Funding </p></a>	
					<?php } ?>
					<a style="cursor:pointer;" onclick="getOrderCustomDetail('<?php echo $order_id;?>','notes','<?php echo $totalblock+3;?>','<?php echo $newcount;?>');" id="stepmenu_<?php echo $totalblock+3; ?>"href="javascript:void();" class="deselected thumb-col"> <div class="thumbImg"><img src="<?php echo base_url();?>assets/images/credit-report-icon.png"></div><p> Notes </p></a>
						
					<!--<a style="cursor:pointer;" onclick="getOrderCustomDetail('<?php //echo $order_id;?>','support','<?php //echo $totalblock+4;?>','<?php //echo $newcount;?>');" id="stepmenu_<?php //echo $totalblock+4; ?>" href="javascript:void();" class="deselected thumb-col"> <div class="thumbImg"><img src="<?php //echo base_url();?>assets/images/support-icon.png"></div><p> Support </p></a>-->
					
					<a style="cursor:pointer;" href="<?php echo base_url('tracking'); ?>" class="deselected thumb-col"> <div class="thumbImg"><img src="<?php echo base_url();?>assets/images/credit-report-icon.png"></div><p> Tracking </p></a>
					
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="row">
              <!-- <div class="col-lg-3">
                <?php if(isMobile()){?>
                <a class="btn mobile-backbtn" href="<?php //echo site_url('order/myaccount');?>"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
                <?php } ?>
              </div> -->
            </div>
            <div id="orderview_step_detail" class="whiteBg">
              <h4 class="order-card-title"> ORDER OVERVIEW
                <hr/>
              </h4>
              <div class="row">
                <div class="col-lg-6">
                  <div class="tableData">
                    <h5> PROJECT INFORMATION </h5>

                    <?php
					$order_price = getorderprice($order->order_id);
                    ?>
                    <div class="row">
                      <div class="col-lg-6 col-6 col-title">Order Number</div>
                      <div class="col-lg-6 col-6"><?php echo $order->order_number; ?></div>
                      <div class="w-100"></div>
                      <div class="col-lg-6 col-6 col-title">Product Name</div>
                      <div class="col-lg-6 col-6"><?php echo $order->product_name;?></div>
                      <div class="w-100"></div>
                      <div class="col-lg-6 col-6 col-title">Order Qty</div>
                      <div class="col-lg-6 col-6"><?php echo $order->order_qty;?></div>
                      <div class="w-100"></div>
                      <!--<div class="col-lg-6 col-6 col-title">Selling Price</div>
                      <div class="col-lg-6 col-6"><?php echo $order->selling_price;?></div>
                      <div class="w-100"></div>-->
                      <div class="col-lg-6 col-6 col-title">Payment Method</div>
                      <div class="col-lg-6 col-6"><?php echo $order->payment_method;?></div>
                      <div class="w-100"></div>
                      <div class="col-lg-6 col-6 col-title">Order Date</div>
                      <div class="col-lg-6 col-6"><?php echo date('m/d/Y',strtotime($order->added_date));?></div>
                      <div class="w-100"></div>
                      <div class="col-lg-6 col-6 col-title">Order Amount </div>
                      <div class="col-lg-6 col-6">$<?php echo $order_price; ?></div>
                      <div class="w-100"></div>
                    </div>
                  </div>
                </div>
				<?php /* ?>
                <div class="col-lg-6">
                  <div class="tableData billingAddress">
                    <h5> BILLING ADDRESS </h5>
                    <div class="row">
                      <div class="col-lg-2 col-4 col-title">Name </div>
                      <div class="col-lg-10 col-8"><?php echo $name;?></div>
                      <div class="w-100"></div>
                      <div class="col-lg-2 col-4 col-title">Address </div>
                      <div class="col-lg-10 col-8"><?php echo $address;?></div>
                      <div class="w-100"></div>
                      <div class="col-lg-2 col-4 col-title">City </div>
                      <div class="col-lg-10 col-8"><?php echo $address;?> <?php echo $citytown.' '.$postalcode; ?> </div>
                      <div class="w-100"></div>
                      <div class="col-lg-2 col-4 col-title">Phone </div>
                      <div class="col-lg-10 col-8"><?php echo $phone;?></div>
                      <div class="w-100"></div>
                      <div class="col-lg-2 col-title col-4">Email </div>
                      <div class="col-lg-10 col-8"><?php echo $email;?></div>
                      <div class="w-100"></div>
                    </div>
                  </div>
                </div>
				<?php */ ?>
              </div>
            </div>
          </div>
        </div>
      
	  <?php } ?>
	  
	  </div>
    </div>
  </div>
</div>

<!---pop up for task starts here--->
<div class="modal supportpopup addNewTicket" id="exampleModaldynamicfield" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div id="loadedittaskdynamicfield"></div>
  </div>
</div>

	<div class="modal fade" id="createticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <form name="addsupport" id="addsupport" method="POST" action="<?php echo base_url('Support/save')?>"  enctype="multipart/form-data">

			<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

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
			  if($priority)
			  {
			  foreach ($priority as $key => $value) 
			  {
			  ?>
			  <option value="<?php echo  $value->id; ?>" ><?php echo  $value->priority; ?></option>
			  <?php } } ?>
			  </select>
				</div>

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
				<label for="name"> Order Notes </label>
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
				<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
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


<script type="text/javascript">
		 $('#selectAll2').click(function(e) {
			if($(this).hasClass('checkedAll')) {
			  $('.selectall').prop('checked', false);   
			  $(this).removeClass('checkedAll');
			} else {
			  $('.selectall').prop('checked', true);
			  $(this).addClass('checkedAll');
			}
		});
		
	function valthisform()
	{
		var count_checked = $("[name='ids[]']:checked").length; // count the checked rows
			if(count_checked == 0) 
			{
				alert("Please select atleast one checkbox");
				return false;
			}
			else
			{
			  job=confirm("Are you sure to delete?");
			  if(job!=true)
			  {
			  return false;
			  }
			}
	}
	
	function getOrderStepDetail(orderId,blockId,stepId,totalsteps){
		$('#orderview_step_detail').html('<div class="loader"></div>');
		stepno(stepId,totalsteps);
		$.ajax({
			type:'GET',
			url:'<?php echo base_url('Ajax/getOrderStepDetail')?>',
			data:'orderId='+orderId+'&blockId='+blockId+'&stepId='+stepId,
			beforeSend: function () {
				$('.modal-body').css('opacity', '.5');
			},
			success:function(response){
				$('#orderview_step_detail').html(response);
			}
		});
	}
	function getOrderCustomDetail(orderId,type,stepId,totalsteps){
		$('#orderview_step_detail').html('<div class="loader"></div>');
		stepno(stepId,totalsteps);
		$.ajax({
			type:'GET',
			url:'<?php echo base_url('Ajax/getOrderCustomStepDetail')?>',
			data:'orderId='+orderId+'&type='+type+'&stepId='+stepId,
			beforeSend: function () {
				$('.modal-body').css('opacity', '.5');
			},
			success:function(response){
				$('#orderview_step_detail').html(response);
			}
		});
	}
	
	function stepno(stepId,totalsteps){
		for(var i=1;i<=totalsteps;i++){
			if(i==stepId){
				$('#stepmenu_'+stepId).removeClass();
				$('#stepmenu_'+stepId).addClass('thumb-col active');
			}else{
				$('#stepmenu_'+i).removeClass();
				$('#stepmenu_'+i).addClass('thumb-col deselected');
			}
		}
	}
	
	</script> 
<script type="text/javascript"> 
  function uploadfile()
  {
  $("#upload_file").toggle();
  }

  function chanagerelate(relate) 
  {
  if(relate=='custom')
  {
  $('#showdept').show();
  }
  else
  {
  $('#showdept').hide();
  }
  }

 $('#selectAll2').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectall').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectall').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 



 $('#selectsupport').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectsupport').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectsupport').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 



 $('#selectnotes').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectnotes').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectnotes').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 

function valthisform()
{
    var count_checked = $("[name='ids[]']:checked").length; // count the checked rows
        if(count_checked == 0) 
        {
            alert("Please select atleast one checkbox");
            return false;
        }
        else
        {
          job=confirm("Are you sure to delete?");
          if(job!=true)
          {
          return false;
          }
        }
}

function loadtask(task_id,action)
{

  $('#formupdate').removeAttr("action");
  $('#formupdate').attr("action",action);

  $.post("<?php echo base_url('task/loadtask'); ?>",{task_id:task_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}

function taskchangestatus(type,value,task_id)
{
    $.post("<?php echo base_url('task/statuspriority'); ?>",{task_id:task_id,value:value,type:type},function(data) 
    {
    });  
}

function supportchangestatus(type,value,support_id)
{
     $.post("<?php echo base_url('support/priorityupdate'); ?>",{type:type,value:value,support_id:support_id},function(data) 
    {
    });  
}


function loadsupport(support_id,action)
{
  $('#formupdate').removeAttr("action");
  $('#formupdate').attr("action",action);

    $.post("<?php echo base_url('support/loadsupport'); ?>",{support_id:support_id},function(data) 
    {
  $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    }); 
}

function loadnotes(notes_id,action)
{
   $('#formupdate').removeAttr("action");
   $('#formupdate').attr("action",action);

    $.post("<?php echo base_url('notes/loadnotes'); ?>",{notes_id:notes_id},function(data) 
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

$(document).ready(function() {
    $('#basic-3').DataTable();
} );




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
          getOrderCustomDetail('<?php echo $order_id;?>','support','<?php echo $totalblock+4;?>','<?php echo $newcount;?>');
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
    	getOrderCustomDetail('<?php echo $order_id;?>','notes','<?php echo $totalblock+4;?>','<?php echo $newcount;?>');
          $('#exampleModaldynamicfield').modal('hide');
    }); 
  }
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
  //window.location.reload();

     getOrderCustomDetail('<?php echo $order_id;?>','support','<?php echo $totalblock+4;?>','<?php echo $newcount;?>');
       $('#createticket').modal('hide');

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
	//window.location.reload();

	   getOrderCustomDetail('<?php echo $order_id;?>','notes','<?php echo $totalblock+4;?>','<?php echo $newcount;?>');
       $('#createnotes').modal('hide');

}
});
}));


function getorderstepdetailsmobile(orderId,blockId,stepId,totalsteps)
{
    $.ajax({
      type:'GET',
      url:'<?php echo base_url('Ajax/getOrderStepDetail')?>',
      data:'orderId='+orderId+'&blockId='+blockId+'&stepId='+stepId,
      beforeSend: function () {
        $('.modal-body').css('opacity', '.5');
      },
      success:function(response){
        $('#orderview_step_detail').html(response);
      }
    });
}
</script>
