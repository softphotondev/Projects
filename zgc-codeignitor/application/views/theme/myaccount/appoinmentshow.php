<div class="page-body vertical-menu-mt">
          <!-- Container-fluid starts-->
          <div class="container-fluid">

            <div class="row">
<?php if ($this->session->flashdata('msg')) {  echo $this->session->flashdata('msg');  } ?>
<div class="summary-tab col-lg-8 offset-lg-2">
<h3>Appoinment Summary</h3>
</div>
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Appoinment List</h5>
                  </div>
                  <div class="card-body">
                  

                        <form id="bulkdelete" method="post" action="<?php echo base_url('status/multideleteappoinment'); ?>">
                   <table class="show-case" id="basic-1">
                        <thead>
                          <tr>
                            <th><button class="btn btn-warning" type="button" data-original-title="btn btn-danger" title="" id="selectsupport">Select All</button> </th>
                            <th>Service</th>
                            <th>Provider</th>
                            <th>Date & Time</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php

                             if($appointment)
                             {
                               foreach($appointment as $appoin)
                               {
                                 $date = date("m/d/Y", strtotime($appoin->datetime));
                                 $name = $appoin->firstname.' '.$appoin->lastname;

                                 $time1 = explode(':', $appoin->appointment_time);

                                 $session = (count($time1)>0 && $time1[0]>12)?'PM':'AM';
                             ?>
            <tr>
                             <td><input name="ids[]" class="selectsupport" type="checkbox" value="<?php echo $appoin->id; ?>"></td>
                        <td><?php echo $servicearray[$appoin->service_id]; ?></td>
                        <td><?php echo $providerarray[$appoin->provider_id]; ?></td>
                        <td><?php echo $date.' '.$appoin->appointment_time.' '.$session; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $appoin->email; ?></td>
                        <td><?php echo $appoin->phone; ?></td>

                            <td>
<select class="custom-select" name="priority" id="priority"  onclick="changeappoinstatus('<?php echo $appoin->id; ?>',this.value)">
<?php
if($status)
{
foreach ($status as $key => $value) 
{
?>
<option value="<?php echo  $key; ?>" <?php echo ($appoin->status==$key)?'selected':''; ?> ><?php echo  $value; ?></option>
<?php } } ?>
</select>
                            </td>
                           

                              <td>

              
                    <a onclick="appoinview('<?php echo $appoin->id;  ?>');" class="btn btn-success btn-xs" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">View</a>

                <a class="btn btn-danger btn-xs"  href="<?php echo base_url('status/deleteappoin/'.$appoin->id)  ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>  

                              </td>
                          </tr>

                        <?php } } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th><button class="btn btn-danger"  onclick="return valthisform()" type="submit" data-original-title="btn btn-danger" title="">Bulk Delete</button></th>
                            <th>Service</th>
                            <th>Provider</th>
                            <th>Date & Time</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
           </div>

        </form>


                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>



<!---pop up for task starts here--->
<div class="modal fade" id="exampleModalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
  <form name="addCMS" id="formupdate" method="POST" enctype="multipart/form-data" >
    <div id="loadedittask"></div>

    </form>
  </div>
</div>


    
<script type="text/javascript">
 $('#selectsupport').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectsupport').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectsupport').prop('checked', true);
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

function changeappoinstatus(appoinid,value)
{
  $.post("<?php echo base_url('status/changeappoinstatus'); ?>",{appoinid:appoinid,value:value},function(data) 
    {
         // $('#loadedittask').html(data);
          //$('#exampleModalupdate').modal('show');
    }); 
}


function appoinview(appoinid)
{
     $.post("<?php echo base_url('status/viewappoin'); ?>",{appoinid:appoinid},function(data) 
    {
          $('#loadedittask').html(data);
          $('#exampleModalupdate').modal('show');
    }); 
}
</script>

    