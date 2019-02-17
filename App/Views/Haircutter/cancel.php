<!DOCTYPE html>

<?php 
  include '../../Style/style.php';
?>

<body>
  <div class="card bg-light mb-3 center">
    <div class="card-header">
      <h3>Kliento rezervacijos atšaukimas</h3>
    </div>
    <div class="card-body">
      <form action="../../Controllers/haircutterController.php" method="POST">
        <label>Vardas ir pavardė:</label><input name="customerName">
        <button class="btn btn-primary btn-lg" type="submit">Paieška</button>
        <input name="findInfoAboutOneCustomer" type="hidden" value="1">
      </form>
      <?php 
    if(isset($_GET['message'])){
      echo $_GET['message'];
      unset($_GET['message']);
    }
  ?>
    </div>

    <a class="button" href="../Haircutter/meniu.php">Gryzti i meniu</a>
  </div>
</body>

</html>