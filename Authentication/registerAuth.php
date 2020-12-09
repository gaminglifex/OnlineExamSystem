<?php
    $name = $loginIdErr = $usernameErr = $emailRegErr = $passwordRegErr = $rePasswordErr = $dateErr = $courseErr = $RadioErr = "";
    include_once 'db_connect.php';
    include_once 'function.php';
    include_once 'photoUpload.php';

    $flag = 0;
    $connect = mysqli_connect($server, $user, $pw, $db);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $dir = $_SERVER['DOCUMENT_ROOT'];
    
    //PhotoUpload
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

    if (isset($_POST["register"])) {
        $loginID = validateInput(strtoupper($_POST['loginID']));
        $username = validateInput($_POST['nickname']);
        $email = validateInput($_POST['registerEmail']);
        $password = validateInput($_POST['registerPassword']);
        $Repassword = validateInput($_POST['inputRePassword']);
        $identity = $_POST['identity'];
        $courseInfo = $gender = $BOD = "";
        $profileimageExtension = $profileimageName = $profileimagePath = $profileimageTarget = "";

        $e = $_FILES["profileimg"];
        print_r($e);

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
                if($connect->query($queryInsertStaff) == TRUE){
                    // header('location: ../pages/index.php');
                } else {
                    echo $connect->error;
                }
            }
        }
        $connect->close();
    }
?>
