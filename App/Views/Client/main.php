<html>
<head>
<style>
</style>
</head>
<body>
<form action="../../Controllers/clientController.php" method="POST">
<label value="">Iveskite savo varda</label>
<input type="text" name="name">
<label value="">Iveskite savo pavarde</label>
<input type="text" name="surname">
<button type="submit">Ieskoti</button>
<input type="hidden" name="postClientName" value="1" readonly>
</form>
</body>
</html>