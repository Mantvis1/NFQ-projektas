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
  <?php 
if(isset($_SESSION['message'])){
  echo $_SESSION['message'];
  $_SESSION['message'] = NULL;
}?>

  <a class="button" href="../Haircutter/customerSearch.php">Nuolaidu paieška</a><br>
  <a class="button" href="../Haircutter/loyalCostumers.php">Klientu sarašas</a><br>
  <a class="button" href="../Haircutter/reservation.php">Laiko klientams rezervacija</a><br>
  <a class="button" href="../Haircutter/cancel.php">Laiko klientams atsaukimas</a><br>
</body>

</html>