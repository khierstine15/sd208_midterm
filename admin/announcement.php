<?php
include_once("../Included/dbconnect/connection.php");
$con = connection();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission and database insertion here
    $announcementTitle = $_POST['announcementTitle'];
    $announcementText = $_POST['announcementText'];


    // Perform the database insertion using SQL queries
    $sql = "INSERT INTO announcement (announcement_title, announcement) VALUES ('$announcementTitle', '$announcementText')";

    if (mysqli_query($con, $sql)) {
        // Insertion was successful, redirect to dashboard.php
        header("Location: dashboard.php");
    } else {
        // Handle the case where insertion failed (e.g., display an error message)
        echo "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>