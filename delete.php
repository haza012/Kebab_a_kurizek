<?php
  require("connect.php");
  $sql = "DELETE FROM Uzivatele WHERE id = '$_GET[id]'";
  if (mysqli_query($spojeni, $sql)) echo "Záznam byl úspěšně smazán";
  else echo "Chyba pri mazání: " . mysqli_error($spojeni);
  mysqli_close($spojeni);
?>
<br>
<a href="index.php">domů</a>