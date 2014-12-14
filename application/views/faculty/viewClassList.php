<h3>View Class List:</h3>
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'viewClassList','class'=>'form-horizontal'); 
	  echo form_open('facultyCon/viewClassList', $attributes); ?>
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

<h4>Your Class List For <?php  if(isset($semester)){echo $semester->Term." ". $semester->Year;}?>:</h4>
<?php if(isset($getRecord)) : ?>
<table class="table table-bordered table-striped table-hover" id="viewClassList" width="50%" cellspacing="5" cellpadding="5">
	<tr>
		<th>CRN</th>
		<th>Course Name</th>
		<th>Current Enrollment</th>
		<th>Max Enrollment</th>
		<th>Section</th>
		<th>View Class Roster</th>
	</tr>
	<?php foreach($getRecord as $row) : ?>
	<tr>
		<td><?php echo $row['CRN'];?></td>
		<td><?php echo $row['CourseName'];?></td>
		<td><?php echo $row['CurrentEnroll'];?></td>
		<td><?php echo $row['MaxEnroll'];?></td>
		<td><?php echo $row['Section'];?></td>
		<td><a href="<?php echo base_url();?>facultyCon/viewClassRoster/<?php echo $row["CRN"];?>/<?php echo $semester->SemesterCode;?>/<?php echo $row["CourseName"];?>/<?php echo $semester->Term." ". $semester->Year;?>"><button type="button" class="btn btn-info">View Class Roster</button></a></td>
		
		
	</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>