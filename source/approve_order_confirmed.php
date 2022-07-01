<?php
session_start();

if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'distributor')
{
    $libary_name = $db->fetch("SELECT Name FROM `Library` WHERE ID=?", $_SESSION['order_library']);
    $db->query('UPDATE `Book` SET ?', ['Amount+=' => $_SESSION['order_amount'], 'Available' => 1], 'WHERE Name=? AND Library=?', $_SESSION['order_title'], $libary_name['Name']);
    $db->query('DELETE FROM `Order` WHERE ID=?', $_SESSION['order_id']);
    ?>

        <div class='upozorneni upozorneni-uspech'>Objednávka potvrzena!</div>
        <td>
        <form action="../index.php?id=5" method="post">
            <input type="submit" value="Zpět na seznam knih" class="button2"/>
        </form>
        </td>
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