 <?php if($this->session->flashdata('registered')): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $this->session->flashdata('registered'); ?></<p>
 <?php endif; ?>
 
  <?php if($this->session->flashdata('login_success')): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $this->session->flashdata('login_success'); ?></<p>
 <?php endif; ?>
 
 <?php if($this->session->flashdata('login_failed')): ?>
 	<p class="alert alert-dismissable alert-danger"/><?php echo $this->session->flashdata('login_failed'); ?></<p>
 <?php endif; ?>
 
  <?php if($this->session->flashdata('logged_OUT_success')): ?>
 	<p class="alert alert-dismissable alert-success"/>
 	<?php echo $this->session->userdata('tempName'). ' ' . $this->session->flashdata('logged_OUT_success'); ?></<p>
 <?php endif; ?>
 
 <?php if($this->session->flashdata('noaccess')): ?>
 	<p class="alert alert-dismissable alert-danger"/><?php echo $this->session->flashdata('noaccess'); ?></<p>
 <?php endif; ?>
 
 
 
 <h1>Welcome to Galdiator Fighters College</h1>
 <p>Your Future Begins Here.</p>
 <p>Fill more stuff</p>