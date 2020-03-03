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
<div id="step-<?php echo $stepno ;?>">
	<h4 class="order-card-title"> TASK <span class="float-right">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addNewTicket" data-backdrop="static" data-keyboard="false">Add Task</button></span> <hr/> </h4>  
    
	<div class="row">
          <?php
          if($task){
              foreach($task as $key=>$tas){
                  $start_date = date("m-d-Y", strtotime($tas->start_date));
                  $due_date = date("m-d-Y", strtotime($tas->due_date));
              ?>
          <div class="col-lg-6"> 
            <div class="custom-orderBox customTabs">
				<div class="custom-header">
				  <div class="row">
					  <div class="col-lg-12"> 
						  <div class="orderplaced-row">
							  <div class="order-col">
								  <p class="otitle"> Start Date: <?php echo $start_date; ?></p>
								  <p class="osubtitle">Due Date:<?php echo $due_date; ?> </p>
							  </div>
							  <div class="order-col">
								  <p class="otitle">Status:  <?php echo $tas->status_name; ?></p>
								  <p class="osubtitle">Priority:  <?php echo $tas->priority_name; ?></p>
							  </div>
						  </div>
					  </div>
				  </div>
				  </div>
				<div class="order-details-section">
                    <div class="row">
                        <div class="col-lg-12"> 
                          <h2 class="order-title"> <?php echo $tas->task_subject; ?> </h2>
                            <div class="row productDetails">
                                <div class="col-lg-12"> <p class="card-text"> <?php echo $tas->description; ?> </p> 
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm btn-block">Update Task As Complete</button>
                            <button type="button" class="btn btn-secondary btn-sm btn-block">Update Task As Complete</button>
                            <button type="button" class="btn btn-secondary btn-sm btn-block">Update Task As CAN Not Complete</button>
                        </div>
                    </div>
                </div>
            </div>	   
          </div>
    <?php  } 
    
      }else { echo 'No Task Found!';} ?>   
            </div>
  </div>
  

<!---pop up for task starts here--->

  <div class="modal supportpopup addNewTicket " id="addNewTicket">
    <div class="modal-dialog modal-lg">
       <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Task - Order No#: <?php echo $order->order_number;?></h4>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <form name="addCMS" method="POST"  id="added_task_funder" enctype="multipart/form-data">
                <div class="modal-content">
                <div class="row">
                    <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id');?>" /> 
                    <div class="form-group col-lg-6">
                      <label for="name">Task Subject </label>
                      <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required="required" data-original-title="" title="">
                    </div>
                     <div class="form-group col-lg-6">

                         <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputCity">Start Date</label>
                           <input  type="date"  name="start_date" required="required" class="form-control" />
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputState">Due Date</label>
                           <input  type="date" name="due_date" required="required" class="form-control" />
                          </div>
                        </div>
  
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="name"> Priority </label>
                      <select class="custom-select" name="priority" id="priority" required="required">
                        <option value="" >Select Priority</option>
                        <?php foreach ($priority as $key => $value){?>
                          <option value="<?php echo  $value->id; ?>" ><?php echo  $value->priority; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                     <div class="form-group col-lg-3">
                      <label for="name"> Type </label>
                      <select class="custom-select" name="task_type">
                        <option value="">Select Type</option>
                        <option value="generaltask">General Task</option>
                        <option value="orderprocess">Order Process</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="name"> Order Related Fields (Mark Flag) </label>
                      <select class="custom-select" name="related_to" onChange="getblockFields('<?php echo $order_id;?>',this.value);">
                        <option value="" >Select Block</option>
                        
                        <?php foreach($order_dynamic_block_menu as $key => $getResponse){
                              $block_name     = $getResponse->block_name;
                              $product_block_id   = $getResponse->block_id;
                            ?>
                            <option value="<?php echo $product_block_id; ?>"><?php echo $block_name; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    
                    <div class="form-group col-lg-12">
                      <label for="name"> Order Note: </label>
                      <textarea  class="form-control" id="description" name="description"  required="required"></textarea>
                    </div>
                    </div>
                   <div class="row" id="order-related-fields-block"></div>
                    
                    <div class="col-lg-12">
                      <button class="btn btn-primary" type="submit">Submit</button>
                       <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
function getUpdateBlockFieldItem(orderDetailId,orderId,blockId)
{   
    //$('#added_task_funder').addClass('loader');
    $.ajax({
      type:'POST',
      url:'<?php echo base_url('Ajax/getUpdateBlockFieldItem')?>',
      data:{order_detail_id:orderDetailId,orderId:orderId,block_id:blockId},
      beforeSend: function () {
        //$('.modal-body').css('opacity', '.5');
      },
      success:function(response){
         // $('#added_task_funder').removeClass('loader');
          //$('#order-related-fields-block').html(response);
      }
    });
}
</script>
