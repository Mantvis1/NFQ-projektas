<html>

<head>
  <style>
  .btn-primary {
    color: #fff;
    background-color: #2C3E50;
    border-color: #2C3E50
  }

  .btn-lg {
    padding: 0.5rem 1rem;
    font-size: 1.171875rem;
    line-height: 1.5;
    border-radius: 0.3rem
  }

  .btn:hover {
    color: #212529;
    text-decoration: none
  }
  </style>

</head>

<body>
  <form action="../../Controllers/haircutterController.php" method="POST">
    <label>Ivesti kliento varda:</label><input name="customerName">
    <button class="btn btn-primary btn-lg" type="submit">Paieska</button>
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