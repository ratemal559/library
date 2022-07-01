<?php
session_start();

if($_SESSION['role'] == 'admin')
{
    $name = $_SESSION['book_name'];
    $library = $_SESSION['library'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $db->query('DELETE FROM Book WHERE Name=? AND Library=?', $name, $library);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>"Kniha úspěšně odebrána"</h1>
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
    <input type="hidden" value='<?php echo $_SESSION['Library'] ?>' name="name"/>
        <input type="submit" value="Zpět" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>