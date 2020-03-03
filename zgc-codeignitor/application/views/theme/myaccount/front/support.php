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
    color: #2b449c;
    font-size: 16px;
	display:inline-flex;
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
<!-- Bootstrap CSS -->    
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

<style>
ul, li {
	margin: 0;
	padding: 0;
	list-style: none;
}
a{
	text-decoration: none !important;
}
body {
    color: #222;
}
section.section_support {
    background: #f1f1f1;
    padding: 40px 0;
}
ul.left-tabs li {
    background: #1e73be;
    color: #fff;
    padding: 10px 10px 10px 20px;
    margin-bottom: 5px;
    font-size: 18px;
}
li.addnewticke_tbtn a {
    color: #fff;
    text-transform: uppercase;
    font-weight: 600;
}
li.addnewticke_tbtn {
    background: #db4432 !important;
    text-align: center;
    padding: 10px !important;
}
li.addnewticke_tbtn:hover {
    background: #ed3223 !important;
}
.filter_bar {
    background: #fff;
    display: flex;
    float: left;
    width: 100%;
    padding: 10px;
}
.filter_bar select.form-control {
    background: #f1f1f1;
    border: 0;
    text-transform: uppercase;
    font-weight: bold;
}
.ticket-div {
    float: left;
    width: 100%;
    margin-top: 40px;
    box-shadow: 0px 3px 5px 3px #ccc;
    background: #fff url(<?php echo base_url('assets/img/'); ?>div-bg.png) no-repeat 0 0 / cover;
}
h1.tic-h1.col-md-12 {
    display: inline-block;
    color: #1e73be;
    font-size: 27px;
    text-transform: uppercase;
    margin-top: 30px;
    padding-left: 60px;
    font-weight: bold;
}
.ticket-div .col-md-8 {
    text-align: right;
    font-weight: 600;
    float: right;
}
.ticket-cols h4 {
    text-transform: uppercase;
    font-weight: bold;
        font-size: 20px;
        line-height: 30px;
}
.row.ticket-cols .col-md-3 {
    text-align: center;
}
.ticket-cols h4 span {
    font-weight: 400;
    display: block;
}
.priority-div span {
    font-size: 16px;
}
.row.ticket-cols {
    float: left;
    width: 100%;
    margin: 30px 0;
}
.priority-img img {
    position: absolute;
    left: -22px;
    top: -32px;
}
.priority-div {
    padding: 10px 0 0;
}
.row.ticket-cols img {
    margin-bottom: 10px;
    max-width: 100%;
}
.row.ticket-cols .col-md-3:last-child img {
    margin: 0;
}
.ticket-div .col-md-8 strong {
    font-weight: bold;
        text-transform: uppercase;
}
button.reply-btn {
    background: #db4432 url(<?php echo base_url('assets/img/'); ?>reply1.png) no-repeat 20px center !important;
    color: #fff;
    padding: 8px 25px 8px 50px;
    text-transform: uppercase;
    font-weight: 600;
    font-size: 18px;
    border-radius: 0;
    border: 0;
    display: inline-block;
    float: right;
}
button.reply-btn-v {
    background: #db4432 url(<?php echo base_url('assets/images/credit-report-icon.png'); ?>) no-repeat 20px center !important;
    color: #fff;
    padding: 8px 25px 8px 50px;
    text-transform: uppercase;
    font-weight: 600;
    font-size: 18px;
    border-radius: 0;
    border: 0;
    display: inline-block;
    float: right;
	
}
.btn-info.focus, .btn-info:focus{
    box-shadow: unset;
}
button.reply-btn:hover {
    background-color: #ed3223 !important;
}
button.reply-btn-v:hover {
    background-color: #ed3223 !important;
}
ul.left-tabs li:hover {
    background: #124572;
}

