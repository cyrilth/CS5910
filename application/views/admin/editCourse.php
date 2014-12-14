<h3>Edit Or Delete Course Here: </h3>
<?php if($this->session->flashdata('editCourse')): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $this->session->flashdata('editCourse'); ?></<p>
<?php endif; ?>
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'editCourse','class'=>'form-horizontal'); 
	  echo form_open('admin_register/editCourse/'.$courseID, $attributes); ?>
<!--DropDown to Select Department-->

<p>
	<p>Select Department: </p> 
	<?php
		$options = array();
		
		foreach($results as $row)
		{
			$options[$row->DepartmentCode] = $row->DepartmentCode; 
		}
		
		echo form_dropdown('DepartmentCode',$options,$courseByID->DepartmentCode);
	?>
</p>	  

<!--Course Num-->
<p>
	<?php echo form_label('Course Number: '); ?>
	<?php
	$data = array(
				  'name'  => 'CourseNum',
				  'value' => $courseByID->CourseNum
				  );
	?>
	<?php echo form_input($data);?>
</p>

<!--Course Title-->
<p>
	<?php echo form_label('Course Title: '); ?>
	<?php
	$data = array(
				  'name'  => 'CourseTitle',
				  'value' => $courseByID->CourseTitle
				  );
	?>
	<?php echo form_input($data);?>
</p>

<!--Number of Credits-->
<p>
	<?php echo form_label('Number of Credits: '); ?>
	<?php
	$data = array(
				  'name'  => 'NumCredits',
				  'value' => $courseByID->NumCredits
				  );
	?>
	<?php echo form_input($data);?>
</p>

<p>
	<button type="button" class="btn btn-default" id="deleteButton" onclick="location.href='<?php echo base_url();?>admin_register/viewCatalogue'">Go Back</button>
	<?php	  $data = array('name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Update');
		  				
		  echo form_submit($data);
		  
	?>
	<button type="button" class="btn btn-danger" onclick="deleteItem()">Delete</button>
</p>
<?php echo form_close();?>
<footer>(Please Note: To Edit Prerequisites Go to Prerequisit Management Under Course Management)</footer>
<script type="text/javascript">
	function deleteItem()
	{
		if(confirm("Are you Sure?"))
		{
			location.href='<?php echo base_url();?>admin_register/deleteCourse/<?php echo $courseID;?>';
			
		}
		return false;
	}
</script>