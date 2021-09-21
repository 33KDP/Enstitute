<?php
//we don't use ending php tag because it makes error when i type something outside of a tag
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'function.inc.php';

    if(emptyInputSignup($name,$email,$username,$pwd,$pwdrepeat) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(invalidUid($username) !== false){
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if(invalidEmail($email) !== false){
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if(pwdnotMatch($pwd,$pwdrepeat) !== false){
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if(UidExists($conn, $username,$email) !== false){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    createUser($conn,$name,$email,$username,$pwd);
    

}else{
    header("location: ../signup.php");
}