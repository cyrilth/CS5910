<h3>Add and Delete Course PreReq.</h3>
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'prereq','class'=>'form-inline'); 
	  echo form_open('admin_register/prereq', $attributes); ?>
<p>
	Select Course:
	<?php
		$options = array();
		foreach($allCourse as $course)
		{
			$options[$course->CourseID] = $course->CourseNum. " ".$course->DepartmentCode. " ".$course->CourseTitle . " | ID: ".$course->CourseID; 
		}
		
		echo form_dropdown('course',$options);
	?>
	


	Select Prerequisite: 
	<?php
		$options = array();
		foreach($allCourse as $course)
		{
			$options[$course->CourseID] = $course->CourseNum. " ".$course->DepartmentCode. " ".$course->CourseTitle . " | ID: ".$course->CourseID; 
		}
		
		echo form_dropdown('prereq',$options);
	?>
	
</p>
<p>
	<?php	  $data = array(
							'name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Add');
		  				
		  echo form_submit($data);
		  
	?>
</p>
<?php echo form_close();?>
<?php if(isset($getPrereq)) : ?>
<table id="viewPrereq" class="display nowrap dataTable dtr-inline" cellspacing="0" width="100%" >
	
	<thead>
		<tr>
			<th>Course Name</th>
			<th>Prereq Name</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($getPrereq as $course) : ?>
		<tr>
			<td><?php echo $course['courseNum']." ".$course['courseDepCode']." ".$course['courseTitle']." | ID: ".$course['courseID'] ;?></td>
			<td><?php echo $course['preqCourseNum']." ".$course['preqDepCode']." ".$course['preqCourseTitle']." | ID: ".$course['preqID'] ;?></td>
			<td><button type="button" class="btn btn-danger" onclick="deleteItem(<?php echo $course['courseID']; ?>,<?php echo $course['preqID']; ?>)">Delete</button></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>	
<?php endif; ?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css"/>
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
        $('#viewPrereq').DataTable();
         } );

	
	function deleteItem(courseID,prereqID)
	{
		if(confirm("Are you Sure?"))
		{
			location.href='<?php echo base_url();?>admin_register/deletePrereq/'+courseID+'/'+prereqID;
			
		}
		return false;
	}
</script>