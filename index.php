<?php
session_start();
include 'source/pdo.php';


/////////////////////////////////////////////
// Připojeni k databazi
/////////////////////////////////////////////
$dsn = 'mysql:host=localhost;dbname=Library';
$user = 'root';
$password = 'FT58S7hH55Vbnkv';

require __DIR__ . '/vendor/autoload.php';
$db = new Nette\Database\Connection($dsn, $user, $password);
/////////////////////////////////////////////

/////////////////////////////////////////////
// Registrace
/////////////////////////////////////////////
$_SESSION['zprava'] = '';

if (isset($_POST['jmenoReg']) && $_POST['jmenoReg'] &&
    isset($_POST['prijmeniReg']) && $_POST['prijmeniReg'] &&
    isset($_POST['hesloReg']) && $_POST['hesloReg'] &&
    isset($_POST['email']) && $_POST['email'] &&
    isset($_POST['hesloZnovu']) && $_POST['hesloZnovu']) {
    $hledatEmail = $db->fetch("SELECT * FROM User WHERE Email LIKE ?", $_POST['email']);

    if ($hledatEmail == null) {
        if ($_POST['hesloReg'] == $_POST['hesloZnovu']) {
            $jmeno = htmlspecialchars($_POST['jmenoReg']);
            $prijmeni = htmlspecialchars($_POST['prijmeniReg']);
            $email = htmlspecialchars($_POST['email']);
            $heslo = md5($_POST['hesloReg']);

            $_SESSION['jmenoReg'] = $jmeno;

            $db->query("INSERT INTO User (ID, Name, Surname, Password, Role, Email)
        VALUES (NULL, ?, ?, ?, ?, ?)", $jmeno, $prijmeni, $heslo, "čtenář", $email);
            //header("location: index.php?id=6");
            $_SESSION['zprava'] = "Registrace byla uspěšná!";
        } else {
            $_SESSION['zprava'] = "Hesla se neshodují!";
        }
    } else {
        $_SESSION['zprava'] = "Tento účet je již registrován!";
    }
}
/////////////////////////////////////////////


/////////////////////////////////////////////
// Příhlašení
/////////////////////////////////////////////
if (isset($_POST['email']) && $_POST['email'] &&
    isset($_POST['heslo']) && $_POST['heslo']) {
    $heslo = md5($_POST['heslo']);
    $hledanyUzivatel = $db->fetch("SELECT * FROM User WHERE Email LIKE ? AND Password LIKE ?", $_POST['email'], $heslo);

    if ($_POST['email'] == $hledanyUzivatel['Email'] && $heslo == $hledanyUzivatel['Password']) {
        if ($hledanyUzivatel['Role'] != "ban") {
            $_SESSION['prihlaseno'] = true;
            header("location: index.php");

            $_SESSION['jmeno'] = $hledanyUzivatel['Name'];
            $_SESSION['prijmeni'] = $hledanyUzivatel['Surname'];
            $_SESSION['email'] = $hledanyUzivatel['Email'];
            $_SESSION['id'] = $hledanyUzivatel['ID'];
            $_SESSION['role'] = $hledanyUzivatel['Role'];
        } else {
            $_SESSION['zprava'] = "Tento účet byl zakázán!";
            //header("location: index.php?id=2");
        }
    } else {
        $_SESSION['zprava'] = "Zadal jste špatný E-mail nebo heslo!";
    }
}
/////////////////////////////////////////////


/////////////////////////////////////////////
// Odhlášeni
/////////////////////////////////////////////
if (isset($_GET['odhlas']) == true) {
    session_destroy();
    session_start();
}
/////////////////////////////////////////////


/////////////////////////////////////////////
// Změna hesla
/////////////////////////////////////////////
if (isset($_POST['zmenaStare']) && $_POST['zmenaStare'] &&
    isset($_POST['zmenaNove']) && $_POST['zmenaNove'] &&
    isset($_POST['zmenaZnovu']) && $_POST['zmenaZnovu']) {
    $stareHeslo = $db->fetch("SELECT Password FROM User WHERE Email LIKE ?", $_SESSION['email']);

    if ($stareHeslo['Password'] == md5($_POST['zmenaStare'])) {
        if ($_POST['zmenaNove'] == $_POST['zmenaZnovu']) {

        //připojení TODO
            $db->query("UPDATE `User` SET `Password` = ? WHERE `User`.`Email` = ?", md5($_POST['zmenaNove']), $_SESSION['email']);

            $_SESSION['zprava'] = "Heslo bylo změněno!";
        } else {
            $_SESSION['zprava'] = "Nová hesla se neshodují!";
        }
    } else {
        $_SESSION['zprava'] = "Zadal jste špatné staré heslo!";
    }
}
/////////////////////////////////////////////

$jmeno = (isset($_POST['jmeno'])) ? $_POST['jmeno'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$popis = (isset($_POST['popis'])) ? $_POST['popis'] : '';

?>

<script type="text/javascript">
   function obnovit()
   {
     //window.location = "http://localhost/iis/index.php?id=5";
   }
</script>


<!-- ///////////////////////////////////////////// -->
<!-- Zacatek HTML -->
<!-- ///////////////////////////////////////////// -->
<!DOCTYPE html>
<html lang="cz" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Knihovna</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>

  <body>


<!-- ///////////////////////////////////////////// -->
<!-- Menu -->
<!-- ///////////////////////////////////////////// -->
<header>
    <ul class="ul">
          <?php
          echo "<li class='li'>";
          if (isset($_SESSION['prihlaseno']) != true) {
              echo "<a href='index.php?id=6'>Přihlásit se</a>";
              echo "</li>";
          } else {
              echo "<li class='li'>";
              echo "<a href='index.php?id=8'>". $_SESSION['jmeno'] . " (".$_SESSION['email'].")</a>";
              echo "</li>";
              echo "<li class='li'>";
              echo "<a href='?odhlas=true'>Odhlásit</a>";
              echo "</li>";
          }
          ?>

          <?php if (isset($_SESSION['prihlaseno']) && $_SESSION['role'] == "admin") { ?>
          <li class="li"><a href="index.php?id=9">Seznam uzivatelu</a></>
          <?php } ?>

          <li class="li"><a href="index.php?id=3">Seznam knihoven</a></li>

          <?php
          if (isset($_SESSION['prihlaseno']) == true && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "knihovník" || $_SESSION['role'] == "čtenář")) {
              echo "<li class='li'><a href='index.php?id=2'>Výpujčky</a></li>";
          } ?>

          <?php
          if (isset($_SESSION['prihlaseno']) == true && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "knihovník" || $_SESSION['role'] == "distributor")) {
              echo "<li class='li'><a href='index.php?id=5'>Objednávky</a></li>";
          } ?>

      <li class="li"><a href="index.php">Domů</a></li>
      <li class="li" style="float:left; padding-left:50px"><a>Knihovna</a></li>
    </ul>
