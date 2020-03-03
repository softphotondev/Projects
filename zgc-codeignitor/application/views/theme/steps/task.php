<style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 5px 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  width:100%;
  margin-left:15px;
}
div#orderview_step_detail {
    background: #fff url(http://localhost/zgc-beta/assets/img/popup-bg.png) no-repeat center center / cover;
}
h4.order-card-title {
    background: #1e73be;
    color: #fff;
    padding: 10px 20px;
}
.order-details-section h2.order-title {
    padding-bottom: 0;
}
.button2 {background-color: #008CBA;} /* Blue */
.button3 {background-color: #f44336;} /* Red */ 
.button4 {background-color: #e7e7e7; color: black;} /* Gray */ 
.button5 {background-color: #555555;} /* Black */
.order-col {
padding: 5px 8px; 
}
.img-fluid { 
height:25px; 
}
ul.profile-usermenu.steeperBtn a.thumb-col {
    background: #1e73be;
    color: #fff;
    border-radius: 0;
    padding: 10px;
}
.row.productDetails button.button.col-lg-4 {
    margin: 0;
    padding: 10px 0;
    line-height: normal;
}
.thumb-col:after {
    color: #fff;
}
.order-details-section {
    padding-bottom: 0;
}
.custom-orderBox.customTabs {
    border-radius: 0;
}
.row.productDetails .button1:hover {
    background: #2a822e;
}
.row.productDetails .button2:hover {
    background: #04607e;
}
.row.productDetails .button3:hover {
    background: #ed3223;
}
.inner-cont{
	padding-bottom: 20px;
}
.order-btn-group {
    float: right;
        padding: 0;
}
.col-lg-4.d-flex {
    display: inline-block !important;
}
ul.profile-usermenu.steeperBtn a.thumb-col:hover {
    background: #124572;
}
ul.profile-usermenu.steeperBtn a.thumb-col.active {
    background: #db4432;
}
ul.profile-usermenu.steeperBtn a.thumb-col.active:hover {
    background: #ed3223 !important
}
.orderplaced-row p {
    line-height: normal;
    font-size: 14px;
}

/********/
@media (min-height: 480px) {
  .order-col {
    position: -webkit-sticky;
    position: sticky;
    bottom: 0;
	font-size:11px;
  }
}
@media (min-width: 992px) and (max-width: 1200px) {
.row.productDetails button.button.col-lg-4 {
    font-size: 13px;
}
}
</style>
	<div id="step-<?php echo $stepno ;?>">
	<h4 class="order-card-title">TASK</h4>
			<div class="row">
				<?php
				if($task){
					foreach($task as $key=>$tas){
						$start_date = date("m-d-Y", strtotime($tas->start_date));
						$due_date = date("m-d-Y", strtotime($tas->due_date));
						$assigned_to = orderusersname($order->user_id);
						
						$tas_fields ='';
						if($tas->order_detail_ids!=0){
							$tas_fields = getalltaskfields($tas->order_id,$tas->order_detail_ids);
						}
						/*else
							$tas_fields ='nil'; 
						if(($tas->task_status==26 || $tas->task_status==27)){
							$tas_fields ='nil';  
						}*/
							$counter = $key+1;
				?>
				<div class="col-lg-12"> 
				<div class="custom-orderBox customTabs">
				<div class="custom-header">
				  <div class="row">
					  <div class="col-lg-12"> 
						  <div class="orderplaced-row">
							  <div class="order-col col-lg-4">
								  <p class="otitle">Start Date: <?php echo $start_date; ?></p>
								  <p class="otitle">Due Date: <?php echo $due_date; ?></p>
								  <!-- <p class="osubtitle"> 	 </p>-->
							  </div>
							  <!--<div class="order-col">								  
								   <p class="osubtitle">  </p> 
							  </div>-->
							  <div class="order-col col-lg-4">
								  <p class="otitle" style="color:#008CBA;">  <?php echo $tas->status_name; ?> </p>
								  <p class="osubtitle" style="color:#f44336;">  <?php echo $tas->priority_name; ?> </p>
							  </div>
							  <div class="col-lg-4 d-flex"> 
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
				<div class="order-details-section">
					  <div class="row">
						  <div class="col-lg-12"> 
							<h2 class="order-title"> <?php echo $tas->task_subject; ?> </h2>
							  <div class="row productDetails">
								  <div class="col-lg-12 inner-cont"> 
								  <?php  if(!empty($tas_fields)) {?>	
									 <h3> TASK FIELDS </h3>
									 <p> TASK FIELDS : <?php echo $tas_fields; ?> </p>
								 <?php } ?> 
									<p> <?php echo $tas->description; ?> </p> 
								  </div>
								    <button class="button button1 col-lg-4">UPDATE TASK AS COMPLETE</button>
									<button class="button button2 col-lg-4">UPDATE TASK AS STARTED</button>
									<button class="button button3 col-lg-4">UPDATE TASK AS CAN NOT COMPLETE</button>
							  </div>
						  </div>
						  
					  </div>
				  </div>
				</div>	   
				</div>
				<?php  } } ?>   
			</div>
  </div>
