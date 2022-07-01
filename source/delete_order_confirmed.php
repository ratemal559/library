<?php
if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'distributor' || $_SESSION['role'] == 'librarian')
{
    $order = $_SESSION['order'];
    $db->query('DELETE FROM `Order` WHERE `ID` LIKE ?', $order);

    ?>
        <div class='upozorneni upozorneni-uspech'>Objednávka zrušena!</div>

        <td>
        <form action="../index.php?id=5" method="post">
            <input type="submit" value="Zpět na seznam objednávek" class="button2"/>
        </form>
        </td>
    <?php
}
else
{
    ?>
        <h1>Chyba: Nedostatečné oprávnění</h1>
    <form action="../index.php?id=5" method="post">
        <input type="submit" value="Zpět" class="button2"/>
    </form>
<?php
}
?>
