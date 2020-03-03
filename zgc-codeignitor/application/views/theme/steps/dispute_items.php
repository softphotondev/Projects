<?php
    if(isset($selectedDisputeItem['creditInquiry']))
    {
      $creditselected =[];
      foreach($selectedDisputeItem['creditInquiry'] as $credit)
      {
         $creditselected[] = $credit->dispute_creditInq_id;
      }
    }
    if(isset($selectedDisputeItem['accountHistoryselected']))
    {
        $disputeitems =[];
        foreach($selectedDisputeItem['accountHistoryselected'] as $dispute)
        {
        $disputeitems[] = $dispute['dispute_account_id'];
        }
    }
?>
<?php if(!empty($personalInfo) && isset($personalInfo)){?>
<style>
.checkout .card .card-body { padding:0px;}
@media(max-width:767px){
	.ah-data h4 {
    font-weight: 700;
    font-size: 13px;
}
.ah-data ul li {font-size:11px;}

}
.disputeItem-row { display:inline-block; width:100%; padding:30px 0px;}

@media (max-width:767px){
	.personal-profile-desktop { display:none;}
}

@media (min-width:768px){
	
.personal-profile-desktop { border: #ccc solid 1px;
    padding: 5px; background:#fff;}
	
.personal-profile-desktop h2 { font-weight: 600;
    font-size: 16px;
    background: #363d8e;
    color: #fff;
    padding: 10px 15px;
    margin: 0;}
	
.personal-profile-desktop .table thead th {
    text-transform: uppercase;
    font-weight: bold;
    background: #f2f2f2; }
	
.personal-profile-desktop .pfaddress { background: #fff7d4;
    border: #f9edb5 solid 1px;
    padding: 10px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 600;
    margin: 0 0 5px 0;}	

}

@media (min-width:768px){
	.personal-profile-mobile { display:none;}
}

@media (max-width:767px){
	
.personal-profile-mobile { border: #ccc solid 1px; padding: 5px; background:#fff;}
.personal-profile-mobile h2 { font-weight: 600;
    font-size: 16px;
    background: #363d8e;
    color: #fff;
    padding: 10px 15px;
    margin: 0;}

.pp-row { padding: 10px;
    background: #f5f5f5;
    border-bottom: #fff solid 2px;}
	
.pp-row h3 {     
	font-weight: 600;
    font-size: 16px;
    background: #dd3333;
    color: #fff;
    padding: 5px 15px;
    margin: 10px 0px 0px 0px;
    border-radius: 5px; text-transform:uppercase; }
	
.pp-row .d-flex { padding: 5px;
    border-bottom: #ececec solid 1px;
    line-height: 27px;
    font-weight: 600; }
	
.pp-row .pp-content { line-height: 20px; }
.creditEnquiry .pp-content { margin:0; padding:0;}
}
.account-history-row {     
	border: #ccc solid 1px;
    padding: 5px;
    background: #fff; }
.account-history-row h2 { 
	font-weight: 600;
    font-size: 16px;
    background: #363d8e;
    color: #fff;
    padding: 10px 15px;
    margin: 0;}
	
.account-history-row h3 {
	background: #f2f2f2;
    border-bottom: 2px solid #dee2e6;
    padding: 0.75rem;
    color: #1b3155;
    font-size: 16px;
    font-weight: 600;
	margin:5px 0px 0px 0px;
}	

.ah-data { background: #1e73be;
    color: #fff;
    padding: 10px; }
.ah-data h4 { font-weight: 600;
    font-size: 16px;
    padding-bottom: 10px; }	

@media(min-width:768px){
	.disputeButton-mobile { display:none;}
	.disputeButton-desktop { background: #a01f24;
    color: #fff;
    justify-content: center;
    align-items: center;
    display: flex;
    font-size: 13px;
    text-transform: uppercase;
    font-weight: bold; }
.disputeButton-desktop input { margin-right:5px;}
}

@media(max-width:767px){
	.disputeButton-desktop { display:none;}
	.disputeButton-mobile { background: #a01f24;
    color: #fff;
    justify-content: center;
    align-items: center;
    display: flex;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: bold; }
}

</style>

<div class="disputeItem-row">
<?php if(!empty($personalInfo) && isset($personalInfo)){?>
<div class="personal-profile-desktop">
<h2> PERSONAL PROFILE </h2>
<table class="table">
  <thead>
    <tr>
      <th>Company</th>
      <th>Name</th>
      <th>Also Known As	</th>
      <th>Year of Birth</th>
	   <th>Address</th>
    </tr>
  </thead>
  <tbody>
   <?php 
   
   foreach($personalInfo as $perinfo){
	$id  = $perinfo->id;
	if(isset($selectedDisputeItem['personalInfo']->$id))
	{
	  $is_name_checked = $selectedDisputeItem['personalInfo']->$id->is_name_checked;
	  $is_dob_checked = $selectedDisputeItem['personalInfo']->$id->is_dob_checked;
	  $is_knows_checked = $selectedDisputeItem['personalInfo']->$id->is_knows_checked;
	  $addressarray = json_decode($selectedDisputeItem['personalInfo']->$id->address);
	}
	else
	{
	   $is_name_checked = $is_dob_checked = $is_knows_checked='';
	   $addressarray = [];
	}
    ?>
    <tr role="row">
		<td valign="middle" data-label="Company"><?php echo strtoupper($perinfo->company_name); ?></td>
		<td valign="middle" data-label="Name"> 
			<input type="hidden" name="personal_profile[]" value="<?php echo $perinfo->id; ?>" />
			<input name="is_name_checked[<?php echo $perinfo->id; ?>]" type="checkbox" value="1"  <?php if($is_name_checked==1){ echo 'checked';}?> > <?php echo $perinfo->name; ?></td>
		<td valign="middle" data-label="Also Known As">  <input name="is_knows_checked[<?php echo $perinfo->id; ?>]" type="checkbox" value="1"  <?php if($is_knows_checked==1){ echo 'checked';}?> ><?php echo $perinfo->knownas; ?> </td>
		<td valign="middle" data-label="Year of Birth">
			<input name="is_dob_checked[<?php echo $perinfo->id; ?>]" type="checkbox" value="1" <?php if($is_dob_checked==1){ echo 'checked';}?> ><?php echo $perinfo->dob; ?> </td>
		  <td valign="middle" data-label="Address" class="td-address"> 
			<?php 	
				if(!empty($perinfo->address) && isset($perinfo->address)){
					$address =@json_decode($perinfo->address) ?? [];
					if(!empty($perinfo->address)){
					foreach($address as $newkey=>$getaddress){
					?>
					<address class="pfaddress">
					<input name="address[<?php echo $perinfo->id; ?>][<?php echo $getaddress->id;?>]" type="checkbox" value="<?php echo $getaddress->id;?>" <?php if(isset($addressarray[$newkey]) && $addressarray[$newkey]->checked==1){ echo 'checked';}?>><?php echo $getaddress->text;?></address>
					<?php }
					}
				}?>
		   </td>
	</tr>
	 <?php } ?>
  </tbody>
</table>
</div>

<?php } ?>

<?php if(!empty($creditInquiry) && isset($creditInquiry)){?>

<div class="personal-profile-desktop">
<h2> CREDIT INQUIRIES </h2>
<table class="table">
          <thead>
            <tr>
              <th scope="col"> <button type="button" class="btn btn-success" id="selectAll2"> Select All </button>
              </th>
              <th scope="col"> Company </th>
               <th scope="col"> Bureua </th>
              <th scope="col"> Date </th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($creditInquiry as $key => $creinfo){
			 if(in_array($creinfo->dispute_creditInq_id,$creditselected))
				  $checked ='checked';
				  else
				  $checked ='';

            ?>
                    <tr>
                      <td data-label="Select"> <input name="dispute_creditInq_id[]" type="checkbox" class="selectall" value="<?php echo $creinfo->dispute_creditInq_id;?>" <?php echo $checked; ?>> </td>
                      <td data-label="Company"><?php echo $creinfo->company;?>  </td>
                      <td data-label="Company"><?php echo $creinfo->bureau;?>  </td>
                      <td data-label="Date"> <?php echo $creinfo->date;?> </td>
                    </tr>
				  <?php } ?>
            </tbody>
        </table>
</div>

<?php } ?>

<?php if(isMobile()){?>
<?php if(!empty($personalInfo) && isset($personalInfo)){?>
<div class="personal-profile-mobile">
    <h2> PERSONAL PROFILE </h2>
	<?php foreach($personalInfo as $perinfo){

if(isset($selectedDisputeItem['personalInfo']->$id))
{
  $is_name_checked = $selectedDisputeItem['personalInfo']->$id->is_name_checked;
  $is_dob_checked = $selectedDisputeItem['personalInfo']->$id->is_dob_checked;
  $is_knows_checked = $selectedDisputeItem['personalInfo']->$id->is_knows_checked;
  $addressarray = json_decode($selectedDisputeItem['personalInfo']->$id->address);
}
else
{
   $is_name_checked = $is_dob_checked = $is_knows_checked='';
   $addressarray = [];
}


    ?>
    <div class="pp-row">
        <h3> <?php echo $perinfo->company_name; ?> </h3>
        <div class="d-flex justify-content-between">
            <div class="pp-content"><?php echo $perinfo->name; ?></div>
            <div class="pp-input">
               <input name="is_name_checked" type="checkbox" value="1" <?php if($is_name_checked==1){ echo 'checked';}?> > 
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="pp-content"><?php echo $perinfo->knownas; ?> </div>
            <div class="pp-input">
             <input name="is_knows_checked" type="checkbox" value="1" <?php if($is_knows_checked==1){ echo 'checked';}?> > 
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="pp-content"><?php echo $perinfo->dob; ?> </div>
            <div class="pp-input">
                <input name="is_dob_checked" type="checkbox" value="1" <?php if($is_dob_checked==1){ echo 'checked';}?> >
            </div>
        </div>
		<?php 	
		if(!empty($perinfo->address) && isset($perinfo->address)){
			$address =json_decode($perinfo->address);
			foreach($address as $newkey=>$getaddress){
			?>
			<div class="d-flex justify-content-between">
				<div class="pp-content">
				   <address class="pfaddress">
					<?php echo $getaddress->text;?></address>
				</div>
				<div class="pp-input">
				  <input name="address[]" type="checkbox" value="<?php echo $getaddress->id;?>" <?php if(isset($addressarray[$newkey]) && $addressarray[$newkey]->checked==1){ echo 'checked';}?> >
				</div>
			</div>
		<?php }
			}?>
    </div>
	 <?php } ?>
</div>
<?php } ?>
<?php if(!empty($creditInquiry) && isset($creditInquiry)){?>

<div class="personal-profile-mobile creditEnquiry">
<h2> CREDIT INQUIRIES </h2>
 <?php foreach ($creditInquiry as $key => $creinfo){

		if(in_array($creinfo->dispute_creditInq_id,$creditselected))
          $checked ='checked';
          else
          $checked ='';

  ?>
	<div class="pp-row">
		<div class="d-flex justify-content-between">
		<div class="pp-content col-5"> <?php echo $creinfo->company;?> </div>
		<div class="pp-content col-3"> <?php echo $creinfo->bureau;?> </div>	
		<div class="pp-content col-3"> <?php echo $creinfo->date;?>  </div>
		<div class="pp-input"><input name="dispute_creditInq_id[]" type="checkbox" value="<?php echo $creinfo->dispute_creditInq_id;?>"  <?php echo $checked; ?> ></div>
		</div>
	</div>
 <?php } ?>

</div>
<?php } ?>
<?php } ?>

<?php if(!empty($accountHistory) && isset($accountHistory)){?>
<div class="account-history-row">
<h2> ACCOUNTS HISTORY </h2>

	<?php 
	foreach($accountHistory as $acchis){


        if(in_array($acchis['dispute_account_id'],$disputeitems))
         $checked ='checked';
          else
          $checked ='';


			$account_historylist = $acchis['account_historylist'];
	?>
	<div class="ac-history-row">
		<h3><?php echo $acchis['company_title'];?> </h3>
		<div class="d-flex justify-content-between">
		<?php 
				foreach($account_historylist as $getaccthistory){
					$dispute_acct_his_detail_id = $getaccthistory['dispute_acct_his_detail_id'];
					$company_title 	= $getaccthistory['company_title'];
					$accountno 		= $getaccthistory['accountno'];
					$paymentstatus 	= $getaccthistory['paymentstatus'];
					$comments 		= $getaccthistory['comments'];
					$dateopened 	= $getaccthistory['dateopened'];
					$balance 		= $getaccthistory['balance'];
					$account_status = $getaccthistory['account_status'];
					$reason 		= $getaccthistory['reason'];
					$instruction 	= $getaccthistory['instruction'];
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
			 
			<div class="disputeButton-desktop col-3">
				<input name="dispute_account_id[]" type="checkbox" value="<?php echo $acchis['dispute_account_id'];?>" <?php  echo $checked;?> >dispute this item </div>
		</div>
		<div class="disputeButton-mobile">
			<input name="dispute_account_id[]" type="checkbox" value="<?php echo $acchis['dispute_account_id'];?>" <?php if($acchis['is_checked']==1){ echo 'checked';}?>>dispute this item </div>
	</div>
	<?php } ?>
</div>
<?php } ?>
</div>

<?php } ?>
