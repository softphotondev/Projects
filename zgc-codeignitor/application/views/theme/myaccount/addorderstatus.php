
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
              <div class="col-sm-12 col-xl-12">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header">
                        <h5><?php echo $title;?></h5>
                      </div>
					  <form name="addform" method="POST" action="<?php echo site_url('order/addorderstatus')?>" enctype="multipart/form-data">

              <?php
          if(isset($orderstatus))
          {
              $or_status = $orderstatus->orderstatus;
              
              if($title!='Copy Order Status')
              {
              ?>
              <input type="hidden" name="id" value="<?php echo $orderstatus->id; ?>">
           <?php
           }   
          }
          else
          {
            $or_status = '';
          }
              ?>
                      <div class="card-body">
                          <div class="form-group">
                            <label class="col-form-label pt-0" for="category_name">Order Status</label>
                         <input type="text" name="orderstatus"  placeholder="Order Status" class="form-control" required  value="<?php echo $or_status; ?>" />
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