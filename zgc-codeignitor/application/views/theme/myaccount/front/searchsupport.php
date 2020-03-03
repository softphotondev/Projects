<style>
.projects-status {
	margin-bottom: 30px;
}
</style>

          <?php
      if($ticket){ 
      foreach($ticket as $key=>$supp){
        $replyData = $supp->reply_support_list;
        
        ?>
          <div class="col-lg-6">       
          <div class="custom-orderBox">
          <div class="custom-header">
            <div class="row">
            <div class="col-lg-10">
              <div class="orderplaced-row">
              <p class="keyNumber"> <?php echo $supp->support_ticket_number ?? $key+1; ?>  </p> <span style="margin-left:14%;padding-left:20px;"><?php echo $supp->status_name; ?> &nbsp;&nbsp; <?php echo $supp->priority_name; ?></span>
              </div>
            </div>
            </div>
          </div>
          <div class="order-details-section">
          
            <div class="row">
            <div class="col-lg-10">
              <h2 class="order-title"> <?php echo orderusersname($supp->user_id); ?> </h2>
              <div class="productDetails"> <?php echo $supp->subject; ?> Status : <?php echo $supp->status_name; ?> </div>
            </div>                
            </div>
            
            <?php if(!empty($replyData)){
                foreach($replyData as $getResponse){
                  $replyMsg     = $getResponse->message;
                  $replyusername  = orderusersname($getResponse->user_id);
                  $replyDate    = date('m/d/Y H:i:s',strtotime($getResponse->created_date));?>
                  
                    <div class="row"> 
                    
                    <div class="col-lg-10">
                    <div class="productDetails"> <hr/>Reply : <?php echo $replyMsg?> </div> <br/>
                   <?php
                  if($getResponse && $getResponse->image!='')
                  {
                  ?>
                  <img id="image_upload_preview" src="<?php echo $getResponse->image; ?>" alt="your image" heoght="100" width="100"/>
                  <?php } ?>
                  <br>
                    <?php echo $replyDate;?> 
                    <br/>
                    <?php echo $replyusername;?>

         
                  </div>  </div>  
                
                <?php } ?>
               
            
            <?php } ?>
      <?php   //if(count($replyData)>0) { ?>
      <div id="initial_<?php echo $supp->ticket_id; ?>">  
      <a href="javascript:void(0);" onclick="showdiv('<?php echo $supp->ticket_id; ?>','<?php echo $supp->status; ?>')" class="btn btn-newTicket" style="float: right;margin-top: -30px;">Reply</a>  
      </div>
      <?php //} ?>
            
          </div>
          </div>



          </div>            

                <?php  } } ?>
              