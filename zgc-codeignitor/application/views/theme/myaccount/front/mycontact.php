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
              </div>
            </div>
            <br>

                <?php if ($this->session->flashdata('msg')) { ?>
                <?php echo $this->session->flashdata('msg'); } ?>
			
            <div class="row" id="load_data">
                <?php

                             if($contact)
                             {
                               foreach($contact as $key=>$cont)
                               {

                  $status  = ($cont->reply!='')?'Replied':'New';


                             ?>
                <div class="col-lg-6">
                  <div class="custom-orderBox">
                    <div class="custom-header">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="orderplaced-row">
                            <p class="keyNumber"> <?php echo $key+1; ?> </p>
                            <div class="order-col">
                              <p class="otitle"><?php echo $cont->First_Name.' '.$cont->Last_Name; ?> </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="order-details-section">
                      <div class="row">
                        <div class="col-lg-8">
                          <h6> Email : <?php echo $cont->Email_Address; ?> </h6>
                          <h6> Phone : <?php echo $cont->phone; ?> </h6>
                          <p> <?php echo $cont->message; ?> </p>
                        </div>
                        <div class="col-lg-4"> 

                          <a onclick="loadmycontact('<?php echo $cont->id;  ?>');" class="btn btn-orderDetails" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">Reply</a>

<a  class="btn btn-orderDetails"  onClick="return doconfirm();" href="<?php echo base_url('Myaccount/deletecontact/'.$cont->id); ?>" data-original-title="btn btn-danger btn-xs" title="">Delete</a>

    <a class="btn btn-orderDetails" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title=""><?php echo $status; ?></a>

                         </div>
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

<!---pop up for track starts here--->
<div class="modal fade" id="exampleModalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form  method="POST" enctype="multipart/form-data"  action="<?php echo base_url('Myaccount/replycontact'); ?>">
      <div id="loadedittask"></div>
    </form>
  </div>
</div>
<script>
 function loadmycontact(contactid)
 {
    $.post("<?php echo base_url('Myaccount/loadcontact'); ?>",{contactid:contactid},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
 }


 function searchvalues(value)
 {
  $.post("<?php echo base_url('Myaccountsearch/searchtracking'); ?>",{value:value},function(data) 
    {
          $('#load_data').html(data);
    });
 }
 </script> 
