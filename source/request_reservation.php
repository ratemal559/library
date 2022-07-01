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
    $_SESSION['book_name'] = $name;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Zažádat o vypůjčení knihy <?= $book['Name'] ?>?</h1>
        <?php
            if($book['Amount'] > 0)
            {
                echo "Momentálně je {$book['Amount']} knih k dispozici\n";
            }
            else
            {
                echo "Momentálně jsou všechny kopie vypůjčeny. O rezervaci můžete stále zažádat, musíte ale počkat, 
                až bude nějaká kniha k dispozici. ";
                if($book['Amount'] < 0)
                {
                    $waiting = -$book['Amount'];
                    echo "Na vypůjčení právě čeká {$waiting} uživatelů."; 
                }
            }
        ?>
    </head>
    <body>
        <form action="request_reservation_confirmed.php" method="post">
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