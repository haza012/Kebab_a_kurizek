<?php

//Získame data z formuláře v login.php souboru

$username = $_POST['user'];
$password = $_POST['passwd'];


// prepojit na mysql

$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);


//pripojit na server a vybrat databazku

mysql_connect("localhost", "root", "");
mysql_select_db("login");

//query databazky pro usera

$result = mysql_query("select * from users where username = '$username' and password = '$password'")
			or die("Failed to query database ".mysql_error());
$row = mysql_fetch_array($result);
if ($row['username'] == $username && $row['password'] == $password){
		echo "Login success! Welcome ".$row['username'];
}else {
	echo "Failed to login!";
}




?>