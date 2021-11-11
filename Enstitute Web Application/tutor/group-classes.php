<?php
    session_start();
    require_once "util.php";
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
        $qry = $conn->prepare("SELECT * FROM `GroupClass` JOIN Student JOIN Subject JOIN `User` ON IndividualClass.student_id = Student.id AND 
                                                                                 IndividualClass.subject_id = Subject.id AND Student.user_id = `User`.id WHERE tutor_id=:tid");
        $qry->execute(array(
            ":tid" => getId($_SESSION['utype'], $_SESSION['user_id'])
        ));
        echo '<div class="container p-4">';
            echo '<div class="row">';
                while($row = $qry->fetch(PDO::FETCH_ASSOC)) {
                    var_dump($row);
                //                echo '<div class="col-4">';
                //                echo '<div class="card mx-auto rounded-3 border-0 shadow my-3">
                //                                      <div class="card-body">
                //                                        <h5 class="card-title">'.htmlentities($row["day"]).'</h5>
                //                                        <h6 class="card-subtitle mb-2 text-muted">'.htmlentities(getTime12($row["start_time"])).' - '.htmlentities(getTime12($row["end_time"])).'</h6>
                //                                        <div class="my-3">';
                //                if ($row["state"] == 0){
                //                    echo '<span class="badge rounded-pill bg-success">Vacant</span>';
                //                } else{
                //                    echo '<span class="badge rounded-pill bg-warning text-dark">Occupied</span>';
                //                }
                //                echo'</div>
                //                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editEntry'.$row["id"].'">Edit</button>
                //                                        <button class="btn btn-sm btn-secondary"  data-bs-toggle="modal" data-bs-target="#deleteEntry'.$row["id"].'">Delete</button>
                //                                      </div>
                //                                    </div>';
                //                echo '</div>';
                }
            echo '</div>';
        echo '</div>';
        ?>
        <!--    <script src="js/timeslot.js"></script>-->
    </body>
</html>
