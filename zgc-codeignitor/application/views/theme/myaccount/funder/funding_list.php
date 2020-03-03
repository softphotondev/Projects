<div class="page-body-wrapper">
<div class="page-body">
<div class="container-fluid">
  <div class="myaccount-profile">
    <div class="row">
     <?php $this->load->view(MYACCOUNT_PATH.'front/sidebar_account',['page' => $page]);?>
    <div class="col-lg-9 card">
    <div class="row" style="margin-bottom:25px;">
    <div class="col-lg-12">
    <h4 class="order-card-title"> <?php echo $title; ?> </h4>
      <div class="details-wrap">                                    
        <div class="details-box orders">
           <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); } ?>
                  <div class="table-responsive">
                  <table class="table" id="basic-2">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Bank Name</th>
                                <th>Applied Date</th>
                                <th>Status</th>
                                <th>Approval Amount</th>
                                <th>Verification Needed</th>
                                <th>Date Received</th>
                                <th>Experian</th>
                                <th>Transunion</th>
                                <th>Equifax</th>
                                <th>Notes</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                  <?php
                     if($funding_list){
                        
                       foreach($funding_list as $resfunding){
                     ?>
                    <tr>
                        <td><?php echo $resfunding->id;?></td>
                        <td><?php echo $resfunding->fn_bank;?></td>
                        <td><?php echo $resfunding->fn_dateapplied;?></td>
                        <td><?php echo $resfunding->fn_status;?></td>
                        <td><?php echo $resfunding->fn_approvalamount;?></td>
                        <td><?php echo $resfunding->fn_verificationneeded;?></td>
                        <td><?php echo $resfunding->fn_datereceived;?></td>
                        <td><?php echo $resfunding->fn_experian;?></td>
                        <td><?php echo $resfunding->fn_transunion;?></td>
                        <td><?php echo $resfunding->fn_equifax;?></td>
                        <td><?php echo $resfunding->notes;?></td>
                      <td> 
                        <a class="btn btn-orderDetails mobile-orderDetails" href="<?php echo base_url('editfunding/'.$resfunding->id); ?>" >Edit</a>
                         <!--<a class="mobileinvoice btn btn-orderDelete" onClick="return doconfirm();" href="<?php //echo base_url('users/deleteuser/'.$cli->user_id) ?>" >Delete</a>-->
                      </td> 
                      </tr>

                   <?php } } ?>
                    </tbody>
                  </table>
                </div>
            </div>

         </div>
     </div> 
    </div> 

      </div>
    </div>
  </div>
</div>
</div>
</div>
<style type="text/css">
 .mobileinvoice
 {
  display: block !important;
 } 
</style>
