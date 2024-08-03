<?php
session_start();
ob_start();
include 'admin/connect.php';
include 'admin/function.php';
include '../function.php';

if (isset($_POST['login']) && $_POST['login']) {
    $email = $_POST['email'];
    $psswd = $_POST['psswd'];
    $id = $_POST['idadmin'];

    $select_users = mysqli_query($conn, "SELECT uid FROM `users` WHERE email = '$email' AND psswd = '$psswd'") or die('query failed');
    $row = mysqli_fetch_assoc($select_users);

    $identity = check($email, $psswd, $id);
    $_SESSION['identity'] = $identity;

    if ($identity == 1) {
        $user = $conn->prepare("SELECT uname FROM users WHERE email=?");
        $user->bind_param("s", $email);
        $user->execute();
        $result = $user->get_result();
        $value = $result->fetch_assoc();
        $_SESSION['uname'] = $value['uname'];
        $_SESSION['user_id'] = $row['uid'];
        $_SESSION['uname'] = $row['uname'];

        header('location:../index.php');
    } else if ($identity == 2) {
        $admin = $conn->prepare("SELECT * FROM admins WHERE email=?");
        $admin->bind_param("s", $email);
        $admin->execute();
        $result = $admin->get_result();
        $value = $result->fetch_assoc();
        $_SESSION['aname'] = $value['aname'];
        $_SESSION['id'] = $value['id'];
        $_SESSION['email'] = $value['email'];
        $_SESSION['phone'] = $value['phone'];
        $_SESSION['img'] = $value['img'];
        header('location:../admin_page/index.php');
    } else if ($identity == 3) {
        $text_err = "Oh, wrong password! One more time yaaa";
    } else if ($identity == 4) {
        $text_err = "Check again!!";
    } else {
        $text_err = "Sorry bae! Your account does not exist.";
    }
} else if (isset($_POST['regis']) && $_POST['regis']) {
    $uname = $_POST['unameregis'];
    $email = $_POST['emailregis'];
    $phone = $_POST['phoneregis'];
    $psswd = $_POST['psswdregis'];
    $gender = $_POST['gender'];
    if (checkemail($email) == 0) {
        $regis = "Email already exists, another one please!";
    } else {
        $user = "INSERT INTO users(uname,phone,email,psswd,gender)VALUES('$uname', '$phone', '$email','$psswd','$gender' )";
        if ($conn->query($user) === TRUE) {
            $regis = "Ready for Login below bae!!!";
        } else {
            $regis = "Sorry, something is wrong...";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" , initial-scale="1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Oxygen:wght@300;400;700&family=Pacifico&family=Prata&display=swap"
        rel="stylesheet">
    <title>First Step to Discover Our World!</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header>
        <a href="#" class="logo">Serein<span id="dot">.</span></a>
        <nav class="nav1">
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <nav>
            <div class="navsearch">
                <i class="fa-solid fa-magnifying-glass" id="search-btn"></i>
            </div>
        </nav>
    </header>
    <!--==================== SEARCH ====================-->
    <div class="search" id="search">
        <i class="fa-solid fa-xmark" id="searchclose"></i>
        <form action="" class="searchform">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" placeholder="What are you looking for, bae?" class="searchinput">
        </form>
    </div>
    <!--==================== LOGIN ====================-->
    <div class="container">
        <div class="form-box login">
            <h2>Login</h2>
            <span class="ic">
                <span class="icmin">
                    <i class="fa-brands fa-facebook"></i>
                </span>
                <span class="icmin">
                    <i class="fa-brands fa-google-plus-g"></i>
                </span>
                <span class="icmin">
                    <i class="fa-solid fa-phone"></i>
                </span>
            </span>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" required name="email">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" required name="psswd">
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">Remember Me</label>
                    <a href="#">Forgot Password</a>
                </div>
                <div class="error">
                    <?php
                    if (isset($text_err) && $text_err != "") {
                        echo $text_err;
                    }
                    ?>
                </div>
                <input type="submit" class="button" name="login" value="Relax Now">
                <div class="login-regis">
                    Don't have account, Bae<span class="icon"><i class="fa-solid fa-heart"></i></span>? <a href="#"
                        class="register-link">Register Here</a>
                </div>
                <div class="login-regis">
                    Only staff below
                </div>
                <div class="alogin">
                    <span class="aicon"><i class="fa-solid fa-pen-nib"></i></span>
                    <div class="ainput">
                        <input type="text" placeholder="Your ID admin" id="ainput" name="idadmin">
                    </div>
                </div>
            </form>
        </div>

        <!--==================== REGISTER ====================-->
        <div class="form-box register">
            <h2>Hello! New Bae<span class="icon"><i class="fa-solid fa-heart"></i></span></h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <input type="text" required name="unameregis">
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" required name="emailregis">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-phone"></i></span>
                    <input type="phone" required name="phoneregis">
                    <label>Phone</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" required name="psswdregis">
                    <label>Password</label>
                </div>
                <div class="wrapper">
                    <span class="icon"><i class="fa-solid fa-venus-mars"></i></span>
                    <div class="select-gender">
                        <select name="gender" class="gender">
                            <option value="Male" class="gender">Male</option>
                            <option value="Female" class="gender">Female</option>
                            <option value="Other" class="gender">Other</option>
                        </select>

                    </div>
                    <label>Gender</label>
                </div>
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox" required>I agree to the <span class="term">terms & conditions</span>
                    </label>
                </div>
                <div class="error">
                    <?php
                    if (isset($regis) && $regis != "") {
                        echo $regis;
                    }
                    ?>
                </div>
                <input type="submit" class="button" name="regis" value="Ready for Exploring">
                <div class="login-regis">
                    Already have an account <span class="icon"><i class="fa-solid fa-heart"></i></span>?<a href="#"
                        class="login-link"> Login Here</a>
                </div>
            </form>
        </div>
    </div>
    <script src="js/login.js"></script>
</body>

</html>