/********** support - page**********/
ul.left-tabs li a {
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 16px;
}
ul.left-tabs li a img {
    margin-right: 5px;
}
li.logout-btn {
    background: #db4432 !important;
}
li.logout-btn:hover {
    background: #ed3223 !important;
}
section.section_tabs {
    background: #f1f1f1;
    padding: 40px 0;
}
span.order-txt-div {
    display: block;
    text-transform: uppercase;
}
span.invo-btn-div a {
    background: #1e73be;
    color: #fff;
    font-size: 14px;
    padding: 0px 10px 3px 10px;
    border-radius: 20px;
}
span.invo-btn-div a:hover {
    background: #124572;
}
.row.ticket-cols.support-info {
    width: 100%;
    float: left;
        margin: 20px 0;
}
.support-info img {
    padding: 20px 10px;
    border: 1px solid #efefef;
}
.col-md-8.supprt-dtl {
    text-align: left;
}
.col-md-8.supprt-dtl h2 {
    color: #1e73be;
    text-transform: uppercase;
    font-size: 24px;
}
span.sp-order {
    display: block;
    font-size: 18px;
}
span.sp-amount {
    color: #ff0000;
    font-size: 18px;
    font-weight: bold;
}
.row.supprt-box {
    text-align: center;
    background: rgba(0,0,0,0.1);
    margin: 0;
    padding: 20px 10px;
}
.row.supprt-box .col-md-4, .row.supprt-box .col-md-3, .row.supprt-box .col-md-5 {
    display: inline-grid;
    align-items: center;
    padding: 0;
}
.status-btns {
    float: left;
    width: 100%;
    display: inline-flex;
}
.status-btns .col-md-4 {
    padding: 0;
}
.status-btns a {
    display: block;
    text-align: center;
    color: #fff;
    text-transform: uppercase;
    font-weight: 600;
    padding: 10px 0;
}
a.status-btn1 {
    background: #1e73be;
}
a.status-btn2 {
    background: #dd3333;
}
a.status-btn3 {
    background: #fb740d;
}
a.status-btn4 {
    background: #3da249;
}
a.status-btn5 {
    background: #3537b2;
}
a.status-btn1:hover {
    background: #124572;
}
a.status-btn2:hover {
    background: #ed3223;
}
a.status-btn3:hover {
    background: #e1680b;
}
a.status-btn4:hover {
    background: #159525;
}
a.status-btn5:hover {
    background: #141693;
}
.status-admn {
    background: #fff;
    padding: 20px 10px;
    text-align: center;
    margin-bottom: 20px;
    box-shadow: 0px 6px 5px 1px #ddd;
}
.status-admn h2 {
    color: #1e73be;
    text-transform: uppercase;
    border-top: 1px solid #efefef;
    margin-top: 20px;
    padding-top: 10px;
}
.filter_bar3 input#srch-term {
    border-left: 0;
    border-top: 0;
    border-bottom: 0;
    background: transparent;
}
.filter_bar3 form.navbar-form {
    background: #f1f1f1;
}
.filter_bar3 input#srch-term::placeholder {
    font-weight: 600;
    color: #454545;
}
.status-admn img {
    max-width: 50%;
}

/************ section_popup ************/


