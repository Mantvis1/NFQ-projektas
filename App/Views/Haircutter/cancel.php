<html>

<head>
  <style>
  </style>
  <script>

  </script>
</head>

<body>
  <form action="../../Controllers/haircutterController.php" method="POST">
    <label>Ivesti kliento varda:</label><input name="customerName">
    <button type="submit">Paieska</button>
    <input name="findInfoAboutOneCustomer" type="hidden" value="1">
  </form>
  <br>
  <?php 
    if(isset($_GET['message'])){
    echo $_GET['message'];
    }
  ?>
  <br>
  <a class="button" href="../Haircutter/meniu.php">Gryzti i meniu</a><br>
</body>

</html>