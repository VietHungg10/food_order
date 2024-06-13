<?php
session_start();


//constant for nonrepeating values
define("LOCALHOST","localhost");
define( "DB_USER", "root" );      
define( "DB_PASSWORD", "" );         
define( "DB_NAME","foodorder");
define( "SITEURL","http://localhost/php-project/");
$conn = mysqli_connect(LOCALHOST, DB_USER, DB_PASSWORD)
or die("Unable to connect!");

$db_select = mysqli_select_db($conn, 'foodorder')
or die("Database selection failed: " . mysqli_error($conn));






?>