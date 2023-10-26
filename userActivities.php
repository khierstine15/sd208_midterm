<?php include_once('user-header.php') ?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" style='background:#012970;'>

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="user.php" style='background: transparent;'>
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link " href="#">
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
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="user.php">Home</a></li>
                <li class="breadcrumb-item active">Activities</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    <style>
        .btns-cont button {
            width: 100%;
        }

        .btns-cont button i {
            margin-right: 10px;
        }
    </style>
    <section class="section dashboard">
        <div class="card-header" style='border-radius: 10px;'>
            <div class='container'>

                <h2 class='center-title text-center'>Manage Life Activities</h2>

                <div class="card-header" style='padding: 40px 15px'>
                    <div class="container row">
                        <div class="col-6" style=' display:flex;'>
                            <div class="btns-cont"
                                style="width: 100%; display:flex; align-items:center; justify-content:center; gap:20px; flex-direction:column; padding:10px 50px">
                                <button id="addActivityBtn" class='btn btn-primary'><i class="bi bi-plus-circle"></i>Add
                                    Activity</button>
                                <button id='showActivities' class="btn btn-primary"><i
                                        class="bi bi-pencil-fill"></i>Edit
                                    Activity</button>
                                <button id='setBtn' class="btn btn-primary"><i class='bi bi-gear-fill'></i>Set
                                    Activity</button>
                            </div>

                        </div>
                        <div class="col-6">
                            <img src="assets/img/features.png" alt="" style="width: 80%; height:100%;">
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<script>
    $(document).ready(function () {
        $('.editActivityBtn').click(function () {
            act_id = $(this).attr('id')
            // alert(act_id);
            $.ajax({
                url: "select.php",
                method: 'post',
                data: { update_id: act_id },
                success: function (result) {
                    $('#editModal').html(result);
                }
            });


            $('#editModal').show();
        })
        // For Delete Activity
        $('.deleteBtn').click(function () {
            const act_id = $(this).attr('id')
            // alert(act_id)
            confirmDeleteModal(act_id);
        });


        // For Set Remarks
        $('.setRemarks').click(function () {
            act_id = $(this).attr('id');
            $.ajax({
                url: "select.php",
                method: 'post',
                data: { set_act: act_id },
                success: function (result) {
                    $('#addRemarksModal').html(result);
                    $('#addRemarksModal').show();
                }
            });
        });



    })

    function confirmDeleteModal(actId) {
        $("#deleteModal .modal-body").text("Are you sure you want to delete Activity ");

        $("#confirmDelete").off("click").on("click", function () {
            console.log("Deleting item ID: " + actId);
            deleteActivity(actId);
        });
    }

    function deleteActivity(actId) {
        $.ajax({
            url: "select.php",
            method: 'post',
            data: { delete_id: actId },
            success: function (result) {
                $('#deleteModal').html(result);
                location.reload();
            }
        });
    }


</script>


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
<div id="editModal" class="modal" style='z-index: 999; overflow:auto;'>
    <!-- The content render here from select.php -->
</div>


<!-- Add Remarks Modal -->
<div id="addRemarksModal" class="modal" style="z-index:99999; overflow: auto;">

</div>



<!-- Delete Activity -->
<div id="deleteModal" class="modal fade" role="dialog" aria-hidden="true" style="z-index:99999;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="padding: 5px;">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">DELETE</h5>
                <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"
                    style='font-size:30px;'></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Show Activity -->
<div id="showModal" class="modal" style="overflow:auto; z-index:997;">
    <div class="modal-content" style="max-width:80%; margin:7% auto;">
        <span class="close" onclick="closeModal()">&times;</span>
        <header>Show Activity</header>
        <div class="card mb-4">
            <div class="card-header" style="margin-bottom:0;">
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
                                        <?php echo $activity["timeOfActivity"]; ?>
                                    </td>
                                    <td>
                                        <img src="<?php echo "act-img/" . $activity['image']; ?>" alt="Activity Image"
                                            class="expandable-image"
                                            style="width: 120px; height:120px; object-fit:cover; border-radius: 5px;">
                                    </td>
                                    <td>
                                        <p>
                                            <?php echo $activity['remarks'] ?>
                                        </p>
                                    </td>
                                    <td>
                                        <button class="editActivityBtn btn btn-primary" name="activity_id"
                                            id="<?php echo $activity['activity_id'] ?>">Edit</button>

                                        <button id="<?php echo $activity['activity_id'] ?>" class="deleteBtn btn btn-danger"
                                            name="activity_id" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">Delete</button>
                                    </td>


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
    </div>
</div>

<style>
    table tbody td {
        vertical-align: middle;
    }
</style>


<!-- Set Activity -->
<div id="setModal" class="modal" style="overflow: auto;">
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
                                            <?php echo $activity['remarks'] ?>
                                        </p>
                                    </td>
                                    <td>
                                        <button class="setRemarks btn btn-primary"
                                            id="<?php echo $activity['activity_id'] ?>">Set Activity</button>
                                    </td>


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
    </div>
</div>



<?php include_once('user-footer.php') ?>