<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>
 
<form method="post" enctype="multipart/form-data">
    <label>Title</label>
    <input type="text" name="title">
    <label>File Upload</label>
    <input type="File" name="file">
    <input type="submit" name="submit">
 
 
</form>
 
</body>
</html>
 
<?php 
$localhost = "localhost"; #localhost
$dbusername = "haza01"; #username of phpmyadmin
$dbpassword = "Tis*763109";  #password of phpmyadmin
$dbname = "haza01";  #database name
 
#connection string
$conn = mysqli_connect($localhost,$dbusername,$dbpassword,$dbname);
 
if (isset($_POST["submit"]))
 {
     #obdržíme název souboru
        $title = $_POST["title"];
     
    #soubor s random shodovatelným číslem se nereplacne
     $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
 
    #docasny nazev souboru na ulozeni souboru
    $tname = $_FILES["file"]["tmp_name"];
   
     #nahrat cestu slozky
$uploads_dir = 'images';
    #TO move the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.'/'.$pname);
 
    #sql query insert do databazky
    $sql = "INSERT into fileup(title,image) VALUES('$title','$pname')";
 
    if(mysqli_query($conn,$sql)){
 
    echo "File Sucessfully uploaded";
    }
    else{
        echo "Error";
    }
}
 
 
?>
