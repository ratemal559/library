
<?php
session_start();
include 'pdo.php';

$p = new pd();
$p->connect();
$data = $p->select_all('User');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Seznam uživatelů</title>
</head>
<body>
<tr>
    <td><b>Jméno</td>
    <td><b>Příjmení</td>
    <td><b>Email</td>
    <td><b>Oprávnění</td>
</tr>
<?php
foreach($data as $row)
{
?>  
<tr>
    <td><b><?php echo $row['Name'] ?></td>
    <td><b><?php echo $row['Surname'] ?></td>
    <td><b><?php echo $row['Email'] ?></td>
    <td><b><?php echo $row['Role'] ?></td>
    <?php
        if($_SESSION['role'] == 0)
        {
            $_POST['email'] = $row['Email'];
            ?>
            <td>
            <form action="change_user_privilege.php" method="post">
              <input type="submit" value="Změnit Oprávnění" class="button"/>
            </form>
            </td>
            <td>
            <form action="delete_user.php" method="post">
              <input type="submit" value="Odstranit uživatele" class="button"/>
            </form>
            </td>
            <?php
        }
    ?>
    <?php
    ?>
</tr>
<?php
}
?>
</body>
</html> 