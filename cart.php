<!DOCTYPE html>
<?php 

session_start();

$con =mysqli_connect("localhost","root","","webster") or die ("could not connet to mysqli");
//include('function/function.php');


remove();
// counting numbers of product from cart
function total_items_cart()
{
    global $con;
if(isset($_SESSION['username']))
{
    $user=$_SESSION['username'];
    $count_cart="select * from cart where username='$user'";
    $run_count=mysqli_query($con,$count_cart);
    $count_item=mysqli_num_rows($run_count);
    echo $count_item;
    
}
}

// counting numbers of product from wishlist

function total_items_wishlist()
{
    global $con;
if(isset($_SESSION['username']))
{
    $user=$_SESSION['username'];
    $count_wish="select * from wishlist where username='$user'";
    $run_count=mysqli_query($con,$count_wish);
    $count_item=mysqli_num_rows($run_count);
    echo $count_item;
    
}
}


function remove(){
    
    if(isset($_GET['pro_id']))
    {
    global $con;
    $username=$_SESSION['username'];
    $pro_id=$_GET['pro_id'];
    
    $remove_item="DELETE from cart where username='$username' AND pro_id='$pro_id'";
    
   $remove_run=mysqli_query($con,$remove_item);
        if($remove_run){
     echo"<script>alert('removed!!')</script>";
    echo"<script>window.open('cart.php','_self')</script>";
} }
}
//total prices


function cart_item(){
    global $con;
    if(isset($_SESSION['username']))
    {
        $username=$_SESSION['username'];
    $get_wish="select * from cart where username='$username'";
    $run_wish=mysqli_query($con,$get_wish);
    while($row_wish=mysqli_fetch_array($run_wish)){
      $p_id=$row_wish['pro_id'];
            $get_product="select * from products where pro_id='$p_id'";
            $run_product=mysqli_query($con,$get_product);
             global $con;
        
            while($pp_row=mysqli_fetch_array($run_product)){
                
                $pro_id=$pp_row['pro_id'];
                 $pro_title=$pp_row['pro_title'];
                $pro_cat=$pp_row['pro_cat'];
                $pro_brand=$pp_row['pro_brand'];
                $pro_desc=$pp_row['pro_desc'];
                $pro_image=$pp_row['pro_img'];
                echo"<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>
        <div class='card pick'>
    <a href='detail.php?pro_id=$pro_id' ><img class='card-img-right' src='images/$pro_image' alt='Card image cap'></a>
  <div class='card-body'>
    <h4 class='card-title'>$pro_title</h4>
    <p class='card-text'>$pro_desc</p>
    <a href='cart.php?pro_id=$pro_id' class='btn btn-primary' name='remove'>remove</a>
  </div></div>
</div>";
            }
        
    }
    }
        else{
            echo "<script>alert('login first')</script>";
        echo "<script>window.open('mnnit_Ekart.php','_self')</script>";
        }
    

}

?>
<html>
<head>
	<title>MNNIT E-CART</title>
	<link rel="stylesheet" type="text/css" href="design.css">
	<!--<link rel="stylesheet" type="text/css" href="bootstrap.css">-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


	<script
  src="http://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
	<style type=text/css>
	</style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="mnnit_Ekart.html">MNNIT E-CART</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="mnnit_Ekart.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Products
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
      	<form class="form-inline my-2 my-lg-0" >
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
      </li>
    </ul>
     <ul class="navbar-nav">
     	<li class="nav-item">
        <a class="nav-link active" href="mnnit_Ekart.php">Home <span class="sr-only">(current)</span></a>
      </li>
      
    
       <?php 
          if(isset($_SESSION['username'])!=null)
          {
          ?>
          
          <li class="nav-item inactive">
        <a class="nav-link" href=""><?php echo $_SESSION['username'] ;?></a>
         </li>
         <li class="nav-item inactive">
        <a class="nav-link" href="logout.php">logout</a>
         </li>
          
        <?php }
          
          else
          {
              ?>
              <li class="nav-item inactive">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item inactive">
        <a class="nav-link" href="signup.php">Sign Up</a>
         </li>
          
    <?php } ?>
         
      <li class="nav-item inactive">
        <a class="nav-link" href="whislist.php"><i class="fa fa-heart" aria-hidden="true"></i><span class="sr-only">(current)</span><span class="badge badge-pill badge-light"><?php total_items_wishlist();?></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
      	<li class="nav-item inactive">
        <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sr-only">(current)</span><span class="badge badge-pill badge-light"><?php total_items_cart();?></span></a>
      </li>
    </ul>
  </div></nav>
  

<div class="container" style="margin-top:100px;" >
<div class="row">
<!--
  <div class="card" style="width: 18rem;">
  <img class="card-img-top" src=".../100px180/" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  </div>
-->

<?php cart_item();?>
</div>
    </div>
<div style="text-align:center;">
    MNNIT E-CART &copy 2018
</div>
</body>
</html>