<?php
session_start();
?>
<html>

<head>

</head>

<body>
  Cia bus rezervacija
  <form action="../../Controllers/clientController.php" method="POST">
    <input name="clientName" value="<?php echo $_SESSION['name']?>" readonly>
    <input name="haircutterName" value="<?php echo $_GET['haircutter']?>" readonly>
    <select name="daySelect">
      <option value="day1">day1</option>
      <option value="day2">day2</option>
      <option value="day3">day3</option>
      <option value="day4">day4</option>
    </select>
    <button type="submit">Pasirinkti laika</button>
    <input name="secondPartOfReservation" type="hidden" value="1">
  </form>
</body>

</html>