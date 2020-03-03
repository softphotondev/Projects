<div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3><?php echo $title;?></h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
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
                  <div class="card-header">
                    <h5><?php echo $title;?></h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive product-table">
                   <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">

                      <table class="display dataTable no-footer" id="basic-1" role="grid" aria-describedby="basic-1_info">
                        <thead>
                              <th>S.No</th>
                              <th>User Type</th>
                               <th>Status</th>
                              <th class="text-center">Actions</th>
                        </thead>
                              <tbody>
                <?php
                  if($roles)
                   {
                       foreach($roles as $key=>$user)
                       {

                        $status = ($user->status==1)?'Active':'Inactive';
                ?>
              <tr>
                <td><?php echo $key+1; ?></td>
                <td><a href="#"><?php echo $user->user_type_name; ?></a></td>
                <td><?php echo $status; ?></td>

                 <td>
<a class="btn btn-success btn-xs" href="<?php echo base_url('addusertype/'.$user->user_type); ?>" data-original-title="btn btn-danger btn-xs" title="">Edit</a>
                          <a class="btn btn-danger btn-xs"  href="<?php echo base_url('users/deleteusertype/'.$user->user_type) ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>
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