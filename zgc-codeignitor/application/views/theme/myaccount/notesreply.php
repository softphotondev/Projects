<div class="page-body vertical-menu-mt">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title;?></li>
          </ol>
        </div>
        <div class="col-lg-6"> </div>
      </div>
    </div>
  </div>
  <?php if ($this->session->flashdata('msg')) { ?>
  <?php echo $this->session->flashdata('msg'); ?>
  <?php } ?>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h5><?php echo $title;?></h5>
      </div>
      <div class="card-body">
        <form name="addCMS" method="POST" action="<?php echo base_url('Notes/replysave')?>"  enctype="multipart/form-data">
          <input type="hidden" name="order_id" value="<?php echo $notes->order_id; ?>">
          <input type="hidden" name="notes_id" value="<?php echo $notes->notes_id; ?>">
          <div class="subject-col">
            <div class="row">
              <div class="col-lg-9">
                <h3 class="ticket_subject"><span id="ticket_subject"> #<?php echo $notes->notes_id; ?> - <?php echo $notes->subject; ?> </span> <small> <?php echo $notes->notes; ?> </small> </h3>
              </div>
            </div>
          </div>
          <h3 class="support-reply"><span id="ticket_subject">Reply</span></h3>
          <textarea  class="form-control" id="description" name="description"  required="required"></textarea>
          <div class="support-btn-group">
          <button class="btn btn-primary" type="submit">Add Response</button>
          <a class="btn btn-secondary" href="<?php echo base_url('projects/view/'.$notes->order_id); ?>" data-dismiss="modal">
          Back</a>
          </div>
        </form>
        
        
              
        <div class="row">
          <?php
                     if($notescomments)
                     {
                      foreach ($notescomments as $key => $value) 
                      {
                        $username = orderusersname($value->user_id);
                ?>
                

         <div class="commentBox">
		 
		 <div class="commentHeader">
          <h5> Comment : </h5>
		  <!--<a class="btn btn-danger btn-xs"  href="<?php echo base_url('support/deletesupport/'.$value->support_id)  ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger" title=""> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a> --></div>
		  
		  <p class="commentText"> <?php echo $value->message; ?> </p>
          
          <div class="uploadImage"></div>

		  <p class="addedTitle"> Added By : <?php echo $username; ?> </p>
          
          </div>

          <?php  } } ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends--> 
</div>
<script src="https://cdn.ckeditor.com/4.9.2/full-all/ckeditor.js"></script> 
<script type="text/javascript">
CKEDITOR.replace('description');
</script> 
