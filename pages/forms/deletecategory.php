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
            $uid=$_GET['id'];
            $delete="DELETE FROM  category WHERE categoryid='$uid'";
              $delete_query=mysqli_query($con,$delete);
              if($delete_query)
                 {

                  $delete_success="Deleted Successfully";
                  
                  header("refresh:0;url=viewcategory.php");
                 }
            else
            {
            $delete_fail="OOPS! Something went wrong";
            header("refresh:0;url=viewcategory.php");  
          }        
  }
          
?>