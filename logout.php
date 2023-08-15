<?php
    session_start();
    if(isset($_SESSION['patientid'])|| isset($_SESSION['doctorid']))
        session_destroy();
    
    header("Location: index.php");
?>