.section_popup {
    background: #f1f1f1;
    padding: 40px 0;
}
.ticket_popup {
    width: 800px !important;
    max-width: 800px !important;
    margin: 0 auto;
    /*box-shadow: 0px 3px 5px 3px #ccc;*/
}
.ticket_popup_body{
    background: #fff url(<?php echo base_url('assets/img/'); ?>popup-bg.png) no-repeat center center / cover;
    padding-bottom: 20px;
}
.popup_head {
    background: #1e73be;
    color: #fff;
    float: left;
    margin-bottom: 5px;
    width: 100%;
    padding: 10px 20px;
}
a.close-btn {
    float: right;
}
.popup_head p {
    float: left;
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}
.ticket_popup_box {
    background: rgba(30,115,190,.2);
    width: 700px;
    margin: 20px auto !important;
    border-radius: 10px;
    display: flex;
    align-items: center;
    padding: 10px 20px 20px 20px;
}
.ticket_popup-left.col-md-9 {
    border-right: 1px solid #ccc;
    padding-left: 0;
}
.ticket-img span {
    background: #db4432;
    color: #fff;
    padding: 0 10px 3px 9px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 20px;
    margin-left: 10px;
}
.ticket-info-div h2 {
    color: #1e73be;
    font-size: 22px;
    text-transform: uppercase;
    font-weight: bold;
    margin: 10px 0;
    padding-left: 45px;
}
.attch-file span {
    display: inline-block;
    float: left;
    width: 100%;
        font-size: 18px;
    margin-bottom: 10px;
    font-weight: bold;
    text-transform: uppercase;
}
.ticket-info-div strong {
    text-transform: uppercase;
    display: block;
    font-size: 18px;
}
.attch-file.col-md-3 {
    text-align: center;
}
.row.sprt-cols {
    margin-left: 30px;
    text-transform: uppercase;
}
.ticket_popup_boxes {
    background: rgba(0,0,0,.1);
    width: 700px;
    margin: 20px auto 0px auto !important;
    border-radius: 10px;
    padding: 10px 20px 20px 20px;
}
.t-boxes-lft {
    text-align: center;
}
.t-boxes-lft span {
    background: #f3a331;
    color: #fff;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 24px;
    font-weight: 600;
    display: block;
    padding-top: 5px;
    margin: 10px auto 0 auto;
}
.t-boxes-ryt h4 {
    color: #1e73be;
    font-weight: bold;
    font-size: 20px;
}
.t-boxes-ryt span {
    font-size: 14px;
    display: block;
    line-height: normal;
}
.t-boxes-ryt .t-para {
    border-top: 1px solid #aaa;
    margin-top: 15px;
    padding-top: 10px;
}
.t-boxes-ryt p {
    margin: 0;
}
.ticket-btm {
    background: #fff;
    padding: 15px 15px 0;
    display: inline-block;
    width: 100%;
}
form.textarea-form textarea {
    background: #f1f1f1;
    border: 0;
    border-radius: 0;
    height: 130px;
    margin-bottom: 20px;
}
.close_btn {
    background: #db4432 !important;
}
a.submit_btn:hover {
    background: #124572;
}
a.submit_btn {
    background: #1e73be;
    margin-right: 1px;
}
.close_btn:hover {
    background: #ed3223 !important;
}
form.textarea-form a, form.textarea-form button {
    color: #fff !important;
    text-transform: uppercase;
    width: 150px;
    float: left;
    text-align: center;
    font-weight: 600;
    padding: 10px 0px;
}

/*********************** RESPONSIVE **********************/
@media (min-width: 576px) and (max-width: 767px){
.filter_bar select.form-control, .filter_bar input#srch-term {
    font-size: 12px;
}
.filter_bar3 form.navbar-form {
    height: 32px;
}
.filter_bar button.btn.btn-default {
    padding-top: 3px;
    padding-bottom: 0;
}
.row.supprt-box {
    margin-top: 20px;
}
.row.supprt-box .col-md-4, .row.supprt-box .col-md-3, .row.supprt-box .col-md-5 {
    width: 33.3%;
}
}

@media (max-width: 575px){
.filter_bar {
    display: block;
}
.filter_bar .col-md-4 {
    margin-bottom: 10px;
}
.filter_bar .col-md-4:last-child {
    margin-bottom: 0px;
}
.row.supprt-box {
    margin-top: 20px;
}

}

