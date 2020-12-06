<?php 
    session_start();
    if($_SESSION['email']){
        echo "Hahahaha" . $_SESSION['email'];
    } else{
        header('location: ../Landing.php');
    }
?>