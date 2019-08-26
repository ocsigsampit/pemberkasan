<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$pageTitle; ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<script src="<?=base_url('assets/jquery-1.11.1.min.js');?>"></script>
	<script src="<?=base_url('assets/theScript.js');?>"></script>
	<script src="<?=base_url('assets/datatables/datatables.min.js');?>"></script>
	<script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
	<script src="<?=base_url('assets/app.min.js');?>"></script>
	<script src="<?=base_url('assets/easyautocomplete/jquery.easy-autocomplete.min.js');?>"></script>
	<script src="<?=base_url('assets/select2/js/select2.min.js');?>"></script>
	<script src="<?=base_url('assets/sweetalert2/sweetalert2.min.js');?>"></script>
	<script src="<?=base_url('assets/tablesorter/jquery.tablesorter.min.js');?>"></script>
	<script src="<?=base_url('assets/bsdatepicker/js/bootstrap-datepicker.min.js');?>"></script>
	<script src="<?=base_url('assets/icheck-1.x/icheck.min.js');?>"></script>
	
	<link rel="stylesheet" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>"><!--BOOTSTRAP-->
	<link rel="stylesheet" href="<?=base_url('assets/font-awesome/css/font-awesome.min.css');?>"><!--FONT AWESOME-->
	<link rel="stylesheet" href="<?=base_url('assets/ionicons/css/ionicons.min.css');?>"><!--FONT AWESOME-->
	<link rel="stylesheet" href="<?=base_url('assets/adminLTE/AdminLTE.min.css');?>">
	<link rel="stylesheet" href="<?=base_url('assets/adminLTE/skins/skin-blue.min.css');?>">
	<link rel="stylesheet" href="<?=base_url('assets/datatables/datatables.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/easyautocomplete/easy-autocomplete.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/easyautocomplete/easy-autocomplete.themes.min.css');?>">
	<link rel="stylesheet" href="<?=base_url('assets/select2/css/select2.min.css');?>">
	<link rel="stylesheet" href="<?=base_url('assets/sweetalert2/sweetalert2.css');?>">
	<link rel="stylesheet" href="<?=base_url('assets/bsdatepicker/css/bootstrap-datepicker.min.css');?>">
	<link rel="stylesheet" href="<?=base_url('assets/icheck-1.x/skins/all.css');?>"><!--iCHECK-->
    <link rel="stylesheet" href="<?=base_url('assets/icheck-1.x/skins/square/green.css');?>"><!--iCHECK-->
	<link rel="stylesheet" href="<?=base_url('assets/newStyle.css');?>">
	
	<script>
	var theSite = '<?php echo base_url();?>';
	</script>
</head>

<body class='hold-transition skin-blue sidebar-mini'>
<div class="wrapper">

	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="<?=site_url('pemberkasan/');?>" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b><span><img src="<?=base_url('/images/box2.png');?>"></span></b></span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>PEMBERKASAN</b></span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="glyphicon glyphicon-list"></span>
				<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<!-- Messages: style can be found in dropdown.less-->
					<li class="dropdown messages-menu">
						<!-- Menu toggle button -->
						<!--
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="glyphicon glyphicon-home"></i>
						<!-- <span class="label label-success">4</span> 
						</a>
						-->
						<ul class="dropdown-menu">
							<!-- <li class="header">You have 4562 messages</li> -->
							<li>
								<!-- inner menu: contains the messages -->
								<ul class="menu">
									<li><!-- start message -->
										<a href="#">
											<div class="pull-left">
												<!-- User Image -->
												<img src="depe" class="rounded-circle" alt="User Image">
											</div>
											<!-- Message title and timestamp -->
											<h4>
												Support Team
												<!-- <small><i class="fa fa-clock-o"></i> 5 mins</small> -->
											</h4>
											<!-- The message -->
											<!-- <p>Why not buy a new awesome theme?</p> -->
										</a>
									</li><!-- end message -->
								</ul><!-- /.menu -->
							</li>
							<!--<li class="footer"><a href="#">See All Messages</a></li>-->
						</ul>
					</li><!-- /.messages-menu -->

					<!-- Notifications Menu -->
					<li class="dropdown notifications-menu">
						<!-- Menu toggle button -->
						<!--
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="glyphicon glyphicon-star"></i>
						<!-- <span class="label label-warning">10</span>
						</a>
						-->
						<ul class="dropdown-menu">
							<!-- <li class="header">You have 10 notifications</li> -->
							<li>
								<!-- Inner Menu: contains the notifications -->
								<ul class="menu">
									<li><!-- start notification -->
										<a href="#">
										<!-- <i class="glyphicon glyphicon-star"></i> 5 new members joined today -->
										</a>
									</li><!-- end notification -->
								</ul>
							</li>
							<li class="footer"><a href="#">View all</a></li>
						</ul>
					</li>
					<!-- Tasks Menu -->
					<li class="dropdown tasks-menu">
						<!-- Menu Toggle Button -->
						<!--<a href="<?php//echo base_url();?>index.php/auth/logout" class="dropdown-toggle" data-toggle="dropdown">-->
						<a href="<?=base_url('/auth/logout');?>" onclick="return confirm('Log out?')">
							<i class="glyphicon glyphicon-off"></i>
							<!-- <span class="label label-danger">9</span> -->
						</a>
						<ul class="dropdown-menu">
							<!-- <li class="header">You have 9 tasks</li> -->
							<li>
								<!-- Inner menu: contains the tasks -->
								<ul class="menu">
									<li><!-- Task item -->
										<a href="#">
											<!-- Task title and progress text -->
											<h3>
												Design some buttons
												<small class="pull-right">20%</small>
											</h3>
											<!-- The progress bar -->
											<div class="progress xs">
												<!-- Change the css width attribute to simulate progress -->
												<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
													<span class="sr-only">20% Complete</span>
												</div>
											</div>
										</a>
									</li><!-- end task item -->
								</ul>
							</li>
							<li class="footer">
								<a href="#">View all tasks</a>
							</li>
						</ul>
					</li>
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">

						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<img src="<?php echo base_url().'/images/'.$this->session->userdata('depe');?>" class="user-image" alt="User Image">
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs"><?=$this->session->userdata('nama');?></span>
						</a>

						<ul class="dropdown-menu">

							<!-- The user image in the menu -->
							<li class="user-header">
								<img src="<?php echo base_url().'/images/'.$this->session->userdata('depe');?>" class="rounded-circle" alt="User Image">
								<p>
									<?//=$this->session->userdata('nama') //echo $this->session->userdata('level')=='1' ? "Administrator" : "Merely A User";?>
									<!--<small>Join since : <?//=$this->session->userdata('tgl_daftar');?></small>-->
								</p>
							</li>

							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="<?php //echo site_url();?>/<?php //echo $this->session->userdata('level')=='1' ? 'admin' : 'member';?>/setting_dp" class="btn btn-default btn-flat">Set Disp.Pic</a>
								</div>
								<div class="pull-right">
									<a href="<?php //echo base_url();?>index.php/admin/ganti_password" class="btn btn-default btn-flat">Change Password</a>
								</div>
							</li>

						</ul>

					</li>
					<!-- Control Sidebar Toggle Button -->
					<li>
						<a href="#" data-toggle="control-sidebar"><i class="glyphicon glyphicon-chevron-left"></i></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->