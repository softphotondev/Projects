
  
<input type="hidden" name="id" id="id" value="<?php echo $usertrack->id; ?>">

<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle"> Update </h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">

<div class="form-group">
<label for="name"> Experian Track </label>
<input class="form-control" id="exp_track" name="exp_track" type="text"  required="required" data-original-title="" title="" value="<?php echo $usertrack->exp_track; ?>">
</div>


<div class="form-group">
<label for="name"> Equafax Track </label>
<input class="form-control" id="equ_track" name="equ_track" type="text" required="required" data-original-title="" title="" value="<?php echo $usertrack->equ_track; ?>">
</div>


<div class="form-group">
<label for="name"> Transunion Track  </label>
<input class="form-control" id="trans_track" name="trans_track" type="text" required="required" data-original-title="" title="" value="<?php echo $usertrack->trans_track; ?>">
</div>


</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
<button class="btn btn-primary" type="submit">Save changes</button>
</div>
</div>