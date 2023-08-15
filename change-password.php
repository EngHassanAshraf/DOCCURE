<?php
	session_start();
	if(!isset($_SESSION['patientid']) || !isset($_SESSION['patlogin'])){
		$_SESSION['error'] = "You Need To Login First";
		header("Location: login.php");
	}else if(!isset($_GET['patientid'])){
		header("Location: doctor-dashboard.php?patientid={$_SESSION['patientid']}");
	}
	else if(isset($_GET['patientid']) && $_GET['patientid'] != $_SESSION['patientid']){
		$_SESSION['error'] = "YOUR ARE NOT ALLOWED";
		header("Location: login.php");
	}else{

?>
<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/change-password.php  30 Nov 2019 04:12:18 GMT -->
<head>
		<meta charset="utf-8">
		<title>Doccure</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
				<!-- Header -->
				<?php include("inc/header.php") ?>
				<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Change Password</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Change Password</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- error/conform area -->
			<?php if (isset($_SESSION['error'])) { ?>
			<div class="alert alert-danger text-center" role="alert">
				<?php
				echo $_SESSION['error'];
				?>
			</div>
			<?php } unset($_SESSION['error']);?>

			<?php if (isset($_SESSION['confirm'])) { ?>
			<div class="alert alert-success text-center" role="alert">
				<?php
				echo $_SESSION['confirm'];
				?>
			</div>
			<?php } unset($_SESSION['confirm']);?>
			<!-- /error/conform area -->

			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<!-- Sidebar -->
						<?php include("inc/patient-sidebar.php")?>
						<!-- Sidebar -->
						
						<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-lg-6">
										
											<!-- Change Password Form -->
											<form action="change-patient-password.php" method="POST">
												<div class="form-group">
													<label>Old Password</label>
													<input type="password" class="form-control" name='old-pat-password'>
												</div>
												<div class="form-group">
													<label>New Password</label>
													<input type="password" class="form-control" name='new-pat-password'>
												</div>
												<div class="form-group">
													<label>Confirm Password</label>
													<input type="password" class="form-control" name='conf-pat-password'>
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
												</div>
											</form>
											<!-- /Change Password Form -->
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>		
			<!-- /Page Content -->
   
		
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/change-password.php  30 Nov 2019 04:12:18 GMT -->
</html>
<?php } ?>