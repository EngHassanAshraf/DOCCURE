<?php
    session_start();
    if(isset($_SESSION["doclogin"]))
    if(isset($_GET['apptid'])){
    include("inc/database-conn.php");
    $apptid = $_GET['apptid'];
    
    $appt_status_updated = $database_conn->query("UPDATE appointments SET status='canceled' WHERE id=$apptid");

    if($appt_status_updated){
        header("Location: doctor-dashboard.php?doctorid={$_SESSION['doctortid']}");
    }
}
else{
    $_SESSION['appt_error'] = "No Appointments are Found";
    header("Location: doctor-dashboard.php?doctorid={$_SESSION['doctortid']}");
}
else{
    $_SESSION['error'] = "You Need To Login First";
    header("Location: login.php");
}
?>