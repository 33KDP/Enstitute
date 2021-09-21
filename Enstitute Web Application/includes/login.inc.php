<?php
//we don't use ending php tag because it makes error when i type something outside of a tag
if(isset($_POST["submit"])){
    //$email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'function.inc.php';

    if(emptyInputlogin($username,$pwd) !== false){
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    loginUser($conn,$username,$pwd);

}else{
    header("location: ../login.php");
    exit();
}