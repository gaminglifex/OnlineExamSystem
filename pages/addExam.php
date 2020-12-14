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


    <!-- Modal -->
    <div class="modal fade" id="examaddmodal" tabindex="-1" role="dialog" aria-labelledby="addExam"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExam">Add Exam</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="retrieveData.php" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Exam Title </label>
                            <input type="text" name="examTitle" id="examTitle" class="form-control"
                                placeholder="">
                        </div>

                        <div class="form-group">
                            <label> Addition Mark</label>
                            <input type="text" name="addMark" id="addMark" class="form-control"
                                placeholder="Addition mark for each correct answer">
                        </div>

                        <div class="form-group">
                            <label> Deduction Mark </label>
                            <input type="text" name="deductMark" id="deductMark" class="form-control"
                                placeholder="Deduction Mark for each incorrect answer">
                        </div>

                        <div class="form-group">
                            <label> No. of Questions </label>
                            <input type="text" name="noOfQuestion" id="noOfQuestion" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label> Scheduled time</label>
                            <input type="text" name="scheduledTime" id="scheduledTime" class="form-control"
                                placeholder="dd/mm/yyyy hh:mm">
                        </div>
                        <div class="form-group">
                            <label> Duration(Minutes) </label>
                            <input type="text" name="examDuration" id="examDuration" class="form-control"
                                placeholder="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertExamdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Staff Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="retrieveData.php" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Exam Title </label>
                            <input type="text" name="examTitle" id="MexamTitle" class="form-control"
                                placeholder="">
                        </div>

                        <div class="form-group">
                            <label> Addition Mark</label>
                            <input type="text" name="addMark" id="MaddMark" class="form-control"
                                placeholder="Addition mark for each correct answer">
                        </div>

                        <div class="form-group">
                            <label> Deduction Mark</label>
                            <input type="text" name="deductMark" id="MdeductMark" class="form-control"
                                placeholder="Deduction Mark for each incorrect answer">
                        </div>

                        <div class="form-group">
                            <label> No. of Questions </label>
                            <input type="text" name="noOfQuestion" id="MnoOfQuestion" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label> Scheduled time</label>
                            <input type="text" name="scheduledTime" id="MscheduledTime" class="form-control"
                                placeholder="dd/mm/yyyy hh:mm">
                        </div>
                        <div class="form-group">
                            <label> Duration(Minutes) </label>
                            <input type="text" name="examDuration" id="MexamDuration" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label> Exam ID </label>
                            <input type="text" name="examID" id="MexamID" class="form-control"
                                placeholder="" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updateExamdata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Exam Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="retrieveData.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deleteExamdata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

        <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> View Exam Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="retrieveData.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="view_id" id="view_id">

                        <h4> Do you want to View the Exam Question ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="viewExamdata" class="btn btn-primary"> Yes </button>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#examaddmodal">
                        ADD DATA
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">

                <?php
                //Database Connection
                $connect = mysqli_connect($server, $user, $pw, $db);
                if (!$connect) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $query = "SELECT * FROM exam";
                $result = $connect->query($query);
                ?>

                    <table id="Examdata" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Mark Addition</th>
                                <th scope="col">Mark Deduction</th>
                                <th scope="col">No. of Questions</th>
                                <th scope="col">Scheduled time</th>
                                <th scope="col">Duration(Minutes)</th>
                                <th scope="col">Creation time</th>
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
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['correct_mark']; ?></td>
                                <td><?php echo $row['incorrect_mark']; ?></td>
                                <td><?php echo $row['no_question']; ?></td>
                                <td><?php echo $row['scheduled_time']; ?> </td>
                                <td><?php echo $row['duration']; ?></td>
                                <td><?php echo $row['creation_time']; ?></td>
                                <td><?php echo $row['eid']; ?></td>
                                <td><button type="button" class="btn btn-info viewbtn"> View </button>
                                <button type="button" class="btn btn-success editbtn"> Modify </button>
                                <button type="button" class="btn btn-danger deletebtn"> DELETE </button></td>
                            </tr>
                        </tbody>
                        <?php           
                    }
                }
                else 
                {
                    echo "No Record Found";
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

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[7]);

            });
        });
    </script>

    <script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#MexamTitle').val(data[0]);
                $('#MaddMark').val(data[1]);
                $('#MdeductMark').val(data[2]);
                $('#MnoOfQuestion').val(data[3]);
                $('#MscheduledTime').val(data[4]);
                $('#MexamDuration').val(data[5]);
                $('#MexamID').val(data[7]);
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

                $('#view_id').val(data[7]);

            });
        });
    </script>


</body>
</html>