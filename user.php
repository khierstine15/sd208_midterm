<?php include_once('user-header.php') ?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" style='background:#012970;'>

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="user.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link " href="userActivities.php" style='background: transparent;'>
                <i class="bi bi-activity"></i>
                <span>Activities</span>
            </a>
        </li>



        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>Chart.js</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>ApexCharts</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i><span>ECharts</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Charts Nav -->

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->


        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-card-list"></i>
                <span>Register</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
        </li><!-- End Login Page Nav -->

    </ul>

</aside><!-- End Sidebar-->


<main id="main" class="main" style='margin-top:60px;'>

    <div class="pagetitle">
        <h1>Announcement</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="user.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <?php
                    include_once('./Included/dbconnect/connection.php');
                    $con = connection();
                    $sql = "SELECT * FROM announcement";
                    $result = $con->query($sql);
                    ?>

                    <!-- USER Card -->
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="announcement">
                            <div class="announcement-header">
                                <?php echo $row['announcement_title']; ?>
                            </div>
                            <div class="announcement-body">
                                <?php echo $row['announcement']; ?>
                            </div>
                            <div class="announcement-footer">
                                <?php echo $row['announcement_created_at']; ?>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- End Revenue Card -->
                </div>


                <div class="card mb-4" style="margin: 10px;">
                    <div class="card-header" style='font-size: 18px; color:black; font-weight: 600; margin-bottom: 0;'>
                        <i class="bi bi-table"></i>
                        Upcoming Activities
                    </div>

                    <div class="card-header">
                        <div class="upper-table">
                            <input type="text" name="searchUser" placeholder="Enter Lastname">
                        </div>
                        <!-- <table class="table" style="height: 450px; overflow:auto;"> -->
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Activity Name</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>OOTD</th>
                                    <th>Remarks</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <?php ?>
                            <tbody>
                                <?php if (!empty($activities)) {
                                    $countActivity = 1;
                                    foreach ($activities as $activity) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $countActivity++; ?>
                                            </td>
                                            <td>
                                                <?php echo $activity['activityName']; ?>
                                            </td>
                                            <td>
                                                <?php echo $activity['location']; ?>
                                            </td>
                                            <td>
                                                <?php echo date("F j, Y", strtotime($activity["dateOfActivity"])); ?>
                                            </td>
                                            <td>
                                                <?php echo date("h:i A", strtotime($activity["timeOfActivity"])); ?>
                                            </td>
                                            <td>
                                                <img src="<?php echo "act-img/" . $activity['image']; ?>" alt="Activity Image"
                                                    class="expandable-image"
                                                    style="width: 120px; height:120px; object-fit:cover; border-radius: 5px;">
                                            </td>
                                            <td>
                                                <p>
                                                    <?php if ($activity['remarks'] == '')
                                                        echo "No remarks";
                                                    else
                                                        echo $activity['remarks'] ?>
                                                    </p>
                                                </td>
                                                <!-- <td>
                                                <button class="editActivityBtn btn btn-primary"
                                                    id="<?php echo $activity['id'] ?>">Edit</button>

                                                <button id="<?php echo $activity['id'] ?>" class="deleteBtn btn btn-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                                            </td> -->


                                        </tr>
                                    <?php }
                                } else { ?>
                                    <div class="alert alert-warning alert-dismissable fade show" role="alert"
                                        style="display:flex;align-items: center; justify-content:space-between;">
                                        <strong>No Activity Added Yet!</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss='alert' aria-label="close"
                                            style="width: 50px;"></button>
                                    </div>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
                $done_query = "SELECT * FROM activities WHERE Status = 'Done'";
                $done = $con->query($done_query);
                ?>




                <div class="card mb-4" style="margin: 10px;">
                    <div class="card-header" style='font-size: 18px; color: black; font-weight: 600; margin-bottom: 0;'>
                        <i class="bi bi-table"></i>
                        Done Activities
                    </div>

                    <div class="card-header">
                        <div class="upper-table">
                            <input type="text" name="searchUser" placeholder="Enter Lastname">
                        </div>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Activity Name</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>OOTD</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $countActivity = 1;
                                while ($activity = $done->fetch_assoc()) { // Changed "$row" to "$activity"
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $countActivity++; ?>
                                        </td>
                                        <td>
                                            <?php echo $activity['activityName']; ?>
                                        </td>
                                        <td>
                                            <?php echo $activity['location']; ?>
                                        </td>
                                        <td>
                                            <?php echo date("F j, Y", strtotime($activity["dateOfActivity"])); ?>
                                        </td>
                                        <td>
                                            <?php echo date("h:i A", strtotime($activity["timeOfActivity"])); ?>
                                        </td>
                                        <td>
                                            <img src="act-img/<?php echo $activity['image']; ?>" alt="Activity Image"
                                                class="expandable-image"
                                                style="width: 120px; height: 120px; object-fit: cover; border-radius: 5px;">
                                        </td>
                                        <td style="color: green; font-weight: bold;">
                                            <?php echo $activity["Status"]; ?>
                                        </td>
                                        <td>
                                            <p>
                                                <?php echo empty($activity['remarks']) ? "No remarks" : $activity['remarks']; ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                if ($countActivity == 1) {
                                    ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-warning alert-dismissable fade show" role="alert"
                                                style="display: flex; align-items: center; justify-content: space-between;">
                                                <strong>No Done Activities Found!</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss='alert'
                                                    aria-label="close" style="width: 50px;"></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
                $cancel_query = "SELECT * FROM activities WHERE Status = 'Cancelled'";
                $cancel = $con->query($cancel_query);
                ?>

                <div class="card mb-4" style="margin: 10px;">
                    <div class="card-header" style='font-size: 18px; color: black; font-weight: 600; margin-bottom: 0;'>
                        <i class="bi bi-table"></i>
                        Cancelled Activities
                    </div>

                    <div class="card-header">
                        <div class="upper-table">
                            <input type="text" name="searchUser" placeholder="Enter Lastname">
                        </div>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Activity Name</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>OOTD</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $countActivity = 1;
                                while ($activity = $cancel->fetch_assoc()) { // Changed "$row" to "$activity"
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $countActivity++; ?>
                                        </td>
                                        <td>
                                            <?php echo $activity['activityName']; ?>
                                        </td>
                                        <td>
                                            <?php echo $activity['location']; ?>
                                        </td>
                                        <td>
                                            <?php echo date("F j, Y", strtotime($activity["dateOfActivity"])); ?>
                                        </td>
                                        <td>
                                            <?php echo date("h:i A", strtotime($activity["timeOfActivity"])); ?>
                                        </td>
                                        <td>
                                            <img src="act-img/<?php echo $activity['image']; ?>" alt="Activity Image"
                                                class="expandable-image"
                                                style="width: 120px; height: 120px; object-fit: cover; border-radius: 5px;">
                                        </td>
                                        <td style="color: red; font-weight: bold;">
                                            <?php echo $activity["Status"]; ?>
                                        </td>
                                        <td>
                                            <p>
                                                <?php echo empty($activity['remarks']) ? "No remarks" : $activity['remarks']; ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                if ($countActivity == 1) { // Check if no activities were found
                                    ?>
                                    <tr>
                                        <td colspan="8">
                                            <div class="alert alert-warning alert-dismissable fade show" role="alert"
                                                style="display: flex; align-items: center; justify-content: space-between;">
                                                <strong>No Cancelled Activities Found!</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss='alert'
                                                    aria-label="close" style="width: 50px;"></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>



                <style>
                    table td {
                        vertical-align: middle;
                    }
                </style>


            </div>
    </section>

</main>

<!-- Modal -->

<!-- ADD Activity -->
<div id="activityModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <header>Add Activity</header>
        <form action='' method='POST' enctype="multipart/form-data">
            <!-- Activity Name -->
            <div class='field input-field'>
                <input type='text' name='nameActivity' placeholder='Name Activity' class='input' required>
            </div>

            <!-- Activity Location -->
            <div class='field input-field'>
                <input type='text' name='location' placeholder='Location' class='input' required>
            </div>

            <!-- Activity Date & Time -->
            <div class='field input-field' style="display: flex; align-items:center; gap: 20px;">
                <div>
                    <label>Date: </label>
                    <input type='date' name='date' placeholder='Date' class='input'>
                </div>
                <div>
                    <label>Time: </label>
                    <input type='time' name='time' placeholder='Time' class='input'>
                </div>
            </div>

            <!-- Activity File OOTD -->
            <div>
                <label>OOTD: </label>
                <input type='file' name='image' class='file' accept='image/*' style="margin-bottom: 20px;">
            </div>

            <div class='field button-field'>
                <input type='submit' class='addActivity' id='submitBtn' name='addActivity' value='Add'>
            </div>
        </form>
    </div>
</div>

<!-- EDIT Activity -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <header>Edit Activity</header>
        <form action='register.php' method='POST'>
            <!-- Activity Name -->
            <div class='field input-field'>
                <input type='text' name='nameActivity' placeholder='Name Activity' class='input'
                    value='<?php echo $rowActivity[' activityName'] ?>' required>
            </div>

            <!-- Activity Location -->
            <div class='field input-field'>
                <input type='text' name='location' placeholder='Location' class='input' value='<?php echo $rowActivity['
                    location'] ?>' required>
            </div>

            <!-- Activity Date & Time -->
            <div class='field input-field' style="display: flex; align-items:center; gap: 20px;">
                <div>
                    <label>Date: </label>
                    <input type='date' name='date' placeholder='Date' class='input' value='<?php echo $rowActivity['
                        dateOfActivity'] ?>' required>
                </div>
                <div>
                    <label>Time: </label>
                    <input type='time' name='time' placeholder='Time' class='input' value='<?php echo $rowActivity['
                        timeOfActivity'] ?>' required>
                </div>
            </div>

            <!-- Activity File OOTD -->
            <div>
                <label>OOTD: </label>
                <input type='file' name='upload' class='file' accept='image/*' required style="margin-bottom: 20px;">
            </div>

            <div class='field button-field'>
                <input type='submit' class='addActivity' id='submitBtn' name='addActivity' value='Add'>
            </div>
        </form>
    </div>
</div>

<!-- Show Activity -->
<div id="showModal" class="modal">
    <div class="modal-content" style="max-width:80%; margin:7% auto;">
        <span class="close" onclick="closeModal()">&times;</span>
        <header>Show Activity</header>
        <div class="card mb-4">
            <div class="card-header">
                <input type="text" placeholder="Search name">

            </div>
            <div class="card-header" style=" margin-bottom: 0px;">
                <table id="datatablesSimple" class='table' style='text-align:center;'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Activity Name</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>OOTD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $countActivity = 0;
                        do { ?>
                            <tr>
                                <td>
                                    <?php echo $countActivity++ ?>
                                </td>
                                <td>
                                    <?php echo $rowActivity['activityName'] ?>
                                </td>
                                <td>
                                    <?php echo $rowActivity['location'] ?>
                                </td>
                                <td>
                                    <?php echo $rowActivity['dateOfActivity'] ?>
                                </td>
                                <td>
                                    <?php echo $rowActivity['timeOfActivity'] ?>
                                </td>
                                <td>
                                    <?php echo '<img src="data:image;base64,' . base64_encode($rowActivity['image']) . '">'; ?>
                                </td>
                                <!-- <td><img src="assets/img/profile-img.jpg" style="width: 80px; height:80px; object-fit:cover; border-radius: 5px;" alt="OOTD"></td> -->

                            </tr>


                        <?php } while ($rowActivity = $resultActivity->fetch_assoc()) ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Set Activity -->
<div id="setModal" class="modal">
    <div class="modal-content" style="max-width:80%; margin:7% auto;">
        <span class="close" onclick="closeModal()">&times;</span>
        <header>Set Activity</header>
        <div class="card mb-4">
            <div class="card-header">
                <input type="text" placeholder="Search name">

            </div>
            <div class="card-header">
                <table id="datatablesSimple" class='table' style='text-align:center;'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Activity Name</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>OOTD</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Sing Opera</td>
                            <td>Carmelites Center</td>
                            <td>09/26/2023</td>
                            <td>8:00AM</td>
                            <td><img src="assets/img/profile-img.jpg"
                                    style="width: 80px; height:80px; object-fit:cover; border-radius: 5px;" alt="OOTD">
                            </td>
                            <td>
                                <button>Cancel</button>
                                <button>Done</button>
                                <button>Remarks</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Cook</td>
                            <td>Carmelites Center</td>
                            <td>09/26/2023</td>
                            <td>8:00AM</td>
                            <td><img src="assets/img/profile-img.jpg"
                                    style="width: 80px; height:80px; object-fit:cover; border-radius: 5px;" alt="OOTD">
                            </td>
                            <td>
                                <button>Cancel</button>
                                <button>Done</button>
                                <button>Remarks</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Draw</td>
                            <td>Carmelites Center</td>
                            <td>09/26/2023</td>
                            <td>8:00AM</td>
                            <td><img src="assets/img/profile-img.jpg"
                                    style="width: 80px; height:80px; object-fit:cover; border-radius: 5px;" alt="OOTD">
                            </td>
                            <td>
                                <button>Cancel</button>
                                <button>Done</button>
                                <button>Remarks</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php include_once('user-footer.php') ?>