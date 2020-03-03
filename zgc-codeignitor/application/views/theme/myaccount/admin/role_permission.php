<div class="page-wrapper" style="min-height: 178px; padding-top:125px"> 
  
  <!-- Page Content -->
  <div class="content container-fluid"> 
    
    <!-- Page Header -->
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <h3 class="page-title">Roles &amp; Permissions</h3>
        </div>
      </div>
    </div>
    <!-- /Page Header -->
    
    <div class="row">
      <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3"> 

        <!--<a href="#" class="btn addBtn" data-toggle="modal" data-target="#add_role"><i class="fa fa-plus"></i> Add Roles</a>-->

  <a href="<?php echo base_url('addusertype'); ?>" class="btn addBtn" ><i class="fa fa-plus"></i> Add Roles</a>


        <div class="roles-menu">
          <ul id="get-roles-list">
			<?php foreach($list as $getRoles){?>

            <li class="active"> 
              <a href="javascript:void(0);" onclick="getModule('<?php echo $getRoles->user_type;?>')"><?php echo $getRoles->user_type_name;?> 
              <span class="role-action"> 
                <!--<span class="action-circle large" data-toggle="modal" data-target="#edit_role" onclick="editRole('<?php echo $getRoles->user_type_name;?>')"> <i class="material-icons">edit</i> </span> -->
               <!-- <span class="action-circle large delete-btn" data-toggle="modal" data-target="#delete_role" onclick="deleteRole('<?php echo $getRoles->user_type_name;?>')"> <i class="material-icons">delete</i> 
                </span>--> 
              </span> 
            </a> 
          </li>
			<?php } ?>
			
          </ul>
        </div>
      </div>
      <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
        <h6 class="card-title m-b-20">Module Access</h6>
		<div class="loader-wrapper loaderSpan"></div>
		<div id="get-module-rolewise">
        <div class="m-b-30">
          <ul class="list-group notification-list">
		   <?php 
			foreach($moduleslist as $getmodule){
				//$role_id 			= $getmodule->role_id;
				$module_id 			= $getmodule->id;
				//$module_role_status = $getmodule->module_role_status;
				
				$getStatus = getModuleRole($role_id,$module_id);
				
				$check='';
				if(!empty($getStatus) && $getStatus=='Enabled'){
					$check="checked='checked'";
				}
			  ?>
            <li class="list-group-item"> <?php echo $getmodule->module_name;?>
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="<?php echo $getmodule->module_code;?>" name="<?php echo $getmodule->module_code;?>" <?php echo $check;?> onclick="getModuleEnableDisable('<?php echo $role_id;?>','<?php echo $module_id;?>')">
                <label class="custom-control-label" for="<?php echo $getmodule->module_code;?>">Toggle me</label>
              </div>
            </li>
		  <?php } ?>
          </ul>
        </div>
        <div class="table-responsive">
          <table class="table table-striped custom-table">
            <thead>
              <tr>
                <th>Module Permission</th>
                <th class="text-center">Read</th>
                <th class="text-center">Write</th>
                <th class="text-center">Create</th>
                <th class="text-center">Delete</th>
                <th class="text-center">Import</th>
                <th class="text-center">Export</th>
              </tr>
            </thead>
            <tbody>
			<?php 
				foreach($moduleslist as $resmodule){
				//foreach($modulesAccessList as $resmodule){
					$module_id 	= $resmodule->id;
					//$role_id 	= $resmodule->role_id;

					$responsemodule  = getModuleAccessRole($role_id,$module_id);
					$read 		= $responsemodule->read ?? 'No';
					$write 		= $responsemodule->write ?? 'No';
					$create 	= $responsemodule->create ?? 'No';
					$delete 	= $responsemodule->delete ?? 'No';
					$import 	= $responsemodule->import ?? 'No';
					$export 	= $responsemodule->export ?? 'No';
				 ?>
				<tr>
					<td><?php echo $resmodule->module_name;?></td>
					<td class="text-center"><input type="checkbox" name="read" id="<?php echo $module_id.'_read';?>" onclick="getModuleAccess('<?php echo $role_id;?>','<?php echo $module_id;?>','read');" <?php if($read=='Yes'){ echo 'checked';}?>></td>
					<td class="text-center"><input type="checkbox" name="write" id="<?php echo $module_id.'_write';?>" onclick="getModuleAccess('<?php echo $role_id;?>','<?php echo $module_id;?>','write');" <?php if($write=='Yes'){ echo 'checked';}?>></td>
					<td class="text-center"><input type="checkbox" name="create" id="<?php echo $module_id.'_create';?>" onclick="getModuleAccess('<?php echo $role_id;?>','<?php echo $module_id;?>','create');" <?php if($create=='Yes'){ echo 'checked';}?>></td>
					<td class="text-center"><input type="checkbox" name="delete" id="<?php echo $module_id.'_delete';?>" onclick="getModuleAccess('<?php echo $role_id;?>','<?php echo $module_id;?>','delete');" <?php if($delete=='Yes'){ echo 'checked';}?>></td>
					<td class="text-center"><input type="checkbox" name="import" id="<?php echo $module_id.'_import';?>" onclick="getModuleAccess('<?php echo $role_id;?>','<?php echo $module_id;?>','import');" <?php if($import=='Yes'){ echo 'checked';}?>></td>
					<td class="text-center"><input type="checkbox" name="export" id="<?php echo $module_id.'_export';?>" onclick="getModuleAccess('<?php echo $role_id;?>','<?php echo $module_id;?>','export');" <?php if($export=='Yes'){ echo 'checked';}?>></td>
				</tr>
			 <?php } ?>
            </tbody>
          </table>
        </div>
      
		</div>
	  </div>
    </div>
  </div>
  <!-- /Page Content --> 
  
  <!-- Add Role Modal -->
  <div id="add_role" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label>Role Name <span class="text-danger">*</span></label>
              <input class="form-control" type="text" name="addrole_name" id="addrole_name" required />
            </div>
            <div class="submit-section">
              <button class="btn btn-primary" onclick="addRole();">Submit</button>
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Add Role Modal --> 
  
  <!-- Edit Role Modal -->
  <div id="edit_role" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content modal-md">
        <div class="modal-header">
          <h5 class="modal-title">Edit Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label>Role Name <span class="text-danger">*</span></label>
              <input class="form-control" value="Team Leader" type="text">
            </div>
            <div class="submit-section">
              <button class="btn btn-primary submit-btn">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /Edit Role Modal --> 
  
  <!-- Delete Role Modal -->
  <div class="modal custom-modal fade" id="delete_role" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="form-header">
            <h3>Delete Role</h3>
            <p>Are you sure want to delete?</p>
          </div>
          <div class="modal-btn delete-action">
            <div class="row">
              <div class="col-6"> <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a> </div>
              <div class="col-6"> <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Delete Role Modal --> 
  <script>
	function getModuleAccess(role_id,module_id,field_name){
	  console.log('role_id ='+role_id);
	  console.log('module_id ='+module_id);
	  console.log('field_name ='+field_name);
	  
	  var getvalue = $('#'+module_id+'_'+field_name).val();
	   console.log('getvalue ='+getvalue);
	   $.ajax({
		 url: "<?php echo site_url('setting/updateRoleMoudleMap')?>", 
		 type: 'post',
		 data: {roleId:role_id,moduleId:module_id,fieldName:field_name},
		 dataType: 'json',
		 success: function (response) {
			  console.log(response);	
		 }
	   });
	}
	function getModuleEnableDisable(role_id,module_id){
	   $.ajax({
		 url: "<?php echo site_url('setting/updateModuleByRole')?>", 
		 type: 'post',
		 data: {roleId:role_id,moduleId:module_id},
		 dataType: 'json',
		 success: function (response) {
			  console.log(response);	
		 }
	   });
	}
	function getModule(role_id){
		$('#get-module-rolewise').html('<div class="loader"></div>');
	   $.ajax({
		 url: "<?php echo site_url('Ajax/getModuleByRole')?>", 
		 type: 'GET',
		 data: 'roleId='+role_id,
		 dataType: 'html',
		 success: function (response) {
			$('#get-module-rolewise').html(response);	
		 }
	   });
	}
	function addRole(){
		 var addrole = $('#addrole_name').val();
	   $.ajax({
		 url: "<?php echo site_url('Ajax/addRole')?>", 
		 type: 'POST',
		 data: {roleName:addrole},
		 dataType: 'json',
		 success: function (response) {
			$('#get-roles-list').html(response);
			 $("#add_role").modal("hide");	
		 }
	   });
	}
	
	
  </script>
</div>
