<?php
    session_start();
    require_once "util.php";
    require_once "../includes/dbh.inc.php";
    if (!isset($_SESSION['user_id'])){
        die("ACCESS DENIED");
    }

    if (isset($_POST['dayInput']) && isset($_POST['startTime']) && isset($_POST['endTime'])) {
        if ($_POST['startTime'] === "" || $_POST['endTime'] === "" || $_POST['dayInput'] === "") {
            //flash message
            header('Location: timeslot.php');
            return;
        } else {
            global $conn;
            $day = $_POST['dayInput'];
            $start = getMinutes($_POST['startTime']);
            $end = getMinutes($_POST['endTime']);
            $timeid = $_POST['timeid'];

            $qry = $conn->prepare("UPDATE TimeSlot set day=:day, start_time=:start, end_time=:end WHERE id=:timeid");
            $qry->execute(array(
                ':day' => $day,
                ':start' => $start,
                ':end' => $end,
                ':timeid'=> $timeid
            ));
            //flash message
            header("location: timeslot.php");
            return;
        }
    }