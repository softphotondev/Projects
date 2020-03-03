<div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3><?php echo $title;?></h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $title;?></li>
                  </ol>
                </div>
                <div class="col-lg-6">
                
                </div>
              </div>
            </div>
		 </div>

                
                  <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Individual column searching (text inputs) Starts-->
              <div class="col-sm-12">
                <div class="card">


                  <div class="card-header"><div class="row">
<div class="col-lg-3"> <h5><?php echo $title;?></h5> </div>
<div class="col-lg-9"> 
<ul class="menuBtn"><li><a href="<?php echo base_url('addfundstatus'); ?>"> Add Funding status </a></li></ul>
</div></div></div>



                  <div class="card-header">
                    <h5><?php echo $title;?></h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">


                      <table class="display" id="basic-1">
                        <thead>
                                          <tr>
                                  <th>S.No</th>
                                  <th>Status</th>
                                  <th class="text-center">Actions</th>
                                  </tr>
                        </thead>


                              <tbody>
                <?php
                  if($fundingstatus)
                   {
                       foreach($fundingstatus as $key=>$ques)
                       {
                ?>
              <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $ques->status; ?></td>
                                 <td>
<a class="btn btn-success btn-xs" href="<?php echo base_url('editfundstatus/'.$ques->id); ?>" data-original-title="btn btn-danger btn-xs" title="">Edit</a>


             <a class="btn btn-danger btn-xs"  href="<?php echo base_url('Setting/deletefundstatus/'.$ques->id) ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>
                          </td>
              </tr>
              
              <?php } } ?>
              

            </tbody>



                      </table>
				   </div>
                  </div>
                </div>
              </div>
              <!-- Individual column searching (text inputs) Ends-->
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>