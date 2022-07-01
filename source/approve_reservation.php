<?php
session_start();
if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník') 
{
    $res_id = $_POST['res_id'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $res = $db->fetch('SELECT * FROM Reservation WHERE ID=?', $res_id);
    $_SESSION['title'] = $res['Title'];
    $_SESSION['res_id'] = $res_id;
    $_SESSION['library'] = $db->fetchField('SELECT Name From Library WHERE ID=?', $res['Libid']);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Potvrdit rezervaci?</h1>
    </head>
    <body>
        <form action="approve_reservation_confirmed.php" method="post">
            <b>datum vrácení<b>
            <input type="text" value='<?php echo date('Y-m-d') ?>' name="date"/><br>
            <input type="submit" value="Potvrdit" class="button"/>
        </form>
        <form action="../index.php?id=2" method="post">
            <input type="submit" value="Zrušit" class="button"/>
        </form>
    </body>
    </html>
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