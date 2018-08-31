<?php 
include 'includes/db.php';
include 'function/function.php';

?> 
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
            crossorigin="anonymous">
<style>
body{
    background-repeat: no-repeat;
    background-size: cover;
    
}
td{
    padding:3%;
    font-size:16px;
    font-weight:bold;
}
td,.register{
    text-shadow: 5px 5px 10px  black;
    text-align:center;
 color:white;
}
table{
    border:2px solid white;
}
  
    </style>

    </head>
    
    <body  background="images/background.jpeg">
        <h2 class="register"> Login/Sign in</h2>
<form action="checkout.php" method="post" enctype="multipart/form-data"> 
<table align="center" width="500">
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
<tr align="center"><td><input type="submit" name="login" value="login" align="center" required></td>
<td><h4><a class="register" href="register.php">NEW?? Register here!!!</a><h4></td>
</tr>

</table>

</form>


    </body>

</html>



<?php
if(isset($_POST['login'])){
    
$mail=$_POST['email']; 
$pwd=$_POST['password'];

$user="SELECT * FROM customers WHERE c_mail='$mail' AND c_pass='$pwd'";
$run=mysqli_query($conn,$user);
if(mysqli_num_rows($run)==0){
    echo "<script>alert('Wrong username and password')</script>";
}
else{
    session_start();
    $ip=getIp();
$show="SELECT * FROM customers WHERE c_ip='$ip'";
$run=mysqli_query($conn,$show);
$check=mysqli_num_rows($run);
$_SESSION['c_mail']=$mail;
echo "<script>alert('$_SESSION[c_mail]') </script>";
if($check==0){
    echo "<script>window.open('index.php','_self') </script>";
}
else{

    echo "<script>window.open('payment.php','_self') </script>";
}
}

}
?>