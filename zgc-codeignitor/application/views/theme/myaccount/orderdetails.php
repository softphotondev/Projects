<style>
.myaccount-profile .tab-content {
	background: #fff;
	padding: 20px;
	min-height: 300px;
}

.myaccount-profile .tab-content h2 { 
	font-size: 18px;
    font-weight: 600;
    text-transform:uppercase; margin-bottom:20px; }

.myaccount-profile .form-control {
	border-radius: 0px;
	font-size: 14px;
}
.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
	background: #072593;
	border-radius: 0px;
	font-size: 13px;
	padding: 8px 10px;
	font-weight: 600;
}
.nav-pills .nav-link {
 border-radius: 0px;
	background: #fff;
	color: #072593;
	text-transform: uppercase;
	font-weight: 600;
}
@media(max-width:767px) {
.card-body, .col-lg-10, .container-fluid {
	padding: 0px;
	margin: 0;
}
.nav-pills {
	display: flex;
}
.nav-pills li {
	width: auto;
}
.nav-pills .nav-link, .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
	font-size: 11px !important;
	paddig: 5px 7px !important;
}

.myaccount-profile .tab-content {
    padding: 20px 5px;
}

.myaccount-profile .card-body { padding:0px;}

.tabs-menusection {
	overflow-x:scroll;
}

.scroll-touch {
-webkit-overflow-scrolling: touch; / Lets it scroll lazy /
}

.scroll-auto {
-webkit-overflow-scrolling: auto; / Stops scrolling immediately /
}

}
.tab-slider {
	margin: 0;
	padding: 0;
	position: relative;
}
.tab-slider .btn-icon {
	position: absolute;
	top: 5px;
}
#goPrev {
	left: 0;
}
#goNext {
	right: 0;
}
.tabs-menusection {
	position: relative;
	white-space: nowrap;
	width: 100%;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
	border: 1px solid transparent;
}
.tabs-menusection>.nav-tabs {
	display: inline-block;
	padding: 0;
	margin: 0;
	position: relative;
	top: 0;
	left: 0;
}
.tabs-menusection>.nav-tabs>li {
	display: inline-block;
	position: relative;
	white-space: normal;
	float: none;
	font-size: 14px;
}
.nav-tabs>li>a {
	margin-right: 0;
	border-radius: 0;
}
#goNext {
	right: 0px;
	padding: 4px;
	background: #d33;
	border-radius: 0px;
	top: 0;
}
#goPrev {
	left: 0px;
	padding: 4px;
	background: #d33;
	border-radius: 0px;
	top: 0;
}
#goPrev .fa, #goNext .fa {
	color: #fff;
}

@media(min-width:556px) {
#goPrev, #goNext {
	display: none;
}
}

