<div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                   <!-- <h3><?php echo $title;?></h3> -->
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $title;?></li>
                  </ol>
                </div>
                <div class="col-lg-6">
				<ul class="menuBtn">
            <li> <a href="javascript:history.back()"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a></li>
          </ul>
                </div>
              </div>
            </div>
          </div>
           <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 
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
                      <div class="card-body">
            
            <form action="<?php  echo base_url('service/saveprovider'); ?>" method="post"  >
              <?php
          if(isset($provider))
          {
              $providerval = $provider->provider;
              $service_id =$provider->service_id; 
              
              if($title!='Copy Provider')
               {     
              ?>
  <input type="hidden" name="id" value="<?php echo $provider->id; ?>" >             
              <?php
              }
          }
          else
          {
              $providerval = $service_id ='';
          }
          ?>


           <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Select Service:</label>
                    <div class="col-lg-9">
              <select class="form-control" name="service_id" id="service_id" required="required">
                <option value="">--Select Service --</option>
                <?php
                   foreach($service as $ser)
                   {
                    ?>
                    <option value="<?php echo $ser->id; ?>" <?php echo ($ser->id==$service_id)?'selected':''; ?>><?php echo $ser->service; ?></option>
                    <?php
                   }
                 ?>
              </select>

                    </div>
                    </div>



                    <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Enter Provider:</label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="provider" value="<?php echo $providerval; ?>" required="required">
                    </div>
                    </div>



                    <div class="card-footer">
                      <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                    
                </form>


                      </div>
                        
                    </div>
                  </div>
                 
                </div>
              </div>

       </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
  