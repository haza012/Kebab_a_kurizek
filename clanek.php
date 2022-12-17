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
    <?php
    require("connect.php");
                    echo "<h3>Název článku - $_GET[nazev]</h3>";
                    $sql = "SELECT * FROM VerzeClanku WHERE idClanku = '$_GET[id]'";
                    $vysledek = mysqli_query($spojeni, $sql);
                    $i = 0;
                    echo "<TABLE>";
                    echo "<TR>";
                    echo "<TH>Verze</TH>";
                    echo "<TH>Koncept</TH>";
                    echo "<TH>Stav verze</TH>";
                    echo "</TR>";
                    if (mysqli_num_rows($vysledek) > 0){
                        while ($radek = mysqli_fetch_assoc($vysledek)):
                            if (($i % 2) == 1) echo "<TR CLASS=druhy>";
                            else echo "<TR>";
                            echo "<TD>".($i+1)."</TD>";
                            echo "<TD><a href='download.php?id=$radek[id]'>stáhnout</a></TD>";
                            switch ($radek['stav']){
                                case 0:
                                    echo "<TD>Odeslána</TD>";
                                    break;
                                case 1:
                                    echo "<TD>Předána recenznímu řízení</TD>";
                                    break;
                                case 2:
                                    echo "<TD>Přijata</TD>";
                                    break;
                                case 3:
                                    echo "<TD>Zamítnuta</TD>";
                                    break;
                            }
                            echo "</TR>";
                            $i = $i + 1;
                        endwhile;
                    }
                    echo"</TABLE>";
                    mysqli_close($spojeni);
?>
    <br><form action="index.php">
        <input type="submit" class="input" value="Zpět">
    </form>
  </body>
</html>
