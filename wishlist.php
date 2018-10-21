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
<div id='content_area' class='col-md-10'>
<?php


?>

<div id="product_box">
<?php

addwish();
?>
<form action="" method="post" enctype="multipart/form-data">
<table align="center" width="700" bgcolor="skyblue">
<tr align="center">
<td colspan="5"><h2>Wishlist</h2></td>
</tr>
<tr align="center">
<th>Remove</th>
<th>Product</th>
<th></th>
<th></th>
</tr>
<?php
showbrands();
showcats();

showwishlist();

 ?>
 </table>

<div class="buttons">
 <input value="Continue" name="continue" type="submit">
 <input type="submit" value="Remove" name="update">
</div>
</form>


</div>
</div>
</div>

    </div>

    </body>
 
    </html>

    <?php
    function addwish() 
    { 
        
        $id=$_GET['pro_id'];
        $user=$_SESSION['c_mail'];
     global $conn;
    if(isset($_GET['pro_id']))
    { 
        //header("location:index.php"); 
        if(isset($_SESSION['c_mail'])){
            
        $check="SELECT * FROM wishlist WHERE email='$user' AND p_id='$id' ";
        $run=mysqli_query($conn,$check);
       
            if(mysqli_num_rows($run)==0){
               
                $add="INSERT INTO wishlist (p_id,email) VALUES ('$id','$user')";
                $r=mysqli_query($conn,$add);
             
               
            }
        
     
    }
    else{
        header("location:checkout.php");   
    }
    }
    
    }
    
    function showwishlist()
    {
                $user=$_SESSION['c_mail'];
        global $conn;
        $product="SELECT * FROM wishlist WHERE email='$user'";
        $result=mysqli_query($conn,$product);
        while($rw=mysqli_fetch_array($result)){
           $pro=$rw['p_id'];      
           $list="SELECT * FROM products WHERE product_id='$pro'";
           $result1=mysqli_query($conn,$list);
           while($row1=mysqli_fetch_array($result1)){
              $id1=$row1['product_id'];
               $price=$row1['product_price'];
               $pic=$row1['product_image']; 
              $title=$row1['product_title'];
               echo "
              <tr align='center'>
                <th>
               <input type='checkbox' name='remove[]' value='$id1'></th>
                 <th><h3>$title</h3></th>
         
              <th><img  width='100' height='100' src='admin/product_img/$pic'></th>
               <th><h4 class='wish-price'></th>
               <th>$price</th>
               <th><a href='details.php?pro_id=$id1'> Details</a></th>
               </tr>
               " ;
                       }
      
        
                    }
   
                 
                 


    }
    $user=$_SESSION['c_mail'];
    if(isset($_POST['continue'])){
  header("location:index.php"); 
    }
    if(isset($_POST['update'])){
  

        foreach($_POST['remove'] as $remove){
        
        $del="DELETE FROM wishlist WHERE p_id='$remove' AND email='$user'";
        $run=mysqli_query($conn,$del);
        
        }

  if($run){
header("location:wishlist.php");
} 
}          
   

    ?>








