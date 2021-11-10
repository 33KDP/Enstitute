<?php
    session_start();
    require_once "util.php";
    require_once "../includes/dbh.inc.php";

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

            $qry = $conn->prepare("INSERT INTO TimeSlot (tutor_id, day, start_time, end_time) VALUES (:tid, :day, :start, :end)");
            $qry->execute(array(
                ':tid' => getId($_SESSION['utype'], $_SESSION['user_id']),
                ':day' => $day,
                ':start' => $start,
                ':end' => $end
            ));
            //flash message
            header("location: timeslot.php");
            return;
        }
    }