<?php
session_start();
if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník')
{
    $name = $_POST['name'];
    $authors = $_POST['authors'];
    $publisher = $_POST['publisher'];
    $published = $_POST['published'];
    $genre = $_POST['genre'];
    $amount = $_POST['amount'];
    $isbn = $_POST['isbn'];
    $votes = $_POST['votes'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $library = $_SESSION['library'];
    $book_id = $db->fetchField('SELECT ID FROM Book WHERE Name=? AND Library=?', $name, $library);
    $_SESSION['book_id'] = $book_id;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Upravit knihu</h1>
    </head>
    <body>
        <form action="update_book_confirmed.php" method="post">
            <input type="text" value="<?= $name ?>" name="name" required /><br>
            <input type="text" value="<?= $authors ?>" name="authors" required /><br>
            <input type="text" value="<?= $published?>" name="published" required /><br>
            <input type="text" value="<?= $publisher?>" name="publisher" required /><br>
            <input type="text" value="<?= $genre ?>" name="genre" required /><br>
            <input type="text" value="<?= $amount ?>" name="amount" required /><br>
            <select name="available">
                <option value=1>k dispozici - Ano</option>
                <option value=0>k dispozici - Ne</option>
            </select> 
            <input type="text" value="<?= $isbn ?>" name="isbn" required /><br>
            <input type="text" value="<?= $votes ?>" name="votes" required /><br>
            <input type="submit" value="OK" class="button"/>
        </form>
        <form action="../index.php?id=4" method="post">
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
        <input type="hidden" value='<?php echo $_SESSION['Library'] ?>' name="name"/>
        <input type="submit" value="Zpět" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>