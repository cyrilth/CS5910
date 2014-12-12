<h3>Add/Delete Class</h3>
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'addClass','class'=>'form-horizontal'); 
	  echo form_open('studentCon/addClass', $attributes); ?>
<p>
	<p><strong>Select Semester: </strong></p> 
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
	<?php	  $data = array(
							'name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Submit');
		  				
		  echo form_submit($data);
		  
	?>
</p>
<?php echo form_close();?>
