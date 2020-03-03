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
.btn-info.focus, .btn-info:focus{
    box-shadow: unset;
}
button.reply-btn:hover {
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
    margin-bottom: 40px;
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
</style>
<!-- <div class="col-lg-3">
<div class="card" style="background:none;">
<div class="myprofile-sidebar card-body">
<div class="userprofile"> -->
<div class="col-md-3 leftarea-bar">
    <!-- <div class="text-center blue-bg userPhoto"> -->
	<div class="status-admn">
        <img src="<?php echo getprofileimage($this->session->userdata('user_id')); ?>"  alt="Logo">
        <h2> <?php echo orderusersname($this->session->userdata('user_id')); ?> </h2>
        
       <?php if($this->session->userdata('user_type')==4){echo 'Referral Code: ' . getRefrenceNumber($this->session->userdata('user_id')); }?>
    </div>
<ul class="left-tabs">
    <?php $page =isset($page) ? $page :'';?>
    
    <!--<a class="active thumb-col" href="<?php //echo base_url('order/myaccount'); ?>"> 
        <div class="thumbImg"> <img src="<?php //echo site_url();?>/assets/home/images/personal-info-icon.png"></div>
        <p> Dashboard </p>
    </a>-->
    <li><a  href="<?php echo base_url('order/myaccount');?>"> 
         <img src="<?php echo site_url();?>/assets/images/order-icon.png">
         Orders  
    </a></li>
    <li><a  href="<?php echo base_url('myinformation'); ?>"> 
         <img src="<?php echo site_url();?>/assets/images/my-account.png">
         My Account Details 
    </a></li>
    <?php /* ?><a class="thumb-col <?php if($page=='myupload'){ echo 'active'; }?>" href="<?php echo base_url('myuploads'); ?>">
        <div class="thumbImg"> <img src="<?php echo site_url();?>/assets/images/my-upload-icon.png"></div>
        <p> My Uploads </p> 
    </a>
    <?php */ ?>
  
    
<?php if($this->session->userdata('user_type')==5){?>
    <li><a  href="<?php echo base_url('creditreport'); ?>"> 
         <img src="<?php echo site_url();?>/assets/images/credit-report-icon.png">
         Credit Report 
    </a></li>
   <!-- <a class="thumb-col <?php //if($page=='invoice'){ echo 'active'; }?>" href="<?php //echo base_url('invoices'); ?>"> 
        <div class="thumbImg"> <img src="<?php echo site_url();?>/assets/images/invoice-icon.png"></div>
        <p> Invoices </p> 
    </a>-->
 
 <?php
 }
 else if($this->session->userdata('user_type')==4)
 {
 ?>
    <li><a href="<?php echo base_url('clientlist'); ?>"> 
         <img src="<?php echo site_url();?>/assets/images/credit-report-icon.png">
         Client List 
    </a></li>
    <!--<li class="active"><a href="<?php //echo base_url('addclient'); ?>"> Add Client </a></li>-->
    <!--<li class="active"><a href="<?php //echo base_url('invoiceadmin'); ?>"> INVOICES DUE TO ADMIN  </a></li>
    <a class="thumb-col <?php //if($page=='invoice'){ echo 'active'; }?>" href="<?php //echo base_url('invoices'); ?>">
        <div class="thumbImg"> <img src="<?php //echo site_url();?>/assets/images/invoice-icon.png"></div>
        <p> Client Invoices </p>
    </a>-->
    <li><a  href="<?php echo base_url('setProductPrice'); ?>">
         <img src="<?php echo site_url();?>/assets/img/view-d.png">
         Set Pricing 
    </a></li>
    <li><a href="<?php echo base_url('sitesettings'); ?>">
         <img src="<?php echo site_url();?>/assets/images/my-account.png">
         Site Settings 
    </a></li>
    <li><a href="<?php echo base_url('paymentsettings'); ?>"> 
         <img src="<?php echo site_url();?>/assets/images/invoice-icon.png">
         Payment Settings 
    </a></li>
   <!--  <a class="thumb-col  <?php //if($page=='contact'){ echo 'active'; }?>" href="<?php //echo base_url('mycontact'); ?>"> 
        <div class="thumbImg"> <img src="<?php //echo site_url();?>/assets/home/images/personal-info-icon.png"></div>
        <p> Contact </p>
    </a>
   <a class="thumb-col  <?php //if($page=='mailaccess'){ echo 'active'; }?>" href="<?php //echo base_url('mailaccess'); ?>"> 
        <div class="thumbImg"> <img src="<?php //echo site_url();?>/assets/home/images/personal-info-icon.png"></div>
        <p> Mail Access </p>
    </a>-->
 <?php } else if($this->session->userdata('user_type')==3){?>
      <li><a  href="<?php echo base_url('funding'); ?>"> 
         <img src="<?php echo site_url();?>/assets/images/tracking-icon.png"> All Funding  
        </a></li>
      <li><a  href="<?php echo base_url('funding/getallnotes'); ?>"> 
         <img src="<?php echo site_url();?>/assets/images/tracking-icon.png"> All Funding Notes 
      </a></li>
 
 <?php } ?>
  <!--<a class="thumb-col  <?php if($page=='tracking'){ echo 'active'; }?>" href="<?php echo base_url('tracking'); ?>"> 
        <div class="thumbImg"> <img src="<?php echo site_url();?>/assets/images/tracking-icon.png"></div>
        <p> Tracking </p> 
    </a> --> 
    <li><a  href="<?php echo base_url('support'); ?>">
         <img src="<?php echo site_url();?>/assets/images/support-icon.png">
         Support 
    </a></li>
 <li class="logout-btn"><a href="<?php echo base_url('site/logout'); ?>">  <img src="<?php echo site_url();?>/assets/images/logout-icon.png">
 Logout </a></li>
</ul>

</div>
<!-- </div>
</div>
</div> -->