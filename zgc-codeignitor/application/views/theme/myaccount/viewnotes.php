<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle"> View Notes </h5>
<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">

<div class="form-group">
<?php echo $notes->notes; ?>	
</div> 


        <div class="row">
          <?php
                     if($notescomments)
                     {
                      foreach ($notescomments as $key => $value) 
                      {
                        $username = orderusersname($value->added_by);
                ?>
                
         <div class="commentBox">
		 
		 <div class="commentHeader">
          <h5> Comment : </h5>
		  <!--<a class="btn btn-danger btn-xs"  href="javascript:void(0);" onClick="return deletenotesreply('<?php echo $value->notes_id; ?>','<?php echo $notes->order_id; ?>');"  data-original-title="btn btn-danger" title=""> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>--> </div>
		  
		  <p class="commentText"> <?php echo $value->notes; ?> </p>
          
		  <p class="addedTitle"> Added By : <?php echo $username; ?> </p>
          
          </div>

          <?php  } } ?>
        </div>


</div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
</div>
</div>