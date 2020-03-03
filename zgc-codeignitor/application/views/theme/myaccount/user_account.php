<style>
.page-body { padding:0px 15px 0px 15px;}
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
	.mobile-backbtn:hover { background:#000; color:#fff; }
	.mobile-backbtn:hover .fa { color:#fff; }
	
.pendingProducts-col { background: #f7f7f7;
    border: #efefef solid 2px;
    text-align: center; }
.proRow { display:flex; justify-content:center; align-items:center;}	
.proRow h2 { font-size:25px; font-weight:600; color:#1e73be;}
.proRow .price { color:#000; font-size:22px; font-weight:600;}
.proRow .notificationText {     color: #fff;
    font-size: 25px;
    text-transform: uppercase;
    font-weight: 700;
    background: #e5534d;
    border-radius: 5px;
    margin: 15px;
    padding: 15px; cursor:pointer;
}
ul.left-tabs li a img {
    max-width: 20px;
}
.custom-modal-dialog .modal-content { z-index:999; position:absolute;}
.modal-dialog {
    margin-top: 70px;
}
.kapee-mask-overaly {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 998;
    opacity: 0;
    visibility: hidden;
    background-color: rgba(0,0,0,.6);
    -webkit-transition: opacity .50s ease,visibility 0s ease .50s;
    transition: opacity .50s ease,visibility 0s ease .50s;
}
.kapee-mask-overaly.opened {
    opacity: 1;
    visibility: visible;
    -webkit-transition: opacity .25s ease,visibility 0s ease;
    transition: opacity .25s ease,visibility 0s ease;
}
.order-btn-group { 
	/*width:300px; */
	padding-top: 0;
}
.status-btns-up .col-md-4 {
    padding: 0;
    float: right;
}
a.status-btn3:hover {
    color: #fff;
}
.status-btns-up .order-btn-group a {
    border-radius: 0;
    padding: 10px 0;
    margin: 0;
    border-bottom: 1px solid #efefef;
    border-left: 1px solid #efefef;
}
.status-btns-up .order-btn-group a:last-child {
    border-left: 0;
}
.priority-img {
      transform: rotate(-10deg);
}
span#product_status {
      text-transform: uppercase;
      font-weight: bold;
      font-size: 18px;
      border: 5px solid #f00;
      color: #f00;
      padding: 3px 10px;
      position: absolute;
      top: -20px;
      left: -20px;
}
span#product_statusb {
      text-transform: uppercase;
      font-weight: bold;
      font-size: 18px;
      border: 5px solid #1e73be;
      color: #1e73be;
      padding: 3px 10px;
      position: absolute;
      top: -20px;
      left: -20px;
}
span#product_statusg {
      text-transform: uppercase;
      font-weight: bold;
      font-size: 18px;
      border: 5px solid #32CD32;
      color: #32CD32;
      padding: 3px 10px;
      position: absolute;
      top: -20px;
      left: -20px;
}
a.status-btn3 img {
    width: 20px;
}
.status-btns a.status-btn1 {
    background: #124572;
}
.status-btns a.status-btn1:hover {
    background: #03294b;
}
/**/
@media (max-width: 479px){
.row.copyright-wrap img {
    width: 100%;
}
}
@media (max-width: 767px){
.status-btns-up .order-btn-group a, .status-btns a {
    border-bottom: 1px solid #efefef;
}
span#product_statusb, span#product_status {
    font-size: 14px;
    top: -40px;
}
.status-btns-up .order-btn-group a {
    border-left: 0;
}
}
@media (max-width: 991px) and (min-width: 768px){
.status-btns a, .status-btns-up a {
    font-size: 9px !important;
}
.priority-img span {
    font-size: 15px !important;
    padding: 3px 2px !important;
    left: -10px !important;
}
ul.left-tabs li a img {
    margin-right: 3px;
}
.section_tabs ul.left-tabs li a {
    font-size: 12px !important;
}
.col-md-3.leftarea-bar {
    padding: 0;
}
.priority-div span {
    font-size: 14px !important;
    line-height: normal;
}
span.sp-order, span.sp-amount {
    font-size: 14px !important;
}
}
span.invo-btn-div a {    
    padding: 3px 2px 2px 3px !important;    
}
span.sp-order {
    font-size: 16px !important;
	text-transform: uppercase;
}
</style>

