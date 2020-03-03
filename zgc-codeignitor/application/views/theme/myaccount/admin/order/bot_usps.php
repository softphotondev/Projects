<?php include_once ('top_content.php'); ?>
	<h2 class="orderview-title"><?php echo $botName; ?> </h2>
	<div class="horizontal-steeper">
	<?php if($this->session->flashdata('msg')){  echo $this->session->flashdata('msg');  } ?>
	<div class="tab-content">
		<div class="tab-pane active" id="disputeditem" role="tabpanel">
		<div class="card fullwidth-col personalProfile" >
		<div class="card-header"><a class="btn btn-success" href="<?php echo $botRunLink;?>">Run</a></div>
		<div style="padding: 15px;">
			<div id="identityIq" class="custom_Iq">
		  <?php if(is_null($obj)) {?>
			<h6 class="heading text-center mt-5">Please reffer to Tracking Tab to know if it is has been run or not.</h6>
			<?php
		  } else {?>
			  <table id="zero_config" role="table" width="100%" class="table-mobile product-list-table">
				<thead>
				  <tr role="row">
					<th width="10%" valign="middle" scope="col">Logs</th>
					<th width="10%" valign="middle" scope="col">Status</th>
				  </tr>
				</thead>
				<tbody>
				  <tr>
					<td>
					  <code><?php echo $obj->results; ?></code>
					</td>
					<td><p class="alert alert-info"><?php echo $obj->bot_status; ?></p></td>
				  </tr>
				</tbody>
			  </table>
	   <?php } ?>
			</div>
		</div>
		</div>
		</div>
	</div>
	</div>
<?php include_once('bottom_content.php'); ?>