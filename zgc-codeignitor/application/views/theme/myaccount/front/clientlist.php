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
    <?php /*if(!$this->session->userdata('usertype')==4){?>
    <a href="<?php echo base_url('addclient'); ?>"  class="btn btn-info mbot25" style="float: right;">Add Client</a>
    <?php } */?>

       <br><br>

  <div class="details-wrap">                                    
    <div class="details-box orders">

       <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); } ?>

              <div class="table-responsive">
              <table class="table" id="basic-2">
                        <thead>
                          <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Phone No</th>
                            <th>Email</th>
                            <th>Create date</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php

                             if($clients)
                             {
                               foreach($clients as $key=>$cli)
                               {
                                $name =  orderusersname($cli->user_id);
                                if($cli->added_date!='0000-00-00 00:00:00')
                                $added_date = date("m/d/Y", strtotime($cli->added_date));
                                else
                                $added_date = '';  
                             ?>
            <tr>
                    <td><?php echo $key+1; ?></td>
                             <td><?php echo $name; ?></td>
                            <td><?php echo $cli->username; ?></td>
                            <td><?php echo $cli->intial_password; ?></td>
                            <td><?php echo $cli->phone; ?></td>
                            <td><?php echo $cli->email; ?></td>
                            <td><?php echo $added_date; ?></td>
                            
              <td> 
                <a class="btn btn-orderDetails mobile-orderDetails" href="<?php echo base_url('addclient/'.$cli->user_id); ?>" >Edit</a>

                 <a class="mobileinvoice btn btn-orderDelete" onClick="return doconfirm();" href="<?php echo base_url('users/deleteuser/'.$cli->user_id) ?>" >Delete</a>
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
