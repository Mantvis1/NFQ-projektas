<?php
session_start();
?>
<!DOCTYPE html>
<?php 
  include '../../Style/style.php';
?>
</head>

<body>
  <div class="card bg-light mb-3 center">
    <div class="card-header">
      <h3>1 etapas: Pasirinkite norimą kirpėją</h3>
    </div>
    <div class="card-body">

      <form action="../../Controllers/clientController.php" method="POST">
        <input class="form-control" id="Id" value="<?php echo $_SESSION['name']?>" readonly>
        <select class="custom-select" name="haircutterSelect">
          <?php for($index = 0; $index < count($_SESSION['haircutterList']); $index++) {?>
          <option value="<?php echo $_SESSION['haircutterList'][$index]['name'];?>">
            <?php echo $_SESSION['haircutterList'][$index]['name'];?>
          </option>
          <?php } ?>
        </select>
        <button class="btn-primary btn-lg" type="submit">Pasirinkti kirpėją</button>
        <input name="firstPartOfReservation" type="hidden" value="1">
      </form>
    </div>
    <a href="../Client/main.php">Gryžti į pradžią</a>
  </div>

</body>

</html>