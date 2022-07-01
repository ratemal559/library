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
    $res = $db->Fetch('SELECT * FROM Reservation WHERE ID=?', $res_id);
    $library = $db->fetchField('SELECT Name FROM Library WHERE ID=?', $res['Libid']);
    if($res['Pending'] == 0)
    {
        $db->query('UPDATE Book SET ?', ['Amount+=' => 1], 'WHERE Name=? AND Library=?', $res['Title'], $library);
    }
    $db->query('DELETE FROM Reservation WHERE ID=?', $res_id);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>"Rezervace úspěšně odstraněna"</h1>
    </head>
    <body>
        <td>
        <form action="../index.php?id=2" method="post">
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
    <form action="../index.php?id=2" method="post">
        <input type="submit" value="Zpět" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>