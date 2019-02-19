<?php 
session_start();
?>
<!DOCTYPE html>
<?php 
  include '../../Style/style.php';
?>

<body>
  <form action="../../Controllers/haircutterController.php" method="POST">
    <label>Paieska pagal data</label>
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
    <label>Paieska pagal kliento varda</label>
    <input name="clientName">
    <button class="btn-primary btn-lg" type="submit">Atlikti paieska</button>
    <input name="filterByName" type="hidden" value="1" readonly>
  </form>
  <form action="../../Controllers/haircutterController.php" method="POST">
    <button class="btn-primary btn-lg" type="submit">Valyti nustatymus</button>
    <input name="removeFilter" type="hidden" value="1" readonly>
  </form>
  <table>
    <thead>
      <tr>
        <td>Vardas Pavarde</td>
        <td>Apsilankymo data</td>
        <td>Apsilankymo laikas</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach($_SESSION['reservations'] as $reservation){?>
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
      <?php } ?>
    </tbody>
  </table>
  <a class="button" href="../Haircutter/meniu.php">Gryzti i meniu</a><br>
</body>

</html>