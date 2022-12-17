<?php
  require("connect.php");
  $fileName = $_FILES['filename']['name'];
  $tmpName  = $_FILES['filename']['tmp_name'];
  $fileSize = $_FILES['filename']['size'];
  $fileType = $_FILES['filename']['type'];
  $fp      = fopen($tmpName, 'r');
  $content = fread($fp, filesize($tmpName));
  $content = addslashes($content);
  fclose($fp);
  $sql = "INSERT INTO Clanky (idAutora, nazev)
  values('$_POST[idAutora]','$_POST[nazev]')";
  if (mysqli_query($spojeni, $sql)) echo "Záznam byl úspešně přidán";
  else echo "Chyba při přidávání: " . mysqli_error($spojeni);
  
          $sql = "SELECT * FROM Clanky WHERE Clanky.nazev = '$_POST[nazev]'";
        $vysledek = mysqli_query($spojeni, $sql);        
        if(mysqli_num_rows($vysledek) > 0){
            $clanek = mysqli_fetch_assoc($vysledek);
            $idClanku = $clanek["id"];
        } 
        
          $sql = "INSERT INTO VerzeClanku (idClanku, koncept, name, type, size)
  values('$idClanku','$content', '$fileName', '$fileType', '$fileSize')";
  if (mysqli_query($spojeni, $sql)) echo "Záznam byl úspešně přidán";
  else echo "Chyba při přidávání: " . mysqli_error($spojeni);

          mysqli_close($spojeni);
?>
<br>
<a href="index.php">domů</a>
