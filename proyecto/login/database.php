<?php

$server = 'localhost';
$username = 'root';
//'id18591597_admincddb'
$password = '';
//'D\LyQM8ZJFjSKcvt'
$database = 'php_login_database';
//'id18591597_clickingduckdb'

try {
    $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    } catch(PDOException $e) {    
    echo "Connection failed: " . $e->getMessage();
    }
?>