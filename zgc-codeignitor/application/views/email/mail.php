<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
 <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<?php $color  =explode(',', $color1); ?>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:'Open Sans',sans-serif; font-size:14px; line-height:20px; width:600px">
	<tbody>
		<tr>
			<td style="background-color:<?php echo $color[0]; ?>">
			<table border="0" cellpadding="10" cellspacing="0" style="background:<?php echo $color[0]; ?>; width:100%">
				<tbody>
					<tr>
						<td><img src="<?php echo sitepurelogo(); ?>" style="height:38px; width:112px" /></td>
						<td>
						<p style="margin-left:0px; margin-right:0px; text-align:right"><span style="font-size:24px"><img src="<?php echo base_url(); ?>/assets/images/phone-icons.png" style="height:27px; width:35px" />
						<span style="color:<?php echo $color[1]; ?>"><strong><?php echo $phone; ?></strong></span></span></p>
						</td>
					</tr>
				</tbody> 
			</table>
			</td>
		</tr>
		<tr>
			<td style="background-color:#ffcd0c"><img src="<?php echo base_url(); ?>/assets/images/emailerBanner.jpg" style="height:100px; width:600px" /></td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
	        <?php echo $message; ?>
			</td>
		</tr>
		<tr>
			<td>
			<table border="0" cellpadding="10" cellspacing="0" style="background:<?php echo $color[2]; ?>; width:100%">
				<tbody>
					<tr>
						<td><a href="mailTo:<?php echo $email; ?>" style="color:<?php echo $color[3]; ?>; font-size:18px; font-weight:bold; text-decoration:none;"><?php echo $email; ?></a></td>
						<td><a href="<?php echo $url; ?>" style="color:<?php echo $color[3]; ?>; font-size:18px; font-weight:bold; text-decoration:none;" target="_blank"><?php echo $url; ?></a></td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>