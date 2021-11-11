<?php
    require_once "../classes/Session.class.php";
    require_once "../classes/DBConn.class.php";
    session_start();

    $curSession = $_SESSION['session'];
    if ($curSession->isLoggedIn()){
        $curTutor = $curSession->getUser();
    }else{
        header("location: ../index.php");
    }

?>

<html>
    <head>
        <?php require_once "../bootstrap.php"; ?>
        <?php require_once "head.php"; ?>
    </head>
    <body>
        <?php require_once "navbar.php"; ?>

    </body>
</html>
