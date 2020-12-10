<?php include_once('..\Authentication\db_connect.php'); ?>

<div class="card">
   <div class="card-header">
        <h3 class='text-center'>Add New Staff</h3>
    </div>
        <div class="card-body">
            <div style="width:600px; margin:0px auto">
            <form class="" action="" method="post">
                <div class="form-group pt-3">
                    <label for="LoginID">Login ID</label>
                    <input type="text" name="LoginID"  class="form-control" placeholder="12345678D">
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username"  class="form-control" placeholder="John Doe">
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" name="email"  class="form-control" placeholder="JohnDoe@domain.com">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                  <label for="course">Course</label>
                  <input type="text" name="course" class="form-control">
                </div>
                <div class="form-group">
                  <div class="form-group">
                    <label for="sel1">Select user Role</label>
                    <select class="form-control" name="role" id="role">
                      <option value="Staff">Staff</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="addUser" class="btn btn-success">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>