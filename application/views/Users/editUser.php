<h3>Edit User Info Here: </h3>

<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'viewEditSchedule','class'=>'form-horizontal'); 
	  echo form_open('admin_register/editUser/' . $userInfo->ID.'/'.$userInfo->Role, $attributes); ?>
<p>
	<button type="button" class="btn btn-default" id="deleteButton" onclick="location.href='<?php echo base_url();?>admin_register/viewEditUser/<?php echo $userInfo->Role;?>'">Go Back</button>
	
	<?php	  
		$data = array('name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Update');
		  				
		  echo form_submit($data);
		  
	?>
	
	<button type="button" class="btn btn-danger" onclick="deleteItem()">Delete</button>
	

</p> 
<?php echo form_close();?>
<script>
	function deleteItem()
	{
		if(confirm("Are you Sure?"))
		{
			location.href='<?php echo base_url();?>admin_register/deleteUser/<?php echo $userInfo->ID;?>';
			
		}
		return false;
	}
</script>