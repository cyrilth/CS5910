<?php if(isset($success)): ?>
 	<p class="alert alert-dismissable alert-success"/><?php echo $success; ?></<p>
 <?php endif; ?>
 <p><button type="button" class="btn btn-default" id="deleteButton" onclick="location.href='<?php echo base_url();?>studentCon/addClass'">Go Back</button></p>