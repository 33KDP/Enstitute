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
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="discover.php">About Us</a></li>
                <li><a href="blog.php">Find Tutor</a></li>
                <?php
                    if(isset($_SESSION["useruid"])){
                        echo "<li><a href='profile.php'>profile page</a></li>";
                        echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                    }else{
                        echo "<div class='container'>";
                        echo "<button type='button' class='btn btn-info btn-round' data-toggle='modal' data-target='#loginModal'>Log in</button>";
                        echo "<button type='button' class='btn btn-info btn-round' data-toggle='modal' data-target='#sigupModal'>Sign up</button>";   
                        echo "</div>";
                    }
                ?>
            </ul>
        </div>
        </header>

        <div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-title text-center">
                <h4>Login</h4>
                </div>
                <div class="d-flex flex-column text-center">
                <form action="includes/login.inc.php" method="post">
                    <div class="form-group">
                    <input type="text" class="form-control" id="email1" name="uid" placeholder="Username/Email...">
                    </div>
                    <div class="form-group">
                    <input type="password" class="form-control" id="password1" name="pwd" placeholder="password...">
                    </div>
                    <button type="submit" name="submit" class="btn btn-info btn-block btn-round">Login</button>
                </form>
                
                <div class="text-center text-muted delimiter">
                    <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"]=="emptyinput"){
                            echo "<p>Fill in all fields!</p>" ;
                        }
                        else if($_GET["error"]=="notexists"){
                            echo "<p>You are not signup</p>" ;
                        }
                        else if($_GET["error"]=="incorrectpw"){
                            echo "<p>Password is incorrect!</p>" ;
                        }
                    }
                    ?>
                </div>
                
                </div>
            </div>
            
            <div class="modal-footer d-flex justify-content-center">
                <div class="signup-section">Not a member yet? <a href="#a" class="text-info"> Sign Up</a>.</div>
            </div>
            </div>
        </div>
        </div>


        <div class="modal fade" id="sigupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-title text-center">
                <h4>Login</h4>
                </div>
                <div class="d-flex flex-column text-center">
                <form action="includes/signup.inc.php" method="post">
                    <div class="form-group">
                    <input type="text" class="form-control" id="email1" name="name" placeholder="Full name...">
                    </div>
                    <div class="form-group">
                    <input type="email" class="form-control" id="email1" name="email" placeholder="email...">
                    </div>
                    <div class="form-group">
                    <input type="text" class="form-control" id="email1" name="uid" placeholder="username...">
                    </div>
                    <div class="form-group">
                    <input type="password" class="form-control" id="password1" name="pwd" placeholder="password...">
                    </div>
                    <div class="form-group">
                    <input type="password" class="form-control" id="password1" name="pwdrepeat" placeholder="repeat password...">
                    </div>
                    <button type="submit" name="submit" class="btn btn-info btn-block btn-round">sigup</button>
                </form>
                
                <div class="text-center text-muted delimiter">
                <?php
                if(isset($_GET["error"])){
                    if($_GET["error"]=="emptyinput"){
                        echo "<p>Fill in all fields!</p>" ;
                    }
                    else if($_GET["error"]=="invaliduid"){
                        echo "<p>Choose a proper username!</p>" ;
                    }
                    else if($_GET["error"]=="invalidemail"){
                        echo "<p>Choose a proper email!</p>" ;
                    }
                    else if($_GET["error"]=="passwordsdontmatch"){
                        echo "<p>Passwords don't match!</p>" ;
                    }
                    else if($_GET["error"]=="usernametaken"){
                        echo "<p>Your username is already taken!</p>" ;
                    }   
                    else if($_GET["error"]=="stmtfailed"){
                        echo "<p>Something went wrong, try again!</p>" ;
                    }    
                    else if($_GET["error"]=="none"){
                        echo "<p>You have signed up!</p>" ;
                    }                                   
                }
                ?>
                </div>

                </div>
            </div>
            </div>
        </div>
        </div>