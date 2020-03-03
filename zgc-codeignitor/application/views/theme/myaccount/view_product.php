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
	<?php $responseProj= $productview[0];?>
	<div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <!--<div class="col-lg-6">
                  <h3><?php //echo $title;?></h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active"><?php //echo $title;?></li>
                  </ol>
                </div>
                <div class="col-lg-6">
                </div>-->
				
				<div class="col-md-7 project-heading">
					<h3 class="hide project-name"><?php echo $responseProj->product_name;?></h3>
					<div id="project_view_name" class="pull-left">
					  
					</div>
				</div>
			  </div>
            </div>
		 </div>
			<div class="col-sm-12 col-xl-6 xl-100">
                <div class="card">
                  <div class="card-body">
                    <ul class="nav nav-tabs nav-left" id="right-tab" role="tablist">
                      <li class="nav-item"><a class="nav-link active" id="right-home-tab" data-toggle="tab" href="#right-home" role="tab" aria-controls="right-home" aria-selected="true">Product Overview</a></li>
					  <?php 
							foreach($block_list as $getRes){
								$block_name = $getRes->block_name;
								$block_id 	= $getRes->block_id;
							?>
                      <li class="nav-item"><a class="nav-link" id="profile-right-tab<?php echo $block_id;?>" data-toggle="tab" href="#right-profile<?php echo $block_id;?>" role="tab" aria-controls="profile-icon" aria-selected="false"><?php echo $block_name ;?></a></li>
                     <?php } ?>
                    </ul>
                    <div class="tab-content" id="right-tabContent">
                      <div class="tab-pane fade show active" id="right-home" role="tabpanel" aria-labelledby="right-home-tab">
						
						<!-- Product Overview -->
						
						<table class="table no-margin project-overview-table">
							<tbody>
								<tr class="project-overview-customer">
									<td class="bold">Product Name</td>
									<td><a href="#"><?php echo $responseProj->product_name;?></a></td>
								</tr>
								<tr class="project-overview-billing">
									<td class="bold">Category</td>
									<td><?php echo getCategoryName($responseProj->category_id);?></td>
								</tr>
								
								<tr>
									<td class="bold">Product Cost</td>
									<td>$<?php echo $responseProj->product_cost;?></td>
								</tr>
								<tr>
									<td class="bold">Selling Price</td>
									<td>$<?php echo $responseProj->selling_price;?></td>
								</tr>
								<tr>
									<td class="bold">Qty</td>
									<td><?php echo $responseProj->qty;?></td>
								</tr>
								<tr> </tr>
								<tr class="project-overview-status">
									<td class="bold">Status</td>
									<td><?php echo getStatus($responseProj->status);?></td>
								</tr>
								<tr class="project-overview-date-created">
									<td class="bold">Date Created</td>
									<td><?php echo date('m/d/Y',strtotime($responseProj->added_date));?></td>
								</tr>
							</tbody>
						</table>
							
					 <div class="card">
                        <div class="bg-primary">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed txt-white" data-toggle="collapse" data-target="#product_description" aria-expanded="false">Description</button>
                          </h5>
                        </div>
                        <div class="collapse" id="product_description" aria-labelledby="headingeight" data-parent="">
                          <div class="card-body"><?php echo $responseProj->description;?></div>
                        </div>
                      </div>
					   <div class="card">
                        <div class="bg-primary">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed txt-white" data-toggle="collapse" data-target="#product_refund_policy" aria-expanded="false">Refund Policy</button>
                          </h5>
                        </div>
                        <div class="collapse" id="product_refund_policy" aria-labelledby="headingeight" data-parent="">
                          <div class="card-body"><?php echo $responseProj->refund_policy;?></div>
                        </div>
                      </div>
			
                      </div>
					  <?php 
						foreach($block_list as $getResponse){
							$block_name = $getResponse->block_name;
							$block_id 	= $getResponse->block_id;
						?>
                      <div class="tab-pane fade" id="right-profile<?php echo $block_id;?>" role="tabpanel" aria-labelledby="profile-right-tab<?php echo $block_id;?>">
							<div class="table-responsive">
								<table class="table">
									<thead>
									  <tr>
										<th>Field Name</th>
										<th>Field Type</th>
										<th>Length</th>
										<th>Options</th>
										<th>Default</th>
										<th>Mandatory</th>
									  </tr>
									</thead>
									<tbody>
									<?php $getCustomerFieldList = getcustomFieldByBlockId($block_id,$blockType='product');
										foreach($getCustomerFieldList as $getCustomField){
											$fieldtype 			= $getCustomField->field_type;
											$label_name 		= $getCustomField->label_name;
											$length 			= $getCustomField->length;
											$default_value 		= $getCustomField->default_value;
											$mandatory_field 	= $getCustomField->mandatory_field;
											//$filedname 			= slugurl($label_name);
											$option_fields 		= $getCustomField->option_fields;
											?>
											  <tr>
												<td><?php echo $label_name;?></td>
												<td><?php echo $fieldtype;?></td>
												<td><?php echo $length;?></td>
												<td><?php echo $option_fields;?></td>
												<td><?php echo $default_value;?></td>
												<td><?php echo $mandatory_field;?></td>
											  </tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
                      </div>
					  <?php } ?>
                    </div>
                  </div>
                </div>
            </div>
	</div>