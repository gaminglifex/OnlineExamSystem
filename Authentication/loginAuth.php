<?php
    include_once 'db_connect.php';
    include_once 'function.php';
    $LoginIdErr = "";
    $passwordErr = "";
    $connect = mysqli_connect($server, $user, $pw, $db);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST["login"])) {
        $userID = validateInput(strtoupper($_POST['inputLoginID']));
        $password = validateInput($_POST['inputLoginPassword']);
        $userQuery = "SELECT userid, user_pw FROM stu_info WHERE userid = '".$userID."'";
        $result = $connect->query($userQuery);
        if($result->num_rows > 0) {
            while($rows = $result->fetch_assoc()){
                if($rows['user_pw'] == $password){
                    $_SESSION['inputLoginID'] = $userID;
                    header("location: http://localhost/Project/pages/index.php");
                    die();
                } else {
                    $passwordErr = "<div class='alert alert-warning' role='alert'><strong>The Password does not match</strong></div>";
                }
            }
        } else {
            $LoginIdErr = "<div class='alert alert-warning' role='alert'><strong>The LoginID does not exist</strong></div>";
        }
        $connect->close();
    }
    
?>
