<?php
                    echo "admin";
                    echo "<h4>Uživatelé</h4>";
                    $sql = "SELECT * FROM Uzivatele";
                    $vysledek = mysqli_query($spojeni, $sql);
                    $i = 0;
                    echo "<TABLE>";
                    echo "<TR>";
                    echo "<TH>ID</TH>";
                    echo "<TH>Login</TH>";
                    echo "<TH>Heslo</TH>";
                    echo "<TH>Oprávnění</TH>";
                    echo "<TH COLSPAN=2></TH>";
                    echo "</TR>";
                    if (mysqli_num_rows($vysledek) > 0){
                        while ($radek = mysqli_fetch_assoc($vysledek)):
                            if (($i % 2) == 1) echo "<TR CLASS=druhy>";
                            else echo "<TR>";
                            $id = $radek["id"];
                            echo "<TD>".$radek["id"]."</TD>";
                            echo "<TD>".$radek["login"]."</TD>";
                            echo "<TD>".$radek["heslo"]."</TD>";
                            switch ($radek[opravneni]){
                                case 0:
                                    echo "<TD>Uživatel</TD>";
                                    break;
                                case 1:
                                    echo "<TD>Autor</TD>";
                                    break;
                                case 2:
                                    echo "<TD>Recenzent</TD>";
                                    break;
                                case 3:
                                    echo "<TD>Redaktor</TD>";
                                    break;
                                case 4:
                                    echo "<TD>Šéfredaktor</TD>";
                                    break;
                                default:
                                    echo "<TD>Administrátor</TD>";
                                    break;
                            }
                            echo "<TD><A HREF='smazat.php?id=$id'>Smazat</A></TD>";
                            echo "<TD><A HREF='upravit.php?id=$id'>Upravit</A></TD>";
                            echo "</TR>";
                            $i = $i + 1;
                        endwhile;
                    }
                    echo"</TABLE>";
                    mysqli_close($spojeni);
                    echo "<h4>Přidání nového uživatele</h4>";
                    echo "<form action='insert.php' method='GET'>";
                    echo "<span>login:</span><input name='login'><br><br>";
                    echo "<span>heslo:</span><input name='heslo'><br><br>";
                    echo "<input type=submit class='input' value='Přidat'>";
                    echo "</form>";
?>