<?php
include('function.php');
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
<img id="logo" src="logo.svg" width="150" height="50">
</div>
<div class="col-md-10">
<h3 id="title">Welcome to admin area<h3>
</div>



</div>
<div class="row content_wrapper">
    <div id="sidebar" class="col-md-2">
<h5><a href="admin.php?view_p">View all products </a></h5>        
<h5><a href="admin.php?insert_p">Insert new product </a></h5>
<h5><a href="admin.php?view_cus">View all customers </a></h5>
<h5><a href="admin.php?view_pay">View payments </a></h5>
<h5><a href="admin.php?view_ods">View all orders </a></h5>
<h5><a href="../index.php">Log out</a></h5>


</div>
<div id="content_area" class="col-md-10">
<?php
customer();?>
<div id="product_box">

<?php

if(isset($_GET['insert_p'])){
 header('location:insert.php');
}

if(!isset($_GET['view_cus'])){
if(!isset($_GET['view_p'])){
    echo "
    <div>
    <form action='admin.php' method='' enctype='multipart/form-data'>
<h5>Insert new category name: <h5>
<input type='text' name='cat' >
<input type='submit' name='add_c' value='Add'>

<h5>Insert new brand name: <h5>
<input type='text' name='brand' >
<input type='submit' name='add_b' value='Add'>
</form>
</div>
    ";
}

}
if(!isset($_GET[view_cus]))
{viewpro();
delpro();
insertcat();
insertbrand();

if(!isset($_GET['view_p'])){
echo "
<div id='list_area' >
<div class='list'>
<div class='catlist'>
    <h5>CATEGORIES</h5>
";
    viewcats();


    echo "
    </div>
<div class='brandlist'>
<h5>BRANDS</h5>
    ";
viewbrand();
echo "

</div>
</div>

";
}
}
?>
</div>

</div>



</div>

</div>
</div>

<div id="footer" class="row">

</div>
    </div>
	







    </body>

</html>