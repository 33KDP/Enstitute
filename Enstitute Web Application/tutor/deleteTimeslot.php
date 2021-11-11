<?php
    session_start();
    require_once "util.php";
    require_once "../includes/dbh.inc.php";
    if (!isset($_SESSION['user_id'])){
        die("ACCESS DENIED");
    }

    if (isset($_POST['Delete'])) {
        global $conn;
        $qry = $conn->prepare("DELETE FROM Timeslot WHERE id=:timeid");
        $qry->execute(array(
            ':timeid' => $_POST['timeid']
        ));
        //flash message
        header("location: timeslot.php");
        return;
    } else {
        header("location: timeslot.php");
        return;
    }
