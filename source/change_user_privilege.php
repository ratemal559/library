<?php
$email = $_POST['email'];
$role = $_POST['role'];

$host = '127.0.0.1';
$db   = 'Library';
$user = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

$stmt= $pdo->prepare("UPDATE User SET Role=? WHERE Email=?");
$stmt->execute([$role, $email]);
?>