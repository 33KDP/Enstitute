<?php 
    include_once 'header.php';
?>

    <section class="signup-form">
        <h2>Sign Up</h2>
        <div class="signup-form-form">
        <!--
            .inc.php or -inc.php  user cant see in the page but only.php files user can see
        -->

        <form action="includes/signup.inc.php" method="post">  
            <input type="text" name="name" placeholder="Full name...">
            <input type="text" name="email" placeholder="email...">
            <input type="text" name="uid" placeholder="username...">
            <input type="password" name="pwd" placeholder="password...">
            <input type="password" name="pwdrepeat" placeholder="repeat password...">
            <button type="submit" name="submit">Sign up</button>
        </form>
        </div>
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
    </section>

<?php 
    include_once 'footer.php';
?>    
