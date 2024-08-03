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
    <!--Link-->
    <?php include ('scripts.php') ?>

    <title>All movies - Sereine Movies</title>
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
                                <a href="#">Movies</a>
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
            //condition to check isset or not
            if (!isset($_GET["genre"])) {
                if (!isset($_GET["movie_id"])) {
                    $sql = "select * from genres as g join movies m on m.g_id=g.g_id";
                    $result = mysqli_query($con, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    $numberPages = 10;
                    $totalPages = ceil($resultCheck / $numberPages);
                    //echo $totalPages;
                    //creating pagination buttons
                    for ($btn = 1; $btn <= $totalPages; $btn++) {
                        echo '<a href="movies.php?page=' . $btn . '"><button id="loader">' . $btn . '</button></a>';
                    }
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $startinglimit = ($page - 1) * $numberPages;
                    $sql = "select * from genres as g join movies m on m.g_id=g.g_id LIMIT " . $startinglimit . ',' . $numberPages;
                    $result = mysqli_query($con, $sql);

                    echo "<div class='movies-grid'>";
                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $movie_id = $row['movie_id'];
                            $movie_name = $row['title'];
                            $genre_id = ['g_id'];
                            $movie_genre = $row['g_name'];
                            $img_path = $row['img_path'];
                            $rating = $row['rating'];
                            $year = $row['season'];
                            echo "
                                            <div class='movie_card'>
                                                <div class='card-head'>
                                                    <img src='img/movies/$img_path' alt='' class='card-img'>
                                                    <div class='card-overlay'>
                                                        <div class='bookmark'>
                                                        <a href='index.php?add_to_list=$movie_id'><i class='bx bx-bookmark-plus'></i></a>
                                                        </div>

                                                        <div class='rating'>
                                                            <i class='bx bx-star'></i><span>$rating</span>
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
                                                            <a href='movies.php?genre=$movie_genre'><span class='genre'>$movie_genre</span></a>
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
            }
            search_movie();
            ?>
        </section>

    </div>
    <?php include ('footer.php'); ?>
</body>

</html>