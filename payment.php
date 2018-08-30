

<?php 
include 'function/function.php';
session_start();
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
        <li><a href="cart.php">Shopping Cart</a></li>
        <li> <a href="admin/admin.php">Admin</a></l>
        <li> <a href="#">Contact us</a></li>

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
<div>
<h2 style="text-align:center;">Complete Your Payment with PapPal!!!</h2>
<p style="text-align:center;"><img src="images/pay.jpeg" width="180" height="180"></p>


</div>

</div>
<div id="product_box">

</div>
</div>
</div>
<div id="footer" class="row">

</div>
    </div>
	
    </body>

    </html>