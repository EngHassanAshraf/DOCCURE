<?php
include("inc/database-conn.php");
session_start();

	if(!isset($_SESSION['doctorid'])){
		header("Location: index.php");
	}else if(!isset($_SESSION['doclogin'])){
		header("Location: index.php");
	}else{
		$doctorid = $_SESSION['doctorid'];
	
		$select_appt_query = "SELECT * FROM appointments WHERE doctorid=$doctorid AND status='pending'";
		$appt_count = "SELECT COUNT(id) AS apptnums FROM appointments WHERE doctorid=$doctorid  AND status='pending'";
		$total_pat_count = "SELECT COUNT(id) AS totalpat FROM appointments WHERE doctorid=$doctorid  AND status='confirmed'";

		$appt_selected = $database_conn->query($select_appt_query);
		
		$appt_counted = $database_conn->query($appt_count);
		$appt_counted = mysqli_fetch_assoc($appt_counted);
		$apptnums = $appt_counted['apptnums'];
		
		$pat_counted = $database_conn->query($total_pat_count);
		$pat_counted = mysqli_fetch_assoc($pat_counted);
		$totalpat = $pat_counted['totalpat'];

?>

<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/doctor-dashboard.php  30 Nov 2019 04:12:03 GMT -->
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
									<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Dashboard</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<!-- Profile Sidebar -->
						<?php include("inc/doctor-sidebar.php")?>
    					<!-- /Profile Sidebar -->
						
						<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="row">
								<div class="col-md-12">
									<div class="card dash-card">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12 col-lg-6">
													<div class="dash-widget dct-border-rht">
														<div class="circle-bar circle-bar1">
															<div class="circle-graph1" data-percent="<?=$totalpat?>">
																<img src="assets/img/icon-01.png" class="img-fluid" alt="patient">
															</div>
														</div>
														<div class="dash-widget-info">
															<h6>Total Patient</h6>
															<h3><?=$totalpat?></h3>
															<p class="text-muted">Till Today</p>
														</div>
													</div>
												</div>

												<div class="col-md-12 col-lg-6">
													<div class="dash-widget">
														<div class="circle-bar circle-bar3">
															<div class="circle-graph3" data-percent="<?=$apptnums?>">
																<img src="assets/img/icon-03.png" class="img-fluid" alt="Patient">
															</div>
														</div>
														<div class="dash-widget-info">
															<h6>Appoinments</h6>
															<h3><?=$apptnums?></h3>
															<p class="text-muted"><?=date('d, M Y')?></p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<h4 class="mb-4">Patient Appoinment</h4>
									<div class="appointments">
							
										<!-- Appointment List -->
										<?php
											foreach($appt_selected as $appt_data){
												$select_pat_query = "SELECT * FROM patients WHERE patientid={$appt_data['patientid']}";
												$pat_selected = $database_conn->query($select_pat_query);
												foreach($pat_selected as $pat_data){
													
										?>
										<div class="appointment-list">

											<div class="profile-info-widget">
												<a href="#" class="booking-doc-img">
													<img src="<?=$pat_data["image"]?>" alt="User Image">
												</a>
												<div class="profile-det-info">
													<h3><a href="#"><?=$pat_data["firstname"].' '.$pat_data["lastname"]?></a></h3>
													<div class="patient-details">
														<h5><i class="far fa-clock"></i> <?=date("d M Y",strtotime("{$appt_data['apptdate']}"))?>, <?=
														date("h:i a", strtotime($appt_data["appttime"]))
														?></h5>
														<h5><i class="fas fa-map-marker-alt"></i><?=$pat_data["state"].', '.$pat_data["country"]?></h5>
														<h5><i class="fas fa-envelope"></i><?=$pat_data["email"]?></h5>
														<h5 class="mb-0"><i class="fas fa-phone"></i><?=$pat_data["mobile"]?></h5>
													</div>
												</div>
											</div>
											<div class="appointment-action">
												<a href="acceptappt.php?apptid=<?=$appt_data['id']?>" class="btn btn-sm bg-success-light">
													<i class="fas fa-check"></i> Accept
												</a>
												<a href="canceledappt.php?apptid=<?=$appt_data['id']?>" class="btn btn-sm bg-danger-light">
													<i class="fas fa-times"></i> Cancel
												</a>
											</div>
										</div>
										<?php }} ?>
										<!-- /Appointment List -->
									
										
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
		
		<!-- Circle Progress JS -->
		<script src="assets/js/circle-progress.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/doctor-dashboard.php  30 Nov 2019 04:12:09 GMT -->
</html>

<?php } ?>