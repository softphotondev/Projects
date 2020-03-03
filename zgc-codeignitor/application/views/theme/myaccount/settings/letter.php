<div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3><?php echo $title;?></h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('myaccount');?>">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $title;?></li>
                  </ol>
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
  <ul class="menuBtn">
  <li><a href="<?php echo base_url('addletters'); ?>">Add Letters</a></li><li>
  </ul>
  </div></div></div>


                
                  <div class="card-body">
                    <div class="table-responsive product-table">
                   <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">

                      <table class="display dataTable no-footer" id="1_wrapper_datatable" role="grid" aria-describedby="basic-1_info">
                        <thead>
                              <th>S.No</th>
                              <th>Subject</th>
                               <th>Visible In Block</th>
                              <th class="text-center">Actions</th>
                        </thead>
                        <tbody>

                          <?php
                            if($letter){
                               foreach($letter as $key=>$lett)
                               {
                          ?>
                          <tr role="row" class="odd">
                          <td><?php echo $lett->id; ?></td>
                          <td><a href="#"><?php echo $lett->subject; ?></a></td>
                          <td><?php if($lett->is_visible_block==1){ echo 'Yes'; } else { echo 'NO';} ?></td>
                          <td>
						<a class="btn btn-success btn-xs" href="<?php echo base_url('editletters/'.$lett->id); ?>" data-original-title="btn btn-danger btn-xs" title="">Edit</a>
                          <a class="btn btn-danger btn-xs"  href="<?php echo base_url('deleteletters/'.$lett->id) ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>
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
              <!-- Individual column searching (text inputs) Ends-->
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
