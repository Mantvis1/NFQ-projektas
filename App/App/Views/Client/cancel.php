<?php
session_start();
?>
<html>

<body>

  <form action="../../Controllers/clientController.php" method="POST">
    <div>Jūs jau turite rezervaciją</div>
    <label>Kirpimo laikas:<?php echo $_SESSION['clientReservationInformation']['startTime'];?></label><br>
    <label>Kirpeja:<?php echo $_SESSION['clientReservationInformation']['name'];?></label><br>
    <button type="submit">Atsaukti</button>
    <input name="cancel" type="hidden" value="1">
  </form>
</body>

</html>