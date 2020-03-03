        <div class="row">
      <?php
        if($list_price)
        {
        foreach($list_price as $key=>$Response)
        {
         $status = $Response['status'];
      ?>

  <div class="cl-sm-4 col-md-4 col-lg-4">
  
    <div class="clientBox-container">
      <div class="priceImg"> 
    <img src="<?php echo  base_url('assets/images/270x360.png'); ?>" class="img-fluid"> 
      <p> <?php echo $status; ?> </p>
      </div>
      <div class="heading"><?php echo $Response['class_name'];?></div>
    <div class="pricingtcontent">
      <p class="price">YOUR PRICE : <?php echo '$'.round($Response['cost']);?></p>
      <p class="clientPrice">CLIENT PRICE : </p>
    <input type="text" name="price_<?php echo $Response['product_id']; ?>" id="price_<?php echo $Response['product_id']; ?>" class="form-control" onkeypress="return isNumberKey(event,this.id)" value="<?php echo $Response['price']; ?>"> 
    <p>Status : <select class="form-control select2" name="status" id="status_<?php echo $Response['product_id']; ?>">
     <option value="">Choose Status</option>
     <option value="Active" <?php echo ($status=='Active')?'selected="selected"':''; ?> >Active</option>
     <option value="Inactive" <?php echo ($status=='Inactive')?'selected="selected"':''; ?> >Inactive</option>
     </select></p>
</div>
    <div class="clientList-details"> 
    <a class="btn btn-info mbot25" href="javascript:void(0);"  onclick="updateclientprice('<?php echo $Response['product_id'];  ?>')">Update</a>
    </div>
    
    </div>
  </div>

<?php } } ?>

</div>
