<?php
session_start();


if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník' || $_SESSION['role'] == 'distributor')
{
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $library = $_SESSION['library'];
    $db->query('INSERT INTO Book ?', ['Name' => $_POST['name'], 'Authors' => $_POST['authors'],
     'Publisher' => $_POST['publisher'], 'Published' => $_POST['published'], 'Genre' => $_POST['genre'], 'Amount' => $_POST['amount'],
      'Available' => $_POST['available'], 'Votes' => 0, 'ISBN' => $_POST['isbn'], 'Library' => $library]); 
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>"Kniha přidána"</h1>
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