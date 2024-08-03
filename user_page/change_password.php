<?php
include ('connect.php');
include ('function.php');

session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:./Login/login.php');
}

$select_query = "select * from `users` where uid = '$user_id'";
$select_query = mysqli_query($con, $select_query);
$row = mysqli_fetch_array($select_query);
$uname = $row["uname"];
$img = $row["img"];
$email = $row['email'];
$phone = $row['phone'];
$psswd = $row['psswd'];
$gender = $row['gender'];

if (isset($_POST['update_password'])) {
    $old_pass = $_POST['old_pass'];
    $update_pass = mysqli_real_escape_string($con, ($_POST['update_pass']));
    $new_pass = mysqli_real_escape_string($con, ($_POST['new_pass']));
    $confirm_pass = mysqli_real_escape_string($con, ($_POST['confirm_pass']));

    if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
        if ($update_pass != $old_pass) {
            $error_msg[] = 'Old password not matched!';
        } elseif ($new_pass != $confirm_pass) {
            $error_msg[] = 'Confirm password not matched!';
        } else {
            mysqli_query($con, "UPDATE `users` SET psswd = '$confirm_pass' WHERE uid = '$user_id'") or die('query failed');
            $success_msg[] = 'Your password has been updated successfully!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS-->
    <link rel="stylesheet" href="css/profile.css">

    <!--Link-->
    <?php include ('scripts.php') ?>

    <title> Change Password </title>
</head>

<body>
    <header>
        <div class="containnavbar">
            <div class="navbar flex1">
                <nav class="navbar">
                    <div class="menu-main-menu-container">
                        <ul id="top-menu" class=" ">
                            <li class="menu-item">
                                <a href='index.php'>Home</a>
                            </li>
                            <li class="menu-item">
                                <a href="profile.php">
                                    My Profile
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#"> Delete Account <i
                                        class="fa-solid fa-user-xmark"></i>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="logout.php"> Logout <i class="fa-solid fa-right-from-bracket"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="login flex">
                    <div class=" ">
                        <ul class="">
                            <li class="">
                                <div class="search-box iq-search-bar d-search">
                                    <form action="searchmovie.php" method="get" class="searchbox">
                                        <div class="form-group position-relative">
                                            <input type="search" class="text search-input font-size-12"
                                                placeholder="Type here to search..." aria-label="Search"
                                                name="search_data">
                                            <input type="submit" value="Search" class="btn" id="btn"
                                                name="search_data_movie">
                                            <i class="search-link fa fa-search"></i>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <img src="img/user/<?php echo $img ?>" class="user-pic">

                    <div class="notify">
                        <a href="mylist.php" class="notify">
                            <i class="bx bx-movie-play bn22">
                                <span>
                                    <sup>
                                        <?php
                                        if (isset($_GET['add_to_list'])) {
                                            global $con;
                                            $get_ip_address = getIPAddress();
                                            $select_query = "select * from `mlist` where ip_address='$get_ip_address' and uid='$user_id'";
                                            $result_query = mysqli_query($con, $select_query);
                                            $count_movie_items = mysqli_num_rows($result_query);
                                        } else {
                                            global $con;
                                            $get_ip_address = getIPAddress();
                                            $select_query = "select * from `mlist` where ip_address='$get_ip_address' and uid='$user_id'";
                                            $result_query = mysqli_query($con, $select_query);
                                            $count_movie_items = mysqli_num_rows($result_query);
                                        }
                                        echo $count_movie_items;
                                        ?>
                                    </sup>
                                </span>
                            </i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="container">
            <?php
            $select = mysqli_query($con, "SELECT * FROM `users` WHERE uid = '$user_id'") or die('query failed');
            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
            }
            ?>

            <div class="left">
                <?php
                if ($fetch['img'] == '') {
                    echo '<img src="img/user/user.png">';
                } else {
                    echo '<img src="img/user/' . $fetch['img'] . '">';
                }
                if (isset($message)) {
                    foreach ($message as $message) {
                        echo '<div class="message">' . $message . '</div>';
                    }
                }
                ?>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="update-col-sm-4">

                        <a href="profile.php">
                            <button type="button" class="btn"> View Profile</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="inf">
                    <div class="inf-data">
                        <div class="data">
                            <input type="hidden" name="old_pass" class="datauser"
                                value="<?php echo $fetch['psswd']; ?>">

                            <h4>Old password</h4>
                            <input type="password" name="update_pass" class="datauser"
                                placeholder=" Enter previous password" class="box" required><i
                                class="fa-solid fa-pen-to-square icon"></i>

                            <h4>New password</h4>
                            <input type="password" name="new_pass" class="datauser" placeholder=" Enter new password"
                                class="box" required><i class="fa-solid fa-pen-to-square icon"></i>

                            <h4>Confirm password</h4>
                            <input type="password" name="confirm_pass" class="datauser"
                                placeholder=" Confirm new password" class="box" required><i
                                class="fa-solid fa-pen-to-square icon"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row-col-sm-4">
                        <a href="profile.php">
                            <input type="submit" value="Save Password" name="update_password" class="btn">
                        </a>
                        <a href="edit_account.php" class="change-pass">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- sweetalert cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include 'alers.php'; ?>
</body>

</html>