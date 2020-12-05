<?php
    include 'config.php';
    $emailErr = "";
    $passwordErr = "";
    $connect = mysqli_connect($server, $user, $pw, $db);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

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