<?php
include ('connect.php');
include ('function.php');
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:./Login/login.php');
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($con, "delete from `mlist` where movie_id = $remove_id");
    $success_msg[] = 'Delete Successfully!';
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

    <title>My List</title>
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
            <div class="list">
                Here is your list <i class="fa fa-heart"></i>
            </div>

            <div class="movies-grid">
                <?php
                global $con;
                $get_ip_address = getIPAddress();
                $list_query = "select * from `mlist` where mlist.ip_address='$get_ip_address' and mlist.uid='$user_id'";
                $result = mysqli_query($con, $list_query);
                $result_count = mysqli_num_rows($result);
                if ($result_count > 0) {

                    while ($row = mysqli_fetch_array($result)) {
                        $movie_id = $row['movie_id'];
                        $select_movie = "select * from `movies` as m join genres as g on g.g_id = m.g_id where m.movie_id = '$movie_id'";
                        $result_movie = mysqli_query($con, $select_movie);
                        while ($row_movie = mysqli_fetch_array($result_movie)) {
                            $movie_id = $row_movie["movie_id"];
                            $movie_name = $row_movie["title"];
                            $genre = $row_movie["g_name"];
                            $age = $row_movie["age_category"];
                            $plot = $row_movie["summary"];
                            $year = $row_movie['season'];
                            $ep = $row_movie['episodes'];
                            $rating = $row_movie['rating'];
                            $time = $row_movie['run_time'];
                            $img_path = $row_movie['img_path'];
                            ?>

                            <div class='movie_card'>
                                <div class='card-head'>
                                    <img src='img/movies/<?php echo $img_path ?>' alt='' class='card-img'>
                                    <div class='card-overlay'>
                                        <div class='bookmark'>
                                            <a href='mylist.php?remove=<?php echo $row_movie['movie_id'] ?>'
                                                onclick="return confirm('Are you sure want to remove this movie?')">
                                                <i id='trash' class='fa fa-trash'></i>
                                            </a>
                                        </div>

                                        <div class='rating'>
                                            <i class='bx bx-star'></i><span><?php echo $rating ?></span>
                                        </div>

                                        <div class='play'>
                                            <a href='details.php?movie_id=<?php echo $movie_id ?>'><i class='bx bx-play'></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class='card-body'>
                                    <h3 class='card-title'>
                                        <a href='details.php?movie_id=<?php echo $movie_id ?>'><span
                                                class='title'><?php echo $movie_name ?></span></a>
                                        <div class='card-info'>
                                            <a href='movies.php?genre=<?php echo $genre ?>'><span
                                                    class='genre'><?php echo $genre ?></span></a>
                                            <span class='season'><?php echo $year ?></span>
                                        </div>
                                    </h3>
                                </div>
                            </div>
                            <?php
                        }
                    }
                } else {
                    echo '<div class="list">
                            Your list is empty! <i class="bx bx-sad"></i></i>
                        </div>
                        <div class="movies-grid"></div>';
                }
                search_movie();
                ?>
            </div>

            <a href="movies.php">
                <button class="load-more bn bn22">DISCOVER</button>
            </a>
        </section>
    </div>
    <!-- sweetalert cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
    include 'alers.php';
    include ('footer.php');
    ?>
</body>

</html>