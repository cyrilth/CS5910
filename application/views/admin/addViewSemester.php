<h2>Add/View Semester</h2>
<p>Please fill out the form below to create a Semester</p>
<?php if($this->session->flashdata('addViewSemester')): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $this->session->flashdata('addViewSemester'); ?></<p>
<?php endif; ?>
<!--Display Errors-->
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'addViewSemester','class'=>'form-horizontal'); 
	  echo form_open('admin_register/addViewSemester', $attributes); ?>


<p>
	<p><strong>Select Term: </strong></p> 
	<?php
		$options = array(
						 'Fall' => "Fall Term",
						 'Spring' => "Spring Term",
						 'Summer'=> "Summer Term",
						 'Winter' => "Winter Term"
						);
		
		echo form_dropdown('term',$options);
	?>
</p>	

<p>
	<?php echo form_label('<strong>Year(####): </strong> '); ?>
	<?php  
	$data = array(
				  'name'  => 'year',
				  'value' => set_value('year')
				  );
	?>
	<?php echo form_input($data);?>
</p>

<p>
	<?php	  $data = array(
							'name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Register');
		  				
		  echo form_submit($data);
		  
	?>
</p>
<?php echo form_close();?>

<p><h3>List All Semester</h3></p>

<table class="table table-striped" id="semTable" width="50%" cellspacing="5" cellpadding="5">
	<tr>
		<th>Semester Code</th>
		<th>Term</th>
		<th>Year</th>
	</tr>
	<?php if(isset($allSemester)) : ?>
	<?php foreach($allSemester as $semester) : ?>
	<tr>
		<td><?php echo $semester->SemesterCode;?></td>
		<td><?php echo $semester->Term;?></td>
		<td><?php echo $semester->Year;?></td>
		
	</tr>
	<?php endforeach; ?>
	<?php endif; ?>
</table>