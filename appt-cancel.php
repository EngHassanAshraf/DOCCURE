<?php
session_start();
if(isset($_SESSION['patientid'])){
	if(isset($_GET['cancel-id'])){
			$appt_id = $_GET['cancel-id'];

			include("inc/database-conn.php");
			$appt_deleted = $database_conn->query("DELETE FROM appointments WHERE id=$appt_id");
		
			if($appt_deleted){
				header("Location: patient-dashboard.php?patientid={$_SESSION['patientid']}");
			}
	}else{
		header("Location: patient-dashboard.php?patientid={$_SESSION['patientid']}");
	}
}
else{
	$_SESSION['error'] = "You Need To Login First";
    header("Location: login.php");
}
