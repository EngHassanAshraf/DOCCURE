<?php
session_start();
if(!isset($_SESSION["doctorid"])){
	$_SESSION['error'] = "You Need To Login First";
    header("Location: login.php");
} else{
	include("inc/database-conn.php");
	$doctorid = $_SESSION['doctorid'];
	$confirmed_appts_query = "SELECT * FROM appointments WHERE doctorid=$doctorid  AND status='confirmed'";
	$appt_selected = $database_conn->query($confirmed_appts_query);

?>
<!DOCTYPE html>
<html lang="en">

<!-- doccure/appointments.php  30 Nov 2019 04:12:09 GMT -->

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
								<li class="breadcrumb-item active" aria-current="page">Appointments</li>
							</ol>
						</nav>
						<h2 class="breadcrumb-title">Appointments</h2>
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
					<?php include("inc/doctor-sidebar.php"); ?>
					<!-- /Profile Sidebar -->
					<div class="col-md-7 col-lg-8 col-xl-9">
						<h2 class="text-center my-3">Accepted Appoinments</h2>
						<div class="appointments">

							<!-- Appointment List -->
							<?php
							foreach ($appt_selected as $appt_data) {
								$select_pat_query = "SELECT * FROM patients WHERE patientid={$appt_data['patientid']}";
								$pat_selected = $database_conn->query($select_pat_query);
								foreach ($pat_selected as $pat_data) {
							?>
									<div class="appointment-list">
										<div class="profile-info-widget">
											<a href="#" class="booking-doc-img">
												<img src="<?= $pat_data["image"] ?>" alt="User Image">
											</a>
											<div class="profile-det-info">
												<h3><a href="#"><?= $pat_data["firstname"] . ' ' . $pat_data["lastname"] ?></a></h3>
												<div class="patient-details">
													<h5><i class="far fa-clock"></i> <?= date("d M Y", strtotime("{$appt_data['apptdate']}")) ?>,
														<?= date("h:i a", strtotime($appt_data["appttime"])) ?>
													</h5>
													<h5><i class="fas fa-map-marker-alt"></i><?= $pat_data["state"] . ', ' . $pat_data["country"] ?></h5>
													<h5><i class="fas fa-envelope"></i><?= $pat_data["email"] ?></h5>
													<h5 class="mb-0"><i class="fas fa-phone"></i><?= $pat_data["mobile"] ?></h5>
												</div>
											</div>
										</div>
									</div>
							<?php }
							} ?>
							<!-- /Appointment List -->

						</div>
					</div>
				</div>

			</div>

		</div>
		<!-- /Page Content -->


	</div>
	<!-- /Main Wrapper -->

	<!-- Appointment Details Modal -->
	<div class="modal fade custom-modal" id="appt_details">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Appointment Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<ul class="info-details">
						<li>
							<div class="details-header">
								<div class="row">
									<div class="col-md-6">
										<span class="title">#APT0001</span>
										<span class="text">21 Oct 2019 10:00 AM</span>
									</div>
									<div class="col-md-6">
										<div class="text-right">
											<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Completed</button>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li>
							<span class="title">Status:</span>
							<span class="text">Completed</span>
						</li>
						<li>
							<span class="title">Confirm Date:</span>
							<span class="text">29 Jun 2019</span>
						</li>
						<li>
							<span class="title">Paid Amount</span>
							<span class="text">$450</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /Appointment Details Modal -->

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

<!-- doccure/appointments.php  30 Nov 2019 04:12:09 GMT -->

</html>

<?php
}
?>