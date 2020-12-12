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
    <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="retrieveData.php" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Login ID </label>
                            <input type="text" name="loginID" class="form-control" placeholder="12345678D">
                        </div>

                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="username" class="form-control" placeholder="John Doe">
                        </div>

                        <div class="form-group">
                            <label> Email </label>
                            <input type="text" name="email" class="form-control" placeholder="JohnDoe@gmail.com">
                        </div>

                        <div class="form-group">
                            <label> Password </label>
                            <input type="text" name="password" class="form-control" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Birthday </label>
                            <input type="text" name="BOD" class="form-control" placeholder="dd/mm/yyyy">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertStudata" class="btn btn-primary">Save Data</button>
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
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="retrieveData.php" method="POST">

                    <div class="modal-body">

                        <div class="form-group">
                            <label> Login ID </label>
                            <input type="text" name="loginID" id="loginID" class="form-control"
                                placeholder="">
                        </div>

                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="">
                        </div>

                        <div class="form-group">
                            <label> Email </label>
                            <input type="text" name="email" id="email" class="form-control"
                                placeholder="">
                        </div>

                        <div class="form-group">
                            <label> Password </label>
                            <input type="text" name="password" id="password" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label> Gender </label>
                            <input type="text" name="sex" id="sex" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label> Birthday </label>
                            <input type="text" name="BOD" id="BOD" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label> Profile Image </label>
                            <input type="text" name="profileImg" id="profileImg" class="form-control"
                                placeholder="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updateStudata" class="btn btn-primary">Update Data</button>
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
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
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
                        <button type="submit" name="deleteStudata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="jumbotron-fluid">
            <div class="card">
                <h2> Student Database </h2>
            </div>
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal">
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

                $query = "SELECT * FROM stu_info";
                $result = $connect->query($query);
                ?>
                    <table id="datatableid" class="table table-bordered table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Login ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">User Password</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Profile Image</th>
                                <th scope="col"> Action </th>
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
                                <td> <?php echo $row['userid']; ?> </td>
                                <td> <?php echo $row['username']; ?> </td>
                                <td> <?php echo $row['email']; ?> </td>
                                <td> <?php echo $row['user_pw']; ?> </td>
                                <td> <?php echo $row['sex']; ?> </td>
                                <td> <?php echo $row['BOD']; ?> </td>
                                <td> 
                                    <?php 
                                    if(!empty($row['profileImg'])){
                                        echo $row['profileImg'] . "<br>";
                                        echo "<img id='posts-img' src='/Exam/profileimage/".$row['profileImg']."' style='width: 100px;height:100px;'>";
                                    }else {
                                        echo "<img id='posts-img' src='/Exam/profileimage/your-picture.png' style='width: 100px;height:100px;'>";
                                    }
                                    ?> 
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success editbtn"> EDIT </button>
                                    <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                                </td>
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

    <!-- <script>
        $(document).ready(function () {

            $('.viewbtn').on('click', function () {
                $('#viewmodal').modal('show');
                $.ajax({ //create an ajax request to display.php
                    type: "GET",
                    url: "display.php",
                    dataType: "html", //expect html to be returned                
                    success: function (response) {
                        $("#responsecontainer").html(response);
                        //alert(response);
                    }
                });
            });

        });
    </script> -->


    <script>
        $(document).ready(function () {

            $('#datatableid').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Your Data",
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

                $('#delete_id').val(data[0]);

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

                console.log($.trim(data));

                $('#loginID').val(data[0]);
                $('#username').val(data[1]);
                $('#email').val(data[2]);
                $('#password').val(data[3]);
                $('#sex').val(data[4]);
                $('#BOD').val(data[5]);
                $('#profileImg').val(data[6]);
            });
        });
    </script>


</body>
</html>