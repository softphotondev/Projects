  <?php include_once ('top_content.php'); ?>
  
  <h2 class="orderview-title"> Bot Table</h2>    
  <div class="horizontal-steeper">
    
    <div class="tab-content">
    <div class="tab-pane active" id="disputeditem" role="tabpanel">
    <div class="card fullwidth-col personalProfile" >
    <div class="card-header">
      <a  class="btn btn-success" href="<?php echo base_url('Order/getrunbot/'.$order_id); ?>" > Run </a>
      <button type="button" class="btn btn-success" onclick="resetdata()" > Reset Data </button>
      <button type="button" class="btn btn-success" onclick="savedata()" > Save Data </button>
    </div>
    <div>
		<?php echo $dispute_items;?>
    </div>
    </div>
    </div>
    </div>
  </div>
  <script type="text/javascript">


  function savedata()
  {
      // Get form
      var form = $('#savedispute')[0];
      // Create an FormData object 
      var data = new FormData(form);
      $.ajax({
      url: '<?php echo base_url('Invoice/saveDisputemobileajax'); ?>',
      type: "POST",
      enctype: 'multipart/form-data',
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      success: function(data)   // A function to be called if request succeeds
      {
        if(data=='success')
        {
          //window.location.reload();
        }
      }
      });
  }

function resetdata()
{
   var order_id = '<?php echo $order_id; ?>';
   var user_id = '<?php echo $orders->user_id; ?>';

  job=confirm("Are you sure to reset dispute items?");
  if(job!=true)
  {
    return false;
  }
  else
  {
    $.post("<?php echo base_url('Invoice/resetreport'); ?>",{order_id:order_id,user_id:user_id},function(data) 
    {
       window.location.reload();
    });
  }

} 
</script>


<script type="text/javascript">
  function changereason(value,id)
 {
     $.post("<?php echo base_url('order/changereason'); ?>",{value:value},function(html) 
    {
     $('#'+id+'_instruction').html(html);
    });
 } 
 /*****Update dispute Data in bot Data *****/
 function getupdatepersonal(dispute_pf_id,value,field,orderId)
 {
   $.post("<?php echo base_url('Ajax/updateDisputePersonalInfo'); ?>",{dispute_pf_id: dispute_pf_id,value:value,field:field,order_id:orderId},function(data){
       
   });
 }
</script>
   <?php include_once ('bottom_content.php'); ?>
