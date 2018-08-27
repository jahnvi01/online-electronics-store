
<?php
$servername = "localhost";
$username= "root";
$password = "jahnvi123";
$dbname = "ecommerce";



$conn = mysqli_connect($servername, $username, $password, $dbname);
function getIp(){

    $ip = $_SERVER['REMOTE_ADDR'];     
    if($ip){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $ip;
    }
    return false;
}

    function getcats(){
    global $conn;
    $get_cats="SELECT * FROM categories";
    $run=mysqli_query($conn,$get_cats);
    while($row=mysqli_fetch_array($run)){
        $cat_id=$row['cat_id'];
        $cat_title=$row['cat_title'];
        echo "<li><a href='index.php?cat=$cat_id'> $cat_title</a></li>";
    }
}


function getbrands(){
    global $conn;
    $get_brands="SELECT * FROM brands";
    $run=mysqli_query($conn,$get_brands);
    while($row=mysqli_fetch_array($run)){
        $brand_id=$row['brand_id'];
        $brand_title=$row['brand_title'];
        echo "<li><a href='index.php?brand=$brand_id'> $brand_title</a></li>";
    }
}
//showing products on page
function getproducts(){
    global $conn;
    if(!isset($_GET['search'])){
    if(!isset($_GET['cat'])){
        
    if(!isset($_GET['brand'])){
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
        <img class='pro_img' width='180' height='180' src='admin/product_img/$pro_image'>    
       <h4 class='pro_price'>Price: $pro_price</h4>
       <a href='details.php?pro_id=$pro_id'>Details</a>
       <a href='index.php?pro_id=$pro_id' name='add_cart'><button style='float:right'>Add to cart</button></a>
       </div>";
    }
}
    
}
    }
}


function showcats(){
    global $conn;
    if(isset($_GET['cat'])){
        $cat_id=$_GET['cat'];
    $get_cats="SELECT * FROM products WHERE product_cat='$cat_id'";
    $run=mysqli_query($conn,$get_cats);
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
        <img class='pro_img' width='180' height='180' src='admin/product_img/$pro_image'>    
       <h4 class='pro_price'>Price: $pro_price</h4>
       <a href='details.php?pro_id=$cat_id'>Details</a>
       <a href='index.php?pro_id=$cat_id'><button style='float:right'>Add to cart</button></a>
       </div>";
    }
}
}




function showbrands(){
    global $conn;
    if(isset($_GET['brand'])){
        $brand_id=$_GET['brand'];
    $get_brands="SELECT * FROM products WHERE product_brand='$brand_id'";
    $run=mysqli_query($conn,$get_brands);
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
        <img class='pro_img' width='180' height='180' src='admin/product_img/$pro_image'>    
       <h4 class='pro_price'>Price: $pro_price</h4>
       <a href='details.php?pro_id=$brand_id'>Details</a>
       <a href='index.php?pro_id=$brand_id'><button style='float:right'>Add to cart</button></a>
       </div>";
    }
}
}

function searchproducts(){

    global $conn;
if(isset($_GET['search'])){
    $pro=$_GET['user_query'];
    $get_products="SELECT * FROM products WHERE product_keyword LIKE '%$pro%'";
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
        <img class='pro_img'  width='180' height='180' src='admin/product_img/$pro_image'>    
       <h4 class='pro_price'>Price: $pro_price</h4>
       <a href='details.php?pro_id=$pro_id'>Details</a>
       <a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to cart</button></a>
       </div>";
    }
}
}

function addcart(){
$ip=getIp();
global $conn;
    if(isset($_GET['pro_id'])){
$id=$_GET['pro_id'];
$check="SELECT * FROM cart WHERE ip='$ip' AND p_id='$id'";
$run=mysqli_query($conn,$check);
if(mysqli_num_rows($run)>0){
    echo "";
}
else{

    $insert="INSERT INTO cart (p_id,ip,qty) VALUES ('$id','$ip','0')";
$run=mysqli_query($conn,$insert);
    echo "<script>alert('product added to the cart') </script>";
}

}

}



function showcart(){
$x=0;
$i=0;
$total_item=0;
$total_price=0;
$idd=array();
$qty=array();
    $ip=getIp();
    global $conn;
    $check="SELECT * FROM cart WHERE ip='$ip'";
    $run=mysqli_query($conn,$check);
    while($row=mysqli_fetch_array($run)){
        $id=$row['p_id'];
    $idd[$i]=$id;
   echo "<script>console.log('$idd[$i]')</script>";   
    $qty=$row['qty'];
    $total_item=$qty+$total_item;
        $singleprize="SELECT * FROM products WHERE product_id='$id'";
        $result=mysqli_query($conn,$singleprize);
        while($rw=mysqli_fetch_array($result)){
           
            $price=$rw['product_price']*$qty;
            $total_price=$price+$total_price;
            $pic=$rw['product_image']; 

            echo "
            <tr align='center'>
            <th><input type='checkbox' name='remove[]' value='$id'></th>
     
            <th><img  width='100' height='100' src='admin/product_img/$pic'></th>

            <th><input type='number' class='qty' value='$qty' name='qty[]'  size='1'></th>
            <th>$price</th>
            </tr>
             ";
                    }
   
 $i++;
   }

   echo "<div >
   <h4 class='bill'>Total Items: $total_item </h4>
   <h4 class='bill'>Total Bill:  $total_price</h4>
   </div>";
   if(isset($_POST['continue'])){
       header("location:index.php");
   }
  
    if(isset($_POST['update'])){
  

        foreach($_POST['remove'] as $remove){
        
        $del="DELETE FROM cart WHERE p_id='$remove' AND ip='$ip'";
        $run=mysqli_query($conn,$del);
        
        }
  
       foreach($_POST['qty'] as $qty){
 $qnt[$x]=$qty;
    echo "<script>console.log('$qnt[$x]')</script>";
$x++;    
}
   for($i=0;$i<$x;$i++){
  echo "<script>alert('$qnt[$i]')</script>";
    $quantity="UPDATE cart SET qty='$qnt[$i]'  WHERE p_id='$idd[$i]' AND ip='$ip' ";   
    $run=mysqli_query($conn,$quantity);

}     

  if($run){
header("location:cart.php");
} 
           
   
            
    }
        
        

}

// function button(){
//     global $conn;
//     $ip=getIp();
      //      $quantity="UPDATE cart SET qty='$qnt[$x]'";
        //    $test=mysqli_query($conn,$quantity);
          //  $x++;
        //global $q;
        // $q=$_SESSION['qty'];
// }
?>


