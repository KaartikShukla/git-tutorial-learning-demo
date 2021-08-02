<?php
session_start();
include '..\..\dbcon.php';
?><!--if(isset($_SESSION['id']))
{
  header("location:..\..\index.php");
}--><?php
if(isset($_POST['signin']))
{
  if(empty($_POST['email']))
  {
    ?><div class="card-body"><div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i></h5>
                  Please Enter your Email.
                </div></div><?php
  }
  elseif(empty($_POST['password']))
  {
    ?><div class="card-body"><div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i></h5>
                  Please Enter your Password.
                </div></div><?php 
  }
  else
  {
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $fetch="SELECT * FROM registrationpage WHERE email='$email'";
    $fetch_query=mysqli_query($con,$fetch);
    $email_count=mysqli_num_rows($fetch_query);
    if($email_count)
    {
      $result=mysqli_fetch_assoc($fetch_query);
      $db_email=$result['email'];
      $db_password=$result['password'];
      $_SESSION['id']=$result['id'];
      $_SESSION['fname']=$result['fullname'];
      $_SESSION['level']=$result['level'];
      $_SESSION['email']=$result['email'];
      $_SESSION['password']=$result['password'];
      $_SESSION['retypepassword']=$result['retypepassword'];

      $passwordverify=password_verify($password,$db_password);
        if($passwordverify)
        {  
          if(isset($_POST['rememberme']))
          {
            setcookie('emailcookie',$email,time()+86400);
            setcookie('passwordcookie',$password,time()+86400);
            header("location:..\..\index.php");
          }
          else
          {
            header("location:..\..\index.php"); 
          }
        }
        else
        {?><div class="card-body">
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i></h5>
                  Please Enter the correct password. 
                </div></div><?php
        }
        
    }
    else
    {
      ?><div class="card-body">
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i></h5>
                  Please Enter a valid Email. 
                </div></div><?php    
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>MECHLIN</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="<?php if(isset($_COOKIE['emailcookie'])){echo $_COOKIE['emailcookie']; }?>"/>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" value="<?php if(isset($_COOKIE['passwordcookie'])){echo $_COOKIE['passwordcookie']; }?>"/>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="rememberme">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="signin">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
      <p class="mb-1">
        <a href="forgot-password.php">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
