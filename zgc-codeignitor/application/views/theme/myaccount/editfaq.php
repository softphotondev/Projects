
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
					          <form name="addform" method="POST" action="<?php echo site_url('Faq/editfaq/'.$faqbroker->id)?>" enctype="multipart/form-data">

                              <input type="hidden" name="id" value="<?php echo $faqbroker->id; ?>">


                      <div class="card-body">
                          <div class="form-group">
                            <label class="col-form-label pt-0" for="category_name">Question Type</label>
                          <select name="type" class="form-control" required id="type">
                            <option value="">--Select--</option>
                           <?php foreach ($questype as $key => $value) { ?>
<option value="<?php echo $value->id; ?>"><?php echo $value->title; ?></option>
                          <?php  } ?> 
                        </select>
                          </div>


                           <div class="form-group">
                         <label>Title</label>
                        <input type="text" name="title"  placeholder="Title" class="form-control" required value="<?php echo $faqbroker->title; ?>"/>
                          </div>
              

               <div class="form-group">
                             <label>Enter Message</label>
                    <textarea name="description"  id="description" rows="5" class="form-control"><?php echo $faqbroker->description; ?></textarea>
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
<script src="https://cdn.ckeditor.com/4.9.2/full-all/ckeditor.js"></script>   
<script>
CKEDITOR.replace('description');
$('#type').val('<?php echo $faqbroker->type;  ?>');
</script>     

        