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
            <div class="sidebar" id="navbar">
                <nav class="nav">
                    <div class="top-left">
                        <ion-icon name="menu-outline" class="navtoggle" id="nav-toggle"></ion-icon>
                        <a href="#" class="logo">
                            <span><i class="fa-brands fa-bluesky"></i></span>
                            <h2><span class="danger">Serein</span> </h2>
                        </a>
                    </div>
                    <div class="nav__list">
                        <a href="#edit.php" class="navlink">
                            <ion-icon name="home-outline" class="icon"></ion-icon>
                            <span class="navname">Dashboard</span>
                        </a>
                        <a href="#edit.php" class="navlink">
                            <ion-icon name="chatbubbles-outline" class="icon"></ion-icon>
                            <span class="navname">Messenger</span>
                        </a>
                        <div class="navlink collapse">
                            <ion-icon name="folder-outline" class="icon"></ion-icon>
                            <span class="navname">Projects</span>

                            <ion-icon name="chevron-down-outline" class="collapselink"></ion-icon>

                            <ul class="menu">
                                <a href="#edit.php" class="sublink">Add</a>
                                <a href="#edit.php" class="sublink">Remove</a>
                                <a href="#edit.php" class="sublink">Update</a>
                            </ul>
                        </div>

                        <a href="#edit.php" class="navlink">
                        <ion-icon name="pie-chart-outline" class="icon"></ion-icon>
                            <span class="navname">Analytics</span>
                        </a>
                        <div class="navlink collapse">
                            <ion-icon name="people-outline" class="icon"></ion-icon>
                            <span class="navname">Team</span>

                            <ion-icon name="chevron-down-outline" class="collapselink"></ion-icon>

                            <ul class="menu">
                                <a href="#edit.php" class="sublink">Data</a>
                                <a href="#edit.php" class="sublink">Group</a>
                                <a href="#edit.php" class="sublink">Members</a>
                            </ul>
                        </div>
                        <a href="showupdate.php" class="navlink">
                            <ion-icon name="person-outline"class="icon"></ion-icon>
                            <span class="navname">Account</span>
                        </a>
                        <a href="#edit.php" class="navlink">
                            <ion-icon name="settings-outline" class="icon"></ion-icon>
                            <span class="navname">Settings</span>
                        </a>
                    </div>
                    <a href="index.php?act=logout" class="navlink">
                        <ion-icon name="log-out-outline" class="icon"></ion-icon>
                        <span class="navname">Log Out</span>
                    </a>
                </nav>
            </div>
            <div class="calendar">
                <div class="namead">
                    <h3>Hi,
                        <span>
                            <?php 
                                if(isset($_SESSION['aname']) && $_SESSION['aname'] != "") {
                                    echo $_SESSION['aname'];
                            }
                            ?>
                        </span>
                        <span class="adicon"><i class="fa-solid fa-heart"></i>
                    </h3>
                </div>
                <div class="date">
                    <ion-icon name="calendar-outline"></ion-icon>
                    <span id="date"></span>
                </div>
                <nav class="boxsearch">
                    <div class="navsearch">
                        <i class="fa-solid fa-magnifying-glass" id="search-btn"></i>
                    </div>
                    <div class="img"><a href="showupdate.php">
                        <?php
                            if (isset($_SESSION['id'])) {
                                global $conn;
                                $id = $_SESSION['id'];
                                $admin =mysqli_query($conn,"SELECT img FROM admins WHERE id='$id'");
                                $value = $admin->fetch_assoc();
                                $img = $value['img'];
                                echo "<div class='avtadmin'><img src='assets/image/$img' ></div>";
                                }
                            else header('location: ../Login/login.php');
                        ?></a>
                    </div>
                </nav>
            </div>
            <main id="content">
                <div>
                <h1 style="margin-top: 20px;margin-left:20px;">Dashboard</h1>
                    <div class="inside">
                        <div class="add">
                            <span><i class="fa-solid fa-plus"></i></span>
                            <div class="middle">
                                <div class="left">
                                    <h3>New</h3>
                                    <h1>
                                        <span id="sum_user">
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
                                        </span>films
                                    </h1>
                                </div>
                            </div>
                            <small id="lastline">Last 24 Hours</small>
                        </div>
                        <div class="update">
                            <span><i class="fa-solid fa-pen-to-square"></i></span>
                            <div class="middle">
                                <div class="left">
                                    <h3>Update</h3>
                                    <h1>
                                        <span id="sum_user">
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
                                        </span>films
                                    </h1>
                                </div>
                            </div>
                            <small id="lastline">Last 24 Hours</small>
                        </div>
                        <div class="m_user">
                            <span> <i class="fa-solid fa-user-gear"></i></span>
                            <div class="middle">
                                <div class="left">
                                    <h3>Account</h3>
                                    <h1>
                                        <span id="sum_user">
                                        <?php
                                        function user(){
                                            include 'assets/php/connect.php';
                                            $sum = "SELECT COUNT(uid) AS total FROM users";
                                            $result = $conn->query($sum);
                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                $total= $row["total"];
                                                return $total;
                                            } else return 0;
                                        }
                                        $total=user();
                                        echo $total;
                                    ?>
                                        </span>users
                                    </h1>
                                </div>
                            </div>
                            <small id="lastline">Last 24 Hours</small>
                        </div>
                    </div>

                    <div class="data">
                        <div class="navtitle">
                            <h2 style="margin-left:20px;">Movies</h2>
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
                                </tr>
                            </thead>
                            <tbody id="content">
                                <?php
                                gethome();
                                ?>  
                            </tbody>
                        </table>
                    </div>
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
            