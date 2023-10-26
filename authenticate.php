<?php
session_start();

include_once("Included/dbconnect/connection.php");
$con = connection();

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT * FROM user WHERE Email = '".$email."' and Password = '".$password."'";
$result = $con->query($sql);
$row = $result->fetch_assoc();


if (isset($_POST['login'])) {
    if ($row !== null && $row["Email"] == $email && $row["Password"] == $password) {
        if ($row["Role"] == "admin") {
            header("Location: admin/dashboard.php");
        } 
        else if ($row["Role"] == "user") {
            header("Location: user.php");
        }

        $_SESSION["ID"] = $row["ID"];
        $_SESSION["Role"] = $row["Role"];
    } else {
        echo "<script>alert('Incorrect username or password!')</script>";
        echo "<script>window.location.href = 'login.html'</script>";
    }
}

closeConnection();
?>