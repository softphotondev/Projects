     <?php 
       if($products){
      foreach ($products as $key => $value) {
        $desc = strip_tags($value->description);
        $desc = substr($desc, 0, 100);
        ?>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
          <div class="productsColumn">
            <a href="#" class="proImg">
              <div class="pro-image"><img src="<?php echo $value->image_name; ?>" class="img-fluid img-hover"></div>
            </a>
            <div class="product-info">
              <div class="product-cats"><a href="#"><?php echo $value->product_name; ?></a></div>
              <h3 class="product-title"><a href="#"> <?php echo $value->product_name; ?> </a></h3>
              <div class="product-price"><span class="price">
              <span class="price-currencySymbol">$</span><?php echo $value->selling_price; ?></span>
              </div>
              <div class="product-buttons">
  <div class="cart-button btn-group">
  <a href="javascript:void(0);" onClick="buynow('<?php echo $value->product_id?>');" class="buynow-btn">Buy Now</a> 
  <a href="javascript:void(0);" onClick="addtocart('<?php echo $value->product_id?>');" class="cart-btn cartsidebar-link">Add to cart</a>
                </div>
              </div>
            </div>
          </div>
        </div>
       <?php
              }
      }
    ?>