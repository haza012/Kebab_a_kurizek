<?php
  require("connect.php");
  $sql = "UPDATE Clanky SET stav = '$_GET[stav]' WHERE id = $_GET[id]";
  if (mysqli_query($spojeni, $sql)) echo "Záznam byl úspěšně změněn";
  else echo "Chyba při měnění: " . mysqli_error($spojeni);
  mysqli_close($spojeni);
?>
<br>
<a href="index.php">domů</a>