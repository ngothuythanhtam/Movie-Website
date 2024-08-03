<?php
include ('connect.php');
include ('function.php');
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:./Login/login.php');
}
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

    <title>Genre - Sereine Movies</title>
</head>

<body>
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
                    <?php
                    $select_query = "select img from `users` where uid = '$user_id'";
                    $select_query = mysqli_query($con, $select_query);
                    $row = mysqli_fetch_array($select_query);
                    $img = $row["img"];
                    ?>
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
                                $select_genres = "select * from genres";
                                $result_genres = mysqli_query($con, $select_genres);
                                $resultCheck = mysqli_num_rows($result_genres);
                                if ($resultCheck > 0) {
                                    while ($row = mysqli_fetch_assoc($result_genres)) {
                                        $g_name = $row['g_name'];
                                        $g_id = $row['g_id'];
                                        echo
                                            "<li class='menu-item'>
                                                <a href='genre.php?g_name=$g_name'>$g_name</a>
                                            </li>";
                                    }
                                }
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


            <?php
            if (isset($_GET['g_name'])) {
                $g_name = $_GET['g_name'];
                $sql = "select * from genres as g join movies m on m.g_id=g.g_id where g.g_name = '$g_name' order by rand()";
                $result = mysqli_query($con, $sql);
                $resultCheck = mysqli_num_rows($result);
                echo "<div class='movies-grid'>";
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $movie_id = $row['movie_id'];
                        $movie_name = $row['title'];
                        $g_id = ['g_id'];
                        $g_name = $row['g_name'];
                        $img_path = $row['img_path'];
                        $year = $row['season'];
                        $age = $row['age_category'];
                        echo "
                                <div class='movie_card'>
                                    <div class='card-head'>
                                        <img src='img/movies/$img_path' alt='' class='card-img'>
                                        <div class='card-overlay'>
                                            <div class='bookmark'>
                                                <a href='index.php?add_to_list=$movie_id'><i class='bx bx-bookmark-plus'></i></a>
                                            </div>

                                            <div class='rating'>
                                                <i class='bx bx-star'></i><span>8.6</span>
                                            </div>

                                            <div class='play'>
                                                <a href='details.php?movie_id=$movie_id'><i class='bx bx-play'></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='card-body'>
                                        <h3 class='card-title'>
                                            <a href='details.php?movie_id=$movie_id'><span class='title'>$movie_name</span></a>
                                            <div class='card-info'>
                                                <a href='movies.php?genre=$g_name'><span class='genre'>$g_name</span></a>
                                                <span class='season'>$year</span>
                                            </div>
                                        </h3>
                                    </div>
                                </div>
                        ";
                    }
                }
                echo "</div>";
            }
            ?>
    </div>

    <button class="load-more bn bn22">
        LOAD MORE
    </button>
    </section>

    </div>
    <?php include ('footer.php'); ?>
</body>