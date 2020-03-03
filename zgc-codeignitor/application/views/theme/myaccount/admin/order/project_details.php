<link rel="stylesheet" type="text/css" href="https://beta.focusfico.com/assets/css/datatables.css">
<link rel="stylesheet" type="text/css" href="https://beta.focusfico.com/assets/css/datatable-extension.css">
<link rel="stylesheet" type="text/css" href="https://beta.focusfico.com/assets/css/date-picker.css">
<style>
.nav-link {
  display: block;
  padding: 0.5rem 0.8rem;
}
.nav i {
  margin-right: 3px;
}
.nav-tabs .nav-link {
  color: #000;
  font-weight:700;
}
.nav-tabs .nav-link.active {
  color: #2a439b;
}
.panel-heading {
  padding-bottom: 15px;
  font-weight: 700;
  font-size: 20px;
  text-transform: uppercase; color:#2b449c;
}
h2.panel-heading {}
.img-border-radius {
    height: 32px;
    width: 32px;
    border-radius:100px;
  border:none !important;
}
.li-listsummary, .li-listsummary p { margin: 0;
    padding: 0;
    font-size: 16px;
    line-height: 23px;
    font-weight: 600; }
.li-listsummary li { list-style:none; text-align:center;}
.li-listsummary { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;}
.li-listsummary p.list-title { font-weight:800; font-size:18px;}

@media(max-width:767px){
  .li-listsummary { display:list-item;}
  .li-listsummary li {
    list-style: none;
    text-align: center;
    width: 50%;
    float: left;
    margin-bottom: 25px;
}
}

.fileupload {     border: #e2e2e2 solid 1px !important;
    padding: 15px !important;
    min-height: 100px !important;
    margin-bottom: 35px !important;
    display: flex;
    justify-content: center;
    align-items: center;}
  
.fileupload .form-control { padding-bottom:38px;}

.textarea {
    border-radius: 3px;
    border: 1px solid #bfcbd9;
}

.textarea {
    margin: 0;
    outline: 0;
    overflow-y: auto;
    cursor: text;
    border: 1px solid #CCC;
    background: #FFF;
    font-size: 1em;
    line-height: 1.45em;
    padding: .25em .8em;
    padding-right: 2em;
}

.comment-box {
    padding-top: 60px;
    padding-bottom: 10px;
}

.comment-box .media img {
    margin-right: 20px;
}

.control-row {
    margin-top: 10px;
}

.control-row>span {
    padding: 5px 20px!important;
    border-radius: 4px;
}

.control-row > span {
    float: right;
    color: #FFF;
    padding: 0 1em;
    font-size: 1em;
    line-height: 1.6em;
    margin-top: .4em;
    border: 1px solid rgba(0, 0, 0, 0);
    opacity: 1;
    background: #2b449c;
    margin-left: 10px;
}

.control-row > span.upload {
    position: relative;
    overflow: hidden;
    background-color: #999;
}

.control-row > span.enabled {
    opacity: 1;
    cursor: pointer;
}

.control-row > span.upload input {
    cursor: pointer;
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    opacity: 0;
    height: 100%;
}

.textarea-wrapper:after {
    content: " ";
    position: absolute;
    border: 7px solid #FFF;
    left: 7px;
    top: 1px;
    width: 10px;
    height: 10px;
    box-sizing: border-box;
    border-bottom-color: rgba(0, 0, 0, 0);
    border-left-color: rgba(0, 0, 0, 0);
}

.reply-box { margin-top:60px;}

.fileattachment {     float: right;
    width: 100%;
    text-align: right;
    display: flex;
    justify-content: flex-end;}

.discussions-comments { margin-top:45px;}
.discussions-comments h2 { margin-bottom:20px !important;}
.discussions-comments h2, .discussions-comments p { margin:0; padding:0;} 
</style>


<style type="text/css">
 .loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
} 
</style>


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

<div class="modal fade" id="createnotes" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
  <form name="addCMS" action="<?php echo base_url('Notes/save')?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Add New Notes </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            
        <div class="form-group">
        <label for="name"> Subject </label>
        <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required="required" data-original-title="" title="">
        </div>

        <div class="form-group">
        <label for="name"> Description </label>
        <textarea  class="form-control" id="notes" name="notes"  required="required" rows="6" cols="100"></textarea>
        </div> 

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
        </div>

    </form>
  </div>
</div>


<!---pop up for task starts here--->
<div class="modal fade" id="exampleModaldynamicfield" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="z-index: 1600;">
        <div class="modal-dialog modal-lg" role="document">
    <div id="loadedittaskdynamicfield"></div>
  </div>
</div>


