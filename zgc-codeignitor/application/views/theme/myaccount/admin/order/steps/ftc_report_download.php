	<a href="<?php echo site_url('Order/getFtcBotReport/'.$order_id);?>" class="btn btn-danger">Fetch FTC Report Manually</a>
	
		<table class="display" width="100%">
		 <thead>
			<tr class="heading-row">
				<th>Report PDF Link</th>
				<th>Error Screenshot</th>
				<th>Logs</th>
				<th>Status</th>
			</tr>
		 </thead>
		 <tbody>
			  <?php if(empty($ftc_report)) {?>
				<h6 class="heading text-center mt-5">No information for this bot</h6>
			<?php } else {
					$api_name 	= $ftc_report->api_name;
					$order_id 	= $ftc_report->order_id;
					$user_id 	= $ftc_report->user_id;
					$ftcdownload = $ftc_report->donwload_url;
					$task_id 	= $ftc_report->task_id;
					$task_status 	= $ftc_report->task_status;
					$screenshot='';
					if(empty($ftcdownload)){
						$domain = "http://pft.cpnexpress.com/static/bot/ftc-report-submitter/screenshot/{$task_id}.jpg";
						$screenshot = $domain;
					}
			 ?>
			 <tr>
					<td><?php echo is_null($ftcdownload) ? "No Pdf link." : '<a class=\'alert alert-link\'  target=\'_blank\' href="'.$ftcdownload.'" download>Download PDF</a>'; ?></td>
					<td>
					<?php if(isset($screenshot) && !empty($screenshot)) {?>
						<a target="__blank" href="<?php echo $screenshot; ?>"><img height="200" width="200" src="<?php echo $screenshot; ?>"></a>
					<?php } else {?><p>No Screenshot of error.</p><?php }?></td>
						<td><?php echo $task_id; ?></td>
					  <?php $have_error = strtolower($task_status) == 'complete';?>
						<td><?php echo $task_status; ?></td>
			</tr>
		  <?php } ?>
		 </tbody>
		
		</table>
