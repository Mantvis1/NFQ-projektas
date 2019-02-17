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
      <h3>3 etapas: Pasirinkite norimą laiką</h3>
    </div>

    <div class="card-body">
      <form action="../../Controllers/clientController.php" method="POST">
        <input name="clientName" value="<?php echo $_SESSION['name']?>" readonly>
        <input name="haircutterName" value="<?php echo $_GET['haircutter']?>" readonly>
        <input name="day" value="<?php echo $_GET['day']?>" readonly>
        <select class="custom-select" name="timeSelect">
          <?php for($index = 0; $index < count($_SESSION['times']); $index++) {?>
          <option value="<?php echo $_SESSION['times'][$index];?>"><?php echo $_SESSION['times'][$index];?></option>
          <?php } ?>
        </select>
        <button class="btn-primary btn-lg" type="submit">Pasirinkti laika</button>
        <input name="thirdPartOfReservation" type="hidden" value="1">
      </form>
    </div>
    <a href="../Client/main.php">Pradeti is pradziu</a>
  </div>
</body>

</html>