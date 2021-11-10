<?php
$servername = "localhost" ;
$DBUsername = "enstitute" ;
$DBPassword = "33kdp";
$DBName = "Enstitute";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$DBName", $DBUsername, $DBPassword); // Others use this
    // $conn = new PDO("mysql:host=$servername;port=3307;dbname=$DBName", $DBUsername, $DBPassword); // Thivindu use this
} catch(PDOException $error){
    header("location: ../index.php?error=database_connect_error");
    $message = $error->getMessage();  
}
