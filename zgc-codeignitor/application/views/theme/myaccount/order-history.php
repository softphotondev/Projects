<style>
.list-staus {
    width: auto;
}
@media(min-width:768px){
	.supportList a {
    display: flex;
    justify-content: center;
    align-items: center; padding:5px 10px;
}
.list-staus h2 {     
	padding: 0px 5px;
    font-size: 20px;
    margin: 0;
    color: #eeff05 !important;
    font-weight: 800;}
}
.summary-tab h3 {     
	font-size: 25px;
    font-weight: 700;
    margin-bottom: 0;
    padding-bottom: 20px; }

</style>

<div class="page-body vertical-menu-mt">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
			
			
<div class="summary-tab col-lg-10 offset-lg-1">
<h3>Projects Summary </h3>

<ul class="projects-status">
         <?php
           if($orderstatusall)
           {
             foreach($orderstatusall as $key=>$orderst)
             {
         ?>
          <li class="list-staus supportList">
          <a href="javascript:void(0);" class="active">
          <h2><?php echo $orderstatus_count[$orderst->status_id]; ?></h2>
		  <span class="list-status-title"> <?php echo $orderst->status_name; ?> </span> </a>
          </li>
    <?php } } ?>
  </ul>
  
  
</div>
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?php echo $title;?></h5>
                  </div>
                  <div class="card-body">
                <form id="bulkdelete" method="post" action="<?php echo base_url('projects/multideleteorder'); ?>">
                   <div class="table-responsive">
                        <table class="display" id="basic-1">
                          <thead>
                            <tr>
                              <th>
                                <button class="btn btn-warning" type="button" id="selectAll2">Select All</button>
                              </th> 
                              <th>Broker Name</th>
                              <th>Client Name</th>
                              <th>View Order</th>
                              <th>Order Number</th>
                              <th>Product</th>
                              <th>Status</th>
                              <th>Payment Status</th>
                              <th>Created Date</th>
                              <?php if($this->session->userdata('user_type')==1){?>
                              <th>Client Access</th>
                              <?php } ?>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
						  
						  foreach($orders as $getOrder){
                               $orderId=$getOrder->order_id;
							   $user_id = $getOrder->user_id;
							   
							   // To get Broker details
							   $clientdetailscheck  = clientdetails($user_id);
                              
                               $clientdetails       = @$clientdetailscheck[0];

							   $phone               = (isset($clientdetails->phone)) ? $clientdetails->phone:'Nil';
                               $brokernamecheck='';
                               if(!empty($clientdetails->parent_user_id)){
                               $brokernamecheck     = orderusersname($clientdetails->parent_user_id);
                               }
							   $brokername          = ($brokernamecheck)?$brokernamecheck:'Nil';				  
								  
							   //$client_details      = $this->Global_model->getClientInfo($user_id); // to get username and pass
                               $info = $this->Global_model->getPersonalInfomationByOrderId($orderId); // to get client information
                               
                               if(!empty($info))
                               {
                                  $clientName  = $info['first-name']. " ". $info['last-name'];
                               }else {
                                   $clientName = $getOrder->first_name. " ". $getOrder->last_name; 
                               }
							    
								// To get Payment status values
								if ($getOrder->payment_status =='1'){ $paymentstatus = "Client Confirmed"; }
								elseif ($getOrder->payment_status =='0') { $paymentstatus = "Client Pending"; }
								elseif ($getOrder->payment_status =='2') { $paymentstatus = "Broker Confirm Client Payment"; }
								elseif ($getOrder->payment_status =='3') { $paymentstatus = "Broker Submit payment To admin";}
								elseif ($getOrder->payment_status =='4') { $paymentstatus = "Admin Confirm Broker Payment - Completed"; } 
								else   { $paymentstatus = "Admin Reject Broker Payment - Rejected"; }
								
								// To get status values
                                $status = "Placed";
								if($getOrder->status==0){ $status = "Incomplete Order"; }
                              ?>
                              <tr>
                                  <td><input type="checkbox" name="ids[]" id="user_id" class="selectall" value="<?php echo $orderId;?>"></td>
                                  <td> <?php echo $brokername; ?></td>
                                   <td><?php echo $clientName; ?></td>
                                  <td><a href="<?php echo base_url('projects/view/'.$orderId); ?>">Order Dashboard</a></td>
                                  <td><?php echo $getOrder->order_number;?></td>
                                  <td><?php echo $getOrder->product_name;?></td>
                                  <td><?php echo $status; ?></td>
                                  <td><?php echo $paymentstatus; ?></td>
                                  <td><?php echo $getOrder->added_date; ?></td>
                                  <?php if($this->session->userdata('user_type')==1){?>
                                  <td><a href="<?php echo site_url('users/clientlogin/'.$user_id);?>" class="btn btn-info btn-xs">Login</a></td>
                                  <?php } ?>
                                  <td><a class="btn btn-danger btn-xs"  href='.base_url('projects/deleteorder/'.$orderId).' onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a></td>
                              </tr>
                          <?php } ?>

                          </tbody>
                          <tfoot>
                              <tr>
                                <th>
                                  <button class="btn btn-warning" type="button" id="selectAll2">Bulk Delete</button>
                                </th> 
                                <th> <button class="btn btn-warning" type="button" id="selectAll2">Bulk Status Update</button></th>
                                <th>Broker Name</th>
                                <th>Client Name</th>
                                <th>Order Number</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th>Payment Status</th>
                                <th>Created Date</th>
                                <?php if($this->session->userdata('user_type')==1){?>
                                <th>Client Access</th>
                                <?php } ?>
                                <th>Action</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                  </form>
                  </div>
                </div>
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
    </script>
