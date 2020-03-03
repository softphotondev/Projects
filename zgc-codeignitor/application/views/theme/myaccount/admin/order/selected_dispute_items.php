
<?php if(!empty($personalInfo) && isset($personalInfo)){
	$isbotcheck = isset($isbotcheck) ? $isbotcheck : '';
	$formId = 'savedispute';
	$botable=1;
	if($isbotcheck!='bottable'){
		$formId = 'savecreatelater';
		$botable=0;
	}
?>
<div style="padding: 15px;">
	<div id="identityIq" class="custom_Iq">
	  	<form id="<?php echo $formId;?>">
			<input type="hidden" name="orderId" id="orderId" value="<?php echo $order_id;  ?>">
			<div class="disputeItem-row">  
				<div class="personal-profile-desktop">
				<h2> PERSONAL PROFILE </h2>
				<table class="table">
					  <thead>
						<tr>
						  <th>Company</th>
						  <th>Name</th>
						  <th>Also Known As </th>
						  <th>Year of Birth</th>
						 <th>Address</th>
						</tr>
					  </thead>
				  <tbody>
				   <?php 
					foreach($personalInfo as $perinfo){
						$dispute_pf_id  = $perinfo->dispute_pf_id;
						$is_name_checked  = $perinfo->is_name_checked;
						$is_dob_checked  = $perinfo->is_dob_checked;
						$is_knows_checked  = $perinfo->is_knows_checked;
						?>
						<tr role="row">
							<td valign="middle" data-label="Company"><?php echo strtoupper($perinfo->company_name); ?></td>
							<td valign="middle" data-label="Name"> 
							<input type="hidden" name="personal_profile[]" value="<?php echo $dispute_pf_id; ?>" />
								<input name="is_name_checked[<?php echo $dispute_pf_id ?>]" type="checkbox" value="1" <?php if($is_name_checked==1){ echo 'checked';}?> onClick="getupdatepersonal('<?php echo $perinfo->dispute_pf_id; ?>','<?php echo $perinfo->is_name_checked; ?>','name','<?php echo $order_id;?>')" > <?php echo $perinfo->name; ?></td>
							<td valign="middle" data-label="Also Known As">  
								<input name="is_knows_checked[<?php echo $dispute_pf_id; ?>]" type="checkbox" value="1" <?php if($is_knows_checked==1){ echo 'checked';}?> onclick="getupdatepersonal('<?php echo $perinfo->dispute_pf_id; ?>','<?php echo $perinfo->knownas; ?>','knownAs','<?php echo $order_id;?>')"><?php echo $perinfo->knownas; ?> 
							</td>
							<td valign="middle" data-label="Year of Birth">
								<input name="is_dob_checked[<?php echo $dispute_pf_id; ?>]" type="checkbox" value="1" <?php if($is_dob_checked==1){ echo 'checked';}?> onclick="getupdatepersonal('<?php echo $perinfo->dispute_pf_id; ?>','<?php echo $perinfo->dob; ?>','dob','<?php echo $order_id;?>')"><?php echo $perinfo->dob; ?> 
							</td>
							<td valign="middle" data-label="Address" class="td-address"> 
							<?php   
							  if(!empty($perinfo->address) && isset($perinfo->address)){
								$address =@json_decode($perinfo->address) ?? [];
								if(!empty($perinfo->address)){
									foreach($address as $newkey=>$getaddress){?>
										<address class="pfaddress">
										<input name="address[<?php echo $dispute_pf_id; ?>][<?php echo $getaddress->id;?>]" type="checkbox" value="<?php echo $getaddress->text;?>" <?php if($getaddress->checked==1){ echo 'checked';}?> onclick="getupdatepersonal('<?php echo $perinfo->dispute_pf_id; ?>','<?php echo $getaddress->id;?>','address','<?php echo $order_id;?>')"  /><?php echo $getaddress->text;?></address>
								<?php  }
								}
							  }?>
							</td>
					  </tr>
			   <?php } ?>
			  </tbody>
			</table>
			</div>

				<div class="personal-profile-desktop">
				<h2> CREDIT INQUIRIES </h2>
				<table class="table">
				  <thead>
						<tr>
						  <th scope="col"> <button type="button" class="btn btn-success" id="selectcredit"> Select All </button></th>
						  <th scope="col"> Company </th>
						   <th scope="col"> Bureua </th>
						  <th scope="col"> Date </th>
						</tr>
				  </thead>
				  <tbody>
				  <?php 
					foreach($creditInquiry as $key => $creinfo){
							$is_checked=$creinfo->is_checked;
							?>
							<tr>
								<td data-label="Select"> <input name="dispute_creditInq_id[]" type="checkbox" class="selectallcredit" value="<?php echo $creinfo->dispute_creditInq_id;?>" <?php if($is_checked==1){ echo 'checked';}?>> </td>
							  <td data-label="Company"><?php echo $creinfo->company;?>  </td>
							  <td data-label="Company"><?php echo $creinfo->bureau;?>  </td>
							  <td data-label="Date"> <?php echo $creinfo->date;?> </td>
							</tr>
					<?php  } ?>
					</tbody>
				</table>
				</div>

				<div class="account-history-row">
				<h2> ACCOUNTS HISTORY </h2>
				  <?php 
				  foreach($accountHistory as $acchis){
					//$getaccountid = getaccounttypeid($acchis['dispute_account_id']);
					//$getaccountinsid = getaccountinsid($acchis['dispute_account_id']);
					
					$getaccountid 	 = $acchis['account_type_id'];
					$getaccountinsid = $acchis['account_ins_id'];
					
					$account_historylist = $acchis['account_historylist'];
				  ?>
					  <div class="ac-history-row">
						<h3><?php echo $acchis['company_title'];?> </h3>
						<div class="row"> 
							<div class="col-lg-12">
								<div class="LayoutHeader"> 
									<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-6">
											<select class="custom-select form-control" id="status-select" name="statusselect_<?php echo $acchis['dispute_account_id']; ?>"  onchange="changereason(this.value,'<?php echo $acchis['dispute_account_id']; ?>')" >
											  <option value="">Select Type of Accounts</option>
											  <?php foreach($credit_report_reason as $resReport){?>
											  <option value="<?php echo $resReport->title; ?>" <?php if($getaccountid==$resReport->title){ echo 'selected';}?>><?php echo $resReport->title; ?></option>
											  <?php } ?>
											  </select> 
										 </div>
											<div class="col-lg-6">
												<select class="custom-select form-control"  id="<?php echo $acchis['dispute_account_id']; ?>_instruction"  name="statusins_<?php echo $acchis['dispute_account_id']; ?>"  >
													<option value="">Missed how?</option>
												  <?php  foreach($ins as  $resInstruction) { ?>
													<option value="<?php echo $resInstruction->title;  ?>" <?php if($getaccountinsid==$resInstruction->title) { echo 'selected';} ?> ><?php echo $resInstruction->title;  ?></option>
												  <?php } ?>
											  </select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-between">
						<?php 
							foreach($account_historylist as $getaccthistory){
							  $dispute_acct_his_detail_id = $getaccthistory['dispute_acct_his_detail_id'];
							  $company_title  = $getaccthistory['company_title'];
							  $accountno    = $getaccthistory['accountno'];
							  $paymentstatus  = $getaccthistory['paymentstatus'];
							  $comments     = $getaccthistory['comments'];
							  $dateopened   = $getaccthistory['dateopened'];
							  $balance    = $getaccthistory['balance'];
							  $account_status = $getaccthistory['account_status'];
							  $reason     = $getaccthistory['reason'];
							  $instruction  = $getaccthistory['instruction'];
							?>
						  <div class="ah-data col">
							<h4>  <?php echo strtoupper($company_title);?></h4>
							<ul>
							  <li> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $accountno;?> </li>
							  <li> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $balance;?> </li>
							  <li> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $dateopened;?>  </li>
							  <li> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $paymentstatus;?> </li>
							  <li> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $paymentstatus;?> </li>
							</ul>
						  </div>
						   <?php  } ?>
						<?php if(isMobile()){?>
						<div class="disputeButton-mobile">
						  <input name="dispute_account_id[]" type="checkbox" value="<?php echo $acchis['dispute_account_id'];?>" <?php if($acchis['is_checked']==1){ echo 'checked';}?> >dispute this item </div>
						<?php }else { ?>
							<div class="disputeButton-desktop col-3">
								<input name="dispute_account_id[]" type="checkbox" value="<?php echo $acchis['dispute_account_id'];?>" <?php if($acchis['is_checked']==1){ echo 'checked';}?> >dispute this item </div>
							</div>
						<?php } ?>
						<div class="comment-col">
							<h4> Comments  </h4>
							<div class="col-lg-12">
							  <ul>
								<?php 
									foreach($account_historylist as $getaccthistory){ ?> 
							  <li> <?php echo $getaccthistory['comments']; ?> </li>
							  <?php } ?>
							  </ul>
							</div>	
						</div>
					  </div>
					 <?php  }  ?>
					</div>
			</div>
		</form>
	</div>
</div>
<?php }?>
