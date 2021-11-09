<?php 
    include_once 'header.php' ;
?>


    <section class="index-categories">

        <?php
            if(isset($_SESSION["useruid"])){
                echo "<h3>Hello there ".$_SESSION["username"]."</h3>";
            }
        ?>

        <h1>Information Management Systems during the Pandemic and Beyond</h1>
        <p>“E-nstitute” is an online platform which will help students to find the best suited private tutors across the island. 
                    Teachers and students can register in E-nstitute and students will be able to search teachers based on the subject, teaching platforms(online/physical) and other criteria. 
                    Students can find a tutors using E-nstitute based on their locations. Students can rate and review teachers by their performance. 
        </p>

    </section>

        <section class="index-categories">
            <h2>Somebich categories</h2>
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