@media (max-width: 767px){
.ticket_popup {
    width: 90% !important;
    max-width: 90% !important;
}
.popup_head p {
    font-size: 16px;
    padding-top: 5px;
}
.ticket_popup-left.col-md-9 {
    border: 0;
    padding: 0;
}
.ticket-info-div h2 {
    padding: 0;
}
.row.sprt-cols {
    margin: 0;
}
.col-md-10.t-boxes-ryt {
    text-align: center;
}
.ticket_popup_box.row {
    text-align: center;
}
.row.ticket-cols .col-md-3 {
    margin-bottom: 10px;
}
.col-md-8.supprt-dtl {
    margin-top: 10px !important;
}
.row.ticket-cols.support-info .col-md-4 {
    text-align: center;
}
.filter_bar {
    margin-top: 40px;
}
.status-btns {
    display: inline-block;
}
.priority-img img {
    left: -15px;
    top: -30px;
    width: 100px;
}
.ticket-div .col-md-8 {
    text-align: center;
    float: none;
    margin:40px auto 0;
}
.ticket-div .col-md-8 span.col-md-6 {
    display: block;
}
h1.tic-h1.col-md-12 {
    padding-left: 20px;
    font-size: 24px;
    text-align: center;
}
.row.ticket-cols {
    margin: 20px 0;
}
.ticket_popup_box, .ticket_popup_boxes {
    width: 90%;
}

}


@media (min-width: 768px) and (max-width: 991px){
.ticket-cols h4 {
    font-size: 15px;
}
.ticket-cols h4 span {
    font-size: 14px;
}
.ticket_popup_box.row, .ticket_popup_boxes.row {
    width: 650px;
}
.ticket_popup {
    max-width: 700px !important;
    width: 700px !important;
}
.filter_bar3 input#srch-term {
    font-size: 14px;
}
h1.tic-h1.col-md-12 {
    font-size: 24px;
    padding-left: 30px;
    margin-top: 10px;
}
.priority-div span.col-md-6 {
    font-size: 13px;
    padding: 0;
    width: 100%;
    float: left;
    max-width: 100%;
}
.priority-img img {
    left: -15px;
    top: -30px;
    width: 100px;
}
li.addnewticke_tbtn a {
    font-size: 14px;
}
li.addnewticke_tbtn {
    padding: 10px !important;
}
ul.left-tabs li{
    font-size: 16px;
}
.filter_bar select.form-control {
    font-size: 14px;
}
.status-admn h2 {
    font-size: 20px;
}
.section_tabs ul.left-tabs li {
    padding: 10px 5px;
}
.section_tabs ul.left-tabs li a {
    font-size: 13px;
}
.col-md-8.supprt-dtl h2 {
    font-size: 20px;
    margin: 0;
}
span.sp-order, span.sp-amount {
    font-size: 16px;
}
.row.supprt-box .col-md-4 strong, .row.supprt-box .col-md-3 strong, .row.supprt-box .col-md-5 strong {
    font-size: 13px;
}
.row.supprt-box .col-md-4, .row.supprt-box .col-md-3, .row.supprt-box .col-md-5 {
    font-size: 11px;
}
.status-btns a, .status-btns-up a {
    font-size: 12px;
}

}



@media (min-width: 992px) and (max-width: 1199px){
.ticket-div .col-md-8 span.col-md-6 {
    font-size: 15px;
}
.section_tabs ul.left-tabs li {
    padding: 10px;
}
.section_tabs ul.left-tabs li a {
    font-size: 15px;
}
.priority-div span.col-md-6 {
    padding: 0;
    width: 100%;
    float: left;
    max-width: 100%;
}
}
.ticket_popup_boxes {
    background: rgba(0,0,0,.1);
    width: 700px;
    margin: 20px auto 10px auto !important;
    border-radius: 10px;
    padding: 10px 20px 20px 20px;
}
/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 350px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
      
<?php 
 foreach($priority as $pri)
 {
  $prikey[$pri->id] = $pri->priority;
 }
 ?>
