<?php
$servername = "localhost" ;
$DBUsername = "root" ;
$DBPassword = "root";
$DBName = "samplelogin";

try{
    //$conn = mysqli_connect($servername,$DBUsername,$DBPassword,$DBName);  //-by mysqli
    $conn = new PDO("mysql:host=$servername;dbname=$DBName", $DBUsername, $DBPassword);
}catch(PDOException $error){
    $message = $error->getMessage();  
}
