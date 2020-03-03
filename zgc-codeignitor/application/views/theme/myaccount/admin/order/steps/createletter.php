
          <div class="card fullwidth-col personalProfile" >
              <div  style="margin-top: 0px;">
                  <form name="addform" method="POST" action="<?php echo site_url('order/generateLetter/'.$order_id)?>">
                      <div class="disputed-items-actionables sticky-top">
                        <button class="btn btn-success" type="submit" >Generate Letter</button>
                      </div>
                      <br>
                      <div class="disputed-items-actionables sticky-top">
                        <select class="custom-select form-control" required="" name="letter_id" id="letter_id">
                          <option value="">--Select--</option>
                          <?php foreach ($letter_templates as $key => $value) { ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->subject; ?></option>
                          <?php } ?> 
                        </select>
                      </div>
                      <input type="hidden" name="OrderId" id="OrderId" value="<?php echo $order_id; ?>">
                    </form>
              </div>
              <div>
                  <div style="padding: 15px;">
                    <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 

                    <?php echo $dispute_items;?>
                  </div>
              </div>
          </div>
