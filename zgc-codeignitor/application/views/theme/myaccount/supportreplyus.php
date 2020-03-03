<div class="modal-content">
        <div class="modal-body">

          <?php
  $totalblock = count($order_dynamic_block);
    $newcount = $totalblock + 4;
          ?>

    <div class="card">
      <div class="card-header">
        <h5>Reply <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></h5>

      </div>
      <div class="card-body">
        <form name="addCMS" id="addsupportreply" method="POST" action="<?php echo base_url('Support/replysave')?>"  enctype="multipart/form-data">
          <input type="hidden" name="order_id" value="<?php echo $support->order_id; ?>">
          <input type="hidden" name="parent_id" value="<?php echo $support->support_id; ?>">

          <div class="subject-col">
            <div class="row">
              <div class="col-lg-9">
                <h3 class="ticket_subject"><span id="ticket_subject"> #<?php echo $support->support_id; ?> - <?php echo $support->subject; ?> </span> <small> <?php echo $support->description; ?> </small> </h3>
              </div>
             
            </div>
          </div>
          <h3 class="support-reply"><span id="ticket_subject">Reply</span></h3>
          <textarea  class="form-control" id="description" name="description"  required="required"></textarea>
          <div class="form-group attachFile">
            <label for="name"> Attach Files </label>
            <input type="file" name="image" id="image"  >
          </div>
          <div class="support-btn-group">
          <button class="btn btn-primary" type="submit">Add Response</button>
          </div>
        </form>
  
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends--> 
</div>
<script type="text/javascript">
function supportchangestatus(type,value,support_id)
{
     $.post("<?php echo base_url('support/priorityupdate'); ?>",{type:type,value:value,support_id:support_id},function(data) 
    {
    });  
}

$("#addsupportreply").on('submit',(function(e) {
e.preventDefault();
// Get form
var form = $('#addsupportreply')[0];
// Create an FormData object 
var data = new FormData(form);
$.ajax({
url: "<?php echo base_url('Support/replysave');?>",
type: "POST",
enctype: 'multipart/form-data',
data: data,
processData: false,
contentType: false,
cache: false,
timeout: 600000,
success: function(data)   // A function to be called if request succeeds
{
      $('#exampleModaldynamicfield').modal('hide');

      <?php 
      if(isMobile())
      { 
      ?>
      window.location.reload();
      <?php 
      }
      else
      { ?>
      getOrderCustomDetail('<?php echo $support->order_id;?>','support','<?php echo $totalblock+4;?>','<?php echo $newcount;?>');
      <?php  }  ?>


        if(data=='success')
      {
         $('#loadmessageload').html('<div class="alert alert-success">Reply Inserted Successfully</div>');
         return false;
         $('#loadmessageload').show();
      }
      else
      {
         $('#loadmessageload').html('<div class="alert alert-danger">Support not added..Please check fill all deatils</div>');
         $('#loadmessageload').show();  
        }
}
});
}));
</script> 