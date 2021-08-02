<?php
 include'..\..\dbcon.php';
if(isset($_POST['register']))
{ 
  if(empty($_POST['fullname'])||empty($_POST['email'])||empty($_POST['password'])||empty($_POST['retypepassword']))
  {
      ?><div class="card-body"><div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i> Alert!</h5>
                  Please Fill All the fields.
                </div></div><?php header("refresh:1;url=register.php");
  }
  else
  {
      if(isset($_POST['terms']))
      {
        $full_name=mysqli_real_escape_string($con,$_POST['fullname']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $password=mysqli_real_escape_string($con,$_POST['password']);
        $retype_password=mysqli_real_escape_string($con,$_POST['retypepassword']);
        $checkbox=mysqli_real_escape_string($con,$_POST['terms']);
        $level=mysqli_real_escape_string($con,$_POST['level']);
        $tokens=bin2hex(random_bytes(15));
        $new_password=password_hash($password,PASSWORD_BCRYPT);
        $new_retype_password=password_hash($retype_password,PASSWORD_BCRYPT);
        $filter_email= filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($filter_email, FILTER_VALIDATE_EMAIL) === false)
        {
            $check="SELECT * FROM registrationpage WHERE email='$filter_email'";
            $check_query=mysqli_query($con,$check);
            $emailcount=mysqli_num_rows($check_query);
              if($emailcount>0)
              {
                ?><div class="card-body"><div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i></h5>
                  Email Already Exists.
                </div></div><?php  header("refresh:1;url=register.php");
              }
              else
              {
                if($password===$retype_password)
                {
                  $insert="INSERT INTO registrationpage (fullname, email, password, retypepassword, checkbox, level,tokens) VALUES ('$full_name','$filter_email','$new_password','$new_retype_password','$checkbox','$level','$tokens')";
                  $insert_query=mysqli_query($con,$insert);
                    if($insert_query)
                    {
                      ?><div class="card-body"><div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i></h5>
                  You have registered succesfully.
                </div>
              </div></script><?php
                      header("refresh:1;url=login.php");
                    }
                    else
                    {
                      ?><div class="card-body">
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i></h5>
                  OOPS! Something went wrong.
                </div></div><?php  header("refresh:1;url=register.php");
                    }
                }
                else
                {
                  ?><div class="card-body"><div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                  Password not Matching
                </div></div><?php 
                }
              }
        }      
        else
        {
            ?><div class="card-body"><div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                  Please Enter a valid Email.
                </div></div><?php 
        }
      }
      else
      {
        ?><div class="card-body"><div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> </h5>
                  Please Tick the Check Box.
                </div></div><?php 
      }
  }   
}
mysqli_close($con);
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>MECHLIN</b></a>
  </div>

  <div class="card" >
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="fullname">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="retypepassword">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <input type="hidden" value="Staff" name="level">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

      
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
