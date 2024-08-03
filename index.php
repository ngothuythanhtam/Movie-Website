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

if (isset($_GET['add_to_list'])) {
    $get_ip_address = getIPAddress();
    $get_movie_id = $_GET['add_to_list'];
    $select_query = "select * from `mlist` where ip_address='$get_ip_address' and movie_id=$get_movie_id and uid=$user_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows > 0) {
        echo "<script>alert('This movie is already added to list!')</script>";
    } else {
        $insert_query = "insert into `mlist` (movie_id, ip_address,uid) values($get_movie_id,'$get_ip_address','$user_id')";
        $result_query = mysqli_query($con, $insert_query);
        echo "<script>alert('Movie is added to your list!')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
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
    <?php include ('scripts.php'); ?>

    <title>Home - Sereine Movies</title>
</head>

<body>
    <main>
        <section class="home">
            <div class="headerbg ">
                <?php include ('header.php'); ?>
                <div class="home-content mtop">
                    <div class="container">
                        <div class="left">
                            <h1>Demon Slayer: Kimetsu no Yaiba Hashira</h1>

                            <div class="time flex">
                                <label>10+</label>
                                <i class='fa fa-circle'></i>
                                <span>1hrs 45mins</span>
                                <i class='fa fa-circle'></i>
                                <p>Fall 2020</p>
                                <i class='fa fa-circle'></i>
                                <button>Action</button>
                            </div>

                            <p>
                                Originally a manga created by Koyoharu Gotoge, Demon Slayer: Kimetsu no Yaiba follows
                                kindhearted charcoal seller Tanjiro, whose life changes forever when his family is
                                attacked by demons. In order to return his sister, who is now a demon, to her former
                                state and avenge his family, Tanjiro sets out on a dangerous journey.
                            </p>

                            <div class="button flex">
                                <button class="btn">PLAY NOW</button>
                                <a target='_blank' href="https://www.youtube.com/watch?v=7w5Vfjozzb8"><i id="playbtn"
                                        class="bx bx-play"></i></a>
                                <a target='_blank' href="https://www.youtube.com/watch?v=7w5Vfjozzb8">
                                    <p>WATCH TRAILER</p>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="popular mtop">
            <div class="container">

                <div class="heading flex1">
                    <h2>Most popular</h2>
                    <button class="more-vid bn22">MORE VIDEO</button>
                </div>

                <div class="owl-carousel owl-theme">
                    <?php
                    $sql = "select * from genres as g join movies m on m.g_id=g.g_id order by rand() limit 8";
                    $result = mysqli_query($con, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $movie_id = $row['movie_id'];
                            $movie_name = $row['title'];
                            $movie_genre = $row['g_name'];
                            $img_path = $row['img_path'];
                            $eps = $row['episodes'];
                            $time = $row['run_time'];
                            echo "
                            <div class='item'>
                            <div class='box'>
                                <div class='imgbox'>
                                    <img src='img/movies/$img_path' alt=''>
                                </div>
        
                                <div class='content'>
                                <a href='details.php?movie_id=$movie_id'><i id='playbtn' class='bx bx-play'></i></a>
                                </div>
        
                                <div class='text'>
                                    <a href='details.php?movie_id=$movie_id'><h3>$movie_name</h3></a>
                                    <div class='time flex1'>
                                        <span>$time</span>
                                    </div>
                                    <div class='icons'>
                                        <a href='index.php?add_to_list=$movie_id'><i class='bx bx-bookmark-plus'></i></a>
                                    </div>
                                </div>
        
                            </div>
                        </div>
                            ";
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="popular mtop">
            <div class="container">
                <div class="heading flex1">
                    <h2>Most viewed</h2>
                    <button class="more-vid bn22">MORE VIDEO</button>
                </div>

                <div class="owl-carousel owl-theme">
                    <?php
                    $sql = "select * from genres as g join movies m on m.g_id=g.g_id order by rand() limit 8";
                    $result = mysqli_query($con, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $movie_id = $row['movie_id'];
                            $movie_name = $row['title'];
                            $movie_genre = $row['g_name'];
                            $img_path = $row['img_path'];
                            $eps = $row['episodes'];
                            $time = $row['run_time'];
                            echo "
                            <div class='item'>
                            <div class='box'>
                                <div class='imgbox'>
                                    <img src='img/movies/$img_path' alt=''>
                                </div>
        
                                <div class='content'>
                                    <a href='details.php?movie_id=$movie_id'><i id='playbtn' class='bx bx-play'></i></a>
                                </div>
        
                                <div class='text'>
                                    <a href='details.php?movie_id=$movie_id'><h3>$movie_name</h3></a>
                                    <div class='time flex1'>
                                        <span>$time</span>
                                    </div>
                                    <div class='icons'>
                                        <a href='index.php?add_to_list=$movie_id'><i class='bx bx-bookmark-plus'></i></a>
                                    </div>
                                </div>
        
                            </div>
                        </div>
                            ";
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
        <script src="js/home.js"></script>

        <section class="new_release top">
            <div class="container">
                <div class="owl-carousel owl-carousel2 owl-theme">
                    <?php
                    new_release();
                    ?>
                </div>
            </div>
        </section>

        <script>
            $('.owl-carousel2').owlCarousel({
                loop: true,
                margin: 20,
                dots: false,
                nav: false,
                items: 1
            })
        </script>

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

                        <div class="checked-radio-bg"></div>
                    </div>
                </div>

                <?php

                //condition to check isset or not
                if (!isset($_GET["genre"])) {

                    if (!isset($_GET["movie_id"])) {

                        $sql = "select * from genres as g join movies m on m.g_id=g.g_id order by rand() limit 15";
                        $result = mysqli_query($con, $sql);
                        $resultCheck = mysqli_num_rows($result);

                        echo "<div class='movies-grid'>";
                        if ($resultCheck > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $movie_id = $row['movie_id'];
                                $movie_name = $row['title'];
                                $genre_id = ['g_id'];
                                $movie_genre = $row['g_name'];
                                $rating = $row['rating'];
                                $img_path = $row['img_path'];
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
                ?>

                <a href="movies.php"><button class="load-more bn bn22" onclick="">
                        LOAD MORE
                    </button>
                </a>
            </section>
        </div>
        <?php include ('footer.php');
        ?>
    </main>
</body>

</html>