<?php
session_start();


if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník')
{
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $name = $_POST['name'];
    $authors = $_POST['authors'];
    $publisher = $_POST['publisher'];
    $published = $_POST['published'];
    $genre = $_POST['genre'];
    $amount = $_POST['amount'];
    $available = $_POST['available'];
    $votes = $_POST['votes'];
    $isbn = $_POST['isbn'];
    $library = $_SESSION['library'];
    $book_id = $_SESSION['book_id'];
    $db->query('UPDATE Book SET', ['Name' => $name, 'Authors' => $authors, 'Published' => $published, 'Publisher' => $publisher,
    'Genre' => $genre, 'Amount' => $amount, 'Available' => $available, 'Votes' => $votes, 'ISBN' => $isbn,],
    'WHERE ID = ?', $book_id);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>"Kniha upravena"</h1>
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