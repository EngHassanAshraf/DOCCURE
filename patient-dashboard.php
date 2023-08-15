<?php
include("inc/database-conn.php");
session_start();
	if(!isset($_SESSION['patientid'])){
		header("Location: index.php");
	}else if(!isset($_SESSION['patlogin'])){
		header("Location: index.php");
	}else{
	$patientid = $_SESSION['patientid'];
	$select_apt_query = "SELECT * FROM appointments WHERE patientid=$patientid";
	$appt_selected = $database_conn->query($select_apt_query);
	
?>

<!DOCTYPE html>
<html lang="en">

<!-- doccure/patient-dashboard.php  30 Nov 2019 04:12:16 GMT -->

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
					<?php include("inc/patient-sidebar.php") ?>
					<!-- / Profile Sidebar -->

					<div class="col-md-7 col-lg-8 col-xl-9">
						<div class="card">
							<div class="card-body pt-0">

								<!-- Tab Menu -->
								<nav class="user-tabs mb-4">
									<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
										<li class="nav-item">
											<a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
										</li>

									</ul>
								</nav>
								<!-- /Tab Menu -->

								<!-- Tab Content -->
								<div class="tab-content pt-0">

									<!-- Appointment Tab -->
									<div id="pat_appointments" class="tab-pane fade show active">
										<div class="card card-table mb-0">
											<div class="card-body">
												<div class="table-responsive">
													<table class="table table-hover table-center mb-0">
														<thead>
															<tr>
																<th>Doctor</th>
																<th>Appt Date</th>
																<th>Booking Date</th>
																<th>Price</th>
																<th>Status</th>
															</tr>
														</thead>
														<tbody>
															<?php
															foreach ($appt_selected as $appt_data) {
																$appt_id = $appt_data['id'];
																$doctor_id = $appt_data["doctorid"];

																$appt_date = date('d M Y', strtotime("{$appt_data["apptdate"]}"));
																$booking_date = date('d M Y', strtotime("{$appt_data["bookingdate"]}"));
															
																$appt_time = date("h:i a", strtotime($appt_data["appttime"]));
																
																$appt_price = $appt_data['price'];
																$appt_status = $appt_data['status'];

															$doc_selected = $database_conn->query("SELECT * FROM doctors WHERE doctorid=$doctor_id");
															if (!($doc_selected->num_rows == 1)) {
																header("Location: ");
															} else {
																foreach ($doc_selected as $doc_data) {
																	$first_name = $doc_data["firstname"];
																	$last_name = $doc_data["lastname"];
																	$image = $doc_data['image'];
																
															
															?>
															<tr>
																<td>
																	<h2 class="table-avatar">
																		<a href="doctor-profile.php?doctorid=<?=$doctor_id?>" class="avatar avatar-sm mr-2">
																			<img class="avatar-img rounded-circle" src="<?=$image?>" alt="User Image">
																		</a>
																		<a href="doctor-profile.php?doctorid=<?=$doctor_id?>">Dr. <?=$first_name.' '.$last_name?> <span>Dental</span></a>
																	</h2>
																</td>
																
																<td><?=$appt_date?><span class="d-block text-info"><?=strtoupper($appt_time)?></span></td>
																
																
																<td><?=$booking_date?></td>

																<td>$<?=$appt_price?></td>

																<td><span class="badge badge-pill bg-<?php 
																if($appt_status=='pending') echo "warning";
																else if($appt_status=='confirmed') echo "success";
																else if($appt_status=='canceled') echo "danger";
																?>-light"><?=$appt_status?></span></td>
																<td class="text-right">
																	<div class="table-action">
																		<a href="appt-cancel.php?cancel-id=<?=$appt_id?>" class="btn btn-sm bg-danger-light">
																			<i class="far fa-trash-alt"></i> Cancel
																		</a>
																	</div>
																</td>
															</tr>
															<?php }}} ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<!-- /Appointment Tab -->


								</div>
								<!-- Tab Content -->

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

<!-- doccure/patient-dashboard.php  30 Nov 2019 04:12:16 GMT -->

</html>
<?php } ?>