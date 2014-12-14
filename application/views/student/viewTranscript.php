<h3>View Your Transcript Here:</h3>

<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'viewTranscript','class'=>'form-horizontal'); 
	  echo form_open('studentCon/viewTranscript', $attributes); ?>
<p>
	<p><strong>Select Semester: </strong></p> 
	<?php
		$options = array('0'=>"Please Select a Semester","-1"=>"View Cumulative Transcript");
		
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

<?php if(isset($getGradeTotal)) : ?>

<p>Credits Attempted: <?php echo $getGradeTotal['CreditsTaken'] ;?></p>
<p>Credits Earned: <?php echo $getGradeTotal['CreditsEarned'] ;?> </p>
<p>Total Grade Points: <?php echo $getGradeTotal['TotalPoints'] ;?> </p>
<p>Cumulative GPA: <?php echo $getGradeTotal['GPA'] ;?> </p>
<p>Class Standing: <?php echo $getGradeTotal['ClassStanding'] ;?> </p>

<?php endif; ?>

<?php if(isset($getAllGrades)) : ?>
<table class="table table-bordered table-striped table-hover" id="getAllGrades" width="50%" cellspacing="5" cellpadding="5">
	<tr>
		<th>Term</th>
		<th>Course</th>
		<th>Credits</th>
		<th>Final Grade</th>
	</tr>
	<?php foreach($getAllGrades as $row) : ?>
	<tr>
		<td><?php echo $row['Term'];?></td>
		<td><?php echo $row['Course'];?></td>
		<td><?php echo $row['Credit'];?></td>
		<td><?php echo $row['Grade'];?></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>

<?php if(isset($semGrade)) : ?>

<p>Credits Attempted: <?php echo $semGrade[count($semGrade)-1]['creditsAttempted'] ;?></p>
<p>Credits Earned: <?php echo $semGrade[count($semGrade)-1]['creditsEarned'] ;?> </p>
<p>rade Points: <?php echo $semGrade[count($semGrade)-1]['gradePoints'] ;?> </p>
<p>GPA: <?php echo $semGrade[count($semGrade)-1]['gradePoints']/ $semGrade[count($semGrade) - 1]['creditsEarned'];?> </p>

<table class="table table-bordered table-striped table-hover" id="getAllGrades" width="50%" cellspacing="5" cellpadding="5">
	<tr>
		<th>Term</th>
		<th>Course</th>
		<th>Credits</th>
		<th>Final Grade</th>
	</tr>
	<?php foreach($semGrade as $row) : ?>
	<tr>
		<td><?php echo $row['Term'];?></td>
		<td><?php echo $row['Course'];?></td>
		<td><?php echo $row['Credit'];?></td>
		<td><?php echo $row['Grade'];?></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>