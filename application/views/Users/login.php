<h3>Login Form</h3>
<?php if($this->session->userdata('logged_in')) : ?>
<p>You are logged in as <?php echo $this->session->userdata('username'); ?></p>
<!--Start Form-->
<?php $attributes = array(
							'id' 	=> 'logout_form',
							'class'	=> 'form-horizontal'
						  );
						  
	   echo form_open('users/logout', $attributes);
	   
	   //Submit Button
	   
	   $data = array(
	   				 'value'	=> "Logout",
	   				 'name'		=> "submit",
	   				 'class'	=> "btn btn-primary"
	   				 );
	   	echo form_submit($data);
	   	echo form_close();
	   	
?>
<p><a href="#"><u>View/Edit Your Personal Info.</u></a></p>
<?php else : ?>

<?php 

	
	$attributes = array('id'=> 'login_form','class'=>'form-horizontal'); 
	echo  form_open('users/login', $attributes);
?>

<p>
	<?php echo form_label('Username: '); 
		  $data = array('name'        => 'username',
		  				'placeholder' => 'Enter Username',
		  				'style' 	  => 'width:90%',
		  				'value' 	  => set_value('username'));
		  				
		  echo form_input($data);
	?>
</p>

<p>
	<?php echo form_label('Password: '); 
		  $data = array('name'        => 'password',
		  				'placeholder' => 'Enter Password',
		  				'style' 	  => 'width:90%',
		  				'value' 	  => set_value('password'));
		  				
		  echo form_password($data);
	?>
</p>

<p>
	 <?php	  $data = array('name'        => 'submit',
		  				    'class' 	  => 'btn btn-primary',
		  				    'value' 	  => 'Login');
		  				
		  echo form_submit($data);
	?>
</p>
<?php echo form_close();?>

<?php endif; ?>

