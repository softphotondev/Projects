<div class="page-wrapper grayBg contactus-page">
<div class="container">
<div class="row">
<div class="col-lg-8 col-0">
 <?php if ($this->session->flashdata('msg')) {  echo $this->session->flashdata('msg');  } ?> 
<div class="getintouchForm">	

<h3>Get in Touch</h3>
 <form role="form" method="POST"  action="<?php echo  base_url('site/contactus'); ?>">
<div class="form-row row">
<div class="col-lg-6 form-group">
<input id="contact-name" type="text" name="First_Name" class="form-control" required placeholder="First Name">
</div> <div class="col-lg-6 form-group">
<input id="contact-name" type="text" name="Last_Name" class="form-control" required placeholder="Last Name">
</div>
<div class="col-lg-6 form-group">
<input id="contact-email" type="email" name="Email_Address" class="form-control" required placeholder="Email Address">
</div>  
<div class="col-lg-6 form-group">
 <input id="contact-name" type="text" name="phone" class="form-control" required onKeypress="addDashesphone(this)" minlength="12" maxlength="12" placeholder="Phone">	
</div>  
<div class="col-lg-12 form-group">
 <textarea id="contact-message" name="message" data-constraints="@Required" class="form-control required" required  placeholder="Message"></textarea>
</div>
<div class="col-lg-12">
<button type="submit" class="btn-send" style="cursor: pointer;">Send</button>
<button type="reset" class="btnreset" style="cursor: pointer;">Reset</button>
</div>
</div>
</form>                
</div>
</div>
<?php /*?>
<div class="col-lg-4 addressRight col-0">
<address class="contact-info">
<h5>Headquarters</h5>
<p class="addressinfo"><?php echo sitename(); ?><br><?php echo siteaddress(); ?><br><?php echo sitefield('company_city'); ?> <?php echo sitefield('company_state'); ?> <?php echo sitefield('company_zip'); ?> </p>
<dl class="list-terms-inline">
<p>Telephone : <?php echo sitephone(); ?></p>
<p>E-mail : <a href="mailto:<?php echo siteemail(); ?>"> <?php echo siteemail(); ?> </a> </p>
</address>
</div>
<?php */ ?>
</div>
</div>
</div>
