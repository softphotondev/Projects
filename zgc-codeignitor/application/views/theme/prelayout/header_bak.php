<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?php echo sitename(); ?></title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo ASSETSPATH; ?>home/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

<!-- Link Swiper's CSS -->
	
<link rel="stylesheet" href="<?php echo base_url('assets/home/css/style.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/home/css/vertical-menu.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/home/css/responsive.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/home/css/custom.css'); ?>">

<link rel="stylesheet" type="text/css" href="<?php echo ASSETSPATH; ?>css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETSPATH; ?>css/owlcarousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETSPATH; ?>css/rating.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETSPATH; ?>css/date-picker.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETSPATH; ?>css/dropzone.css">
<link rel="stylesheet" type="text/css" href="<?php echo ASSETSPATH; ?>home/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?php echo ASSETSPATH; ?>css/swiper.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<header id="mainHeader" class="header">
  <div class="customeHeader-top">
    <div class="container">
      <ul class="headerTop-menu">
        <li> WELCOME TO OUR STORE! </li>
        <li> <a href="<?php echo site_url('frequently-asked-questions');?>"> <i class="fa fa-files-o" aria-hidden="true"></i> Faq's </a> </li>
        <li> <a href="#"> <i class="fa fa-folder-open-o" aria-hidden="true"></i> Blog </a> </li>
        <li> <a href="<?php echo site_url('schedule/')?>" target="_blank"> <i class="fa fa-phone-square" aria-hidden="true"></i> Schedule call </a> </li>
      </ul>
    </div>
  </div>
  <?php
 $catrgorydrop = getallcategory();
  ?>
  <div class="container"> <a href="<?php echo site_url();?>">
  <img src="https://beta.focusfico.com/uploads/logo/5df2e69971891_ZGCRED.png" alt="" class="logo"></a>
    <div class="headerMid">
      <div class="searchBox">
        <?php
			 $logins= ['login','register'];
			 
			 /*if(!in_array($this->router->fetch_method(),$logins))
			 {?>
				<div class="input-group search-group">
					<input type="text" class="form-control search-input" id="search_category" name="search_category" placeholder="Search for products...">
					<input type="hidden" name="search_category_value" id="search_category_value">
					<span class="input-group-btn"><button class="btn-search" type="submit" onclick="return searchfield();"> <i class="fa fa-search" aria-hidden="true"></i> </button></span> 
				</div>
			<?php } */ ?> 
      </div>

      <div class="header-rightdetails">
        <div class="headerAccountD"> 
          <p class="accountDetails"> 
            <?php
            if($this->session->userdata('user_id'))
            {
				if($this->session->userdata('user_type')==1){
					 $myaccount='myaccount';
				}else{
                    $myaccount='order/myaccount';
                }
              ?>
            <a  href="<?php echo base_url($myaccount); ?>">Hello<span> <br><?php echo $this->session->userdata('first_name'); ?> </span> </a>
			<?php
            }
            else
            {
              ?>
       <a  href="<?php echo base_url('login'); ?>">Hello <span> <br>Account</span></a>
              <?php
            }
            ?>
          </p>

           </div>
        <div class="headerCartdetails"> <a href="<?php echo site_url('cart/');?>"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> <span class="headerCartdetails-count"> <?php echo getTotalItem();?> </span> </a> </div>
        <div class="vertical-mobile-sidebar">
		<i class="fa fa-bars sidebar-bar"></i></div>
      </div>
    
	<div class="iqlogo">  <a href="https://www.identityiq.com/sc-securemax.aspx?offercode=4311381F" target="_blank"><img src="<?php echo site_url();?>assets/images/indentityiq-logo.jpg"></a> </div>
	
	</div>
  </div>
  
  
  <div class="headerMenu-group">
    <div class="container">
      <div class="headerBotMenu">
        <?php
         $menu = getheadermenu();
        ?>
        <!-- vertical menu start-->
        <div class="vertical-menu-main">
          <nav id="main-nav"> 
		  
            <!-- Sample menu definition-->
            <ul class="sm pixelstrap" id="main-menu">
              <li>
                <div class="text-right mobile-back">Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
              </li>
			<li class="m-account">
			<?php
				if($this->session->userdata('user_id')){
					if($this->session->userdata('user_type')==5 || $this->session->userdata('user_type')==4){
						$myaccount='order/myaccount';
					}
					else{
					  $myaccount='myaccount';
					}
				?>
				<a  href="<?php echo base_url($myaccount); ?>">Hello  <span> 
				<?php echo $this->session->userdata('first_name'); ?> </span> </a>
				<?php }
            else
            {
              ?>
		<a  href="<?php echo base_url('login'); ?>">Hello <span> Account</span></a><?php } ?>
	</li>
  
			  <li><a href="<?php echo base_url(); ?>"> Home </a>
			  
			  </li>
			  <li><a href="<?php echo site_url('aboutus');?>"> About Us </a></li>
			  
              <!--<li><a href="<?php //echo site_url('becomebroker');?>"> Become a Reseller </a></li>-->
			  <li><a href="<?php echo site_url('frequently-asked-questions');?>"> Faq's </a></li>
			  <li class="m-blog-link"><a href="#"> Blog </a></li>
			  <li class="m-schedule-call"><a href="#"> Schedule call </a></li>
              <li><a href="<?php echo site_url('contactus');?>">Contact us </a></li>
			  
			<li class="shop-menu"><a href="<?php echo base_url('category/'); ?>"> SERVICES </a>
			  <?php if(!in_array($this->router->fetch_method(),$logins)){ ?>
			  <ul>
				 <?php foreach($catrgorydrop as $cate) { ?> 
				 <li> <a href="<?php echo base_url('category/'.$cate->slug_url); ?>" > <?php echo $cate->category_name; ?> </a></li>
			  <?php } ?>
			  </ul>
           <?php } ?>
		   	</li>

              <?php 
              foreach($menu as $menu=>$me)
              {
                ?>
                  <li><a href="<?php echo $me; ?>" class="getfree"><?php echo $menu; ?> </a></li>
                <?php
              }
              ?>
            <?php
            if($this->session->userdata('id'))
            {
              ?>
			   <li><a href="<?php echo base_url('support'); ?>">Support Ticket</a></li>
			   <li class="getfree login-menu myaccount"><a href="<?php echo base_url($myaccount); ?>">MyAccount</a></li>
              <li class="getfree login-menu"><a href="<?php echo base_url('logout'); ?>" class="getfree login-menu">logout</a></li>
            <?php } else { ?>
			  <li class="getfree login-menu"><a href="<?php echo base_url('register'); ?>" class="getfree register-menu">Register</a></li>
			  <li class="getfree login-menu"><a href="<?php echo base_url('login'); ?>">login</a></li>
            <?php } ?>
			
            </ul>
          </nav>
        </div>
        <!-- vertical menu ends--> 
      </div>
    </div>
  </div>
</header>

<style>
  .error {
  margin: 0px !important;
  color: red !important; }
  .fade:not(.show)
  {
    opacity: 1;
  }
  .astrisk{
	  color:red;
  }
</style>
