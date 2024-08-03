<?php 
    include ('assets/php/connect.php');
    include('assets/php/function.php');
    session_start();
    ob_start();
    if(isset($_SESSION['identity'])&&($_SESSION['identity']==2)){
        include "home.php";
        if(isset($_GET['act'])){
            switch($_GET['act']){
                case 'logout':
                    unset($_SESSION['identity']); 
                    header('location:../Login/login.php');
                    break;
                case 'delete':
                    delete();
                    header('Location: edit.php');
                    break;  
                default:
                    header('location: index.php');
                    break; 
            }
        }
    }
    else header('location:../Login/login.php');
?>
