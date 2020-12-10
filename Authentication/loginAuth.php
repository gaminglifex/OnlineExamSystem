<?php
    include_once 'db_connect.php';
    include_once 'function.php';
    $LoginIdErr = "";
    $passwordErr = "";

    //Database Connection
    $connect = mysqli_connect($server, $user, $pw, $db);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
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
                    $_SESSION['loginId'] = $rows['userid'];
                    $_SESSION['username'] = $rows['username'];
                    $_SESSION['user_role'] = $rows['user_role'];
                    echo $_SESSION['loginId'] . $_SESSION['username'] . $_SESSION['user_role'];
                    header("location: ../pages/index.php");
                    die();
                } else {
                    $passwordErr = "<div class='alert alert-warning' role='alert'><strong>The Password does not match</strong></div>";
                }
            }
        } elseif($result2->num_rows > 0){
            while($rows = $result2->fetch_assoc()){
                if($rows['user_pw'] == $password){
                    $_SESSION['loginId'] = $rows['userid'];
                    $_SESSION['username'] = $rows['username'];
                    $_SESSION['user_role'] = $rows['user_role'];
                    echo $_SESSION['loginId'] . $_SESSION['username'] . $_SESSION['user_role']; 
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
?>