<?php 
    include('assets/php/function.php');
    session_start();
    ob_start();
    if(!isset($_SESSION['identity'])){
        header('location:../Login/login.php'); 
    }
    delete();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="jquery-3.7.1.js"></script>
        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/manage.css">
        <!-- = FONT && ICON =-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Jua&family=Mandali&family=Raleway:ital,wght@0,100..900;1,100..900&family=Tilt+Neon&display=swap" rel="stylesheet">
        <title>Serein's Home</title>
    </head>
    <body id="body-pd">
        <div class="container">
            <main>
                <h1 style="margin-top: 20px;margin-left:20px;">Manage Animations</h1>
                <div class="baredit">
                    <div class="total">
                        <div class="middle">
                            <div class="left">
                                <span>Total</span>
                                <h1>
                                    <?php
                                        function total(){
                                            include 'assets/php/connect.php';
                                            $sum = "SELECT COUNT(movie_id) AS total FROM movies";
                                            $result = $conn->query($sum);
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                $total= $row["total"];
                                                return $total;
                                            } else return 0;
                                        }
                                        $total=total();
                                        echo $total;
                                    ?>
                                </h1>
                                <small>The total of movies</small>
                            </div>
                            <div class="edit_icon">
                                <ion-icon name="film-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                    <div class="processing">
                        <div class="middle">
                            <div class="left">
                                <span>Upload </span>
                                <h1>
                                    <?php
                                        function processing(){
                                            include 'assets/php/connect.php';
                                            $sum = "SELECT COUNT(movie_id) AS total FROM movies WHERE status = 0";
                                            $result = $conn->query($sum);
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                $total= $row["total"];
                                                return $total;
                                            } else return 0;
                                        }
                                        $total=processing();
                                        echo $total;
                                    ?>
                                </h1>
                                <small>Attraction of movies</small>
                            </div>
                            <div class="edit_icon">
                                <ion-icon name="cloud-upload-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                    <div class="finish">
                        <div class="middle">
                            <div class="left">
                                <span>Complete</span>
                                <h1>
                                <?php 
                                    function finish(){
                                        include 'assets/php/connect.php';
                                        $sum = "SELECT COUNT(movie_id) AS total FROM movies WHERE status = 1";
                                        $result = $conn->query($sum);
                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $total= $row["total"];
                                            return $total;
                                        } else return 0;
                                    }                                        
                                    $total=finish();
                                    echo $total;
                                ?>
                                </h1>
                                <small>Finished movies</small>
                            </div>
                            <div class="edit_icon">
                                <ion-icon name="cloud-done-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                    <div class="return">
                        <a href="index.php">
                            <div class="homereturn"><h1>Home</h1>
                            </div>         
                        </a>
                    </div>
                </div>
                <div class="data">
                    <div class="navtitle">
                        <h2>Movies</h2>
                        <div>
                            <form action="edit.php?pg=movie" method="post">
                                <input type="text" class="text" name="text" id="" placeholder="Find something...">
                                <input type="submit" name="search" value="Search" class="button">
                            </form>
                        </div>
                    </div>
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Genres</th>
                                <th>Episodes</th>
                                <th>Status</th>
                                <th>Update</th>
                            </tr>
                        </thead>
                        <tbody id="content">
                            <?php
                                getall();
                            ?>  
                        </tbody>
                    </table>
                </div>
            </main>  
        </div>
        <div class="search" id="search">
            <i class="fa-solid fa-xmark" id="searchclose"></i>
            <form action="" class="searchform">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="What are you looking for, bae?" class="searchinput">
            </form>
        </div>
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>             
        <!-- ===== MAIN JS ===== -->
        <script src="assets/js/main.js"></script>
        <script src="assets/js/admin.js"></script>
    </body>
</html>
            
                    


        