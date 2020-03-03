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
              <div class="col-lg-6">
                <h1> <?php echo $title; ?> </h1>
              </div>
              <div class="col-lg-6">
                <div class="input-group searchdata-table">
                  <input type="text" class="form-control" placeholder="Search" onkeyup="searchvalues(this.value)">
                </div>

              <div class="col-lg-12"> <a href="javascript:void(0);"  data-toggle="modal" data-target="#addpayment"class="btn btn-newTicket" style="float: right;">Add New Method</a> </div>

              </div>
            </div>
            <br>

                <?php if ($this->session->flashdata('msg')) { ?>
                <?php echo $this->session->flashdata('msg'); } ?>
			
            <div class="row" id="load_data">
                <?php
                   if($paymentmethods){
                       $i=1;
                     foreach($paymentmethods as $getPaymode)
                     {
                   ?>
                <div class="col-lg-6">
                  <div class="custom-orderBox">
                    <div class="custom-header">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="orderplaced-row">
                            <p class="keyNumber"> <?php echo $i; ?> </p>
                            <div class="order-col">
                              <p class="otitle"><?php echo $getPaymode->name; ?> </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="order-details-section">
                      <div class="row">
                        <div class="col-lg-8">
                          <p> <?php echo $getPaymode->description; ?> </p>
                        </div>
                        <div class="col-lg-4"> 
                        <?php if($getPaymode->status==1){?>
                          <a  class="btn btn-success btn-xs btn-block">Active</a>
                        <?php }else{ ?>
                          <a  class="btn btn-danger btn-xs btn-block">Inactive</a>
                        <?php } ?>
                          <a onclick="loadpayment('<?php echo $getPaymode->payment_id;  ?>');" class="btn btn-orderDetails" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">Update</a>
                          
                          <a  class="btn btn-orderDetails"  onClick="return doconfirm();" href="<?php echo base_url('Myaccount/deletepayment/'.$getPaymode->payment_id); ?>" data-original-title="btn btn-danger btn-xs" title="">Delete</a>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php $i++;} } ?>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="addpayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form name="addCMS" method="POST" action="<?php echo base_url('Myaccount/paymentsave')?>"  enctype="multipart/form-data">
      <input type="hidden" name="parent_id" id="ticket_id">
    <input type="hidden" name="status" id="status" >

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Add New Ticket </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">

        <div class="form-group">
            <label for="name"> Name </label>
            <input class="form-control" id="name" name="name" type="text" placeholder="Name" required="required" data-original-title="" title="">
          </div>
         
          <div class="form-group">
            <label for="name"> Description </label>
            <textarea  class="form-control" id="description" rows="5"  name="description"  required="required"></textarea>
          </div>
          <div class="form-group">
            <label for="name"> Status </label>
            <select name="form-control" name="status">
              <option value="">Select</option>
               <option value="1">Active</option>
                 <option value="0">Inactive</option>
            </select>
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

<!---pop up for track starts here--->
<div class="modal fade" id="exampleModalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form  method="POST" enctype="multipart/form-data"  action="<?php echo base_url('Myaccount/paymentsave'); ?>">
      <div id="loadedittask"></div>
    </form>
  </div>
</div>
<script>
 function loadpayment(payment_id)
 {
    $.post("<?php echo base_url('Myaccount/loadpayment'); ?>",{payment_id:payment_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
 }


 function searchvalues(value)
 {
  $.post("<?php echo base_url('Myaccountsearch/searchpayment'); ?>",{value:value},function(data) 
    {
          $('#load_data').html(data);
    });
 }
 </script> 
