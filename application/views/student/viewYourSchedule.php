<p><h3>Your Schedule</h3></p>
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'viewYourSchedule','class'=>'form-horizontal'); 
	  echo form_open('studentCon/viewYourSchedule', $attributes); ?>
<p>
	<p><strong>Select Semester: </strong></p> 
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
	<?php	  $data = array(
							'name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Submit');
		  				
		  echo form_submit($data);
		  
	?>
</p>
<?php echo form_close();?>


<table class="table table-bordered table-striped table-striped " id="viewYourSchedule" width="50%" cellspacing="5" cellpadding="5">
<?php if(isset($viewReg)) : ?>
	<tr>
		<th>Time/Day</th>
		<th>Monday</th>
		<th>Tuesday</th>
		<th>Wednesday</th>
		<th>Thursday</th>
		<th>Friday</th>
	</tr>
	
	<tr>
		<td>8:40 AM - 10:10 AM</td>
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "1010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "1020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "1010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "1020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		<td></td>
		
	</tr>
	<tr>
		<td>10:20 AM - 11:50 AM</td>
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "2010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break; }else if($count1 == count($viewReg)){echo '<td>'.'</td>';};?>
		<?php $count1++;?>
		<?php endforeach; ?>
	
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "2020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "2010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';};?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "2020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';};?>
		<?php $count1++;?>
		<?php endforeach; ?>
		<td></td>
	</tr>
	<tr>
		<td>1:10 PM - 2:40 PM</td>
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "3010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "3020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "3010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "3020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		<td ></td>
	</tr>
	<tr>
		<td>2:50 PM - 4:20 PM</td>
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "4010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "4020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "4010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "4020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		<td></td>
	</tr>
	<tr>
		<td>4:30 PM - 6:00 PM</td>
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "5010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "5020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "5010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "5020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		<td></td>
	</tr>
	<tr>
		<td>6:10 PM - 7:40 PM</td>
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "6010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "6020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "6010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "6020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		<td></td>
	</tr>
	<tr>
		<td>7:50 PM - 9:20 PM</td>
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "7010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "7020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "7010"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		
		<?php $count1 = 1;?>
		<?php foreach($viewReg as $row) : ?>
		<?php if($row['timeslot']== "7020"){echo '<td>'.$row['Course']." " .$row['Location']. " ".$row['Faculty'].'</td>'; break;}else if($count1 == count($viewReg)){echo '<td>'.'</td>';} ;?>
		<?php $count1++;?>
		<?php endforeach; ?>
		<td></td>
	</tr>
	
<?php endif; ?>
</table>
