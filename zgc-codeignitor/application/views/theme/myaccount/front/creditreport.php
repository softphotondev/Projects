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
                <!--<div class="col-lg-6">
                  <div class="input-group">
                    <a  class="btn btn-orderDelete" href="javascript:void(0);" data-original-title="btn btn-orderDelete">Get New Report</a> 
                  </div>
                </div>-->
            </div>
            <?php if ($this->session->flashdata('msg')) { ?>
            <?php echo $this->session->flashdata('msg'); } ?>
            <div class="row">
          <?php
             if($order_identity_report)
             {
               foreach($order_identity_report as $key=>$order_identity)
               {
              $date = ($order_identity->created_at!=NULL)?date("m/d/Y H:i:s", strtotime($order_identity->created_at)):'';
              //$order_id =  $order_identity->order_id.'-'.date("Ymd", strtotime($order_identity->created_at));
             ?>
              <div class="col-lg-6">
                <div class="custom-orderBox">
                  <div class="custom-header">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="orderplaced-row">
                          <p class="keyNumber"> <?php echo $key+1; ?> </p>
                          <div class="order-col">
                            <p class="otitle"> Date <?php echo $date; ?> </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="order-details-section creditReport">
                    <div class="row">
                      <div class="col-lg-7">
                        <h2 class="order-title"> <?php echo orderusersname($order_identity->user_id); ?> </h2>
                        <div class="productDetails"> 
                            <?php echo $order_identity->title; ?>
						</div>
                        <!--<p> <strong> Order ID </strong>	<?php //echo $order_id ?? 0; ?> </p>-->
                      </div>
                    <div class="col-lg-5"> <a href="#credit_<?php echo $order_identity->id; ?>" onclick="viewreport('<?php echo $order_identity->id;  ?>');" class="btn btn-orderDetails" href="javascript:void(0);" data-original-title="btn btn-orderDetails" title="">View Report</a> 
                </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } } ?>
            </div>
            <?php
            if($order_identity_report)
            {
               foreach($order_identity_report as $key=>$order_identity)
               {
                ?>
              <div id="credit_<?php echo $order_identity->id; ?>" style="border:2px solid #efefef;padding:25px;margin-top:20px;display: none; background:#fff;">
              <h4 class="order-card-title"> Credit Report </h4>
              <a onclick="viewreport('<?php echo $order_identity->id;  ?>');" class="btn btn-success btn-danger" href="javascript:void(0);" data-original-title="btn btn-danger btn-danger" style="float:right;">Close Report</a> <?php echo $order_identity->message; ?> </div>
            <?php } }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!---pop up for track starts here--->
<div class="modal fade" id="exampleModalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div id="loadedittask"></div>
  </div>
</div>
<script>
 function viewreport(id)
 {
  $('#credit_'+id).toggle();
    /*$.post("<?php //echo base_url('Myaccount/creditreport_load'); ?>",{id:id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); */
 }

 </script> 
