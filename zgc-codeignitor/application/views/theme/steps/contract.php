<link href="<?php echo ASSETSPATH; ?>pad/css/jquery.signaturepad.css" rel="stylesheet">
<style type="text/css">
#btnSaveSign {
color: #fff;
background: #f99a0b;
padding: 5px;
border: none;
border-radius: 5px;
font-size: 20px;
margin-top: 10px;
}

#btnSaveSignreset {
color: #fff;
background: #f99a0b;
padding: 5px;
border: none;
border-radius: 5px;
font-size: 20px;
margin-top: 10px;
}
#signArea{
width:100%;
margin: 0px auto;
}
.sign-container {
width: 100%;
margin: auto;
}
.sign-preview {
width: 150px;
height: 50px;
margin: 10px 5px;
}
.tag-ingo {
font-family: cursive;
font-size: 12px;
text-align: left;
font-style: oblique;
}
p:empty { display:none;}
p&nbsp; { display:none;}
.sigWrapper { border:none; height:auto;}
.sign-pad { background:#fff; border:#fff solid 1px;}

@media(max-width:767px){
	.signForm { position:relative;}
	.signature-container { position:relative; left:0; right:0; bottom:0;}
	<!-- .signature-container canvas { width:100% !important;} -->
}

</style>
   <div class="card">
      <div class="card-body" style="overflow-y:scroll;overflow-x:hidden; -webkit-overflow-scrolling: touch;margin-left:14px;">
  <br>
      <?php
    if(empty($contract_sign->contract_url))
        {
         ?>
    <input type="checkbox" name="terms" id="terms"> <a href="javascript:void(0);" data-toggle="modal" data-target="#myModalcontract" >READ DOCUMENT PREPARATION SERVICES AGREEMENT</a>
	  <?php
     }
          //echo $message;
         ?>
	  </div>
		<?php
		if(empty($contract_sign->contract_url))
        {
         ?>
				<div class="signature-container">
					<div id="signArea"  style="margin:10px;">
						<h2 class="tag-ingo">SIGNATURE,</h2>
						
						<div class="sig sigWrapper" style="height:175px; width:350px;" id="canvasdiv" >
							<hr/>
							<div class="typed"></div>
							<canvas class="sign-pad" id="sign-pad" height="250" width="695"></canvas>
							<hr/>
						</div>
					<!--	<button type="button" class="btn btn-primary" id="btnSaveSign">Submit</button>-->
						<button type="button" class="btn btn-primary" id="btnSaveSignreset" onclick="restsign()">Reset Signature</button>
					</div>
				</div>	
	<?php } else {  ?>
<h2 class="tag-ingo">SIGNATURE</h2>  
 <img src="<?php echo $contract_sign->sign; ?>" height="175" width="350">
	<?php } ?>	
	  </div>


  <!-- Modal -->
  <div class="modal fade" id="myModalcontract" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="padding: 30px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Contract</h4>
        </div>
        <?php
          echo $message;
         ?>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
function restsign()
{
  window.location.reload();  
}
</script>

<style type="text/css">
.modal-header
{
	display:unset !important;
}

.modal-dialog
{
  top:5500px;
}
.fade:not(.show)
{
  opacity: 1;
}	
</style>
