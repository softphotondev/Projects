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
    <p> <strong> Payment Method <?php echo $invo->payment_method; ?> </strong> </p>
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