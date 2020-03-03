<?php /* ?>
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
max-height: 80%;
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
<?php */ ?>
    <div id="step-<?php echo $stepno ;?>">
        <h4 class="order-card-title"> Funding <span class="float-right">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addFunding" data-backdrop="static" data-keyboard="false">Add Funding</button></span></h4>
            <div class="row">
                <div class="table-responsive">
                  <table class="table" id="basic-2">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Bank Name</th>
                        <th>Applied Date</th>
                        <th>Status</th>
                        <th>Approval Amount</th>
                        <th>Verification Needed</th>
                        <th>Date Received</th>
                        <th>Experian</th>
                        <th>Transunion</th>
                        <th>Equifax</th>
                        <th>Notes</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php
                  if($fundinglist){
                      foreach($fundinglist as $resfunding){
                          $created_at = date("m-d-Y", strtotime($resfunding->created_at));
                      ?>
                            <tr>
                                <td><?php echo $resfunding->id;?></td>
                                <td><?php echo $resfunding->fn_bank;?></td>
                                <td><?php echo $resfunding->fn_dateapplied;?></td>
                                <td><?php echo $resfunding->fn_status;?></td>
                                <td><?php echo $resfunding->fn_approvalamount;?></td>
                                <td><?php echo $resfunding->fn_verificationneeded;?></td>
                                <td><?php echo $resfunding->fn_datereceived;?></td>
                                <td><?php echo $resfunding->fn_experian;?></td>
                                <td><?php echo $resfunding->fn_transunion;?></td>
                                <td><?php echo $resfunding->fn_equifax;?></td>
                                <td><?php echo $resfunding->notes;?></td>
                              <td> 
                                <!-- <a class="btn btn-orderDetails mobile-orderDetails" href="<?php //echo base_url('editfunding/'.$resfunding->id); ?>" >Edit</a>
                                <a class="mobileinvoice btn btn-orderDelete" onClick="return doconfirm();" href="<?php //echo base_url('users/deleteuser/'.$cli->user_id) ?>" >Delete</a>-->
                              </td> 
                              </tr>

                  <?php } ?>
                  
            <?php 
              }else { echo 'No Funding Found!';} ?>  
                </tbody>
                </table>
                </div>
            </div>
          </div>
  

<!---pop up for Funding starts here--->

  <div class="modal supportpopup addNewTicket " id="addFunding">
    <div class="modal-dialog modal-lg">
       <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Funding - Order No#: <?php echo $order->order_number;?></h4>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="modal-content" id="funding-message">

          <form name="addform" method="POST" id="add-order-funding">
            <div class="row">
            <div class="col-lg-12"> <h5 class="box-title">Add Funding</h5> </div>
            <input type="hidden" id="order_id" name="order_id" value="<?php echo $order->order_id;?>">    
            <div class="col-md-4">
            <div class="form-group">
            <label>Bank Name</label>
             <select name="fn_bank" class="form-control" required autocomplete="off">
                <option value="">select Bank</option>
                <?php foreach($banklist as $Resbank){?>
                <option value="<?php echo $Resbank->bank_name;?>"><?php echo $Resbank->bank_name;?></option>
                <?php } ?>
              </select>
                              
            </div>
            </div>
            
            <div class="col-md-4">
            <div class="form-group">
            <label>Date Applied</label>
            <input id="fn_dateapplied" name="fn_dateapplied" type="date" class="form-control" data-date-format="DD/MM/YYYY">
            </div>
            </div>
            
            <div class="col-md-4">
            <div class="form-group">
            <label>Status</label>
            <select name="fn_status" class="form-control">
            <option value="Need To Apply">Need To Apply</option>
            <option value="Approved">Approved</option>
            <option value="Declined">Declined</option>
            <option value="Pending">Pending</option>
            </select>
            </div>
            </div>
            
            <div class="col-md-4">
            <div class="form-group">
            <label>Approval Amount </label>
            <input id="fn_approvalamount" name="fn_approvalamount" type="text" class="form-control"></div>
            </div>
            
            <div class="col-md-4">
            <div class="form-group">
            <label>Verification Needed </label>
            <select name="fn_verificationneeded" class="form-control">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            </select>
            </div>
            </div>
            
            <div class="col-md-4">
            <div class="form-group">
            <label> Date Received </label>
            <input id="fn_datereceived" name="fn_datereceived" type="date" class="form-control" data-date-format="DD/MM/YYYY">
            </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
            <label>Experian</label>
            <select name="fn_experian" class="form-control">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            </select>
            </div>
            </div>
            
            <div class="col-md-4">
            <div class="form-group">
            <label>Equifax</label>
            <select name="fn_equifax" class="form-control">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            </select>
            </div>
            </div>
            
            <div class="col-md-4">
            <div class="form-group">
            <label>Transunion</label>
            <select name="fn_transunion" class="form-control">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            </select>
            </div>
            </div>
            
            <div class="col-md-12">
            <div class="form-group">
            <label>Notes</label>
            <textarea name="notes" class="form-control" required=""></textarea>
            </div>
            </div>
            
            <div class="col-md-12">
            <div class="form-group">
            <label>Admin Notes</label>
            <textarea name="admin_notes" id="admin_notes" class="form-control"></textarea>
            </div>
            </div>
            
              <div class="col-md-12">
                <div class="box-footer">
                      <button class="btn btn-primary" type="button" onclick="getUpdateFunding()" id="funding_button">
                        Submit
                      </button>
                       <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div> 
            </form>
          </div>
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
              </div>
            </div>
          </div> 	 
          <div class="ticket-message-box">
            <div class="ticket-info-icon pull-left"><span class="messageTitle"> S </span></div>
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

function getblockFields(orderId,blockId)
{   
    $('#order-related-fields-block').addClass('loader');
    $.ajax({
      type:'GET',
      url:'<?php echo base_url('Ajax/getallFieldsofBlock')?>',
      data:'orderId='+orderId+'&blockId='+blockId,
      beforeSend: function () {
        //$('.modal-body').css('opacity', '.5');
      },
      success:function(response){
          $('#order-related-fields-block').removeClass('loader');
        $('#order-related-fields-block').html(response);
      }
    });
}

function getUpdateFunding()
{    
    $('#funding_button').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submit');
    var fundingdata = $('#add-order-funding').serialize();
    $.ajax({
      type:'POST',
      url:'<?php echo base_url('Ajax/addupdateFunding')?>',
      data:fundingdata,
      beforeSend: function () {
        //$('.modal-body').css('opacity', '.5');
      },
      success:function(response){
        $('#funding_button').html('Submit');
          $('#funding-message').html(response);
      }
    });
}
</script>
