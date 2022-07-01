<?php
session_start();

if($_SESSION['role'] == 'admin')
{
    $name = $_SESSION['library_name'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $db->query('DELETE FROM Library WHERE Name=?', $name);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>"Knihovna úspěšně odebrána"</h1>
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