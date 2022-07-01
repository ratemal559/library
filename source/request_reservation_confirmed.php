<?php
session_start();


if(isset($_SESSION['prihlaseno']))
{
    $name = $_SESSION['book_name'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $library = $_SESSION['library'];
    $lib_id = $db->fetchField('SELECT ID FROM Library WHERE Name=?', $library);
    $db->query('INSERT INTO Reservation ?', ['Pending' => 1, 'Email' => $_SESSION['email'], 'Title' => $name, 'Fine' => 0, 'Return_date' => "0000-00-00", 'Libid' => $lib_id]);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>"Rezervace vytvořena"</h1>
    </head>
    <body>
        <td>
        <form action="../index.php?id=4" method="post">
        <input type="hidden" value='<?php echo $_SESSION['Library'] ?>' name="name"/>
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