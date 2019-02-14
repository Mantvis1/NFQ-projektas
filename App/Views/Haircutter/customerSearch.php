<?php
session_start();
?>
<html>

<head>
</head>

<body>
  <form method="POST" action="../../Controllers/haircutterController.php">
    <label>Kliento paieska:</label>
    <input name="name">
    <button type="submit">Ieskoti</button>
    <input type="hidden" name="userSearch" value="1" readonly>
  </form>
  <?php 
    if(isset($_SESSION['message'])){
      print($_SESSION['message']);
      $_SESSION['message'] = null;
    }
  ?>
</body>

</html>