<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>GFC | College</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- Bootstrap -->
		
    <link href="<?php echo base_url();?>asset/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url();?>asset/css/bootstrap-responsive.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php echo base_url();?>asset/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link href="<?php echo base_url();?>asset/css/custom.css" rel="stylesheet">
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		<script>
 			$(function() {
    		$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd', 
    		   changeMonth: true,
    		   changeYear: true,
    		   yearRange: "-100:+0"});
  				});
  	</script>
		<link href="<?php echo base_url();?>asset/css/custom.css" type="text/css" rel="stylesheet"/>
	</head>
<body>
	
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?php echo base_url(); ?>">GFC | College</a>
          <div class="nav-collapse collapse">
          	<p class="navbar-text pull-right">
          		<!--Right Top Content-->
          		<?php if($this->session->userdata('logged_in')): ?>
          			Welcome, <?php echo $this->session->userdata('username'); ?>
          		<?php else : ?>
          		<a href="<?php echo base_url(); ?>users/register"> Register</a>
          		<?php endif; ?>
          	</p>
            <ul class="nav navbar-nav navbar-left">
              <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
              <?php if($this->session->userdata('logged_in') && $this->session->userdata('role') == 'Admin'): ?>
              <li class="dropdown">
              	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              		Course Management
              		<b class="caret"></b>
              	</a>
              	<ul class="dropdown-menu">
              		<li><a href="<?php echo base_url(); ?>admin_register/addCourse">Add Course</a></li>						
              		<li><a href="<?php echo base_url(); ?>admin_register/viewCatalogue">View/Edit Course </a></li>
              	</ul>
              </li>
              <li class="dropdown">
              	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              		Schedule Management
              		<b class="caret"></b>
              	</a>
              	<ul class="dropdown-menu">
              		<li><a href="<?php echo base_url(); ?>admin_register/addViewSemester">Add/View Semester</a></li>						
              		<li><a href="<?php echo base_url(); ?>admin_register/createSchedule">Create Schedule</a></li>
              		<li><a href="<?php echo base_url(); ?>admin_register/viewEditSchedule">View/Edit Schedule</a></li>
              	</ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  User Management
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url(); ?>users/register">Add User</a></li>            
                  <li><a href="<?php echo base_url(); ?>admin_register/viewEditUser">View/Edit User</a></li>
                </ul>
              </li>
              <?php endif;?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
    
  <div class="container-fluid">
  	<div class="row-fluid">
  		<div class="span2">
  			<div class="well sidebar-nav">
  				<div style="margin: 0 0 10px 10px">
  					<!--Sidebar Content-->
  					<?php $this->load->view('users/login'); ?>
  				</div>
  			</div><!--well sidebar-->
  		</div><!--span-->
  		
  		<div class="span10">
  			<!--main content-->
  			<?php $this->load->view($main_content); ?>
  		</div><!--span9-->
  	</div><!--row fluid-->
  	
  	<footer>
  		<p>&copy; GFC Copyright 2014</p>
  	</footer>
  </div> <!--container fluid-->	

</body>
</html>