</header>
<!-- ///////////////////////////////////////////// -->


<!-- ///////////////////////////////////////////// -->
<!-- Formulář registrace -->
<!-- ///////////////////////////////////////////// -->
<div id="box-left">
<div id="bodypos">
<div class="content">

    <?php
    if (isset($_GET['id']) && $_GET['id'] == 7 && isset($_SESSION['prihlaseno']) != true) {
        ?>
    <div class="body-content">
      <div class="module">
        <h1>Registrace</h1>
        <form class="form" action="index.php?id=7" method="post">
          <?php if ($_SESSION['zprava'] == "Registrace byla uspěšná!") {
            echo "<div class='upozorneni upozorneni-uspech'>".$_SESSION['zprava']."</div>";
        } else {
            echo "<div class='upozorneni upozorneni-chyba'>".$_SESSION['zprava']."</div>";
        } ?>
          <input type="text" placeholder="*Jméno" name="jmenoReg" value="<?php echo $_POST['jmenoReg'];?>" required />
          <input type="text" placeholder="*Přijmení" name="prijmeniReg" value="<?php echo $_POST['prijmeniReg'];?>" required />
          <input type="password" placeholder="*Heslo" name="hesloReg" required />
          <input type="password" placeholder="*Znovu heslo" name="hesloZnovu" required />
          <input type="email" placeholder="*Email" name="email" value="<?php echo $_POST['email'];?>" required />
          <input type="submit" value="Registrovat" name="registrovat" class="button" />
        </form>

        <br><br>

        <form action="index.php?id=6" method="post">
            <input type="submit" value="Přihlásit se" class="button"/>
        </form>
      </div>
    </div>
    <?php
    } ?>
