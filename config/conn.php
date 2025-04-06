<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "ecomdb";

$conn = mysqli_connect($server, $username, $password, $dbname);
if (!$conn) {
    echo "somthing wrong..";
}
