<!DOCTYPE html>
<?php 

$con =mysqli_connect("localhost","root","","webster") or die ("could not connet to mysqli");
//include"function/function_web.php";



if(isset($_POST['login'])){
    if(!isset($_SESSION['username']))
    {
    global $con;
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $flag=0;
    $select_c="select * from user";
    $run_c=mysqli_query($con,$select_c);
    while($rr=mysqli_fetch_array($run_c)){
       $e=$rr['email'];
        $p=$rr['password'];
        if($e==$email){
            $flag=1;
            if($p==$pass){
                echo"<script>alert('you logged in successfully')</script>";
                session_start();
                $_SESSION['username']=$rr['username'];
                
                if(isset($_POST['remindme']))
                {
                setcookie('username',$rr['username'], time() + (86400 * 30)); // 86400 = 1 day
                setcookie('password',$pass, time() + (86400 * 30)); // 86400 = 1 day
                }
                echo"<script>window.open('mnnit_Ekart.php','_self')</script>";
            }
            
            else{
                $_SESSION['error_2']="password doesn't matched !!";
                echo"<script>window.open('login.php','_self')</script>";
            }
        }
        
    }
    if($flag==0){
            echo"<script>alert('signup first!!')</script>";
            echo"<script>window.open('signup.php','_self')</script>";
        }
    
}
    else
    {
        echo"<script>alert(' already logged in!!')</script>";
            echo"<script>window.open('mnnit_Ekart.php','_self')</script>";
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
      <!--<li class="nav-item">
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
      
      <li class="nav-item active">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item inactive">
          <a class="nav-link" href="signup.php">Sign Up</a></li>
      <!--<li class="nav-item inactive">
        <a class="nav-link" href="whislist.php">Whislist<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
      	<li class="nav-item inactive">
        <a class="nav-link" href="cart.html"><i class="fa fa-shopping-cart" aria-hidden="true">Cart</i><span class="sr-only">(current)</span></a>
      </li>-->
    </ul>
  </div></nav>
  
  
	<div style="margin-top:100px;" class="container">
<form method="post">
  <div class="form-group">
   
    
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email"></br>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
   
    <div style="color:red;">
    <?php 
      
      if(isset($_SESSION['error_2']))
      {
          echo $_SESSION['error_2'];
      }
      ?>
      </div>
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
  </div>
  <input type="checkbox" name="remindme">Remind me!
  <button type="submit" name="login" class="btn btn-primary">Login</button>
  <br/>
</form>

</div>
<div style="text-align:center;">
    MNNIT E-CART &copy 2018
</div>
</body>
</html>