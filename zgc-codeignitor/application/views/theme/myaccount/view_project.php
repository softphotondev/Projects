<div class="page-body vertical-menu-mt">
  <div class="page-header">
    <div class="row">
      <div class="col-md-7 project-heading">
        <h3 class="hide project-name"><?php echo $orders->product_name; ?>  - In Progress</h3>
        <div id="project_view_name" class="pull-left"> </div>
      </div>
    </div>
  </div>


<?php
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
  ?>


   <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 

   <div class="alert alert-success" style="display: none;" id="loadmessageload">Updated Successfully</div>
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs" id="pills-tab" role="tablist">
	<li class="nav-item"> <a class="nav-link <?php echo $projecttab; ?>" id="pills-home-tab" data-toggle="pill" href="#pills-project" role="tab" > <i class="fa fa-th" aria-hidden="true"></i> Project Overview </a></li>
		 <?php
			$totalblock = count($order_dynamic_block_menu);
			/*$newcount = $totalblock + 4;
			$b=1; */?> 
        <li class="nav-item"><a class="nav-link <?php echo $tasktab; ?>" id="pills-profile-tab" data-toggle="pill" href="#pills-tasks" role="tab" aria-controls="pills-tasks" > <i class="fa fa-check-circle" aria-hidden="true"></i> Tasks </a></li>
        <li class="nav-item"><a class="nav-link <?php echo $supporttab; ?>" id="pills-tickets-tab" data-toggle="pill" href="#pills-tickets" role="tab" aria-controls="pills-tickets" > <i class="fa fa-life-ring" aria-hidden="true"></i> Tickets </a></li>
        
		<li class="nav-item"><a class="nav-link <?php echo $notestab; ?>" id="pills-tickets-tab" data-toggle="pill" href="#pills-notes" role="tab" aria-controls="pills-tickets" > <i class="fa fa-life-ring" aria-hidden="true"></i> Notes </a></li>
        
        <li class="nav-item"><a class="nav-link <?php echo $invoicetab; ?>" id="pills-invoices-tab" data-toggle="pill" href="#pills-invoices" role="tab" aria-controls="pills-invoices" > <i class="fa fa-sun-o" aria-hidden="true"></i> Invoices </a></li>
        
        <li class="nav-item"><a class="nav-link" id="pills-activity-tab" data-toggle="pill" href="#pills-activity" role="tab" aria-controls="pills-activity" > <i class="fa fa-exclamation" aria-hidden="true"></i> Activity </a></li>

      </ul>
    </div>

    <div class="card-body">
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade <?php echo $projecttab; ?>" id="pills-project" role="tabpanel" aria-labelledby="pills-home-tab">

			<div class="row">
			  <div class="col-sm-3 col-xs-12">
				<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

			<div class="widget account-details">
				<a class="thumb-col" href="<?php echo base_url('projects/view/'.$order_id); ?>">
				<div class="thumbImg"> <img src="<?php echo base_url('assets/home/images/personal-info-icon.png'); ?>"></div> <p> Project Overview </p> 
				</a>
				<a class="thumb-col" href="<?php echo base_url('order/clientdetails/'.$order_id); ?>">
					<div class="thumbImg"> <img src="<?php echo base_url('assets/home/images/personal-info-icon.png'); ?>"></div> <p> Client Details </p> 
				</a>
			<?php
				$totalblock = count($order_dynamic_block_menu);
				$newcount = $totalblock + 4;
				$b=1;

				foreach($order_dynamic_block_menu as $key => $getResponse){
					$block_name     = $getResponse->block_name;
					$product_block_id   = $getResponse->block_id;
					//$getcustom_fields   = $getRes->custom_fields;
					 $img = (isset($getResponse->icon) && $getResponse->icon!='NULL')?$getResponse->icon:base_url('assets/home/images/personal-info-icon.png');
			?>
			<a class="thumb-col" href="<?php echo base_url('projects/getOrderajaxsingle/'.$order_id.'/'.$product_block_id.'/'.$b); ?>" >
			<div class="thumbImg"> <img src="<?php echo $img; ?>"></div> <p> <?php echo $block_name ;?></p> </a>
				<?php $b++;} ?>
				<a class="thumb-col" href="<?php echo site_url('order/bottable/'.$order_id);?>"><div class="thumbImg"> <img src="<?php echo $img; ?>"></div> <p> Credit Report </p> 
				</a>
				<a class="thumb-col" href="<?php echo site_url('order/bottable/'.$order_id);?>"><div class="thumbImg"> <img src="<?php echo $img; ?>"></div> <p> BOT TABLE</p> 
				</a>
				<a class="thumb-col" href="<?php echo site_url('order/createletter/'.$order_id);?>"><div class="thumbImg"> <img src="<?php echo $img; ?>"></div> <p> CREATE LETTER</p> 
				</a>
				<a class="thumb-col" href="#"><div class="thumbImg"> <img src="<?php echo $img; ?>"></div> <p> LETTER</p> </a>
				<a class="thumb-col" style="cursor:pointer;" onclick="getBotPages('<?php echo $order_id;?>','innovis');"><div class="thumbImg"> 
					<img src="<?php echo $img; ?>"></div> <p> INNOVIS</p> 
				</a>
				<a class="thumb-col" style="cursor:pointer;" onclick="getBotPages('<?php echo $order_id;?>','usps');"><div class="thumbImg"> 
						<img src="<?php echo $img; ?>"></div> <p> USPS</p> 
				</a>
				<a class="thumb-col" style="cursor:pointer;" onclick="getBotPages('<?php echo $order_id;?>','lexisnexis');"><div class="thumbImg"> 			<img src="<?php echo $img; ?>"></div> <p>LEXIS NEXIS</p> 
				</a>
				<a class="thumb-col" style="cursor:pointer;" onclick="getBotPages('<?php echo $order_id;?>','ftc');"><div class="thumbImg"> 
						<img src="<?php echo $img; ?>"></div> <p> FTC</p> 
				</a>
				<a class="thumb-col" style="cursor:pointer;" onclick="getBotPages('<?php echo $order_id;?>','document');"><div class="thumbImg"> 		<img src="<?php echo $img; ?>"></div> <p> DOCUMENTS</p> 
				</a>
				<a class="thumb-col" style="cursor:pointer;" onclick="getBotPages('<?php echo $order_id;?>','tracking');"><div class="thumbImg"> 		<img src="<?php echo $img; ?>"></div> <p> TRACKING</p> 
				</a>
			</div>
				</div>
			  </div>
			  <div class="col-sm-9 col-xs-12">
				<div class="tab-content" id="v-pills-tabContent">
				
					  <div class="tab-pane fade show active" id="v-pills-overview" role="tabpanel" aria-labelledby="v-pills-overview-tab">
						<div class="panel-body no-radius" id="order-step-detail-pages">
							<table class="table table-borded no-margin">
							 <tbody>
								<tr class="project-billing-type">
								  <td class="bold"><strong>Product Name</strong></td>
								  <td><?php echo $orders->product_name; ?> </td>
								</tr>
								<tr class="project-cost">
								  <td class="bold"><strong>Client name</strong></td>
								  <td><?php echo orderusersname($orders->user_id); ?></td>
								</tr>
								<tr> </tr>
								<tr>
								  <td class="bold"><strong>Client Price</strong></td>
								  <td>$ <?php echo $orders->order_amount; ?></td>
								</tr>
								<?php $orderprice = ($orders->broker_amount!='0.00')?$orders->broker_amount:$orders->order_amount;?>
								 <tr>
								  <td class="bold"><strong>Broker Price</strong></td>
								  <td>$ <?php echo $orderprice; ?></td>
								</tr>
								<tr>
								  <td class="bold"><strong>Payment Method</strong></td>
								  <td><?php echo $orders->payment_method; ?></td>
								</tr>
								<tr>

								  <?php
								  if($orders->status!='')
								  {
								  ?>
								  <td class="bold"><strong>Order Status</strong></td>
								  <td><?php echo getstatusname($orders->status); ?></td>

								<?php } ?>
								</tr>

							  </tbody>
							</table>
						</div>
					  </div>
				</div>
			  </div>
			</div>
        </div>
		
		  
        <div class="tab-pane fade <?php echo $tasktab; ?>" id="pills-tasks" role="tabpanel" aria-labelledby="pills-tasks-tab">

              <a href="javascript:void(0);"  data-toggle="modal" data-target="#exampleModalLong" class="btn btn-info mbot25">Add New Task</a>
          <div style="height:30px;width:100%;"></div>

          <h2 class="panel-heading project-info-bg no-radius">Tasks Summary</h2>
		  
		<ul class="li-listsummary">
		<?php
     if($task_status_output)
     {
       foreach($task_status_output as $key=>$stats)
       {
    ?>
    <li>
		<p class="listDigit"> <?php echo $task_count[$key]; ?> </p>
		<p class="list-title"> <?php echo $stats; ?> </p>
		</li>
    <?php } } ?>
  </ul>
		 
              <form id="bulkdelete" method="post" action="<?php echo base_url('task/multitaskdelete'); ?>">
                  <div class="dt-ext table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>
                             <button class="btn btn-warning" type="button" data-original-title="btn btn-danger" title="" id="selectAll2">Select All</button> 
                            </th>
                            <th>Task Subject</th>
                            <th>Task Fields</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>Due Date</th>
                            <th>Priority</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          if($task)
                          {
                             foreach($task as $tas) 
                             {
                               $start_date = date("m/d/Y", strtotime($tas->start_date));
                               $due_date = date("m/d/Y", strtotime($tas->due_date));

                               $assigned_to = orderusersname($orders->user_id);

                                if($tas->order_detail_ids<>'0') 
                                $tas_fields = getalltaskfields($tas->order_id,$tas->order_detail_ids);
                                else
                                $tas_fields =' ';  
                              ?>
                          <tr>
                            <td><input name="ids[]" class="selectall" type="checkbox" value="<?php echo $tas->task_id; ?>"></td>
                            <td><?php echo $tas->task_subject; ?></td>
                            <td><?php echo $tas_fields; ?></td>
                            <td> 
<select name="task_status" class="custom-select" id="task_status" onclick="taskchangestatus('1',this.value,'<?php  echo $tas->task_id; ?>')">
  <?php 
        if($task_status)
        {
           foreach($task_status as $keynew=>$status)
             {
              ?>
              <option value="<?php echo $keynew; ?>"  <?php echo ($tas->task_status==$keynew)?'selected':''; ?> ><?php echo $status; ?></option>
              <?php
             }
        }
  ?>
                                </select>
                          </td>
                            <td><?php echo $start_date; ?></td>
                            <td><?php echo $due_date; ?></td>
                            <td> 
<select class="custom-select" name="priority" id="priority"  onclick="taskchangestatus('2',this.value,'<?php  echo $tas->task_id; ?>')">
  <?php
    if($priority)
       {
        foreach ($priority as $key => $value) 
        {
  ?>
<option value="<?php echo  $value->id; ?>" <?php echo ($tas->priority==$value->id)?'selected':''; ?> ><?php echo  $value->priority; ?></option>
<?php } } ?>
                        </select>
                          </td>
                          <td>
        <?php
          if($tas->task_status==26  || $tas->task_status==27)
          {
         ?>

                   <!-- <a onclick="showselectpopup('<?php echo $orders->order_id; ?>','<?php echo $orders->product_id; ?>','<?php echo $tas->order_detail_ids; ?>')" class="btn btn-success btn-xs" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">View Submit Data</a>-->
           <a onclick="showselectpopupfixnow('<?php echo $orders->order_id; ?>','<?php echo $orders->product_id; ?>','<?php echo $tas->order_detail_ids; ?>','<?php  echo $tas->task_id; ?>')" class="btn btn-success btn-xs" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">View Submit Data</a>
       <?php } ?>
              <a onclick="loadtask('<?php echo $tas->task_id;  ?>','<?php echo base_url('task/save'); ?>');" class="btn btn-success btn-xs" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">Edit</a>

                          <a class="btn btn-danger btn-xs"  href="<?php echo base_url('task/deletetask/'.$tas->task_id)  ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>
                          </td>
                          </tr>

                        <?php } } ?>
                        </tbody>
                        <tfoot> 
                    <tr>
                    <th>
                    <button class="btn btn-danger"  onclick="return valthisform()" type="submit" data-original-title="btn btn-danger" title="">Bulk Delete</button>
                    </th>
                    <th>Task Subject</th>
                    <th>Task Fields</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                    <th>Action</th>
                    </tr>
                        </tfoot>
                      </table>
                    </div>
                  </form>
					
