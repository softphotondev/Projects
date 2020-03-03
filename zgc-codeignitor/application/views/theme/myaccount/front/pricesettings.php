<style>
.price-input p.clientPrice, .status-select p.p_status2 {
    width: 160px;
    margin: 0;
    align-items: center;
    font-weight: bold;
    display: flex;
}
.status-select, .price-input {
    display: flex;
    margin-bottom: 5px;
}
.clientList-details a.btn-info {
    background: #dd3333 !important;
    border-color: #dd3333 !important;
    margin-top: 10px;
    width: 100%;
}
.clientList-details {
    margin: 0 auto;
    text-align: center;
}
span.span-dlr {
    font-weight: bold;
	float: right;
}
p.price {
    background: #efefef;
    padding: 10px;
    font-weight: bold;
}
p.p_status {
    margin: 0;
    font-weight: bold;
    font-size: 12px;
}
.clientBox-container .heading {
    padding: 10px 0px;
	    font-weight: 700;
}
p.p_status:after {
    content: "";
    background: green;
    width: 9px;
    height: 9px;
    border-radius: 50%;
    display: inline-block;
    left: 3px;
    position: relative;
}
.status-select .select2 {
    font-size: 14px;
}
h4.order-card-title {
    text-transform: uppercase;
}
.row.p3-page label {
    margin: 0;
	    font-weight: 700;
}
.row.p3-page select#category, .row.p3-page input {
    border: 0;
	height: 40px;
    font-size: 14px;
}
.p3-page button.btn.btn-theme {
    background: #d33;
    color: #fff;
    margin: 0 !important;
    height: 40px;
    float: right;
}
.priceImg img.img-fluid {
    height: 220px;
    width: 100%;
}
.clientList-details a.btn-info:hover, .p3-page button.btn.btn-theme:hover {
    background: #ed3223 !important;
}
.row.p3-page {
    background: #efefef;
    margin: 0;
	padding-top: 10px;
}

@media (max-width: 575px){
.row.copyright-wrap img {
    width: 100%;
}
.row.p3-page {
    padding: 20px 10px;
}
}
@media (max-width: 767px){
.clientBox-container {
    margin-bottom: 40px;
}
}
@media (min-width: 1024px){
.row.p3-page input#update {
    width: 59% !important;
}
}
@media (min-width: 576px) and (max-width: 767px){
.p3-page button.btn.btn-theme {
    padding: 10px 6px;
}
.clientBox-container {
    width: 300px;
    margin: 0 auto 40px auto;
}
}
@media (min-width: 768px) and (max-width: 843px){
.p3-page button.btn.btn-theme {
    padding: 10px 20px;
}
}
@media (min-width: 992px) and (max-width: 1150px){
.p3-page button.btn.btn-theme {
    padding: 10px 20px;
}
}
@media (min-width: 992px) and (max-width: 1210px){
.row.p3-page input#update {
    width: 53% !important;
}
}
</style>
<div class="page-body-wrapper">
<div class="page-body">
<div class="container-fluid">
  <div class="myaccount-profile">
    <div class="row">
     <?php $this->load->view(MYACCOUNT_PATH.'front/sidebar_account',['page' => $page]);?>

    <div class="col-lg-9 card">

<div class="row" style="margin-bottom:25px;">