.tableData { background:#f9f9f9; padding:15px;}
.tableData .col { height:25px; font-size:16px;}
.tableData .col-title {
	font-weight:700;
}
.tableData h3 { font-size: 16px;
    font-weight: 600;
    color: #000;
    text-transform: uppercase;
    margin-bottom: 20px; }

@media(max-width:767px){
.tableData .col {
    height: 23px;
    font-size: 12px;
    line-height: 16px;
    text-align: left;
}
}

.myaccount-profile .nav-tabs .nav-link { background:#fff; border:#f1f1f1 solid 1px; color:#000; text-transform: uppercase; font-size: 13px;
font-weight: 600; padding: 8px 15px 5px 15px !important;}
.myaccount-profile .nav-tabs .nav-link.active { background:#072593; color:#fff;}

</style>

<?php
  $obj = json_decode($order->billing_info); 
    if($obj)
    {
          $name = $obj->fname.' '.$obj->lname;
          $address  = $obj->address;
          $citytown  = $obj->citytown;
          $postalcode  = $obj->postalcode;
          $phone  = $obj->phone;
          $email  = $obj->email;
    }
    else
    {
         $name =  $address =  $citytown =  $postalcode =  $phone = $email ='';   
    }

    $added_date = (isset($order->added_date)&&$order->added_date!=NULL)?date("d F Y", strtotime($order->added_date)):date("d F Y", strtotime($order->last_updated_date));

    $order_id =  $order->order_id.'-'.date("Ymd", strtotime($order->added_date));

    $payment_method = $order->payment_method;

    $order_amount = '$ '.$order->order_amount;
?>

<div class="page-body-wrapper">
  <div class="page-body">
    <div class="container-fluid">
  <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 
   <div class="alert alert-success" style="display: none;" id="loadmessageload">Updated Successfully</div>
	  <a href="<?php echo base_url('order/myaccount'); ?>" class="backbtn"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to DashBoard </a>
      <div class="myaccount-profile">
		<div class="card-body">
  
<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#project-overview">PROJECT OVERVIEW</a></li>
				   <?php
						$totalblock = count($order_dynamic_block);
						$newcount = $totalblock + 3;
						$b=1;
						foreach($order_dynamic_block as $key => $getResponse){
							$block_name 		= $getResponse['block_name'];
							$product_block_id 	= $getResponse['block_id'];
							//$getcustom_fields 	= $getRes->custom_fields;
							?>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#step-<?php echo $b ;?>"><?php echo $block_name ;?></a></li>
						 
                    <?php $b++;} ?> 
                    
<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#task">Task</a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#notes">Notes</a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#support-tab">Support</a></li>

</ul>
<div class="tab-content">
                <div class="tab-pane active" id="project-overview">
					<div class="col-lg-12"><h2> PROJECT INFORMATION </h2> </div>
					<div class="row">
						<div class="col-lg-5">
							<div class="tableData">	
								<div class="row">
									<div class="col col-title">Order Number</div>
									<div class="col"><?php //echo $order->order_number ?? $order->order_id;?></div>
									<div class="w-100"></div>
									<div class="col col-title">Product Name</div>
									<div class="col"><?php echo $order->product_name;?></div>
									<div class="w-100"></div>
									<div class="col col-title">Order Qty</div>
									<div class="col"><?php echo $order->order_qty;?></div>
									<div class="w-100"></div>
									<div class="col col-title">Selling Price</div>
									<div class="col"><?php echo $order->selling_price;?></div>
									<div class="w-100"></div>
									<div class="col col-title">Payment Method</div>
									<div class="col"><?php echo $order->payment_method;?></div>
									<div class="w-100"></div>
									<div class="col col-title">Order Date</div>
									<div class="col"><?php echo date('m/d/Y',strtotime($order->added_date));?></div>
									<div class="w-100"></div>
									<div class="col col-title">Order Amount </div>
									<div class="col"><?php echo $order->order_amount;?></div>
									<div class="w-100"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-7">
							<h3> Billing Address </h3>
							<div class="tableData">	
								<div class="row">
									<div class="col col-title">Name </div>
									<div class="col"><?php echo $name;?></div>
									<div class="w-100"></div>
									<div class="col col-title">Address </div>
									<div class="col"><?php echo $address;?></div>
									<div class="w-100"></div>
								   <div class="col col-title">City </div>
									<div class="col"><?php echo $address;?> <?php echo $citytown.' '.$postalcode; ?>
									</div>
									<div class="w-100"></div>
									<div class="col col-title">Phone </div>
									<div class="col"><?php echo $phone;?></div>
									<div class="w-100"></div>
									<div class="col col-title">Email </div>
									<div class="col"><?php echo $email;?></div>
									<div class="w-100"></div>
								</div>
							</div>
						</div>
					</div>
                </div>
				
				<?php
					$c=1;
					foreach($order_dynamic_block as $getRes){
						//print_r($getRes);
						//$getRes = (object) $getRes;
						$block_name 		= $getRes['block_name'];
						$product_block_id 	= $getRes['block_id'];
						$getcustom_fields 	= $getRes['customfields'];
						$module_selected 	= $getRes['module_selected'];
					?>
                                    
				<div class="tab-pane fade" id="step-<?php echo $c ;?>">
					<h2><?php echo $block_name;?></h2>
					<?php 
						if($module_selected=='contract'){
							echo $contract_sign_letter;
						}else if($product_block_id==8){
							echo $dispute_items;
						}else {
							$data['dynamic_block']=$this->Product_model->getdynamicBlockByProductIdandblock($order->product_id,$product_block_id);
							$data['pre_dynamic_block'] =$this->Product_model->getdynamicBlockByOrderId($order->order_id);
							$data['orderId'] = $order->order_id;
							$data['product_block_id'] = $product_block_id;
							$data['product_id'] = $order->product_id;
							echo $this->load->view('theme/myaccount/dynamic_field_view',$data,true);
							
						}	
					   ?>
				</div>
		  <?php $c++; } ?>
                <div class="tab-pane fade" id="task">
                  <h2> TASK </h2>
					 <div class="list-group">
					 
					 <?php
					  if($task){
						 foreach($task as $key=>$tas){
						   $start_date = date("m/d/Y", strtotime($tas->start_date));
						   $due_date = date("m/d/Y", strtotime($tas->due_date));
						   $assigned_to = orderusersname($order->user_id);
							if($tas->order_detail_ids<>'0') 
							$tas_fields = getalltaskfields($tas->order_id,$tas->order_detail_ids);
							else
							$tas_fields =' '; 
						  ?>	
						  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
							<div class="d-flex w-100 justify-content-between">
							  <h5 class="mb-1"><?php echo $tas->task_subject; ?> | <?php echo $priority_array[$tas->priority]; ?></h5>
							  <small>Start Date  <?php echo $start_date; ?>  Due Date <?php echo $due_date; ?></small>
							</div>
							<p class="mb-1"><h3> <?php echo $tas_fields; ?> </h3></p>
							<small>Status : <?php echo $task_status[$tas->task_status]; ?></small>
						  </a>
						  
						  <?php
						  if($tas->order_detail_ids<>'0')
						  {
						 ?>  
						 <a onclick="showselectpopup('<?php echo $order->order_id; ?>','<?php echo $order->product_id; ?>','<?php echo $tas->order_detail_ids; ?>')" class="btn btn-orderDetails" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">Fix Now</a>
						<?php } ?>
						<?php } } ?>
					</div>
                </div>
                <div class="tab-pane fade" id="notes">
                  <h2> NOTES </h2>
				   <div class="list-group">
					  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
						<div class="d-flex w-100 justify-content-between">
						  <h5 class="mb-1">List group item heading</h5>
						  <small>3 days ago</small>
						</div>
						<p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
						<small>Donec id elit non mi porta.</small>
					  </a>
					  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
						<div class="d-flex w-100 justify-content-between">
						  <h5 class="mb-1">List group item heading</h5>
						  <small class="text-muted">3 days ago</small>
						</div>
						<p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
						<small class="text-muted">Donec id elit non mi porta.</small>
					  </a>
					  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
						<div class="d-flex w-100 justify-content-between">
						  <h5 class="mb-1">List group item heading</h5>
						  <small class="text-muted">3 days ago</small>
						</div>
						<p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
						<small class="text-muted">Donec id elit non mi porta.</small>
					  </a>
					</div>
                </div>
                <div class="tab-pane fade" id="support-tab">
                  <h2> SUPPORT </h2>
				   <div class="list-group">
					  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
						<div class="d-flex w-100 justify-content-between">
						  <h5 class="mb-1">List group item heading</h5>
						  <small>3 days ago</small>
						</div>
						<p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
						<small>Donec id elit non mi porta.</small>
					  </a>
					  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
						<div class="d-flex w-100 justify-content-between">
						  <h5 class="mb-1">List group item heading</h5>
						  <small class="text-muted">3 days ago</small>
						</div>
						<p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
						<small class="text-muted">Donec id elit non mi porta.</small>
					  </a>
					  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
						<div class="d-flex w-100 justify-content-between">
						  <h5 class="mb-1">List group item heading</h5>
						  <small class="text-muted">3 days ago</small>
						</div>
						<p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
						<small class="text-muted">Donec id elit non mi porta.</small>
					  </a>
					</div>
                </div>
              </div>

		</div>
		</div>
      </div>
    </div>
  </div>
  



<!---pop up for task starts here--->
<div class="modal fade" id="exampleModaldynamicfield" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="z-index: 1600;">
  <div class="modal-dialog modal-lg" role="document">
    <div id="loadedittaskdynamicfield"></div>
  </div>
</div>

<!---pop up for task starts here--->
<div class="modal fade" id="exampleModalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog" role="document">
  <form name="addCMS" id="formupdate" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="order_id" value="<?php echo  $order->order_id; ?>">
    <div id="loadedittask"></div>
    </form>
  </div>
</div>


<div class="modal fade" id="createticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog" role="document">
  <form name="addCMS" method="POST" action="<?php echo base_url('Support/save')?>"  enctype="multipart/form-data">

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
        <label for="name"> Status </label>
        <select class="custom-select" name="status" id="status">
        <option value=""> Choose One...</option>
        <?php foreach($support_status as $keysup=>$supp) { ?>
          <option value="<?php echo $keysup; ?>"><?php echo $supp; ?></option>
        <?php } ?>
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
          <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
        </div>
      </form>
        </div>
        </div>



<script>
function showselectpopup(orders_id,product_id,product_block_id)
{
  $.post("<?php echo base_url('projects/getproductcustomfieldsfixnow'); ?>",{orders_id:orders_id,product_id:product_id,product_block_id:product_block_id},function(data) 
    {
     setTimeout(function(){ showselectpopup1(orders_id,product_id,product_block_id); }, 1000);
      $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    });
}

function showselectpopup1(orders_id,product_id,product_block_id)
{
    $.post("<?php echo base_url('projects/getproductcustomfieldsfixnow'); ?>",{orders_id:orders_id,product_id:product_id,product_block_id:product_block_id},function(data) 
    {
      $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    });
}


function stepno(stepId,totalsteps){
	for(var i=1;i<=totalsteps;i++){
		if(i==stepId){
			$('#step-'+stepId).show();
			$('#stepmenu_'+stepId).removeClass();
			$('#stepmenu_'+stepId).addClass('selected');
		}else{
			$('#step-'+i).hide();
			$('#stepmenu_'+i).removeClass();
			$('#stepmenu_'+i).addClass('deselected');
		}
	}
}

function stepnocontact(stepId,totalsteps){
	stepno(stepId,totalsteps);
	$('#step-'+stepId).show();
	$('#stepmenu_'+stepId).removeClass();
	$('#stepmenu_'+stepId).addClass('selected');
	
	
}


$(document).ready(function(){
	
$('#submit').click(function(){
	
   var form_data = new FormData();
   // Read selected files
   var totalfiles = document.getElementById('files').files.length;
   for (var index = 0; index < totalfiles; index++) {
      form_data.append("files[]", document.getElementById('files').files[index]);
   }
   // AJAX request
   $.ajax({
     url: 'ajaxfile.php', 
     type: 'post',
     data: form_data,
     dataType: 'json',
     contentType: false,
     processData: false,
     success: function (response) {

       for(var index = 0; index < response.length; index++) {
         var src = response[index];

         // Add img element in <div id='preview'>
         $('#preview').append('<img src="'+src+'" width="200px;" height="200px">');
       }

     }
   });

});

});


function taskchangestatus(type,value,task_id)
{
    $.post("<?php echo base_url('task/statuspriority'); ?>",{task_id:task_id,value:value,type:type},function(data) 
    {
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
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
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

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
