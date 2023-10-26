

<?php

include_once('dash-header.php');
include_once('sideBar.php');

$accountID = $_GET['id'];

$sql = "SELECT * FROM user WHERE ID = '" . $accountID . "'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$_SESSION['status'] = "";

if (isset($_POST['updateAccount'])) {
    $accountId = $_POST['updateId'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Check if any changes are made in the form
    if ($fname == $row['Firsname'] && $lname == $row['Lastname'] && $gender == $row['Gender'] && $address == $row['Address'] && $email == $row['Email']&& $role == $row['Role']) {
        $_SESSION['status'] = "fail";
        $_SESSION['message'] = 'Account not Updated!';
    } else {
        $stmt = $con->prepare("UPDATE `user` SET `firstName` = ?, `lastName` = ?, `gender` = ?, `address` = ?, `email` = ?, `Role` = ? WHERE `ID` = $accountId");
        $stmt->bind_param("ssssss", $fname, $lname, $gender, $address, $email,$role);

        if ($stmt->execute()) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = 'Account Updated Successfully!';

        } else {
            $_SESSION['status'] = "fail";
            $_SESSION['message'] = 'Account Update Failed!';
        }
    }
}
?>

<style>
    :root {
        --main-color: #3080f5;
        --red: #e74c3c;
        --orange: #f39c12;
        --light-color: #888;
        --light-bg: #eee;
        --black: #2c3e50;
        --white: #fff;
        --border: 0.1rem solid rgba(0, 0, 0, 0.2);
    }



    .pagetitle {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 10px 0;

        
    }
    .pagetitle a {
            position: absolute;
            top: 10px;
            left: 0;
            font-size: 18px;
        }


    .form-container {
        min-height: calc(100vh - 20rem);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-container form {
        background-color: var(--white);
        border-radius: .5rem;
        padding: 2rem;
        width: 35rem;
    }

    .form-container form h3 {
        font-size: 1.5rem;
        font-weight: 800;
        text-transform: capitalize;
        color: var(--black);
        text-align: center;
    }

    .form-container form p {
        color: var(--light-color);
        padding-top: 1rem;
        margin-bottom: 0;
    }

    .form-container form p span {
        color: var(--red);
    }

    .form-container form .box {
        color: var(--black);
        border-radius: .5rem;
        padding: 1.4rem;
        background-color: var(--light-bg);
        width: 100%;
        border: none;
        outline: none;
        margin-bottom: 1rem;
    }

    .form-container form .box:focus {
        border: 1px solid #0d6efd;

    }

    #updateUser {
        background-color: var(--main-color);
        display: block;
        width: 100%;
        border-radius: 0.5rem;
        color: #fff;
        font-size: 1rem;
        cursor: pointer;
        text-transform: capitalize;
        padding: 1rem 3rem;
        text-align: center;
    }

    .popup {
        position: fixed;
        top: -50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 99999;
        background: #212529ba;
        color: #fff;
        padding: 10px;
        animation: slideDown 5s ease-in-out;
        transition: 1s ease-in-out;
    }

    @keyframes slideDown {

        0%,
        100% {
            top: -50%;
        }

        25%,
        50%,
        75% {
            top: 20px;
        }
    }
</style>



<main id="main" class="main" style='margin-top:0px;'>
    <div class="pagetitle">
        <a class="btn btn-primary" href="dashboard.php#list-user">Back</a>
        <div class="back">

        </div>
    </div>




    <section class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- <?php if ($_SESSION['status'] === '' || $_SESSION['status'] == 'fail') { ?>
                <div class="alert alert-warning alert-dismissable fade show" role="alert">
                    <strong>
                        Account Not update!
                    </strong>
                </div>
            <?php } ?> -->

            <h3> Update profile</h3>
            <p> Firstname</p>
            <input type="hidden" name="updateId" class="box" value='<?php echo $row['ID'] ?>'>
            <input type="text" name="firstname" class="box" value='<?php echo $row['Firstname'] ?>'>
            <p> Lastname</p>
            <input type="text" name="lastname" class="box" value='<?php echo $row['Lastname'] ?>'>
            <p> Gender</p>
            <input type="text" name="gender" class="box" value='<?php echo $row['Gender'] ?>'>
            <p> Address</p>
            <input type="text" name="address" class="box" value='<?php echo $row['Address'] ?>'>
            <p> Email</p>
            <input type="email" name="email" class="box" value='<?php echo $row['Email'] ?>'>
            <p> Role</p>
            <input type="text" name="role" class="box" value='<?php echo $row['Role'] ?>'>
            <!-- <p> pic</p>
            <input type="file" accept="image/*" class="box" name="pro-img"> -->
            <input id="updateUser" class="btn btn-primary" type="submit" name="updateAccount" value="Update">
        </form>

    </section>


</main>


<?php if ($_SESSION['status'] === 'success') { ?>
    <div id="updateSuccess" class="modal" style="display:block;">
        <div class='modal-content' style='padding:20px; padding-bottom: 5px;'>
            <span class='close'>&times;</span>
            <header>Update Successfully</header>
            <div class='modal-body'>
                <?php echo $_SESSION['message']; ?>

            </div>
            <div class='modal-footer'>
                <button class='btn btn-primary' id='cancelModal'>Cancel</button>
                <button class='btn btn-primary' id='done'>Done</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("cancelModal").addEventListener("click", function () {
            document.getElementById("updateSuccess").style.display = "none";
        });

        document.getElementById("done").addEventListener("click", function () {
            window.location = 'viewAccount.php?id=' + <?php echo $accountID ?>

        });
    </script>

    <?php
    // Reset session variables to empty strings
    $_SESSION['status'] = '';
    $_SESSION['message'] = '';
    ?>

<?php } ?>


<?php include_once('dash-footer.php') ?>