<script>
$(document).ready(function(){
<?php 
if(getTotalItem()>0 || $balanceordercount>0) {  ?> 
$("#alertpopup").modal('show');
<?php } ?>
});
</script>

<div class="page-body-wrapper">
<div class="page-body">
<div class="container-fluid">
  <div class="myaccount-profile">
  <section class="section_tabs">
  <div class="container">
    <div class="row">	
	 <?php if(!isMobile()){?>
		<?php $this->load->view(MYACCOUNT_PATH.'front/sidebar_account',['page' => $page]);?>
	 <?php } ?>
    <div class="col-md-9">
		<div class="row" style="margin-bottom:25px;">
	     <div class="col-lg-6"> 
		  <?php if(isMobile()){?>
			<a class="btn mobile-backbtn" href="<?php echo site_url('order/myaccount');?>"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
			<?php } ?>
		</div>
		
		
		<div class="filter_bar col-lg-6">
		 <div class="searchBox" style="float: right;">
			<div class="input-group search-group">
			  <input type="text" class="form-control" id="search" name="search" placeholder="Search" autocomplete="off" onkeyup="searchvalues('1',this.value)">

			  <span style="width:10px;"></span>

			  <select id="changestatus" name="changestatus" class="form-control search-select" onchange="searchvalues('2',this.value)">
				 <option value="">--Select Status--</option>
				<?php
				   if($orderstatus)
				   {
					 foreach ($orderstatus as $key => $value) 
					 {
					  if($orderstatus_count[$key]>0)
					  {
					  ?>
				  <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
					 <?php 
					  }
					 }
				   }
				?>
				</select>
			</div>
		  </div>
		 </div> 
		 
		 
	  </div> 


	
    <?php
    if($orders)
    {
        foreach($orders as $order)
        {	
			$status=(isset($orderstatus[$order->status])&& $orderstatus[$order->status]) ? $orderstatus[$order->status]:'Incomplete';

			$added_date = (isset($order->added_date)&&$order->added_date!=NULL)?date("d F Y", strtotime($order->added_date)):date("d F Y", strtotime($order->last_updated_date));

			$order_amount = '$ '.$order->order_amount;
			$payment_method = $order->payment_method;

			//$order_id =  $order->order_id.'-'.date("Ymd", strtotime($order->added_date));
			
			$order_number = $order->order_number;
			
			$getimage = getimageproduct($order->product_id);

			$order_price1 = getorderprice($order->order_id);
			if((empty($order_price1) || $order_price1='0.00') && empty($order->status)){
				$order_price1 = getroleprice($order->product_id);
			}
			if($order_price1=='0.00'){
				$order_price = $order_amount;
			}else{
				$order_price = '$'.$order_price1;
			}
			if($this->session->userdata('user_type')==3){
				$productAssociateId = $this->Global_model->isUserAccessOfProductById($order->product_id,$this->session->userdata('user_id'));
				if(empty($productAssociateId->product_id)){
					continue;
				}
			}
			$step_stage = $order->step_stage;
			$totalsteps = $order->totalsteps;
			$step=$step_stage;
			if($totalsteps>$step_stage){
				$step=$step_stage+1;
			}
			
			$confirmBrokerPayment = getOrderPaymentStatus($order->order_id,2);
			$clientPaymentConfirm = false;
			if(!empty($confirmBrokerPayment)){
				$clientPaymentConfirm = true;
			}
			
			$confirmAdminPayment = getOrderPaymentStatus($order->order_id,3);
			$clientAdminConfirm = false;
			if(!empty($confirmAdminPayment)){
				$clientAdminConfirm = true;
			}
			$confirmYourPayment = getOrderPaymentStatus($order->order_id,1);
			$confirmedbyClient = false;
			if(!empty($confirmYourPayment)){
				$confirmedbyClient = true;
			}
			
			if($confirmedbyClient!=1){
				if($clientPaymentConfirm==1 || $clientAdminConfirm==1){
					$confirmedbyClient = true;
				}
			}
			?>
	<div id="load_data">
		<div class="ticket-div">
            <div class="priority-div">
                <div class="col-md-4 priority-img">

				<?php if($status=='ORDER IS PROCESSING'){ ?>
                  <span id="product_statusb"><?php echo $status; ?></span>
		         <?php } elseif ($status=='Incomplete') { ?>
				 <span id="product_status"><?php echo $status; ?></span>
				 <?php }elseif ($status=='Completed') { ?>
				 <span id="product_statusg"><?php echo $status; ?></span>
				 <?php } else { ?>
				 <span id="product_status"><?php echo $status; ?></span>
				 <?php } ?>
                </div>
				
                <div class="col-md-8">
				  <span class="order-txt-div"><strong><?php echo orderusersname($order->user_id); ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Order Id #<?php echo $order_number; ?></strong></span>
                  <?php /* ?><span class="invo-btn-div">
				   <a href="<?php echo base_url('order/getOrderDetail/'.$order->order_id); ?>">Order Details</a> 
				  <a target="_blank" href="<?php echo base_url('viewinvoice/'.$order->order_id); ?>">Invoice</a> </span> <?php */ ?>
				  <?php if($this->session->userdata('user_type')==4){?>
					  
						  <?php if(!empty($order_price) || $order_price!='0.00'){?>
						  <?php 
							if($clientPaymentConfirm==1){?>
							<a href="javascript:void();" class="btn btn-orderDelete btn-sm">CLIENT PAYMENT CONFIRMED</a>
						  <?php }else{ ?>
							<a href="javascript:void();" onclick="showpaymentPage('<?php echo $order->order_id;?>','<?php echo $order_price; ?>','2')" data-toggle="modal" data-target="#confirm_order_payment" class="btn btn-orderDetails btn-sm col-md-6">COMFIRM CLIENT PAYMENT</a>
						  <?php } ?>
						  <?php if($clientAdminConfirm==1){?>
							<a href="javascript:void();" class="btn btn-orderDelete btn-sm col-md-6"> ADMIN PAID </a>
						 <?php }else{ ?>
							<a href="javascript:void();" onclick="showpaymentPage('<?php echo $order->order_id;?>','<?php echo $order_price; ?>','3')" data-toggle="modal" data-target="#confirm_order_payment" class="btn btn-orderDetails btn-sm col-md-6"> PAY ADMIN  </a>
						  <?php } ?>
						  <?php } ?>						
						  
				  <?php } ?>
				  <?php if($this->session->userdata('user_type')==5){?>
					  
						  <?php if(!empty($order_price) || $order_price!='0.00'){?>
						  <?php if($confirmedbyClient==1){?>
							<a href="javascript:void();" class="btn btn-orderDelete btn-sm col-md-4" > PAYMENT CONFIRMED </a> 
						 <?php }else{ ?>
							<a href="javascript:void();" onclick="showpaymentPage('<?php echo $order->order_id;?>','<?php echo $order_price; ?>','1')" data-toggle="modal" data-target="#confirm_order_payment" class="btn btn-orderDetails btn-sm col-md-6"> Waiting For Payment Confirm  </a>
						  <?php } ?>
						  <?php } ?>	
						  
				  <?php } ?>
				  
				  
				  
                </div>
            </div>
            
            <div class="row ticket-cols support-info">
                <div class="col-md-4">
                  <img src="<?php echo $getimage; ?>">
                </div>
                <div class="col-md-8 supprt-dtl">
                  <h2><?php echo $order->product_name; ?></h2>
                  <span class="sp-order"><strong>Order Status:</strong> <?php echo $status; ?></span>
                  <span class="sp-amount"><?php echo $order_price; ?></span>
				  <span class="sp-order"><?php echo $order->product_options ?? ''; ?></span>
                  <div class="row supprt-box" style="background: rgba(0,0,0,0.1);">
                    <div class="col-md-4"><strong><?php echo $status; ?></strong><?php echo $added_date; ?></div>
                    <div class="col-md-3"><strong>TOTAL</strong><?php echo $order_price; ?></div>
                    <div class="col-md-5"><strong>PAYMENT METHOD</strong><?php echo $payment_method; ?></div>					
                  </div>	  
                </div>				
            </div>
            <?php /* ?> <div class="status-btns-up">
				  <?php if($this->session->userdata('user_type')==4){?>
					  <div class=""> 
						  <div class="order-btn-group">
						  <?php if(!empty($order_price) || $order_price!='0.00'){?>
						  <?php 
							if($clientPaymentConfirm==1){?>
							<a href="javascript:void();" class="btn btn-orderDelete btn-sm">CLIENT PAYMENT CONFIRMED</a>
						  <?php }else{ ?>
							<a href="javascript:void();" onclick="showpaymentPage('<?php echo $order->order_id;?>','<?php echo $order_price; ?>','2')" data-toggle="modal" data-target="#confirm_order_payment" class="btn btn-orderDetails btn-sm col-md-4">COMFIRM CLIENT PAYMENT</a>
						  <?php } ?>
						  <?php if($clientAdminConfirm==1){?>
							<a href="javascript:void();" class="btn btn-orderDelete btn-sm col-md-4"> ADMIN PAID </a>
						 <?php }else{ ?>
							<a href="javascript:void();" onclick="showpaymentPage('<?php echo $order->order_id;?>','<?php echo $order_price; ?>','3')" data-toggle="modal" data-target="#confirm_order_payment" class="btn btn-orderDetails btn-sm col-md-4"> PAY ADMIN  </a>
						  <?php } ?>
						  <?php } ?>	
							<a  href="<?php //echo base_url('invoices'); ?>" class="btn btn-orderDetails btn-sm col-md-4"> Invoice </a>
						  </div>
					  </div>
				  <?php } ?>
				  <?php if($this->session->userdata('user_type')==5){?>
					  <div class=""> 
						  <div class="order-btn-group">
						  <?php if(!empty($order_price) || $order_price!='0.00'){?>
						  <?php if($confirmedbyClient==1){?>
							<a href="javascript:void();" class="btn btn-orderDelete btn-sm col-md-4"> PAYMENT CONFIRMED </a>
						 <?php }else{ ?>
							<a href="javascript:void();" onclick="showpaymentPage('<?php echo $order->order_id;?>','<?php echo $order_price; ?>','1')" data-toggle="modal" data-target="#confirm_order_payment" class="btn btn-orderDetails btn-sm col-md-4"> WAITING FOR PAYMENT CONFIRM  </a>
						  <?php } ?>
						  <?php } ?>	
						  </div>
					  </div>
				  <?php } ?>
        	</div> <?php */ ?>
            <div class="status-btns">
	              <div class="col-md-4"><a href="<?php echo base_url('order/getOrderDetail/'.$order->order_id); ?>" class="status-btn1"><img src="<?php echo base_url('assets/img/'); ?>view-d.png"> View Details</a></div>
	              <div class="col-md-4"><a href="<?php echo base_url('projects/deleteorder/'.$order->order_id); ?>" onClick="return doconfirm();"  class="status-btn2"><img src="<?php echo base_url('assets/img/'); ?>cancel.png"> Cancel</a></div>
	              <?php if($order->status==0){?>
				  <div class="col-md-4"><a href="<?php echo base_url('completecheckout/'.$order->order_id.'?step='.$step); ?>" class="status-btn3 btn-warning"><img src="<?php echo base_url('assets/img/'); ?>procced-cmp.png"> Proceed To Complete</a></div>
				  <?php } else { ?>
				  <div class="col-md-4"><a target="_blank" href="<?php echo base_url('viewinvoice/'.$order->order_id); ?>" class="status-btn3"> <img src="<?php echo base_url('assets/img/'); ?>procced-cmp.png"> Pay Invoice </a>
				  <?php } ?>
				</div>
        	</div>
	    </div><!-- ticket-div -->
        <?php
	   }
    }
    ?>
      </div>
    </div>
  </div> 
</div> 
</section>
</div>
</div>
</div>
</div>
<?php if(isset($balanceorder) && !empty($balanceorder)){?>
		 <?php if($this->session->userdata('user_type')==5 ){?>
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

	<div class="modal fade" id="confirm_order_payment" tabindex="-1" role="dialog" aria-labelledby="confirmorderpayment" aria-hidden="true" >
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h2>Confirm Payment</h2>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body" id="confirm-payment-message">

			</div>
		</div>
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


function searchvalues(type,value)
{
    $.post("<?php echo base_url('Order/loadsearch'); ?>",{type:type,value:value},function(data) 
    {
          $('#load_data').html(data);
    }); 
} 



function showpaymentPage(orderId,price,type)
{    
    //var paymentdata = $('#confirm-order-pay').serialize();
    $.ajax({
      type:'GET',
      url:'<?php echo base_url('Ajax/getPaymentconfirm')?>',
      data:'order_id='+orderId+'&price='+price+'&type='+type,
      beforeSend: function () {
        //$('.modal-body').css('opacity', '.5');
		 $('#confirm-payment-message').html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');
      },
      success:function(response){
          $('#confirm-payment-message').html(response);
		  
		  
      }
    });
}

</script>
