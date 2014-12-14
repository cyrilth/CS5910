<h3>Pay Your Balance Here:</h3>
<?php if($this->session->flashdata('viewPayBalance')): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $this->session->flashdata('viewPayBalance'); ?></<p>
<?php endif; ?>

<p>Your Current Balance: <?php echo $getBalance;?></p>

<?php if($getBalance>0): ?>
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger"/>');

	  $attributes = array('id'=> 'viewPayBalance','class'=>'form-horizontal'); 
	  echo form_open('studentCon/viewPayBalance', $attributes); ?>

<p>
	<?php echo form_label('Enter Ammount (To pay): '); ?>
	<?php
	$data = array(
				  'name'  => 'balance',
				  'value' => set_value('balance')
				  );
	?>
	<?php echo form_input($data);?>
</p>
	  <!--Submit Button-->
<p>
	<?php	  $data = array('name'   => 'submit',
		  					'class'  => 'btn btn-primary',
		  					'value'  => 'Pay');
		  				
		  echo form_submit($data);
	?>
</p>

<?php echo form_close();?>
<?php endif; ?>