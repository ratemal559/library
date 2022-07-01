<?php
session_start();

if($_SESSION['role'] == 'admin')
{
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $id = $_SESSION['id_update'];
    $db->query('UPDATE User SET', [
        'Name' => $name, 
        'Surname' => $surname, 
        'Role' => $role, 
        'Email' => $email,
    ], 'WHERE ID=?', $id);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>"Uživatel úspěšně změněn"</h1>
    </head>
    <body>
        <td>
        <form action="../index.php?id=9" method="post">
            <input type="submit" value="Zpět" class="button"/>
        </form>
        </td>
    </body>
    <?php
}
else
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Chyba: Nedostatečné oprávnění</h1>
    </head>
    <body>
    <form action="../index.php?id=9" method="post">
        <input type="submit" value="Zpět" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>