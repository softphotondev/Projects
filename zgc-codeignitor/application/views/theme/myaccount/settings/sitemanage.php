<div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3><?php echo $title;?></h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
<ul class="menuBtn"><li><a href="<?php echo base_url('addsite'); ?>"> Add Site </a></li></ul>
</div></div></div>

                  <div class="card-body">
                    <div class="table-responsive">


                      <table class="display" id="1_wrapper_datatable">
                        <thead>
                                          <tr>
                              <th><button type="button" class="btn btn-success btn-xs" id="selectAll" >Select All</button></th>
                                  <th>Sitename</th>
                                  <th>Broker</th>
                                  <th>Username</th>
                                  <th>Password</th>
                                  <th>Site URL</th>
                                  <th>Site Email</th>
                                  <th>Site Phone</th>
                                  <th>SMS Mobile Phone</th>
                                  <th class="text-center">Actions</th>
                                  </tr>
                        </thead>


                              <tbody>
                <?php
                  if($site)
                   {
                       foreach($site as $key=>$sitelist)
                       {

                        $broker_name = $sitelist->first_name.' '.$sitelist->last_name;
                ?>
              <tr>
                  <td><input type="checkbox" class="account" name="userids[]" value="<?php echo $sitelist->user_id; ?>" /></td>
                <td><?php echo $sitelist->sitename; ?></td>

                <td><?php echo $broker_name; ?></td>

                <td><?php echo $sitelist->username; ?></td>

                <td><?php echo $sitelist->passworduser; ?></td>

                <td><?php echo $sitelist->domain; ?></td>

                <td><?php echo $sitelist->siteemail; ?></td>
                <td><?php echo $sitelist->sitephone; ?></td>
                <td><?php echo $sitelist->sms_mobile; ?></td>
                                 <td>
<a class="btn btn-success btn-xs" href="<?php echo base_url('editsite/'.$sitelist->id); ?>" data-original-title="btn btn-danger btn-xs" title="">Edit</a>


             <a class="btn btn-danger btn-xs"  href="<?php echo base_url('Setting/deletesite/'.$sitelist->id) ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>
                          </td>
              </tr>
              
              <?php } } ?>
              

            </tbody>

            <tfoot>
               <tr>
                       <th ><button type="button"  onclick="checkmessage()" class="btn btn-primary btn-xs">Send Message</button></th>

                                  <th>Sitename</th>
                                  <th>Broker</th>
                                  <th>Username</th>
                                  <th>Password</th>
                                  <th>Site URL</th>
                                  <th>Site Email</th>
                                  <th>Site Phone</th>
                                  <th>SMS Mobile Phone</th>
                                  <th class="text-center">Actions</th>
                                  </tr>

            </tfoot>



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


  <!-- Modal -->
  <div class="modal fade" id="myModal2222" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 class="modal-title">Sent Message</h2>
        </div>
        <div class="modal-body">
    <div id="loadmessage"></div>  
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


 <script type="text/javascript">
  $('#selectAll').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.account').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.account').prop('checked', true);
      $(this).addClass('checkedAll');
    }
});


function checkmessage()
{
if($("input:checked").length == 1)
{
    alert('Please checked atleast one');
}
else
{

  var message_to = $("input[name='userids[]']").map(function(){ if ($(this).prop('checked')==true){ return $(this).val();}}).get();
  
  $.post("<?php echo site_url('Setting/loadmessage')?>",{message_to: message_to},function(html) 
    {
    $('#loadmessage').html(html);
    $('#myModal2222').modal('show');
    }); 
} 
} 
 </script>       