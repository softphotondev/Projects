<?php 
// Create two new DateTime-objects...
$date1 = new DateTime('2006-04-12T12:30:00');
//$date1 = new DateTime('2006-04-12T12:30:00');
$date2 = new DateTime('2006-04-14T11:30:00');

// The diff-methods returns a new DateInterval-object...
$diff = $date2->diff($date1);

// Call the format method on the DateInterval-object
$day_diffrence =  $diff->format('%a Day and %h hours ago');

?>
  <div class="ticketview-box">
      <div class="ticket-message-customer-name"> <?php echo ucfirst($notes->first_name.' ' . $notes->last_name);?>  </div>
          <div class="ticket-message-message-time">  
       <?php echo $day_diffrence;?> [<?php echo date('m/d/Y H:s',strtotime($notes->datetime));?>] </div>
      <div class="ticket-main-info">
        <div class="ticket-info-subject"><?php echo ucfirst($notes->subject);?>
        <p><?php echo $notes->notes;?></p>
        </div>
       
      </div>
    </div> 
    <div id="note-replylist">
      <?php foreach($notesReply_list as $resnotelist){?>
      <div class="ticket-message-box">
        <div class="ticket-info-icon pull-left"><span class="messageTitle"> S </span></div>
        <div class="ticket-message-info">
          <div class="ticket-message-customer-name"> <?php echo ucfirst($resnotelist->first_name.' ' . $resnotelist->last_name);?>  </div>
          <div class="ticket-message-message-time">  
        <?php echo $day_diffrence;?> [<?php echo date('m/d/Y H:s',strtotime($resnotelist->created_date));?>] </div>
        <hr>
          <div class="custome-content">
            <p class="ticket-description"> <?php echo $resnotelist->message;?> </p>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
        <form class="ticket-form" id="add_notes_reply" method="POST" enctype="multipart/form-data">
             <input type="hidden" name="order_id" value="<?php echo $notes->order_id; ?>">
              <input type="hidden" name="notes_id" value="<?php echo $notes->notes_id; ?>">	
              <div class="form-group col-lg-12">
                <textarea  class="form-control" id="message" name="message"  required="required" placeholder="Enter reply message .. "></textarea>
              </div>
               <div class="form-group col-lg-12">
                    <button type="button" onclick="addNotesReplied()" class="btn btn-primary">Send</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
        </form>
