
<?php 
include 'admin/includes/db.php';
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
        <h2 style="text-align:center;"> Register/Sign up</h2>
<form action="" method="post" enctype="multipart/form-data"> 
<table align="center" width="500" border="2">
<tr align="center">
    <td align="right">Name: </td>
<td align="left">
<input type="text" name="name" required>
</td>
    </tr>
<tr align="center">
    <td align="right">E-mail:</td>
<td align="left"><input type="email" name="email" required></td>
    </tr>

    <tr align="center">
    <td align="right">Password: </td>
<td align="left">
<input type="password" name="password" required>
</td>
    </tr>

    <tr align="center">
    <td align="right">Country: </td>
<td align="left" >
<select name="country">
<option>America</option>
<option>France</option>
<option>India</option>
<option>Europe</option>
</select>
</td>
    </tr>
   
    <tr align="center">
    <td align="right">City:</td>
<td align="left"><input type="text" name="city" required></td>
    </tr>

    <tr align="center">
    <td align="right">Contact Number:</td>
<td align="left"><input type="number" name="contact" required></td>
    </tr>

<tr align="center">
    <td align="right">Address:</td>
<td align="left"><input type="text" name="address" required></td>
    </tr>


<tr align="center"><td><input type="submit" name="register" value="register" align="center" required></td>

</tr>

</table>

</form>


    </body>

</html>

 <?php
 
 global $conn;
 if(isset($_POST['register'])){
$ip=getIp();

$c_name=$_POST['name'];
$c_mail=$_POST['email'];
$c_password=$_POST['password'];
$c_country=$_POST['country'];
$c_city=$_POST['city'];
$c_contact=$_POST['contact'];
$c_address=$_POST['address'];



$insert1="INSERT INTO customers (c_ip,c_name,c_mail,c_pass,c_country,c_city,c_contact,c_address) VALUES ('$ip','$c_name','$c_mail','$c_password','$c_country','$c_city','$c_contact','$c_address')";

$run=mysqli_query($conn,$insert1);

$show="SELECT * FROM customers WHERE c_ip='$ip'";
$run=mysqli_query($conn,$show);
$check=mysqli_num_rows($run);
$_SESSION['c_mail']=$c_mail;
if($check==0){

    echo "<script>alert('registered successfully :)') </script>";
    echo "<script>window.open('customer/myacc.php','_self') </script>";
}
else{


    echo "<script>alert('registered successfully :)') </script>";
    echo "<script>window.open('payment.php','_self') </script>";
}

}
?>
