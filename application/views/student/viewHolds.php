<h3>View Your Holds Here: </h3>

<?php if($holds == "None" || $holds == "NULL") :?>
<p>You Currently Do not have any Holds.</p>
<?php else :?>
<P>Holds: <?php echo $holds?></P>
<?php endif;?>