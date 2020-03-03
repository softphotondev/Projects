<div class="page-body" style="padding-top:15px;"> 
	<div class="page-content"> 
	<a class="btn mobile-backbtn" href="<?php echo site_url('order');?>"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
	<h1 class="page-tab-title"> PRODUCT CATEGORIES </h1>
	
		<div class="grid-icons-2">
	<?php
		foreach($category_list as $cate) {
			$iconUrl = $cate->icon_url;
		?>
		<a href="<?php echo base_url('getproduct/'.$cate->slug_url); ?>" class="bg-theme round-medium shadow-huge scale-hover">
			<img src="<?php echo $iconUrl;?>" /><span class="color-theme">  <?php echo $cate->category_name; ?> (<?php echo $productcount[$cate->category_id]; ?>) </span></a>  
		 <?php } ?>
		</div>    
	</div>
</div>