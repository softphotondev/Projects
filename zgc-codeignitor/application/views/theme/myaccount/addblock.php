
	<div class="page-body vertical-menu-mt">
          <!-- <div class="container-fluid">
           <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3><?php echo $title;?></h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Manage Block</li>
                    <li class="breadcrumb-item active"><?php echo $title;?></li>
                  </ol>
                </div>
                <div class="col-lg-6">
                </div>
              </div>
            </div>
          </div>-->

          <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 
          
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 col-xl-12">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header">
                        <h5><?php echo $title;?></h5>
						<span class="text-right"><a href="javascript:void();" data-toggle="modal" data-target="#add_new_block" class="btn btn-info">New Block</a></span>
                      </div>
						<form action="<?php  echo base_url('saveblock'); ?>" method="post" enctype="multipart/form-data">
						  <div class="card-body">
							    <div class="form-group">
									<label class="col-form-label" for="block_name">Block Name:</label>
									<input class="form-control" type="text" name="block_name" required />
								</div>
							    <div class="form-group">
									<label class="col-form-label" for="module_selected">Select Module for API Seperate Call:</label>
									<select class="form-control" name="module_selected">
										<option value="">Select</option>
										<option value="identityiq">IDENTITYIQ</option>
										<option value="contract">CONTRACT</option>
									</select>
							   </div>
						  </div>
							<div class="card-footer">
							  <button class="btn btn-primary" type="submit">Submit</button>
							  <input class="btn btn-light" type="reset" value="Cancel">
							</div>
						</form>
                    </div>
                  </div>
                 
                </div>
              </div>

		   </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>