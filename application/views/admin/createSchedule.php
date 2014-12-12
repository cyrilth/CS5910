<h3>Create Schedule for a Semester Here:</h3>
<?php if($this->session->flashdata('createSchedule')): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $this->session->flashdata('createSchedule'); ?></<p>
<?php endif; ?>
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'createSchedule','class'=>'form-horizontal'); 
	  echo form_open('admin_register/createSchedule', $attributes); ?>

<p>
	<p><strong>Select Semester (*): </strong></p> 
	<?php
		$options = array('0'=>"Please Select a Semester");
		
		foreach($getSemester as $row)
		{
			$options[$row->SemesterCode] = $row->Term . " " . $row->Year; 
		}
		
		echo form_dropdown('semesterID',$options);
	?>
</p>
<p>
	<p>Select Department (*) : </p> 
	<?php
		$options = array('0'=>"Please Select a Department");
		$selected = $this->input->post('DepartmentCode');
		foreach($allCourse as $row)
		{
			$options[$row->DepartmentCode] = $row->DepartmentCode; 
		}
		
		echo form_dropdown('DepartmentCode',$options,$selected,'id="selectDepartment"');
	?>
	
</p>


<p>
	<p>Select Course (*) : </p> 
	<?php
		$options = array('0'=>"Please Select a Course");
		
		echo form_dropdown('CourseID',$options,"",'id="sortCourse"');
	?>
</p>
<p>
	<p>Select TimeSlot (*) : </p> 
	<?php
		$options = array('0'=>"Please Select a TimeSlot");
		$selected = $this->input->post('TimeSlotID');
		foreach($allTimeSlot as $row)
		{
			$options[$row->TimeSlotID] = $row->Time . " " . $row->Days; 
		}
		
		echo form_dropdown('TimeSlotID',$options,$selected);
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
		
		echo form_dropdown('LocationID',$options, $selected,'id="selectLocation"');
	?>
	
</p>
<p>
	<p>Select Faculty: </p> 
	<?php
		$options = array('0'=>"Please Select a Faculty");
		$selected = $this->input->post('Faculty');
		
		echo form_dropdown('Faculty',$options,'','id="sortFaculty"');
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
	<p>Select Course Level (*) : </p> 
	<?php
		$options = array( '0'=>"Please Select a Course Level",'undergraduate' => "Undergraduate", 'graduate' => "Graduate");
		$selected = $this->input->post('courseLevel');
		echo form_dropdown('courseLevel',$options,$selected);
	?>
	
</p>
<p>
	<p>Select Section (*) : </p> 
	<?php
		$options = array( '001'=>"001",'002' => "002", '003' => "003");
		$selected = $this->input->post('Section');
		echo form_dropdown('Section',$options,$selected);
	?>
	
</p>
<p>
	<?php	  $data = array('name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Register');
		  				
		  echo form_submit($data);
		  
	?>
</p>
<?php echo form_close();?>
<script type="text/javascript">

	function sortCourseByDepartment()
	{
		$('#sortCourse').empty();
		$('#sortFaculty').empty();
		
		var selectedDep = $("#selectDepartment").val();
		var allCourseArray = <?php echo json_encode($allCourse); ?>;
		var selectionCourseID = $("#sortCourse");
		
		var allFacultyArray = <?php echo json_encode($getAllFaculty); ?>;
		var selectionFacultyID = $("#sortFaculty");
		$('<option />', {value: "0",text: "Please Select a Course"}).appendTo(selectionCourseID);
		$('<option />', {value: "0",text: "TBA"}).appendTo(selectionFacultyID);
		
		
		//Sort Courses By Department
		$.each(allCourseArray, function(index, val)
		{
			
			if(allCourseArray[index].DepartmentCode == selectedDep)
			{
				
				$('<option />', {value: allCourseArray[index].CourseID, text: allCourseArray[index].CourseNum + " "  + " " + allCourseArray[index].DepartmentCode + " " + allCourseArray[index].CourseTitle + " Course ID: " + allCourseArray[index].CourseID }).appendTo(selectionCourseID);
			}
		});
		
		
		//Sort Faculty By Department
		$.each(allFacultyArray, function(index, val)
		{
			if(allFacultyArray[index].DepartmentCode == selectedDep)
			{
				
				$('<option />', {value: allFacultyArray[index].facultyID, text: allFacultyArray[index].First_Name + " " + allFacultyArray[index].Last_Name + " ID: " + allFacultyArray[index].facultyID}).appendTo(selectionFacultyID);
			}	
		});		
	}
	$( "#selectDepartment" ).change( sortCourseByDepartment );
	sortCourseByDepartment();
	
	function locationChange()
	{
		
		
		var allLocation = <?php echo json_encode($allLocation); ?>;
		var selectedLocation = $("#selectLocation").val();
		var maxCapacity = allLocation[selectedLocation].MaxCapacity;
		document.getElementById('ShowMax').innerHTML = "Max Room Capacity: " + maxCapacity;
		document.getElementById('MaxEnroll').setAttribute("max",maxCapacity);
		document.getElementById('MaxEnroll').setAttribute("value",<?php echo $MaxEnroll;?>);
	}
	$("#selectLocation").change(locationChange);
	locationChange();
</script>