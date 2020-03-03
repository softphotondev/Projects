<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Creative admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo sitepurelogo(); ?>" type="image/x-icon">
    <title><?php echo sitename(); ?></title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/feather-icon.css">
    <!-- Plugins css start-->
	<link rel="stylesheet" href="<?php echo base_url('assets/home/css/custom.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/chartist.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/prism.css">
	<link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/vector-map.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?php echo  base_url(); ?>assets/css/light-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/responsive.css">
	<link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/print.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/rating.css">
  <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/datatables.css">
 <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/page-builder.css">
 <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/select2.css">
  <link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>assets/css/photoswipe.css">
<script src="<?php echo  base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo  base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?php echo  base_url(); ?>assets/js/bootstrap/bootstrap.min.js"></script>
  
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="loader loader-7">
        <div class="line line1"></div>
        <div class="line line2"></div>
        <div class="line line3"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper vertical">
	<header class="headerTop">
      <!-- Page Header Start-->
      <div class="page-main-header">
	  <div class="container">
        <div class="main-header-right row">
          <div class="main-header-left d-lg-none">
            <div class="logo-wrapper "><a href="<?php echo base_url();?>"><img src="<?php echo sitepurelogo(); ?>" alt="" class="logo" style="height:70px;"></a></div>
          </div>
          <div class="mobile-sidebar d-none">
            <div class="media-body text-right switch-sm">
              <label class="switch">
                <input id="sidebar-toggle" type="checkbox" checked="checked"><span class="switch-state"></span>
              </label>
            </div>
          </div>
          <div class="nav-right col pull-right right-menu">
		  <div class="headerMid">
      <div class="header-rightdetails">
        <div class="headerAccountD"> 
          <p class="accountDetails"><a href="https://beta.focusfico.com/myaccount">Hello <span> <br>admin</span></a>
          </p>
        </div>
        <div class="headerCartdetails"> <a href="https://beta.focusfico.com/cart/"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> <span class="headerCartdetails-count"> 0 </span> </a> </div>
        <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar"></i></div>
      </div>
	<div class="iqlogo">  <a href="https://www.identityiq.com/sc-securemax.aspx?offercode=4311381F" target="_blank"><img src="https://beta.focusfico.com/assets/images/indentityiq-logo.jpg"></a> </div>
	<div class="notification dropdown">
	<?php 
	$ticketnoti = getTotalTicketsNoti();
	$tasknoti = getTotalTasksNotifi();
	$ticketsnotifi = getTicketsNotifi();
	$tasksnotifi = getTasksNotifi();
	?>
    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><i data-feather="bell"></i><span class="notification badge badge-pill badge-danger f-10"><?php echo $totnot = $ticketnoti + $tasknoti; ?></span></button>
                  <div class="dropdown-menu p-0">
                    <ul class="notification-dropdown">
                      <li class="gradient-primary">
                        <h6>Notifications</h6><span>You have total <?php echo $ticketnoti; ?> Tickets and <?php echo $tasknoti; ?> Tasks</span>
                      </li>
					  
					  <?php
				   if($ticketsnotifi)
				   {
					 foreach ($ticketsnotifi as $key => $value) 
					 {
					  if($ticketsnotifi[$key]>0)
					  {
					  ?>
						<li>
                        <div class="media">
                          <div class="notification-icons bg-success mr-3"><i class="mt-0" data-feather="message-circle"></i></div>
                          <div class="media-body">
                            <h6><a href="<?php echo  base_url(); ?>ticket"><?php echo $value->subject; ?></a></h6>
                            <p class="mb-0"> <?php echo $value->datetime; ?></p>
                          </div>
                        </div>
                      </li>
					 <?php 
					  }
					 }
				   }
				?>
				 <?php
				   if($tasksnotifi)
				   {
					 foreach ($tasksnotifi as $key => $value) 
					 {
					  if($tasksnotifi[$key]>0)
					  {
					  ?>
						<li class="pt-0">
                        <div class="media">
                          <div class="notification-icons bg-info mr-3"><i class="mt-0" data-feather="message-square"></i></div>
                          <div class="media-body">
                            <h6><a href="#"><?php echo $value->task_subject; ?></a></h6>
                            <p class="mb-0"><?php echo $value->last_update_date; ?></p>
                          </div>
                        </div>
                      </li>
					 <?php 
					  }
					 }
				   }
				?>
               
                      <li class="bg-light txt-dark">Notification are Like:  
					  <i class="mt-0" data-feather="message-square"></i> Tasks
					  <i class="mt-0" data-feather="message-circle"></i> Tickets
					  </li>
                    </ul>
                  </div>
                </div>
	
	</div>

			
			
        <!-- <ul class="nav-menus">
            <li><a class="btn btn-primary btn-air-primary" href="<?php echo base_url('') ?>">Go To Main Site</a></li>
              <li><a class="btn btn-danger btn-air-danger" href="<?php echo base_url('site/logout') ?>">Logout</a></li>
            </ul> -->
		
          </div>
        </div>
     </div>
	 </div>
      <!-- Page Header Ends-->
	  <div class="container">
	 <!-- vertical menu start-->
	<div class="vertical-menu-main customMenu">
    <nav id="main-nav">
        <!-- Sample menu definition-->
        <ul class="sm pixelstrap backendMenu" id="main-menu">
            <li>
                <div class="text-right mobile-back">Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
            </li>
            <li><a href="<?php echo base_url('myaccount'); ?>">Dashboard </a></li>
            <li><a href="javascript:void(0)">USERS</a>
            <ul>
                <!--<li><a href="<?php echo base_url('addusertype'); ?>">Add User Type</a></li>-->
                <li><a href="<?php echo base_url('getusertypelist'); ?>">User TypeList</a></li>
                <!--<li><a href="<?php echo base_url('adduser'); ?>">Add Users</a></li>-->
                <li><a href="<?php echo base_url('getuserlist'); ?>">All Users List</a></li>
                <li><a href="<?php echo base_url('getuserlist/4'); ?>">All Broker List</a></li>
                <li><a href="<?php echo base_url('getuserlist/5'); ?>">All Clients List</a></li>
            </ul>
            </li>
            <li><a href="#">Products</a>
                <ul>
                    <li><a href="<?php echo base_url('getcategory'); ?>">Category List</a></li>
                    <li><a href="<?php echo base_url('addcategory'); ?>">Add Category</a></li>
                    <li><a href="<?php echo base_url('productlist'); ?>">All Products</a></li>
                    <li><a href="<?php echo base_url('addproduct'); ?>">Add Product</a></li>
                     <li><a href="<?php echo base_url('product/membershiptlist'); ?>">Membership Plan</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Order</a>
                <ul><li><a href="<?php echo base_url('getorders'); ?>">All Orders List</a></li></ul>
            </li>
            <li><a href="javascript:void(0);">Invoice</a>
                <ul>
                    <li><a href="<?php echo base_url('brokerinvoice'); ?>">All Broker Invoice</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Page</a>
                <ul>
                    <li><a href="<?php echo base_url('getpages'); ?>">All Pages</a></li>
                    <li><a href="<?php echo base_url('getmenus'); ?>">All Navigation</a></li>
                    <li><a href="<?php echo base_url('faq'); ?>">FAQ</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);">Setting</a>
                <ul>
                    <li><a href="<?php echo base_url('lettertemplates'); ?>">Letter Template</a></li>
                    <li><a href="<?php echo base_url('marketemail'); ?>">Marketing Templates</a></li>
                    <li><a href="<?php echo base_url('smstemplates'); ?>">SMS Templates</a></li>
                    <li><a href="<?php echo base_url('banklist'); ?>">Bank List</a></li>
                    <li><a href="<?php echo base_url('creditlist'); ?>">Credit List</a></li>
                    <li><a href="<?php echo base_url('callstatuslist'); ?>">Call Status List</a></li>
                    <li><a href="<?php echo base_url('emailtemplates'); ?>">Email Template</a></li>
                    <li><a href="<?php echo base_url('setting/rolePermission'); ?>">Roles & Permissions</a></li>
                    <li><a href="<?php echo base_url('sitesettings'); ?>">Site settings</a></li>
                    <li><a href="<?php echo base_url('manageblock'); ?>">Manage Block</a></li>
                    <li><a href="<?php echo base_url('statusmanage'); ?>">Status Management</a></li>
                    <li><a href="<?php echo base_url('servicemanage'); ?>">Service Management</a></li>
                    <li><a href="<?php echo base_url('providermanage'); ?>">Provider Management</a></li>
                    <li><a href="<?php echo base_url('appoinmentshow'); ?>">Appointment Management</a></li>
                    <li><a href="<?php echo base_url('departmentshow'); ?>">Department Management</a></li>
                    <li><a href="<?php echo base_url('fundingstatus'); ?>">Funding status</a></li>
                    <li><a href="<?php echo base_url('brokercontract'); ?>">Broker Contract(%)</a></li>
                    <li><a href="<?php echo base_url('smssubject'); ?>">Subject Management</a></li>
                    <li><a href="<?php echo base_url('manageques'); ?>">question Management</a></li>
                    <li><a href="<?php echo base_url('sitemanagement'); ?>">Sites Management</a></li>
                    <li><a href="<?php echo base_url('reasonmanage'); ?>">Reason Management</a></li>
                    <li><a href="<?php echo base_url('instructmanage'); ?>">Instruction Management</a></li>
                     <li><a href="<?php echo base_url('paymentmethod'); ?>">Payment Settings</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url('ticket'); ?>">Support Ticket</a></li>
            <li><a href="<?php echo base_url('chat'); ?>">Chat</a></li>
			<li class="getfree login-menu"><a href="<?php echo base_url('site/logout') ?>">Logout</a></li>
        </ul>
    </nav>
</div>
	   <!-- Page Body Start-->
  </div>
    </header> 

	 <div class="page-body-wrapper">
    
