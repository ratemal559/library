<?php
session_start();

if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník')
{
    $return_date = $_POST['return_date'];
    $fine = $_POST['fine'];
    $res = $_SESSION['res'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    $res_id = $_SESSION['res_id'];
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $db->query('UPDATE Reservation SET', ['Return_date' => $return_date, 'Fine' => $fine], 'WHERE ID=?', $res_id);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>"Rezervace úspěšně změněna"</h1>
    </head>
    <body>
        <td>
        <form action="../index.php?id=2" method="post">
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
    <form action="../index.php?id=2" method="post">
        <input type="submit" value="Zpět" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>