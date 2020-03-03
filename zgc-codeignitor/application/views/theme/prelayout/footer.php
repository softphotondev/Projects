<?php
//$productdrop = getProductList();
//$footermenu = getfootermenu();
?>
<footer id="footer" class="site-footer">
  <div class="footer-main">
    <div class="container">
	<div class="footerMenu">
	<div class="row">
	<div class="col-lg-12">
	<ul class="footerNav">
		<li><a href="<?php echo base_url('aboutus'); ?>">ABOUT US</a></li>
		<li><a href="<?php echo base_url('services/'); ?>">SERVICES</a></li>
		<li><a href="<?php echo base_url('frequently-asked-questions'); ?>">FAQ</a></li>
	   <!-- <li><a href="<?php //echo base_url('contactus'); ?>">CONTACTS</a></li>-->
		<li><a href="<?php echo base_url('privacypolicy'); ?>">Privacy Policy</a></li>
		<li><a href="<?php echo base_url('refundpolicy'); ?>" >REFUND POLICY</a></li>
		<li><a href="<?php echo base_url('termsofservice'); ?>">TERMS OF SERVICES</a></li>
	  </ul>
	</div>		  
	</div>
	</div>
      <div class="row">
	  <div class="disclaimerbg">
        <?php echo disclaimer(); ?>
	  </div>	
      </div>
   
  </div>

  <div class="footer-copyright copyright-columns">
    <div class="container">
      <div class="row copyright-wrap">
        <div class="text-left reset-mb-10 col-12 col-md-6">© Copyright 2019-2020 All Rights Reserved<?php //echo sitefield('copyright'); ?></div>
        <div class="text-right col-12 col-md-6"> <img src="<?php echo site_url()?>assets/images//payments-method.png" alt="Payment logo"> </div>
      </div>
    </div>
  </div>
  
</footer>

<!-- Swiper JS --> 
<script src="<?php echo  ASSETSPATH; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/additional-methods.min.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/swiper.min.js"></script>
<script src="<?php echo  ASSETSPATH; ?>/home/js/vertical-menu.js"></script>

<script src="<?php echo  ASSETSPATH; ?>js/megamenu.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/main.js"></script>

<script src="<?php echo  ASSETSPATH; ?>js/login.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/touchspin/touchspin.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/touchspin/input-groups.min.js"></script>

<!-- latest jquery-->
    <!-- Plugins JS start-->
<script src="<?php echo  ASSETSPATH; ?>js/dropzone/dropzone.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/dropzone/dropzone-script.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/chat-menu.js"></script>
	
<script src="<?php echo  base_url(); ?>assets/js/script.js"></script>
<!-- login js-->
<script src="<?php echo  ASSETSPATH; ?>js/datepicker/date-picker/datepicker.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/datepicker/date-picker/datepicker.en.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/datepicker/date-picker/datepicker.custom.js"></script>
<!-- Plugin used-->

<script src="<?php echo ASSETSPATH; ?>js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETSPATH; ?>js/datatable/datatables/datatable.custom.js"></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo  ASSETSPATH; ?>plugins/mdb-file-upload.min.js"></script>
<script>$('.file_upload').file_upload();</script>

<script>
var availableTags = [
<?php /*foreach($productdrop as $key=>$values) { 
echo "{ value:".$values->product_id." , label:'".$values->product_name."' },";
} */?>
];
$('#search_category').each(function(i, el) {
var that = $(el);
that.autocomplete({
source: availableTags,
select: function( event , ui ) {
$('#search_category_value').val(ui.item.value);  
setTimeout(function(){  $("#search_category").val(ui.item.label); }, 1);
}
});
});


function searchfield()
{
  var search_category_value = $('#search_category_value').val();
  var  select_category = $('#select_category').val();

  if(select_category!='' && search_category_value=='')
  window.location.href="<?php echo base_url('category/');?>"+select_category;
  else if(search_category_value!='')
  window.location.href="<?php echo base_url('categorysearch/');?>"+search_category_value;
  
  return false;
}


$(document).ready(function() {
    $('#basic-2').DataTable();
} );
</script> 



<?php
if(empty($contract_sign->contract_url))
  {
  ?>
<script src="<?php echo base_url(); ?>assets/pad/js/numeric-1.2.6.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/pad/js/bezier.js"></script>
<script src="<?php echo base_url(); ?>assets/pad/js/jquery.signaturepad.js" type='text/javascript'></script> 
<script src="<?php echo base_url(); ?>assets/pad/js/html2canvas.js" type='text/javascript'></script>
<script src="<?php echo base_url(); ?>assets/pad/js/json2.min.js"></script>
<script>
$(document).ready(function() {
$('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true,lineTop:260});
var $canvasDiv = $('#canvasdiv');
var canvas = document.getElementById("sign-pad");
canvas.height = $canvasDiv.innerHeight();
canvas.width = $canvasDiv.innerWidth();
});  


function submitsign(form_id) 
{
html2canvas([document.getElementById('sign-pad')], {
onrendered: function (canvas) {
var canvas_img_data = canvas.toDataURL('image/png');
var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
var order_id = '<?php echo (isset($orderId) && $orderId!='')?$orderId:''; ;?>';


if($("#terms").prop('checked') == true)
{
setTimeout(function(){ $('#contract').submit(); $('#'+form_id).submit(); }, 4000);
//ajax call to save image inside folder
$.ajax({
url: '<?php echo site_url('Order/creditcontract')?>',
data: { img_data:img_data,order_id:order_id},
type: 'post',
dataType: 'json',
success: function (response) 
{
}
});
}
else
{
  alert('Please read contract and then sign');
}
}
});
}  
</script>
<?php } ?>

<script>
var accormenu=document.getElementsByClassName('card-link');
var accordata=document.getElementsByClassName('card-data');
for (let i=0; i<accormenu.length; i++){
	accormenu[i].addEventListener('click',()=>{
	for(let j=0;j<accordata.length;j++){
	if(accordata[i].classList.contains('tabshow')){
	for(let s=0; s<accormenu.length; s++){
	accordata[s].classList.remove('tabshow');
	}
	}
	else {
	accordata[i].classList.add('tabshow');
	accormenu[j].classList.add('tabshow');
	}
	}
	});
	}
	

const fsticky = document.querySelector('#mainHeader')
window.addEventListener('scroll', function(e) {
if(window.innerWidth>1024){	
  const lastPosition = window.scrollY
  if (lastPosition > 0 ) {
    fsticky.classList.add('headerfixed')
  } else if (fsticky.classList.contains('headerfixed')) {
    fsticky.classList.remove('headerfixed')
  } else {
    fsticky.classList.remove('headerfixed')
  }
}
});
</script>
</body>
</html>
