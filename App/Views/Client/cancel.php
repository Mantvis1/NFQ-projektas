<?php
session_start();
?>
<html>

<body>
  <?php
if(isset($_GET)){
  echo $_GET["message"];
}
?>
  <form action="../../Controllers/clientController.php" method="POST">
    <div>Jūs jau turite rezervaciją</div>
    <label>Kirpimo laikas:<?php echo $_SESSION['clientReservationInformation']['startTime'];?></label><br>
    <label>Kirpeja:<?php echo $_SESSION['clientReservationInformation']['name'];?></label><br>
    <button type="submit">Atsaukti</button>
    <input name="cancel" type="hidden" value="1">
  </form>
  <a href="main.php">Gryzti i pradzia</a>
</body>

</html>