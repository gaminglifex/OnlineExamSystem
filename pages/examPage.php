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
    <!--Timer-->
    <link rel="stylesheet" href="/Exam/css/TimeCircles.css">
    <script src="/Exam/css/TimeCircles.js"></script>
</head>
<?php 
    $examID = $_SESSION['exam_id'];
    $questionArray = array();
    $query = "SELECT qid, question, opt1, opt2, opt3, opt4, optAns FROM exam_question WHERE eid = '".$examID."'";
    $query2 = "SELECT title, no_question, duration FROM exam_info WHERE eid = '".$examID."'";
    $result = $connect->query($query);
    while($rows = $result->fetch_assoc()){
        $questionArray[] = $rows;
    };
    $row = $connect->query($query2)->fetch_assoc();
    $title = $row['title'];
    $noOfQuestion = $row['no_question'];
    echo $questionArray[0]['qid'];
    echo $examID;
?>
<body>
    <div class="card">
        <h5 class="card-header text-white bg-info">Exam Question-<?php echo "$title". "-". "$noOfQuestion" . "Questions"; ?></h5>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <form action="retrieveData.php" method="POST">
                        <div id="timer" data-timer="<?php echo $_SESSION['duration'];?>" style="width:50%;height:100px;"></div>
                        <button type='hidden' name='JSsubmitExam' id='submitExam' class="btn bg-transparent"></button>
                        <input type="hidden" name="examID" value="<?php echo $examID; ?>">
                        <input type="hidden" name="noOfQuestion" value="<?php echo $noOfQuestion; ?>">
                        <?php
                            $q = isset($_GET['q']) ? $_GET['q'] : $q=1;

                            if($q <= $noOfQuestion){
                                echo "
                                <div class='form-group'>
                                    <input type='hidden' id='getValue'></input>
                                    <input type='hidden' name='q' value='$q'>
                                    <b>Question $q</b><br>
                                    ".$questionArray[$q-1]['question']."
                                </div>
                                ";

                                for($j = 1; $j <= 4; $j++){
                                    $optionArray = ['', 'A', 'B', 'C', 'D'];
                                    echo "
                                    <div class='form-group'>
                                        <div class='form-check'>
                                            <label class='form-check-label' for='".$q.$j."'>
                                            <input type='radio' name='optradio' id='".$q.$j."' value='".$optionArray[$j]."' class='form-check-input'>
                                            ".$optionArray[$j]." : ".$questionArray[$q-1]['opt'.$q]."</label>
                                        </div>
                                    </div>
                                    ";
                                }

                                if($q == $noOfQuestion){
                                    echo "
                                        <div class='form-group'>
                                            <button type='submit' name='submitExam' id='submitExam' class='btn btn-lg btn-info'>Submit</button>
                                        </div>
                                    ";
                                } else{
                                    echo "
                                        <div class='form-group'>
                                            <button type='submit' name='nextQuestion' class='btn btn-lg btn-info'>Next Question</button>
                                        </div>
                                    ";
                                }
                            } else {
                                echo "
                                    <div class='form-group'>
                                            <h2>Submission Completed!</h2>
                                            <a id='getValue' href='student.php?page=takeExam' class='btn btn-lg btn-success'>Back to Exam dashboard</a>
                                            <a href='student.php?page=examResult' class='btn btn-lg btn-success'>View Exam Result</a>
                                    </div>
                                ";
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script>

$("#timer").TimeCircles({
    count_past_zero: false,
    time:{
        Days:{
            show: false
        },
    }
})

var countdown = setInterval(function(){
    var remaining_second = $("#timer").TimeCircles().getTime();
    var getValue = document.getElementById('getValue').innerHTML;
    if(getValue != "Back to Exam dashboard")
    {
        if(remaining_second <= 0)
        {
            clearInterval(countdown);
            alert('Exam time is over');
            document.getElementById("submitExam").click();
        }
    } else{
        $("#timer").TimeCircles().stop();
    }
}, 1000);


</script>
</html>