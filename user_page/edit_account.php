<?php
include ('connect.php');
include ('function.php');
include ('scripts.php');

session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:Login/login.php');
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

if (isset($_POST['update_profile'])) {

    $update_name = mysqli_real_escape_string($con, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($con, $_POST['update_email']);
    $update_phone = mysqli_real_escape_string($con, $_POST['update_phone']);
    $update_gender = mysqli_real_escape_string($con, $_POST['update_gender']);

    $update_query = mysqli_query($con, "UPDATE `users` SET uname = '$update_name', email = '$update_email', phone = '$update_phone', gender = '$update_gender' WHERE uid = '$user_id'") or die('query failed');
    if ($update_query) {
        $success_msg[] = 'Your profile has been updated successfully!';
    }

    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'img/user/' . $update_image;

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $error_msg[] = 'Image is too large';
        } else {
            $image_update_query = mysqli_query($con, "UPDATE `users` SET img = '$update_image' WHERE uid = '$user_id'") or die('query failed');
            if ($image_update_query) {
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
            }
            $success_msg[] = 'Image updated successfully!';
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

    <title> Update Profile </title>
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

                    <img src="img/user/<?php echo $img ?>" class="user-pic" onclick="toggleMenu()">

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

            <div class="p-left">
                <?php
                if ($fetch['img'] == '') {
                    echo '<img src="img/user/user.png">';
                } else {
                    echo '<img src="img/user/' . $fetch['img'] . '">';
                }
                ?>
                <div class="row">
                    <div class="update-col-sm-4">
                        <a href="profile.php">
                            <button type="button" class="btn">View Profile</button>
                        </a>
                    </div>
                </div>

            </div>

            <div class="right">
                <div class="inf">
                    <div class="inf-data">
                        <div class="data">
                            <h4>Username</h4>
                            <input type="text" name="update_name" class="datauser"
                                value="<?php echo $fetch['uname']; ?> " class="box" required><i
                                class="fa-solid fa-pen-to-square icon"></i>

                            <h4>Email</h4>
                            <input type="email" name="update_email" class="datauser"
                                value="<?php echo $fetch['email']; ?>" class="box" required><i
                                class="fa-solid fa-pen-to-square icon"></i>

                            <h4>Phone</h4>
                            <input type="text" name="update_phone" class="datauser"
                                value="<?php echo $fetch['phone']; ?>" class="box" required><i
                                class="fa-solid fa-pen-to-square icon"></i>

                            <h4>Gender</h4>
                            <input type="radio" name="update_gender" value="Male" required> Male
                            <input type="radio" name="update_gender" value="Female"> Female
                            <input type="radio" name="update_gender" value="Other"> Other


                            <h4>Avatar</h4>
                            <input type="file" name="update_image" class="datauser" accept="img/jpg, img/jpeg, img/png"
                                class="box"><i class="fa-solid fa-pen-to-square icon"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row-col-sm-4">
                        <input type="submit" value="Save profile" name="update_profile" class="btn">
                        <a href="change_password.php" class="change-pass">
                            Change Password
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