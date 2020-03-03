<div class="page-body vertical-menu-mt"> 
      <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Individual column searching (text inputs) Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                        <div class="col-lg-3"> <h5><?php echo $title;?></h5> </div>
                          <div class="col-lg-9"> 
                            <ul class="menuBtn">
                              <?php if($title=='Manage Navigation') { ?>          
                              <li><a href="<?php echo base_url('addmenu'); ?>"> Add Menu </a></li>
                              <?php } else if($title=="User Types") { ?>
                              <li><a href="<?php echo base_url('addusertype'); ?>"> Add User Types  </a></li>
                              <?php } else if($title=="Broker List" || $title=="Client List" || $title=="User List") { ?> 
                              <li><a href="<?php echo base_url('adduser'); ?>"> Add Users  </a></li>
                              <?php } else if($title=="Status Manage List") { ?> 
                               <li><a href="<?php echo base_url('addstatus'); ?>"> Add Status  </a></li>
                              <?php } else if($title=="Service Manage") { ?> 
                              <li><a href="<?php echo base_url('addservice'); ?>"> Add Service  </a></li>     
                              <?php } else if($title=="Provider Manage") {  ?>
                              <li><a href="<?php echo base_url('addprovider'); ?>"> Add Provider  </a></li>
                          <?php } ?> 
                          
                          </ul>
                      </div>
                    </div>
				</div>
                  <div class="card-body">
                  	<form id="bulkdelete" method="post" action="<?php echo base_url('users/multidelete');?>">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                               <tr>
                                  <th><button class="btn btn-warning" type="button" data-original-title="btn btn-danger" title="" id="selectAll2">All</button></th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>Username</th>
                                  <th>Password</th>
                                  <th>Profile Login</th>
                                  <th>Email</th>
                                  <th>Role</th>
                                  <th>Referral Code</th>
                                  <th>Status</th>
                                  <th class="text-center">Actions</th>
                                </tr>
                        </thead>
                        <tbody>
                              <?php
                                if($users)
                                 {  
                                  $i=1;
                                     foreach($users as $key=>$user)
                                     {
                              ?>
                            <tr>
                              <td>
                              <input type="checkbox" name="ids[]" id="user_id" class="selectall" value="<?php echo $user->id; ?>"></td>
                              <td><?php echo ucfirst($user->first_name); ?></td>
                              <td><?php echo ucfirst($user->last_name); ?></td>
                              <td><?php echo $user->username; ?></td>
                              <td><span id="password_<?php echo $i; ?>" style="display:none;"><?php echo $user->intial_password; ?></span><a href="javascript:void();" onclick="showpassword('<?php echo $i; ?>')" title="Click Here to Show Password" id="hiddenpass_<?php echo $i; ?>">*******</a></td>
                              <td><a href="<?php echo site_url('users/clientlogin/'.$user->id);?>">Login</a></td>
                              <td><?php echo $user->email; ?></td>
                              <td><?php echo $roles[$user->user_type]; ?></td>
                              <td><?php echo $user->referal_code; ?></td>
                              <td><span class="badge badge-success"><?php echo $status[$user->status]; ?></span></td>
                              <td><a class="btn btn-success btn-xs" href="<?php echo base_url('adduser/'.$user->user_id); ?>" data-original-title="btn btn-danger btn-xs" title="">Edit</a>
                              <a class="btn btn-danger btn-xs"  href="<?php echo base_url('users/deleteuser/'.$user->user_id) ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>
                              </td>
                            </tr>
                            
                            <?php $i++;} } ?>
                      </tbody>
                      </table>
				   </div>
                   </form>
                  </div>
                </div>
              </div>
              <!-- Individual column searching (text inputs) Ends-->
            </div>
          </div>
          <!-- Container-fluid Ends-->
</div>

<script type="text/javascript">
function showpassword(id){
    if(id){
        $('#password_'+id).show();
        $('#hiddenpass_'+id).hide();
    }
}

 $('#selectAll2').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectall').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectall').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 

function valthisform()
{
    var count_checked = $("[name='ids[]']:checked").length; // count the checked rows
        if(count_checked == 0) 
        {
            alert("Please select atleast one checkbox");
            return false;
        }
        else
        {
					job=confirm("Are you sure to delete?");
					if(job!=true)
					{
					return false;
					}
        }
}
</script>

