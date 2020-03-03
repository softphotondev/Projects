  <?php
  $name = $appointment->firstname.' '.$appointment->lastname;
  $date = date("m/d/Y", strtotime($appointment->datetime));
  $time1 = explode(':', $appointment->appointment_time);
  $session = (count($time1)>0 && $time1[0]>12)?'PM':'AM';
  ?>
        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> View Appoinment </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            
        <div class="form-group">
        <label for="name"> Service  :  <?php echo $servicearray[$appointment->service_id]; ?> </label>
        </div>


        <div class="form-group">
        <label for="name"> Provider  :  <?php echo $providerarray[$appointment->provider_id]; ?> </label>
        </div>

         <div class="form-group">
        <label for="name"> Date & Time  :  <?php echo $date.' '.$session; ?> </label>
        </div>


         <div class="form-group">
        <label for="name"> Name  :  <?php echo $name; ?> </label>
        </div>

         <div class="form-group">
        <label for="name"> Address  :  <?php echo $appointment->address; ?> </label>
        </div>

         <div class="form-group">
        <label for="name"> City  :  <?php echo $appointment->city; ?> </label>
        </div>


 <div class="form-group">
        <label for="name"> Email  :  <?php echo $appointment->email; ?> </label>
        </div>


         <div class="form-group">
        <label for="name"> Zip code  :  <?php echo $appointment->zip_code; ?> </label>
        </div>


         <div class="form-group">
        <label for="name"> Phone  :  <?php echo $appointment->phone; ?> </label>
        </div>


 <div class="form-group">
        <label for="name"> Notes :  <?php echo $appointment->notes; ?> </label>
        </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        </div>
        </div>
