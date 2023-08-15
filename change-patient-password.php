<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include("inc/database-conn.php");
        $old_pass = $_POST['old-pat-password'];
        $new_pass = $_POST['new-pat-password'];
        $conf_new_pass = $_POST['conf-pat-password'];
        $patientid = $_SESSION['patientid'];
        $pass_selected = $database_conn->query("SELECT password FROM patients WHERE patientid=$patientid");
        foreach($pass_selected as $pass_data){
            $old_d_pass = $pass_data['password'];
        }
        if(md5($old_pass)==$old_d_pass){
            if($new_pass==$conf_new_pass){
                $new_d_pass = md5($new_pass);
                $pass_updated = $database_conn->query("UPDATE patients SET `password`='$new_d_pass' WHERE patientid=$patientid");
                if($pass_updated){
                    $_SESSION['confirm'] = "Password Updated Successfully";
                    header("Location: change-password.php?patientid=$patientid");
                }
            }else{
                $_SESSION['error'] = "Passwords Match Error";
                header("Location: change-password.php?patientid=$patientid");
            }
        }else{
            $_SESSION['error'] = "Wrong Password";
            header("Location: change-password.php?patientid=$patientid");
        }
    }else{
        header("Location: patient-dashboard.php?patientid={$_SESSION['patientid']}");
    }
?>