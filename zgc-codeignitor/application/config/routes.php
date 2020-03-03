<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['uploads/(:any)'] = "Validation/index/$1";

$route['default_controller'] = 'Site/index';
$route['login'] 			= 'Site/login';
$route['logout'] 			= 'Site/logout';
$route['register'] 			= 'Site/register';
$route['becomebroker'] 		= 'Site/becomeBroker';
$route['home'] 				= 'Site/index';
$route['contactus'] 		= 'Site/contact';
//$route['terms'] 			= 'Site/terms';
//$route['policy'] 			= 'Site/policy';
//$route['refund'] 			= 'Site/refund';
//$route['about-us'] 			= 'Site/about';
$route['dashboard'] 		= 'Admin/index';
$route['myaccount'] 		= 'Admin/myaccount';
$route['frequently-asked-questions'] = 'Site/faq';
/******User List *******/

$route['getclientlist'] 	= 'User/getclientlist';
$route['getbrokerlist'] 	= 'User/getbrokerlist';

/******Category and Product List *******/
$route['getcategory'] 		= 'Product/categorylist';
$route['addcategory'] 		= 'Product/addcategory';
$route['getproductlist'] 	= 'Product/index';
$route['getblock/(:any)'] 	= 'Product/getblock';


$route['copycategory/(:any)'] = 'Product/copycategory/$1';

$route['productlist'] 	= 'Product/productlist';


$route['addproduct'] 		= 'Product/addproduct';
$route['createaccount'] 	= 'Site/createaccount';
$route['resetpassword'] 	= 'Site/resetpassword';


/*********** User type and user list*******/
$route['addusertype'] 	= 'Users/addusertype';
$route['addusertype/(:any)'] = 'Users/addusertype/$1';
$route['getusertypelist'] 	= 'Users/getusertypelist';


$route['getuserlist'] 	= 'Users/getuserlist';

$route['getuserlist/(:any)'] 	= 'Users/getuserlist/$1';


$route['brokerlist'] 	= 'Users/brokerlist';

$route['adduser'] 	= 'Users/adduser';
$route['adduser/(:any)'] 	= 'Users/adduser/$1';
$route['copyuser/(:any)'] 	= 'Users/copyuser/$1';

$route['copyusertype/(:any)'] 	= 'Users/copyusertype/$1';

/*******Shop by Category ******/
$route['getproduct/(:any)'] = 'Cart/getproductlistByCategory/$1';
$route['services'] 			= 'Cart/getproductCategory';
$route['services/(:any)'] 	= 'Cart/getproductCategory/$1';
$route['categorysearch/(:any)'] = 'Cart/getCategorysearch/$1';
$route['cart'] 				= 'Cart/index';
$route['checkout'] 			= 'Cart/checkout';
$route['placeorder'] 		= 'Cart/placeorder';
$route['completecheckout/(:any)'] = 'Cart/completeCheckout/$1';
$route['getpayment/(:any)'] = 'Cart/payment/$1';

/*******CMS Pages ******/
$route['getpages'] 		= 'Pages/getpages';
$route['addpages'] 		= 'Pages/addpages';
$route['addpages/(:any)'] 	= 'Pages/addpages/$1';
$route['page/(:any)'] 	= 'Pages/index/$1';

/****Navigation Menu *****/
$route['getmenus'] 		= 'Pages/getmenus';
$route['addmenu'] 		= 'Pages/addmenu';
$route['addmenu/(:any)'] 		= 'Pages/addmenu/$1';

$route['copymenu/(:any)'] 		= 'Pages/copymenu/$1';

$route['productdetail'] = 'Cart/productDetail';
$route['productdetail/(:any)'] = 'Cart/productDetail/$1';


/****Settings*****/
//$route['sitesettings'] = 'Setting/sitesettings';

$route['emailtemplates'] = 'Setting/emailtemplates';

$route['copyemail/(:any)'] = 'Setting/copyemail/$1';

$route['editemail/(:any)'] = 'Setting/editemail/$1';

/************************/
$route['getorders'] = 'Projects/index';

$route['projectoverview'] = 'Projects/projectoverview';


