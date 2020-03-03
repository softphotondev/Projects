<div class="page-body-wrapper">
<div class="page-body">
<div class="container-fluid">
  <div class="myaccount-profile">
    <div class="row">
    <?php $this->load->view(MYACCOUNT_PATH.'front/sidebar_account',['page' => $page]);?>

    <div class="col-lg-9 card">

<div class="row" style="margin-bottom:25px;">

<div class="col-lg-12">

  <div class="details-wrap">                                    
    <div class="details-box orders">

       <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); } ?>


                <div class="col-sm-12 col-xl-6 xl-100">
                <div class="card">
                  <div class="card-header">
                    <h5> <?php echo $title; ?> </h5>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                      <li class="nav-item"><a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Header</a></li>
                      <li class="nav-item"><a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Footer</a></li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <p class="mb-0 m-t-30">


                            <div class="row">
                <div class="col-md-9">
                    <h4>Header</h4>
                    <p>It is used to change Header like email phone.</p>
                    <div class="card mb-5">
                        <div class="card-body">
                            <form method="post"  enctype="multipart/form-data"  action="<?php echo site_url('sitesettings');?>" >
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="siteemail" class="form-control" name="siteemail" placeholder="Email" value="<?php echo $site_settings->siteemail ?? '';?>" required="required">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sitephone" placeholder="Phone" value="<?php echo $site_settings->sitephone ?? '';?>" required="required">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Logo</label>
                                    <div class="col-sm-5">
                                        <input type="file" class="form-control" name="sitelogo" id="inputFile" placeholder="Password" >
                                    </div>
                                       <div class="col-sm-4">
                                      <img id="image_upload_preview" src="<?php echo $site_settings->sitelogo ?? ''?>" alt="your image" style="width:160px;" />
                                    </div>
                                </div>
                                <?php if(!empty($site_settings->id)){?>
                                <input type="hidden" name="id" value="<?php echo $site_settings->id; ?>" >
                                <?php } ?>
                                    <div class="clearfix"></div>
                                <div class="form-group row">
                                    <div class="col-sm-7"> 
                                        <button type="submit" class="btn btn-primary" style="float: right;">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                        </p>
                      </div>
   
                      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <p class="mb-0 m-t-30">
                          

    <div class="row">
                <div class="col-md-12">
                    <h4>Footer</h4>
                    <div class="card mb-5">
                        <div class="card-body">
                                 <form method="post"  enctype="multipart/form-data"  action="<?php echo site_url('sitesettings');?>" >


                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Company Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="sitename" placeholder="Company Name" value="<?php echo $site_settings->sitename ?? '';?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="site_address" placeholder="Company address" value="<?php echo $site_settings->site_address ?? '';?>">
                                    </div>
                                </div>
                                
                                
                                  <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">City</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="company_city" placeholder="City" value="<?php echo $site_settings->company_city ?? '';?>">
                                    </div>
                                </div>
                                

                                  <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">State</label>
                                    <div class="col-sm-9">
                        <select class="form-control" name="company_state" id="company_state">
                        <option value="">Choose State</option>
                        <?php foreach($statelist as $Restate){?>
                        <option value="<?php echo $Restate->code;?>" <?php echo ($site_settings->company_state==$Restate->code)?'selected':'';?> ><?php echo $Restate->name;?></option>
                        <?php } ?>
                        </select>
                                    </div>
                                </div>


                                  <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Zip</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="company_zip" placeholder="Zip" value="<?php echo $site_settings->company_zip ?? '';?>">
                                    </div>
                                </div>
                                

                                  <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Phone</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="company_phone" placeholder="Phone" value="<?php echo $site_settings->company_phone ?? '';?>">
                                    </div>
                                </div>
                                
                                <?php /* ?>
                                
                                  <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Copyright</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="copyright" placeholder="Copyright" value="<?php echo strip_tags($site_settings->copyright);?>">
                                    </div>
                                </div>
                                
                            
                                  <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Privacy</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control"  name="privacy_policy" id="privacy_policy"><?php echo $site_settings->privacy_policy;?></textarea>
                                    </div>
                                </div>
                                
                                
                                
                                  <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Terms</label>
                                    <div class="col-sm-9">
                                <textarea class="form-control"  name="terms_policy" id="terms_policy"><?php echo $site_settings->terms_policy;?></textarea>
                                    </div>
                                </div>
                                
                                
                                     <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Refund Policy</label>
                                    <div class="col-sm-9">
                            <textarea class="form-control"  name="refund_policy" id="refund_policy"><?php echo $site_settings->refund_policy;?></textarea>
                                    </div>
                                </div>
                                
                                
                                
                                     <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Disclaimer</label>
                                    <div class="col-sm-9">
                                      <textarea class="form-control"  name="disclaimer" id="disclaimer"><?php echo $site_settings->disclaimer;?></textarea>
                                    </div>
                                </div>


                                   <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">About</label>
                                    <div class="col-sm-9">
                                      <textarea class="form-control"  name="about" id="about"><?php echo $site_settings->about;?></textarea>
                                    </div>
                                </div>
                                
                                <?php */ ?>
                                <?php if(!empty($site_settings->id)){ ?>
                                <input type="hidden" name="id" value="<?php echo $site_settings->id; ?>" >
                                <?php } ?>
                               
                                <div class="form-group row">
                                    <div class="col-sm-8">
                                        <button type="submit" class="btn btn-primary" style="float: right;">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                        </p>
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
</div>

<script src="https://cdn.ckeditor.com/4.9.2/full-all/ckeditor.js"></script>  
<script type="text/javascript">
CKEDITOR.replace('privacy_policy');
CKEDITOR.replace('terms_policy');
CKEDITOR.replace('refund_policy');
CKEDITOR.replace('disclaimer');
CKEDITOR.replace('about');
</script>

<style type="text/css">
 .fade:not(.show)
 {
  opacity: 1;
 } 
</style>
