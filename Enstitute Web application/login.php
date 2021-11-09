<?php 
    include_once 'header.php';
?>

    <section class="signup-form">
        <h2>Log in</h2>
        <div class="signup-form-form">
        <!--
            .inc.php or -inc.php  user cant see in the page but only.php files user can see
        -->
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
    </section>

<?php 
    include_once 'footer.php';
?>    

