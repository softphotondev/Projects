<div class="page-body vertical-menu-mt">
       
      <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Individual column searching (text inputs) Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?php echo $title;?></h5>
					<span class="text-right"><a href="javascript:void();" data-toggle="modal" data-target="#add_new_block" class="btn btn-info">New Block</a></span>
                  </div>
                  <div class="card-body">
				  
                    <div class="table-responsive product-table">
					<div id="basic-1_wrapper_datatable" class="dataTables_wrapper no-footer">

                      <table class="display dataTable no-footer" id="1_wrapper_datatable" role="grid" aria-describedby="basic-1_info">
                        <thead>
                              <th>S.No</th>
                              <th>Block Name</th>
							   <th>External API Call</th>
							   <th>Sort</th>
                              <th>Status</th>
                              <th class="text-center">Actions</th>
                        </thead>
                        <tbody class="row_position">

                          <?php
					if($blocklist)
					{
						$i=1;
						foreach($blocklist as $getblock){
						$status = ($getblock->status==1) ? 'Active':'Inactive';
						$blockId = $getblock->block_id;
						?>
                          <tr id="<?php echo $getblock->block_id; ?>" role="row" class="odd">
                          <td><?php echo $i; ?></td>
                          <td><?php echo $getblock->block_name; ?></td>
                          <td><?php echo $getblock->module_selected; ?></td>
						   <td><?php echo $getblock->sort; ?></td>
                          <td><span class=""><?php echo $status; ?></span></td>
                          <td>
							<a class="btn btn-success btn-xs" data-toggle="modal" data-target="#ediblock_field" onclick="editblock(<?php echo $blockId;?>)">Edit</a>
							
							 <a class="btn btn-success btn-xs" href="<?php echo base_url('blockView/'.$blockId); ?>" data-original-title="btn btn-danger btn-xs" title="">VIEW</a>
							
							 <button class="btn-info btn-xs" type="button" data-toggle="modal" data-target="#addcustom_field" onclick="createCustomfield(<?php echo $blockId;?>,'<?php echo $getblock->module_selected; ?>')">Add Custom Field</button>
							 
							<!--<a class="btn btn-danger btn-xs"  href="<?php //echo base_url('product/deletecategory/'.$blockId) ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>-->
							
                          </td>
                          </tr>


				<?php $i++; } } ?>
                        </tbody>
                      </table>

					</div>

				   </div>
                  </div>
                </div>
              </div>
              <!-- Individual column searching (text inputs) Ends-->
            </div>
          </div>
          <!-- Container-fluid Ends-->

