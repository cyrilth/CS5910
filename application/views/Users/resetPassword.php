<h1>Reset Password Here: </h1>
 <?php if($this->session->flashdata('changePassword')): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $this->session->flashdata('changePassword'); ?></<p>
 <?php endif; ?>

<!--Display Errors-->
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'resetPassword','class'=>'form-horizontal'); 
	  echo form_open('users/resetPasswordByUser', $attributes); ?>
<!--Field: Old Password-->
<p>
	<?php echo form_label('Old Password: '); ?>
	<?php
	$data = array(
				  'name'  => 'oldpassword',
				  'value' => set_value('oldpassword')
				  );
	?>
	<?php echo form_password($data);?>
</p>
<!--Field: Password-->
<p>
	<?php echo form_label('New Password: '); ?>
	<?php
	$data = array(
				  'name'  => 'password',
				  'value' => set_value('password')
				  );
	?>
	<?php echo form_password($data);?>
</p>

<!--Field: Confirm Password-->
<p>
	<?php echo form_label('Confirm New Password: '); ?>
	<?php
	$data = array(
				  'name'  => 'confirm_password',
				  'value' => set_value('confirm_password')
				  );
	?>
	<?php echo form_password($data);?>
</p>

<!--Submit Button-->
<p>
	<?php	$data = array('name'   => 'submit',
		  				  'class'  => 'btn btn-primary',
		  				  'value'  => 'update');
		  				
		  echo form_submit($data);
	?>
</p>

<?php echo form_close();?>