<?php
session_start();

include_once('Included/dbconnect/connection.php');

$con = connection();

if (isset($_POST['submit'])) {
    if ($_POST['password'] == $_POST['confirm-password']) {

        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = 'user';
        $status = 'active';

        // Check if email already exists
        $emailExist = "SELECT COUNT(*) as emailCount FROM user WHERE Email = '$email'";
        $emailResult = $con->query($emailExist);
        $emailRow = $emailResult->fetch_assoc();

        if ($emailRow['emailCount'] > 0) {
            echo "<script language='javascript'>
                    alert('Email already exists!');
                    window.location.href ='register.html';
                  </script>";
            exit;
        }

        // Prepare and bind the values to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO `user` (`Firstname`, `Lastname`, `Gender`, `Address`, `Email`, `Password`, `Role`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $fname, $lname, $gender, $address, $email, $password, $role, $status);

        if ($stmt->execute()) {
            $sql = "SELECT * FROM user WHERE Email = '" . $email . "' and Password = '" . $password . "'";
            $result = $con->query($sql);
            $row = $result->fetch_assoc();

            echo "<script language='javascript'>
            alert('Registered Successfully!');
            </script>";

            $_SESSION['ID'] = $row['ID'];
            $_SESSION['Role'] = $row['Role'];

            header('Location: user.php');
            exit;
        } else {
            echo 'Error: ' . $stmt->error;
        }

        $stmt->close();
        $con->close();

    } else {
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        echo "<script>
                alert('Password is Incorrect!');
                window.location.href ='register.html';            
            </script>";
        exit;
    }
}
?>