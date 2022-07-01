<?php
session_start();
if (isset($_SESSION['prihlaseno']))
{
    $name = $_POST['name'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $book = $db->fetch('SELECT * FROM Book WHERE Name=? AND Library=?', $name, $_SESSION['library']);
    $_SESSION['book_id'] = $book['ID'];
    $_SESSION['book_name'] = $name;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Hlasovat o přidání knihy <?= $book['Name'] ?> do knihovny?</h1>
    </head>
    <body>
        <form action="vote_confirmed.php" method="post">
            <input type="submit" value="Ano" class="button"/>
        </form>
        <form action="../index.php?id=4" method="post">
        <input type="hidden" value='<?php echo $_SESSION['Library'] ?>' name="name"/>
            <input type="submit" value="Ne" class="button"/>
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
        <h1>Pro tuto operaci musíte být přihlášen</h1>
    </head>
    <body>
    <form action="../index.php?id=6" method="post">
        <input type="submit" value="Přejít k přihlášení" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>