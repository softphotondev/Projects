  <?php include_once ('top_content.php'); ?>
   <h2 class="orderview-title"> Letters</h2>

   <br>


       <div class="table-responsive">
                    <table class="display" width="100%"  id="basic-1">
                      <thead>
                        <tr role="row">
                            <th>S.No</th>
                            <th>Experian</th>
                            <th>Equifax</th>
                            <th>Transunion</th>
                            <th>Create Date & Time</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                        <tbody>
      <?php 

      if($letters)
      {
      $k=1;
      foreach($letters as $key=>$Response)
      {
      $expname = explode('.',$Response->final_exprian_pdf);

      $equiname = explode('.',$Response->final_equifax_pdf);

      $transname = explode('.',$Response->final_trans_pdf);

      if($expname)
      {
      $name_date = explode('_', $expname[0]);
      $last_value = array_pop($name_date);
      $expdate =implode('_',$name_date).'_'.date('m/d/Y',$last_value);
      }


      if($equiname)
      {
      $name_date1 = explode('_', $equiname[0]);
      $last_value1 = array_pop($name_date1);
      $equidate =implode('_',$name_date1).'_'.date('m/d/Y',$last_value1);
      }

      if($transname)
      {
      $name_date2 = explode('_', $transname[0]);
     $last_value2 = array_pop($name_date2);
      $transdate =implode('_',$name_date2).'_'.date('m/d/Y',$last_value2);
      }

      $date = date('m/d/Y h:i:s A', strtotime($Response->datetime));

      ?>

      <tr>
      <td><?php echo $key+1; ?></td>
      <td>
      <?php if($Response->exprian_pdf!='') { ?> 

      <?php echo $expdate; ?>

      <i class="fa fa-print printpdf" aria-hidden="true" onclick="printimage('<?php echo $Response->exprian_pdf;  ?>')"></i>

<a href="<?php echo $Response->exprian_pdf; ?>" target="_blank"><i class="fa fa-eye view-eyes" aria-hidden="true"></i></a>
                <input type="checkbox"  name="which_letter[]"  value="Experian"> 


      <?php } ?>
      </td>

      <td>
      <?php if($Response->equifax_pdf!='') { ?> 
      <?php echo $equidate; ?>

      <i class="fa fa-print printpdf" aria-hidden="true" onclick="printimage('<?php echo $Response->equifax_pdf; ?>')"></i>

      <a href="<?php echo $Response->equifax_pdf; ?>" target="_blank"><i class="fa fa-eye view-eyes" aria-hidden="true"></i></a>

                <input type="checkbox"  name="which_letter[]"  value="equifax">
      
      <?php } ?>
      </td>

      <td>
      <?php if($Response->trans_pdf!='') { ?>
      <?php echo $transdate; ?>
      <i class="fa fa-print printpdf" aria-hidden="true" onclick="printimage('<?php echo $Response->trans_pdf;  ?>')"></i>

    <a href="<?php echo $Response->trans_pdf; ?>" target="_blank"><i class="fa fa-eye view-eyes" aria-hidden="true"></i>
                <input type="checkbox"  name="which_letter[]"  value="transunion">
      </a>
      <?php } ?>
      </td>

      <td><?php echo $date; ?></td>
      <td>

      	<a class="btn btn-danger btn-xs"  href="<?php echo base_url('order/deletereport/'.$Response->id) ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>

      </td>
      
      </tr>

      <?php $k++;  } }  ?>

      </tbody>
      </table>

                  </div>

<script type="text/javascript">

 function doconfirm()
{
  job=confirm("Are you sure to delete permanently?");
  if(job!=true)
  {
	return false;
  }
}


function printimage(img)
{
    var W = window.open(img);

    W.window.print();
}

</script>

  <?php include_once ('bottom_content.php');