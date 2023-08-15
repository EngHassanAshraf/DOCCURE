<?php
session_start();
if (!isset($_GET['doctorid'])) {
	header("Location: patient-dashboard.php?patientid={$_SESSION['patientid']}");
} else {
	$doctorid = $_GET['doctorid'];

	include('inc/database-conn.php');
	$doc_selected = $database_conn->query("SELECT * FROM doctors WHERE doctorid=$doctorid");
	if (!($doc_selected->num_rows == 1)) {
		header("Location: ");
	} else {
		foreach ($doc_selected as $doc_data) {
			$firstname = $doc_data["firstname"];
			$lastname = $doc_data["lastname"];
			$image = $doc_data['image'];
			$country = $doc_data["country"];
			$pricing = $doc_data["pricing"];
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- doccure/booking.php  30 Nov 2019 04:12:16 GMT -->

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
		<div class="content">
			<div class="container">

				<div class="row">
					<div class="col-12">

						<div class="card">
							<div class="card-body">
								<div class="booking-doc-info">
									<a href="doctor-profile.php?doctorid=<?= $doctorid ?>" class="booking-doc-img">
										<img src="<?= $image ?>" alt="User Image">
									</a>
									<div class="booking-info">
										<h4><a href="doctor-profile.php?doctorid=<?= $doctorid ?>">Dr. <?= $firstname . ' ' . $lastname ?></a></h4>

										<p class="text-muted mb-3"><i class="fas fa-map-marker-alt"></i> <?= $country ?></p>
										<p class="doc-location">
											<i class="far fa-money-bill-alt"></i> <?= $pricing ?>
										</p>
									</div>
								</div>
							</div>
						</div>
						<form action="bookingappt.php" method="post">

							<div class="row">
								<div class="col-md-4">
									<div class="card">
										<div class="card-body">
											<h4>Choose your Appointment Price</h4>
											<input type="text" class="form-control" required name='price' placeholder="20">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card">
										<div class="card-body">
											<h4>Choose your Appointment Date</h4>
											<input type="date" class="form-control" required name='date'>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card">
										<div class="card-body">
											<h4>Choose your Appointment Time</h4>
											<input type="time" class="form-control" required name='time'>
										</div>
									</div>
								</div>
							</div>



							<!-- Schedule Widget -->

							<!-- /Schedule Widget -->

							<!-- Submit Section -->
							<div class="submit-section proceed-btn text-right">
								<button type="submit" class="btn btn-primary submit-btn">Make Appointment</button>
							</div>
							<!-- /Submit Section -->
						</form>
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

<!-- doccure/booking.php  30 Nov 2019 04:12:16 GMT -->

</html>