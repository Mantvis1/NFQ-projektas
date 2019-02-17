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
      <h3>Nuolaidų paiška</h3>
    </div>
    <div class="card-body">
      <form method="POST" action="../../Controllers/haircutterController.php">
        <label>Kliento vardas ir pavardė:</label>
        <input name="name">
        <button class="btn-primary btn-lg" type="submit">Ieskoti</button>
        <input type="hidden" name="userSearch" value="1" readonly>
      </form>
      <?php 
    if(isset($_SESSION['message'])){
      print($_SESSION['message']);
      unset($_SESSION['message']);
    }
  ?>
    </div>
    <a class="button" href="../Haircutter/meniu.php">Gryzti i meniu</a>
  </div>
</body>

</html>