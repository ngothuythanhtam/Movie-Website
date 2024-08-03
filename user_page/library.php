<?php
include ('connect.php');
include ('function.php');
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:Login/login.php');
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
    <link rel="stylesheet" href="css/library.css">
    <!--Link-->
    <?php include ('scripts.php') ?>

    <title>Sereine Library</title>
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
                    $userid = $_SESSION['user_id'];
                    $user_img = "select * from `users` where uid = '$userid'";
                    $user_img = mysqli_query($con, $user_img);
                    $row_img = mysqli_fetch_array($user_img);
                    $user_img = $row_img["img"];
                    ?>

                    <a href="profile.php">
                        <img src="img/user/<?php echo $user_img ?>" class="user-pic">
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
                <?php
                search_movie();
                ?>
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
            <?php
            $select_movie = "select * from `movies` as m join genres as g on g.g_id = m.g_id order by movie_id ";
            $result_movie = mysqli_query($con, $select_movie);
            $count_movie = mysqli_num_rows($result_movie);

            $numberPages = 10;
            $totalPages = ceil($count_movie / $numberPages);
            //echo $totalPages;
            //creating pagination buttons
            for ($btn = 1; $btn <= $totalPages; $btn++) {
                echo '<a href="library.php?page=' . $btn . '"><button id="loader_lib">' . $btn . '</button></a>';

            } ?>
            <div class="tb">
                <div class="table">
                    <div class="table-header">
                        Our Library <i class="fa fa-heart"></i>
                    </div>
                    <div class="table-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th></th>
                                    <th>Title</th>
                                    <th>Genre</th>
                                    <th>Age</th>
                                    <th>Year</th>
                                    <th>Episodes</th>
                                    <th>Duration</th>
                                    <th>Plot</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                } else {
                                    $page = 1;
                                }
                                $startinglimit = ($page - 1) * $numberPages;
                                $sql = "select * from `movies` as m join genres as g on g.g_id = m.g_id order by movie_id LIMIT " . $startinglimit . ',' . $numberPages;
                                $result_movie = mysqli_query($con, $sql);

                                if ($count_movie > 0) {
                                    while ($row_movie = mysqli_fetch_assoc($result_movie)) {
                                        $movie_id = $row_movie["movie_id"];
                                        $movie_name = $row_movie["title"];
                                        $age = $row_movie["age_category"];
                                        $plot = $row_movie["summary"];
                                        $year = $row_movie['season'];
                                        $ep = $row_movie['episodes'];
                                        $time = $row_movie['run_time'];
                                        $img_path = $row_movie['img_path'];
                                        $g_name = $row_movie["g_name"];
                                        $rating = $row_movie["rating"];

                                        echo "
                                        <tr>
                                            <td>$movie_id</td>
                                            <td><img src='img/movies/$img_path' alt=''></td>
                                            <td>$movie_name</td>
                                            <td>$g_name</td>
                                            <td>$age</td>
                                            <td>$year</td>
                                            <td>$ep</td>
                                            <td>$time</td>
                                            <td>$plot</td>
                                            <td>$rating</td>
                                        </tr>
                                        ";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <?php include ('footer.php'); ?>
</body>

</html>