<section class="section_support">
  <div class="container">
    <div class="row">
      <div class="col-md-3 leftarea-bar">
        <ul class="left-tabs">         
		  
		  <?php
             if($support_status_output)
             {
                 foreach($support_status_output as $supp_key=>$suppo)
                 {
            ?>
                <li><strong> <?php echo $support_count[$supp_key]; ?> </strong> <?php echo $suppo; ?> </li>
                <?php }  } ?>
		  
          <li class="addnewticke_tbtn"><a onclick="getOrderNumberView('<?php $user_id = $this->session->userdata('user_id'); echo $user_id; ?>');" data-toggle="modal" data-target="#addNewTicket" data-backdrop="static" data-keyboard="false">Add New Ticket</a></li>
        </ul>
      </div>
	  
      <div class="col-md-9 rigtarea-bar">
	  <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?>
	  <script>
	  setTimeout(function() {
    $('.alert-success').fadeOut('slow');
}, 2000); 
	  </script>
        <div class="filter_bar">
          <div class="filter_bar1 col-md-4">
              <select class="form-control">
                <option>Status</option>
                <option>Open</option>
                <option>In Progress</option>
                <option>Closed</option>
              </select>
            </div>
            <div class="filter_bar2 col-md-4">
              <select class="form-control">
                <option>Priority</option>
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
                <option>Urgent</option>
              </select>
            </div>
            <div class="filter_bar3 col-md-4">
              <select class="form-control">
                <option>Department</option>
                <option>Invoice</option>
                <option>Funding</option>
                <option>Order Process</option>
                <option>Support</option>
              </select>
            </div>
        </div><!-- filter_bar -->
        
		
		
		<?php
                  if($ticket){ 
                  foreach($ticket as $key=>$supp){
                      $replyData = $supp->reply_support_list;
                      ?>
					  
        <div class="ticket-div">
            <div class="priority-div">
                <div class="col-md-4 priority-img">
				<?php if($supp->priority_name=="High"){ ?>
                  <img src="<?php echo site_url();?>/assets/img/high-priority.png">
				<?php } elseif($supp->priority_name=="Urgent") { ?>
				  <img src="<?php echo site_url();?>/assets/img/u-priority.png">
				<?php } elseif($supp->priority_name=="Medium") { ?>
				  <img src="<?php echo site_url();?>/assets/img/medium-priority.png">
				<?php } else { ?>
				<img src="<?php echo site_url();?>/assets/img/low-priority.png">
				<?php } ?>
                </div>
                <div class="col-md-8">
                  <span class="col-md-6"><strong>ID:</strong> <?php echo $supp->support_ticket_number ?? $key+1; ?></span>
                  <span class="col-md-6"><strong>ORDER ID:</strong> <?php echo $supp->order_number; ?></span>
                </div>
            </div>
            <h1 class="tic-h1 col-md-12"><?php echo $supp->subject; ?></h1>
            <div class="row ticket-cols">
                <div class="col-md-3">
                  <img src="<?php echo site_url();?>/assets/img/department.png">
                  <h4>Department <span><?php echo $supp->department_name; ?></span></h4>
                </div>
                <div class="col-md-3">
                  <img src="<?php echo site_url();?>/assets/img/status1.png">
                  <h4>Status <span><?php echo $supp->status_name; ?></span></h4>
                </div>
                <div class="col-md-3">
                  <img src="<?php echo site_url();?>/assets/img/created1.png">
                  <h4>Created <span><?php echo date('m/d/Y',strtotime($supp->datetime)); ?> </span></h4>
                </div>
                <div class="col-md-3">
                  <img src="<?php echo site_url();?>/assets/img/cloud1.png">
                  <h4>Updated <span><?php if(!empty($supp->updated_date)){ echo date('m/d/Y',strtotime($supp->updated_date)); }else { echo date('m/d/Y',strtotime($supp->datetime));} ?></span></h4>
                </div>
            </div>
			<?php 
			   $lastreplyinfo = getlastreplysupport($supp->ticket_id); 			  
			?>
        
			<div class="ticket_popup_boxes row">
                <div class="col-md-2 t-boxes-lft">
                    <span><?php echo ucfirst('R'); ?></span>
                </div>
                <div class="col-md-10 t-boxes-ryt">
                    <h4><?php echo ucfirst('Last Message'); ?></h4>                    
                    <div class="t-para">
                      <p><?php echo ucfirst($lastreplyinfo->message); ?></p>
					  
			      <div class="attch-file col-md-3" style="float: right;">
                  
				   <?php $created = date('m/d/Y h:i:s A',strtotime($supp->datetime));  ?>
            <button type="button" class="btn btn-info btn-lg reply-btn-v" data-toggle="modal" data-target="#myModal"
			id="<?php echo $supp->support_ticket_number ?? $key+1; ?>" aria-hidden="true" data-ticketid="<?php echo $supp->ticket_id; ?>" data-subject="<?php echo $supp->subject; ?>" data-priority="<?php echo $supp->priority_name; ?>"data-status="<?php echo $supp->status_name; ?>" data-department="<?php echo $supp->department_name; ?>" data-fullname="<?php echo $supp->first_name.' '.$supp->last_name ?>" data-created="<?php echo $created ?>"
			data-backdrop="static" data-keyboard="false" onclick="getSupportView('<?php echo $supp->ticket_id;?>');">View All</button>
			  </div> 
			
                  </div>
                </div>
            </div>
			
						
			           
            <button type="button" onclick="openForm()" class="btn btn-info btn-lg reply-btn" data-toggle="modal" 
			id="<?php echo $supp->support_ticket_number ?? $key+1; ?>" aria-hidden="true" data-ticketid="<?php echo $supp->ticket_id; ?>" data-subject="<?php echo $supp->subject; ?>" data-priority="<?php echo $supp->priority_name; ?>"data-status="<?php echo $supp->status_name; ?>" data-department="<?php echo $supp->department_name; ?>" data-fullname="<?php echo $supp->first_name.' '.$supp->last_name ?>" data-created="<?php echo $created ?>"
			data-backdrop="static" data-keyboard="false" onclick="getSupportView('<?php echo $supp->ticket_id;?>');">Reply</button>
			
			<div class="form-popup" id="myForm">
			 <form name="addCMS" class="form-container" method="POST" action="<?php echo base_url('Tickets/replysave'); ?>"  enctype="multipart/form-data"> 
				<h3>Quick Reply</h3>
				<label for="email"><b>Message</b></label>				
				 <input type="hidden" name="parent_id" id="ticket_id">
				<input type="hidden" name="status" id="status">	
				<span class="tickethiddenidq"> </span>
				<textarea  class="form-control z-depth-1" id="description" rows="5"  name="description" placeholder="Your message..."  required="required"></textarea>   
				<br/>				
                <input type="file" name="image" id="image" class="form-control-file">
				<br/>
				<input class="btn btn-primary submit_btn" type="submit" value="Submit" />     
				<!-- <button type="submit" class="btn">Submit</button> -->
				<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
			  </form>
			</div>

			<script>
			function openForm() {
			  document.getElementById("myForm").style.display = "block";
			}

			function closeForm() {
			  document.getElementById("myForm").style.display = "none";
			}
			</script>			
			
        </div> <!-- ticket-div -->
		<?php } } ?>

			
      </div>
    </div>
  </div>
