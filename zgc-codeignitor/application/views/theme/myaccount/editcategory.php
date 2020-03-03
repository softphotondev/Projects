
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
              <div class="col-sm-12 col-xl-12">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header">
                        <h5><?php echo $title;?></h5>
                      </div>
					   <form action="<?php echo base_url('product/saveCategory'); ?>" method="post" enctype="multipart/form-data">

             <?php if($title!='Copy Category') { ?>
					   <input type="hidden" name="category_id" value="<?php echo $categorylist->category_id;?>" />
             <?php } ?>


						  <div class="card-body">
							  <div class="form-group">
								<label class="col-form-label pt-0" for="category_name">Category Name</label>
								<input class="form-control" name="category_name" type="text" value="<?php echo $categorylist->category_name;?>" />
							  </div>
							   <div class="form-group">
								<label class="col-form-label pt-0" for="slug_url">Slug URL</label>
								<input class="form-control" name="slug_url" type="text" value="<?php echo $categorylist->slug_url;?>" />
							  </div>
							  <div class="form-group">
								<label for="category_level">Category Level</label>
									<select name="category_level" class="form-control">
										<option value="0" <?php if($categorylist->category_level==0) { echo 'selected'; }?>>Master Category</option>
										<option value="1" <?php if($categorylist->category_level==1) { echo 'selected'; }?>>Category</option>
										<option value="2" <?php if($categorylist->category_level==2) { echo 'selected'; }?>>Sub Category</option>
										<option value="3" <?php if($categorylist->category_level==3) { echo 'selected'; }?>>Sub SubCategory</option>
									</select>
							  </div>
							   <div class="form-group">
								<label for="description">Description</label>
								 <textarea class="form-control" name="description" rows="3"><?php echo $categorylist->description;?></textarea>
							  </div>


                  <div class="form-group">
                  <label class="col-lg-3 col-form-label">Category Image:</label>
                  <div class="col-lg-9">
                  <div id="filediv" style="margin-bottom: 20px;">
                  <input name="image" type="file" id="image"/>
                  </div>
                  </div>
                  </div>

                  <?php
                  if($categorylist && $categorylist->image)
                  {
                  ?>
              <img id="image_upload_preview" src="<?php echo $categorylist->image; ?>" alt="your image"  width="150px"  height="100px"/>
              <input type="hidden" name="image_old" value="<?php echo $categorylist->image; ?>">
                <?php } ?>




                  <div class="form-group">
                  <label class="col-lg-3 col-form-label">Category (Mobile) ICON:</label>
                  <div class="col-lg-9">
                  <div id="filediv" style="margin-bottom: 20px;">
                  <input name="icon_url" type="file" id="icon_url" />
                  </div>
                  <label>Note : Icon size must be 70*70</label>
                  </div>
                  </div>

                  <?php
                  if($categorylist && $categorylist->icon_url)
                  {
                  ?>
              <img id="image_upload_preview" src="<?php echo $categorylist->icon_url; ?>" alt="your icon url"  width="150px"  height="100px"/>
              <input type="hidden" name="icon_url_old" value="<?php echo $categorylist->icon_url; ?>">
                <?php } ?>


						  </div>
                        <div class="card-footer">
						<button class="btn btn-primary" type="submit">Submit</button>
						<a href="<?php echo site_url('getcategory');?>"><input class="btn btn-light" type="reset" value="Go Back"></a>
					</form>
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
