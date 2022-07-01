<?php
session_start();


if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník') 
{
    $res_id = $_SESSION['res_id'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $db->query('UPDATE Reservation SET ?', ['Pending' => 0, 'Return_date' => $_POST['date']], 'WHERE ID = ?', $res_id);
    $db->query('UPDATE Book SET ?', ['Amount-=' => 1], 'WHERE Name=? AND Library=?', $_SESSION['title'], $_SESSION['library']);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>"Rezervace potvrzena"</h1>
    </head>
    <body>
        <td>
        <form action="../index.php?id=2" method="post">
            <input type="submit" value="Zpět na seznam knih" class="button"/>
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
    <form action="../index.php?id=6" method="post">
        <input type="submit" value="Zpět" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>