/****FAQ*****/
$route['faq'] = 'Faq/index';
$route['manageques'] = 'Faq/manageques';
$route['addquestype'] = 'Faq/addquestype';
$route['editfaqques/(:any)'] = 'Faq/editfaqques/$1';
$route['addfaq'] = 'Faq/addfaq';
$route['editfaq/(:any)'] = 'Faq/editfaq/$1';
$route['faq'] = 'Faq/index';

/******Manage Block ******/
$route['manageblock'] 		= 'Setting/blocklist';
$route['addblock'] 			= 'Setting/addblock';
$route['editblock/(:any)'] 	= 'Setting/addblock/$1';
$route['saveblock'] 		= 'Setting/saveBlock';
$route['saveCustomfield'] 	= 'Setting/saveCustomfield';
$route['blockView/(:any)'] 	= 'Setting/blockView/$1';


/******Manage Order Status ******/
$route['orderstatus'] 		= 'Order/orderstatus';
$route['addorderstatus'] 	= 'Order/addorderstatus';
$route['addorderstatus/(:any)'] 	= 'Order/addorderstatus/$1';
$route['copyorderstatus/(:any)'] 	= 'Order/copyorderstatus/$1';

$route['ticket'] 	= 'Tickets/index';

$route['appointment'] 	= 'Site/appointment';



/*****Status management***/
$route['statusmanage'] 	= 'Status/statusmanage';
$route['addstatus'] 	= 'Status/addstatus';
$route['addstatus/(:any)'] 	= 'Status/addstatus/$1';
$route['copystatus/(:any)'] 	= 'Status/copystatus/$1';


/*****Department management***/
$route['departmentshow'] 	= 'Tickets/departmentshow';
$route['adddepart'] 	= 'Tickets/adddepart';
$route['editdepart/(:any)'] 	= 'Tickets/editdepart/$1';
$route['deletedepart/(:any)'] 	= 'Tickets/deletedepart/$1';


/*****Service management***/
$route['servicemanage'] 	= 'Service/servicemanage';
$route['addservice'] 	= 'Service/addservice';
$route['addservice/(:any)'] 	= 'Service/addservice/$1';
$route['copyservice/(:any)'] 	= 'Service/copyservice/$1';



$route['providermanage'] 	= 'Service/providermanage';
$route['addprovider'] 	= 'Service/addprovider';
$route['addprovider/(:any)'] 	= 'Service/addprovider/$1';
$route['copyprovider/(:any)'] 	= 'Service/copyprovider/$1';



$route['appoinmentshow'] 	= 'Status/appoinmentshow';


/*****My account starts here***/
$route['dashboard'] 	= 'Myaccount/dashboard';
$route['myinformation'] 	= 'Myaccount/myinformation';
$route['myuploads'] 	= 'Myaccount/myuploads';
$route['documents'] 	= 'Myaccount/documents';
$route['creditreport'] 	= 'Myaccount/creditreport';
$route['invoices'] 	= 'Myaccount/invoices';
$route['tracking'] 	= 'Myaccount/tracking';
$route['support'] 	= 'Myaccount/support';

$route['changepassword'] 	= 'Myaccount/changepassword';

$route['clientlist'] 	= 'Myaccount/clientlist';
$route['addclient'] 	= 'Myaccount/addclient';

$route['addclient/(:any)'] 	= 'Myaccount/addclient/$1';

$route['invoiceadmin'] 	= 'Myaccount/invoiceadmin';
$route['clientinvoices'] 	= 'Myaccount/clientinvoices';
$route['setProductPrice'] 	= 'Myaccount/pricesettings';
$route['sitesettings'] 	= 'Myaccount/sitesettings';
$route['mailaccess'] 	= 'Myaccount/mailaccess';
$route['mycontact'] 	= 'Myaccount/mycontact';


$route['paymentsettings'] 	= 'Myaccount/paymentsettings';


$route['privacypolicy'] 	= 'Site/privacypolicy';
$route['termsofservice'] 	= 'Site/termsofservice';
$route['refundpolicy'] 	= 'Site/refundpolicy';
$route['aboutus'] 	= 'Site/aboutus';
$route['termsofsale'] 	= 'Site/termsofsale';

