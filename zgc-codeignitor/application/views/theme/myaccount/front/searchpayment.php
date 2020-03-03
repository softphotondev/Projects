         <?php

                             if($paymentmethods)
                             {
                               foreach($paymentmethods as $key=>$cont)
                               {
                             ?>
                <div class="col-lg-6">
                  <div class="custom-orderBox">
                    <div class="custom-header">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="orderplaced-row">
                            <p class="keyNumber"> <?php echo $key+1; ?> </p>
                            <div class="order-col">
                              <p class="otitle"><?php echo $cont->name; ?> </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="order-details-section">
                      <div class="row">
                        <div class="col-lg-8">
                          <p> <?php echo $cont->description; ?> </p>
                        </div>
                        <div class="col-lg-4"> 

                          <a onclick="loadpayment('<?php echo $cont->payment_id;  ?>');" class="btn btn-orderDetails" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">Update</a>
<a  class="btn btn-orderDetails"  onClick="return doconfirm();" href="<?php echo base_url('Myaccount/deletepayment/'.$cont->payment_id); ?>" data-original-title="btn btn-danger btn-xs" title="">Delete</a>

                         </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } } ?>