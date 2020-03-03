
		<div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3><?php echo $title;?></h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active"><?php echo $title;?></li>
                  </ol>
                </div>
                <div class="col-lg-6">
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 col-xl-12">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header">
                        <h5><?php echo $title;?></h5>
                      </div>
					   <!--<form action="<?php  //echo base_url('product/save'); ?>" method="post">-->

               <form action="<?php  echo base_url('product/addproduct'); ?>" method="post" id="addproduct" novalidate="false" enctype="multipart/form-data">
				<?php
				  if(isset($product))
				  {
						$productdata 	= $product[0];
						$product_name 	= $productdata->product_name;
						$product_type 	= $productdata->product_type;
						$category_id 	= $productdata->category_id;
						$block_ids 		= json_decode($productdata->block_ids);
						$description 	= $productdata->description;
						$qty = $productdata->qty;
						$selling_price 	= $productdata->selling_price;
						$product_cost 	= $productdata->product_cost;
						$refund_policy 	= $productdata->refund_policy;
						?>
					<?php if($is_copy_enabled!=1){?>
						<input type="hidden" name="id" value="<?php echo $productdata->product_id; ?>" >  
					<?php } ?>
					<?php
					  }
						  else
						  {
							$product_name = $category_id = $description= $qty = $selling_price = $product_cost = $refund_policy = '';
						  }
					  ?>
                      <div class="card-body">
                          <div class="form-group">
                            <label class="col-form-label pt-0" for="product_name">Product Name *</label>
                            <input class="form-control" name="product_name" type="text" required="required" value="<?php echo $product_name; ?>"/>
                          </div>
						   <div class="form-group">
                            <label class="col-form-label pt-0" for="category_id">Category Id *</label>
                            	<select name="category_id" class="form-control" required>
									<option value="">--Select Category --</option>
									<?php
									foreach($category as $key=>$role)
									{
									?>
									<option value="<?php echo $key; ?>" <?php echo ($category_id!='' && $category_id==$key)?'selected':''; ?>><?php echo $role; ?></option>
									<?php } ?>
								</select>
                          </div>
						   <div class="form-group">
                            <label class="col-form-label pt-0" for="product_type">Product Type *</label>
                            	<select name="product_type" class="form-control" required>
									<?php
									foreach($productType as $getPtype){
										$product_type_id = $getPtype->product_type_id;
										$selected='';
										if(!empty($product_type)){
											if($product_type==$getPtype->product_type_id){
												$selected='selected';
											}
										}
									?>
									<option value="<?php echo $getPtype->product_type_id; ?>" <?php echo $selected;?>><?php echo $getPtype->product_type_name; ?></option>
									<?php } ?>
								</select>
                          </div>
						   <div class="form-group">
                            <label class="col-form-label pt-0" for="qty">Qty *</label>
                            <input class="form-control" name="qty" type="text" required="required" value="<?php echo $qty; ?>"/>
                          </div>
						   <div class="form-group">
                            <label class="col-form-label pt-0" for="product_cost">Product Cost *</label>
                            <input class="form-control" name="product_cost" type="text" required="required"    value="<?php echo $product_cost; ?>"/>
                          </div>
						   <div class="form-group">
                            <label class="col-form-label pt-0" for="selling_price">Selling Price *</label>
                            <input class="form-control" name="selling_price" type="text" required="required"  value="<?php echo $selling_price; ?>" />
                          </div>
						  
						  
							<div class="card">
							  <div class="card-header">
								<h5>Manage Product Options: <span style="float:right;"><button type="button" id="addproduct_options">Add More</button> </span></h5>
							  </div>
							   <div class="card-body" id="add-product-options-fields">
									<?php if(isset($product_options) && !empty($product_options)){?>
										<?php foreach($product_options as $getProductOption){?>
												<input type="hidden" name="products_options_id[]" value="<?php echo $getProductOption->products_options_id;?>" />
												<div class="form-row">
												<div class="form-group col-md-6">
												  <label for="inputCity">Product Title</label>
												  <input type="text" class="form-control" name="sub_product_name[]" value="<?php echo $getProductOption->sub_product_name;?>" />
												</div>
												<div class="form-group col-md-1">
												  <label for="inputState">Qty</label>
												   <input type="text" class="form-control" name="sub_qty[]"  value="<?php echo $getProductOption->sub_qty;?>"/>
												</div>
												<div class="form-group col-md-2">
												  <label for="inputZip">Cost</label>
												  <input type="text" class="form-control" name="sub_product_cost[]" value="<?php echo $getProductOption->sub_product_cost;?>" />
												</div>
												<div class="form-group col-md-2">
												  <label for="inputZip">Selling Price</label>
												  <input type="text" class="form-control" name="sub_selling_price[]" value="<?php echo $getProductOption->sub_selling_price;?>" />
												</div>
											</div>
										<?php } ?>
									<?php } ?>
								</div>
							</div>
							
						   <div class="form-group">
                            <label for="description">Description</label>
							 <textarea class="form-control" name="description" rows="3" id="description"><?php echo $description; ?></textarea>
                          </div>
						  <div class="form-group">
                            <label for="refund_policy">Refund Policy</label>
							 <textarea class="form-control" name="refund_policy" id="refund_policy" rows="3"><?php echo $refund_policy; ?></textarea>
                          </div>
						   <div class="form-group">
								<label class="col-form-label pt-0" for="product_type">Dynamic Block </label>
								<?php
									foreach($blocklist as $getblock){
										$block_id = $getblock->block_id;
										$selected='';
										if(!empty($block_ids)){
											foreach($block_ids as $resBlock){
												if($resBlock==$block_id){
													$selected='checked';
												}
											}
										}
									?>
									<div class="custom-control custom-switch">
									  <input type="checkbox" name="block_ids[]" class="custom-control-input" id="customSwitch<?php echo $block_id; ?>" value="<?php echo $block_id; ?>" <?php echo $selected;?> />
									  <label class="custom-control-label" for="customSwitch<?php echo $block_id; ?>"><?php echo $getblock->block_name; ?></label>
									</div>

								<?php } ?>
                          </div>
			<?php
			  $old_image  = [];
			  if(isset($productimages) && isset($product)){?>
				<div class="form-group ">
					<label class="col-lg-3 col-form-label">Product Images:</label>
						<div class="col-lg-9">

						  <?php foreach ($productimages as $key => $value) {  $old_image[] =$value->product_image;?>
									   <div id="deleteimage_<?php echo $value->product_image; ?>">           
											<img id="image_upload_preview" src="<?php echo $value->image_name; ?>" alt="your image"  width="150px"  height="100px"/>
											<input type="button" name="delete" value="delete" style="background-color: red;color: #fff; border: 2px solid red;" onclick="removeimage('<?php echo $value->product_image; ?>','<?php echo $productdata->product_id; ?>','<?php echo $value->product_image; ?>')">
										</div>
											<br>
						   <?php   }  ?>
						</div>
				</div>
			<?php } ?>
		<?php
		 if(isset($product)){?>
				<input type="hidden" name="old_images" id="old_images" value="<?php echo implode(',',$old_image); ?>">
        <?php } ?>
					<div class="form-group">
						<label class="col-lg-3 col-form-label">Product Image:</label>
						<div class="col-lg-9">
							<div id="filediv" style="margin-bottom: 20px;">
								<input name="product_image[]" type="file" id="file"/>
							</div>
							<input style="margin-top: 20px;" type="button" id="add_more" class="upload" value="Add More Images"/>
						</div>
					</div>
                      </div>
                        <div class="card-footer">
							<button class="btn btn-primary" type="submit">Submit</button>
							<input class="btn btn-light" type="reset" value="Cancel">
						</div>
						
					  </form>
                    </div>
                  </div>
                 
                </div>
              </div>

		   </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

