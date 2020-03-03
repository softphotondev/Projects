<div class="page-body-wrapper">
  <div class="page-body">
    <div class="container-fluid">
      <div class="myaccount-profile my-upload">
        <div class="row">
          <?php if(!isMobile()){?>
           <?php $this->load->view(MYACCOUNT_PATH.'front/sidebar_account',['page' => $page]);?>
          <?php } ?>
          <?php if(isMobile()){?>
          <div class="col-lg-3"> <a class="btn mobile-backbtn" href="<?php echo site_url('order/myaccount');?>"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a></div>
          <?php } ?>
          <div class="col-lg-9">
            <div class="row">
              <div class="col-lg-3">
                <h1> <?php echo $title; ?> </h1>
              </div>
               <div class="col-lg-3">
        <?php if ($this->session->flashdata('msg')) { ?>
            <?php echo $this->session->flashdata('msg'); } ?>
            <?php
      if($this->session->userdata('user_type')==4) 
      { 
      if($title!="Invoices")
      {
      ?>
            <a href="<?php echo base_url('invoices'); ?>"  class="btn btn-info mbot25" style="float: right;">Client Invoices</a> <br>
            <br>
            <?php
      }
      else
      {
      ?>
            <a href="<?php echo base_url('invoiceadmin'); ?>"  class="btn btn-info mbot25" style="float: right;">Admin Invoices</a>
            <?php
      }
      }
      ?>



              </div>


              <div class="col-lg-6">
                <div class="input-group searchdata-table">
                  <input type="text" class="form-control" placeholder="Search" onkeyup="searchvalues(this.value)">
                </div>
              </div>
            </div>
            <br>
            <div class="row" id="load_data">
              <?php

                             if($invoices)
                             {
                               foreach($invoices as $key=>$invo)
                               {
            $name =  orderusersname($invo->user_id);
            $order_id =  $invo->order_id.'-'.date("Ymd", strtotime($invo->added_date));

            if($this->session->userdata('user_type')==5) 
            {
               if($invo->payment_status==0)
               {
                 $clientstatus = 'CLICK TO MARK AS PAID';
                  $class ='mobileinvoice btn btn-orderDelete';
               }
               else if($invo->payment_status==1)
               {
                 $clientstatus = 'Waiting for Payment Confirm';
                  $class ='mobileinvoice btn btn-orderDelete';
               }
               else  if($invo->payment_status==2 || $invo->payment_status==3)
               {
                    $clientstatus = 'Waiting for Payment Confirm';
                     $class ='mobileinvoice btn btn-orderDelete';
               }
               else if($invo->payment_status==4)
               {
                    $brokerstatus = 'Payment Completed';
                    $class ='btn btn-orderDetails mobile-orderDetails';
               }
               else
               {
                    $brokerstatus = 'Payment Rejected';
                    $class ='mobileinvoice btn btn-orderDelete';
               }
            }
            else
            {
               if($invo->payment_status==0)
               {
                    $brokerstatus = 'Client Payment Pending';
                    $class ='mobileinvoice btn btn-orderDelete';
               }
               else if($invo->payment_status==1)
               {
                    $brokerstatus = 'Waiting for Broker Payment Confirm';
                    $class ='mobileinvoice btn btn-orderDelete';
               }
               else if($invo->payment_status==2)
               {
                $brokerstatus = 'Click To Pay Admin';
                 $class ='mobileinvoice btn btn-orderDelete';
               }
               else if($invo->payment_status==3)
               {
                   $brokerstatus = 'Waiting for Admin Confirm';
                    $class ='mobileinvoice btn btn-orderDelete';
               }
               else if($invo->payment_status==4)
               {
                   $brokerstatus = 'Broker Payment Completed';
                    $class ='btn btn-orderDetails mobile-orderDetails';
               }
               else if($invo->payment_status==5)
               {
                   $brokerstatus = 'Broker Payment Rejected';
                    $class ='mobileinvoice btn btn-orderDelete';
               }
            }
                             ?>
              <div class="col-lg-12">
                <div class="custom-orderBox">
                  <div class="custom-header">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="orderplaced-row">
                          <p class="keyNumber"> <?php echo $key+1; ?> </p>
                          <div class="order-col">
                            <p class="otitle"> <?php echo $invo->product_name; ?> </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="order-details-section creditReport">
                    <div class="row">
                      <div class="col-lg-8">
                        <h2 class="order-title"> <?php echo $name; ?> </h2>
                        <div class="productDetails"> </div>
   <p> <strong> Order ID <?php echo $order_id; ?> </strong>  </p>
    <p> <strong> Amount $ <?php echo $invo->order_amount; ?> </strong> </p>
    <p> <strong> Payment Method	<?php echo $invo->payment_method; ?> </strong> </p>
                      </div>
                      <div class="col-lg-4">
                        <?php if($this->session->userdata('user_type')==5) { ?>
                        <div>
                          <?php
                            if($invo->payment_status==0)
                            {
                            ?>
                          <a class="<?php echo $class; ?>" href="javascript:void(0);" data-toggle="modal" data-target="#paymentstatusclient"  onclick="confirmboxhere('<?php echo $invo->order_id; ?>','1')"> <?php echo $clientstatus; ?> </a>
                          <?php
                            }
                            else
                            {
                            ?>
                          <a class="<?php echo $class; ?>" href="javascript:void(0);" > <?php echo $clientstatus; ?> </a>
                          <?php } ?>
                        </div>
                        <?php }  ?>
                        <?php if($this->session->userdata('user_type')==4) { ?>
                        <div>
                          <?php
                          if($invo->payment_status==1)
                          {
                            ?>
                          <a class="<?php echo $class; ?>" href="javascript:void(0);" data-toggle="modal" data-target="#paymentstatus"  onclick="confirmboxhere('<?php echo $invo->order_id; ?>','2')"> <?php echo $brokerstatus; ?> </a>
                          <?php
                          }
                          else if($invo->payment_status==2)
                          {
                          ?>
                          <a class="<?php echo $class; ?>" href="javascript:void(0);" data-toggle="modal" data-target="#paymentstatusadmin"  onclick="confirmboxhere('<?php echo $invo->order_id; ?>','3')"> <?php echo $brokerstatus; ?> </a>
                          <?php
                          }
                          else
                          {
                            ?>
                          <a class="<?php echo $class; ?>" href="javascript:void(0);" > <?php echo $brokerstatus; ?> </a>
                          <?php
                          }
                          ?>
                        </div>
                        <?php }  ?>
                        <a class="btn btn-orderDetails" href="<?php echo base_url('viewinvoice/'.$invo->order_id); ?>" target="_blank" >Invoice</a> </div>
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
<script>
function confirmboxhere(id,value)
{
  if(value==1)
  {
    $('#idclient').val(id);
  }
  else if(value==2)
  {
    $('#idbroker').val(id);
  }
  else if(value==3)
  {
     $('#idadmin').val(id);
      $.post("<?php echo base_url('Myaccount/showclientdetails'); ?>",{id: id},function(html) 
     {
     $('#loadclientdetails').html(html); 
     });
  }
}


function searchvalues(value)
{
$.post("<?php echo base_url('Myaccountsearch/serachinvoices'); ?>",{value:value},function(data) 
    {
          $('#load_data').html(data);
    });
}
</script>
<style type="text/css">
 .mobileinvoice
 {
  display: block !important;
 } 
</style>
<div class="modal fade none-border modalDesign" id="paymentstatusadmin">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Confirm Payment ?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form name="addform" method="POST" action="<?php echo site_url('Order/updatestatus')?>">
          <input type="hidden" name="order_id" id="idadmin">
          <input type="hidden" name="value" value="3" >
          <p> By clicking confirm you are verifying that you have made your payment to the payment account you are selecting below. Payments after 5:00PM PST will be processed next business day.</p>
          <div id="loadclientdetails"></div>
          <button type="submit" class="btn btn-primary">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade none-border" id="paymentstatus">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Confirm Payments ?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body"  style="overflow: scroll; height: 180px;">
        <form name="addform" method="POST" action="<?php echo site_url('Order/updatestatus')?>">
          <input type="hidden" name="order_id" id="idbroker">
          <input type="hidden" name="value" value="2" >
          <div> By clicking confirm you are acknowledging that you have received payment from your client and their order invoice will be marked as completed in their user dashboard. ? <br>
            <div class="col-md-12" style="margin-top:10px;">
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Confirm</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade none-border" id="paymentstatusclient">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Confirm Payment ?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body"  style="overflow: scroll; height: 180px;">
        <form name="addform" method="POST" action="<?php echo site_url('Order/updatestatus')?>">
          <input type="hidden" name="order_id" id="idclient">
          <input type="hidden" name="value" value="1">
          <div> By clicking confirm you are verifying that you have made your payment to the payment account you selected during check out.? <br>
            <div class="col-md-12" style="margin-top:10px;">
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Confirm</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
