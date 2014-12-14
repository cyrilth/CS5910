<?php if(isset($dataFlash)): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $dataFlash; ?></<p>
<?php endif; ?>
<h3>View Course Schedule</h3>
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'viewCourseSection','class'=>'form-horizontal'); 
	  echo form_open('common/viewCourseSection', $attributes); ?>

<p>
	<p><strong>Select Semester: </strong></p> 
	<?php
		$options = array('0'=>"Please Select a Semester");
		
		foreach($getSemester as $row)
		{
			$options[$row->SemesterCode] = $row->Term . " " . $row->Year; 
		}
		
		echo form_dropdown('semesterID',$options,isset($past) ? $past :$this->input->post("semesterID"));
		
		
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
<?php if(isset($sectionBySem)) : ?>
<table id="viewCourseSectionTable" class="display tableBody" cellspacing="0" width="100%">
	    <thead>
	        <tr>
	            <th>CRN</th>
	            <th>Course Number</th>
	            <th>Department</th>
	            <th>Course Title</th>
	            <th>Time</th>
	            <th>Days</th>
	            <th>Location</th>
	            <th>Faculty</th>
	            <th>Max Enroll</th>
	            <th>Cur Enroll</th>
	            <th>Level</th>
	            <th>Section</th>
	            <th>View PreReq</th>
	        </tr>
	    </thead>
	   
	    
	    <tbody>
		   <?php foreach($sectionBySem as $section) : ?>
		      	<tr>
		      		<td><?php echo $section["CRN"];?></td>
		      		<td><?php echo $section["CourseNUM"];?></td>
		      		<td><?php echo $section["DepartmentCode"];?></td>
		      		<td><?php echo $section["CourseTitle"];?></td>
		      		<td><?php echo $section["Time"];?></td>
		      		<td><?php echo $section["Days"];?></td>
		      		<td><?php echo $section["Location"];?></td>
		      		<td><?php echo $section["Faculty"];?></td>
		      		<td><?php echo $section["MaxEnroll"];?></td>
		      		<td><?php echo $section["CurentEnroll"];?></td>
		      		<td><?php echo $section["Level"];?></td>
		      		<td><?php echo "00".$section["Section"];?></td>
		      		<td><a href="<?php echo base_url();?>common/viewPrereq/<?php echo $section["CRN"];?>">View Prereq</a></td>
		      	</tr>
		   <?php endforeach; ?>
	    </tbody>
</table>

<?php endif; ?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css"/>
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
        $('#viewCourseSectionTable').DataTable();
         } );

</script>