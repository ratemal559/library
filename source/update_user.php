<?php
session_start();
if($_SESSION['role'] == 'admin')
{
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $id = $db->fetchField('SELECT ID FROM User WHERE Email=?', $email);
    $_SESSION['id_update'] = $id;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Upravit uživatele "<?= $name ?>"</h1>
    </head>
    <body>
        <form action="update_user_confirmed.php" method="post">
            <input type="text" value="<?= $name ?>" name="name" /><br>
            <input type="text" value="<?= $surname ?>" name="surname" /><br>
            <input type="text" value="<?= $role ?>" name="role"/><br>
            <input type="text" value="<?= $email ?>" name="email"/><br>
            <input type="submit" value="OK" class="button"/>
        </form>
        <form action="../index.php?id=9" method="post">
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
    <form action="../index.php?id=9" method="post">
        <input type="submit" value="Zpět" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>