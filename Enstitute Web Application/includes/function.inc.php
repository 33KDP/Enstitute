<?php

function emptyInputSignup($fname,$lname,$email,$pwd,$pwdrepeat,$user_type,$grade,$distric,$city){
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
    if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        $reuslt = true;
    }else{
        $reuslt = false;
    }
    return $reuslt;
}

function invalidEmail($email){
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $reuslt = true;
    }else{
        $reuslt = false;
    }
    return $reuslt;
}

function pwdnotMatch($pwd,$pwdrepeat){
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
        $usid = $row["id"];

        $sql2="SELECT * FROM `authentication` WHERE `user_id` = :userid";
        $stmt2 = $conn->prepare($sql2);
    
        $stmt2 -> execute(array(
            ':userid' => $usid
        ));
        $row2 = $stmt2->fetch(pdo::FETCH_ASSOC);
    
        $row["password"] = $row2["password"];
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

        $sql3="INSERT INTO tutor(`user_id`) VALUES(:uids)";
        $stmt3  = $conn->prepare($sql3);
        $stmt3->execute(array(
            ':uids' => $profile_id)
            );
            
    }


    $profile_id = $conn->lastInsertId();
    if($profile_id){
        header("location: ../signup.php?error=none");
    }else{
        header("location: ../signup.php?error=stmtfailed");
    }
    
}


//functions for login page

function emptyInputlogin($email,$pwd){
    if(empty($email) || empty($pwd)){
        $reuslt = true;
    }else{
        $reuslt = false;
    }
    return $reuslt;
}

function loginUser($conn,$email,$pwd){
    $uidExists = UidExists($conn,$email);

    if($uidExists === false){
        header("location: ../login.php?error=notexists");
        exit();
    }

    $pwdHashed = $uidExists["password"];
    $checkpwd = password_verify($pwd, $pwdHashed);

    if($checkpwd === false){
        header("location: ../login.php?error=incorrectpw");
        exit();        
    }
    else if($checkpwd === true){
        session_start();
        $_SESSION["utype"] = $uidExists["usertype_id"];
        $_SESSION["fname"] = $uidExists["first_name"];  
        $_SESSION["lname"] = $uidExists["last_name"];
        $_SESSION["user_id"] = $uidExists["id"];
        if ($uidExists["usertype_id"] == 1){
            header("location: ../Student/index.php"); //Student home page
        } else {
            header("location: ../Tutor/home.php"); //Tutor home page
        }

        exit();
    }
}