<!-- ///////////////////////////////////////////// -->


<!-- ///////////////////////////////////////////// -->
<!-- Formulář přihlášení -->
<!-- ///////////////////////////////////////////// -->
      <?php
      if (isset($_GET['id']) && $_GET['id'] == 6  && isset($_SESSION['prihlaseno']) != true) {
          ?>
      <div class="body-content">
        <div class="module">
          <h1>Přihlásit se</h1>
          <form action="index.php?id=6" method="post">
            <div class="upozorneni upozorneni-chyba"><?= $_SESSION['zprava'] ?></div>
            <input type="text" placeholder="E-mail" name="email" required />
            <input type="password" placeholder="Heslo" name="heslo" required />
            <input type="submit" value="Přihlásit se" name="prihlasit" class="button" />
          </form>

          <br><br>

          <form action="index.php?id=7" method="post">
              <input type="submit" value="Zaregistrovat se" class="button"/>
          </form>
        </div>
      </div>
      <?php
      }
      ?>
<!-- ///////////////////////////////////////////// -->


<!-- ///////////////////////////////////////////// -->
<!-- 1) Domů stránka -->
<!-- ///////////////////////////////////////////// -->
      <?php
      if (isset($_GET['id']) == null) {
          ?>
      <h2>Knihovna</h2>

      <div class="text">

      <ul>
          <li>Vítejte na naší stránce!</li>
          <li>Knihovna IS pro snadnou správu Vašich vypůjčených knižních titulů</li>
          <li>Vyhledávejte mezi tituly!</li>
          <li>Hodnoťe!</li>
          <li>A rozširujte Vaše obzory v naší knihovně!</li>
      </ul>

      </div>

      <?php
      }
      ?>

      <?php if (isset($_GET['id']) && $_GET['id'] == 8 && isset($_SESSION['prihlaseno']) == true) { ?>

      <h1>Uživatel <?php echo $_SESSION['jmeno']; ?></h1>


        <div class="body-content">
          <div class="module">
            <h1>Změna hesla</h1>
            <form class="form" action="index.php?id=8" method="post">
              <?php if ($_SESSION['zprava'] == "Heslo bylo změněno!") {
          echo "<div class='upozorneni upozorneni-uspech'>".$_SESSION['zprava']."</div>";
      } else {
          echo "<div class='upozorneni upozorneni-chyba'>".$_SESSION['zprava']."</div>";
      }?>
              <input type="password" placeholder="Staré heslo" name="zmenaStare" required />
              <input type="password" placeholder="Nové heslo" name="zmenaNove" required />
              <input type="password" placeholder="Nové heslo znovu" name="zmenaZnovu" required />
              <input type="submit" value="Uložit" name="zmenit" class="button" />
            </form>
          </div>
        </div>

<?php } ?>
<!-- ///////////////////////////////////////////// -->


<!-- ///////////////////////////////////////////// -->
<!-- 3) Seznam knihoven -->
<!-- ///////////////////////////////////////////// -->
<?php if (isset($_GET['id']) && $_GET['id'] == 3) { ?>

          <h2>Seznam knihoven</h2>
          <?php
          $data = $db->query('SELECT * FROM Library');
          ?>
          <!DOCTYPE html>
          <html>
          <head>
              <meta charset="utf-8">
              <title>Seznam uživatelů</title>
              <link rel="stylesheet" type="text/css" href="css/style.css">
          </head>
          <body>
          <table>
            <tr>
                <td><b>Název</td>
                <td><b>Adresa</td>
                <td><b>Otevírací Hodiny</td>
            </tr>
          <?php
          foreach($data as $row)
          {
            ?>
            <tr>
            <td>
            <form action="index.php?id=4" method="post">
              <input type="submit" value='<?php echo $row['Name'] ?>' class="button2"/>
              <input type="hidden" value='<?php echo $row['Name'] ?>' name="library"/>
            </form>
            </td>
            <td><b><?php echo $row['Address'] ?></td>
            <td><b><?php echo $row['Open_hours'] ?></td>
            <?php
                if($_SESSION['role'] == 'admin')
                {
                  ?>
                  <td>
                  <form action="source/Update_library.php" method="post">
                      <input type="hidden" value='<?php echo $row['Name'] ?>' name="name"/>
                      <input type="hidden" value='<?php echo $row['Address'] ?>' name="address"/>
                      <input type="hidden" value='<?php echo $row['Open_hours'] ?>' name="hours"/>
                      <input type="submit" value="Upravit knihovnu" class="button2"/>
                  </form>
                  </td>
                  <td>
                  <form action="source/Delete_library.php" method="post">
                      <input type="hidden" value='<?php echo $row['Name'] ?>' name="name"/>
                      <input type="submit" value="Odstranit knihovnu" class="button2"/>
                  </form>
                </td>
                <?php
                }
                ?>


            </tr>

            <?php
          }
            ?>
          </table>
          <form action="source/new_library.php" method="post">
                      <input type="submit" value="Nová knihovna" class="button"/>
                  </form>
            <?php
        }?>
