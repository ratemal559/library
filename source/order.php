<?php
session_start();
if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník') 
{
    $name = $_POST['name'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $book = $db->fetch('SELECT * FROM Book WHERE Name=? AND Library=?', $name, $_SESSION['library']);
    $_SESSION['publisher'] = $book['Publisher'];
    $_SESSION['title'] = $book['Name'];
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Objednávka na knihu <?= $book['Name'] ?></h1>
    </head>
    <body>
        <form action="order_confirmed.php" method="post">
            <input type="text" placeholder="počet" name="amount" required /><br>
            <input type="submit" value="Potvrdit" class="button"/>
        </form>
        <form action="../index.php?id=4" method="post">
        <input type="hidden" value='<?php echo $_SESSION['Library'] ?>' name="name"/>
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
    <form action="../index.php?id=4" method="post">
        <input type="submit" value="Přejít k přihlášení" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>