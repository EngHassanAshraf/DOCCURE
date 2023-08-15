<?php
	session_start();
	if(!isset($_SESSION["patientid"])){
		$_SESSION['error'] = "You Need To Login First";
		header("Location: login.php");
	
	} else{
	if(!isset($_SESSION['booked'])){
		header("Location: booking.php?doctorid={$_SESSION['doctorid']}");
	}else{
		include("inc/database-conn.php");
		$select_last_appt = "SELECT doctorid, apptdate, appttime FROM appointments ORDER BY id DESC LIMIT 1";
		$appt_data_selected = $database_conn->query($select_last_appt);
		if(!($appt_data_selected->num_rows==1)){
			header("Location: booking.php?doctorid={$_SESSION['doctorid']}");
		}else{
		foreach($appt_data_selected as $appt_data){
			$doctorid = $appt_data["doctorid"];

			$apptdate = $appt_data["apptdate"];
			$apptdate = explode('-',"$apptdate");

			$day = $apptdate[2];
			$monthNum = $apptdate[1];
			$year = $apptdate[0];
			
			$appttime = date( "h:i a" ,strtotime($appt_data["appttime"]));
			$monthName = date('M', mktime(0, 0, 0, $monthNum, 10));
			

		}

		$doc_selected = $database_conn->query("SELECT * FROM doctors WHERE doctorid=$doctorid");
		if(!($doc_selected->num_rows==1)){
			header("Location: ");
		}
		else{
			foreach($doc_selected as $doc_data){
				$firstname = $doc_data["firstname"];
				$lastname = $doc_data["lastname"];
			}
		}
	}
	}
}
?>

<!DOCTYPE html> 
<html lang="en">
	
<!-- doccure/booking-success.php  30 Nov 2019 04:12:16 GMT -->
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
									<li class="breadcrumb-item active" aria-current="page">Booking</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Booking</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content success-page-cont">
				<div class="container-fluid">
				
					<div class="row justify-content-center">
						<div class="col-lg-6">
						
							<!-- Success Card -->
							<div class="card success-card">
								<div class="card-body">
									<div class="success-cont">
										<i class="fas fa-check"></i>
										<h3>Appointment booked Successfully!</h3>
										<p>Appointment booked with <strong> Dr. <?=$firstname.' '.$lastname?> </strong><br> on <strong><?=$day .' '. $monthName . ' '. $year . ' ' . strtoupper($appttime)?>

										</strong></p>
										<a href="doctors.php" class="btn btn-primary view-inv-btn">Go To Doctors</a>
									</div>
								</div>
							</div>
							<!-- /Success Card -->
							
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
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

<!-- doccure/booking-success.php  30 Nov 2019 04:12:16 GMT -->
</html>