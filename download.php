<?php
if(isset($_GET['id']))
{
// if id is set then get the file with the id from database

require("connect.php");

$id    = $_GET['id'];
$query = "SELECT koncept, name, type, size " .
         "FROM VerzeClanku WHERE id = '$id'";

$result = mysqli_query($spojeni, $query) or die('Error, query failed');
$clanek = mysqli_fetch_assoc($result);

header("Content-length: $clanek[size]");
header("Content-type: $clanek[type]");
header("Content-Disposition: attachment; filename=$clanek[name]");
echo $clanek['koncept'];

exit;
mysqli_close($spojeni);
}

?>
<br>
<a href="index.php">domů</a>
 