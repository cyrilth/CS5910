<h1>View/Update Your Personal Info</h1>
 <?php if($this->session->flashdata('viewEditPersonalInfo')): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $this->session->flashdata('viewEditPersonalInfo'); ?></<p>
 <?php endif; ?>
<p>You are a/an: <?php echo $userInfo->Role; ?></p>
<p>Your Account ID: <?php echo $userInfo->ID; ?></p>
<p>Your DOB: <?php echo $userInfo->DOB; ?></p>
<p>Your SSN: <?php echo $userInfo->SSN; ?></p>
<!--Display Errors-->
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'viewEditPersonalInfo','class'=>'form-horizontal'); 
	  echo form_open('users/viewEditPersonalInfo', $attributes); ?>

<!--Field: First Name-->
<p>
	<?php echo form_label('First Name: '); ?>
	<?php
	$data = array(
				  'name'  => 'first_name',
				  'value' => $userInfo->First_Name
				  );
	?>
	<?php echo form_input($data);?>
</p>

<!--Field: Last Name-->
<p>
	<?php echo form_label('Last Name: '); ?>
	<?php
	$data = array(
				  'name'  => 'last_name',
				  'value' => $userInfo->Last_Name
				  );
	?>
	<?php echo form_input($data);?>
</p>
<!--Field: Username-->
<p>
	<?php echo form_label('Username: '); ?>
	<?php
	$data = array(
				  'name'  => 'username',
				  'value' => $userInfo->username
				  );
	?>
	<?php echo form_input($data);?>
</p>

<!--Field: Email-->
<p>
	<?php echo form_label('Email: '); ?>
	<?php
	$data = array(
				  'name'  => 'email',
				  'value' => $userInfo->Email
				  );
	?>
	<?php echo form_input($data);?>
</p>

<!--Field: Street-->
<p>
	<?php echo form_label('Street Address: '); ?>
	<?php
	$data = array(
				  'name'  => 'street',
				  'value' => $userInfo->Street
				  );
	?>
	<?php echo form_input($data);?>
</p>

<!--Field: City-->
<p>
	<?php echo form_label('City: '); ?>
	<?php
	$data = array(
				  'name'  => 'city',
				  'value' => $userInfo->City
				  );
	?>
	<?php echo form_input($data);?>
</p>

<!--Field: State-->
<p>
	<?php echo form_label('State (Ex: NY): '); ?>
	<?php
	$data = array(
				  'name'  => 'state',
				  'value' => $userInfo->State
				  );
	?>
	<?php echo form_input($data);?>
</p>

<!--Field: Zipcode-->
<p>
	<?php echo form_label('ZipCode: '); ?>
	<?php
	$data = array(
				  'name'  => 'zipcode',
				  'value' => $userInfo->Zipcode
				  );
	?>
	<?php echo form_input($data);?>
</p>

<!--Field: Tel-->
<p>
	<?php echo form_label('Tel (Enter Without Dashs)[Example: 1234567890]: '); ?>
	<?php
	$data = array(
				  'name'  => 'tel',
				  'value' => $userInfo->Tel
				  );
	?>
	<?php echo form_input($data);?>
</p>

<!--Submit Button-->
<p>
	<?php	  $data = array('name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Update');
		  				
		  echo form_submit($data);
	?>
</p>

<?php echo form_close();?>