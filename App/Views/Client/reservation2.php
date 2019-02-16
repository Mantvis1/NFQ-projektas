<?php
session_start();
?>
<html>

<head>

</head>

<body>
  Cia bus rezervacija
  <br>
  <form action="../../Controllers/clientController.php" method="POST">
    <input name="clientName" value="<?php echo $_SESSION['name']?>" readonly>
    <input name="haircutterName" value="<?php echo $_GET['haircutter']?>" readonly>
    <select name="daySelect">
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
    <button type="submit">Pasirinkti laika</button>
    <input name="secondPartOfReservation" type="hidden" value="1">
  </form>
  <a href="../Client/main.php">Pradeti is pradziu</a>
</body>

</html>