<div class="col-lg-12">
<h4 class="order-card-title"> <?php echo $title; ?> </h4>

  <div class="details-wrap">                                    
    <div class="details-box orders">

       <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); } ?>



    <div class="row p3-page">
  <div class="col-sm-4">
    <div class="form-group">
    <label>Select Category</label>
     <select name="category" id="category" class="form-control select2" style="width:100%;" onchange="changecategory(this.value)">
      <option value="0">Select Category</option>
      <?php  foreach ($productcategory as $key => $productcate) { ?>
      <option value="<?php echo $productcate->category_id;?>"   <?php if($cateid==$productcate->category_id){ echo 'selected';}?>><?php echo $productcate->category_name; ?></option>
      <?php } ?>
    </select>
    </div>
    </div> 
    <div class="col-sm-4">
    <div class="form-group">
    <label>Search</label>
    <input id="search" name="search" placeholder="Search" type="text" class="form-control" onkeyup="searchalertprice(this.value);"   >
    </div>
    </div> 
    <div class="col-sm-4">
    <div class="form-group">
    <label>Update</label><br>
    <input id="update" name="update" placeholder="Update %" type="text" class="form-control" style="width: 55%; float: left;" >
    <button onclick="updatedatas()" class="btn btn-theme btn-theme-dark"  style="margin-top:2px; cursor: pointer;">Update</button>
    </div>
    </div>  
    </div>


          <div class="clear" style="clear: both;"></div>

      
              
            <div class="details-wrap" style="width:100%;">                                    
            <div class="details-box orders">

      <br>
      <div id="searchresultprice"> 

        <div class="row">
	<?php //print_r($list_images); 
	  if($list_images)  {							
           foreach ($list_images as $key=>$row) 
          {
            
			$image_name = $row[0]->image_name; ?>

  <div class="cl-sm-4 col-md-4 col-lg-4">
  
    <div class="clientBox-container">
      <div class="priceImg">   

   <img src="<?php echo $image_name; ?>" class="img-fluid">                     
	
    
      </div>
    
    </div>
  </div>

<?php } } ?>			
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
	  
      <p class="p_status"><?php echo $status; ?></p>
      </div>
      <div class="heading"><?php echo $Response['class_name'];?></div>
    <div class="pricingtcontent">
      <p class="price">YOUR PRICE : <span class="span-dlr"><?php echo '$'.round($Response['cost']);?></span></p>
	    <div class="price-input">
		  <p class="clientPrice">Client Price : </p>
		  <input type="text" name="price_<?php echo $Response['product_id']; ?>" id="price_<?php echo $Response['product_id']; ?>" class="form-control" onkeypress="return isNumberKey(event,this.id)" value="<?php echo $Response['price']; ?>"> 
		</div>
		<div class="status-select">
		  <p class="p_status2"> Status :</p>
		  <select class="form-control select2" name="status" id="status_<?php echo $Response['product_id']; ?>">
		  <option value="">Choose Status</option>
		  <option value="Active" <?php echo ($status=='Active')?'selected="selected"':''; ?> >Active</option>
		  <option value="Inactive" <?php echo ($status=='Inactive')?'selected="selected"':''; ?> >Inactive</option>
		  </select>
		</div>
	</div>
    <div class="clientList-details"> 
    <a class="btn btn-info mbot25" href="javascript:void(0);"  onclick="updateclientprice('<?php echo $Response['product_id'];  ?>')">Update</a>
    </div>
    
    </div>
  </div>

<?php } } ?>

</div>

</div>
</div>
</div>  


        </div>

     </div>
     </div> 
    </div> 

      </div>
    </div>
  </div>
</div>
</div>
</div>

<script type="text/javascript">
function isNumberKey(evt,id)
{
  try{
        var charCode = (evt.which) ? evt.which : event.keyCode;
  
        if(charCode==46){
            var txt=document.getElementById(id).value;
            if(!(txt.indexOf(".") > -1)){
  
                return true;
            }
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57) )
            return false;

        return true;
  }catch(w){
    alert(w);
  }
}

  function searchalert(value)
 {
     $.post("<?php echo base_url('Myaccount/searchresult'); ?>", {value:value}, function( data ) {
      $('#searchresult').html(data);
      });
 }

   function searchalertprice(search)
 {
      var category = $('#category').val();

     $.post("<?php echo base_url('Myaccount/searchresultprice'); ?>", {search:search,category:category}, function( data ) {
      $('#searchresultprice').html(data);
      });
 } 

  function changecategory(category)
 {
  var search = $('#search').val();

  $.post("<?php echo base_url('Myaccount/changecategoryprice'); ?>", {category:category,search:search}, function( data ) {
      $('#searchresultprice').html(data);
      });
 } 

 function updatedatas()
 {
   var category = $('#category').val();
   var update = $('#update').val();

    $.post("<?php echo base_url('Myaccount/updatedatas'); ?>", {category:category,update:update}, function(data) {
     window.location.reload();
      });
 } 


  function updateclientprice(product_id)
 {
   var price = $('#price_'+product_id).val();
   var status = $('#status_'+product_id).val();

    $.post("<?php echo base_url('Myaccount/productpriceupdate'); ?>", {product_id: product_id,price:price,status:status}, function( data ) {
        if(data=='success')
        alert('Price Updated successfully');
        else
        alert(data);
          
      });

 }  
</script>
