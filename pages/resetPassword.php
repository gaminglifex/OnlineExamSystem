
<html>
    <head>

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
        <link rel="stylesheet" href="/Exam/css/form.css">

    </head>
<body>
    <?php include('..\Authentication\UserAuth.php'); ?>
    <div class="login-form">
        <form class="form" id="reset-form" action="" method="post">
            <h2 class="text-center">Reset Password</h2>
            <div class="form-col">
                <div class="form-group col-md">
                    <div class="form-group">
                        <label for="inputLoginID">Login ID</label>
                        <input type="text" id="inputLoginID" name="inputLoginID" class="form-control"
                            placeholder="12345678D" required>
                    </div>
                    <?php echo "$loginIdErr"; ?>
                </div>
                <div class="form-group col-md">
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="text" id="inputEmail" name="inputEmail" class="form-control"
                            placeholder="12345678D" required>
                    </div>
                    <?php echo "$emailReErr"; ?>
                </div>
                <div class="form-group col-md">
                    <div class="form-group">
                        <label for="inputLoginPassword">New Password</label>
                        <input type="password" id="inputPassword" name="inputPassword" class="form-control"
                            placeholder="Password" required>
                    </div>
                    <?php echo "$passwordResetErr"; ?>
                </div>
                <div class="form-group col-md">
                    <div class="form-group">
                        <label for="inputLoginPassword">Confirm New Password</label>
                        <input type="password" id="inputRePassword" name="inputRePassword" class="form-control"
                            placeholder="Password" required>
                    </div>
                    <?php echo "$resetPasswordErr"; ?>
                </div>
                <?php echo "$resultMessage"; ?>
                <div class="form-group">
                    <div class="buttonHolder">
                        <button type="submit" name="reset" class="btn btn-primary btn-md">Reset</button>
                    </div>
                </div>
                <div class="form-group col-md">
                    <div class="form-group clearfix">
                        <h6 class="text-center"><a href="/Exam/Landing.php" class="text-left">Back to Login</a></h6>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
