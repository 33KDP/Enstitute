<?php
    session_start();
    require_once "../includes/dbh.inc.php";
    if (!isset($_SESSION['user_id'])){
        die("ACCESS DENIED");
    }
?>

<html>
    <head>
        <?php require_once "bootstrap.php"; ?>
        <?php require_once "head.php"; ?>
    </head>
    <body>
    <?php require_once "navbar.php"; ?>
    <?php
    global $conn;
    $qry = $conn->prepare("SELECT * FROM `User` JOIN `Tutor` JOIN `Request` ON `User`.`id` = `Tutor`.`user_id` 
                                                         AND `Tutor`.`id` = `Request`.`tutor_id` WHERE `User`.`id`=:uid");
    $qry->execute(array(
        ":uid" => $_SESSION["user_id"]
    ));
    $row = $qry->fetch(PDO::FETCH_ASSOC);
    if ($row === false){

    }
    while($row = $qry->fetch(PDO::FETCH_ASSOC)) {
        echo $row["subject_id"];
        echo $row["message"];
        echo $row["type"];
        echo $row["state"];
    }
    ?>
    </body>
</html>
