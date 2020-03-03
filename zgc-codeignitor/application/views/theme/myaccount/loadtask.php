        <input type="hidden" name="task_id" id="task_id" value="<?php echo $task->task_id; ?>">

        <?php
$start_date = date("m/d/Y", strtotime($task->start_date));
$due_date = date("m/d/Y", strtotime($task->due_date));
        ?>
        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Update New Task </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            
        <div class="form-group">
        <label for="name"> Subject </label>
        <input class="form-control" id="task_subject" name="task_subject" type="text" placeholder="Subject" required="required" data-original-title="" title="" value="<?php echo $task->task_subject; ?>">
        </div>
   

        <div class="form-group row">
        <div class="col-lg-6">
        <label for="name"> Start Date </label>
        <div class="input-group">
        <input class="form-control" type="text"  id="datepicker11_edit" name="start_date" required="required" value="<?php echo $start_date; ?>"  style="position: unset !important;"></div>
        </div>
        <div class="col-lg-6">
        <label for="name"> Due Date </label>
        <div class="input-group">
        <input class="form-control" type="text"  id="due_date12_edit" name="due_date" required="required" value="<?php echo $due_date; ?>"  style="position: unset !important;"></div>
        </div>
        </div>

        <div class="form-group row">
        <div class="col-lg-6">
        <label for="name"> Priority </label>
      <select class="custom-select" name="priority" id="priority" required="required">
      <option value="" >--Select Priority--</option>
      <?php
      if($priority)
      {
      foreach ($priority as $key => $value) 
      {
      ?>
      <option value="<?php echo  $value->id; ?>" <?php echo ($task->priority==$value->id)?'selected':''; ?> ><?php echo  $value->priority; ?></option>
      <?php } } ?>
      </select>


        </div>
        <div class="col-lg-6">
        <label for="name"> Related To </label>
        <select class="custom-select" name="related_to" id="related_to" onchange="showselectpopup('<?php echo $task->order_id; ?>','<?php echo $orders->product_id; ?>',this.value)">
         <option value=""> Choose One...</option>
           <?php
      $totalblock = count($order_dynamic_block);
      $b=1;
      
      foreach($order_dynamic_block as $key => $getResponse){
        $block_name     = $getResponse['block_name'];
        $product_block_id   = $getResponse['block_id'];
        //$getcustom_fields   = $getRes->custom_fields;
        ?>
        <option value="<?php echo $product_block_id; ?>" <?php echo ($product_block_id==$task->order_detail_ids)?'selected':''; ?>><?php echo $block_name; ?></option>
        <?php } ?>
        </select>
        </div>
        </div>


         <div class="form-group" id="showrelate" style="display: none;">
      <input class="form-control" id="task_relate" name="task_relate" type="text" placeholder="Relate" data-original-title="" title="">
         </div>


        <div class="form-group row">
        <div class="col-lg-6">
        <label for="name"> Status </label>
        <select name="task_status" class="custom-select" id="task_status" required="required">
        <option value=""> Choose One...</option>
  <?php 
        if($task_status)
        {
           foreach($task_status as $keynew=>$status)
             {
              ?>
              <option value="<?php echo $keynew; ?>" <?php echo ($task->task_status==$keynew)?'selected':''; ?> ><?php echo $status; ?></option>
              <?php
             }
        }
  ?>
      </select>
        </div>
        </div>

          <div class="form-group">
        <label for="name"> Description </label>
        <textarea  class="form-control" id="description" name="description"  required="required"><?php echo $task->description; ?></textarea>
        </div> 

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
        </div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( "#datepicker11_edit" ).datepicker({ minDate: 0});
$( "#due_date12_edit" ).datepicker({ minDate: 0});
</script>        