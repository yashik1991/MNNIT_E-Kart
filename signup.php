<!DOCTYPE html>
<?php 

$con =mysqli_connect("localhost","root","","webster") or die ("could not connet to mysqli");
//include('function_web.php');


session_start();
if(isset($_SESSION['error_1']))
var_dump($_SESSION['error_1']);
if(isset($_SESSION['error_2']))
var_dump($_SESSION['error_2']);
//$_SESSION['error_1']="";
//$_SESSION['error_2']="";

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}




global $con;

if(isset($_POST['submit']))
{

$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['npassword'];
$cpassword=$_POST['cpassword'];
    
    $ip=get_client_ip();
    
    $select_user= "select * from user";
    $run_user=mysqli_query($con,$select_user);
    $flag=0;
    
    while($r=mysqli_fetch_array($run_user))
    {
        $temp_user=$r['username'];
        if($temp_user==$username)
        {
            $flag=1;
            $_SESSION['error_1']="usernmae already exist!!";
            echo "<script>window.open('signup.php','_self_')</script>";
            break;
        }

    }
    if(($password!=$cpassword)&&$flag==0)
    {
        $_SESSION['error_2']="password doesn't matched !!";
        echo "<script>window.open('signup.php','_self')</script>";
    }

    else if($flag!=1)
    {
        $ip=get_client_ip();
        $insert_user="insert into user (user_ip,username,email,password) values ('$ip','$username','$email','$password') ";
        $insert_run = mysqli_query($con,$insert_user);
        if($insert_run){
            $_SESSION['username']=$username;
         echo "<script>alert('you signedup successfully !')</script>";
                echo"<script>window.open('mnnit_Ekart.php','_self')</script>";
            }
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
        
        .form-control{
            width:50%;
        }
        @media only screen and (max-width:500px){
        .form-control{
            width:100%;
            transition-duration: 3s;
            }}
        
        .mynav{
            background-color: #ff3300;
        }
	</style>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="mnnit_Ekart.php">MNNIT E-CART</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Products
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
     <!-- <li class="nav-item">
      	<form class="form-inline my-2 my-lg-0" >
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
      </li>-->
    </ul>
     <ul class="navbar-nav">
     	<li class="nav-item inactive">
        <a class="nav-link" href="mnnit_Ekart.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item inactive">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="signup.php">Sign Up</a>
      <!--<li class="nav-item inactive">
        <a class="nav-link" href="whislist.php">Whislist<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
      	<li class="nav-item inactive">
        <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true">Cart</i><span class="sr-only">(current)</span></a>
      </li>-->
    </ul>
  </div></nav>
  <!--sign up form-->
  <div style="margin-top:100px;" class="container">
  <form method="post">
  <div class="form-group">
    <label for="Username">Enter Username</label>
    <div style="color:red;">
    <?php 
      
      if(isset($_SESSION['error_1']))
      {
          echo $_SESSION['error_1'];
      }
      ?>
      </div>
    <input class="form-control" name="username" type="text" placeholder="Username" autofocus required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Enter email-address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div style="color:red;">
   <?php 
      
      if(isset($_SESSION['error_2']))
      {
          echo $_SESSION['error_2'];
      }
      ?>
      </div>
  <div class="form-group">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" class="form-control" name="npassword" placeholder="Password" required>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Re-Enter Password</label>
    <input type="password" class="form-control" name="cpassword" placeholder="Re-Enter Password" required>
  </div>
  
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  

</form>
</div>
  <div style="text-align:center;">
    MNNIT E-CART &copy 2018
</div>
</body>
</html>
