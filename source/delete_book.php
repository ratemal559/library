<?php
session_start();
if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník')
{
    $name = $_POST['name'];
    $_SESSION['book_name'] = $name;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Opravdu si přejete zrušit tuto knihu?</h1>
    </head>
    <body>
        <form action="delete_book_confirmed.php" method="post">
            <input type="submit" value="OK" class="button"/>
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
    <input type="hidden" value='<?php echo $_SESSION['Library'] ?>' name="name"/>
        <input type="submit" value="Zpět" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>