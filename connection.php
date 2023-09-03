<?php
$username = "root";
$password = "";
$server = "localhost";
$database = "car_dekho";

// $username = "id21215148_monudixit932";
// $password = "Monu@123";
// $server = "localhost";
// $database = "id21215148_cardekho1";




$conn = mysqli_connect($server,$username,$password,$database);
if(!$conn){
    echo "connection unsuccessful";
}

?>