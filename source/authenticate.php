<?php
$email = $_POST['login'];
$password = $_POST['password'];

$host = '127.0.0.1';
$db   = 'Library';
$user = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

$stmt = $pdo->prepare("SELECT Role from User WHERE Email = ? AND Password == ?");
$stmt->execute([$email, $password]);
$data = $stmt->fetch();

if($data != null)
{
    if($data['Role'] != null)
    {
        session_start();
        $_SESSION['role'] = $data['Role'];
        $_SESSION['email'] = $data['Email'];
        include("libraries.html");
    }
}
else
{
    echo "Error: invalid credentials";
}
?>
