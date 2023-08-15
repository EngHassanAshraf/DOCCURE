<?php
include("database-conn.php");
if (isset($_SESSION['patientid'])) {
    $patientid = $_SESSION['patientid'];

    $select_pat_query = "SELECT 
            firstname, 
            lastname, 
            dateofbirth,
            image, 
            city,
            country
            FROM patients WHERE patientid=$patientid";
    $pat_selected = $database_conn->query($select_pat_query);
?>

    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
        <div class="profile-sidebar">
            <div class="widget-profile pro-widget-content">
                <div class="profile-info-widget">
                    <?php
                    if ($pat_selected->num_rows == 1) {
                        foreach ($pat_selected as $pat_data) {
                            $firstname = $pat_data['firstname'];
                            $lastname = $pat_data['lastname'];
                            $dateofbirth = $pat_data['dateofbirth'];
                            $patientimage = $pat_data['image'];
                            $city = $pat_data['city'];
                            $country = $pat_data['country'];

                            $today = date("Y-m-d");
                            $birthdate = date_create($dateofbirth);
                            $todaydate = date_create($today);
                            $diff = date_diff($todaydate, $birthdate);
                            $age = $diff->format('%y');
                    ?>
                            <a href="#" class="booking-doc-img">
                                <img src="<?= $patientimage ?>" alt="User Image">
                            </a>
                            <div class="profile-det-info">
                                <h3><?= $firstname . " " . $lastname ?></h3>
                                <div class="patient-details">

                                    <?php if ($dateofbirth != null) { ?>
                                        <h5><i class="fas fa-birthday-cake"></i> <?= $dateofbirth . ', ' . $age . ' years' ?></h5>
                                    <?php } ?>
                                    <?php if ($city != null && $country != null) { ?>
                                    <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> <?= $city.', '.$country?> </h5>
                                    <?php } ?>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
            <div class="dashboard-widget">
                <nav class="dashboard-menu">
                    <ul>
                        <li>
                            <a href="patient-dashboard.php?patientid=<?=$patientid?>">
                                <i class="fas fa-columns"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="doctors.php">
                                <i class="fas fa-user-md"></i>
                                <span>Doctors</span>
                            </a>
                        </li>
                        <li>
                            <a href="profile-settings.php?patientid=<?=$patientid?>">
                                <i class="fas fa-user-cog"></i>
                                <span>Profile Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="change-password.php?patientid=<?=$patientid?>">
                                <i class="fas fa-lock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>

<?php
} else {
    $_SESSION['error'] = "YOU ARE NOT ALLOWED";
    header("Location: ");
}

//     } else {
//         $_SESSION['error'] = "No user Found";
//         header("Location: ");
//     }
// } else {
//     $_SESSION['error'] = "You Must Login First";
//     header("Location: ");
// }
?>