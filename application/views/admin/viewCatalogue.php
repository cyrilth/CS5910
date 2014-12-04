<h3>List All Course</h3>

<table id="viewCatalogue" class="display nowrap dataTable dtr-inline" cellspacing="0" width="100%" >
	
	<thead>
		<tr>
			<th>CRN</th>
			<th>Course Number</th>
			<th>Department Code</th>
			<th>Course Title</th>
			<th>Number of Credits</th>
			<th>PreReq. 1</th>
			<th>PreReq. 2</th>
			<th>PreReq. 3</th>
			<th>View/Edit</th>
		</tr>
	</thead>
	<?php if(isset($allCourse)) : ?>
	<tbody>
		<?php foreach($allCourse as $course) : ?>
		<tr>
			<td><?php echo $course->CRN;?></td>
			<td><?php echo $course->CourseNum;?></td>
			<td><?php echo $course->DepartmentCode;?></td>
			<td><?php echo $course->CourseTitle;?></td>
			<td><?php echo $course->NumCredits;?></td>
			<td><?php if($course->Prereq1==0){echo "None";}else{echo $course->Prereq1;}?></td>
			<td><?php if($course->Prereq2==0){echo "None";}else{echo $course->Prereq2;}?></td>
			<td><?php if($course->Prereq3==0){echo "None";}else{echo $course->Prereq3;}?></td>
			<td><a href="<?php echo base_url();?>admin_register/editCourse/<?php echo $course->CRN;?>">View/Edit</a></td>
			
		</tr>
		<?php endforeach; ?>
	</tbody>
	<?php endif; ?>
</table>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css"/>
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
        $('#viewCatalogue').DataTable();
         } );

	
</script>