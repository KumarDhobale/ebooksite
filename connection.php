<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error display for debugging

$host = 'localhost';
$user = 'root';
$password = ''; // Update if your MySQL has a password
$database = 'ebookstore'; // Changed to ebookstore

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>