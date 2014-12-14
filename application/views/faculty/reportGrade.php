<h3>Report Grade For <?php echo "Name: ".$studName. " ID: ".$studID. " | ". $courseName." | ".$semName;?></h3>
<?php if($this->session->flashdata('updateGrade')): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $this->session->flashdata('updateGrade'); ?></<p>
 <?php endif; ?>
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'reportGrade','class'=>'form-horizontal'); 
	  echo form_open('facultyCon/reportGrade/'.$crn."/".$semID."/".$semName."/".$courseName."/".$studID."/".$studName, $attributes); ?>
<p>
	<p><strong>Select Midterm Grade: </strong></p> 
	<?php
		$options = array("TBA"=>"TBA","S"=>"Satisfactory","U"=>"Unsatisfactory");
		
		echo form_dropdown('midterm',$options,$midterm);
		
		
	?>
</p>
<p>
	<p><strong>Select Final Grade: </strong></p> 
	<?php
		$options = array(
						 "TBA"=>"TBA",
						 "A" =>"A",
						 "A-"=>"A-",
						 "B+"=>"B+",
						 "B"=>"B",
						 "B-"=>"B-",
						 "C+"=>"C+",
						 "C"=>"C",
						 "C-"=>"C-",
						 "D+"=>"D+",
						 "D"=>"D",
						 "W"=>"WithDrawn",
						 "F"=>"Failed",
						 "I"=>"InComplete",
						 "NG"=>"No Grade"
						 );
		
		echo form_dropdown('final',$options,$final);
		
		
	?>
</p>
<p>
	<button type="button" class="btn btn-default" id="deleteButton" onclick="location.href='<?php echo base_url();?>facultyCon/viewClassRoster/<?php echo $crn;?>/<?php echo $semID;?>/<?php echo $courseName;?>/<?php echo $semName;?>'">Go Back</button>
	<?php	  $data = array(
							'name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Submit');
		  				
		  echo form_submit($data);
		  
	?>
</p>
<?php echo form_close();?>