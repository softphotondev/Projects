<div class="row">
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item"><a class="nav-link <?php echo $projecttab; ?> active" href="<?php echo site_url('projects/view/'.$order_id);?>">Overview</a></li>
		<li class="nav-item"> <a class="nav-link <?php if($page=='creditrepair'){ echo $active_class; } ?>" href="<?php echo site_url('order/creditreport/'.$order_id);?>"> Credit Report </a> </li>
		<li class="nav-item"> <a class="nav-link <?php $active_class;?>" href="<?php echo site_url('order/bottable/'.$order_id);?>"> BOT TABLE </a> </li>
		<li class="nav-item"> <a class="nav-link <?php $active_class;?>" href="<?php echo site_url('order/createletter/'.$order_id);?>"> CREATE LETTER </a> </li>
		<li class="nav-item"> <a class="nav-link <?php if($page=='document'){echo $active_class;}?>" href="<?php echo site_url('order/documents/'.$order_id);?>"> DOCUMENTS </a> </li>
		<li class="nav-item"><a class="nav-link <?php echo $tasktab; ?>" href="javascript:void(0)"> TASKS </a></li>
		<li class="nav-item"><a class="nav-link <?php echo $supporttab; ?>" href="javascript:void(0)"> TICKETS </a></li>
		<li class="nav-item"><a class="nav-link <?php echo $notestab; ?>" href="javascript:void(0)"> NOTES </a></li>
		<li class="nav-item"><a class="nav-link <?php echo $invoicetab; ?>" href="javascript:void(0)"> INVOICES </a></li>
		<li class="nav-item"><a class="nav-link " href="javascript:void(0)" id="activity"> ACTIVITY </a></li>
   </ul>
</div>
