<?php
session_start();
include '..\..\dbcon.php';
if(!$_SESSION['id'])
{
    header("location:../examples/login.php");
}
if(isset($_POST['back']))
{
    header("location:..\..\index.php");   
}

if(isset($_GET['id']))
{
  $Uid=$_GET['id'];
  $fet="SELECT * FROM  registrationpage WHERE id='$Uid'";
  $fet_query=mysqli_query($con,$fet);
  $result=mysqli_fetch_assoc($fet_query);
}
if(isset($_POST['update']))
{
  if($_SESSION['level']=='Admin')
  {
    $fname=mysqli_real_escape_string($con,$_POST['fullname']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $level=mysqli_real_escape_string($con,$_POST['level']);
    $new_password=mysqli_real_escape_string($con,$_POST['password']);
    $retype_password=mysqli_real_escape_string($con,$_POST['retypepassword']);
    if(empty($_POST['password']) && empty($_POST['retypepassword']))
    {
      $nipass=$result['password'];
      $ripass=$result['retypepassword'];
    }
    else
    {
    
    $nipass=password_hash($new_password,PASSWORD_BCRYPT);
    $ripass=password_hash($retype_password,PASSWORD_BCRYPT);
    }
    $filter_email=filter_var($email,FILTER_SANITIZE_EMAIL);
    if(!filter_var($filter_email,FILTER_VALIDATE_EMAIL)===false)
    {
      if($new_password===$retype_password)
      {
        $fetch="SELECT * FROM  registrationpage WHERE id='$Uid'";
        $fetch_query=mysqli_query($con,$fetch);
        $result=mysqli_fetch_assoc($fetch_query);
        if($fetch_query)
        {
          $update="UPDATE registrationpage SET fullname='$fname',email='$email',level='$level',password='$nipass',retypepassword='$ripass' WHERE id='$Uid' ";
          $update_query=mysqli_query($con,$update);
          if($update_query)
          {
            $update_success="Updated Successfully";
            header("refresh:1;url=view.php");  
          }
          else
          {
           $update_fail="OOPS! Something went wrong";
           header("location:view.php");
          }
        }
        else
        {
          $id_not_found="Id Not Found";
        }
      }
      else
      {
        $pass_fail="Password are not matching";
      }
     
    }  
    else
    {
      $valid_eamil="Enter a valid Email";
    }  
  }
  else
  {
    $id=$_SESSION['id'];
    $fname=mysqli_real_escape_string($con,$_POST['fullname']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $new_password=mysqli_real_escape_string($con,$_POST['password']);
    $retype_password=mysqli_real_escape_string($con,$_POST['retypepassword']);
    if(empty($_POST['password']) && empty($_POST['retypepassword']))
    {
      $nipass=$result['password'];
      $ripass=$result['retypepassword']; 
    }
    else
    {
    
    $nipass=password_hash($new_password,PASSWORD_BCRYPT);
    $ripass=password_hash($retype_password,PASSWORD_BCRYPT);

    }
    $filter_email=filter_var($email,FILTER_SANITIZE_EMAIL);
      if(!filter_var($filter_email,FILTER_VALIDATE_EMAIL)===false)
      {
          $fetch="SELECT * FROM  registrationpage WHERE id='$id'";
          $fetch_query=mysqli_query($con,$fetch);
          if($new_password===$retype_password)
          {
            if($fetch_query)
            {
              $update="UPDATE registrationpage SET fullname='$fname',email='$email',password='$nipass',retypepassword='$ripass' WHERE id='$id' ";
              $update_query=mysqli_query($con,$update);
                if($update_query)
                {
                  $update_success="Updated Successfully";
                  header("refresh:1;update.php");
                  
                }
                else
                {
                  $update_fail="OOPS! Something went wrong"; 
                  header("location:view.php");
                }
            }
           else
            {
              $id_not_found="ID Not Found";
              header("location:view.php");
            }
          }
          else
          {
            $pass_fail="Password are not Matching";
          }
      }  
      else
      {
       $valid_eamil="Enter a valid Email";
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
  <title>AdminLTE 3 | Update Form Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="..\..\index.php" class="nav-link">Home</a>
      </li>
    
    </ul>

    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="https://mechlintech.com/" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MECHLIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="update.php?id=<?php echo $_SESSION['id']?>" class="d-block" value="iconclick"><?php echo $_SESSION['fname'];?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          
          <li class="nav-item menu-open">
            
            <?php if($_SESSION['level']!='Admin')
            {?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../forms/update.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update User</p>
                </a>
              </li>
               <li class="nav-item">
              <a href="../examples/logout.php" class="nav-link">
                <i class="fa fa-sign-out-alt nav-icon"></i>
                <p>Logout</p>
              </a>
            </li>
            <?php }?>
            <?php if($_SESSION['level']!='Admin')
            {?>
              <li class="nav-item invisible">
                <a href="add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <?php }
              else{?>
                <li class="nav-item">
                <a href="add.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
                <?php } ?>
              <?php if($_SESSION['level']!='Admin')
            {?>
              <li class="nav-item invisible">
                <a href="view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View User</p>
                </a>
              </li>
              <?php }
              else{ ?><li class="nav-item ">
                <a href="view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View User</p>
                </a>
              </li>
              <?php }?>
               <?php if($_SESSION['level']!='Admin')
                {?>
              
              <?php }
              else{ ?><li class="nav-item ">
                <a href="addcategory.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <?php } ?>
              <?php if($_SESSION['level']!='Admin')
                {?>
              
              <?php }
              else{ ?><li class="nav-item ">
                <a href="viewcategory.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Category</p>
                </a>
              </li>
              <?php } ?>
                <?php if($_SESSION['level']!='Admin')
                {?>
              <?php }  
              else{ ?><li class="nav-item ">
                <a href="addproduct.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
            <?php } ?>
            <?php if($_SESSION['level']!='Admin')
                {?>
              <?php }  
              else{ ?><li class="nav-item ">
                <a href="viewproduct.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Product</p>
                </a>
              </li>
            <?php } ?>
            </ul>
            <?php if($_SESSION['level']!='Admin'){?>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item invisible">
              <a href="../examples/logout.php" class="nav-link">
                <i class="fa fa-sign-out-alt nav-icon"></i>
                <p>Logout</p>
              </a>
            </li>
            </ul>
          <?php } else{?><ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item visible">
              <a href="../examples/logout.php" class="nav-link">
                <i class="fa fa-sign-out-alt nav-icon"></i>
                <p>Logout</p>
              </a>
            </li>
            </ul>

          <?php } ?>
          </li>
         </ul> 
  </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="..\..\index.php">Home</a></li>
              <li class="breadcrumb-item active">Update Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->  
      
      <div class="container" style="width:50%; min-height:400px; max-height: 800px;"!important>
            <div class="container-fluid bg-primary text-white rounded"><h1 style="margin-top:5px;">Update User</h1>
            </div>
            <?php if(isset($update_success))
            {?><div class="card-body">
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i></h5>
                  <?php echo $update_success;?>
                </div>
              </div><?php } 
              if(isset($update_fail))
              {
                ?><div class="card-body">
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i></h5>
                  <?php echo $update_fail;?> 
                </div></div><?php }
              if(isset($id_not_found))
              {
                ?><div class="card-body"> <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                  <?php echo $id_not_found; header("refresh:1;url=view.php"); ?>
                </div></div><?php }
              if(isset($valid_eamil))
              {
                ?><div class="card-body">
                <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                  <?php echo $valid_eamil;?>
                </div></div><?php }
                if(isset($pass_fail)){?>
                  <div class="card-body">
                <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                  <?php echo $pass_fail;?>
                </div></div><?php }
                ?>
                <form method="POST">
                      <?php if($_SESSION['level']=='Admin'){ ?>
                        <div class="form-group">
                        <label class=" mb-1" for="inputFirstName">Full Name</label>
                         <div class="fontuser" style="position:relative;">
                        <span class="fa fa-user" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius: 20px; padding-left: 30px;" id="inputFirstName" type="text" placeholder="Enter full name" name="fullname" value="<?php echo $result['fullname'];?>"/></div>
                    </div>
                    <?php } 
                    else { ?>
                      <div class="form-group">
                        <label class="mb-1" for="inputFirstName">Full Name</label>
                        <div class="fontuser" style="position:relative;">
                        <span class="fa fa-user" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius: 20px; padding-left: 30px;" id="inputFirstName" type="text" placeholder="Enter full name" name="fullname" value="<?php echo $_SESSION['fname'];?>"/></div>
                    </div><?php 
                  } ?>
                  <?php if($_SESSION['level']=='Admin'){ ?>
                  <div class="form-group">
                        <label class=" mb-1" for="inputEmailAddress">Email</label>
                        <div class="fontuser" style="position:relative;">
                        <span class="fa fa-envelope" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius: 20px; padding-left: 30px"; id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" value="<?php echo $result['email'];?>"/></div>
                    </div><?php }
                    else{ ?>
                    <div class="form-group">
                        <label class="mb-1" for="inputEmailAddress">Email</label>
                        <div class="fontuser" style="position:relative;">
                        <span class="fa fa-envelope" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius: 20px; padding-left:30px;" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" value="<?php echo $_SESSION['email'];?>"/></div>
                    </div><?php } ?>
                    <div class="form-group">
                        
                        <?php if($_SESSION['level']!='Admin'){?>
                        <?php }
                        else
                        {?>
                        <label class="mb-1" for="inputUser" style="margin-right:10rem;">User</label>  
                        <?php if($result['level']!='Admin'){?>
                        <input class=" small py-4" id="inputUser" type="radio" aria-describedby="userHelp"name="level" Value="Staff"checked/>Staff
                        <span>
                        <input class=" py-4" style="margin-left: 10rem;" id="inputUser"type="radio" aria-describedby="userHelp" name="level" Value="Admin"/>Admin
                        </span><?php }
                        else { ?>
                        <input class=" small py-4" id="inputUser" type="radio" aria-describedby="userHelp"name="level" Value="Admin" checked/>Admin
                        <span>
                        <input class=" py-4" style="margin-left: 10rem;" id="inputUser"type="radio" aria-describedby="userHelp" name="level" Value="Staff"/>Staff
                        </span><?php } ?>
                        <?php }?> 
                        
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="inputPassword">Password</label>
                        <div class="fontuser" style="position:relative;">
                        <span class="fa fa-lock" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius: 20px; padding-left: 30px;" id="inputPassword" type="Password" placeholder="Enter Password" name="password"/></div>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="inputRetypepassword">Retype Password</label>
                        <div class="fontuser" style="position:relative;">
                        <span class="fa fa-lock" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius: 20px; padding-left: 30px;" id="inputRetypepassword" type="Password" placeholder="Re Enter Password " name="retypepassword"/></div>
                    </div>
                    <div class="form-row"><div style="margin-left:10rem; margin-right:5rem;"><button type="submit" class="btn btn-primary btn-block" style="box-shadow: 2px 3px #007bff;" name="update">UPDATE</button></div><div ><button type="back" class="btn btn-primary btn-block" style="box-shadow: 2px 3px #007bff;"  name="back">BACK</button></div>
                </form>
              </section>  
    </div>   
    <!-- Main content -->
      <!-- /.content-wrapper -->

<div class="container-fluid"> <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://mechlintech.com/">MECHLIN</a></strong> All rights reserved.
  </footer></div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
