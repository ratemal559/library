<?php
session_start();
if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník')
{
    $res_id = $_POST['res_id'];
    $_SESSION['res_id'] = $res_id;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Skutečně odstranit rezervaci?</h1>
    </head>
    <body>
        <form action="delete_reservation_confirmed.php" method="post">
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