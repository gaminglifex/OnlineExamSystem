<?php
    session_start();
    include_once 'db_connect.php';
    include_once 'function.php';
    $emailErr = "";
    $passwordErr = "";
    $connect = mysqli_connect($server, $user, $pw, $db);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST["login"])) {
        $email = validateInput($_POST['inputLoginEmail']);
        $password = validateInput($_POST['inputLoginPassword']);
        $userQuery = "SELECT email, user_pw FROM stu_info WHERE email = '".$email."'";
        $result = $connect->query($userQuery);
        if($result->num_rows > 0) {
            while($rows = $result->fetch_assoc()){
                if($rows['user_pw'] == $password){
                    $_SESSION['email'] = $email;
                    header("location: http://localhost/Project/pages/index.php");
                    die();
                } else {
                    $passwordErr = "<div class='alert alert-warning' role='alert'><strong>The Password does not match</strong></div>";
                }
            }
        } else {
            $emailErr = "<div class='alert alert-warning' role='alert'><strong>The Email does not exist</strong></div>";
        }
        $connect->close();
    }
    
?>
