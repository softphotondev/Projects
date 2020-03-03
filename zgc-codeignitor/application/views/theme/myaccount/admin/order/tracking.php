  <?php include_once ('top_content.php'); ?>
  
   <h2 class="orderview-title"> Letters</h2>
   <br>
        <div class="table-responsive">
			<table id="example3" class="table tbl table-bordered table-striped dataTable" >
			  <thead>
				<tr>
				  <th>S.No</th>
				  <th>Experian</th>
				  <th>Equifax</th>
				  <th>Transunion</th>
				  <th>Create Date & Time</th>
				  <th>Action</th>
				  </tr>
			  </thead>
			  <tbody>
			  <?php 
				$i=1;
				$due_date = date("m/d/Y H:i:s", strtotime($usertrack->created_at));
			  ?>
			  <tr>
				<td><?php echo $i; ?></td>
				<td>
				<span class="txt_<?php echo $usertrack->id; ?>"><?php echo $usertrack->exp_track; ?><br />
				  <a href="<?php echo $usertrack->exp_link; ?>" target="_blank">Print Label</a>
				</span>
				<input id="exp_track" name="exp_track" type="text"  value="<?php echo $usertrack->exp_track; ?>" class="form-control ctrl_<?php echo $usertrack->id; ?>" style="display:none;width: 210px;box-shadow: 3px 3px 3px 3px #888888;"   />
				</td>

				<td>
				<span class="txt_<?php echo $usertrack->id; ?>"><?php echo $usertrack->equ_track; ?>
				  <br />
				   <a href="<?php echo $usertrack->equ_link; ?>" target="_blank">Print Label</a>
				</span>
				<input id="equ_track" name="exp_track" type="text"  value="<?php echo $usertrack->equ_track; ?>" class="form-control ctrl_<?php echo $usertrack->id; ?>" style="display:none;width: 210px;box-shadow: 3px 3px 3px 3px #888888;"   />
				</td>


				<td >
				<span class="txt_<?php echo $usertrack->id; ?>"><?php echo $usertrack->trans_track; ?>
				  <br />
				   <a href="<?php echo $usertrack->trans_link; ?>" target="_blank">Print Label</a>
				</span>
			  <input id="trans_track" name="exp_track" type="text"  value="<?php echo $usertrack->trans_track; ?>" class="form-control ctrl_<?php echo $usertrack->id; ?>" style="display:none;width: 210px;box-shadow: 3px 3px 3px 3px #888888;"   />
				</td>

				<td><?php echo $due_date; ?></td>
				<td>
				<a href="javascript:void();"  onclick="enableEdit('<?php echo $usertrack->id; ?>')" class="btn btn-success btn-xs editbutton_<?php echo $usertrack->id; ?>" >Edit
				</a>

				<button type="button" value="update" class="btn btn-success btn-xs updatebutton_<?php echo $usertrack->id; ?>" style="display:none" onclick="formsubmitbuttion('<?php echo $usertrack->id;  ?>')">Update</button>&nbsp;
				</td>
			  </tr>
          </tbody>
			</table>
        </div>
		
	<script type="text/javascript">
		function enableEdit(frmid){
			$(".txt_"+frmid).css({"display":"none"});
			$(".ctrl_"+frmid).css({"display":"block"});
			$(".editbutton_"+frmid).css({"display":"none"});
			$(".updatebutton_"+frmid).css({"display":"block"});
		}
		function formsubmitbuttion(id){
			var exp_track = $('#exp_track').val();
			var equ_track = $('#equ_track').val();
			var trans_track = $('#trans_track').val();
			$.post("<?php echo base_url('order/updatetrack'); ?>",{id: id,exp_track:exp_track,equ_track:equ_track,trans_track:trans_track},function(html) 
			{
			  window.location.reload();
			});
		}
	</script>
	
<?php include_once ('bottom_content.php');