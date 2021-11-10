<?php 
    include_once 'header.php' ;
?>


    <section class="index-categories">

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
                else if($_GET["error"]=="database_connect_error"){
                    echo "<p>database is not connnected !</p>" ;
                }
            }
            ?>
        </div>

        <?php
            if(isset($_SESSION["utype"])){
                echo "<h3>Hello  ".$_SESSION["fname"]." Have a nice day</h3>";
                if($_SESSION["utype"]=="1"){
                    echo "<h3>As a STUDENT, you can find the best matching tutor for you</h3>";
                }else{
                    echo "<h3>As a TUTOR, you will be requested by many students</h3>";
                }
                
            }
        ?>

        <h1>Information Management Systems during the Pandemic and Beyond</h1>
        <p>“E-nstitute” is an online platform which will help students to find the best suited private tutors across the island. 
                    Teachers and students can register in E-nstitute and students will be able to search teachers based on the subject, teaching platforms(online/physical) and other criteria. 
                    Students can find a tutors using E-nstitute based on their locations. Students can rate and review teachers by their performance. 
        </p>

    </section>

        <section class="index-categories">
            <h2>This is Sri Lanka categories</h2>
            <div class="index-categories-list">
                <div>
                    <h3>Timeslots</h3>   
                </div>
                <div>
                    <h3>Timeslots</h3>   
                </div>
                <div>
                     <h3>Timeslots</h3>   
                </div>
                </div>
            </section>

<?php 
    include_once 'footer.php';
?>    

