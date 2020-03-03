<style>
.accordata-hide {
	display: none;
}
.tabshow {
	display: block;
}
.show-content {
	display: block;
}
.card {
	margin-bottom: 10px;
	border: 0px;
}
.card .card-header {
	background-color: #1a85ef;
	padding: 15px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
	margin: 10px;
}
.card-header a {
	color: #fff;
	font-size: 16px;
	font-weight: 700;
}
.card .card-body {
	padding: 20px;
	background-color: transparent;
	font-size: 16px;
	line-height: 22px;
}

#accordion-custom h2 { color: #2c419a;
font-size: 25px;
font-weight: 600;
margin-top: 20px; }

</style>


<?php
  if(count($faq)==2)
  {
       $size = 6;
  }
  else if(count($faq)==3)
  {
     $size = 4;
  }
  else
  {
       $size = 3;
  }
?>


<div class="page-wrapper grayBg contactus-page">
  <div class="container">
    <div id="accordion-custom">
      <div class="row" id="accordion">

         <?php if($faq) { foreach ($faq as $key => $value) { ?>
        <div class="col-lg-6" >
          <h2><?php echo $titlehere[$key]; ?></h2>

       <?php   foreach ($value as $key11 => $innervalue) {?> 
          <div class="card">
            <div class="card-header"> 
          <a class="collapsed card-link" data-toggle="collapse" href="#collapseOne_<?php echo $innervalue->id; ?>"> <?php echo $innervalue->title; ?> </a> </div>
            <div id="collapseOne_<?php echo $innervalue->id; ?>" class="collapse" data-parent="#accordion">
              <div class="card-body"><?php echo $innervalue->description; ?></div>
            </div>
          </div>

        <?php } ?>


      </div>

       <?php } } ?>
    </div>
  </div>
</div>
