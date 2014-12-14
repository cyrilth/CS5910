<h3>View Your Advisor Here: </h3>
<?php if(isset($getRecord)) : ?>
<table class="table table-bordered table-striped table-hover" id="advisor" width="50%" cellspacing="1" cellpadding="1">
	<tr>
		<th>Advisor</th>
		
	</tr>
	<?php foreach($getRecord as $row) : ?>
	<tr>
		<td><?php echo $row['Name'];?></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>