<?php
session_start();
?>
<html>

<head>
  <style>
  </style>
  <script>

  </script>
</head>

<body>
  <form action="../../Controllers/haircutterController.php" method="POST">
    <label>Kliento vardas</label>
    <input name="name">
    <label>Kliento pavarde</label>
    <input name="surname">
    <button class="btn-primary btn-lg" type="submit">Pasirinkti klienta</button>
    <input name="firstPartOfReservation" type="hidden" value="1">
    <a class="button" href="../Haircutter/meniu.php">Gryzti i meniu</a><br>
</body>

</html>