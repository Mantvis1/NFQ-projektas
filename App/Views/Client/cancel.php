<?php
session_start();
?>
<html>
<?php 
  include '../../Style/style.php';
?>

<head>
</head>

<body>
  <div class="card bg-light mb-3 center">
    <div class="card-header">
      <h3>
        <div>Jūs jau turite rezervaciją</div>
      </h3>
    </div>
    <div class="card-body">
      <form action="../../Controllers/clientController.php" method="POST">

        <label>Kirpimo data:</label><input readonly
          value="<?php echo $_SESSION['clientReservationInformation']['startDay'];?>"><br>
        <label>Kirpimo laikas:</label><input readonly
          value="<?php echo $_SESSION['clientReservationInformation']['startTime'];?>"><br>
        <label>Kirpeja:</label><input readonly
          value="<?php echo $_SESSION['clientReservationInformation']['name'];?>"><br>
        <button class="btn-primary btn-lg" type="submit">Atsaukti</button>
        <input name="cancel" type="hidden" value="1">
      </form>
    </div>
    <a href="main.php">Gryzti i pradzia</a>
</body>

</html>