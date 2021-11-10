<?php
$servername = "localhost" ;
$DBUsername = "enstitute" ;
$DBPassword = "33kdp";
$DBName = "Enstitute";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$DBName", $DBUsername, $DBPassword);
} catch(PDOException $error){
    header("location: ../index.php?error=database_connect_error");
    $message = $error->getMessage();  
}
