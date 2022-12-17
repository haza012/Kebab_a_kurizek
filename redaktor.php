  <?php
                    echo "<h3>Články autorů</h3>";
                    $sql = "SELECT * FROM Clanky";
                    $vysledek = mysqli_query($spojeni, $sql);
                    $i = 0;
                    echo "<TABLE>";
                    echo "<TR>";
                    echo "<TH>ID</TH>";
                    echo "<TH>ID autora</TH>";
                    echo "<TH>Název</TH>";
                    echo "<TH>Stav</TH>";
                    echo "<TH COLSPAN=2></TH>";
                    echo "</TR>";
                    if (mysqli_num_rows($vysledek) > 0){
                        while ($radek = mysqli_fetch_assoc($vysledek)):
                            if (($i % 2) == 1) echo "<TR CLASS=druhy>";
                            else echo "<TR>";
                            echo "<TD>".$radek["id"]."</TD>";
                            echo "<TD>".$radek["idAutora"]."</TD>";
                            echo "<TD><a href='clanek.php?id=$radek[id]&nazev=$radek[nazev]'>".$radek["nazev"]."</a></TD>";
                            switch ($radek['stav']){
                                case 0:
                                    echo "<TD>Odeslán</TD>";
                                    echo "<TD><A HREF='zmenaStavuClanku.php?id=$radek[id]&stav=1'>Předat recenznímu řízení</A></TD>";
                                    break;
                                case 1:
                                    echo "<TD>Předán recenznímu řízení</TD>";
                                    echo "<TD><A HREF='zmenaStavuClanku.php?id=$radek[id]&stav=2'>Přijmout</A></TD>";
                                    echo "<TD><A HREF='zmenaStavuClanku.php?id=$radek[id]&stav=3'>Zamítnout</A></TD>";
                                    break;
                                case 2:
                                    echo "<TD>Přijat</TD>";
                                    break;
                                case 3:
                                    echo "<TD>Zamítnut</TD>";
                                    echo "<TD><A HREF='zmenaStavuClanku.php?id=$radek[id]&stav=1'>Předat recenznímu řízení</A></TD>";
                                    break;
                            }
                            echo "</TR>";
                            $i = $i + 1;
                        endwhile;
                    }
                    echo"</TABLE>";
                    mysqli_close($spojeni);
?>
