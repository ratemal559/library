<?php
session_start();
if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník')
{
    $id = $_POST['res_id'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $res = $db->Fetch('SELECT * FROM Reservation WHERE ID=?', $id);
    $_SESSION['res_id'] = $id;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Upravit rezervaci"</h1>
    </head>
    <body>
        <form action="update_reservation_confirmed.php" method="post">
            <input type="text" value="<?= $res['Return_date'] ?>" name="return_date" required /><br>
            <input type="text" value="<?= $res['Fine'] ?>" name="fine" required /><br>
            <input type="submit" value="OK" class="button"/>
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