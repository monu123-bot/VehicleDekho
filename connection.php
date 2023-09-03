<?php
$username = "root";
$password = "";
$server = "localhost";
$database = "car_dekho";
$conn = mysqli_connect($server,$username,$password,$database);
if(!$conn){
    echo "connection unsuccessful";
}

?>