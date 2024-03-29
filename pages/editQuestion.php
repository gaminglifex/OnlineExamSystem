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
    $examID = $_SESSION['view_id'];
    $query = "SELECT title, no_question FROM exam_info WHERE eid = '".$examID."'";
    $rows = $connect->query($query)->fetch_assoc();
    $title = $rows['title'];
    $noOfQuestion = $rows['no_question'];
    echo $examID;
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
                                    <input type='hidden' name='questionID' value='$i'>
                                    <label class='' for='qns".$i."'></label>  
                                    <textarea rows='3' cols='5' name='qns".$i."' class='form-control' placeholder='Write Question Here...'></textarea>  
                                </div>
                                ";
                                for($j = 1; $j <= 4; $j++){
                                    $optionArray = ['', 'A', 'B', 'C', 'D'];
                                    echo "
                                    <div class='form-group'>
                                        <label class='col-md-12 control-label' for='".$i.$j."'></label>  
                                        <div class='col-md-12'>
                                        <input type='text' name='".$i.$j."' id='".$i.$j."' placeholder='Enter option ".$optionArray[$j]."' class='form-control input-md'>
                                        </div>
                                    </div>
                                    ";
                                }
                                echo "
                                    <div class='form-group'>
                                        <select id='ans".$i."' name='ans".$i."' placeholder='Choose correct answer' class='form-control input-md'>
                                            <option value='' disabled selected>Select answer for Question ".$i."</option>
                                            <option value='A'>option A</option>
                                            <option value='B'>option B</option>
                                            <option value='C'>option C</option>
                                            <option value='D'>option D</option> 
                                        </select>
                                    </div>
                                ";
                            }
                        ?>
                        <div class="form-group">
                            <button type="submit" name="updateQuestiondata" class="btn btn-lg btn-info">Update Question</button>
                            <a href="staff.php" class="btn btn-lg btn-success">Back to Exam dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>