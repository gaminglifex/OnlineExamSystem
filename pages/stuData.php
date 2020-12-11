<?php
    include_once('..\Authentication\db_connect.php');
    
    //Database Connection
    $connect = mysqli_connect($server, $user, $pw, $db);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST['insertdata']))
    {
        $loginID = $_POST['loginID'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $Birthday = $_POST['BOD'];

        $query = "INSERT INTO stu_info (userid, username, email, user_pw, sex, BOD) VALUES ('$loginID','$username','$email','$password','$gender','$Birthday')";

        if($connect->query($query))
        {
            echo '<script> alert("Data Saved"); </script>';
            header('Location: admin.php?page=Database');
        }
        else
        {
            echo '<script> alert("Data Not Saved"); </script>';
            header('Location: admin.php?page=Database');
        }
    }

    if(isset($_POST['updatedata']))
    {   
        $loginID = trim($_POST['loginID']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $gender = trim($_POST['sex']);
        $Birthday = trim($_POST['BOD']);
        $profileImg = trim($_POST['profileImg']);

        $query = "UPDATE stu_info SET 
            username ='".$username."', 
            email = '".$email."', 
            user_pw = '".$password."', 
            sex = '".$gender."', 
            BOD = '".$Birthday."', 
            profileImg = '".$profileImg."' 
            WHERE userid = '".$loginID."'";

        if($connect->query($query) == TRUE)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location: admin.php?page=Database");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
            header("Location: admin.php?page=Database");
        }
    }

    if(isset($_POST['deletedata']))
    {
    $id = $_POST['delete_id'];
    $loginID = trim($id);
    $query = "DELETE FROM stu_info WHERE userid= '".$loginID."'";
    $result = $connect->query($query);

    if($result)
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("location: admin.php?page=Database");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
    }
?>