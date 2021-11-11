<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-nstitute</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Demo CSS -->
    <link rel="stylesheet" href="css/demo.css">
</head>

<body>
<header class="intro">
    <div class="header">
        <a href="index.php"><img src="img/logo.png" alt="E-nstitute logo"></a>
        <ul class="list-group">
            <li class="list-group-item"><a href="index.php">Home</a></li>
            <li class="list-group-item"><a href="discover.php">About Us</a></li>
            <li class="list-group-item"><a href="blog.php">Find Tutor</a></li>
            <?php
            if(isset($_SESSION["useruid"])){
                echo "<li class='list-group-item'><a href='profile.php'>profile page</a></li>";
                echo "<li class='list-group-item'><a href='includes/logout.inc.php'>Log out</a></li>";
            }else{
                echo "<li class='list-group-item'><a href='login.php'>Log in</a></li>";
                echo "<li class='list-group-item'><a href='signup.php'>Sign up</a></li>";
            }
            ?>
        </ul>
    </div>
</header>

