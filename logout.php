<?php 

session_start();
session_destroy();

if(isset($_COOKIE['username'])&&isset($_COOKIE['password'])) {
setcookie("username", "", time() - 3600);
setcookie("password", "", time() - 3600);
}
echo "<script>alert('you logged out!!')</script>";

echo "<script>window.open('mnnit_Ekart.php','_self')</script>";

?>