<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include("inc/database-conn.php");

	$email = $_POST["docemail"];
	$password = md5($_POST["docpassword"]);


	$doc_select_query = "SELECT doctorid FROM doctors WHERE email='$email' AND password='$password'";
	$doc_SELECTED = $database_conn->query($doc_select_query);

	if ($doc_SELECTED->num_rows == 1) {
		foreach ($doc_SELECTED as $doc) {
			$doctorid = $doc['doctorid'];
		}
		
		$_SESSION['doclogin']=true;
		$_SESSION['doctorid']=$doctorid;

		header("Location: doctor-dashboard.php?doctorid=$doctorid");
	} else {
		$_SESSION['error'] = "Email/Password doesn't Match";
        header("Location: doctorlogin.php");
	}
}else{
	header("Location: index.php");
}
?>