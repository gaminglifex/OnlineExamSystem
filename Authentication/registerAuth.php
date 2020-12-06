<?php
    $loginIdErr = $usernameErr = $emailRegErr = $passwordRegErr = $dateErr = $courseErr = $RadioErr = "";
    include_once 'db_connect.php';
    include_once 'function.php';
    $connect = mysqli_connect($server, $user, $pw, $db);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST["register"])) {
        $loginID = validateInput($_POST['loginID']);
        $username = validateInput($_POST['nickname']);
        $email = validateInput($_POST['registerEmail']);
        $password = validateInput($_POST['registerPassword']);
        $identity = $_POST['identity'];
        $courseInfo = $gender = $BOD = $profileimageExtension = $profileimageName = $profileimagePath = $profileimageTarget = "";
        $e = $_FILES['profileimg']['error'];
        
        // Check User Register Role
        if($identity == 'student'){
            //Data Handling
            $gender = $_POST['Gender'];
            $day = $_POST['dd'];
            $month = $_POST['mm'];
            $year = $_POST['yyyy'];
            $date = "$day" . "/" . "$month" . "/" . "$year";
            $BOD = date('d/m/Y', strtotime($date));
            ProImage($e, $loginID);
            //Query
            $queryInsertStudent = "INSERT INTO stu_info (stuid, username, email, user_pw, sex, BOD, profileimg)
                VALUES ('$loginID', '$username', '$email', '$password', '$gender', '$BOD', '$profileimageName')";
            if($connect->query($queryInsertStudent) == TRUE){
                header('location: ../pages/index.php');
            } else {
                echo $connect->error;
            }
        }
        if ($identity == 'staff'){
            //Data Handling
            $course = $_POST['courseInfo'];
            $courseInfo = trim($course);
            ProImage($e, $loginID);
            //Query
            $queryInsertStaff = "INSERT INTO staff_info (staffid, username, email, user_pw, courses, profileimg)
                VALUES ('$loginID', '$username', '$email', '$password', '$courseInfo', '$profileimageName')";
            if($connect->query($queryInsertStaff) == TRUE){
                header('location: pages/index.php');
            } else {
                echo $connect->error;
            }
        }

        //Validate loginID
        if(empty($loginID)){
            $loginIdErr = "<div class='alert alert-warning' role='alert'><strong>The loginID cannot be Empty</strong></div>";
        }
        else if(strlen($loginID) > 9) {
            $loginIdErr = "<div class='alert alert-warning' role='alert'><strong>The length of loginID is too long</strong></div>";
        }

        //Validate Username
        if(empty($username)){
            $usernameErr = "<div class='alert alert-warning' role='alert'><strong>The Nickname cannot be Empty</strong></div>";
        } 
        else if(!preg_match("/^[a-zA-Z ]*$/", $username)) {
            $usernameErr = "<div class='alert alert-warning' role='alert'><strong>Only letters and white space allowed.</strong></div>";
        }

        //Validate Email
        if(empty($email)){
            $emailRegErr = "<div class='alert alert-warning' role='alert'><strong>The Email cannot be Empty</strong></div>";
        } 
        else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
            $emailRegErr = "<div class='alert alert-warning' role='alert'><strong>The Email format is invalid</strong></div>";
        }

        //Validate Password
        if(empty($password)){
            $passwordRegErr = "<div class='alert alert-warning' role='alert'><strong>The Password cannot be Empty</strong></div>";
        } 
        else if(strlen($password) < 8) {
            $passwordRegErr = "<div class='alert alert-warning' role='alert'><strong>The length of Password is too short</strong></div>";
        }

        //$result = $connect->query($userQuery);
        // if($result->num_rows > 0) {
        //     while($rows = $result->fetch_assoc()){
        //         if($rows['user_pw'] == $password){
        //             $_SESSION['email'] = $email;
        //             header("location: pages/index.php");
        //             die();
        //         } else {
        //             $passwordErr = "<div class='alert alert-warning' role='alert'><strong>The Password does not match</strong></div>";
        //         }
        //     }
        // } else {
        //     $emailErr = "<div class='alert alert-warning' role='alert'><strong>The Email does not exist</strong></div>";
        // }
    }

?>
