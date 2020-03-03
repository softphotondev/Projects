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
            
            <form action="<?php  echo base_url('pages/saveMenu'); ?>" method="post"  >
              <?php
          if(isset($menu))
          {
              $menufield =  $menu->menu;
              $status = $menu->status;

              $parent_id = $menu->parent_id;
              $group_position = $menu->group_position;
              
              if($title!='Copy Menu')
               {     
              ?>
  <input type="hidden" name="id" value="<?php echo $menu->id; ?>" >             
              <?php
              }
          }
          else
          {
              $menufield =  $group_position ='';
              $status = $parent_id = '';
          }
          ?>
                    <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Enter Menu:</label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="menu" value="<?php echo $menufield; ?>" required="required">
                    </div>
                    </div>


                     <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Parent:</label>
                    <div class="col-lg-9">
                    <select class="form-control form-control-select2" name="parent_id" id="parent_id" required="required">
                    <option value="0" label="None">None</option>
                    <?php foreach($list as $pages) { ?>
                       <option value="<?php  echo $pages->id; ?>" label="<?php  echo $pages->title; ?>" <?php echo ($parent_id!='' && $parent_id==$pages->id)?'selected':''; ?> ><?php  echo $pages->title; ?></option>
                    <?php } ?>
                    </select>
                    </div>
                    </div>


                     <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Group:</label>
                    <div class="col-lg-9">
                    <select class="form-control form-control-select2" name="group_position" required="required">
                    <option value="0" <?php echo ($group_position!='' && $group_position==0)?'selected':''; ?>>Main</option>
                    <option value="1" <?php echo ($group_position!='' &&  $group_position==1)?'selected':''; ?>>Header</option>
                    <option value="2" <?php echo ($group_position!='' &&  $group_position==2)?'selected':''; ?>>Footer</option>
                    </select>
                    </div>
                    </div>
                    
                  <?php
                  if($title=='Update Menu')
               {  
                ?>
                    <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Status:</label>
                    <div class="col-lg-9">
                    <select class="form-control form-control-select2" name="status" required="required">
                    <option value="">--Select Status --</option>
                    <option value="1" <?php echo ($status!='' && $status==1)?'selected':''; ?>>Active</option>
                    <option value="0" <?php echo ($status!='' &&  $status==0)?'selected':''; ?>>Inactive</option>
                    </select>
                    </div>
                    </div>
                 <?php } ?>


                    <div class="card-footer">
                      <button class="btn btn-primary" type="submit">Submit</button>
                      <a class="btn btn-light" value="Cancel" href="<?php  echo base_url('getmenus'); ?>">Back</a>
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
  