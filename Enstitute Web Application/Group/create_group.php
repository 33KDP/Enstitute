<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>New Group</title>
    <?php require_once "bootstrap.php";?>
</head>
<body>
<?php #flash();?>

<div class="container">
    <h1>Create a new Group from Below</h1>

    <!--?php

    if (isset($_SESSION['name'])){
        if (isset($_POST['cancel'])){
            header('Location: index.php');
            return;
        }

        if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])) {
            if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1 ) {
                $_SESSION['failure'] = "All fields are required";
            } else if (!strpos($_POST['email'], '@')) {
                $_SESSION['failure'] = "Email must have an at-sign (@)";
            } else if (($msg = validatePos()) !== True){
                $_SESSION['failure'] = $msg;
            } else {
                $stmt = $pdo->prepare('INSERT INTO Profile
                (user_id, first_name, last_name, email, headline, summary)
                VALUES ( :uid, :fn, :ln, :em, :he, :su)');

                $stmt->execute(array(
                ':uid' => $_SESSION['user_id'],
                ':fn' => $_POST['first_name'],
                ':ln' => $_POST['last_name'],
                ':em' => $_POST['email'],
                ':he' => $_POST['headline'],
                ':su' => $_POST['summary'])
                );

                $profile_id = $pdo->lastInsertId();

                $stmt = $pdo->prepare('INSERT INTO Position (profile_id, rank, year, description) VALUES ( :pid, :rank, :year, :desc)');
                $rank = 1;
                for($i=1; $i<=9; $i++) {
                    if ( ! isset($_POST['year'.$i]) ) continue;
                    if ( ! isset($_POST['desc'.$i]) ) continue;

                    $year = $_POST['year'.$i];
                    $desc = $_POST['desc'.$i];

                    $stmt->execute(array(
                        ':pid' => $profile_id,
                        ':rank' => $rank,
                        ':year' => $year,
                        ':desc' => $desc
                    ));
                    $rank++;
                }

                $rank = 1;
                for ($i = 1; $i <= 9; $i++) {
                    if (!isset($_POST['edu_year' . $i])) continue;
                    if (!isset($_POST['edu_school' . $i])) continue;

                    $edu_year = $_POST['edu_year' . $i];
                    $edu_school = $_POST['edu_school' . $i];

                    $stmt = $pdo->prepare("SELECT * FROM Institution where name = :xyz");
                    $stmt->execute(array(":xyz" => $edu_school));
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($row) {
                        $institution_id = $row['institution_id'];
                    } else {
                        $stmt = $pdo->prepare('INSERT INTO Institution (name) VALUES ( :name)');

                        $stmt->execute(array(
                            ':name' => $edu_school,
                        ));
                        $institution_id = $pdo->lastInsertId();
                    }

                    $stmt = $pdo->prepare('INSERT INTO Education
            (profile_id, institution_id, year, rank)
            VALUES ( :pid, :institution, :edu_year, :rank)');


                    $stmt->execute(array(
                            ':pid' => $profile_id,
                            ':institution' => $institution_id,
                            ':edu_year' => $edu_year,
                            ':rank' => $rank)
                    );

                    $rank++;

                }

                $_SESSION['success'] = "Record added";
                header('Location: index.php');
                return;
            }
            header('Location: add.php');
            return;
        }
    } else {
        die("ACCESS DENIED");
    }
?-->

    <body>
    <div class="container">
        <?php #flash(); ?>

        <form method="post">
            <p>Headline:<br/><input type="text" name="headline" size="80"/></p>
            <p>Headline:<br/><input type="text" name="headline" size="80"/></p>
            <p>Headline:<br/><input type="text" name="headline" size="80"/></p>
            <p>Headline:<br/><input type="text" name="headline" size="80"/></p>
            <p>Headline:<br/><input type="text" name="headline" size="80"/></p>
            <p>Headline:<br/><input type="text" name="headline" size="80"/></p>
            <p>Headline:<br/><input type="text" name="headline" size="80"/></p>
            <p>Headline:<br/><input type="text" name="headline" size="80"/></p>
            <p>Headline:<br/><input type="text" name="headline" size="80"/></p>
            <p>Summary:<br/><textarea name="summary" rows="8" cols="82"></textarea>
            <p><input type="submit" value="Add"><input type="submit" name="cancel" value="Cancel"></p>
        </form>
    </div>
    </body>
</html>