<!-- ///////////////////////////////////////////// -->

<!-- ///////////////////////////////////////////// -->
<!-- 4) Seznam knih v jednolivých knohhovnách -->
<!-- ///////////////////////////////////////////// -->
<?php
if (isset($_GET['id']) && $_GET['id'] == 4) {  ?>

  <?php
  if(isset ($_POST['library']))
  {
    $_SESSION['library'] = $_POST['library'];
  }
  $data = $db->query('SELECT * FROM Book Where Library=?', $_SESSION['library']);
  ?>
  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="utf-8">
      <title>Seznam uživatelů</title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  <table>
    <tr>
        <td><b>Název</td>
        <td><b>Autoři</td>
        <td><b>Rok vydání</td>
        <td><b>Vydavatel</td>
        <td><b>Žánr</td>
        <td><b>Počet</td>
        <td><b>K dispozici</td>
        <td><b>ISBN</td>
        <td><b>Hlasy</td>
    </tr>
  <?php
  foreach($data as $row)
  {
    ?>
    <tr>
    <td><b><?php echo $row['Name'] ?></td>
    <td><b><?php echo $row['Authors'] ?></td>
    <td><b><?php echo $row['Published'] ?></td>
    <td><b><?php echo $row['Publisher'] ?></td>
    <td><b><?php echo $row['Genre'] ?></td>
    <td><b><?php echo $row['Amount'] ?></td>
    <?php
    if($row['Available'] == 0)
    {
      echo "<td><b>Ne</td>";
    }
    else
    {
      echo "<td><b>Ano</td>";
    }
    ?>
    <td><b><?php echo $row['ISBN'] ?></td>
    <?php
    if($row['Available'] >= 1)
    {
      ?>
    <td><b>n/a</td>
    <?php
    }
    else
    {
      ?>
      <td><?php echo $row['Votes'] ?></td>
      <?php
    }
    if($row['Available'] >= 1)
    {
      ?><td>
        <form action="source/request_reservation.php" method="post">
              <input type="hidden" value='<?php echo $row['Name'] ?>' name="name"/>
              <input type="submit" value="Zažádat o vypůjčení" class="button2"/>
          </form>
          </td>
      <?php
    }
    else
    {
      ?><td>
        <form action="source/vote.php" method="post">
              <input type="hidden" value='<?php echo $row['Name'] ?>' name="name"/>
              <input type="submit" value="Hlasovat o zakoupení" class="button2"/>
          </form>
          </td>
      <?php
    }
    if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník')
    {
      ?>
      <td>
      <form action="source/update_book.php" method="post">
        <input type="hidden" value='<?php echo $row['Name'] ?>' name="name"/>
        <input type="hidden" value='<?php echo $row['Authors'] ?>' name="authors"/>
        <input type="hidden" value=<?php echo $row['Published'] ?> name="published"/>
        <input type="hidden" value='<?php echo $row['Publisher'] ?>' name="publisher"/>
        <input type="hidden" value=<?php echo $row['Genre'] ?> name="genre"/>
        <input type="hidden" value=<?php echo $row['Amount'] ?> name="amount"/>
        <input type="hidden" value=<?php echo $row['ISBN'] ?> name="isbn"/>
        <input type="hidden" value=<?php echo $row['Votes'] ?> name="votes"/>
        <input type="submit" value="Upravit knihu" class="button2"/>
      </form>
      </td>
      <td>
      <form action="source/delete_book.php" method="post">
        <input type="hidden" value='<?php echo $row['Name'] ?>' name="name"/>
        <input type="submit" value="Odstranit knihu" class="button2"/>
      </form>
      </td>
      <?php
      if($row['Available'] <= 0)
      {
        ?><td>
        <form action="source/order.php" method="post">
              <input type="hidden" value='<?php echo $row['Name'] ?>' name="name"/>
              <input type="submit" value="Objednat" class="button2"/>
          </form>
          </td>
        <?php
      }
    }
        ?>


    </tr>

    <?php
  }
    ?>
  </table>
  <?php
  if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'knihovník' || $_SESSION['role'] == 'distributor')
      {
        ?>
        <form action="source/new_book.php" method="post">
              <input type="submit" value="Přidat knihu" class="button"/>
          </form>
          <?php
}
}?>
<!-- ///////////////////////////////////////////// -->


