<?php
session_start();

if($_SESSION['role'] == 'admin')
{
    $email = $_SESSION['email_del'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $db->query('DELETE FROM User WHERE Email=?', $email);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>"Uživatel úspěšně odebrán"</h1>
    </head>
    <body>
        <td>
        <form action="../index.php?id=9" method="post">
            <input type="submit" value="Zpět na seznam uživatelů" class="button"/>
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