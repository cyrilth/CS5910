<h3>View Advisement List Here: </h3>
<table id="viewAdvisementList" class="display nowrap dataTable dtr-inline" cellspacing="0" width="100%" >
	
	<thead>
		<tr>
			<th>Student ID</th>
			<th>StudentName</th>
			<th>Advisor</th>
		</tr>
	</thead>
	<?php if(isset($advisor)) : ?>
	<tbody>
		<?php foreach($advisor as $row) : ?>
		<tr>
			<td><?php echo $row['StudentID'];?></td>
			<td><?php echo $row['StudentName'];?></td>
			<td><?php echo $row['Advisor'];?></td>
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
        $('#viewAdvisementList').DataTable();
         } );

	
</script>