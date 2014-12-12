<h4>Input Course CRN # Here for <?php echo $semester->Term." ". $semester->Year;?>:</h4>
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'addCRN','class'=>'form-inline'); 
	  echo form_open('studentCon/addCRN/'.$semester->SemesterCode, $attributes); ?>
<p>
	<?php echo form_label(''); ?>
	<?php
	$data = array(
				  'name'  => 'course1',
				  'placeholder' => 'Enter CRN 1 Here',
				  'value' 	  => set_value('course1')
				  );
	?>
	<?php echo form_input($data);?>
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

<?php if(isset($getRecord)) : ?>
<table class="table table-striped" id="semTable" width="50%" cellspacing="5" cellpadding="5">
	<tr>
		<th>CRN</th>
		<th>CourseName</th>
		<th>Delete</th>
	</tr>
	<?php foreach($getRecord as $row) : ?>
	<tr>
		<td><?php echo $row['CRN'];?></td>
		<td><?php echo $row['CourseName'];?></td>
		<td><button type="button" class="btn btn-danger" onclick="deleteItem(<?php echo($row['regID']); ?>)">Delete</button></td>
		
	</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>
<script type="text/javascript">
	function deleteItem(regID)
	{
		if(confirm("Are you Sure?"))
		{
			location.href='<?php echo base_url();?>studentCon/deleteReg/'+regID;
			
		}
		return false;
	}
</script>