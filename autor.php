<?php
                    echo "autor";
                    echo "<h4>Nabídnutí článku</h4>";
                    echo "<form action='pridatClanek.php' method='POST' enctype='multipart/form-data'>";
                    echo "<span>Název článku:</span><input name='nazev'><br><br>";
                    echo "<input id='filename' type='file' name='filename' accept='.pdf, .doc, .docx'><label id='text'></label><br><br>";
                    echo "<input type=submit class='input' id='odeslat' value='Odeslat'><br><br>";
                    echo "<input name='idAutora' type='hidden' value='$_SESSION[id]'>";
                    echo "</form>";
                    echo "<h3>Vaše články</h3>";
                    $sql = "SELECT * FROM Clanky WHERE Clanky.idAutora = '$_SESSION[id]'";
                    $vysledek = mysqli_query($spojeni, $sql);
                    $i = 0;
                    echo "<TABLE>";
                    echo "<TR>";
                    echo "<TH>Název</TH>";
                    echo "<TH>Stav článku</TH>";
                    echo "</TR>";
                    if (mysqli_num_rows($vysledek) > 0){
                        while ($radek = mysqli_fetch_assoc($vysledek)):
                            if (($i % 2) == 1) echo "<TR CLASS=druhy>";
                            else echo "<TR>";
                            echo "<TD><a href='clanek.php?id=$radek[id]&nazev=$radek[nazev]'>".$radek["nazev"]."</a></TD>";
                            switch ($radek['stav']){
                                case 0:
                                    echo "<TD>Odeslán</TD>";
                                    break;
                                case 1:
                                    echo "<TD>Předán recenznímu řízení</TD>";
                                    break;
                                case 2:
                                    echo "<TD>Přijat</TD>";
                                    break;
                                case 3:
                                    echo "<TD>Zamítnut</TD>";
                                    break;
                            }
                            echo "</TR>";
                            $i = $i + 1;
                        endwhile;
                    }
                    echo"</TABLE>";
                    mysqli_close($spojeni);
?>
<script>
    $('#filename').change(function(){
        if (document.getElementById('filename').value.endsWith('.pdf') || document.getElementById('filename').value.endsWith('.doc') || document.getElementById('filename').value.endsWith('.docx')){
            $("#text").text('ok');
            $("#text").css("color","green");
            $("#odeslat").css("display","block");
        }
        else{
            $("#text").text('chyba');
            $("#text").css("color","red");
            $("#odeslat").css("display","none");
        }
    });
</script>
