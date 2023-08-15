<?php
	include("inc/database-conn.php");
	session_start();
	if(!isset($_SESSION['doctorid'])){
		header("Location: index.php");
	}else{
	$doctorid = $_SESSION['doctorid'];
	$doc_select_query = "SELECT * FROM doctors WHERE doctorid=$doctorid";
	$doc_selected = $database_conn->query($doc_select_query);
	if($doc_selected->num_rows==1){
		foreach ($doc_selected as $doc_data) {
			$docusername = $doc_data['username'];
			$email = $doc_data['email'];
			$firstname = $doc_data['firstname'];
			$lastname = $doc_data['lastname'];
			$mobile = $doc_data['mobile'];
			$country = $doc_data['country'];
			$biography = $doc_data['biography'];
			$pricing = $doc_data['pricing'];
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<!-- doccure/doctor-profile-settings.php  30 Nov 2019 04:12:14 GMT -->

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

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css">

	<link rel="stylesheet" href="assets/plugins/dropzone/dropzone.min.css">

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
								<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
							</ol>
						</nav>
						<h2 class="breadcrumb-title">Profile Settings</h2>
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
					<?php include("inc/doctor-sidebar.php") ?>
					<!-- /Profile Sidebar -->
						<div class="col-md-7 col-lg-8 col-xl-9">
							<form action="doc-data-update.php" method="POST" enctype="multipart/form-data">
								<input type="text" hidden value='<?= $doctorid ?>' name='doctorid'>
								<!-- Basic Information -->
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Basic Information</h4>
										<div class="row form-row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="change-avatar">
														<div class="profile-img">
															<img src="<?= $image ?>" alt="User Image">
														</div>
														<div class="upload-img">
															<div class="change-photo-btn">
																<span><i class="fa fa-upload"></i>Upload Photo</span>
																<input type="file" class="upload" name='docimage'>
															</div>
															<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Username <span class="text-danger">*</span></label>
													<input type="text" class="form-control" readonly value='<?= $docusername ?>'>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Email <span class="text-danger">*</span></label>
													<input type="email" class="form-control" readonly value='<?= $email  ?>'>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>First Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control" value='<?= $firstname ?>' name='docfname'>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Last Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control" value='<?= $lastname ?>' name='doclname'>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Phone Number</label>
													<input type="text" class="form-control" value='<?= $mobile ?>' name='mobile'>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Country</label>
													<input type="text" class="form-control" value='<?= $country ?>' name='country'>
												</div>
											</div>

										</div>
									</div>
								</div>
								<!-- /Basic Information -->

								<!-- About Me -->
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">About Me</h4>
										<div class="form-group mb-0">
											<label>Biography</label>
											<textarea class="form-control" rows="5" name='biography'><?=$biography?></textarea>
										</div>
									</div>
								</div>
								<!-- /About Me -->

								<!-- Pricing -->
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Pricing</h4>
										<div class="form-group mb-0">
											<div>
												<input type="text" class="form-control" placeholder="20" value='<?=$pricing?>' name='pricing'>
											</div>
										</div>
									</div>
								</div>
								<!-- /Pricing -->

								<div class="submit-section submit-btn-bottom">
									<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
								</div>
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

	<!-- Sticky Sidebar JS -->
	<script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
	<script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

	<!-- Select2 JS -->
	<script src="assets/plugins/select2/js/select2.min.js"></script>

	<!-- Dropzone JS -->
	<script src="assets/plugins/dropzone/dropzone.min.js"></script>

	<!-- Bootstrap Tagsinput JS -->
	<script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>

	<!-- Profile Settings JS -->
	<script src="assets/js/profile-settings.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/script.js"></script>

</body>

<!-- doccure/doctor-profile-settings.php  30 Nov 2019 04:12:15 GMT -->

</html>
<?php } ?>