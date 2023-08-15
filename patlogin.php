<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include("inc/database-conn.php");

	$email = $_POST["patemail"];
	$password = md5($_POST["patpassword"]);


	$query = "SELECT patientid FROM patients WHERE email='$email' AND password='$password'";
	$pat_SELECTED = $database_conn->query($query);
	

	if ($pat_SELECTED->num_rows == 1) {
		foreach ($pat_SELECTED as $pat) {
			$patientid = $pat['patientid'];
		}
		$_SESSION['patlogin']=true;
		$_SESSION['patientid'] = $patientid;
		header("Location: patient-dashboard.php?patientid=$patientid");
	} else {
		$_SESSION['error'] = "Email/Password doesn't Match";
        header("Location: login.php");
	}
}else{
	header("Location: index.php");
}
?>