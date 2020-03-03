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

  <form name="addform" id="updateform" method="POST" action="<?php echo base_url('addclient'); ?>" enctype="multipart/form-data">

    <?php
      if(isset($users))
      {
        $usersdata = $users[0];

        $username = $usersdata->username;
        $email = $usersdata->email;
        $user_type = $usersdata->user_type;
        $first_name = $usersdata->first_name;
        $last_name = $usersdata->last_name;
        $phone = $usersdata->phone;
        $readonly= "disabled";
        $profile_image =$usersdata->profile_image;
        $ssn =$usersdata->ssn;
        $dob = $usersdata->dob;
        $address = $usersdata->address;
        $city = $usersdata->city;
        $userstate = $usersdata->state;
        $zipcode = $usersdata->zipcode;
        ?>
  <input type="hidden" name="user_id" value="<?php echo $usersdata->user_id; ?>" >
    <input type="hidden" name="password" value="<?php echo $usersdata->intial_password; ?>" >
    <input type="hidden" name="username_old" value="<?php echo $usersdata->username; ?>" >       
      <?php
      }
      else
      {
         $username =  $email=  $user_type =  $first_name= $last_name=  $phone=  $ssn=  $profile_image= $dob = $address =  $city =  $userstate = $readonly = $zipcode = '';
      }
      ?>

          <div class="row">

            <div class="col-md-4">
                          <div class="form-group">
                          <label>Username</label>
                         <input type="text" class="form-control"  autocomplete="off" name="username"  value="<?php echo $username; ?>" <?php echo $readonly; ?> required >
                          </div>
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" class="form-control" name="first_name"  value="<?php echo $first_name; ?>" required>
                          </div>
                          </div>

                          <div class="col-md-4">
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" class="form-control" name="last_name"   value="<?php echo $last_name; ?>" required>
                          </div>
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">
                          <label> Phone </label>
                          <input id="phone" name="phone" type="text" class="form-control" value="<?php echo $phone; ?>" required="" onkeypress="addDashesphone(this)" minlength="12" maxlength="12"></div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label> Email </label>
                              <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required="">
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label> Date of birth </label>
                              <input id="dob" name="dob" type="text" class="form-control" value="<?php echo $dob; ?>" data-date-format="DD/MM/YYYY" style="line-height:12px !important;" onkeypress="addDashesdob(this)">
                            </div>
                          </div>


                          <!--<div class="col-md-4">
                            <div class="form-group">
                              <label> SSN </label>
                              <input name="ssn" type="text" class="form-control" value="<?php //echo $ssn; ?>" maxlength="11" onkeypress="addDashesssn(this)" autocomplete="off" minlength="11" >
                            </div>
                          </div>-->
                         
                          <div class="col-md-4">
                            <div class="form-group">
                              <label> Current Address </label>
                              <input id="address" name="address" type="text" class="form-control" value="<?php echo $address; ?>" >
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label> City </label>
                              <input id="city" name="city" type="text" class="form-control" value="<?php echo $city; ?>" >
                            </div>
                          </div>

  
                          <div class="col-md-4">
                            <div class="form-group">
                              <label> State </label>
                              <select name="state" id="state" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option value="">Choose State</option>
                                <?php  if($state) { foreach($state as $stat) { ?>
                                <option value="<?php echo $stat->code; ?>" <?php echo($userstate==$stat->code)?'selected':''; ?>><?php echo $stat->name; ?></option>
                                <?php } } ?>                 
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label> Zip </label>
                              <input id="zipcode" name="zipcode" type="text" class="form-control" value="<?php echo $zipcode; ?>" onkeypress="return isNumberKey(event)" maxlength="5" minlength="5" >
                            </div>
                          </div>


                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" id="profile_image" name="profile_image">
                          </div>
                        </div>


                      <?php if(isset($profile_image) && !empty($profile_image)) { ?>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Profile Picture</label>
                            <div class="custom-file">
                              <img src="<?php echo $profile_image; ?>" width="100px;">
                              <input type="hidden" name="profile_image_old" value="<?php echo $profile_image; ?>">
                            </div>
                          </div>
                        </div>
                        <?php } ?>   

                        </div>


                <div class="clearfix"><br><br><br></div>
                <div class="col-md-12">
                <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </div>
          
          </form>
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

<script>
function isNumberKey(evt)
  {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode != 45  && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

     return true;
  }

function addDashesssn(f) {
  var r = /(\D+)/g,
  npa = '',
  nxx = '',
  last4 = '';
  f.value = f.value.replace(r, '');
  npa = f.value.substr(0, 3);
  nxx = f.value.substr(3, 2);
  last4 = f.value.substr(5, 4);
  f.value = npa + '-' + nxx + '-' + last4;
}

function addDashesphone(f) {
  var r = /(\D+)/g,
  npa = '',
  nxx = '',
  last4 = '';
  f.value = f.value.replace(r, '');
  npa = f.value.substr(0, 3);
  nxx = f.value.substr(3, 3);
  last4 = f.value.substr(6, 3);
  f.value = npa + '-' + nxx + '-' + last4;
}

function addDashesdob(f)
{
  var r = /(\D+)/g,
  npa = '',
  nxx = '',
  last4 = '';
  f.value = f.value.replace(r, '');
  npa = f.value.substr(0,2);
  nxx = f.value.substr(2,2);
  last4 = f.value.substr(4, 3);
  f.value = npa + '/' + nxx + '/' + last4;
}
</script>
