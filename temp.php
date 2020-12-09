if($rows['Email'] != $email){
                    $emailErr = "<div class='alert alert-warning' role='alert'><strong>The Email does not exist</strong></div>";
                }
                if($rows['Password'] != $password){
                    $passwordErr = "<div class='alert alert-warning' role='alert'><strong>The Password does not match</strong></div>";
                }