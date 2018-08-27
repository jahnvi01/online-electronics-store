<?php 
include 'includes/db.php';
?> 
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
            crossorigin="anonymous">
<style>
body{
    background:skyblue;
}
td{
    padding:3%;
    font-size:16px;
    font-weight:bold;
}
    </style>

    </head>
    
    <body>
<form action="" method="post" enctype="multipart/form-data"> 
<table align="center" width="500" border="2">
<tr align="center">
    <td align="right">Product Title:</td>
<td align="left"><input type="text" name="product_title" required></td>
    </tr>

    <tr align="center">
    <td align="right">Product Category: </td>
<td align="left">
<select name="product_cat">
<?php
global $conn;
$get_cats="SELECT * FROM categories";
   $run=mysqli_query($conn,$get_cats);
   while($row=mysqli_fetch_array($run)){
       $cat_id=$row['cat_id'];
       $cat_title=$row['cat_title'];
       echo "<option value='$cat_id'> $cat_title</opion>";
   }
?>
</select>
</td>
    </tr>

    <tr align="center">
    <td align="right">Product Brand: </td>
<td align="left">
<select name="product_brand">
<?php
  global $conn;
  $get_brands="SELECT * FROM brands";
  $run=mysqli_query($conn,$get_brands);
  while($row=mysqli_fetch_array($run)){
      $brand_id=$row['brand_id'];
      $brand_title=$row['brand_title'];
      echo "<option value='$brand_id'> $brand_title</option>";
  }
?>
</select>

</td>
    </tr>

    <tr align="center">
    <td align="right">Product Image: </td>
<td align="left"><input type="file" name="product_image" required></td>
    </tr>

    <tr align="center">
    <td align="right">Product Price: </td>
<td align="left"><input type="text" name="product_price" required></td>
    </tr>

 
 <tr align="center">
    <td align="right">Product Description: </td>
<td align="left"><textarea type="text" cols="20" rows="10" name="product_desc">
</textarea></td> </tr>

    <tr align="center">
    <td align="right">Product Keywords: </td>
<td align="left"><input type="text" name="product_keyword" required></td>
    </tr>

 
 <tr align="center">
<td colspan="8"><input type="submit" name="insert11" value="insert"></td>
    </tr>
   
</table>
    </form>


    </body>

</html>

<?php
if(isset($_POST['insert11']))
{

    $product_cat=$_POST['product_cat'];
    $product_title=$_POST['product_title'];
    $product_brand=$_POST['product_brand'];
    $product_price=$_POST['product_price'];
    $product_keyword=$_POST['product_keyword'];
    $product_desc=$_POST['product_desc'];
  
 $product_image =$_FILES['product_image']['name'];
 $product_img_tmp=$_FILES['product_image']['tmp_name'];
  move_uploaded_file($product_img_tmp,"product_img/".$product_image);
$insert1="INSERT INTO products (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keyword) VALUES ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keyword')";
$run=mysqli_query($conn,$insert1);

if($run){

    echo"<script>locaion.href='../index.php'</script>";
}
}
?>