<!-- ///////////////////////////////////////////// -->
<!-- 9) Seznam uživatelů -->
<!-- ///////////////////////////////////////////// -->
<?php
if (isset($_GET['id']) && $_GET['id'] == 9 && isset($_SESSION['prihlaseno']) && $_SESSION['role'] == "admin") { ?>

<h2>Seznam uživatelů</h2>

<?php
$data = $db->query('SELECT * FROM User');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Seznam uživatelů</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<table>
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
  ?>
  <td>
  <form action="source/update_user.php" method="post">
      <input type="hidden" value=<?php echo $row['Name'] ?> name="name"/>
      <input type="hidden" value=<?php echo $row['Surname'] ?> name="surname"/>
      <input type="hidden" value=<?php echo $row['Email'] ?> name="email"/>
      <input type="hidden" value=<?php echo $row['Password'] ?> name="password"/>
      <input type="hidden" value=<?php echo $row['Role'] ?> name="role"/>
      <input type="submit" value="Změnit Oprávnění" class="button2"/>
  </form>
  </td>
  <td>
  <form action="source/delete_user.php" method="post">
      <input type="hidden" value=<?php echo $row['Email'] ?> name="email"/>
      <input type="submit" value="Odstranit uživatele" class="button2"/>
  </form>
  </td>
</tr>
<?php
}
?>
</table>
<?php
}?>


<!-- ///////////////////////////////////////////// -->
<!-- 2) Výpujčky -->
<!-- ///////////////////////////////////////////// -->
<?php
if (isset($_GET['id']) && $_GET['id'] == 2  && isset($_SESSION['prihlaseno']) == true && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "knihovník" || $_SESSION['role'] == "čtenář")) { ?>

 <h2>Výpujčky</h2>

 <?php
 $data = $db->query('SELECT * FROM Reservation');
 ?>

<!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <title>Seznam Vypujcek</title>
     <link rel="stylesheet" type="text/css" href="css/style.css">
 </head>
 <body>
 <table>
   <tr>
       <td><b>Potvrzeno</td>
       <td><b>Datum vrácení</td>
       <td><b>Pokuta</td>
       <td><b>Email uzivatele</td>
       <td><b>Titul</td>
       <td><b>Knihovna</td>
   </tr>
 <?php
foreach($data as $row)
{
?>
<tr>
<?php
  if($row['Pending'] == 0)
  {
    ?>
    <td><b>Ano</td>
    <?php
  }
  else
  {
    ?>
    <td><b>Ne</td>
    <?php
  }
?>
 <td><b><?php echo $row['Return_date'] ?></td>
 <td><b><?php echo $row['Fine'] ?></td>
 <td><b><?php echo $row['Email'] ?></td>
 <td><b><?php echo $row['Title']?></td>
 <?php
 $lib = $db->fetchField('SELECT Name FROM Library WHERE ID=?', $row['Libid']);
 ?>
 <td><b><?php echo $lib?></td>
 <?php
  if($_SESSION['role'] == "admin" || $_SESSION['role'] == "knihovník")
  {
    if($row['Pending'] == 0)
    {
    ?>
     <td>
     <form action="source/update_reservation.php" method="post">
         <input type="hidden" value=<?php echo $row['ID'] ?> name="res_id"/>
         <input type="submit" value="Upravit" class="button2"/>
     </form>
     </td>
    <?php
    }
    else
    {
      ?>
      <td>
      <form action="source/approve_reservation.php" method="post">
          <input type="hidden" value=<?php echo $row['ID'] ?> name="res_id"/>
          <input type="submit" value="Potvrdit" class="button2"/>
      </form>
      </td>
      <td>
      <?php
    }
  }
     ?>
     <td>
     <form action="source/delete_reservation.php" method="post">
         <input type="hidden" value=<?php echo $row['ID'] ?> name="res_id"/>
         <input type="submit" value="Odstranit" class="button2"/>
     </form>
     </td>
 </tr>
<?php
}
   ?>
 </table>
   <?php
 }?>
