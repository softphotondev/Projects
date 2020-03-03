<html>
<title>Application Form</title>
	<head>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<style type="text/css" media="print">
			td{
			color:#000;
			font-family:arial;
			font-size:14px;
			font-weight:500;
			}
			.heading{
				color:#000;
				font-size:18px;
				text-transform: uppercase;
				background-color: ivory;
			}
			.topheading{
				color:#000;
				font-size:20px;
				text-transform: uppercase;
				background-color: aliceblue;
			}
		</style>
	</head>
<body>
	<div class="container">
		<?php if(isset($isflag)!=1){?>
		<form name="saveapplication" method="post" action="<?php echo site_url('projects/saveapplicatedate');?>">
		<input type="hidden" name="order_id" value="<?php echo $order_id;?>" />
		<?php } ?>
		<table class="table table-bordered">
		  <thead>
		    <tr><td colspan="8" align="center" bgcolor="aliceblue" class="topheading">CREDIT APPLICATION </td></tr>
			<tr><td colspan="8" align="center" bgcolor="lightgrey" class="heading">APPLICANT INFORMATION</td></tr>
		  </thead>
		  <tbody>
			<tr>
				<td>First Name:</td>
				<td colspan="3"><?php echo $orderdata->firstname;?></td>
				<td>Last Name:</td>
				<td colspan="3"><?php echo $orderdata->lastname;?></td>
			</tr>
			<tr>
				<td>Date of Birth:</td>
				<td colspan="3"><?php echo $orderdata->dob;?></td>
				<td>SSN:</td>
				<td colspan="3"><?php echo $orderdata->ssn;?></td>
			</tr>
			<tr>
				<td>Phone:</td>
				<td colspan="3"><?php echo $orderdata->phone;?></td>
				<td>Email:</td>
				<td colspan="3"><?php echo $orderdata->email;?></td>
			</tr>
			<tr>
				<td>Driver Licence No :</td>
				<td colspan="3"><?php echo $orderdata->driverslicense;?></td>
				<td>Driver Licence Exp Date:</td>
				<td colspan="3"><?php echo $orderdata->driverslicenseexp;?></td>
			</tr>
			<tr>
				<td colspan="8">
					<table class="table table-bordered">
						<tr>
							<td>Address:</td>
							<td><?php echo $orderdata->address;?></td>
							<td>City:</td>
							<td><?php echo $orderdata->city;?></td>
							<td>State:</td>
							<td><?php echo $orderdata->state;?></td>
							<td>Zip:</td>
							<td><?php echo $orderdata->zip;?></td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr>
				<td colspan="3">HOUSING TYPE RENT/OWN/OTHER*:</td>
				<td><?php echo $orderdata->housingtype;?></td>
				<td colspan="3">YEARS AT ADDRESS*:</td>
				<td><?php echo $orderdata->yearsataddress;?></td>
			</tr>
			 <tr>
				<td colspan="8" align="center" bgcolor="lightgrey" class="heading">Employment Information</td>
			</tr>
			<tr>
				<td>Employer Name:</td>
				<td colspan="7"><?php echo $orderdata->employer;?></td>
			</tr>
			<tr>
				<td>Employer Phone:</td>
				<td><?php echo $orderdata->employerphone;?></td>
				<td>Years On Job:</td>
				<td><?php echo $orderdata->yearsonjob;?></td>
				<td>Gross Monthly Income:</td>
				<td>$<?php echo $orderdata->grossannualincome;?></td>
				<td>Gross Annual Income:</td>
				<td>$<?php echo $orderdata->grossannualincome;?></td>
			</tr>
			
			<tr>
				<td>Address:</td>
				<td><?php echo $orderdata->employeraddress;?></td>
				<td>City:</td>
				<td><?php echo $orderdata->employercity;?></td>
				<td>State:</td>
				<td><?php echo $orderdata->employerstate;?></td>
				<td>Zip:</td>
				<td><?php echo $orderdata->employerzip;?></td>
			</tr>
			<tr>
				<td colspan="3">HOUSING TYPE RENT/OWN/OTHER*:</td>
				<td><?php echo $orderdata->housingtype;?></td>
				<td colspan="3">YEARS AT ADDRESS*:</td>
				<td><?php echo $orderdata->yearsataddress;?></td>
			</tr>
			 <tr>
				<td colspan="8" align="center" bgcolor="lightgrey">Please Read Carefully and Sign</td>
			</tr>
			 <tr>
				<td colspan="8" align="justify">
				<p>I certify that the financial information I have provided is correct. I agree to give AG Jeweler Corp notice of any material change in my financial condition. AG Jeweler Corp may use information about me for other business purposes including but not limited to sharing information with affiliated companies. I agree that AG Jewelers may request a report on me from a credit bureau in connection with my account and review, renewal, or extention of my account. I have read and understand the applicable disclosure statement attached to this application, and authorize AG Jeweler Corp to issue an AG Jeweler credit account to me. I understand that the terms and condition of my account shall be governed by the Credit Agreement and Disclosures that have been furnished to me.</p>
				<p>In the event that AG Jeweler Corp is unable to provide me with an AG Jeweler Corp credit account, I authorize AG Jeweler Corp to forward my application to other companies to be considered for different financing alternatives. I authorize such companies to independently obtain my personal information from other sources. I understand that I have no obligation in any way to accept any credit that may be offered by AG Jeweler Corp or any other company.</p>
			
				<p>I agree in advance, that in the event of any action, proceeding, of counterclaim brought by either AG Jeweler Corp or myself (the borrower) against the other on any matter arising in any way in connection with this contract, the venue at which such events will take place shall be designated to the San Diego Superior Court located at 330 W Broadway #1100 San Diego Ca 92101.</p>
				</td>
			</tr>
			
				
			 <tr>
				<td>Signature</td>
				<td colspan="4"><textarea style="width:500px;height:50px;"></textarea></td>
				<td>Date</td>
				<td colspan="2">
				<?php 
					if(isset($isflag)==1){
						echo $savedate;
					}else{?>
					<input type="text" name="date" value="<?php echo $date;?>"  />
					<?php } ?>
				</td>
			</tr>
			
		  </tbody>
		</table>
		<?php if(isset($isflag)!=1){?>
		<input type="submit" class="btn btn-sm" value="SAVE" />
		<?php } ?>
			</form>
	</div>

</body>
</html>
