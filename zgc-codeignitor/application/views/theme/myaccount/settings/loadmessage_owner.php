       <?php
         $mails = implode(',',$emails);
         $phones = implode(',',$phones);  
       ?>
        <form name="addform" method="post" action="<?php echo site_url('Setting/sentmessage')?>" enctype="multipart/form-data">

            <div id="message_group">
			<div class="row" id="message_row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Message To (Email)</label>
						<textarea name="emails[]" class="form-control" required="" style="height:auto;"><?php echo $mails; ?></textarea>
					</div>
				</div>
			</div>
            </div>
            
            
            <div id="message_group">
			<div class="row" id="message_row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Message To (Phones)</label>
						<textarea name="phones[]" class="form-control" required="" style="height:auto;"><?php echo $phones; ?></textarea>
					</div>
				</div>
			</div>
            </div>
   
            <div>
			<div class="row" id="message_row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Subject</label>
						<select class="form-control" name="selsubject" id="selsubject" onchange="checkvaluesubject(this.value)">
							<option value="">--Select Subject--</option>	
						 <?php foreach($oldsubject as $old) { ?>
						  <option value="<?php echo $old->subject; ?>"><?php echo $old->subject; ?></option>	 
						  <?php } ?>	 	
						 <option value="new">Add New Subject</option>	
						</select>
					</div>
				</div>
			</div>
            </div>
            
            
             <div>
			<div class="row" id="subject_div" style="display:none;">
				<div class="col-md-12">
					<div class="form-group">
						<input type="text" name="subject" id="subject" class="form-control"  placeholder="Enter Subject" >
					</div>
				</div>
			</div>
            </div>


			<div class="row">
				<div class="col-md-10">
					<div class="form-group">
						<label>Enter Message</label>
						<textarea name="message" id="message" class="form-control" placeholder="Enter Message" required="" style="height: 150px;"></textarea>
					</div>
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-sm-5 col-md-5">
                <div class="checkbox-block" style="font-size:14px;color:#fff;"> 
                    <input id="savesms" name="savesms" class="checkbox" style="float: left;" type="checkbox"> 
                    <label class="" for="savesms" style="color: #000 !important;margin-left:10px;">Save SMS</label>
                </div>
            </div>
			</div>
			

			<div class="row">
				<div class="col-md-12">
					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
          <!-- /.row -->
        </form>
        
  <script>
  function checkvaluesubject(value)
  {
	  
	  if(value!='')
	  {
	  if(value=='new')
	  {
		  $('#subject_div').show();
		  $('#message').val(''); 
	  }
	  else
	  {
		  $('#subject_div').hide();
		  
					$.post("<?php echo base_url('Setting/selectsub'); ?>",{oldsubject: value},function(html) 
					{
						$('#message').val(html); 
						
					});  
	  }
      }
      else
      {
		$('#message').val('');  
	  }
	  
  }
  </script>      
