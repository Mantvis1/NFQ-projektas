<?php 
session_start();
?>
<html>

<head>
</head>

<body>
  <form action="../../Controllers/haircutterController.php" method="POST">
    <button type="submit">Filtruoti</button>
    <input name="filter" type="hidden" value="1" readonly>
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
      <?php for($index = 0; $index < count($_SESSION['reservations']);$index++){?>
      <tr>
        <td>
          <?php echo $_SESSION['reservations'][$index]['clientNameAndSurname']; ?>
        </td>
        <td>
          <?php echo $_SESSION['reservations'][$index]['startDay']; ?>
        </td>
        <td>
          <?php echo $_SESSION['reservations'][$index]['startTime']; ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <a class="button" href="../Haircutter/meniu.php">Gryzti i meniu</a><br>
</body>

</html>