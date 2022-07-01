<?php
session_start();

if($_SESSION['role'] == 'admin')
{
    $name = $_POST['name'];
    $address = $_POST['address'];
    $hours = $_POST['hours'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $id = $_SESSION['id_library'];
    $db->query('UPDATE Library SET', ['Name' => $name, 'Address' => $address, 'Open_hours' => $hours], 'WHERE ID=?', $id);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>"Knihovna úspěšně změněna"</h1>
    </head>
    <body>
        <td>
        <form action="../index.php?id=3" method="post">
            <input type="submit" value="Zpět na seznam knihoven" class="button"/>
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
    <form action="../index.php?id=3" method="post">
        <input type="submit" value="Zpět" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>