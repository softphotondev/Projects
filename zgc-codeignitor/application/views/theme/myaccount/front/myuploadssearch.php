
                       <?php
                             if($myuploads)
                             {
                               foreach($myuploads as $key=>$uploads)
                               {
            $date = ($uploads->added_date!=NULL)?date("m/d/Y H:i:s", strtotime($uploads->added_date)):'';
            $name =  $uploads->first_name.' '.$uploads->last_name;
            $field = ucfirst(str_replace("-"," ",$uploads->custom_field_name));
                             ?>
				<div class="col-lg-12">			 
              <div class="custom-orderBox">
                <div class="custom-header">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="orderplaced-row">
                      <p class="keyNumber"> <?php echo $key+1; ?>  </p>
                        <div class="order-col">
                          <p class="otitle"> Create Date : <?php echo $date; ?> </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="order-details-section">
                  <div class="row">
                    <div class="col-lg-4">
                      <h2 class="order-title"> <?php echo $name; ?> </h2>
                      <div class="productDetails"> <?php echo $field; ?> </div>
                    </div>

                     <div class="col-lg-4">  
                    <img src="<?php echo $uploads->custom_field_values; ?>" alt="..." class="img-thumbnail" style="max-height:225px;">
                    </div>

                    <div class="col-lg-4">
                      <div class="order-btn-group"> <a href="<?php echo $uploads->custom_field_values;?>" target="_blank"  download  class="btn btn-orderDetails"> <i class="fa fa-download" aria-hidden="true"></i> Download</a> <a href="javascript:void(0);"   onclick="printimage('<?php echo $uploads->custom_field_values;?>')" target="_blank"  class="btn btn-orderDelete" ><i class="fa fa-print" aria-hidden="true"></i> Print</a> </div>
                    </div>
                  </div>
                </div>
              </div>
			  </div>
              <?php } } ?>
              
