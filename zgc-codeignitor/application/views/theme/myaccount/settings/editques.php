
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
               <form action="<?php  echo base_url('Setting/saveques'); ?>" method="post"  >
    <?php
      if(isset($pre_order_question))
      {
        $question = $pre_order_question->question;
  
        ?>
  <input type="hidden" name="id" value="<?php echo $pre_order_question->id; ?>" >  
       <?php
      }
          else
          {
      $subject = $message ='';
          }
      ?>

                      <div class="card-body">

                    <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Question:</label>
                    <div class="col-lg-9">
                    <input class="form-control" name="question" type="text" required="required" value="<?php echo $question; ?>"/>
                    </div>
                    </div>   

                    <div class="form-group row">
                    <label class="col-lg-3 col-form-label"></label>
                    <div class="col-lg-9">
                      <button class="btn btn-primary" type="submit">Submit</button>
                      <a class="btn btn-light" href="<?php echo base_url('manageques'); ?>">Back</a>
                    </div>
                    </div> 


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


<script src="https://cdn.ckeditor.com/4.5.0/full-all/ckeditor.js"></script>
<script>
CKEDITOR.replace('message');
CKEDITOR.config.allowedContent = true;
</script>