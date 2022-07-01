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
    $id = $db->fetchField('SELECT ID FROM Library WHERE Name=?', $name);
    $_SESSION['id_library'] = $id;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Upravit knihovnu "<?= $name ?>"</h1>
    </head>
    <body>
        <form action="update_library_confirmed.php" method="post">
            <input type="text" value="<?= $name ?>" name="name" required /><br>
            <input type="text" value="<?= $address ?>" name="address" required /><br>
            <input type="text" value="<?= $hours ?>" name="hours" required /><br>
            <input type="submit" value="OK" class="button"/>
        </form>
        <form action="../index.php?id=3" method="post">
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
    <form action="../index.php?id=3" method="post">
        <input type="submit" value="Zpět" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>