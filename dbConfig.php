<?php
// Database configuration
$dbHost     = "ungias.com.mysql";
$dbUsername = "ungias_com_img";
$dbPassword = "ungias_com_img";
$dbName     = "ungias_com_img";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
