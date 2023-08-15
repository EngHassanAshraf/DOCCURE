<?php
include("database-conn.php");
if (!isset($_SESSION['doctorid'])) {
    $_SESSION['error'] = "YOU ARE NOT ALLOWED";
    header("Location: ");
}else{
    $doctorid = $_SESSION['doctorid'];

    $select_doc_query = "SELECT 
            firstname, 
            lastname, 
            image, 
            biography
            FROM doctors WHERE doctorid=$doctorid";
    $doc_selected = $database_conn->query($select_doc_query);
    if($doc_selected->num_rows==1){
        foreach($doc_selected as $doc_data){
            $firstname = $doc_data['firstname'];
            $lastname = $doc_data['lastname'];
            $image = $doc_data['image'];
            $biography = $doc_data['biography'];
        }
    }
}
?>

<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
    <div class="profile-sidebar">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="#" class="booking-doc-img">
                    <img src="<?=$image?>" alt="User Image">
                </a>
                <div class="profile-det-info">
                    <h3>Dr. <?=$firstname .' '. $lastname?></h3>

                    <div class="patient-details">
                        <h5 class="mb-0"><?=$biography?></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li>
                        <a href="doctor-dashboard.php?doctorid=<?=$doctorid?>">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="appointments.php?doctorid=<?=$doctorid?>">
                            <i class="fas fa-calendar-check"></i>
                            <span>Appointments</span>
                        </a>
                    </li>


                    <li>
                        <a href="doctor-profile-settings.php?doctorid=<?=$doctorid?>">
                            <i class="fas fa-user-cog"></i>
                            <span>Profile Settings</span>
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