<?php 
    include_once('..\Authentication\db_connect.php');
    //Database Connection
    $connect = mysqli_connect($server, $user, $pw, $db);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>
</head>
<?php 
    if($_SESSION['user_role'] == "student"){
        $examID = $_SESSION['exam_id'];
        $loginID = $_SESSION['loginId'];
        $questionArray = array();

        $query = "SELECT optAns FROM exam_result WHERE userid = '".$loginID."' AND eid = '".$examID."'";
        $query2 = "SELECT * FROM exam_question WHERE eid = '".$examID."'";
        $query3 = "SELECT title, no_question FROM exam_info WHERE eid = '".$examID."'";
        
        
        $result2 = $connect->query($query2); 

        $row1 = $connect->query($query)->fetch_assoc();
        while($row2 = $result2->fetch_assoc()){
            $questionArray[] = $row2;
        };
        $row3 = $connect->query($query3)->fetch_assoc();

        $splitAns = $row1['optAns'];
        $chosenAns = explode(",",$splitAns);
        $title = $row3['title'];
        $noOfQuestion = $row3['no_question'];
        echo $examID;
        echo $loginID;
    } elseif($_SESSION['user_role'] == "staff"){
        $examID = $_SESSION['exam_id'];
        $loginID = $_SESSION['userid'];
        $questionArray = array();

        $query = "SELECT optAns FROM exam_result WHERE userid = '".$loginID."' AND eid = '".$examID."'";
        $query2 = "SELECT * FROM exam_question WHERE eid = '".$examID."'";
        $query3 = "SELECT title, no_question FROM exam_info WHERE eid = '".$examID."'";
        
        
        $result2 = $connect->query($query2); 

        $row1 = $connect->query($query)->fetch_assoc();
        while($row2 = $result2->fetch_assoc()){
            $questionArray[] = $row2;
        };
        $row3 = $connect->query($query3)->fetch_assoc();

        $splitAns = $row1['optAns'];
        $chosenAns = explode(",",$splitAns);
        $title = $row3['title'];
        $noOfQuestion = $row3['no_question'];
        echo $examID;
    }
?>
<body>
    <div class="card">
        <h5 class="card-header text-white bg-info">Exam Question-<?php echo "$title". "-". "$noOfQuestion" . "Questions"; ?></h5>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <form action="retrieveData.php"  method="POST">
                        <input type="hidden" name="examID" value="<?php echo $examID; ?>">
                        <input type="hidden" name="noOfQuestion" value="<?php echo $noOfQuestion; ?>">
                        <?php
                            for($i = 1; $i <= $noOfQuestion; $i++){
                                echo "
                                <b>Question $i</b><br>
                                <div class='form-group'>
                                   '".$questionArray[$i-1]['question']."'
                                </div>
                                <div class='form-group bg-dark text-white'>
                                   The chosen answer: ".$chosenAns[$i-1]."
                                </div>
                                <div class='form-group bg-success text-white'>
                                   The correct answer: ".$questionArray[$i-1]['optAns']."
                                </div>
                                ";
                                for($j = 1; $j <= 4; $j++){
                                    $optionArray = ['', 'A', 'B', 'C', 'D'];
                                    echo "
                                    <div class='form-group'>
                                        ".$optionArray[$j]." : ".$questionArray[$i-1]['opt'.$i]."
                                    </div>
                                    ";
                                }
                            }
                        ?>
                        <div class="form-group">
                            <a href="student.php?page=examResult" class="btn btn-lg btn-success">Back to Exam Result dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>