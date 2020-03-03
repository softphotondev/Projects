<script>
$(document).ready(function(){
<?php 
if($balanceordercount>0) {  ?> 
$("#alertpopup").modal('show');
<?php } ?>
});
</script>


<div class="page-body"> 
<div class="page-content"> 
<a class="btn mobile-backbtn" href="<?php echo site_url('order/myaccount');?>"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
<h1 class="page-tab-title"> My Orders </h1>
<div class="grid-icons-2">
<a href="<?php echo site_url('services/');?>" class="bg-theme round-medium shadow-huge scale-hover"><img src="<?php echo base_url('assets/home/'); ?>images/dashboard-icon.png"><span class="color-theme">Shop</span></a> 
<?php /*?>
<a href="<?php echo site_url();?>membership/usercontrol/dashboard" class="bg-theme round-medium shadow-huge scale-hover"><img src="<?php echo base_url('assets/home/'); ?>images/dashboard-icon.png"><span class="color-theme">Membership Dashbaord</span></a> <?php */ ?>  

<a href="<?php echo site_url('order/getAllOrders');?>" class="bg-theme round-medium shadow-huge scale-hover"><img src="<?php echo base_url('assets/home/'); ?>images/order-icon.png"><span class="color-theme">Orders</span></a> 

<a href="<?php echo base_url('myinformation'); ?>" class="bg-theme round-medium shadow-huge scale-hover"><img src="<?php echo base_url('assets/home/'); ?>images/myaccount-icon.png"><span class="color-theme">My Account Details</span></a> 

<a href="<?php echo base_url('myuploads'); ?>" class="bg-theme round-medium shadow-huge scale-hover"><img src="<?php echo base_url('assets/home/'); ?>images/uploads-icon.png"><span class="color-theme"> My Uploads</span></a> 	

<a href="<?php echo base_url('creditreport'); ?>" class="bg-theme round-medium shadow-huge scale-hover"><img src="<?php echo base_url('assets/home/'); ?>images/credit-report-icon.png"><span class="color-theme"> Credt Report</span></a> 	

<a href="<?php echo base_url('invoices'); ?>" class="bg-theme round-medium shadow-huge scale-hover"><img src="<?php echo base_url('assets/home/'); ?>images/invoices-icon.png"><span class="color-theme"> INVOICES </span></a> 	

<a href="<?php echo base_url('tracking'); ?>" class="bg-theme round-medium shadow-huge scale-hover"><img src="<?php echo base_url('assets/home/'); ?>images/tracking-icon.png"><span class="color-theme"> TRACKING </span></a>

<a href="<?php echo base_url('support'); ?>" class="bg-theme round-medium shadow-huge scale-hover"><img src="<?php echo base_url('assets/home/'); ?>images/support-icon.png"><span class="color-theme"> SUPPORT </span></a>  	
<a href="<?php echo base_url('logout'); ?>" class="bg-theme round-medium shadow-huge scale-hover"><img src="<?php echo base_url('assets/home/'); ?>images/logout-icon.png"><span class="color-theme"> LOGOUT </span></a>  
</div>    
</div>


<?php if(isset($balanceorder) && !empty($balanceorder)){?>
		 <?php if($this->session->userdata('user_type')==4 || $this->session->userdata('user_type')==5 ){?>
	<div class="modal fade" id="alertpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
			
			<?php
			   foreach($balanceorder as $balorder)
			   {
				$getimagebal = getimageproduct($balorder->product_id);
				$order_amountbal = '$ '.$balorder->order_amount;
				if($balorder->step_stage==$balorder->totalsteps){
					$stepStage=$balorder->step_stage;
				}else if($balorder->totalsteps>$balorder->step_stage){
					$stepStage=$balorder->step_stage+1;
				}else{
					$stepStage=$balorder->step_stage;
				}
				if($balorder->step_stage==0)
				{
				  $this->session->set_userdata('order_id',$balorder->order_id);
				  $url = base_url('checkout');
				}
				else
				{
					$url = base_url('completecheckout/'.$balorder->order_id.'?step='.$stepStage);
				}
				?>
				
			<h2> <?php echo $balorder->product_name; ?> </h2>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">
			
				
				<div class="pendingProducts-col">				
					<div class="row proRow">					
						<div class="col-lg-4">
							<img src="<?php echo $getimagebal; ?>" class="img-fluid img-hover">
						</div>
						<div class="col-lg-8">
							<a href="<?php echo $url; ?>"><div class="notificationText">Click here to complete order</div></a>							
							<!--<p class="price"> <?php //echo $order_amountbal; ?> </p>-->
						</div>
					</div>
				</div>
			<br>
			<?php
			   }
			?>
			</div>
		</div>
		</div>
	</div>
	
<?php } } ?>
