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
        <form name="addCMS" method="POST" action="<?php echo base_url('Tickets/replysave')?>"  enctype="multipart/form-data">
          <input type="hidden" name="user_id" value="<?php echo $tickets->user_id; ?>">
          <input type="hidden" name="parent_id" value="<?php echo $tickets->ticket_id; ?>">
          <div class="subject-col">
            <div class="row">
              <div class="col-lg-9">
                <h3 class="ticket_subject"><span id="ticket_subject"> #<?php echo $tickets->ticket_id; ?> - <?php echo $tickets->subject; ?> </span> <small> <?php echo $tickets->description; ?> </small> </h3>
              </div>
              <div class="col-lg-3">
                <select class="custom-select" name="status" id="status"  onclick="supportchangestatus('1',this.value,'<?php  echo $tickets->ticket_id; ?>')">
                  <option value=""> Choose One...</option>
                  <?php foreach($support_status as $keysup=>$supphere) { ?>
                  <option value="<?php echo $keysup; ?>" <?php echo ($tickets->status==$keysup)?'selected':''; ?>><?php echo $supphere; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <h3 class="support-reply"><span id="ticket_subject">Reply</span></h3>
          <textarea  class="form-control" id="description" name="description"  required="required"></textarea>
          <div class="form-group attachFile">
            <label for="name"> Attach Files </label>
            <input type="file" name="image" id="image">
          </div>
          <div class="support-btn-group">
          <button class="btn btn-primary" type="submit">Add Response</button>
          <a class="btn btn-secondary" href="<?php echo base_url('ticket'); ?>" data-dismiss="modal">
          Back</a>
          </div>
        </form>
        
        

        <?php
        $comments = getallcommentsticket($tickets->ticket_id); ?>
        
        
        <div class="row">
          <?php
                     if($comments)
                     {
                      foreach ($comments as $key => $value) 
                      {
                        $username = orderusersname($value->user_id);
                ?>
                

         <div class="commentBox">
		 
		 <div class="commentHeader">
          <h5> Comment : </h5>
		 <!-- <a class="btn btn-danger btn-xs"  href="<?php echo base_url('tickets/deleteticket/'.$value->ticket_id)  ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger" title=""> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a> -->

    </div>
		  
		  <p class="commentText"> <?php echo $value->message; ?> </p>
          
          <div class="uploadImage">
          <?php
          if($value && $value->image!='')
          {
          ?>
          <img id="image_upload_preview" src="<?php echo $value->image; ?>" alt="your image"/>
            <?php } ?> </div>

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


function supportchangestatus(type,value,support_id)
{
     $.post("<?php echo base_url('tickets/priorityupdate'); ?>",{type:type,value:value,support_id:support_id},function(data) 
    {
    });  
}

</script> 