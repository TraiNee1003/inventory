<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "mrf";

$con = mysqli_connect($hostname, $username, $password, $dbname);

if (!$con){
    die("Conection failed :".mysqli_error($con));
}

?>