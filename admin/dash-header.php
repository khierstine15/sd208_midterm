<?php
session_start();
include_once('../Included/dbconnect/connection.php');
$con = connection();

if ($_SESSION["Role"] == null) {
    header("Location: ../FlexStart/login.html");
} else {
    if ($_SESSION["Role"] == "admin") {
        $sql = "SELECT gender, COUNT(*) AS count FROM user GROUP BY gender";
        $result = $con->query($sql);
        $genderData = array();

        while ($rowGender = $result->fetch_assoc()) {
            $genderData[$rowGender['gender']] = $rowGender['count'];
        }


        $query = "SELECT EXTRACT(MONTH FROM dateOfActivity) AS month, COUNT(*) AS count 
        FROM activities 
        GROUP BY EXTRACT(MONTH FROM dateOfActivity)";
        $result = $con->query($query);
        $activityData = array_fill(0, 12, 0);

        if ($result->num_rows > 0) {
            while ($rowActivity = $result->fetch_assoc()) {
                $month = $rowActivity['month'];
                $count = $rowActivity['count'];
                $monthIndex = $month - 1;
                $activityData[$monthIndex] = (int) $count;
            }
        } else {
            echo "No activity data found.";
        }

    } else {
        header("Location: ../FlexStart/login.html");
    }
}

// show user
$sql = "SELECT * FROM user WHERE ID = '" . $_SESSION['ID'] . "'";
$result = $con->query($sql);
$row = $result->fetch_assoc();


// show List of users
$query = "SELECT * FROM user where role = 'user'";
$resultUser = $con->query($query);
$rowUsers = $resultUser->fetch_assoc();

$query = "SELECT COUNT(*) AS totalUsers FROM user WHERE role = 'user' AND status = 'active'";
$result = $con->query($query);
$rowtotalUser = $result->fetch_assoc();
$totalUsers = $rowtotalUser['totalUsers'];


$sqlActivity = "SELECT * FROM activities";
$resultActivity = $con->query($sqlActivity);


$activities = [];
while ($rowData = $resultActivity->fetch_assoc()) {
    $activities[] = $rowData;
}



// Update Activity
if (isset($_POST['updateActivity'])) {
    $activityId = $_POST['acitivityID'];
    $activityName = $_POST['nameActivity'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $new_img = $_FILES['image']['name'];

    $old_img = $_POST['old_image'];


    $stmt = $con->prepare("UPDATE `activities` SET `activityName` = ?, `location` = ?, `dateOfActivity` = ?, `timeOfActivity` = ?, `image` = ?, userId = ? WHERE `activity_id` = $activityId");
    $stmt->bind_param("sssssi", $activityName, $location, $date, $time, $new_img, $userId);

    if ($stmt->execute()) {

        if ($_FILES["image"]["tmp_name"] != '') {
            move_uploaded_file($_FILES["image"]["tmp_name"], "../act-img/" . $new_img);
            unlink("../act-img/" . $old_img);
        }

        $_SESSION['status'] = "Image Updated Successfully!";
        header('Location: dashboard.php');

        exit;

    } else {
        $_SESSION['status'] = "Image Not Updated.!";
        header('Location: dashboard.php');
    }
}

if (isset($_POST['addRemarks'])) {
    $activityId = $_POST['activityId'];
    $remarks = $_POST['remarks'];

    if (!empty($remarks)) {
        $stmt = $con->prepare("UPDATE activities SET remarks = ? WHERE id = ?");
        $stmt->bind_param("si", $remarks, $activityId);

        if ($stmt->execute()) {
            // echo "Remarks added successfully."; //needs a modal to show succes message
        } else {
            echo "Failed to add remarks.";
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>

    <!-- Favicons -->
    <link href="../assets/img/logo.png" rel="icon">
    <link href="../assets/img/logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

    <!-- Fontawesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />


    <!-- Template Main CSS File -->
    <link href="../assets/css/dash.css" rel="stylesheet">
    <link href="../assets/css/manage.css" rel="stylesheet">

    <!-- chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- AJAX -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="dashboard.php" class="logo d-flex align-items-center">
                <img src="../assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Admin</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="../assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="../assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="../assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php echo $row['Firstname'] ?>
                        </span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header text-center">
                            <h6>
                                <?php echo $row['Firstname'] . ' ' . $row['Lastname'] ?>
                            </h6>
                            <span>Admin</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>

    </header><!-- End Header -->