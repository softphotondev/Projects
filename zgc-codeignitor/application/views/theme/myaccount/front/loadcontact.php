
  
<input type="hidden" name="id" id="id" value="<?php echo $contact->id; ?>">

<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle"> Reply </h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">

<div class="form-group">
<label for="name"> Message </label>
<label for="name"> <?php echo $contact->message; ?> </label>
</div>


<div class="form-group">
<label for="name"> Reply </label>
<textarea class="form-control" id="reply" name="reply" type="text"  required="required"></textarea>
</div>


</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
<button class="btn btn-primary" type="submit">Save changes</button>
</div>
</div>