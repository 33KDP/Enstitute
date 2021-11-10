<?php
//we don't use ending php tag because it makes error when i type something outside of a tag
if(isset($_POST["submit"])){
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $grade = $_POST["grade"];
    $distric = $_POST["district"];
    $city = $_POST["city"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];
    $user_type = $_POST["usertype"];

    require_once 'dbh.inc.php';
    require_once 'function.inc.php';
    global $conn;
    if(emptyInputSignup($fname,$fname,$email,$pwd,$pwdrepeat,$user_type,$grade,$distric,$city) !== false){
        header("location: ../signup.php?error=emptyinput");
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
    if(UidExists($conn,$email) !== false){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    createUser($conn,$fname,$lname,$email,$pwd,$user_type,$grade,$distric,$city);
    

}else{
    header("location: ../signup.php");
}