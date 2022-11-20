<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="generator" content="PSPad editor, www.pspad.com">
    <title></title>
    <style>
        input{
            width: 50px;
            padding: 5px;
        }
    </style>
  </head>
  <body>
    <?php
      require("connect.php");
      $sql = "SELECT * FROM Uzivatele WHERE id=$_GET[id]";      
      $vysledek = mysqli_query($spojeni, $sql);
      $radek = mysqli_fetch_assoc($vysledek);
      $id=$radek['id'];
      echo "<H4>Chcete tento záznam opravdu smazat?</H4>";
      echo "<B>ID:</B> ".$radek['id']."<BR>";
      echo "<B>Login:</B> ".$radek['login']."<BR>";
      echo "<B>Heslo:</B> ".$radek['heslo']."<BR>";
      echo "<B>Oprávnění:</B> ".$radek['opravneni']."<BR><BR>";
      mysqli_close($spojeni);
    ?>
    <form action="delete.php" method="GET">
      <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
      <input type="submit" VALUE="Ano">
    </form>
    <form action="index.php">
        <input type=submit value="Zpět">
    </form>
  </body>
</html>
