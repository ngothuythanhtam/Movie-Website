<?php
include ('connect.php');
include ('function.php');
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

    <title> Your Profile </title>
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
                                <a href="#"> Delete Account <i class="fa-solid fa-user-xmark"></i>
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

    <div class="container">
        <div class="left">
            <img src="img/user/<?php echo $img ?>" alt="">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="update-col-sm-4">
                    <a href="edit_account.php">
                        <button type="button" name="update_user" class="btn btn-primary"> Edit Profile</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="p-right">
            <div class="p-inf">
                <table class="p-inf-data">
                    <tr class="p-data">
                        <th>
                            <h4>User Name</h4>
                        </th>
                        <td class="p-form-control  p-datauser">
                            <div class="td"><?php echo $uname ?></div>
                        </td>
                    </tr>
                    <tr class="p-data">
                        <th>
                            <h4>Email</h4>
                        </th>
                        <td class="form-control  p-datauser">
                            <div class="td"><?php echo $email ?></div>
                        </td>
                    </tr>
                    <tr class="p-data">
                        <th>
                            <h4>Phone</h4>
                        </th>
                        <td class="form-control  p-datauser">
                            <div class="td"><?php echo $phone ?></div>
                        </td>
                    </tr>
                    <tr class="p-data">
                        <th>
                            <h4>Gender</h4>
                        </th>
                        <td class="form-control  p-datauser">
                            <div class="td"><?php echo $gender ?></div>
                        </td>
                    </tr>

                    <tr class="p-data">
                        <th>
                            <h4>Password</h4>
                        </th>
                        <td class="form-control  p-datauser">
                            <div class="td"><input type="password" value="<?php echo $psswd ?>" disabled></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>