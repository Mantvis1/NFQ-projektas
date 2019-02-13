<?php
session_start();
?>
<html>

<body>
  Cia bus rezervacija
  <form>
    <input value="<?php echo $_SESSION['name']?>" readonly>
    <!-- galima kad jei padare klaida gryzt atgal(cia pagalvojimui)-->

  </form>
</body>

</html>