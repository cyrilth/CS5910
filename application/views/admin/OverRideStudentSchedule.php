<h3>Add A course section to Student Schedule:</h3>
 <?php if($this->session->flashdata('OverRideStudentSchedule')): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $this->session->flashdata('OverRideStudentSchedule'); ?></<p>
 <?php endif; ?>
 <?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'OverRideStudentSchedule','class'=>'form-horizontal'); 
	  echo form_open('admin_register/OverRideStudentSchedule', $attributes); ?>
<p>
	<p><strong>Select Semester (*): </strong></p> 
	<?php
		$options = array('0'=>"Please Select a Semester");
		
		foreach($getSemester as $row)
		{
			$options[$row->SemesterCode] = $row->Term . " " . $row->Year; 
		}
		
		echo form_dropdown('semesterID',$options);
	?>
</p>	  
<p>
	<?php echo form_label('Student ID: '); ?>
	<?php
	$data = array(
				  'name'  => 'studentID',
				  'value' => set_value('studentID')
				  );
	?>
	<?php echo form_input($data);?>
</p>
<p>
	<?php echo form_label('CRN: '); ?>
	<?php
	$data = array(
				  'name'  => 'crn',
				  'value' => set_value('crn')
				  );
	?>
	<?php echo form_input($data);?>
</p>
	  <!--Submit Button-->
<p>
	<?php	  $data = array('name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Register');
		  				
		  echo form_submit($data);
	?>
</p>

<?php echo form_close();?>