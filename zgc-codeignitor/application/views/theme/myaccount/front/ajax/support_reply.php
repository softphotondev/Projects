
 <!-- Modal Header -->
 
        <div class="modal-header popup_head">
          <h4 class="modal-title">Incident No - <?php echo $supports->support_ticket_number;?></h4>
          <button type="button" class="close" data-dismiss="modal"><img src="<?php echo site_url();?>/assets/img/close-btn.png"></button>		 
        </div>
        <!-- Modal body -->       

              <div class="ticket_popup_box row">
                <div class="ticket_popup-left col-md-9">
                  <div class="ticket-info-div">
                    <div class="ticket-img">
                        <img src="<?php echo site_url();?>/assets/img/ticket-img.png"> <span><?php echo $supports->status_name;?></span>
                    </div>
                    <h2><?php echo $supports->subject;?></h2>
                    <div class="row sprt-cols">
                        <div class="col-md-3"><strong>Priority</strong> <?php echo $supports->priority_name;?></div>
                        <div class="col-md-4"><strong>Department</strong> <?php echo $supports->department_name;?></div>
                        <div class="col-md-5"><strong>Order Number</strong> <?php echo $supports->order_number;?></div>
                    </div>
                  </div>
                </div>
				<?php if ($supports->image!='') { ?>
                <div class="attch-file col-md-3">
                  <span>Attached File</span>
                  <a href="<?php echo base_url().$supports->image; ?>" download><img src="<?php echo site_url();?>/assets/img/attach-img.png"></a>
                </div>
				<?php } ?>
            </div>
			
			<?php foreach($supportReply_list as $supportreply){?>
			<div class="ticket_popup_boxes row">
                <div class="col-md-2 t-boxes-lft">
                    <span><?php echo ucfirst($supportreply->first_name[0]); ?></span>
                </div>
                <div class="col-md-10 t-boxes-ryt">
                    <h4><?php echo ucfirst($supportreply->first_name.' '.$supportreply->last_name); ?></h4>
                    <span class="t-date"><?php echo date('m/d/y',strtotime($supportreply->created_date));?></span>
                    <span class="t-id">Your Ticket ID #<?php echo $supportreply->ticket_id; ?></span>
                    <div class="t-para">
                      <p><?php echo ucfirst($supportreply->message); ?></p>
					  <?php if ($supportreply->image!='') { ?> 
			      <div class="attch-file col-md-3" style="float: right;">
                  <span>Attached File</span> 
				<a href="<?php echo base_url().$supportreply->image; ?>" download>
					  <img src="<?php echo site_url();?>/assets/img/attach-img.png" alt="Download Attached File" title="Download Attached File" width="45">
					</a>
			  </div> 
			 <?php } ?>
                  </div>
                </div>
            </div>
			<?php } ?>	
		
