<?php
$email = $_POST['login'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$name = $_POST['name'];
$surname = $_POST['surname'];

$host = '127.0.0.1';
$db   = 'Library';
$user = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);

if($password == $confirm_password)
{
    $stmt = $pdo->prepare("SELECT * from User WHERE Email = ?");
    $stmt->execute([$email]);
    $data = $stmt->fetch();
    if($data == null)
    {
        $stmt = $pdo->prepare("INSERT INTO User (Name, Surname, Password, Role, Email) VALUES(?,?,?,?,?)");
        $stmt = $pdo->execute([$name, $surname, $password, 3, $email]);
        session_start();
        $_SESSION['role'] = $data['Role'];
        $_SESSION['email'] = $data['Email'];
        include("libraries.html");
    }
    else
    {
        echo "Error: user already exists";
    }
}
else
{
    echo "Error: passwords do not match";
}
?>