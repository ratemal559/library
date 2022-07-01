<?php
session_start();
if($_SESSION['role'] == 'admin')
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Nová knihovna</h1>
    </head>
    <body>
        <form action="new_library_confirmed.php" method="post">
            <input type="text" placeholder="Název knihovny" name="name" required /><br>
            <input type="text" placeholder="Adresa" name="address" required /><br>
            <input type="text" placeholder="Otevírací hodiny" name="hours" required /><br>
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