<!---pop up for task starts here--->
<div class="modal fade" id="exampleModalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
  <form name="addCMS" id="formupdate" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
    <div id="loadedittask"></div>

    </form>
  </div>
</div>


  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="z-index: 1400;">
        <div class="modal-dialog" role="document">
  <form name="addCMS" method="POST" action="<?php echo base_url('task/save')?>"  enctype="multipart/form-data">

    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Add New Task </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            
        <div class="form-group">
        <label for="name"> Subject </label>
        <input class="form-control" id="task_subject" name="task_subject" type="text" placeholder="Subject" required="required" data-original-title="" title="">
        </div>

        <div class="form-group row">
        <div class="col-lg-6">
        <label for="name"> Start Date </label>
        <div class="input-group">
        <input  type="text"  id="datepicker11" name="start_date" required="required" class="form-control" style="position: unset !important;"></div>
        </div>
        <div class="col-lg-6">
        <label for="name"> Due Date </label>
        <div class="input-group">
        <input  type="text"   id="due_date12" name="due_date" required="required" class="form-control" style="position: unset !important;"></div>
        </div>
        </div>


        <div class="form-group row">
        <div class="col-lg-6">
        <label for="name"> Priority </label>
      <select class="custom-select" name="priority" id="priority" required="required">
      <option value="" >--Select Priority--</option>
      <?php
      if($priority)
      {
      foreach ($priority as $key => $value) 
      {
      ?>
      <option value="<?php echo  $value->id; ?>" ><?php echo  $value->priority; ?></option>
      <?php } } ?>
      </select>
        </div>

        <div class="col-lg-6">
        <label for="name"> Related To </label>
        <select class="custom-select" name="related_to" id="related_to" onchange="showselectpopup('<?php echo $orders->order_id; ?>','<?php echo $orders->product_id; ?>',this.value)">
         <option value=""> Choose One...</option>
           <?php
      $totalblock = count($order_dynamic_block_menu);
      $b=1;
      
      foreach($order_dynamic_block_menu as $key => $getResponse){
        $block_name     = $getResponse['block_name'];
        $product_block_id   = $getResponse['block_id'];
        //$getcustom_fields   = $getRes->custom_fields;
        ?>
        <option value="<?php echo $product_block_id; ?>"><?php echo $block_name; ?></option>
        <?php } ?>
        </select>
        </div>
        </div>


 <div class="form-group row"> <div id="loadvalues"></div></div>

        <div class="form-group row">
        <div class="col-lg-6">
        <label for="name"> Status </label>
        <select name="task_status" class="custom-select" id="task_status" required="required">
        <option value="" > Choose One...</option>
  <?php 
        if($task_status)
        {
           foreach($task_status as $keynew=>$status)
             {
              ?>
              <option value="<?php echo $keynew; ?>" ><?php echo $status; ?></option>
              <?php
             }
        }
  ?>
      </select>
        </div>
        </div>


          <div class="form-group">
        <label for="name"> Description </label>
        <textarea  class="form-control" id="description" name="description"  required="required"></textarea>
        </div> 

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
        </div>
      </form>
        </div>
        </div>


<!---pop up for task ends here--->


<!---pop up for support starts here--->

  <div class="modal fade" id="createticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
  <form name="addCMS" method="POST" action="<?php echo base_url('Support/save')?>"  enctype="multipart/form-data">

    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Add New Ticket </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
     
        <div class="form-group">
        <label for="name"> Subject </label>
        <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required="required" data-original-title="" title="">
        </div>

        <div class="form-group">
        <label for="name"> Priority </label>
      <select class="custom-select" name="priority" id="priority" required="required">
      <option value="" >--Select Priority--</option>
      <?php
      if($priority)
      {
      foreach ($priority as $key => $value) 
      {
      ?>
      <option value="<?php echo  $value->id; ?>" ><?php echo  $value->priority; ?></option>
      <?php } } ?>
      </select>
        </div>


        <div class="form-group">
        <label for="name"> Status </label>
        <select class="custom-select" name="status" id="status">
        <option value=""> Choose One...</option>
        <?php foreach($support_status as $keysup=>$supp) { ?>
          <option value="<?php echo $keysup; ?>"><?php echo $supp; ?></option>
        <?php } ?>
        </select>
        </div>

        <div class="form-group">
        <label for="name"> Department </label>
        <select class="custom-select" name="department" id="department" onclick="chanagerelate(this.value)">
        <option value=""> Choose One...</option>
         <?php foreach($support_depart as $supp) { ?>
        <option value="<?php echo $supp->id; ?>"><?php echo $supp->dept; ?></option>
         <?php } ?>
        <option value="custom">Custom</option>
        </select>
        </div>

         <div class="form-group" id="showdept" style="display: none;">
      <input class="form-control" id="dept" name="dept" type="text" placeholder="Department" data-original-title="" title="">
         </div>
            

        <div class="form-group">
        <label for="name"> Description </label>
        <textarea  class="form-control" id="description" name="description"  required="required"></textarea>
        </div> 


        <div class="form-group">
        <label for="name"> Attach Files </label>
         <input type="file" name="image" id="image"  class="form-control" >
        </div> 

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
        </div>
      </form>
        </div>
        </div>

