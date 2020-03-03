<link rel="stylesheet" href="<?php echo base_url();?>assets/css/projectoverivew.css" />
<?php
$orders = $sidebar['orders'];
$order_dynamic_block_menu = $sidebar['order_dynamic_block_menu'];
$order_id = $sidebar['order_id'];
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

$product_name = (isset($orders->product_name))?$orders->product_name:'';

$page = $tabname ?? '';
$active_class='active';
?>

<h3 class="hide project-name"><?php echo $product_name; ?>  - In Progress</h3>
