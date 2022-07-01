<?php
if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'distributor')
{
    $order_id = $_POST['order_id'];
    $order = $db->fetch("SELECT * FROM `Order` WHERE ID=?", $order_id);
    $_SESSION['order_id'] = $order['ID'];
    $_SESSION['order_title'] = $order['Title'];
    $_SESSION['order_publisher'] = $order['Publisher'];
    $_SESSION['order_amount'] = $order['Amount'];
    $_SESSION['order_library'] = $order['Library'];

    ?>
        <div class='upozorneni upozorneni-uspech'>Potvrdit objednávku?</div>

        <form action="../index.php?id=5" method="post">
            <input type="submit" value="Potvrdit" name="<?php echo 'apconf_'.$row['ID'] ?>" class="button2"/>
        </form>
        <form action="../index.php?id=5" method="post">
            <input type="submit" value="Zrušit" class="button2"/>
        </form>
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
