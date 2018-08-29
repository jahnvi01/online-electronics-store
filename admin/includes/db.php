
<?php
$servername = "localhost";
$username= "root";
$password = "jahnvi123";
$dbname = "ecommerce";



$conn = mysqli_connect($servername, $username, $password, $dbname);


function 
getIp(){

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

?>