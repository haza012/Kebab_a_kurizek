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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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
        #odeslat, #registrovat{
            display: none;
        }
    </style>
  </head>
  <body>
    <span id="login">
      <?php
          echo "<form method='post'>";
          if($_SESSION["prihlaseni"] == 1) echo "<input id='odhlasit' name='odhlasit' type='submit' value='Odhlásit'>";
          else{
              echo "<h4>Přihlášení</h4>";
              echo "<input placeholder='login' id='login' name='login' type='text'><br><br>";
              echo "<input placeholder='heslo' id='heslo' name='heslo' type='password'><br><br>";
              echo "<input id='prihlasit' name='prihlasit' type='submit' value='Přihlásit'>";
              echo "</form>";
              echo "<h4>Registrace</h4>";
              echo "<form action='insert.php' method='GET'>";
              echo "<input placeholder='login' name='login'><br><br>";
              echo "<input placeholder='heslo' id='heslo2' name='heslo' type='password'><br><br>";
              echo "<input placeholder='heslo znovu' id='heslo3' name='heslo2' type='password'><br><br>";
              echo "<input id='registrovat' type=submit name='registrovat' value='Registrovat'>";
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
<script>
    $('#heslo2,#heslo3').on("keyup", function(){
        if (document.getElementById('heslo2').value == document.getElementById('heslo3').value){
            $("#registrovat").css("display","block");
        }
        else{
            $("#registrovat").css("display","none");
        }
    });
</script>