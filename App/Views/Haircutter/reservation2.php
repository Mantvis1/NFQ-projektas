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
      <h3>2 etapas:</h3>
    </div>
    <div class="card-body">
      <form action="../../Controllers/haircutterController.php" method="POST">
        <input name="clientName" value="<?php echo $_SESSION['name']?>" readonly>
        <input name="haircutterName" value="<?php echo $_SESSION['haircutterName']?>" readonly>
        <select class="custom-select" name="daySelect">
          <?php for($index = 0; $index < count($_SESSION['dates']); $index++) 
    {
     if($index == 0){
    ?>
          <option value="<?php echo $_SESSION['dates'][$index];?>">Šiandien</option>
          <?php }
      else if($index > 1){?>
          <option value="<?php echo $_SESSION['dates'][$index];?>"><?php echo $_SESSION['dates'][$index];?></option>
          <?php }else {
        ?>
          <option value="<?php echo $_SESSION['dates'][$index];?>">Rytoj</option>
          <?php
      }
    } ?>
        </select>
        <button class="btn-primary btn-lg" type="submit">Pasirinkti datą</button>
        <input name="secondPartOfReservation" type="hidden" value="1">
    </div>
    </form>
    <a class="button" href="../Haircutter/meniu.php">Grįžti į meniu</a>
  </div>
</body>

</html>