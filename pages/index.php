<?php
    session_start();
    //include_once('..\Authentication\UserAuth.php');
    if($_SESSION['user_role'] == "staff"){
        header("location: ./staff.php");
    } elseif($_SESSION['user_role'] == "student"){
        header("location: ./student.php");
    } elseif($_SESSION['user_role'] == "admin"){
        header("location: ./admin.php");
    } else{
        header("location: ../Landing.php");
    }
?>