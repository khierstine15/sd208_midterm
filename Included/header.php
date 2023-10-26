<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>User Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/manage.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="userManage.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span>FlexStart</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto  <?php echo ($_SERVER['PHP_SELF'] == '/userManage.php') ? '' : 'active'; ?>" href="userManage.php">Home</a></li>
          <?php if ($_SESSION['Role'] == null) { ?>
            <li><a class="nav-link scrollto" href="#about">About</a></li>
          <?php } ?>
          <?php if ($_SESSION['Role'] == 'user') { ?>
            <li><a class="nav-link scrollto" href="manage.php">Manage</a></li>
          <?php } ?>
          <?php if ($_SESSION['Role'] == null) { ?>
            <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="#">Drop Down 1</a></li>
                <li><a href="#">Drop Down 2</a></li>
                <li><a href="#">Drop Down 3</a></li>
                <li><a href="#">Drop Down 4</a></li>
              </ul>
            </li>
          <?php } ?>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <?php if ($_SESSION['Role'] == null) { ?>
            <li><a class="getstarted scrollto" href="login.html">Login</a></li>
          <?php } ?>
          <?php if ($_SESSION['Role'] == 'user') { ?>
            <li class="nav-item dropdown pe-3">

              <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" style="max-height:40px;">
                <span class="d-none d-md-block dropdown-toggle ps-2">
                  <?php echo $row['Firstname'] ?>
                </span>
              </a>

              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                <li class="dropdown-header" style="text-align: center; color: black;">
                  <h6 class='uname' style="cursor: pointer;">
                    <?php echo $row['Firstname'] . " " . $row['Lastname']; ?>
                  </h6>
                  <span>Web Designer</span>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                    <i class="bi bi-person" style='font-size: 20px;'></i>
                    <span>My Profile</span>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                    <i class="bi bi-gear" style='font-size: 20px;'></i>
                    <span>Account Settings</span>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>

                <li>
                  <a class="dropdown-item d-flex align-items-center" href="logout.php">
                    <i class="bi bi-box-arrow-right" style='font-size: 20px;'></i>
                    <span>Sign Out</span>
                  </a>
                </li>

              </ul>
            </li>
          <?php } ?>




        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header><!-- End Header -->