<?php
    session_start();
    setcookie('loginID', "", time()-86400);
    setcookie('password', "", time()-86400);
    session_unset();
    session_destroy();
    header("location: ../Landing.php");
?>