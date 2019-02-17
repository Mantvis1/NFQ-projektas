<?php
session_start();
?>
<!DOCTYPE html>

<?php 
  include '../../Style/style.php';
?>

<body>

  <div class="card bg-light mb-3 center">
    <div class="card-header">
      <h3>Pasirinkite kitą veiksmą</h3>
    </div>
    <div class="card-body">
      <?php 
      if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      }?>
      <a class="button" href="../Haircutter/customerSearch.php">Nuolaidu paieška</a><br>
      <a class="button" href="../Haircutter/loyalCostumers.php">Klientu sarašas</a><br>
      <a class="button" href="../Haircutter/reservation.php">Laiko klientams rezervacija</a><br>
      <a class="button" href="../Haircutter/cancel.php">Laiko klientams atsaukimas</a><br>
    </div>
  </div>
</body>

</html>