<?php 
    session_start();
    ob_start();
    include('../admin_page/assets/php/connect.php');
    if(!isset($_SESSION['identity'])){
        header('location:../Login/login.php'); 
    }
    if (isset($_SESSION['id']) &&$_SESSION['id']){

        if (isset($_POST['upd'])&&$_POST['upd']) {
            $aid = $_SESSION['id'];
            $aname = $_POST['aname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $update = $conn->prepare("UPDATE admins SET aname = ?, email = ?, phone = ? WHERE id = ?");
            $update->bind_param("sssi", $aname, $email, $phone, $aid);
            $update->execute();

            $img = $_FILES['img']['name'];
            $img_tmp_name = $_FILES['img']['tmp_name'];
            $img_folder = 'assets/image/' . $img;
            $img_size = $_FILES['img']['size'];

            if (!empty($img)) {
                if ($img_size > 2000000) {
                    echo "<script>alert('Fail!')</script>"; 
                } else {
                    $img_update = $conn->prepare("UPDATE admins SET img = ? WHERE id = ?");
                    $img_update->bind_param("si", $img, $aid);
                    $img_update->execute();
                    if ($img_update) {
                        move_uploaded_file($img_tmp_name, $img_folder);
                    }
                    echo "<script>alert('Updated successfully!')</script>"; 
                }
            }
            header('Location: showupdate.php');
        }
    }
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
                        <div class="input-box">
                            <span class="icon"><i class="fa-solid fa-file-signature"></i></span>
                            <input type="text" value=<?php echo $_SESSION['aname'] ?> name="aname">
                        </div>
                        <div class="input-box">
                            <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" value=<?php echo $_SESSION['email'] ?> name="email">
                        </div>
                    </div>
                    <div class="right">
                        <div class="input-box">
                            <span class="icon"><i class="fa-solid fa-phone"></i></span>
                            <input type="text" value=<?php echo $_SESSION['phone'] ?> name="phone">
                        </div>
                        <div class="upload">
                            <h4>Avartar</h4>
                            <input type="file" class="form-control datauser" name="img" id="file" accept="img/jpg, img/jpeg, img/png">
                        </div>
                    </div>
                </div>
                <input type="submit" class="button" name="upd" value="Update Now">     
            </form>
        </div>
    </div>
    <script src="assets/js/login.js"></script>
</body>

</html>