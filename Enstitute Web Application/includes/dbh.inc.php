<?php
$servername = "localhost" ;
$DBUsername = "enstitute" ;
$DBPassword = "33kdp";
$DBName = "Enstitute";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$DBName", $DBUsername, $DBPassword);
} catch(PDOException $error){
    $message = $error->getMessage();  
}
