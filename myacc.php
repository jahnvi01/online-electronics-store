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
    <li><a href="#">My orders</a></li>
<li><a href="#">Edit account</a></li>
<li><a href="#">Change password</a></li>
<li><a href="#">Delete account</a></li>

     </ul>


</div>
<div id="content_area" class="col-md-10">
   
<div class="login"> 
<?php
if(!isset($_SESSION['c_mail'])){
echo "<a href='checkout.php'>Login</a>";
}
else{
    echo "<a href='logout.php'>Logout</a>";
}
?>
</div>
<div id="product_box">
<?php
$user=$_SESSION['c_mail'];
$info="SELECT * FROM customers WHERE C_mail='$user'";

$run=mysqli_query($conn,$info);
while($row=mysqli_fetch_array($run)){
    $name=$row['c_name'];
    $country=$row['c_country'];
    $city=$row['c_city'];
    $contact=$row['c_contact'];
    $address=$row['c_address'];
    echo"<h3>Hello $name<h3>
    <h3>e-mail: $user<h3>
    <h3>country: $country<h3>
    <h3>city:  $city<h3>
    <h3>Contact: $contact<h3>
    <h3>address:  $address<h3>    
    
    ";

}


?>
</div>
</div>
</div>
<div id="footer" class="row">

</div>
    </div>
	
    </body>

    </html>