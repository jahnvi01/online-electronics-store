<?php
include('includes/db.php');

function viewpro(){
    if(isset($_GET['view_p'])){
        global $conn;
     
        $get_products="SELECT * FROM products";
        $run=mysqli_query($conn,$get_products);
        while($row=mysqli_fetch_array($run)){
            $pro_id=$row['product_id'];
            $pro_cat=$row['product_cat'];
            $pro_brand=$row['product_brand'];
            $pro_title=$row['product_title'];
            $pro_price=$row['product_price'];
            $pro_desc=$row['product_desc'];
            $pro_image=$row['product_image'];
            $pro_keyword=$row['product_keyword'];
            echo "<div id='single_product'>
            <h3 class='pro_title'>$pro_title</h3>
            <img class='pro_img' width='70' height='70' src='product_img/$pro_image'>    
           <h4 class='pro_price'>Price: $pro_price</h4>
       <a href='../details.php?pro_id=$pro_id'>Details</a>
       <a href='admin.php?del=$pro_id'>Delete</a>
       </div>";
    
    }
    
    }
    
}
function delpro(){
    if(isset($_GET['del'])){
   
        global $conn;
    
        $id=$_GET['del'];
       
        $del="DELETE FROM products WHERE product_id='$id'";
       
        $run=mysqli_query($conn,$del);
        if($run){
            echo "<script>alert('product deleted')</script>";
            echo "<script>window.php('admin.php?view_p')</script>";
       
        }   
    } 

}


function insertcat(){
    global $conn;
    if(isset($_GET['add_c'])){
$cat=$_GET['cat'];
if($cat!=''){
$add="INSERT INTO categories (cat_title) VALUES ('$cat')";
$run=mysqli_query($conn,$add);
echo "<script>alert('category added')</script>";
    }
}
}
function insertbrand(){
    global $conn;
    if(isset($_GET['add_b'])){
$brand=$_GET['brand'];
if($brand!=''){
$add="INSERT INTO brands (brand_title) VALUES ('$brand')";
$run=mysqli_query($conn,$add);
echo "<script>alert('brand added')</script>";
    }
    }
}
function viewcats(){
    global $conn;
    $get_cats="SELECT * FROM categories";
    $run=mysqli_query($conn,$get_cats);
    while($row=mysqli_fetch_array($run)){
    $cat=$row['cat_title'];
        echo "<h4 class='cat'>$cat</h4>";
    }
}
function viewbrand(){
    global $conn;
    $get_brands="SELECT * FROM brands";
    $run=mysqli_query($conn,$get_brands);
    while($row=mysqli_fetch_array($run)){
    $brand=$row['brand_title'];
        echo "<h4 class='brand'>$brand</h4>";
    }
}
function customer(){
   
    if(isset($_GET['view_cus'])){
    echo "
    <table align='center' class='customers' >
    <tr class='cus_row'>
    <th>Name</th>
    <th>email</th>
    <th>country</th>
    <th>city</th>
    <th>contact</th>
    <th>address</th>
    </tr>
    ";
    
$list="SELECT * FROM customers";
global $conn;
$run=mysqli_query($conn,$list);
while($row=mysqli_fetch_array($run)){
   $name=$row['c_name'];
   $mail=$row['c_mail'];
   $contact=$row['c_contact'];
   $country=$row['c_country'];
   $city=$row['c_city'];
   $address=$row['c_address'];
    echo " <tr class='cus_row'>
   <td>$name</td>
   <td>$mail</td>
   <td>$country</td>
   <td>$city</td>
   <td>$contact</td>
   <td>$address</td>
   </tr>";
}
    echo"
   </table> 
    " ;
    }
    }
?>