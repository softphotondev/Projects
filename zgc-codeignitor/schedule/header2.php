<?php $companyname = $obj_settings->get_option("rzvy_company_name"); ?>
<?php /*?>
<header class="rzvy-header-style">
	<div class="row">
		<div class="col-md-5 pl-5"><?php if(!isset($_GET['if'])){ ?><?php if($obj_settings->get_option("rzvy_company_logo") != "" && file_exists("uploads/images/".$obj_settings->get_option("rzvy_company_logo"))){ ?><img class="rzvy-companylogo" src="<?php echo SITE_URL; ?>uploads/images/<?php echo $obj_settings->get_option("rzvy_company_logo"); ?>" /> <?php }else{ ?><b class="rzvy-companytitle"><?php echo $obj_settings->get_option("rzvy_company_name"); ?></b><?php } ?><?php } ?></div>
		<div class="col-md-7">
			<a href="<?php echo SITE_URL; ?>backend/my-appointments.php<?php echo $saiframe; ?>" class="btn btn-link pull-right"><?php if(isset($rzvy_translangArr['my_appointments'])){ echo $rzvy_translangArr['my_appointments']; }else{ echo $rzvy_defaultlang['my_appointments']; } ?></a>
			<?php if($rzvy_location_selector_status == "Y"){ ?> <a data-toggle="modal" data-target="#rzvy-location-selector-modal" href="javascript:void(0)" class="btn btn-link pull-right"><?php if(isset($rzvy_translangArr['book_at_another_location'])){ echo $rzvy_translangArr['book_at_another_location']; }else{ echo $rzvy_defaultlang['book_at_another_location']; } ?></a><?php } ?>
		</div>
	</div>
	<?php 		
	if($lang_j>1){ 
		?>
		<div class="row py-1">
			<div class="col-md-12">
				<div class="pull-right">
					<label for="rzvy_set_language" class="fa fa-fw fa-language"></label> 
					<select class="rzvy_set_language">
						<?php echo $langOptions; ?>
					</select>
				</div>
			</div>
		</div>
		<?php 
	}  
	?>
</header>
<?php */ ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Link Swiper's CSS -->

<link rel="stylesheet" href="https://beta.focusfico.com/assets/home/css/style.css">
<link rel="stylesheet" href="https://beta.focusfico.com/assets/home/css/vertical-menu.css">
<link rel="stylesheet" href="https://beta.focusfico.com/assets/home/css/responsive.css">
<link rel="stylesheet" href="https://beta.focusfico.com/assets/home/css/custom.css">
<link rel="stylesheet" type="text/css" href="https://beta.focusfico.com/assets/css/style.css">
<header id="mainHeader" class="header">
  <div class="customeHeader-top">
    <div class="container">
      <ul class="headerTop-menu">
        <li> WELCOME TO OUR STORE! </li>
        <li> <a href="#"> <i class="fa fa-files-o" aria-hidden="true"></i> Faq's </a> </li>
        <li> <a href="#"> <i class="fa fa-folder-open-o" aria-hidden="true"></i> Blog </a> </li>
      </ul>
    </div>
  </div>
  <div class="container"> <a href="https://beta.focusfico.com/"><img src="https://beta.focusfico.com/uploads/logo/5df2e69971891_ZGCRED.png" alt="" class="logo"></a>
    <div class="headerMid">

      <div class="header-rightdetails">
        <div class="headerAccountD"> 


           </div>
       <!-- <div class="headerWishcart"> <a href="#"> <i class="fa fa-heart-o" aria-hidden="true"></i> <span class="wishcart-count"> 0 </span> </a> </div>-->
        <div class="headerCartdetails"> <a href="https://beta.focusfico.com/cart/"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> <span class="headerCartdetails-count"> <?php //echo getTotalItem();?> </span> </a> </div>
        <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar"></i></div>
      </div>
    
	<div class="iqlogo"> <img src="https://beta.focusfico.com/assets/images/indentityiq-logo.jpg"> </div>
	
	</div>
  </div>
  <div class="headerMenu-group">
    <div class="container">
      <div class="headerBotMenu">
        <?php
         //$menu = getheadermenu();
        ?>
        <!-- vertical menu start-->
        <div class="vertical-menu-main">
          <nav id="main-nav"> 
            <!-- Sample menu definition-->
            <ul class="sm pixelstrap" id="main-menu">
              <li>
                <div class="text-right mobile-back">Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
              </li>
              <li><a href="https://beta.focusfico.com/"> Home</a></li>
              <li><a href="https://beta.focusfico.com/becomebroker"> Become a Reseller </a></li>
              <li><a href="https://beta.focusfico.com/contactus">Contact us </a></li>
			  <li><a href="https://beta.focusfico.com/logout" class="getfree">logout</a></li>
			
            
            </ul>
          </nav>
        </div>
        <!-- vertical menu ends--> 
      </div>
    </div>
  </div>
</header>
