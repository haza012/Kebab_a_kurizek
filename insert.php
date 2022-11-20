<?php
  require("connect.php");
  $sql = "INSERT INTO Uzivatele (login, heslo)
  values('$_GET[login]','$_GET[heslo]')";
  if (mysqli_query($spojeni, $sql)) echo "Záznam byl úspešně přidán";
  else echo "Chyba při přidávání: " . mysqli_error($spojeni);
  mysqli_close($spojeni);
?>
<br>
<a href="index.php">domů</a>