</section>


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
					<label for="name"> Order Number </label>					  
                      <select class="custom-select" name="ordernumber" id="ordernumber" required="required">
					  
                      <img id="loading-images" src="<?php echo  base_url(); ?>/assets/images/ajax-loader.gif" width="16" style="display:none;"/>
					  
                     </select>
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
                    <button class="btn btn-primary" type="submit">Submit</button>
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
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
      <div class="modal-content ticket_popup_body" id="support-view-reply">
       <img id="loading-image" src="<?php echo  base_url(); ?>/assets/images/ajax-loader.gif" width="16" style="display:none;"/>
	   
      </div>
	  
	  <!-- Submit Reply -->
	 <div class="modal-content ticket-btm" style="border:none; margin-top:-10px;">
	  <form name="addCMS" method="POST" action="<?php echo base_url('Tickets/replysave'); ?>"  enctype="multipart/form-data">
     <input type="hidden" name="parent_id" id="ticket_id">
    <input type="hidden" name="status" id="status">	
	<span class="tickethiddenid"> </span>
         
          <div class="form-group">            
            <textarea  class="form-control z-depth-1" id="description" rows="5"  name="description" placeholder="Your message..."  required="required"></textarea>
          </div>
          <div class="form-group">            
            <input type="file" name="image" id="image" class="form-control-file">
          </div>  
        		
        <div class="modal-footer">          
          <input class="btn btn-primary submit_btn" type="submit" value="Submit" />
		  <button class="btn btn-secondary btn-default close_btn" type="button" data-dismiss="modal">Close</button>
        </div>      
 </form> </div>
  <!-- End Submit Reply -->
  
    </div>	
  </div>
   

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script  src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script  src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<!-- <script  src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script> -->

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
  $(document).on('click', '.reply-btn-v', function() //Original
  //$(document).on('click', '.fa-replyxxxxxx', function() //Modified
  {
    var support_id = $(this).attr("id");
    // Function for support by Sanjeev on Date 12-2-20 
    var ticket_status = $(this).data("status");
	var ticket_ids = $(this).data("ticketid");
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
      //$(".modal-title").html(support_id); 
      // Function for support by Sanjeev on Date 12-2-20 
	  //$(".ticketss_ids").html("<b>Your original message for ticket ID #"+ticket_ids+"</b>");
	  //$(".messageTitle").html("#"+ticket_ids);	  
      //$(".ticket-info-status label").html(ticket_status);
      //$(".ticket-info-subject").html("<strong>Subject:</strong><span> "+ticket_subject+"</span>");
      //$(".priority_label").html(ticket_priority);
      //$(".department_label").html(ticket_department);
      //$(".ticket-message-customer-name").html(ticket_customer);
      //$(".ticket-description").html(ticket_description);
      //$(".ticket-message-message-time").html("Created on: "+ticket_created);
	  $(".tickethiddenid").html('<input type="hidden" id="ticket_id" name="ticket_id" value="'+ticket_ids+'">');
	  
    }
  });
});

