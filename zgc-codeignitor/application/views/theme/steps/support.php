<div>
	<h4 class="order-card-title"> Support <hr/></h4>
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
				  <p class="otitle"> <?php echo $supp->subject; ?></p>
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
				 <p> Priority : <?php echo $priority; ?> 
					<!--<select class="custom-select" name="priority" id="priority"  onclick="supportchangestatus('2',this.value,'<?php  echo $supp->support_id; ?>')">
			<?php
			if($priority)
			{
			foreach ($priority as $key => $value) 
			{
			?>
			<option value="<?php echo  $value->id; ?>" <?php echo ($supp->priority==$value->id)?'selected':''; ?> ><?php echo  $value->priority; ?></option>
			<?php } } ?>
			</select> -->

			</p> 
				  <p> Status :  <?php echo $status; ?> 

			<!--<select class="custom-select" name="status" id="status"  onclick="supportchangestatus('1',this.value,'<?php  echo $supp->support_id; ?>')">
					<option value=""> Choose One...</option>
					<?php foreach($support_status as $keysup=>$supphere) { ?>
					  <option value="<?php echo $keysup; ?>" <?php echo ($supp->status==$keysup)?'selected':''; ?>><?php echo $supphere; ?></option>
					<?php } ?>
					</select>-->

				  </p>

				  <p> Department :  <?php echo getdepartment($supp->department);?></p>

				    <p> Description :  <?php echo $supp->description;?></p>  

				    <p>Date & Time : <?php echo $date; ?></p>

				  </div>
				  </div>
				  </div>
				  <div class="col-lg-3 d-flex"> 
				  <div class="order-btn-group">
				  <!--<a href="javascript:void(0);" class="btn btn-orderDetails" onclick="replysupport('<?php echo $supp->support_id; ?>');"> Reply </a>
					 <a target="_blank"  onclick="loadsupport('<?php echo $supp->support_id;  ?>','<?php echo base_url('support/save'); ?>');"  class="btn btn-orderDelete"> Update </a>

					<a   href="javascript:void(0);" onclick="return deletesupportreply('<?php echo $supp->support_id; ?>');"  class="btn btn-orderDelete"> Delete </a>-->

				  </div>
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

			<div class=""> 

			<div class="col-lg-12">
			<div class="productDetails"> <hr/>Reply : <?php echo $replyMsg?> </div> <br/>
			<?php
			if($getResponse && $getResponse->image!='')
			{
			?>
			<img id="image_upload_preview" src="<?php echo $getResponse->image; ?>" alt="your image" heoght="100" width="100"/>
			<?php } ?>
			<br>
			<?php echo $replyDate;?> 
			<br/>
			<?php echo $replyusername;?>


			</div>	</div>	

			<?php } ?>


			<?php } ?>
			<?php   //if(count($replyData)>0) { ?>
			 <div class="order-btn-group">
				  <a href="javascript:void(0);" class="btn btn-orderDetails" onclick="replysupport('<?php echo $supp->support_id; ?>');" style="margin-top:10px;float:right;width:25%;"> Reply </a>
			</div>
			<?php //} ?>



				  
				</div>	   
				</div>

				<?php } } ?> 

				</div> 
  </div>