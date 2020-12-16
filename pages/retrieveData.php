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
    //UpdateStaffdata
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
    //deleteStaffdata
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

    //Insert Exam data
    if(isset($_POST['insertExamdata']))
    {
        $examid = uniqid("exam_");
        $title = $_POST['examTitle'];
        $addMark = $_POST['addMark'];
        $deductMark = $_POST['deductMark'];
        $noOfQuestion = $_POST['noOfQuestion'];
        $scheduledTime = $_POST['scheduledTime'];
        $examDuration = $_POST['examDuration'];
        $creationTime = date("d/m/Y H:i:s", time());
        $query = "INSERT INTO exam_info (eid, title, correct_mark, incorrect_mark, no_question, scheduled_time, duration, creation_time) 
            VALUES ('$examid','$title','$addMark','$deductMark','$noOfQuestion','$scheduledTime','$examDuration','$creationTime')";
        if($connect->query($query))
        {
            echo '<script> alert("Data Inserted"); </script>';
            header("location: staff.php?page=addExam");
        }
        else
        {
            echo '<script> alert("Data Not Inserted"); </script>';
            echo "Error: " . $query . "<br>" . $connect->error;
        }
    }

    //Update Exam data
    if(isset($_POST['updateExamdata']))
    {   
        $examID = $_POST['examID'];
        $title = $_POST['examTitle'];
        $addMark = $_POST['addMark'];
        $deductMark = $_POST['deductMark'];
        $noOfQuestion = $_POST['noOfQuestion'];
        $scheduledTime = $_POST['scheduledTime'];
        $examDuration = $_POST['examDuration'];

        $query = "UPDATE exam_info SET
            title ='".$title."', 
            correct_mark = '".$addMark."', 
            incorrect_mark = '".$deductMark."', 
            no_question = '".$noOfQuestion."', 
            scheduled_time = '".$scheduledTime."',
            duration = '".$examDuration."'
            WHERE eid = '".$examID."'";

        if($connect->query($query) == TRUE)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location: staff.php?page=addExam");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
            echo "Error: " . $query . "<br>" . $connect->error;
        }
    }

    //Delete Exam data
    if(isset($_POST['deleteExamdata']))
    {
        $id = $_POST['delete_id'];
        $examID = trim($id);
        $query = "DELETE FROM exam_info WHERE eid= '".$examID."'";

        if($connect->query($query))
        {
            echo '<script> alert("Data Deleted"); </script>';
            header("location: staff.php?page=addExam");
        }
        else
        {
            echo '<script> alert("Data Not Deleted"); </script>';
        }
    }

    //View Question data
    if(isset($_POST['viewExamdata']))
    {
        session_start();
        $ExamID = $_POST['view_id'];
        $_SESSION['view_id'] = $ExamID;
        header("location: staff.php?page=editQuestion");
    }

    //Update Question data
    if(isset($_POST['updateQuestiondata']))
    {
        $examID = $_POST['examID'];
        $questionID = "";
        for($i = 1; $i<=$_POST['noOfQuestion']; $i++){
            $questionID = $examID . "_q" . $i;
            $question = $_POST["qns$i"];
            $answer = $_POST["ans$i"];
            $query = "INSERT INTO exam_question (eid, qid, question, optAns) 
                VALUES ('$examID', '$questionID', '$question', '$answer')";
            if($connect->query($query)){
                echo "Update Success";
            } else{
                echo $connect->error;
            } //Insert Data First
            echo $questionID . " " . $question . " " . $answer . "<br>";
            for($j = 1;$j <= 4; $j++){
                $optionID = $_POST["$i$j"];
                echo $optionID . "<br>";
                $query2 = "UPDATE exam_question SET opt$j = '".$optionID."' WHERE eid = '".$examID."' AND qid = '".$questionID."'" ;
                if($connect->query($query2)){
                    echo "Update Success";
                } else{
                    echo $connect->error;
                } //Insert Data First
            }
        }
        header("location: staff.php?page=addExam");
    }

    //Enroll to Exam
    if(isset($_POST['takeExam']))
    {
        session_start();
        $ExamID = $_POST['exam_id'];
        $query = "SELECT scheduled_time, duration FROM exam_info WHERE eid = '".$ExamID."'";
        $row = $connect->query($query)->fetch_assoc();
        $scheduledTime = $row['scheduled_time'];
        $duration = $row['duration'];
        $end_duration = time()+($duration*60);
        $currentTime = date("d/m/Y H:i:s", time());
        $start_time = strtotime(date("Y-m-d H:i:s", time()));
        $end_time = strtotime(date("Y-m-d H:i:s", $end_duration));
        $_SESSION['end_time'] = $end_time;
        $_SESSION['duration'] = $end_time - $start_time;
        if($currentTime < $scheduledTime){
            echo "<script> 
            alert('You are not allowed to start the exm before the Scheduled Time!');
            window.location.href = 'student.php?page=takeExam';
             </script>";
        } elseif($currentTime > $scheduledTime){
            $_SESSION['exam_id'] = $ExamID;
            $_SESSION['optAnsArray'] = array();
            $loginID = $_SESSION['loginId'];
            $resultID = $loginID . "_" . $ExamID;
            $query2 = "INSERT INTO stu_exam (userid, eid, result_id) VALUES ('$loginID', '$ExamID', '$resultID')";
            if($connect->query($query2)){
                echo "Update Success";
            } else{
                echo $connect->error;
            }
            header("location: student.php?page=examPage");
        }

    }
    //Next Question
    if(isset($_POST['nextQuestion']))
    {
        session_start();
        $start_time = strtotime(date("Y-m-d H:i:s", time()));
        $_SESSION['duration'] = $_SESSION['end_time'] - $start_time;
        $ExamID = $_POST['examID'];
        $loginID = $_SESSION['loginId'];
        $q = $_POST['q'];
        $chosen = $_POST['optradio'];
        array_push($_SESSION['optAnsArray'],$chosen);
        $optAnsArray = $_SESSION['optAnsArray'];
        $optAns = implode(",",$optAnsArray);
        $query = "UPDATE stu_exam SET optAns = '".$optAns."' WHERE userid = '".$loginID."' && eid = '".$ExamID."'";
        if($connect->query($query)){
            echo "Update Success";
        } else{
            echo $connect->error;
        }
        $q++;

        header("location: student.php?page=examPage&q=$q");
    }
    //Submit Question
    if(isset($_POST['submitExam']) || isset($_POST['JSsubmitExam']))
    {
        //Submit
        session_start();
        $start_time = strtotime(date("Y-m-d H:i:s", time()));
        $_SESSION['duration'] = $_SESSION['end_time'] - $start_time;
        $ExamID = $_POST['examID'];
        $loginID = $_SESSION['loginId'];
        $resultID = $loginID . "_" . $ExamID;
        $q = $_POST['q'];
        $chosen = $_POST['optradio'];
        $noOfQuestion = $_POST['noOfQuestion'];
        $time = date("d/m/Y H:i:s", time());
        array_push($_SESSION['optAnsArray'],$chosen);
        $optAnsArray = $_SESSION['optAnsArray'];
        $optAns = implode(",",$optAnsArray);

        $query = "UPDATE stu_exam SET 
        optAns = '".$optAns."',
        submission_time = '".$time."'
        WHERE eid = '".$ExamID."' && userid = '".$loginID."'";

        //Result Calculation
        $score = 0;
        $checkAnsArray = array();
        $addMarkQuery = "SELECT correct_mark, title FROM exam_info WHERE eid = '".$ExamID."'";
        $ansQuery = "SELECT optAns FROM exam_question WHERE eid = '".$ExamID."'";
        //Retrieve Mark addition/subtraction
        $row = $connect->query($addMarkQuery)->fetch_assoc();
        $addMark = $row['correct_mark'];
        $title = $row['title'];
        //Real Caculate
        $result = $connect->query($ansQuery);
        while($rows = $result->fetch_assoc()){
            $checkAnsArray[] = $rows;
        }
        for($i = 0; $i < $q; $i++){
            if($optAnsArray[$i] == $checkAnsArray[$i]['optAns']){
                $score += $addMark;
            }
        }
        $query2 = "INSERT INTO exam_result (userid, eid, result_id, title, optAns, score) 
        VALUES ('$loginID', '$ExamID', '$resultID', '$title', '$optAns', '$score')
        ";

        if($connect->query($query) && $connect->query($query2)){
            echo "Update Success";
        } else{
            echo $connect->error;
        }

        // $_SESSION['optAnsArray']);

        //Completed Submisssion
        $q = $noOfQuestion+1;
        header("location: student.php?page=examPage&q=$q");
    }
    //Slect Exam Details
    if(isset($_POST['submitExamTitle']))
    {
        session_start();
        $examID = $_POST['ExamID'];
        $_SESSION['viewExamID'] = $examID;
        header("location: staff.php?page=examResult");
    }
    //View Exam Details
    if(isset($_POST['stuViewExamDetails']))
    {
        session_start();
        if($_SESSION['user_role'] == "student"){
            //Submit
            $ExamID = $_POST['exam_id'];
            $_SESSION['exam_id'] = $ExamID;
            $loginID = $_SESSION['loginId'];
            $query = "SELECT optAns FROM exam_result WHERE userid = '".$loginID."' AND eid = '".$ExamID."'";
            $query2 = "SELECT * FROM exam_question WHERE eid = '".$ExamID."'";
            header("location: student.php?page=viewDetails");
        } elseif($_SESSION['user_role'] == "staff"){
            $ExamID = $_POST['exam_id'];
            $_SESSION['exam_id'] = $ExamID;
            $loginID = $_POST['userid'];
            $_SESSION['userid'] = $loginID;
            $query = "SELECT optAns FROM exam_result WHERE userid = '".$loginID."' AND eid = '".$ExamID."'";
            $query2 = "SELECT * FROM exam_question WHERE eid = '".$ExamID."'";
            header("location: staff.php?page=viewDetails");
        }
    }
?>