</script>
<script>
$(document).ready(function() {
  $(document).on('click', '.reply-btn', function() //Original
    {
    var support_id = $(this).attr("id");
    // Function for support by Sanjeev on Date 12-2-20 
    var ticket_status = $(this).data("status");
	var ticket_ids = $(this).data("ticketid");
    var ticket_subject = $(this).data("subject");
    var ticket_priority = $(this).data("priority");
    var ticket_department = $(this).data("department");
    var ticket_customer = $(this).data("fullname");
    var ticket_description = $(this).parent().next("p").data("description");
    var ticket_created = $(this).data("created");
	
    // console.log(ticket_description);
    if (support_id != '')    {
      
	  $(".tickethiddenidq").html('<input type="hidden" id="ticket_id" name="ticket_id" value="'+ticket_ids+'">');
	  
    }
  });
});

</script>

<script>
    function getSupportView(ticket_id){    
          
          $.ajax({
            type:'POST',
            url:'<?php echo base_url('Tickets/replysupport')?>',
            data:{ticketId:ticket_id},
            beforeSend: function () {
				 $("#loading-image").show();
              $('.ticket_popup_box').css('opacity', '.2');			  
            },
			complete: function(){
     $('#loading-image').hide();
  },
            success:function(response){			
              $('#support-view-reply').html(response);
            }
          });
      }
	  
	  function getOrderNumberView(user_id){    
          
          $.ajax({
            type:'POST',
            url:'<?php echo base_url('Tickets/replyorderssupport')?>',
            data:{userId:user_id},
			beforeSend: function () {
							 $("#loading-images").show();              
						},
						complete: function(){
				 $('#loading-images').hide();
			  },            
            success:function(response){			
              $('#ordernumber').html(response);
            }
          });
      }
  </script>