</div>

         <div class="tab-pane fade <?php echo $supporttab; ?>" id="pills-tickets" role="tabpanel" aria-labelledby="pills-tickets-tab">

        <a href="javascript:void(0);"  data-toggle="modal" data-target="#createticket" class="btn btn-info mbot25">Add New ticket</a>
          <div style="height:30px;width:100%;"></div>
			
    <h2 class="panel-heading project-info-bg no-radius">Tickets Summary</h2>
	  <ul class="li-listsummary">
    <?php
     if($support_status_output)
     {
         foreach($support_status_output as $supp_key=>$suppo)
         {
    ?>  
		
    <li>
		<p class="listDigit"> <?php echo $support_count[$supp_key]; ?> </p>
		<p class="list-title"> <?php echo $suppo; ?> </p>
		</li>
  <?php }  } ?>
		
		</ul>
		
 <form id="bulkdelete" method="post" action="<?php echo base_url('support/multidelete'); ?>">		
<div class="table-responsive">
                      <table class="show-case" id="basic-2">
                        <thead>
                          <tr>
                            <th><button class="btn btn-warning" type="button" data-original-title="btn btn-danger" title="" id="selectsupport">Select All</button> </th>
                            <th>Subject</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Department</th>
                            <th>New Message</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php

                             if($support)
                             {
                               foreach($support as $supp)
                               {

                        $newmessage = getallcommentssupportfornew($supp->support_id);
                       $newmessagestatus = ($newmessage>0)?'Yes':'No'; 
                             ?>
						<tr>
                             <td><input name="ids[]" class="selectsupport" type="checkbox" value="<?php echo $supp->support_id; ?>"></td>
                            <td><?php echo $supp->subject; ?></td>
                            <td>
<select class="custom-select" name="priority" id="priority"  onclick="supportchangestatus('2',this.value,'<?php  echo $supp->support_id; ?>')">
<?php
if($priority)
{
foreach ($priority as $key => $value) 
{
?>
<option value="<?php echo  $value->id; ?>" <?php echo ($supp->priority==$value->id)?'selected':''; ?> ><?php echo  $value->priority; ?></option>
<?php } } ?>
</select>
                            </td>
                            <td> 
<select class="custom-select" name="status" id="status"  onclick="supportchangestatus('1',this.value,'<?php  echo $supp->support_id; ?>')">
        <option value=""> Choose One...</option>
        <?php foreach($support_status as $keysup=>$supphere) { ?>
          <option value="<?php echo $keysup; ?>" <?php echo ($supp->status==$keysup)?'selected':''; ?>><?php echo $supphere; ?></option>
        <?php } ?>
        </select>
                            </td>
                    <td> <?php echo (isset($supp->department_name) && $supp->department_name)?$supp->department_name:'';?></td>

                    <td><?php echo $newmessagestatus; ?></td>

                              <td>

                    <a  class="btn btn-success btn-xs" href="<?php echo base_url('support/reply/'.$supp->support_id)  ?>" data-original-title="btn btn-danger btn-xs" title="">Reply</a>

                    <a onclick="loadsupport('<?php echo $supp->support_id;  ?>','<?php echo base_url('support/save'); ?>');" class="btn btn-success btn-xs" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">Edit</a>

                <a class="btn btn-danger btn-xs"  href="<?php echo base_url('support/deletesupport/'.$supp->support_id)  ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>  

                              </td>
                          </tr>

                        <?php } } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th><button class="btn btn-danger"  onclick="return valthisform()" type="submit" data-original-title="btn btn-danger" title="">Bulk Delete</button></th>
                            <th>Subject</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Department</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
				   </div>
				</form>   
		
        </div>

	<div class="tab-pane fade <?php echo $notestab; ?>" id="pills-notes" role="tabpanel" aria-labelledby="pills-invoices-tab">
		<a href="javascript:void(0);" data-toggle="modal" data-target="#createnotes" class="btn btn-info mbot25">Add New Notes</a>   
		<div style="height:30px;width:100%;"></div>
		<form id="bulkdelete" method="post" action="<?php echo base_url('Notes/multidelete'); ?>"> 
			<div class="table-responsive">
                      <table class="show-case" id="basic-4">
                        <thead>
                          <tr>
            <th><button class="btn btn-warning" type="button" data-original-title="btn btn-danger" title="" id="selectnotes">Select All</button> </th>
            <th> Subject </th>
            <th> Notes </th>
            <th> Added By </th>
            <th> Date Time </th>
             <th>New Message</th>
            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                           if($notes)
                           {
                            foreach ($notes as $key => $value) 
                            {
                              $date = date("m/d/Y", strtotime($value->datetime));
                              $small = substr($value->notes, 0, 45).'...';

                        $newmessage = allcommentsnotes($value->notes_id);
                       $newmessagestatus = ($newmessage>0)?'Yes':'No'; 

                          ?>
              <tr>
                            <td><input name="ids[]" class="selectnotes" type="checkbox" value="<?php echo $value->notes_id; ?>"> </td>
                            <td> <?php echo $value->subject; ?></td>
                            <td> <?php echo $small; ?></td>
                            <td> <?php echo orderusersname($value->added_by); ?></td>
                            <td> <?php echo $date; ?> </td>
                            <td> <?php echo $newmessagestatus; ?> </td>
              <td>  
              <!--<a onclick="loadnotesview('<?php echo $value->notes_id;  ?>');" class="btn btn-success btn-xs" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">View</a>-->


               <a class="btn btn-success btn-xs" href="<?php echo base_url('notes/replyadminnotes/'.$value->notes_id); ?>" data-original-title="btn btn-danger btn-xs" title="">Reply</a>

                <a onclick="loadnotes('<?php echo $value->notes_id;  ?>','<?php echo base_url('Notes/save'); ?>');" class="btn btn-success btn-xs" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">Edit</a>

                          <a class="btn btn-danger btn-xs"  href="<?php echo base_url('Notes/deletenotes/'.$value->notes_id)  ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>

                        </td>
                          </tr>
                        <?php } } ?>
                        </tbody>
               
                          <tfoot>
                         <th><button class="btn btn-danger"  onclick="return valthisform()" type="submit" data-original-title="btn btn-danger" title="">Bulk Delete</button></th>
                          <th> Subject </th>
                          <th> Notes </th>
                          <th> Added By </th>
                          <th> Date Time </th>
                          <th> Action </th>
                          </tfoot>
                      </table>
           </div>
         </form>
     
     
    </div>

        <div class="tab-pane fade <?php echo $invoicetab; ?>" id="pills-invoices" role="tabpanel" aria-labelledby="pills-invoices-tab">

        	<?php  $added_date = date("m/d/Y", strtotime($orders->added_date)); ?>
         
		   <div class="table-responsive">
                      <table class="show-case">
                        <thead>
                          <tr>
                            <th> Order ID # </th>
                            <th> Client Price </th>
                            <th> Broker Price </th>
                            <th> Date </th>
                            <th> Client </th>
							<th> Product </th>
							<th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
							<tr>
                            <td><?php echo $orders->order_number; ?></td>
                            <td> $ <?php echo $orders->order_amount; ?></td>
                            <td> $ <?php echo $orders->broker_amount; ?></td>
                            <td> <?php echo $added_date; ?></td>
                            <td><?php echo orderusersname($orders->user_id); ?> </td>
                            <td><?php echo $orders->product_name; ?> </td>
							<td>  
								<a class="btn btn-success btn-xs" href="<?php echo base_url('viewinvoice/'.$orders->order_id); ?>" data-original-title="btn btn-danger btn-xs" title=""  target="_blank">View Invoice</a> </td>

                          </tr>
                        </tbody>
                      </table>
				   </div>
        </div>
        <div class="tab-pane fade" id="pills-activity" role="tabpanel" aria-labelledby="pills-activity-tab">
          <p> Activity </p>

          <?php
             if($user_activity)
               {
                foreach ($user_activity as $key => $activity) 
                {
                  $date = date("m/d/Y H:i:s", strtotime($activity->datetime));
                  ?>
                   <p> <?php echo $date; ?> -- <?php echo $activity->subject; ?> - <?php echo $activity->message; ?> processed by  <?php echo orderusersname($activity->added_by); ?> </p>
                <?php  
                }
               }
          ?>
        </div>


      </div>
    </div>
  </div>
