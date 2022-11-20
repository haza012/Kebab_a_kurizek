<?php
    require("connect.php");
    session_start();
    if($_POST["prihlasit"]){
        $sql = "SELECT * FROM Uzivatele WHERE Uzivatele.login = '$_POST[login]' and Uzivatele.heslo = '$_POST[heslo]'";
        $vysledek = mysqli_query($spojeni, $sql);        
        if(mysqli_num_rows($vysledek) > 0){
            $_SESSION["prihlaseni"] = 1;
            $uzivatel = mysqli_fetch_assoc($vysledek);
            $_SESSION["opravneni"] = $uzivatel["opravneni"];
        } 
    }
    else if($_POST["odhlasit"]){
        session_unset();
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="generator" content="PSPad editor, www.pspad.com">
    <title></title>
    <style>
        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td{
            width: auto;
            padding: 5px;
            padding-left: 10px;
            padding-right: 10px;
            text-align: center;
        }
        th{
            background-color: pink;
        }
        .druhy{
            background-color: palegreen;
        }
        .input{
            width: 75px;
            padding: 5px;
        }
        span{
            width: 100px;
            display: inline-block;
        }
    </style>
  </head>
  <body>
    <span id="login">
      <?php
          echo "<form method='post'>";
          if($_SESSION["prihlaseni"] == 1) echo "<input id='odhlasit' name='odhlasit' type='submit' value='Odhlásit'>";
          else{
              echo "<input placeholder='login' id='login' name='login' type='text'><br><br>";
              echo "<input placeholder='heslo' id='heslo' name='heslo' type='password'><br><br>";
              echo "<input id='prihlasit' name='prihlasit' type='submit' value='Přihlásit'>";
          }
          echo "</form>";
      ?>
    </span>
    <?php
        if($_SESSION["prihlaseni"] == 1){
            switch($_SESSION["opravneni"]){
                default:
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
                    break;
                case 0:
                    echo "uživatel";
                    break;
                case 1:
                    echo "autor";
                    break;
                case 2:
                    echo "recenzent";
                    break;
                case 3:
                    echo "redaktor";
                    break;
                case 4:
                    echo "šéfredaktor";
                    break;
            } 
        }                                                                                
    ?>
  </body>
</html>
