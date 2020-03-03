
<input type="hidden" name="notes_id" id="notes_id" value="<?php echo $notes->notes_id; ?>">

<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle"> Update Notes </h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">

<div class="form-group">
<label for="name"> Subject </label>
<input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required="required" data-original-title="" title="" value="<?php echo $notes->subject; ?>">
</div>

<div class="form-group">
<label for="name"> Description </label>
<textarea  class="form-control" id="notes" name="notes"  required="required" rows="6" cols="100"><?php echo $notes->notes; ?></textarea>
</div> 

</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
<button class="btn btn-primary" type="submit">Save changes</button>
</div>
</div>