<?php
include_once("./Included/dbconnect/connection.php");
$con = connection();


if (isset($_POST["activity_id"])) {
    $activity_id = $_POST["activity_id"];

    // Update the activity status to "Done" in the database
    $query = "UPDATE activities SET Status = 'Cancelled'  WHERE activity_id = '$activity_id'";
    if (mysqli_query($con, $query)) {
       
    } else {
        echo 'error'; // Send an error response to the AJAX request
    }
}
?>
<script>window.location.href = 'user.php';</script>