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
            
            <form action="<?php  echo base_url('status/save'); ?>" method="post"  >
              <?php
          if(isset($status))
          {
              $type =  $status->type;
              $status_name = $status->status_name;
              
              if($title!='Copy Status')
               {     
              ?>
  <input type="hidden" name="status_id" value="<?php echo $status->status_id; ?>" >             
              <?php
              }
          }
          else
          {
              $type =  $status_name ='';
          }
          ?>


           <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Type:</label>
                    <div class="col-lg-9">
                    <select class="form-control form-control-select2" name="type" required="required">
            <option value="" >--Select Type--</option>          
    <option value="order" <?php echo ($type!='' && $type=='order')?'selected':''; ?>>Order</option>
    <option value="payment" <?php echo ($type!='' &&  $type=='payment')?'selected':''; ?>>Payment</option>
    <option value="task" <?php echo ($type!='' &&  $type=='task')?'selected':''; ?>>Task</option>
    <option value="support" <?php echo ($type!='' &&  $type=='support')?'selected':''; ?>>Support</option>
                    </select>
                    </div>
                    </div>


                    <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Enter Status:</label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="status_name" value="<?php echo $status_name; ?>" required="required">
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
  