</div>



<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/datatables.css'); ?>"><link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/datatable-extension.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/ate-picker.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/view_project.css'); ?>">


<div class="modal fade" id="createnotes" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
  <form name="addCMS" action="<?php echo base_url('Notes/save')?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Add New Notes </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            
        <div class="form-group">
        <label for="name"> Subject </label>
        <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required="required" data-original-title="" title="">
        </div>

        <div class="form-group">
        <label for="name"> Description </label>
        <textarea  class="form-control" id="notes" name="notes"  required="required" rows="6" cols="100"></textarea>
        </div> 

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
        </div>

    </form>
  </div>
</div>


<!---pop up for task starts here--->
<div class="modal fade" id="exampleModaldynamicfield" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="z-index: 1600;">
        <div class="modal-dialog modal-lg" role="document">
    <div id="loadedittaskdynamicfield"></div>
  </div>
</div>


<!---pop up for task starts here--->
<div class="modal fade" id="exampleModalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
  <form name="addCMS" id="formupdate" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
    <div id="loadedittask"></div>

    </form>
  </div>
</div>


  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="z-index: 1400;">
        <div class="modal-dialog" role="document">
  <form name="addCMS" method="POST" action="<?php echo base_url('task/save')?>"  enctype="multipart/form-data">

    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Add New Task </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            
        <div class="form-group">
        <label for="name"> Subject </label>
        <input class="form-control" id="task_subject" name="task_subject" type="text" placeholder="Subject" required="required" data-original-title="" title="">
        </div>

        <div class="form-group row">
        <div class="col-lg-6">
        <label for="name"> Start Date </label>
        <div class="input-group">
        <input  type="text"  id="datepicker11" name="start_date" required="required" class="form-control" style="position: unset !important;"></div>
        </div>
        <div class="col-lg-6">
        <label for="name"> Due Date </label>
        <div class="input-group">
        <input  type="text"   id="due_date12" name="due_date" required="required" class="form-control" style="position: unset !important;"></div>
        </div>
        </div>


        <div class="form-group row">
        <div class="col-lg-6">
        <label for="name"> Priority </label>
      <select class="custom-select" name="priority" id="priority" required="required">
      <option value="" >--Select Priority--</option>
      <?php
      if($priority)
      {
      foreach ($priority as $key => $value) 
      {
      ?>
      <option value="<?php echo  $value->id; ?>" ><?php echo  $value->priority; ?></option>
      <?php } } ?>
      </select>
        </div>

        <div class="col-lg-6">
        <label for="name"> Related To </label>
        <select class="custom-select" name="related_to" id="related_to" onchange="showselectpopup('<?php echo $orders->order_id; ?>','<?php echo $orders->product_id; ?>',this.value)">
         <option value=""> Choose One...</option>
           <?php
      $totalblock = count($order_dynamic_block_menu);
      $b=1;
      
      foreach($order_dynamic_block_menu as $key => $getResponse){
        $block_name     = $getResponse->block_name;
$product_block_id   = $getResponse->block_id;
        //$getcustom_fields   = $getRes->custom_fields;
        ?>
        <option value="<?php echo $product_block_id; ?>"><?php echo $block_name; ?></option>
        <?php } ?>
        </select>
        </div>
        </div>


 <div class="form-group row"> <div id="loadvalues"></div></div>

        <div class="form-group row">
        <div class="col-lg-6">
        <label for="name"> Status </label>
        <select name="task_status" class="custom-select" id="task_status" required="required">
        <option value="" > Choose One...</option>
  <?php 
        if($task_status)
        {
           foreach($task_status as $keynew=>$status)
             {
              ?>
              <option value="<?php echo $keynew; ?>" ><?php echo $status; ?></option>
              <?php
             }
        }
  ?>
      </select>
        </div>
        </div>


          <div class="form-group">
        <label for="name"> Description </label>
        <textarea  class="form-control" id="description" name="description"  required="required"></textarea>
        </div> 

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
        </div>
      </form>
        </div>
        </div>


