
<div class="page-body vertical-menu-mt">

          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
     <!-- <h3><?php echo $title;?></h3> -->
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $title;?></li>
                  </ol>
                </div>
                <div class="col-lg-6">
				<ul class="menuBtn">
<li><a href="<?php echo base_url('addfaq'); ?>">Add Faq</a></li><li><a href="<?php echo base_url('manageques'); ?>">FAQ Question Type</a></li><li><a href="<?php echo base_url('addquestype'); ?>">Add FAQ Question Type </a></li>
				</ul>
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
					  <form name="addform" method="POST" action="<?php echo site_url('faq/addquestype')?>" enctype="multipart/form-data">
                      <div class="card-body">
                          <div class="form-group">
                            <label class="col-form-label pt-0" for="category_name">Title</label>
                         <input type="text" name="title"  placeholder="Title" class="form-control" required />
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