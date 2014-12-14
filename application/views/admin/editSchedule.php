<h3>Edit Schedule Here:</h3>
 <?php if(isset($dataflash)): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $dataflash; ?></<p>
 <?php endif; ?>
 
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'viewEditSchedule','class'=>'form-horizontal'); 
	  echo form_open('admin_register/editSchedule/' . $getSchedule->CRN, $attributes); ?>
 


 
<P>Department: <?php echo $DepartmentCode ;?></P>
<p>CRN: <?php echo $getSchedule->CRN ;?></p>
<p>Course Number: <?php echo $getCourseBySecID->CourseNum ;?></p>
<p>Course Title: <?php echo $getCourseBySecID->CourseTitle;?></p>
<p>Course Section: <?php echo $getSchedule->Section;?></p>
<?php if(isset($preReq)):?>
<?php foreach($preReq as $req) : ?>
<p><?php echo "PreReq: ".$req['CourseNum']." ".$req['DepartmentCode']." ".$req["CourseTitle"] ;?></p>
<?php endforeach;?>
<?php else:?>
<p>There is no PreReq For this course.</p>
<?php endif ;?>

<p>
	<p>Select TimeSlot (*) : </p> 
	<?php
		$options = array('0'=>"Please Select a TimeSlot");
		$selected = $this->input->post('TimeSlotID');
		foreach($allTimeSlot as $row)
		{
			$options[$row->TimeSlotID] = $row->Time . " " . $row->Days; 
		}
		
		echo form_dropdown('TimeSlotID',$options,$getSchedule->TimeSlotID);
	?>
	
</p>
<p>
	<p>Select Location: </p> 
	<?php
		$options = array();
		$selected = $this->input->post('LocationID');
		foreach($allLocation as $row)
		{
			$options[$row->LocationID] = $row->Building . " Room:" . $row->Room . " Max Capacity:" . $row->MaxCapacity; 
		}
		
		echo form_dropdown('LocationID',$options,$getSchedule->LocationID,'id="selectLocation"');
	?>
	
</p>
<p>
	<?php echo form_label('Max Enrollment Allowed (*) : '); ?>
	<?php
	$data = array(
				  'name'  => 'MaxEnroll',
				  'id'	  => 'MaxEnroll',
				  'min'	  => '0',
				  'type'  => "number"
				  );
	?>
	<?php echo form_input($data);?> <b id="ShowMax"></b>
</p>
<p>
	<p>Select Faculty: </p> 
	<?php
		$options = array('0'=>"Please Select a Faculty");
		
		foreach($getAllFaculty as $row)
		{
			if($row->DepartmentCode == $DepartmentCode)
			{
				$options[$row->facultyID] = $row->First_Name . " " . $row->Last_Name . " ID: " . $row->facultyID; 
			}
		}
		
		echo form_dropdown('Faculty',$options,$getSchedule->FacultyID,'id="sortFaculty"');
	?>
	
</p>
<p>
	<button type="button" class="btn btn-default" id="deleteButton" onclick="location.href='<?php echo base_url();?>admin_register/viewEditSchedule/<?php echo $getSchedule->SemesterCode;?>'">Go Back</button>
	
	<?php	  $data = array('name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Update');
		  				
		  echo form_submit($data);
		  
	?>
	
	<button type="button" class="btn btn-danger" onclick="deleteItem()">Delete</button>
	

</p> 
<?php echo form_close();?>
<script>
	function locationChange()
	{
		var allLocation = <?php echo json_encode($allLocation); ?>;
		var selectedLocation = $("#selectLocation").val();
		var maxCapacity = allLocation[selectedLocation].MaxCapacity;
		document.getElementById('ShowMax').innerHTML = "Max Room Capacity: " + maxCapacity;
		document.getElementById('MaxEnroll').setAttribute("max",maxCapacity);
		document.getElementById('MaxEnroll').setAttribute("value",<?php echo $getSchedule->MaxEnroll;?>);
	}
	$("#selectLocation").change(locationChange);
	locationChange();
	
	function deleteItem()
	{
		if(confirm("Are you Sure?"))
		{
			location.href='<?php echo base_url();?>admin_register/deleteSchedule/<?php echo $getSchedule->CRN;?>';
			
		}
		return false;
	}
</script>