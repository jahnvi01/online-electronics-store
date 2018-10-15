<?php 
include 'function/function.php';
?>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
            crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

    </head>
    
    <body>
	<div class="main_wrapper">
    <div class="row menubar">
    <div class="col-md-2">
<img id="logo" src="images/logo.svg" width="150" height="50">
</div>
<div class="col-md-7">
<ul class="menu-list">
        <li><a href="index.php">Home</a></li>
        <li> <a href="myacc.php">My Account</a></li>
        <li><a href="register.php">Sign up</a></li>
        <li class="login"> 
<?php
if(!isset($_SESSION['c_mail'])){
echo "<a href='checkout.php'>Login</a>";
}
else{
    echo "<a href='logout.php'>Logout</a>";
}
?>
</li>
        
        <li> <a href="admin/admin.php">Admin</a></l>
        <li> <a href="#">Contact us</a></li>
</ul>


</div>
<div class="col-md-3">
<ul class="side-list">
<li><a href="cart.php" class="cart">Shopping Cart</a></li>
<br>
<li><a href="wishlist.php" class="wishlist">Wishlist</a></li>
</ul>
</div>

</div>
<div class="row content_wrapper">
    <div id="sidebar" class="col-md-2">
    <ul class="side-menu">
 <?php 
 getcats();
 ?>

     </ul>

<ul class="brands">
   <?php getbrands();?>

</ul>

</div>
<div id="content_area" class="col-md-10">

<div id="product_box">
<?php
getdetails();
?>
</div>
</div>
</div>
<div id="footer" class="row">

</div>
    </div>
	
    </body>

    </html>
<?php

function getdetails(){
    if(isset($_GET['pro_id']))
  {  global $conn;

    $pro_id=$_GET['pro_id'];

        $get_products="SELECT * FROM products WHERE product_id='$pro_id'";
    $run=mysqli_query($conn,$get_products);
    while($row=mysqli_fetch_array($run)){
      
        $pro_cat=$row['product_cat'];
        $pro_brand=$row['product_brand'];
        $pro_title=$row['product_title'];
        $pro_price=$row['product_price'];
        $pro_desc=$row['product_desc'];
        $pro_image=$row['product_image'];
        $pro_keyword=$row['product_keyword'];
        echo "<div id='single_product'>
        
        <h3 class='pro_title'>$pro_title</h3>
        <a href='admin/product_img/$pro_image'>  <img class='pro_img' width='250' height='250' src='admin/product_img/$pro_image'> </a>   
       <h4 class='pro_price'>Price: $pro_price</h4>
       <a href='index.php'>Go back</a>
       <a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to cart</button></a>
     
       </div>
       <h3>Description</h3>
       <br>
       <p class='pro_desc'>$pro_desc</p>
       </div>";
    }
}
}

?>