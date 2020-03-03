<?php 
$ResInv = $invoice_list[0];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invoice</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
<style>
body { margin:0 auto; text-align:center; font-family: 'Open Sans', sans-serif; font-size:16px;}
address { font-style:normal; text-align:left;}
</style>
</head>
<body>
    
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff" align="center" style="padding:15px; color:#252525;">
  <tr>
    <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"> <img src="<?php echo $list['s_logo'];?>" width="180px" /> </td>
    <td align="right" style="font-weight:bolder;"> <h1 style="color:#2c419a; font-weight:bold; font-size:30px;"> INVOICE </h1> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="33%" rowspan="4" align="right"> <table id="meta" width="100%" style="font-size:14px; border:#ccc solid 1px;" 
    border="0">
      <tbody><tr>
        <td bgcolor="#2c4199" style="color:#fff; padding:5px; font-weight:bold; font-size:18px;"><strong>Invoice #</strong></td>
        <td bgcolor="#f8f8f8" style="font-weight:bold; padding-left:10px; font-size:18px;"><?php echo $ResInv->id; ?></td>
      </tr>
      <tr>
        <td bgcolor="#2c4199" style="color:#fff; padding:5px; font-weight:bold; font-size:18px;">Date</td>
        <td bgcolor="#f8f8f8" style="font-weight:bold; padding-left:10px; font-size:18px;"><?php echo date('M/d/Y',strtotime($ResInv->created_at)); ?></td>
      </tr>
      <tr>
        <td bgcolor="#2c4199" style="color:#fff; padding:5px; font-weight:bold; font-size:18px; padding-left:10px;">Amount Due</td>
        <td bgcolor="#f8f8f8" ><div class="due" style="font-family: 'Open Sans', sans-serif; color:#2c4199; font-weight:bold; padding-left:10px; font-size:18px;">$<?php echo number_format($price,2); ?></div></td>
      </tr>
      
     
      
      <tr>
        <td bgcolor="#2c4199" style="color:#fff; padding:5px; font-weight:bold; font-size:18px; padding-left:10px;">Payment Status</td>
        <td bgcolor="#f8f8f8" ><div class="due" style="font-family: 'Open Sans', sans-serif; color:#2c4199; font-weight:bold; padding-left:10px; font-size:18px;"><?php echo (isset($status) && $status)?$status:''; ?></div></td>
      </tr>
      
      
    </tbody></table> </td>
  </tr>
  <tr>
    <td width="67%" style="font-size:18px;">  
    <address>
      <strong style="color:#2c4199"><?php echo $ResInv->firstname .' '.$ResInv->lastname; ?> </strong> <br />
      <?php echo $students->current_address.' '.$students->city.' '.$students->state.' '.$students->pincode; ?> <br /> Phone: <?php echo $students->mobileno; ?>
    </address> </td>
    </tr>
  <tr>
    <td height="25">&nbsp;</td>
    </tr>
   </table>

    </td>
    <td>&nbsp;</td>
  </tr>
</table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>
    
    <table width="100%" cellspacing="5" cellpadding="10" border="0" style="font-size:18px; border:#2c4199 solid 1px;">
  <tr>
    <td align="left" bgcolor="#2c4199" style="color:#fff; font-size:18px; padding:5px; text-transform:uppercase;"> Item </td>
    <td align="left" bgcolor="#2c4199" style="color:#fff; font-size:18px; padding:5px; text-transform:uppercase;"> Payment Method	</td>
    <td align="left" bgcolor="#2c4199" style="color:#fff; font-size:18px; padding:5px; text-transform:uppercase;"> Unit Cost	 </td>
    <td align="left" bgcolor="#2c4199" style="color:#fff; font-size:18px; padding:5px; text-transform:uppercase;"> Quantity	</td>
    <td bgcolor="#2c4199" style="color:#fff; font-size:18px; padding:5px; text-transform:uppercase;">Price</td>
  </tr>
  <tr>
    <td height="30" align="left" style="padding-left:10px;"> <?php echo $ResInv->vendor_name; ?> </td>
    <td height="30" align="left"> <?php echo (isset($payment_type_field) && $payment_type_field!='')?$payment_type_field:""; ?></td>
    <td height="30" align="left"> $<?php echo number_format($price,2); ?> </td>
    <td height="30" align="left"> 1 </td>
    <td height="30" align="left"> $<?php echo number_format($price,2); ?></td>
  </tr>
  <tr>
    <td height="30" align="left">&nbsp;</td>
    <td height="30" align="left">&nbsp;</td>
    <td height="30" align="left">&nbsp;</td>
    <td height="30" align="left">&nbsp;</td>
    <td height="30" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" align="left">&nbsp;</td>
    <td height="30" align="left">&nbsp;</td>
    <td colspan="3" rowspan="2" align="left" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="5">
      <tr>
        <td height="25" bgcolor="#eeeff0" style="padding-left:10px;"> Subtotal </td>
        <td height="25" bgcolor="#eeeff0" > $<?php echo number_format($price,2); ?> </td>
      </tr>
      <tr>
        <td height="25" bgcolor="#eeeff0" style="padding-left:10px;"> Total </td>
        <td height="25" bgcolor="#eeeff0"> $<?php echo number_format($price,2); ?> </td>
      </tr>
      <tr>
        <td height="25" bgcolor="#eeeff0" style="padding-left:10px;"> Amount Paid </td>
        <td height="25" bgcolor="#eeeff0"> $<?php echo number_format($price,2); ?> </td>
      </tr>
      <tr>
        <td height="25" bgcolor="#000" style="padding-left:10px;"><strong style="color:#fff; font-weight:bold;">Balance Due	</strong></td>
        <td height="25" bgcolor="#000"><strong style="color:#fff; font-weight:bold;">$ <?php  echo $balance; ?></strong></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td height="30" align="left">&nbsp;</td>
    <td height="30" align="left">&nbsp;</td>
    </tr>
    </table>

    
    
    </td>
  </tr>
  <tr>
    <td bgcolor="#fff">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#eeeff0"> <p style="font-size:16px; padding:10px; text-align:left"> <strong>How To Pay ?</strong>
    
<br>

Thank you for your order! <br>

<b style="color:red;">NO PAYMENT REQUIRED SERVICES</b> - If you have chosen a service that has no payment required there is nothing you need to do. A representative will contact you if needed regarding your order.<br>

<b style="color:red;">CREDIT CARD OR E-CHECK SERVICES</b> - If you used Credit Card or E-check as a payment, there is nothing further you need to do.<br>

<b style="color:red;">ZELLE,CASH APP, or VENMO </b> - If you have chosen Zelle, Cash App, or Venmo as a payment method you will need to follow the instructions below<br>

After you have made your payment please follow these instructions to confirm your payment has been made.<br>

1.&nbsp;&nbsp;&nbsp;	Login to <b><?php echo sitename(); ?></b><br>
2.&nbsp;&nbsp;&nbsp;	Go to My Accounts section<br>
3.&nbsp;&nbsp;&nbsp;	Find the Orders and Invoices tab<br>
4.&nbsp;&nbsp;&nbsp;	Click on invoices<br>
5.&nbsp;&nbsp;&nbsp;	Click the confirm payment link<br>
6.&nbsp;&nbsp;&nbsp;	Your payment will be confirmed by admin
    

</td>
    
    
  </tr>
</table>
</body>
</html>
