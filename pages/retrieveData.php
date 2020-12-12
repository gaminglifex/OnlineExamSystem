<?php
    include_once('..\Authentication\db_connect.php');
    
    //Database Connection
    $connect = mysqli_connect($server, $user, $pw, $db);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //Student Data
    if(isset($_POST['insertStudata']))
    {
        $loginID = $_POST['loginID'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $Birthday = $_POST['BOD'];
        $role = "student";

        $query = "INSERT INTO stu_info (userid, username, email, user_pw, sex, BOD) VALUES ('$loginID','$username','$email','$password','$gender','$Birthday')";
        $query2 = "INSERT INTO user_type (userid, user_role) VALUES ('$loginID', '$role')";
        if($connect->query($query) && $connect->query($query2))
        {
            echo '<script> alert("Data Saved"); </script>';
            header('Location: admin.php?page=stuDatabase');
        }
        else
        {
            echo '<script> alert("Data Not Saved"); </script>';
            header('Location: admin.php?page=stuDatabase');
        }
    }

    if(isset($_POST['updateStudata']))
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
            header("Location: admin.php?page=stuDatabase");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
            header("Location: admin.php?page=stuDatabase");
        }
    }

    if(isset($_POST['deleteStudata']))
    {
    $id = $_POST['delete_id'];
    $loginID = trim($id);
    $query = "DELETE FROM stu_info WHERE userid= '".$loginID."'";
    $query2 = "DELETE FROM user_type WHERE userid= '".$loginID."'";

    if($connect->query($query) && $connect->query($query2))
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("location: admin.php?page=stuDatabase");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
    }
    //Staff data
    if(isset($_POST['insertStaffdata']))
    {
        $loginID = $_POST['loginID'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $courses = $_POST['courses'];
        $role = "staff";

        $query = "INSERT INTO staff_info (userid, username, email, user_pw, courses) VALUES ('$loginID','$username','$email','$password','$courses')";
        $query2 = "INSERT INTO user_type (userid, user_role) VALUES ('$loginID', '$role')";
        if($connect->query($query) && $connect->query($query2))
        {
            echo '<script> alert("Data Saved"); </script>';
            header('Location: admin.php?page=staffDatabase');
        }
        else
        {
            echo '<script> alert("Data Not Saved"); </script>';
            header('Location: admin.php?page=staffDatabase');
        }
    }

    if(isset($_POST['updateStaffdata']))
    {   
        $loginID = trim($_POST['loginID']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $courses = trim($_POST['course']);
        $profileImg = trim($_POST['profileImg']);

        $query = "UPDATE staff_info SET 
            username ='".$username."', 
            email = '".$email."', 
            user_pw = '".$password."', 
            courses = '".$courses."', 
            profileimg = '".$profileImg."' 
            WHERE userid = '".$loginID."'";

        if($connect->query($query) == TRUE)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location: admin.php?page=staffDatabase");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
            header("Location: admin.php?page=staffDatabase");
        }
    }

    if(isset($_POST['deleteStaffdata']))
    {
    $id = $_POST['delete_id'];
    $loginID = trim($id);
    $query = "DELETE FROM staff_info WHERE userid= '".$loginID."'";
    $query2 = "DELETE FROM user_type WHERE userid= '".$loginID."'";

    if($connect->query($query) && $connect->query($query2))
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("location: admin.php?page=staffDatabase");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
    }
?>