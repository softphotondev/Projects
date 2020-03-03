
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
<li><a href="<?php echo base_url('departmentshow'); ?>">Back</a></li>
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
					  <form name="addform" method="POST" action="<?php echo site_url('Tickets/savedept')?>" enctype="multipart/form-data">

              <input type="hidden" name="id" id="id" value="<?php echo $support_depart->id; ?>">
                      <div class="card-body">
                          <div class="form-group">
                            <label class="col-form-label pt-0" for="dept">Department</label>
                         <input type="text" name="dept"  placeholder="Department" class="form-control" required  value="<?php echo $support_depart->dept; ?>" />
                          </div>
						  

					
                      </div>
                        <div class="card-footer">
                      <button class="btn btn-primary" type="submit">Submit</button>

                      <a  class="btn btn-light" href="<?php echo base_url('departmentshow'); ?>">Back</a>
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