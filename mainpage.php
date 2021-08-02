<?php
include 'dbcon.php';
$product_sql="SELECT * FROM product";
$product_sql_query=mysqli_query($con,$product_sql);
$result=mysqli_fetch_assoc($product_sql_query);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=viewport, initial-scale=1.0">
	<title>Home Page</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style type="text/css">
	.jumbotron{
	background-color: #0d6efd ;
	color:white;
	text-align: center;
}
.navlist{
	justify-content: center;
	text-align: center;
}
ul{
	display: inline-flex;
	text-align: center;

}
li{
	list-style-type: none;
	margin-right: 10px;
	text-align: center;
}
a{
	color:inherit;
	text-transform: uppercase;
	text-decoration: none;
}
a:hover{
	color:inherit;
	text-transform: uppercase;
	text-decoration: none;
	cursor: pointer;	
}
.productdisplay{
	border: 1px solid red;
	height:auto;
}
.product{
	border: 5px solid green;
	width:25%;
	height: auto;
}
.productimg{
	display: block;
	text-align: center;
}
#btn1{
	background-color:#0d6efd;
	color:white;
	border-radius: 5px;
	text-align: center;
	height: 30px;
	cursor: pointer; 
}
</style>
</head>
<body>
<div class="container jumbotron" >
	<h1>Welcome</h1>
<div class="navlist"><ul><li><a href="">Home</a></li><li><a href="">Contact</a></li></ul></div>
</div>
<div class="container">
<div class="productdisplay">
	<div class="product">
		<div class="productimg"><a href="pages/forms/productdetail.php?id=<?php echo $result['productid'];?>"><img src="image/trimmer.jpg"></a><span><button id="btn1">Add To Cart</button></span>
		</div>
	</div>
</div>
</div>
</body>
</html>