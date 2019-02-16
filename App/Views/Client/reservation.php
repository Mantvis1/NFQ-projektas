<?php
session_start();
?>
<html>

<head>
  <style>
  .mb-3 {
    margin-bottom: 1rem !important
  }

  .center {
    margin: auto;

    width: 30%;

  }

  .card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem
  }

  .custom-select {
    display: inline-block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 1.75rem 0.375rem 0.75rem;
    font-size: 0.9375rem;
    font-weight: 400;
    line-height: 1.5;
    color: #7b8a8b;
    vertical-align: middle;
    background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right 0.75rem center/8px 10px;
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
  }

  .bg-light {
    background-color: #ecf0f1 !important
  }

  .card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0, 0, 0, 0.03);
    border-bottom: 1px solid rgba(0, 0, 0, 0.125)
  }

  .card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem
  }

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

  .form-group {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-flex: 0;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-flow: row wrap;
    flex-flow: row wrap;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    margin-bottom: 0
  }
  </style>
</head>

<body>
  <div class="card bg-light mb-3 center">
    <div class="card-header">
      <h3>Pasirinkite norimą kirpėją</h3>
    </div>
    <div class="card-body">

      <form action="../../Controllers/clientController.php" method="POST">
        <input class="form-control" id="Id" value="<?php echo $_SESSION['name']?>" readonly>
        <select class="custom-select" name="haircutterSelect">
          <?php for($index = 0; $index < count($_SESSION['haircutterList']); $index++) {?>
          <option value="<?php echo $_SESSION['haircutterList'][$index]['name'];?>">
            <?php echo $_SESSION['haircutterList'][$index]['name'];?>
          </option>
          <?php } ?>
        </select>
        <button class="btn-primary btn-lg" type="submit">Pasirinkti kirpeją</button>
        <input name="firstPartOfReservation" type="hidden" value="1">
      </form>
    </div>
    <a href="../Client/main.php">Gryžti į pradžią</a>
  </div>

</body>

</html>