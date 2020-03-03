<?php
                             if($usertrackhere)
                             {
                               foreach($usertrackhere as $key=>$usertrack)
                               {

            $date = ($usertrack->exp_track!=NULL)?date("m/d/Y H:i:s", strtotime($usertrack->created_at)):'';

                             ?>
                <div class="col-lg-6">
                  <div class="custom-orderBox">
                    <div class="custom-header">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="orderplaced-row">
                            <p class="keyNumber"> <?php echo $key+1; ?> </p>
                            <div class="order-col">
                              <p class="otitle"> Create Date : <?php echo $date; ?> </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="order-details-section">
                      <div class="row">
                        <div class="col-lg-8">
                          <h2 class="order-title"> <?php echo orderusersname($usertrack->user_id); ?> </h2>
                          <div class="productDetails"> <?php echo $usertrack->exp_track; ?> </div>
                          <p> <?php echo $usertrack->equ_track; ?> </p>
                          <p> <?php echo $usertrack->trans_track; ?> </p>
                        </div>
                        <div class="col-lg-4"> <a onclick="loadtrack('<?php echo $usertrack->id;  ?>');" class="btn btn-orderDetails" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">Update</a> </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } } ?>
        