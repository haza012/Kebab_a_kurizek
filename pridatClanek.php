<?php
  require("connect.php");
  $sql = "INSERT INTO Clanky (idAutora, nazev)
  values('$_GET[idAutora]','$_GET[nazev]')";
  if (mysqli_query($spojeni, $sql)) echo "Záznam byl úspešně přidán";
  else echo "Chyba při přidávání: " . mysqli_error($spojeni);
  
          $sql = "SELECT * FROM Clanky WHERE Clanky.nazev = '$_GET[nazev]'";
        $vysledek = mysqli_query($spojeni, $sql);        
        if(mysqli_num_rows($vysledek) > 0){
            $clanek = mysqli_fetch_assoc($vysledek);
            $idClanku = $clanek["id"];
        } 
        
          $sql = "INSERT INTO VerzeClanku (idClanku, koncept)
  values('$idClanku','$_GET[koncept]')";
  if (mysqli_query($spojeni, $sql)) echo "Záznam byl úspešně přidán";
  else echo "Chyba při přidávání: " . mysqli_error($spojeni);

          mysqli_close($spojeni);
?>
<br>
<a href="index.php">domů</a>
