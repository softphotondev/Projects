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
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>Creative - Premium Admin Template</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/print.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/vertical-menu.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/light-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/responsive.css">
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
      <!-- Page Header Start-->

    <!-- Page Body Start-->
      <div class="page-body-wrapper">
    <?php
  $date = date('m d,Y',strtotime($orders->added_date));
  $shortdesc = substr($productdetails->description, 0, 130);
  $order_number = ($orders->order_number!=NULL)?$orders->order_number:$orders->order_id;
  $email = ($userdetails->email!='')?$userdetails->email:'';
  $phone = ($userdetails->phone!='')?$userdetails->phone:'';
  $product_name = ($productdetails->product_name!='')?$productdetails->product_name:'';
  $description = ($productdetails->description!='')?$productdetails->description:'';
  $order_amount = ($orders->order_amount!='')?$orders->order_amount:'';

  $order_price = getorderprice($orders->order_id);

  
  ?>
        <!-- Right sidebar Ends-->
        <div class="page-body vertical-menu-mt">
   
          <!-- Container-fluid starts-->
          <div class="container" style="padding-top: 70px;">
            <div class="row">
              <div class="col-sm-12">
                <div class="card" id="dvContainer">
                  <div class="card-body">
                    <div class="invoice">
                      <div>
                        <div>
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="media">
                                <div class="media-left"><img class="media-object img-60" src="<?php echo sitepurelogo(); ?>" alt=""></div>
                                <div class="media-body m-l-20">
                                  <h4 class="media-heading"><?php echo sitename(); ?></h4>
                                  <p><?php echo siteemail(); ?><br><span class="digits"><?php echo sitephone(); ?></span></p>
                                </div>
                              </div>
                              <!-- End Info-->
                            </div>
                            <div class="col-sm-6">
                              <div class="text-md-right">
                      <h3>Invoice #<span class=""><?php echo $order_number; ?></span></h3>
                          <p>Order Date: <span class="digits"><?php echo $date; ?></span><br>              
                                  <!--Payment Due: June <span class="digits">27, 2015</span>-->
                                </p>
                              </div>
                              <!-- End Title-->
                            </div>
                          </div>
                        </div>
                        <hr>
                        <!-- End InvoiceTop-->
                        <div class="row">
                          <div class="col-md-4">
                            <div class="media">
                              <div class="media-left"><img class="media-object rounded-circle img-60" src="<?php echo getprofileimage($orders->user_id); ?>" alt=""></div>
                              <div class="media-body m-l-20">
                                <h4 class="media-heading"><?php echo orderusersname($orders->user_id); ?></h4>
                            <p><?php echo $userdetails->email; ?><br><span class="digits"><?php echo $phone; ?></span></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="text-md-right" id="project">
                              <h6>Project Description</h6>
                              <p><?php echo $shortdesc.'..'; ?></p>
                            </div>
                          </div>
                        </div>
                        <!-- End Invoice Mid-->
                        <div>
                          <div class="table-responsive invoice-table" id="table">
                            <table class="table table-bordered table-striped">
                              <tbody>
                                <tr>
                                  <td class="item">
                                    <h6 class="p-2 mb-0">Item Description</h6>
                                  </td>
                     
                                  <td class="Rate">
                                    <h6 class="p-2 mb-0">Rate</h6>
                                  </td>
                                  <td class="subtotal">
                                    <h6 class="p-2 mb-0">Sub-total</h6>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <label><?php echo $product_name; ?></label>
                                    <p class="m-0"><?php echo $description; ?></p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits">$<?php echo $order_price; ?></p>
                                  </td>
                                  <td>
                                    <p class="itemtext digits">$<?php echo $order_price; ?></p>
                                  </td>
                                </tr>
                                
                                
                                <tr>
                                  <td></td>
                                  <td class="Rate">
                                    <h6 class="mb-0 p-2">Total</h6>
                                  </td>
                                  <td class="payment digits">
                                    <h6 class="mb-0 p-2">$<?php echo $order_price; ?></h6>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <!-- End Table-->
                          <div class="row">
                            <div class="col-md-8">
                              <div>
                                <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices.</p>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <form class="text-right">
                                <input type="image" src="<?php echo base_url(); ?>assets/images/other-images/paypal.png" name="submit" alt="PayPal - The safer, easier way to pay online!">
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- End InvoiceBot-->
                      </div>
                      <div class="col-sm-12 text-center mt-3">
 
                    <button class="btn btn btn-primary mr-2 " type="button" id="btnPrint">Print</button>
                      </div>
                      <!-- End Invoice-->
                      <!-- End Invoice Holder-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->

      </div>
    </div>
    <!-- latest jquery-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap/bootstrap.js"></script>
    <!-- feather icon js-->
    <script src="<?php echo base_url(); ?>assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="<?php echo base_url(); ?>assets/js/sidebar-menu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="<?php echo base_url(); ?>assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/counter/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/counter/counter-custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/chat-menu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/print.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?php echo base_url(); ?>assets/js/script.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.drilldown.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/vertical-menu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/megamenu.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
<script type="text/javascript">
    $("#btnPrint").click(function(){
      var divContents = $("#dvContainer").html();
      var printWindow = window.open('', '', 'height=400,width=800');
      printWindow.document.write('<html><head><title>Invoice</title>');
      printWindow.document.write('</head><body >');
      printWindow.document.write(divContents);
      printWindow.document.write('</body></html>');
      printWindow.document.close();
      printWindow.print();
  });

    function printpdf(order_id)
    {

    $.post("<?php echo base_url('Invoice/printpdf'); ?>",{id: id},function(html) 
     {
     $('#loadclientdetails').html(html); 
     });

    }
</script>



  </body>
</html>