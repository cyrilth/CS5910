<h3>View/Change Your Major Here: </h3>
<?php if($this->session->flashdata('major')): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $this->session->flashdata('major'); ?></<p>
<?php endif; ?>
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'major','class'=>'form-horizontal'); 
	  echo form_open('studentCon/viewEditMajor', $attributes); ?>
<!--DropDown to Select Department-->
<p>
	<p>Select 1rst Major: </p> 
	<?php
		$options = array();
		
		foreach($getAllMajor as $row)
		{
			$options[$row->majorID] = $row->majorTitle; 
		}
		
		echo form_dropdown('major1',$options,$major['Major1']);
	?>
</p>	
<p>
	<p>Select 2nd Major: </p> 
	<?php
		$options = array();
		
		foreach($getAllMajor as $row)
		{
			$options[$row->majorID] = $row->majorTitle; 
		}
		
		echo form_dropdown('major2',$options,$major['Major2']);
	?>
</p>
<p>
	<p>Select Minor: </p> 
	<?php
		$options = array();
		
		foreach($getAllMinor as $row)
		{
			$options[$row->majorID] = $row->majorTitle; 
		}
		
		echo form_dropdown('minor',$options,$major['Minor']);
	?>
</p>  
<p>
	<?php	  $data = array('name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Update');
		  				
		  echo form_submit($data);
		  
	?>
</p>
<?php echo form_close();?>