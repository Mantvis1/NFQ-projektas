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
    <label value="">Iveskite savo varda</label><br>
    <input type="text" required name="name"><br>
    <label value="">Iveskite savo pavarde</label><br>
    <input type="text" required name="surname"><br>
    <button class="btn btn-primary btn-lg" type="submit">Ieskoti</button>
    <input type="hidden" name="postHaircutterName" value="1" readonly>
  </form>
</body>

</html>