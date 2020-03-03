
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
					   <form action="<?php  echo base_url('product/saveCategory'); ?>" method="post" enctype="multipart/form-data">
                          <div class="card-body">
                              <div class="form-group">
                                <label class="col-form-label pt-0" for="category_name">Category Name *</label>
                                <input class="form-control" name="category_name" type="text" required="required" />
                              </div>
                              <div class="form-group">
                                <label for="description">Description</label>
                                 <textarea class="form-control" name="description" rows="3"></textarea>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-3 col-form-label">Category Image:</label>
                                <div class="col-lg-9">
                                  <div id="filediv" style="margin-bottom: 20px;">
                                    <input name="image" type="file" id="image" required="required"/>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-3 col-form-label">Category (Mobile) ICON:</label>
                                <div class="col-lg-9">
                                  <div id="filediv" style="margin-bottom: 20px;">
                                    <input name="icon_url" type="file" id="icon_url" required="required"/>
                                  </div>
                                  <label>Note : Icon size must be 70*70</label>
                                </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    var _URL = window.URL || window.webkitURL;
   $("#icon_url").change(function (e) {
    var file, img;
    if ((file = this.files[0])) {
        img = new Image();
        var objectUrl = _URL.createObjectURL(file);
        img.onload = function () {

          if( this.width > 70 || this.height > 70 ) 
            {
               alert('Image size must less then 70*70');
            }
            _URL.revokeObjectURL(objectUrl);
        };
        img.src = objectUrl;
    }
}); 
</script>      
