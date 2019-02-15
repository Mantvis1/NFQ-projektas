<?php
session_start();
?>
<html>

<head>

</head>

<body>
  Cia bus rezervacija
  <form action="../../Controllers/clientController.php" method="POST">
    <input id="Id" value="<?php echo $_SESSION['name']?>" readonly>
    <select name="haircutterSelect">
      <?php for($index = 0; $index < count($_SESSION['haircutterList']); $index++) {?>
      <option value="<?php echo $_SESSION['haircutterList'][$index]['name'];?>">
        <?php echo $_SESSION['haircutterList'][$index]['name'];?>
      </option>
      <?php } ?>
    </select>
    <button type="
        submit">Pasirinkti kirpeja</button>
    <input name="firstPartOfReservation" type="hidden" value="1">
  </form>
  <a href="../Client/main.php">Pradeti is pradziu</a>
</body>

</html>