<?php

function emptyInputSignup($name,$email,$username,$pwd,$pwdrepeat){
    $reuslt;
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdrepeat)){
        $reuslt = true;
    }else{
        $reuslt = false;
    }
    return $reuslt;
}

function invalidUid($username){
    $reuslt;
    if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        $reuslt = true;
    }else{
        $reuslt = false;
    }
    return $reuslt;
}

function invalidEmail($email){
    $reuslt;
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $reuslt = true;
    }else{
        $reuslt = false;
    }
    return $reuslt;
}

function pwdnotMatch($pwd,$pwdrepeat){
    $reuslt;
    if($pwd !== $pwdrepeat){
        $reuslt = true;
    }else{
        $reuslt = false;
    }
    return $reuslt;
}

function UidExists($conn,$username,$email){

    $sql="SELECT * FROM users WHERE usersUid = :un OR usersEmail = :ue";
    $stmt = $conn->prepare($sql);

	$stmt -> execute(array(
		':un' => $_POST['uid'],
		':ue' => $_POST['email']
	));
    $row = $stmt->fetch(pdo::FETCH_ASSOC);

    if($row){
        return $row;
    }else{
        $reuslt = false;
        return $reuslt;
    }

    /*  -------------------- BY mysqli -------------------------------------
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../index.php?error=stmtfailed");
        exit(); 
    }

    mysqli_stmt_bind_param($stmt, "ss", $username,$email); //bindparameters
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt); //get the results what we prepare in line 45

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $reuslt = false;
        return $reuslt;
    }

    mysqli_stmt_close($stmt);
    */
}

function createUser($conn,$name,$email,$username,$pwd){
    $sql="INSERT INTO users(usersName,usersEmail,usersUid,userspwd) VALUES(:fname,:uemail,:uname,:upassword)";
    $stmt  = $conn->prepare($sql);

    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

    $stmt->execute(array(
        ':fname' => $name,
        ':uemail' => $email,
        ':uname' =>$username,
        ':upassword' => $hashedpwd)
        );

    $profile_id = $conn->lastInsertId();
    if(profile_id){
        header("location: ../signup.php?error=none");
    }else{
        header("location: ../signup.php?error=stmtfailed");
    }

    /*   -------------- by mysqli --------------------------------
    $sql = "INSERT INTO users(usersName,usersEmail,usersUid,userspwd) VALUES (?,?,?,?)" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit(); 
    }

    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name,$email,$username,$hashedpwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    */

    
}


//functions for login page

function emptyInputlogin($username,$pwd){
    $reuslt;
    if(empty($username) || empty($pwd)){
        $reuslt = true;
    }else{
        $reuslt = false;
    }
    return $reuslt;
}

function loginUser($conn,$username,$pwd){
    $uidExists = UidExists($conn,$username,$username);  //it is not a problem weather user gives email or his username UidExist function check both with or operator

    if($uidExists === false){
        header("location: ../login.php?error=notexists");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkpwd = password_verify($pwd, $pwdHashed);

    if($checkpwd === false){
        header("location: ../login.php?error=incorrectpw");
        exit();        
    }
    else if($checkpwd === true){
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];  
        $_SESSION["username"] = $uidExists["usersName"]; 
        header("location: ../index.php"); //after loging what user see
        exit();
    }
}