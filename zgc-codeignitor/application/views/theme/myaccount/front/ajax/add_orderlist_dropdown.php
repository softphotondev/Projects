                        <option value="" >Select Order Number</option>
                        <?php
                          if($ordersnumberlist)
                          {
							
                          foreach ($ordersnumberlist as $row) 
                          {
                          ?>
                        <option value="<?php echo $row->order_number; ?>" ><?php  echo $row->order_number; ?></option>
                        <?php } } ?>