<?php
    require_once('./classes/LogIn.class.php');
    require_once('./classes/DBConn.class.php');

    $loginObj = new LogIn(DBConn::getInstance());

    if (isset($_POST['Login'])){
        $loginObj->logInUser($_POST);
    } else {
        header("location: index.php");
    }
