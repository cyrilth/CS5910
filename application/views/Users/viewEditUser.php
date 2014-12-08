<h3>View/Edit User Information Here: </h3>
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'viewEditSchedule','class'=>'form-horizontal'); 
	  echo form_open('admin_register/viewEditUser', $attributes); ?>
<p>
	<p><strong>Select Role: </strong></p> 
	<?php
		$options = array(
							'0'		=> "Please Select a Role",
						 'Guest' 	=> "Guest",
						 'Student' 	=> "Student",
						 'Faculty'	=> "Faculty",
						 'Admin' 	=> "Admin"
						);
		
		if($this->input->post())
		{
			$selected = $this->input->post('role');
		}
		else
		{
			$selected = $pastRole;
		}
		echo form_dropdown('role',$options,$selected,'id="role"');
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

<?php if(isset($userInfo)) : ?>
<table id="viewEditUser" class="display tableBody" cellspacing="0" width="100%">
		
	    <thead>
	        <tr>
	            <th>ID</th>
	            <th>UserName</th>
	            <th>First Name</th>
	            <th>Last Name</th>
	            <th>DOB</th>
	            <th>View/Edit</th>
	            <th>Reset Password</th>
	        </tr>
	    </thead>
	   
	    
	    <tbody>
		   <?php foreach($userInfo as $user) : ?>
		      	<tr>
		      		<td><?php echo $user->ID;?></td>
		      		<td><?php echo $user->username;?></td>
		      		<td><?php echo $user->First_Name;?></td>
		      		<td><?php echo $user->Last_Name;?></td>
		      		<td><?php echo $user->DOB;?></td>
		      		<td><a href="<?php echo base_url();?>admin_register/editUser/<?php echo $user->ID;?>/<?php echo $userRole ;?>">View/Edit</a></td>
		      		<td><a href="<?php echo base_url();?>admin_register/ResetPassword/<?php echo $user->ID;?>">Reset Password</a></td>
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
        $('#viewEditUser').DataTable();
         } );

</script>