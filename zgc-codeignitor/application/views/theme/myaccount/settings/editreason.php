
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
<div class="row">
<div class="col-lg-3"><h5><?php echo $title;?></h5> </div>
</div></div>
					  
					      <form name="addform" method="POST" action="<?php echo site_url('Setting/savereason')?>" enctype="multipart/form-data">
                   
          <input type="hidden" name="id" id="id" value="<?php echo $credit_report_reason->id; ?>">

                      <div class="card-body">
                          
                <div class="form-group">
                <label>Enter Reason</label>
                <input type="text" name="title"  placeholder="Reason" class="form-control" required value="<?php echo $credit_report_reason->title; ?>" />
                </div>

                <input type="hidden" name="parent_id" id="parent_id" value="0">

               <!-- <div class="form-group">
                <label>Color</label>
                <select name="color" id="color" class="form-control" style="width: 100%;">
                <option value="">Select Color-</option>
                <option value="#dd4b39">Red</option>
                <option value="#E4A514">Yellow</option>
                <option value="#099B28">Green</option>
                </select>
                </div>-->
					
                      </div>
                        <div class="card-footer">
                      <button class="btn btn-primary" type="submit">Submit</button>
                       <a class="btn btn-light" href="<?php echo site_url('reasonmanage')?>">Back</a>
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



 <script src="https://cdn.ckeditor.com/4.9.2/full-all/ckeditor.js"></script>   
<script>
CKEDITOR.replace('message');
</script>     