<!---pop up for task ends here--->


<!---pop up for support starts here--->

  <div class="modal fade" id="createticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
  <form name="addCMS" method="POST" action="<?php echo base_url('Support/save')?>"  enctype="multipart/form-data">

    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Add New Ticket </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
     
        <div class="form-group">
        <label for="name"> Subject </label>
        <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required="required" data-original-title="" title="">
        </div>

        <div class="form-group">
        <label for="name"> Priority </label>
      <select class="custom-select" name="priority" id="priority" required="required">
      <option value="" >--Select Priority--</option>
      <?php
      if($priority)
      {
      foreach ($priority as $key => $value) 
      {
      ?>
      <option value="<?php echo  $value->id; ?>" ><?php echo  $value->priority; ?></option>
      <?php } } ?>
      </select>
        </div>


        <div class="form-group">
        <label for="name"> Status </label>
        <select class="custom-select" name="status" id="status">
        <option value=""> Choose One...</option>
        <?php foreach($support_status as $keysup=>$supp) { ?>
          <option value="<?php echo $keysup; ?>"><?php echo $supp; ?></option>
        <?php } ?>
        </select>
        </div>

        <div class="form-group">
        <label for="name"> Department </label>
        <select class="custom-select" name="department" id="department" onclick="chanagerelate(this.value)">
        <option value=""> Choose One...</option>
         <?php foreach($support_depart as $supp) { ?>
        <option value="<?php echo $supp->id; ?>"><?php echo $supp->dept; ?></option>
         <?php } ?>
        <option value="custom">Custom</option>
        </select>
        </div>

         <div class="form-group" id="showdept" style="display: none;">
      <input class="form-control" id="dept" name="dept" type="text" placeholder="Department" data-original-title="" title="">
         </div>
            

        <div class="form-group">
        <label for="name"> Description </label>
        <textarea  class="form-control" id="description" name="description"  required="required"></textarea>
        </div> 


        <div class="form-group">
        <label for="name"> Attach Files </label>
         <input type="file" name="image" id="image"  class="form-control" >
        </div> 

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
        </div>
      </form>
        </div>
        </div>

