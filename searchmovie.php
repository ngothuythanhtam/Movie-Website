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
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/movie-grid.css">

    <!--Link-->
    <?php include ('scripts.php') ?>

    <title>Search movie</title>
</head>

<body>
    <main>
        <header>
            <div class="container">
                <div class="navbar flex1">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <div class="menu-main-menu-container">
                            <ul id="top-menu" class="navbar-nav ml-auto">
                                <li class="menu-item">
                                    <a href='index.php'>Home</a>
                                </li>
                                <li class="menu-item">
                                    <a href="movies.php">Movies</a>
                                </li>
                                <li class="menu-item">
                                    <a href="library.php">Library</a>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <div class="login flex">
                        <div class="navbar-right menu-right">
                            <ul class="d-flex align-items-center list-inline m-0">
                                <li class="nav-item nav-icon">
                                    <div class="search-box iq-search-bar d-search">
                                        <form action="#" class="searchbox">
                                            <div class="form-group position-relative">
                                                <input type="text" class="text search-input font-size-12"
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
                        <a href="profile.php">
                            <img src="img/user/<?php echo $img ?>" class="user-pic">
                        </a>

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

        <div class="ctn">
            <section class="movies">
                <div class="filter-bar">
                    <div class="filter-dropdowns">
                        <nav class="navbar navbar-expand-lg navbar-light p-0">
                            <div class="menu-main-menu-container">
                                <ul id="top-menu" class="navbar-nav ml-auto">
                                    <?php
                                    get_genres();
                                    ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="filter-radios">
                        <input type="radio" name="grade" id="featured" checked>
                        <label for="featured">Featured</label>

                        <input type="radio" name="grade" id="newest" checked>
                        <label for="newest">Newest</label>

                        <select name="seasons" class="seasons">
                            <option value="All seasons">All seasons</option>
                            <?php
                            get_season();
                            ?>
                        </select>
                    </div>
                </div>
                <div class="movies-grid">
                    <?php
                    search_movie();
                    ?>
                </div>

                <button class="load-more bn bn22">
                    LOAD MORE
                </button>
            </section>
        </div>

        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap//js/popper.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <?php include ('footer.php') ?>

    </main>
</body>

</html>