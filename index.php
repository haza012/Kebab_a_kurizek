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
            $_SESSION["id"] = $uzivatel["id"];
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
                    include 'admin.php';
                    break;
                case 0:
                    echo "uživatel";
                    break;
                case 1:
                    echo "autor";
                    include 'autor.php';
                    break;
                case 2:
                    echo "recenzent";
                    break;
                case 3:
                    echo "redaktor";
                    include 'redaktor.php';
                    break;
                case 4:
                    echo "šéfredaktor";
                    break;
            } 
        }                                                                                
    ?>
  </body>
</html>
