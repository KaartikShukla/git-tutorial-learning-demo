<?php 
include '..\..\dbcon.php';
if(empty($_POST['newpassword']))
{
  $passnotfill=" New Password Field is blank";
}
if(empty($_POST['retypepassword']))
{
 $repassnotfill ="Retype Password Field is blank";
}
if(isset($_POST['changepassword']))
{
  if(isset($_GET['token']))
  {
    $tok=mysqli_real_escape_string($con,$_GET['token']);
    $npass=mysqli_real_escape_string($con,$_POST['newpassword']);
    $cpass=mysqli_real_escape_string($con,$_POST['confirmpassword']);
    $nhasspass=password_hash($npass,PASSWORD_BCRYPT);
    $chasspass=password_hash($cpass,PASSWORD_BCRYPT);
      if($npass===$cpass)
      { 
        $update="UPDATE registrationpage SET password='$nhasspass',retypepassword='$chasspass' WHERE tokens='$tok'";
        $update_query=mysqli_query($con,$update);
        if($update_query)
        {
          $update_success="Password Updated Successfully";
        }
        else
        {
          $update_fail="Password Not Updated";
        }

      }
      else
      {
        $mismatch="Password are Not Matching";
      }

  }
  else
  {
    $no_token="Token Not Found";
    header("refresh:1;url=login.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Recover Password</title>

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
    <a href="#"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
      <?php if(isset($update_success))
      {?><div class="card-body">
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i></h5>
                  <?php echo $update_success;?>
                </div>
              </div><?php }?> 
              <?php
              if(isset($update_fail)){?>
                div class="card-body">
                <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                <?php echo $update_fail;?>
                </div></div><?php }?>
                <?php
                if(isset($mismatch)){?>
                  <div class="card-body">
                <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                  <?php echo $mismatch;?>
                </div></div><?php }?>
                <?php
                if(isset($no_token)){?>
                <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                <?php echo $no_token;?>
                </div></div><?php }
                if(isset($passnotfill)){?>
                 <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                <?php echo $passnotfill;?>
                </div></div><?php }
                if(isset($repassnotfill)){?>
                  <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                <?php echo $repassnotfill;?>
                </div></div><?php }?>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="newpassword">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="changepassword">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
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
