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
      <h3>1 etapas:</h3>
    </div>
    <div class="card-body">
      <form action="../../Controllers/haircutterController.php" method="POST">
        <label>Kliento vardas</label>
        <input name="name">
        <label>Kliento pavarde</label>
        <input name="surname">
        <button class="btn-primary btn-lg" type="submit">Pasirinkti klientą</button>
        <input name="firstPartOfReservation" type="hidden" value="1">
    </div>
    <a class="button" href="../Haircutter/meniu.php">Grįžti į meniu</a>
  </div>
</body>

</html>