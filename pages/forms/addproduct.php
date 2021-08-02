<?php
session_start();
include '..\..\dbcon.php';

if(!$_SESSION['id'])
{
  header("location:../examples/login.php");
}
if (isset($_POST['add'])) 
{
  $required=array('productname','category','productmrp','productprice','productqty','image','shortdesc','longdesc','metakeyword','metatitle','metadesc'); 
  foreach ($required as $field)
   {
    if(empty($_POST[$field]))
    {
      $error=1;
    }
    else
    {
      $error=0;
    }
  }
  if($error==1)
  {
    $first_error="All Fields are Required";
  }
  else
  {
    $productname=mysqli_real_escape_string($con,$_POST['productname']);
    $category=mysqli_real_escape_string($con,$_POST['category']);
    $productmrp=mysqli_real_escape_string($con,$_POST['productmrp']);
    $productprice=mysqli_real_escape_string($con,$_POST['productprice']);
    $productqty=mysqli_real_escape_string($con,$_POST['productqty']);
    $shortdesc=mysqli_real_escape_string($con,$_POST['shortdesc']);
    $longdesc=mysqli_real_escape_string($con,$_POST['longdesc']);
    $metatitle=mysqli_real_escape_string($con,$_POST['metatitle']);
    $metadesc=mysqli_real_escape_string($con,$_POST['metadesc']);
    $productstatus=mysqli_real_escape_string($con,$_POST['productstatus']);
    $metakeyword=mysqli_real_escape_string($con,$_POST['metakeyword']);
    $image=$_FILES['image'];
    $filename=$image['name'];
    $filetmp=$image['tmp_name'];
    $fileext=explode('.',$filename);
    $filecheck=strtolower(end($fileext));
    $fileextstored=array('png','jpg','jpeg');
    if(in_array($filecheck,$fileextstored)){
    $destinationfile='../../image/'.$filename;
    move_uploaded_file($filetmp, $destinationfile);
      $add_product="INSERT INTO product (categoryid, productname, productmrp, productprice, quantity, image, productstatus, shortdescription, longdescription, metatitle, metadescription, metakeyword) VALUES ('$category','$productname','$productmrp','$productprice','$productqty','$destinationfile','$productstatus','$shortdesc','$longdesc','$metatitle','$metadesc','$metakeyword')";
      $add_product_sql=mysqli_query($con,$add_product);
      if($add_product_sql)
      {
          $add_success="Product added Successfully";
          header("refresh:1;url=addproduct.php");
      }
      else
      {
          $add_fail="OOPS!! Something Went Wrong";
      }
    }
    else
    {
      $warning_picture_extension="Image Should have only JPEG/JPG & PNG format";
    }
  }
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
  <title>AdminLTE 3 | Add Product</title>

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
              <li class="breadcrumb-item active">Add Product Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->  
      <div class="container" style="width:50%; min-height:400px; max-height:auto; position: relative;"!important>
            <div class="container-fluid bg-primary text-white rounded" style="margin-bottom:5px;"!important ><h1 style="font-size: 30px;">Add Product</h1></div>
              <?php 
                  if(isset($first_error))
                    {?>
                        <div class="card-body" style="width: 100% ;">
                        <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i></h5>
                        <?php echo $first_error;?>
                        </div></div><?php }

                  if(isset($warning_picture_extension))
                      {?><div class="card-body" style="width: 100% ;">
                        <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
                        <?php echo $warning_picture_extension;?>
                        </div></div><?php }
                        
                  if(isset($add_success)){?>
                        <div class="card-body" style="width: 100% ;">
                        <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i></h5>
                        <?php echo $add_success; ?>
                        </div><div><?php }
                  if(isset($add_fail))
                          {?><div class="card-body" style="width: 100% ;">
                        <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i></h5>
                        <?php echo $add_fail;?>
                        </div></div><?php } ?>
                        <?php
                         $product_name=(isset($_POST['productname']) ? $_POST['productname']:'' );
                         $category=(isset($_POST['Category']) ? $_POST['category']:'' );
                         $productmrp=(isset($_POST['productmrp']) ? $_POST['productmrp']:'' );
                         $productprice=(isset($_POST['productprice']) ? $_POST['productprice']:'' );
                         $productqty=(isset($_POST['productqty']) ? $_POST['productqty']:'' );
                         $shortdesc=(isset($_POST['shortdesc']) ? $_POST['shortdesc']:'' );
                         $longdesc=(isset($_POST['longdesc']) ? $_POST['longdesc']:'' );
                         $metakeyword=(isset($_POST['metakeyword']) ? $_POST['metakeyword']:'' );
                         $metatitle=(isset($_POST['metatitle']) ? $_POST['metatitle']:'' );
                         $metadesc=(isset($_POST['metadesc']) ? $_POST['metadesc']:'' );
                         ?>
          <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class=" mb-1" for="inputFirstName">Product Name</label>
                        <div class="fontuser" style="position:relative;">
                        <span class="fab fa-product-hunt" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius:20px; padding-left: 30px;" id="inputFirstName" type="text" placeholder="Enter product name" name="productname" value="<?php echo $product_name;?>"/></div>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="">Select Category</label>
                        <div class="fontuser" style="position:relative;">
                          <span class="fa fa-angle-down" style="position:absolute; margin-top: 20px;padding-left:10px;"></span>
                        <select class="py-3" style="border-radius:20px; padding-left: 30px; width: 100%" id="inputCategory" aria-describedby="" name="category"/>
                        <option selected value="Null">Select Category</option>
                        <?php
                          $category_sql="SELECT * FROM category ORDER BY categoryname ASC";
                          $res=mysqli_query($con,$category_sql);
                         while ($row=mysqli_fetch_assoc($res)) {
                            echo "<option value='".$row['categoryid']."'>".$row['categoryname']."</option>";
                        } ?>
                      </select></div>
                    </div>                  
                    <div class="form-group">
                        <label class="mb-1" for="inputEmailAddress">Product MRP</label>
                        <div class="fontuser" style="position:relative;">
                          <span class="fa fa-tags" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius:20px; padding-left: 30px;" id="inputProductmrp" type="text" aria-describedby="emailHelp" placeholder="Product MRP" name="productmrp" value="<?php echo $productmrp;?>"/></div>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="inputEmailAddress">Product Price</label>
                        <div class="fontuser" style="position:relative;">
                          <span class="fa fa-money-bill-wave-alt" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius:20px; padding-left: 30px;" id="inputProductprice" type="text" aria-describedby="emailHelp" placeholder="Enter Product Price" name="productprice" value="<?php echo $productprice;?>"/></div>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="">Product Quantity</label>
                        <div class="fontuser" style="position:relative;">
                          <span class="fa fa-sort-amount-up" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius:20px; padding-left: 30px;" id="inputPassword" type="text" placeholder="Enter Product Quantity" name="productqty" value="<?php echo $productqty;?>"/></div>
                    </div>
                    <div class="form-group">
                        <label class=" mb-1" for="">Product Image </label>
                        <div class="fontuser" style="position:relative;">
                          <span class="fa fa-image" style="position:absolute; margin-top: 20px;padding-left:10px;"></span>
                        <input class="form-control py-3" style=" height:auto;border-radius:20px; padding-left: 30px"; id="inputConfirmPassword" type="file" name="image" value=""/></div>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="">Product Short Description</label>
                        <div class="fontuser" style="position:relative;">
                          <span class="fa fa-pencil-alt" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius:20px; padding-left: 30px;" id="inputPassword" type="text" placeholder="Enter Product Short Description" name="shortdesc" value="<?php echo $shortdesc;?>"/></div>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="">Product Full Description</label>
                        <div class="fontuser" style="position:relative;">
                          <span class="fa fa-pen-alt" style="position:absolute; margin-top: 30px;padding-left:10px;"></span>
                        <textarea class="form-control py-3" style="border-radius:20px; padding-left: 30px;" id="inputPassword" placeholder="Enter Product Full Description" name="longdesc"/><?php echo $longdesc;?></textarea></div>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="">Product Meta Keyword</label>
                        <div class="fontuser" style="position:relative;">
                          <span class="fa fa-search-dollar" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius:20px; padding-left: 30px;" id="metaKeyword" type="text" placeholder="Enter Product Meta Keyword" name="metakeyword" value="<?php echo $metakeyword; ?>"/></div>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="">Product Meta Title</label>
                        <div class="fontuser" style="position:relative;">
                          <span class="fa fa-search-location" style="position:absolute; margin-top: 10px;padding-left:10px;"></span>
                        <input class="form-control py-3" style="border-radius:20px; padding-left: 30px;" id="metaTitle" type="text" placeholder="Enter Product Meta Title" name="metatitle" value="<?php echo $metatitle; ?>"/></div>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="">Product Meta Description</label>
                        <div class="fontuser" style="position:relative;">
                          <span class="fa fa-highlighter" style="position:absolute; margin-top: 30px;padding-left:10px;"></span>
                        <textarea class="form-control py-3" style="border-radius:20px; padding-left: 30px;" id="metaDesc" placeholder="Enter Product Meta Description" name="metadesc" value="<?php echo $metadesc?>"/></textarea></div>
                    </div>
                    <input type="hidden" name="productstatus" value="1">
                    <div class="form-row"><div style="margin-left:10rem; margin-right:5rem;"><button type="submit" class="btn btn-primary btn-block" style="width:100px; box-shadow: 2px 3px #007bff;"  name="add">ADD</button></div><div ><button type="back" class="btn btn-primary btn-block" style="width:100px;box-shadow: 2px 3px #007bff;" name="back">BACK</button></div>
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
