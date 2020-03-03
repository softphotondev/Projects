<?php include_once('top_content.php'); ?>

		<div class="card">
		  <div class="card-header">
			  <div class="row">
				  <div class="col-lg-6"> <h5>Credit Report</h5></div>
			  </div>
		  </div>
		  <div class="card-body">
          <?php
         if($order_identity_report){
           foreach($order_identity_report as $key=>$order_identity)
           {
            ?>
            <div id="credit_<?php echo $order_identity->id; ?>" style="background:#fff;">
             <?php echo $order_identity->message; ?> 
            </div>
        <?php } } ?>
        
        </div>
      </div>

<?php include_once ('bottom_content.php'); ?>
