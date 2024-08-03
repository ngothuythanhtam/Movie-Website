<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'movie_web';

    $con = new mysqli($servername, $username, $password, $database);

    if ($con) 
    {
        mysqli_query($con, "SET NAMES 'utf8' ");
        #echo "Connected successfully!";
    }

    else{
        echo "connected fail";
    }

 ?>