<?php
// https://www.w3schools.com/php/php_mysql_select.asp
// https://www.php.net/manual/en/function.mysql-connect.php
$servername = "db";
$username = "root";
$password = "root";
$dbname = "db_netflix";
$port = 3306;
$conn = new mysqli($servername, $username, $password, $dbname, $port);
?>