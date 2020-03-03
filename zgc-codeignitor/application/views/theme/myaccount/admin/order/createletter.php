  <?php include_once ('top_content.php'); ?>


  <h2 class="orderview-title"> Generate Letter</h2>
  <div style="margin-top: 20px;">
  <div class="horizontal-steeper">
    <div class="tab-content">
        <div class="tab-pane active" id="disputeditem" role="tabpanel">
            <div class="card fullwidth-col personalProfile" >
                <div  style="margin-top: 0px;">
                    <form name="addform" method="POST" action="<?php echo site_url('order/generateLetter/'.$order_id)?>">
                        <div class="disputed-items-actionables sticky-top">
                          <button class="btn btn-success" type="submit" >Generate Letter</button>
                        </div>
                        <br>
                        <div class="disputed-items-actionables sticky-top">
                          <select class="custom-select form-control" required="" name="letter_id" id="letter_id">
                            <option value="">--Select--</option>
                            <?php foreach ($letter_templates as $key => $value) { ?>
                              <option value="<?php echo $value->id; ?>"><?php echo $value->subject; ?></option>
                            <?php } ?> 
                          </select>
                        </div>
                        <input type="hidden" name="OrderId" id="OrderId" value="<?php echo $order_id; ?>">
                      </form>
                </div>
                <div>
                    <div style="padding: 15px;">
                      <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 

                      <?php echo $dispute_items;?>
                    </div>
                </div>
            </div>
        </div>
        </div>
      </div>
  </div>

  <script type="text/javascript">
    
    $('#selectcredit').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectallcredit').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectallcredit').prop('checked', true);
      $(this).addClass('checkedAll');
    }
});


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
          window.location.reload();
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
 /*****Update dispute create Letter Data *****/
 function getupdatepersonal(dispute_pf_id,value,field,orderId)
 {
   $.post("<?php echo base_url('Ajax/updateDisputePersonalInfo'); ?>",{dispute_pf_id: dispute_pf_id,value:value,field:field,order_id:orderId},function(data){
       
   });
 }
</script>
<?php include_once ('bottom_content.php');
