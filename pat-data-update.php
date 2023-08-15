<?php
    include('inc/database-conn.php');
    session_start();
    if(!isset($_SESSION['patientid'])){
        header("Location: index.php");
    }else{
    $patientid = $_SESSION['patientid'];
    $patientid_post = $_POST['patientid'];

    $patfname = $_POST['firstname'];
    $patlname = $_POST['lastname'];
    $dateofbirth = $_POST['dateofbirth'];
    $mobile = $_POST['mobile'];
    $blood = $_POST['blood'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $country = $_POST['country'];

    
    $old_data = $database_conn->query("SELECT * FROM patients WHERE patientid=$patientid_post");
    if($_FILES['patimage']['error']>0){
        foreach($old_data as $col)
            $image_loc = $col['image'];
    }
    else{
        $image_name = $_FILES['patimage']['name'];
        $image_tmp_loc = $_FILES['patimage']['tmp_name'];
        $image_loc = "images/patientsImages/" . time() . rand() . "$image_name";
        move_uploaded_file($image_tmp_loc, $image_loc);
    }

    $pat_update_query = "UPDATE `patients` SET 
        `firstname`='$patfname',
        `lastname`='$patlname',
        `image` = '$image_loc',
        `dateofbirth` = '$dateofbirth',
        `mobile`='$mobile',
        `blood`='$blood',
        `address`='$address',
        `city`='$city',
        `state`='$state',
        `zipcode`='$zipcode',
        `country`='$country',
        `date`=Now() 
    WHERE patientid=$patientid_post";

    $pat_updated = $database_conn->query($pat_update_query);

    if($pat_updated){
        header("Location: profile-settings.php");
    }
}
?>