<?php
    session_start();
    //include_once('..\Authentication\UserAuth.php');
    if($_SESSION['user_role'] == "staff"){
        echo "Hahahaha" . $_SESSION['username'];
    } 
    if($_SESSION['user_role'] == "student"){
        echo "Hahahaha" . $_SESSION['username'];
    } 
    if($_SESSION['user_role'] == "admin"){
        header("location: ./admin.php");
        echo "Hahahaha" . " " . $_SESSION['username'];
    }
?>