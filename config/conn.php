<?php
$server="localhost";
$username="root";
$password="";
$dbname="reg";

$conn=mysqli_connect($server,$username,$password,$dbname);
if(!$conn)
{
    echo"somthing wrong";
}


?>