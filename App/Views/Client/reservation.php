<?php
session_start();
?>
<html>

<head>

</head>

<body>
  Cia bus rezervacija
  <form action="../../Controllers/clientController.php" method="POST">
    <input id="Id" value="<?php echo $_SESSION['name']?>" readonly>
    <select name="haircutterSelect">
      <option value="volvo">Volvo</option>
      <option value="saab">Saab</option>
      <option value="opel">Opel</option>
      <option value="audi">Audi</option>
    </select>
    <button type="submit">Pasirinkti kirpeja</button>
    <input name="firstPartOfReservation" type="hidden" value="1">
  </form>
</body>

</html>