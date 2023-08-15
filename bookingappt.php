<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    if (isset($_SESSION["doctorid"])) {
        $doctorid = $_SESSION["doctorid"];
        header("Location: booking.php?doctorid=$doctorid");
    } else if (isset($_SESSION["patientid"])) {
        header("Location: patient-dashboard.php?patientid={$_SESSION['patientid']}");
    } else {
        $_SESSION['error'] = "You Need To Login First";
        header("Location: login.php");
    }
} else {
    include('inc/database-conn.php');
    $patientid = $_SESSION["patientid"];
    $doctorid = $_SESSION["doctorid"];
    $apptdate = $_POST["date"];
    $appttime = $_POST["time"];
    $apptprice = $_POST["price"];

    $book_appt_query = "INSERT INTO `appointments`(`patientid`, `doctorid`, `apptdate`, `appttime`, `price`, `bookingdate`) 
    VALUES                     ('$patientid','$doctorid','$apptdate','$appttime','$apptprice',Now())";

    $appt_booked = $database_conn->query($book_appt_query);

    if ($appt_booked) {
        $_SESSION['booked'] = true;
        header("Location: booking-success.php");
    }
}
