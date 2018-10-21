<?php 
include 'function/function.php';
session_start();
if(!isset($_SESSION['recent']))     {
    $_SESSION['recent'] = array();
  }
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

<div class='review'>

<h3>Add a comment</h3>
<form action="" method="post" enctype="multipart/form-data"> 
<input type="text" name="comment" class="comment" placeholder="Leave a comment here...">
<input type="submit" name="post" value="Post">
</form>
<div class='review_sec'>
    <h3 class='review_title'>Review section</h3>
<?php
seereviews();
?>
</div>
</div>
</div>



</div>
</div>

    </div>
	<?php
recentviewed();
addreview();

?>
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

function recentviewed(){
   echo "<div class='recent_box'>
   <h3 class='recent-title'>Recently viewed products</h3>
   ";
    if(isset($_GET['pro_id']))
    {  global $conn;
        $pro_id=$_GET['pro_id'];
        $c=count($_SESSION['recent']);
      session_start();
      $enter=1;
      foreach($_SESSION['recent'] as $check){
       // echo "<script>alert('$check')</script>";
if($check==$pro_id){
$enter=0;
// echo "<script>alert('$enter')</script>";
}
  }
      if(count($_SESSION['recent'])<5 && $enter==1){
    array_push($_SESSION['recent'],$pro_id);

    }
       else{
            if($enter==1){
           $_SESSION['recent'] = array_slice($_SESSION['recent'],1);
           array_push($_SESSION['recent'],$pro_id);
      }
    }
      foreach($_SESSION['recent'] as $rec){
//echo "<script>alert('$rec')</script>";
        $get_products="SELECT * FROM products WHERE product_id='$rec'";
        $run=mysqli_query($conn,$get_products);
        while($row=mysqli_fetch_array($run)){
            $pro_title=$row['product_title'];
            $pro_price=$row['product_price'];
            $pro_image=$row['product_image'];
            echo "
            <a href='details.php?pro_id=$rec'>
            <div class='recent_product'>
            <h3 class='pro_title'>$pro_title</h3>
          <img class='pro_img' width='100' height='100' src='admin/product_img/$pro_image'>
           <h4 class='pro_price'>Price: $pro_price</h4>
          
           </div>
           </a>
           </div>";
    


        }
      }
      
    } 
    echo "</div>";
}


function addreview(){
    if(isset($_POST['post'])){
    if(isset($_GET['pro_id']))
    {  
        if(isset($_SESSION['c_mail'])){
        global $conn;
       $user=$_SESSION['c_mail'];
      $pro_id=$_GET['pro_id'];
    $comment=$_POST['comment'];
   if($comment!=""){
    $add="INSERT INTO review (p_id,user,comment) VALUES ('$pro_id','$user','$comment')";
$run=mysqli_query($conn,$add);
header("location:details.php?pro_id=$pro_id"); 
        }
    }
        else{
            header("location:checkout.php"); 
        }
    }
}
}

function seereviews(){
    global $conn;
    $id=$_GET['pro_id'];
    $review="SELECT * FROM review WHERE p_id='$id'";
    $result=mysqli_query($conn,$review);
    while($row=mysqli_fetch_array($result)){
        $user=$row['user'];
        $cmnt=$row['comment'];
        $cust="SELECT * FROM customers WHERE c_mail='$user'";
$run=mysqli_query($conn,$cust);
while($rw=mysqli_fetch_array($run)){
   $name=$rw['c_name'];
}
        echo "
        <h3 class='cmt-name'>$name</h3>
        <h3 class='cmt-list'>$cmnt</h3>
                ";
    }

}
?>