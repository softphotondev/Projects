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
      