</div>
				<div class="modal fade" id="add_new_block" tabindex="-1" role="dialog" aria-labelledby="add_new_block" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
							<form name="addblock" action="<?php  echo base_url('saveblock'); ?>" method="post"  enctype="multipart/form-data">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel2">Add Block</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							  </div>
							  <div class="modal-body">
								  <div class="form-group">
									<label class="col-form-label" for="recipient-name">Block Name:</label>
									<input class="form-control" type="text" name="block_name" required />
								  </div>
								   <div class="form-group">
									<label class="col-form-label" for="module_selected">Select Module for API Seperate Call:</label>
									<select class="form-control" name="module_selected" onchange="getContactList(this.value);">
										<option value="">Select</option>
										<option value="identityiq">IDENTITYIQ</option>
										<option value="contract">CONTRACT</option>
									</select>
								  </div>
								<?php /*?><div class="form-group">
									<label class="col-form-label" for="module_selected">Contract List:</label>
									<select class="form-control" name="contract_select" multiple>
										<option value="">Select</option>
										<?php foreach($contactlist as $getconlist){?>
										<option value="<?php echo $getconlist->id;?>"><?php echo $getconlist->subject;?></option>
										<?php } ?>
									</select>
								  </div><?php */ ?>
								  <div class="form-group">
									<label class="col-form-label" for="recipient-name">Mobile Icon:</label>
									<input type="file" name="icon" class="form-control" required>
								  </div>

							  </div>
							  <div class="modal-footer">
								<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
								<button class="btn btn-primary" type="submit">Save</button>
							  </div>
							</form>
                        </div>
                      </div>
                </div>
				
				<div class="modal fade" id="ediblock_field" tabindex="-1" role="dialog" aria-labelledby="ediblock_field" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
							<form name="addblock" action="<?php  echo base_url('saveblock'); ?>" method="post" enctype="multipart/form-data">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel2">Update Block</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							  </div>
							  <div class="modal-body">
								  <div id="edit-blockId"></div>
							  </div>
							  <div class="modal-footer">
								<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
								<button class="btn btn-primary" type="submit">Save</button>
							  </div>
							</form>
                        </div>
                      </div>
                </div>

				<div class="modal fade" id="addcustom_field" tabindex="-1" role="dialog" aria-labelledby="addcustom_field" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
							<form name="addblock" action="<?php  echo base_url('saveCustomfield'); ?>" method="post">
							<input type="hidden" id="product_block_id" name="block_id"  />
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel2">Create Custom Field</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							  </div>
							  <div class="modal-body">
								  <div class="form-group">
									<label class="col-form-label" for="field_type">Select Field Type:</label>
									<select class="form-control" name="field_type" required onchange="checkselectoption(this.value);">
									<?php foreach($field_type as $restype){?>
										<option value="<?php echo $restype->field_value;?>"><?php echo $restype->field_name;?></option>
									<?php } ?>
									</select>
								  </div>
								   <div class="form-group" id="select-options-fields" style="display:none;">
									<label class="col-form-label" for="label_name">Option Values: (Enter Comma separated value)</label>
									<textarea name="option_fields" id="option_fields" class="form-control" placeholder="Please enter value with comma separated ex. YES,NO"></textarea>
								  </div>
								  <div class="form-group">
									<label class="col-form-label" for="label_name">Label Name:</label>
									<input class="form-control" type="text" name="label_name" required />
								  </div>
								  <div class="form-group">
									<label class="col-form-label" for="length">Length :</label>
									<input class="form-control" type="text" name="length" />
								  </div>
								  <div class="form-group">
									<label class="col-form-label" for="default_value"> Default Value:</label>
									<input class="form-control" type="text" name="default_value"  />
								  </div>
								   <div class="form-group">
									<label class="col-form-label" for="place_holder"> Place Holder:</label>
									<input class="form-control" type="text" name="place_holder"  />
								  </div>
								  <div class="checkbox">
									<input id="checkbox3" type="checkbox" name="mandatory_field" checked="" value="1" >
									<label for="checkbox3">Mandatory Field</label>
								  </div>
									<div class="form-group m-t-15 m-checkbox-inline mb-0" id="contract_id" style="display:none;">
									  <div class="checkbox checkbox-dark">
										<input id="inline-2" type="checkbox"  name="is_mobile_view" value="1" >
										<label for="inline-2">Mobile</label>
									  </div>
									</div>
							  </div>
							  <div class="modal-footer">
								<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
								<button class="btn btn-primary" type="submit">Save</button>
							  </div>
							</form>
                        </div>
                      </div>
                </div>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

	<script>
	function createCustomfield(block_id,module_selected){
		$('#product_block_id').val(block_id);
		if(module_selected=='contract'){
			$('#contract_id').show();
		}else{
			$('#contract_id').show();
		}
	}
	function checkselectoption(fieldtype){
		if(fieldtype=='checkbox' || fieldtype=='select' || fieldtype=='multiple'){
			$('#select-options-fields').show();
		}else{
			$('#select-options-fields').hide();
			$('#option_fields').val('');	
		}
	}

	 function editblock(blockId){
		$('#loader').show();
		$.ajax({
			url: '<?php echo site_url('setting/editmanageblock')?>',
			type: 'POST',
			data: {block_id: blockId },
			cache: false,
			success: function(response) {
				$('#edit-blockId').html(response);
			console.log(response);
			 $('#loader').hide();
			 //location.reload();
			}
		});
	 }
	</script>
	
	<script type="text/javascript">
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        $.ajax({
            url:"<?php echo site_url('setting/updateblockOrder')?>",
            type:'post',
            data:{position:data},
            success:function(){
                //alert('your change successfully saved');
            }
        })
    }
</script>
