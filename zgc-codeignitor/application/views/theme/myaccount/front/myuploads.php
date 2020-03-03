<div class="page-body-wrapper">
  <div class="page-body">
    <div class="container-fluid">
      <div class="myaccount-profile my-upload">
        <div class="row">
          <?php if(!isMobile()){?>
           <?php $this->load->view(MYACCOUNT_PATH.'front/sidebar_account',['page' => $page]);?>
          <?php } ?>
          <?php if(isMobile()){?>
		  
        <div class="col-lg-3"> <a class="btn mobile-backbtn" href="<?php echo site_url('order/myaccount');?>"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a></div>
		
          <?php } ?>
		  
          <div class="col-lg-9">
		  <div class="row">
		  <div class="col-lg-6"> <h1> <?php echo $title; ?> </h1> </div>
		  <div class="col-lg-6">  <div class="input-group searchdata-table">
    <input type="text" class="form-control" placeholder="Search" onkeyup="searchvalues(this.value)">
  </div> </div> </div>
  <br>
		  
		       <?php if ($this->session->flashdata('msg')) { ?>
              <?php echo $this->session->flashdata('msg'); } ?>
              
            <div class="row" id="load_data"> 
                       <?php
                             if($myuploads)
                             {
                               foreach($myuploads as $key=>$uploads)
                               {
            $date = ($uploads->added_date!=NULL)?date("m/d/Y H:i:s", strtotime($uploads->added_date)):'';
            $name =  $uploads->first_name.' '.$uploads->last_name;
            $field = ucfirst(str_replace("-"," ",$uploads->custom_field_name));
                             ?>
				<div class="col-lg-12">			 
              <div class="custom-orderBox">
                <div class="custom-header">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="orderplaced-row">
                      <p class="keyNumber"> <?php echo $key+1; ?>  </p>
                        <div class="order-col">
                          <p class="otitle"> Create Date : <?php echo $date; ?> </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="order-details-section">
                  <div class="row">
                    <div class="col-lg-4">
                      <h2 class="order-title"> <?php echo $name; ?> </h2>
                      <div class="productDetails"> <?php echo $field; ?> </div>
                    </div>
                    
                    <div class="col-lg-4">  
                    <img src="<?php echo $uploads->custom_field_values; ?>" alt="..." class="img-thumbnail" style="max-height:225px;">
                    </div>
                    <div class="col-lg-4">
                      <div class="order-btn-group"> <a href="<?php echo $uploads->custom_field_values;?>" target="_blank"  download  class="btn btn-orderDetails"> <i class="fa fa-download" aria-hidden="true"></i> Download</a> <a href="javascript:void(0);"   onclick="printimage('<?php echo $uploads->custom_field_values;?>')" target="_blank"  class="btn btn-orderDelete" ><i class="fa fa-print" aria-hidden="true"></i> Print</a> </div>
                    </div>
                  </div>
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
<script type="text/javascript">
 function printimage(img)
{
    var W = window.open(img);
    W.window.print();
    window.location.reload();
} 


function searchvalues(value)
{
    $.post("<?php echo base_url('Myaccountsearch/serachmyuploads'); ?>",{value:value},function(data) 
    {
          $('#load_data').html(data);
    });
}
</script>
