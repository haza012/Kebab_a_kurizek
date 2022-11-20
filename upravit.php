<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="generator" content="PSPad editor, www.pspad.com">
    <title></title>
    <style>
        .input{
            width: 75px;
            padding: 5px;
        }
        span{
            width: 100px;
            display: inline-block;
        }
        .info{
            width: auto;
        }
    </style>
  </head>
  <body>
    <h4>Úprava údajů</h4>
    <?php
      require("connect.php");
      $sql = "SELECT * FROM Uzivatele WHERE id=$_GET[id]";      
      $vysledek = mysqli_query($spojeni, $sql);
      $radek = mysqli_fetch_assoc($vysledek);
      echo "id: ".$_GET[id];
      mysqli_close($spojeni);
    ?>
    <form action="update.php" method="GET">
      <input name=id type=hidden value="<?php echo $radek['id'] ?>"><br>
      <span>login:</span><input name="login" value="<?php echo $radek['login'] ?>"><br><br>
      <span>heslo:</span><input name="heslo" value="<?php echo $radek['heslo'] ?>"><br><br>
      <span class="info"><b>0</b> - uživatel <b>| 1</b> - autor <b>| 2</b> - recenzent <b>| 3</b> - redaktor <b>| 4</b> - šéfredaktor</span><br><br>
      <span>oprávnění:</span><input name="opravneni" value="<?php echo $radek['opravneni'] ?>"><br><br>
      <input type=submit class="input" value="Změnit">
    </form>
    <form action="index.php">
        <input type="submit" class="input" value="Zpět">
    </form>
  </body>
</html>
