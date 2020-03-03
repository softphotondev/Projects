<?php include_once('header.php'); ?> 

        <div class="page-body checkout vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <div class="page-header-left">
                    <h3>Checkout</h3>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                      <li class="breadcrumb-item">Ecommerce</li>
                      <li class="breadcrumb-item active">Checkout</li>
                    </ol>
                  </div>
                </div>
                <div class="col-lg-6">
                  <!-- Bookmark Start-->
                  <div class="bookmark pull-right">
                    <ul>
                      <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
                      <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                      <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                      <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
                      <li><a href="#"><i class="bookmark-search" data-feather="star"></i></a>
                        <form class="form-inline search-form">
                          <div class="form-group form-control-search">
                            <input type="text" placeholder="Search..">
                          </div>
                        </form>
                      </li>
                    </ul>
                  </div>
                  <!-- Bookmark Ends-->
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="card">
              <div class="card-header">
                <h5>Billing Details</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6 col-sm-12">
                    <form>
                      <div class="form-row">
                        <div class="form-group col-sm-6">
                          <label for="inputEmail4">First Name</label>
                          <input class="form-control" id="inputEmail4" type="email">
                        </div>
                        <div class="form-group col-sm-6">
                          <label for="inputPassword4">Last Name</label>
                          <input class="form-control" id="inputPassword4" type="password">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-sm-6">
                          <label for="inputEmail5">Phone</label>
                          <input class="form-control" id="inputEmail5" type="email">
                        </div>
                        <div class="form-group col-sm-6">
                          <label for="inputPassword7">Email Address</label>
                          <input class="form-control" id="inputPassword7" type="password">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputState">Country</label>
                        <select class="form-control" id="inputState">
                          <option selected="">Choose...</option>
                          <option>...</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="inputAddress5">Address</label>
                        <input class="form-control" id="inputAddress5" type="text">
                      </div>
                      <div class="form-group">
                        <label for="inputCity">Town/City</label>
                        <input class="form-control" id="inputCity" type="text">
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2">State/Country</label>
                        <input class="form-control" id="inputAddress2" type="text">
                      </div>
                      <div class="form-group">
                        <label for="inputAddress6">Postal Code</label>
                        <input class="form-control" id="inputAddress6" type="text">
                      </div>
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" id="gridCheck" type="checkbox">
                          <label class="form-check-label" for="gridCheck">Check me out</label>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-lg-6 col-sm-12">
                    <div class="checkout-details">
                      <div class="order-box">
                        <div class="title-box">
                          <div class="checkbox-title">
                            <h4>Product </h4><span>Total</span>
                          </div>
                        </div>
                        <ul class="qty">
                          <li>Pink Slim Shirt × 1 <span>$25.10</span></li>
                          <li>SLim Fit Jeans × 1 <span>$555.00</span></li>
                        </ul>
                        <ul class="sub-total">
                          <li>Subtotal <span class="count">$380.10</span></li>
                          <li class="shipping-class">Shipping
                            <div class="shopping-checkout-option">
                              <label class="d-none" for="chk-ani">
                                <input class="checkbox_animated" id="chk-ani" type="checkbox" checked="">Option 1
                              </label>
                              <label class="d-block" for="chk-ani1">
                                <input class="checkbox_animated" id="chk-ani1" type="checkbox">Option 2
                              </label>
                            </div>
                          </li>
                        </ul>
                        <ul class="sub-total total">
                          <li>Total <span class="count">$620.00</span></li>
                        </ul>
                        <div class="animate-chk">
                          <div class="row">
                            <div class="col">
                              <label class="d-block" for="edo-ani">
                                <input class="radio_animated" id="edo-ani" type="radio" name="rdo-ani" checked="" data-original-title="" title="">Check Payments
                              </label>
                              <label class="d-block" for="edo-ani1">
                                <input class="radio_animated" id="edo-ani1" type="radio" name="rdo-ani" data-original-title="" title="">Cash On Delivery
                              </label>
                              <label class="d-block" for="edo-ani2">
                                <input class="radio_animated" id="edo-ani2" type="radio" name="rdo-ani" checked="" data-original-title="" title="">PayPal<img class="img-paypal" src="assets/images/checkout/paypal.png" alt="">
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="text-right"><a class="btn btn-primary" href="#">Place Order  </a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
         <?php include_once('footer.php'); ?>      