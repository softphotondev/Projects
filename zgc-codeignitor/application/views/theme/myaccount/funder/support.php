<style>
.projects-status {
	margin-bottom: 30px;
}
.custom-support-data { margin-top:25px; margin-bottom:25px; background-color:#fff; padding:10px;}

.label {
    border-radius: 3px;
    color: 
    #fff;
    font-size: 12px;
    line-height: 1;
    margin-bottom: 0;
    text-transform: capitalize;
    padding: 3px 5px;
}
.custom-support-data .fa-reply { margin:0px 10px; color:#158df7; cursor:pointer;}
.custom-support-data .fa-times { color:#d33;}
.supportpopup .modal-header { background: #2b449c; color: #fff;}
.modal-title { text-transform: uppercase; font-weight: 600; font-size: 20px;}
.modal-title span { color: #ffef06;
text-transform: capitalize;
font-size: 15px;
font-weight: 600;
display: inline-block;
padding-left: 15px;}

.modal-header .close { color: #fff; opacity: 1;}
.ticketview-box .ticket-main-info { margin-left: 45px; }
.otherInfo div { display:flex;}
.otherInfo div strong { padding-right:10px;}
.otherInfo div strong span { padding-left:10px;}
.ticket-info-subject {
    font-weight: 600;
    padding: 5px 0px;
    color: 
    #2b449c;
    font-size: 16px;
}
.supportpopup .fa-ticket { color:#319d00;}
.ticketview-box { box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12); border-left: 4px solid #4CAF50; padding: 15px; background:#fff; margin-bottom:25px;} 
.supportpopup .modal-body { background-color:
#f1f1f1;
padding: 25px 25px 75px 25px;
max-height: 350px;
overflow-y: scroll;}
.supportpopup .modal-dialog { top: 0px; }

.ticket-message-box { 
 border-left: 4px solid #FFCB00; 
 padding: 15px; 
 background:#fffeeb; 
 margin-bottom:25px;} 
 
.ticket-message-subject {
    font-weight: 600;
    padding: 5px 0px;
    color: 
    #2b449c;
    font-size: 16px;
}
.ticket-message-box .ticket-message-info { margin-left: 55px; }
.messageTitle { display: flex;
align-content: center;
justify-content: center;
width: 40px;
background:
#ffcb00;
font-size: 18px;
border-radius: 50px;
padding: 5px;
}
.ticket-message-customer-name { color:#2b449c; font-size: 20px; font-weight: 600;}
.ticket-message-message-time { font-size:12px;}
.support-data .modal-footer { position: fixed;
bottom: 0;
width: 100%;
background: #fff;}

.projects-status {
    margin-bottom: 0;
}
button.close { background:none !important;}
table.dataTable > tbody > tr.child ul.dtr-details {
    display: inline-block;
    list-style-type: none;
    margin: 0;
    width: 100%;
    background: #f6f6f6;
    padding: 15px;
}
.addNewTicket .modal-content { padding:15px;}

@media(min-width:768px){
	.supportList {
    display: flex;
    justify-content: center;
    align-items: center; padding:0px;
}
.list-staus h2 { padding:0px 5px;}
}

.ticket-form { padding:15px;}
</style>

<div class="page-body-wrapper">
  <div class="page-body">
    <div class="container-fluid">
      <div class="myaccount-profile my-upload">
        <div class="row">
          <?php if(isMobile()){?>
           <div class="col-lg-3"> <a class="btn mobile-backbtn" href="<?php echo site_url('order/myaccount');?>"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a></div> 
          <?php } ?>
		  
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-10"></div>
			  <div class="col-lg-2"> <a data-toggle="modal" data-target="#addNewTicket" data-backdrop="static" data-keyboard="false" class="btn btn-newTicket">Add New ticket</a></div>
			  
            </div>
             <div class="support-data">
             <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?>  
                 <div class="custom-support-data">
                    <table class="table table-bordered table-hover mytable " >
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Department</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Condition</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                    <tbody>
                     <?php
                      if($ticket){ 
                      foreach($ticket as $key=>$supp){
                          $replyData = $supp->reply_support_list;
                          ?>
                      <tr>
                          <td> <?php echo $supp->support_ticket_number ?? $key+1; ?></td>
                          <td> <?php echo $supp->subject; ?></td>
                          <td> <label class="label label-warning"><?php echo $supp->priority_name; ?></label> </td>
                          <td> <label class="label label-info"><?php echo $supp->status_name; ?></label> </td>
                          <td>  <?php echo $supp->department_name; ?> </td>
                          <td>  <?php echo date('m/d/Y',strtotime($supp->datetime)); ?>  </td>
                          <td>  <?php if(!empty($supp->updated_date)){ echo date('m/d/Y',strtotime($supp->updated_date)); }else { echo date('m/d/Y',strtotime($supp->datetime));} ?>  </td>
                          <td> <label class="label label-success"><?php echo $supp->status_name; ?></label> </td>
                          <td> 
                            <?php 
                            $created = date('m/d/Y h:i:s A',strtotime($supp->datetime)); 

                            ?>
                            <!--  Data added for support by Sanjeev on Date 12-2-20 / -->
                          <a data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false"> <i id="<?php echo $supp->support_ticket_number ?? $key+1; ?>" class="fa fa-reply" aria-hidden="true" data-subject="<?php echo $supp->subject; ?>" data-priority="<?php echo $supp->priority_name; ?>"data-status="<?php echo $supp->status_name; ?>" data-department="<?php echo $supp->department_name; ?>" data-fullname="<?php echo $supp->first_name.' '.$supp->last_name ?>" data-created="<?php echo $created ?>"></i> </a>
                          <!-- p tag for support by Sanjeev on Date 12-2-20 / -->
                          <p data-description="<?php echo $supp->description ?>"></p>
                          <!-- <a href="#"> <i class="fa fa-times" aria-hidden="true"></i> </a> -->
                          </td>
                      </tr>
                      <?php }} ?>
                    </tbody>
                  </table>		
                </div>
            </div>
          </div>
        </div>
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
              if($users){
                foreach ($users as $key => $user) {?>
              <option value="<?php echo $user->user_id; ?>"  <?php echo ($this->session->userdata('user_id')==$user->user_id)?'selected':''; ?>><?php echo ucfirst($user->first_name).' '.ucfirst($user->last_name); ?></option>
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
          <button class="btn btn-primary" type="submit">Save Support</button>
        </div>
      </div>
    </form>
	
	
  </div>
</div>


<div class="modal fade" id="replyticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form name="addCMS" method="POST" action="<?php echo base_url('Tickets/replysave')?>"  enctype="multipart/form-data">
      <input type="hidden" name="parent_id" id="ticket_id">
    <input type="hidden" name="status" id="status" >

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Reply Ticket </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
         
          <div class="form-group">
            <label for="name"> Description </label>
            <textarea  class="form-control" id="description" rows="5"  name="description"  required="required"></textarea>
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

<!-- Add New Support Ticket Modal -->
  <div class="modal supportpopup addNewTicket" id="addNewTicket">
    <div class="modal-dialog modal-lg">
       <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Tickets </h4>
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>-->
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form name="addCMS" method="POST" action="<?php echo base_url('Tickets/save')?>"  enctype="multipart/form-data">
                <div class="modal-content">
                <div class="row">
                    <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id');?>" /> 
                    <div class="form-group col-lg-6">
                      <label for="name"> Subject </label>
                      <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required="required" data-original-title="" title="">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="name"> Priority </label>
                      <select class="custom-select" name="priority" id="priority" required="required">
                        <option value="" >Select Priority</option>
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
                    <div class="form-group col-lg-6">
                      <label for="name"> Department </label>
                      <select class="custom-select" name="department" id="department" onclick="chanagerelate(this.value)" required="required">
                        <option value=""> Choose One...</option>
                        <?php foreach($support_depart as $supp) { ?>
                        <option value="<?php echo $supp->id; ?>"><?php echo $supp->dept; ?></option>
                        <?php } ?>
                        <option value="custom">Custom</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-6" id="showdept" style="display: none;">
                      <input class="form-control" id="dept" name="dept" type="text" placeholder="Department" data-original-title="" title="">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="name"> Description </label>
                      <textarea  class="form-control" id="description" name="description"  required="required"></textarea>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="name"> Attach Files </label>
                      <input type="file" name="image" id="image"  class="form-control" >
                    </div>
                  <div class="col-lg-12">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                  </div>	
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
  
  <!-- View Support Ticket Modal -->
  <div class="modal supportpopup" id="myModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"> </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>		 
        </div>
        <!-- Modal body -->
        <div class="modal-body">		
<div class="ticketview-box">
<div class="ticket-info-icon pull-left"><i class="fa fa-2x fa-fw fa-ticket"></i></div>
<div class="ticket-main-info">
<div class="ticket-info-status"> <label class="label label-info">Open</label> </div>
<div class="ticket-info-subject">Internet is very slow after Renew</div>
<div class="otherInfo">
<div><strong>Priority</strong>:<span><label class="label label-warning priority_label">High</label></span></div>
<div><strong>Department</strong>:<span class="department_label">Problem</span></div>
</div></div></div> 	 
<div class="ticket-message-box">
<div class="ticket-info-icon pull-left">
<span class="messageTitle"> S </span>
</div>
<div class="ticket-message-info">
<div class="ticket-message-customer-name"> Santosh Kumar </div>
<div class="ticket-message-message-time">  
about 22 hours ago [2020-02-08 01:48:51 AM] </div>
<hr>
<div class="custome-content">
<p> Hi Team, </p>
<p class="ticket-description"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s </p>
</div>
</div>
</div>

<form class="ticket-form">
<div class="form-group col-lg-12">
<label for="name"> Add message </label>
<textarea  class="form-control" id="message" name="message"  required="required"></textarea>
</div>
<div class="form-group col-lg-12">
<label for="name"> Attach Files </label>
<div class="custom-file">
<input type="file" class="custom-file-input" id="customFile" name="filename">
<label class="custom-file-label" for="customFile">Choose file</label>
</div>
</div>
</form>

</div>
        <div class="modal-footer">
		<button type="button" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script  src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script  src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script type="text/javascript">
$('.mytable').dataTable( {

"responsive" : true
} );
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<script>
$(document).ready(function() {
  $(document).on('click', '.fa-reply', function()
  {
    var support_id = $(this).attr("id");
    // Function for support by Sanjeev on Date 12-2-20 
    var ticket_status = $(this).data("status");
    var ticket_subject = $(this).data("subject");
    var ticket_priority = $(this).data("priority");
    var ticket_department = $(this).data("department");
    var ticket_customer = $(this).data("fullname");
    var ticket_description = $(this).parent().next("p").data("description");
    var ticket_created = $(this).data("created");
    // console.log(ticket_description);
    if (support_id != '')
    {
    	// $(".modal-title").append(support_id);	
      $(".modal-title").html(support_id); 
      // Function for support by Sanjeev on Date 12-2-20 
      $(".ticket-info-status label").html(ticket_status);
      $(".ticket-info-subject").html(ticket_status);
      $(".priority_label").html(ticket_priority);
      $(".department_label").html(ticket_department);
      $(".ticket-message-customer-name").html(ticket_customer);
      $(".ticket-description").html(ticket_description);
      $(".ticket-message-message-time").html("Created on: "+ticket_created);
    }
  });
});
</script>

