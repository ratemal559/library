<?php
if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník' || $_SESSION['role'] == 'distributor')
{
    $title = $_POST['title'];
    $library_id = $_POST['library'];

    $order = $db->fetch('SELECT * FROM `Order` WHERE `Title` LIKE ? AND `Library` LIKE ?', $title, $library_id);
    $_SESSION['order'] = $order['ID'];
    echo $title;
    echo $library_id;
    echo $order['ID'];
    ?>
        <div class='upozorneni upozorneni-chyba'>Skutečně odstranit objednávku?</div>

        <form action="../index.php?id=5" method="post">
            <input type="submit" value="OK" name=<?php echo 'delconf_'.$row['ID'] ?> class="button2"/>
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
    <form action="index.php?id=5" method="post">
        <input type="submit" value="Zpět" class="button2"/>
    </form>
<?php
}
?>
