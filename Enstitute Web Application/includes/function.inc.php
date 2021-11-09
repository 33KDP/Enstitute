<?php

function emptyInputSignup($fname,$lname,$email,$pwd,$pwdrepeat,$user_type,$grade,$distric,$city){
    $reuslt;
    if( empty($fname) || empty($lname) || empty($email)  || empty($pwd) || empty($pwdrepeat) || empty($user_type) || empty($distric) || empty($city)){
        $reuslt = true;
    }else{
        if($user_type=="student"){
            if(empty($grade)){
                $reuslt = true;
            }else{
                $reuslt = false;
            }
        }else{
            $reuslt = false;
        }    
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

function UidExists($conn,$email){

    $sql="SELECT * FROM user WHERE email = :ue";
    $stmt = $conn->prepare($sql);

	$stmt -> execute(array(
		':ue' => $email
	));
    $row = $stmt->fetch(pdo::FETCH_ASSOC);

    if($row){
        return $row;
    }else{
        $reuslt = false;
        return $reuslt;
    }

}

function createUser($conn,$fname,$lname,$email,$pwd,$user_type,$grade,$distric,$city){
    if($user_type=="student"){
        $sql1="INSERT INTO user(usertype_id,email,first_name,last_name,district,city) VALUES(:utype,:uemail,:fname,:lname,:distric,:city)";
        $stmt1  = $conn->prepare($sql1);
    
        $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
    
        $stmt1->execute(array(
            ':utype' => 1,
            ':uemail' => $email,
            ':fname' => $fname,
            ':lname' => $lname,
            ':distric' => $distric,
            ':city' => $city)
            );

        $profile_id = $conn->lastInsertId();

        $sql2="INSERT INTO `authentication`(`user_id`,`password`) VALUES(:uida,:upassword)";
        $stmt2  = $conn->prepare($sql2);
        $stmt2->execute(array(
            ':uida' => $profile_id,
            ':upassword' => $hashedpwd)
            );

        $sql3="INSERT INTO student(`user_id`,grade) VALUES(:uids,:sgrade)";
        $stmt3  = $conn->prepare($sql3);
        $stmt3->execute(array(
            ':uids' => $profile_id,
            ':sgrade' => $grade)
            );

    }else{
        $sql1="INSERT INTO user(usertype_id,email,first_name,last_name,district,city) VALUES(:utype,:uemail,:fname,:lname,:distric,:city)";
        $stmt1  = $conn->prepare($sql1);
    
        $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
    
        $stmt1->execute(array(
            ':utype' => 2,
            ':uemail' => $email,
            ':fname' => $fname,
            ':lname' => $lname,
            ':distric' => $distric,
            ':city' => $city)
            );

        $profile_id = $conn->lastInsertId();

        $sql2="INSERT INTO `authentication`(`user_id`,`password`) VALUES(:uida,:upassword)";
        $stmt2  = $conn->prepare($sql2);
        $stmt2->execute(array(
            ':uida' => $profile_id,
            ':upassword' => $hashedpwd)
            );
    }


    $profile_id = $conn->lastInsertId();
    if(profile_id){
        header("location: ../signup.php?error=none");
    }else{
        header("location: ../signup.php?error=stmtfailed");
    }
    
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