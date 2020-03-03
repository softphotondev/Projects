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
 <ul class="menuBtn">
<li><a href="<?php echo base_url('addfaq'); ?>">Add Faq</a></li><li><a href="<?php echo base_url('manageques'); ?>">FAQ Question Type</a></li><li><a href="<?php echo base_url('addquestype'); ?>">Add FAQ Question Type </a></li>
				</ul>
</div></div></div>
				  
				  
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                                        <tr>
                                                    <th>S.No</th>
                                                    <th>Type</th>
                                                    <th>Title</th>
                                                    <th>Sort Order</th>
                                                    <th>Action</th>
                                                </tr>
                        </thead>


                                                                   <tbody>
                                                 <?php

                                                 if($faqbroker)
                                                   {
  foreach($faqbroker as $key=>$values)
  {
      
      
      
        $order = 'id'.'  '.'desc';
        $where = array('type'=>$values->type);
        $faqbrokernew = $this->Basic->getmultiplerow($order,$where,'faqbroker');
        
      $where = array('id'=>$values->type);
      $faqbrokerquestype = $this->Basic->getsinglerow($where,'faqbrokerquestype');
      
      
    $sortorder = $values->sort;
?>
<tr>
<td><?php echo $key+1; ?></td>
<td><?php echo $faqbrokerquestype->title; ?></td>
<td><?php echo $values->title; ?> </td>
<td>
<select class="form-control" required="" id="sortorder_<?php echo $values->id; ?>" name="sortorder" onchange="changeorder(this.value,'<?php echo $values->id; ?>','<?php echo $values->type; ?>')">
<option value="">--Select Order--</option>
<?php for($i=1;$i<=count($faqbrokernew);$i++) { ?>
<option value="<?php echo $i; ?>" <?php echo ($sortorder==$i)?'selected':''; ?>><?php echo $i; ?></option>
<?php } ?>
</select>
</td>
                            
<td>
<a  href="<?php echo site_url();?>Faq/editfaq/<?php echo $values->id ?>" class="btn btn-success btn-xs">Edit </a>
<a class="btn btn-danger btn-xs" href="<?php echo site_url();?>Faq/deletefaq/<?php echo $values->id ?>" onclick="return doconfirm()" >
<i class="fa fa-trash" aria-hidden="true"></i> Delete </a>
</td>
                                                </tr>
                                          <?php } } ?>     
                                            </tbody>



                      </table>
				   </div>
                  </div>
                </div>
              </div>
              <!-- Individual column searching (text inputs) Ends-->
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>



<script>
function isActive(text)
{
  //alert("OK"+text);
  job=confirm("Are you sure to "+text+" ?");
  if(job != true)
  {
    return false;
  }
}

function changeorder(value,id,type)
{
   $.post("<?php echo base_url(); ?>Faq/updateorder",{value:value,id:id,type:type},function(data) 
    {
        var data1 = data.split('--');
        $('#sortorder_'+data1[0]).val(data1[1]);
    });
}


</script>        