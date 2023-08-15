<?php
    include('inc/database-conn.php');
    session_start();
    if($_SERVER["REQUEST_METHOD"]!="POST")
    {
        if(isset($_SESSION['doctorid']))
            header("Location: doctor-profile-settings.php?doctorid={$_SESSION['doctorid']}");
        else{
            header("Location: index.php");
        }
    }else{
    $doctorid = $_SESSION['doctorid'];
    $doctorid_post = $_POST['doctorid'];

    $docfname = $_POST['docfname'];
    $doclname = $_POST['doclname'];
    $mobile = $_POST['mobile'];
    $country = $_POST['country'];
    $biography = mysqli_real_escape_string($database_conn, $_POST['biography']);
    $pricing = $_POST['pricing'];
    
    $old_data = $database_conn->query("SELECT * FROM doctors WHERE doctorid=$doctorid_post");

    if($_FILES['docimage']['error']>0){
        foreach($old_data as $col)
            $image_loc = $col['image'];
    }
    else{
        $image_name = $_FILES['docimage']['name'];
        $image_tmp_loc = $_FILES['docimage']['tmp_name'];
        $image_loc = "images/doctorsImages/" . time() . rand() . "$image_name";
        move_uploaded_file($image_tmp_loc, $image_loc);
    }

    $doc_update_query = "UPDATE `doctors` SET 
        `firstname`='$docfname',
        `lastname`='$doclname',
        `mobile`='$mobile',
        `image` = '$image_loc',
        `country`='$country',
        `biography`='$biography',
        `pricing`='$pricing',
        `date`=Now() 
    WHERE doctorid=$doctorid_post";

    $doc_updated = $database_conn->query($doc_update_query);

    if($doc_updated){
        header("Location: doctor-profile-settings.php");
    }
}
?>