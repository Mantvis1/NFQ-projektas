<!DOCTYPE html>
<?php 
  include '../../Style/style.php';
?>


<body>
  <div class="card bg-light mb-3 center">
    <div class="card-header">
      <h3>Įveskite vardą ir pavardę</h3>
    </div>
    <div class="card-body">
      <form action="../../Controllers/clientController.php" method="POST">
        <label>Vardas</label><br>
        <input type="text" required name="name"><br>
        <label>Pavardė</label><br>
        <input type="text" required name="surname"><br>
        <button class="btn btn-primary btn-lg" type="submit">Ieskoti</button>
        <input type="hidden" name="postClientName" value="1" readonly>
      </form>
    </div>
  </div>
</body>

</html>