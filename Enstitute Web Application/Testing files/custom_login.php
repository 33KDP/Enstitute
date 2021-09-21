<?php 
    include_once 'header.php';
?>

    <section class="signup-form">
        <h2>Log in</h2>
        <div class="signup-form-form">
        <!--
            .inc.php or -inc.php  user cant see in the page but only.php files user can see
        -->
        <form action="includes/login.inc.php" method="post">  
            <input type="text" name="uid" placeholder="Username/Email...">
            <input type="password" name="pwd" placeholder="password...">
            <button type="submit" name="submit">Log In</button>
        </form>
        </div>
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
    </section>

<?php 
    include_once 'footer.php';
?>    

