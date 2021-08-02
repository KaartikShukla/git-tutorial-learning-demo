<?php
session_start();
include '..\..\dbcon.php';
if(!$_SESSION['id'])
{
    header("location:../examples/login.php");
}
if(isset($_GET['id']))
{
  $pid=$_GET['id'];
  $sql="SELECT * FROM  product Where productid='$pid'";
  $sql_query=mysqli_query($con,$sql);
  $row=mysqli_fetch_assoc($sql_query);
}

if(isset($_POST['back']))
{
    header("location:..\..\index.php");   
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | View product Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <style type="text/css">
    table{
      width:100%;
      border:2px solid #007bff ;
      table-layout: auto;
      font-size: 20px;
    }
    tr{
      text-align: center;
    }
    tr:hover{
      background-color: black;
      color:white;
      opacity: 0.4;
    }
  </style>
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

    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="https://mechlintech.com/" class="brand-link">
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

      <!-- SidebarSearch Form -->
      
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
              <li class="breadcrumb-item active"> Product Description</li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid --> 
<div class="container">
  <div class="container-fluid bg-primary text-white text-center rounded"style=" margin-bottom:30px;"!important><h1 style="font-size: 50px;">Product Description</h1>
  </div>
  <div class="productdescription">
      <div style=""><img src="<?php echo $row['image'];?>" style="width: 100%; height: 600px;">
      </div> 
      <div>
        <table>
          <tr>
            <th>Product Status</th> 
            <th><?php if($row['productstatus']==1){ echo "ACTIVE";} else{echo "DEACTIVE";}?></th>
          </tr>
          <tr>
            <th>Product Name:</th> 
            <td><?php echo $row['productname'];?></td>
          </tr>
          <tr>
            <th>Product Category:</th> 
            <td><?php $category_sql="SELECT categoryname FROM category where categoryid='".$row['categoryid']."'";
                              $res=mysqli_query($con,$category_sql);
                                $rows=mysqli_fetch_assoc($res);  echo $rows['categoryname'];?></td>
          </tr>
          <tr>
            <th>Product MRP:</th> 
            <td><?php echo $row['productmrp'];?></td>
          </tr>
          <tr>
            <th>Product Price:</th> 
            <td><?php echo $row['productprice'];?></td>
          </tr>
          <tr>
            <th>Product Quantity:</th> 
            <td><?php echo $row['quantity'];?></td>
          </tr>
          <tr>
            <th>Product  Description:</th> 
            <td><?php echo $row['shortdescription'];?></td>
          </tr>
          <tr>
            <th>Product Details:</th> 
            <td><?php echo $row['longdescription'];?></td>
          </tr>
          <tr>
            <th>Meta Title:</th> 
            <td><?php echo $row['metatitle'];?></td>
          </tr>
          <tr>
            <th>Meta Keyword:</th> 
            <td><?php echo $row['metakeyword'];?></td>
          </tr>
          <tr>
            <th>Meta Description:</th> 
            <td><?php echo $row['metadescription'];?></td>
          </tr>
        </table>
      </div>
  </div>
</section>      
</div>
 <div class="container-fluid"> <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://mechlintech.com/">MECHLIN</a>.</strong> All rights reserved.
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
 
