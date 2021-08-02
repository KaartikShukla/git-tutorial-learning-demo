<?php
session_start();
include '..\..\dbcon.php';

if(!$_SESSION['id'])
{
  header("location:../examples/login.php");
}

if(isset($_GET['id']))
{
  $uid=$_GET['id'];
}

if(isset($_GET['id']))
{
  $uid=$_GET['id'];
  $fet="SELECT * FROM  category WHERE categoryid='$uid'";
  $fet_query=mysqli_query($con,$fet);
  $check=mysqli_num_rows($fet_query);
  if($check)
  {
    $result=mysqli_fetch_assoc($fet_query); 
  }
  else
  {
    header("location:viewcategory.php");
  }

}
if(isset($_POST['update']))
{
   $categoryname=mysqli_real_escape_string($con,$_POST['categoryname']);
   $updateid=mysqli_real_escape_string($con,$_POST['updateid']);
    $checkname="SELECT categoryname FROM category";
    $checkname_sql=mysqli_query($con,$checkname);
    $checkname_res=mysqli_fetch_assoc($checkname_sql);
    if($checkname_res['categoryname']===$categoryname)
    {
        $checkname_msg="Duplicate Category Name";
        header("refresh:1; url=viewcategory.php");
    }
    else
    {
       $update_sql="UPDATE category SET categoryname='$categoryname' WHERE categoryid='$updateid'";
       $update_sql_query=mysqli_query($con,$update_sql);
        if($update_sql_query)
        {
          $update_success="Category Name Successfully Updated";
          header("refresh:0; url=viewcategory.php");
        }
        else
        {
          $update_fail="OOPS !! Something Went wrong";
        } 
    }
 }   
   
if(isset($_POST['back']))
{
  header("location:..\..\index.php");
}
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Add Form Elements</title>

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
        <a href="../../index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="https://mechlintech.com/" target="blank" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><strong>MECHLIN</strong></span>
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

    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          
          <li class="nav-item menu-open">
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="view.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View User</p>
                </a>
              </li>
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
              
            <li class="nav-item">
              <a href="../examples/logout.php" class="nav-link">
                <i class="fa fa-sign-out-alt nav-icon"></i>
                <p>Logout</p>
              </a>
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
              <li class="breadcrumb-item active">Add Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->  
      <div class="container" style="width:50%; min-height:400px; max-height:600px; position: relative;"!important>
            <div class="container-fluid bg-primary text-white rounded" style="margin-bottom:5px;"!important ><h1 style="font-size: 30px;">Add Category</h1></div>
              <?php 
                         if(isset($update_success)){?>
                        <div class="card-body" style="width: 100% ;">
                        <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i></h5>
                        <?php echo $update_success; ?>
                        </div><div><?php } 

                         if(isset($update_fail))
                          {?><div class="card-body" style="width: 100% ;">
                        <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i></h5>
                        <?php echo $update_fail?>
                        </div></div><?php }

                        if(isset($checkname_msg))
                          {?><div class="card-body" style="width: 100% ;">
                        <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i></h5>
                        <?php echo $checkname_msg;?>
                        </div></div><?php } ?>

                        <?php
                         $category_name=(isset($_POST['categoryname']) ? $_POST['categoryname']:'' );
                         ?>
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
                    <div class="form-group">
                        <label class=" mb-1" for="inputFirstName">Category Name</label>
                        <div class="fontuser" style="position:relative;">
                        <span class="fa fa-list-alt" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius:20px; padding-left: 30px;" id="inputFirstName" type="text" placeholder="Enter Category name" name="categoryname" value="<?php echo $result['categoryname'];?>"/></div>
                    </div> 
                    <input type="hidden" name="updateid" value="<?php echo $result['categoryid'];?>">                 
                    <div class="form-row"><div style="margin-left:10rem; margin-right:5rem;"><button type="submit" class="btn btn-primary btn-block" style="width:100px; box-shadow: 2px 3px #007bff;"  name="update">Update</button></div><div ><button type="back" class="btn btn-primary btn-block" style="width:100px;box-shadow: 2px 3px #007bff;" name="back">BACK</button></div>
                </form>
                </div>
                </section>  
                </div>   
    <!-- Main content -->
      <!-- /.content-wrapper -->

<div class="container-fluid"> <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://mechlintech.com/" target="blank">MECHLIN</a></strong> All rights reserved.
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
`