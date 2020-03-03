<input type="hidden" name="payment_id" id="payment_id" value="<?php echo $payment->payment_id; ?>">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle"> Update Payment </h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
    <div class="modal-body">
        <div class="form-group">
            <label for="name"> Name </label>
            <input class="form-control" id="name" name="name" type="text" placeholder="Name" required="required" data-original-title="" title="" value="<?php echo $payment->name;  ?>">
          </div>
         
          <div class="form-group">
            <label for="name"> Description </label>
            <textarea  class="form-control" id="description" rows="5"  name="description"  required="required"><?php echo $payment->description;  ?></textarea>
          </div>
          <div class="form-group">
            <label for="name"> Status </label>
            <select class="form-control" name="status">
                <option value="">Select</option>
                <option value="1" <?php if($payment->status==1){ echo 'selected';}?>>Active</option>
                <option value="0" <?php if($payment->status==0){ echo 'selected';}?>>Inactive</option>
            </select>
          </div>
        </div>

          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Update</button>
          </div>
    </div>
</div>
