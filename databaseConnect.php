<?php
$host="localhost";
$user="root";
$password="adeyi";
$dbName="library_system";
$con=mysqli_connect($host,$user,$password);
mysqli_select_db($con,$dbName);
//$db = new PDO('mysql:host=localhost;dbname=library_system;charset=utf8mb4', 'root', 'adeyi');