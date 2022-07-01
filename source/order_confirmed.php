<?php
session_start();


if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník')
{
    $amount = $_POST['amount'];
    $title = $_SESSION['title'];
    $publisher = $_SESSION['publisher'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $library = $_SESSION['library'];
    $lib_id = $db->fetchField('SELECT ID FROM Library WHERE Name=?', $library);
    $db->query('INSERT INTO `Order` ?', ['Title' => $title, 'Publisher' => $publisher, 'Amount' => $amount, 'Library' => $lib_id]);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>"Objednávka vytvořena"</h1>
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