<div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <!-- <h3><?php echo $title;?></h3> -->
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $title;?></li>
                  </ol>
                </div>
                <div class="col-lg-6">
             
                </div>
              </div>
            </div>
		 </div>
			<?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Individual column searching (text inputs) Starts-->
              <div class="col-sm-12">
                <div class="card">
				
                  <div class="card-header">
				  <div class="row">
					<div class="col-lg-3"> <h5><?php echo $title;?></h5> </div>
					<div class="col-lg-9"> 
					<ul class="menuBtn">
					  <?php if($title=='Manage Navigation') { ?>          
					  <li><a href="<?php echo base_url('addmenu'); ?>"> Add Menu </a></li>
					  <?php } else if($title=="User Types") { ?>
					  <li><a href="<?php echo base_url('addusertype'); ?>"> Add User Types  </a></li>
					  <?php } else if($title=="Broker List" || $title=="Client List" || $title=="User List") { ?> 
					  <li><a href="<?php echo base_url('adduser'); ?>"> Add Users  </a></li>
					  <?php } else if($title=="Status Manage List") { ?> 
					   <li><a href="<?php echo base_url('addstatus'); ?>"> Add Status  </a></li>
					  <?php } else if($title=="Service Manage") { ?> 
					  <li><a href="<?php echo base_url('addservice'); ?>"> Add Service  </a></li>     
					  <?php } else if($title=="Provider Manage") {  ?>
					  <li><a href="<?php echo base_url('addprovider'); ?>"> Add Provider  </a></li>
                  <?php } ?> 
				  
				</ul>
				</div>
				</div>
				</div>
                 <div class="card-body">
            	<form id="bulkdelete" method="post" action="<?php echo $formaction; ?>">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
									<tr>
									<th>
									<button class="btn btn-warning" type="button" data-original-title="btn btn-danger" title="" id="selectAll2">Select All</button>
									</th>	
									<?php foreach($head as $key=>$th) { ?>      	
									<th><?php echo $th; ?></th>
									<?php } ?>
									</tr>
									</thead>
										<tbody>
										<?php 
										for($i=0;$i<count($headrows);$i++)
										{
										?>
										<tr>

										<?php
										foreach($headrows[$i] as $index=>$keys) {
										?>
										<td>
                                          <?php if($index==0) { ?>
											<input type="checkbox" name="ids[]" id="user_id" class="selectall" value="<?php echo $keys; ?>">
                                            <?php } else { ?>    

											<?php echo $keys; ?>
												
												<?php } ?>

											</td>
										<?php } ?>
										</tr>
										<?php } ?>
										</tbody>
<tfoot>
	<tr>
									<th>
									<button class="btn btn-danger"  onclick="return valthisform()" type="submit" data-original-title="btn btn-danger" title="">Bulk Delete</button>
									</th>	
									<?php foreach($head as $key=>$th) { ?>      	
									<th><?php echo $th; ?></th>
									<?php } ?>
									</tr>
</tfoot>


                      </table>
				   </div>

				</form>
                  </div>
                </div>
              </div>
              <!-- Individual column searching (text inputs) Ends-->
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
<script type="text/javascript">
 $('#selectAll2').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectall').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectall').prop('checked', true);
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
</script>

