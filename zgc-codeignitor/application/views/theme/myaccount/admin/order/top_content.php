<?php
$orders = $sidebar['orders'];
$order_dynamic_block_menu = $sidebar['order_dynamic_block_menu'];
$order_id 	= $sidebar['order_id'];
$task_status_output = $sidebar['task_status_output'];
$task_count = $sidebar['task_count'];

$task_status = $sidebar['task_status'];
$priority = $sidebar['priority'];
$support_status = $sidebar['support_status'];
$support_depart = $sidebar['support_depart'];

$task = $sidebar['task'];
$support_status_output = $sidebar['support_status_output'];
$support = $sidebar['support'];
$support_count = $sidebar['support_count'];
$notes = $sidebar['notes'];
$user_activity = $sidebar['user_activity'];
$task_status_output = $sidebar['task_status_output'];
$projecttab = $tasktab = $notestab =  $supporttab = $invoicetab = ''; 
if($this->session->userdata('tab')=='project')
$projecttab = 'active show';
else if($this->session->userdata('tab')=='task')
$tasktab = 'active show';
else if($this->session->userdata('tab')=='notes')
$notestab = 'active show';
else if($this->session->userdata('tab')=='support')
$supporttab = 'active show';
else if($this->session->userdata('tab')=='invoice')
$invoicetab = 'active show';
 else
  $projecttab = 'active show'; 

$product_name 	= (isset($orders->product_name))?$orders->product_name:'';
$product_id 	= $orders->product_id ?? 0; 
$page = $tabname ?? '';
$active_class='active';


$categoryId = getCategoryId($product_id); // 2 - Credit Repair
?>

<div class="page-body vertical-menu-mt">
  <div class="page-header">
    <div class="row">
      <div class="col-md-7 project-heading">
        <h3 class="hide project-name"><?php echo $product_name; ?>  - In Progress</h3>
        <div id="project_view_name" class="pull-left"> </div>
      </div>
    </div>
  </div>

   <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?>
   <div class="alert alert-success" style="display: none;" id="loadmessageload">Updated Successfully</div>
   
   
  <div class="card overview-project">
  
  
  <div class="project-overviewtabs">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs projectsTabs" role="tablist">
    <li class="nav-item">
    <a class="nav-link menu-tab <?php echo $projecttab; ?> active" href="javascript:void(0)" id="poverview">PROJECT OVERVIEW</a>
    </li>
	<?php
            $totalblock = count($order_dynamic_block_menu);
            /*$newcount = $totalblock + 4;
            $b=1; */?> 
			
    <li class="nav-item">
    <a class="nav-link menu-tab <?php echo $tasktab; ?>" href="javascript:void(0)" id="tasks"> TASKS </a>
    </li>
    <li class="nav-item">
    <a class="nav-link menu-tab <?php echo $supporttab; ?>" href="javascript:void(0)" id="tickets"> TICKETS </a>
    </li>
	<li class="nav-item">
    <a class="nav-link menu-tab <?php echo $notestab; ?>" href="javascript:void(0)" id="notes"> NOTES </a>
    </li>
	<li class="nav-item">
    <a class="nav-link menu-tab <?php echo $invoicetab; ?>" href="javascript:void(0)" id="invoices"> INVOICES </a>
    </li>
	<li class="nav-item">
    <a class="nav-link menu-tab" href="javascript:void(0)" id="activity"> ACTIVITY </a>
    </li>
	
  </ul>

 <!-- Tab panes -->
  <div class="tab-content <?php echo $projecttab; ?>">
<div id="poverview" class="tab-data">
<ul class="menuProjectview">

<li> <a class="<?php if($page=='overview'){ echo $active_class; }?>" href="<?php echo base_url('projects/view/'.$order_id); ?>"> Order Overview </a></li>

<?php if($categoryId==2){?>
<li> <a class="<?php if($page=='creditrepair'){ echo $active_class; } ?>" href="<?php echo site_url('order/creditreport/'.$order_id);?>"> Credit Report </a> </li>
<li> <a class="<?php $active_class;?>" href="<?php echo site_url('order/bottable/'.$order_id);?>"> BOT TABLE </a> </li>
<li> <a class="<?php $active_class;?>" href="<?php echo site_url('order/createletter/'.$order_id);?>"> CREATE LETTER </a> </li>
<li> <a class="<?php $active_class;?>" href="<?php echo base_url('order/letters/'.$order_id); ?>"> LETTER </a> </li>	
<li> <a class="<?php if($page=='document'){echo $active_class;}?>" href="<?php echo site_url('order/documents/'.$order_id);?>"> Credit Processing </a> </li>

<?php /* ?>
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown"> BOT LINKS <span class="caret"></span> </a>
		<ul class="dropdown-menu">
			<li> <a class="<?php if($page=='innovis'){echo $active_class;}?>" href="<?php echo base_url('order/getinnovis/'.$order_id); ?>"> INNOVIS </a> </li>
			<li> <a class="<?php  if($page=='usps'){ echo $active_class; }?>" href="<?php echo base_url('order/getusps/'.$order_id); ?>"> USPS </a> </li>										
			<li> <a class="<?php  if($page=='lexisnexis'){echo $active_class;}?>" href="<?php echo base_url('order/getLexisnexis/'.$order_id); ?>"> LEXIS NEXIS </a> </li>					
			<li> <a class="<?php if($page=='ftc'){echo $active_class;}?>" href="<?php echo base_url('order/getFTC/'.$order_id); ?>"> FTC </a> </li>	
			<li> <a class="<?php if($page=='tracking'){echo $active_class;}?>" href="<?php echo site_url('order/tracking/'.$order_id);?>"> TRACKING </a> </li>
		</ul>
	</li>
	<?php */?>
	
<?php } ?>
<?php if($categoryId==18){?>
	<li><a class="active" href="<?php echo base_url('projects/generateapplicationPdf/'.$order_id); ?>">Update Application PDF </a> </li>
	<li><a class="active" target="_blank" href="<?php echo base_url('projects/generatePdf/'.$order_id); ?>"> Generate PDF </a> </li>
<?php }?>
</ul>
