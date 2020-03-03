<div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                   <!-- <h3><?php echo $title;?></h3> -->
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active"><?php echo $title;?></li>
                  </ol>
                </div>
                <div class="col-lg-6">
                
                </div>
              </div>
            </div>
		 </div>

                
                 <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Individual column searching (text inputs) Starts-->
              <div class="col-sm-12">
                <div class="card">
				
<div class="card-header"><div class="row">
<div class="col-lg-3"> <h5><?php echo $title;?></h5> </div>
<div class="col-lg-9"> 
<ul class="menuBtn"><li><a href="<?php echo base_url('addpages'); ?>"> Add Pages </li></ul>
</div></div></div>

                  <div class="card-body">
      <div class="row">
        <?php foreach($list as $response){ 
          $page_url = $response->page_url;
            if(!empty($parent_id)){
              $getPageURl = getParentPageURlById($parent_id);
              $parentPage_url = $getPageURl->page_url;
              $page_url   = $parentPage_url."/".$page_url;
            }


            $url = ($response->id!='5')?base_url($page_url):base_url();


        ?>
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title"><?php echo $response->title;?></h5>
              <p class="card-text"><?php echo substr(strip_tags($response->page_content),0,200);?></p>
              <a href="<?php echo base_url('addpages/'.$response->id);?>" class="btn btn-primary">Update</a>
              <a href="<?php echo $url;?>" target="_blank" class="btn btn-warning">View Page</a>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
                </div>
              </div>
              <!-- Individual column searching (text inputs) Ends-->
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>