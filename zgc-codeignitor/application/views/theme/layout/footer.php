<style>
  .error {
  margin: 0px !important;
  color: red !important; }
.footer { background-color:#2c469d; color:#fff; padding:5px 0px;}
</style>
<!-- footer start-->
        <footer class="footer">
          <div class="container">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0"><?php echo sitefield('copyright'); ?>.</p>
              </div>
              <div class="col-md-6">
<p class="pull-right mb-0">ZEROGRAVITYCREDIT</p>
              </div>
            </div>
          </div>
        </footer>
      
	  
	  </div>
    </div>
   <!-- latest jquery-->
    <!--<script src="<?php echo  ASSETSPATH; ?>js/jquery-3.2.1.min.js"></script>-->
    <!-- Bootstrap js-->
    <script src="<?php echo  ASSETSPATH; ?>js/bootstrap/popper.min.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/bootstrap/bootstrap.js"></script>
    <!-- feather icon js-->
    <script src="<?php echo  ASSETSPATH; ?>js/icons/feather-icon/feather.min.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="<?php echo  ASSETSPATH; ?>js/sidebar-menu.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/config.js"></script>

   
    <script src="<?php echo ASSETSPATH; ?>js/jquery.validate.min.js"></script>
    <script src="<?php echo ASSETSPATH; ?>js/additional-methods.min.js"></script>

	<script src="<?php echo ASSETSPATH; ?>js/datatable/datatables/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    var base_url = "<?php echo base_url() ?>";
  </script>
    <script src="<?php echo ASSETSPATH; ?>js/datatable/datatables/datatable.custom.js"></script>

    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
    <!-- Plugins JS start-->
    <script src="<?php echo  ASSETSPATH; ?>js/chart/chartjs/chart.min.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/chart/chartist/chartist.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/chart/chartist/chartist-plugin-tooltip.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/chart/knob/knob.min.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/chart/knob/knob-chart.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/prism/prism.min.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/clipboard/clipboard.min.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/counter/jquery.waypoints.min.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/counter/jquery.counterup.min.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/counter/counter-custom.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/custom-card/custom-card.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/notify/bootstrap-notify.min.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/vector-map/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/vector-map/map/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/vector-map/map/jquery-jvectormap-us-aea-en.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/vector-map/map/jquery-jvectormap-uk-mill-en.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/vector-map/map/jquery-jvectormap-au-mill.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/vector-map/map/jquery-jvectormap-chicago-mill-en.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/vector-map/map/jquery-jvectormap-in-mill.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/vector-map/map/jquery-jvectormap-asia-mill.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/dashboard/default.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/notify/index.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/chat-menu.js"></script>
    <script src="<?php echo  base_url(); ?>/js/tooltip-init.js"></script>
    <script src="<?php echo  ASSETSPATH; ?>js/animation/wow/wow.min.js"></script>
	
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
<script src="<?php echo  ASSETSPATH; ?>js/script.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/jquery.drilldown.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/vertical-menu.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/megamenu.js"></script>
<script src="<?php echo  ASSETSPATH; ?>js/product-tab.js"></script>
<link rel="stylesheet" href="<?php echo  ASSETSPATH; ?>assets/css/jquery-ui.css">
<script src="<?php echo  ASSETSPATH; ?>assets/js/jquery-ui.js"></script>
<script>
$( "#datepicker11" ).datepicker({ minDate: 0});
$( "#due_date12" ).datepicker({ minDate: 0});
$( "#datepicker11_edit" ).datepicker({ minDate: 0});
$( "#due_date12_edit" ).datepicker({ minDate: 0});
</script>
	  
	<script>
const fsticky = document.querySelector('#filtersticky')
window.addEventListener('scroll', function(e) {
if(window.innerWidth>1024){	
  const lastPosition = window.scrollY
  if (lastPosition > 100 ) {
    fsticky.classList.add('factive')
  } else if (fsticky.classList.contains('factive')) {
    fsticky.classList.remove('factive')
  } else {
    fsticky.classList.remove('factive')
  }
}
else{}  
})


$('#1_wrapper_datatable').dataTable( {
  "pageLength": 50
} );
</script>


</body>
</html>