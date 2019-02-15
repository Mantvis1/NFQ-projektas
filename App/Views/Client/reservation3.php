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
    <input name="day" value="<?php echo $_GET['day']?>" readonly>
    <select name="timeSelect">
      <option value="time1">time1</option>
      <option value="time4">time4</option>
      <option value="time3">time3</option>
      <option value="time2">time2</option>
    </select>
    <button type="submit">Pasirinkti laika</button>
    <input name="thirdPartOfReservation" type="hidden" value="1">
  </form>
  <a href="../Client/main.php">Pradeti is pradziu</a>
</body>

</html>