<?php
    session_start();
    setcookie('loginID', "", time()-(60*60*7));
    setcookie('password', "", time()-(60*60*7));
    session_unset();
    session_destroy();
    header("location: ../Landing.php");
?>