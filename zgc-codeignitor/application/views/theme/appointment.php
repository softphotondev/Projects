<style>

#bookingform {
    background-color: #ffffff;
    margin: 0px auto;
    font-family: Raleway;
    padding: 20px;
    width: 100%;
}

.tab h2 { font-weight: 600;
    font-size: 25px;
    color: #1e73be;
    margin-bottom: 20px; }

.tab h3 {
	    font-weight: 600;
    font-size: 20px;
    margin-bottom: 20px;
}
.tab .form-group .form-control { border-radius:0px;}

.confirmAppointment address p { margin:0; padding:0;}
.confirmAppointment address { font-weight:600;}
.tab label { font-weight:600;}


/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<div class="page-wrapper grayBg contactus-page">
<div class="container">
<?php if ($this->session->flashdata('msg')) {  echo $this->session->flashdata('msg');  } ?>
<div class="col-lg-8 offset-lg-2">
<form id="bookingform" action="<?php echo base_url('appointment'); ?>" method="post">
 
  <!-- One "tab" for each step in the form: -->
    <h2> Schedule an appointment. </h2>
    <div class="frame-content">
	<div class="row">
		<div class="form-group col-lg-12">
			<label for="select-service"> Select Category? </label>
			<select id="category_id" class="custom-select" name="category_id" required="required" onchange="getService(this.value);">
				<option value="">Select Category</option>
				<?php
				   foreach($category as $getCategory)
				   {
				?>
					<option value="<?php echo $getCategory->id; ?>"><?php echo strtoupper($getCategory->cat_name); ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group col-lg-12">
			<label for="select-service"> What type of service? </label>
			<select id="service_id_schedule" class="custom-select" name="service_id">
				<option value="">Select Services</option>
			</select>
		</div>
		
		<div class="form-group col-lg-12">
			<label for="select-service"> Choose your appointment slot </label>
			
		</div>
		
		
		<div class="form-group col-lg-12">
			<button class="btn btn-block rzvy-big-block-btn" type="submit"><span class="fa fa-calendar-check-o"></span>Book Now</button>
		</div>
		
		
	  </div>
      </div>                 
 
</form>

</div>
</div>
<script>
function getService(categoryId){
	$.ajax({
		type: 'post',
		data: {
			'category_id': categoryId
		},
		url:"<?php echo site_url('service/getServiceList')?>",
		success: function (res) {
			$('#service_id_schedule').html(res);
			console.log(res);
		}
	});
}
</script>