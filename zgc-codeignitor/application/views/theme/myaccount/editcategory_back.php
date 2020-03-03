
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
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 col-xl-12">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header">
                        <h5><?php echo $title;?></h5>
						  <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModalfat" data-whatever="@mdo">+ Add Block</button>
                      </div>
                      <div class="card-body">
                       <form action="<?php  echo base_url('product/save'); ?>" method="post">
                          <div class="form-group">
                            <label class="col-form-label pt-0" for="category_name">Category Name</label>
                            <input class="form-control" name="category_name" type="text" />
                          </div>
                          <div class="form-group">
                            <label for="category_level">Category Level</label>
							<select name="category_level" class="form-control">
								<option value="0">Master Category</option>
								<option value="1">Category</option>
								<option value="2">Sub Category</option>
								<option value="3">Sub SubCategory</option>
							</select>
                          </div>
						   <div class="form-group">
                            <label for="description">Description</label>
							 <textarea class="form-control" name="description" rows="3"></textarea>
                          </div>
							
							<div id="dynamic_block">
								<div class="default-according style-1" id="accordionoc">
								  <div class="card">
									<div class="card-header bg-primary">
									  <h5 class="mb-0">
										<button class="btn btn-link txt-white" data-toggle="collapse" data-target="#collapseicon" aria-expanded="true" aria-controls="collapse11"><i class="icofont icofont-briefcase-alt-2"></i> Collapsible Group Item #<span class="digits">1</span></button>
									  </h5>
									</div>
									<div class="collapse show" id="collapseicon" aria-labelledby="collapseicon" data-parent="#accordionoc">
									  <div class="card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</div>
									</div>
								  </div>
							   </div>
							</div>
                        </form>
                      </div>
                        <div class="card-footer">
                      <button class="btn btn-primary" type="submit">Submit</button>
                      <input class="btn btn-light" type="reset" value="Cancel">
                    </div>
                    </div>
                  </div>
                 
                </div>
              </div>

		   </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

				<div class="modal fade" id="exampleModalfat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Add Block</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                <label class="col-form-label" for="recipient-name">Block Name:</label>
                                <input class="form-control" type="text" name="block_name" />
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="button">Save</button>
                          </div>
                        </div>
                      </div>
                    </div>
