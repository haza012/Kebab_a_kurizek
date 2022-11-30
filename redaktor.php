<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title></title>
  </head>
  <body>
<div>
  <h3>Články autorů</h3>
  <?php
                    $sql = "SELECT * FROM Clanky";
                    $vysledek = mysqli_query($spojeni, $sql);
                    $i = 0;
                    echo "<TABLE>";
                    echo "<TR>";
                    echo "<TH>ID</TH>";
                    echo "<TH>ID autora</TH>";
                    echo "<TH>Název</TH>";
                    echo "<TH>Stav</TH>";
                    echo "</TR>";
                    if (mysqli_num_rows($vysledek) > 0){
                        while ($radek = mysqli_fetch_assoc($vysledek)):
                            if (($i % 2) == 1) echo "<TR CLASS=druhy>";
                            else echo "<TR>";
                            echo "<TD>".$radek["id"]."</TD>";
                            echo "<TD>".$radek["idAutora"]."</TD>";
                            echo "<TD><a href='clanek.php?id=$radek[id]&nazev=$radek[nazev]'>".$radek["nazev"]."</a></TD>";
                            echo "<TD>".$radek["stav"]."</TD>";
                            echo "</TR>";
                            $i = $i + 1;
                        endwhile;
                    }
                    echo"</TABLE>";
                    mysqli_close($spojeni);
?>
</div>
  </body>
</html>
