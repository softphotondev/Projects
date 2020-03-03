
<div class="page-body vertical-menu-mt">

          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3><?php echo $title;?></h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active"><?php echo $title;?></li>
                  </ol>
                </div>
                <div class="col-lg-6">
					
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
          <div class="col-sm-12 col-xl-6 xl-100">
                <div class="card">
                  <div class="card-header">
                    <h5><?php echo $title;?></h5>
					
					<span style="float:right;">   <button class="btn btn-primary buttons-copy buttons-html5" type="button" data-toggle="modal" data-target="#exampleModalfat" data-whatever="@mdo">Add Block</button></span>
                  </div>    
					
					
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3 col-xs-12">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<?php 
							$i=1;
							foreach($block_list as $getRes){
									$block_name 		= $getRes->block_name;
									$category_block_id 	= $getRes->category_block_id;
									$flag='false';
									$active='';
									if($i==1){
										$flag='true';
										$active='active';
									}
							?>
						<a class="nav-link <?php echo $active;?>" id="v-pills-block<?php echo $category_block_id;?>-tab" data-toggle="pill" href="#v-pills-block<?php echo $category_block_id;?>" role="tab" aria-controls="v-pills-block<?php echo $category_block_id;?>" aria-selected="<?php echo $flag;?>"><?php echo $block_name ;?></a>
						<?php $i++;} ?>
						</div>
                      </div>
                      <div class="col-sm-9 col-xs-12">
                        <div class="tab-content" id="v-pills-tabContent">
						
						<?php 
							$j=1;
							foreach($block_list as $getResponse){
									$block_name 		= $getResponse->block_name;
									$category_block_id 	= $getResponse->category_block_id;
									$flag='false';
									$active='';
									if($j==1){
										$flag='true';
										$active='show active';
									}
							?>
                          <div class="tab-pane fade <?php echo $active;?>" id="v-pills-block<?php echo $category_block_id;?>" role="tabpanel" aria-labelledby="v-pills-block<?php echo $category_block_id;?>-tab">
							<div style="float:right;">   <button class="btn btn-info buttons-copy buttons-html5" type="button" data-toggle="modal" data-target="#addcustom_field" onclick="createCustomfield(<?php echo $category_block_id;?>)">Add Custom Field</button>
							</div> 

								<div class="card-header">
									<h5><?php echo $block_name;?></h5>
								</div>
								<div class="card-body">
									<div class="table-responsive">
									 <table class="display" id="basic-2">
										<thead>
										  <tr>
											<th>Field Name</th>
											<th>Field Type</th>
											<th>Length</th>
											<th>Default</th>
											<th>Mandatory</th>
										  </tr>
										</thead>
										<tbody>
									<?php $getCustomerFieldList = getcustomFieldByBlockId($category_block_id,$blockType='category');
										foreach($getCustomerFieldList as $getCustomField){
											$fieldtype 		= $getCustomField->field_type;
											$label_name 		= $getCustomField->label_name;
											$length 			= $getCustomField->length;
											$default_value 		= $getCustomField->default_value;
											$mandatory_field 	= $getCustomField->mandatory_field;
											$filedname 			= slugurl($label_name);
											?>
											  <tr>
												<td><?php echo $label_name;?></td>
												<td><?php echo $fieldtype;?></td>
												<td><?php echo $length;?></td>
												<td><?php echo $default_value;?></td>
												<td><?php echo $mandatory_field;?></td>
											  </tr>
										<?php } ?>
									</tbody>
									  </table>
									</div>
								</div>

                          </div>
                        <?php $j++;} ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
		   </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

				<div class="modal fade" id="exampleModalfat" tabindex="-1" role="dialog" aria-labelledby="exampleModalfat" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
							<form name="addblock" action="<?php  echo base_url('product/saveBlock'); ?>" method="post">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel2">Add Block</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							  </div>
							  <input type="hidden" name="category_id" value="<?php echo $category_id;?>" />
							  <div class="modal-body">
								  <div class="form-group">
									<label class="col-form-label" for="recipient-name">Block Name:</label>
									<input class="form-control" type="text" name="block_name" required />
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
				
				
				<div class="modal fade" id="addcustom_field" tabindex="-1" role="dialog" aria-labelledby="addcustom_field" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
							<form name="addblock" action="<?php  echo base_url('product/savecustomfield'); ?>" method="post">
							<input type="hidden" id="category_block_id" name="category_block_id"  />
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel2">Create Custom Field</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							  </div>
							  <input type="hidden" name="category_id" value="<?php echo $category_id;?>" />
							  <div class="modal-body">
								  <div class="form-group">
									<label class="col-form-label" for="field_type">Select Field Type:</label>
									<select class="form-control" name="field_type" required >
									<?php foreach($field_type as $restype){?>
										<option value="<?php echo $restype->field_value;?>"><?php echo $restype->field_name;?></option>
									<?php } ?>
									</select>
								  </div>
								  <div class="form-group">
									<label class="col-form-label" for="label_name">Label Name:</label>
									<input class="form-control" type="text" name="label_name" required />
								  </div>
								  <div class="form-group">
									<label class="col-form-label" for="length">Length :</label>
									<input class="form-control" type="text" name="length" required />
								  </div>
								  <div class="form-group">
									<label class="col-form-label" for="default_value"> Default Value:</label>
									<input class="form-control" type="text" name="default_value"  />
								  </div>
								  <div class="form-group">
									<label class="col-form-label" for="mandatory_field"> Mandatory Field:</label>
									<input class="form-control" type="checkbox" name="mandatory_field" value="1"  />
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
<script>
function createCustomfield(block_id){
	$('#category_block_id').val(block_id);
}
</script>