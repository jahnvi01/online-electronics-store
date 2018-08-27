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
        <li>Home</li>
      
        <li>My Account</li>
        <li>Sign up</li>
        <li>Shopping Cart</li>
        <li>Contact us</li>


</ul>
</div>

<form class="col-md-3" id="form">
<input type="text" name="user_query" placeholder="search a product" >
<input type="submit" name="search" value="search">

</form>

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
    <div id="shop_cart">
<h4><a href="cart.php" class="cart">Go to cart</a></h4>
</div>
<?php
addcart();
?>

<div id="product_box">
<?php
getproducts();
showcats();
showbrands();
searchproducts();
?>
</div>
</div>
</div>
<div id="footer" class="row">

</div>
    </div>
	
    </body>

    </html>