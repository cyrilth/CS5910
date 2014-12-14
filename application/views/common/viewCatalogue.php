<h3>List All Course</h3>
<table id="viewCatalogue" class="display nowrap dataTable dtr-inline" cellspacing="0" width="100%" >
	
	<thead>
		<tr>
			<th>Course Number</th>
			<th>Department Code</th>
			<th>Course Title</th>
			<th>Number of Credits</th>
			<th>PreReq</th>
		</tr>
	</thead>
	<?php if(isset($allCourseWPrereq)) : ?>
	<tbody>
		<?php foreach($allCourseWPrereq as $course) : ?>
		<tr>
			<td><?php echo $course['CourseNum'];?></td>
			<td><?php echo $course['DepartmentCode'];?></td>
			<td><?php echo $course['CourseTitle'];?></td>
			<td><?php echo $course['NumCredits'];?></td>		
			<td><?php echo $course['PreReq'];?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	<?php endif; ?>
</table>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css"/>
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function() {
        $('#viewCatalogue').DataTable();
         } );

	
</script>
