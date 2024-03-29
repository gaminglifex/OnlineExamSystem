<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Online Examination System</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
            integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
            crossorigin="anonymous"></script>

        <!-- Main js & css-->
        <link rel="stylesheet" href="css/global.css">
        <script src="js/main.js"></script>
    </head>
    <body id="body">

        <!-- Authentication Script -->
        <?php include_once("Authentication\UserAuth.php"); ?>
        <div id="auth-form" class="container">
            <?php echo "$registerStatus"; ?>
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login"
                        aria-selected="true">Login</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register"
                        aria-selected="false">Register</a>
                    </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="nav-login">
                    <div class="login-form">
                        <form class="form" id="login-form" action="" method="post">
                            <div class="form-col">
                                <div class="form-group col-md">
                                    <div class="form-group">
                                        <label for="inputLoginID">Login ID</label>
                                        <input type="text" id="inputLoginID" name="inputLoginID" class="form-control"
                                            placeholder="12345678D" required>
                                    </div>
                                    <?php echo "$LoginIdErr"; ?>
                                </div>
                                <div class="form-group col-md">
                                    <div class="form-group">
                                        <label for="inputLoginPassword">Password</label>
                                        <input type="password" id="inputLoginPassword" name="inputLoginPassword" class="form-control"
                                            placeholder="Password" required>
                                    </div>
                                    <?php echo "$passwordErr"; ?>

                                </div>
                                <div class="form-group col-md">
                                    <div class="form-group clearfix">
                                        <label class="float-left checkbox-inline"><input type="checkbox" name="remember" value="rembmer"> Remember me</label>
                                        <a href="/Exam/pages/resetPassword.php" class="float-right">Forgot password?</a>
                                    </div>
                                </div>
                                <div class="buttonHolder">
                                    <button type="submit" name="login" class="btn btn-primary btn-md">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="nav-register">
                    <div class="register-form">
                        <form class="form" action="" method="post" id="register-form" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-col col-md-4">
                                    <div class="form-file">
                                        <input type="file" class="inputfile" name="profileimg" id="profileimg" onchange="readURL(this);"
                                            data-multiple-caption="{count} files selected" multiple />
                                        <label for="profileimg">
                                            <figure>
                                                <img src="images/your-picture.png" alt="" class="profileimg">
                                            </figure>
                                            <span class="file-button">choose picture</span>
                                        </label>
                                        <small id="passwordHelpBlock" class="form-text text-muted">
                                            The image format must be <strong>JPEG</strong> only
                                        </small>
                                    </div>
                                </div>
                                <div class="form-col col-md-8">
                                    <div class="form-group col-md">
                                        <div class="form-group">
                                            <label for="registerLoginID">LoginID</label>
                                            <input type="text" id="registerLoginID" name="loginID" class="form-control" placeholder="12345678D">
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                Please make sure the ID is consistent with the assigned one.
                                            </small>
                                            <?php echo "$loginIdErr"; ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md">
                                        <div class="form-group">
                                            <label for="inputNickname">Nickname</label>
                                            <input type="text" id="inputNickname" name="nickname" class="form-control" placeholder="JohnDoe">
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                No special characters are allowed!
                                            </small>
                                            <?php echo "$usernameErr"; ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md">
                                        <div class="form-group">
                                            <label for="inputRegisterEmail">Email</label>
                                            <input type="email" id="inputRegisterEmail" name="registerEmail" class="form-control" placeholder="JohnDoe@domain.com">
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                Dont' leave it empty.
                                            </small>
                                            <?php echo "$emailRegErr"; ?>
                                        </div>
                                    </div>
                                    <div class="form-group col-md">
                                        <label for="inputRegisterPassword">Password</label>
                                        <input type="password" id="inputRegisterPassword" name="registerPassword" class="form-control" placeholder="Password">
                                        <small id="passwordHelpBlock" class="form-text text-muted">
                                            Your password must be 8-20 characters long, contain letters,
                                                numbers and special characters, but must not contain spaces.
                                        </small>
                                        <?php echo "$passwordRegErr"; ?>
                                    </div>
                                    <div class="form-group col-md">
                                        <label for="inputRePassword">Confirm Password</label>
                                        <input type="password" id="inputRePassword" name="inputRePassword" class="form-control" placeholder="Password">
                                        <small id="passwordHelpBlock" class="form-text text-muted">
                                            Re-enter Password.
                                        </small>
                                        <?php echo "$rePasswordErr"; ?>
                                    </div>
                                    <div class="form-group col-md" id="collapseOpt">
                                        <div class="btn-group-toggle clearfix" data-toggle="buttons">
                                            <label id="stuBtn" class="float-left btn btn-primary btn-md active custBtn">
                                                <input id="stuOpt" name="identity" value="student" type="radio" data-toggle="collapse" data-target="#studentOpt" aria-expanded="false" aria-controls="studentOpt" checked> I am a student
                                            </label>
                                            <label id="staffBtn" class="float-right btn btn-primary btn-md custBtn">
                                                <input id="staffOpt" name="identity" value="staff" type="radio" data-toggle="collapse" data-target="#staffOpt" aria-expanded="false" aria-controls="staffOpt"> I am a staff
                                            </label>
                                        </div>
                                        <div class="collapse show" id="studentOpt" data-parent="#collapseOpt">
                                            <div class="card card-body">
                                                <div class="form-group row justify-content-around">
                                                    <label class="col-form-label" for="Gender">Gender</label>
                                                    <div class="col-sm-3">
                                                        <select id="Gender" name="Gender" class="form-control">
                                                            <option value="M">Male</option>
                                                            <option value="F">Female</option>
                                                        </select>
                                                    </div>
                                                    <label class="col-form-label" for="inputDay">Birthday</label>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="dd" id="inputDay" placeholder="dd">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroupPrepend1">/</span>
                                                            </div>
                                                            <input type="text" class="form-control" name="mm" id="inputMonth" placeholder="mm">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroupPrepend2">/</span>
                                                            </div>
                                                            <input type="text" class="form-control" name="yyyy" id="inputYear" placeholder="yyyy">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="staffOpt" data-parent="#collapseOpt">
                                            <div class="card card-body">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for=CourseInfo>Course</label>
                                                    <div class="col-sm-10">
                                                        <input id="CourseInfo" name="courseInfo" class="form-control" type="text">
                                                        <small id="passwordHelpBlock" class="form-text text-muted">
                                                            eg. EIE4432,EIE4433,EIE1234 MUst not contain any spaces.
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttonHolder">
                                        <button type="submit" id='registerbtn' name="register" class="btn btn-primary btn-md">Register</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
 $(document).ready(function(){
    $(document).on('click', '#registerbtn', function(){
    var name = document.getElementById("profileimg").files[0].name;
    var form_data = new FormData();
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['jpg','jpeg']) == -1) 
    {
    alert("Invalid Image File");
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("profileimg").files[0]);
    var f = document.getElementById("profileimg").files[0];
    var fsize = f.size||f.fileSize;
    if(fsize > 2000000)
    {
        alert("Image File Size is very big");
    }
    else
    {
        form_data.append("file", document.getElementById('profileimg').files[0]);
        $.ajax({
            url:"../Exam/Authentication/registerAuth.php",
            method:"POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            {
                alert('Upload success');
            }
        });
    }
    });
});
</script>
