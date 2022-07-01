<?php
session_start();
if($_SESSION['role'] == 'admin')
{
    $name = $_POST['name'];
    $_SESSION['library_name'] = $name;
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Opravdu si přejete zrušit tuto knihovnu?</h1>
    </head>
    <body>
        <form action="Delete_library_confirmed.php" method="post">
            <input type="submit" value="OK" class="button"/>
        </form>
        <form action="../index.php?id=3" method="post">
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
    <form action="../index.php?id=3" method="post">
        <input type="submit" value="Zpět" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>