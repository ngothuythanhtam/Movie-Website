<?php
include ('connect.php');

//get genres
function get_genres()
{
    global $con;
    if (!isset($_GET["g_name"])) {
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
    }
}

// get year (season)
function get_season()
{
    global $con;
    $select_season = "select distinct movies.season from movies order by movies.season desc";
    $result_season = mysqli_query($con, $select_season);
    $resultCheck = mysqli_num_rows($result_season);
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result_season)) {
            $year = $row['season'];
            echo
                "<option value='$year'>$year</option>";
        }
    }
}

//new release
function new_release()
{
    global $con;
    $sql = "select * from genres as g join movies m on m.g_id=g.g_id order by rand() limit 8";
    $result = mysqli_query($con, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $movie_id = $row['movie_id'];
            $img_path = $row['img_path'];
            $movie_name = $row['title'];
            $age = $row['age_category'];
            $time = $row['run_time'];
            $year = $row['season'];
            $movie_genre = $row['g_name'];
            $plot = $row['summary'];
            echo "
                            
                            <div id='items' class='items'>
                                <div class='left'>
                                    <div class='img'>
                                        <img src='img/bg/$img_path' alt=''>
                                    </div>
                                    <div class='heading'>
                                        <h2 id='h2'><span></span> NEW RELEASE</h2>
                                        <a href='details.php?movie_id=$movie_id'><h1>$movie_name</h1></a>
                                    </div>

                                    <div class='time flex'>
                                        <label>$age</label>
                                        <i class='bx bxs-circle'></i>
                                        <span>$time</span>
                                        <i class='bx bxs-circle'></i>
                                        <a href='#' class='flex1'>
                                            <img width='48' height='48' src='https://img.icons8.com/color/48/imdb.png'
                                                alt='imdb' />
                                        </a>
                                        <i class='bx bxs-circle'></i>
                                        <p>$year</p>
                                        <i class='bx bxs-circle'></i>
                                        <button>$movie_genre</button>
                                    </div>

                                    <p>$plot</p>

                                    <div class='button flex'>
                                        <button class='btn'>PLAY NOW</button>
                                        <i id='playbtn' class='bx bx-play'></i>
                                        <p>WATCH TRAILER</p>
                                    </div>
                                </div>
                            </div>
                            ";
        }
    }
}

//searching movie
function search_movie()
{
    global $con;
    if (isset($_GET['search_data_movie'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "select * from `movies` as m join `genres` as g on m.g_id=g.g_id where title like'%$search_data_value%'";
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
                                                    <a href='movies.php?genre=$movie_genre'><span class='genre'>$movie_genre</span></a>
                                                    <span class='season'>$year</span>
                                                </div>
                                            </h3>
                                        </div>
                                    </div>
                                    ";
            }
        } else {
            echo "<h2>No result match!</h2>";
        }
    }
}

//get IP address
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip;  