$route['brokerinvoice'] 	= 'Invoice/brokerinvoice';
$route['clientinvoicezgc'] 	= 'Invoice/clientinvoicezgc';
$route['viewinvoice/(:any)'] 	= 'Invoice/viewinvoice/$1';

/*****Admin settings starts here***/
$route['lettertemplates'] 	= 'Admin/lettertemplates';
$route['addletters'] 	= 'Admin/addletters';
$route['editletters/(:any)'] 	= 'Admin/editletters/$1';
$route['deleteletters/(:any)'] 	= 'Admin/deleteletters/$1';


$route['marketemail'] 	= 'Admin/marketemail';
$route['editmarkets/(:any)'] 	= 'Admin/editmarkets/$1';
$route['smstemplates'] 	= 'Admin/smstemplates';
$route['editsms/(:any)'] 	= 'Admin/editsms/$1';

$route['banklist'] 	= 'Admin/banklist';
$route['addbanks'] 	= 'Admin/addbanks';
$route['editbanks/(:any)'] 	= 'Admin/editbanks/$1';
$route['deletebanks/(:any)'] 	= 'Admin/deletebanks/$1';


$route['creditlist'] 	= 'Admin/creditlist';
$route['addcredit'] 	= 'Admin/addcredit';
$route['editcredit/(:any)'] 	= 'Admin/editcredit/$1';
$route['deletecredit/(:any)'] 	= 'Admin/deletecredit/$1';


$route['callstatuslist'] 	= 'Admin/callstatuslist';
$route['addcallstatus'] 	= 'Admin/addcallstatus';
$route['editcallstatus/(:any)'] 	= 'Admin/editcallstatus/$1';
$route['deletecallstatus/(:any)'] 	= 'Admin/deletecallstatus/$1';


$route['smssubject'] 	= 'Setting/smssubject';
$route['editsubject/(:any)'] 	= 'Setting/editsubject/$1';
$route['deletesubject/(:any)'] 	= 'Setting/deletesubject/$1';


$route['manageques'] 	= 'Setting/manageques';
$route['addques'] 	= 'Setting/addques';
$route['editques/(:any)'] 	= 'Setting/editques/$1';
$route['deleteques/(:any)'] 	= 'Setting/deleteques/$1';

$route['brokercontract'] 	= 'Setting/brokercontract';


$route['fundingstatus'] 	= 'Setting/fundingstatus';
$route['addfundstatus'] 	= 'Setting/addfundstatus';
$route['editfundstatus/(:any)'] 	= 'Setting/editfundstatus/$1';
$route['deletefundstatus/(:any)'] 	= 'Setting/deletefundstatus/$1';


$route['sitemanagement'] 	= 'Setting/sitemanagement';
$route['addsite'] 	= 'Setting/addsite';
$route['editsite/(:any)'] 	= 'Setting/editsite/$1';
$route['deletesite/(:any)'] 	= 'Setting/deletesite/$1';


$route['paymentmethod'] 	= 'Setting/paymentmethod';
$route['addpayment'] 	= 'Setting/addpayment';
$route['editpayment/(:any)'] 	= 'Setting/editpayment/$1';
$route['deletepayment/(:any)'] 	= 'Setting/deletepayment/$1';

$route['reasonmanage'] 	= 'Setting/reasonmanage';
$route['addreason'] 	= 'Setting/addreason';
$route['editreason/(:any)'] 	= 'Setting/editreason/$1';
$route['deletereason/(:any)'] 	= 'Setting/deletereason/$1';


$route['instructmanage'] 	= 'Setting/instructmanage';
$route['addinstruction'] 	= 'Setting/addinstruction';
$route['editinstruction/(:any)'] 	= 'Setting/editinstruction/$1';
$route['deleteinstruction/(:any)'] 	= 'Setting/deleteinstruction/$1';


$route['paymentmethod'] 	= 'Setting/paymentmethod';
$route['addpayment'] 	= 'Setting/addpayment';
$route['editpayment/(:any)'] 	= 'Setting/editpayment/$1';
$route['deletepayment/(:any)'] 	= 'Setting/deletepayment/$1';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
