<div class="page-body vertical-menu-mt">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
			
	
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Broker  Invoice List</h5>
                  </div>

                <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); } ?>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                  <tr>
                            <th>S.No</th>
                            <th>Order ID</th>
                            <th>Client Name</th>
                            <th>Prdouct name</th>
                            <th>Order Amount</th>
                            <th>Payment Method</th>
                             <th>Broker Price (Broker Need to Pay)</th>
                            <th>Client Payment Status</th>
                            <th>Broker Payment Status</th>
                           
                  </tr>
                        </thead>
                    <tbody>
                    <?php 
                      foreach($orders as $key=>$order)
                     {
                     $name = orderusersname($order->user_id);
                     $order_amount = '$'.$order->order_amount;
                     $payment_method = $order->payment_method;

                     $payment_method = $order->payment_method;

                     if($order->payment_status==0)
                     {
                     $clientstatus = "Client Pending";
                     $clientclass ='btn btn-danger btn-xs';
                     }
                     else if($order->payment_status==1)
                     {
                          $clientstatus ="Waiting for Broker Confirm";
                          $clientclass ='btn btn-danger btn-xs';
                     }
                     else
                     {
                        $clientstatus ="Payment Completed"; 
                        $clientclass ='btn btn-success btn-xs';
                     }

                     if($order->payment_status==0)
                     {
                         $brokerstatus ="Client Pending";
                         $brokerclass="btn btn-danger btn-xs";
                     }
                     else if($order->payment_status==1)
                     {
                           $brokerstatus ="Waiting for Broker Confirm";
                           $brokerclass="btn btn-danger btn-xs";
                     } 
                     else if($order->payment_status==2)
                     { 
                      $brokerstatus ="Waiting for Broker Payment";
                      $brokerclass="btn btn-danger btn-xs";          
                     }
                     else if($order->payment_status==3)
                     {
                         $brokerstatus ="Pending Admin Confirmation";
                         $brokerclass="btn btn-danger btn-xs"; 
                     }
                     else if($order->payment_status==4)
                     {
                        $brokerstatus ="Payment Completed";
                        $brokerclass ='btn btn-success btn-xs'; 
                     }
                     else if($order->payment_status==5)
                     {
                       $brokerstatus ="Payment Rejected";
                       $brokerclass ='btn btn-danger btn-xs'; 
                     }

                    ?>
                    <tr>

                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $order->order_number; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $order->product_name; ?></td>
                        <td><?php echo $order_amount; ?></td>
                        <td><?php echo $payment_method; ?></td>
                        <td>$ <?php echo $order->broker_amount; ?></td>
                        <td>
                          <button class="<?php echo $clientclass;  ?>" type="button" data-original-title="btn btn-danger btn-xs" title=""><?php echo $clientstatus; ?></button>
                        </td>

                        <td>
<?php
   if($order->payment_status==3)
   {
   ?>
<button class="<?php echo $brokerclass;  ?>" type="button" data-original-title="btn btn-danger btn-xs" title=""   data-toggle="modal" data-target="#paymentstatusadmin" onclick="confirmboxhereadmin('<?php echo $order->order_id; ?>','payment_status_admin')" ><?php echo $brokerstatus; ?></button>

   <?php
   }
   else
   {
    ?>
      <button class="<?php echo $brokerclass;  ?>" type="button" data-original-title="btn btn-danger btn-xs" title=""><?php echo $brokerstatus; ?></button>
    <?php
   }
?>
                          </td>
                        

                    </tr>
                    <?php } ?>
                    </tbody>
                      </table>
           </div>


                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
  
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
 <input type="hidden" name="value" value="4" >
<p> By clicking confirm you are acknowledging that you have received payment from your broker and their order invoice will be marked as completed in their user dashboard. ?</p>
<button type="submit" class="btn btn-success btn-xs">Confirm</button>    
</form>
</div>
</div>
</div>
</div>


<script type="text/javascript">
 function confirmboxhereadmin(id,field)
{
     $('#idadmin').val(id);
}
</script>
    