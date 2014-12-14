<h3>Class Roster For: </h3>
<?php if(isset($preInfo)) :?>
<h5><?php echo "CRN: ".$preInfo['CRN']. " | Course Name: " .$preInfo['CourseName']. " | For ". $preInfo['SemName'] ;?></h5>
<?php endif ;?>

<?php if(isset($reg)) :?>
<table class="table table-bordered table-striped table-hover" id="viewClassRoster" width="50%" cellspacing="5" cellpadding="5">
	<tr>
		<th>Student ID</th>
		<th>Student Name</th>
		<th>Midterm Grade</th>
		<th>Final Grade</th>
		<th>Report Grade</th>
	</tr>
	<?php foreach($reg as $row) : ?>
	<tr>
		<td><?php echo $row['StudentID'];?></td>
		<td><?php echo $row['Name'];?></td>
		<td><?php echo $row['midtermGrade'];?></td>
		<td><?php echo $row['courseGrade'];?></td>
		<td><a href="<?php echo base_url();?>facultyCon/reportGrade/<?php echo $preInfo["CRN"];?>/<?php echo $preInfo["SemID"];?>/<?php echo $preInfo["SemName"];?>/<?php echo $preInfo["CourseName"];?>/<?php echo $row['StudentID'];?>/<?php echo $row['Name'];?>"><button type="button" class="btn btn-info">Report Grade</button></a></td>
		
		
	</tr>
	<?php endforeach; ?>
</table>
<?php endif ;?>