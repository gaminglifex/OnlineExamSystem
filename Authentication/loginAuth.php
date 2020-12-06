<?php
<<<<<<< HEAD
    session_start();
    include_once 'db_connect.php';
    include_once 'function.php';
=======
    include 'config.php';
>>>>>>> 93b25df2c9a812de6e69b66258a489e2af34e3e6
    $emailErr = "";
    $passwordErr = "";
    $connect = mysqli_connect($server, $user, $pw, $db);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

<<<<<<< HEAD
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
=======
    if (isset($_POST["submit"])) {
        $email = validateInput($_POST['inputLoginEmail']);
        $password = validateInput($_POST['inputLoginPassword']);
        $userEmail = "SELECT Email FROM stu_info WHERE Email = '".$email."'";
        $result = $connect->query($userEmail);
        if($result->num_rows > 0) {
            while($rows = $result->fetch_assoc()){
                echo "Welcome bois";
            }
        } else {
            $emailErr = "<div class='alert alert-danger' role='alert'>The Email does not exist</div>";
        }
    }
    
    function validateInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

?>
>>>>>>> 93b25df2c9a812de6e69b66258a489e2af34e3e6