<!---pop up for support ends here--->

<script type="text/javascript"> 
  function uploadfile()
  {
  $("#upload_file").toggle();
  }

  function chanagerelate(relate) 
  {
  if(relate=='custom')
  {
  $('#showdept').show();
  }
  else
  {
  $('#showdept').hide();
  }
  }

 $('#selectAll2').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectall').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectall').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 



 $('#selectsupport').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectsupport').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectsupport').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 



 $('#selectnotes').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectnotes').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectnotes').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 

function valthisform()
{
    var count_checked = $("[name='ids[]']:checked").length; // count the checked rows
        if(count_checked == 0) 
        {
            alert("Please select atleast one checkbox");
            return false;
        }
        else
        {
          job=confirm("Are you sure to delete?");
          if(job!=true)
          {
          return false;
          }
        }
}

function loadtask(task_id,action)
{

  $('#formupdate').removeAttr("action");
  $('#formupdate').attr("action",action);

  $.post("<?php echo base_url('task/loadtask'); ?>",{task_id:task_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}

function taskchangestatus(type,value,task_id)
{
    $.post("<?php echo base_url('task/statuspriority'); ?>",{task_id:task_id,value:value,type:type},function(data) 
    {
      $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    });  
}


function taskchangestatusfinal(type,value,task_id)
{
      $.post("<?php echo base_url('task/statuspriorityfinal'); ?>",{task_id:task_id,value:value,type:type},function(data) 
    {
      $('#exampleModaldynamicfield').modal('hide');
    });  
}

function supportchangestatus(type,value,support_id)
{
     $.post("<?php echo base_url('support/priorityupdate'); ?>",{type:type,value:value,support_id:support_id},function(data) 
    {
    });  
}


function loadsupport(support_id,action)
{
  $('#formupdate').removeAttr("action");
  $('#formupdate').attr("action",action);

    $.post("<?php echo base_url('support/loadsupport'); ?>",{support_id:support_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}

function loadnotes(notes_id,action)
{
   $('#formupdate').removeAttr("action");
   $('#formupdate').attr("action",action);

    $.post("<?php echo base_url('notes/loadnotes'); ?>",{notes_id:notes_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}

function loadnotesview(notes_id)
{
    $.post("<?php echo base_url('notes/loadnotesview'); ?>",{notes_id:notes_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}

$(document).ready(function() {
    $('#basic-3').DataTable();
} );


function showselectpopup(orders_id,product_id,product_block_id)
{
  $.post("<?php echo base_url('projects/getproductcustomfields'); ?>",{orders_id:orders_id,product_id:product_id,product_block_id:product_block_id},function(data) 
    {
      $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    });
}


function showselectpopupfixnow(orders_id,product_id,product_block_id,task_id)
{
    $.post("<?php echo base_url('projects/getproductcustomfieldsfixnow'); ?>",{orders_id:orders_id,product_id:product_id,product_block_id:product_block_id,task_id:task_id},function(data) 
    {
      $('#loadedittaskdynamicfield').html(data);
      $('#exampleModaldynamicfield').modal('show');
    });
}

  function getOrderStepDetail(orderId,blockId,stepId,totalsteps){
    $('#orderview_step_detail').html('<div class="loader"></div>');
    stepno(stepId,totalsteps);
    $.ajax({
      type:'GET',
      url:'<?php echo base_url('Ajax/getOrderStepDetail')?>',
      data:'orderId='+orderId+'&blockId='+blockId+'&stepId='+stepId,
      beforeSend: function () {
        $('.modal-body').css('opacity', '.5');
      },
      success:function(response){
        $('#step-'+stepId).html(response);
      }
    });
  }


    function stepno(stepId,totalsteps){
    for(var i=1;i<=totalsteps;i++){
      if(i==stepId){
        $('#stepmenu_'+stepId).removeClass();
        $('#stepmenu_'+stepId).addClass('selected');
      }else{
        $('#stepmenu_'+i).removeClass();
        $('#stepmenu_'+i).addClass('nav-link deselected');
      }
    }
  } 



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
          alert('Data saved successfully');
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
