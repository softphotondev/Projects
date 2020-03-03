 <div>	
		<h4 class="order-card-title"> Notes <span class="float-right">
    	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addnotes_system" data-backdrop="static" data-keyboard="false">Add Notes</button></span> <hr/> </h4>  
	
		<div class="row">
		<?php
			if($notes){
				foreach ($notes as $key => $value) {
				$date = date("m/d/Y", strtotime($value->datetime));
				$small = substr($value->notes, 0, 45).'...';
				?>
				<div class="col-lg-6"> 
				<div class="custom-orderBox customTabs">
				<div class="custom-header">
					  <div class="row">
						  <div class="col-lg-12"> 
							  <div class="orderplaced-row">
								  <div class="order-col">
									<p class="otitle"> <?php //echo $value->subject; ?></p>
								  </div>
							  </div>
						  </div>
					  </div>
				  </div>
				<div class="order-details-section">
				  <div class="row">
					  <div class="col-lg-12"> 
						<h2 class="order-title"><?php echo $value->subject; ?>  </h2>
						  <div class="row productDetails">
							  <div class="col-lg-12"> 
								<p> Description :  <?php echo $value->notes;?></p>  
								<p>Date & Time : <?php echo $date; ?></p>
							  </div>
						  </div>
						  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-notes-reply" data-backdrop="static" data-keyboard="false" onclick="replynotes('<?php echo $value->notes_id; ?>');">Reply</button>
					  </div>
				  </div>
				</div>
			</div>	   
		</div>
		<?php } 
			} else { echo 'Order Notes not found!';} ?> 
		</div> 
  </div>
  
  <!---pop up for Funding starts here--->

  <div class="modal supportpopup addNewTicket " id="addnotes_system">
    <div class="modal-dialog modal-lg">
       <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Notes - Order No#: <?php echo $order->order_number;?></h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>				
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="modal-content" id="addnotes-message">
			 <form name="addCMS" id="addnotes_order" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
				<?php if($this->session->userdata('user_type')==3 || $this->session->userdata('user_type')==1){?>
					<div class="form-group">
						<input name="is_client_enabled" type="checkbox"> Client
						<input name="is_broker_enabled" type="checkbox"> Broker
					</div>
				<?php } ?>
					<div class="form-group">
						<label for="name"> Subject </label>
						<input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required="required" data-original-title="" title="">
					</div>
					<div class="form-group">
						<label for="name"> Description </label>
						<textarea  class="form-control" id="notes" name="notes"  required="required" rows="6" cols="100"></textarea>
					</div>
					 <div class="col-md-12">
						<div class="box-footer">
						  <button class="btn btn-primary" type="button" onclick="getUpdateNotes()" id="funding_button">
							Submit
						  </button>
						   <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						</div>
				  	</div>
				</form>
          </div>
      	</div>
    </div>
  </div>
  
  
  <div class="modal supportpopup" id="add-notes-reply" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Reply Notes - Order No#: <?php echo $order->order_number;?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>		 
        </div>
        <!-- Modal body -->
        <div class="modal-body" id="get-order-notes-list"></div>
      </div>
    </div>
  </div>

  
  <script>
	  function getUpdateNotes(){    
			var orderId = $('#order_id').val();
			var postdata = $('#addnotes_order').serialize();
			$.ajax({
			  type:'POST',
			  url:'<?php echo base_url('Notes/save')?>',
			  data:postdata,
			  beforeSend: function () {
				//$('.modal-body').css('opacity', '.5');
				$('#funding_button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submit');
				$('#addnotes-message').addClass('loader');
			  },
			  success:function(response){
				$('#funding_button').html('Submit');
				 // $('#addnotes-message').html(response);
				  getTabStepDetail(orderId,'notes','4','6');
				  setTimeout(function() {$('#addnotes_system').modal('hide');}, 2000);
			  }
			});
		}
		 function addNotesReplied(){    
			$('#add_button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submit');
			var postdata = $('#add_notes_reply').serialize();
			$.ajax({
			  type:'POST',
			  url:'<?php echo base_url('Ajax/savenotesReply')?>',
			  data:postdata,
			  beforeSend: function () {
				//$('.modal-body').css('opacity', '.5');
			  },
			  success:function(response){
				  $('#add_button').html('send');
				   $('#message').val('');
				  $('#note-replylist').append(response);
				  //setTimeout(function() {$('#forgot-form').modal('hide');}, 2000);
			  }
			});
		}
		function replynotes(notes_id){
			 $('#get-order-notes-list').html('');
			 $('#get-order-notes-list').addClass('loader');
			   $.post("<?php echo base_url('Notes/replynotes'); ?>",{notes_id:notes_id},function(data){
				   $('#get-order-notes-list').removeClass('loader');
				   $('#message').html('');
				  $('#get-order-notes-list').html(data);
				});
		}
		
	function getTabStepDetail(orderId,blockId,stepId,totalsteps){
		$('#orderview_step_detail').html('<div class="loader"></div>');
		stepno(stepId,totalsteps);
		$.ajax({
			type:'GET',
			url:'<?php echo base_url('Ajax/getOrderStepDetail')?>',
			data:'orderId='+orderId+'&blockId='+blockId+'&stepId='+stepId,
			beforeSend: function () {
				$('.modal-body').css('opacity', '.5');
			},
			success:function(response){
				$('#orderview_step_detail').html(response);
			}
		});
	}
  </script>
