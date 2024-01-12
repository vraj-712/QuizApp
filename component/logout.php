<?php
    session_start();
    session_destroy();
    header("Location:/quizapp/index.php",true);
?>