
<div class="page-body vertical-menu-mt">

          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3><?php echo $title;?></h3>
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

               <form action="<?php  echo base_url('Setting/save'); ?>" method="post" enctype="multipart/form-data">
    <?php
      if(isset($site_settings))
      {
        $sitename = $site_settings->sitename;
        $siteemail = $site_settings->siteemail;
        $sitephone = $site_settings->sitephone;
        $domain = $site_settings->domain;
        $SMTP_host = $site_settings->SMTP_host;
        $SMTP_username = $site_settings->SMTP_username;
        $SMTP_password = $site_settings->SMTP_password;
        $SMTP_port = $site_settings->SMTP_port;
        $sms_mobile = $site_settings->sms_mobile;
        $site_address = $site_settings->site_address;
        $copyright = $site_settings->copyright;
        ?>
  <input type="hidden" name="id" value="<?php echo $site_settings->id; ?>" >  
      <?php
      }
          else
          {
      $sitename = $siteemail = $sitephone= $domain = $SMTP_host = $SMTP_username = $SMTP_password = $SMTP_port =$sms_mobile =$site_address = $copyright = '';
          }
      ?>



                <div class="card-body">


                  <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Site Name </label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="sitename" value="<?php echo $sitename; ?>" required="required">
                    </div>
                    </div>


                    <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Site Email </label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="siteemail" value="<?php echo $siteemail; ?>" required="required">
                    </div>
                    </div>



<div class="form-group row">
                    <label class="col-lg-3 col-form-label">Site Phone </label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="sitephone" value="<?php echo $sitephone; ?>" required="required">
                    </div>
                    </div>


<div class="form-group row">
                    <label class="col-lg-3 col-form-label">Site Address </label>
                    <div class="col-lg-9">
             <textarea name="site_address"><?php echo $site_address; ?></textarea>
                    </div>
                    </div>



<div class="form-group row">
                    <label class="col-lg-3 col-form-label">Site Copyright </label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="copyright" value="<?php echo $copyright; ?>" required="required">
                    </div>
                    </div>



<div class="form-group row">
                    <label class="col-lg-3 col-form-label">SMTP Host</label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="SMTP_host" value="<?php echo $SMTP_host; ?>" required="required">
                    </div>
                  </div>


<div class="form-group row">
                    <label class="col-lg-3 col-form-label">SMTP Host</label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="SMTP_host" value="<?php echo $SMTP_host; ?>" required="required">
                    </div>
   </div>



<div class="form-group row">
                    <label class="col-lg-3 col-form-label">SMTP Password</label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="SMTP_password" value="<?php echo $SMTP_password; ?>" required="required">
                    </div>
                    </div>



<div class="form-group row">
                    <label class="col-lg-3 col-form-label">SMTP Port </label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="SMTP_port" value="<?php echo $SMTP_port; ?>" required="required">
                    </div>
                    </div>


<div class="form-group row">
                    <label class="col-lg-3 col-form-label">SMS Mobile </label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="sms_mobile" value="<?php echo $sms_mobile; ?>" required="required">
                    </div>
                    </div>


                    <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Logo</label>
                    <div class="col-lg-9">
              <input name="sitelogo" type="file" id="file"/>

               <img id="image_upload_preview" src="<?php echo  $site_settings->sitelogo; ?>" alt="your image"  width="150px"  height="100px"/>
              <input type="hidden" name="image_old" value="<?php echo  $site_settings->sitelogo; ?>">
                    </div>
                    </div>


     

                       <div class="form-group row">
                    <label class="col-lg-3 col-form-label"></label>
                    <div class="col-lg-9">
           <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                    </div>



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
CKEDITOR.replace( 'site_address' );
</script>