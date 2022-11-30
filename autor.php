<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <title></title>
  <style>
         textarea{
            width: 400px;
            height: 200px;
            margin-top: 5px;
         }
  </style>
  </head>
  <body>
<div>
    <h3>Nabídnutí článku</h3>
    <form id="form" action='pridatClanek.php' method='GET'>
    Název článku: <input type="text" id="nazev" name="nazev" required><br><br>
  <!--<input type="file" id="filename" accept=".docx"><br><br>-->
  Koncept:<br>
  <textarea id="koncept" name="koncept" form="form" required></textarea><br><br>
  <?php
     echo "<input id='idAutora' name='idAutora' type='hidden' value='$_SESSION[id]'>";
  ?>
  <input type="submit" value="Odeslat">
  <!--<button id="tlacitko">Odeslat</button>
  <label id="text"></label>-->
  </form>
  <h3>Vaše články</h3>
  <?php
                    $sql = "SELECT * FROM Clanky WHERE Clanky.idAutora = '$_SESSION[id]'";
                    $vysledek = mysqli_query($spojeni, $sql);
                    $i = 0;
                    echo "<TABLE>";
                    echo "<TR>";
                    echo "<TH>Název</TH>";
                    echo "<TH>Stav</TH>";
                    echo "</TR>";
                    if (mysqli_num_rows($vysledek) > 0){
                        while ($radek = mysqli_fetch_assoc($vysledek)):
                            if (($i % 2) == 1) echo "<TR CLASS=druhy>";
                            else echo "<TR>";
                            echo "<TD><a href='clanek.php?id=$radek[id]&nazev=$radek[nazev]'>".$radek["nazev"]."</a></TD>";
                            echo "<TD>".$radek["stav"]."</TD>";
                            echo "</TR>";
                            $i = $i + 1;
                        endwhile;
                    }
                    echo"</TABLE>";
                    mysqli_close($spojeni);
?>
<script>



$('#tlacitko').click(function(){
 //if (document.getElementById('filename').value.endsWith('.docx') && document.getElementById('nazev').value.length > 0) {
   if(document.getElementById('nazev').value.length > 0 && document.getElementById('koncept').value.length > 0) {
    var id = document.getElementById('idAutora').value.toString();
    var koncept = document.getElementById('koncept').value;
    
    $("#text").text('Odesláno');
    $("#text").css("color","green");
 }
 else{
    $("#text").text('Chyba');
    $("#text").css("color","red");
 }
});
</script>
</div>
  </body>
</html>
