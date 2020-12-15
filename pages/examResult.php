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

<body>

        <!-- Exam POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Enroll to Exam </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="retrieveData.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="exam_id" id="exam_id">
                        <input type="hidden" name="userid" id="userid">

                        <h4> Do you want to View the Exam Details ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="stuViewExamDetails" class="btn btn-primary"> Yes </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="jumbotron-fluid">
            <div class="card">
                <h2> Exam Dashboard </h2>
            </div>

            <div class="card">
                <div class="card-body">

                <?php
                //Database Connection
                $connect = mysqli_connect($server, $user, $pw, $db);
                if (!$connect) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                if($_SESSION['user_role'] == "student"){
                    //For ***Student***
                    //Data from Exam result
                    $query = "SELECT * FROM exam_result WHERE userid = '".$_SESSION['loginId']."'";
                    $result = $connect->query($query);
                    //Data from Stu result Record
                    $query2 = "SELECT submission_time FROM stu_exam WHERE userid = '".$_SESSION['loginId']."'";
                    $row2 = $connect->query($query2)->fetch_assoc();
                    $time = $row2['submission_time'];
                    $result = $connect->query($query);
                    ?>

                        <table id="Examdata" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Student ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Score</th>
                                    <th scope="col">Submission Time</th>
                                    <th scope="col">Exam ID</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <?php
                    if($result)
                    {
                        foreach($result as $row)
                        {
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $row['userid']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['score']; ?> </td>
                                    <td><?php echo $time; ?></td>
                                    <td><?php echo $row['eid']; ?></td>
                                    <td><button type="button" class="btn btn-info viewbtn"> View Details </button></td>
                                </tr>
                            </tbody>
                            <?php           
                        }
                    }
                    else 
                    {
                        echo "No Record Found";
                    }
                } elseif($_SESSION['user_role'] == "staff"){
                    //For ***Staff***
                    //Data from Exam result
                    $query = "SELECT * FROM exam_result";
                    $result = $connect->query($query);
                    //Data from Stu result Record
                    $query2 = "SELECT submission_time FROM stu_exam";
                    $row2 = $connect->query($query2)->fetch_assoc();
                    $time = $row2['submission_time'];
                    //Data from stu_info
                    $query3 = "SELECT * FROM stu_info";
                    $row3 = $connect->query($query3);
                    ?>

                        <table id="Examdata" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Student ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Score</th>
                                    <th scope="col">Submission Time</th>
                                    <th scope="col">Exam ID</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <?php
                    if($result)
                    {
                        foreach($result as $row)
                        {
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $row['userid']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['score']; ?> </td>
                                    <td><?php echo $time; ?></td>
                                    <td><?php echo $row['eid']; ?></td>
                                    <td><button type="button" class="btn btn-info viewbtn"> View Details </button></td>
                                </tr>
                            </tbody>
                            <?php           
                        }
                    }
                    else 
                    {
                        echo "No Record Found";
                    }
                }
                ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            $('#Examdata').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "info": false,
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search.....",
                }
            });

        });
    </script>

    <script>
        $(document).ready(function () {

            $('.viewbtn').on('click', function () {

                $('#viewmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#userid').val(data[0]);
                $('#exam_id').val(data[4]);

            });
        });
    </script>


</body>
</html>