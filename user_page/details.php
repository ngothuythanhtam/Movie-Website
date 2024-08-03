<?php
include ('connect.php');
include ('function.php');
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
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
    <link rel="stylesheet" href="css/details.css">
    <link rel="stylesheet" href="css/index.css">

    <!--Link-->
    <?php include ('scripts.php') ?>

    <title>
        <?php
            if (isset($_GET['movie_id'])) {
                $movie_id = $_GET['movie_id'];
                $search_query = "select * from `movies` as m join `genres` as g on m.g_id=g.g_id where m.movie_id ='$movie_id'";
                $result = mysqli_query($con, $search_query);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $movie_id = $row['movie_id'];
                        $movie_name = $row['title'];
                        echo $movie_name;
                    }
                }
            }
        ?> - Sereine Movies
    </title>
</head>

<body>
    <?php
    include ('header.php');

    if (isset($_GET['movie_id'])) {
        $movie_id = $_GET['movie_id'];
        $search_query = "select * from `movies` as m join `genres` as g on m.g_id=g.g_id where m.movie_id='$movie_id'";
        $result = mysqli_query($con, $search_query);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $movie_id = $row['movie_id'];
                $movie_name = $row['title'];
                $genre_id = ['g_id'];
                $movie_genre = $row['g_name'];
                $img_path = $row['img_path'];
                $year = $row['season'];
                $age = $row['age_category'];
                $rating = $row['rating'];
                $plot = $row['summary'];
                $ep = $row['episodes'];
                ?>
                <div class='breaking'>
                    <div class='movie-description'>
                        <div class='movie-img'>
                            <img src='img/movies/<?php echo $img_path ?>' alt=''>
                            <a href="#review?movie_id=<?php echo $movie_id ?>"><button id="review">View Rating</button></a>
                        </div>
                        <div class='movie-content'>
                            <div class='movie-trailer'>
                                <h1><?php echo $movie_name ?></h1>
                                <div class='movie-type'>
                                    <p><?php echo $movie_genre ?></p>
                                    <div class='line'></div>
                                </div>
                            </div>
                            <div class='rating'>
                                <p>Rating: <?php echo $rating ?></p>
                                <p><?php echo $ep ?> episode(s)</p>
                                <p><?php echo $age ?></p>
                                <p>Release: <?php echo $year ?></p>
                                <p><?php echo $plot ?></p>
                            </div>
                            <div class='trailer'>
                                <div class='save'>
                                    <a href='index.php?add_to_list=<?php echo $movie_id ?>'><i
                                            class='bx bx-bookmark-plus'></i></a>
                                </div>
                                <div class='btn-trailer'>
                                    <a href="#"><button class='btn-trailer'>
                                        Watch trailer
                                    </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
    ?>
</body>