<!-- ///////////////////////////////////////////// -->

<!-- ///////////////////////////////////////////// -->
<!-- 5) Objednávky -->
<!-- ///////////////////////////////////////////// -->
<?php
if (isset($_GET['id']) && $_GET['id'] == 5  && isset($_SESSION['prihlaseno']) == true && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "knihovník" || $_SESSION['role'] == "distributor")) { ?>

  <h2>Seznam objednávek</h2>

  <?php
  if ($_SESSION['role'] == "distributor") {
    $data = $db->query("SELECT `Order`.*, `Library`.`Name` AS `LibName` FROM `Order` , `Library` WHERE `Library`.`ID` = `Order`.`Library` AND `Order`.`Publisher` = ?;", $_SESSION['jmeno']);
  }
  else {
    $data = $db->query("SELECT `Order`.*, `Library`.`Name` AS `LibName` FROM `Order` , `Library` WHERE `Library`.`ID` = `Order`.`Library`;");
  }

  ?>

  <table>
  <tr>
      <th><b>Titul</th>
      <th><b>Vydavatel</th>
      <th><b>Počet</th>
      <th><b>Knihovna</th>
  </tr>

  <?php

  foreach ($data as $row) { ?>

  <tr>
  <td><b><?php echo $row['Title'] ?></td>
  <td><b><?php echo $row['Publisher'] ?></td>
  <td><b><?php echo $row['Amount'] ?></td>
  <td><b><?php echo $row['LibName'] ?></td>

  <td><b>

      <form action="index.php?id=5" method="post" class="form">
          <input type="hidden" value="<?php echo $row['ID'] ?>" name="order_id"/>
          <input type="hidden" value="<?php echo $row['Title'] ?>" name="title"/>
          <input type="hidden" value="<?php echo $row['Publisher'] ?>" name="publisher"/>
          <input type="hidden" value="<?php echo $row['Amount'] ?>" name="amount"/>
          <input type="hidden" value="<?php echo $row['Library'] ?>" name="library"/>
          <input type="submit" value="Objednávka knihy" name="<?php echo 'ap_'.$row['ID'] ?>" class="button2"/>
      </form>

      <?php
        if (!empty($_POST) && isset($_POST['ap_'.$row['ID']])) {
            include("source/approve_order.php");
        }

        if (!empty($_POST) && isset($_POST['apconf_'.$row['ID']])) {
            include("source/approve_order_confirmed.php");
        }
        ?>

  </td><b>



  <td><b>
      <form action="index.php?id=5" method="post" class="form">
          <input type="hidden" value="<?php echo $row['Title'] ?>" name="title"/>
          <input type="hidden" value="<?php echo $row['Library'] ?>" name="library"/>
          <input type="submit" name=<?php echo 'del_'.$row['ID'] ?> value="Odstranit objednávku" class="button2"/>
      </form>

      <?php
        if (!empty($_POST) && isset($_POST['del_'.$row['ID']])) {
            include("source/delete_order.php");
        }

        if (!empty($_POST) && isset($_POST['delconf_'.$row['ID']])) {
            include("source/delete_order_confirmed.php");
        }
      ?>
  </td>

  </tr>
  <?php  } ?>

  </table>


<?php } ?>
<!-- ///////////////////////////////////////////// -->


<!-- ///////////////////////////////////////////// -->
<!-- Zápatí -->
<!-- ///////////////////////////////////////////// -->
  <div id="footertop">
      <div id="footer">
          <footer>
              <div id="footer-center"><a>&copy; 2021 • Hnihovna</a></div>
          </footer>
      </div>
  </div>
<!-- ///////////////////////////////////////////// -->

  </body>
</html>
