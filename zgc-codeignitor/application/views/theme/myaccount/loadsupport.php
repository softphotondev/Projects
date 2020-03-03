<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <input type="hidden" name="support_id" id="support_id" value="<?php echo $support->support_id; ?>">


        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Update New Suppport </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">

                    <div class="form-group">
        <label for="name"> Subject </label>
        <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required="required" data-original-title="" title="" value="<?php echo $support->subject; ?>">
        </div>

        <div class="form-group">
        <label for="name"> Priority </label>
        <select class="custom-select" name="priority" id="priority" >
  <?php
    if($priority)
       {
        foreach ($priority as $key => $value) 
        {
  ?>
<option value="<?php echo  $value->id; ?>" <?php echo ($support->priority==$value->id)?'selected':''; ?> ><?php echo  $value->priority; ?></option>
<?php } } ?>
                        </select>
        </div>


         <div class="form-group">
        <label for="name"> Status </label>
        <select class="custom-select" name="status" id="status">
        <option value=""> Choose One...</option>
        <?php foreach($support_status as $keysup=>$supphere) { ?>
          <option value="<?php echo $keysup; ?>" <?php echo ($support->status==$keysup)?'selected':''; ?>><?php echo $supphere; ?></option>
        <?php } ?>
        </select>
        </div>

        <div class="form-group">
        <label for="name"> Department </label>
        <select class="custom-select" name="department" id="department" onclick="chanagerelate(this.value)">
        <option value=""> Choose One...</option>
        <?php
        foreach($support_depart as $relate)
        {
        ?>
      <option value="<?php echo $relate->id; ?>" <?php echo ($relate->id==$support->department)?'selected':''; ?> ><?php echo $relate->dept; ?></option>
      <?php } ?>
        <option value="custom">Custom</option>
        </select>
        </div>

         <div class="form-group" id="showdept" style="display: none;">
      <input class="form-control" id="dept" name="dept" type="text" placeholder="Department" data-original-title="" title="">
         </div>
            

        <div class="form-group">
        <label for="name"> Description </label>
        <textarea  class="form-control" id="description" name="description"  required="required"><?php  echo $support->description ?></textarea>
        </div> 


        <div class="form-group" id="upload_file" style="display:<?php echo ($support && $support->image!='')?'block':'none'; ?>;">
        <input type="file" name="image" id="image">
      <?php
          if($support && $support->image!='')
          {
          ?>
      <img id="image_upload_preview" src="<?php echo $support->image; ?>" alt="your image"  width="150px"  height="100px"/>
      <input type="hidden" name="image_old" value="<?php echo $support->image; ?>">
        <?php } ?>
        </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
        </div>