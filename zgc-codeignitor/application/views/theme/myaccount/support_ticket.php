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
table.dataTable input, table.dataTable select {
    border: 1px solid #efefef; height:auto;
}

.tab-status { display: inline-block;
    font-size: 12px;
    font-weight: 400;
    padding: .2em .7em .2em;
    border-radius: 3px; }

.tab-red { border:1px solid #ff2d42; color:#ff2d42;}
.tab-green { border: 1px solid #84c529; color: #84c529; }
.tab-gray { border: 1px solid #c0c0c0; color: #c0c0c0; }

.li-listsummary {}
.li-listsummary .listDigit { font-size: 1.5rem;
    color: #2b449c;}
.list-title.red-text { color:red; font-size:14px !important;}
.list-title.green-text { color:green; font-size:14px !important;}
.list-title.blue-text { color:blue; font-size:14px !important;}
.list-title.gray-text { color:gray; font-size:14px !important;}
.list-title.close-text { color:blue; font-size:14px !important;}

</style>
<div class="page-body vertical-menu-mt">
  <div class="page-header">
    <div class="row">
      <div class="col-md-7 project-heading">
        <h3 class="hide project-name"> Support Tickets </h3>
        <div id="project_view_name" class="pull-left"> </div>
      </div>
    </div>
  </div>

    <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?>
  <div class="card">
    <div class="card-body">

          <a href="javascript:void(0);"  data-toggle="modal" data-target="#createticket" class="btn btn-info mbot25">Add New ticket</a>
          <div style="height:30px;width:100%;"></div>
   
    <h2 class="panel-heading project-info-bg no-radius">Tickets Summary</h2>
<ul class="li-listsummary">
                <?php
     if($support_status_output)
     {
         foreach($support_status_output as $supp_key=>$suppo)
         {
    ?>  
        <li>
        <p class="listDigit"> <?php echo $support_count[$supp_key]; ?> </p>
        <p class="list-title green-text"> <?php echo $suppo; ?> </p>
        </li>
        <?php }  } ?>
		</ul>

<div class="support-ticket-details">

<form id="bulkdelete" method="post" action="<?php echo base_url('tickets/multidelete'); ?>">    			
<div class="table-responsive">
                      <table class="show-case" id="basic-3">
                        <thead>
                          <tr>
						  <th><button class="btn btn-warning" type="button" data-original-title="btn btn-danger" title="" id="selectsupport">Select All</button> </th>
                            <th>Client Name</th>
                            <th>Subject</th>
                            <th>Latest Message</th>
                            <th>Date & Time</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>

      <tbody>

                          <?php

                             if($ticket)
                             {
                               foreach($ticket as $supp)
                               {

             $last_reply = getlastreply($supp->ticket_id);


                $date = ($supp->datetime!=NULL)?date("m/d/Y H:i:s", strtotime($supp->datetime)):'';
                             ?>
                        <tr>
                             <td><input name="ids[]" class="selectsupport" type="checkbox" value="<?php echo $supp->ticket_id; ?>"></td>

                               <td><?php echo orderusersname($supp->user_id); ?></td>
                            <td><?php echo $supp->support_ticket_number.'-'.$supp->subject; ?></td>
                             <td><?php echo $last_reply; ?></td>
                            <td><?php echo $date; ?></td>
                            <td>
<select class="custom-select" name="priority" id="priority"  onclick="supportchangestatus('2',this.value,'<?php  echo $supp->ticket_id; ?>')">
<?php
if($priority)
{
foreach ($priority as $key => $value) 
{
?>
<option value="<?php echo  $value->id; ?>" <?php echo ($supp->priority==$value->id)?'selected':''; ?> ><?php echo  $value->priority; ?></option>
<?php } } ?>
</select>
                            </td>
                            <td> 
<select class="custom-select" name="status" id="status"  onclick="supportchangestatus('1',this.value,'<?php  echo $supp->ticket_id; ?>')">
        <option value=""> Choose One...</option>
        <?php foreach($support_status as $keysup=>$supphere) { ?>
          <option value="<?php echo $keysup; ?>" <?php echo ($supp->status==$keysup)?'selected':''; ?>><?php echo $supphere; ?></option>
        <?php } ?>
        </select>
                            </td>
                              <td>

                    <a  class="btn btn-success btn-xs" href="<?php echo base_url('tickets/reply/'.$supp->ticket_id)  ?>" data-original-title="btn btn-danger btn-xs" title="">Reply</a>

                    <a onclick="loadsupport('<?php echo $supp->ticket_id;  ?>','<?php echo base_url('tickets/save'); ?>');" class="btn btn-success btn-xs" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">Edit</a>

                <a class="btn btn-danger btn-xs"  href="<?php echo base_url('tickets/deleteticket/'.$supp->ticket_id)  ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>  

                              </td>
                          </tr>

                        <?php } } ?>
                        </tbody>

                        <tfoot>
                          <tr>
                            <th><button class="btn btn-danger"  onclick="return valthisform()" type="submit" data-original-title="btn btn-danger" title="">Bulk Delete</button></th>
                            <th>Client Name</th>
                            <th>Subject</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
				   </div>

                </form>
</div>	    
   
   
   
   
	</div>
  </div>
</div>



<!---pop up for task starts here--->
<div class="modal fade" id="exampleModalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
  <form name="addCMS" id="formupdate" method="POST" enctype="multipart/form-data">
    <div id="loadedittask"></div>

    </form>
  </div>
</div>



  <div class="modal fade" id="createticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
  <form name="addCMS" method="POST" action="<?php echo base_url('Tickets/save')?>"  enctype="multipart/form-data">

        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Add New Ticket </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">


        <div class="form-group">
        <label for="name"> Select Client </label>
      <select class="custom-select" name="user_id" id="user_id" required="required">
      <option value="" >--Select Client--</option>
      <?php
      if($priority)
      {
      foreach ($users as $key => $user) 
      {
      ?>
      <option value="<?php echo  $user->user_id; ?>" ><?php echo ucfirst($user->first_name).' '.ucfirst($user->last_name); ?></option>
      <?php } } ?>
      </select>
       </div>
     
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
        <select class="custom-select" name="status" id="status" required="required">
        <option value=""> Choose One...</option>
        <?php foreach($support_status as $keysup=>$supp) { ?>
          <option value="<?php echo $keysup; ?>"><?php echo $supp; ?></option>
        <?php } ?>
        </select>
        </div>

        <div class="form-group">
        <label for="name"> Department </label>
        <select class="custom-select" name="department" id="department" onclick="chanagerelate(this.value)" required="required">
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

<script type="text/javascript">   
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


  function supportchangestatus(type,value,support_id)
{
     $.post("<?php echo base_url('support/priorityupdate'); ?>",{type:type,value:value,support_id:support_id},function(data) 
    {
    });  
}

function supportchangestatus(type,value,support_id)
{
     $.post("<?php echo base_url('tickets/priorityupdate'); ?>",{type:type,value:value,support_id:support_id},function(data) 
    {
    });  
}



function loadsupport(ticket_id,action)
{
  $('#formupdate').removeAttr("action");
  $('#formupdate').attr("action",action);

    $.post("<?php echo base_url('tickets/loadticket'); ?>",{ticket_id:ticket_id},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}


 $('#selectsupport').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectsupport').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectsupport').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 

 </script>