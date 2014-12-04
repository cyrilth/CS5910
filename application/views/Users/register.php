<h1>Register</h1>
 <?php if($this->session->flashdata('registeredByAdmin')): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $this->session->flashdata('registeredByAdmin'); ?></<p>
 <?php endif; ?>
<p>Please fill out the form below to create an account</p>
<!--Display Errors-->
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'reister_form','class'=>'form-horizontal'); 
	  echo form_open('users/register', $attributes); ?>

<!--Field: First Name-->
<p>
	<?php echo form_label('First Name: '); ?>
	<?php
	$data = array(
				  'name'  => 'first_name',
				  'value' => set_value('first_name')
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
				  'value' => set_value('last_name')
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
				  'value' => set_value('email')
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
				  'value' => set_value('username')
				  );
	?>
	<?php echo form_input($data);?>
</p>

<!--Field: Password-->
<p>
	<?php echo form_label('Password: '); ?>
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
	<?php echo form_label('Confirm Password: '); ?>
	<?php
	$data = array(
				  'name'  => 'confirm_password',
				  'value' => set_value('confirm_password')
				  );
	?>
	<?php echo form_password($data);?>
</p>

<!--Field: DOB-->
<p>
	<?php echo form_label('Date Of Birth (YYYY-MM-DD): '); ?>
	<?php
	$data = array(
				  'name'  => 'dob',
				  'id'    =>'datepicker',
				  'value' => set_value('dob')
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
				  'value' => set_value('ssn')
				  );
	?>
	<?php echo form_password($data);?>
</p>

<!--Field: Street-->
<p>
	<?php echo form_label('Street Address: '); ?>
	<?php
	$data = array(
				  'name'  => 'street',
				  'value' => set_value('street')
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
				  'value' => set_value('city')
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
				  'value' => set_value('state')
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
				  'value' => set_value('zipcode')
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
				  'value' => set_value('tel')
				  );
	?>
	<?php echo form_input($data);?>
</p>
<?php if($this->session->userdata('logged_in') &&  $this->session->userdata('role') == 'Admin') : ?>
<p>
	<p><strong>Select Role: </strong></p> 
	<?php
		$options = array(
						 'Guest' 	=> "Guest",
						 'Student' 	=> "Student",
						 'Faculty'	=> "Faculty",
						 'Admin' 	=> "Admin"
						);
		$selected = $this->input->post('role');
		echo form_dropdown('role',$options,$selected,'id="role"');
	?>
</p>
<div id="hideBySelection">
	<p>
		<p>Select Department: </p> 
		<?php
			$options = array();
			$selected = $this->input->post('DepartmentCode');
			foreach($results as $row)
			{
				$options[$row->DepartmentCode] = $row->DepartmentCode; 
			}
			
			echo form_dropdown('DepartmentCode',$options,$selected,'id="selectDepartment"');
		?>
	</p>
		<div id="hideByFaculty">
			<p>
				<p>Select Major: </p> 
				<?php
					$options = array(
									 'Guest' 	=> "Guest",
									 'Student' 	=> "Student",
									 'Faculty'	=> "Faculty",
									 'Admin' 	=> "Admin"
									);
					$selected = $this->input->post('major');
					echo form_dropdown('major',$options,$selected,'id="major"');
				?>
			</p>
			<p>
				<?php echo form_label('Hold (Leave Blank if no Hold): '); ?>
				<?php
				$data = array(
							  'name'  => 'hold',
							  'value' => set_value('hold'),
							  
							  );
				?>
				<?php echo form_input($data);?>
			</p>
		</div>
</div>
<?php endif; ?>
<!--Submit Button-->
<p>
	<?php	  $data = array('name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Register');
		  				
		  echo form_submit($data);
	?>
</p>

<?php echo form_close();?>

<script>
	$(document).ready(
		function()
		{
			toggleFields();
			$("#role").change(
				function ()
				{
					toggleFields();
				});
		});
		
	function toggleFields()
	{
		if($("#role").val() == "Guest" || $("#role").val() == "Admin")
		{		
			$("#hideBySelection").hide();
		}
		else if($("#role").val() == "Faculty")
		{
			
			$("#hideBySelection").show();
			$("#hideByFaculty").hide();
		}
		else
		{
			$("#hideBySelection").show();
			$("#hideByFaculty").show();		
		}
	}
	
	//Sort Major By Department
	function sortMajorByDepartment()
	{
		$('#major').empty();
		
		var selectedDep = $("#selectDepartment").val();
		var allMajor = <?php echo json_encode($major); ?>;
		var selectMajorID = $("#major");
		
		$.each(allMajor, function(index, val)
		{
			if(allMajor[index].DepartmentCode == selectedDep)
			{
				$('<option />',{value:allMajor[index].majorID,text:allMajor[index].majorTitle}).appendTo(selectMajorID);
			}
		});
	}
	$("#selectDepartment").change(sortMajorByDepartment);
	sortMajorByDepartment();
</script>