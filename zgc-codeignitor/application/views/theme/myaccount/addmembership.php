
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
                      
                      <?php if($page=='addmembership'){?>
					   <form action="<?php  echo base_url('product/saveMembership'); ?>" method="post" enctype="multipart/form-data">
                          <div class="card-body">
                              <div class="form-group">
                                <label class="col-lg-3 col-form-label">Title *</label>
                                <div class="col-lg-9">
                                  <div id="filediv" style="margin-bottom: 20px;">
                                <input class="form-control" name="title" type="text" required="required" />
                                </div>
                                </div>
                              </div>
                               <div class="form-group">
                                  <label class="col-lg-3 col-form-label">Plan</label>
                                  <div class="col-lg-9">
                                    <div id="filediv" style="margin-bottom: 20px;">
                                     <select name="user_type_id" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach($membershiplist as $getMembership){?>
                                         <option value="<?php echo $getMembership->user_type;?>"><?php echo $getMembership->user_type_name;?></option>
                                        <?php } ?>
                                     </select>
                                    </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-3 col-form-label">Price:</label>
                                <div class="col-lg-9">
                                  <div id="filediv" style="margin-bottom: 20px;">
                                    <input name="price" type="text" id="price" class="form-control" />
                                  </div>
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="col-lg-3 col-form-label">Billing Cycle:</label>
                                <div class="col-lg-9">
                                  <div id="filediv" style="margin-bottom: 20px;">
                                     <select name="billing_cycle" class="form-control">
                                        <option value="">Select</option>
                                         <option value="Monthly">Monthly</option>
                                         <option value="Yearly">Yearly</option>
                                     </select>
                                  </div>
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="col-lg-3 col-form-label">Super Tag:</label>
                                <div class="col-lg-9">
                                  <div id="filediv" style="margin-bottom: 20px;">
                                    <input name="super_tag" type="text" id="super_tag" class="form-control" />
                                  </div>
                                </div>
                              </div>
                               
                               <div class="form-group">
                                <label for="description">Feature</label>
                                 <div class="col-lg-9">
                                    <div id="filediv" style="margin-bottom: 20px;">
                                      <textarea class="form-control" name="feature" id="feature" rows="3"></textarea>
                                    </div>
                                 </div>
                              </div>
                               <div class="form-group">
                                  <label class="col-lg-3 col-form-label">Button Name:</label>
                                  <div class="col-lg-9">
                                    <div id="filediv" style="margin-bottom: 20px;">
                                      <input name="button_name" type="text" id="button_name" value="Get Started" />
                                    </div>
                                  </div>
                              </div>
                            
                          </div>
                          <div class="card-footer">
                              <button class="btn btn-primary" type="submit">Submit</button>
                              <input class="btn btn-light" type="reset" value="Cancel">
                          </div>
					  </form>
                      
                      <?php } else if($page=='editmembership'){ ?>
                             <form action="<?php  echo base_url('product/saveMembership'); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                            <input type="hidden" name="membership_plan_id" value="<?php echo $membership->membership_plan_id;?>" />
                              <div class="form-group">
                                <label class="col-lg-3 col-form-label">Title *</label>
                                <div class="col-lg-9">
                                  <div id="filediv" style="margin-bottom: 20px;">
                                <input class="form-control" name="title" type="text" required="required" value="<?php echo $membership->title;?>" />
                                </div>
                                </div>
                              </div>
                               <div class="form-group">
                                  <label class="col-lg-3 col-form-label">Plan</label>
                                  <div class="col-lg-9">
                                    <div id="filediv" style="margin-bottom: 20px;">
                                     <select name="user_type_id" class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach($membershiplist as $getMembership){?>
                                         <option value="<?php echo $getMembership->user_type;?>" <?php if($getMembership->user_type==$membership->user_type_id){ echo 'selected';}?>><?php echo $getMembership->user_type_name;?></option>
                                        <?php } ?>
                                     </select>
                                    </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-3 col-form-label">Price:</label>
                                <div class="col-lg-9">
                                  <div id="filediv" style="margin-bottom: 20px;">
                                    <input name="price" type="text" class="form-control" value="<?php echo $membership->price;?>" />
                                  </div>
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="col-lg-3 col-form-label">Billing Cycle:</label>
                                <div class="col-lg-9">
                                  <div id="filediv" style="margin-bottom: 20px;">
                                     <select name="billing_cycle" class="form-control">
                                        <option value="">Select</option>
                                         <option value="Monthly" <?php if($membership->billing_cycle=='Monthly'){ echo 'selected'; }?>>Monthly</option>
                                         <option value="Yearly" <?php if($membership->billing_cycle=='Yearly'){ echo 'selected'; }?>>Yearly</option>
                                     </select>
                                  </div>
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="col-lg-3 col-form-label">Super Tag:</label>
                                <div class="col-lg-9">
                                  <div id="filediv" style="margin-bottom: 20px;">
                                    <input name="super_tag" type="text" class="form-control" value="<?php echo $membership->super_tag;?>" />
                                  </div>
                                </div>
                              </div>
                               
                               <div class="form-group">
                                <label for="description">Feature</label>
                                 <div class="col-lg-9">
                                    <div id="filediv" style="margin-bottom: 20px;">
                                      <textarea class="form-control" name="feature" id="feature" rows="3"><?php echo $membership->feature;?></textarea>
                                    </div>
                                 </div>
                              </div>
                               <div class="form-group">
                                  <label class="col-lg-3 col-form-label">Button Name:</label>
                                  <div class="col-lg-9">
                                    <div id="filediv" style="margin-bottom: 20px;">
                                      <input name="button_name" type="text" value="<?php echo $membership->button_name;?>"  />
                                    </div>
                                  </div>
                              </div>
                            
                          </div>
                          <div class="card-footer">
                              <button class="btn btn-primary" type="submit">Update</button>
                          </div>
					  </form>
                        
                      <?php } else { ?>
                            <div class="table-responsive product-table">
                   <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">

                      <table class="display dataTable no-footer" id="basic-1" role="grid" aria-describedby="basic-1_info">
                        <thead>
                              <th>Title</th>
                              <th>Price</th>
                              <th>Billing Cycle</th>
                              <th>Super Tag</th>
                              <th class="text-center">Actions</th>
                        </thead>
                        <tbody>
                     <?php
                      if($membership){
                           foreach($membership as $response)
                           {
                            ?>
                          <tr role="row" class="odd">
                            <td><?php echo $response->title; ?></td>
                            <td><?php echo $response->price; ?></td>
                            <td><?php echo $response->billing_cycle; ?></td>
                            <td><?php echo $response->super_tag; ?></td>
                            <td>
                              <a class="btn btn-success btn-xs" href="<?php echo base_url('product/addmembership/'.$response->membership_plan_id); ?>" data-original-title="btn btn-danger btn-xs" title="">Edit</a>
                              <a class="btn btn-danger btn-xs"  href="<?php echo base_url('product/deletemembership/'.$response->membership_plan_id) ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>
                            </td>
                          </tr>
                    <?php } } ?>
                        </tbody>
                      </table>

                  </div>

				   </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
		   </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>    
 <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('feature');
</script>
