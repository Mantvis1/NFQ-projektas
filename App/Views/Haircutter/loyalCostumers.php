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
      <form action="../../Controllers/haircutterController.php" method="POST">
        <label>Paieška pagal datą</label>
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
        <button class="btn-primary btn-lg" type="submit">Filtruoti</button>
        <input name="filterByDate" type="hidden" value="1" readonly>
      </form>
      <form action="../../Controllers/haircutterController.php" method="POST">
        <label>Paieška pagal kliento vardą</label>
        <input name="clientName" required>
        <button class="btn-primary btn-lg" type="submit">Atlikti paiešką</button>
        <input name="filterByName" type="hidden" value="1" readonly>
      </form>
      <form action="../../Controllers/haircutterController.php" method="POST">
        <button class="btn-primary btn-lg" type="submit">Valyti nustatymus</button>
        <input name="removeFilter" type="hidden" value="1" readonly>
      </form>
    </div>
  </div>
  <table>
    <thead>
      <tr>
        <td>Vardas Pavardė</td>
        <td>Apsilankymo data</td>
        <td>Apsilankymo laikas</td>
      </tr>
    </thead>
    <tbody>
      <?php if(isset($_SESSION['reservations']) || ($_SESSION['reservations'] != NULL)){
       foreach($_SESSION['reservations'] as $reservation){?>
      <tr>
        <td>
          <?php echo $reservation['clientNameAndSurname']; ?>
        </td>
        <td>
          <?php echo $reservation['startDay']; ?>
        </td>
        <td>
          <?php echo $reservation['startTime']; ?>
        </td>
      </tr>
      <?php }}else{ ?>
    </tbody>
  </table>
  <?php echo "<div>Spauskite valyti nustatymus</div>";}?>
  <a class="button" href="../Haircutter/meniu.php">Grįžti į meniu</a>
</body>

</html>