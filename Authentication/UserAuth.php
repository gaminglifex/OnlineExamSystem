<?php
    include_once 'db_connect.php';
    include_once 'function.php';
    session_start();

    //Login Error Message
    $LoginIdErr = $passwordErr = "";

    //Register Error Message
    $loginIdErr = $usernameErr = $emailRegErr = $passwordRegErr = $rePasswordErr = $dateErr = $courseErr = $RadioErr = "";
    $registerStatus = "";
    $flag = 0;
    $dir = $_SERVER['DOCUMENT_ROOT'];

    //Register Error Message
    $loginIdErr = $emailReErr = $passwordResetErr = $resetPasswordErr = $resultMessage = "";
    $flag = 0;

    //Database Connection
    $connect = mysqli_connect($server, $user, $pw, $db);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //Login Status
     if(isset($_SESSION['loginId'])){
         header("location: ./pages/index.php");
     }

    //Login Auth
    if (isset($_POST["login"])) {
        $loginId = validateInput(strtoupper($_POST['inputLoginID']));
        $password = validateInput($_POST['inputLoginPassword']);
        $username = "";
        $user_role = "";
        $userQuery = "SELECT stu_info.userid, stu_info.user_pw, username, user_role FROM stu_info INNER JOIN user_type
        on stu_info.userid = user_type.userid WHERE stu_info.userid = '".$loginId."'";
        $userQuery2 = "SELECT staff_info.userid, user_pw, username, user_role FROM staff_info INNER JOIN user_type
        on staff_info.userid = user_type.userid WHERE staff_info.userid = '".$loginId."'";
        $result = $connect->query($userQuery);
        $result2 = $connect->query($userQuery2);
        if($result->num_rows > 0) {
            while($rows = $result->fetch_assoc()){
                if($rows['user_pw'] == $password){
                    if(!empty($_POST['remember'])){
                        setcookie('loginID', "$loginId", time()+60*60*7); // Cookies Valid for 7 days
                        setcookie('password', "$password", time()+60*60*7); // Cookies Valid for 7 hrs
                    } else {
                        if(isset($_COOKIE['loginID']) || isset($_COOKIE['password'])){
                            setcookie('loginID', "");
                            setcookie('password', "");
                        }
                    }
                    $_SESSION['loginId'] = $rows['userid'];
                    $_SESSION['username'] = $rows['username'];
                    $_SESSION['user_role'] = $rows['user_role'];
                    header("location: ./pages/index.php");
                    die();
                } else {
                    $passwordErr = "<div class='alert alert-warning' role='alert'><strong>The Password does not match</strong></div>";
                }
            }
        } elseif($result2->num_rows > 0){
            while($rows = $result2->fetch_assoc()){
                if($rows['user_pw'] == $password){
                    if(!empty($_POST['remember'])){
                        setcookie('loginID', "$loginId", time()+60*60*7); // Cookies Valid for 7 days
                        setcookie('password', "$password", time()+60*60*7); // Cookies Valid for 7 hrs
                    } else {
                        if(isset($_COOKIE['loginID']) || isset($_COOKIE['password'])){
                            setcookie('loginID', "");
                            setcookie('password', "");
                        }
                    }
                    $_SESSION['loginId'] = $rows['userid'];
                    $_SESSION['username'] = $rows['username'];
                    $_SESSION['user_role'] = $rows['user_role'];
                    header("location: ./pages/index.php");
                    die();
                } else {
                    $passwordErr = "<div class='alert alert-warning' role='alert'><strong>The Passwords does not match</strong></div>";
                }
            }
        } else{
            $LoginIdErr = "<div class='alert alert-warning' role='alert'><strong>The LoginID does not exist</strong></div>";
        }
        $connect->close();
    }

    //PhotoUpload **Do not Use**
    // if(isset($_FILES['file'])){
    //     if($_FILES["file"]["error"] != "4"){
    //         global $profileimageExtension, $profileimageName, $profileimagePath, $profileimageTarget;
    //         $loginID = validateInput(strtoupper($_POST['loginID']));
    //         $imageArray = explode('.', $_FILES['file']['name']);
    //         $profileimageExtension = end($imageArray);
    //         $profileimageName = "{$loginID}.{$profileimageExtension}";
    //         $profileimagePath = $_FILES['file']['tmp_name'];
    //         $profileimageTarget = "../profileimage/$profileimageName";
    //         move_uploaded_file($profileimagePath, $profileimageTarget);
    //         // ImageRename($JJ, $profileimageTarget, $profileimageExtension);
    //     } else {
    //         $profileimageName = NULL;
    //     }  
    // }

    //Resgister Auth
    if (isset($_POST["register"])) {
        $loginID = validateInput(strtoupper($_POST['loginID']));
        $username = validateInput($_POST['nickname']);
        $email = validateInput($_POST['registerEmail']);
        $password = validateInput($_POST['registerPassword']);
        $Repassword = validateInput($_POST['inputRePassword']);
        $identity = $_POST['identity'];
        $courseInfo = $gender = $BOD = "";
        $profileimageExtension = $profileimageName = $profileimagePath = $profileimageTarget = "";

        // $e = $_FILES["profileimg"];
        // print_r($e);

        //Validate loginID
        if(empty($loginID)){
            $loginIdErr = "<div class='alert alert-warning' role='alert'><strong>The loginID cannot be Empty</strong></div>";
            $flag = 1;
        }
        else if(strlen($loginID) > 9) {
            $loginIdErr = "<div class='alert alert-warning' role='alert'><strong>The length of loginID is too long</strong></div>";
            $flag = 1;
        }

        //Validate Username
        if(empty($username)){
            $usernameErr = "<div class='alert alert-warning' role='alert'><strong>The Nickname cannot be Empty</strong></div>";
            $flag = 1;
        } 
        else if(!preg_match("/^[a-zA-Z ]*$/", $username)) {
            $usernameErr = "<div class='alert alert-warning' role='alert'><strong>Only letters and white space allowed.</strong></div>";
            $flag = 1;
        }

        //Validate Email
        if(empty($email)){
            $emailRegErr = "<div class='alert alert-warning' role='alert'><strong>The Email cannot be Empty</strong></div>";
            $flag = 1;
        } 
        else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
            $emailRegErr = "<div class='alert alert-warning' role='alert'><strong>The Email format is invalid</strong></div>";
            $flag = 1;
        }

        //Validate Password
        if(empty($password)){
            $passwordRegErr = "<div class='alert alert-warning' role='alert'><strong>The Password cannot be Empty</strong></div>";
            $flag = 1;
        } 
        else if(strlen($password) < 8) {
            $passwordRegErr = "<div class='alert alert-warning' role='alert'><strong>The length of Password is too short</strong></div>";
            $flag = 1;
        }

        //Validate Password
        if(empty($Repassword)){
            $rePasswordErr = "<div class='alert alert-warning' role='alert'><strong>The re-Password cannot be Empty</strong></div>";
            $flag = 1;
        } 
        else if($Repassword != $password) {
            $rePasswordErr = "<div class='alert alert-warning' role='alert'><strong>The Password does not match</strong></div>";
            $flag = 1;
        }

        //Insert record
        if($flag == 0) {
            if($identity == 'student'){
                //Data Handling
                $gender = $_POST['Gender'];
                $day = $_POST['dd'];
                $month = $_POST['mm'];
                $year = $_POST['yyyy'];
                $date = "$day" . "/" . "$month" . "/" . "$year";
                $BOD = date('d/m/Y', strtotime($date));
                if($_FILES["profileimg"]["error"] != "4"){
                    global $profileimageExtension, $profileimageName, $profileimagePath, $profileimageTarget;
                    $loginID = validateInput(strtoupper($_POST['loginID']));
                    $imageArray = explode('.', $_FILES['profileimg']['name']);
                    $profileimageExtension = end($imageArray);
                    $profileimageName = "{$loginID}.{$profileimageExtension}";
                    $profileimagePath = $_FILES['profileimg']['tmp_name'];
                    $profileimageTarget = "$dir/Exam/profileimage/$profileimageName";
                    move_uploaded_file($profileimagePath, $profileimageTarget);
                } else {
                    $profileimageName = NULL;
                }       
                //Query
                $queryInsertStudent = "INSERT INTO stu_info (userid, username, email, user_pw, sex, BOD, profileimg)
                    VALUES ('$loginID', '$username', '$email', '$password', '$gender', '$BOD', '$profileimageName')";
                $queryInsertRole = "INSERT INTO user_type (userid, user_role) VALUES ('$loginID', '$identity')";
                if($connect->query($queryInsertStudent) == TRUE && $connect->query($queryInsertRole) == TRUE){
                    // header('location: ./pages/index.php');
                    $registerStatus = "<div class='alert alert-warning' role='alert'><strong>Successfully Registered! Please Login</strong></div>";
                } else {
                    echo $connect->error;
                }
            }
            if ($identity == 'staff'){
                //Data Handling
                $course = $_POST['courseInfo'];
                $courseInfo = trim($course);
                // $name = $loginID . "." . "$profileimageExtension";
                // ProImage($loginID);
                if($_FILES["profileimg"]["error"] != "4"){
                    global $profileimageExtension, $profileimageName, $profileimagePath, $profileimageTarget;
                    $loginID = validateInput(strtoupper($_POST['loginID']));
                    $imageArray = explode('.', $_FILES['profileimg']['name']);
                    $profileimageExtension = end($imageArray);
                    $profileimageName = "{$loginID}.{$profileimageExtension}";
                    $profileimagePath = $_FILES['profileimg']['tmp_name'];
                    $profileimageTarget = "$dir/Exam/profileimage/$profileimageName";
                    move_uploaded_file($profileimagePath, $profileimageTarget);
                } else {
                    $profileimageName = NULL;
                }             
                //Query
                $queryInsertStaff = "INSERT INTO staff_info (userid, username, email, user_pw, courses, profileimg)
                    VALUES ('$loginID', '$username', '$email', '$password', '$courseInfo', '$profileimageName')";
                $queryInsertRole = "INSERT INTO user_type (userid, user_role) VALUES ('$loginID', '$identity')";
                if($connect->query($queryInsertStaff) == TRUE && $connect->query($queryInsertRole) == TRUE){
                    // header('location: ./pages/index.php');
                    $registerStatus = "<div class='alert alert-warning' role='alert'><strong>Successfully Registered! Please Login</strong></div>";
                } else {
                    echo $connect->error;
                }
            }
        }
        $connect->close();
    }

    //Reset Auth
    if (isset($_POST["reset"])) {
        $loginId = validateInput(strtoupper($_POST['inputLoginID']));
        $email = validateInput($_POST['inputEmail']);
        $password = validateInput($_POST['inputPassword']);
        $rePassword = validateInput($_POST['inputRePassword']);
        $userQuery = "SELECT userid, email FROM stu_info WHERE userid = '".$loginId."'";
        $userQuery2 = "SELECT userid, user_pw FROM staff_info WHERE userid = '".$loginId."'";
        $insertQuery = "UPDATE stu_info SET user_pw = '".$password."' WHERE userid = '".$loginId."'";
        $insertQuery2 = "UPDATE staff_info SET user_pw = '".$password."' WHERE userid = '".$loginId."'";
        $result = $connect->query($userQuery);
        $result2 = $connect->query($userQuery2);
        if($result->num_rows > 0) {
            while($rows = $result->fetch_assoc()){
                if($email == $rows['email']){
                    if($connect->query($insertQuery)){
                        $resultMessage = "<div class='alert alert-warning' role='alert'><strong>Password is sucessfully changed</strong></div>";
                    }
                    // header("location: ../pages/index.php");
                } else {
                    $emailReErr = "<div class='alert alert-warning' role='alert'><strong>The Email does not exist</strong></div>";
                }
            }
        } elseif($result2->num_rows > 0){
            while($rows = $result2->fetch_assoc()){
                if($email == $rows['email']){
                    if($connect->query($insertQuery2)){
                        $resultMessage = "<div class='alert alert-warning' role='alert'><strong>Password is sucessfully changed</strong></div>";
                    }
                } else {
                    $emailReErr = "<div class='alert alert-warning' role='alert'><strong>The Email does not match</strong></div>";
                }
            }
        } else{
            $loginIdErr = "<div class='alert alert-warning' role='alert'><strong>The LoginID does not exist</strong></div>";
        $connect->close();
        }
    }

    //Logout
    if(isset($_POST['logout'])){
        setcookie('loginId', "", time() - 3600*7);
        setcookie('password', "", time() - 3600*7);
        session_destroy();
        header("location: ../Landing.php");
    }
?>