<?php
    require_once('includes/LogIn.php');
    require_once('includes/DBConn.php');

    $loginObj = new LogIn(DBConn::getInstance());

    if (isset($_POST['Login'])){
        $loginObj->logInUser($_POST);
    } else {
        var_dump($_POST);
        //header("location: ../index.php");
    }
