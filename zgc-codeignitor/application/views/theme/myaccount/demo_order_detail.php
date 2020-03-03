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

.tableData { background:#f9f9f9; padding:15px; line-height: 25px; font-size: 16px;}
.tableData .col { font-size:16px;}
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
    height: auto;
    font-size: 12px;
    line-height: 16px;
    text-align: left;
}
}

.swiper-slide { width:50px;}
.swiper-container .nav {
    flex-wrap:inherit !important;
}

@media(min-width:768px){
}

.swiper-button-next, .swiper-container-rtl .swiper-button-prev { top:21px;
    background-image: none;
    right: 0;
    left: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #9d1c24;
}
.swiper-button-prev, .swiper-container-rtl .swiper-button-next { top:21px; background-image: none;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #9d1c24; }
.swiper-button-next .fa, .swiper-button-prev .fa { color:#fff;}  
.swiper-button-next, .swiper-button-prev {     
    position: absolute;
    width: 27px;
    height: 38px;
    margin-top: -22px;
    z-index: 10;
    cursor: pointer;
    background-size: 27px 44px;
    background-position: center;
    background-repeat: no-repeat; }
	
.swiper-button-prev, .swiper-container-rtl .swiper-button-next { background-image:none; }

.swiper-button-prev { left:0 !important;}

.nav-tabs .nav-link { text-align: center;
    font-weight: 700;
    background: #fff;
    color: #000;
    font-size: 14px;
    text-transform: uppercase; }
	
.nav-tabs .nav-link.active { color: #fff !important; background-color: #1e73be !important; }

.tableData h3 { font-size:18px; font-weight:600; color:#a01f24;}

.tab-arrow-group { position:relative; display:none;} 
	
@media(max-width:767px){
	.nav-tabs { width:100%; overflow-x:scroll;}
	.nav { flex-wrap:inherit !important;}
	.tab-arrow-group { display:block;}
	.tab-next-arrow { position: absolute; left: 0; top: -30px; cursor: pointer; background: #db4432; padding: 5px;}
.tab-next-prev { position:absolute; right:0; top: -30px; cursor: pointer; background: #db4432; padding: 5px;}
.tab-next-arrow .fa, .tab-next-prev .fa { color:#fff;}
}

@media only screen and (max-width: 575px){
.nav {
    display: -webkit-box !important;
}
}

#step-1 { font-size:16px;}
#step-1 .form-group { margin:0;}
.col-form-label {
    padding: 0 15px;
    padding-bottom: 0;
    margin-bottom: 0;
    font-size: 15px;
    line-height: 1.5;
    font-weight: 700;
}
#step-2 .bg-dark { width: 25%; float: left; margin: 15px; border-radius:0px; }

#step-2 .bg-dark .card-body { padding:5px; margin:0;}
#step-2 .bg-dark .card-body .card-title { margin:0; font-weight:600;}

.customTabs .tab-content h2 { margin:0 !important;}

@media(max-width:767px){
	#step-2 .bg-dark { width:100%;}
}

.projects-status .list-staus { width:19%;}
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


.comment-list header { background:none;}
.chatBox {  }
.chatBox .comment-user {     
	    color: #1e73be;
    font-size: 17px;
    font-weight: 600;
    margin-bottom: 5px; } 
	
.chatBox .comment-date { color: #000; margin-bottom: 15px; display: block; }
.chatBox .comment-post { font-size:16px; color:#565656;}
.btn-reply {     background: #065f15;
    border: #065f15 solid 1px;
    color: #fff;
    font-size: 13px;
    text-transform: capitalize; }
.btn-update { background: #9f1a04;
    border: #065f15 solid 1px;
    color: #fff;
    font-size: 13px;
    text-transform: capitalize; }
	
.btn-reply:hover, .btn-update:hover { background:#000; color:#fff !important;} 

.chatBox .comment-post { text-align:left;}

.addNew { background: #db4432 !important; border: #db4432 solid 1px !important;}

@media (max-width: 767px) { 
.tab-title { margin-left:15px;}
.addNew { margin-right:15px;}
}


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
	
<div class="myaccount-profile">

  <!-- Swiper -->
  <div class="tab-container">
    <div class="col-lg-3">
    <ul class="nav nav-tabs"  id="myTab" role="tablist">
      <li>  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#projectoverview">ORDER OVERVIEW</a> </li>
	  
	   <?php
			$totalblock = count($order_dynamic_block);
			$newcount = $totalblock + 3;
			$b=1;
			foreach($order_dynamic_block as $key => $getResponse){
				$block_name 		= $getResponse['block_name'];
				$product_block_id 	= $getResponse['block_id'];
				//$getcustom_fields 	= $getRes->custom_fields;
				?>
	  <li> <a class="nav-link" id="profile-tab" data-toggle="tab" href="#step-<?php echo $b ;?>"><?php echo $block_name ;?></a> </li>
		<?php $b++;} ?>
		
      <li>  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#task">Task</a> </li>
	  <li> <a class="nav-link" id="profile-tab" data-toggle="tab" href="#notes">Notes</a> </li>
      <li>  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#support">Support</a> </li>
    </ul>
	 <!-- Add Arrows -->
 <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
<!-- HTML -->

<div class="tab-arrow-group">
<div class="tab-next-arrow"> <i class="fa fa-chevron-left" aria-hidden="true"></i> </div>
<div class="tab-next-prev"> <i class="fa fa-chevron-right" aria-hidden="true"></i>  </div> </div>

</div>

   <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 
 
	  <div class="col-lg-9">
			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane active" id="projectoverview">
								<div class="row">
									<div class="col-lg-5">
										<div class="tableData">	
										<h2> PROJECT INFORMATION </h2>
											<div class="row">
												<div class="col col-title col-6">Order Number</div>
												<div class="col col-6"><?php echo $order->order_number; ?></div>
												<div class="w-100"></div>
												<div class="col-lg-4 col-6 col-title">Product Name</div>
												<div class="col-lg-8 col-6"><?php echo $order->product_name;?></div>
												<div class="w-100"></div>
												<div class="col-lg-4 col-6 col-title">Order Qty</div>
												<div class="col-lg-8 col-6"><?php echo $order->order_qty;?></div>
												<div class="w-100"></div>
												<div class="col-lg-4 col-6 col-title">Selling Price</div>
												<div class="col-lg-8 col-6"><?php echo $order->selling_price;?></div>
												<div class="w-100"></div>
												<div class="col-lg-4 col-6 col-title">Payment Method</div>
												<div class="col-lg-8 col-6"><?php echo $order->payment_method;?></div>
												<div class="w-100"></div>
												<div class="col-lg-4 col-6 col-title">Order Date</div>
												<div class="col-lg-8 col-6"><?php echo date('m/d/Y',strtotime($order->added_date));?></div>
												<div class="w-100"></div>
												<div class="col-lg-4 col-6 col-title">Order Amount </div>
												<div class="col-lg-8 col-6"><?php echo $order->order_amount;?></div>
												<div class="w-100"></div>
											</div>
										</div>
									</div>
									<div class="col-lg-7">
										<div class="tableData">	
										<h3> Billing Address </h3>
											<div class="row">
												<div class="col-lg-2 col-4 col-title">Name </div>
												<div class="col-lg-10 col-8"><?php echo $name;?></div>
												<div class="w-100"></div>
												<div class="col-lg-2 col-4 col-title">Address </div>
												<div class="col-lg-10 col-8"><?php echo $address;?></div>
												<div class="w-100"></div>
											   <div class="col-lg-2 col-4 col-title">City </div>
												<div class="col-lg-10 col-8"><?php echo $address;?> <?php echo $citytown.' '.$postalcode; ?>
												</div>
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
				 <h2> Task </h2>
				

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

									if(($tas->task_status==26 || $tas->task_status==27))
									{
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
				  <!--<a target="_blank" href="#" class="btn btn-orderDelete"> Update </a>-->
				  </div>
				  </div>
				  </div>
				  </div>
				</div>	   
				</div>

								

				<?php  } } ?>   

				</div>

			  </div>


				<div class="tab-pane fade" id="notes">
				 <h2> NOTES </h2>
				 
				 <div class="row">
				 
				  <section class="comment-list">
						<div class="order-details-section chatBox">
						  <div class="panel panel-default">
							<div class="panel-body">
							  <header class="text-left">
								<div class="comment-user"><i class="fa fa-user"></i> That Guy </div>
								<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
							  </header>
							  <div class="comment-post">
								<p>
								  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
								</p>
							  </div>
							  <p class="text-right"> <a href="#" class="btn btn-update btn-sm"><i class="fa fa-wrench"></i> Update </a> <a href="#" class="btn btn-reply btn-sm"><i class="fa fa-reply"></i> reply</a>  </p>

							  <div class="replyBox col-md-offset-1">
								<header class="text-left">
								<div class="comment-user"><i class="fa fa-user"></i> That Guy </div>
								<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
							  </header>
							  <div class="comment-post">
								<p>
								  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
								</p>
							  </div>
							  <p class="text-right"> <a href="#" class="btn btn-update btn-sm"><i class="fa fa-wrench"></i> Update </a> <a href="#" class="btn btn-reply btn-sm"><i class="fa fa-reply"></i> reply</a>  </p>
							  </div>

							</div>
						  </div>
						</div>
					</section>


				 
				 
				 
				 
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
											  <p class="otitle"> Date Time  </p>
											  <p class="osubtitle"> <?php  echo $date; ?></p>
										  </div>
									  </div>
								  </div>
							  </div>
							  </div>
						<div class="order-details-section">
						  <div class="row">
							  <div class="col-lg-9"> 
							  <h2 class="order-title"> <?php echo $value->subject; ?></h2>
								  <div class="row productDetails">
									  <div class="col-lg-12"> 
										 <h3> Notes :   <?php echo $small; ?></h3>
										 <p> Added By :<?php echo orderusersname($value->added_by); ?> </p> 
									  </div>
								  </div>
							  </div>
							  <div class="col-lg-3 d-flex"> 
								  <div class="order-btn-group">
									<a  href="javascript:void(0);" onclick="loadnotesview('<?php echo $value->notes_id;  ?>');"class="btn btn-orderDetails"> View </a>

									<a  href="javascript:void(0);" onclick="loadnotes('<?php echo $value->notes_id;  ?>','<?php echo base_url('Notes/save'); ?>');"  class="btn btn-orderDetails"> Edit </a>

									<a  href="javascript:void(0);" href="<?php echo base_url('Notes/deletenotes/'.$value->notes_id)  ?>" onClick="return doconfirm();"  class="btn btn-orderDetails"> Delete </a>

								  
								  </div>
							  </div>
						  </div>
						  
						  </div>
						  
						</div>	
				
					</div>

				<?php  } } ?> 

			</div>
					
			  </div>


			<div class="tab-pane fade" id="support">
			
			<div class="row">
				<div class="col-lg-4 col"> <h2 class="tab-title"> Support </h2> </div>
				<div class="col-lg-8 col"> <a href="javascript:void(0);"  data-toggle="modal" data-target="#createticket" class="btn btn-info addNew mbot25 pull-right">Add New ticket</a> </div>
			</div>		 
	 
				<ul class="projects-status">
				<?php
				 if($support_status_output){
					 foreach($support_status_output as $supp_key=>$suppo){
				?>
				<li class="list-staus">
					<h2> <?php echo $support_count[$supp_key]; ?> </h2>
					<span class="list-status-title"> <?php echo $suppo; ?> </span>
					</li>
			  <?php }  } ?>

				</ul>

					<div class="row">
									  <?php
										 if($support)
										 {
										   foreach($support as $key=>$supp)
										   {


										 ?>
								
					
				<div class="col-lg-6"> 
				<div class="custom-orderBox customTabs">
				<div class="custom-header">
				  <div class="row">
				  <div class="col-lg-12"> 
				  <div class="orderplaced-row">
				  <div class="order-col">
				  <p class="otitle"> Department  : <?php echo getdepartment($supp->department);?></p>
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
				 <h3> Priority :  </h3>
				 <p> Priority : 
					<select class="custom-select" name="priority" id="priority"  onclick="supportchangestatus('2',this.value,'<?php  echo $supp->support_id; ?>')">
			<?php
			if($priority)
			{
			foreach ($priority as $key => $value) 
			{
			?>
			<option value="<?php echo  $value->id; ?>" <?php echo ($supp->priority==$value->id)?'selected':''; ?> ><?php echo  $value->priority; ?></option>
			<?php } } ?>
			</select> 

			</p> 
				  <p> Status : 

			<select class="custom-select" name="status" id="status"  onclick="supportchangestatus('1',this.value,'<?php  echo $supp->support_id; ?>')">
					<option value=""> Choose One...</option>
					<?php foreach($support_status as $keysup=>$supphere) { ?>
					  <option value="<?php echo $keysup; ?>" <?php echo ($supp->status==$keysup)?'selected':''; ?>><?php echo $supphere; ?></option>
					<?php } ?>
					</select>

				  </p>

				  </div>
				  </div>
				  </div>
				  <div class="col-lg-3 d-flex"> 
				  <div class="order-btn-group">
				  <a target="_blank" href="<?php echo base_url('support/replyus/'.$supp->support_id)  ?>" class="btn btn-orderDetails"> Reply </a>
				  <a target="_blank"  onclick="loadsupport('<?php echo $supp->support_id;  ?>','<?php echo base_url('support/save'); ?>');"  class="btn btn-orderDelete"> Update </a>

			  <a   href="<?php echo base_url('support/deletesupport/'.$supp->support_id)  ?>" onClick="return doconfirm();"class="btn btn-orderDetails"> Delete </a>


				  


				  </div>
				  </div>
				  </div>
				  </div>
				  
				</div>	   
				</div>

				<?php } } ?> 

				</div> 
				  
				  
				  </div>
				  


			</div>

	</div>

</div>

</div>

    </div>
  </div>
</div>



    <script type="text/javascript">
/**** JQuery *******/
jQuery('body').on('click','.tab-next-prev', function(){
      var next = jQuery('.nav-tabs > .active').next('li');
       jQuery('.nav-tabs > .active a').removeClass('active');
      if(next.length){
        next.find('a').trigger('click');
        next.find('a').addClass('active');

        jQuery('.nav-tabs > .active').next('li').focus();

      }else{
        jQuery('#myTab a:first').tab('show');
      }
});

jQuery('body').on('click','.tab-next-arrow', function(){
      var prev = jQuery('.nav-tabs > .active').prev('li');
       jQuery('.nav-tabs > .active a').removeClass('active');
      if(prev.length){
        prev.find('a').trigger('click');
        prev.find('a').addClass('active');
        jQuery('.nav-tabs > .active').prev('li').focus();
      }else{
        jQuery('#myTab a:last').tab('show');
      }
});
    </script>

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
			$('#step-'+stepId).addClass('show');
			//$('#stepmenu_'+stepId).removeClass();
			$('#stepmenu_'+stepId).addClass('active');
		}else{
			$('#step-'+i).hide();
			//$('#stepmenu_'+i).removeClass();
			//$('#stepmenu_'+i).addClass('active');
		}
	}
}

function stepnocontact(stepId,totalsteps){
	stepno(stepId,totalsteps);
	$('#step-'+stepId).show();
	$('#stepmenu_'+stepId).removeClass();
	$('#stepmenu_'+stepId).addClass('selected');	
}
function stepother(type){
	if(type=='task'){
		$('#'+type).show();
		$('#'+type).addClass('show');
		//$('#stepmenu_'+type).removeClass();
		$('#stepmenu_'+type).addClass('active');
	}
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

</script>

<link rel="stylesheet" type="text/css" href="https://beta.focusfico.com/assets/css/datatables.css">
<link rel="stylesheet" type="text/css" href="https://beta.focusfico.com/assets/css/datatable-extension.css">
<link rel="stylesheet" type="text/css" href="https://beta.focusfico.com/assets/css/date-picker.css">


<div class="modal fade" id="createnotes" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
  <form name="addCMS" action="<?php echo base_url('Notes/save')?>" method="POST" enctype="multipart/form-data">
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
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
    <div id="loadedittask"></div>

    </form>
  </div>
</div>


  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="z-index: 1400;">
        <div class="modal-dialog" role="document">
  <form name="addCMS" method="POST" action="<?php echo base_url('task/save')?>"  enctype="multipart/form-data">

    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Add New Task </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            
        <div class="form-group">
        <label for="name"> Subject </label>
        <input class="form-control" id="task_subject" name="task_subject" type="text" placeholder="Subject" required="required" data-original-title="" title="">
        </div>

        <div class="form-group row">
        <div class="col-lg-6">
        <label for="name"> Start Date </label>
        <div class="input-group">
        <input  type="text"  id="datepicker11" name="start_date" required="required" class="form-control" style="position: unset !important;"></div>
        </div>
        <div class="col-lg-6">
        <label for="name"> Due Date </label>
        <div class="input-group">
        <input  type="text"   id="due_date12" name="due_date" required="required" class="form-control" style="position: unset !important;"></div>
        </div>
        </div>


        <div class="form-group row">
        <div class="col-lg-6">
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

        <div class="col-lg-6">
        <label for="name"> Related To </label>
        <select class="custom-select" name="related_to" id="related_to" onchange="showselectpopup('<?php echo $order->order_id; ?>','<?php echo $order->product_id; ?>',this.value)">
         <option value=""> Choose One...</option>
           <?php
      $totalblock = count($order_dynamic_block);
      $b=1;
      
      foreach($order_dynamic_block as $key => $getResponse){
        $block_name     = $getResponse['block_name'];
        $product_block_id   = $getResponse['block_id'];
        //$getcustom_fields   = $getRes->custom_fields;
        ?>
        <option value="<?php echo $product_block_id; ?>"><?php echo $block_name; ?></option>
        <?php } ?>
        </select>
        </div>
        </div>


 <div class="form-group row"> <div id="loadvalues"></div></div>

        <div class="form-group row">
        <div class="col-lg-6">
        <label for="name"> Status </label>
        <select name="task_status" class="custom-select" id="task_status" required="required">
        <option value="" > Choose One...</option>
  <?php 
        if($task_status)
        {
           foreach($task_status as $keynew=>$status)
             {
              ?>
              <option value="<?php echo $keynew; ?>" ><?php echo $status; ?></option>
              <?php
             }
        }
  ?>
      </select>
        </div>
        </div>


          <div class="form-group">
        <label for="name"> Description </label>
        <textarea  class="form-control" id="description" name="description"  required="required"></textarea>
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


<!---pop up for task ends here--->


<!---pop up for support starts here--->



<!---pop up for support ends here--->

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
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}

function loadnotes(notes_id,action)
{
   $('#formupdate').removeAttr("action");
   $('#formupdate').attr("action",action);

    $.post("<?php echo base_url('notes/loadnotes'); ?>",{notes_id:notes_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}

function loadnotesview(notes_id)
{
    $.post("<?php echo base_url('notes/loadnotesview'); ?>",{notes_id:notes_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
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

</script>
