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
<p><button type="button" class="btn btn-default" id="deleteButton" onclick="location.href='<?php echo base_url();?>common/viewCourseSection/<?php echo $getSchedule->SemesterCode;?>'">Go Back</button></p>