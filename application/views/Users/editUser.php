<h3>Edit User Info Here: </h3>

<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'viewEditSchedule','class'=>'form-horizontal'); 
	  echo form_open('admin_register/editUser/' . $userInfo->ID.'/'.$userInfo->Role, $attributes); ?>
	  
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

<!--Field: DOB-->
<p>
	<?php echo form_label('Date Of Birth (YYYY-MM-DD): '); ?>
	<?php
	$data = array(
				  'name'  => 'dob',
				  'id'    =>'datepicker',
				  'value' => $userInfo->DOB
				  );
	?>
	<?php echo form_input($data);?>
</p>

<!--Field: SSN-->
<p>
	<?php echo form_label('SSN (Enter without Dashs [Example: 123456789]: '); ?>
	<?php
	$data = array(
				  'name'  => 'ssn',
				  'value' => $userInfo->SSN
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

<?php if(!($studentInfo == NULL)) : ?>
<p>Credits Taken: <?php echo $studentInfo->CreditsTaken ;?></p>
<p>Creits Earned: <?php echo $studentInfo->CreditsEarned ;?></p>
<p>GPA: 		  <?php echo $studentInfo->GPA ;?></p>
<p>Total Points:  <?php echo $studentInfo->TotalPoints ;?></p>
<p>
	<?php echo form_label('Class Standing: '); ?>
	<?php 
	$data = array(
				  'name'  => 'class_standing',
				  'value' => $studentInfo->ClassStanding
				  );
	?>
	<?php echo form_input($data);?>
</p>
<p>
	<?php echo form_label('Hold: '); ?>
	<?php 
	$data = array(
				  'name'  => 'Hold',
				  'value' => $studentInfo->Hold
				  );
	?>
	<?php echo form_input($data);?>
</p>
<p>
	<?php echo form_label('Balance: '); ?>
	<?php 
	$data = array(
				  'name'  => 'Balance',
				  'value' => $studentInfo->balances
				  );
	?>
	<?php echo form_input($data);?>
</p>
<p>
	<p>Select Department: </p> 
	<?php
		$options = array();
		$selected = $studentInfo->DepartmentCode;
		foreach($DepCode as $row)
		{
			$options[$row->DepartmentCode] = $row->DepartmentCode; 
		}
		
		echo form_dropdown('DepartmentCode',$options,$selected,'id="selectDepartment"');
	?>
</p>
<?php endif; ?>
<p>
	<button type="button" class="btn btn-default" id="deleteButton" onclick="location.href='<?php echo base_url();?>admin_register/viewEditUser/<?php echo $userInfo->Role;?>'">Go Back</button>
	
	<?php	  
		$data = array('name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Update');
		  				
		  echo form_submit($data);
		  
	?>
	
	<button type="button" class="btn btn-danger" onclick="deleteItem()">Delete</button>
	

</p> 
<?php echo form_close();?>
<script>
	function deleteItem()
	{
		if(confirm("Are you Sure?"))
		{
			location.href='<?php echo base_url();?>admin_register/deleteUser/<?php echo $userInfo->ID;?>';
			
		}
		return false;
	}
</script>