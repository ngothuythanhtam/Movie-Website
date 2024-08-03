<?php 
    session_start();
    ob_start();
    if(!isset($_SESSION['identity'])){
        header('location:../Login/login.php'); 
    }
    include "assets/php/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="jquery-3.7.1.js"></script>
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/update.css">
    <!-- = FONT && ICON =-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Serein's Home</title>
</head>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header>
        <a href="#" class="logo">
            <span id="logo"><i class="fa-brands fa-bluesky"></i></span>
            <span id="text">Serein</span>
        </a>
        <nav>
            <div class="navsearch">
                <a href="index.php">
                    <i class="fa-solid fa-house" id="search-btn"></i>
                </a>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="form-box login">
            <h2>Update Box</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                <div class="gridbox">
                    <div class="left">
                        <div class="input-box2">
                            <div class="infor"><?php echo $_SESSION['aname']?></div>
                        </div>
                        <div class="input-box2">
                            <div class="infor"><?php echo $_SESSION['email'] ?> </div>
                        </div>
                        <div class="input-box2">
                            <div class="infor"><?php echo $_SESSION['phone'] ?> </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="avt">
                            <div id=#avt><h4>Avartar</h4></div>
                            <div class="img">
                                <?php
                                    if (isset($_SESSION['id'])) {
                                        global $conn;
                                        $id = $_SESSION['id'];
                                        $admin =mysqli_query($conn,"SELECT img FROM admins WHERE id='$id'");
                                        $value = $admin->fetch_assoc();
                                        $img = $value['img'];
                                        echo "<div class='avtadmin'><img src='assets/image/$img' alt='Admin Image'></div>";
                                    }
                                    else header('location: ../Login/login.php');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="toupdate"><a href="update.php">Edit Profile</a></div>
            </form>
        </div>
    </div>
    <script src="assets/js/login.js"></script>
</body>

</html>