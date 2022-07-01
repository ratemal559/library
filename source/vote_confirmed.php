<?php
session_start();
if(isset($_SESSION['prihlaseno']))
{
    $book_id = $_SESSION['book_id'];
    $dsn = 'mysql:host=localhost;dbname=Library';
    $user = 'root';
    $password = 'FT58S7hH55Vbnkv';
    require '../vendor/autoload.php';
    $db = new Nette\Database\Connection($dsn, $user, $password);
    $vote = $db->query('SELECT * FROM Votes WHERE Email=? AND Title=? AND Library=?', $_SESSION['email'], $_SESSION['book_name'], $_SESSION['library']);
    if($vote->getRowCount() == 0)
    {
        $db->query('UPDATE Book SET ?', ['Votes+=' => 1,], 'WHERE ID=?', $book_id);
        $db->query('INSERT INTO Votes ?', ['Email' => $_SESSION['email'], 'Title' => $_SESSION['book_name'], 'Library' => $_SESSION['library']]);
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <h1>"Hlas přidán"</h1>
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
            <h1>Chyba: už jste hlasoval</h1>
        </head>
        <body>
        <form action="../index.php?id=4" method="post">
            <input type="submit" value="Zpět na seznam knih" class="button"/>
        </form>
        </body>
        </html>
<?php
    }
    
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