<!---pop up for support ends here--->

<script type="text/javascript"> 
  function uploadfile()
  {
  $("#upload_file").toggle();
  }

  function chanagerelate(relate) 
  {
  if(relate=='custom')
  {
  $('#showdept').show();
  }
  else
  {
  $('#showdept').hide();
  }
  }

 $('#selectAll2').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectall').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectall').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 



 $('#selectsupport').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectsupport').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectsupport').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 



 $('#selectnotes').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectnotes').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectnotes').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 

function valthisform()
{
    var count_checked = $("[name='ids[]']:checked").length; // count the checked rows
        if(count_checked == 0) 
        {
            alert("Please select atleast one checkbox");
            return false;
        }
        else
        {
          job=confirm("Are you sure to delete?");
          if(job!=true)
          {
          return false;
          }
        }
}

function loadtask(task_id,action)
{

  $('#formupdate').removeAttr("action");
  $('#formupdate').attr("action",action);

  $.post("<?php echo base_url('task/loadtask'); ?>",{task_id:task_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}

function taskchangestatus(type,value,task_id)
{
    $.post("<?php echo base_url('task/statuspriority'); ?>",{task_id:task_id,value:value,type:type},function(data) 
    {
      $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    });  
}


function taskchangestatusfinal(type,value,task_id)
{
      $.post("<?php echo base_url('task/statuspriorityfinal'); ?>",{task_id:task_id,value:value,type:type},function(data) 
    {
      $('#exampleModaldynamicfield').modal('hide');
    });  
}

function supportchangestatus(type,value,support_id)
{
     $.post("<?php echo base_url('support/priorityupdate'); ?>",{type:type,value:value,support_id:support_id},function(data) 
    {
    });  
}


function loadsupport(support_id,action)
{
  $('#formupdate').removeAttr("action");
  $('#formupdate').attr("action",action);

    $.post("<?php echo base_url('support/loadsupport'); ?>",{support_id:support_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}

function loadnotes(notes_id,action)
{
   $('#formupdate').removeAttr("action");
   $('#formupdate').attr("action",action);

    $.post("<?php echo base_url('notes/loadnotes'); ?>",{notes_id:notes_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}

function loadnotesview(notes_id)
{
    $.post("<?php echo base_url('notes/loadnotesview'); ?>",{notes_id:notes_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}

$(document).ready(function() {
    $('#basic-3').DataTable();
} );


function showselectpopup(orders_id,product_id,product_block_id)
{
  $.post("<?php echo base_url('projects/getproductcustomfields'); ?>",{orders_id:orders_id,product_id:product_id,product_block_id:product_block_id},function(data) 
    {
      $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    });
}


function showselectpopupfixnow(orders_id,product_id,product_block_id,task_id)
{
    $.post("<?php echo base_url('projects/getproductcustomfieldsfixnow'); ?>",{orders_id:orders_id,product_id:product_id,product_block_id:product_block_id,task_id:task_id},function(data) 
    {
      $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    });
}

  function getOrderStepDetail(orderId,blockId,stepId,totalsteps){
    $('#orderview_step_detail').html('<div class="loader"></div>');
    stepno(stepId,totalsteps);
    $.ajax({
      type:'GET',
      url:'<?php echo base_url('Ajax/getOrderStepDetail')?>',
      data:'orderId='+orderId+'&blockId='+blockId+'&stepId='+stepId,
      beforeSend: function () {
        $('.modal-body').css('opacity', '.5');
      },
      success:function(response){
        $('#step-'+stepId).html(response);
      }
    });
  }


    function stepno(stepId,totalsteps){
    for(var i=1;i<=totalsteps;i++){
      if(i==stepId){
        $('#stepmenu_'+stepId).removeClass();
        $('#stepmenu_'+stepId).addClass('selected');
      }else{
        $('#stepmenu_'+i).removeClass();
        $('#stepmenu_'+i).addClass('nav-link deselected');
      }
    }
  } 



  $('#selectcredit').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectallcredit').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectallcredit').prop('checked', true);
      $(this).addClass('checkedAll');
    }
});


  function savedata()
  {
      // Get form
      var form = $('#savedispute')[0];
      // Create an FormData object 
      var data = new FormData(form);
      $.ajax({
      url: '<?php echo base_url('Invoice/saveDisputemobileajax'); ?>',
      type: "POST",
      enctype: 'multipart/form-data',
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      success: function(data)   // A function to be called if request succeeds
      {
        if(data=='success')
        {
          alert('Data saved successfully');
        }
      }
      });
  }



function resetdata()
{
   var order_id = '<?php echo $order_id; ?>';
   var user_id = '<?php echo $orders->user_id; ?>';

  job=confirm("Are you sure to reset dispute items?");
  if(job!=true)
  {
    return false;
  }
  else
  {
    $.post("<?php echo base_url('Invoice/resetreport'); ?>",{order_id:order_id,user_id:user_id},function(data) 
    {
       window.location.reload();
    });
  }

} 

function getBotPages(orderId,tabname)
{
	$('#order-step-detail-pages').html('<div class="loader"></div>');
    $.ajax({
      type:'GET',
      url:'<?php echo base_url('Ajax/getOrderBotDetail')?>',
      data:'orderId='+orderId+'&tabname='+tabname,
      beforeSend: function () {
        $('.modal-body').css('opacity', '.5');
      },
      success:function(response){
        $('#order-step-detail-pages').html(response);
      }
    });
}
</script>