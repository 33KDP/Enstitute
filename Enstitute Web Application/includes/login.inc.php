<?php
//we don't use ending php tag because it makes error when i type something outside of a tag
if(isset($_POST["submit"])){
    //$email = $_POST["email"];
    $email = $_POST["uemail"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'function.inc.php';

    if(emptyInputlogin($email,$pwd) !== false){
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    loginUser($conn,$email,$pwd);

}else{
    header("location: ../login.php");
    exit();
}