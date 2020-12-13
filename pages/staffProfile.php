
<?php
include_once('..\Authentication\db_connect.php');
//Database Connection
$connect = mysqli_connect($server, $user, $pw, $db);
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
$loginID = $_SESSION['loginId'];
$user_role = $_SESSION['user_role'];
$query = "SELECT * FROM staff_info WHERE userid = '".$loginID."'";
$result = $connect->query($query);
if($result->num_rows > 0) {
  $rows = $result->fetch_assoc();
}
?>
<html>
  <body>
      <div class="card">
    <div class="card-header">
          <h3 class='text-center'>Profile</h3>
      </div>
        <div class="card-body d-flex justify-content-between">
          <div class="row">
              <div class="col-md-6">
                <?php
                  if(!empty($rows['profileimg'])){
                      echo "<img id='posts-img' src='/Exam/profileimage/".$rows['profileimg']."' style='width: 350px;height:350px;'>";
                  } else {
                    echo "<img id='posts-img' src='/Exam/profileimage/your-picture.png' style='width: 350px;height:350px;'>";
                  }
                ?>
              </div>
              <div class="col-md-6">
                  <div style="width:600px; margin:0px auto">
                      <form class="" action="" method="post">
                          <div class="form-group pt-3">
                              <label for="LoginID">Login ID</label>
                              <?php echo "<input type='text' name='LoginID'  value='".$rows['userid']."' class='form-control' placeholder='12345678D'>" ?>
                          </div>
                          <div class="form-group">
                            <label for="username">Username</label>
                            <?php echo "<input type='text' name='username'  value='".$rows['username']."' class='form-control' placeholder='12345678D'>" ?>
                          </div>
                          <div class="form-group">
                            <label for="email">Email address</label>
                            <?php echo "<input type='text' name='email'  value='".$rows['email']."' class='form-control' placeholder='12345678D'>" ?>
                          </div>
                          <div class="form-group">
                            <label for="password">Password</label>
                            <?php echo "<input type='text' name='password'  value='".$rows['user_pw']."' class='form-control' placeholder='12345678D'>" ?>
                          </div>
                          <div class="form-group">
                            <label for="course">Courses</label>
                            <?php echo "<input type='text' name='course'  value='".$rows['courses']."' class='form-control' placeholder='12345678D'>" ?>
                          </div>
                          <div class="form-group">
                            <div class="form-group">
                              <label for="sel1">User Role</label>
                              <select class="form-control" name="role" id="role">
                                <option value="Staff">Staff</option>
                              </select>
                            </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </body>
</html>