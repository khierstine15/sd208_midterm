<?php include_once('dash-header.php') ?>

<?php include_once('sideBar.php') ?>

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


    /* Profile */
    .heading {
        font-size: 2.5rem;
        color: var(--black);
        border-bottom: var(--border);
        padding-bottom: 1.5rem;
        text-transform: capitalize;
        text-align: center;
    }

    .user-profile {
        position: relative;
        
        
    }
    .user-profile  a.back {
            position: absolute;
            left: 0;
            font-size: 18px;

        }

    .user-profile .info {
        background-color: var(--white);
        border-radius: 0.5rem;
        padding: 2rem;
    }

    .user-profile .info .user {
        text-align: center;
        margin-bottom: 2rem;
        padding: 1rem;
    }

    .user-profile .info .user img {
        height: 10rem;
        width: 10rem;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1rem;
    }

    .user-profile .info .user h3 {
        font-size: 2rem;
        color: var(--black);
    }

    .user-profile .info .user p {
        font-size: 1.7rem;
        color: var(--light-color);
        padding: 0.3rem 0;
    }

    .user-profile .info .box-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .user-profile .info .box-container .box {
        background-color: var(--light-bg);
        border-radius: 0.5rem;
        padding: 2rem;
        flex: 1 1 25rem;
    }

    .user-profile .info .box-container .box .flex {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-bottom: 1rem;
    }

    .user-profile .info .box-container .box .flex i {
        font-size: 2rem !important;
        color: var(--white);
        background-color: var(--black);
        text-align: center;
        border-radius: 0.5rem;
        height: 5rem;
        width: 5rem;
        line-height: 4.9rem;
    }

    .user-profile .info .box-container .box .flex span {
        font-size: 2.5rem;
        color: var(--main-color);
    }

    .user-profile .info .box-container .box .flex p {
        color: var(--light-color);
        font-size: 1.7rem;
        margin-bottom: 0;
    }
</style>

<main id="main" class="main" style='margin-top:60px;'>

    <?php
    $accountID = $_GET['id'];

    $sql = "SELECT * FROM user WHERE ID = '" . $accountID . "'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    ?>
    <section class="user-profile">
        <a class="back btn btn-primary" href="dashboard.php#list-user">Back</a>

        <h1 class="heading">View Account</h1>

        <div class="info">

            <div class="user">
                <img src="../act-img/profile-img.jpg" alt="">
                <h3>
                    <?php echo $row['Firstname'] . " " . $row['Lastname'] ?>
                </h3>
                <p>
                    <?php echo $row['Role'] ?>
                </p>
                <a class="btn btn-primary" href="editAccount.php?id=<?php echo $accountID ?>">Update profile</a>
            </div>

            <div class="box-container">

                <div class="box">
                    <div class="flex">
                        <i class="bi bi-bookmark"></i>
                        <div>
                            <span>4</span>
                            <p>total activities</p>
                        </div>
                    </div>
                    <a class="btn btn-primary" href="">view activities</a>
                </div>

                <div class="box">
                    <div class="flex">
                        <i class="bi bi-heart"></i>
                        <div>
                            <span>33</span>
                            <p>activities liked</p>
                        </div>
                    </div>
                    <a class="btn btn-primary" href="">view liked</a>
                </div>

            </div>
        </div>

    </section>



</main>














<?php include_once('dash-footer.php') ?>