
<div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-8">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $title;?></li>
                  </ol>
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
                      <div class="row">
                      <div class="col-lg-6"><h5><?php echo $title;?></h5> </div>
                      </div>
                      </div>
					  
					  <form name="addform" method="POST" action="<?php echo site_url('Admin/save')?>" enctype="multipart/form-data">

                          <input type="hidden" name="id" id="id" value="<?php echo $letter->id; ?>">
                            <div class="card-body">
                               <div class="form-group row">
                                  <div class="col-lg-9">
                                      <label>Subject</label>
                                      <input type="text" name="subject"  placeholder="Subject" class="form-control" required value="<?php echo $letter->subject; ?>" />
                                  </div>
                                  <div class="col-lg-3">
                                      <label>Make Visible in Manage Block</label>
                                      <input type="checkbox" name="is_visible_block"  class="form-control" value="1" <?php if($letter->is_visible_block==1){ echo 'checked';}?> />
                                  </div>
                              </div>
                              <div class="form-group">
                                 <label>Enter Message</label>
                                  <textarea name="message"  id="message" rows="5" class="form-control">
                                  <?php echo $letter->message; ?></textarea>
                              </div>
                          </div>
                          <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a class="btn btn-light" href="<?php echo site_url('lettertemplates')?>">Back</a>
                          </div>
					  </form>

      <div class="box-body">
        <h4>Client Information</h4>
        <div class="col-md-12" style="border: 1px solid #ddd;">
          <div class="col-md-12">
            <div class="col-md-6">##FIRSTNAME## - Client Firstname</div>
            <div class="col-md-6">##MIDDLENAME##- Client Middlename</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##LASTNAME## - Client Last name</div>
            <div class="col-md-6">##MOBILE##- Client Mobile</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##EMAIL## - Client Email</div>
            <div class="col-md-6">##STATE##- Client State</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##CITY## - Client City</div>
            <div class="col-md-6">##ZIP##- Client Zip</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##DOB## - Client Date of Birth</div>
            <div class="col-md-6">##GENDER##- Client Gender</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##ADDRESS## - Client Address</div>
            <div class="col-md-6">##SSN##- Client SSN</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##MOTHERNAME## - Client  Client Mother Name</div>
            <div class="col-md-6">##PREVIOUSADDRESS##- Client Old Address</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##OLDCITY## - Client Old City</div>
            <div class="col-md-6">##OLDSTATE##- Client Old State</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##OLDZIP## - Client Old Zip</div>
            <div class="col-md-6">##OLDPAYMENT##- Client Old Monthly Payment</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##LICENSE## - Client License</div>
            <div class="col-md-6">##LICENSESTATE##- Client License Issue State</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##EXPIREDATE## - Client Expiry Date</div>
            <div class="col-md-6">##BANK##- Client primary bank</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##EMPLOYER## - Client Current Employer</div>
            <div class="col-md-6">##HOWLONG##- Client Employee How long</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##EMPADDRESS## - Client Employee address</div>
            <div class="col-md-6">##EMPCITY##- Client Employee City</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##EMPSTATE## - Client Emloyee State</div>
            <div class="col-md-6">##EMPZIP##- Client Employee Zip</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##EMPPHONE## - Client Employee phone</div>
            <div class="col-md-6">##EMPFAX##- Client Employee Fax</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##EMPEMAIL## - Client Employee Email</div>
            <div class="col-md-6">##EMPPOSITION##- Client Employee Position</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##HOURSALARY## - Client Employee Hour Salary</div>
            <div class="col-md-6">##EMPANNUAL##- Client Employee Annual</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##DATE## - Current Date</div>
            <div class="col-md-6">##TIME##- Current Time</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##PERSONAL## - Personal information</div>
            <div class="col-md-6">##CREDIT##- Credit  Inquiries</div>
          </div>
          <div class="col-md-12">
            <div class="col-md-6">##ACCOUNT## - Account History</div>
            <div class="col-md-6">##SIGN## - Account Signature</div>
          </div>
        </div>
      </div>
                    </div>
                  </div>
                </div>
              </div>
		   </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

<script src="https://cdn.ckeditor.com/4.9.2/full-all/ckeditor.js"></script>   
<script>
CKEDITOR.replace('message');
</script>     