<script src="<?php echo  base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>        
<script type="text/javascript">
 var abc = 0;      // Declaring and defining global increment variable.
$(document).ready(function() {
//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
$('#add_more').click(function() {
$(this).before($("<div/>", {
id: 'filediv'
}).fadeIn('slow').append($("<input/>", {
name: 'product_image[]',
type: 'file',
id: 'file'
}),$("<br/><br/>")));

$('.defaultimage').click(function() {
    $('.defaultimage').not(this).prop('checked', false);
});

});
// Following function will executes on change event of file input to select different file.
$('body').on('change', '#file', function() {
if (this.files && this.files[0]) {
abc += 1; // Incrementing global variable by 1.
var z = abc - 1;
var x = $(this).parent().find('#previewimg' + z).remove();
$(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
$(this).hide();
$("#abcd" + abc).append($("<img/>", {
id: 'img',
src: 'x.png',
alt: 'delete'
}).click(function() {
$(this).parent().parent().remove();
}));
}
});
// To Preview Image
function imageIsLoaded(e) {
$('#previewimg' + abc).attr('src', e.target.result);
};
$('#upload').click(function(e) {
var name = $(":file").val();
if (!name) {
alert("First Image Must Be Selected");
e.preventDefault();
}
});
}); 


function removeimage(id,product_id,value)
{
    $('#deleteimage_'+id).hide();

  var old_image = $('#old_images').val(); 

    $.post("<?php echo base_url('product/removeimage'); ?>",{value:value,old_image:old_image,product_id:product_id,id:id},function(data) 
    {
          $('#old_images').val(data);
    });
}
</script>

<style>
.upload{
background-color:#0773d2;
border:1px solid #0773d2;
color:#fff;
border-radius:5px;
padding:10px;
text-shadow:1px 1px 0 green;
box-shadow:2px 2px 15px rgba(0,0,0,.75)
}
.upload:hover{
cursor:pointer;
background:#c20b0b;
border:1px solid #c20b0b;
box-shadow:0 0 5px rgba(0,0,0,.75)
}
#file{
color:green;
padding:5px;
border:1px dashed #123456;
background-color:#f9ffe5
}
#upload{
margin-left:45px
}
#noerror{
color:green;
text-align:left
}
#error{
color:red;
text-align:left
}
#img{
width:17px;
border:none;
height:17px;
margin-left:-20px;
margin-bottom:91px
}
.abcd{
text-align:left;
}
.abcd img{
height:100px;
width:100px;
padding:5px;
border:1px solid #e8debd
}
 </style> 

 <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'description' );
CKEDITOR.replace( 'refund_policy' );
</script>

<script>
    $(document).ready(function() {
    var max_fields_limit	= 10; 
    var x = 1; 
    $('#addproduct_options').click(function(e){ 
        e.preventDefault();
        if(x < max_fields_limit){ 
            x++; 
            $('#add-product-options-fields').append('<div class="form-row"> <div class="form-group col-md-6"> <label for="inputCity">Product Title</label> <input type="text" class="form-control" name="sub_product_name[]" /> </div> <div class="form-group col-md-1"> <label for="inputState">Qty</label> <input type="text" class="form-control" name="sub_qty[]" /> </div> <div class="form-group col-md-2"> <label for="inputZip">Cost</label> <input type="text" class="form-control" name="sub_product_cost[]" /> </div> <div class="form-group col-md-2"> <label for="inputZip">Selling Price</label> <input type="text" class="form-control" name="sub_selling_price[]" /> </div><button class="remove_field btn btn-danger btn-sm">Remove</button></div>'); //add input field
        }
    });  
    $('#add-product-options-fields').on("click",".remove_field", function(e){ //user click on remove text links
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
