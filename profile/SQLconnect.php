<?php
$host = 'localhost';
$user  = 'root';
$psw = '';
$db = 'profile';
$conn = new mysqli($host, $user, $psw, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}