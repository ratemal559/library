<?php
session_start();
if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník' || $_SESSION['role'] == 'distributor')
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <h1>Přidat knihu</h1>
    </head>
    <body>
        <form action="new_book_confirmed.php" method="post">
            <input type="text" placeholder="Název" name="name" required /><br>
            <input type="text" placeholder="Autor" name="authors" required /><br>
            <input type="text" placeholder="Vydavatel" name="publisher" required /><br>
            <input type="text" placeholder="Rok vydání" name="published" required /><br>
            <input type="text" placeholder="Žánr" name="genre" required /><br>
            <input type="text" placeholder="Počet" name="amount" required /><br>
            <select name="available">
                <option value=1>k dispozici - Ano</option>
                <option value=0>k dispozici - Ne</option>
            </select> <br>
            <input type="text" placeholder="ISBN" name="isbn" required /><br>
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