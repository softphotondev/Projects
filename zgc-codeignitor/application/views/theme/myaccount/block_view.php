	<style>
	.btn-default.active.focus, .btn-default.active:focus, .btn-default.active:hover, .btn-default:active.focus, .btn-default:active:focus, .btn-default:active:hover, .open>.dropdown-toggle.btn-default.focus, .open>.dropdown-toggle.btn-default:focus, .open>.dropdown-toggle.btn-default:hover {
    color: #333;
    background-color: #d4d4d4;
    border-color: #8c8c8c;
}
.btn-group.open .dropdown-toggle {
    border: 0;
    outline: 0;
    box-shadow: inset 0 0 0 rgba(0,0,0,.125);
    -webkit-box-shadow: inset 0 0 0 rgba(0,0,0,.125);
}
.btn-default.active, .btn-default:active, .open .dropdown-toggle.btn-default {
    background-image: none;
}
.btn-default.active, .btn-default:active, .btn-default:focus, .btn-default:hover, .open .dropdown-toggle.btn-default {
    color: #415164;
    background-color: #e1e4e6;
    border-color: #e6e9eb;
}
.btn-group.open .dropdown-toggle {
    -webkit-box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
    box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
}
.btn-group .dropdown-toggle:active, .btn-group.open .dropdown-toggle {
    outline: 0;
}
.btn-group>.btn:first-child {
    margin-left: 0;
}
.open>.dropdown-menu {
    display: block;
}
.width200 {
    width: 200px;
}
.dropdown-menu {
    margin: 0;
    margin-top: 5px;
    padding: 0;
    border-radius: 6px;
    z-index: 9000;
    -webkit-box-shadow: 1px 2px 3px rgba(0,0,0,.125);
    box-shadow: 1px 2px 3px rgba(0,0,0,.125);
    border-color: #bfcbd9;
}
.dropdown-menu-right {
    right: 0;
    left: auto;
}
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}
.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
    outline: 0!important;
    background: #e4e8f1;
}

.dropdown-menu>li:first-child>a {
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
}
.panel-full .panel-body {
    border-radius: 0;
    padding-left: 25px;
    padding-right: 25px;
}
.panel_s .panel-body {
    background: #fff;
    border: 1px solid #dce1ef;
    border-radius: 4px;
    padding: 20px;
    position: relative;
}
	</style>
	<div class="page-body vertical-menu-mt">
        <div class="container-fluid">
            <div class="page-header">
              <div class="row">
            
				<div class="col-md-7 project-heading">
					<h3 class="hide project-name"><?php echo $blockview->block_name;?></h3>
					<div id="project_view_name" class="pull-left">
					  
					</div>
				</div>
				<div class="col-md-5 text-right">
                 <div style="float:right;">   <button class="btn btn-info buttons-copy buttons-html5" type="button" data-toggle="modal" data-target="#addcustom_field" onclick="createCustomfield(<?php echo $block_id;?>,'<?php echo $blockview->module_selected; ?>')">Add Custom Field</button>
				 </div>
			  </div>
            </div>
		 </div>
			<div class="col-sm-12 col-xl-6 xl-100">
                <div class="card">
					<div class="card-body">
						<ul class="nav nav-tabs nav-left" id="right-tab" role="tablist">
						  <li class="nav-item"><a class="nav-link active" id="right-home-tab" data-toggle="tab" href="#right-home" role="tab" aria-controls="right-home" aria-selected="true"><?php echo $blockview->block_name;?></a></li>
						</ul>
						<div class="tab-content" id="right-tabContent">
								<div class="table-responsive">
									<table class="table">
										<thead>
										  <tr>
											<th>Field Name</th>
											<th>Field Type</th>
											<th>Length</th>
											<th>Options</th>
											<th>Default</th>
											<th>Sort</th>
											<th>Mandatory</th>
											<th>Action</th>
										  </tr>
										</thead>
										<tbody class="row_position">
										<?php 
											foreach($getCustomerFieldList as $getCustomField){

												$fieldtype 			= $getCustomField->field_type;
												$label_name 		= $getCustomField->label_name;
												$length 			= $getCustomField->length;
												$default_value 		= $getCustomField->default_value;
												$mandatory_field 	= $getCustomField->mandatory_field;
												//$filedname 			= slugurl($label_name);
												$option_fields 		= $getCustomField->option_fields;
												$sort 	= $getCustomField->sort;
												?>
												  <tr id="<?php echo $getCustomField->custom_block_field_id; ?>" role="row" class="odd">
													<td><?php echo $label_name;?></td>
													<td><?php echo $fieldtype;?></td>
													<td><?php echo $length;?></td>
													<td><?php echo $option_fields;?></td>
													<td><?php echo $default_value;?></td>
													<td><?php echo $sort;?></td>
													<td><?php echo $mandatory_field;?></td>
													<td>
								<a class="btn btn-success btn-xs" 
								href="<?php echo site_url('setting/editcustomBlock/'.$getCustomField->custom_block_field_id);?>">Edit</a>
													</td>
												  </tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
						</div>
                    </div>
                </div>
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
										<input id="inline-2" type="checkbox" name="is_mobile_view" value="1" >
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


    function updateOrder(data) 
    {
    	var  block_id = '<?php echo $block_id;?>';
        $.ajax({
            url:"<?php echo site_url('setting/updateCustomorder')?>",
            type:'post',
            data:{position:data,block_id:block_id},
            success:function(){
                //alert('your change successfully saved');
            }
        })
    }
</script>