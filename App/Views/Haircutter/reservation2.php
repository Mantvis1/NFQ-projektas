<?php
session_start();
?>
<html>

<head>

</head>

<body>
  Cia bus rezervacija
  <br>
  <form action="../../Controllers/haircutterController.php" method="POST">
    <input name="clientName" value="<?php echo $_SESSION['name']?>" readonly>
    <input name="haircutterName" value="<?php echo $_SESSION['haircutterName']?>" readonly>
    <select name="daySelect">
      <?php for($index = 0; $index < count($_SESSION['dates']); $index++) {
      if($index == 0){?>
      <option value="<?php echo $_SESSION['dates'][$index];?>">Siandien</option>
      <?php} else if($index == 1){?>
      <option value="<?php echo $_SESSION['dates'][$index];?>">Rytoj</option>
      <?php }else { ?>
      <option value="<?php echo $_SESSION['dates'][$index];?>"><?php echo $_SESSION['dates'][$index];?></option>
      <?php } 
      } ?>
    </select>
    <button type="submit">Pasirinkti laika</button>
    <input name="secondPartOfReservation" type="hidden" value="1">
  </form>
  <a class="button" href="../Haircutter/meniu.php">Gryzti i meniu</a><br>
</body>

</html>