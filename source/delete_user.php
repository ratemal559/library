<?php
session_start();
if($_SESSION['role'] == 'admin')
{
    $_SESSION['email_del'] = $_POST['email'];
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Skutečně odebrat uživatele?</h1>
    </head>
    <body>
        <form action="delete_user_confirmed.php" method="post">
            <input type="submit" value="OK" class="button"/>
        </form>
        <form action="../index.php?id=9" method="post">
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
    <form action="../index.php?id=9" method="post">
        <input type="submit" value="Zpět" class="button"/>
    </form>
    </body>
    </html>
<?php
}
?>