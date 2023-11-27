<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "dbdentalcare";

    $con = mysqli_connect($host, $username, $password, $database) or die (mysqli_error($conn));

    if(!$con) {
        echo '<script> alert("Error on connection."); </script>';
    }
?>