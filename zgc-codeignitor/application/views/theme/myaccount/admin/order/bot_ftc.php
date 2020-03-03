<?php include_once ('top_content.php'); ?>
	<h2 class="orderview-title"><?php echo $titile; ?> <a href="<?php echo site_url('Order/getFtcBotReport/'.$order_id);?>" class="btn btn-danger">Fetch FTC Report Manually</a></h2>
	
	<div class="horizontal-steeper">
	 <?php 
		if(empty($ftc)) {
            ?>
            <h6 class="heading text-center mt-5">No information for this bot</h6>
            <?php
          } else {
          ?>
            <div class="table-responsive">
              <table id="zero_config" role="table" width="100%" class="table-mobile product-list-table">
                <thead>
                  <tr role="row">
                    <th width="10%" valign="middle" scope="col">PDF Link</th>
                    <th width="10%" valign="middle" scope="col">Error Screenshot</th>
                    <th width="10%" valign="middle" scope="col">Logs</th>
                    <th width="10%" valign="middle" scope="col">Status</th>
                  </tr>
                </thead>
					<tbody>
					  <tr>
						<td data-label="PDF Link"><?php echo is_null($ftc->extra) ? "No Pdf link." : '<a class=\'alert alert-link\'  target=\'_blank\' href="'.$ftc->extra.'">Download PDF</a>'; ?></td>
						<td data-label="Error Screenshot">
						<?php if(isset($ftc->screenshot)) {?>
							<a target="__blank" href="<?php echo $ftc->screenshot; ?>"><img height="200" width="200" src="<?php echo $ftc->screenshot; ?>"></a>
						<?php } else {?><p>No Screenshot of error.</p><?php }?></td>
							<td><code><?php echo $ftc->task_id; ?></code></td>
						  <?php $have_error = strtolower($ftc->bot_status) == 'complete';?>
							<td>
								<?php if (isset($ftc->screenshot) && !$have_error) {?>
									<p style="color: red;">Error</p>
								<?php } if ($have_error) {?>
								<p style="color: green;">Completed.</p>
								<?php } else {?>
								<p><?php echo $ftc->bot_status; ?></p>
								<?php } ?>
							</td>
					  </tr>
					</tbody>
              </table>
            </div>
		<?php } ?>
	</div>	
<?php include_once ('bottom_content.php'); ?>
