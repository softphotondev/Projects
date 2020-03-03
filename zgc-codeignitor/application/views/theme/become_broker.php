<div class="page-wrapper grayBg becameBg">
<div class="container">
<div class="col-lg-8 offset-lg-2">
<div class="becomeBroker-content">
<h3>Become Broker</h3>
<p class="thankuText"> Thank you for your interest in becoming a broker.</p>
<p>Our broker program is completely white-labeled which means that everything is labeled with your business name, logo, phone, and more. All broker requests are not approved. We require brokers to do all prequalifying for their clients. Please fill out the form below to be contacted for our broker program.</p>
</div>

  <?php if ($this->session->flashdata('msg')) {  echo $this->session->flashdata('msg');  } ?>
<div class="blackBg">

<form role="form" name="become_broker" class="broker-form"  method="POST" action="<?php echo base_url('becomebroker')?>" onsubmit="return validatePassword();">
<div class="form-row">
<div class="col-lg-6 form-group">
<input type="text" name="teacher_fname" class="form-control" id="teacher_fname" placeholder="Firstname" required />
</div> <div class="col-lg-6 form-group">
<input type="text" name="teacher_lname" class="form-control" id="teacher_lname" placeholder="Lastname" required />
</div>
<div class="col-lg-6 form-group">
<input type="email" name="email" class="form-control" id="email" placeholder="Email" required />
</div>  
<div class="col-lg-6 form-group">
<input type="text" name="phone" class="form-control" id="phone" placeholder="Mobile No" required />
</div> 
<div class="col-lg-12 form-group">
<input type="text" name="companyname" class="form-control" id="companyname" placeholder="Company Name" required />
</div>    
<div class=col-lg-12>
<p class="subtitle"> PLEASE ANSWER THE FOLLOWING QUESTIONS. </p>
</div>        
<div class="col-lg-12 col-md-12 form-group">
How many protentional clients do you have per month?
<div class="row">
<div class="custom-control  col-lg-4 col-xs-6">
<input type="checkbox" id="customCheck" name="client" value="Yes" class="checkbox-custom"><span class="checkbox-custom-dummy"></span><label for="customCheck"> Less than 5 </label></div>
<div class="custom-control  col-lg-4 col-xs-6"><input type="checkbox" id="customCheck" name="client" value="No" class="checkbox-custom"><span class="checkbox-custom-dummy"></span>
<label for="customCheck1"> More than 5 </label></div> 
</div></div>
<div class="col-lg-12 col-md-12 form-group">
Do you work with CPN files?
<div class="row">
<div class="custom-control col-lg-4 col-xs-6">
<input type="checkbox" id="customCheck2" name="cpn" value="Yes" class="checkbox-custom"><span class="checkbox-custom-dummy"></span><label for="customCheck2"> Yes </label></div>
<div class="custom-control col-lg-4 col-xs-6">
<input type="checkbox" id="customCheck3" name="cpn" value="No" class="checkbox-custom"><span class="checkbox-custom-dummy"></span><label for="customCheck3"> No </label></div></div>
</div>
<div class="col-lg-12 col-md-12 form-group">
Do you know how to evaluate a credit report?
<div class="row">
<div class="custom-control  col-lg-4 col-xs-6">
<input type="checkbox" id="customCheck4" name="report" value="Yes" class="checkbox-custom"><span class="checkbox-custom-dummy"></span><label for="customCheck4"> Yes </label></div>
<div class="custom-control  col-lg-4 col-xs-6">
<input type="checkbox" id="customCheck5" name="report" value="No" class="checkbox-custom"><span class="checkbox-custom-dummy"></span><label for="customCheck5"> No </label></div></div></div>
<div class="col-lg-12 col-md-12 form-group">
Do you know how to screen client employment and income documents?
<div class="row">
<div class="custom-control col-lg-4 col-xs-6">
<input type="checkbox" id="customCheck6" name="income" value="Yes" class="checkbox-custom"><span class="checkbox-custom-dummy"></span>
<label for="customCheck6"> Yes </label></div>
<div class="custom-control col-lg-4 col-xs-6">
<input type="checkbox" id="customCheck7" name="income" value="No" class="checkbox-custom"><span class="checkbox-custom-dummy"></span><label for="customCheck7"> No </label>
</div></div></div>
<div class="col-lg-12 form-group">
<button type="submit" class="btn btn-primary btn-submit">Submit</button></div>
</div>            
</form>
</div>
</div>
</div>
</div>