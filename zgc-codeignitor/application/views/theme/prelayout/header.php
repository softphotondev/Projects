<?php
$brokerInfo=[];
if(!empty($_SESSION['broker_id'])){
	$brokerInfo = getBrokerInfoByBrokerId($_SESSION['broker_id']);
}
?>

<!doctype html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>GET YOUR CREDIT REPAIR<?php //echo sitename(); ?></title>
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
<style>
.headerTop {
    display: flex;
    justify-content: center;
    float: right;
    align-items: center;
    font-size: 14px;
    margin-top: 5px;
}
.callus, .emailicons, .socialMediaicons, .identityiqlogo {
    margin: 15px 15px 0px 15px;
}
.callus, .emailicons {
    position: relative;
    padding-left: 46px;
}
.headerTop a {
    color: #151b30;
    font-weight: 400;
}
.callus span, .emailicons span {
color:#2b489e;
font-size: 16px;
line-height: 20px !important;
}
</style>
</head>
<body>
<header id="mainHeader" class="header">
  <?php $catrgorydrop = getallcategory();?>
  <div class="container"> 
  <?php 
  $sitelog=site_url().'assets/images/logo.jpg';
  $homemenu='<li><a href="'.base_url().'"> Home </a></li>';
  if(!empty($brokerInfo)){
	  $sitelog=$brokerInfo->sitelogo;
	   $homemenu='';
  }else if($this->session->userdata('user_type')==4 || $this->session->userdata('user_type')==5){
	   $homemenu='';
  }
  ?>
 <a href="<?php echo base_url();?>"> <img class="logo" src="<?php echo $sitelog; ?>" width="230" height="60" /> </a>
	
    <div class="headerMid">
	<?php  if(!empty($brokerInfo)){?>
	<div class="headerTop"> 
		<div class="callus">
		<div class="Icons"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
		<div class="icons-content">
		<a href="Tel: <?php echo $brokerInfo->sitephone;?>">
		<span>Call Us<br></span><?php echo $brokerInfo->sitephone;?> </a></div>	
		</div>
		<div class="emailicons">
		<div class="Icons"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
		<div class="icons-content">
		<a href="mailTo:<?php echo $brokerInfo->siteemail;?>">
		<span> Email Us <br></span> <?php echo $brokerInfo->siteemail;?> </a>
		</div>
		</div>
	</div>
	<?php } ?>
	
	<?php $logins= ['login','register'];?> 
      <div class="header-rightdetails">
        <div class="headerAccountD"> 
          <p class="accountDetails"> 
            <?php
				$loggedInName='Account';
				$myaccount='login';
				if($this->session->userdata('user_id')){
					$loggedInName=$this->session->userdata('first_name');
					if($this->session->userdata('user_type')==1){
						 $myaccount='myaccount';
					}else{
						$myaccount='order/myaccount';
					}
				}
            ?>
			<a  href="<?php echo base_url($myaccount); ?>">Hello <span> <br><?php echo $loggedInName; ?></span></a>
          </p>
		   
        </div>
        <!--<div class="headerCartdetails"> <a href="<?php //echo site_url('cart/');?>"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> <span class="headerCartdetails-count"> <?php //echo getTotalItem();?> </span> </a> </div>-->
        <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar"></i></div>
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
						$loggedInName='Account';
						$myaccount='login';
						if($this->session->userdata('user_id')){
							$loggedInName=$this->session->userdata('first_name');
							if($this->session->userdata('user_type')==1){
								 $myaccount='myaccount';
							}else{
								$myaccount='order/myaccount';
							}
						}
						?>
				<a  href="<?php echo base_url($myaccount); ?>"> My <span><?php echo $loggedInName; ?></span></a>		
				</li>
	  
			  <!-- Home Menu -->
			  <?php echo $homemenu; ?>
			  
			  <li><a href="<?php echo site_url('aboutus');?>"> About Us </a></li>
			  <li class="shop-menu"><a href="<?php echo base_url('services/'); ?>"> SERVICES </a>
				  <?php if(!in_array($this->router->fetch_method(),$logins)){ ?>
					<ul>
						<li> <a href="<?php echo base_url('services/');?>" > ALL SERVICES </a></li>
						<?php foreach($catrgorydrop as $cate) { ?> 
							<li> <a href="<?php echo base_url('services/'.$cate->slug_url); ?>" > <?php echo $cate->category_name; ?> </a></li>
						<?php } ?>
					</ul>
				<?php } ?>
			  </li>
			  <li><a href="<?php echo site_url('frequently-asked-questions');?>"> Faq's </a></li>
			  <?php /*?><li><a href="<?php echo site_url('becomebroker');?>"> BECOME BROKER </a></li>
			  <li class="m-blog-link"><a href="<?php echo site_url('becomebroker');?>"> BECOME BROKER </a></li> 
			  <li class="m-blog-link"><a href="#"> Blog </a></li><?php */ ?>
			 <!-- <li class="m-schedule-call"><a href="#"> Schedule call </a></li>-->
             <!-- <li><a href="<?php //echo site_url('contactus');?>">Contact us </a></li> -->
			  
              <?php foreach($menu as $menu=>$me){?>
					  <li><a href="<?php echo $me; ?>" class="getfree"><?php echo $menu; ?> </a></li>
					<?php
				  }
					if($this->session->userdata('id')){?>
						<li class="getfree login-menu" style="background:darkorange;"><a href="<?php echo site_url('support');?>">Support Ticket </a></li>
						<li class="getfree login-menu myaccount"><a href="<?php echo base_url($myaccount); ?>">MyAccount</a></li>
						<?php if($this->session->userdata('is_login_from_admin')==1){?>
						<li class="getfree login-menu"><a href="<?php echo base_url('users/clientlogout');?>">logout</a></li>
						<?php }else{ ?>
						<li class="getfree login-menu"><a href="<?php echo base_url('logout'); ?>">logout</a></li>
						<?php } ?>
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
