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
	
	<?php $blockview = $getCustomerFieldList[0];
	?>
	<div class="page-body vertical-menu-mt">
        <div class="container-fluid">
            <div class="page-header">
              <div class="row">
            
				<div class="col-md-7 project-heading">
					<h3 class="hide project-name"><?php echo $blockview->block_name;?></h3>
					<div id="project_view_name" class="pull-left">
					  
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
								<form name="addblock" action="<?php  echo base_url('saveCustomfield'); ?>" method="post">
									<input type="hidden" name="block_id" value="<?php echo $blockview->block_id;?>" />
									<input type="hidden" name="custom_block_field_id" value="<?php echo $blockview->custom_block_field_id;?>" />
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel2">Create Custom Field</h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
									  </div>
									  <div class="modal-body">
										  <div class="form-group">
											<label class="col-form-label" for="field_type">Select Field Type:</label>
											<select class="form-control" name="field_type" required onchange="checkselectoption(this.value);">
											<?php foreach($field_type as $restype){?>
												<option value="<?php echo $restype->field_value;?>" <?php if($blockview->field_type==$restype->field_value){ echo 'selected'; } ?>><?php echo $restype->field_name;?></option>
											<?php } ?>
											</select>
										  </div>
										   <div class="form-group" id="select-options-fields" style="display:none;">
											<label class="col-form-label" for="label_name">Option Values: (Enter Comma separated value)</label>
											<textarea name="option_fields" id="option_fields" class="form-control" placeholder="Please enter value with comma separated ex. YES,NO"></textarea>
										  </div>
										  <div class="form-group">
											<label class="col-form-label" for="label_name">Label Name:</label>
											<input class="form-control" type="text" name="label_name" required value="<?php echo $blockview->label_name;?>" />
										  </div>
										  <div class="form-group">
											<label class="col-form-label" for="length">Length :</label>
											<input class="form-control" type="text" name="length" value="<?php echo $blockview->length;?>" />
										  </div>
										  <div class="form-group">
											<label class="col-form-label" for="default_value"> Default Value:</label>
											<input class="form-control" type="text" name="default_value" value="<?php echo $blockview->default_value;?>" />
										  </div>
										   <div class="form-group">
											<label class="col-form-label" for="place_holder"> Place Holder:</label>
											<input class="form-control" type="text" name="place_holder" value="<?php echo $blockview->place_holder;?>" />
										  </div>
										   <div class="checkbox">
											<input id="checkbox3" type="checkbox" name="mandatory_field" checked="" value="1" <?php if($blockview->mandatory_field==1){ echo "checked"; }?> >
											<label for="checkbox3">Mandatory Field</label>
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